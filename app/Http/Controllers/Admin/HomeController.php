<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Validator;
use Response;
use Auth;
use DataTables;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\User;
use Hash;

class HomeController extends Controller
{
	public function __construct(
        
    )
    {
        $this->middleware('auth');
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($role = null,$id = null)
    {
        return view('admin.home',[]);
    }

    public function adminProfile($id,$tab = ''){
        $row = User::where('id',$id)->first();
        return view('admin.profile',compact('row','tab'));
    }

    
    public function AdminChangePassword(Request $request,$id){
        $input = $request->all();
        $data = [
            'password' => Hash::make($input['password'])
        ];
        $result = User::where('id', $id)->update($data);
        if(!empty($result)){
            session()->flash('success', 'Admin Password Updated!');
            return redirect()->route('admin.profile',[$id,'tab_3']);
        }else{
            session()->flash('error', 'Something wend wrong');
            return redirect()->route('admin.profile');
        }
    }

    public function DoEditAdmin(Request $request,$id){
        $input = $request->all();
        $data = [
            'name' => $input['name'],
            'email' => $input['email'],
            'mobile' => $input['mobile'],
            'username' => $input['username']
        ];
        $result = User::where('id', $id)->update($data);
        if($request->hasFile('user_image'))
        {
            $image = $request->file('user_image');
            $imagePath = public_path('user_image');
            $imageName = md5(time().'_'.$image->getClientOriginalName()).'.'.$image->getClientOriginalExtension();
            $image->move($imagePath,$imageName);
            $imageData = [
                'user_image'		=> $imageName
            ];
            User::where('id', $id)->update($imageData);
            if($input['hidden_image']!=''){
                unlink($imagePath.'/'.$input['hidden_image']);
            }
            
        }
        if(!empty($result)){
            session()->flash('success', 'Admin Personal information Updated!');
            return redirect()->route('admin.profile',$id);
        }else{
            session()->flash('error', 'Something wend wrong');
            return redirect()->route('admin.profile');
        }
    }
}
