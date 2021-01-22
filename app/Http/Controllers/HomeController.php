<?php

namespace App\Http\Controllers;

use App\UserCoin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Investment;
use App\Withdraw;
use App\Plan;
use App\Coin;
use \App\Http\Controllers\Traits\HasError;
use App\Transaction;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Mail\PlanDepositMail;
use App\Models\Admin\Setting;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;
use App\Reference;
use App\User;
use App\TraitsFolder\MailTrait;
use App\Mail\SendNotifyMail;
Use BlockIo;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\ErrorCorrectionLevel;
use CountryState;
use App\Library\IPTranslate\GeoPluginApi;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Session;
use App\UserWithdrawal;

class HomeController extends Controller {

    use HasError,
        MailTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('register_verify');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function indexData() {
        $data['user_detail'] = User::whereId(Auth::user()->id)->first();

        $data['total_deposit'] = number_format(Investment::whereNotNull('hash')->whereUser_id(Auth::user()->id)->whereStatus_deposit(1)->sum('amount'), 2);
        $data['active_deposit'] = number_format(Investment::whereNotNull('hash')->whereUser_id(Auth::user()->id)->whereStatus_deposit(1)->whereStatus(0)->sum('amount'), 2);
        $data['last_deposit'] = number_format(Investment::whereUser_id(Auth::user()->id)->orderBy('created_at', 'desc')->take(1)->pluck('amount')->first(), 2);
        $data['total_withdraw'] = number_format(Withdraw::whereUser_id(Auth::user()->id)->whereStatus(1)->sum('amount'), 2);
        $data['pending_withdraw'] = number_format(Withdraw::whereUser_id(Auth::user()->id)->whereStatus(0)->sum('amount'), 2);
        $data['last_withdraw'] = number_format(Withdraw::whereUser_id(Auth::user()->id)->orderBy('created_at', 'desc')->whereStatus(true)->take(1)->pluck('amount')->first(), 2);
        $data['earned'] = number_format(UserWithdrawal::whereUser_id(Auth::user()->id)->whereType('Profit')->whereStatus(true)->sum('amount'), 2);
        $data['ref_balance'] = number_format(UserWithdrawal::whereUser_id(Auth::user()->id)->whereType('Referral Bonus')->whereStatus(true)->sum('amount'), 2);
        $main = UserWithdrawal::whereUser_id(Auth::user()->id)->whereStatus(true)->sum('amount');
        $data['total_balance'] = number_format($main, 2);
        $check_for = Investment::whereUser_id(Auth::user()->id)->whereStatus_deposit(1)->whereStatus(0)->with('plan')->orderBy('created_at', 'desc')->first();
        if (is_object($check_for)) {
            $data['invest'] = $check_for;
        } else {
            $data['invest'] = false;
        }
        $data['transaction'] = Transaction::whereUser_id(Auth::user()->id)->whereStatus(true)->orderBy('created_at', 'desc')->take(5)->get();
        $data['investment'] = Investment::whereNotNull('hash')->whereUser_id(Auth::user()->id)->whereStatus_deposit(1)->whereStatus(0)->orderBy('created_at', 'desc')->take(5)->get();
//admin
        $data['total_money'] = number_format(UserWithdrawal::whereStatus(true)->sum('amount'), 2);
        $data['users'] = number_format(User::count());
        $data['all_deposits'] = number_format(Investment::whereStatus_deposit(1)->count());
        $data['all_withdraws'] = number_format(Withdraw::whereStatus(true)->count(), 2);
        $data['plans'] = number_format(Plan::count());
        $data['active_investment'] = number_format(Investment::where('due_pay', '>', Carbon::now())->count());
        $data['completed_investment'] = number_format(Investment::whereStatus(true)->count());
        $data['pending_investment'] = number_format(Investment::whereStatus_deposit(false)->count());
        $data['confirm_investment'] = number_format(Investment::whereStatus_deposit(true)->count());
        $data['withdraws_pending'] = number_format(Withdraw::whereStatus(false)->count());
        $data['withdraws_complete'] = number_format(Withdraw::whereStatus(true)->count());
        $data['name_ref'] = Reference::whereReferred_id(Auth::user()->id)->first();
        $data['my_invests'] = Investment::whereUser_id(Auth::user()->id)->whereStatus_deposit(1)->orderBy('created_at', 'desc')->take(3)->get();
        $data['admin_transaction'] = Transaction::orderBy('created_at', 'desc')->whereStatus(true)->with('user')->take(5)->get();
        $data['admin_investment'] = Investment::whereNotNull('hash')->whereStatus(true)->whereStatus_deposit(1)->whereStatus(0)->with('user')->orderBy('created_at', 'desc')->take(5)->get();

        return $data;
    }

    public function index() {

        return view('home');
    }

    public function deposit() {
        $data['total_balance'] = UserWithdrawal::whereUser_id(Auth::user()->id)->whereStatus(true)->sum('amount');
        $data['earned'] = UserWithdrawal::whereUser_id(Auth::user()->id)->whereStatus(true)->whereType('Profit')->sum('amount');
        $data['coins'] = Coin::whereStatus(true)->get();
        $data['plan'] = Plan::with('compound')->get();
        $data['investment'] = Investment::whereNotNull('hash')->whereUser_id(Auth::user()->id)->with('coin', 'plan')->orderBy('created_at', 'desc')->paginate(10);
        return $data;
    }

    public function success() {
        return view('user.success');
    }

