<!--<div class="modal modal-success fade in" id="dialog-border-crossing">-->
<div class="modal fade in" id="dialog-border-crossing">
    <!--<div class="modal-dialog modal-sm">-->
    <!--<div class="modal-dialog modal-lg">-->
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">New cancel type</h4>
            </div>
            <div class="modal-body">
                <form id="border-crossing-form" role="form" action="<?php echo base_url()?>border_crossing/add" method="post" accept-charset="utf-8">
                    <div class="form-group">
                        <label>Border Crossing Name</label>
                        <input type="text" class="form-control" id="border_crossing_name" name="border_crossing_name" placeholder="Enter name">
                    </div>
                    <div class="form-group">
                        <label>Border Crossing Name (Khmer)</label>
                        <input type="text" class="form-control" id="border_crossing_name_kh" name="border_crossing_name_kh" placeholder="Enter name (Khmer)">
                    </div>


                    <div class="clearfix"></div>
                    <input type="hidden" id="border_crossing_id" name="border_crossing_id" value="0"/>
                    <input type="hidden" id="is_deletable" name="is_deletable" value="1"/>
                </form>

            </div>
            <div class="modal-footer">
                <div class="form-group no-margin">
                    <button type="button" class="btn btn-primary pull-left" id="btn-add-border-crossing"><i class="fa fa-save"></i> Save</button>
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
        $(document).off("click","#btn-new-border-crossing");
        $(document).on("click","#btn-new-border-crossing", function(event){
            event.preventDefault();

            $("#dialog-border-crossing .modal-title").html("New Border Crossing");
            $("#border-crossing-form").attr('action', '<?php echo base_url()?>border_crossing/add' );
            $("#border_crossing_id").val(0);

            $("#dialog-border-crossing").modal({
                backdrop: "static" // true | false | "static" => default is true
            });
        })

        //clear form and refresh main page when close dialog
        $(document).off('hidden.bs.modal', '#dialog-border-crossing');
        $(document).on('hidden.bs.modal', '#dialog-border-crossing', function() {
            $("#border-crossing-form")[0].reset();
            $("#modal-message").empty();
            $(".btn-refresh").trigger('click');
        });

        //submit user type to service to save
        $(document).off("click","#btn-add-border-crossing");
        $(document).on("click","#btn-add-border-crossing", function(event){
            event.preventDefault();


            var form = $("#border-crossing-form");
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
                            //$("#border_crossing_id").val(data.model.border_crossing_id);
                            $("#border-crossing-form")[0].reset();
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