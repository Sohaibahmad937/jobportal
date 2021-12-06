@extends('layouts.admin')
@section('page_header')
<ul class="navbar-nav flex-row">
    <li>
        <div class="page-header">
            <nav class="breadcrumb-one" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Administration</a></li>
					<li class="breadcrumb-item"><a href="#">Roles</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>Permission</span></li>
                </ol>
            </nav>
        </div>
    </li>
</ul>
@endsection
@section('content')
<div id="load"></div>
<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
            <div class="widget-content widget-content-area p-4 float-left w-100">
                <div class="widget-one">
                   	<div id="RETURN_DATA" style="color:#c00;font-weight:bolder;font-size:16px;"></div>
		    		<div id="return_users_access" style="width:100%;float:left;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
	function viewData(){
	    var role_id = <?php echo $role_id;?>;
	    var parent_id = <?php echo $parent_id;?>;
	    $("#load").show();
	    $.ajax({
		    type: 'GET',
		    data: {role_id:role_id,parent_id:parent_id},
		    url:  "<?php echo route('admin.display_access')?>",
		    success: function(data){
			    $('#return_users_access').html(data);
			    $("#load").hide();
			}
		});
    }
	
  $(document).ready(function(){
	    viewData()
	    $(document).on("click","#Add",function() {
		    $("#load").show();
            var module_link = $(this).attr('module_link');
			var module_id = $(this).attr('module_id');
		    var role_id = $(this).attr('role_id');
		    var forwhat = $(this).attr('forwhat');
		    if($(this).is(":checked")){
		        var valueck = "1";
		    }else{
			    var valueck = "0";
			}
		    $.ajax({
		        type: 'GET',
                data: {module_link:module_link,module_id:module_id,role_id:role_id,forwhat:forwhat,valueck:valueck,option:'For_access'},
		        url:  "<?php echo route('admin.display_access')?>",
		        success: function(msg){
			        $('#RETURN_DATA').show();
                    $('#RETURN_DATA').html(msg);
			        viewData();
			    }		
            });
        
	    });
  });
 </script>
 
@stop