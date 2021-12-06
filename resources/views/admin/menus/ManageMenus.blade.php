@extends('layouts.admin')
@section('page_header')
<ul class="navbar-nav flex-row">
    <li>
        <div class="page-header">
            <nav class="breadcrumb-one" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{url('/admin/menus')}}">Menus</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>Manage Menus</span></li>
                </ol>
            </nav>
        </div>
    </li>
</ul>
@endsection

@section('content')    
<link rel="stylesheet" type="text/css" href="{{asset('admin_assets/css/nestable.css')}}">    
<div id="load"></div>  
<div class="layout-px-spacing">
  <div class="row layout-top-spacing">
    <div class="col-xl-6 col-lg-6 col-md-12 col-6 layout-spacing ">
      <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>{{trans('label.Menus For')}} {{$main_menu->name}}</h4>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area p-4">
          <div class="widget-one">
            <div id="error_div"></div>
            <div class="form-group col-lg-12">
              <label for="label" class="col-sm-3 control-label" style="padding-right:0px;">Menu Name:<span style="color:red;">*</span></label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="label" placeholder="Enter Menu Name" name="label">
              </div>
            </div>
            <div class="form-group col-lg-12">
                <label for="publish" class="col-sm-3 control-label">Publish:</label>
                <div class="col-sm-9">
                  <select class="form-control" id="publish" name="publish">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                  </select>
                </div>
            </div>
            <div class="form-group col-lg-12">
                <label for="Page_Link" class="col-sm-3 control-label">Page/Link:</label>
                <div class="col-sm-9">
                  <select class="form-control" id="Page_Link" name="Page_Link" onChange="Page_or_Link(this);">
                    <option value="">Please Select</option>
                    <option value="3">Root Menu</option>
                    <option value="2">Link</option>
                  </select>
                </div>
            </div>
            <div class="form-group col-lg-12" style="display:none;" id="EN_Links">
                <label for="Link" class="col-sm-3 control-label">Link:</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="Link" placeholder="Enter Link" name="Link">
                </div>
            </div>
            <div class="form-group col-lg-12">
                <label for="Link" class="col-sm-3 control-label">Menu Icon:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="icons" placeholder="Enter Menu Icon" name="icons">
                </div>
            </div>
            <div class="form-group col-lg-12">
                <label for="Target" class="col-sm-3 control-label">Target:</label>
                <div class="col-sm-9">
                    <select class="form-control" id="Target" name="Target">
                      <option value="_self">Open in same window</option>
                      <option value="_blank">Open in new window</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-12">
              <div class="col-sm-offset-3 col-sm-9">
                <button id="submit" class="btn btn-primary btn-flat">Submit</button>
                <button id="reset" class="btn btn-warning btn-flat">Reset</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-12 col-6 layout-spacing ">
      <input type="hidden" id="id">
      <div class="cf nestable-lists">
        <div class="dd" id="nestable">
          <?php
            $ref   = [];
            $items = [];
            foreach($menus as $data) {
              $thisRef = &$ref[$data->menu_id];
              $thisRef['parent_menu_id'] = $data->parent_menu_id;
              $thisRef['menu_title'] = $data->menu_title;
              $thisRef['menu_id'] = $data->menu_id;
              $thisRef['link'] = $data->link;
              $thisRef['menu_type'] = $data->menu_type;
              $thisRef['Target'] = $data->Target;
              $thisRef['publish'] = $data->publish;
              $thisRef['icons'] = $data->icons;
              if($data->parent_menu_id == 0) {
                    $items[$data->menu_id] = &$thisRef;
              } else {
                    $ref[$data->parent_menu_id]['child'][$data->menu_id] = &$thisRef;
              }
            }
            function get_menu($items,$class = 'dd-list') {
              $html = "<ol class=\"".$class."\" id=\"menu-id\">";
              foreach($items as $key=>$value) {
                $html.= '<li class="dd-item dd3-item" data-id="'.$value['menu_id'].'" >
                    <div class="dd-handle dd3-handle">&nbsp;</div>
                    <div class="dd3-content"><span id="label_show'.$value['menu_id'].'">'.$value['menu_title'].'</span> 
                        <span class="span-right" id="span-right'.$value['menu_id'].'">
                            <a class="edit-button btn btn-primary btn-sm btn-flat dlbtn'.$value['menu_id'].'" id="'.$value['menu_id'].'" label="'.$value['menu_title'].'" link="'.$value['link'].'" page_link="'.$value['menu_type'].'" icons="'.$value['icons'].'" Target="'.$value['Target'].'" publish="'.$value['publish'].'" style="padding: 1px 7px;"><i class="fas fa-pencil-alt"></i></a>  <a class="del-button btn btn-danger btn-sm btn-flat" id="'.$value['menu_id'].'" style="padding: 1px 7px;"><i class="fa fa-trash"></i></a>
                        </span> 
                    </div>';
                    if(array_key_exists('child',$value)) {
                        $html .= get_menu($value['child'],'dd-list');
                    }
                $html .= "</li>";
              }
              $html .= "</ol>";
              return $html;
            }
            print get_menu($items);
          ?>
        </div>
      </div>
      <p></p>
      <input type="hidden" id="nestable-output">
      <button id="save" class="btn btn-primary btn-flat">Save</button>
    </div>
  </div>
