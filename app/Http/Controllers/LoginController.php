<?php

namespace App\Http\Controllers;
use App\Jobs\UserLoginJob;
use App\Models\User;
use App\Services\UserService;
use Adldap\Laravel\Facades\Adldap;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Session;
use Modules\Academics\Entities\Teacher;
use Modules\Academics\Entities\Menu;
use Modules\Academics\Events\UserCreated;
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

    public function authenticate(LoginRequest $request)
    {
        $response = $this->userService->verification($request);

        if ($response) {
             $this->dispatch(new UserLoginJob(Auth::user()));
            if (Auth::user()->hasRole('Welcome')) {
                return redirect()->intended('welcome');
            }
            return redirect()->route('academic.session');
        } else {
            return redirect()->back()->with('error', 'Fail to login! Try Again');
        }
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
