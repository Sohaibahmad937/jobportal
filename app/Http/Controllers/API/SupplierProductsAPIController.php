<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Model\Products;
use App\Http\Model\SupplierProducts;
use App\Http\Model\SupplierProductsPricingHistory;
use App\Http\Model\SupplierProductsPricing;
use App\Http\Model\Unit;

use App\Http\Requests\API\SupplierProductsRequest;
use App\Http\Requests\API\SupplierProductsPricingRequest;
use Auth;
class SupplierProductsAPIController extends Controller
{
    public function __construct(
        Products $Products,
        SupplierProducts $SupplierProducts,
        Unit $Unit,
        SupplierProductsPricingHistory $SupplierProductsPricingHistory,
        SupplierProductsPricing $SupplierProductsPricing
        )
    {
        $this->Products = $Products;
        $this->SupplierProducts = $SupplierProducts;
        $this->SupplierProductsPricingHistory = $SupplierProductsPricingHistory;
        $this->Unit = $Unit;
        $this->SupplierProductsPricing = $SupplierProductsPricing;
    }

    public function SupplierProductsList(){
        $pro = $this->SupplierProducts->SupplierProductsList();
        return response()->json([
            'error' => false,
            'msg' => 'Success',
            'result_SupplierProductsList' => $pro
        ]);
    }

    public function ProductsAutoCompleteForSupplier(Request $request){
        $input = $request->all();
        $pro = $this->SupplierProducts->ProductsAutoCompleteForSupplier($input);
        return response()->json([
            'error' => false,
            'msg' => 'Success',
            'result_ProductsAutoCompleteForSupplier' => $pro
        ]);
    }

    public function SupplierProductsAPI_store(SupplierProductsRequest $request)
    {
        $input = $request->all();
        $result = $this->SupplierProducts->create(
            [
                'product_id' => $input['product_id'],
                'supplier_id' => $input['supplier_id'],
                'unit_id' => $input['unit_id'],
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id
            ]
        );
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

    public function SupplierProductsAPI_edit($id)
    {
        // $units = $this->Unit->GetAllUnit();
        $row = $this->SupplierProducts->SupplierProductsInfo($id);
        $input = [
            'product_id' => $row->product_id,
            'supplier_id' => Auth::user()->id
        ];
        $pricing_info = $this->SupplierProductsPricing->GetSupplierProductPricing($input);
        // $result['units'] = $units;
        $result['row'] = $row;
        $result['pricing_info'] = $pricing_info;
        return response()->json([
            'error' => false,
            'msg' => 'Success',
            'result_SupplierProductsAPI_edit' => $result
        ]);
    }

    public function SupplierProductsAPI_update(SupplierProductsPricingRequest $request, $id)
    {
        $input = $request->all();
        // return response()->json($input);
        $this->SupplierProductsPricing->UpdatePricing($input,$id);
        $data_info = [
            'msg' => 'Success',
            'error' => false
        ];
        return response()->json($data_info);
    }

    public function SupplierProducts_destroy($id)
    {
        $info = $this->SupplierProducts->SupplierProducts_destroy($id);
        if($info['error'] == true){
            $data_info = [
                'msg' => $info['message'],
                'error' => true
            ];
        }else{
            $data_info = [
                'msg' => $info['message'],
                'error' => false
            ];
        }
        return response()->json($data_info);
    }
}
