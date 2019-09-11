<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ForgotPassword extends Mailable
{
    use Queueable, SerializesModels;
    public $forgot;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($forgot)
    {
        $this->forgot = $forgot;
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
        $subject = 'Forget password mail';
        $email = $this->from($from, $name)->subject($subject)->view('emails.api.forgot_password', compact('forgot'));
        return $email;
    }
}
