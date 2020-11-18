<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCompounding extends Model
{
    protected $dates = ['due_pay'];
    protected $fillable = [
        'transaction_id', 'user_id','coin_id','amount','run_count','due_pay','status','compound_id',
    ];
    
     public function user() {
       return $this->belongsTo(User::class,'user_id') ;
    }
    
      public function coin() {
       return $this->belongsTo(Coin::class,'coin_id') ;
    }
      public function compound() {
       return $this->belongsTo(Compound::class,'compound_id') ;
    }
     
    
}
