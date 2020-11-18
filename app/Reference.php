<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
 protected $fillable = [
        'user_id', 'referred_id',
    ];
 
   public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
     public function refs() {
        return $this->hasOne(User::class, 'id','referred_id')->with('activeIn');
    }
     public function userRef() {
        return $this->hasMany(User::class, 'id', 'referred_id')->with('activeIn');
    }
}
