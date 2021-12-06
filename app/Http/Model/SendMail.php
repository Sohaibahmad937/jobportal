<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


use View;
use PDF;


class SendMail extends Model
{
    public function send_order_success_mail($sales_id){
        $sales_header_obj = new SalesHeader();
        $orders = $sales_header_obj->GetOrderDetail($sales_id);
        
        $sales_header = $orders['sales_header'];
        $user_id = $sales_header['user_id'];
        $user_info = FrontUserInfo($user_id);
        // print_r($user_info); die();
        $email = $user_info['email'];
        $name = $user_info['name'];
        $guest_or_not = FALSE;
        if($user_id == ''){
            $guest = $sales_header['guest'];
            if($guest!=''){
                $guest = json_decode($guest,true);
                $email = $guest['guest_email'];
                $name = $guest['guest_name'];
                $guest_or_not = TRUE;
            }
        }
        $home_page_settings = HomePageSettings::first()->toArray();
        $image = asset('home_page_images/'.$home_page_settings['site_logo']);
        
        $Host = config('constant.Host');
        $Username = config('constant.Username');
        $Password = config('constant.Password');
        $SMTPSecure = config('constant.SMTPSecure');
        $Port = config('constant.Port');
        $mail_from_address = config('constant.mail_from_address');
        $mail_from_name = config('constant.mail_from_name');
        

        $mail = new PHPMailer(true);// Passing `true` enables exceptions
        $mail->SetLanguage("en");
        try {
            // Server settings
            $mail->SMTPDebug = 0;                                	// Enable verbose debug output
            $mail->isSMTP();                                     	// Set mailer to use SMTP
            $mail->Host = $Host;												// Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                              	// Enable SMTP authentication
            $mail->Username = $Username;             // SMTP username
            $mail->Password = $Password;              // SMTP password
            $mail->SMTPSecure = $SMTPSecure;                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = $Port;                                    // TCP port to connect to
            

            //Recipients
            $mail->setFrom($mail_from_address, $mail_from_name);
            $mail->addAddress($email, $name);	// Add a recipient, Name is optional
            // $mail->addCustomHeader('Content-Type: text/html; charset=ISO-8859-1');
            $mail->CharSet = 'UTF-8';
            // $mail->addCustomHeader('Content-Type: text/html; charset=UTF-8');
            // $mail->AddAttachment($path.'/'.$fileName);
            
            //Content
            $mail->isHTML(true); 																	// Set email format to HTML
            $mail->Subject = 'Confirmed: Mjdmart.com Order placed successfully.';
            $otp = NULL;
            $otp = rand(1000,9999);
            $data = [
                'otp' => $otp
            ];
            //$mail->AddEmbeddedImage($image, 'logo_2u', $home_page_settings['site_logo']);
            $mail->Body    = (string)View::make('mail.send_order_success_mail', compact('sales_id','home_page_settings','orders','name','guest_or_not'));//view('mail',compact('input'));						// message

            $mail->send();
            // unlink($full_path);
            
            // $result = FrontUsers::where('email',$email)->update([
            //     'otp' => $otp
            // ]);
            $data_info = [
                'error' => false,
                'msg' => 'Success'
            ];
            return response()->json($data_info);

        } catch (Exception $e) {
            $data_info = [
                'error' => true,
                'msg' => 'Mail Could not be sent'.$e
            ];
            return response()->json($data_info);
        }
    }

    public function send_order_success_sms($input){

        
        $phone_number = $input['phone'];
        $msg = rawurlencode($input['msg']);

        
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "http://message.smartwave.co.in/rest/services/sendSMS/sendGroupSms?AUTH_KEY=2d8c738b8699df742433b3de53984f&message=$msg&senderId=MJDMRT&routeId=8&mobileNos=$phone_number&smsContentType=english",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_CUSTOMREQUEST => "GET",
        ));
        $response = curl_exec($curl);
        //echo $response;
        curl_close($curl);
    }

    

    public function send_sms($input){
        $phone_number = $input['phone'];
        $msg = rawurlencode($input['msg']);
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "http://message.smartwave.co.in/rest/services/sendSMS/sendGroupSms?AUTH_KEY=2d8c738b8699df742433b3de53984f&message=$msg&senderId=MJDMRT&routeId=8&mobileNos=$phone_number&smsContentType=english",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_CUSTOMREQUEST => "GET",
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        // echo $response;
    }

}