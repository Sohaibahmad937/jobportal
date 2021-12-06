<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Model\Categories;
use App\Http\Requests\Admin\CategoriesRequest;
use DataTables;


class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cat = Categories::pluck('category_name','id');
        return view('admin.categories.index',compact('cat'));
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
    public function store(CategoriesRequest $request)
    {
        $input = $request->all();
        //    dd($input);
        if($input['parent_id'] == null)
        {
            $category = Categories::create([
                'category_name'=> $input['category_name'],
                'parent_id'=> 0
            ]);

        }
        else
        {   
            $category = Categories::create([
                'category_name'=> $input['category_name'],
                'parent_id'=> $input['parent_id']
            ]);

        }

        return \Response::json(['msg'=>'Successfully added category','error'=>0]);

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
        $row = Categories::find($id);
        $cat = Categories::pluck('category_name','id');
        return view('admin.categories.edit',compact('row','cat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriesRequest $request, $id)
    {
        $category = Categories::find($id);
        $category->category_name = $request->category_name;
        $result = $category->update();
        if($result){
            return response()->json(['msg'=>'Success','error'=>0]);
        }
        else{
            return response()->json(['msg'=>'Something went wrong.','error'=>1]);
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
        $result = Categories::where('parent_id',$id)->delete();
        $result = Categories::where('id',$id)->delete();

        if(!empty($result)){
             session()->flash('success', 'category Deleted!');
             return redirect()->back();
         }else{
             session()->flash('error', 'Something wend wrong');
             return redirect()->back();
         }
    }

    public function CategoriesList()
    {
        $category = Categories::all();
        // dd($category);
        return DataTables::of($category)
            
            ->addColumn('command', function ($category) {
                $command = '';  
                if (moduleacess('admin/categories', 'edit')) {
                    $command.='<a href="javascript:void(0);" onclick = "EditModal(\''.url('admin/categories/'.$category->id.'/edit').'\')"  class="btn mb-2 mr-2 rounded-circle btn-outline-primary" data-placement="top" title="Edit"><i class="fas fa-pencil-alt"></i></a>';
                }
                if (moduleacess('admin/categories', 'delete')) {
                    $command .= '<form class="table_from" action="' . route("admin.categories.destroy", $category->id) . '" method="POST">
                ' . method_field('DELETE') . '
                ' . csrf_field() . '
                <button type="submit" class="btn mb-2 mr-2 rounded-circle btn-outline-danger" value="delete" onClick="return confirm(\'Are You Sure You Want To Delete This?\')"><i class="fas fa-trash-alt"></i> </button>
                </form>';
                }
                return $command;
            })
            ->rawColumns(['edit', 'command'])
            ->make(true);

    }
}
