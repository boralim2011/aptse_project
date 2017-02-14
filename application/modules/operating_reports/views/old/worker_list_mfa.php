<!-- title row -->
<div class="row">
    <div class="col-xs-12">
        <h2 class="page-header">
            <i class="fa fa-globe"></i> AdminLTE, Inc.
            <small class="pull-right">Date: <?php echo Date("y-m-d h:i A"); ?></small>
        </h2>
    </div><!-- /.col -->
</div>

<p>Ref No: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; AP(Malaysia) </p>
<h4 class="text-center report" style="text-transform: uppercase; font-family: times;">
    List Of Cambodian Worker to Work in Malaysia
</h4>

<table id="register-table" class="table table-striped table-bordered report">
    <thead>
    <tr>
        <th >No</th>
        <th >Worker Code</th>
        <th >Name (Khmer)</th>
        <th >Name</th>
        <th >Sex</th>
        <th class="date-col">DOB</th>
        <th >Passport No</th>
        <th >Name of Employer And Address</th>
    </tr>

    </thead>
    <tbody>
    <?php if(isset($registers) && is_array($registers)){
        $no = 0;
        foreach($registers as $row){
            $no++;

            $employer = $row->employer_name;
            if(isset($row->employee_address)) $employer.= "<br>$row->employee_address";
            if(isset($row->employee_address_2)) $employer.= ", $row->employee_address_2";
            if(isset($row->employee_address_3)) $employer.= ", $row->employee_address_3";
            if(isset($row->employee_address_4)) $employer.= ", $row->employee_address_4";
            if(isset($row->employee_address_5)) $employer.= ", $row->employee_address_5";

            ?>
            <tr>
                <td><?php echo $no;?></td>
                <td><?php echo isset($row->worker_code)? $row->worker_code:"";?></td>
                <td><?php echo isset($row->contact_name_kh)? $row->contact_name_kh:"";?></td>
                <td><?php echo isset($row->contact_name)? $row->contact_name:"";?></td>
                <td><?php echo isset($row->gender)? $row->gender:"";?></td>
                <td><?php echo isset($row->age)? $row->date_of_birth:"";?></td>
                <td><?php echo isset($row->passport_no)? $row->passport_no:"";?></td>
                <td><?php echo $employer;?></td>

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

<br>
<table width="100%">
    <tr>
        <td> </td>
        <td width="360px" align="center" >​ ធ្វើនៅរាជធានីភ្នំពេញ ថ្ងៃទី​  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ខែ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ឆ្នាំ  <?php echo Date("Y");?> </td>
    </tr>
    <tr>
        <td></td>
        <td style="width: 32px; text-align: center; font-family: 'Khmer OS Muol Light'; font-size: 14px; padding-top: 10px;" > អគ្គនាយក្រុមហ៊ុន </td>
    </tr>
</table>

