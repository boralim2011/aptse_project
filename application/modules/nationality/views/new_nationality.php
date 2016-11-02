<!--<div class="modal modal-success fade in" id="dialog-nationality">-->
<div class="modal fade in" id="dialog-nationality">
    <!--<div class="modal-dialog modal-sm">-->
    <!--<div class="modal-dialog modal-lg">-->
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">New Nationality</h4>
            </div>
            <div class="modal-body">
                <form id="nationality-form" role="form" action="<?php echo base_url()?>nationality/add" method="post" accept-charset="utf-8">
                    <div class="form-group">
                        <label for="nationality_name">Nationality</label>
                        <input type="text" class="form-control" id="nationality_name" name="nationality_name" placeholder="Enter name">
                    </div>
                    <div class="form-group">
                        <label for="nationality_name_kh">Nationality(Khmer)</label>
                        <input type="text" class="form-control" id="nationality_name_kh" name="nationality_name_kh" placeholder="Enter name">
                    </div>

                    <div class="clearfix"></div>
                    <input type="hidden" id="nationality_id" name="nationality_id" value="0"/>
                    <input type="hidden" id="is_deletable" name="is_deletable" value="1"/>

                </form>

            </div>
            <div class="modal-footer">
                <div class="form-group no-margin">
                    <button type="button" class="btn btn-primary pull-left" id="btn-add-nationality"><i class="fa fa-save"></i> Save</button>
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
        $(document).off("click","#btn-new-nationality");
        $(document).on("click","#btn-new-nationality", function(event){
            event.preventDefault();

            $("#dialog-nationality .modal-title").html('New Nationality');
            $("#nationality-form").attr('action', '<?php echo base_url()?>nationality/add' );
            $("#nationality_id").val(0);

            $("#dialog-nationality").modal({
                backdrop: "static" // true | false | "static" => default is true
            });
        })

        //clear form and refresh main page when close dialog
        $(document).off('hidden.bs.modal', '#dialog-nationality');
        $(document).on('hidden.bs.modal', '#dialog-nationality', function() {
            $("#nationality-form")[0].reset();
            $("#modal-message").empty();
            $(".btn-refresh").trigger('click');
        });

        //submit user type to service to save
        $(document).off("click","#btn-add-nationality");
        $(document).on("click","#btn-add-nationality", function(event){
            event.preventDefault();


            var form = $("#nationality-form");
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
                            //$("#nationality_id").val(data.model.nationality_id);
                            $("#nationality-form")[0].reset();
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