@extends('layouts.admin')
@section('page_header')
<ul class="navbar-nav flex-row">
    <li>
        <div class="page-header">
            <div class="page-title">
                <h3>Categories</h3>
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
                            <h4>Categories</h4>
                            @if(moduleacess('admin/categories','add'))
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddModal"><i class="fa fa-plus" aria-hidden="true"></i> &nbsp;{{trans('label.New')}} {{trans('label.Categories')}}</button>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="widget-one">
                        <table id="CategoryList" class="table dt-table-hover dataTable" >
                            <thead>
                                <tr>
                                    <th>{{trans('label.Category Id')}}</th>
                                    <th class="not-mobile">{{trans('label.Categories Name')}}</th>
                                    <th class="not-mobile">{{trans('label.Parent Id')}}</th>
                                    <th class="not-mobile">{{trans('label.Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

        
<!-- Add Categories Model -->
<div class="modal fade" id="AddModal"   aria-labelledby="AddModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="AddModalLabel">{{trans('label.New')}} {{trans('label.Categories')}}</h5>
            </div>
            <div class="modal-body">
                <form name="AddCategory" id="AddCategory" >
                    {{ csrf_field() }}
                    <div class="mb-3">
                        <label for="parent_id" class="col-form-label">Parent:</label>
                        <select  class="form-control" name='parent_id' id="parent_id">
                            <option selected disabled>Select Parent</option>
                            @if(isset($cat))
                                    @foreach($cat as $id => $val)
                                        <option  value='{{$id}}'> {{ $val}} </option>
                                    @endforeach
                                @endif
                        </select>                
                    </div>
                    <div class="mb-3">
                        <label for="category_name" class="col-form-label">Category Name:<?=$required_span; ?></label>
                        <input class="form-control" type="text" name="category_name" id="category_name" required>
                    </div>
                    <button type="submit"  class="btn btn-primary  submit">{{trans('label.Save')}}</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End Add Categories Model -->

<div class="modal fade" id="ModalEdit" data-backdrop="static"></div>

@endsection


@section('script')
<script>
$(function() {
    var table_html = '';
    var table_html_td = '';
    var i = 1;
    var dt = $('#CategoryList').DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        ordering: false,
        ajax: '{!! route('admin.CategoriesList') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'category_name', name: 'category_name' },
            { data: 'parent_id', name: 'parent_id' },
            { data: 'command', name: 'command', searchable: false }
        ],
        "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
        "<'table-responsive'tr>" +
        "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
               "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 7

    });  
    
    $("#AddCategory").validate({
        submitHandler(form){
            var form_data = $('#AddCategory')[0];
            var form1 = new FormData(form_data);
            $.ajax({
                type: "POST",
                url: "{{route('admin.categories.store')}}",
                data: form1,
                contentType: false,
                processData: false,
                success: function( response ) {
                    console.log(response)
                    if(response.error == 0){
                        toastr.success(response.msg);
                        setTimeout(function(){
                            location.href = response.url;
                        },2000);
                    }else{
                        $(".submit").attr("disabled", false);
                        toastr.error(response.msg);
                    }
                },
                error: function(data){
                    $(".submit").attr("disabled", false);
                    var errors = data.responseJSON;
                    $.each( errors.errors, function( key, value ) {
                        var ele = "#"+key;
                        $(ele).addClass('error');
                        $('<label class="error">'+ value +'</label>').insertAfter(ele);
                    });
                }
            });
            return false;
        }
    });  

});

function EditModal(url) {
        $.ajax({
            url: url,
            method: 'GET',
            success: function(res) {
                $("#ModalEdit").html(res);
                $("#ModalEdit").modal('show');
            }
        });
    }
</script>
@endsection




