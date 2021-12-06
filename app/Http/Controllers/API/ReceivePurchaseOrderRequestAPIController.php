<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Model\PurchaseOrder;
use App\Http\Model\PurchaseOrderItems;
use Auth;

class ReceivePurchaseOrderRequestAPIController extends Controller
{
    public function __construct(
        PurchaseOrder $PurchaseOrder,
        PurchaseOrderItems $PurchaseOrderItems
    )
    {
        $this->PurchaseOrder = $PurchaseOrder;
        $this->PurchaseOrderItems = $PurchaseOrderItems;
    }

    public function ReceivePurchaseOrderRequestAPI_receive_po_list(Request $request){
        $input = $request->all();
        $pro = $this->PurchaseOrder->receive_po_list($input);
        return response()->json([
            'error' => false,
            'msg' => 'Success',
            'result_ReceivePurchaseOrderRequestAPI_receive_po_list' => $pro
        ]);
    }

    public function ReceivePurchaseOrderRequestAPI_show($id)
    {
        // $units = $this->Unit->GetAllUnit();
        $row = $this->PurchaseOrder->GetPODetail($id);
        $pro_items = $this->PurchaseOrderItems->PO_Items($id);
        $result['po_header'] = $row;
        $result['pro_items'] = $pro_items;
        return response()->json([
            'error' => false,
            'msg' => 'Success',
            'result_ReceivePurchaseOrderRequestAPI_show' => $result
        ]);
    }

    public function ReceivePurchaseOrderRequestAPI_update_status(Request $request,$id){
        $input = $request->all();
        $result = $this->PurchaseOrder->update_status($input,$id);
        if(!empty($result)){
            return response()->json([
                'error' => false,
                'msg' => 'Success'
            ]);
        }else{
            return response()->json([
                'error' => true,
                'msg' => 'Error'
            ]);
        }
    }
}
