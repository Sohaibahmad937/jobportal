<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Model\Products;
use App\Http\Model\BillingHeader;
use App\Http\Model\BillingItems;
use App\Http\Model\BillingCustomers;
use App\Http\Model\BillingPayment;
use App\Http\Requests\Admin\BillingFinishRequest;
use App\Http\Requests\Admin\UpdatePaymentRequest;
use Auth;

class BillingAPIController extends Controller
{
    public function __construct(
        Products $Products,
        BillingHeader $BillingHeader,
        BillingItems $BillingItems,
        BillingCustomers $BillingCustomers,
        BillingPayment $BillingPayment
    )
    {
        $this->Products = $Products;
        $this->BillingHeader = $BillingHeader;
        $this->BillingItems = $BillingItems;
        $this->BillingCustomers = $BillingCustomers;
        $this->BillingPayment = $BillingPayment;
    }

    public function ProductPricingBasedOnWeight(Request $request){
        $input = $request->all();
        $product_code = $input['product_code'];
        $weight = $input['weight'];

        $result = $this->Products->ProductPricingBasedOnWeight($input);
        return [
            'error' => false,
            'msg' => 'Success',
            'result_ProductPricingBasedOnWeight' => $result
        ];


    }

    public function StartBilling(Request $request){
        $input = $request->all();
        
        $result = $this->BillingHeader::create([
            'code' => 'B'.date('dmYHis'),
            'user_id' => Auth::user()->id
        ]);

        if(!empty($result)){
            $data_info = [
                'error' => false,
                'msg' => 'Success',
                'result' => $result
            ];
        }else{
            $data_info = [
                'error' => true,
                'msg' => 'Something went wrong'
            ];
        }

        return response()->json($data_info);
    }

    public function AddBillingItems(Request $request){
        $input = $request->all();
        $result = $this->BillingItems->AddBillingItems($input);
        return $result;
    }

    public function FinishBilling(BillingFinishRequest $request){
        $input = $request->all();
        $result = $this->BillingHeader->FinishBilling($input);
        return $result;
    }

    public function ViewBillingInfo(Request $request){
        $input = $request->all();
        $result = $this->BillingItems->BillingItems($input);
        
        $main_header = [];
        $count = 0;
        if(!empty($result)){
            foreach($result as $row_billing_items){
                if(empty($main_header)){
                    $main_header[$count]['tax'] = $row_billing_items['tax'];
                    $main_header[$count]['tax_charge'] = $row_billing_items['tax_charge'];
					$main_header[$count]['tax_charge_type'] = $row_billing_items['tax_charge_type'];
                    $main_header[$count]['items'][] = $row_billing_items;
                    $count++;
                }else{
                    $all_type_names = array_column($main_header,'tax');
                    if(in_array($row_billing_items['tax'],$all_type_names)){
                        $key = array_search($row_billing_items['tax'],$all_type_names);
                        $count_sub = count($main_header[$key]['items']);
                        $main_header[$key]['items'][$count_sub] = $row_billing_items;
                    }else{
                        $main_header[$count]['tax'] = $row_billing_items['tax'];
                        $main_header[$count]['tax_charge'] = $row_billing_items['tax_charge'];
						$main_header[$count]['tax_charge_type'] = $row_billing_items['tax_charge_type'];
                        $main_header[$count]['items'][] = $row_billing_items;
                        $count++;
                    }
                }
            }
        }
        // print_r($main_header);
        // exit;
        $row = $this->BillingHeader::where('id',$input['billing_header_id'])->first()->toArray();
        $payment_history = $this->BillingPayment->where('bill_id',$input['billing_header_id'])->orderBy('id','DESC')->get()->toArray();
        return response()->json([
            'error' => false,
            'msg' => 'Success',
            'result_ViewBillingInfo' => [
                'billing_header' => $row,
                'billing_items' => $main_header,
                'payment_history' => $payment_history
            ]
        ]);
    }

    public function ProductsAutoComplete(Request $request){
        $input = $request->all();
        $pro = $this->Products->ProductsAutoComplete($input);
        return response()->json([
            'error' => false,
            'msg' => 'Success',
            'result_ProductsAutoComplete' => $pro
        ]);
        
    }

    public function BillingList(Request $request){
        $input = $request->all();
        $brand_object = $this->BillingHeader->BillingList($input);
        return [
            'error' => false,
            'msg' => 'Success',
            'result_billing_list' => $brand_object
        ];
        json_encode();
    }

    public function DeleteBillingItems(Request $request){
        $input = $request->all();
        $result = $this->BillingItems->DeleteBillingItems($input);
        return $result;
    }
    
    public function GetBillingCustomerRewardPoints(Request $request){
        $input = $request->all();
        $result = $this->BillingCustomers->GetBillingCustomerRewardPoints($input);
        return response()->json([
            'error' => false,
            'msg' => 'Success',
            'result_GetBillingCustomerRewardPoints' => $result
        ]);
    }

    public function getBillingInfo($id){
        $row = $this->BillingHeader->getBillingInfo($id);
        $data_info = [
            'error' => false,
            'msg' => 'Success',
            'result_getBillingInfo' => $row
        ];
        return $data_info;
    }

    public function GetCustomerDetail(Request $request){
        $input = $request->all();
        $result = $this->BillingHeader->GetCustomerDetail($input);
        if(!empty($result)){
            $data_info = [
                'error' => false,
                'msg' => 'Success',
                'result_GetCustomerDetail' => $result
            ];
        }else{
            $data_info = [
                'error' => true,
                'msg' => 'Something went wrong',
              
            ];
        }
        return $data_info;
    }

    public function UpdateBillingItem(Request $request){
        $input = $request->all();
        $result = $this->BillingItems->UpdateBillingItem($input);
        return $result;
    }

    public function updatePayment(UpdatePaymentRequest $request){
        $input = $request->all();
        $result = $this->BillingHeader->MakePayment($input);
        return $result;
    }

}
