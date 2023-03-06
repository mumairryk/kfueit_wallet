<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
class SendForgetPasswordLinkEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $encryptedEmail;
    public $password;
    /**
     * Create a new message instance.
     */
    public function __construct($encryptedEmail,$password)
    {
        $this->password=$password;
        $this->encryptedEmail=$encryptedEmail;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        $data['email']=$this->encryptedEmail;
        $data['password']=$this->password;
        return $this->view('auth.emails.forget-password-link',$data)
            ->subject('Your Forget Password');
    }
}

