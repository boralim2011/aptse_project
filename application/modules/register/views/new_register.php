<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo isset($title)? $title:'New Register'; ?>
        <!--<small>Optional description</small>-->
    </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-home"></i> home</a></li>
    <li><a href="#register"><i class="fa fa-keyboard-o"></i> Manage Register</a></li>
    <li class="active"><?php echo isset($title)? $title:'New Register'; ?></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">

    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#personal-data">Personal Data</a></li>
        <li><a data-toggle="tab" href="#family-info">Family Info</a></li>
        <li><a data-toggle="tab" href="#registration">Registration</a></li>
        <li><a data-toggle="tab" href="#worker-cancel">Worker Cancel</a></li>
    </ul>

    <form id="contact-form" role="form" action="<?php echo $url;?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">

        <div class="tab-content box no-border">

            <div id="personal-data" class="tab-pane fade in active ">
                <div class="box-header with-border bg-title">
                    <h3 class="box-title">Personal Info :</h3>
                        <div class="box-tools pull-right">
                            <!--<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>-->
                            <!--<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>-->
                        </div>
                 </div>
                <div class="box-body">
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <input type="hidden" id="photo" name="photo" value="<?php echo $contact->photo;?>" />
                            <img src="<?php echo $contact->photo_path;?>" align="left" style="width: 100px; height: 100px; margin: 0 15px 5px 0;"/>
                            <div style="display: inline-block;">
                                <label for="file">Select Photo</label>
                                <input type="file" id="file">
                                <p class="help-block">Image file only! </p>
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label><span class="text-red">*</span> Register Name</label>
                            <input type="text" class="form-control" id="contact_name" name="contact_name" placeholder="Enter register name" value="<?php echo $contact->contact_name; ?>">
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label><span class="text-red">*</span> Register Name(Khmer)</label>
                            <input type="text" class="form-control" id="contact_name_kh" name="contact_name_kh" placeholder="Enter register name" value="<?php echo $contact->contact_name_kh; ?>">
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Register Code</label>
                            <input type="text" class="form-control" id="contact_code" name="contact_code" placeholder="Enter register code" value="<?php echo $contact->contact_code; ?>"  readonly="readonly">
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label><span class="text-red">*</span> First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter register name" value="<?php echo $contact->first_name; ?>">
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label><span class="text-red">*</span> First Name (Khmer)</label>
                            <input type="text" class="form-control" id="first_name_kh" name="first_name_kh" placeholder="Enter register name" value="<?php echo $contact->first_name_kh; ?>">
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label><span class="text-red">*</span> Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter register name" value="<?php echo $contact->last_name; ?>">
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label><span class="text-red">*</span> Last Name (Khmer)</label>
                            <input type="text" class="form-control" id="last_name_kh" name="last_name_kh" placeholder="Enter register name" value="<?php echo $contact->last_name_kh; ?>">
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Nickname</label>
                            <input type="text" class="form-control" id="nick_name" name="nick_name" placeholder="Enter register name" value="<?php echo $contact->nick_name; ?>">
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label><span class="text-red">*</span> Date of birth</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control datepicker" name="date_of_birth" id="date_of_birth" value="<?php echo $contact->date_of_birth;?>">
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label><span class="text-red">*</span> Gender</label>
                            <div style="height: 34px;">
                                <label style="margin-right: 30px;"><input type="radio" class="minimal form-control" id="male" name="gender" value="M" <?php if($contact->gender=='M') echo 'checked="checked"';?>  > Male</label>
                                <label style="margin-right: 30px;"><input type="radio" class="minimal form-control" id="female" name="gender" value="F" <?php if($contact->gender=='F') echo 'checked="checked"';?>  > Female</label>
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-8 col-lg-8">
                            <label><span class="text-red">*</span> Marital Status</label>
                            <div style="height: 34px;">
                                <label style="margin-right: 30px;"><input type="radio" class="minimal form-control" id="single" name="marital_status" value="Single" <?php if($contact->marital_status=='Single') echo 'checked="checked"';?>  > Single</label>
                                <label style="margin-right: 30px;"><input type="radio" class="minimal form-control" id="married" name="marital_status" value="Married" <?php if($contact->marital_status=='Married') echo 'checked="checked"';?>  > Married</label>
                                <label style="margin-right: 30px;"><input type="radio" class="minimal form-control" id="widow" name="marital_status" value="Widow" <?php if($contact->marital_status=='Widow') echo 'checked="checked"';?>  > Widow</label>
                                <label style="margin-right: 30px;"><input type="radio" class="minimal form-control" id="separated" name="marital_status" value="Separated" <?php if($contact->marital_status=='Separated') echo 'checked="checked"';?>  > Separated</label>
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label><span class="text-red">*</span> Nationality</label>
                            <div class="input-group">
                                <select class="select2" id="nationality_id" name="nationality_id" data-placeholder="--Select--" style="width: 100%;">
                                    <option value="1">Khmer</option>
                                    <?php if($contact->nationality_id!=0){?>
                                    <option value="<?php echo $contact->nationality_id; ?>" selected="selected"><?php echo $register->nationality_name;?></option>
                                    <?php }?>
                                </select>
                                <a href="#" class="input-group-addon btn btn-primary" id="btn-new-nationality" data-toggle="tooltip" title="New Nationality">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label><span class="text-red">*</span> Phone Number</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Phone number" value="<?php echo $contact->phone_number; ?>">
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Phone Number 2</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <input type="text" class="form-control" id="phone_number_2" name="phone_number_2" placeholder="Phone number" value="<?php echo $contact->phone_number_2; ?>">
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Height</label>
                            <input type="text" class="form-control" id="height" name="height" placeholder="000 cm" value="<?php echo $contact->height; ?>">
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Weight</label>
                            <input type="text" class="form-control" id="weight" name="weight" placeholder="0.00 Kg" value="<?php echo $contact->weight; ?>">
                        </div>

                        <input type="hidden" id="contact_id" name="contact_id" value="<?php echo isset($contact->contact_id)? $contact->contact_id:0;?>"/>
                        <input type="hidden" id="contact_type" name="contact_type" value="<?php echo isset($contact->contact_type)? $contact->contact_type:'';?>"/>
                        <input type="hidden" id="created_date" name="created_date" value="<?php echo isset($contact->created_date)? $contact->created_date:0;?>" />
                        <input type="hidden" id="is_deletable" name="is_deletable" value="<?php echo isset($contact->is_deletable)? $contact->is_deletable:0;?>" />

                    </div>
                </div>

                <?php echo $this->load->view('contact_address', array('contact_title'=>'Place of Birth', 'index'=>1, 'var_name'=>'place_of_birth'));?>
                <?php echo $this->load->view('contact_address', array('contact_title'=>'Contact Address', 'index'=>'', 'var_name'=>'address'));?>

            </div>

            <div id="family-info" class="tab-pane fade">
                <div class="box-header with-border bg-title">
                    <h3 class="box-title">Family Info :</h3>
                    <div class="box-tools pull-right">
                        <!--<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>-->
                        <!--<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>-->
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Father Name</label>
                            <input type="text" class="form-control" id="father_name" name="father_name" placeholder="Enter father's name" value="<?php echo $contact->father_name; ?>">
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Father Name (Khmer)</label>
                            <input type="text" class="form-control" id="father_name_kh" name="father_name_kh" placeholder="Enter father's name" value="<?php echo $contact->father_name_kh; ?>">
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Father's Job</label>
                            <input type="text" class="form-control" id="father_job" name="father_job" placeholder="Enter father's job" value="<?php echo $contact->father_job; ?>">
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Mother Name</label>
                            <input type="text" class="form-control" id="mother_name" name="mother_name" placeholder="Enter mother's name" value="<?php echo $contact->mother_name; ?>">
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Mother Name (Khmer)</label>
                            <input type="text" class="form-control" id="mother_name_kh" name="mother_name_kh" placeholder="Enter mother's name" value="<?php echo $contact->mother_name_kh; ?>">
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Mother's Job</label>
                            <input type="text" class="form-control" id="mother_job" name="mother_job" placeholder="Enter mother's job" value="<?php echo $contact->mother_job; ?>">
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Spouse's Name</label>
                            <input type="text" class="form-control" id="spouse_name" name="spouse_name" placeholder="Enter spouse's name" value="<?php echo $contact->spouse_name; ?>">
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Spouse's Name (Khmer)</label>
                            <input type="text" class="form-control" id="spouse_name_kh" name="spouse_name_kh" placeholder="Enter spouse's name" value="<?php echo $contact->spouse_name_kh; ?>">
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Spouse's Job</label>
                            <input type="text" class="form-control" id="spouse_job" name="spouse_job" placeholder="Enter spouse's job" value="<?php echo $contact->spouse_job; ?>">
                        </div>

                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Father's Age</label>
                            <input type="text" class="form-control" id="father_age" name="father_age" placeholder="" value="<?php echo $contact->father_age; ?>">
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Mother's Age</label>
                            <input type="text" class="form-control" id="mother_age" name="mother_age" placeholder="0" value="<?php echo $contact->mother_age; ?>">
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Spouse's Age</label>
                            <input type="text" class="form-control" id="spouse_age" name="spouse_age" placeholder="0" value="<?php echo $contact->spouse_age; ?>">
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Family Phone</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <input type="text" class="form-control" id="family_phone" name="family_phone" placeholder="Enter phone number" value="<?php echo $contact->family_phone; ?>">
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Family Phone 2</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <input type="text" class="form-control" id="family_phone_2" name="family_phone_2" placeholder="Enter phone number" value="<?php echo $contact->family_phone_2; ?>">
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Number of Brother</label>
                            <input type="text" class="form-control" id="number_of_brother" name="number_of_brother" placeholder="0" value="<?php echo $contact->number_of_brother; ?>">
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Number of Sister</label>
                            <input type="text" class="form-control" id="number_of_sister" name="number_of_sister" placeholder="0" value="<?php echo $contact->number_of_sister; ?>">
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Sibling order</label>
                            <input type="text" class="form-control" id="sibling_order" name="sibling_order" placeholder="0" value="<?php echo $contact->sibling_order; ?>">
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Number of Children</label>
                            <input type="text" class="form-control" id="number_of_children" name="number_of_children" placeholder="0" value="<?php echo $contact->number_of_children; ?>">
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Oldest Age</label>
                            <input type="text" class="form-control" id="oldest_age" name="oldest_age" placeholder="0" value="<?php echo $contact->oldest_age; ?>">
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Youngest Age</label>
                            <input type="text" class="form-control" id="youngest_age" name="youngest_age" placeholder="0" value="<?php echo $contact->youngest_age; ?>">
                        </div>


                    </div>
                </div>

                <?php echo $this->load->view('contact_address', array('contact_title'=>'Parent\'s Address', 'index'=>'2', 'var_name'=>'parent_address'));?>

            </div>
            <div id="registration" class="tab-pane fade">

                <div class="box-header with-border bg-title">
                    <h3 class="box-title">Register Info :</h3>
                    <div class="box-tools pull-right">
                        <!--<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>-->
                        <!--<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>-->
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label><span class="text-red">*</span> Company's Name</label>
                            <select class="select2" id="company_id" name="company_id" data-placeholder="--Select--" style="width: 100%;">
                                <option></option>
                                <?php if($register->company_id!=0){?>
                                <option value="<?php echo $register->company_id; ?>" selected="selected"><?php echo $register->company_name;?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label><span class="text-red">*</span> Service Type</label>
                            <div class="input-group">
                                <select class="select2" id="service_type_id" name="service_type_id" data-placeholder="--Select--" style="width: 100%;">
                                    <option></option>
                                    <?php if($register->service_type_id!=0){?>
                                    <option value="<?php echo $register->service_type_id; ?>" selected="selected"><?php echo $register->service_type_name;?></option>
                                    <?php }?>
                                </select>
                                <a href="#" class="input-group-addon btn btn-primary" id="btn-new-service-type" data-toggle="tooltip" title="New Service Type">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Worker Code</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="worker_code" name="worker_code" placeholder="Enter worker code" value="<?php echo $register->worker_code; ?>"  data-toggle="tooltip" title="Click button generate or just keep it blank!">
                                <a class="input-group-addon" data-toggle="tooltip" title="Generate Worker Code" href="#" id="btn-generate-code">
                                    <i class="	fa fa-bolt"></i>
                                </a>
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label><span class="text-red">*</span> Recruiter</label>
                            <select class="select2" id="recruiter_id" name="recruiter_id" data-placeholder="--Select--" style="width: 100%;">
                                <option></option>
                                <?php if($register->recruiter_id!=0){?>
                                <option value="<?php echo $register->recruiter_id; ?>" selected="selected"><?php echo $register->recruiter_name;?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label><span class="text-red">*</span> Country Name</label>
                            <div class="input-group">
                                <select class="select2" id="to_country_id" name="to_country_id" data-placeholder="--Select--" style="width: 100%;" <?php //echo isset($register->to_country_id) && $register->to_country_id!=0? 'disabled="disabled"':''; ?> >
                                    <option></option>
                                    <?php if($register->to_country_id!=0){?>
                                        <option value="<?php echo $register->to_country_id; ?>" selected="selected"><?php echo $register->to_country_name;?></option>
                                    <?php }?>
                                </select>
                                <a href="#" class="input-group-addon btn btn-primary btn-new-country" data-toggle="tooltip" title="New Country">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label><span class="text-red">*</span> Register Date</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control datepicker" name="register_date" id="register_date" value="<?php echo $register->register_date;?>">
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label><span class="text-red">*</span> Register Type</label>
                            <div class="input-group">
                                <select class="select2" id="worker_type_id" name="worker_type_id" data-placeholder="--Select--" style="width: 100%;">
                                    <option></option>
                                    <?php if($register->worker_type_id!=0){?>
                                    <option value="<?php echo $register->worker_type_id; ?>" selected="selected"><?php echo $register->register_type_name;?></option>
                                    <?php }?>
                                </select>
                                <a href="#" class="input-group-addon btn btn-primary" id="btn-new-register-type" data-toggle="tooltip" title="New Worker Type">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div>

                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label><span class="text-red">*</span> Border Crossing</label>
                            <div class="input-group">
                                <select class="select2" id="border_crossing_id" name="border_crossing_id" data-placeholder="--Select--" style="width: 100%;">
                                    <option value="1"> None </option>
                                    <?php if($register->border_crossing_id!=1){?>
                                        <option value="<?php echo $register->border_crossing_id; ?>" selected="selected"><?php echo $register->border_crossing_name;?></option>
                                    <?php }?>
                                </select>
                                <a href="#" class="input-group-addon btn btn-primary" id="btn-new-border-crossing" data-toggle="tooltip" title="New Worker Type">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="box-header with-border">
                    <h3 class="box-title">Documentation :</h3>
                    <div class="box-tools pull-right">
                        <!--<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>-->
                        <!--<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>-->
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>ID Card No</label>
                            <input type="text" class="form-control" id="id_card_no" name="id_card_no" placeholder="Enter ID Card No" value="<?php echo $register->id_card_no; ?>">
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>ID Card Issue Date</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control datepicker" name="id_card_issue_date" id="id_card_issue_date" value="<?php echo $register->id_card_issue_date;?>">
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>ID Card Expired Date</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control datepicker" name="id_card_expired_date" id="id_card_expired_date" value="<?php echo $register->id_card_expired_date;?>">
                            </div>
                        </div>

                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Agency</label>
                            <select class="select2" id="agency_id" name="agency_id" data-placeholder="--Select--" style="width: 100%;">
                                <option></option>
                                <?php if($register->agency_id!=0){?>
                                <option value="<?php echo $register->agency_id; ?>" selected="selected"><?php echo $register->agency_name;?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Date of send document</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control datepicker" name="date_of_send_document" id="date_of_send_document" value="<?php echo $register->date_of_send_document;?>">
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label for="document_type_id">Documents</label>
                            <div class="input-group">
                                <select class="select2" id="document_type_id" name="document_type_id" data-placeholder="--Select--" style="width: 100%;">
                                    <option></option>
                                    <?php if($register->document_type_id!=0){?>
                                    <option value="<?php echo $register->document_type_id; ?>" selected="selected"><?php echo $register->document_type_name;?></option>
                                    <?php }?>
                                </select>
                                <a href="#" class="input-group-addon btn btn-primary" id="btn-new-document-type" data-toggle="tooltip" title="New Document Type">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div>

                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Passport Photo</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control datepicker" name="passport_photo_date" id="passport_photo_date" value="<?php echo $register->passport_photo_date;?>">
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Work Permit Date</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control datepicker" name="work_permit_date" id="work_permit_date" value="<?php echo $register->work_permit_date;?>">
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Name List Date</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control datepicker" name="name_list_date" id="name_list_date" value="<?php echo $register->name_list_date;?>">
                            </div>
                        </div>

                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Date of Send BIO SD</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control datepicker" name="date_of_send_bio_scan" id="date_of_send_bio_scan" value="<?php echo $register->date_of_send_bio_scan;?>">
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Date of MCUp SD</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control datepicker" name="date_of_send_medical_checkup_sd" id="date_of_send_medical_checkup_sd" value="<?php echo $register->date_of_send_medical_checkup_sd;?>">
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Date of PPC SD</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control datepicker" name="date_of_send_ppc_sd" id="date_of_send_ppc_sd" value="<?php echo $register->date_of_send_ppc_sd;?>">
                            </div>
                        </div>

                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Date of Receive Passport</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control datepicker" name="date_of_receive_passport" id="date_of_receive_passport" value="<?php echo $register->date_of_receive_passport;?>">
                            </div>
                        </div>

                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Passport No</label>
                            <input type="text" class="form-control" id="passport_no" name="passport_no" placeholder="Enter Passport Number" value="<?php echo $register->passport_no; ?>">
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Passport Issue Date</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control datepicker" name="passport_issue_date" id="passport_issue_date" value="<?php echo $register->passport_issue_date;?>">
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Passport Expired Date</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control datepicker" name="passport_expired_date" id="passport_expired_date" value="<?php echo $register->passport_expired_date;?>">
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Date of Ministry of Foreign Affair</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control datepicker" name="date_of_mofa" id="date_of_mofa" value="<?php echo $register->date_of_mofa;?>">
                            </div>
                        </div>

                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Date of Visa RD Confirm</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control datepicker" name="date_of_visa_rd_confirm" id="date_of_visa_rd_confirm" value="<?php echo $register->date_of_visa_rd_confirm;?>">
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Date of Receive Visa RD</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control datepicker" name="date_of_visa_rd_receive" id="date_of_visa_rd_receive" value="<?php echo $register->date_of_visa_rd_receive;?>">
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Date of Buy Air Ticket</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control datepicker" name="date_of_buy_air_ticket" id="date_of_buy_air_ticket" value="<?php echo $register->date_of_buy_air_ticket;?>">
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Date of Fly</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control datepicker" name="date_of_fly" id="date_of_fly" value="<?php echo $register->date_of_fly;?>">
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <label>Note</label>
                            <textarea class="form-control" name="note" id="note" rows="5"><?php echo $register->note;?></textarea>
                        </div>

                        <input type="hidden" id="worker_id" name="worker_id" value="<?php echo $register->worker_id;?>" />

                    </div>
                </div>

                <div class="box-header with-border bg-title">
                    <h3 class="box-title">Employer Info :</h3>
                    <div class="box-tools pull-right">
                        <!--<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>-->
                        <!--<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>-->
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Employer's Name</label>
                            <input type="text" class="form-control" id="employer_name" name="employer_name" placeholder="Enter Employer's Name" value="<?php echo $register->employer_name; ?>">
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Employer's Phone</label>
                            <input type="text" class="form-control" id="employer_phone" name="employer_phone" placeholder="Enter Employer's Phone" value="<?php echo $register->employer_phone; ?>">
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Employer's Phone 2</label>
                            <input type="text" class="form-control" id="employer_phone_2" name="employer_phone_2" placeholder="Enter Employer's Phone" value="<?php echo $register->employer_phone_2; ?>">
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Employer's Date</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control datepicker" name="date_of_employer" id="date_of_employer" value="<?php echo $register->date_of_employer;?>">
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Employer's Address</label>
                            <input type="text" class="form-control" id="employer_address" name="employer_address" placeholder="Enter Employer's Address" value="<?php echo $register->employer_address; ?>">
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Employer's Address 2</label>
                            <input type="text" class="form-control" id="employer_address_2" name="employer_address_2" placeholder="Enter Employer's Address" value="<?php echo $register->employer_address_2; ?>">
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Employer's Address 3</label>
                            <input type="text" class="form-control" id="employer_address" name="employer_address_3" placeholder="Enter Employer's Address" value="<?php echo $register->employer_address_3; ?>">
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Employer's Address 4</label>
                            <input type="text" class="form-control" id="employer_address" name="employer_address_4" placeholder="Enter Employer's Address" value="<?php echo $register->employer_address_4; ?>">
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Employer's Address 5</label>
                            <input type="text" class="form-control" id="employer_address" name="employer_address_5" placeholder="Enter Employer's Address" value="<?php echo $register->employer_address_5; ?>">
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Employer's NIRC</label>
                            <input type="text" class="form-control" id="employer_nirc" name="employer_nirc" placeholder="Enter Employer's NIRC" value="<?php echo $register->employer_nirc; ?>">
                        </div>

                    </div>
                </div>

            </div>


            <div id="worker-cancel" class="tab-pane fade">
                <div class="box-header with-border bg-title">
                    <h3 class="box-title">Worker Cancel :</h3>
                    <div class="box-tools pull-right">
                        <!--<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>-->
                        <!--<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>-->
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>&nbsp;</label>
                            <div style="height: 34px;">
                                <label style="margin-right: 30px;"><input type="checkbox" class="minimal form-control" id="female" name="gender" value="1" <?php if($register->is_cancel==1) echo 'checked="checked"';?>  > Is Cancel</label>
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Canceled Date</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control datepicker" name="canceled_date" id="canceled_date" value="<?php echo $register->canceled_date;?>">
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label for="cancel_type_id">Cancel Type</label>
                            <div class="input-group">
                                <select class="select2" id="cancel_type_id" name="cancel_type_id" data-placeholder="--Select--" style="width: 100%;">
                                    <option></option>
                                    <?php if($register->cancel_type_id!=0){?>
                                    <option value="<?php echo $register->cancel_type_id; ?>" selected="selected"><?php echo $register->cancel_type_name;?></option>
                                    <?php }?>
                                </select>
                                <a href="#" class="input-group-addon btn btn-primary" id="btn-new-cancel-type" data-toggle="tooltip" title="New Cancel Type">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <label>Remark</label>
                            <textarea class="form-control" name="canceled_reason" id="canceled_reason" rows="12"><?php echo $register->canceled_reason;?></textarea>
                        </div>

                    </div>
                </div>
            </div>

            <div class="box-footer">
                <button type="button" class="btn btn-primary" name="submit" id="submit"><i class="fa fa-save"></i> Submit </button>
                <a href="#register/manage_register/<?php echo $register->to_country_id;?>" class="btn btn-default"><i class="fa fa-close"></i> Cancel </a>
            </div>

        </div>

    </form>



    <div id = "message" >
        <?php if(isset($message)) $this->show_message($message); ?>
    </div>

</section><!-- /.content -->


<script type="text/javascript">

    $(document).ready(function()
    {
        //Initialize Select2 Elements
        //$(".select2").select2();

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass: 'iradio_minimal-red'
        });
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });

        //date picker
        $(".datepicker").datepicker({
            format: "yyyy-mm-dd"
        });

        //Timepicker
        $(".timepicker").timepicker({
            showInputs: false
        });


        //personal info
        $("#nationality_id").select2({
            ajax: {
                url: "<?php echo base_url()?>nationality/get_combobox_items",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term // search term
                    };
                },
                processResults: function (data) {
                    // parse the results into the format expected by Select2.
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data
                    return {
                        results: data
                    };
                },
                cache: true
            },
            minimumInputLength: 1
        });


        //register
        $("#company_id").select2({
            ajax: {
                url: "<?php echo base_url()?>company/get_combobox_items",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term // search term
                    };
                },
                processResults: function (data) {
                    // parse the results into the format expected by Select2.
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data
                    return {
                        results: data
                    };
                },
                cache: true
            },
            minimumInputLength: 1
        });

        $("#service_type_id").select2({
            ajax: {
                url: "<?php echo base_url()?>service_type/get_combobox_items",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term // search term
                    };
                },
                processResults: function (data) {
                    // parse the results into the format expected by Select2.
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data
                    return {
                        results: data
                    };
                },
                cache: true
            },
            minimumInputLength: 1
        });

        $("#recruiter_id").select2({
            ajax: {
                url: "<?php echo base_url()?>recruiter/get_combobox_items",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term // search term
                    };
                },
                processResults: function (data) {
                    // parse the results into the format expected by Select2.
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data
                    return {
                        results: data
                    };
                },
                cache: true
            },
            minimumInputLength: 1
        });

        $("#agency_id").select2({
            ajax: {
                url: "<?php echo base_url()?>agency/get_combobox_items",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term // search term
                    };
                },
                processResults: function (data) {
                    // parse the results into the format expected by Select2.
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data
                    return {
                        results: data
                    };
                },
                cache: true
            },
            minimumInputLength: 1
        });

        $("#to_country_id").select2({
            ajax: {
                url: "<?php echo base_url()?>location/get_combobox_items",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term, // search term
                        type: '1',
                        parent: 0
                    };
                },
                processResults: function (data) {
                    // parse the results into the format expected by Select2.
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data
                    return {
                        results: data
                    };
                },
                cache: true
            },
            minimumInputLength: 1
        });

        $("#worker_type_id").select2({
            ajax: {
                url: "<?php echo base_url()?>register_type/get_combobox_items",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term // search term
                    };
                },
                processResults: function (data) {
                    // parse the results into the format expected by Select2.
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data
                    return {
                        results: data
                    };
                },
                cache: true
            },
            minimumInputLength: 1
        });

        $("#border_crossing_id").select2({
            ajax: {
                url: "<?php echo base_url()?>border_crossing/get_combobox_items",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term // search term
                    };
                },
                processResults: function (data) {
                    // parse the results into the format expected by Select2.
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data
                    return {
                        results: data
                    };
                },
                cache: true
            },
            minimumInputLength: 1
        });

        $("#document_type_id").select2({
            ajax: {
                url: "<?php echo base_url()?>document_type/get_combobox_items",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term // search term
                    };
                },
                processResults: function (data) {
                    // parse the results into the format expected by Select2.
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data
                    return {
                        results: data
                    };
                },
                cache: true
            },
            minimumInputLength: 1
        });


        //cancel
        $("#cancel_type_id").select2({
            ajax: {
                url: "<?php echo base_url()?>cancel_type/get_combobox_items",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term // search term
                    };
                },
                processResults: function (data) {
                    // parse the results into the format expected by Select2.
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data
                    return {
                        results: data
                    };
                },
                cache: true
            },
            minimumInputLength: 1
        });

    });
