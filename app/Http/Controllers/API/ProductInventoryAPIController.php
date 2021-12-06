<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Model\ProductInventory;
use App\Http\Model\ProductInventoryDetail;
use App\Http\Model\DeliveryChallan;
use App\Http\Model\DeliveryChallanItems;

use App\Http\Requests\API\ProductInventoryRequest;

use Auth;

class ProductInventoryAPIController extends Controller
{
    public function __construct(
        ProductInventory $ProductInventory,
        ProductInventoryDetail $ProductInventoryDetail,
        DeliveryChallan $DeliveryChallan
    )
    {
        $this->ProductInventory = $ProductInventory;
        $this->ProductInventoryDetail = $ProductInventoryDetail;
        $this->DeliveryChallan = $DeliveryChallan;
    }

    public function ProductInventoryList(){
        $InventoryDetail = $this->ProductInventory->InventoryList();
        return response()->json([
            'error' => false,
            'msg' => 'Success',
            'result_ProductInventoryList' => $InventoryDetail
        ]);
    }

    public function DeliveryChallanAutoComplete(Request $request){
        $input = $request->all();
        $pro = $this->DeliveryChallan->DeliveryChallanAutoComplete($input);
        return response()->json([
            'error' => false,
            'msg' => 'Success',
            'result_DeliveryChallanAutoComplete' => $pro
        ]);
    }

    public function ProductInventoryAPI_store_inventory(ProductInventoryRequest $request)
    {
        $input = $request->all();
        $result = $this->ProductInventory->store_inventory($input);
        if($result){
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
