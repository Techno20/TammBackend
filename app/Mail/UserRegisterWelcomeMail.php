<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRegisterWelcomeMail extends Mailable
{
    use SerializesModels;

    /**
     * Create a new message instance.
     * @param $User
     * @return void
     */
    public function __construct($User)
    {
        //
        $this->User = $User;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(__('auth.register_welcome',['name' => $this->User->name]))->markdown('emails.user-register-welcome',['User' => $this->User]);
    }
}
