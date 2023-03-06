<?php

namespace App\Http\Controllers;

use App\Models\GenerateChallan;
use Carbon\Carbon;
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

    public function get_user_history()
    {
        $user_id = Auth::user()->id;
        $userTransactions = \App\Helpers\AppHelper::instance()->getusertransaction($user_id, 1);
        $userTransactions = json_decode($userTransactions);
        return view('customize.getusertransaction', compact('userTransactions'));


        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->post()) {

            $request->validate([
                'amount' => 'required|numeric'
            ]);

            $user_id = Auth::user()->id;
            $lastrecordinserted = GenerateChallan::create([
                'user_id' => $user_id,
                'service_id' => 0,
                'debit' => $request['amount'],
                'credit' => 0,
                'is_approved' => 0,
                'remarks' => 'BANK',
                'status' => 1
            ]);
            return $this->download_challan($lastrecordinserted->id);
            //return $lastrecordinserted;
//            $transaction_data = GenerateChallan::with('getuserdata')->where('id', $lastrecordinserted->id)->first();
//            $data = $transaction_data->toArray();
//            // return $transaction_data;
//            //$transaction_data= GenerateChallan::with('getuserdata')->get();
//            return view('customize.challanview', compact('data'));
        }
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(array $data)
    {


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


    public function download_challan($challanID)
    {
        $voucher=$this->post_voucher($challanID);
        $file_path=public_path("uploads/challan/{$challanID}_challan.pdf");
        $data=json_decode($voucher);

        //echo $data->voucher_link; exit;
        //print_r($data);exit;
        $url= $data->voucher_link;

        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );

        $v_file= file_get_contents($url, false, stream_context_create($arrContextOptions));


        //var_dump($v_file); exit;
        file_put_contents($file_path,$v_file);
        $this->file_download($file_path,"{$challanID}_challan.pdf",true);
    }
    public function post_voucher($challanID)
    {
        $generateChallanData = GenerateChallan::findOrFail($challanID);
        $voucher_details['Digital Wallet Top-up'] =  $generateChallanData->debit;
        $userData = $generateChallanData->user;
        $parameter= array(
            'token'=>'53JFU#72Vend',
            'cnic'=>$userData->cnic,
            'app_code'=>'KFDW',
            'voucher_type_code'=>'KFDW01',
            'ref_id'=>'',
            'name'=>$userData->name,
            'year'=>date('Y'),
            'semester'=>date('m')>6?1:2,
            'app_no'=>$generateChallanData->id,
            'due_date'=>Carbon::now()->addDays(2)->format('Y-m-d'),
            'expiry_date'=>Carbon::now()->addDays(2)->format('Y-m-d'),
            'voucher_particulars'=>json_encode($voucher_details),
            'is_json'=>true
        );
        //print_r($parameter);exit;
        $response = $this->sendPostRequest('https://admissions.kfueit.edu.pk/account_book/service/get_voucher/',$parameter);

        return $response;
    }

    function sendPostRequest($url,$_param=array())
    {
        try {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $url,
                CURLOPT_USERAGENT => 'Codular Sample cURL Request',
                CURLOPT_POST => 1,
                CURLOPT_POSTFIELDS => $_param,
                CURLOPT_SSL_VERIFYPEER=>false
            ));

            $output = curl_exec($curl);
            if ($output === false) {
                throw new Exception(curl_error($curl), curl_errno($curl));

            }
        } catch(Exception $e) {

            trigger_error(sprintf(
                'Curl failed with error #%d: %s',
                $e->getCode(), $e->getMessage()),
                E_USER_ERROR);

        }
        return $output;
    }
    function file_download($full_file_path,$download_file_name=null,$unlink_file_after_download=false)
    {
        if($download_file_name==null)
        {
            $download_file_name=public_path(parse_url($full_file_path, PHP_URL_PATH));
        }

        if(file_exists($full_file_path))// avoid infinite loop in case of no such file
        {
            $size=filesize($full_file_path);
            header('Content-Length: ' . $size);
            header("Content-Disposition: attachment; filename=$download_file_name");
            header("Content-Type: application/force-download");
            header("Content-Type: application/octet-stream");
            header("Content-Type: application/download");
            header("Content-Description: File Transfer");
            flush(); // this doesn't really matter.

            $fp = fopen($full_file_path, "r");
            while (!feof($fp))
            {
                echo fread($fp, 65536);
                flush(); // this is essential for large downloads
            }
            fclose($fp);
        }

        if($unlink_file_after_download)
        {
            @unlink($full_file_path);
        }
        exit;

    }
}
