<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Setting;
use App\User;
use \App\Http\Controllers\Traits\HasError;
use Illuminate\Support\Carbon;
use App\Coin;
use App\UserCoin;
use Illuminate\Support\Facades\Notification;
use App\Mail\RegistrationMail;
use App\Investment;
use App\Mail\PlanDepositMail;
use App\Withdraw;
use App\Mail\SendNotifyMail;
use App\Transaction;
use Illuminate\Support\Facades\DB;
use App\Plan;
use App\Compound;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\TraitsFolder\MailTrait;
use App\Reference;
use Illuminate\Support\Facades\Auth;
use App\UserCompounding;
use Illuminate\Pagination\LengthAwarePaginator;
use CountryState;
use App\HomePageText;
use Bitly;
use App\UserWithdrawal;

class AdminController extends Controller {

    use HasError,
        MailTrait;

    public function setting() {
        $data['setting'] = Setting::whereId(1)->first();
        return $data;
    }

    public function getHistory(Request $request) {
        if ($request->type == null) {
            $url_path = url('admin-get_history');
        } else {
            $url_path = url('admin-get_history?type=' . $request->type);
        }
        $data['coins'] = Coin::all();
        if ($request->type == null) {
            $items = Transaction::whereStatus(true)->with('coin', 'user')->orderBy('created_at', 'desc')->get();
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $itemCollection = collect($items);
            $perPage = 20;
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage ) - $perPage, $perPage)->all();
            $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
            $data['histories'] = $paginatedItems->setPath($url_path);
            $data['type'] = '';
        }
        if ($request->type == 'deposit') {
            $items = Transaction::whereStatus(true)->with('coin', 'user')->orderBy('created_at', 'desc')->whereType('Deposit Investment')->get();
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $itemCollection = collect($items);
            $perPage = 20;
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage ) - $perPage, $perPage)->all();
            $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
            $data['histories'] = $paginatedItems->setPath($url_path);
            $data['type'] = 'deposit';
        }
        if ($request->type == 'bonus') {
            $items = Transaction::whereStatus(true)->with('coin', 'user')->orderBy('created_at', 'desc')->whereType('Bonus')->get();
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $itemCollection = collect($items);
            $perPage = 20;
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage ) - $perPage, $perPage)->all();
            $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
            $data['histories'] = $paginatedItems->setPath($url_path);
            $data['type'] = 'bonus';
        }
        if ($request->type == 'earning') {
            $items = Transaction::whereStatus(true)->with('coin', 'user')->orderBy('created_at', 'desc')->whereType('Earning')->get();
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $itemCollection = collect($items);
            $perPage = 20;
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage ) - $perPage, $perPage)->all();
            $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
            $data['histories'] = $paginatedItems->setPath($url_path);
            $data['type'] = 'earning';
        }

        if ($request->type == 'withdrawal') {
            $items = Transaction::whereStatus(true)->with('coin', 'user')->orderBy('created_at', 'desc')->whereType('Withdrawal')->get();
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $itemCollection = collect($items);
            $perPage = 20;
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage ) - $perPage, $perPage)->all();
            $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
            $data['histories'] = $paginatedItems->setPath($url_path);
            $data['type'] = 'withdrawal';
        }

        if ($request->type == 'commissions') {
            $items = Transaction::whereStatus(true)->with('coin', 'user')->orderBy('created_at', 'desc')->whereType('Referral Bonus')->get();
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $itemCollection = collect($items);
            $perPage = 20;
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage ) - $perPage, $perPage)->all();
            $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
            $data['histories'] = $paginatedItems->setPath($url_path);
            $data['type'] = 'commissions';
        }
        if ($request->type == 'bitcoin_address') {
            $coin = Coin::whereSlug('bitcoin_address')->first();
            $items = Transaction::whereStatus(true)->with('coin', 'user')->orderBy('created_at', 'desc')->whereCoin_id($coin->id)->get();
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $itemCollection = collect($items);
            $perPage = 20;
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage ) - $perPage, $perPage)->all();
            $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
            $data['histories'] = $paginatedItems->setPath($url_path);
            $data['type'] = 'bitcoin_address';
        }
        if ($request->type == 'litecoin_address') {
            $coin = Coin::whereSlug('litecoin_address')->first();
            $items = Transaction::whereStatus(true)->with('coin', 'user')->orderBy('created_at', 'desc')->whereCoin_id($coin->id)->get();
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $itemCollection = collect($items);
            $perPage = 20;
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage ) - $perPage, $perPage)->all();
            $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
            $data['histories'] = $paginatedItems->setPath($url_path);
            $data['type'] = 'litecoin_address';
        }
        if ($request->type == 'ethereum_address') {
            $coin = Coin::whereSlug('ethereum_address')->first();
            $items = Transaction::whereStatus(true)->with('coin', 'user')->orderBy('created_at', 'desc')->whereCoin_id($coin->id)->get();
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $itemCollection = collect($items);
            $perPage = 20;
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage ) - $perPage, $perPage)->all();
            $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
            $data['histories'] = $paginatedItems->setPath($url_path);
            $data['type'] = 'ethereum_address';
        }

        if ($request->type == 'bitcoin_cash_address') {
            $coin = Coin::whereSlug('bitcoin_cash_address')->first();
            $items = Transaction::whereStatus(true)->with('coin', 'user')->orderBy('created_at', 'desc')->whereCoin_id($coin->id)->get();
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $itemCollection = collect($items);
            $perPage = 20;
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage ) - $perPage, $perPage)->all();
            $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
            $data['histories'] = $paginatedItems->setPath($url_path);
            $data['type'] = 'bitcoin_cash_address';
        }

        if ($request->type == 'dash_address') {
            $coin = Coin::whereSlug('dash_address')->first();
            $items = Transaction::whereStatus(true)->with('coin', 'user')->orderBy('created_at', 'desc')->whereCoin_id($coin->id)->get();
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $itemCollection = collect($items);
            $perPage = 20;
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage ) - $perPage, $perPage)->all();
            $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
            $data['histories'] = $paginatedItems->setPath($url_path);
            $data['type'] = 'dash_address';
        }

