<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\CreditLatterRequest;
use App\Http\Requests\Admin\CreditLatterRequestRequest;
use Auth;
class CreditLatterAPIController extends Controller
{
    public function __construct(CreditLatterRequest $CreditLatterRequest){
        $this->CreditLatterRequest = $CreditLatterRequest;
    }

    public function CreditLetterRequestList(){
        $res = $this->CreditLatterRequest->CreditLetterRequestList();
        return response()->json([
            'error' => false,
            'msg' => 'success',
            'result_CreditLetterRequestList' => $res
        ]);
    }

    public function StoreCreditLetterRequest(CreditLatterRequestRequest $request)
    {
        $input = $request->all();
        
        $data = [
            'user_id' => $input['user_id'],
            'days' => $input['days'],
            'limit' => $input['limit'],
            'created_by' => Auth::user()->id
        ];
        $result = $this->CreditLatterRequest::create($data);
        if($result){
            $data_info = [
                'msg' => 'Success',
                'error' => false
            ];
        }else{
            $data_info = [
                'msg' => 'Something wend wrong',
                'error' => true
            ];
        }
        return response()->json($data_info);
    }

    public function DestroyCreditLetterRequest($id)
    {
        $result = $this->CreditLatterRequest::where('id',$id)->delete();
        if($result){
            $data_info = [
                'error' => false,
                'msg' => 'Success'
            ];
        }else{
            $data_info = [
                'error' => true,
                'msg' => 'Something went wrong'
            ];
        }

        return response()->json($data_info);
    }
}
