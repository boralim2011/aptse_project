
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo isset($title)? $title:'New Arrival_departure'; ?>
        <!--<small>Optional description</small>-->
    </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-home"></i> home</a></li>
    <li><a href="#user"><i class="fa fa-user"></i> Manage Arrival Departure</a></li>
    <li class="active"><?php echo isset($title)? $title:'New Arrival Departure'; ?></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">

    <!-- SELECT2 EXAMPLE -->
    <div class="box box-default">
        <form id="travel-form" role="form" action="<?php echo $url;?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
            <div class="box-header with-border">
                <h3 class="box-title">Arrival_departure Info:</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <!--<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>-->
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <label >Worker Code</label>
                        <select class="select2" id="register_id" name="register_id" data-placeholder="--Select--" style="width: 100%;">
                            <option></option>
                            <?php if($arrival_departure->register_id!=0){?>
                                <option value="<?php echo $arrival_departure->register_id; ?>" selected="selected"><?php echo $arrival_departure->worker_code;?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <label>Travel Date</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control datepicker" name="arrival_departure_date" id="arrival_departure_date" value="<?php echo $arrival_departure->arrival_departure_date;?>">
                        </div>
                    </div>
                    <div class="form-group  col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <label >Document Ref</label>
                        <input type="text" class="form-control" id="document_ref" name="document_ref" placeholder="Enter Document Ref" value="<?php echo $arrival_departure->document_ref;?>">
                    </div>
                    <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <label>From Location</label>
                        <div class="input-group">
                            <select class="select2" id="from_location_id" name="from_location_id" data-placeholder="--Select--" style="width: 100%;">
                                <option></option>
                                <?php if($arrival_departure->from_location_id!=0){?>
                                    <option value="<?php echo $arrival_departure->from_location_id; ?>" selected="selected"><?php echo $arrival_departure->from_location_name;?></option>
                                <?php }?>
                            </select>
                            <a href="#" class="input-group-addon btn btn-primary btn-new-province" data-toggle="tooltip" title="New Province">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <label>To Location</label>
                        <div class="input-group">
                            <select class="select2" id="to_location_id" name="to_location_id" data-placeholder="--Select--" style="width: 100%;">
                                <option></option>
                                <?php if($arrival_departure->to_location_id!=0){?>
                                    <option value="<?php echo $arrival_departure->to_location_id; ?>" selected="selected"><?php echo $arrival_departure->to_location_name;?></option>
                                <?php }?>
                            </select>
                            <a href="#" class="input-group-addon btn btn-primary btn-new-province" data-toggle="tooltip" title="New Province">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <label>Visa Made Location</label>
                        <div class="input-group">
                            <select class="select2" id="visa_issue_location_id" name="visa_issue_location_id" data-placeholder="--Select--" style="width: 100%;">
                                <option></option>
                                <?php if($arrival_departure->visa_issue_location_id!=0){?>
                                    <option value="<?php echo $arrival_departure->visa_issue_location_id; ?>" selected="selected"><?php echo $arrival_departure->visa_issue_location_name;?></option>
                                <?php }?>
                            </select>
                            <a href="#" class="input-group-addon btn btn-primary btn-new-province" data-toggle="tooltip" title="New Province">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="form-group  col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <label >Visa No</label>
                        <input type="text" class="form-control" id="visa_no" name="visa_no" placeholder="Enter Travel Method" value="<?php echo $arrival_departure->visa_no;?>">
                    </div>
                    <div class="form-group  col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <label >Travel Method</label>
                        <input type="text" class="form-control" id="travel_method" name="travel_method" placeholder="Enter Travel Method" value="<?php echo $arrival_departure->travel_method;?>">
                    </div>
                    <div class="form-group  col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <label >Travel Purpose</label>
                        <input type="text" class="form-control" id="travel_purpose" name="travel_purpose" placeholder="Enter Travel Purpose" value="<?php echo $arrival_departure->travel_purpose;?>">
                    </div>
                    <div class="form-group  col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <label >Length of Stay</label>
                        <input type="text" class="form-control" id="length_of_stay" name="length_of_stay" placeholder="Enter Length of Stay" value="<?php echo $arrival_departure->length_of_stay;?>">
                    </div>
<!--                    <div class="form-group  col-xs-12 col-sm-12 col-md-4 col-lg-4">-->
<!--                        <label >From Address</label>-->
<!--                        <textarea type="text" class="form-control" id="from_address" name="from_address" placeholder="From Address" rows="3">--><?php //echo $arrival_departure->from_address;?><!--</textarea>-->
<!--                    </div>-->
<!--                    <div class="form-group  col-xs-12 col-sm-12 col-md-4 col-lg-4">-->
<!--                        <label >To Address</label>-->
<!--                        <textarea type="text" class="form-control" id="to_address" name="to_address" placeholder="To Address" rows="3">--><?php //echo $arrival_departure->to_address;?><!--</textarea>-->
<!--                    </div>-->

                    <div class="clearfix"></div>

                    <input type="hidden" id="arrival_departure_id" name="arrival_departure_id" value="<?php echo $arrival_departure->arrival_departure_id;?>"/>
                    <input type="hidden" id="is_deletable" name="is_deletable" value="<?php echo $arrival_departure->is_deletable;?>"/>
                </div>
            </div>

            <div class="box-footer">
                <button type="button" class="btn btn-primary" name="submit" id="submit"><i class="fa fa-save"></i> Submit </button>
                <a href="#arrival_departure" class="btn btn-default"><i class="fa fa-close"></i> Cancel </a>
            </div>
        </form>

    </div><!-- /.box -->

    <div id = "message" >
        <?php if(isset($message)) $this->show_message($message); ?>
    </div>

</section><!-- /.content -->


<script type="text/javascript">

    $(document).ready(function()
    {
        //Initialize Select2 Elements
        //$(".select2").select2();

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass: 'iradio_minimal-red'
        });
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });

        //date picker
        $(".datepicker").datepicker({
            format: "yyyy-mm-dd"
        });

        //Timepicker
        $(".timepicker").timepicker({
            showInputs: false
        });

        $("#register_id").select2({
            ajax: {
                url: "<?php echo base_url()?>register/get_combobox_items",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term // search term
                    };
                },
                processResults: function (data) {
                    // parse the results into the format expected by Select2.
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data
                    return {
                        results: data
                    };
                },
                cache: true
                //,allowClear: true
            },
            minimumInputLength: 1
        });

        $("#from_location_id, #to_location_id, #visa_issue_location_id").select2({
            ajax: {
                url: "<?php echo base_url()?>location/get_combobox_items",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term, // search term
                        type: '1,2,3',
                        parent: 0
                    };
                },
                processResults: function (data) {
                    // parse the results into the format expected by Select2.
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data
                    return {
                        results: data
                    };
                },
                cache: true
                //,allowClear: true
            },
            minimumInputLength: 1
        });

    });
</script>


<script type="text/javascript">

    $(document).ready(function()
    {
        $(document).off("click","#submit");
        $(document).on("click","#submit", function( event ) {
            event.preventDefault();

            $("#travel-form").submit();
        });


        $(document).off("submit","#travel-form");
        $(document).on("submit","#travel-form", function( event )
        {
            event.preventDefault();

            var form = $("#travel-form");
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
                    else
                    {

                        if(data.success===true){
                            $("#arrival_departure_id").val(data.model.arrival_departure_id);
                        }
                        //alert(data.message);
                        show_message(data.message, $("#message"));
                    }
                },
                error: function(xhr,status,error){
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




