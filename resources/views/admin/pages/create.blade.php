@extends('layouts.admin')
@section('page_header')
<ul class="navbar-nav flex-row">
    <li>
        <div class="page-header">
            <div class="page-title">
                <h3>Pages</h3>
            </div>
        </div>
    </li>
</ul>
@endsection
@section('content')
<?php $required_span = '<span class="text-red">*</span>';?>
<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing ">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>New Page</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area p-4">
                    <div class="widget-one">
                        <form method="POST" action="{{ route('admin.pages.store') }}" class="form-horizontal add_product" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="name">{{trans('label.Name')}}: <?=$required_span; ?></label>
                                        <input type="text" class="form-control {!! $errors->first('name', 'error') !!}" name="name" id="name" value="{{old('name')}}">
                                        {!! $errors->first('name', '<label class="error">:message</label>') !!}
                                    </div>
                                </div>
                                <!-- col-lg-6 -->
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="desc">{{trans('label.Desc')}}: <?=$required_span; ?></label>
                                        <textarea type="text" name="desc" id="desc" >{{old('desc')}}</textarea>
                                        
                                    </div>
                                </div>
                                <!-- col-lg-12 -->
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="image_name">{{trans('label.Images')}}:</label>
                                        <input type="file" class="form-control" name="image_name" id="image_name">
                                    </div>
                                </div>
                                <!-- col-lg-12 -->
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="col-sm-9 col-sm-offset-3">
                                            <button type="submit" class="btn btn-primary btn-flat submit">{{trans('label.Save')}}</button>
                                            <a href="{{url('/admin/pages')}}" class="btn btn-flat btn-default">{{trans('label.Back')}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
CKEDITOR.replace( 'desc' );
$(".add_product").validate({
    submitHandler(form){
        $(".submit").attr("disabled", true);
        var form_cust = $('.add_product')[0]; 
        let form1 = new FormData(form_cust);
        var desc = CKEDITOR.instances.desc.getData();
        form1.append('desc',desc);
        $.ajax({
            type: "POST",
            url: '{{route('admin.pages.store')}}',
            data: form1,//$('.add_product').serialize(),
            contentType: false,
            processData: false,
            success: function( response ) {
                if(response.error == 0){
                    toastr.success(response.msg);
                    setTimeout(function(){
                        location.href = '{{url('admin/pages')}}';
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
        })
        return false;
    }
});
</script>
@stop