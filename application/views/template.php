<?php

//menu group general items
$general_items = array
(
    'company'=>'company',
    'recruiter'=>'recruiter',
    'employee'=>'employee',
    'location'=>'location',
    'nationality'=>'nationality',
    'register type'=>'register type',
    'document type'=>'document type',
    'service type'=>'service type',
    'timetable'=>'timetable',
    'holiday'=>'holiday',
    'permission type'=>'permission type',
    'chart of account'=>'chart of account'
);

$user_items = array(
    'user group'=>'user group',
    'user'=>'user'
);
$operating_items = array(
    'registration'=>'registration',
    'documentation'=>'documentation'
);
$accounting_items = array(
    'general journal'=>'general journal',
    'bill'=>'bill',
    'pay bill'=>'pay bill',
    'invoice'=>'invoice',
    'receipt'=>'receipt'
);
$payroll_items = array(
    'employee schedule'=>'employee schedule',
    'attendance'=>'attendance',
    'monthly payroll'=>'monthly payroll'
);
$reporting_items = array(
    'operating reports'=>'operating reports',
    'accounting reports'=>'accounting reports',
    'payroll reports'=>'payroll reports'
);

?>



<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>BIS | <?php echo $title; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url();?>template/bootstrap/css/bootstrap.min.css">


    <link rel="stylesheet" href="<?php echo base_url();?>template/style/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>template/style/ionicons.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">


    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url();?>template/plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url();?>template/plugins/datatables/responsive.bootstrap.min.css">


    <!-- daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url();?>template/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?php echo base_url();?>template/plugins/iCheck/all.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="<?php echo base_url();?>template/plugins/colorpicker/bootstrap-colorpicker.min.css">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="<?php echo base_url();?>template/plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo base_url();?>template/plugins/select2/select2.min.css">
    <!-- Bootstrap Date Picker -->
    <link rel="stylesheet" href="<?php echo base_url();?>template/plugins/datepicker/datepicker3.css">


    <!--Dream Alert-->
    <!--<link href="--><?php //echo base_url();?><!--template/plugins/dreamalert/jquery.dreamalert.css" media="screen" rel="stylesheet" type="text/css" />-->
    <!-- Toast message  -->
    <link href="<?php echo base_url();?>template/plugins/toastr/toastr.css" rel="stylesheet" type="text/css" />
    <!-- Toast message -->

    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url();?>template/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <!--<link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">-->
    <link rel="stylesheet" href="<?php echo base_url();?>template/dist/css/skins/_all-skins.min.css">

    <!-- Custom style-->
    <link rel="stylesheet" href="<?php echo base_url();?>template/style/custom_style.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script type="text/javascript">
        if(navigator.onLine)
        {
            //alert("Online");
        }
        else
        {
            //alert("Offline");
        }
    </script>



</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a href="<?php echo base_url();?>" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>AP</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>A.P.T.S.E</b> Cambodia</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <img src="<?php echo $this->UserSession->photo_path; //base_url().$DefaultUserImage; ?>" class="user-image" alt="User Image">
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs"><?php echo $this->UserSession->user_name;?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="<?php echo $this->UserSession->photo_path;//base_url().$DefaultUserImage;?>" class="img-circle" alt="User Image">
                                <p>
                                    <?php echo $this->UserSession->user_name;?> - <?php echo $this->UserSession->user_group_name;?>
                                    <small>Member since <?php echo Date("Y-m-d", (new DateTime($this->UserSession->created_date))->getTimestamp()) ;?></small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                                <div>
                                    <a href="<?php echo base_url();?>user/change_password" ><i class="fa fa-edit"></i> Change Password</a>
                                </div>
                                <!--<div class="col-xs-4 text-center">-->
                                <!--<a href="#">Sales</a>-->
                                <!--</div>-->
                                <!--<div class="col-xs-4 text-center">-->
                                <!--<a href="#">Friends</a>-->
                                <!--</div>-->
                            </li>

                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#user/edit/<?php echo $this->UserSession->user_id;?>" class="btn btn-default btn-flat" data-json='<?php echo json_encode($this->UserSession);?>' ><i class="fa fa-user"></i> Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="<?php echo base_url();?>login/logout" class="btn btn-default btn-flat"><i class="fa fa-power-off"></i> Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>

                    <!-- Language -->
