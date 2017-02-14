<div class="report">

    <div>

        <div class="pull-left" style="width: 260px; text-align: center;">
            <img src="<?php echo isset($logo)? $logo:"";?>" width="80" height="80" >
            <h4 style="font-family: 'Times New Roman'; font-size: 14px; " >
                MINISTRY OF LABOUR<br>
                AND VOCATIONAL TRAINING<br>
                No:………………………..M.L.V.T<br>
            </h4>

        </div>
        <h4 style="font-family: 'Times New Roman'; font-size: 18px; font-width:bold; text-transform:uppercase ; text-align: center">Kingdom of Cambodia <br> Nation Religion King</h4>

        <div class="clearfix"></div>
    </div>


    <h4 class="text-center" style="font-family: 'Times New Roman'; font-size: 14px; font-weight: bold; text-decoration: underline;">
        Confirmed List of OCWC Card Holders who Request for Non-immigrant Visa from Embassy of Thailand
    </h4>
    <table width="100%">
        <tr>
            <td style="font-family: 'Times New Roman'; font-size: 14px; font-weight: bold;width: 40%; padding-left: 5px;">No.: <?php echo isset($report_no)?$report_no:"";?></td>
            <td style="font-family: 'Times New Roman'; font-size: 14px; font-weight: bold;text-align: right; padding-right: 5px;" "><?php echo isset($company_name)? $company_name:""?></td>
        </tr>
    </table>
    <br>
    <table id="register-table" class="table table-striped table-bordered report">
        <thead>
        <tr>
            <th class="text-center"> No. </th>
            <th > Surname & Name <br/> (English) </th>
            <th class="text-center"> Sex</th>
            <th class="text-center"> Date of Birth </th>
            <th class="text-center"> Passport No. </th>
            <th class="text-center"> OCWC No. </th>
            <th class="text-center"> Family's address and <br> Tel. in Cambodia </th>
            <th class="text-center" style="font-size: 10px;"> Address of Working Place in Thailand <br> (Name of Employer, Address and Tel.) </th>
            <th class="text-center" style="font-size: 10px;"> Company Partner in Thailand <br> (Name, Address and Tel.) </th>
        </tr>

        </thead>
        <tbody>
        <?php if(isset($registers) && is_array($registers)){
            $no = 0;
            foreach($registers as $row){
                $no++;
                $date = strtotime($row->date_of_birth);
                $dob = Date("d-m-Y",$date);
                ?>
                <tr>
                    <td class="text-center"><?php echo $no;?></td>
                    <td><?php echo isset($row->contact_name)? $row->contact_name:"";?></td>
                    <td class="text-center"><?php echo isset($row->gender)? $row->gender:"";?></td>
                    <td class="text-center"><?php echo $dob;?></td>
                    <td class="text-center"><?php echo isset($row->passport_no)? $row->passport_no:"";?></td>
                    <td class="text-center"><?php echo isset($row->ocwc_no)? $row->ocwc_no:"";?></td>
                    <td class="text-center"><?php echo isset($row->place_of_birth)? $row->place_of_birth:"";?></td>
                    <td class="text-center" style="width: 200px; font-size: 9px; ">
                        <?php echo $row->employer_name; ?>
                        <span style="font-size: 8px;"><?php echo  isset($row->employer_address)? "<br>".$row->employer_address:"";?></span>
                    </td>
                    <td class="text-center" style="width: 200px; font-size: 9px; ">
                        <?php echo $row->agency_name;?>
                        <span style="font-size: 8px;"><?php echo isset($row->agency_address)? "<br>".$row->agency_address:"";?></span>
                    </td>
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
            <td width="360px" align="center" >​ Phnom Penh <span style="display: inline-block; width: 110px;"></span> <?php echo Date("Y");?> </td>
        </tr>
        <tr>
            <td></td>
            <td style="width: 32px; text-align: center; font-family: 'Times New Roman'; font-size: 12px; padding-top: 10px;" >GENERAL DEPARTMENT OF LABOUR</td>
        </tr>
        <tr>
            <td></td>
            <td width="360px" align="center" >
                <br/><br/><br/><br/>
            </td>
        </tr>
    </table>

</div>
