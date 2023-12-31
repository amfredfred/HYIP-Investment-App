<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TraitsFolder\MailTrait;
use App\Investment;
use App\Transaction;
use App\Models\Admin\Setting;
use App\UserCoin;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\UserWithdrawal;

class CronJobController extends Controller {

    use MailTrait;

    public function index() {
        $setting = Setting::whereId(1)->first();
        DB::beginTransaction();
        try {
            if ($setting->investment_payment_mode == false) {
                $investments = Investment::whereStatus(0)->whereStatus_deposit(1)->where('updated_at', '<', Carbon::now()->subWeek())->get();
                foreach ($investments as $invest) {

                    $action = $invest->coin->slug;
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
                    $address = $invest->userCoin->address;

                    $c = ($invest->plan->compound->compound / 24);
                    $check = $invest->run_count;
                    if ($check != $c) {

                        $profit = $invest->amount * $invest->plan->percentage / 100;
                        // / $c
                        $daily_profit = $profit;
//                        $usercoin = UserCoin::whereCoin_id($invest->coin_id)->whereUser_id($invest->user_id)->first();
//                        //usercoin 
//                        $usercoin->earn = $usercoin->earn + $daily_profit;
//                        $usercoin->save();
                        //userwithdrawal
                        $user_withdraw = new UserWithdrawal();
                        $user_withdraw->amount = $daily_profit;
                        $user_withdraw->user_id = $invest->user_id;
                        $user_withdraw->coin_id = $invest->coin_id;
                        $user_withdraw->type = "Profit";
                        $user_withdraw->status = true;
                        $user_withdraw->plan_id = $invest->plan_id;
                        $user_withdraw->save();
                        //update investment 
                        $update_investment = Investment::findOrFail($invest->id);
                        $update_investment->run_count = $invest->run_count + 1;
                        $update_investment->earn = $invest->earn + $daily_profit;
                       // $update_investment->com_earn = $invest->com_earn + $daily_profit;
                        $update_investment->save();

                        //transcation log
                        Transaction::create([
                            'user_id' => $invest->user_id,
                            'transaction_id' => $invest->transaction_id,
                            'type' => 'Deposit Investment',
                            'name_type' => 'Weekly Profit',
                            'coin_id' => $invest->coin_id,
                            'status' => true,
                            'amount' => $daily_profit,
                            'amount_profit' => $daily_profit,
                            'description' => 'Profit Notification Under ' . $invest->plan->name
                        ]);
                        $text_p = "You’ve earned a profit of $$daily_profit and it has been credited to your account.";

                        $this->sendMail($invest->user->email, $invest->user->first_name, 'Profit Notification', $text_p); 
                    } else {

//                        //usercoin 
//                        $usercoin = UserCoin::whereCoin_id($invest->coin_id)->whereUser_id($invest->user_id)->first();
//                        $usercoin->amount = $usercoin->amount + $invest->amount;
//                        $usercoin->save();
                        $user_withdraw = new UserWithdrawal();
                        $user_withdraw->amount = $invest->amount;
                        $user_withdraw->user_id = $invest->user_id;
                        $user_withdraw->coin_id = $invest->coin_id;
                        $user_withdraw->type = "Main Balance";
                        $user_withdraw->status = true;
                        $user_withdraw->plan_id = $invest->plan_id;
                        $user_withdraw->save();
                        //update investment 
                        $update_investment = Investment::findOrFail($invest->id);
                        $update_investment->status = true;
                        $update_investment->save();

                        //transcation log
                        Transaction::create([
                            'user_id' => $invest->user_id,
                            'transaction_id' => $invest->transaction_id,
                            'type' => 'Deposit Investment',
                            'name_type' => 'Return Investment Amount',
                            'coin_id' => $invest->coin_id,
                            'status' => true,
                            'amount' => $invest->amount,
                            'amount_profit' => $invest->amount,
                            'description' => 'You Investment Amount Returned  Under ' . $invest->plan->name
                        ]);
                        $text = "Your investment of $$invest->amount have been returned.";
                        $this->sendMail($invest->user->email, $invest->user->first_name, 'Investment  Completed.', $text); 
                    }
                }
            } else {
                $investments = Investment::whereStatus(0)->whereStatus_deposit(1)->where('due_pay', '<', Carbon::now())->get();
//dd($investments);
                foreach ($investments as $invest) {
                    $action = $invest->coin->slug;
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
                    $address = $invest->userCoin->address;
                    $usercoin = UserCoin::whereCoin_id($invest->coin_id)->whereUser_id($invest->user_id)->first();

                    $profitamount = $invest->amount * $invest->plan->percentage / 100;
//                    //usercoin 
//                    $usercoin->amount = $usercoin->amount + $invest->amount;
//                    $usercoin->earn = $usercoin->earn + $profitamount;
//                    $usercoin->save();
                    //user withdrawal
                    $user_withdraw_p = new UserWithdrawal();
                    $user_withdraw_p->amount = $profitamount;
                    $user_withdraw_p->user_id = $invest->user_id;
                    $user_withdraw_p->coin_id = $invest->coin_id;
                    $user_withdraw_p->type = "Profit";
                    $user_withdraw_p->status = true;
                    $user_withdraw_p->plan_id = $invest->plan_id;
                    $user_withdraw_p->save();
                    //main balance
                    $user_withdraw = new UserWithdrawal();
                    $user_withdraw->amount = $invest->amount;
                    $user_withdraw->user_id = $invest->user_id;
                    $user_withdraw->coin_id = $invest->coin_id;
                    $user_withdraw->type = "Main Balance";
                    $user_withdraw->status = true;
                    $user_withdraw->plan_id = $invest->plan_id;
                    $user_withdraw->save();
                    //update investment 
                    $update_investment = Investment::findOrFail($invest->id);
                    $update_investment->status = true;
                    $update_investment->earn = $update_investment->earn + $profitamount;
                    $update_investment->com_earn = $update_investment->com_earn + $profitamount;
                    $update_investment->save();

                    //transcation log profit
                    Transaction::create([
                        'user_id' => $invest->user_id,
                        'transaction_id' => $invest->transaction_id,
                        'type' => 'Deposit Investment',
                        'name_type' => 'Profit Amount',
                        'coin_id' => $invest->coin_id,
                        'amount' => $profitamount,
                        'status' => true,
                        'amount_profit' => $profitamount,
                        'description' => 'You Investment Profit Under ' . $invest->plan->name
                    ]);
                    $text = "You’ve earned a profit of $$profitamount  and it has been credited to your account.";
                    $this->sendMail($invest->user->email, $invest->user->first_name, 'Profit Notification', $text);

                    //transcation log
                    Transaction::create([
                        'user_id' => $invest->user_id,
                        'transaction_id' => $invest->transaction_id,
                        'type' => 'Deposit Investment',
                        'name_type' => 'Return Investment Amount',
                        'coin_id' => $invest->coin_id,
                        'amount' => $invest->amount,
                        'status' => true,
                        'amount_profit' => $invest->amount,
                        'description' => 'You Investment Amount Returned  Under ' . $invest->plan->name
                    ]);
                    $text_in = "Your investment of $$invest->amount have been returned.";
                    $this->sendMail($invest->user->email, $invest->user->first_name, 'Investment  Completed.', $text_in);
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        return 'success';
    }

    public function moveFund() {
        //profit
        $userCoin = UserCoin::all();
        //user withdrawal
        $user_withdraw = new UserWithdrawal();
        $user_withdraw->amount = $userCoin->amount;
        $user_withdraw->user_id = $userCoin->user_id;
        $user_withdraw->coin_id = $userCoin->coin_id;
        $user_withdraw->type = "Main Balance";
        $user_withdraw->status = true;
        $user_withdraw->plan_id = 1;
        $user_withdraw->save();
        //move bonus
        $user_withdraw_b = new UserWithdrawal();
        $user_withdraw_b->amount = $userCoin->earn;
        $user_withdraw_b->user_id = $userCoin->user_id;
        $user_withdraw_b->coin_id = $userCoin->coin_id;
        $user_withdraw_b->type = "Profit";
        $user_withdraw_b->status = true;
        $user_withdraw_b->plan_id = 1;
        $user_withdraw_b->save();
        return 'success';
    }

}
