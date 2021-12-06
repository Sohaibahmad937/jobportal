@extends('layouts.admin')
@section('page_header')
<ul class="navbar-nav flex-row">
    <li>
        <div class="page-header">
            <nav class="breadcrumb-one" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Administration</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>Roles</span></li>
                </ol>
            </nav>
        </div>
    </li>
</ul>
@endsection
@section('content')
<?php
  $required_span='<span style="color:red;">*</span>';
?>
<div class="layout-px-spacing">
  <div class="row layout-top-spacing">
    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing ">
      <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>Roles</h4>
                    @if(moduleacess('admin/roles','add'))
                    <a href="#" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#addMenu">New Role</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area">
            <div class="widget-one">
              <table id="example" class="table dt-table-hover dataTable">
                <thead>
                  <tr>
                    <th >No</th>
                    <th >Role</th>
                    <th >Date Published</th>
                    <th >Command</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                      $i=1;
                      foreach($roles as $row){
                        $Name=$row->name;
                        echo'<tr>
                          <td>'.$i.'</td>
                          <td>'.$Name.'</td>
                          <td >'.date('d-M-y',strtotime($row->created_at)).'</td>
                          <td>';
                            if(moduleacess('admin/roles','edit')){
                              echo'<a class="btn mb-2 mr-2 rounded-circle btn-outline-primary"  href="#" data-toggle="modal" data-target="#updateMenu'.$row->id.'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-pencil-alt"></i></a>';
                            }
                            echo'&nbsp;<a class="btn mb-2 mr-2 rounded-circle btn-outline-dark" href="'.route("admin.RolePermissions",[$row->id,'0']).'" data-toggle="tooltip" data-placement="top" title="Give Access"><i class="far fa-eye"></i></a>';
                          echo' </td>
                        </tr>';
                        $i++;
                      }
                    ?>
                </tbody>
              </table>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
#-------------------------------
#Model Starts		  
		  echo' <div class="modal fade" id="addMenu">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">New Role</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              </div>
              <div class="modal-body">
			        <!-- form start -->
            <form class="form-horizontal validate_form" method="post" action="'.route('admin.roles.store').'" >';
            ?>
             @csrf
            <?php
              echo'<div class="box-body">
                <div class="form-group">
                  <label for="Title">Role Name:'.$required_span.'</label>
                  <input type="text" class="form-control" id="Title" placeholder="Title" name="Title" required>	
                </div>
                  <button type="submit" class="btn btn-primary btn-flat">Publish</button>
              </div>
              <!-- /.box-body -->
              
              
            </form>
			
              
              
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->';
#-------------------------------
#Model Ends
               
				foreach($roles as $row){
					$Name=$row->name;
					
					#-------------------------------
          #UPDATE Model Starts		  
                echo' <div class="modal fade" id="updateMenu'.$row->id.'">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Menu</h4>  
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                  
                <div id="return_data"></div>
                  <!-- form start -->
                      <form class="form-horizontal" method="POST" action="'.route('admin.roles.update',$row->id).'">';
                      ?>
                      @csrf
                      
                        <?php echo'<input name="_method" type="hidden" value="PATCH">
                        <div class="box-body">
                          <div class="form-group">
                            <label for="Title">Menu Name:</label>
                            <input type="text" class="form-control" id="Title" placeholder="Title" name="Title" value="'.$row->name.'">	
                          </div>
                          <button type="submit" class="btn btn-primary btn-flat">Update</button>
                  
                        </div>
                        <!-- /.box-body -->
                        
                        
                      </form>
                
                        
                        
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.modal -->';
          #-------------------------------
          #UPDATE Model Ends
				}
?>
@endsection