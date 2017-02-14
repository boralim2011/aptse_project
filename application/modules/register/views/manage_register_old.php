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
            <div class="box box-info">
                <div class="box-header">
                    <a href="#register/add<?php echo $view_country==0?"":"/$view_country";?>" class="btn btn-primary" ><i class="fa fa-plus"></i> Add</a>
                    <a href="#register" class="btn btn-primary btn-refresh"><i class="fa fa-refresh"></i> Refresh</a>
                </div><!-- /.box-header -->
                <div class="box-body" id="display-list">
                    <table id="register-table" class="table table-bordered table-hover data-table display nowrap">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Name(Khmer)</th>
                            <th>Worker Code</th>
                            <th>Register Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(isset($registers) && is_array($registers)){
                            foreach($registers as $row){
                                ?>
                                <tr>
                                    <td></td>
                                    <td><?php echo isset($row->contact_name)? $row->contact_name:"";?></td>
                                    <td><?php echo isset($row->contact_name_kh)? $row->contact_name_kh:"";?></td>
                                    <td><?php echo isset($row->worker_code)? $row->worker_code:"";?></td>
                                    <td><?php echo isset($row->register_date)? $row->register_date:"";?></td>
                                    <td>
                                        <a href="#register/edit/<?php echo $row->contact_id;?>"  class="inline-button" data-toggle="tooltip" title="Edit"> <i class="fa fa-pencil text-orange"></i> </a>
                                        <a href="#" data-json='{"contact_id":"<?php echo $row->contact_id;?>"}' class="inline-button btn-delete" data-toggle="tooltip" title="Delete" url="<?php echo base_url();?>register/delete"> <i class="fa fa-trash-o text-red"></i> </a>
                                    </td>
                                </tr>
                            <?php
                            }
                        }
                        ?>
                        </tbody>

                    </table>

                    <div class="row">
                        <div class="col-xs-4">
                            <select id="display" name="display"  data-placeholder="10" style="margin-top: 20px; padding: 5px;" >
                                <option value="10" <?php echo $display==10? 'selected="selected"':''; ?>>10</option>
                                <option value="20" <?php echo $display==20? 'selected="selected"':''; ?> >20</option>
                                <option value="30" <?php echo $display==30? 'selected="selected"':''; ?>>30</option>
                                <option value="50" <?php echo $display==50? 'selected="selected"':''; ?>>50</option>
                                <option value="100" <?php echo $display==100? 'selected="selected"':''; ?>>100</option>
                                <option value="200" <?php echo $display==200? 'selected="selected"':''; ?>>200</option>
                                <option value="300" <?php echo $display==300? 'selected="selected"':''; ?>>300</option>
                                <option value="500" <?php echo $display==500? 'selected="selected"':''; ?>>500</option>
                            </select>
                        </div>
                        <div class="col-xs-8">
                            <div id="page-selection" class="pull-right"> </div>
                            <div style="margin-top: 20px; padding: 5px 20px;" class="pull-right">
                                Total:  <span style="font-weight: bold;"> <?php echo $records; ?> </span> records
                            </div>
                        </div>
                    </div>

                </div><!-- /.box-body -->
            </div><!-- /.box -->


        </div><!-- /.col -->
    </div><!-- /.row -->

</section><!-- /.content -->



