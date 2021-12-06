<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Model\PurchaseOrderTransporters;
use App\Http\Model\PurchaseOrder;
use App\Http\Model\PurchaseOrderItems;

class TransporterPORequestAPIController extends Controller
{
    public function __construct(
        PurchaseOrderTransporters $PurchaseOrderTransporters,
        PurchaseOrder $PurchaseOrder,
        PurchaseOrderItems $PurchaseOrderItems
    )
    {
        $this->PurchaseOrder = $PurchaseOrder;
        $this->PurchaseOrderItems = $PurchaseOrderItems;
        $this->PurchaseOrderTransporters = $PurchaseOrderTransporters;
    }

    public function TransporterPORequestList(Request $request){
        $input = $request->all();
        $pro = $this->PurchaseOrderTransporters->TransporterPORequestList($input);
        return response()->json([
            'error' => false,
            'msg' => 'Success',
            'result_TransporterPORequestList' => $pro
        ]);
    }

    public function ViewTransporterPORequest($id)
    {
        $trans = PurchaseOrderTransporters::where('id',$id)->first();
        $row = $this->PurchaseOrder->GetPODetail($trans->po_id);
        $pro_items = $this->PurchaseOrderItems->PO_Items($trans->po_id);
        $result['trans'] = $trans;
        $result['po_header'] = $row;
        $result['pro_items'] = $pro_items;

        return response()->json([
            'error' => false,
            'msg' => 'Success',
            'result_show' => $result
        ]);

    }

    public function TransporterPORequest_update_status(Request $request,$id){
        $input = $request->all();
        $result = $this->PurchaseOrderTransporters->update_status($input,$id);
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
