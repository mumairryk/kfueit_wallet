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

    public $uuid;
    /**
     * Create a new message instance.
     */
    public function __construct($uuid)
    {
        $this->uuid=$uuid;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        $data['uuid']=$this->uuid;
        return $this->view('auth.emails.forget-password-link',$data)
            ->subject('Your Forget Password');
    }
}

