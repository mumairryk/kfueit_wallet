<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
   public function index(Request $request){
       if($request->post()){
           return 'helo';
       }
       return view('auth.register');
   }
}
