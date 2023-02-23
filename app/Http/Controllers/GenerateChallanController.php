<?php

namespace App\Http\Controllers;

use App\Models\GenerateChallan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GenerateChallanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        $emp_code=Auth::user()->user_info;
//        $emp_data  = DB::connection('mysql2')->table('mis_employees')->where(['emp_no'=>$emp_code])->first();
//       //dd($emp_data);
//        if(Auth::user()->user_type_id==1){
//           return view('customize.createchallan',compact('emp_data'));
//       }
//       else{
//           echo "2";exit;
//       }
        return view('customize.createchallan');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->post()) {

            $request->validate([
                'amount' => ['required']
            ]);

            $user_id = Auth::user()->id;
            $lastrecordinserted = GenerateChallan::create([
                'user_id' => $user_id,
                'service_id' => 1,
                'debit' => $request['amount'],
                'is_approved' => 0,
                'remarks' => 'test',
                'status' => 1
            ]);
            //return $lastrecordinserted;
            $transaction_data = GenerateChallan::with('getuserdata')->where('id', $lastrecordinserted->id)->first();
            $data = $transaction_data->toArray();
            // return $transaction_data;
            //$transaction_data= GenerateChallan::with('getuserdata')->get();
            return view('customize.challanview', compact('data'));
        }
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(array $data)
    {

        return $lastrecordinserted;


    }

    /**
     * Display the specified resource.
     */
    public function show(GenerateChallan $generateChallan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GenerateChallan $generateChallan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GenerateChallan $generateChallan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GenerateChallan $generateChallan)
    {
        //
    }
}
