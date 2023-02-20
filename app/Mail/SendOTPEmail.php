<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendOTPEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $otp_code;
    /**
     * Create a new message instance.
     */
    public function __construct($otp_code)
    {
        $this->otp_code=$otp_code;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        $data['otp']=$this->otp_code;
        return $this->view('auth.emails.otp',$data)
            ->subject('Your OTP Code');
    }
}
