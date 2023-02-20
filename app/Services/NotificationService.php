<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOTPEmail;
class NotificationService
{
    public function sendOTPViaEmail($email, $otp)
    {
       return Mail::to($email)->send(new SendOTPEmail($otp));
    }
    public function sendOTPViaSMS($phoneNo,$opt)
    {

    }
}
