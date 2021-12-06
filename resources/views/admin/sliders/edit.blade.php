<?php $required_span = '<span class="text-red">*</span>';?>
<div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">{{trans('label.Edit')}} {{trans('label.Slider_detail.Sliders')}}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        
        </div>
        <div class="modal-body">
        <form class="form-horizontal" method="post" action="javascript:void(0)" id="edit_slider">
            <input name="_method" type="hidden" value="PATCH">
            @csrf
            <div class="box-body">
            <div class="form-group">
                <label for="title" class="col-sm-2 control-label">{{trans('label.Name')}}:</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="title" name="title" value="{{$row->title}}">	
                </div>
            </div>
            <div class="form-group">
                <label for="detail" class="col-sm-2 control-label">{{trans('label.Desc')}}:</label>
                <div class="col-sm-10">
                <textarea type="text" class="form-control" id="detail" name="detail" rows="10">{{$row->detail}}</textarea>	
                </div>
            </div>
            <div class="form-group">
                <label for="link" class="col-sm-2 control-label">{{trans('label.Link')}}:</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="link" name="link" value="{{$row->link}}">	
                </div>
            </div>
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary btn-flat">{{trans('label.Update')}}</button>
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
<script>
$("#edit_slider").validate({
    submitHandler(form){
        $(".submit").attr("disabled", true);
        $.ajax({
            type: "POST",
            url: '{{route('admin.sliders.update',$row->id)}}',
            data: $('#edit_slider').serialize(), 
            success: function( response ) {
                if(response.error == 0){
                    toastr.success(response.msg);
                    setTimeout(function(){
                        location.reload();
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