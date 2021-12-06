@extends('layouts.admin')
@section('page_header')
<ul class="navbar-nav flex-row">
    <li>
        <div class="page-header">
            <nav class="breadcrumb-one" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>Home Page Settings</span></li>
                </ol>
            </nav>
        </div>
    </li>
</ul>
@endsection
@section('content')
@php $required_span ='<span style="color:red">*</span>'; @endphp
    <form method="POST" action="{{ route('admin.home_page_settings.update',$row['id']) }}" class="form-horizontal" enctype="multipart/form-data">
        <input name="_method" type="hidden" value="PATCH">
        @csrf
        <div class="layout-px-spacing">
            <div class="row layout-top-spacing">
                <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing ">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Site Logo</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area p-4">
                            <div class="widget-one">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="site_logo" class="col-sm-3 control-label">Logo:</label>
                                            <div class="col-sm-9">
                                                @if($row['site_logo'] != '')
                                                    <image src="{{asset('home_page_images')}}/{{$row['site_logo']}}" class="img-responsive" style="max-height:150px;">
                                                @endif
                                                <input type="file" class="form-control" name="site_logo" id="site_logo">
                                                <input type="hidden" value="{{$row['site_logo']}}" class="form-control" name="site_logo_hidden" id="banner_1_hidden">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row layout-top-spacing">
                <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing ">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Banners</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area p-4">
                            <div class="widget-one">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="banner_1" class="col-sm-3 control-label">Banner 1:</label>
                                            <div class="col-sm-9">
                                                @if($row['banner_1'] != '')
                                                    <image src="{{asset('home_page_images')}}/{{$row['banner_1']}}" class="img-responsive" style="max-height:150px;">
                                                @endif
                                                <input type="file" class="form-control" name="banner_1" id="banner_1">
                                                <input type="hidden" value="{{$row['banner_1']}}" class="form-control" name="banner_1_hidden" id="banner_1_hidden">
                                                
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="banner_1_link" class="col-sm-3 control-label">Banner 1 Link:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="banner_1_link" id="banner_1_link" value="{{$row['banner_1_link']}}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="banner_2" class="col-sm-3 control-label">Banner 2:</label>
                                            <div class="col-sm-9">
                                                @if($row['banner_2'] != '')
                                                    <image src="{{asset('home_page_images')}}/{{$row['banner_2']}}" class="img-responsive" style="max-height:150px;">
                                                @endif
                                                <input type="file" class="form-control" name="banner_2" id="banner_2">
                                                <input type="hidden" value="{{$row['banner_2']}}" class="form-control" name="banner_2_hidden" id="banner_2_hidden">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="banner_2_link" class="col-sm-3 control-label">Banner 2 Link:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="banner_2_link" id="banner_2_link" value="{{$row['banner_2_link']}}">
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <!-- col-lg-6 -->
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="banner_3" class="col-sm-3 control-label">Banner 3:</label>
                                            <div class="col-sm-9">
                                                @if($row['banner_3'] != '')
                                                    <image src="{{asset('home_page_images')}}/{{$row['banner_3']}}" class="img-responsive" style="max-height:150px;">
                                                @endif
                                                <input type="file" class="form-control" name="banner_3" id="banner_3">
                                                <input type="hidden" value="{{$row['banner_3']}}" class="form-control" name="banner_3_hidden" id="banner_3_hidden">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="banner_3_link" class="col-sm-3 control-label">Banner 3 Link:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="banner_3_link" id="banner_3_link" value="{{$row['banner_3_link']}}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="banner_4" class="col-sm-3 control-label">Banner 4:</label>
                                            <div class="col-sm-9">
                                                @if($row['banner_4'] != '')
                                                    <image src="{{asset('home_page_images')}}/{{$row['banner_4']}}" class="img-responsive" style="max-height:150px;">
                                                @endif
                                                <input type="file" class="form-control" name="banner_4" id="banner_4">
                                                <input type="hidden" value="{{$row['banner_4']}}" class="form-control" name="banner_4_hidden" id="banner_4_hidden">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="banner_4_link" class="col-sm-3 control-label">Banner 4 Link:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="banner_4_link" id="banner_4_link" value="{{$row['banner_4_link']}}">
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <!-- col-lg-6 -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row layout-top-spacing">
                <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing ">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Other Settings</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area p-4">
                            <div class="widget-one">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="home_content" class="col-sm-12">Home Contect:</label>
                                            <div class="col-sm-12">
                                                <textarea type="text" class="ckeditor" name="home_content" id="home_content">
                                                    {{$row['home_content']}}
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- col-lg-12 -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-flat">{{trans('global.Update')}}</button>
            <a href="{{url('/admin/home_page_settings')}}" class="btn btn-danger btn-flat">{{trans('global.Cancel')}}</a>
        </div>
        
    </form>

@endsection

@section('script')
<script>
$(document).ready(function() {
    $('#home_bottom_categories').select2({
        "multiple": true,
        placeholder: "Select",
        maximumSelectionLength: 3
    });
});

</script>
@stop