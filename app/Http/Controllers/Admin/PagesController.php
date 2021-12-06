<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Model\Pages;

use App\Http\Requests\Admin\PagesRequests;
use DataTables;
use Auth;
class PagesController extends Controller
{
    public function __construct(
        Pages $Pages
        ){
        $this->Pages = $Pages;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if(moduleacess('admin/pages','view') == FALSE){
            return redirect()->back()->with(['error'=>'You dont have a permission']);
        }
        return view('admin.pages.index');
    }

    public function PagesList(){
        $pro = $this->Pages->PagesList();
        return DataTables::of($pro)
        ->addColumn('command',function($pro){
            $command = '';
            if(moduleacess('admin/pages','edit')){
                $command.='<a href="'.route('admin.pages.edit',$pro['id']).'" class="btn btn-sm btn-primary btn-flat">Edit</a> ';
            }
            if(moduleacess('admin/pages','delete')){
                $command.='<form class="table_from" action="'.route("admin.pages.destroy",$pro['id']).'" method="POST">
                '.method_field('DELETE').'
                '.csrf_field().'
                <button type="submit" class="btn btn-sm btn-flat btn-danger" value="delete" onClick="return confirm(\'Are You Sure You Want To Delete This? \')">Delete</button>
            </form>';
            }
            return $command;
        })
        ->rawColumns(['command'])
        ->make(true);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PagesRequests $request)
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
        }
        
        $data = [
            'name' => $input['name'],
            'desc' =>  $input['desc'],
            'image_name' =>  $imageName,
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id
        ];
        $result = $this->Pages::create($data);
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
        $row = $this->Pages::where('id',$id)->first()->toArray();
        return view('admin.pages.edit',compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PagesRequests $request, $id)
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
            'name' => $input['name'],
            'desc' =>  $input['desc'],
            'image_name' =>  $imageName,
            'updated_by' => Auth::user()->id
        ];
        $result = $this->Pages::where('id',$id)->update($data);
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
        
        $row = $this->Pages::where('id',$id)->first()->toArray();
        if(!empty($row)){
            if($row['image_name']!=''){
                unlink($imagePath.'/'.$row['image_name']);
            }
            $result = $this->Pages::where('id',$id)->delete();
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
