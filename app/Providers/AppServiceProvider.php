<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;
use DB;

use App\Http\Model\ProductInventory;
use App\Http\Model\DeliveryChallanItems;
use Illuminate\Support\Facades\Schema;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('custom_qty', function($attribute, $value, $parameters, $validator) {
            $product_id = $parameters[0];
            $dc_id = $parameters[1];
            $id = $parameters[2];
            $variation_value_id = $parameters[3];
            $unit_id = $parameters[4];
            $user_id = $parameters[5];
            $role = $parameters[6];
            $to_user_id = $parameters[7];
            if($role == 3){
                return true;
            }

            if($role == 1 || $role == 2){
                $user_id = 1;
            }
            $total_qty = 0;
            $available_qty = 0;
            if($variation_value_id != ''){
                $Get_pro_info = ProductInventory::where('variation_value_id',$variation_value_id)->where('product_id',$product_id)->where('unit_id',$unit_id)->where('with_variation','Yes')->where('user_id',$user_id)->first();
                if(!empty($Get_pro_info)){
                    $total_qty = $Get_pro_info->total_qty;
                }
            }else{
                $Get_pro_info = ProductInventory::where('product_id',$product_id)->where('unit_id',$unit_id)->where('with_variation','No')->where('user_id',$user_id)->first();
                if(!empty($Get_pro_info)){
                    $total_qty = $Get_pro_info->total_qty;
                }
            }

            $query = DeliveryChallanItems::leftJoin('delivery_challan',function($join){
                $join->on('delivery_challan.id','=','delivery_challan_items.dc_id');
            });
            $query->where('delivery_challan.to_user_id',$to_user_id);
            $query->where('delivery_challan.status','Open');
            if($id!=''){
                $query->where('delivery_challan_items.id','!=',$id);
            }
            if($variation_value_id != ''){
                $query->where('variation_value_id',$variation_value_id);
            }
            $query->where('delivery_challan_items.product_id',$product_id);
            $query->where('delivery_challan_items.unit_id',$unit_id);

            $query->groupBy('delivery_challan_items.dc_id');
            $dc_qty_query = $query->select('delivery_challan_items.qty')->get()->toArray();
            $dc_qty = 0;
            if(!empty($dc_qty_query)){
                foreach($dc_qty_query as $row_dc){
                    $dc_qty+=$row_dc['qty'];
                }
            }
            $available_qty = $total_qty - $dc_qty;
            if($available_qty<$value){
                return false;
            }else{
                return true;
            }
        });   
      
        Validator::replacer('custom_qty', function($message, $attribute, $rule, $parameters) {
            return str_replace(':field', $parameters[0], 'You do not have enough qty to add this dc item');
        });


        Validator::extend('billing_qty', function($attribute, $value, $parameters, $validator) {
            // echo $value; die();
            $product_id = $parameters[0];
            $qty = $parameters[1];
            $unit_id = $parameters[2];
            $user_id = $parameters[3];
            $role = $parameters[4];
            

            if($role == 1 || $role == 2){
                $user_id = 1;
            }
            $total_qty = 0;
            
            $Get_pro_info = ProductInventory::where('product_id',$product_id)->where('unit_id',$unit_id)->where('with_variation','No')->where('user_id',$user_id)->first();
            if(!empty($Get_pro_info)){
                $total_qty = $Get_pro_info->total_qty;
            }
                        
            if($total_qty<$value){
                return false;
            }else{
                return true;
            }
        });   
      
        Validator::replacer('billing_qty', function($message, $attribute, $rule, $parameters) {
            return str_replace(':field', $parameters[0], "you Don't have enough quantity of this product");
        });

        Schema::defaultStringLength(191);
       
    }
}
