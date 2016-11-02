<!--<div class="modal modal-success fade in" id="dialog-agency_type">-->
<div class="modal fade in" id="dialog-agency_type">
    <!--<div class="modal-dialog modal-sm">-->
    <!--<div class="modal-dialog modal-lg">-->
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">New user type</h4>
            </div>
            <div class="modal-body">
                <form id="agency_type-form" role="form" action="<?php echo base_url()?>agency_type/add" method="post" accept-charset="utf-8">
                    <div class="form-group">
                        <label for="agency_type_name">Agency_type</label>
                        <input type="text" class="form-control" id="agency_type_name" name="agency_type_name" placeholder="Enter name">
                    </div>
                    <div class="form-group">
                        <label for="agency_type_name_kh">Agency_type(Khmer)</label>
                        <input type="text" class="form-control" id="agency_type_name_kh" name="agency_type_name_kh" placeholder="Enter name">
                    </div>

                    <div class="clearfix"></div>
                    <input type="hidden" id="agency_type_id" name="agency_type_id" value="0"/>
                    <input type="hidden" id="is_deletable" name="is_deletable" value="1"/>

                </form>

            </div>
            <div class="modal-footer">
                <div class="form-group no-margin">
                    <button type="button" class="btn btn-primary pull-left" id="btn-add-agency_type"><i class="fa fa-save"></i> Save</button>
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
        $(document).off("click","#btn-new-agency_type");
        $(document).on("click","#btn-new-agency_type", function(event){
            event.preventDefault();

            $("#dialog-agency_type .modal-title").html('New Agency Type');
            $("#agency_type-form").attr('action', '<?php echo base_url()?>agency_type/add' );
            $("#agency_type_id").val(0);

            $("#dialog-agency_type").modal({
                backdrop: "static" // true | false | "static" => default is true
            });
        })

        //clear form and refresh main page when close dialog
        $(document).off('hidden.bs.modal', '#dialog-agency_type');
        $(document).on('hidden.bs.modal', '#dialog-agency_type', function() {
            $("#agency_type-form")[0].reset();
            $("#modal-message").empty();
            $(".btn-refresh").trigger('click');
        });

        //submit user type to service to save
        $(document).off("click","#btn-add-agency_type");
        $(document).on("click","#btn-add-agency_type", function(event){
            event.preventDefault();


            var form = $("#agency_type-form");
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
                            //$("#agency_type_id").val(data.model.agency_type_id);
                            $("#agency_type-form")[0].reset();
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