<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Model\PurchaseOrder;
use App\Http\Model\PurchaseOrderItems;
use App\Http\Model\PurchaseOrderTransporters;
use App\Http\Model\Unit;

use App\Http\Requests\API\PurchaseOrderRequest;
use App\Http\Requests\API\PurchaseOrderItemsRequest;

use Auth;
use DB;

class PurchaseOrderAPIController extends Controller
{
    public function __construct(
        PurchaseOrder $PurchaseOrder,
        PurchaseOrderItems $PurchaseOrderItems,
        PurchaseOrderTransporters $PurchaseOrderTransporters,
        Unit $Unit
    )
    {
        $this->PurchaseOrder = $PurchaseOrder;
        $this->Unit = $Unit;
        $this->PurchaseOrderItems = $PurchaseOrderItems;
        $this->PurchaseOrderTransporters = $PurchaseOrderTransporters;
    }

    public function PurchaseOrderAPI_POList(Request $request){
        $input = $request->all();
        $pro = $this->PurchaseOrder->POList($input);
        return response()->json([
            'error' => false,
            'msg' => 'Success',
            'result_PurchaseOrderAPI_POList' => $pro
        ]);
    }

    public function ReceivePOAutoComplete(Request $request){
        $input = $request->all();
        $result = $this->PurchaseOrder->ReceivePOAutoComplete($input);
        return response()->json([
            'error' => false,
            'msg' => 'Success',
            'result_ReceivePOAutoComplete' => $result
        ]);
    }
    public function PurchaseOrderAPI_store(PurchaseOrderRequest $request)
    {
        $input = $request->all();
        $result = $this->PurchaseOrder->po_store_api($input);
        if(!empty($result)){
            $data_info = [
                'msg' => 'Success',
                'result_PurchaseOrderAPI_store' => $result,
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

    public function PurchaseOrderAPI_show($id)
    {
        $row = $this->PurchaseOrder->GetPODetail($id);
        $pro = $this->PurchaseOrderItems->PO_Items($id);
        $result['po_header'] = $row;
        $result['po_items'] = $pro;

        return response()->json([
            'error' => false,
            'msg' => 'Success',
            'result_PurchaseOrderAPI_show' => $result
        ]);

    }

    public function PurchaseOrderAPI_update(PurchaseOrderRequest $request, $id)
    {
        $input = $request->all();
        $result = $this->PurchaseOrder->po_update($input,$id);
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

    public function ProductsAutoCompleteForPO(Request $request){
        $input = $request->all();
        $pro = $this->PurchaseOrderItems->ProductsAutoCompleteForPO($input);
        return response()->json([
            'error' => false,
            'msg' => 'Success',
            'result_ProductsAutoCompleteForPO' => $pro
        ]);
    }

    public function GetProInfo(Request $request){
        $input = $request->all();
        $pro = $this->PurchaseOrderItems->GetProInfo($input);
        return response()->json([
            'error' => false,
            'msg' => 'Success',
            'result_GetProInfo' => $pro
        ]);
    }

    public function PurchaseOrderAPI_store_po_item(PurchaseOrderItemsRequest $request){
        $input = $request->all();
        $result = $this->PurchaseOrderItems->store_po_item($input);
        if(!empty($result)){
            $this->PurchaseOrderItems->Update_PO_Totals($input['po_id']);
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

    public function PurchaseOrderAPI_view_po_items(Request $request,$id){
        $input = $request->all();
        $row = $this->PurchaseOrderItems->PO_Item_detail($id);
        $data_info = [
            'msg' => 'Success',
            'error' => false,
            'result_PurchaseOrderAPI_view_po_items' => $row
        ];
        return response()->json($data_info);
    }

    public function PurchaseOrderAPI_update_po_item(PurchaseOrderItemsRequest $request,$id){
        $input = $request->all();
        $result = $this->PurchaseOrderItems->update_po_item($input,$id);
        if(!empty($result)){
            $this->PurchaseOrderItems->Update_PO_Totals($input['po_id']);
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

    public function PurchaseOrderAPI_delete_po_item($id,$po_id){
        $result = $this->PurchaseOrderItems::where('id',$id)->delete();
        if(!empty($result)){
            $this->PurchaseOrderItems->Update_PO_Totals($po_id);
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

    public function PurchaseOrderAPI_delete_po($id)
    {
        $this->PurchaseOrderItems::where('po_id',$id)->delete();
        $result = $this->PurchaseOrder::where('id',$id)->delete();
        if(!empty($result)){
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

    public function POTransporterList(Request $request, $id){
        $input =  $request->all();
        $pro = $this->PurchaseOrderTransporters->POTransporterList($id, $input);

        $data_info = [
            'msg' => 'Success',
            'error' => false,
            'result_POTransporterList' => $pro
        ];

        return response()->json($data_info);
    }

    public function POTransporterAutoComplete(Request $request){
        $input = $request->all();
        $pro = $this->PurchaseOrderTransporters->POTransporterAutoComplete($input);
        $data_info = [
            'msg' => 'Success',
            'error' => false,
            'result_POTransporterAutoComplete' => $pro
        ];
        return response()->json($data_info);
    }

    public function PurchaseOrderAPI_add_po_transporter(Request $request){
        $input = $request->all();
        $this->PurchaseOrderTransporters->add_po_transporter($input);
        $data_info = [
            'msg' => 'Success',
            'error' => true
        ];
        return response()->json($data_info);
    }

    public function PurchaseOrderAPI_delete_po_transporter($id){
        $result = $this->PurchaseOrderTransporters::where('id',$id)->delete();
        if(!empty($result)){
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

    public function PurchaseOrderAPI_select_po_transporter($id,$po_id,$transporter_id){
        $this->PurchaseOrderTransporters::where('po_id',$po_id)->update([
            'status' => NULL
        ]);
        $result = $this->PurchaseOrderTransporters::where('id',$id)->update([
            'status' => 'Selected'
        ]);
        if(!empty($result)){
            $this->PurchaseOrder::where('id',$po_id)->update([
                'transporter_id' => $transporter_id,
                'updated_by' => Auth::user()->id
            ]);
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

}
