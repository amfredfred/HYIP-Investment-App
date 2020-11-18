<?php

namespace App\TraitsFolder;


use App\Models\Admin\Setting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

trait MailTrait
{
    public function sendMail($email,$name,$subject,$text){
        $basic = Setting::whereId(1)->first();
        $body = $basic->email_body;
        $mail_val = [
            'email' => $email,
            'name' => $name,
            'g_email' => $basic->send_notify_email,
            'g_title' => $basic->site_name,
            'subject' => $subject,
        ];
        Config::set('mail.driver','mail');
        Config::set('mail.from',$basic->send_notify_email);
        Config::set('mail.name',$basic->site_name);

        $body = $basic->email_body;
        $body = str_replace("{{name}}",$name,$body);
        $body = str_replace("{{message}}",$text,$body);

        Mail::send('emails.email', ['body'=>$body], function ($m) use ($mail_val) {
            $m->from($mail_val['g_email'], $mail_val['g_title']);
            $m->to($mail_val['email'], $mail_val['name'])->subject($mail_val['subject']);
        });

    }
   
}