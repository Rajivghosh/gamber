<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateAccount extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
         $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $name = 'GAMEBAR';
        $from = 'testdevloper007@gmail.com';
        $subject = 'Account Created Successfully';
        $email = $this->from($from, $name)->subject($subject)->view('emails.api.email_create_account_mail', compact('user'));
        return $email;
    }
}
