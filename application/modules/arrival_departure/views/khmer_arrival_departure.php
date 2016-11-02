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
            /*size:A4;*/
            size: auto;  /* auto|A4 is the initial value */
            /*size:17cm 13cm;*/
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
            width: 17cm;
            height: 13.5cm;
            /*border: 1px solid blue; */
            position: relative;
            left: 2cm;
            top: 0px;

            background-image: url("<?php echo base_url()?>files/khmer_border.jpg");
            background-repeat: no-repeat;
            background-size: 17cm;
        }

        span
        {
            position: absolute;
            display: block;
            min-width: 20px;
            min-height: 20px;
            /*background-color: #f5f5f5;*/
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


        .design  {
            padding-left:25px;
            background:url("<?php echo base_url()?>files/checkmark.png") no-repeat top left;
            display: inline-block;
            height: 17px;
            width: 50px;
        }

    </style>

</head>
<body onload="window.print()">
<!--<body >-->

<div>

<!--    <span class="design">Design Viz</span>-->


    <span style="top: 81px; left: 68px; width: 240px;"> <?php echo $arrival_departure->last_name; ?> </span>
    <span style="top: 81px; left: 386px; width: 240px;"> <?php echo $arrival_departure->last_name; ?> </span>

    <span style="top: 108px; left: 68px; width: 240px;"> <?php echo $arrival_departure->first_name; ?> </span>
    <span style="top: 108px; left: 386px; width: 240px;"> <?php echo $arrival_departure->first_name; ?> </span>

    <span style="top: 137px; left: 69px; width: 75px;"> <?php echo Date("d m Y", (new DateTime($arrival_departure->date_of_birth))->getTimestamp() ); ?> </span>
    <span style="top: 137px; left: 387px; width: 75px;"> <?php echo Date("d m Y", (new DateTime($arrival_departure->date_of_birth))->getTimestamp() ); ?>  </span>

    <span style="top: 137px; left: 195px; width: 115px;"> <?php echo $arrival_departure->nationality_name; ?> </span>
    <span style="top: 137px; left: 512px; width: 115px;"> <?php echo $arrival_departure->nationality_name; ?> </span>

    <span style="top: 165px; left: 69px; width: 167px;"> <?php echo  $arrival_departure->passport_no; ?> </span>
    <span style="top: 165px; left: 387px; width: 167px;"> <?php echo  $arrival_departure->passport_no; ?>  </span>

    <span style="top: 163px; left: 300px; width: 10px;" class="<?php //if($arrival_departure->gender=="M") echo "check";?>"><i class="<?php if($arrival_departure->gender=="M") echo "fa fa-check";?>" style="font-size: 10px;"></i></span>
    <span style="top: 175px; left: 300px; width: 10px;" class="<?php //if($arrival_departure->gender=="F") echo "check";?>"><i class="<?php if($arrival_departure->gender=="F") echo "fa fa-check";?>" style="font-size: 10px;"></i></span>

    <span style="top: 163px; left: 618px; width: 10px;" class="<?php //if($arrival_departure->gender=="M") echo "check";?>"><i class="<?php if($arrival_departure->gender=="M") echo "fa fa-check";?>" style="font-size: 10px;"></i></span>
    <span style="top: 175px; left: 618px; width: 10px;" class="<?php //if($arrival_departure->gender=="F") echo "check";?>"><i class="<?php if($arrival_departure->gender=="F") echo "fa fa-check";?>" style="font-size: 10px;"></i></span>

    <span style="top: 193px; left: 113px; width: 198px;"> <?php echo  $arrival_departure->travel_method; ?> </span>
    <span style="top: 193px; left: 429px; width: 198px;"> <?php echo  $arrival_departure->travel_method; ?>  </span>

    <span style="top: 219px; left: 113px; width: 198px;"> <?php echo  $arrival_departure->from_location_name; ?> </span>
    <span style="top: 219px; left: 429px; width: 198px;"> <?php echo  $arrival_departure->to_location_name; ?>  </span>

    <span style="top: 246px; left: 69px; width: 82px;"> <?php echo  $arrival_departure->visa_no;  ?> </span>
    <span style="top: 246px; left: 215px; width: 94px;"> <?php echo  $arrival_departure->visa_issue_location_name; ?> </span>
    <span style="top: 246px; left: 429px; width: 198px;"> <?php echo  $arrival_departure->travel_purpose; ?>  </span>

    <span style="top: 274px; left: 69px; width: 114px;"> <?php echo  $arrival_departure->travel_purpose; ?>  </span>
    <span style="top: 274px; left: 256px; width: 54px;"> <?php echo  $arrival_departure->length_of_stay; ?>  </span>

<!--    <span style="top: 304px; left: 95px; width: 210px;"> --><?php //echo  $arrival_departure->from_address; ?><!--  </span>-->

</div>

</body>

</html>






