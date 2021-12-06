@extends('layouts.admin')
@section('page_header')
<ul class="navbar-nav flex-row">
    <li>
        <div class="page-header">
            <div class="page-title">
                <h3>Menus</h3>
            </div>
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
                          <h4>Menus</h4>
                          <a href="#" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#addMenu"><i class="fa fa-plus" aria-hidden="true"></i> &nbsp;{{trans('label.New')}} {{trans('label.Menu')}}</a>
                      </div>
                  </div>
              </div>
              <div class="widget-content widget-content-area">
                  <div class="widget-one">
                    <table id="example" class="table dt-table-hover dataTable">
                      <thead>
                        <tr>
                          <th>{{trans('label.No')}}</th>
                          <th>{{trans('label.Menu Name')}}</th>
                          <th class="not-mobile" style="text-align:center;">{{trans('label.Date Published')}}</th>
                          <th class="not-mobile" >{{trans('label.Action')}}</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $i=1;
                          foreach($menus as $row){
                            $Name=$row->name;
                        ?>
                          <tr>
                            <td>{{$i}}</td>
                            <td><span class="page_title_span">{{$Name}}</span></td>
                            <td style="text-align:center;">{{date('d-M-y',$row->createdate)}}</td>
                            <td>
                              <a href="#" class="btn mb-2 mr-2 rounded-circle btn-outline-primary" data-toggle="modal" data-target="#updateMenu{{$row->main_id}}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                              <a class="btn mb-2 mr-2 rounded-circle btn-outline-dark" href="{{route('admin.ManageMenus',$row->main_id)}}" data-toggle="tooltip" data-placement="top" title="Manage Menus"><i class="fas fa-clipboard-list"></i></a>
                              <form class="table_from" action="{{route('admin.menus.destroy',$row->main_id)}}" method="POST">
                                {{method_field('DELETE')}}
                                {{csrf_field()}}
                                <button type="submit" class="btn mb-2 mr-2 rounded-circle btn-outline-danger" value="delete" onClick="return confirm('Are You Sure You Want To Delete This Menu?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash-alt"></i></button>
                              </form>
                            </td>
                          </tr>
                        <?php
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
      foreach($menus as $row){
        $Name=$row->name;
    ?>
        <div class="modal fade" id="updateMenu{{$row->main_id}}">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
              <h4 class="modal-title">{{trans('label.Edit')}} {{trans('label.Menu')}} </h4>  
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                
              </div>
              <!-- modal-header -->
              <div class="modal-body">
                <div id="return_data"></div>
                <form class="form-horizontal" method="POST" action="{{route('admin.menus.update',$row->main_id)}}">
                  @csrf
                  <input name="_method" type="hidden" value="PATCH">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="Title" class="col-sm-4 control-label">{{trans('label.Menu')}} {{trans('label.Name')}}:</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="Title" name="Title" value="{{$row->name}}">	
                      </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10 no-padding">
                      <button type="submit" class="btn btn-primary btn-flat">{{trans('label.Update')}}</button>
                    </div>
                  </div>
                  <!-- /.box-body -->
                </form>
              </div>
              <!-- modal-body -->
              <div class="modal-footer">
                <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
              </div>
              <!-- modal-footer -->
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    <?php
      }
    ?>

    <div class="modal fade" id="addMenu">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">{{trans('label.New')}} {{trans('label.Menu')}}</h4>  
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <i class="fas fa-times"></i>
              </button>
              
            </div>
            <div class="modal-body">
              <form class="form-horizontal validate_form" method="post" action="{{route('admin.menus.store')}}" >
                @csrf
                <div class="box-body">
                  <div class="form-group">
                    <label for="Title" class="col-sm-4 control-label">{{trans('label.Menu')}} {{trans('label.Name')}}: <?=$required_span; ?></label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="Title" name="Title" required>	
                    </div>
                  </div>
                  <div class="col-sm-offset-4 col-sm-8">
                    <button type="submit" class="btn btn-primary btn-flat">{{trans('label.Save')}}</button>
                  </div>
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
      <!-- /.modal -->

@stop
