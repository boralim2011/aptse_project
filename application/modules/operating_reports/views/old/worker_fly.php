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

<h4 class="text-center report text-bold">
    Report Worker Flight
</h4>

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

        $total = array();
        foreach($registers as $row)
        {
            $date_of_fly = new DateTime($row->date_of_fly);
            $year = Date('Y', $date_of_fly->getTimestamp());
            $month = Date('Y-m', $date_of_fly->getTimestamp());
            $type = $month.$row->service_type_name;

            $total[$year] = isset($total[$year])? $total[$year] + 1 : 1;
            $total[$month] = isset( $total[$month])?  $total[$month] + 1 : 1;
            $total[$type] =  isset($total[$type])? $total[$type] + 1 : 1;
        }

        $group_service_type = '';
        $group_year = '';
        $group_month = '';
        $no = 0;
        foreach($registers as $row)
        {
            $no++;

            $date_of_fly = new DateTime($row->date_of_fly);
            $year = Date('Y', $date_of_fly->getTimestamp());
            $month = Date('Y-m', $date_of_fly->getTimestamp());
            $type = $month.$row->service_type_name;

            if($group_year!= $year ){ ?>
            <tr>
                <td colspan="2" class="text-bold"><?php echo Date('Y', $date_of_fly->getTimestamp()); ?></td>
                <td colspan="11" >Total : <?php echo $total[$year];?></td>
            </tr>
            <?php }
            if($group_month!= $month ){
                $no = 1;
                ?>
            <tr>
                <td colspan="2" class="text-bold"><?php echo Date('F', $date_of_fly->getTimestamp()); ?></td>
                <td colspan="11" >Total : <?php echo $total[$month];?></td>
            </tr>
            <?php }
            if($group_service_type!= $type){
                ?>
            <tr>
                <td colspan="3"><?php echo isset($row->service_type_name)? $row->service_type_name:"";?></td>
                <td colspan="10" >Total : <?php echo $total[$type];?></td>
            </tr>
            <?php }
            $group_year = Date('Y', $date_of_fly->getTimestamp());
            $group_month = Date('Y-m', $date_of_fly->getTimestamp());
            $group_service_type = $group_month.$row->service_type_name;
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