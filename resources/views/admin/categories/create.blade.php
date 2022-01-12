<?php $required_span = '<span class="text-red">*</span>'; ?>
<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AddModalLabel">{{trans('label.Add')}} {{trans('label.Categories')}}</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal addCategory" method="POST" action="javascript:void(0);">
                    {{ csrf_field() }}
                    <div class="mb-3">
                        <label for="parent_id" class="col-form-label">Parent:</label>
                        <select  class="form-control" name='parent_id' id="parent_id">
                            <option>Select Parent</option>
                                @if(isset($cat))
                                    @foreach($cat as $id => $val)
                                        <option  value='{{$id}}'> {{ $val}} </option>
                                    @endforeach
                                @endif
                        </select>                
                    </div>
                    <div class="mb-3">
                        <label for="category_name" class="col-form-label"> Name:<?=$required_span; ?></label>
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

<script>
    $(function(){
        $(".addCategory").validate({
        submitHandler(form){
        $(".submit").attr("disabled", true);
        var form_data = $('.addCategory')[0];
        var form1 = new FormData(form_data);
        $.ajax({
            type: "POST",
            url: '{{route('admin.categories.store')}}',
            data: form1,
            contentType: false,
            processData: false,
            success: function( response ) {
                if(response.error == 0){
                    toastr.success(response.msg);

                    setTimeout(function(){
                        location.href = '{{url('admin/categories')}}';
                    },1900);
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
    })

</script>