</script>


<script type="text/javascript">

    $(document).ready(function() {

        $(document).off('click', "#btn-generate-code");
        $(document).on('click', "#btn-generate-code", function(event){
            event.preventDefault();

            var error = '';
            var company_id =  $("#company_id").val();
            error = company_id? "" : 'Company name is require.<br/>';
            var service_type_id =  $("#service_type_id").val();
            error += service_type_id? "": 'Service type is require.';

            if(error!=''){
                var message = '{"text":"'+error+'","type":"Error","title":"Error"}';
                show_message(message, $("#message"));
                return;
            }

            var form = $("#contact-form");
            var formData = new FormData(form[0]);
            var url = '<?php echo base_url();?>register/generate_code';

            //var formData = new FormData();
            formData.append('submit', 1);
            // Main magic with files here
            //formData.append('file', $('input[type=file]')[0].files[0]);

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                dataType:"json",
                //async: false,
                cache: false,
                beforeSend: function(xhr){
                    //alert('Before send');
                },
                success: function(data, status, xhr)
                {
                    if(data==521){
                        go_to_login();
                    }
                    else
                    {
                        $("#worker_code").val(data.worker_code);
                    }
                },
                error: function(xhr,status,error){
                    var message = '{"text":"'+error+'","type":"Error","title":"Error"}';
                    show_message(message, $("#message"));
                },
                complete: function(xhr,status){
                    //alert(status);
                },
                contentType: false,
                processData: false
            });

            return false;

        });

        $(document).off("click","#submit");
        $(document).on("click","#submit", function( event )
        {
            event.preventDefault();

            $("#contact-form").submit();
        });

        $(document).off("submit", "#contact-form");
        $(document).on("submit","#contact-form", function(event)
        {
            var form = $("#contact-form");
            var formData = new FormData(form[0]);
            var url = form.attr('action').toString();

            //var formData = new FormData();
            formData.append('submit', 1);
            // Main magic with files here
            formData.append('file', $('input[type=file]')[0].files[0]);

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                dataType:"json",
                //async: false,
                cache: false,
                beforeSend: function(xhr){
                    //alert('Before send');
                },
                success: function(data, status, xhr)
                {
                    if(data==521){
                        go_to_login();
                    }
                    else
                    {
                        if(data.success===true){
                            $("#contact_id").val(data.model.contact_id);
                            $("#address_id").val(data.model.address_id);
                            $("#address_id1").val(data.model.address_id1);
                            $("#address_id2").val(data.model.address_id2);
                            $("#worker_id").val(data.model.worker_id);

                        }

                        show_message(data.message, $("#message"));
                    }
                },
                error: function(xhr,status,error){
                    var message = '{"text":"'+error+'","type":"Error","title":"Error"}';
                    show_message(message, $("#message"));
                },
                complete: function(xhr,status){
                    //alert(status);
                },
                contentType: false,
                processData: false
            });

            return false;
        });
    });

</script>

<?php $this->load->view('contact_address_location'); ?>

<?php $this->load->view('nationality/new_nationality'); ?>
<?php $this->load->view('service_type/new_service_type'); ?>
<?php $this->load->view('register_type/new_register_type'); ?>
<?php $this->load->view('document_type/new_document_type'); ?>
<?php $this->load->view('border_crossing/new_border_crossing'); ?>
<?php $this->load->view('cancel_type/new_cancel_type'); ?>

