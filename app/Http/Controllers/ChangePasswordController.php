<?php

namespace App\Http\Controllers;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{

    public function changePassword(){
        return view('profile.change-password');
    }

    public function passwordUpdate(ChangePasswordRequest $request){
       $record=User::findOrFail(Auth::user()->id);
        $record->update([
            'password'=>Hash::make($request['newpassword'])
        ]);
        session()->flash('success','Update Password Successfully');
        return redirect()->back();
    }
}
