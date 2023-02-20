<?php

namespace App\Http\Controllers;
use App\Models\UserTypes;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
   public function index(Request $request){
       if($request->post()){
           $request->validate([
               'name' => ['required', 'string', 'max:255'],
               'username' => ['required', 'string', 'max:255'],
               'phone_number' => ['required', 'max:12','unique:users,phone_number'],
               'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
               'password' => ['required', 'string', 'min:8'],
               'confirmed' => ['required', 'string', 'min:8','same:password'],
               'user_type_id' => ['required', 'integer'],
           ]);

           $data = $request->all();
           $check = $this->create($data);
           return redirect()->route('welcome')->withSuccess('You have signed-in');
       }
       $data['usertypes']=UserTypes::all();
       return view('auth.register',$data);
   }

    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'username'=>$data['username'],
            'phone_number'=>$data['phone_number'],
            'user_type_id'=>$data['user_type_id']
        ]);
    }

    public function dashboard()
    {
        if(Auth::check()){
            return view('welcome');
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }
}
