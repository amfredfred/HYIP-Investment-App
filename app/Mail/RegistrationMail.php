<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegistrationMail extends Mailable {

    use Queueable;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $subject, $type) {
        $this->user = $user;
        $this->subject = $subject;
        $this->type = $type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->view('emails.register')->subject($this->subject)->with([
                    'user' => $this->user,
                    'type' => $this->type
        ]);
    }

}