</div>
@endsection
@section('script')
<script src="{{asset('admin_assets/js/jquery.nestable.js')}}"></script>
<script>
$(document).ready(function()
{
    var updateOutput = function(e)
    {
        var list   = e.length ? e : $(e.target),
            output = list.data('output');
        if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
        } else {
            output.val('JSON browser support required for this demo.');
        }
    };
    // activate Nestable for list 1
    $('#nestable').nestable({
        group: 1
    })
    .on('change', updateOutput);
    // output initial serialised data
    updateOutput($('#nestable').data('output', $('#nestable-output')));
    $('#nestable-menu').on('click', function(e)
    {
        var target = $(e.target),
            action = target.data('action');
        if (action === 'expand-all') {
            $('.dd').nestable('expandAll');
        }
        if (action === 'collapse-all') {
            $('.dd').nestable('collapseAll');
        }
    });
});
</script>
<script>
  $(document).ready(function(){
    $("#load").hide();
    $("#submit").click(function(){
      if($("#label").val() == '' ){
        alert('Menu Name required');
        return false;
      }
      $("#load").show();
      var dataString = { 
        label : $("#label").val(),
        Link : $("#Link").val(),
        icons : $("#icons").val(),
        Pages : $("#Pages").val(),
        Target : $("#Target").val(),
        Page_Link: $("#Page_Link").val(),
        publish : $("#publish").val(),
        id : $("#id").val(),
        main_menu_id: <?php echo $menu_id;?>
      };
      $.ajax({
        type: "POST",
        url: "<?php echo route('admin.menu_insert');?>",
        data: dataString,
        dataType: "json",
        cache : false,
        success: function(data){
          if(data.type == 'add'){
              $("#menu-id").append(data.menu);
          } else if(data.type == 'edit'){
            location. reload(true);
            $('#label_show'+data.menu_id).html(data.menu_title);
          }else if(data.type == 'error'){
				    $('#error_div').html(data.error);
			    }
          $('#label').val('');
          $('#Link').val('');
			    $('#icons').val('');
			    $('#Pages').val('');
			    $('#Page_Link').val('');
		      $('#publish').val('1');
          $('#Target').val('_self');
			    $('#id').val('');
          $("#load").hide();
			    $('div#EN_Links').hide();
			    $('div#SL_pages').hide();
        } ,error: function(xhr, status, error) {
            alert(error);
        },
      });
	
    });
    $('.dd').on('change', function() {
        $("#load").show();
        var dataString = { 
          data : $("#nestable-output").val(),
        };
        $.ajax({
          type: "POST",
          url: "{{route('admin.menu_save')}}",
          data: dataString,
          cache : false,
          success: function(data){
            $("#load").hide();
          } ,error: function(xhr, status, error) {
            alert(error);
          },
        });
    });
    $("#save").click(function(){
        $("#load").show();
        var dataString = { 
          data : $("#nestable-output").val(),
        };
        $.ajax({
          type: "POST",
          url: "<?php echo route('admin.menu_save');?>",
          data: dataString,
          cache : false,
          success: function(data){
            $("#load").hide();
            alert('Data has been saved');
        
          } ,error: function(xhr, status, error) {
            alert(error);
          },
        });
    });
 
    $(document).on("click",".del-button",function() {
        var x = confirm('Delete this menu?');
        var id = $(this).attr('id');
        if(x){
          $("#load").show();
          $.ajax({
            type: "POST",
            url: "<?php echo route('admin.menu_delete');?>",
            data: { id : id },
            cache : false,
            success: function(data){
              $("#load").hide();
              $("li[data-id='" + id +"']").remove();
            } ,error: function(xhr, status, error) {
              alert(error);
            },
          });
        }
    });
	
	
    $(document).on("click",".edit-button",function() {
      var id = $(this).attr('id');
      var label = $(this).attr('label');
      var link = $(this).attr('link');
		  var icons = $(this).attr('icons');
		  var page_id = $(this).attr('page_id');
		  var Page_Link = $(this).attr('page_link');
		  var target = $(this).attr('target');
		  var publish = $(this).attr('publish');
		  $("#publish").val(publish);
		  if(Page_Link==='2'){
        $('div#EN_Links').show();
        $('div#SL_pages').hide();
        $("#Link").val(link);
		  }else if(Page_Link==='1'){
			  $('div#EN_Links').hide();
			  $('div#SL_pages').show();	
  			$("#Pages").val(page_id);
		  }else{
			  $('div#EN_Links').hide();
			  $('div#SL_pages').hide();
      }
        $("#id").val(id);
        $("#label").val(label);
        $("#icons").val(icons);
        $("#Page_Link").val(Page_Link);
		    $("#Target").val(target);
    });
    $(document).on("click","#reset",function() {
      $('#label').val('');
      $('#Link').val('');
		  $('#icons').val('');
	    $('#Pages').val('');
	    $('#Page_Link').val('');
	    $('#Target').val('_self');
	    $('#publish').val('1');
	    $('#id').val('');
	    $('div#EN_Links').hide();
	    $('div#SL_pages').hide();
    });
  });
function Page_or_Link(id){
		var val= id.value;
		if(val==='2'){
			$('div#EN_Links').show();
			$('div#SL_pages').hide();
		}else if(val==='1'){
			$('div#EN_Links').hide();
			$('div#SL_pages').show();	
		 }else{
			 $('div#EN_Links').hide();
			$('div#SL_pages').hide();
			 }	
	}
</script>
@stop