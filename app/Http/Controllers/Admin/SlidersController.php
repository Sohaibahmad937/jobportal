<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Model\Sliders;
use DataTables;
class SlidersController extends Controller
{
    public function __construct(Sliders $Sliders)
    {
        $this->Sliders = $Sliders;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.sliders.index');   
    }

    public function SlidersList(){
        $pro = $this->Sliders::all();
        return DataTables::of($pro)
        ->addColumn('image',function($pro){
            $url = asset('slider_images').'/'.$pro->image_name;
            $image='<a href="'.$url.'" target="_blank"><image src="'.$url.'" style="width:150px"></a>';
            return $image;
        })
        ->addColumn('command',function($pro){
            $command = '';
            if(moduleacess('admin/sliders','edit')){
                $command.='<a href="#" onClick="GetModel('.$pro->id.',\''.route('admin.sliders.edit',$pro->id).'\')" class="btn mb-2 mr-2 rounded-circle btn-outline-primary" data-placement="top" title="Edit"><i class="fas fa-pencil-alt"></i></a> ';
            }
            if(moduleacess('admin/sliders','delete')){
                $command.='<form class="table_from" action="'.route("admin.sliders.destroy",$pro->id).'" method="POST">
                '.method_field('DELETE').'
                '.csrf_field().'
                <button type="submit" class="btn mb-2 mr-2 rounded-circle btn-outline-danger" onClick="return confirm(\'Do you realy want to delete this?\')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash-alt"></i></button>
            </form>';
            }
            return $command;
        })
        ->rawColumns(['command','image'])
        ->make(true);
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
       
        if($request->hasFile('myImages'))
        {
            $image = $request->file('myImages');
            $imagePath = public_path('/slider_images/');
            if (!file_exists($imagePath)) {
                mkdir($imagePath, 0775, true);
            }
            $imageName = md5(time().'_'.$image->getClientOriginalName()).'.'.$image->getClientOriginalExtension();
            $image->move($imagePath,$imageName);
            $imageData = [
                'image_name'		=> $imageName
            ];
            $this->Sliders::create($imageData);
            
        }
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
        $row = $this->Sliders::where('id',$id)->first();
        return view('admin.sliders.edit',compact('row','id'));
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
        $result = $this->Sliders::where('id',$id)->update([
            'title' => $request->title,
            'detail' => $request->detail,
            'link' => $request->link
        ]);

        if(!empty($result)){
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
        $info = $this->Sliders->where('id',$id)->first();
        if(!empty($info)){
            $url = public_path('slider_images').'/'.$info->image_name;
            if($info->image_name!=''){
                unlink($url);
                $result = $this->Sliders::where('id',$id)->delete();
                if($result){
                    return redirect()->back()->with(['success','Success']);
                }else{
                    return redirect()->back()->with(['error','Something went wrong']);
                }
            }else{
                return redirect()->back()->with(['error','Something went wrong']);
            }
        }else{
            return redirect()->back()->with(['error','Something went wrong']);
        }
    }
}
