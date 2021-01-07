<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investment extends Model {

    protected $dates = ['due_pay'];
    protected $fillable = [
        'transaction_id', 'user_id', 'plan_id', 'coin_id', 'earn', 'com_earn', 'hash', 'amount', 'run_count', 'due_pay', 'status_deposit', 'deposit_investment_charge', 'settled_status', 'status',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function coin() {
        return $this->belongsTo(Coin::class, 'coin_id');
    }

    public function plan() {
        return $this->belongsTo(Plan::class, 'plan_id');
    }

    public function plans() {
        return $this->hasMany(Plan::class, 'plan_id');
    }

    public function userCoin() {
        return $this->belongsTo(UserCoin::class, 'coin_id');
    }

}
