<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Http\Controllers\Traits\HasError;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\UserCoin;
use App\Coin;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationMail;
use App\Models\Admin\Setting;
use App\Reference;
use App\Mail\SendNotifyMail;
use Illuminate\Support\Str;
use Bitly;
use Illuminate\Support\Facades\Notification;

class UserController extends Controller {

    use HasError;

    public function register(Request $request) {
        $input = $request->all();
        $setting = Setting::whereId(1)->first();

        if (empty($request->bitcoin_address)) {
            $rules = ([
                'first_name' => 'required',
                'last_name' => 'required',
                'country' => 'required',
                'phone_no' => ['required', 'max:15'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
                'confirm_password' => 'required|same:password',
                'bitcoin_address' => 'required|regex:/^[13][a-km-zA-HJ-NP-Z1-9]{25,34}$/'
            ]);
        } else {
            $rules = ([
                'bitcoin_address' => 'regex:/^[13][a-km-zA-HJ-NP-Z1-9]{25,34}$/',
                'first_name' => 'required',
                'last_name' => 'required',
                'country' => 'required',
                'phone_no' => ['required', 'max:15', 'unique:users'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
                'confirm_password' => 'required|same:password',
                'bitcoin_address' => 'required'
            ]);
        }


        $error = static::getErrorMessage($input, $rules);

        if ($error) {
            return $error;
        }

        DB::beginTransaction();
        try {
            $rand = strtoupper(Str::random(6));
            $verify_code = mt_rand(2000, 9000);
            $site_url = url('register/?ref=' . $rand);
            $url = Bitly::getUrl($site_url);
            $input['ref_code'] = $url;
            $input['ref_check'] = $rand;
            $input['verified_code'] = $verify_code;
            $input['type'] = 'user';
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
            if ($request->ref) {
                $owner = User::whereRef_check($request->ref)->first();
                if (!is_object($owner)) {
                    return ([
                        'status' => 422,
                        'message' => 'Invalid Ref User'
                    ]);
                }
                //creste
                Reference::create([
                    'user_id' => $owner->id,
                    'referred_id' => $user->id
                ]);
                //send mail
                $greeting = 'Hello' . ' ' . $owner->first_name;
                $email = $owner->email;
                $subject = 'Referral Registration Notification';
                $message = $user->first_name . ' ' . $user->last_name . '  registered with your referral link';

                Notification::route('mail', $email)
                        ->notify(new SendNotifyMail($greeting, $subject, $message));
            }
            if (!empty($request->bitcoin_address)) {
                $coin = Coin::whereSlug('bitcoin_address')->first();
                UserCoin::create([
                    'user_id' => $user->id,
                    'coin_id' => $coin->id,
                    'amount' => 0,
                    'address' => $request->bitcoin_address
                ]);
            }
            $type = 'user';
            $subject = $setting->site_name . ' - Welcome to ' . $setting->site_name;
            Mail::to($user->email)->send(new RegistrationMail($user, $subject, $type));
            //send admin message
            $type_admin = 'admin';
            $subject_admin = $setting->site_name . ' New Registration ';
            Mail::to($setting->send_notify_email)->send(new RegistrationMail($user, $subject_admin, $type_admin));
            Auth::login($user);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        return ([
            'status' => 200,
            'message' => 'Registration Completed'
        ]);
    }

    public function comfirm(Request $request) {
        $input = $request->all();

        $rules = ([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
            'password_confirmation' => 'required|same:password'
        ]);
        $error = static::getErrorMessageSweet($input, $rules);

        if ($error) {
            return $error;
        }
        $user = User::whereEmail($request->email)->first();
        if (is_object($user)) {
            $password = bcrypt($input['password']);
            $user->password = $password;
            $user->save();
            session()->flash('message.level', 'success');
            session()->flash('message.color', 'green');
            session()->flash('message.content', 'Password Succesfully Changed');
            return Redirect:: to('login');
        } else {
            session()->flash('message.level', 'error');
            session()->flash('message.color', 'red');
            session()->flash('message.content', 'Invalid Email Provided');
            return Redirect::back()->withInput();
        }
    }

}
