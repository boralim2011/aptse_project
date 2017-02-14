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
            /*size: auto;  /* auto|A4 is the initial value */
            size: 33.02cm 21.59cm;
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

        }

        div{
            display: block;
            width: 37.5cm;
            height: 8.2cm;
            /*border: 1px solid blue;*/
            position: relative;
            left: -4.5cm;
            top: 6.5cm;

            background-image: url("<?php echo base_url()?>files/thai_border.jpg");
            background-repeat: no-repeat;
            background-size: 37.5cm;
        }

        span
        {
            position: absolute;
            display: block;
            min-width: 20px;
            min-height: 20px;
            background-color: #f5f5f5;
            text-align: center;
        }

        span.check{
            background-image: url("<?php echo base_url()?>files/checkmark.png");
            background-size: 10px;
            background-repeat: no-repeat;
            background-color: transparent;
        }

        input[type="checkbox"]{
            background: none;
        }



    </style>

</head>
<body onload="window.print()">
<!--<body >-->

<div>
    <span style="top: 78px; left: 114px; width: 290px;"> <?php echo $arrival_departure->last_name; ?> </span>
    <span style="top: 121px; left: 820px; width: 290px;"> <?php echo $arrival_departure->last_name; ?> </span>

    <span style="top: 114px; left: 114px; width: 290px;"> <?php echo $arrival_departure->first_name; ?> </span>
    <span style="top: 154px; left: 820px; width: 290px;"> <?php echo $arrival_departure->first_name; ?> </span>

    <span style="top: 140px; left: 114px; width: 214px;"> <?php echo $arrival_departure->nationality_name; ?> </span>
    <span style="top: 212px; left: 820px; width: 290px;"> <?php echo $arrival_departure->nationality_name; ?> </span>

    <span style="top: 173px; left: 368px; width: 20px;"> <?php echo Date("d", (new DateTime($arrival_departure->date_of_birth))->getTimestamp() ); ?> </span>
    <span style="top: 173px; left: 408px; width: 20px;"> <?php echo Date("m", (new DateTime($arrival_departure->date_of_birth))->getTimestamp() ); ?> </span>
    <span style="top: 173px; left: 448px; width: 40px;"> <?php echo Date("Y", (new DateTime($arrival_departure->date_of_birth))->getTimestamp() ); ?> </span>

    <span style="top: 187px; left: 825px; width: 20px;"> <?php echo Date("d", (new DateTime($arrival_departure->date_of_birth))->getTimestamp() ); ?>  </span>
    <span style="top: 187px; left: 865px; width: 20px;"> <?php echo Date("m", (new DateTime($arrival_departure->date_of_birth))->getTimestamp() ); ?>  </span>
    <span style="top: 187px; left: 910px; width: 40px;"> <?php echo Date("Y", (new DateTime($arrival_departure->date_of_birth))->getTimestamp() ); ?>  </span>

    <span style="top: 147px; left: 363px; width: 10px;" class="<?php if($arrival_departure->gender=="M") echo "check";?>"> &nbsp;</span>
    <span style="top: 147px; left: 430px; width: 10px;" class="<?php if($arrival_departure->gender=="F") echo "check";?>"> &nbsp;</span>

    <span style="top: 191px; left: 1020px; width: 10px;" class="<?php if($arrival_departure->gender=="M") echo "check";?>"> &nbsp;</span>
    <span style="top: 191px; left: 1078px; width: 10px;" class="<?php if($arrival_departure->gender=="F") echo "check";?>"> &nbsp;</span>

    <span style="top: 173px; left: 114px; width: 180px;"> <?php echo  $arrival_departure->passport_no; ?> </span>
    <span style="top: 244px; left: 820px; width: 290px;"> <?php echo  $arrival_departure->passport_no; ?>  </span>

<!--    <span style="top: 193px; left: 113px; width: 198px;"> --><?php //echo  $arrival_departure->travel_method; ?><!-- </span>-->
<!--    <span style="top: 193px; left: 429px; width: 198px;"> --><?php //echo  $arrival_departure->travel_method; ?><!--  </span>-->
<!---->
<!--    <span style="top: 219px; left: 113px; width: 198px;"> --><?php //echo  $arrival_departure->from_location_name; ?><!-- </span>-->
<!--    <span style="top: 219px; left: 429px; width: 198px;"> --><?php //echo  $arrival_departure->to_location_name; ?><!--  </span>-->
<!---->
    <span style="top: 205px; left: 114px; width: 216px;"> <?php echo  $arrival_departure->visa_no;  ?> </span>
    <span style="top: 236px; left: 171px; width: 290px;"> <?php echo  $arrival_departure->agency_name; ?> </span>
    <span style="top: 256px; left: 171px; width: 290px;"> <?php echo  $arrival_departure->agency_address; ?>  </span>
<!---->
<!--    <span style="top: 274px; left: 69px; width: 114px;"> --><?php //echo  $arrival_departure->travel_purpose; ?><!--  </span>-->
<!--    <span style="top: 274px; left: 256px; width: 54px;"> --><?php //echo  $arrival_departure->length_of_stay; ?><!--  </span>-->
<!---->
<!--    <span style="top: 304px; left: 95px; width: 210px;"> --><?php //echo  $arrival_departure->from_address; ?><!--  </span>-->

</div>

</body>

</html>






