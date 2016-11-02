<!-- title row-->
<!--<div class="row">-->
<!--    <div class="col-xs-12">-->
<!--        <h2 class="page-header">-->
<!--            <i class="fa fa-globe"></i> AdminLTE, Inc.-->
<!--            <small class="pull-right">Date: --><?php //echo Date("y-m-d h:i A"); ?><!--</small>-->
<!--        </h2>-->
<!--    </div>-->
<!--</div>-->

<p>លេខ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; AP</p>

<h4 class="text-center" style="font-family: 'Khmer OS Muol Light'; font-size: 16px;">
    បញ្ជីរាយនាម ពលករខ្មែរចេញដំណើរទៅប្រទេសថៃឡង់ដ៍
</h4>

<table id="register-table" class="table table-striped table-bordered report">
    <thead>
    <tr>
        <th > ល.រ <br/> No </th>
        <th > លេខកូដ <br/> Worker Code </th>
        <th > ឈ្មោះជាភាសាខ្មែរ <br/> Name (Khmer) </th>
        <th > ឈ្មោះជាភាសាអង់គ្លេស <br/> Name (English) </th>		
        <th > ភេទ <br/> Sex</th>
        <th > ថ្ងៃខែឆ្នាំកំណើត <br/> DOB</th>
		<th > មកពីខេត្ត <br/> Province </th>
        <th > លិខិតឆ្លងដែនលេខ <br/> Passport No</th>
        <th > ភ្នាក់ងារនៅថៃឡង់ដ៍ <br/> Agency in Thailand</th>
    </tr>

    </thead>
    <tbody>
    <?php if(isset($registers) && is_array($registers)){
        $no = 0;
        foreach($registers as $row){
            $no++;

            //$agency = isset($row->agency_name)? $row->agency_name."<br>":"";
            //$agency.= $row->agency_address." ".$row->phone_number;
            $agency = $row->agency_name;

            ?>
            <tr>
                <td><?php echo $no;?></td>
                <td><?php echo isset($row->worker_code)? $row->worker_code:"";?></td>
                <td><?php echo isset($row->contact_name_kh)? $row->contact_name_kh:"";?></td>
                <td><?php echo isset($row->contact_name)? $row->contact_name:"";?></td>
                <td><?php echo isset($row->gender)? $row->gender:"";?></td>
                <td><?php echo isset($row->age)? $row->date_of_birth:"";?></td>
				<td><?php echo isset($row->province_name)? $row->province_name:"";?></td>
                <td><?php echo isset($row->passport_no)? $row->passport_no:"";?></td>
                <td class="align-center"><?php echo $agency;?></td>

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

