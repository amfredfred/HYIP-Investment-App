<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCoin extends Model
{
     protected $fillable = [
        'user_id', 'coin_id','amount','address','earn','earn_promo',
    ];
     
    public function coin() {
      return $this->belongsTo(Coin::class,'coin_id');  
    }
     public function user() {
      return $this->belongsTo(User::class,'user_id');  
    }
     public function userCoin() {
      return $this->hasOne(User::class,'user_id');  
    }
}
