<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailVerificationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $emailVerify;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($emailVerify)
    {
        $this->emailVerify = $emailVerify;
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
        $subject = 'Email Verification mail';
        $email = $this->from($from, $name)->subject($subject)->view('emails.api.email_verification_mail', compact('emailVerify'));
        return $email;
        
    }
}