    public function getPlan(Request $request) {
        $min = Plan::whereId($request->plan_id)->first();
        if ($min->name == 'Remove') {
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
        $coin = Coin::whereId($request->coin_id)->first();
        $usercoin = UserCoin::whereUser_id(Auth::user()->id)->whereCoin_id($coin->id)->first();
        if (is_object($usercoin)) {


            $data['usermoney'] = '$' . $usercoin->amount;
            $plan = Plan::whereId($request->plan_id)->first();
            if ($plan->name == 'Remove') {
                $all = file_get_contents("https://blockchain.info/ticker");
                $res = json_decode($all);
                $btcrate = $res->USD->last;
                $pp = $plan->min * $btcrate;
                if ($usercoin->amount < $pp) {
                    $data['message_danger'] = 'You are not Eligble to Spend , Please Click Spend to Deposit  ';
                    $data['status'] = 401;
                } else {
                    $data['message_success'] = 'You are Eligble to Spend Fund from this Address , Please Click Spend to Invest';
                    $data['status'] = 200;
                }
            } else {
                if ($usercoin->amount < $plan->min) {
                    $data['message_danger'] = 'You are not Eligble to Spend , Please Click Spend to Deposit  ';
                    $data['status'] = 401;
                } else {
                    $data['message_success'] = 'You are Eligble to Spend Fund from this Address , Please Click Spend to Invest';
                    $data['status'] = 200;
                }
            }
        } else {
            $data['message_danger'] = 'You Need to Add this Coin, Go to your Account Setting to add it ';
            $data['status'] = 401;
        }

        return $data;
    }

    public function createDeposit(Request $request) {
//         $check = Investment::whereUser_id(Auth::user()->id)->orderBy('created_at', 'desc')->whereNull('hash')->first();
//        if (is_object($check)) {
//            return [
//                'status' => 'error',
//                'message' => 'You have a pending Deposit'
//            ];
//        }
        $input = $request->all();
        $rules = [
            'plan_id' => 'required',
            'amount' => 'required'
        ];
        $error = static::getErrorMessage($input, $rules);
        if ($error) {
            return $error;
        }
//check plan
        $plan = Plan::whereId($request->plan_id)->first();
        $setting = Setting::whereId(1)->first();
// $charge = $plan->deposit_fee;

        $amount_pay = $request->amount;
        DB::beginTransaction();
        try {
            $coin = Coin::whereId($request->coin_id)->first();
            if (!is_object($coin)) {
                return [
                    'status' => 'error',
                    'message' => 'Invalid Payment Method'
                ];
            }
            $checkuser = UserCoin::whereUser_id(Auth::user()->id)->whereCoin_id($request->coin_id)->first();
            if (!is_object($checkuser)) {
                return [
                    'status' => 'error',
                    'message' => 'You Need to Add this Coin,Go to your Account Setting to add it'
                ];
            }
//btc
            try {
                $all = file_get_contents("https://blockchain.info/ticker");
                $res = json_decode($all);
                $btcrate = $res->USD->last;
            } catch (\Exception $e) {
                return [
                    'status' => 'error',
                    'message' => 'Bitcoin Server Very Busy , Try Again'
                ];
            }

            $action = $coin->slug;

            if ($request->amount < $plan->min) {
                return [
                    'status' => 'error',
                    'message' => 'Amount is less than the minimum amount for this plan'
                ];
            }

            if ($request->amount > $plan->max) {
                return [
                    'status' => 'error',
                    'message' => 'Amount is greater than the maxmium amount for this plan'
                ];
            }
            $useramount = $checkuser->amount;



            if ($useramount < $amount_pay) {
                $data['fund'] = 'fund';
            } else {
                $data['fund'] = 'fund';
            }

//substract
            if ($data['fund'] == 'invest') {

                $sub = UserCoin::whereUser_id(Auth::user()->id)->whereCoin_id($request->coin_id)->first();
                $amountd = $request->amount;
                $sub->update([
                    'amount' => $sub->amount - $amountd
                ]);
                $current = Carbon::now();
                $status_deposit = true;
                $due = $current->addHours($plan->compound->compound);
                $due_pay = $due->addMinutes(2);
                $txt = strtoupper(Str::random(20));
            } else {
                $status_deposit = false;
                $due_pay = null;
                $txt = strtoupper(Str::random(20));
            }
            if ($request->transaction_id) {
//know plan name
//create investment

                $invest = Investment::whereTransaction_id($request->transaction_id)->first();
                $invest->update([
                    'transaction_id' => $request->transaction_id,
                    'user_id' => Auth::user()->id,
                    'plan_id' => $request->plan_id,
                    'coin_id' => $request->coin_id,
                    'amount' => $request->amount,
                    // 'deposit_investment_charge' => $charge,
                    'run_count' => 0,
                    'earn' => 0,
                    'due_pay' => $due_pay,
                    'status_deposit' => $status_deposit,
                    'settled_status' => 0,
                    'status' => 0
                ]);
            } else {
//create investment

                $invest = Investment::create([
                            'transaction_id' => $txt,
                            'user_id' => Auth::user()->id,
                            'plan_id' => $request->plan_id,
                            'coin_id' => $request->coin_id,
                            'amount' => $request->amount,
                            //'deposit_investment_charge' => $charge,
                            'run_count' => 0,
                            'earn' => 0,
                            'due_pay' => $due_pay,
                            'status_deposit' => $status_deposit,
                            'settled_status' => 0,
                            'status' => 0
                ]);
            }

            $profit = $invest->amount * $plan->percentage / 100;
//transcation log
            Transaction::create([
                'user_id' => Auth::user()->id,
                'transaction_id' => $invest->transaction_id,
                'type' => 'Deposit Investment',
                'name_type' => 'Deposit',
                //'deposit_investment_charge' => $charge,
                'coin_id' => $request->coin_id,
                'amount' => $invest->amount,
                'amount_profit' => $profit,
                'description' => 'You Deposited Under  ' . $plan->name
            ]);

//amount in btc or lite or btc cash
            if ($action == 'bitcoin_address') {
                $data['amount_convert'] = $amount_pay / $btcrate;
                $data['name'] = 'BTC';
                $data['name_full'] = 'bitcoin';
            }
            $general_coin = file_get_contents('https://api.coincap.io/v2/assets');
            if ($action == 'litecoin_address') {
                try {
                    $lit = $general_coin;
                    $litecoin = json_decode($lit);
                    $litecoin_final = $litecoin->data[7]->priceUsd;
                    $data['amount_convert'] = $amount_pay / $litecoin_final;
                    $data['name'] = 'LTE';
                    $data['name_full'] = 'litecoin';
                } catch (\Exception $e) {
                    return [
                        'status' => 'error',
                        'message' => 'Litecoin Server Very Busy , Try Again'
                    ];
                }
            }
            if ($action == 'ethereum_address') {

                try {
                    $eth = $general_coin;
                    $ethereum = json_decode($eth);
                    $ethereum_final = $ethereum->data[1]->priceUsd;
                    $data['amount_convert'] = $amount_pay / $ethereum_final;
                    $data['name'] = 'ETH';
                    $data['name_full'] = 'ethereum';
                } catch (\Exception $e) {

                    return [
                        'status' => 'error',
                        'message' => 'Ethereum Server Very Busy , Try Again'
                    ];
                }
            }
            if ($action == 'bitcoin_cash_address') {
//bitcoin cash
                try {
                    $btic_cash = $general_coin;
                    $dash = json_decode($btic_cash);
                    $cash_final = $dash->data[4]->priceUsd;
                    $data['amount_convert'] = $amount_pay / $cash_final;
                    $data['name'] = 'BTC Cash';
                    $data['name_full'] = 'bitcoin-cash';
                } catch (\Exception $e) {

                    return [
                        'status' => 'error',
                        'message' => 'Bitcoin Cash Server Very Busy , Try Again'
                    ];
                }
            }
            if ($action == 'dash_address') {

//dash
                try {
                    $da = $general_coin;
                    $dash = json_decode($da);
                    $dash_final = $dash->data[21]->priceUsd;
                    $data['amount_convert'] = $amount_pay / $dash_final;
                    $data['name'] = 'dash';
                    $data['name_full'] = 'dash';
                } catch (\Exception $e) {

                    return [
                        'status' => 'error',
                        'message' => 'Dash Cash Server Very Busy , Try Again'
                    ];
                }
            }

            $data['amount_convert'] = number_format(floatval($data['amount_convert']), 8, '.', '');
            $data['invest'] = $invest;
            $data['coin'] = $coin;
            $data['plan'] = $plan;
            $data['profit'] = $profit;
            $data['sendaddress'] = $data['name_full'] . ':' . $coin->address;

//send user email
            if ($data ['fund'] == 'invest') {
//check reference for bouns
                $actionb = $invest->coin->slug;
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
                foreach ($invest->user->coin as $ucoin) {
                    if ($invest->coin_id == $ucoin->coin_id) {

                        $address = $ucoin->address;
                    }
                }
                $user_ref = Reference::whereReferred_id($invest->user_id)->first();
                if (is_object($user_ref)) {
//plan ref percentage
                    $bonus = $invest->amount * $invest->plan->ref / 100;
                    $pay = UserCoin::whereUser_id($user_ref->user_id)->whereCoin_id($invest->coin_id)->first();
                    if (is_object($pay)) {
                        $pay->bonus = $pay->bonus + $bonus;
                        $pay->save();
//transcation log
                        Transaction::create([
                            'user_id' => $user_ref->user_id,
                            'transaction_id' => $invest->transaction_id,
                            'type' => 'Referral Bonus',
                            'name_type' => 'Referral Bonus',
                            'coin_id' => $invest->coin_id,
                            'amount' => $bonus,
                            'status' => true,
                            'amount_profit' => $bonus,
                            'description' => 'Referral Bonus Under ' . $invest->plan->name
                        ]);
                        $user_pay = $user_ref->refs->first_name . ' ' . $user_ref->refs->last_name;
                        $text = "You earned a referral bonus  of $$bonus for referring  $user_pay.";


                        $message = $text;

                        $this->sendMail($pay->user->email, $pay->user->first_name, 'Referral Bonus Notification', $message);
                    }
                }

                $greeting = 'Hello ' . Auth::user()->first_name . ' ' . Auth::user()->last_name . ',';
                $email = Auth::user()->email;
                $subject = 'New Investment Notification';
                $message = ' You invested' . '$' . $invest->amount . " using " . $data ['name'] . " Under " . $plan->name . "  .";

                Notification:: route('mail', $email)
                        ->notify(new PlanDepositMail($greeting, $subject, $message));

                return [
                    'status' => 'success',
                    'message' => 'The Deposit Have Been Successfully Saved',
                    'plan' => $plan,
                    'invest' => $invest,
                    'type' => 'invest'
                ];
            }

            if ($data ['fund'] == 'fund') {
                $realcount = number_format(floatval($data['amount_convert']), 8, '.', '');
                Investment::whereId($invest->id)->update([
                    'amount_check' => $realcount
                ]);
//generate image for QR barcode

                $text = $data['sendaddress'] . '?amount=' . $realcount;
                $qrCode = new QrCode($text);
                $qrCode->setSize(300);
                $qrCode->setWriterByName('png');
                $qrCode->setEncoding('UTF-8');
                $qrCode->setErrorCorrectionLevel(ErrorCorrectionLevel::HIGH());
                $qrCode->setForegroundColor(['r' => 0, 'g' => 0, 'b' => 0, 'a' => 0]);
                $qrCode->setBackgroundColor(['r' => 255, 'g' => 255, 'b' => 255, 'a' => 0]);
                $qrCode->setLogoPath(public_path() . '/' . $setting['logo']);
                $qrCode->setLogoSize(32, 32);
                $qrCode->setValidateResult(false);
                $qrcode_image = $qrCode->writeDataUri();
                $data['image_qrcode'] = $qrcode_image;
                $data['type'] = 'fund';
                $data['status'] = 'success';
                return $data;
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function confirmDeposit(Request $request) {
        $input = $request->all();
        $rules = [
            'hash' => 'required',
            'transaction_id' => 'required'
        ];
        $error = static::getErrorMessage($input, $rules);
        if ($error) {
            return $error;
        }
        $check = Investment::whereTransaction_id($request->transaction_id)->first();
        if (is_object($check)) {
            $check->update([
                'hash' => $request->hash
            ]);
            Transaction::whereTransaction_id($check->transaction_id)->update([
                'status' => true
            ]);
            return [
                'status' => 'error',
                'message' => 'Transaction Hash Submitted'
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Invalid Deposit'
            ];
        }
    }

    public function withdraw() {
        $data['user_withdrawal'] = UserWithdrawal::whereUser_id(Auth::user()->id)->whereStatus(true)->get();
        $data['withdraws'] = Withdraw::whereUser_id(Auth::user()->id)->whereStatus(true)->with('coin')->orderBy('created_at', 'desc')->paginate(10);
        return $data;
    }

    public function withdrawPost(Request $request) {
        $setting = Setting::whereId(1)->first();
        $charge = $setting['withdraw_charge'];
        $usercoin = UserWithdrawal::whereId($request->id)->first();
        $amount_to_convert = $usercoin->amount - $charge;
        $amount = $usercoin->amount;
        if ($amount < $setting->min_withdraw) {
            return [
                'status' => 'error',
                'message' => 'The  Amount you Entered is Very Small to Withdraw'
            ];
        }
        if (Auth::user()->can_withdraw == true) {

            return [
                'status' => 'error',
                'message' => 'You can not make a withdraw right now, your account is under review'
            ];
        }
//        if (Auth::user()->can_withdraw_auto == true) {
//            session()->flash('message.level', 'error');
//            session()->flash('message.color', 'red');
//            session()->flash('message.content', 'Auto withdraw disabled contact admin');
//            return redirect()->back();
//        }
        DB::beginTransaction();
        try {



//btc
            try {
                $all = file_get_contents("https://blockchain.info/ticker");
                $res = json_decode($all);
                $btcrate = $res->USD->last;
            } catch (\Exception $e) {
                return [
                    'status' => 'error',
                    'message' => 'Bitcoin Server Very Busy , Try Again'
                ];
            }
            $coin = Coin::whereId($usercoin->coin_id)->first();
            $action = $coin->slug;
            $general_coin = file_get_contents('https://api.coincap.io/v2/assets');
//amount in btc or lite or btc cash
            if ($action == 'bitcoin_address') {
                $data['amount_convert'] = $amount_to_convert / $btcrate;
                $data['name'] = 'BTC';
                $data['name_full'] = 'Bitcoin';
            }
            if ($action == 'litecoin_address') {
                try {
                    $lit = $general_coin;
                    $litecoin = json_decode($lit);
                    $litecoin_final = $litecoin->data[7]->priceUsd;
                    $data['amount_convert'] = $amount_to_convert / $litecoin_final;
                    $data['name'] = 'LTE';
                    $data['name_full'] = 'Litecoin';
                } catch (\Exception $e) {
                    return [
                        'status' => 'error',
                        'message' => 'Litecoin Server Very Busy , Try Again'
                    ];
                }
            }
            if ($action == 'ethereum_address') {

                try {
                    $eth = $general_coin;
                    $ethereum = json_decode($eth);
                    $ethereum_final = $ethereum->data[1]->priceUsd;
                    $data['amount_convert'] = $amount_to_convert / $ethereum_final;
                    $data['name'] = 'ETH';
                    $data['name_full'] = 'Ethereum';
                } catch (\Exception $e) {
                    return [
                        'status' => 'error',
                        'message' => 'Ethereum Server Very Busy , Try Again'
                    ];
                }
            }
            if ($action == 'bitcoin_cash_address') {
//bitcoin cash
                try {
                    $btic_cash = $general_coin;
                    $dash = json_decode($btic_cash);
                    $cash_final = $dash->data[4]->priceUsd;
                    $data['amount_convert'] = $amount_to_convert / $cash_final;
                    $data['name'] = 'BTC Cash';
                    $data['name_full'] = 'Bitcoin Cash';
                } catch (\Exception $e) {
                    return [
                        'status' => 'error',
                        'message' => 'Bitcoin Cash Server Very Busy , Try Again'
                    ];
                }
            }
            if ($action == 'dash_address') {

//dash
                try {
                    $da = $general_coin;
                    $dash = json_decode($da);
                    $dash_final = $dash->data[21]->priceUsd;
                    $data['amount_convert'] = $amount_to_convert / $dash_final;
                    $data['name'] = 'dash';
                    $data['name_full'] = 'Dash';
                } catch (\Exception $e) {
                    return [
                        'status' => 'error',
                        'message' => 'Dash Cash Server Very Busy , Try Again'
                    ];
                }
            }
            $am = number_format(floatval($data['amount_convert']), 8, '.', '');
//create withdraw

            $data_withdraw = ([
                'transaction_id' => strtoupper(Str::random(20)),
                'user_id' => Auth::user()->id,
                'coin_id' => $usercoin->coin_id,
                'usercoin_id' => $usercoin->coin_id,
                'user_withdrawal_id' => $request->id,
                'withdraw_from' => $usercoin->type,
                'description' => 'You Widthrew  ' . '$' . $amount,
                'amount' => $amount,
                //'comment' => $request->comment,
                'total_amount' => $amount + $charge,
                'withdraw_charge' => $charge,
                'message' => null,
                'amount_check' => $am,
                'confirm' => 1,
                'status' => 0
            ]);
            $request->session()->put('withdraw', $data_withdraw);
            $withdraw = Session::get('withdraw');
////transcation log
//            Transaction::create([
//                'user_id' => Auth::user()->id,
//                'transaction_id' => $withdraw->transaction_id,
//                'type' => 'Withdrawal',
//                'name_type' => 'Withdrawal',
//                'withdraw_charge' => $charge,
//                'coin_id' => $request->coin,
//                'amount' => $amount,
//                'description' => 'You Widthraw  ' . '$' . $amount
//            ]);


            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        $usercoin_address = UserCoin::whereUser_id(Auth::user()->id)->whereCoin_id($usercoin->coin_id)->first();
        $data['amount_convert'] = number_format(floatval($data['amount_convert']), 8, '.', '');
        $data['withdraw'] = $withdraw;
        $data['address'] = $usercoin_address->address;
        $data['total_balance'] = number_format(UserCoin::whereUser_id(Auth::user()->id)->sum('amount'), 2);
        $data['total_earn'] = number_format(UserCoin::whereUser_id(Auth::user()->id)->sum('earn'), 2);
        $data['total_bonus'] = number_format(UserCoin::whereUser_id(Auth::user()->id)->sum('bonus'), 2);
        $data['status'] = 'success';
        return $data;
    }

    public function withdrawFund(Request $request) {
        $setting = Setting::whereId(1)->first();
        $charge = $setting['withdraw_charge'];
        $on = $setting['auto_withdraw'];
        $input = $request->all();
        $rules = [
            'withdraw' => 'required'
        ];
        $error = static::getErrorMessage($input, $rules);
        if ($error) {
            return $error;
        }
        DB::beginTransaction();
        try {
            $withdraw_create = Session::get('withdraw');
            $withdraw = new Withdraw();
            $withdraw->transaction_id = $withdraw_create['transaction_id'];
            $withdraw->user_id = $withdraw_create['user_id'];
            $withdraw->coin_id = $withdraw_create['coin_id'];
            $withdraw->user_withdrawal_id = $withdraw_create['user_withdrawal_id'];
            $withdraw->usercoin_id = $withdraw_create['usercoin_id'];
            $withdraw->withdraw_from = $withdraw_create['withdraw_from'];
            $withdraw->description = $withdraw_create['description'];
            $withdraw->amount = $withdraw_create['amount'];
            //$withdraw->comment = $withdraw_create['comment'];
            $withdraw->total_amount = $withdraw_create['total_amount'];
            $withdraw->withdraw_charge = $withdraw_create['withdraw_charge'];
            $withdraw->message = null;
            $withdraw->amount_check = $withdraw_create['amount_check'];
            $withdraw->confirm = $withdraw_create['confirm'];
            $withdraw->status = $withdraw_create['status'];
            $withdraw->save();


            $action = $withdraw->coin->slug;
            $pin = $setting['block_io_pin'];

            if ($action == 'bitcoin_address') {
                $name = 'Bitcoin';
                $apiKey = $withdraw->coin->api_key;
                $version = 2; // API version
                $block_io = new BlockIo($apiKey, $pin, $version);
                $site_address = $withdraw->coin->address;
            }
            if ($action == 'litecoin_address') {

                $name = 'Litecoin';
                $apiKey = $withdraw->coin->api_key;
                $version = 2; // API version
                $block_io = new BlockIo($apiKey, $pin, $version);
                $site_address = $withdraw->coin->address;
            }
            if ($action == 'ethereum_address') {
                $name = 'Ethereum';
                $apiKey = $withdraw->coin->api_key;
                $version = 2; // API version
                $block_io = new BlockIo($apiKey, $pin, $version);
                $site_address = $withdraw->coin->address;
            }
            if ($action == 'bitcoin_cash_address') {
                $name = 'Bitcoin Cash';
                $apiKey = $withdraw->coin->api_key;
                $version = 2; // API version
                $block_io = new BlockIo($apiKey, $pin, $version);
                $site_address = $withdraw->coin->address;
            }
            if ($action == 'dash_address') {
                $name = 'Dash';
                $apiKey = $withdraw->coin->api_key;
                $version = 2; // API version
                $block_io = new BlockIo($apiKey, $pin, $version);
                $site_address = $withdraw->coin->address;
            }
//amount in btc or lite or btc cash
            $amount_to_convert = $withdraw->total_amount;
            $general_coin = file_get_contents('https://api.coincap.io/v2/assets');
            if ($action == 'bitcoin_address') {
                $all = file_get_contents("https://blockchain.info/ticker");
                $res = json_decode($all);
                $btcrate = $res->USD->last;
                $data['amount_convert'] = $amount_to_convert / $btcrate;
                $charge = $setting['withdraw_charge'] / $btcrate;
                $data['name'] = 'BTC';
                $data['name_full'] = 'Bitcoin';
            }
            if ($action == 'litecoin_address') {
                try {
                    $lit = $general_coin;
                    $litecoin = json_decode($lit);
                    $litecoin_final = $litecoin->data[6]->priceUsd;
                    $data['amount_convert'] = $amount_to_convert / $litecoin_final;
                    $charge = $setting['withdraw_charge'] / $litecoin_final;
                    $data['name'] = 'LTE';
                    $data['name_full'] = 'Litecoin';
                } catch (\Exception $e) {
                    return [
                        'status' => 'error',
                        'message' => 'Litecoin Server Very Busy , Try Again'
                    ];
                }
            }
            if ($action == 'ethereum_address') {

                try {
                    $eth = $general_coin;
                    $ethereum = json_decode($eth);
                    $ethereum_final = $ethereum->data[1]->priceUsd;
                    $data['amount_convert'] = $amount_to_convert / $ethereum_final;
                    $charge = $setting['withdraw_charge'] / $ethereum_final;
                    $data['name'] = 'ETH';
                    $data['name_full'] = 'ethereum';
                } catch (\Exception $e) {
                    return [
                        'status' => 'error',
                        'message' => 'Ethereum Server Very Busy , Try Again'
                    ];
                }
            }
            if ($action == 'bitcoin_cash_address') {
//bitcoin cash
                try {
                    $btic_cash = $general_coin;
                    $dash = json_decode($btic_cash);
                    $cash_final = $dash->data[4]->priceUsd;
                    $data['amount_convert'] = $amount_to_convert / $cash_final;
                    $charge = $setting['withdraw_charge'] / $cash_final;
                    $data['name'] = 'BTC Cash';
                    $data['name_full'] = 'Bitcoin Cash';
                } catch (\Exception $e) {
                    return [
                        'status' => 'error',
                        'message' => 'Bitcoin Cash Server Very Busy , Try Again'
                    ];
                }
            }
            if ($action == 'dash_address') {

//dash
                try {
                    $da = $general_coin;
                    $dash = json_decode($da);
                    $dash_final = $dash->data[21]->priceUsd;
                    $data['amount_convert'] = $amount_to_convert / $dash_final;
                    $charge = $setting['withdraw_charge'] / $dash_final;
                    $data['name'] = 'dash';
                    $data['name_full'] = 'Dash';
                } catch (\Exception $e) {
                    return [
                        'status' => 'error',
                        'message' => 'Dash Cash Server Very Busy , Try Again'
                    ];
                }
            }



//maual withdraw
            if ($on == false) {
                $address = $withdraw->usercoin->address;
////transcation log
                Transaction::create([
                    'user_id' => Auth::user()->id,
                    'transaction_id' => $withdraw->transaction_id,
                    'type' => 'Withdrawal',
                    'name_type' => 'Withdrawal',
                    'withdraw_charge' => $charge,
                    'coin_id' => $withdraw_create['coin_id'],
                    'amount' => $withdraw->amount,
                    'description' => 'You Widthraw  ' . '$' . $withdraw->amount
                ]);
//set user withdrawal status
                UserWithdrawal::whereId($withdraw->user_withdrawal_id)->update([
                    'status' => false
                ]);
//send mail
                $greeting = 'Hello Administrator,';
                $user_name = $withdraw->user->first_name . ' ' . $withdraw->user->last_name;
                $subject = 'Requested a withdrawal';
                $message = "$user_name with $name address $address just requested for a withdrawal of $$withdraw->amount";
                Withdraw::whereId($request->withdraw)->update([
                    'confirm' => true
                ]);
                Notification:: route('mail', $setting->send_notify_email)
                        ->notify(new SendNotifyMail($greeting, $subject, $message));
            } else {
//auto withdraw
                $ch = number_format(floatval($charge), 8, '.', '');
                try {
                    $block_io->withdraw_from_addresses(array('amounts' => $withdraw->amount_check, $ch, 'from_addresses' => $site_address, 'to_addresses' => $address));
                } catch (\Exception $e) {
                    Withdraw::whereId($withdraw->id)->delete();
                    return [
                        'status' => 'error',
                        'message' => 'No Fund in our wallet now, please try again later'
                    ];
                }
                Withdraw::whereId($request->withdraw)->update([
                    'confirm' => true
                ]);

//send mail
//            $greeting = 'Hello' . ' ' . $withdraw->user->full_name;
//            $email = $withdraw->user->email;
//            $subject = 'Withdrawal has been Confirmed ';
//            $text = "You Initiated an Automatic withdrawal of  " . "$" . $withdraw->amount;
//            $message = $text . ' from ' . $name . ' Wait for Confirmation in BlockChain ' . $name . " account " . $address . ' We will notify you once Blockchain Confirmed Your Withdrawal';
//            Notification:: route('mail', $email)
//                    ->notify(new SendNotifyMail($subject, $greeting, $message));
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        return [
            'status' => 'success',
            'message' => 'Withdrawal Successfully Confirmed'
        ];
    }

    public function reinvest(Request $request) {
        $usercoin = UserWithdrawal::whereId($request->id)->first();
//check plan
        $plan = Plan::whereId($usercoin->plan_id)->first();
        DB::beginTransaction();
        try {
            $coin = Coin::whereId($usercoin->coin_id)->first();
            if (!is_object($coin)) {
                return [
                    'status' => 'error',
                    'message' => 'Invalid Payment Method'
                ];
            }

//btc
            try {
                $all = file_get_contents("https://blockchain.info/ticker");
                $res = json_decode($all);
                $btcrate = $res->USD->last;
            } catch (\Exception $e) {
                return [
                    'status' => 'error',
                    'message' => 'Bitcoin Server Very Busy , Try Again'
                ];
            }
            $action = $coin->slug;
            $current = Carbon::now();
            $status_deposit = true;
            $due = $current->addHours($plan->compound->compound);
            $due_pay = $due->addMinutes(2);
            $txt = strtoupper(Str::random(20));


//create investment

            $invest = Investment::create([
                        'transaction_id' => $txt,
                        'hash' => 'reinvest',
                        'user_id' => Auth::user()->id,
                        'plan_id' => $usercoin->plan_id,
                        'coin_id' => $usercoin->coin_id,
                        'amount' => $usercoin->amount,
                        'user_withdrawal_id' => $request->id,
                        'run_count' => 0,
                        'earn' => 0,
                        'due_pay' => $due_pay,
                        'status_deposit' => $status_deposit,
                        'settled_status' => 0,
                        'status' => 0
            ]);


            $profit = $invest->amount * $plan->percentage / 100;
//transcation log
            Transaction::create([
                'user_id' => Auth::user()->id,
                'transaction_id' => $invest->transaction_id,
                'type' => "$usercoin->type Re-investment",
                'name_type' => 'Deposit',
                //'deposit_investment_charge' => $charge,
                'coin_id' => $usercoin->coin_id,
                'amount' => $invest->amount,
                'amount_profit' => $profit,
                'description' => "You Re-invested your $usercoin->type Under  " . $plan->name
            ]);

//amount in btc or lite or btc cash
            if ($action == 'bitcoin_address') {
                $data['name'] = 'BTC';
                $data['name_full'] = 'bitcoin';
            }
            if ($action == 'litecoin_address') {
                try {
                    $data['name'] = 'LTE';
                    $data['name_full'] = 'litecoin';
                } catch (\Exception $e) {
                    return [
                        'status' => 'error',
                        'message' => 'Litecoin Server Very Busy , Try Again'
                    ];
                }
            }
            if ($action == 'ethereum_address') {

                try {
                    $data['name'] = 'ETH';
                    $data['name_full'] = 'ethereum';
                } catch (\Exception $e) {

                    return [
                        'status' => 'error',
                        'message' => 'Ethereum Server Very Busy , Try Again'
                    ];
                }
            }
            if ($action == 'bitcoin_cash_address') {
//bitcoin cash
                try {
                    $data['name'] = 'BTC Cash';
                    $data['name_full'] = 'bitcoin-cash';
                } catch (\Exception $e) {

                    return [
                        'status' => 'error',
                        'message' => 'Bitcoin Cash Server Very Busy , Try Again'
                    ];
                }
            }
            if ($action == 'dash_address') {
//dash
                try {
                    $data['name'] = 'dash';
                    $data['name_full'] = 'dash';
                } catch (\Exception $e) {

                    return [
                        'status' => 'error',
                        'message' => 'Dash Cash Server Very Busy , Try Again'
                    ];
                }
            }



//check reference for bouns
            $actionb = $invest->coin->slug;
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
//
//        $user_ref = Reference::whereReferred_id($invest->user_id)->first();
////        if (is_object($user_ref)) {
////plan ref percentage
//            $bonus = $invest->amount * $invest->plan->ref / 100;
//            $pay = UserCoin::whereUser_id($user_ref->user_id)->whereCoin_id($invest->coin_id)->first();
//            if (is_object($pay)) {
//                $pay->bonus = $pay->bonus + $bonus;
//                $pay->save();
////transcation log
//                Transaction::create([
//                    'user_id' => $user_ref->user_id,
//                    'transaction_id' => $invest->transaction_id,
//                    'type' => 'Re-invest Referral Bonus',
//                    'name_type' => 'Referral Bonus',
//                    'coin_id' => $invest->coin_id,
//                    'amount' => $bonus,
//                    'status' => true,
//                    'amount_profit' => $bonus,
//                    'description' => 'Re-invest Referral Bonus Under ' . $invest->plan->name
//                ]);
//                $user_pay = $user_ref->refs->first_name . ' ' . $user_ref->refs->last_name;
//                $text = "You earned a referral bonus  of $$bonus for referring  $user_pay.";
//
//
//                $message = $text;
//
//                $this->sendMail($pay->user->email, $pay->user->first_name, 'Referral Bonus Notification', $message);
//            }
//        }
            //set user withdrawal status
            UserWithdrawal::whereId($invest->user_withdrawal_id)->update([
                'status' => false
            ]);

            $greeting = 'Hello ' . Auth::user()->first_name . ' ' . Auth::user()->last_name . ',';
            $email = Auth::user()->email;
            $subject = 'New Re-Investment Notification';
            $message = ' You Re-invested your ' . $usercoin->type . ' $' . $invest->amount . " using " . $data ['name'] . "  Under " . $plan->name . "  .";

            Notification:: route('mail', $email)
                    ->notify(new PlanDepositMail($greeting, $subject, $message));

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        return [
            'status' => 'success',
            'message' => "The Re-investment of your $usercoin->type Successfully done",
            'plan' => $plan,
            'invest' => $invest,
            'type' => 'invest'
        ];
    }

    public function depositList() {
        $data['plans'] = Plan::all();
        $data['deposits'] = Investment::whereUser_id(Auth::user()->id)->orderBy('created_at', 'desc')->paginate(15);
        return view('user.deposit_list', $data);
    }

    public function depositHistory(Request $request) {
        $data['coins'] = Coin::all();
        $data['histories'] = Investment::whereUser_id(Auth::user()->id)->orderBy('created_at', 'desc')->paginate(15);
        $data['type'] = 'Deposit';
        return view('user.deposit_history', $data);
    }

    public function withdrawHistory(Request $request) {
        $data['coins'] = Coin::all();
        $data['histories'] = Withdraw::whereUser_id(Auth::user()->id)->paginate(15);
        $data['type'] = 'withdrawal';
        return view('user.withdraw_history', $data);
    }

    public function earnings(Request $request) {
        $data['coins'] = Coin::all();
        $data['histories'] = Transaction::whereUser_id(Auth::user()->id)->paginate(15);
        $data['type'] = null;
        return view('user.withdraw_history', $data);
    }

    public function getHistory(Request $request) {
        if ($request->type == null) {
            $url_path = url('get_history');
        } else {
            $url_path = url('get_history?type=' . $request->type);
        }
        $data['coins'] = Coin::all();
        if ($request->type == null) {
            $items = Transaction::whereUser_id(Auth::user()->id)->whereStatus(true)->with('coin')->orderBy('created_at', 'desc')->get();
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $itemCollection = collect($items);
            $perPage = 10;
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage ) - $perPage, $perPage)->all();
            $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
            $data['histories'] = $paginatedItems->setPath($url_path);
            $data['type'] = '';
        }
        if ($request->type == 'deposit') {
            $items = Transaction::whereUser_id(Auth::user()->id)->whereStatus(true)->with('coin')->orderBy('created_at', 'desc')->whereType('Deposit Investment')->get();
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $itemCollection = collect($items);
            $perPage = 10;
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage ) - $perPage, $perPage)->all();
            $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
            $data['histories'] = $paginatedItems->setPath($url_path);
            $data['type'] = 'deposit';
        }
        if ($request->type == 'bonus') {
            $items = Transaction::whereUser_id(Auth::user()->id)->whereStatus(true)->with('coin')->orderBy('created_at', 'desc')->whereType('Bonus')->get();
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $itemCollection = collect($items);
            $perPage = 10;
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage ) - $perPage, $perPage)->all();
            $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
            $data['histories'] = $paginatedItems->setPath($url_path);
            $data['type'] = 'bonus';
        }
        if ($request->type == 'earning') {
            $items = Transaction::whereUser_id(Auth::user()->id)->whereStatus(true)->with('coin')->orderBy('created_at', 'desc')->whereType('Earning')->get();
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $itemCollection = collect($items);
            $perPage = 10;
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage ) - $perPage, $perPage)->all();
            $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
            $data['histories'] = $paginatedItems->setPath($url_path);
            $data['type'] = 'earning';
        }

        if ($request->type == 'withdrawal') {
            $items = Transaction::whereUser_id(Auth::user()->id)->whereStatus(true)->with('coin')->orderBy('created_at', 'desc')->whereType('Withdrawal')->get();
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $itemCollection = collect($items);
            $perPage = 10;
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage ) - $perPage, $perPage)->all();
            $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
            $data['histories'] = $paginatedItems->setPath($url_path);
            $data['type'] = 'withdrawal';
        }

        if ($request->type == 'commissions') {
            $items = Transaction::whereUser_id(Auth::user()->id)->whereStatus(true)->with('coin')->orderBy('created_at', 'desc')->whereType('Referral Bonus')->get();
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $itemCollection = collect($items);
            $perPage = 10;
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage ) - $perPage, $perPage)->all();
            $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
            $data['histories'] = $paginatedItems->setPath($url_path);
            $data['type'] = 'commissions';
        }
        if ($request->type == 'bitcoin_address') {
            $coin = Coin::whereSlug('bitcoin_address')->first();
            $items = Transaction::whereUser_id(Auth::user()->id)->whereStatus(true)->with('coin')->orderBy('created_at', 'desc')->whereCoin_id($coin->id)->get();
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $itemCollection = collect($items);
            $perPage = 10;
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage ) - $perPage, $perPage)->all();
            $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
            $data['histories'] = $paginatedItems->setPath($url_path);
            $data['type'] = 'bitcoin_address';
        }
        if ($request->type == 'litecoin_address') {
            $coin = Coin::whereSlug('litecoin_address')->first();
            $items = Transaction::whereUser_id(Auth::user()->id)->whereStatus(true)->with('coin')->orderBy('created_at', 'desc')->whereCoin_id($coin->id)->get();
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $itemCollection = collect($items);
            $perPage = 10;
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage ) - $perPage, $perPage)->all();
            $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
            $data['histories'] = $paginatedItems->setPath($url_path);
            $data['type'] = 'litecoin_address';
        }
        if ($request->type == 'ethereum_address') {
            $coin = Coin::whereSlug('ethereum_address')->first();
            $items = Transaction::whereUser_id(Auth::user()->id)->whereStatus(true)->with('coin')->orderBy('created_at', 'desc')->whereCoin_id($coin->id)->get();
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $itemCollection = collect($items);
            $perPage = 10;
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage ) - $perPage, $perPage)->all();
            $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
            $data['histories'] = $paginatedItems->setPath($url_path);
            $data['type'] = 'ethereum_address';
        }

        if ($request->type == 'bitcoin_cash_address') {
            $coin = Coin::whereSlug('bitcoin_cash_address')->first();
            $items = Transaction::whereUser_id(Auth::user()->id)->whereStatus(true)->with('coin')->orderBy('created_at', 'desc')->whereCoin_id($coin->id)->get();
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $itemCollection = collect($items);
            $perPage = 10;
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage ) - $perPage, $perPage)->all();
            $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
            $data['histories'] = $paginatedItems->setPath($url_path);
            $data['type'] = 'bitcoin_cash_address';
        }

        if ($request->type == 'dash_address') {
            $coin = Coin::whereSlug('dash_address')->first();
            $items = Transaction::whereUser_id(Auth::user()->id)->whereStatus(true)->with('coin')->orderBy('created_at', 'desc')->whereCoin_id($coin->id)->get();
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $itemCollection = collect($items);
            $perPage = 10;
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

    public function referals() {
        $data['referal'] = Reference::whereUser_id(Auth::user()->id)->with('refs')->get();
        $data['refs_count'] = number_format(Reference::whereUser_id(Auth::user()->id)->count());

        $ref = Reference::whereUser_id(Auth::user()->id)->select('referred_id')->pluck('referred_id');
        $ddd = Investment:: whereIn('user_id', $ref)->whereStatus_deposit(1)->get();
        $data['active'] = $ddd->groupBy('user_id')->count();
        $data['commission'] = number_format(UserWithdrawal::whereUser_id(Auth::user()->id)->whereStatus(true)->whereType('Referral Bonus')->sum('amount'), 2);
        $ref_link = User::whereId(Auth::user()->id)->first();
        $data['ref_link'] = $ref_link->ref_code;
        return $data;
    }

    public function referalsLink() {
        return view('user.referallinks');
    }

    public function edit(Request $request) {
        $data['user'] = User::whereId(Auth::user()->id)->first();
        $data['payment_method'] = UserCoin::whereUser_id(Auth::user()->id)->with('coin')->get();
        $data['country'] = CountryState::getCountries();
//          $data['number'] = $this->setLocation($request);

        return $data;
    }

    private function setLocation(Request $request) {
        $ip = $request->getClientIp();
        $geoip = GeoPluginApi::locate($ip);
        $code = $geoip->getCountryCode();
        if (!empty($code)) {
            $code_list = \megastruktur\PhoneCountryCodes::getCodesList();
            $phone_code = collect($code_list[$code]);
            return $phone_code[0];
        }
    }

    public function editPost(Request $request) {

        $input = $request->all();
        $rules = ([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_no' => 'required',
            'country' => 'required',
            'email' => 'required'
        ]);
        if (!empty($request->password)) {
            $rules = ([
                'password' => ['required', 'string', 'min:8'],
                'confirm_password' => 'required|same:password'
            ]);
        }
        if (!empty($request->bitcoin_address)) {
            $rules = ([
                'bitcoin_address' => 'regex:/^[13][a-km-zA-HJ-NP-Z1-9]{25,34}$/'
            ]);
        }
        if (!empty($request->litecoin_address)) {
            $rules = ([
                'litecoin_address' => 'regex:/^[LM3][a-km-zA-HJ-NP-Z1-9]{25,34}$/'
            ]);
        }

        if (!empty($request->ethereum_address)) {
            $rules = ([
                'ethereum_address' => 'regex:/^(0x)?[0-9a-fA-F]{40}$/'
            ]);
        }
        if (!empty($request->bitcoin_cash_address)) {
            $rules = ([
                'bitcoin_cash_address' => 'regex:/^[\w\d]{25,43}$/'
            ]);
        }
        if (!empty($request->dash_address)) {
            $rules = ([
                'dash_address' => 'regex:/^X[0-9a-zA-Z]{33}$/'
            ]);
        }

        $error = static::getErrorMessage($input, $rules);
        if ($error) {
            return $error;
        }
        if (!empty($request->bitcoin_address)) {

            $coin = Coin::whereSlug('bitcoin_address')->first();
            $usercoin = UserCoin::firstOrNew(array('user_id' => (Auth:: user()->id), 'coin_id' => $coin->id));
            $usercoin->user_id = Auth::user()->id;
            $usercoin->coin_id = $coin->id;
            $usercoin->address = $request->bitcoin_address;
            $usercoin->amount = 0;
            $usercoin->save();
        }
        if (!empty($request->litecoin_address)) {
            $coin = Coin::whereSlug('litecoin_address')->first();
            $usercoin = UserCoin::firstOrNew(array('user_id' => (Auth:: user()->id), 'coin_id' => $coin->id));
            $usercoin->user_id = Auth::user()->id;
            $usercoin->coin_id = $coin->id;
            $usercoin->address = $request->litecoin_address;
            $usercoin->amount = 0;
            $usercoin->save();
        }

        if (!empty($request->ethereum_address)) {
            $coin = Coin::whereSlug('ethereum_address')->first();
            $usercoin = UserCoin::firstOrNew(array('user_id' => (Auth:: user()->id), 'coin_id' => $coin->id));
            $usercoin->user_id = Auth::user()->id;
            $usercoin->coin_id = $coin->id;
            $usercoin->address = $request->ethereum_address;
            $usercoin->amount = 0;
            $usercoin->save();
        }
        if (!empty($request->bitcoin_cash_address)) {
            $coin = Coin::whereSlug('bitcoin_cash_address')->first();
            $usercoin = UserCoin::firstOrNew(array('user_id' => (Auth:: user()->id), 'coin_id' => $coin->id));
            $usercoin->user_id = Auth::user()->id;
            $usercoin->coin_id = $coin->id;
            $usercoin->address = $request->bitcoin_cash_address;
            $usercoin->amount = 0;
            $usercoin->save();
        }
        if (!empty($request->dash_address)) {
            $coin = Coin::whereSlug('dash_address')->first();
            $usercoin = UserCoin::firstOrNew(array('user_id' => (Auth:: user()->id), 'coin_id' => $coin->id));
            $usercoin->user_id = Auth::user()->id;
            $usercoin->coin_id = $coin->id;
            $usercoin->address = $request->dash_address;
            $usercoin->amount = 0;
            $usercoin->save();
        }
        $user = User::firstOrNew(array('id' => (Auth::user()->id)));
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone_no = $request->phone_no;
        $user->country = $request->country;

        $user->email = $request->email;
        $user->save();
        if (!empty($request->password)) {
            $user = User::firstOrNew(array('id' => (Auth::user()->id)));
            $user->password = bcrypt($request->password);
            $user->save();
        }
        return [
            'status' => 'success',
            'message' => 'Data Successfully Saved'
        ];
    }

    public function logOut() {
        Auth::logout();
        return redirect('/login');
    }

    public function compoundEnable() {
//        User::whereId(Auth::user()->id)->update([
//            'compounding' => true
//        ]);
//        return [
//            'status' => 200,
//            'message' => 'Success'
//        ];
    }

    public function compoundDisable() {
//        User::whereId(Auth::user()->id)->update([
//            'compounding' => false
//        ]);
//        return [
//            'status' => 200,
//            'message' => 'Success'
//        ];
    }

}
