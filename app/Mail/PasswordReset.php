<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PasswordReset extends Mailable
{
    use Queueable, SerializesModels;

    public $user_mail;
    public $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_mail, $token)
    {
        $this->user_mail = $user_mail;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Resetare parola')->from('facultatea.de.informatica.tml@gmail.com')->view('emails.reset')->with(['user_mail' => $this->user_mail, 'token' => $this->token ]);
    }
}
