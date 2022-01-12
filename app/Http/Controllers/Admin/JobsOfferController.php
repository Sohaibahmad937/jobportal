<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Model\DynamicPage;
use App\Http\Requests\Admin\JobsOfferRequest;
use DataTables;



class JobsOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function index()
    {
       //
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
    public function store(JobsOfferRequest $request)
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
        $row = DynamicPage::find($id);
        return view('admin.Dynamic_pages.updateJobOffer',compact('row'));
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
        if($request->hasFile('image_name'))
        {
            $image = $request->file('image_name');
            $image_ext = $image->getClientOriginalExtension();
            $all_image_ext = ['jpeg','jpg','png','gif'];
            if(!in_array($image_ext,$all_image_ext)){
                $data_info = [
                    'msg' => 'Image type not supported',
                    'error' => 1
                ];
                return response()->json($data_info);
            }
        }
        $imageName = NULL;
        if($request->hasFile('image_name'))
        {
            $image = $request->file('image_name');
            $imagePath = public_path('/page_images/');
            if (!file_exists($imagePath)) {
                mkdir($imagePath, 0775, true);
            }
            $imageName = md5(time().'_'.$image->getClientOriginalName()).'.'.$image->getClientOriginalExtension();
            $image->move($imagePath,$imageName);
            if($input['image_name_hidden']!=''){
                unlink($imagePath.'/'.$input['image_name_hidden']);
            }
        }else{
            $imageName = $input['image_name_hidden'];
        }
        
        $data = [
            'title' => $input['title'],
            'description' =>  $input['description'],
            'title2' => $input['title2'],
            'dec2' =>  $input['dec2'],
            'title3' => $input['title3'],
            'desc3' =>  $input['desc3'],
            'image_name' =>  $imageName,
        ];
        $result = DynamicPage::where('id',$id)->update($data);
        if($result){
            $data_info = [
                'msg' => 'Success',
                'error' => 0
            ];
        }else{
            $data_info = [
                'msg' => 'Something wend wrong',
                'error' => 1
            ];
        }
        
        return response()->json($data_info);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $imagePath = public_path('/page_images/');
        
        $row = DynamicPage::where('id',$id)->first()->toArray();
        if(!empty($row)){
            if($row['image_name']!=''){
                unlink($imagePath.'/'.$row['image_name']);
            }
            $result = $this->joboffer::where('id',$id)->delete();
            if($result){
                return redirect()->back()->with(['success'=>'Successfully deleted']);
            }else{
                return redirect()->back()->with(['error'=>'Something went wrong']);
            }
        }else{
            return redirect()->back()->with(['error'=>'Something went wrong']); 
        }

    }
}
