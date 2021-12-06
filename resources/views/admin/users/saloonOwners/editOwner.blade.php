@extends('layouts.admin')
@section('page_header')
    <ul class="navbar-nav flex-row">
        <li>
            <div class="page-header">
                <nav class="breadcrumb-one" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">Saloon Owners</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><span>Update</span></li>
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
                                <h4>Update Owner Details</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area p-4">
                        <div class="widget-one">
                            <ul class="nav nav-tabs  mb-3 mt-3" id="simpletab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="tab_1-tab" data-toggle="tab" href="#tab_1" role="tab" aria-controls="tab_1" aria-selected="true">{{trans('label.Personal information')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab_3-tab" data-toggle="tab" href="#tab_3" role="tab" aria-controls="tab_3" aria-selected="false">{{trans('label.Change Password')}}</a>
                                </li>

                            </ul>
                            <div class="tab-content" id="simpletabContent">
                                <div class="tab-pane fade show active" id="tab_1" role="tabpanel" aria-labelledby="tab_1-tab">
                                    <form method="POST" action="{{ route('admin.DoEditOwner',$row->id) }}" class="form-horizontal edit_owner" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="username">{{trans('label.Username')}}:<?=$required_span;?></label>
                                                    <input type="text" class="form-control" name="username" id="username" value="{{old('username',$row->username)}}">
                                                </div>
                                            </div>
                                            <div class="col-lg-2 justify-content-center">
                                                <label for="activated">Activated:</label>
                                                <div class="form-group">
                                                    <label class="switch s-info">
                                                        <input id="status" name="status" type="checkbox" class="switch s-info  mt-4 mr-2" {{ $row->status == 1 ? 'checked' : '' }} value="1">
                                                        <span class="slider round"></span>
                                                    </label>
                                                    {!! $errors->first('status', '<label class="error">:message</label>') !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="username">{{trans('label.Username')}}:<?=$required_span;?></label>
                                                    <input type="text" class="form-control"  name="username" id="username" value="{{$row->username}}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">{{trans('label.Name')}}:<?=$required_span;?></label>
                                                    <input type="text" class="form-control"  name="name" id="name" value="{{$row->name}}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">{{trans('label.Email')}}:<?=$required_span;?></label>
                                                    <input type="email" class="form-control" placeholder="Enter Email" name="email" id="email" value="{{$row->email}}">

                                                </div>
                                                <div class="form-group">
                                                    <label for="mobile">{{trans('label.Mobile')}}:</label>
                                                    <input type="text" class="form-control" placeholder="Enter Mobile" name="mobile" id="mobile" value="{{$row->mobile}}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="user_image">{{trans('label.Profile Photo')}}:</label>
                                                    <?php
                                                    if($row->user_image != ''){
                                                        echo '<img src="'.asset('user_image/'.$row->user_image.'').'" class="img-fluid">';
                                                    }
                                                    ?>
                                                    <input id="file-upload" type="file" name="user_image" class="form-control"/>
                                                    <input type="hidden" value="{{$row->user_image}}" name="hidden_image">
                                                </div>
                                            </div>
                                            <!-- col-lg-6 -->
                                            <div class="col-lg-6">

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary btn-flat">{{trans('label.Update')}}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="tab_3" role="tabpanel" aria-labelledby="tab_3-tab">
                                    <form method="POST" action="{{ route('admin.DoChangePassword',$row->id) }}" class="form-horizontal change_pass" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="password">{{trans('label.Password')}}:<?=$required_span;?></label>
                                                    <input type="text" class="form-control" _placeholder="Enter Password" name="password" id="password" value="{{old('password')}}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="cpassword">{{trans('label.Confirm Password')}} :<?=$required_span;?></label>
                                                    <input type="text" class="form-control" _placeholder="Confirm Password" name="cpassword" id="cpassword" value="{{old('cpassword')}}">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary btn-flat">{{trans('label.Update')}}</button>
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
        </div>
    </div>

@stop
@section('script')
    <script>
        $('.change_pass').validate({
            rules:{
                password : {
                    required:true,
                },
                cpassword : {
                    required:true,
                    equalTo : "#password"
                },
            },
            messages:{
                cpassword:{
                    required:'Confirm Password is required',
                    equalTo:'Confirm Password & Password does not match',
                }
            }
        });
        $('.edit_owner').validate({
            rules:{
                password : {
                    required:true,
                },
                cpassword : {
                    required:true,
                    equalTo : "#password"
                },
                email:{
                    required:true,
                    email:true,
                    remote:{
                        url:'{{url("admin/CheckDuplicateUser")}}',
                        type:'post',
                        data:{
                            email: function(){return $('#email').val();},
                            id: function(){return '{{$row->id}}'}
                        }
                    }
                },
                username:{
                    required:true,
                    remote:{
                        url:'{{url("admin/CheckDuplicateUsername")}}',
                        type:'post',
                        data:{
                            username: function(){return $('#username').val();},
                            id: function(){return '{{$row->id}}'}
                        }
                    }
                },
                mobile:{
                    number:true
                }

            },
            messages:{
                name:'Name can not be empty',
                middle_name:'Middle Name can not be empty',
                surname:'Surname can not be empty',
                nif_cif:'NIF/CIF can not be empty',
                email:{
                    required:'Email is required',
                    email:'Email is not in correct format',
                    remote:'Email already exist',
                },
                username:{
                    required:'Username is required',
                    remote:'Username already exist',
                },
                mobile:{
                    number:'Mobile number is not correct'
                },
                cpassword:{
                    required:'Confirm Password is required',
                    equalTo:'Confirm Password & Password does not match',
                }
            },
            submitHandler(form){
                $(".submit").attr("disabled", true);
                var form_owners = $('.edit_owner')[0];
                let form1 = new FormData(form_owners);
                $.ajax({
                    type: "POST",
                    url: '{{route('admin.DoEditOwner',$row->id)}}',
                    data: form1,
                    contentType: false,
                    processData: false,
                    success: function( response ) {
                        if(response.error == 0){
                            toastr.success(response.msg);
                            setTimeout(function(){
                                location.href = '{{url('admin/saloonOwners')}}';
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
    <script>

        var val = '{{$tab}}';
        if(val != ''){
            //alert(val);
            jQuery(function () {
                jQuery('a[href="#'+ val +'"]').tab('show');
            });
        }
    </script>
@stop
