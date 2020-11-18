<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SubscriberMail extends Notification {

    use Queueable;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $message) {

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
		$url = url('/');
        return (new MailMessage)
                        ->subject($this->subject)
                        ->line('Message : ' . $this->message)
						->action(config('app.domain'), url($url))
                        ->line('You are getting this message because you just subscribe to our dailly news offers!')
        ;
    }

}
