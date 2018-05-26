<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AccountConfirm extends Mailable
{
    use Queueable, SerializesModels;

    private $token;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('facultatea.de.informatica.tml@gmail.com')->subject('Confirmare profil')->view('emails.confirm')->with(['token' => $this->token]);
    }
}
