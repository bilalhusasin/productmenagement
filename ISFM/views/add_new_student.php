<!--BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/jquery_ui_css/jquery-ui.css" />

 <?php $user = $this->ion_auth->user()->row(); $userId = $user->id;?>
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                    <?php echo lang('admi_page_title'); ?> <small></small>
                </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <?php echo lang('home'); ?>
                        
                    </li>
                    <li>
                        <?php echo lang('header_stu_paren'); ?> 
                    </li>
                    <li>
                        <?php echo lang('header_stude'); ?>
                        
                    </li>
                    <li>
                        <?php echo lang('header_admission'); ?>
                    </li>
                    <li id="result" class="pull-right topClock"></li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12 ">
                <!-- BEGIN SAMPLE FORM PORTLET-->
                <div class="portlet box green ">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-bars"></i> <?php echo lang('admi_form_title'); ?>
                        </div>
                        <div class="tools">
                            <a href="" class="collapse">
                            </a>
                            <a href="" class="reload">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <?php $form_attributs = array('class' => 'form-horizontal', 'role' => 'form', 'name' => 'myForm', 'onsubmit' => 'return validateForm()');
                        echo form_open_multipart('users/admission', $form_attributs);
                        ?>
                        <div class="form-body">
                            <?php
                            if (!empty($success)) {
                                echo $success;
                            } 
                            ?>

                        <div id="div1"> 

                        <div > 
                            <h3 style="padding-left: 4%; font-weight: 700;">Instructions</h3>
                            <p style="padding-left: 8%; font-weight: 700;">Following Documents must be attached with the Admission Form</p>  
                            <!-- <p style="padding-left: 12%;"> 1. Attested copy of Birth Certificate or NADRA Registration 'B' Form</p>
                             -->
                            <div class="form-group">
                                <p class="col-md-6 " style="padding-left: 12%;"> </p> 
                                <div class="col-md-3 text-right">
                                     Registration Number<span class="requiredStar"> * </span>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" name="register_number" id="register_number" onkeyup="fetch_reg_stu(this.value)" placeholder="Enter Minimum 8 digit Registration No">
                                    <span id="errordata" class="text-danger" style="margin-top: 10px; font-weight: 800;"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <p class="col-md-6 " style="padding-left: 12%;"><?php echo lang('admi_BirthCertificate'); ?>  1. </p> 
                                <div class="col-md-6">
                                    <input type="file"  name="birth_certificate" data-validation="" data-validation-error-msg="<?php echo lang('admi_BirthCertificate_error'); ?>">
                                </div>
                            </div> 
                            <div class="form-group">
                                <p class="col-md-6" style="padding-left: 12%;"><?php echo lang('admi_SchoolLeavingCertificate'); ?> </p> 
                                <div class="col-md-6">
                                    <input type="file"  name="school_leaving_certificate" data-validation="" data-validation-error-msg="<?php // echo lang('admi_firstName_error_msg'); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <p class="col-md-6" style="padding-left: 12%;"><?php echo lang('admi_progressreport'); ?> </p>
                                <div class="col-md-6">
                                    <input type="file"  name="progress_report" data-validation="" data-validation-error-msg="<?php  echo lang('admi_progressreport_error_msg'); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <p class="col-md-6" style="padding-left: 9%;"><?php echo lang('admi_admissionAccepted'); ?>   N.B. </p>
                                 
                            </div>
                             
                        </div>
                        <hr>
                        <h3 style="padding-left: 4%; font-weight: 700;"><?php echo lang('admi_particuler_heading'); ?> </h3> 
            <div id="reg_hide">            
                    <div class="row">
                        <div class="col-lg-9 " style="padding-left: 8%">   
                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo lang('admi_FirstName'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control a" name="first_name" id="first_name" data-validation="required" data-validation-error-msg="<?php echo lang('admi_firstName_error_msg'); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo lang('admi_LastName'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control b" placeholder="" name="last_name" id="last_name" data-validation="required" data-validation-error-msg="<?php echo lang('admi_LastName_error_msg'); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3"><?php echo lang('admi_DateOfBirth'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-4">
                                    <input class="form-control c" name="birthdate"  id="birthdate" placeholder="yyyy-mm-dd" type="text" data-validation="required" data-validation-error-msg="<?php echo lang('admi_DateOfBirth_error_msg'); ?>">
                                    
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo lang('admi_Sex'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-4 marginLeftSex">
                                    <div class="radio-list">
                                        <label class="radio-inline">
                                            <input type="radio" name="sex" id="gender1" class="g" value="Male" 
                                            <?php // if ($gender == 'Male') {echo 'checked'; } ?> > <?php echo lang('admi_Male'); ?>
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="sex" id="gender2" class="g" value="Female" 
                                            <?php // if ($gender == 'Female') { echo 'checked'; } ?>> <?php echo lang('admi_Female'); ?> 
                                        </label>
                                         
                                    </div>
                                </div>
                            </div>  
                            <div class="form-group">
                                <label class="col-md-3 control-label"> <?php echo lang('admi_placebirth'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control d" name="place_birth" placeholder="" data-validation="required" data-validation-error-msg="<?php  echo lang('admi_place_birth_error_msg'); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">  <?php echo lang('admi_nationality'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control e" name="nationality" placeholder="" data-validation="required" data-validation-error-msg="<?php echo lang('admi_nationality_error_msg'); ?>">
                                </div>
                            </div>
                            
                            
                            <!-- <div class="form-group">
                                <label class="col-md-3 control-label"><?php // echo lang('admi_FatherName'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control " name="father_name" placeholder="" data-validation="required" data-validation-error-msg="<?php // echo lang('admi_FatherName_error'); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php // echo lang('admi_MotherName'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control " name="mother_name" placeholder="" data-validation="required" data-validation-error-msg="<?php // echo lang('admi_MotherName_error_msg'); ?>">
                                </div>
                            </div> -->
                        </div>
                        <div class="col-md-3 ">
                            <label class="control-label "><?php echo lang('admi_students_photo');?> <span class="requiredStar"> * </span></label>
                            <div class="form-group last">
                                
                                <div class="">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail">
                                            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""/>
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail uploadImagePreview">
                                        </div>
                                        <div>
                                            <span class="btn default btn-file">
                                                <span class="fileinput-new"> <?php echo lang('admi_select_photo'); ?> </span>
                                                <span class="fileinput-exists">
                                                    <?php echo lang('admi_stu_photo_change'); ?> </span>
                                                <input type="file" name="userfile" class="" >
                   <!-- data-validation="required" data-validation-error-msg="<?php // echo lang('admi_students_photo_error_msg');?>" -->
                                            </span>
                                            <a href="#" class="btn red fileinput-exists " data-dismiss="fileinput">
                                                <?php echo lang('admi_stu_photo_remove'); ?> </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                         
                            <div class="form-group ">
                                <label class="col-md-3 control-label"> <?php echo lang('admi_religion'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <select name="religion" class="form-control se" data-validation="required" data-validation-error-msg="<?php echo lang('admi_religion_error_msg'); ?>">
                                        <option value=""><?php  echo lang('admi_religion_op1'); ?></option>
                                        <option value="islam"><?php  echo lang('admi_religion_op2'); ?></option> 
                                        <option value="christian"><?php  echo lang('admi_religion_op3'); ?></option> 
                                        <option value="hindu"><?php  echo lang('admi_religion_op4'); ?></option>  
                                    </select>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label class="col-md-3 control-label"> <?php echo lang('admi_sect'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control f" name="sect" placeholder="" data-validation="required" data-validation-error-msg="<?php echo lang('admi_sect_error_msg'); ?>">
                                </div>
                            </div>
                             
                             
                            <div class="form-group">
                                <label class="col-md-3 control-label"> <?php echo lang('admi_detailschool'); ?> <!-- <span class="requiredStar"> * </span> --></label>
                                <div class="col-md-6">
                                    <textarea class="form-control" name="previous_detail_school" rows="3"></textarea>
                       <!--  data-validation="required" data-validation-error-msg="<?php // echo lang('admi_admi_detailschool_error_msg'); ?>" -->             
                                </div>
                            </div>
                            <div class="form-actions fluid">
                              <div class="col-md-offset-3 col-md-6"> 
                                <button type="button" id="btn_hidde"  class="btn btn-success btn-lg"> Next </button><!--1onclick="hidden_div()"-->
                              </div>
                            </div>
                        </div>
                    </div>
    
                   <div style="display: none;" id="div2">
                    <h3 style="padding-left: 4%; font-weight: 700;"><?php echo lang('admi_academicAchievements');?></h3> 
                            <div class="form-group">
                                <label class="col-md-2 control-label"> <?php // echo lang('admi_PresentAddress'); ?> </label>
                                <div class="col-md-6">
                                     <label class=" control-label"> <?php echo lang('admi_academic_achievement'); ?> </label>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label"> </label>
                                <div class="col-md-6">
                                    <textarea class="form-control h" name="academic_achievement" rows="3" > </textarea>
                   <!-- data-validation="required" data-validation-error-msg="<?php // echo lang('admi_academic_achievement_error_msg'); ?>" -->
                                </div>
                            </div>
                    <h3 style="padding-left: 4%; font-weight: 700;"> <?php echo lang('admi_specialinterest'); ?></h3>
                            <div class="form-group">
                                <label class="col-md-3 control-label"> Game/Hobbies <?php echo lang('admi_gamehobbies'); ?> <span class="requiredStar">  </span></label>
                                <div class="col-md-6">
                                    <textarea class="form-control i" name="game_hobbies" rows="3" > </textarea>
                        <!-- data-validation="required" data-validation-error-msg="<?php // echo lang('admi_PresentAddress_error_msg'); ?>" -->
                                </div>
                            </div>
                    <h3 style="padding-left: 4%; font-weight: 700;"><?php echo lang('admi_extraactivities'); ?> </h3>
                            <div class="form-group">
                                <label class="col-md-3 control-label"> <?php // echo lang('admi_PresentAddress'); ?>  </label>
                                <div class="col-md-6">
                                    <textarea class="form-control j" name="extra_activities" rows="3" > </textarea>
                        <!-- data-validation="required" data-validation-error-msg="<?php // echo lang('admi_PresentAddress_error_msg'); ?>" -->
                                </div>
                            </div>
                       
                            <div class="form-group">
                                <label class="col-md-3 control-label"> <?php  echo lang('admi_honour'); ?> <span class="requiredStar"> </span></label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control k" name="honour_distinction" placeholder="" >
                           <!--  data-validation="required" data-validation-error-msg="<?php // echo lang('admi_FatherName_error'); ?>" -->
                                </div>
                            </div>
                    <h3 style="padding-left: 4%; font-weight: 700;"><?php echo lang('admi_brothersister'); ?></h3>
                              
                            <div class="form-group">
                                <label class="col-md-3 control-label"> <?php // echo lang('tea_eq'); ?><span class="requiredStar">  </span></label>
                                <div class="col-md-2">
                                    <H4 class="eduFormTitle"> <?php echo lang('admi_Name'); ?></H4>
                                     <input class="form-control eduForm" name="br_name_1" type="text" placeholder="" data-validation=" " data-validation-error-msg="">
                                    <input class="form-control eduForm" name="br_name_2" type="text" placeholder="" >
                                    <input class="form-control eduForm" name="br_name_3" type="text" placeholder="" > 
                                </div>
                                <div class="col-md-3">
                                    <H4 class="eduFormTitle">  <?php echo lang('admi_Class_Section'); ?></H4>
                                    <input class="form-control eduForm" name="br_section_1" type="text" placeholder="" data-validation=" " data-validation-error-msg="">
                                    <input class="form-control eduForm" name="br_section_2" type="text" placeholder="" >
                                    <input class="form-control eduForm" name="br_section_3" type="text" placeholder="" > 
                                </div>
                                <div class="col-md-2">
                                    <H4 class="eduFormTitle"> <?php echo lang('admi_StudentNo'); ?></H4>
                                    <input class="form-control eduForm" name="br_no_1" type="text" placeholder="" data-validation=" " data-validation-error-msg="">
                                    <input class="form-control eduForm" name="br_no_2" type="text" placeholder="" >
                                    <input class="form-control eduForm" name="br_no_3" type="text" placeholder="" > 
                                </div> 
                            </div>
                            <div class="form-actions fluid">
                              <div class="col-md-offset-3 col-md-6"> 
                                <button type="button" id="btn_show_previous2"  class="btn btn-primary btn-lg"> Previous </button>
                                <button type="button" id="btn_hidde2"  class="btn btn-success btn-lg"> Next </button><!--1onclick="hidden_div()"-->
                                
                              </div>
                            </div>
                    </div>
                    <div style="display: none;" id="div3">
                    <h3 style="padding-left: 4%; font-weight: 700;">Family Information</h3>
                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo lang('admi_FatherName'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control l" name="father_name" id="father_name" placeholder="" data-validation="required" data-validation-error-msg="<?php echo lang('admi_FatherName_error'); ?>">
                                </div>
                            </div> 
                            <div class="form-group">
                                <label class="col-md-3 control-label">Father CNIC No <?php // echo lang('admi_PhoneNumber'); ?> <span class="requiredStar"> * </span></label> 
                                <div class="col-md-6">
                                    <input type="text" class="form-control m" name="father_cnic" id="father_cnic" placeholder=""  data-validation="required" data-validation-error-msg="<?php echo 'Father CNIC Number is Required'; ?>" maxlength="15">
                                    <span class="help-block"> xxxxx-xxxxxxx-x </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"> Qualification <?php // echo lang('admi_FatherName'); ?> <!-- <span class="requiredStar"> * </span> --></label>
                                <div class="col-md-6">
                                 <input type="text" class="form-control n" name="father_qualification" placeholder="">
                            <!-- data-validation="required" data-validation-error-msg="" -->
                                </div>
                            </div> 
                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo lang('admi_FatherOccupation'); ?> <!-- <span class="requiredStar"> * </span> --></label>
                                <div class="col-md-6">
                                     <!-- data-validation="required" data-validation-error-msg="<?php // echo lang('admi_FatherOccupation_error_msg'); ?>" -->
                                    <select name="father_occupation" id="father_occupation" class="form-control fo">
                                        <option value=""><?php echo lang('admi_father_occupation_op1'); ?></option>
                                        <option value="Business"><?php echo lang('admi_father_occupation_op2'); ?></option>
                                        <option value="Employer"><?php echo lang('admi_father_occupation_op3'); ?></option>
                                        <option value="Banker"><?php echo lang('admi_father_occupation_op4'); ?></option>
                                        <option value="Teachers"><?php echo lang('admi_father_occupation_op5'); ?></option>
                                        <option value="Farmer"><?php echo lang('admi_father_occupation_op6'); ?></option>
                                        <option value="Car Driver"><?php echo lang('admi_father_occupation_op7'); ?></option>
                                        <option value="Other"><?php echo lang('admi_father_occupation_op8'); ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"> <?php echo lang('admi_PresentAddress'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <textarea class="form-control o" name="present_address" id="present_address" rows="3" data-validation="required" data-validation-error-msg="<?php echo lang('admi_PresentAddress_error_msg'); ?>"> </textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"> <?php echo lang('admi_PermanentAddress'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <textarea class="form-control p" name="permanent_address" id="permanent_address" rows="3" data-validation="required" data-validation-error-msg="<?php echo lang('admi_PermanentAddress_error_msg'); ?>"></textarea>
                                </div>
                            </div> 
                            <div class="form-group">
                                <label class="col-md-3 control-label"> <?php echo lang('admi_PhoneNumber'); ?> <span class="requiredStar"> * </span></label>
                                    <div class="col-md-1">
                                        <input type="text" class="form-control pc" name="phoneCode" id="phoneCode" placeholder="+92"  data-validation="required" data-validation-error-msg="<?php echo 'Phone Number field is Required'; ?>" value="<?php if(!empty($countryPhoneCode)){echo $countryPhoneCode;}?>">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control pn" name="phone" id="phone" placeholder="" data-validation="required" data-validation-error-msg="<?php echo 'Phone Number field is Required'; ?>" maxlength="10"  onkeypress="return /[0-9]/i.test(event.key)" >
                                        <span class="help-block">
                                            300 1234567</span>
                                    </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo lang('admi_MotherName'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control q" name="mother_name" placeholder="" data-validation="required" data-validation-error-msg="<?php echo lang('admi_MotherName_error_msg'); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Mother CNIC No <?php // echo lang('admi_PhoneNumber'); ?> <span class="requiredStar"> * </span></label> 
                                <div class="col-md-6">
                                    <input type="text" class="form-control r" name="mother_cnic" id="mother_cnic" placeholder=""  data-validation="required" data-validation-error-msg="<?php echo 'Mother CNIC Number is Required'; ?>" maxlength="15">
                                    <span class="help-block"> xxxxx-xxxxxxx-x</span>
                                </div>
                            </div> 
                            <div class="form-group">
                                <label class="col-md-3 control-label">Qualification <?php // echo lang('admi_FatherName'); ?> <!-- <span class="requiredStar"> * </span> --></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control s" name="mother_qualification" placeholder="" >
                           <!--  data-validation="required" data-validation-error-msg="<?php // echo 'This Field is Required'; ?>" -->
                                </div>
                            </div> 
                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo lang('admi_Mother_occup'); ?></label>
                                <div class="col-md-6">
                                    <select name="mother_occupation" class="form-control mo" >
                                        <option value=""><?php echo lang('admi_Mother_occup_valu_1'); ?></option>
                                        <option value="Housewife"><?php echo lang('admi_Mother_occup_valu_2'); ?></option>
                                        <option value="Business"><?php echo lang('admi_Mother_occup_valu_3'); ?></option>
                                        <option value="Employer"><?php echo lang('admi_Mother_occup_valu_4'); ?></option>
                                        <option value="Banker"><?php echo lang('admi_Mother_occup_valu_5'); ?></option>
                                        <option value="Teachers"><?php echo lang('admi_Mother_occup_valu_6'); ?></option>
                                        <option value="Farmer"><?php echo lang('admi_Mother_occup_valu_7'); ?></option>
                                        <option value="Car Driver"><?php echo lang('admi_Mother_occup_valu_8'); ?></option>
                                        <option value="Other"><?php echo lang('admi_Mother_occup_valu_9'); ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"> Office Address <?php // echo lang('admi_PresentAddress'); ?> <!-- <span class="requiredStar"> * </span> --></label>
                                <div class="col-md-6">
                                    <textarea class="form-control t" name="mother_office_address" rows="3" > </textarea>
                        <!-- data-validation="required" data-validation-error-msg="<?php // echo lang('admi_PresentAddress_error_msg'); ?>" -->
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Ph. Office  <?php // echo lang('admi_PhoneNumber'); ?> <!-- <span class="requiredStar"> * </span> --></label> 
                                <div class="col-md-6">
                                    <input type="text" class="form-control u" name="mother_ph_office" placeholder="" maxlength="11" onkeypress="return /[0-9]/i.test(event.key)">
                                    <!-- data-validation="required" data-validation-error-msg="" -->
                                    <span class="help-block"> 0300-1234567</span>
                                </div>
                            </div> 
                            <div class="form-actions fluid">
                              <div class="col-md-offset-3 col-md-6"> 
                                <button type="button" id="btn_show_previous3"  class="btn btn-primary btn-lg"> Previous </button>
                                <button type="button" id="btn_hidde3"  class="btn btn-success btn-lg"> Next </button><!--1onclick="hidden_div()"-->
                                
                              </div>
                            </div>
                    </div>
                    <div style="display: none;" id="div4">
                 <h3 style="padding-left: 4%; font-weight: 700;">Legal Guardian</h3>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Guardian First Name <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control ln" name="guardian_first_name" placeholder="" data-validation="required" data-validation-error-msg="<?php echo lang('admi_FatherName_error'); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Guardian Last Name <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control ln1" name="guardian_last_name" placeholder="" data-validation="required" data-validation-error-msg="<?php echo lang('admi_FatherName_error'); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Guardian CNIC # <?php // echo lang('admi_PhoneNumber'); ?> <span class="requiredStar"> * </span></label> 
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="guardian_cnic" id="guardian_cnic" placeholder="" data-validation="required" maxlength="15"data-validation-error-msg="<?php echo 'Guardian CNIC Number is Required'; ?>">
                                    <span class="help-block"> xxxxx-xxxxxxx-x </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Relationship with the student <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control lr" name="guardian_relationship" placeholder="" data-validation="required" data-validation-error-msg="<?php echo 'This Field is Required'; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Qualification </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control lq" name="guardian_qualification" placeholder=""> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"> Occupation </label>
                                <div class="col-md-6">
                                    <select name="guardian_occupation" class="form-control" >
                                        <option value="">Select...</option>
                                        <option value="Business">Business <?php // echo lang('admi_father_occupation_op2'); ?></option>
                                        <option value="Employer">Employer <?php // echo lang('admi_father_occupation_op3'); ?></option>
                                        <option value="Banker">Banker <?php // echo lang('admi_father_occupation_op4'); ?></option>
                                        <option value="Teachers">Teachers <?php // echo lang('admi_father_occupation_op5'); ?></option>
                                        <option value="Farmer">Farmer <?php // echo lang('admi_father_occupation_op6'); ?></option>
                                        <option value="Car Driver">Car Driver <?php // echo lang('admi_father_occupation_op7'); ?></option>
                                        <option value="Other">Other <?php // echo lang('admi_father_occupation_op8'); ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label "> Residential Address <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <textarea class="form-control la" name="guardian_residential_address" rows="3" data-validation="required" data-validation-error-msg="<?php // echo lang('admi_PresentAddress_error_msg'); ?>"> </textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Ph. Res. </label> 
                                <div class="col-md-4">
                                    <input type="text" class="form-control lp" name="guardian_ph_res" placeholder="" maxlength="11" onkeypress="return /[0-9]/i.test(event.key)">
                                    <!-- data-validation="required" data-validation-error-msg="" -->
                                    <span class="help-block">0300-1234567</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Ph. Office </label> 
                                <div class="col-md-4">
                                    <input type="text" class="form-control lo" name="guardian_ph_office" placeholder="" maxlength="11" onkeypress="return /[0-9]/i.test(event.key)"> 
                                    <span class="help-block">0300-1234567</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Mobile <span class="requiredStar"> * </span></label> 
                                <div class="col-md-4">
                                    <input type="text" class="form-control lm" name="guardian_mobile" placeholder=""  data-validation="required" data-validation-error-msg="" maxlength="11" onkeypress="return /[0-9]/i.test(event.key)">
                                    <span class="help-block">0300-1234567</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-2 control-label">  <input type="checkbox" class="check" name="term_condition" placeholder=""  data-validation="required" value="agree" data-validation-error-msg="<?php echo 'This Field is Required'; ?>"> </div> 
                                <div class="col-md-7"> 
                                    I undertake that my child shall abide by all the School Rules and Regulations in letter and spirit. In case of any dispute, the decision of the School shall be final and acceptable to me and my child. I also undertake to pay the annually 5% enhanced tuition fee, as expected, every year.
                                </div>
                            </div>

 
                          
                            <!-- <div class="form-group">
                                <label class="col-md-3 control-label"><?php // echo lang('admi_Email'); ?><span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" onkeyup="checkEmail(this.value)" placeholder="demo@demo.com" name="email" data-validation="email required" data-validation-error-msg="<?php // echo lang('admi_Email_error_msg'); ?>">
                                    <span class="help-block">This student can login his profile by this Email and Password </span>
                                    <div id="checkEmail" class="col-md-12"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"> <?php // echo lang('admi_Password'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password" placeholder="" data-validation="required" data-validation-error-msg="<?php // echo lang('Password field is required field.'); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php // echo lang('admi_ConfirmPassword'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password_confirm" placeholder="" data-validation="required" data-validation-error-msg="<?php // echo lang('admi_ConfirmPassword_error_msg'); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php // echo lang('admi_blood'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <select name="blood" class="form-control" data-validation="required" data-validation-error-msg="<?php // echo lang('admi_blood_err_mess'); ?>">
                                        <option value=""><?php // echo lang('select'); ?></option>
                                        <option value="O+">O+</option>
                                        <option value="O-">O-</option>
                                        <option value="A+">A+</option>
                                        <option value="A-">A-</option>
                                        <option value="B+">B+</option>
                                        <option value="B-">B-</option>
                                        <option value="AB+">AB+</option>
                                        <option value="AB-">AB-</option>
                                    </select>
                                </div>
                            </div>
                            
                         <div class="form-group">
                                <label class="col-md-3 control-label"><?php // echo lang('admi_father_Income_range'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <input type="text" name="father_incom_range" class="form-control" placeholder="" data-validation="required" data-validation-error-msg="<?php // echo lang('admi_father_Income_range_error_msg'); ?>">
                                    <span class="help-block"><?php // echo lang('admi_father_Income_range_demo_text');?></span>
                                </div>
                            </div> -->
                            <div class="form-group">
                                <label class="col-md-3 control-label"> Class for Admission<span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <input type="text" name="class_id" id="class_id" class="form-control" readonly="" >
                                </div>
                            </div>
                            <div class="form-group"> 
                                <label class="col-md-3 control-label"><?php echo lang('admi_Class'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <select name="class" onchange="classInfo(this.value)" class="form-control" data-validation="required" data-validation-error-msg="<?php echo lang('admi_Class_error_msg');?>">
                                        <option value=""><?php echo lang('admi_select_class');?></option>
                                         <?php foreach ($s_class as $row) { ?>
                                           <option value="<?php echo $row['id']; ?>"><?php echo $row['class_title']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div id="txtHint"> </div> 
                            <input type="hidden" name="created_by" value="<?php echo $userId; ?>">
                          
                            <div class="alert alert-success">
                                <?php echo lang('admi_submit_doc');?>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"> </label>
                                <div class="col-md-9">
                                    <div class="checkbox-list">
                                        <label>
                                            <input type="checkbox" name="previous_certificate" value="submited"> <?php echo lang('admi_Pre_Class_Cer'); ?> </label>
                                        <label>
                                            <input type="checkbox" name="tc" value="submited"> <?php echo lang('admi_TC'); ?> </label>
                                        <label>
                                            <input type="checkbox" name="at" value="submited"> <?php echo lang('admi_Academic_Transcript');?> </label>
                                        <label>
                                            <input type="checkbox" name="nbc" value="submited"> <?php echo lang('admi_NBC'); ?> </label>
                                        <label>
                                            <input type="checkbox" name="testmonial" value="submited"> <?php echo lang('admi_Testimonial'); ?>  </label>
                                    </div>
                                </div>
                            </div>  
                                                      
                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo lang('admi_Submitted_File_Informations'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <input type="text" name="submit_file_information" class="form-control" placeholder="<?php echo lang('admi_Submitted_File_Informations_placeholder'); ?>" data-validation="required" data-validation-error-msg="<?php echo lang('admi_Submitted_File_Info_error_msg'); ?>" >
                                </div>
                            </div>   
                            <div class="form-actions fluid">
                              <div class="col-md-offset-3 col-md-6">
                                <button type="button" class="btn btn-primary btn-lg" id="pre_btn">Previous</button>
                                <button type="submit" class="btn green btn-lg" name="submit" id="submit_data" value="submit"><?php echo lang('save');?></button>
                                <!-- <button type="reset" class="btn default"><?php // echo lang('refresh');?></button> -->
                                
                              </div>
                            </div>
                        </div>
                        </div>
                        
                        <?php echo form_close(); ?>
                    </div>
                </div>
                <!-- END SAMPLE FORM PORTLET-->
            </div>
        </div>
        <!-- END PAGE CONTENT-->
    </div>
</div>
<!-- END CONTENT -->


<!-- BEGIN PAGE LEVEL script -->
<script src= "assets/global/plugins/3.1.1-jquery.min.js"> </script> 
<script src= "assets/global/plugins/1.12.1-jquery-ui.min.js"> </script> 
<script type="text/javascript" src="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
<script type="text/javascript" src="assets/global/plugins/jquery.input-ip-address-control-1.0.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js"></script>
<script src="assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript"></script>
<script src="assets/global/plugins/typeahead/handlebars.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/typeahead/typeahead.bundle.min.js" type="text/javascript"></script>
<script src="assets/admin/pages/scripts/components-form-tools.js"></script>
<script src="assets/global/plugins/jquery.form-validator.min.js" type="text/javascript"></script>

 
  <script>
    $(document).ready(function() { 
        $(function() { 
        $("#birthdate").datepicker({
            changeDay: true,
            changeMonth: true,
            changeYear: true,
            yearRange:"2000:2050",
            dateFormat: 'yy-mm-dd'
                    
        }); 
        });   
    });
    
  </script> 
  <script>
/*$(document).ready(function(){
//form ma lagy huvy button ko disable krny k lia code
jQuery("#btn_hidde2").prop('disabled', true);
var toValidate = jQuery('.h, .i, .j, .k'), 
valid = false;
toValidate.keyup(function () {
if (jQuery(this).val().length > 0) {
    jQuery(this).data('valid', true);
} else {
    jQuery(this).data('valid', false);
}
toValidate.each(function () {
    if (jQuery(this).data('valid') == true) {
        valid = true;
    } else {
        valid = false;
    }
});
if (valid === true) {
    jQuery("#btn_hidde2").prop('disabled', false);
} else {
    jQuery("#btn_hidde2").prop('disabled', true);
}
});
});*/
      
  </script>
  <script>
    $(document).ready(function(){
    //form ma lagy huvy button ko disable krny k lia code
jQuery("#btn_hidde3").prop('disabled', true);
var toValidate = jQuery('.l, .m, .o, .p, .q, .r, .pc, .pn'), 
    valid = false;
toValidate.keyup(function () {
    if (jQuery(this).val().length > 0) {
        jQuery(this).data('valid', true);
    } else {
        jQuery(this).data('valid', false);
    }
    toValidate.each(function () {
        if (jQuery(this).data('valid') == true) {
            valid = true;
        } else {
            valid = false;
        }
    });
    if (valid === true) {
        jQuery("#btn_hidde3").prop('disabled', false);
    } else {
        jQuery("#btn_hidde3").prop('disabled', true);
    }
});
}); 
      
  </script>
  <script>
    $(document).ready(function(){
    //form ma lagy huvy button ko disable krny k lia code
jQuery("#submit_data").prop('disabled', true);
var toValidate = jQuery('.ln, .ln1, .lr, .lq, .la, .lp, .lo, .lm'), 
    valid = false;
toValidate.keyup(function () {
    if (jQuery(this).val().length > 0) {
        jQuery(this).data('valid', true);
    } else {
        jQuery(this).data('valid', false);
    }
    toValidate.each(function () {
        if (jQuery(this).data('valid') == true) {
            valid = true;
        } else {
            valid = false;
        }
    });
    if (valid === true) {
        jQuery("#submit_data").prop('disabled', false);
    } else {
        jQuery("#submit_data").prop('disabled', true);
    }
});
}); 
      
  </script>
<script>
$(document).ready(function(){
    //form ma lagy huvy button ko disable krny k lia code
jQuery("#btn_hidde").prop('disabled', true);
var toValidate = jQuery('.a, .b, .c, .d, .e, .f'), 
    valid = false;
toValidate.keyup(function () {
    if (jQuery(this).val().length > 0) {
        jQuery(this).data('valid', true);
    } else {
        jQuery(this).data('valid', false);
    }
    toValidate.each(function () {
        if (jQuery(this).data('valid') == true) {
            valid = true;
        } else {
            valid = false;
        }
    });
    if (valid === true) {
        jQuery("#btn_hidde").prop('disabled', false);
    } else {
        jQuery("#btn_hidde").prop('disabled', true);
    }
}); 
// 
   // form ko hide and show krny k liya code  
  $("#btn_hidde").click(function(){
    $("#div1").hide();
    $("#btn_hidde").hide(); 
    $("#div2").show();
  });
  $("#btn_hidde2").click(function(){
    $("#div2").hide();
    $("#btn_hidde2").hide(); 
    $("#div3").show();
  });
  $("#btn_show_previous2").click(function(){
    $("#div2").hide(); 
    $("#btn_hidde").show();
    $("#div1").show();
  });
  $("#btn_hidde3").click(function(){
    $("#div3").hide();
    $("#btn_hidde3").hide(); 
    $("#div4").show();
  });
  $("#btn_show_previous3").click(function(){
    $("#div3").hide(); 
    $("#btn_hidde2").show();
    $("#div2").show();
  });
  $("#pre_btn").click(function(){
    $("#div4").hide(); 
    $("#btn_hidde3").show();
    $("#div3").show();
  });
   
});
</script>

<script> $.validate(); </script>
<script>
    jQuery(document).ready(function() {
        ComponentsFormTools.init();
    });
</script>
<script type="text/javascript">
    var RecaptchaOptions = {
        theme: 'custom',
        custom_theme_widget: 'recaptcha_widget'
    };
</script>
<script>
    function classInfo(str) {
        var xmlhttp;
        if (str.length === 0) {
            document.getElementById("txtHint").innerHTML = "";
            return;
        }
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        }
        else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "index.php/users/student_info?q=" + str, true);
        xmlhttp.send();
    }
    function checkEmail(str) {
        var xmlhttp;
        if (str.length === 0) {
            document.getElementById("checkEmail").innerHTML = "";
            return;
        }
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        }
        else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                document.getElementById("checkEmail").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "index.php/commonController/checkEmail?val=" + str, true);
        xmlhttp.send();
    }
</script>
<script>
    jQuery(document).ready(function() {
//here is auto reload after 1 second for time and date in the top
        jQuery(setInterval(function() {
            jQuery("#result").load("index.php/home/iceTime");
        }, 1000));
        var url_string = window.location.href
        var url = new URL(url_string);
        var reg_id = url.searchParams.get("reg_id");
        if(reg_id){
                   fetch_reg_stu(reg_id);
        $('#register_number').val(reg_id);
        }
        
    });

</script>

<!-- fetch student data in data base table register_pass -->
    <script>
    function fetch_reg_stu(register_number){
        var register_number  = register_number;
        //alert (register_number);
       if(register_number.length>=8){
            $.ajax({
                url: 'index.php/users/get_student_info',
                type: 'POST',
                data: {register_number:register_number},
                success: function (result) {  
                   var data = JSON.parse(result);
                   //alert(data);
                if(data.length==39){
                    $("#errordata").text(data);
                    $("#reg_hide").hide(); 
                } else if(data.length==32){
                    $("#errordata").text(data);
                    $("#reg_hide").hide(); 
                } else{
                    $("#errordata").text("");
                    $("#reg_hide").show();}   
                    $("#first_name").val(data.first_name);
                    $("#last_name").val(data.last_name);   
                    $("#father_name").val(data.father_name);  
                    $("#father_cnic").val(data.father_cnic); 
                    $("#birthdate").val(data.birth_date); 
                    $("#gender").val(data.gender);  
                    $("#father_occupation").val(data.father_occupation);   
                    $("#present_address").val(data.present_address); 
                    $("#phone").val(data.phone);
                    $("#class_id").val(data.class_title); 
                    if(data.gender== "Male"){ 
                        document.getElementById("gender1").checked = true;
                    } else if(data.gender== "Female"){
                        document.getElementById("gender2").checked = true;
                    }
                }
            }); 
        }
    }
    
</script>
<script>
    $('#guardian_cnic').keydown(function(){

  //allow  backspace, tab, ctrl+A, escape, carriage return
  if (event.keyCode == 8 || event.keyCode == 9 
                    || event.keyCode == 27 || event.keyCode == 13 
                    || (event.keyCode == 65 && event.ctrlKey === true) )
                        return;
  if((event.keyCode < 48 || event.keyCode > 57))
   event.preventDefault();

  var length = $(this).val().length; 
              
  if(length == 5 || length == 13)
   $(this).val($(this).val()+'-');

 }); 
    $('#father_cnic').keydown(function(){

  //allow  backspace, tab, ctrl+A, escape, carriage return
  if (event.keyCode == 8 || event.keyCode == 9 
                    || event.keyCode == 27 || event.keyCode == 13 
                    || (event.keyCode == 65 && event.ctrlKey === true) )
                        return;
  if((event.keyCode < 48 || event.keyCode > 57))
   event.preventDefault();

  var length = $(this).val().length; 
              
  if(length == 5 || length == 13)
   $(this).val($(this).val()+'-');

 });
 $('#mother_cnic').keydown(function(){

  //allow  backspace, tab, ctrl+A, escape, carriage return
  if (event.keyCode == 8 || event.keyCode == 9 
                    || event.keyCode == 27 || event.keyCode == 13 
                    || (event.keyCode == 65 && event.ctrlKey === true) )
                        return;
  if((event.keyCode < 48 || event.keyCode > 57))
   event.preventDefault();

  var length = $(this).val().length; 
              
  if(length == 5 || length == 13)
   $(this).val($(this).val()+'-');

 }); 
</script>
<!-- END PAGE LEVEL script
    