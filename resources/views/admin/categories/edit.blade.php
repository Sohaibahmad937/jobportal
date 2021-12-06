<?php $required_span = '<span class="text-red">*</span>'; ?>
<div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="EditModalLabel">{{trans('label.New')}} {{trans('label.Categories')}}</h5>
        </div>
        <div class="modal-body">
            <form class="form-horizontal editCategory" method="post" action="javascript:void(0)" >
                {{ method_field('PUT') }}
                <div class="mb-3">
                    <label for="category_name" class="col-form-label">Category Name:<?=$required_span; ?></label>
                    <input class="form-control" type="text" name="category_name" id="category_name" value="{{ $row->category_name }}" required>
                </div>
                <button type="submit"  class="btn btn-primary  submit">Save</button>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
</div>

<script>
$(function(){
    $(".editCategory").validate({
        submitHandler(form){
        $(".submit").attr("disabled", true);
        var form_data = $('.editCategory')[0];
        var form1 = new FormData(form_data);
        $.ajax({
            type: "POST",
            url: '{{route('admin.categories.update',$row->id)}}',
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


