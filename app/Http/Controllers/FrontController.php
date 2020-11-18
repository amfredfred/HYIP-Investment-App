<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Http\Controllers\Traits\HasError;
use App\Models\Admin\Setting;
use App\ContactUs;
use Illuminate\Support\Facades\Notification;
use App\Mail\ContactUsMail;
use App\Mail\SubscriberMail;
use App\EmailSubscriber;
use App\Page;
use App\Benefit;
use App\GetStarted;
use App\Faq;
use App\Plan;
use Illuminate\Support\Facades\Cookie;

class FrontController extends Controller {

    use HasError;

    public function index() {
//        $data['deposits'] = Investment::whereStatus_deposit(1)->orderBy('created_at', 'desc')->take(10)->get();
//        $data['withdraws'] = Withdraw::whereStatus(1)->orderBy('created_at', 'desc')->take(10)->get();
//        $data['plans'] = Plan::all();
//        $data['users_count'] = User::count();
//        $data['total_deposit'] = Investment::whereStatus_deposit(1)->sum('amount');
//        $data['total_withdraw'] = Withdraw::whereStatus(1)->sum('amount');

        $data['about'] = Page::whereSlug('about-us')->first();
        $data['benefits'] = Benefit::orderBy('created_at', 'desc')->get();
        $data['get_started'] = GetStarted::orderBy('created_at', 'desc')->get();

        return view('welcome', $data);
    }

    public function contact(Request $request) {
        $input = $request->all();
        $rules = ([
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'message' => ['required', 'string']
        ]);
        $error = static::getErrorMessage($input, $rules);
        if ($error) {
            return $error;
        }

        $input['name'] = $request->name;
        $input['email'] = $request->email;
        $setting = Setting::whereId(1)->first();
        ContactUs::create($input);
        $subject = 'Contact Us Notification';
        $name = $request->name;
        $email = $request->email;
        $message = $request->message;
        Notification::route('mail', $setting['send_notify_email'])
                ->notify(new ContactUsMail($subject, $name, $email, $message));
        return [
            'status' => 200,
            'message' => 'Message Sent, We will get back to You',
        ];
    }

    public function sub(Request $request) {
        $input = $request->all();
        $rules = ([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:email_subscribers']
        ]);
        $error = static::getErrorMessage($input, $rules);
        if ($error) {
            return $error;
        }
        EmailSubscriber::create($input);
        $subject = 'Subscription for Newsletter for Dailly Offer was Successfull';
        $message = "You can now keep receiving new offer Bonus directly to your email.";
        Notification::route('mail', $request->email)
                ->notify(new SubscriberMail($subject, $message));
        return [
            'status' => 200,
            'message' => 'Subscription for Newsletter for Dailly Offer was Successfull',
        ];
    }

    public function plan() {
        $data['plans'] = Plan::all();
        return view('pages.plan', $data);
    }

    public function getPlan(Request $request) {
        $min = Plan::whereId($request->plan_id)->first();
        if ($min->name == 'PLAN 6') {
            $data['min'] = $min->min;
            $data['sign'] = 'BTC';
            $data['profit'] = $min->min * $min->percentage / 100;
        } else {
            $data['min'] = number_format($min->min, 2);
            $data['sign'] = '$';
            $data['profit'] = '$' . $min->min * $min->percentage / 100;
        }
        $data['amount'] = $min->min;
        $data['percentage'] = $min->percentage . '%';
        $data['p_id'] = $min->id;
        return $data;
    }

    public function getCoin(Request $request) {

        $plan = Plan::whereId($request->plan_id)->first();

        if ($request->amount < $plan->min) {
            $data['message_danger'] = 'You amount is less than the minimum price  ';
            $data['status'] = 401;
        }
        if ($request->amount > $plan->max) {
            $data['message_danger'] = 'You amount is greater than the Max price  ';
            $data['status'] = 401;
        }
        $net_profit = $request->amount * $plan->percentage / 100;
        $return = $request->amount + $net_profit;
        $data['net_profit'] = '$' . $net_profit;
        $data['return'] = '$' . $return;
        return $data;
    }

    public function faq() {
        $data['faqs'] = Faq::whereStatus(true)->orderBy('created_at', 'asc')->get();
        return view('pages.faq', $data);
    }

    public function theme(Request $request) {
        $action = $request->theme;
        $minutes = 3600 * 24 * 356;
        switch ($action) {
            case 'white':
                Cookie::queue(Cookie::forget('dark'));
                return redirect('/dashboard');
                break;
            case 'dark':
                Cookie::queue(Cookie::forget('white'));
                Cookie::queue(Cookie::make('dark', $action, $minutes));
                return redirect('/dashboard');
                break;
        }
    }

    public function certificate() {
        $file = public_path('files/Certificate Of Incorporation For Maven Investment.pdf');
        return response()->file($file);
    }

    public function cofirmation() {
        $file = public_path('files/Confirmation Statement For Maven Investment.pdf');
         return response()->file($file);
    }

    public function full() {
        $file = public_path('files/Full Accounts For Maven Investment.pdf');
         return response()->file($file);
    }

}
