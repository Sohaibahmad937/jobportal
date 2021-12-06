       
<?php

if(isset($data['option'])=='For_access'){
	$role_id = $data['role_id'];
    $module_link = $data['module_link'];
    $module_id = $data['module_id'];
	$forwhat= $data['forwhat'];
	$valueck= $data['valueck'];
	$row_access = DB::table('role_privilege')->where('role_id',$role_id)->where('module_id',$module_id)->count();
        if($row_access>0){
            $data_update =[
                $forwhat => $valueck
            ];

            DB::table('role_privilege')->where('role_id',$role_id)->where('module_id',$module_id)->update($data_update);
            echo'Updated';
        }else{
            $data_insert = [
                'role_id' => $role_id,
                $forwhat => $valueck,
                'module_link' => $module_link,
                'module_id' => $module_id
            ];
            DB::table('role_privilege')->insert($data_insert);
            echo'Inserted';
        }
	}else{
	 $role_id = $data['role_id'];
	 $parent_id = $data['parent_id'];
    echo '<table class="table" style="text-align: center;">
            <thead>
                <tr>
                    <th>#</th>
                    <th >Module Name</th>
                    <th >Sub Level</th>
                    <th ><i class="fa fa-gift fa-2x" style="color:#19a15f;font-size: 20px;"></i> Module</th>
                    <th ><i class="fa fa-plus fa-2x" style="color:#19a15f;font-size: 20px;"></i> Add </th>
                    <th ><i class="fas fa-pencil-alt fa-2x" style="color:#4c8cf5;font-size: 20px;"></i> Edit </th>
                    <th ><i class="fa fa-eye fa-2x" style="color:#e06326;font-size: 20px;"></i> View</th>
                    <th ><i class="fa fa-trash fa-2x" style="color:#d80a0a;font-size: 20px;"></i> Delete</th>
                    <th ><i class="fa fa-print fa-2x" style="color:#4c8393;font-size: 20px;"></i> Print</th>
                </tr>
                </thead>
                <tbody>';
					  $module=DB::table('menus')->where('parent_menu_id',$parent_id)->where('main_menu_id',3)->orderBy('sort','ASC')->get();
					  $i=1;
					  foreach($module as $row){
						    $what = "";
						    $whatadd = "";
						    $whatedit = "";
						    $whatview = "";
						    $whatdelete = "";
						    $whatprint = "";
						    $role_privilege_id="";
                            $row_access=DB::table('role_privilege')->where('role_id',$role_id)->where('module_id',$row->menu_id)->first();
                            if($row_access){		
                                if($row_access->access==1) $what = "checked";
                                if($row_access->add==1) $whatadd = "checked";
                                if($row_access->edit==1) $whatedit = "checked";
                                if($row_access->view==1) $whatview = "checked";
                                if($row_access->delete==1) $whatdelete = "checked";
                                if($row_access->print==1) $whatprint = "checked";
                                $role_privilege_id = $row_access->id;
                            }
                        echo '<tr>
                          <th scope="row" style="padding-top:20px;">'.$i.'</th>
                          <td style="padding-top:20px;text-align:left;">'.$row->menu_title.'<input type="hidden" name="module[]" value="'.$row->link.'"/></td>';
						  echo '<td style="text-align: left;">
							  '.($row->menu_type=='3'?'<a href="'.route("admin.RolePermissions",[$role_id,$row->menu_id]).'"><i class="fa fa-clone pointer" style="font-size: 35px;" ></i></a>':'<i class="fa fa-window-close" style="font-size: 35px;"></i>').'
						  </td>';
						  echo '<td >
                                <label class="containerck">
                                    <input type="checkbox" '.$what.' id="Add"  style="zoom:1.5;" module_link="'.$row->link.'" role_id = '.$role_id.' forwhat = "access" module_id="'.$row->menu_id.'"> 
                                 <span class="checkmark"></span>
                                <label>
						  </td>';
						  
						  echo '<td >
							    <label class="containerck">
                                    <input type="checkbox" '.$whatadd.' id="Add"  style="zoom:1.5;" module_link="'.$row->link.'" role_id = '.$role_id.' forwhat = "add" module_id="'.$row->menu_id.'"><span class="checkmark"></span>
                                </label>
								
						  </td>';
						  echo '<td >
							<label class="containerck">
							    <input type="checkbox" '.$whatedit.' id="Add"  style="zoom:1.5;" module_link="'.$row->link.'" role_id = '.$role_id.' forwhat = "edit" module_id="'.$row->menu_id.'"><span class="checkmark"></span>
							<label>
							
						  </td>';
						  echo '<td >
							    <label class="containerck">
                                    <input type="checkbox" '.$whatview.' id="Add"  style="zoom:1.5;" module_link="'.$row->link.'" role_id = '.$role_id.' forwhat = "view" module_id="'.$row->menu_id.'"><span class="checkmark"></span>
                                </label>
								
						  </td>';
						  echo '<td >
							    <label class="containerck">
                                    <input type="checkbox" '.$whatdelete.' id="Add"  style="zoom:1.5;" module_link="'.$row->link.'" role_id = '.$role_id.' forwhat = "delete" module_id="'.$row->menu_id.'"><span class="checkmark"></span> 
                                </label>
                          </td>';
                          echo '<td >
							    <label class="containerck">
                                    <input type="checkbox" '.$whatprint.' id="Add"  style="zoom:1.5;" module_link="'.$row->link.'" role_id = '.$role_id.' forwhat = "print" module_id="'.$row->menu_id.'"><span class="checkmark"></span> 
                                </label>
						  </td>';
						 
						 echo' </tr>';
						$i++;					  
					  }
                      echo '</tbody>
                    </table>';
}
?>