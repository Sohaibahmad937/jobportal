<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Model\DeliveryChallan;
use App\Http\Model\DeliveryChallanItems;

use App\Http\Requests\API\DeliveryChallanRequest;
use App\Http\Requests\API\DeliveryChallanItemsRequest;

use Auth;

class DeliveryChallanAPIController extends Controller
{
    public function __construct(
        DeliveryChallan $DeliveryChallan,
        DeliveryChallanItems $DeliveryChallanItems
    )
    {
        $this->DeliveryChallan = $DeliveryChallan;
        $this->DeliveryChallanItems = $DeliveryChallanItems;
    }

    public function DeliveryChallanAPI_DCList(Request $request){
        $input = $request->all();
        $pro = $this->DeliveryChallan->DCList($input);
        return response()->json([
            'error' => false,
            'msg' => 'Success',
            'result_DeliveryChallanAPI_DCList' => $pro
        ]);
    }

    public function DeliveryChallanAPI_store(DeliveryChallanRequest $request)
    {
        $input = $request->all();
        $result = $this->DeliveryChallan->store($input);
        if(!empty($result)){
            $data_info = [
                'msg' => 'Success',
                'result_DeliveryChallanAPI_store' => $result,
                'error' => false
            ];
        }else{
            $data_info  = [
                'msg' => 'Error',
                'error' => true
            ];
        }
        return response()->json($data_info);
    }

    public function DeliveryChallanAPI_view($id)
    {
        $row = $this->DeliveryChallan->DC_detail($id);
        $pro = $this->DeliveryChallanItems->DC_Items($id,$row->po_id);
        $result['dc_header'] = $row;
        $result['dc_items'] = $pro;
        $data_info = [
            'msg' => 'Success',
            'result_DeliveryChallanAPI_edit' => $result,
            'error' => false
        ];
        return response()->json($data_info);
    }

    public function DeliveryChallanAPI_update(DeliveryChallanRequest $request, $id)
    {
        $input = $request->all();
        $result = $this->DeliveryChallan->updateDC($input,$id);
       
        if(!empty($result)){
            $data_info = [
                'msg' => 'Success',
                'error' => false
            ];
        }else{
            $data_info  = [
                'msg' => 'Error',
                'error' => true
            ];
        }
        return response()->json($data_info);
    }

    public function ProductsAutoCompleteForDC(Request $request){
        $input = $request->all();
        $pro = $this->DeliveryChallanItems->ProductsAutoCompleteForDC($input);
        $data_info = [
            'msg' => 'Success',
            'result_ProductsAutoCompleteForDC' => $pro,
            'error' => false
        ];
        return response()->json($data_info);
    }

    public function GetAllQty(Request $request){
        $input = $request->all();
        $result = $this->DeliveryChallanItems->GetAllQty($input);
        $data_info = [
            'msg' => 'Success',
            'result_GetAllQty' => $result,
            'error' => false
        ];
        return response()->json($data_info);
    }

    public function DeliveryChallanAPI_store_dc_item(DeliveryChallanItemsRequest $request){
        $input = $request->all();
        $result = $this->DeliveryChallanItems->store_dc_item($input);
        if(!empty($result)){
            $this->DeliveryChallanItems->Update_DC_Totals($input['dc_id']);
            $data_info = [
                'msg' => 'Success',
                'error' => false
            ];
        }else{
            $data_info = [
                'msg' => 'Error',
                'error' => true
            ];
        }

        return response()->json($data_info);
    }

    public function DeliveryChallanAPI_view_dc_items(Request $request,$id){
        $input = $request->all();
        $row = $this->DeliveryChallanItems->DC_Item_detail($id);
        $data_info = [
            'msg' => 'Success',
            'error' => false,
            'result_DeliveryChallanAPI_view_dc_items' => $row
        ];
        return response()->json($data_info);
    }

    public function DeliveryChallanAPI_update_dc_item(DeliveryChallanItemsRequest $request,$id){
        $input = $request->all();
        $result = $this->DeliveryChallanItems->update_dc_item($input,$id);
        if(!empty($result)){
            $this->DeliveryChallanItems->Update_DC_Totals($input['dc_id']);
            $data_info = [
                'msg' => 'Success',
                'error' => false
            ];
        }else{
            $data_info = [
                'msg' => 'Error',
                'error' => true
            ];
        }
        return response()->json($data_info);
    }

    public function DeliveryChallanAPI_delete_dc_item($id,$dc_id){
        $result = $this->DeliveryChallanItems->delete_dc_item($id,$dc_id);
        if(!empty($result)){
            $this->DeliveryChallanItems->Update_DC_Totals($dc_id);
            $data_info = [
                'msg' => 'Success',
                'error' => false
            ];
        }else{
            $data_info = [
                'msg' => 'Error',
                'error' => true
            ];
        }

        return response()->json($data_info);
    }

    public function ReceivedDCList(Request $request){
        $input = $request->all();
       
        $pro = $this->DeliveryChallan->ReceivedDCList($input);
        return response()->json([
            'error' => false,
            'msg' => 'Success',
            'result_ReceivedDCList' => $pro
        ]);
    }
}
