<!-- title row -->
<div class="row">
    <div class="col-xs-12">
        <h2 class="page-header">
            <i class="fa fa-globe"></i> AdminLTE, Inc.
            <small class="pull-right">Date: <?php echo Date("y-m-d h:i A"); ?></small>
        </h2>
    </div><!-- /.col -->
</div>

<?php
    $agency_name = is_array($registers) && count($registers)? $registers[0]->agency_name: "";
    $bio_send_date = is_array($registers) && count($registers)? $registers[0]->date_of_send_bio_scan: "";
?>

<p class="text-center report">
    Report send BIO to Agency : <?php echo $agency_name;?> <br/>
    BIO Data Sending Date : <?php echo $bio_send_date;?>
</p>

<table id="register-table" class="table table-striped table-bordered report">
    <thead>
    <tr>
        <th rowspan="2">No</th>
        <th rowspan="2">Worker Code</th>
        <th rowspan="2">Name</th>
        <th rowspan="2">Sex</th>
        <th rowspan="2">Age</th>
        <th rowspan="2">Type</th>
        <th colspan="3">BIO</th>
        <th rowspan="2">Document</th>
        <th rowspan="2">Recruiter</th>
        <th rowspan="2" class="date-col">Fly</th>
        <th rowspan="2">Agency</th>
    </tr>
    <tr>
        <th class="date-col">BIO S'D</th>
        <th class="date-col">PPC S'D</th>
        <th class="date-col">MCUp S'D</th>
    </tr>
    </thead>
    <tbody>
    <?php if(isset($registers) && is_array($registers)){
        $group = '';
        $no = 0;
        foreach($registers as $row){
            $no++;
            if($group!= $row->service_type_name){ ?>
            <tr>
                <td colspan="13"><?php echo isset($row->service_type_name)? $row->service_type_name:"";?></td>
            </tr>
            <?php }
            $group = $row->service_type_name;
            ?>
            <tr>
                <td><?php echo $no;?></td>
                <td><?php echo isset($row->worker_code)? $row->worker_code:"";?></td>
                <td><?php echo isset($row->contact_name)? $row->contact_name:"";?></td>
                <td><?php echo isset($row->gender)? $row->gender:"";?></td>
                <td><?php echo isset($row->age)? $row->age:"";?></td>
                <td><?php echo isset($row->register_type_name)? $row->register_type_name:"";?></td>
                <td><?php echo isset($row->date_of_send_bio_scan)? $row->date_of_send_bio_scan:"";?></td>
                <td><?php echo isset($row->date_of_send_ppc_sd)? $row->date_of_send_ppc_sd:"";?></td>
                <td><?php echo isset($row->date_of_send_medical_checkup_sd)? $row->date_of_send_medical_checkup_sd:"";?></td>
                <td><?php echo isset($row->document_type_name)? $row->document_type_name:"";?></td>
                <td><?php echo isset($row->recruiter_name)? $row->recruiter_name:"";?></td>
                <td><?php echo isset($row->date_of_fly)? $row->date_of_fly:"";?></td>
                <td><?php echo isset($row->agency_name)? $row->agency_name:"";?></td>
            </tr>
        <?php
        }
    }
    ?>
    </tbody>
</table>

<?php if(!isset($registers) || !is_array($registers) || count($registers) == 0 ){ ?>
    <h4 class="red">No records found</h4>
<?php }?>