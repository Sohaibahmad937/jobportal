<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Model\Supplier;

class SupplierAPIController extends Controller
{
    public function __construct(Supplier $Supplier)
    {
        $this->Supplier = $Supplier;
    }

    public function SupplierAutoComplete(Request $request){
        $input = $request->all();
        $result = $this->Supplier->SupplierAutoComplete($input);
        return response()->json([
            'error' => false,
            'msg' => 'Success',
            'result_SupplierAutoComplete' => $result
        ]);
    }
}
