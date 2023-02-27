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

class AuthController extends BaseController
{
    public function signin(Request $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $authUser = Auth::user();
            $success['token'] = $authUser->createToken('MyAuthApp')->plainTextToken;
            $success['name'] = $authUser->name;
            $otp = app('App\Http\Controllers\LoginController')->generateOtp($authUser->phone_number)->code;
            $notification = new NotificationService();
            $notification->sendOTPViaEmail($authUser->email, $otp);
            return $this->sendResponse($success, 'User signed in');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }

    public function check_otp(Request $request)
    {

        if ($request->post()) {

//            $request->validate([
//                'otp' => ['required','exists:user_auth_codes,code']
//            ]);
            $input = $request->all();

            $validator = Validator::make($input, [
                'otp' => ['required', 'exists:user_auth_codes,code'],
                'email' => 'required|email'

            ]);
            if ($validator->fails()) {
                return $this->sendError($validator->errors());
            }
            $email_check = $input['email'];
            //check if email exist
            $response = User::where(['email' => $email_check])->first();

            #Validation Logic
            $verificationCode = UserAuthCode::where(['user_id' => $response->id, 'code' => $request->otp])->first();
            $now = Carbon::now();
            if (!$verificationCode) {

                return $this->sendError('Unauthorised.', ['error' => 'Wrong OTP']);
            } elseif ($verificationCode && $now->isAfter($verificationCode->expiry)) {
                return $this->sendError('Unauthorised.', ['error' => 'Your OTP has been expired']);

            }
            $user = User::whereId($response->id)->first();
            if ($user) {
                // Expire The OTP
                $verificationCode->update([
                    'expiry' => Carbon::now()
                ]);
            }
            $success['name'] = $user->name;
            return $this->sendResponse($success, 'Verify.');
        }

    }

    public function gettoken(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $authUser = Auth::user();
            $success['token'] = $authUser->createToken('MyAuthApp')->plainTextToken;
            unset($authUser['password']);
            $success['user_detail'] = $authUser;
            return $this->sendResponse($success, 'success');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }


}
