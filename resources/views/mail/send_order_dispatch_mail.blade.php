@php $order_header = $orders['sales_header']; @endphp
<?php 
    if(isset($orders['shipping_info'][0])){
        $shipping_info = $orders['shipping_info'][0];
    }else{
        $shipping_info = [];
    }
    ?>
    <?php
        $shipping_addresses = json_decode($order_header['shipping_address']);
        $delivery_addresses = json_decode($order_header['delivery_address']);

        $shipping_name = NULL;
        $shipping_pincode = NULL;
        $shipping_email = NULL;
        $shipping_mobile = NULL;
        // $shipping_locality = NULL;
        $shipping_address = NULL;
        $shipping_city = NULL;
        $shipping_lang_mark = NULL;
        $shipping_state = NULL;
        $shipping_alternate_phone = NULL;
        
        if(!empty($shipping_addresses)){
            $shipping_name = $shipping_addresses->shipping_name;
            $shipping_pincode = $shipping_addresses->shipping_pincode;
            $shipping_email = $shipping_addresses->shipping_email;
            $shipping_mobile = $shipping_addresses->shipping_mobile;
            // $shipping_locality = $shipping_addresses->shipping_locality;
            $shipping_address = $shipping_addresses->shipping_address;
            $shipping_city = CityName($shipping_addresses->shipping_city);
            $shipping_lang_mark = $shipping_addresses->shipping_lang_mark;
            $shipping_state = $shipping_addresses->shipping_state;
            $shipping_alternate_phone = $shipping_addresses->shipping_alternate_phone;
        }

        $delivery_name = NULL;
        $delivery_pincode = NULL;
        $delivery_email = NULL;
        $delivery_mobile = NULL;
        // $delivery_locality = NULL;
        $delivery_address = NULL;
        $delivery_city = NULL;
        $delivery_lang_mark = NULL;
        $delivery_state = NULL;
        $delivery_alternate_phone = NULL;
        if(!empty($delivery_addresses)){
            $delivery_name = $delivery_addresses->delivery_name;
            $delivery_pincode = $delivery_addresses->delivery_pincode;
            $delivery_email = $delivery_addresses->delivery_email;
            $delivery_mobile = $delivery_addresses->delivery_mobile;
            // $delivery_locality = $delivery_addresses->delivery_locality;
            $delivery_address = $delivery_addresses->delivery_address;
            $delivery_city = CityName($delivery_addresses->delivery_city);
            $delivery_lang_mark = $delivery_addresses->delivery_lang_mark;
            $delivery_state = $delivery_addresses->delivery_state;
            $delivery_alternate_phone = $delivery_addresses->delivery_alternate_phone;
        }

    ?>
    @php $sales_detail = $orders['sales_detail']; @endphp
    @php $coupon_detail = $orders['coupon_detail']; @endphp
