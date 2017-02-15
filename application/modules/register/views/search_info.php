<div class="box box-info">
    <div class="box-header">
        <h4>Search info :</h4>
        <form id="search-form" role="form" action="#" method="post" accept-charset="utf-8">
            <div class="row">
                <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div>
                        <label style="margin-right: 20px;">Date of</label>
                        <label><input type="checkbox" class="minimal form-control" id="all_date" name="all_date" value="1" <?php if(isset($all_date) && $all_date=='1') echo 'checked="checked"';?>  > All Date</label>
                    </div>
                    <select id="date_of" name="date_of" class="form-control select2" data-placeholder="--Select Agency--"  style="width: 100%;">
                        <option value="register_date" <?php echo isset($date_of) && $date_of=='register_date' ? 'selected="selected"':'';?> >Register</option>
                        <option value="passport_issue_date" <?php echo isset($date_of) && $date_of=='passport_issue_date' ? 'selected="selected"':'';?> >Issue Passport</option>
                        <option value="date_of_receive_passport" <?php echo isset($date_of) && $date_of=='date_of_receive_passport' ? 'selected="selected"':'';?> >Receive Passport</option>
                        <option value="date_of_send_ppc_sd" <?php echo isset($date_of) && $date_of=='date_of_send_ppc_sd' ? 'selected="selected"':'';?> >Send Passport Scan</option>
                        <option value="date_of_send_bio_scan" <?php echo isset($date_of) && $date_of=='date_of_send_bio_scan' ? 'selected="selected"':'';?> >Send Bio Scan</option>
                        <option value="date_of_send_document" <?php echo isset($date_of) && $date_of=='date_of_send_document' ? 'selected="selected"':'';?> >Send Document</option>
                        <option value="name_list_date" <?php echo isset($date_of) && $date_of=='name_list_date' ? 'selected="selected"':'';?> >Name List</option>
                        <option value="date_of_mofa" <?php echo isset($date_of) && $date_of=='date_of_mofa' ? 'selected="selected"':'';?> >MFA</option>
                        <option value="date_of_visa_rd_confirm" <?php echo isset($date_of) && $date_of=='date_of_visa_rd_confirm' ? 'selected="selected"':'';?> >Visa Confirm</option>
                        <option value="date_of_visa_rd_receive" <?php echo isset($date_of) && $date_of=='date_of_visa_rd_receive' ? 'selected="selected"':'';?> >Visa Receive</option>
                        <option value="date_of_buy_air_ticket" <?php echo isset($date_of) && $date_of=='date_of_buy_air_ticket' ? 'selected="selected"':'';?> >Buy Air Ticket</option>
                        <option value="date_of_travel" <?php echo isset($date_of) && $date_of=='date_of_fly' ? 'selected="selected"':'';?> >Travel</option>
                        <option value="canceled_date" <?php echo isset($date_of) && $date_of=='canceled_date' ? 'selected="selected"':'';?> >Worker Canceled</option>
                    </select>
                </div>
                <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <label>From Date</label>
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
                <!--                <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">-->
                <!--                    <label>Employer</label>-->
                <!--                    <select id="employer_id" name="employer_id" class="form-control select2" data-placeholder="--Select Employer--"  style="width: 100%;">-->
                <!--                        <option value="0" --><?php //echo isset($employer_id) && $employer_id==0 ? 'selected="selected"':'';?><!-- >All</option>-->
                <!--                        --><?php //if(isset($employers) && is_array($employers))
                //                            foreach($employers as $a){
                //                                ?>
                <!--                                <option value="--><?php //echo $a->contact_id;?><!--" --><?php //echo isset($employer_id) && $employer_id==$a->contact_id? 'selected="selected"':'';?><!-- >--><?php //echo $a->contact_name;?><!--</option>-->
                <!--                            --><?php
                //                            }
                //                        ?>
                <!--                    </select>-->
                <!--                </div>-->
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
                    <select id="to_country_id" name="to_country_id" class="form-control select2" data-placeholder="--Select Country--"  style="width: 100%;"  >
                        <option value="0" <?php echo isset($to_country_id) && $to_country_id==0 ? 'selected="selected"':'';?> >All</option>
                        <?php if(isset($countries) && is_array($countries))
                            foreach($countries as $count){
                                ?>
                                <option value="<?php echo $count->location_id;?>" <?php echo isset($to_country_id) && $to_country_id==$count->location_id ? 'selected="selected"':'';?> ><?php echo $count->location_name;?></option>
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
                    <select id="register_type_id" name="register_type_id" class="form-control select2" data-placeholder="--Select Register Type--"  style="width: 100%;">
                        <option value="0" <?php echo isset($register_type_id) && $register_type_id==0 ? 'selected="selected"':'';?> >All</option>
                        <?php if(isset($register_types) && is_array($register_types))
                            foreach($register_types as $rgt){
                                ?>
                                <option value="<?php echo $rgt->register_type_id;?>" <?php echo isset($register_type_id) && $register_type_id==$rgt->register_type_id? 'selected="selected"':'';?> ><?php echo $rgt->register_type_name;?></option>
                            <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <label>Document Type</label>
                    <select id="document_type_id" name="document_type_id" class="form-control select2" data-placeholder="--Select Document Type--"  style="width: 100%;">
                        <option value="0" <?php echo isset($document_type_id) && $document_type_id==0 ? 'selected="selected"':'';?> >All</option>
                        <?php if(isset($document_types) && is_array($document_types))
                            foreach($document_types as $dot){
                                ?>
                                <option value="<?php echo $dot->document_type_id;?>" <?php echo isset($document_type_id) && $document_type_id==$dot->document_type_id? 'selected="selected"':'';?> ><?php echo $dot->document_type_name;?></option>
                            <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <label>List No</label>
                    <select id="register_key" name="register_key" class="form-control select2" data-placeholder="All"  style="width: 100%;">
                        <option value="" <?php echo isset($register_key) && $register_key=="" ? 'selected="selected"':'';?> >All</option>
                        <?php
                        for($key=1; $key<10; $key++){
                            ?>
                            <option value="<?php echo $key;?>" <?php echo isset($register_key) && $register_key==$key? 'selected="selected"':'';?> ><?php echo $key;?></option>
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

        </form>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function() {

        $(".select2").select2();

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

        $('#all_date').on('ifChecked', function (event) {
            $('#from_date').attr("disabled", true);
            $('#to_date').attr("disabled", true);
        });
        $('#all_date').on('ifUnchecked', function (event) {
            $('#from_date').attr("disabled", false);
            $('#to_date').attr("disabled", false);
        });


    });

</script>



