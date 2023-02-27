<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Models\User;
use App\Services\NotificationService;
use App\Models\{UserAuthCode};
use Carbon\Carbon;

class UserData extends BaseController
{
    public function getsum(Request $request)
    {
        if ($request->post()) {

            $input = $request->all();
            $validator = Validator::make($input, [
                'user_id' => ['required']
            ]);
            if ($validator->fails()) {
                return $this->sendError($validator->errors());
            }
            $user_id = $input['user_id'];

            $balance = \App\Helpers\AppHelper::instance()->getuserbalance($user_id);
            $success['balance'] = $balance;
            return $this->sendResponse($success, 'success.');
        } else {
            return $this->sendError('Unauthorised.', ['error_code' => '100', 'error' => 'please send user id']);
        }

    }

    public function getusertransaction(Request $request)
    {
        if ($request->post()) {

            $input = $request->all();
            $validator = Validator::make($input, [
                'user_id' => ['required']
            ]);
            if ($validator->fails()) {
                return $this->sendError($validator->errors());
            }
            $user_id = $input['user_id'];

            $userTransactions = \App\Helpers\AppHelper::instance()->getusertransaction($user_id, 1);
            $success['userTransactions'] = $userTransactions;
            return $this->sendResponse($success, 'success.');
        } else {
            return $this->sendError('Unauthorised.', ['error_code' => '100', 'error' => 'please send user id']);
        }
    }

    public function add_transaction_detail(Request $request)
    {
        if ($request->post()) {

            $input = $request->all();
            $validator = Validator::make($input, [
                'service_id' => ['required|numeric|gt:0'],
                't_amount' => ['required|numeric|gt:0'],
                'qty' => ['required|numeric|gt:0'],
                'head_id' => ['required|numeric|gt:0'],
                'remarks' => ['required|string|max:255']
            ]);

            $user_id = $input['user_id'];
            $service_id = $input['service_id'];
            $t_amount = $input['t_amount'];
            $qty = $input['qty'];
            $remarks = $input['remarks'];
            $head_id = $input['head_id'];
            $is_transaction_detail_added = \App\Helpers\AppHelper::instance()->add_transaction_detail_helper(
                $user_id, $service_id, $t_amount, $remarks, $qty, $head_id);
            if ($is_transaction_detail_added == 's') {
                $success['transaction_detail'] = 'success';
                return $this->sendResponse($success, 'success');
            } elseif ($is_transaction_detail_added == 'lb') {
                return $this->sendError('low balance.', ['error' => 'low balance']);
            }
        }
    }

}
