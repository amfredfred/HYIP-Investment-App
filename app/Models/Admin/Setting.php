<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model {

    public $table = 'settings';

    protected $fillable = [
        'site_name', 'site_url', 'site_phone', 'site_email', 'site_phone', 'send_notify_email', 'address', 'site_code', 'logo', 'favicon', 'location',
        'copy_right', 'withdraw_charge', 'investment_payment_mode', 'email_body', 'block_io_pin', 'auto_withdraw', 'video_1', 'video_2', 'img_login_register'
    ];

}
