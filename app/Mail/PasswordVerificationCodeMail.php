<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordVerificationCodeMail extends Mailable
{
    use SerializesModels;

    /**
     * Create a new message instance.
     * @param $code Verification code
     * @return void
     */
    public function __construct($code)
    {
        //
        $this->code = $code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(__('auth.password_reset.email_subject'))->markdown('emails.password-reset-code',['Code' => $this->code]);
    }
}
