<?php

namespace App\Http\Controllers;
use App\Jobs\UserLoginJob;
use App\Models\{User,UserAuthCode};
use App\Services\UserService;
use Adldap\Laravel\Facades\Adldap;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Modules\Academics\Entities\Teacher;
use Modules\Academics\Entities\Menu;
use Modules\Academics\Events\UserCreated;
use App\Services\NotificationService;
use Carbon\Carbon;
class LoginController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {

        $this->userService = $userService;
    }

    public function auth(Request $request, User $user)
    {
        return view("auth.login");
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'exists:users,email'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        $response = User::where(['email'=>$request['email']])->first();

        $remember=($request->has('remember'))?true:false;
        if (Hash::check($request['password'],$response['password'])){
            \session()->put(['password'=>$request['password'],'email'=>$request['email'],'remember'=>$remember]);
            $otp= $this->generateOtp($response->phone_number)->code;
            $notification= new NotificationService();
            $notification->sendOTPViaEmail($response->email,$otp);
//            $notification->sendOTPViaSMS($response->phone_number,$otp);
            return view('auth.otp-verification');
        } else {
            return redirect()->back()->with('error', 'The provided credentials do not match our records.');
        }
    }

    public  function otpLogin(Request $request){
        if($request->post()){
        $request->validate([
            'otp' => ['required','exists:user_auth_codes,code']
        ]);
        //check if email exist
       $response = User::where(['email'=>\session('email')])->first();
        #Validation Logic
       $verificationCode   = UserAuthCode::where(['user_id'=> $response->id,'code'=>$request->otp])->first();
        $now = Carbon::now();
        if (!$verificationCode) {

            return redirect()->route('otp')->with('error', 'Your OTP is not correct');
        }elseif($verificationCode && $now->isAfter($verificationCode->expiry)){

            return redirect()->route('otp')->with('error', 'Your OTP has been expired');
        }
       $user = User::whereId($response->id)->first();
        if($user) {
            // Expire The OTP
            $verificationCode->update([
                'expiry' => Carbon::now()
            ]);
        }
        Auth::guard()->login($response,\session('remember'));
        Auth::shouldUse('auth');
        return redirect('welcome')->with('success', 'Login Successfully');
        }
        return view('auth.otp-verification');
    }

    public function generateOtp($phone_number)
    {
        $user = User::where('phone_number', $phone_number)->first();

        # User Does not Have Any Existing OTP
        $verificationCode = UserAuthCode::where('user_id', $user->id)->latest()->first();

        $now = Carbon::now();

        if($verificationCode && $now->isBefore($verificationCode->expiry)){
            return $verificationCode;
        }

        // Create a New OTP
        return UserAuthCode::create([
            'user_id' => $user->id,
            'code' => rand(123456, 999999),
            'expiry' => Carbon::now()->addMinutes(30)
        ]);
    }


    protected function redirectTo($request)
    {
        return route('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        Session::forget('course_record');
        Session::flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Logout Successfully');
    }

}
