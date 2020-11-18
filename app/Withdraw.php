<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model {
   protected $fillable = [
        'user_id', 'transaction_id','coin_id','usercoin_id','status_withdraw','amount','description','withdraw_from','comment','withdraw_charge','total_amount','message','confirm','status','amount_check'
    ];
    public function user() {
        return $this->belongsTo(User::class, 'user_id')->with('coin');
    }

    public function coin() {
        return $this->belongsTo(Coin::class, 'coin_id');
    }
     public function usercoin() {
        return $this->belongsTo(UserCoin::class, 'usercoin_id');
    }

}
