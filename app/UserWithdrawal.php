<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserWithdrawal extends Model {

    protected $fillable = [
        'plan_id', 'user_id', 'coin_id', 'amount', 'type', 'status'
    ];

}
