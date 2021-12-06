<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Setting;

use DB;
use Auth;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $row = Setting::first();
        $zipcode = [];
        return view('admin.settings.index',['row'=>$row,'zipcode' => $zipcode]);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $data = [
            'mail_driver' => $input['mail_driver'],
            'mail_host' => $input['mail_host'],
            'mail_port' => $input['mail_port'],
            'mail_from_address' => $input['mail_from_address'],
            'mail_from_name' => $input['mail_from_name'],
            'mail_encryption' => $input['mail_encryption'],
            'mail_username' => $input['mail_username'],
            'mail_password' => $input['mail_password'],
            'mail_recipient' => $input['mail_recipient'],
            'mail_recipientname' => $input['mail_recipientname']
        ];
        Setting::where('id',$id)->update($data);
        return back()->with('success','Updated Successfully');
    }

    
}
