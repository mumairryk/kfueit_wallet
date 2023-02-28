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
        $data['userDebit'] = \App\Helpers\AppHelper::instance()->getDebit($user_id);
        $data['userCredit'] = \App\Helpers\AppHelper::instance()->getCredit($user_id);
        $data['userPendingChallah'] = \App\Helpers\AppHelper::instance()->getPendingChallah($user_id);
        $data['userPendingChallahData'] = \App\Helpers\AppHelper::instance()->getuserPendingChallah($user_id, 5);
        $data['userCreditData'] = \App\Helpers\AppHelper::instance()->getUserCredit($user_id, 5);
        $data['userTransactions'] = json_decode($data['userTransactions']);
        $data['userPendingChallahData'] = json_decode($data['userPendingChallahData']);
        $data['userCreditData'] = json_decode($data['userCreditData']);


        if ($request->ajax()) {
            return response()->json($data);
        } else {
            return view('welcome', $data);
        }

    }


}
