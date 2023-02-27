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
        $balance = \App\Helpers\AppHelper::instance()->getuserbalance($user_id);
        $userTransactions = \App\Helpers\AppHelper::instance()->getusertransaction($user_id, 5);
        $userTransactions = json_decode($userTransactions);
        //echo "<pre>";print_r($userTransactions);
        if ($request->ajax()) {
            return response()->json($balance);
        } else {
            return view('welcome', compact('balance', 'userTransactions'));
        }

    }


}
