<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Mange Register Type
        <!--<small>Optional description</small>-->
    </h1>
    <ol class="breadcrumb">
    <li><a href="#home"><i class="fa fa-home"></i> Home</a></li>
    <li class="active">Manage Register Type</li>
    </ol>
</section>
<!-- Main content -->
<section class="content no-margin-height">

    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">List of Register Type</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <a href="#" class="btn btn-primary" id="btn-new-register-type"><i class="fa fa-plus"></i> Add</a>
                    <a href="#register_type" class="btn btn-primary btn-refresh"><i class="fa fa-refresh"></i> Refresh</a>
                </div>
                <div class="box-body">
                    <table id="register-type-table" class="table table-bordered table-hover data-table">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Register Type Name </th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(isset($register_types) && is_array($register_types)){
                            foreach($register_types as $row){
                                ?>
                                <tr>
                                    <td></td>
                                    <td><?php echo isset($row->register_type_name)? $row->register_type_name:"";?></td>

                                    <td>
                                        <a href="#" data-json='<?php echo json_encode($row);?>' class="inline-button btn-edit" data-toggle="tooltip" title="Edit"> <i class="fa fa-pencil text-orange"></i> </a>
                                        <a href="#" data-json='<?php echo json_encode($row);?>' class="inline-button btn-delete" data-toggle="tooltip" title="Delete" url="<?php echo base_url();?>register_type/delete"> <i class="fa fa-trash-o text-red"></i> </a>
                                    </td>
                                </tr>
                            <?php
                            }
                        }
                        ?>
                        </tbody>

                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->

    <div id = "message" >
        <?php if(isset($message)) $this->show_message($message); ?>
    </div>

</section><!-- /.content -->


<script type="text/javascript">

    $(document).ready(function(){

        var t = $('#register-type-table').DataTable( {
            "scrollX": true,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "columnDefs": [ {
                "searchable": false,
                "orderable": false,
                "targets": 0
            } ],
            "order": [[ 1, 'asc' ]]//,
//            "createdRow": function ( row, data, index ) {
//
//                var user_id =  0;//row[index].user_id;
//
//                var btn_delete = '<a href="#" onclick="delete_user('+ user_id +')" class="inline-button" data-toggle="tooltip" title="Delete"> <i class="fa fa-trash-o text-red"></i> </a>';
//                var btn_edit = '<a href="#" onclick="edit_user('+user_id+')" class="inline-button" data-toggle="tooltip" title="Edit"> <i class="fa fa-pencil text-orange"></i> </a>';
//
//                $('td', row).eq(5).html(btn_edit + " " + btn_delete);
//                if(data[3] > 1){
//                    $('td', row).eq(3).addClass('blue text-bold');
//                }
//            }
        } );

        t.on( 'order.dt search.dt', function () {
            t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();

    });

</script>

<script type="text/javascript">

    $(document).ready(function(){

        //edit use type
        $(document).off("click",".btn-edit");
        $(document).on("click",".btn-edit", function(event){
            event.preventDefault();

            $("#dialog-register-type .modal-title").html("Edit Register Type");
            $("#register-type-form").attr('action', '<?php echo base_url()?>register_type/edit' );

            var model = JSON.parse($(this).attr('data-json'));
            $("#register_type_id").val(model.register_type_id);
            $("#register_type_name").val(model.register_type_name);
            $("#is_deletable").val(model.is_deletable);

            $("#dialog-register-type").modal({
                backdrop: "static" // true | false | "static" => default is true
            });
        });

        //delete user type
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
                formData.append('register_type_id', model.register_type_id);

                $.ajax({
                    //url: '<?php //echo base_url();?>register_type/delete',
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



<?php $this->load->view('register_type/new_register_type'); ?>


