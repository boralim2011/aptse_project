<html>
<head>
    <title>

    </title>


    <link rel="stylesheet" href="<?php echo base_url();?>template/style/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>template/style/ionicons.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <style type="text/css">

        @page
        {
            /*size: auto;  *//* auto|A4 is the initial value */
            size:A4;
            margin: 0mm;  /* this affects the margin in the printer settings */
        }

        @media print {
            html, body{
                margin: 0;
                padding: 0;
            }
        }

        html{
            margin: 0;
            padding: 0;
        }
        body
        {
            margin: 0;
            padding: 0;
            font-size: 12px;
            font-family: 'Times New Roman';

        }

        div{
            display: block;
            width: 21.1cm;
            height: 29.7cm;
            border: 1px solid blue;
            position: relative;
            left: 0px;
            top: 0cm;

            background-image: url("<?php echo base_url()?>files/visa_thai.jpg");
            background-repeat: no-repeat;
            background-size: 21.1cm ;
        }

        span
        {
            position: absolute;
            display: block;
            min-width: 20px;
            min-height: 20px;
            /*background-color: #ffffff;*/
            /*border: 1px solid blue;*/
        }

        .text-center{ text-align: center; }

        input[type="checkbox"]{
            background: none;
        }

        img{position: absolute;}
        hr{position: absolute; }

        ul{
            position: absolute;
            padding: 0px;
            list-style: none;
        }
        li{
            line-height: 15px;
        }

        i{margin-right: 6px;}

        .check{ font-size: 16px;}

    </style>

</head>
<!--<body onload="window.print()">-->
<body >

<div>

    <!-- Photo -->
    <span style="top:35px; left: 56px; width: 3.2cm; height: 4.6cm; border:1px solid black;"></span>

    <img style="top:46px; left: 330px; width: 84px;" src="<?php echo base_url();?>files/visa_logo.gif">
    <span style="top: 150px; left: 220px; width: 300px; text-transform: uppercase; font-size: 14px;" class="text-center"> Application For Visa </span>
    <span style="top: 175px; left: 220px; width: 300px; text-transform: uppercase; font-size: 14px;" class="text-center"> Royal Thai Embassy. Phnom Penh </span>

    <span style="top: 66px; left: 528px; width: 240px; font-weight: bold; font-size: 11px;" > Please Include Type of Visa Requested</span>
    <ul style="top: 78px; left: 528px; width: 240px; font-size: 11px;" >
        <li> <i class="fa fa-square-o check"></i> Diplomatic Visa </li>
        <li> <i class="fa fa-square-o check" ></i> Official Visa </li>
        <li> <i class="fa fa-square-o check" ></i> Courtesy Visa </li>
        <li> <i class="fa fa-check-square-o check" ></i> None-Immigrant Visa </li>
        <li> <i class="fa fa-square-o check" ></i> Tourist Visa </li>
        <li> <i class="fa fa-square-o check" ></i> Transit Visa </li>
    </ul>
    <span style="top: 190px; left: 528px; width: 240px; font-weight: bold; font-size: 11px;" > Number of Entries Requested ________</span>

    <span style="top: 225px; left: 55px; width: 124px; text-align: left; " >
        <i class="<?php echo $arrival_departure->gender=="M"? "fa fa-check-square-o": "fa fa-square-o";?>"></i> Mr.
        <i class="<?php echo $arrival_departure->gender=="F" && $arrival_departure->marital_status!="Single"? "fa fa-check-square-o": "fa fa-square-o" ;?>" ></i> Mrs.
        <i class="<?php echo $arrival_departure->gender=="F" && $arrival_departure->marital_status=="Single"? "fa fa-check-square-o": "fa fa-square-o";?>" ></i> Miss.
    </span>

    <span style="top: 220px; left: 180px; width: 400px;" class="text-center"> <?php echo $arrival_departure->contact_name; ?> </span>
    <hr style="top:230px; left: 185px; width: 535px;">
    <span style="top: 240px; left: 220px; width: 400px;">First Name </span>
    <span style="top: 240px; left: 320px; width: 400px;">Middle Name </span>
    <span style="top: 240px; left: 430px; width: 400px;">Family Name </span>
    <span style="top: 240px; left: 520px; width: 400px;">(In BLOCK Letters) </span>

    <span style="top: 265px; left: 56px; width: 400px;">Former Name <i>(If any)</i> </span>
    <hr style="top:272px; left: 155px; width: 220px;">

    <span style="top: 285px; left: 180px; width: 140px;"> <?php echo $arrival_departure->nationality_name; ?> </span>
    <span style="top: 317px; left: 180px; width: 140px;"> <?php echo $arrival_departure->nationality_name; ?> </span>
<!--    <span style="top: 347px; left: 110px; width: 100px;"> --><?php //echo $arrival_departure->place_of_birth; ?><!-- </span>-->
    <span style="top: 347px; left: 285px; width: 90px;"> <?php echo $arrival_departure->marital_status; ?> </span>
    <span style="top: 375px; left: 150px; width: 200px;"> <?php echo $arrival_departure->date_of_birth; ?> </span>
    <span style="top: 410px; left: 180px; width: 200px;"> Passport </span>
    <span style="top: 440px; left: 230px; width: 140px;"> Phnom Penh </span>
    <span style="top: 516px; left: 110px; width: 140px;"> <?php echo $arrival_departure->register_type_name; ?> </span>
    <span style="top: 568px; left: 160px; width: 180px;"> <?php echo $arrival_departure->address; ?> </span>
    <span style="top: 840px; left: 160px; width: 180px;"> <?php echo $arrival_departure->travel_method; ?> </span>
    <span style="top: 915px; left: 220px; width: 160px;"> <?php echo $arrival_departure->length_of_stay; ?> </span>
    <span style="top: 993px; left: 64px; width: 10px;" > <i class="fa fa-check" style="font-size: 10px;"></i></span>
    <span style="top: 987px; left: 220px; width: 100px;"> <?php echo $arrival_departure->travel_purpose; ?></span>

    <span style="top: 280px; left: 410px; width: 310px;"> <?php echo $arrival_departure->to_location_name; ?> </span>
    <span style="top: 332px; left: 410px; width: 310px; height: 45px;"> <?php echo $arrival_departure->agency_address; ?> </span>
    <span style="top: 395px; left: 410px; width: 310px; height: 45px; font-size: 85%;"> <?php echo $arrival_departure->company_name.", ".$arrival_departure->company_address ; ?> </span>
    <span style="top: 442px; left: 410px; width: 310px;"> <?php echo $arrival_departure->company_phone; ?> </span>
    <span style="top: 823px; left: 403px; width: 10px;" > <i class="fa fa-check" style="font-size: 10px;"></i></span>
    <span style="top: 838px; left: 410px; width: 310px;"> L-A </span>
    <span style="top: 900px; left: 610px; width: 100px;"> 20$ </span>

</div>

</body>

</html>






