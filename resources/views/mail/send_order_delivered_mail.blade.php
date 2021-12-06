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
             <td style="padding:0px;vertical-align:bottom;font:12px/16px Arial,sans-serif"> <a href="{{ url('/') }}" style="text-decoration:none;color:#006699;font-family:Arial,san-serif" target="_blank">Mjdmart.com</a> </td> 
            </tr> 
           </tbody> 
          </table> </td> 
        </tr> 
        <tr> 
         <td style="text-align:right;padding:7px 0px 0px 20px;width:490px"> <span style="font:20px Arial,san-serif">Order Delivered</span> </td> 
        </tr> 
        <tr> 
         <td style="text-align:right;padding:0px 0px 5px 20px;width:490px"> <span style="font-size:12px"> Order #<a href=".about" style="text-decoration:none;color:#006699" target="_blank" >{{ $order_header['order_no'] }}</a> </span> </td> 
        </tr> 
       </tbody>
      </table> </td> 
    </tr> 
    <tr> 
      @php
        $firstName = explode(' ', $name);
      @endphp
     <td colspan="2" style="width:640px"> <p style="font:18px Arial,sans-serif;color:#cc6600;margin:15px 20px 0 20px">Hello {{ $firstName[0] }},</p> <p style="margin:4px 20px 18px 20px;width:640px"> Your order has been successfully delivered </p> </td> 
    </tr> 
    
    <tr>
      
      <td style="padding-bottom:2px;border-collapse:collapse!important;font-family:Arial,sans-serif" colspan="2"><span style="margin: 15px 20px 0 20px;"> Please rate your Shopping Experience.</span> </td>
      
    </tr>
    <tr>
        <td colspan="2" style="vertical-align: text-bottom;">
        
        <table class="m_4900683661704317124trackPackageButtonTable" style="height:45px!important;width:397px!important;max-width:397px!important;display:block;border-collapse:collapse!important;text-align:left;margin: 15px 20px 0 20px;"> 
                        <tbody>
                         <tr align="center" valign="middle" class="m_4900683661704317124trackPackageButtonText" width="400" height="50" bgcolor="ffa723" style="line-height:18px;color:rgb(17,17,17);font-size:16px;text-decoration:none;vertical-align:middle"> 
                          <td width="90" style="border-collapse:collapse!important;font-family:Arial,sans-serif"></td> 
                          <td style="border-collapse:collapse!important;font-family:Arial,sans-serif"> <a href="{{ route('BulkReview',base64_encode($order_header['id'])) }}" style="color:rgb(0,46,54);text-decoration:none" target="_blank" > <img align="center" id="m_4900683661704317124leaveDeliveryFeedback" src="https://ci3.googleusercontent.com/proxy/TbFGNKIrU4P4jrefYJ8xnk1kpkxXTbgDZQlGUlHgT9MCPI8ExA3M2SSmpnoJQcHoa8WZoOqrCHVPQQn7sfAgZljm_ZsKupHOWN9vyFUOi_pTvYrvQhpToWskrr7Nh__oa4M=s0-d-e1-ft#http://g-ecx.images-amazon.com/images/G/31/A2I/star_unfilled._CB531035208_.png/" class="CToWUd"> </a> </td> 
                          <td style="border-collapse:collapse!important;font-family:Arial,sans-serif"> <a href="{{ route('BulkReview',base64_encode($order_header['id'])) }}" style="color:rgb(0,46,54);text-decoration:none" target="_blank"> <img align="center" id="m_4900683661704317124leaveDeliveryFeedback" src="https://ci3.googleusercontent.com/proxy/TbFGNKIrU4P4jrefYJ8xnk1kpkxXTbgDZQlGUlHgT9MCPI8ExA3M2SSmpnoJQcHoa8WZoOqrCHVPQQn7sfAgZljm_ZsKupHOWN9vyFUOi_pTvYrvQhpToWskrr7Nh__oa4M=s0-d-e1-ft#http://g-ecx.images-amazon.com/images/G/31/A2I/star_unfilled._CB531035208_.png/" class="CToWUd"> </a> </td> 
                          <td style="border-collapse:collapse!important;font-family:Arial,sans-serif"> <a href="{{ route('BulkReview',base64_encode($order_header['id'])) }}" style="color:rgb(0,46,54);text-decoration:none" target="_blank" > <img align="center" id="m_4900683661704317124leaveDeliveryFeedback" src="https://ci3.googleusercontent.com/proxy/TbFGNKIrU4P4jrefYJ8xnk1kpkxXTbgDZQlGUlHgT9MCPI8ExA3M2SSmpnoJQcHoa8WZoOqrCHVPQQn7sfAgZljm_ZsKupHOWN9vyFUOi_pTvYrvQhpToWskrr7Nh__oa4M=s0-d-e1-ft#http://g-ecx.images-amazon.com/images/G/31/A2I/star_unfilled._CB531035208_.png/" class="CToWUd"> </a> </td> 
                          <td style="border-collapse:collapse!important;font-family:Arial,sans-serif"> <a href="{{ route('BulkReview',base64_encode($order_header['id'])) }}" style="color:rgb(0,46,54);text-decoration:none" target="_blank" > <img align="center" id="m_4900683661704317124leaveDeliveryFeedback" src="https://ci3.googleusercontent.com/proxy/TbFGNKIrU4P4jrefYJ8xnk1kpkxXTbgDZQlGUlHgT9MCPI8ExA3M2SSmpnoJQcHoa8WZoOqrCHVPQQn7sfAgZljm_ZsKupHOWN9vyFUOi_pTvYrvQhpToWskrr7Nh__oa4M=s0-d-e1-ft#http://g-ecx.images-amazon.com/images/G/31/A2I/star_unfilled._CB531035208_.png/" class="CToWUd"> </a> </td> 
                          <td style="border-collapse:collapse!important;font-family:Arial,sans-serif"> <a href="{{ route('BulkReview',base64_encode($order_header['id'])) }}" style="color:rgb(0,46,54);text-decoration:none" target="_blank" > <img align="center" id="m_4900683661704317124leaveDeliveryFeedback" src="https://ci3.googleusercontent.com/proxy/TbFGNKIrU4P4jrefYJ8xnk1kpkxXTbgDZQlGUlHgT9MCPI8ExA3M2SSmpnoJQcHoa8WZoOqrCHVPQQn7sfAgZljm_ZsKupHOWN9vyFUOi_pTvYrvQhpToWskrr7Nh__oa4M=s0-d-e1-ft#http://g-ecx.images-amazon.com/images/G/31/A2I/star_unfilled._CB531035208_.png/" class="CToWUd"> </a> </td> 
                          <td width="90" style="border-collapse:collapse!important;font-family:Arial,sans-serif"></td> 
                         </tr> 
                         <tr></tr>
                        
                        </tbody>
                       </table>
                     
                      
        </td>
        
    </tr>
   
    <tr> 
     <td colspan="2" style="padding:0 20px 0 20px;line-height:22px;width:640px"> <p style="margin:10px 0;padding:0 0 20px 0;border-bottom:1px solid #eaeaea">We hope to see you again soon!<br> <span style="font:14px Arial,san-serif"> <strong>Mjdmart.com</strong> </span> </p> </td> 
    </tr> 
   </tbody>
  </table>  
 </div>