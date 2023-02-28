<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class AppHelper
{
    public static function instance()
    {
        return new AppHelper();
    }

    public function getusertransaction($user_id, $limit)
    {
        if ($limit != 1) {

            $userTransactions = DB::table('user_transaction as ut')
                ->leftJoin('user_transaction_detail as utd', 'utd.user_transaction_id', '=', 'ut.id')
                ->leftJoin('services_detail as sd', 'sd.id', '=', 'ut.service_id')
                ->leftJoin('service_type as st', function ($join) {
                    $join->on('st.id', '=', 'sd.service_type')
                        ->where('st.status', '=', 1);
                })
                ->select('ut.id', 'st.desc as service_desc', 'sd.desc', 'ut.debit', 'ut.credit', 'ut.created_at')
                ->where('ut.user_id', '=', $user_id)
                ->where('ut.is_approved', '=', 1)
                ->orderBy('ut.created_at', 'desc')
                ->limit($limit)
                ->get();

            return "$userTransactions";
        } else {

            $userTransactions = DB::table('user_transaction as ut')
                ->leftJoin('user_transaction_detail as utd', 'utd.user_transaction_id', '=', 'ut.id')
                ->leftJoin('services_detail as sd', 'sd.id', '=', 'ut.service_id')
                ->leftJoin('service_type as st', function ($join) {
                    $join->on('st.id', '=', 'sd.service_type')
                        ->where('st.status', '=', 1);
                })
                ->select('ut.id', 'st.desc as service_desc', 'sd.desc', 'ut.debit', 'ut.credit', 'ut.created_at')
                ->where('ut.user_id', '=', $user_id)
                ->where('ut.is_approved', '=', 1)
                ->orderBy('ut.created_at', 'desc')
                ->get();
            return "$userTransactions";

        }
    }
    public function getuserPendingChallah($user_id, $limit)
    {
        if ($limit != 1) {

            $userTransactions = DB::table('user_transaction as ut')
                ->leftJoin('user_transaction_detail as utd', 'utd.user_transaction_id', '=', 'ut.id')
                ->leftJoin('services_detail as sd', 'sd.id', '=', 'ut.service_id')
                ->leftJoin('service_type as st', function ($join) {
                    $join->on('st.id', '=', 'sd.service_type')
                        ->where('st.status', '=', 1);
                })
                ->select('ut.id', 'st.desc as service_desc', 'sd.desc', 'ut.debit', 'ut.credit', 'ut.created_at')
                ->where('ut.user_id', '=', $user_id)
                ->where('ut.is_approved', '=', 0)
                ->orderBy('ut.created_at', 'desc')
                ->limit($limit)
                ->get();

            return "$userTransactions";
        } else {

            $userTransactions = DB::table('user_transaction as ut')
                ->leftJoin('user_transaction_detail as utd', 'utd.user_transaction_id', '=', 'ut.id')
                ->leftJoin('services_detail as sd', 'sd.id', '=', 'ut.service_id')
                ->leftJoin('service_type as st', function ($join) {
                    $join->on('st.id', '=', 'sd.service_type')
                        ->where('st.status', '=', 1);
                })
                ->select('ut.id', 'st.desc as service_desc', 'sd.desc', 'ut.debit', 'ut.credit', 'ut.created_at')
                ->where('ut.user_id', '=', $user_id)
                ->where('ut.is_approved', '=', 0)
                ->orderBy('ut.created_at', 'desc')
                ->get();
            return "$userTransactions";

        }
    }

    public function add_transaction_detail_helper($user_id, $service_id, $t_amount, $remarks, $qty, $head_id)
    {
        //echo "$user_id,$service_id,$t_amount,$remarks,$qty,$head_id";exit;
        $get_current_user_balance = $this->getuserbalance($user_id);
        if ($get_current_user_balance > $t_amount) {
            DB::beginTransaction();

            try {
                $user_transaction_id = DB::table('user_transaction')->insertGetId(
                    ['user_id' => $user_id,
                        'service_id' => $service_id,
                        'debit' => 0,
                        'credit' => $t_amount,
                        'is_approved' => 1,
                        'remarks' => $remarks,
                        'status' => 1,
                        'created_at' => Carbon::now()
                    ]
                );

                $head_amount = ((int)$t_amount) / ((int)$qty);
                $user_transaction_id = DB::table('user_transaction_detail')->insertGetId(
                    ['user_transaction_id' => $user_transaction_id,

                        'head_id' => $head_id,
                        'head_amount' => $head_amount,
                        'qty' => $qty,
                        'status' => '1',
                        'created_at' => Carbon::now()
                    ]
                );


                DB::commit();
                return "s";
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }

        } else {
            return "lb";
        }
    }

    public function getuserbalance($user_id)
    {
        $balance = DB::selectOne(
            "SELECT (
        (SELECT SUM(debit) FROM user_transaction WHERE is_approved = ? AND user_id = ? AND status = ?)
        - COALESCE((SELECT SUM(credit) FROM user_transaction WHERE user_id = ? AND status = ?), 0)
    ) AS balance",
            [1, $user_id, 1, $user_id, 1]
        )->balance;
        return "$balance";
    }

    public function getDebit($user_id){
      return   DB::table('user_transaction')
            ->selectRaw('debit')
            ->where('is_approved', '=', 1)
            ->where('user_id', '=', $user_id)
            ->where('status', '=', 1)
            ->sum('debit');
    }
    public function getCredit($user_id){
      return   DB::table('user_transaction')
            ->selectRaw('credit')
            ->where('user_id', '=', $user_id)
            ->where('status', '=', 1)
            ->sum('credit');
    }
    public function getPendingChallah($user_id){
      return   DB::table('user_transaction')
            ->selectRaw('debit')
          ->where('is_approved', '=', 0)
            ->where('user_id', '=', $user_id)
            ->where('status', '=', 1)
            ->sum('debit');
    }

    public function getUserCredit($user_id,$limit){
        if ($limit != 1) {
            return DB::table('user_transaction as ut')
                ->select('ut.id', 'st.desc as service_desc', 'sd.desc', 'ut.credit', 'ut.created_at')
                ->join('user_transaction_detail as utd', 'utd.user_transaction_id', '=', 'ut.id')
                ->join('services_detail as sd', 'sd.id', '=', 'ut.service_id')
                ->join('service_type as st', function ($join) {
                    $join->on('st.id', '=', 'sd.service_type')
                        ->where('st.status', '=', 1);
                })
                ->where('ut.user_id', '=', $user_id)
                ->where('ut.is_approved', '=', 1)
                ->orderBy('ut.created_at', 'desc')
                ->limit($limit)
                ->get();
        }else{
            return DB::table('user_transaction as ut')
                ->select('ut.id', 'st.desc as service_desc', 'sd.desc', 'ut.credit', 'ut.created_at')
                ->join('user_transaction_detail as utd', 'utd.user_transaction_id', '=', 'ut.id')
                ->join('services_detail as sd', 'sd.id', '=', 'ut.service_id')
                ->join('service_type as st', function ($join) {
                    $join->on('st.id', '=', 'sd.service_type')
                        ->where('st.status', '=', 1);
                })
                ->where('ut.user_id', '=', $user_id)
                ->where('ut.is_approved', '=', 1)
                ->orderBy('ut.created_at', 'desc')
                ->get();
        }
    }
}