<!--                    <li class="dropdown notifications-menu language-menu">-->
<!--                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">-->
<!--                            <img src="--><?php //echo base_url();?><!--template/dist/img/khmer.png" class="no-margin"/>-->
<!--                        </a>-->
<!--                        <ul class="dropdown-menu">-->
<!--                            <li>-->
<!--                                <ul class="menu">-->
<!--                                    <li><a href="#" class="font-khmer"><img src="--><?php //echo base_url();?><!--template/dist/img/khmer.png"/> ភាសាខ្មែរ</a></li>-->
<!--                                    <li><a href="#"><img src="--><?php //echo base_url();?><!--template/dist/img/english.png"/> English </a></li>-->
<!--                                </ul>-->
<!--                            </li>-->
<!--                        </ul>-->
<!--                    </li>-->

                    <!-- Control Sidebar Toggle Button -->
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gear"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- Sidebar user panel (optional) -->
            <div class="user-panel margin-bottom">
                <div class="pull-left image">
                    <img src="<?php echo base_url();?>template/dist/img/logo.png" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>BIS Management System</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-anchor"></i> lead to success</a>

                </div>
            </div>

            <!-- search form (Optional) -->
            <!--<form action="#" method="get" class="sidebar-form">-->
            <!--<div class="input-group">-->
            <!--<input type="text" name="q" class="form-control" placeholder="Search...">-->
            <!--<span class="input-group-btn">-->
            <!--<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>-->
            <!--</span>-->
            <!--</div>-->
            <!--</form>-->
            <!-- /.search form -->

            <!-- Sidebar Menu -->
            <ul class="sidebar-menu">
                <li class="header">Main Menu</li>
                <!-- Optionally, you can add icons to the links -->
                <li <?php if( $this->Menu=='' || $this->Menu=='home') echo 'class="active"'; ?> >
                    <a href="#home"><i class="fa fa-qrcode"></i> <span>Dashboard</span></a>
                </li>
                <li class="treeview <?php if(array_key_exists($this->Menu, $general_items)) echo 'active'; ?>">
                    <a href="#">
                        <i class="fa fa-gear"></i> <span>General</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu <?php if(array_key_exists($this->Menu, $general_items)) echo 'menu-open'; ?>" <?php if(array_key_exists($this->Menu, $general_items)) echo 'style="display: block;"'; ?> >

                        <!-- Company and partner -->
                        <li <?php if($this->Menu=='company') echo 'class="active"'; ?> >
                            <a href="#company"><i class="fa fa fa-bank"></i> <span>Company & Partner</span></a>
                        </li>
                        <!-- General setup -->
                        <li <?php if($this->Menu=='location') echo 'class="active"'; ?> >
                            <a href="#location"><i class="fa fa-map-marker"></i> <span>Location</span></a>
                        </li>
                        <li <?php if($this->Menu=='nationality') echo 'class="active"'; ?> >
                            <a href="#nationality"><i class="fa fa-flag"></i> <span>Nationality</span></a>
                        </li>
                        <li <?php if($this->Menu=='border_crossings') echo 'class="active"'; ?> >
                            <a href="#border_crossings"><i class="fa fa-arrows"></i> <span>Border Crossings</span></a>
                        </li>

                        <!-- Register -->
                        <li <?php if($this->Menu=='agency type') echo 'class="active"'; ?> >
                            <a href="#agency_type"><i class="fa fa-at"></i> <span>Agency Type</span></a>
                        </li>
                        <li <?php if($this->Menu=='register type') echo 'class="active"'; ?> >
                            <a href="#register_type"><i class="fa fa-registered"></i> <span>Register Type</span></a>
                        </li>
                        <li <?php if($this->Menu=='document type') echo 'class="active"'; ?> >
                            <a href="#document_type"><i class="fa fa-folder-open"></i> <span>Document Type</span></a>
                        </li>
                        <li <?php if($this->Menu=='service type') echo 'class="active"'; ?> >
                            <a href="#service_type"><i class="fa fa-fire"></i> <span>Service Type</span></a>
                        </li>
                        <li <?php if($this->Menu=='cancel type') echo 'class="active"'; ?> >
                            <a href="#cancel_type"><i class="fa fa-ban"></i> <span>Cancel Type</span></a>
                        </li>
                    </ul>
                </li>
                <li class="treeview <?php if(array_key_exists($this->Menu, $user_items)) echo 'active'; ?>">
                    <a href="#">
                        <i class="fa fa-shield"></i> <span>Security</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu <?php if(array_key_exists($this->Menu, $user_items)) echo 'menu-open'; ?>" <?php if(array_key_exists($this->Menu, $user_items)) echo 'style="display: block;"'; ?> >
                        <li>
                            <a href="#user_group"><i class="fa fa-share-alt"></i> <span>User Group</span></a>
                        </li>
                        <li <?php if($this->Menu=='user group') echo 'class="active"'; ?> >
                            <a href="#user_role"><i class="fa fa-gears"></i> <span>User Role</span></a>
                        </li>
                        <li <?php if($this->Menu=='user') echo 'class="active"'; ?> >
                            <a href="#user"><i class="fa fa-user-plus"></i> <span>User</span></a>
                        </li>
                    </ul>
                </li>
                <li class="treeview <?php if(array_key_exists($this->Menu, $operating_items)) echo 'active'; ?>">
                    <a href="#">
                        <i class="fa fa-spinner"></i> <span>Operating</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu <?php if(array_key_exists($this->Menu, $operating_items)) echo 'menu-open'; ?>" <?php if(array_key_exists($this->Menu, $operating_items)) echo 'style="display: block;"'; ?> >
                        <li <?php if($this->Menu=='agency') echo 'class="active"'; ?> >
                            <a href="#agency"><i class="fa fa-industry"></i> <span>Agency</span></a>
                        </li>
                        <li <?php if($this->Menu=='recruiter') echo 'class="active"'; ?> >
                            <a href="#recruiter"><i class="fa fa-user"></i> <span>Recruiter</span></a>
                        </li>
                        <li <?php if($this->Menu=='register') echo 'class="active"'; ?> >
                            <a href="#register/manage_register/3"><i class="fa fa-keyboard-o"></i> <span>Registration (Thai)</span></a>
                        </li>
                        <li <?php if($this->Menu=='register') echo 'class="active"'; ?> >
                            <a href="#register/manage_register/4"><i class="fa fa-keyboard-o"></i> <span>Registration (Malaysia)</span></a>
                        </li>
                        <li <?php if($this->Menu=='arrival_departure') echo 'class="active"'; ?> >
                            <a href="#arrival_departure"><i class="fa fa-send-o"></i> <span>Arrival Departure</span></a>
                        </li>
                    </ul>
                </li>
                <li class="treeview <?php if(array_key_exists($this->Menu, $accounting_items)) echo 'active'; ?>">
                    <a href="#">
                        <i class="fa fa-money"></i> <span>Accounting</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu <?php if(array_key_exists($this->Menu, $accounting_items)) echo 'menu-open'; ?>" <?php if(array_key_exists($this->Menu, $accounting_items)) echo 'style="display: block;"'; ?> >
                        <!-- Accounting -->
                        <li <?php if($this->Menu=='chart of account') echo 'class="active"'; ?> >
                            <a href="#"><i class="fa fa-user-plus"></i> <span>Chart of Account</span></a>
                        </li>
                        <li <?php if($this->Menu=='general journal') echo 'class="active"'; ?> >
                            <a href="#"><i class="fa fa-user-plus"></i> <span>General Journal</span></a>
                        </li>
                        <li <?php if($this->Menu=='general journal') echo 'class="active"'; ?> >
                            <a href="#"><i class="fa fa-user-plus"></i> <span>General Ledger</span></a>
                        </li>
                        <li <?php if($this->Menu=='bill') echo 'class="active"'; ?> >
                            <a href="#"><i class="fa fa-user-plus"></i> <span>Bill</span></a>
                        </li>
                        <li <?php if($this->Menu=='pay bill') echo 'class="active"'; ?> >
                            <a href="#"><i class="fa fa-user-plus"></i> <span>Bill Payment</span></a>
                        </li>
                        <li <?php if($this->Menu=='invoice') echo 'class="active"'; ?> >
                            <a href="#"><i class="fa fa-user-plus"></i> <span>Invoice</span></a>
                        </li>
                        <li <?php if($this->Menu=='receipt') echo 'class="active"'; ?> >
                            <a href="#"><i class="fa fa-user-plus"></i> <span>Invoice Payment</span></a>
                        </li>
                    </ul>
                </li>
                <li class="treeview <?php if(array_key_exists($this->Menu, $payroll_items)) echo 'active'; ?>">
                    <a href="#">
                        <i class="fa fa-file-powerpoint-o"></i> <span>Employee & Payroll</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu <?php if(array_key_exists($this->Menu, $payroll_items)) echo 'menu-open'; ?>" <?php if(array_key_exists($this->Menu, $payroll_items)) echo 'style="display: block;"'; ?> >
                        <!-- Employee and payroll-->
                        <li <?php if($this->Menu=='timetable') echo 'class="active"'; ?> >
                            <a href="#"><i class="fa fa-user-plus"></i> <span>Timetable</span></a>
                        </li>
                        <li <?php if($this->Menu=='holiday') echo 'class="active"'; ?> >
                            <a href="#"><i class="fa fa-user-plus"></i> <span>Holiday List</span></a>
                        </li>
                        <li <?php if($this->Menu=='permission type') echo 'class="active"'; ?> >
                            <a href="#"><i class="fa fa-user-plus"></i> <span>Permission Type</span></a>
                        </li>
                        <li <?php if($this->Menu=='employee') echo 'class="active"'; ?> >
                            <a href="#"><i class="fa fa-user-plus"></i> <span>Employee</span></a>
                        </li>
                        <li <?php if($this->Menu=='employee schedule') echo 'class="active"'; ?> >
                            <a href="#"><i class="fa fa-user-plus"></i> <span>Employee Schedule</span></a>
                        </li>
                        <li <?php if($this->Menu=='attendance') echo 'class="active"'; ?> >
                            <a href="#"><i class="fa fa-user-plus"></i> <span>Attendance & Permission</span></a>
                        </li>
                        <li <?php if($this->Menu=='monthly payroll') echo 'class="active"'; ?> >
                            <a href="#"><i class="fa fa-user-plus"></i> <span>Monthly Payroll</span></a>
                        </li>
                    </ul>
                </li>
                <li class="treeview <?php if(array_key_exists($this->Menu, $reporting_items)) echo 'active'; ?>">
                    <a href="#">
                        <i class="fa fa-file-text-o"></i> <span>Reporting</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu <?php if(array_key_exists($this->Menu, $reporting_items)) echo 'menu-open'; ?>" <?php if(array_key_exists($this->Menu, $reporting_items)) echo 'style="display: block;"'; ?> >
                        <li <?php if($this->Menu=='operating reports') echo 'class="active"'; ?> >
                            <a href="#operating_reports"> <i class="fa fa-file-image-o"></i> Operating reports</a>
                        </li>
                        <li <?php if($this->Menu=='accounting reports') echo 'class="active"'; ?> >
                            <a href="#"> <i class="fa fa-file-text"></i> Accounting Reports </a>
                        </li>
                        <li <?php if($this->Menu=='payroll reports') echo 'class="active"'; ?> >
                            <a href="#"> <i class="fa fa-file-powerpoint-o"></i> Payroll Reports</a>
                        </li>
                    </ul>
                </li>

            </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" id = "display-content">

    <!-- content view go here  -->

    <?php //if( isset($view) && $view!='') $this->load->view($view); ?>

    <!-- end content view -->

    </div><!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
            BIS Management System
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2016 <a href="#">BIS Solution</a>.</strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <!--<li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>-->
            <li class="active">
                <a href="#control-sidebar-settings-tab" data-toggle="tab" class="align-left">
                    <i class="fa fa-gear"></i> Skin Color Setting
                </a>
            </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <!-- Home tab content -->
            <!--<div class="tab-pane active" id="control-sidebar-home-tab">-->
            <!--<h3 class="control-sidebar-heading">Recent Activity</h3>-->
            <!--<ul class="control-sidebar-menu">-->
            <!--<li>-->
            <!--<a href="javascript::;">-->
            <!--<i class="menu-icon fa fa-birthday-cake bg-red"></i>-->
            <!--<div class="menu-info">-->
            <!--<h4 class="control-sidebar-subheading">Langdon's Birthday</h4>-->
            <!--<p>Will be 23 on April 24th</p>-->
            <!--</div>-->
            <!--</a>-->
            <!--</li>-->
            <!--</ul>&lt;!&ndash; /.control-sidebar-menu &ndash;&gt;-->

            <!--<h3 class="control-sidebar-heading">Tasks Progress</h3>-->
            <!--<ul class="control-sidebar-menu">-->
            <!--<li>-->
            <!--<a href="javascript::;">-->
            <!--<h4 class="control-sidebar-subheading">-->
            <!--Custom Template Design-->
            <!--<span class="label label-danger pull-right">70%</span>-->
            <!--</h4>-->
            <!--<div class="progress progress-xxs">-->
            <!--<div class="progress-bar progress-bar-danger" style="width: 70%"></div>-->
            <!--</div>-->
            <!--</a>-->
            <!--</li>-->
            <!--</ul>&lt;!&ndash; /.control-sidebar-menu &ndash;&gt;-->

            <!--</div>&lt;!&ndash; /.tab-pane &ndash;&gt;-->
            <!-- Stats tab content -->
            <!--<div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>&lt;!&ndash; /.tab-pane &ndash;&gt;-->
            <!-- Settings tab content -->
            <div class="tab-pane active" id="control-sidebar-settings-tab">
                <h3 class="control-sidebar-heading">Choose a color you want</h3>
                <div >
                    <a onclick="change_skin('skin-black')" class="btn btn-flat bg-white">&nbsp;</a>
                    <a onclick="change_skin('skin-red')" class="btn btn-flat bg-danger">&nbsp;</a>
                    <a onclick="change_skin('skin-yellow')" class="btn btn-flat bg-warning">&nbsp;</a>
                    <a onclick="change_skin('skin-green')" class="btn btn-flat bg-success">&nbsp;</a>
                    <a onclick="change_skin('skin-blue')" class="btn btn-flat bg-info">&nbsp;</a>
                    <a onclick="change_skin('skin-purple')" class="btn btn-flat bg-purple">&nbsp;</a>
                </div>
            </div><!-- /.tab-pane -->
        </div>
    </aside><!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
    immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div><!-- ./wrapper -->

