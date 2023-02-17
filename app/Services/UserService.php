<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;
use Illuminate\Session\SessionManager;
use Modules\Academics\Entities\Menu;
use Modules\Academics\Events\UserCreated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserService
{

    protected $session;
    protected $instance;

    /**
     * Constructs a new user object.
     *
     * @param Illuminate\Session\SessionManager $session
     */
    public function __construct(SessionManager $session)
    {
        $this->session = $session;
    }

    public function verification(Request $request)
    {
        $session_data = array();
        $logged_in = false;
        $user_role = '';
        $user_id = '';

        $user_id = $request->username;
        $password = $request->validated()['password'];

        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        $remember = $request->get('remember');
        $credentials += ['active' => 1];

        $response = Http::get('https://password.kfueit.edu.pk/home/mykfueit_auth', [
            'username' => $request->validated()['username'],
            'password' => $request->validated()['password'],
        ])->json();
        //dd($response);
        if ($response['status'] == false || str_contains($response['data']['group_role'], 'students')) {
            return false;
        } else {
            $cba_user = Menu::where(['user_id' => $request->username])->get(['user_id', 'user_name', 'role_id', 'external_id']);
            if ($cba_user->isEmpty()) {
                $cba_user = Menu::where(['external_id' => $request->username])->get(['user_id', 'user_name', 'role_id', 'external_id']);
                if ($cba_user->isEmpty()) {
                    $user_role = 'Welcome';
                }
            }
            if ($cba_user->isNotEmpty()) {
                $user_role = strtolower(@$cba_user[0]->role_id);
                $user_id = strtolower(@$cba_user[0]->user_id);

                if (empty($user_id))
                    $user_id = strtolower(@$cba_user[0]->external_id);
                if (empty($user_id))
                    return false;
            }
            if (is_null($user_id) || $user_id == '') {
                $user_id = $request->validated()['username'];
            }
            $user = User::where('username', $user_id)->first();
            if (!$user) {
                if ($user_role == '') {
                    $user_role = 'Welcome';
                }
                DB::table('users')->insertOrIgnore(
                    [
                        'name' => $response['data']['fullname'],
                        'username' => $request->validated()['username'],
                        'email' => $request->validated()['username'] . "@kfueit.edu.pk",
                        'password' => Hash::make($request->validated()['password']),
                        'role_id' => $user_role,
                        'user_id' => $user_id,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                        'last_login' => date('Y-m-d H:i:s'),
                    ]);
                $user = User::where('user_id', $user_id)->first();
                if ($user_role == 'global') {
                    $user->assignRole('Super Admin');
                } else {
                    $user->assignRole($user_role);
                }
            } else {
                User::where('user_id', $user_id)->update(['password' => Hash::make($request->validated()['password']), 'last_login' => date('Y-m-d H:i:s')]);
            }
            if (empty($user->user_id)) {
                $user->update(['user_id' => $user_id, 'last_login' => date('Y-m-d H:i:s'),]);
            }
        }
        if (Auth::attempt(['user_id' => $user_id, 'password' => $password, 'active' => 1])) {
            $request->session()->regenerate();
            return redirect()->intended('academicsession');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

}
