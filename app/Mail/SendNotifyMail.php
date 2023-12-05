<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Admin\Setting;

class SendNotifyMail extends Notification {

    use Queueable;

    public $message;
    public $greeting;
    public $subject;

    /**
    * Create a new message instance.
    *
    * @return void
    */

    public function __construct( $greeting, $subject, $message ) {
        $this->message = $message;
        $this->subject = $subject;
        $this->greeting = $greeting;
    }

    public function via( $notifiable ) {
        return [ 'mail' ];
    }

    /**
    * Build the message.
    *
    * @return $this
    */

    public function toMail( $notifiable ) {

        return ( new MailMessage )
        ->greeting( $this->greeting )
        ->subject( $this->subject )
        ->line( $this->message )
        ;
    }

}
