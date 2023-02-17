<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Auth;

class StudentServices
{
    private $transcript_api_url="https://my.kfueit.edu.pk/Services/Students/transcript";
    protected $session;
    protected $instance;
    public function transript($regNumber,$student_id,$created_time)
    {
        $response = Http::get($this->transcript_api_url, [
            'regNumber' => $regNumber,
            'key' => $created_time,
//            'key'=>md5($student_id.$created_time),
            'debug' => 0
        ])->json();
        return $response;
    }
}
