<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use DB;
class MainMenusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = DB::table('main_menues')->get();
        return view('admin.menus.index',compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        echo 'h';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $input = $request->all();
        //    print_r($input);

       $data = [
           'name' => $input['Title'],
           'createdate' => time()
       ];
       $result = DB::table('main_menues')->insert($data);
       if(!empty($result)){
            session()->flash('success', 'Menu created!');
            return redirect()->route('admin.menus.index');
        }else{
            session()->flash('error', 'Something wend wrong');
            return redirect()->route('admin.menus.index');
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
        //
        $input = $request->all();
        $data = [
            'name' => $input['Title']
        ];
        $result = DB::table('main_menues')->where('main_id',$id)->update($data);
        if(!empty($result)){
             session()->flash('success', 'Menu Updated!');
             return redirect()->route('admin.menus.index');
         }else{
             session()->flash('error', 'Something wend wrong');
             return redirect()->route('admin.menus.index');
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
        $result = DB::table('main_menues')->where('main_id',$id)->delete();
        if(!empty($result)){
             session()->flash('success', 'Menu Deleted!');
             return redirect()->route('admin.menus.index');
         }else{
             session()->flash('error', 'Something wend wrong');
             return redirect()->route('admin.menus.index');
         }
    }

    public function ManageMenus($id){
        $main_menu = DB::table('main_menues')->where('main_id',$id)->first();
        $menus = DB::table('menus')->where('main_menu_id',$id)->orderBy('sort')->get();
        $menu_id = $id;
        return view('admin.menus.ManageMenus',compact('main_menu','menus','menu_id'));
    }

    public function menu_insert(Request $request){
        $input = $request->all();
        if(!isset($input['Pages']))$input['Pages'] = NULL;
        if(!isset($input['Pages']))$input['Pages'] = NULL;
        if($input['id'] != ''){
            $update_data = [
                'menu_title' => $input['label'],
                'link' => $input['Link'],
                'main_menu_id' => $input['main_menu_id'],
                'Target' => $input['Target'],
                'publish' => $input['publish'],
                'menu_type' => $input['Page_Link'],
                'icons' => $input['icons']
            ];
            DB::table('menus')->where('menu_id',$input['id'])->update($update_data);
            $arr['type']  = 'edit';
            $arr['menu_title'] = $input['label'];
            $arr['link']  = $input['Link'];
            $arr['main_menu_id']    = $input['main_menu_id'];
            $arr['icons']    = $input['icons'];
            $arr['Target']    = $input['Target'];
            $arr['menu_type']    = $input['Page_Link'];
            $arr['menu_id']    = $input['id'];
        } else {
            $data_insert = [
                'menu_title' => $input['label'],
                'link' => $input['Link'],
                'main_menu_id' => $input['main_menu_id'],
                'Target' => $input['Target'],
                'publish' => $input['publish'],
                'menu_type' => $input['Page_Link'],
                'icons' => $input['icons']
            ];
            $insert_id = DB::table('menus')->insertGetId($data_insert);
            $arr['menu'] = '<li class="dd-item dd3-item" data-id="'.$insert_id.'" >
                                <div class="dd-handle dd3-handle">&nbsp;</div>
                                <div class="dd3-content">
                                    <span id="label_show'.$insert_id.'">'.$input['label'].'</span>
                                    <span class="span-right">
                                        <a class="edit-button btn btn-primary btn-sm btn-flat dlbtn'.$insert_id.'" id="'.$insert_id.'" label="'.$input['label'].'" link="'.$input['Link'].'" page_link="'.$input['Page_Link'].'"
                                        icons="'.$input['icons'].'"
                                        Target="'.$input['Target'].'" publish="'.$input['publish'].'" style="padding: 1px 7px;"><i class="fas fa-pencil-alt"></i></a>  <a class="del-button btn btn-danger btn-sm btn-flat" id="'.$insert_id.'" style="padding: 1px 7px;"><i class="fa fa-trash"></i></a>
                                    </span> 
                                </div>';
            $arr['type'] = 'add';
        }
        print json_encode($arr);
    }

    public function menu_save(Request $request){
        $input = $request->all();
        $data = json_decode($input['data']);
        function parseJsonArray($jsonArray, $parentID = 0) {
          $return = array();
          foreach ($jsonArray as $subArray) {
            $returnSubSubArray = array();
            if (isset($subArray->children)) {
                $returnSubSubArray = parseJsonArray($subArray->children, $subArray->id);
            }
        
            $return[] = array('id' => $subArray->id, 'parentID' => $parentID);
            $return = array_merge($return, $returnSubSubArray);
          }
          return $return;
        }
        
        $readbleArray = parseJsonArray($data);
        $i=0;
        foreach($readbleArray as $row){
          $i++;
          $data_update = [
           'parent_menu_id' => $row['parentID'], 
           'sort' => $i, 
          ];
          DB::table('menus')->where('menu_id',$row['id'])->update($data_update);
        }
    }

    public function menu_delete(Request $request){
        $input = $request->all();
        function recursiveDelete($id) {
            $result = DB::table('menus')->select('menu_id')->where('parent_menu_id',$id)->get();
            if(!empty($result)){
               foreach($result as $current) {
                    recursiveDelete($current->menu_id);
               }
            }
            DB::table('menus')->where('menu_id',$id)->delete();
        }
        recursiveDelete($input['id']);
    }
}