<!--Dialog message-->
<!--<div class="modal modal-success fade in" id="dialog-user-type">-->
<div class="modal fade in" id="dialog-message">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Message title</h4>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 no-margin">
                    <button type="button" class="btn btn-outline" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--Dialog message-->
<!--<div class="modal modal-success fade in" id="dialog-user-type">-->
<div class="modal modal-primary fade in" id="dialog-confirm">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Confirm Message!</h4>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 no-margin">
                    <button type="button" class="btn btn-outline" id="btn-ok"><i class="fa fa-check"></i> Yes</button>
                    <button type="button" class="btn btn-outline" data-dismiss="modal"><i class="fa fa-close"></i> No</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.1.4 -->
<script src="<?php echo base_url();?>template/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="<?php echo base_url();?>template/bootstrap/js/bootstrap.min.js"></script>

<!-- DataTables -->
<script src="<?php echo base_url();?>template/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>template/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url();?>template/plugins/datatables/responsive.bootstrap.min.js"></script>
<script src="<?php echo base_url();?>template/plugins/datatables/dataTables.responsive.min.js"></script>


<!-- Select2 -->
<script src="<?php echo base_url();?>template/plugins/select2/select2.full.min.js"></script>
<!-- InputMask -->
<script src="<?php echo base_url();?>template/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url();?>template/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url();?>template/plugins/input-mask/jquery.inputmask.extensions.js"></script>

