<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Http\Model\Roles;
use DB;
class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = DB::table('roles')->where('id','!=',1)->get();
        return view('admin.roles.index',compact('roles'));
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
        if(moduleacess('admin/roles','add') == FALSE){
            session()->flash('error', "You dont have a permission");
            return Redirect::back();
        }
        $input = $request->all();
        //    print_r($input);

       $data = [
           'name' => $input['Title'],
           'createdate' => time()
       ];
       $result = Roles::create($data);
       if(!empty($result)){
            session()->flash('success', 'Role created!');
            return redirect()->route('admin.roles.index');
        }else{
            session()->flash('error', 'Something wend wrong');
            return redirect()->route('admin.roles.index');
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
        if(moduleacess('admin/roles','edit') == FALSE){
            session()->flash('error', "You dont have a permission");
            return Redirect::back();
        }
        $input = $request->all();
        $data = [
            'name' => $input['Title'],
        ];
        $result = Roles::where('id',$id)->update($data);
        if(!empty($result)){
             session()->flash('success', 'Role Updated!');
             return redirect()->route('admin.roles.index');
         }else{
             session()->flash('error', 'Something wend wrong');
             return redirect()->route('admin.roles.index');
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
        if(moduleacess('admin/roles','delete') == FALSE){
            session()->flash('error', "You dont have a permission");
            return Redirect::back();
        }

        $result = DB::table('roles')->where('id',$id)->delete();
        if(!empty($result)){
             session()->flash('success', 'Menu Deleted!');
             return redirect()->route('admin.roles.index');
         }else{
             session()->flash('error', 'Something wend wrong');
             return redirect()->route('admin.roles.index');
         }
    }

    public function RolePermissions($role_id,$parent_id){
        return view('admin.roles.RolePermissions',compact('role_id','parent_id'));
    }

    public function display_access(Request $request){
        $data = $request->all();
        return view('admin.roles.display_access',compact('data'));
    }
}
