<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function welcome(Request $request)
    {
        $user_id = Auth::user()->id;

        $data['balance']= \App\Helpers\AppHelper::instance()->getuserbalance($user_id);
        $data['userTransactions'] = \App\Helpers\AppHelper::instance()->getusertransaction($user_id, 5);
        $data['userTransactions'] = json_decode($data['userTransactions']);
        if ($request->ajax()) {
            return response()->json($data);
        } else {
            return view('welcome', $data);
        }

    }


}