<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="<?php echo base_url();?>template/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="<?php echo base_url();?>template/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="<?php echo base_url();?>template/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- bootstrap date picker -->
<script src="<?php echo base_url();?>template/plugins/datepicker/bootstrap-datepicker.js"></script>

<!-- SlimScroll -->
<script src="<?php echo base_url();?>template/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="<?php echo base_url();?>template/plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url();?>template/plugins/fastclick/fastclick.min.js"></script>

<!-- Toastr message -->
<!-- Dream alert -->
<!--<script src="--><?php //echo base_url();?><!--template/plugins/dreamalert/jquery.dreamalert.js" type="text/javascript"></script>-->
<script src="<?php echo base_url();?>template/plugins/toastr/toastr.js"></script>

<!-- AdminLTE App -->
<script src="<?php echo base_url();?>template/dist/js/app.min.js"></script>

<!-- Pagination -->
<script src="<?php echo base_url();?>template/plugins/pagination/jquery.bootpag.min.js"></script>

<script type="text/javascript">

    function change_skin(skin)
    {
        $("body").removeClass (function (index, css) {
            return (css.match (/(^|\s)skin-\S+/g) || []).join(' ');
        });
        $("body").addClass(skin);
    }

    function go_to_login()
    {
        window.location = '<?php echo base_url();?>login';
    }

    function on_hash_change()
    {
        var $hash = location.hash.toString();

        if(typeof $hash === typeof undefined || $hash==='' || $hash==='#') $hash = '#home';

        var $a = $('a[href="'+$hash+'"]:first');

        //for menu selection
        if($a.parent().parent().hasClass('sidebar-menu') || $a.parent().parent().hasClass('treeview-menu'))
        {
            $("ul.sidebar-menu li").removeClass('active');
            $a.parent().addClass('active');
            if($a.parent().parent().hasClass('treeview-menu')) {
                $a.parent().parent().parent().addClass('active');
            }
        }

        var $root = '<?php echo base_url()?>';
        var $roots = [
            $root,
            $root + '<?php echo SELF;?>',
            $root + '<?php echo SELF;?>/',
            $root + '<?php echo SELF;?>/home',
            $root + '<?php echo SELF;?>/home/',
            $root + '<?php echo SELF;?>/home<?php echo $this->config->item('url_suffix');?>',
            $root + '<?php echo SELF;?>/home<?php echo $this->config->item('url_suffix');?>/',
            $root + 'home',
            $root + 'home/',
            $root + 'home<?php echo $this->config->item('url_suffix');?>',
            $root + 'home<?php echo $this->config->item('url_suffix');?>/',
        ];

        var $url = $root + $hash.replace('#','');
        var $current_url = window.location.toString();
        $current_url = $current_url.replace($hash,'');
        if($roots.indexOf($current_url)< 0 ) $url = $root+'home/show_404';

        var $data = $a.attr('data-json');
        if (typeof $data === typeof undefined || $data === false)
        {
            $data = true;
        }

        // Send the data using post
        //$(selector).post(URL,data,function(data,status,xhr),dataType)
        var posting = $.post(
            $url,
            {ajax : $data },
            function( data, status, xhr )
            {
                if(data==521)
                {
                    go_to_login();
                }
                else
                {
                    $("#display-content").empty().append(data);
                }
            }
        );
    }

    $(document).ready(function()
    {
        on_hash_change();

        window.onhashchange = function(event)
        {
            event.preventDefault();

            on_hash_change();
        };

        //ajax button
        $(document).off('click','.btn-refresh');
        $(document).on('click','.btn-refresh',function(event)
        {
            event.preventDefault();

            on_hash_change();
        });
    });