//        if ($request->type == 'filter') {
//            $from = $request->year_from . '-' . $request->month_from . '-' . $request->day_from;
//
//            $to = $request->year_to . '-' . $request->month_to . '-' . $request->day_to;
//             $items = Transaction::whereUser_id(Auth::user()->id)->whereType('Deposit Investment')->whereBetween('created_at', [$from, $to])->orderBy('created_at', 'desc')->get();
//            $currentPage = LengthAwarePaginator::resolveCurrentPage();
//            $itemCollection = collect($items);
//            $perPage = 10;
//            $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
//            $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
//            $data['histories'] = $paginatedItems->setPath($url_path);
//            $data['type'] = 'date';
//        }
//        if ($request->type == 'filterw') {
//            $from = $request->year_from . '-' . $request->month_from . '-' . $request->day_from;
//
//            $to = $request->year_to . '-' . $request->month_to . '-' . $request->day_to;
//            
//            $data['histories'] = Transaction::whereUser_id(Auth::user()->id)->whereBetween('created_at', [$from, $to])->whereType('Withdraw')->orderBy('created_at', 'desc')->paginate(15);
//            $data['type'] = 'date';
//        }
//        if ($request->type == 'filtere') {
//            $from = $request->year_from . '-' . $request->month_from . '-' . $request->day_from;
//
//            $to = $request->year_to . '-' . $request->month_to . '-' . $request->day_to;
//            $data['histories'] = Transaction::whereUser_id(Auth::user()->id)->whereBetween('created_at', [$from, $to])->orderBy('created_at', 'desc')->paginate(15);
//            $data['type'] = 'date';
//        }
//        
        return $data;
    }

    public function mailing() {
        return view('admin.mailing.index');
    }

    public function userRef($id) {
        $data['refs'] = Reference::whereUser_id($id)->orderBy('created_at', 'desc')->with('refs')->get();
        return $data;
    }

    public function mailingPost(Request $request) {
        $input = $request->all();
        $rules = ([
            'emails' => 'required',
            'title' => 'required',
            'message' => 'required'
        ]);
        $error = static::getErrorMessage($input, $rules);
        if ($error) {
            return $error;
        }

        $var = explode(',', $request->emails);
        foreach ($var as $email) {
            $text = nl2br($request->message);
            $this->sendMail($email, $email, $request->title, $text);
        }
        return [
            'status' => 'success',
            'message' => 'Mail Successfully Sent'
        ];
    }

    public function users(Request $request) {
        if ($request->type == null) {
            $url_path = url('users');
        } elseif ($request->q) {
            $url_path = url('users?q=' . $request->q);
        } else {
            $url_path = url('users?type=' . $request->type);
        }

        if ($request->q) {
            $items = User::where(function ($query) use($request) {
                        $query->where('first_name', 'LIKE', '%' . $request->q . '%')
                                ->orWhere('last_name', 'LIKE', '%' . $request->q . '%');
                    })->orderBy('created_at', 'desc')->withCount(['usercoinOneMain as main_balance' => function($query) {
                            $query->select(DB::raw('sum(amount)'));
                        }])->withCount(['usercoinOneProfit as profit_balance' => function($query) {
                            $query->select(DB::raw('sum(amount)'));
                        }])->withCount(['usercoinOneEarn as earn_balance' => function($query) {
                            $query->select(DB::raw('sum(amount)'));
                        }])->withCount(['invest as total_invest' => function($query) {
                            $query->select(DB::raw('sum(amount)'));
                        }])->get();
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $itemCollection = collect($items);
            $perPage = 10;
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage ) - $perPage, $perPage)->all();
            $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
            $data['user_details'] = $paginatedItems->setPath($url_path);

            $data['type'] = '';
        } elseif ($request->type == '') {
            $items = User::orderBy('created_at', 'desc')->withCount(['usercoinOneMain as main_balance' => function($query) {
                            $query->select(DB::raw('sum(amount)'));
                        }])->withCount(['usercoinOneProfit as profit_balance' => function($query) {
                            $query->select(DB::raw('sum(amount)'));
                        }])->withCount(['usercoinOneEarn as earn_balance' => function($query) {
                            $query->select(DB::raw('sum(amount)'));
                        }])->withCount(['invest as total_invest' => function($query) {
                            $query->select(DB::raw('sum(amount)'));
                        }])->get();
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $itemCollection = collect($items);
            $perPage = 10;
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage ) - $perPage, $perPage)->all();
            $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
            $data['user_details'] = $paginatedItems->setPath($url_path);
            $data['type'] = '';
        } elseif ($request->type == 'verified') {
            $items = User::whereCode(true)->orderBy('created_at', 'desc')->withCount(['usercoinOneMain as main_balance' => function($query) {
                            $query->select(DB::raw('sum(amount)'));
                        }])->withCount(['usercoinOneProfit as profit_balance' => function($query) {
                            $query->select(DB::raw('sum(amount)'));
                        }])->withCount(['usercoinOneEarn as earn_balance' => function($query) {
                            $query->select(DB::raw('sum(amount)'));
                        }])->withCount(['invest as total_invest' => function($query) {
                            $query->select(DB::raw('sum(amount)'));
                        }])->get();
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $itemCollection = collect($items);
            $perPage = 10;
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage ) - $perPage, $perPage)->all();
            $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
            $data['user_details'] = $paginatedItems->setPath($url_path);
            $data['type'] = 'verified';
        } elseif ($request->type == 'unverified') {
            $items = User::whereCode(false)->orderBy('created_at', 'desc')->withCount(['usercoinOneMain as main_balance' => function($query) {
                            $query->select(DB::raw('sum(amount)'));
                        }])->withCount(['usercoinOneProfit as profit_balance' => function($query) {
                            $query->select(DB::raw('sum(amount)'));
                        }])->withCount(['usercoinOneEarn as earn_balance' => function($query) {
                            $query->select(DB::raw('sum(amount)'));
                        }])->withCount(['invest as total_invest' => function($query) {
                            $query->select(DB::raw('sum(amount)'));
                        }])->get();
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $itemCollection = collect($items);
            $perPage = 10;
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage ) - $perPage, $perPage)->all();
            $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
            $data['user_details'] = $paginatedItems->setPath($url_path);
            $data['type'] = 'unverified';
        }
        $data['country'] = CountryState::getCountries();
        return $data;
    }

    public function viewUser(Request $request) {
        $id = $request->id;
        $data['user'] = User::find($id);
        $data['usercoin'] = UserCoin::whereUser_id($id)->get();
        $data['country'] = CountryState::getCountries();
        return $data;
    }

    public function userVerify(Request $request) {
        User::whereId($request->id)->update([
            'code' => true
        ]);
    }

    public function login(Request $request) {
        $id = $request->id;
        $user = User::find($id);
        Auth::login($user);
        return [
            'status' => 'success',
            'message' => 'Login Success'
        ];
    }

    public function settingPost(Request $request) {
        $setting = Setting::firstOrNew(array('id' => (1)));
        $setting->site_name = $request->site_name;
        $setting->site_url = $request->site_url;
        $setting->site_email = $request->site_email;
        $setting->send_notify_email = $request->send_notify_email;
        $setting->address = $request->address;
        $setting->site_code = $request->site_code;
        $setting->location = $request->location;
        $setting->copy_right = $request->copy_right;
        $setting->send_notify_email = $request->send_notify_email;
        $setting->send_notify_email = $request->send_notify_email;
        $setting->investment_payment_mode = $request->mode;
        $setting->email_body = $request->email_body;
        $setting->site_phone = $request->site_phone;
        $setting->min_withdraw = $request->min_withdraw;
        $setting->block_io_pin = $request->block_io_pin;
        $setting->auto_withdraw = $request->auto_withdraw;
        $setting->withdraw_charge = $request->withdraw_charge;
        //$setting->chat_script = $request->chat_script;



        $setting->save();
        if (!empty($request->logo)) {
            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $extension = $file->getClientOriginalExtension();
                $rand = 'logo';
                $name = $rand . '.' . $extension;
                $file->move(public_path('/images/logo'), $name);
                $save = 'images/logo/' . $name;
                $setting = Setting::firstOrNew(array('id' => (1)));
                $setting->logo = $save;
                $setting->save();
            }
        }
        if (!empty($request->favicon)) {
            if ($request->hasFile('favicon')) {
                $file = $request->file('favicon');
                $extension = $file->getClientOriginalExtension();
                $rand = 'favicon';
                $name = $rand . '.' . $extension;
                $file->move(public_path('/images/favicon'), $name);
                $save = 'images/favicon/' . $name;
                $setting = Setting::firstOrNew(array('id' => (1)));
                $setting->favicon = $save;
                $setting->save();
            }
        }
        if (!empty($request->video_1)) {
            if ($request->hasFile('video_1')) {
                $file = $request->file('video_1');
                $extension = $file->getClientOriginalExtension();
                $rand = 'video_1';
                $name = $rand . '.' . $extension;
                $file->move(public_path('/images/video_1'), $name);
                $save = 'images/video_1/' . $name;
                $setting = Setting::firstOrNew(array('id' => (1)));
                $setting->video_1 = $save;
                $setting->save();
            }
        }
        if (!empty($request->video_1)) {
            if ($request->hasFile('video_2')) {
                $file = $request->file('video_2');
                $extension = $file->getClientOriginalExtension();
                $rand = 'video_2';
                $name = $rand . '.' . $extension;
                $file->move(public_path('/images/video_2'), $name);
                $save = 'images/video_2/' . $name;
                $setting = Setting::firstOrNew(array('id' => (1)));
                $setting->video_1 = $save;
                $setting->save();
            }
        }
        if (!empty($request->img_login_register)) {
            if ($request->hasFile('img_login_register')) {
                $file = $request->file('img_login_register');
                $extension = $file->getClientOriginalExtension();
                $rand = 'img_login_register';
                $name = $rand . '.' . $extension;
                $file->move(public_path('/images/img_login_register'), $name);
                $save = 'images/img_login_register/' . $name;
                $setting = Setting::firstOrNew(array('id' => (1)));
                $setting->img_login_register = $save;
                $setting->save();
            }
        }
        return [
            'status' => 'success',
            'message' => 'Site Settings Data Successfully Saved'
        ];
    }

    public function create(Request $request) {
        $input = $request->all();
        if (empty($request->bitcoin_address)) {
            $rules = ([
                'first_name' => 'required',
                'last_name' => 'required',
                'country' => 'required',
                'phone_no' => ['required', 'max:15', 'unique:users'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => ['required', 'string', 'min:8']
            ]);
        } else {
            $rules = ([
                'bitcoin_address' => 'regex:/^[13][a-km-zA-HJ-NP-Z1-9]{25,34}$/',
                'first_name' => 'required',
                'last_name' => 'required',
                'country' => 'required',
                'phone_no' => ['required', 'max:15', 'unique:users'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => ['required', 'string', 'min:8'],
                'bitcoin_address' => 'required'
            ]);
        }


        $error = static::getErrorMessage($input, $rules);

        if ($error) {
            return $error;
        }
        $setting = Setting::whereId(1)->first();
        DB::beginTransaction();
        try {
            $rand = strtoupper(Str::random(6));
            $verify_code = mt_rand(2000, 9000);
            $site_url = url('register/?ref=' . $rand);
            $url = Bitly::getUrl($site_url);
            $input['ref_code'] = $url;
            $input['ref_check'] = $rand;
            $input['verified_code'] = $verify_code;
            $input['type'] = $request->type;
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);

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
            //Auth::login($user);
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

    public function edit(Request $request) {

        return $this->toUpdate($request);
    }

    public function toUpdate(Request $request) {

        $input = $request->all();


        $rules = ([
            'first_name' => 'required',
            'last_name' => 'required',
//            'country' => 'required',
//            'phone_no' => ['required'],
//            'email' => ['required', 'string', 'email', 'max:255'],
//            'bitcoin_address' => 'required'
        ]);


        $error = static::getErrorMessage($input, $rules);

        if ($error) {
            return $error;
        }

        $user = User::findOrFail($request->id);
        if (empty($request->password)) {
            $input['password'] = $user->password;
        } else {
            $input['password'] = bcrypt($input['password']);
        }
        $user->update($input);
        return [
            'status' => 'success',
            'message' => 'User  Successfully Updated'
        ];
    }

    public function delete(Request $request) {
        $id = $request->id;
        $array = array($id);
        //deposit
        Investment::whereIn('user_id', $array)->delete();
        Withdraw::whereIn('user_id', $array)->delete();
        UserCoin::whereIn('user_id', $array)->delete();
        Transaction::whereIn('user_id', $array)->delete();
        Transaction::whereIn('user_id', $array)->delete();
        Reference::whereIn('user_id', $array)->delete();
        Reference::whereIn('referred_id', $array)->delete();


        $user = User::find($id);


        if ($user->delete()) {
            return [
                'status' => 'success',
                'message' => 'User deleted successfully'
            ];
        } else {
            return [
                'status' => 'success',
                'message' => 'User Delete failed'
            ];
        }
    }

    public function deposit(Request $request) {
        if ($request->type == null) {
            $url_path = url('manage-deposit');
        } else {
            $url_path = url('manage-deposit?type=' . $request->type);
        }
        if ($request->type == '') {
            $items = Investment::with('coin', 'plan', 'user')->whereNotNull('hash')->orderBy('created_at', 'desc')->get();
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $itemCollection = collect($items);
            $perPage = 10;
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage ) - $perPage, $perPage)->all();
            $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
            $data['deposits'] = $paginatedItems->setPath($url_path);
            $data['type'] = '';
        }
        if ($request->type == 'running') {
            $items = Investment::with('coin', 'plan', 'user')->where('due_pay', '>', Carbon::now())->orderBy('created_at', 'desc')->get();
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $itemCollection = collect($items);
            $perPage = 10;
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage ) - $perPage, $perPage)->all();
            $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
            $data['deposits'] = $paginatedItems->setPath($url_path);
            $data['type'] = 'running';
        }
        if ($request->type == 'completed') {
            $items = Investment::with('coin', 'plan', 'user')->whereStatus(true)->orderBy('created_at', 'desc')->get();
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $itemCollection = collect($items);
            $perPage = 10;
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage ) - $perPage, $perPage)->all();
            $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
            $data['deposits'] = $paginatedItems->setPath($url_path);
            $data['type'] = 'completed';
        }
        if ($request->type == 'confirmed') {
            $items = Investment::with('coin', 'plan', 'user')->whereStatus_deposit(true)->orderBy('created_at', 'desc')->get();
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $itemCollection = collect($items);
            $perPage = 10;
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage ) - $perPage, $perPage)->all();
            $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
            $data['deposits'] = $paginatedItems->setPath($url_path);
            $data['type'] = 'confirmed';
        }
        if ($request->type == 'hash') {
            $items = Investment::with('coin', 'plan', 'user')->whereNull('hash')->orderBy('created_at', 'desc')->get();
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $itemCollection = collect($items);
            $perPage = 10;
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage ) - $perPage, $perPage)->all();
            $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
            $data['deposits'] = $paginatedItems->setPath($url_path);
            $data['type'] = 'hash';
        }
        if ($request->type == 'pending') {
            $items = Investment::with('coin', 'plan', 'user')->whereStatus_deposit(false)->orderBy('created_at', 'desc')->get();
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $itemCollection = collect($items);
            $perPage = 10;
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage ) - $perPage, $perPage)->all();
            $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
            $data['deposits'] = $paginatedItems->setPath($url_path);
            $data['type'] = 'pending';
        }

        return $data;
    }

    public function deleteDeposit(Request $request) {
        $id = $request->id;
        $deposit = Investment::find($id);
        Transaction::whereTransaction_id($deposit->transaction_id)->delete();
        if ($deposit->delete()) {
            return [
                'status' => 'error',
                'message' => 'Deposit deleted successfully'
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Deposit Delete failed'
            ];
        }
    }

    public function confirm(Request $request) {
        DB::beginTransaction();
        try {
            $id = $request->id;
            $payment = Investment::find($id);
            if (empty($payment->hash)) {
                $payment->update([
                    'hash' => md5(uniqid())
                ]);
            }
            $current = Carbon::now();
            $status_deposit = true;
            $due = $current->addHours($payment->plan->compound->compound);
            $due_pay = $due->addMinutes(2);
            $payment->update([
                'status_deposit' => $status_deposit,
                'due_pay' => $due_pay
            ]);
            if ($payment->plan->name == 'Remove') {
                $namep = $payment->amount . ' BTC';
            } else {
                $namep = '$' . $payment->amount;
            }
            $action = $payment->coin->slug;
            if ($action == 'bitcoin_address') {
                $name = 'Bitcoin';
            }
            if ($action == 'litecoin_address') {

                $name = 'Litecoin';
            }
            if ($action == 'ethereum_address') {
                $name = 'Erhereum';
            }
            if ($action == 'bitcoin_cash_address') {
                $name = 'Bitcoin Cash';
            }
            if ($action == 'dash_address') {
                $name = 'dash';
            }

            //check reference for bouns
            $actionb = $payment->coin->slug;
            if ($actionb == 'bitcoin_address') {
                $name = 'Bitcoin';
            }
            if ($actionb == 'litecoin_address') {

                $name = 'Litecoin';
            }
            if ($actionb == 'ethereum_address') {
                $name = 'Ethereum';
            }
            if ($actionb == 'bitcoin_cash_address') {
                $name = 'Bitcoin Cash';
            }
            if ($actionb == 'dash_address') {
                $name = 'Dash';
            }

            $user_ref = Reference::whereReferred_id($payment->user_id)->first();
            if (is_object($user_ref)) {
                //plan ref percentage
                $bonus = $payment->amount * $payment->plan->ref / 100;
                $pay = UserCoin::whereUser_id($user_ref->user_id)->whereCoin_id($payment->coin_id)->first();
                if (is_object($pay)) {
                    $pay->bonus = $pay->bonus + $bonus;
                    $pay->save();
                    //user withdrawal
                    $user_withdraw = new UserWithdrawal();
                    $user_withdraw->amount = $bonus;
                    $user_withdraw->user_id = $user_ref->user_id;
                    $user_withdraw->coin_id = $payment->coin_id;
                    $user_withdraw->type = "Referral Bonus";
                    $user_withdraw->status = true;
                    $user_withdraw->plan_id = $payment->plan_id;
                    $user_withdraw->save();
                    //transcation log
                    Transaction::create([
                        'user_id' => $user_ref->user_id,
                        'transaction_id' => $payment->transaction_id,
                        'type' => 'Referral Bonus',
                        'name_type' => 'Referral Bonus',
                        'coin_id' => $payment->coin_id,
                        'amount' => $bonus,
                        'status' => true,
                        'amount_profit' => $bonus,
                        'description' => 'Referral Bonus Under ' . $payment->plan->name
                    ]);
                    $user_pay = $user_ref->refs->first_name . ' ' . $user_ref->refs->last_name;
                    $text = "You earned a referral bonus  of $$bonus for referring  $user_pay.";


                    $message = $text;

                    $this->sendMail($pay->user->email, $pay->user->first_name, 'Referral Bonus Notification', $message);
                }
            }
            //trans
            Transaction::whereTransaction_id($payment->transaction_id)->update([
                'status' => true
            ]);

            $email = $payment->user->email;
            $subject = 'New Investment Notification';
            $greeting = 'Hello ' . $payment->user->first_name . ' ' . $payment->user->last_name . ',';
            $message = 'You invested ' . '$' . $payment->amount . " using " . $name . "  Under " . $payment->plan->name . ".";

            Notification::route('mail', $email)
                    ->notify(new PlanDepositMail($greeting, $subject, $message));
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        session()->flash('message.level', 'success');
        session()->flash('message.color', 'green');
        session()->flash('message.content', 'Payment Successfully Confirmed');
        return [
            'status' => 'success',
            'message' => 'Payment Successfully Confirmed'
        ];
    }

    public function withdraw(Request $request) {
        if ($request->type == null) {
            $url_path = url('manage-withdraw');
        } else {
            $url_path = url('manage-withdraw?type=' . $request->type);
        }
        if ($request->type == '') {
            $items = Withdraw::with('coin', 'user', 'usercoin')->orderBy('created_at', 'desc')->get();
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $itemCollection = collect($items);
            $perPage = 10;
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage ) - $perPage, $perPage)->all();
            $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
            $data['withdraws'] = $paginatedItems->setPath($url_path);
            $data['type'] = '';
        }
        if ($request->type == 'pending') {
            $items = Withdraw::with('coin', 'user', 'usercoin')->whereStatus(false)->orderBy('created_at', 'desc')->get();
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $itemCollection = collect($items);
            $perPage = 10;
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage ) - $perPage, $perPage)->all();
            $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
            $data['withdraws'] = $paginatedItems->setPath($url_path);
            $data['type'] = 'pending';
        }
        if ($request->type == 'completed') {
            $items = Withdraw::with('coin', 'user', 'usercoin')->whereStatus(true)->orderBy('created_at', 'desc')->get();
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $itemCollection = collect($items);
            $perPage = 10;
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage ) - $perPage, $perPage)->all();
            $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
            $data['withdraws'] = $paginatedItems->setPath($url_path);
            $data['type'] = 'completed';
        }

        return $data;
    }

    public function deleteWithdraw(Request $request) {
        $id = $request->id;

        $withdraw = Withdraw::find($id);
        Transaction::whereTransaction_id($withdraw->transaction_id)->delete();

        if ($withdraw->delete()) {
            return [
                'status' => 'success',
                'message' => 'Withdrew deleted successfully'
            ];
        } else {
            return [
                'status' => 'success',
                'message' => 'Withdrew Delete failed'
            ];
        }
    }

    public function confirmWithdraw(Request $request) {
        $id = $request->id;

        DB::beginTransaction();
        try {
            $withdraw = Withdraw::find($id);
            $withdraw->update([
                'status' => true,
                'status_withdraw' => true
            ]);
            $action = $withdraw->coin->slug;
            if ($action == 'bitcoin_address') {
                $name = 'Bitcoin wallet address';
            }
            if ($action == 'litecoin_address') {

                $name = 'Litecoin wallet address';
            }
            if ($action == 'ethereum_address') {
                $name = 'Ethereum wallet address';
            }
            if ($action == 'bitcoin_cash_address') {
                $name = 'Bitcoin Cash wallet address';
            }
            if ($action == 'dash_address') {
                $name = 'Dash wallet address';
            }
            $amount = $withdraw->amount - $withdraw->withdraw_charge;
            $address = $withdraw->user->usercoinOne->address;

//            $sub = UserCoin::whereUser_id($withdraw->user_id)->whereCoin_id($withdraw->coin_id)->first();
//            if ($withdraw->withdraw_from == 'Balance') {
//                $sub->update([
//                    'amount' => $sub->amount - $withdraw->total_amount
//                ]);
//            }
//            if ($withdraw->withdraw_from == 'Profit Balance') {
//                $sub->update([
//                    'earn' => $sub->earn - $withdraw->total_amount
//                ]);
//            }
//            if ($withdraw->withdraw_from == 'Special Balance') {
//                $sub->update([
//                    'earn_promo' => $sub->earn_promo - $withdraw->total_amount
//                ]);
//            }
//            if ($withdraw->withdraw_from == 'Referral Bonus') {
//                $s = $sub->bonus - $withdraw->total_amount;
//                $sub = UserCoin::whereUser_id($withdraw->user_id)->whereCoin_id($withdraw->coin_id)->update([
//                    'bonus' => $s
//                ]);
//            }
//
//            if ($withdraw->withdraw_from == 'All') {
//                $s = $sub->bonus - $withdraw->total_amount;
//                $sub = UserCoin::whereUser_id($withdraw->user_id)->whereCoin_id($withdraw->coin_id)->update([
//                    'amount' => 0,
//                    'bonus' => 0,
//                    'earn' => 0,
//                    'earn_promo' => 0,
//                ]);
//            }
            $message = 'Your withdrawal of $' . $amount . ' has been successfully sent to your ' . $name . '  ' . $address . '. ';
////set user withdrawal status
            UserWithdrawal::whereId($withdraw->user_withdrawal_id)->update([
                'status' => false
            ]);
//transcation log
            Transaction::whereTransaction_id($withdraw->transaction_id)->update([
                'status' => true,
            ]);
            //send mail
            $greeting = 'Hello' . ' ' . $withdraw->user->first_name;
            $email = $withdraw->user->email;
            $subject = 'Withdrawal Processed';


            Notification::route('mail', $email)
                    ->notify(new SendNotifyMail($greeting, $subject, $message));

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        return [
            'status' => 'success',
            'message' => 'Withdrew successfully Paid'
        ];
    }

    public function rejectWithdraw(Request $request) {
        $id = $request->id;
        DB::beginTransaction();
        try {
            $withdraw = Withdraw::find($id);
            $withdraw->update([
                'status_withdraw' => true
            ]);
            $sub = UserCoin::whereUser_id($withdraw->user_id)->whereCoin_id($withdraw->coin_id)->first();
            if ($withdraw->withdraw_from == 'Balance') {
                $sub->update([
                    'amount' => $sub->amount + $withdraw->amount
                ]);
            }
            if ($withdraw->withdraw_from == 'All') {
                $sub->update([
                    'amount' => $sub->amount + $withdraw->amount
                ]);
            }
            if ($withdraw->withdraw_from == 'Profit') {
                $sub->update([
                    'earn' => $sub->earn + $withdraw->amount
                ]);
            }
            if ($withdraw->withdraw_from == 'Referal Bonus') {
                $sub = UserCoin::whereUser_id($withdraw->user_id)->whereCoin_id($withdraw->coin_id)->update([
                    'bonus' => $sub->bonus + $withdraw->amount
                ]);
            }
            $action = $withdraw->coin->slug;
            if ($action == 'bitcoin_address') {
                $name = 'Bitcoin';
            }
            if ($action == 'litecoin_address') {

                $name = 'Litecoin';
            }
            if ($action == 'ethereum_address') {
                $name = 'Ethereum';
            }
            if ($action == 'bitcoin_cash_address') {
                $name = 'Bitcoin Cash';
            }
            if ($action == 'dash_address') {
                $name = 'Dash';
            }
            $amount = $withdraw->amount - $withdraw->withdraw_charge;
            foreach ($withdraw->user->coin as $ucoin) {
                if ($withdraw->coin_id == $ucoin->coin_id) {

                    $address = $ucoin->address;
                }
            }

            $message = '$' . $amount . " has been Rejected back to your  " . $name . ' ' . $withdraw->withdraw_from . " account " . $address . '.' . " Transaction ID Is : #$withdraw->transaction_id";

//transcation log
            Transaction::create([
                'user_id' => $withdraw->user_id,
                'transaction_id' => $withdraw->transaction_id,
                'type' => 'Withdraw',
                'name_type' => 'Refund Back',
                'withdraw_charge' => $withdraw->withdraw_charge,
                'coin_id' => $withdraw->coin_id,
                'amount' => $withdraw->amount - $withdraw->withdraw_charge,
                'description' => $message
            ]);
            //send mail
            $greeting = 'Hello' . ' ' . $withdraw->user->full_name;
            $email = $withdraw->user->email;
            $subject = 'Withdrawal has been Rejected';

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        Notification::route('mail', $email)
                ->notify(new SendNotifyMail($subject, $greeting, $message));
        session()->flash('message.level', 'success');
        session()->flash('message.color', 'green');
        session()->flash('message.content', 'Withdraw successfully Rejected');
        return redirect()->back();
    }

    public function planSetting() {
        $data['compounds'] = Compound::all();
        $data['plans'] = Plan::orderBy('created_at', 'desc')->with('compound')->get();
        return $data;
    }

    public function addPlan(Request $request) {
        $input = $request->all();
        $rules = ([
            'name' => 'required|unique:plans',
            'ref' => 'required',
            'percentage' => 'required',
            'min' => 'required',
            'max' => 'required',
            'deposit_fee' => 'required',
            'compound_id' => 'required'
        ]);
        $error = static::getErrorMessage($input, $rules);
        if ($error) {
            return $error;
        }
        if (!empty($request->photo)) {
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $extension = $file->getClientOriginalExtension();
                $rand = 'photo' . $request->name;
                $name = $rand . '.' . $extension;
                $file->move(public_path('/images/plan'), $name);
                $save = 'images/plan/' . $name;
                $input['image'] = $save;
            }
        }
        Plan::create($input);
        return [
            'status' => 'success',
            'message' => 'Plan successfully Created'
        ];
    }

    public function deletePlan(Request $request) {
        $id = $request->id;
        $array = array($id);
        //deposit
        Investment::whereIn('plan_id', $array)->delete();
        $plan = Plan::find($id);
        if ($plan->delete()) {
            return [
                'status' => 'success',
                'message' => 'Plan deleted successfully'
            ];
        } else {
            return [
                'status' => 'success',
                'message' => 'Plan Delete failed'
            ];
        }
    }

    public function editPlan(Request $request) {
        $input = $request->all();
        $id = $request->id;
        $plan = Plan::find($id);
        $rules = ([
            'name' => 'required',
            'ref' => 'required',
            'percentage' => 'required',
            'min' => 'required',
            'max' => 'required',
            'compound_id' => 'required'
        ]);
        $error = static::getErrorMessage($input, $rules);
        if ($error) {
            return $error;
        }
        if (!empty($request->photo)) {
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $extension = $file->getClientOriginalExtension();
                $rand = 'photo' . $request->name;
                $name = $rand . '.' . $extension;
                $file->move(public_path('/images/plan'), $name);
                $save = 'images/plan/' . $name;
                $input['image'] = $save;
            }
        }
        $plan->update($input);
        return [
            'status' => 'success',
            'message' => 'Plan successfully Updated'
        ];
    }

    public function compoundSetting() {
        $data['compounds'] = Compound::orderBy('created_at', 'desc')->get();
        return $data;
    }

    public function addCompound(Request $request) {
        $input = $request->all();
        $rules = ([
            'name' => 'required|unique:compounds',
            'compound' => 'required|unique:compounds',
            'compound_turn_over' => 'required'
        ]);
        $error = static::getErrorMessage($input, $rules);
        if ($error) {
            return $error;
        }
        Compound::create($input);
        return [
            'status' => 'success',
            'message' => 'Compound successfully Created'
        ];
    }

    public function deleteCompound(Request $request) {
        $id = $request->id;
        $compound = Compound::find($id);
        if ($compound->delete()) {
            return [
                'status' => 'success',
                'message' => 'Compound deleted successfully'
            ];
        } else {
            return [
                'status' => 'success',
                'message' => 'Compound Delete failed'
            ];
        }
    }

    public function editCompound(Request $request) {
        $input = $request->all();
        $id = $request->id;
        $compound = Compound::find($id);
        $rules = ([
            'name' => 'required',
            'compound' => 'required',
            'compound_turn_over' => 'required'
        ]);
        $error = static::getErrorMessage($input, $rules);
        if ($error) {
            return $error;
        }
        $compound->update($input);
        return [
            'status' => 'success',
            'message' => 'Compound successfully Updated'
        ];
    }

    public function coinSetting() {
        $data['coins'] = Coin::orderBy('created_at', 'desc')->paginate(20);
        return $data;
    }

    public function addCoin(Request $request) {
        $input = $request->all();
        $rules = ([
            'name' => 'required|unique:coins',
            'address' => 'required|unique:coins'
        ]);
        $error = static::getErrorMessage($input, $rules);
        if ($error) {
            return $error;
        }
        $input['slug'] = str_slug($request->name, '_address');

        if (!empty($request->photo)) {
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $extension = $file->getClientOriginalExtension();
                $rand = $input['slug'];
                $name = $rand . '.' . $extension;
                $file->move(public_path('/coins'), $name);
                $save = 'coins/' . $name;
                $input['photo'] = $save;
            }
        }



        Coin::create($input);
        return [
            'status' => 'success',
            'message' => 'Coin successfully Created'
        ];
    }

    public function deleteCoin(Request $request) {
        $id = $request->id;
        $coin = Coin::find($id);
        if ($coin->delete()) {
            return [
                'status' => 'success',
                'message' => 'Coin deleted successfully'
            ];
        } else {
            return [
                'status' => 'success',
                'message' => 'Coin Delete failed'
            ];
        }
    }

    public function editCoin(Request $request) {
        $input = $request->all();
        $id = $request->id;
        $coin = Coin::find($id);
        $rules = ([
            'address' => 'required'
        ]);
        $error = static::getErrorMessage($input, $rules);
        if ($error) {
            return $error;
        }
        $input['slug'] = str_slug($request->name . ' address', '_');

        if (!empty($request->photo)) {
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $extension = $file->getClientOriginalExtension();
                $rand = $input['slug'];
                $name = $rand . '.' . $extension;
                $file->move(public_path('/coins'), $name);
                $save = 'coins/' . $name;
                $input['photo'] = $save;
            }
        }
        $coin->update($input);
        return [
            'status' => 'success',
            'message' => 'Coin successfully Updated'
        ];
    }

    public function fund(Request $request) {
        $input = $request->all();
        $rules = ([
            'type' => 'required',
            'coin' => 'required',
            'amount' => 'required'
        ]);
        $error = static::getErrorMessage($input, $rules);
        if ($error) {
            return $error;
        }
        DB::beginTransaction();
        try {
            $amount = $request->amount;
            if ($request->type == 'bonus') {
                $type_name = 'Bonus';
            }
            if ($request->type == 'add') {
                $type_name = 'Added';
            }
            if ($request->type == 'substract') {
                $type_name = 'Substracted';
            }

            if ($request->coin == 'all') {

                $usercoin = UserCoin::whereUser_id($request->user_id)->get();
                foreach ($usercoin as $ucoin) {
                    $action = $ucoin->coin->slug;
                    if ($action == 'bitcoin_address') {
                        $name = 'Bitcoin';
                    }
                    if ($action == 'litecoin_address') {

                        $name = 'Litecoin';
                    }
                    if ($action == 'ethereum_address') {
                        $name = 'Ethereum';
                    }
                    if ($action == 'bitcoin_cash_address') {
                        $name = 'Bitcoin Cash';
                    }
                    if ($action == 'dash_address') {
                        $name = 'Dash';
                    }


                    $message = '$' . $amount . " has been  " . $type_name . ' to your ' . $name . ' ' . " account " . $ucoin->address;
                    if ($request->type == 'bonus' || $request->type == 'add') {
                        $ucoin->update([
                            'amount' => $ucoin->amount + $request->amount
                        ]);
                        //transcation log
                        Transaction::create([
                            'user_id' => $request->user_id,
                            'transaction_id' => strtoupper(Str::random(20)),
                            'type' => 'Bonus',
                            'name_type' => $type_name,
                            'withdraw_charge' => 0,
                            'coin_id' => $ucoin->coin_id,
                            'amount' => $request->amount,
                            'description' => $message
                        ]);
//                        //send mail
//                        $greeting = 'Hello' . ' ' . $ucoin->user->full_name;
//                        $email = $ucoin->user->email;
//                        $subject = 'Fund Added';
//
//
//                        Notification::route('mail', $email)
//                                ->notify(new SendNotifyMail($subject, $greeting, $message));
                    }

                    if ($request->type == 'substract') {
                        $ucoin->update([
                            'amount' => $ucoin->amount - $request->amount
                        ]);
                    }
                }
            } else {
                $usercoin = UserCoin::whereUser_id($request->user_id)->whereCoin_id($request->coin)->first();
                $action = $usercoin->coin->slug;
                if ($action == 'bitcoin_address') {
                    $name = 'Bitcoin';
                }
                if ($action == 'litecoin_address') {

                    $name = 'Litecoin';
                }
                if ($action == 'ethereum_address') {
                    $name = 'Ethereum';
                }
                if ($action == 'bitcoin_cash_address') {
                    $name = 'Bitcoin Cash';
                }
                if ($action == 'dash_address') {
                    $name = 'Dash';
                }

                $message = '$' . $amount . " has been  " . $type_name . ' to your ' . $name . ' ' . " account " . $usercoin->address;
                if ($request->type == 'bonus' || $request->type == 'add') {
                    $usercoin->update([
                        'amount' => $usercoin->amount + $request->amount
                    ]);
                    //transcation log
                    Transaction::create([
                        'user_id' => $request->user_id,
                        'transaction_id' => strtoupper(Str::random(20)),
                        'type' => 'Bonus',
                        'name_type' => $type_name,
                        'withdraw_charge' => 0,
                        'coin_id' => $usercoin->coin_id,
                        'amount' => $request->amount,
                        'description' => $message
                    ]);
                    //send mail
                    $greeting = 'Hello' . ' ' . $usercoin->user->full_name;
                    $email = $usercoin->user->email;
                    $subject = 'Fund Added';


                    Notification::route('mail', $email)
                            ->notify(new SendNotifyMail($subject, $greeting, $message));
                }

                if ($request->type == 'substract') {
                    $usercoin->update([
                        'amount' => $usercoin->amount - $request->amount
                    ]);
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        return [
            'status' => 'success',
            'message' => 'Fund successfully Proccessed'
        ];
    }

    public function compounding() {
        $data['users'] = User::orderBy('created_at', 'desc')->get();
        $data['compounds'] = Compound::all();
        return view('admin.compounding', $data);
    }

    public function postCompounding(Request $request) {
        $input = $request->all();


        $rules = [
            'user' => 'required',
            'compound' => 'required'
        ];
        $error = static::getErrorMessage($input, $rules);
        if ($error) {
            return $error;
        }

        $user = UserCoin::whereUser_id($request->user)->first();
        $txt = strtoupper(Str::random(20));
        $current = Carbon::now();
        $com = Compound::whereId($request->compound)->first();
        $due = $current->addHours($com->compound);
        $due_pay = $due->addMinutes(2);
        $invest = UserCompounding::create([
                    'transaction_id' => $txt,
                    'user_id' => $user->user_id,
                    'coin_id' => $user->coin_id,
                    'amount' => $user->amount,
                    'compound_id' => $com->id,
                    'run_count' => 0,
                    'due_pay' => $due_pay,
                    'status' => 0
        ]);
        Transaction::create([
            'user_id' => $user->user_id,
            'transaction_id' => $invest->transaction_id,
            'type' => 'Compouding Investment',
            'name_type' => 'Compounding',
            'coin_id' => $user->coin_id,
            'amount' => $user->amount,
            'amount_profit' => $user->amount,
            'description' => 'Compounding'
        ]);
        session()->flash('message.level', 'success');
        session()->flash('message.color', 'green');
        session()->flash('message.content', 'Compounding successfully set for user ' . $user->user->username);
        return redirect()->back();
    }

    public function homepage() {
        $data['homepages'] = HomePageText::whereId(1)->first();
        return $data;
    }

    public function homepagePost(Request $request) {
        $homepage = HomePageText::firstOrNew(array('id' => (1)));
        $homepage->title = $request->title;
        $homepage->description = $request->description;
        $homepage->video_text = $request->video_text;
        $homepage->get_start_text = $request->get_start_text;
        $homepage->why_us_text = $request->why_us_text;
        $homepage->benefit_text = $request->benefit_text;
        $homepage->get_beneift_text = $request->get_beneift_text;

        $homepage->save();
        if (!empty($request->photo)) {
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $extension = $file->getClientOriginalExtension();
                $rand = 'photo';
                $name = $rand . '.' . $extension;
                $file->move(public_path('/images/homepage/photo'), $name);
                $save = 'images/homepage/photo/' . $name;
                $homepage = HomePageText::firstOrNew(array('id' => (1)));
                $homepage->photo = $save;
                $homepage->save();
            }
        }
        if (!empty($request->about_us_photo)) {
            if ($request->hasFile('about_us_photo')) {
                $file = $request->file('about_us_photo');
                $extension = $file->getClientOriginalExtension();
                $rand = 'about_us_photo';
                $name = $rand . '.' . $extension;
                $file->move(public_path('/images/homepage/about_us_photo'), $name);
                $save = 'images/homepage/about_us_photo/' . $name;
                $homepage = HomePageText::firstOrNew(array('id' => (1)));
                $homepage->about_us_photo = $save;
                $homepage->save();
            }
        }

        if (!empty($request->get_start_text_image)) {
            if ($request->hasFile('get_start_text_image')) {
                $file = $request->file('get_start_text_image');
                $extension = $file->getClientOriginalExtension();
                $rand = 'get_start_text_image';
                $name = $rand . '.' . $extension;
                $file->move(public_path('/images/homepage/get_start_text_image'), $name);
                $save = 'images/homepage/get_start_text_image/' . $name;
                $homepage = HomePageText::firstOrNew(array('id' => (1)));
                $homepage->get_start_text_image = $save;
                $homepage->save();
            }
        }
        if (!empty($request->why_us_text_image)) {
            if ($request->hasFile('why_us_text_image')) {
                $file = $request->file('why_us_text_image');
                $extension = $file->getClientOriginalExtension();
                $rand = 'why_us_text_image';
                $name = $rand . '.' . $extension;
                $file->move(public_path('/images/homepage/why_us_text_image'), $name);
                $save = 'images/homepage/why_us_text_image/' . $name;
                $homepage = HomePageText::firstOrNew(array('id' => (1)));
                $homepage->why_us_text_image = $save;
                $homepage->save();
            }
        }
        return [
            'status' => 'success',
            'message' => 'Homepage Data Successfully Saved'
        ];
    }

    public function blackList() {
        User::whereId(Auth::user()->id)->update([
            'can_withdraw' => true
        ]);
        return [
            'status' => 'success',
            'message' => 'User Withdrawal Blacklisted'
        ];
    }

    public function UnBlackList() {
        User::whereId(Auth::user()->id)->update([
            'can_withdraw' => false
        ]);
        return [
            'status' => 'success',
            'message' => 'User Withdrawal UnBlacklisted'
        ];
    }

    public function usersMail() {
        $data['user_details'] = User::orderBy('created_at', 'desc')->get();
        return $data;
    }

    public function payout(Request $request) {
        $users = $request->users;
        foreach ($users as $user) {
            $check_user = User::find($user);
            if (is_object($check_user)) {

                $withdraw = new Withdraw();
                $withdraw->transaction_id = strtoupper(Str::random(20));
                $withdraw->user_id = $user;
                $withdraw->coin_id = $check_user->usercoinOne->coin_id;
                $withdraw->user_withdrawal_id = null;
                $withdraw->usercoin_id = $check_user->usercoinOne->coin_id;
                $withdraw->withdraw_from = $request->type;
                $withdraw->description = 'You Widthrew  ' . '$' . $request->amount;
                $withdraw->amount = $request->amount;
                $withdraw->total_amount = $request->amount;
                $withdraw->withdraw_charge = 0;
                $withdraw->message = null;
                $withdraw->amount_check = $request->amount;
                $withdraw->confirm = true;
                $withdraw->status = true;
                $withdraw->created_at = Carbon::parse($request->date);
                $withdraw->save();
                Transaction::create([
                    'user_id' => $user,
                    'transaction_id' => $withdraw->transaction_id,
                    'type' => 'Withdrawal',
                    'name_type' => 'Withdrawal',
                    'withdraw_charge' => 0,
                    'coin_id' => $check_user->usercoinOne->coin_id,
                    'amount' => $withdraw->amount,
                    'description' => 'You Widthrew  ' . '$' . $withdraw->amount,
                    'status' => true,
                    'created_at' => Carbon::parse($request->date)
                ]);
            }
        }
        return [
            'status' => 'success',
            'message' => 'Payout done'
        ];
    }

}
