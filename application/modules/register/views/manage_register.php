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

            <?php
                $this->load->view("register/search_info");
            ?>

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
                                    <td><?php echo isset($row->contact_code)? $row->contact_code:"";?></td>
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


        //$(".select2").select2();

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
                                //if ($(".btn-refresh").length) $(".btn-refresh").trigger('click');
                                post_search();
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


