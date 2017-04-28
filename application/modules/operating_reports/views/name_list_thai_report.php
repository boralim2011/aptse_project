
<div class="report">
    <p style="display: block; height: 7cm;">&nbsp;</p>
    <h4 class="text-center" style="font-family: 'Times New Roman'; font-size: 14px; font-weight: bold;">
        Name List of Cambodian Workers<br/>
        Working Place : <?php echo isset($employer_name)? $employer_name:"";?><br/>
        Address : <?php echo isset($employer_address) ? $employer_address:"";?><br/>
        Sending Company : <?php echo isset($company_name)? $company_name:"";?>
    </h4>

    <table id="register-table" class="table table-striped table-bordered report">
        <thead>
        <tr>
            <th class="text-center"> No. </th>
            <th > Surname & Name <br/> (Khmer)</th>
            <th > Surname & Name <br/> (English) </th>
            <th class="text-center"> Sex</th>
            <th class="text-center"> Date of Birth </th>
            <th class="text-center"> Passport No. </th>
            <th class="text-center"> OCWC No. </th>
            <th class="text-center"> Place of Birth </th>
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
                    <td style="font-family:'Khmer OS System'; font-size: 12px;"><?php echo isset($row->contact_name_kh)? $row->contact_name_kh:"";?></td>
                    <td><?php echo isset($row->contact_name)? $row->contact_name:"";?></td>
                    <td class="text-center"><?php echo isset($row->gender)? $row->gender:"";?></td>
                    <td class="text-center"><?php echo $dob;?></td>
                    <td class="text-center"><?php echo isset($row->passport_no)? $row->passport_no:"";?></td>
                    <td class="text-center"><?php echo isset($row->ocwc_no)? $row->ocwc_no:"";?></td>
                    <td class="text-center"><?php echo isset($row->place_of_birth)? $row->place_of_birth:"";?></td>
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
                Dr. SENG SAKDA<br/>
                DIRECTOR GENERAL
            </td>
        </tr>
    </table>


</div>
