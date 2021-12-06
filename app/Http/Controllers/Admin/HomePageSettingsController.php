<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Model\HomePageSettings;

class HomePageSettingsController extends Controller
{
    public function __construct(HomePageSettings $HomePageSettings)
    {
        $this->HomePageSettings = $HomePageSettings;
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = $this->HomePageSettings::all()->toArray();
        $row = $result[0];
        return view('admin.home_page_settings.index',compact('row'));   
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
       
        
        $imagePath = public_path('/home_page_images/');
        if (!file_exists($imagePath)) {
            mkdir($imagePath, 0775, true);
        }
        if($request->hasFile('site_logo'))
        {
            $image = $request->file('site_logo');
            $site_logo = md5(time().'_'.$image->getClientOriginalName()).'.'.$image->getClientOriginalExtension();
            $image->move($imagePath,$site_logo);
            if($input['site_logo_hidden']!=''){
                unlink($imagePath.'/'.$input['site_logo_hidden']);
            }
        }else{
            $site_logo = $input['site_logo_hidden'];
        }

        if($request->hasFile('banner_1'))
        {
            $image = $request->file('banner_1');
            $banner_1 = md5(time().'_'.$image->getClientOriginalName()).'.'.$image->getClientOriginalExtension();
            $image->move($imagePath,$banner_1);
            if($input['banner_1_hidden']!=''){
                unlink($imagePath.'/'.$input['banner_1_hidden']);
            }
        }else{
            $banner_1 = $input['banner_1_hidden'];
        }

        if($request->hasFile('banner_2'))
        {
            $image = $request->file('banner_2');
            $banner_2 = md5(time().'_'.$image->getClientOriginalName()).'.'.$image->getClientOriginalExtension();
            $image->move($imagePath,$banner_2);
            if($input['banner_2_hidden']!=''){
                unlink($imagePath.'/'.$input['banner_2_hidden']);
            }
        }else{
            $banner_2 = $input['banner_2_hidden'];
        }

        if($request->hasFile('banner_3'))
        {
            $image = $request->file('banner_3');
            $banner_3 = md5(time().'_'.$image->getClientOriginalName()).'.'.$image->getClientOriginalExtension();
            $image->move($imagePath,$banner_3);
            if($input['banner_3_hidden']!=''){
                unlink($imagePath.'/'.$input['banner_3_hidden']);
            }
        }else{
            $banner_3 = $input['banner_3_hidden'];
        }

        if($request->hasFile('banner_4'))
        {
            $image = $request->file('banner_4');
            $banner_4 = md5(time().'_'.$image->getClientOriginalName()).'.'.$image->getClientOriginalExtension();
            $image->move($imagePath,$banner_4);
            if($input['banner_4_hidden']!=''){
                unlink($imagePath.'/'.$input['banner_4_hidden']);
            }
        }else{
            $banner_4 = $input['banner_4_hidden'];
        }
        $home_bottom_categories = NULL;
        if(isset($input['home_bottom_categories'])) $home_bottom_categories = implode('##',$input['home_bottom_categories']);
        $result = $this->HomePageSettings::where('id',$id)->update([
            'site_logo' => $site_logo,
            'banner_1' => $banner_1,
            'banner_2' => $banner_2,
            'banner_3' => $banner_3,
            'banner_4' => $banner_4,
            'banner_1_link' => $input['banner_1_link'],
            'banner_2_link' => $input['banner_2_link'],
            'banner_3_link' => $input['banner_3_link'],
            'banner_4_link' => $input['banner_4_link'],
            'home_content' => $input['home_content'],
            
        ]);
        if($result){
            return redirect()->back()->with(['success'=>'Success']);
        }else{
            return redirect()->back()->with(['error'=>'Something went wrong']);
        }

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
