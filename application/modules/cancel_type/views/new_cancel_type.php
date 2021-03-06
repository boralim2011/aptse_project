<!--<div class="modal modal-success fade in" id="dialog-cancel-type">-->
<div class="modal fade in" id="dialog-cancel-type">
    <!--<div class="modal-dialog modal-sm">-->
    <!--<div class="modal-dialog modal-lg">-->
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">New cancel type</h4>
            </div>
            <div class="modal-body">
                <form id="cancel-type-form" role="form" action="<?php echo base_url()?>cancel_type/add" method="post" accept-charset="utf-8">
                    <div class="form-group">
                        <label for="cancel_type_name">Cancel Type</label>
                        <input type="text" class="form-control" id="cancel_type_name" name="cancel_type_name" placeholder="Enter name">
                    </div>

                    <div class="clearfix"></div>
                    <input type="hidden" id="cancel_type_id" name="cancel_type_id" value="0"/>
                    <input type="hidden" id="is_deletable" name="is_deletable" value="1"/>
                </form>

            </div>
            <div class="modal-footer">
                <div class="form-group no-margin">
                    <button type="button" class="btn btn-primary pull-left" id="btn-add-cancel-type"><i class="fa fa-save"></i> Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
        <div id="modal-message"></div>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script type="text/javascript">

    $(document).ready(function(){

        //add user type
        $(document).off("click","#btn-new-cancel-type");
        $(document).on("click","#btn-new-cancel-type", function(event){
            event.preventDefault();

            $("#dialog-cancel-type .modal-title").html("New Cancel Type");
            $("#cancel-type-form").attr('action', '<?php echo base_url()?>cancel_type/add' );
            $("#cancel_type_id").val(0);

            $("#dialog-cancel-type").modal({
                backdrop: "static" // true | false | "static" => default is true
            });
        })

        //clear form and refresh main page when close dialog
        $(document).off('hidden.bs.modal', '#dialog-cancel-type');
        $(document).on('hidden.bs.modal', '#dialog-cancel-type', function() {
            $("#cancel-type-form")[0].reset();
            $("#modal-message").empty();
            $(".btn-refresh").trigger('click');
        });

        //submit user type to service to save
        $(document).off("click","#btn-add-cancel-type");
        $(document).on("click","#btn-add-cancel-type", function(event){
            event.preventDefault();


            var form = $("#cancel-type-form");
            var formData = new FormData(form[0]);
            var url = form.attr('action').toString();

            //var formData = new FormData();
            formData.append('submit', 1);
            // Main magic with files here
            //formData.append('file', $('input[type=file]')[0].files[0]);

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                dataType:"json",
                //async: false,
                cache: false,
                beforeSend: function(xhr){
                    //alert('Before send');
                },
                success: function(data, status, xhr)
                {
                    if(data==521){
                        go_to_login();
                    }
                    else{
                        if(data.success===true){
                            //$("#cancel_type_id").val(data.model.cancel_type_id);
                            $("#cancel-type-form")[0].reset();
                        }
                        //alert(data.message);
                        show_message(data.message, $("#modal-message"));
                    }
                },
                error: function(xhr,status,error){
                    //alert('error' + error);
                    var message = '{"text":"'+error+'","type":"Error","title":"Error"}';
                    show_message(message, $("#modal-message"));
                },
                complete: function(xhr,status){
                    //alert(status);
                },
                contentType: false,
                processData: false
            });

            return false;
        });

    });
</script>