</script>

<script type="text/javascript">

    $(document).ready(function()
    {
        function setModalMaxHeight(element) {
            this.$element     = $(element);
            this.$content     = this.$element.find('.modal-content');
            var borderWidth   = this.$content.outerHeight() - this.$content.innerHeight();
            var dialogMargin  = $(window).width() < 768 ? 20 : 60;
            var contentHeight = $(window).height() - (dialogMargin + borderWidth);
            var headerHeight  = this.$element.find('.modal-header').outerHeight() || 0;
            var footerHeight  = this.$element.find('.modal-footer').outerHeight() || 0;
            var maxHeight     = contentHeight - (headerHeight + footerHeight);

            this.$content.css({
                'overflow': 'hidden'
            });

            this.$element
                .find('.modal-body').css({
                    'max-height': maxHeight,
                    'overflow-y': 'auto'
                });
        }

        $(document).off('show.bs.modal', '.modal');
        $(document).on('show.bs.modal', '.modal', function() {
            $(this).show();
            setModalMaxHeight(this);
        });

        $(window).resize(function() {
            if ($('.modal.in').length != 0) {
                setModalMaxHeight($('.modal.in'));
            }
        });

    });

</script>

<script type="text/javascript">

    function show_message(message, display)
    {
        var sms = JSON.parse(message);
        var type = sms.type;
        var types = { Error: "error", Success:"success", Warning:"warning", Info:"info" };
        if(typeof type === typeof undefined || !(type in types)) type = 'Success';

        var title = sms.title;
        if(typeof title === typeof undefined) title = type;

        toastr.clear();

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-bottom-full-width",
            //"positionClass": "toast-bottom-right",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "3000",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        Command: toastr[types[type]]("<h4>" + title + "</h4><div>" + sms.text + "</div>");


//        $.post(
//            '<?php //echo base_url()?>//user/show_message',
//            { message: message },
//            function(data, status, xhr){
//                //$("#message").empty().append(data);
//
//                display.empty().append(data);
//                display.fadeIn();
//                setTimeout(function(){
//                    display.fadeOut();
//                }, 4000);
//            }
//        );
    }

    function show_dialog_message(message, type)
    {
        var types = { Error: "modal-warning", Success:"modal-primary" };
        if(typeof type === typeof undefined || !(type in types)) type = 'Success';

        $("#dialog-message").removeClass('modal-warning');
        $("#dialog-message").removeClass('modal-primary');
        $("#dialog-message").addClass(types[type]);

        $("#dialog-message .modal-title").empty().append(type);
        $("#dialog-message .modal-body").empty().append(message);

        $("#dialog-message").modal({
            backdrop: "static" // true | false | "static" => default is true
        });

        ////clear form and refresh main page when close dialog
        //$(document).off('hidden.bs.modal', '#dialog-message');
        //$(document).on('hidden.bs.modal', '#dialog-message', function() {
        //    $("#dialog-message").removeClass('modal-warning');
        //    $("#dialog-message").removeClass('modal-primary');
        //});
    }

    function confirm_message(message)
    {
        $("#dialog-confirm .modal-body").empty().append(message);

        $("#dialog-confirm").modal({
            backdrop: "static" // true | false | "static" => default is true
        });

        //$(document).off("click", "#dialog-confirm #btn-ok");
        //$(document).on("click", "#dialog-confirm #btn-ok", function(event){
        //    event.preventDefault();
        //    $("#dialog-confirm").modal("hide");
        //});
    }

</script>


<!-- Optionally, you can add Slimscroll and FastClick plugins.
 Both of these plugins are recommended to enhance the
 user experience. Slimscroll is required when using the
 fixed layout. -->

<div id="display-script"></div>
<?php

if(isset($script_view) && $script_view!='' ) $this->load->view($script_view);

?>


</body>
</html>