<?php

namespace App\Http\Controllers;
use Modules\Academics\Entities\{ProgramLevel, Department};
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Modules\Academics\Entities\Menu;
use Modules\Academics\Entities\RouteWeb;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function welcome(Request $request)
    {
        return view('welcome');
    }

    public function index(Request $request)
    {
        //dr. adnan food science hod
        //doa.
        //$user->getAllPermissions();
        //$this->authorize($request->route()->getName())

        //   dd($request->route()->getName());

        //abort_if(\Gate::denies($request->route()->getName()), 403);
        $users = User::with('roles')->orderBy('id', 'DESC')->get();
        return view('academics::pages.users.listing.user_role', compact('users'));
    }

    public function create()
    {
        $data['program_level'] = ProgramLevel::pluck('level_title', 'level_id');
        $data['department'] = Department::pluck('department_title', 'department_id');
        return view('academics::pages.users.manage.user_edit', $data);
    }

    public function store(Request $request)
    {
        User::create($request->all());
        $msg = 'Created Successfully';
        $notification = array(
            'message' => $msg,
            'alert-type' => 'success'
        );
        return redirect()->route('users.list')->with($notification);
    }

    public function edit(User $user)
    {
        $data['user'] = $user;
        $data['program_level'] = ProgramLevel::pluck('level_title', 'level_id');
        $data['department'] = Department::pluck('department_title', 'department_id');
        return view('academics::pages.users.manage.user_edit', $data);
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        $msg = 'Updated Successfully';
        $notification = array(
            'message' => $msg,
            'alert-type' => 'success'
        );
        return redirect()->route('users.list')->with($notification);
    }

    public function userRole(User $user)
    {
        $userRole = User::with('roles')->find($user->id);
        $roles = Role::with('users')->get();
        return view('academics::pages.users.manage.user_role', compact('user', 'roles', 'userRole'));
    }

    public function assignUserRole(Request $request, $user)
    {
        $user = User::findOrFail($user);
        $user->syncRoles($request->roles);

        $notification = array(
            'message' => 'Role Assined',
            'alert-type' => 'success'
        );

        return redirect()->route('users.list')->with($notification);
    }

    public function loginInstance(User $user)
    {
        $logged_in_user = Auth::user();
        \Session::put('previous_user', $logged_in_user);
        \Session::put('show_rollback_action', true);
        Auth::login($user);
        if (Auth::user()->hasRole('Welcome')) {
            return redirect()->intended('welcome');
        }
        return redirect()->route('academic.session');
    }

    public function loginRollBack(User $user)
    {
        \Session::forget('previous_user');
        \Session::put('show_rollback_action', false);
        Auth::login($user);
        return redirect()->route('academic.session');
    }

}
