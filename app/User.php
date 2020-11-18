<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'type', 'country','compounding', 'phone_no', 'email', 'ref_check', 'password', 'can_withdraw', 'verified_code', 'ref_code', 'code', 'google2fa_secret', 'google2fa_secret_status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function usercoin() {
        return $this->hasMany(UserCoin::class, 'coin_id');
    }

    public function coin() {
        return $this->hasMany(UserCoin::class, 'user_id');
    }

    public function activeIn() {
        return $this->hasMany(Investment::class, 'user_id')
                ->selectRaw('investments.user_id,SUM(investments.amount) as total')->groupBy('investments.user_id');
       
    }
   
}
