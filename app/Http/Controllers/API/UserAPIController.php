<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use App\User;
use App\Http\Model\Retailer;

class UserAPIController extends Controller
{

    public function __construct(
        Retailer $Retailer,
        CityPostcode $CityPostcode
    )
    {
        $this->Retailer = $Retailer;
        $this->CityPostcode = $CityPostcode;
    }

    public function Login(Request $request){
        if(Auth::attempt(['username' => request('username'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            $token =  $user->createToken('MyApp')-> accessToken; 
            if($user->role == 5){
                $user->retailer_id = DPRetailerFromUserID($user->id);
            }else{
                $user->retailer_id = NULL;
            }
            $GetZipInfo = $this->CityPostcode->GetZipInfo($user->zipcode);
            $user->zip_info = $GetZipInfo;
            return response()->json([
                'error' => false,
                'msg' =>'Success',
                'result' => $user,
                'token' => $token
            ]);
        } 
        else{ 
            return response()->json([
                'error' => true,
                'msg' =>'User name Password Does not match'
            ]);
            // return response()->json(['error'=>'Unauthorised'], 401); 
        }
    }

    public function logout(){
        Auth::user()->token()->revoke();
        DB::table('oauth_access_tokens')
        ->where('user_id', Auth::user()->id)
        ->update([
            'revoked' => true
        ]);
    }

    public function RetailerList(){
        $sup = $this->Retailer->RetailerList();
        return [
            'error' => false,
            'result_RetailerList' => $sup
        ];
    }
    

    
    
}
