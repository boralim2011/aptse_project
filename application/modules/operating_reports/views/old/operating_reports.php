<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Manage Register
        <!--<small>Optional description</small>-->
    </h1>
    <ol class="breadcrumb">
    <li><a href="#home"><i class="fa fa-home"></i> Home</a></li>
    <li class="active">Manage Register</li>
    </ol>
</section>
<!-- Main content -->
<section class="content no-margin-height">

    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header">
                    <h4>Search info :</h4>
                    <form id="search-form" role="form" action="<?php echo base_url();?>operating_reports" method="post" accept-charset="utf-8"  target="_blank">
                        <div class="row">
                            <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <label>Date of</label>
                                <select id="date_of" name="date_of" class="form-control select2" data-placeholder="--Select Agency--"  style="width: 100%;">
                                    <option value="register_date" <?php echo isset($date_of) && $date_of=='register_date' ? 'selected="selected"':'';?> >Register</option>
                                    <option value="passport_issue_date" <?php echo isset($date_of) && $date_of=='passport_issue_date' ? 'selected="selected"':'';?> >Issue Passport</option>
                                    <option value="date_of_receive_passport" <?php echo isset($date_of) && $date_of=='date_of_receive_passport' ? 'selected="selected"':'';?> >Receive Passport</option>
                                    <option value="date_of_send_ppc_sd" <?php echo isset($date_of) && $date_of=='date_of_send_ppc_sd' ? 'selected="selected"':'';?> >Send Passport Scan</option>
                                    <option value="date_of_send_bio_scan" <?php echo isset($date_of) && $date_of=='date_of_send_bio_scan' ? 'selected="selected"':'';?> >Send Bio Scan</option>
                                    <option value="date_of_send_document" <?php echo isset($date_of) && $date_of=='date_of_send_document' ? 'selected="selected"':'';?> >Send Document</option>
                                    <option value="date_of_mofa" <?php echo isset($date_of) && $date_of=='date_of_mofa' ? 'selected="selected"':'';?> >Ministry of Foreign Affair</option>
                                    <option value="date_of_visa_rd_confirm" <?php echo isset($date_of) && $date_of=='date_of_visa_rd_confirm' ? 'selected="selected"':'';?> >Visa Confirm</option>
                                    <option value="date_of_visa_rd_receive" <?php echo isset($date_of) && $date_of=='date_of_visa_rd_receive' ? 'selected="selected"':'';?> >Visa Receive</option>
                                    <option value="date_of_buy_air_ticket" <?php echo isset($date_of) && $date_of=='date_of_buy_air_ticket' ? 'selected="selected"':'';?> >Buy Air Ticket</option>
                                    <option value="date_of_fly" <?php echo isset($date_of) && $date_of=='date_of_fly' ? 'selected="selected"':'';?> >Fly</option>
                                    <option value="canceled_date" <?php echo isset($date_of) && $date_of=='canceled_date' ? 'selected="selected"':'';?> >Worker Canceled</option>
                                </select>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <div>
                                    <label style="margin-right: 20px;"><input type="checkbox" class="minimal form-control" id="all_date" name="all_date" value="1" <?php if(isset($all_date) && $all_date=='1') echo 'checked="checked"';?>  > All Date</label>
                                    <label>From Date</label>
                                </div>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control datepicker" name="from_date" id="from_date" value="<?php echo isset($from_date)?$from_date:'' ;?>" <?php if(isset($all_date) && $all_date=='1') echo 'disabled="disabled"';?> >
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <label>To Date</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control datepicker" name="to_date" id="to_date" value="<?php echo isset($to_date)?$to_date:'' ;?>" <?php if(isset($all_date) && $all_date=='1') echo 'disabled="disabled"';?> >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <label>Company</label>
                                <select id="company_id" name="company_id" class="form-control select2" data-placeholder="--Select Company--"  style="width: 100%;">
                                    <option value="0" <?php echo isset($company_id) && $company_id==0 ? 'selected="selected"':'';?> >All</option>
                                    <?php if(isset($companies) && is_array($companies))
                                        foreach($companies as $com){
                                            ?>
                                            <option value="<?php echo $com->contact_id;?>" <?php echo isset($company_id) && $company_id==$com->contact_id? 'selected="selected"':'';?> ><?php echo $com->contact_name;?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <label>Agency</label>
                                <select id="agency_id" name="agency_id" class="form-control select2" data-placeholder="--Select Agency--"  style="width: 100%;">
                                    <option value="0" <?php echo isset($agency_id) && $agency_id==0 ? 'selected="selected"':'';?> >All</option>
                                    <?php if(isset($agencies) && is_array($agencies))
                                        foreach($agencies as $a){
                                            ?>
                                            <option value="<?php echo $a->contact_id;?>" <?php echo isset($agency_id) && $agency_id==$a->contact_id? 'selected="selected"':'';?> ><?php echo $a->contact_name;?></option>
                                        <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <label>Recruiter</label>
                                <select id="recruiter_id" name="recruiter_id" class="form-control select2" data-placeholder="--Select Agency--"  style="width: 100%;">
                                    <option value="0" <?php echo isset($recruiter_id) && $recruiter_id==0 ? 'selected="selected"':'';?> >All</option>
                                    <?php if(isset($recruiters) && is_array($recruiters))
                                        foreach($recruiters as $rec){
                                            ?>
                                            <option value="<?php echo $rec->contact_id;?>" <?php echo isset($recruiter_id) && $recruiter_id==$rec->contact_id? 'selected="selected"':'';?> ><?php echo $rec->contact_name;?></option>
                                        <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <label>To Country</label>
                                <select id="to_country_id" name="to_country_id" class="form-control select2" data-placeholder="--Select Country--"  style="width: 100%;">
                                    <option value="0" <?php echo isset($to_country_id) && $to_country_id==0 ? 'selected="selected"':'';?> >All</option>
                                    <?php if(isset($countries) && is_array($countries))
                                        foreach($countries as $count){
                                            ?>
                                            <option value="<?php echo $count->location_id;?>" <?php echo isset($to_country_id) && $to_country_id==$count->location_id? 'selected="selected"':'';?> ><?php echo $count->location_name;?></option>
                                        <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <label>Service Type</label>
                                <select id="service_type_id" name="service_type_id" class="form-control select2" data-placeholder="--Select Service Type--"  style="width: 100%;">
                                    <option value="0" <?php echo isset($service_type_id) && $service_type_id==0 ? 'selected="selected"':'';?> >All</option>
                                    <?php if(isset($service_types) && is_array($service_types))
                                        foreach($service_types as $st){
                                            ?>
                                            <option value="<?php echo $st->service_type_id;?>" <?php echo isset($service_type_id) && $service_type_id==$st->service_type_id? 'selected="selected"':'';?> ><?php echo $st->service_type_name;?></option>
                                        <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <label>Worker Type</label>
                                <select id="worker_type_id" name="worker_type_id" class="form-control select2" data-placeholder="--Select Agency--"  style="width: 100%;">
                                    <option value="0" <?php echo isset($worker_type_id) && $worker_type_id==0 ? 'selected="selected"':'';?> >All</option>
                                    <?php if(isset($worker_types) && is_array($worker_types))
                                        foreach($worker_types as $wt){
                                            ?>
                                            <option value="<?php echo $wt->register_type_id;?>" <?php echo isset($worker_type_id) && $worker_type_id==$wt->register_type_id? 'selected="selected"':'';?> ><?php echo $wt->register_type_name;?></option>
                                        <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-xs-12 col-sm-5 col-md-4 col-lg-4">
                                <label>Search By</label>
                                <select id="search_by" name="search_by" class="form-control select2" data-placeholder="--Select Agency--"  style="width: 100%;">
                                    <option value="contact_name" <?php echo isset($search_by) && $search_by=='contact_name' ? 'selected="selected"':'';?> >Register Name</option>
                                    <option value="register_code" <?php echo isset($search_by) && $search_by=='register_code' ? 'selected="selected"':'';?> >Register Code</option>
                                    <option value="worker_code" <?php echo isset($search_by) && $search_by=='worker_code' ? 'selected="selected"':'';?> >Worker Code</option>
                                    <option value="contact_name_kh" <?php echo isset($search_by) && $search_by=='contact_name_kh' ? 'selected="selected"':'';?> >Register Name (Khmer)</option>
                                    <option value="first_name" <?php echo isset($search_by) && $search_by=='first_name' ? 'selected="selected"':'';?> >First Name</option>
                                    <option value="first_name_kh" <?php echo isset($search_by) && $search_by=='first_name_kh' ? 'selected="selected"':'';?> >First Name (Khmer)</option>
                                    <option value="last_name" <?php echo isset($search_by) && $search_by=='last_name' ? 'selected="selected"':'';?> >Last Name</option>
                                    <option value="last_name_kh" <?php echo isset($search_by) && $search_by=='last_name_kh' ? 'selected="selected"':'';?> >Last Name (Khmer)</option>
                                    <option value="id_card_no" <?php echo isset($search_by) && $search_by=='id_card_no' ? 'selected="selected"':'';?> >ID Card No</option>
                                    <option value="passport_no" <?php echo isset($search_by) && $search_by=='passport_no' ? 'selected="selected"':'';?> >Passport No</option>
                                    <option value="phone_number" <?php echo isset($search_by) && $search_by=='phone_number' ? 'selected="selected"':'';?> >Phone Number</option>
                                </select>
                            </div>
                            <div class="form-group col-xs-12 col-sm-7 col-md-8 col-lg-8">
                                <div>
                                    <label style="margin-right: 20px;"><input type="radio" class="minimal form-control" id="like" name="search_option" value="like" <?php if(!isset($search_option) || $search_option=='like') echo 'checked="checked"';?>  > Like</label>
                                    <label style="margin-right: 20px;"><input type="radio" class="minimal form-control" id="start_with" name="search_option" value="start_with" <?php if(isset($search_option) && $search_option=='start_with') echo 'checked="checked"';?>  > Start With</label>
                                    <label style="margin-right: 20px;"><input type="radio" class="minimal form-control" id="exact" name="search_option" value="exact" <?php if(isset($search_option) && $search_option=='exact') echo 'checked="checked"';?>  > Exact</label>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="search" name="search" placeholder="Enter something to search" value="<?php echo isset($search)? $search:'';?>"/>
                                    <a class="input-group-addon btn btn-primary" name="btn-search" id="btn-search" href="#">
                                        <i class="fa fa-search"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <input type='hidden' name='registers' value='<?php echo json_encode($registers);?>'>
                        <input type='hidden' name='report_name' id="report_type" value='<?php echo isset($report_name)? $report_name:"bio_data";?>'>

                    </form>

                </div><!-- /.box-header -->

            </div><!-- /.box -->

            <div class="box box-info">
                <div class="box-header">
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-4">
                            <label>Select Report</label>
                            <div class="input-group">
                                <select id="report_name" name="report_name" class="form-control select2" data-placeholder="--Select Report--"  style="width: 100%; display: none;">
                                    <option value="bio_data" <?php echo isset($report_name) && $report_name=='bio_data' ? 'selected="selected"':'';?> >BIO Data</option>
                                    <option value="bio_data_fly" <?php echo isset($report_name) && $report_name=='bio_data_fly' ? 'selected="selected"':'';?> >Send BIO Agency</option>
                                    <option value="worker_fly" <?php echo isset($report_name) && $report_name=='worker_fly' ? 'selected="selected"':'';?> >Worker Flight</option>
                                    <option value="worker_cancel" <?php echo isset($report_name) && $report_name=='worker_cancel' ? 'selected="selected"':'';?> >Worker Cancel</option>
                                    <option value="worker_list_mfa" <?php echo isset($report_name) && $report_name=='worker_list_mfa' ? 'selected="selected"':'';?> >List of Worker (MFA)</option>
                                    <option value="worker_list" <?php echo isset($report_name) && $report_name=='worker_list' ? 'selected="selected"':'';?> >List of Worker</option>
                                    <option value="worker_list_thai" <?php echo isset($report_name) && $report_name=='worker_list_thai' ? 'selected="selected"':'';?> >List of Worker (Thai)</option>
                                </select>
                                <a class="input-group-addon btn btn-primary" id="btn-print" target="_blank" href="<?php echo base_url();?>operating_reports/print_<?php echo isset($report_name)? $report_name:"bio_data";?>">
                                    <i class="fa fa-print"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body" id="display-list">

                    <?php $this->load->view($report_name);?>

                </div><!-- /.box-body -->
            </div><!-- /.box -->

        </div><!-- /.col -->
    </div><!-- /.row -->

</section><!-- /.content -->


<script type="text/javascript">
    $(document).ready(function(){
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

        $(".select2").select2();

        $('#all_date').on('ifChecked', function(event){
            $('#from_date').attr("disabled", true);
            $('#to_date').attr("disabled", true);
        });
        $('#all_date').on('ifUnchecked', function(event){
            $('#from_date').attr("disabled", false);
            $('#to_date').attr("disabled", false);
        });
    });

</script>

<script type="text/javascript">
    $(document).ready(function()
    {

        $(document).off('click', '#btn-print');
        $(document).on('click', '#btn-print', function(event){
            event.preventDefault();

            var form = $('#search-form');
            var submitForm = form.clone();
            submitForm.attr('action',"<?php echo base_url()?>operating_reports/print_report");
            //submitForm.attr('target','_blank');

            submitForm.submit();

        });


        $(document).off('click', '#btn-search');
        $(document).on('click', '#btn-search', function(event){
            event.preventDefault();

            if($('#search-form').length) $('#search-form').submit();
        });

        $(document).off('change', '#report_name');
        $(document).on('change', '#report_name', function(event){
            event.preventDefault();

            $("#report_type").val($(this).val());

            if($('#search-form').length) $('#search-form').submit();
        });

        $(document).off('submit', '#search-form');
        $(document).on('submit', '#search-form', function(event){
            event.preventDefault();

            var form = $(this);
            var formData = new FormData(form[0]);
            var url = form.attr('action').toString();

            //var formData = new FormData();
            formData.append('submit', 1);
            //formData.append('report_name', $("#report_name").val())
            // Main magic with files here
            //formData.append('file', $('input[type=file]')[0].files[0]);

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                //dataType:"json",
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
                        $("#display-content").empty().append(data);
                    }
                },
                error: function(xhr,status,error){
                    //alert('error'+ error);
                    var message = '{"text":"'+error+'","type":"Error","title":"Error"}';
                    show_message(message, $("#message"));
                },
                complete: function(xhr,status){
                    //alert(status);
                },
                contentType: false,
                processData: false
            });
        });
    });
</script>
