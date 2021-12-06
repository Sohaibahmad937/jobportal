@extends('layouts.admin')
@section('page_header')
<ul class="navbar-nav flex-row">
    <li>
        <div class="page-header">
            <nav class="breadcrumb-one" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Administration</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>Settings</span></li>
                </ol>
            </nav>
        </div>
    </li>
</ul>
@endsection
@section('content')
@php $required_span ='<span style="color:red">*</span>'; @endphp
<div class="layout-px-spacing">
  <div class="row layout-top-spacing">
    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing ">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Settings</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area p-4">
                <div class="widget-one">
                    <form method="POST" action="{{ route('admin.settings.update',$row->id) }}" class="form-horizontal validate_form">
                    <input name="_method" type="hidden" value="PATCH">
                    @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="mail_driver">Driver:</label>
                                    <input type="text" class="form-control" name="mail_driver" id="mail_driver" value="{{$row->mail_driver}}" >
                                </div>
                                <div class="form-group">
                                    <label for="mail_host">Host:</label>
                                    <input type="text" class="form-control" name="mail_host" id="mail_host" value="{{$row->mail_host}}">
                                </div>
                                <div class="form-group">
                                    <label for="mail_port">Port:</label>
                                    <input type="text" class="form-control" name="mail_port" id="mail_port" value="{{$row->mail_port}}">
                                </div>
                                <div class="form-group">
                                    <label for="mail_from_address">Mail From Address:</label>
                                    <input type="text" class="form-control" name="mail_from_address" id="mail_from_address" value="{{$row->mail_from_address}}" >
                                </div>
                                <div class="form-group">
                                    <label for="mail_from_name">Mail From Name:</label>
                                    <input type="text" class="form-control" name="mail_from_name" id="mail_from_name" value="{{$row->mail_from_name}}">
                                </div>
                            </div>
                            <!-- col-lg-6 -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="mail_username">Username:</label>
                                    <input type="text" class="form-control" name="mail_username" id="mail_username" value="{{$row->mail_username}}" >
                                </div>
                                <div class="form-group">
                                    <label for="mail_password">Password:</label>
                                    <input type="text" class="form-control" name="mail_password" id="mail_password" value="{{$row->mail_password}}" >
                                </div>
                                <div class="form-group">
                                    <label for="mail_recipient">Recipient Address:</label>
                                    <input type="text" class="form-control" name="mail_recipient" id="mail_recipient" value="{{$row->mail_recipient}}" >
                                </div>
                                <div class="form-group">
                                    <label for="mail_recipientname">Recipient Name:</label>
                                    <input type="text" class="form-control" name="mail_recipientname" id="mail_recipientname" value="{{$row->mail_recipientname}}">
                                </div>
                                <div class="form-group">
                                    <label for="mail_encryption">Encryption:</label>
                                    <input type="text" class="form-control" name="mail_encryption" id="mail_encryption" value="{{$row->mail_encryption}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 no-padding">
                                <button type="submit" class="btn btn-primary btn-flat">{{trans('global.Update')}}</button>
                                <a href="{{url('/admin/settings')}}" class="btn btn-danger btn-flat">{{trans('global.Cancel')}}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

@stop