<div style="margin:0;"><img width="1" height="1" src="{{asset('home_page_images/')}}/{{$home_page_settings['site_logo']}}" class="CToWUd"> 
  <table width="640" cellspacing="0" style="font:12px/16px Arial,sans-serif;color:#333;background-color:#fff;margin:0 auto" cellpadding="0"> 
   <tbody>
    <tr> 
     <td valign="top" style="padding:14px 0px 10px 20px;width:100px;border-collapse:collapse"> <a href="{{URL('/')}}" title="Visit Purefresh" target="_blank"><img style="width: 250px;" alt="Purefresh" border="0" id="m_5412194817524348427PurefreshLogo" src="{{asset('home_page_images/')}}/{{$home_page_settings['site_logo']}}" class="CToWUd"></a> </td> 
     <td style="text-align:right;padding:0px 20px"> 
      <table cellspacing="0" style="font:12px/16px Arial,sans-serif;color:#333;margin:0 auto;border-collapse:collapse" cellpadding="0"> 
       <tbody>
        <tr> 
         <td style="border-bottom:1px solid #f67734;width:490px;padding:0px 0px 5px 0px" class="m_5412194817524348427topHeaderLinks"> 
          <table align="right" style="border-collapse:collapse" cellspacing="0"> 
           <tbody> 
            <tr> 
             <td style="padding:0px;vertical-align:bottom;font:12px/16px Arial,sans-serif"> <a href="@if($guest_or_not) {{ route('view_order_guest',$order_header['id']) }} @else {{route('profile','orders')}} @endif" style="text-decoration:none;color:#006699;font-family:Arial,san-serif" target="_blank" >Your Orders</a> <span style="text-decoration:none;color:#ccc;font:15px Arial,san-serif">&nbsp;|&nbsp;</span> </td> 
             <td style="padding:0px;vertical-align:bottom;font:12px/16px Arial,sans-serif"> <a href="{{route('profile')}}" style="text-decoration:none;color:#006699;font-family:Arial,san-serif" target="_blank" >Your Account</a> <span style="text-decoration:none;color:#ccc;font:15px Arial,san-serif">&nbsp;|&nbsp;</span> </td> 
             <td style="padding:0px;vertical-align:bottom;font:12px/16px Arial,sans-serif"> <a href="{{ url('/') }}" style="text-decoration:none;color:#006699;font-family:Arial,san-serif" target="_blank">mjdmart.com</a> </td> 
            </tr> 
           </tbody> 
          </table> </td> 
        </tr> 
        <tr> 
         <td style="text-align:right;padding:7px 0px 0px 20px;width:490px"> <span style="font:20px Arial,san-serif">Order Dispatched</span> </td> 
        </tr> 
        <tr> 
         <td style="text-align:right;padding:0px 0px 5px 20px;width:490px"> <span style="font-size:12px"> Order #<a href="{{route('profile',['orders',$order_header['id']])}}" style="text-decoration:none;color:#006699" target="_blank" >{{ $order_header['order_no'] }}</a> </span> </td> 
        </tr> 
       </tbody>
      </table> </td> 
    </tr> 
    <tr> 
    @php
        $firstName = explode(' ', $name);
    @endphp
     <td colspan="2" style="width:640px"> <p style="font:18px Arial,sans-serif;color:#cc6600;margin:15px 20px 0 20px">Hello {{ $firstName[0] }},</p> <p style="margin:4px 20px 18px 20px;width:640px"> Your Package is being shipped by {{ $order_header['courier_master_company_name'] }} & Tracking no is {{ $order_header['tracking_number'] }}.</p> </td> 
    </tr> 
    <tr> 
     <td colspan="2" style="padding:0 20px;width:640px"> 
      <table cellspacing="0" style="border-top:3px solid #2d3741;width:640px" cellpadding="0"> 
       <tbody>
        <tr> 
         <td style="font:14px Arial,san-serif;padding:11px 18px 14px 18px;width:280px;background-color:#efefef">
         @if(strpos($order_header['courier_master_company_name'],'Vaiblue')!== false)
            @php $track_link = $order_header['company_link']; @endphp
         @else
            @php $track_link = 'https://track.aftership.com/trackings?courier='.$order_header['courier_master_company_name'].'&tracking-numbers='.$order_header['tracking_number'] @endphp
         @endif
         <a class="m_5340937242043753340link" href="{{ $track_link }}" style="font-size: 11px;color: #FFFFFF !important;text-decoration: none!important;font: 16px/18px Arial,sans-serif!important;padding: 10px 12px;line-height: 1.5;border-radius: 10px;border-style: solid;border-color: rgb(0,0,0);border-width: 1px;background: #F67734 linear-gradient(#F67733,#f17838) repeat scroll 0% 0%;background-color: #F67734;white-space: nowrap;" target="_blank">Track your Package</a>

         </td>
         <td valign="top" style="font:14px Arial,san-serif;padding:11px 18px 14px 18px;width:280px;background-color:#efefef">
         <span style="color:#666">Your package was sent to:</span>
         <br> <p style="margin:2px 0"> <strong> {{ $shipping_name }}<br> 
            <u></u>
              {{$shipping_email}} <br>
              {{$shipping_mobile}}<br>
             {!! nl2br($shipping_address) !!}, {{$shipping_city}} <br>
             {{ $shipping_pincode }} - {{StateName($shipping_state)}}
            <u></u> </strong> </p> </td> 
        </tr> 
        
       </tbody>
      </table> </td> 
    </tr> 
    <tr> 
     <td colspan="2" style="width:640px"> <p style="font:18px Arial,sans-serif;color:#cc6600;border-bottom:1px solid #ccc;margin:0 20px 3px 20px;padding:0 0 3px 0"> Order Summary </p> </td> 
    </tr> 
    <tr> 
     <td colspan="2" id="m_5412194817524348427shipmentDetails" class="m_5412194817524348427shipmentDetails-no-asin"> 
      @php $sub_total_amount = 0 @endphp
      @if(!empty($sales_detail))
        @php $i = 1 @endphp
        @foreach($sales_detail as $row)
          @php $variation_info = $row['variation_info']; @endphp
          @php $sub_total_amount+=(($row['data']['price'] * $row['data']['qty'])) @endphp
          @php $i++ @endphp
        @endforeach
        
        
      <table width="565" cellspacing="0" cellpadding="0" style="margin:0 20px 3px 20px;"> 
       <tbody>
        
        @if(isset($coupon_detail))
            @if(!empty($coupon_detail))
            <?php
                $discount_type = $coupon_detail['discount_type'];
                $discount_value = $coupon_detail['discount_value'];
                if($discount_type == 'Flate'){
                    $discount = $discount_value;
                }else{
                    $discount = ($sub_total_amount * $discount_value)/100;
                }
                $sub_total_amount = $sub_total_amount - $discount;
            ?>
      
            @endif
        @endif
      
        <tr> 
         <td colspan="2" align="left" valign="top" style="font:12px/18px Arial,sans-serif;padding:0 10px 0 0;color:#333;width:480px"> No. of Items: </td> 
         <td align="left" valign="top" style="font:12px/18px Arial,sans-serif;color:#333;width:85px;width:70%"> {{ count($sales_detail) }} </td> 
        </tr> 
        <tr> 
         <td colspan="2" align="left" valign="top" style="font:12px/18px Arial,sans-serif;padding:0 10px 0 0;color:#333;width:480px"> Order Value: </td> 
         <td align="left" valign="top" style="color:#333;font:12px/18px Arial,sans-serif;width:85px;width:70%"> {{GetCurrency()}} {{$order_header['total_price']}} </td> 
        </tr>
       </tbody>
      </table> 
      @endif
      </td> 
    </tr> 
    <tr> 
     <td colspan="2" style="padding:0 20px;line-height:22px;width:640px"> <p style="border-top:1px solid #ccc;padding:20px 0 0 0">  If you need further assistance with your order, email us at <a href="mailto:order@mjdmart.com" style="color:#006699;text-decoration:none" target="_blank">order@mjdmart.com</a> </p> </td> 
    </tr> 
    <tr> 
     <td colspan="2" style="padding:0 20px 0 20px;line-height:22px;width:640px"> <p style="margin:10px 0;padding:0 0 20px 0;border-bottom:1px solid #eaeaea">We hope to see you again soon!<br> <span style="font:14px Arial,san-serif"> <strong>Mjdmart.com</strong> </span> </p> </td> 
    </tr> 
   </tbody>
  </table>  
 </div>