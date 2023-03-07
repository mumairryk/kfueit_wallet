<?php

namespace App\Http\Controllers;
use App\Models\UserTypes;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Rules\CNICValidation;

class RegisterController extends Controller
{
   public function index(Request $request){

       if($request->post()){
           $request->validate([
               'name' => ['required', 'string', 'max:255'],
               'username' => ['required', 'string', 'max:255'],
               'phone_number' => ['required', 'max:11', 'unique:users,phone_number'],
               'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
               'cnic'=>['required',new CNICValidation],
               'password' => ['required', 'string', 'min:8'],
               'confirmed' => ['required', 'string', 'min:8', 'same:password'],

           ]);
           $data = $request->all();
          $check = $this->create($data);
         return redirect()->route('welcome')->with(['Success'=>'You have signed-in']);
       }
       $data['usertypes']=UserTypes::all();
       return view('auth.register',$data);
   }

    public function create(array $data)
    {
        $cnic = $data['cnic'];
        $student_data = DB::connection('mysql2')
            ->table('students')
            ->select('rfid')
            ->where('cnic', '=', $cnic)
            ->limit(1)
            ->get()
            ->toArray();

        if (!empty($student_data)) {
            $rfid = $student_data[0]->rfid;
        } else {
//             $employees_data = DB::connection('mysql2')
//                 ->table('mis_employees')
//                 ->select('rfid')
//                 ->where('cnic', '=', $cnic)
//                 ->limit(1)
//                 ->get()
//                 ->toArray();
//            if(!Empty($employees_data)){
//                $rfid=$employees_data[0]->rfid;
//            }
//            else{
//                $rfid=NULL;
//            }
            $rfid = NULL;
        }
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'username' => $data['username'],
            'phone_number' => $data['phone_number'],
            'cnic' => $data['cnic'],
            'rfid_no' => $rfid
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