<script type="text/javascript">

    $(document).ready(function() {

        var t = $('#register-table').DataTable({
            "scrollX": true,
            //responsive: true,
            bFilter: false, //show or hide box filter
            bInfo: false,
            bPaginate: false,
            //"sPaginationType": "full_numbers",
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "columnDefs": [{
                "searchable": false,
                "orderable": false,
                "targets": 0
            }],
            "order": [[1, 'asc']]//,
            //"createdRow": function ( row, data, index ) {

            //    var contact_id =  0; row[index].contact_id;

            //    var btn_delete = '<a href="#" onclick="delete_register('+ contact_id +')" class="inline-button" data-toggle="tooltip" title="Delete"> <i class="fa fa-trash-o text-red"></i> </a>';
            //    var btn_edit = '<a href="#" onclick="edit_register('+contact_id+')" class="inline-button" data-toggle="tooltip" title="Edit"> <i class="fa fa-pencil text-orange"></i> </a>';

            //    $('td', row).eq(5).html(btn_edit + " " + btn_delete);
            //    if(data[3] > 1){
            //        $('td', row).eq(3).addClass('blue text-bold');
            //    }
            //}
        });

        t.on('order.dt search.dt', function () {
            t.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();


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

        $(document).off("change", '#display');
        $(document).on("change", '#display', function (event) {
            event.preventDefault();

            post_search();
        });

        //Pagination
        $('#page-selection').bootpag({
            total: <?php echo $pages;?>,
            page: <?php echo $page;?>,
            maxVisible: 5,
            leaps: true,
            firstLastUse: true,
            //first: '<span aria-hidden="true">&larr;</span>',
            //last: '<span aria-hidden="true">&rarr;</span>',
            first: '<i class="fa fa-fast-backward" style="font-size:10px;"></i>',
            last: '<i class="fa fa-fast-forward" style="font-size:10px;"></i>',
            prev: '<i class="fa fa-backward" style="font-size:10px;"></i>',
            next: '<i class="fa fa-forward" style="font-size:10px;"></i>',
            wrapClass: 'pagination',
            activeClass: 'active',
            disabledClass: 'disabled',
            nextClass: 'next',
            prevClass: 'prev',
            lastClass: 'last',
            firstClass: 'first'
        }).on("page", function (event, num) {
            event.preventDefault();

            post_search(num);

            return false;
        });

        $('#search').keyup(function (e)
        {
            if(e.keyCode==13) post_search();
        });

        $(document).off("click", "#btn-search");
        $(document).on("click", "#btn-search", function (event) {
            event.preventDefault();

            post_search();
        });

        $(document).off('submit', '#search-form');
        $(document).on('submit', '#search-form', function(event){
            event.preventDefault();

            post_search();
        });

        function post_search( page=1)
        {
            var count = $("#display").val();
            //var search = $("#search").val();
            //var search_by = $("#search_by").val();

            var url = "<?php echo base_url()?>register/manage_register";

            var data = $("#search-form").serializeArray();
            data.push({name:'submit', value: 1});
            data.push({name:'display', value: count?count:10});

            $.post(url, data , function(data, status, xhr)
            {
                if (data == 521) {
                    go_to_login();
                }
                else {
                    $("#display-content").empty().append(data);
                }
            });

        }
    });

</script>

<script type="text/javascript">
//    $(document).ready(function(){
//
//        $(document).off('click', '#btn-search');
//        $(document).on('click', '#btn-search', function(event){
//            event.preventDefault();
//
//            if($('#search-form').length) $('#search-form').submit();
//        });
//
//
//        $(document).off('submit', '#search-form');
//        $(document).on('submit', '#search-form', function(event){
//            event.preventDefault();
//
//            var form = $(this);
//            var formData = new FormData(form[0]);
//            var url = form.attr('action').toString();
//
//            //var formData = new FormData();
//            formData.append('submit', 1);
//            // Main magic with files here
//            //formData.append('file', $('input[type=file]')[0].files[0]);
//
//            $.ajax({
//                url: url,
//                type: 'POST',
//                data: formData,
//                //dataType:"json",
//                //async: false,
//                cache: false,
//                beforeSend: function(xhr){
//                    //alert('Before send');
//                },
//                success: function(data, status, xhr)
//                {
//                    if(data==521){
//                        go_to_login();
//                    }
//                    else{
//                        $("#display-content").empty().append(data);
//                    }
//                },
//                error: function(xhr,status,error){
//                    //alert('error'+ error);
//                    var message = '{"text":"'+error+'","type":"Error","title":"Error"}';
//                    show_message(message, $("#message"));
//                },
//                complete: function(xhr,status){
//                    //alert(status);
//                },
//                contentType: false,
//                processData: false
//            });
//        });
//    });
</script>

<script type="text/javascript">

    $(document).ready(function(){

        //delete register type
        $(document).off("click",".btn-delete");
        $(document).on("click",".btn-delete", function(event){
            event.preventDefault();

            var btn = $(this);

            confirm_message('Are you sure to delete');

            $(document).off("click", "#dialog-confirm #btn-ok");
            $(document).on("click", "#dialog-confirm #btn-ok", function(event){
                event.preventDefault();

                $("#dialog-confirm").modal("hide");

                var model = JSON.parse(btn.attr('data-json'));
                var formData = new FormData();
                formData.append('submit', 1);
                formData.append('contact_id', model.contact_id);

                $.ajax({
                    //url: '<?php //echo base_url();?>register_group/delete',
                    url: btn.attr("url"),
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
                            if(data.success===true)
                            {
                                if ($(".btn-refresh").length) $(".btn-refresh").trigger('click');
                            }
                            show_message(data.message, $("#message"));
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
    });
</script>


