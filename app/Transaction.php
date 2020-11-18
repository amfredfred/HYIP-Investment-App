<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id', 'transaction_id','coin_id','status','amount','name_type','amount_profit','description','type','deposit_investment_charge','withdraw_charge'
    ];
     public function coin() {
       return $this->belongsTo(Coin::class,'coin_id') ;
    }
     public function getPlan() {
        return  preg_replace('/[^0-9]/', '', $this->description);
    }
      public function user() {
       return $this->belongsTo(User::class,'user_id') ;
    }
}
