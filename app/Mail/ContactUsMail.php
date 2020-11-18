<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ContactUsMail extends Notification 
{
    use Queueable;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     public function __construct($subject, $name, $email,$message) {
        $this->name = $name;
        $this->email = $email;
        $this->message = $message;
        $this->subject = $subject;
    }

    public function via($notifiable) {
        return ['mail'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function toMail($notifiable) {
        return (new MailMessage)
                        ->subject($this->subject)
                        ->line($this->name . ' Contacted You')
                        ->line('Email : ' . $this->email)
                        ->line('Message : ' . $this->message)
                        ->line('You are getting this message because you are the owner of this site!')
        ;
    }

}
