<link rel="stylesheet" type="text/css" href="assets/global/jquery_ui_css/jquery-ui.css" />
<?php $user = $this->ion_auth->user()->row();
$userId = $user->id; ?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                    <?php echo lang('stu_esi'); ?> <small></small>
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
                        <?php echo lang('header_stu_info'); ?>
                    </li>
                    <li>
                        <?php echo lang('stu_esi'); ?>
                    </li>
                    <li id="result" class="pull-right topClock"></li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
                            <?php
                            if (!empty($success)) {
                                echo $success;
                            }
                            ?>
        <div class="row">
            <div class="col-md-12 ">
                <!-- BEGIN SAMPLE FORM PORTLET-->
                <div class="portlet box green ">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-bars"></i> <?php echo lang('stu_esib'); ?>
                        </div>
                        <div class="tools">
                            <a href="" class="collapse">
                            </a>
                            <a href="" class="reload">
                            </a>
                        </div>
                    </div>
                    <?php
                    /*foreach ($users as $row) {
                        $first_name = $row['first_name'];
                        $last_name = $row['last_name'];
                        $phone_number = $row['phone'];
                        $email = $row['email'];
                    }*/
                    foreach ($studentInfo as $row1) {
                        $year=$row1['year'];
                        $first_name = $row1['first_name'];
                        $last_name = $row1['last_name']; 
                        // $email = $row['email']; 
                        $stuname = $row1['student_nam'];
                        $fatherName = $row1['farther_name'];
                        $motherName = $row1['mother_name'];
                        $birthDate = $row1['birth_date'];
                        $gender = $row1['gender'];
                        $phone = $row1['phone'];
                        $student_ID = $row1['student_id'];
                        $roll_Number = $row1['roll_number'];
                        $sec = $row1['section'];
                        $present_address = $row1['present_address'];
                        $permanent_address = $row1['permanent_address'];
                        $father_occupation = $row1['father_occupation'];
                        $father_incom_range = $row1['father_incom_range'];
                        $mother_occupation = $row1['mother_occupation'];
//                        $class_id = $row1['class_id'];
                        $last_class_certificate = $row1['last_class_certificate'];
                        $t_c = $row1['t_c'];
                        $academic_transcription = $row1['academic_transcription'];
                        $national_birth_certificate = $row1['national_birth_certificate'];
                        $testimonial = $row1['testimonial'];
                        $documents_info = $row1['documents_info'];
                        $blood = $row1['blood'];
                        $reg_number = $row1['registration_number'];
                        $status = $row1['status'];
                        $status_reason = $row1['status_reason'];
                    }
                    $class_id = $this->input->get('class_id');
                    $class = $this->common->class_title($class_id);
                    $m = '';
                    $f = "";
                    $o = "";
                    if ($gender == 'Male') {
                        $m = 'checked';
                    } elseif ($gender == 'Female') {
                        $f = 'checked';
                    }   
                    
                    $studentClass = $this->input->get('id');
                    $studentInfoId = $this->input->get('sid'); 
                    $class_id = $this->input->get('class_id');
                    $userid = $this->input->get('userId');
                    
                    ?>
                    <div class="portlet-body form">
                        <?php

                        $form_attributs = array('class' => 'form-horizontal', 'role' => 'form');
                        echo form_open("students/editStudent?id=$studentClass&sid=$studentInfoId&userId=$userid&class_id=$class_id", $form_attributs);
                        ?>
                        <div class="form-body">
                            
                            <input type="hidden" name="created_by" value="<?php echo $userId; ?>" readonly="">
                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo lang('admi_FirstName'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" value="<?php echo $first_name;?>" name="first_name" data-validation="required" data-validation-error-msg="<?php echo lang('First name is required field.'); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo lang('admi_LastName'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" value="<?php echo $last_name; ?>" name="last_name" data-validation="required" data-validation-error-msg="<?php echo lang('admi_LastName_error_msg'); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo lang('admi_PhoneNumber'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>" data-validation="required" data-validation-error-msg="">
                                    <span class="help-block">0300-0000000</span>
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                 <label class="col-md-3 control-label"><?php echo lang('admi_Email'); ?><span class="requiredStar"> * </span></label>
                                 <div class="col-md-6">
                                     <input type="email" class="form-control" onkeyup="checkEmail(this.value)" placeholder="demo@demo.com" value="<?php echo $email; ?>" name="email" data-validation="email required" data-validation-error-msg="<?php echo lang('admi_Email_error_msg'); ?>">
                                     <div id="checkEmail" class="col-md-12"></div>
                                 </div>
                             </div>  --> 
                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo lang('admi_FatherName'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="father_name" value="<?php echo $fatherName; ?>" data-validation-error-msg="<?php echo lang('admi_FatherName_error'); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo lang('admi_MotherName'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="mother_name" value="<?php echo $motherName; ?>" data-validation="required" data-validation-error-msg="<?php echo lang('admi_MotherName_error_msg'); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3"><?php echo lang('admi_DateOfBirth'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-4">
                                    <input class="form-control" name="birthdate" id="mask_date2" value="<?php echo $birthDate; ?>" type="text" data-validation="required" data-validation-error-msg="<?php echo lang('admi_DateOfBirth_error_msg'); ?>"/>
                                    <span class="help-block">
                                        Date Type  DD/MM/YYYY </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo lang('admi_Sex'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-6 marginLeftSex">
                                    <div class="radio-list">
                                        <label class="radio-inline">
                                           <input type="radio" name="sex" id="optionsRadios4" <?php echo $m; ?> value="Male" data-validation="required" data-validation-error-msg="<?php echo lang('admi_sex_error_msg'); ?>"><?php echo lang('admi_Male'); ?></label>
                                        <label class="radio-inline">
                                            <input type="radio" name="sex" id="optionsRadios5" <?php echo $f; ?> value="Female"> <?php echo lang('admi_Female'); ?> </label>
                                         
                                    </div>
                                </div>
                            </div> 
                            <div class="form-group">
                                <label class="col-md-3 control-label"> <?php echo lang('admi_PresentAddress'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <textarea class="form-control" name="present_address" rows="3" data-validation="required" data-validation-error-msg="<?php echo lang('admi_PresentAddress_error_msg'); ?>"><?php echo $present_address; ?> </textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"> <?php echo lang('admi_PermanentAddress'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <textarea class="form-control" name="permanent_address" rows="3" data-validation="required" data-validation-error-msg="<?php echo lang('admi_PermanentAddress_error_msg'); ?>"><?php echo $permanent_address; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo lang('admi_FatherOccupation'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <select name="father_occupation" class="form-control" data-validation="required" data-validation-error-msg="<?php echo lang('admi_FatherOccupation_error_msg'); ?>">
                                        <option value="<?php echo $father_occupation; ?>"><?php echo $father_occupation; ?></option>
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
                            <!-- <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo lang('admi_father_Income_range'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <input type="text" name="father_incom_range" class="form-control" value="<?php echo $father_incom_range; ?>" data-validation="required" data-validation-error-msg="<?php  echo lang('admi_father_Income_range_error_msg'); ?>">
                                    <span class="help-block"><?php echo lang('admi_father_Income_range_demo_text');?></span>
                                </div>
                            </div> -->
                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo lang('admi_Mother_occup'); ?></label>
                                <div class="col-md-6">
                                    <select name="mother_occupation" class="form-control" >
                                        <option value="<?php echo $mother_occupation; ?>"><?php echo $mother_occupation; ?></option>
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
                                    <label class="col-md-3 control-label"><?php echo lang('admi_Class'); ?> </label>
                                    <div class="col-md-6">
                                        <select class="form-control" name="class">
                                            <option class="claasSelectBGColor"  value="<?php echo $class_id; ?>"><?php echo $class; ?></option> 
                                        </select>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="col-md-3 control-label">  Section</label>
                                    <div class="col-md-6">
                                         <input type="text" class="form-control" value="<?php echo $sec; ?>" name="student_id" readonly> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"> <?php echo lang('stu_add_id'); ?> </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" value="<?php echo $student_ID; ?>" name="student_id" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo lang('stu_add_roll'); ?></label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control"  value="<?php echo $roll_Number; ?>" name="roll_number" readonly>
                                    </div>
                                </div>
                            <div class="alert alert-success">
                               <?php echo lang('admi_submit_doc');?>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"> </label>
                                <div class="col-md-3">
                                    <div class="checkbox-list">
                                        <label>
                                            <input type="checkbox" name="previous_certificate" <?php
                                            if (!empty($last_class_certificate)) {
                                                echo 'checked value="submited"';
                                            }
                                            ?>> Previous  Class Certificate. </label>
                                        <label>
                                            <input type="checkbox" name="tc"  <?php
                                            if (!empty($t_c)) {
                                                echo 'checked value="submited"';
                                            }
                                            ?>> Transfer certificate. </label>
                                        <label>
                                            <input type="checkbox" name="at" <?php
                                            if (!empty($academic_transcription)) {
                                                echo 'checked value="submited"';
                                            }
                                            ?>> Academic Transcript. </label>
                                        <label>
                                            <input type="checkbox" name="nbc" <?php
                                            if (!empty($national_birth_certificate)) {
                                                echo 'checked value="submited"';
                                            }
                                            ?>> National Birth Certificate. </label>
                                        <label>
                                            <input type="checkbox" name="testmonial" <?php
                                            if (!empty($testimonial)) {
                                                echo 'checked value="submited"';
                                            }
                                            ?>> Testimonial  </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo lang('admi_Submitted_File_Informations'); ?> <span class="requiredStar">  </span></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="submit_file_information" value="<?php echo $documents_info; ?>" placeholder="<?php echo lang('admi_Submitted_File_Informations_placeholder'); ?>" data-validation="required" data-validation-error-msg="<?php echo lang('admi_Submitted_File_Info_error_msg'); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"> Student Status </label>
                                <div class="col-md-6">
                                    <select onchange="checkstatus(this.value)" class="form-control" name="status">
                                        <option class="claasSelectBGColor" value="<?php echo $status; ?>"><?php echo $status; ?></option>
                                        <option value="Active">Active</option>
                                        <option value="Deactive">Deactive</option> 
                                        <option value="Defaulter">Defaulter</option>
                                        <option value="Schoolleft">School Left</option>
                                    </select>
                                </div>
                            </div>
                            <div id="ajaxResult"></div> 
                        </div>  
    <input type="hidden" name="pre_year" value="<?php echo $year; ?>" >
    <input type="hidden" name="pre_first_name" value="<?php echo $first_name; ?>" >
    <input type="hidden" name="pre_last_name" value="<?php echo $last_name; ?>" >
    <input type="hidden" name="pre_stu_name" value="<?php echo $stuname; ?>" >
    <input type="hidden" name="pre_father_name" value="<?php echo $fatherName; ?>" >
    <input type="hidden" name="pre_mother_name" value="<?php echo $motherName; ?>" >
    <input type="hidden" name="pre_birth_date" value="<?php echo $birthDate; ?>" >
    <input type="hidden" name="pre_gender" value="<?php echo $gender; ?>" >
    <input type="hidden" name="pre_phone" value="<?php echo $phone; ?>" >
    <input type="hidden" name="pre_class_title" value="<?php echo $class; ?>" >
    <input type="hidden" name="pre_class_id" value="<?php echo $class_id; ?>" >
    <input type="hidden" name="pre_sec" value="<?php echo $sec; ?>" >
    <input type="hidden" name="pre_student_id" value="<?php echo $student_ID; ?>" >
    <input type="hidden" name="pre_roll_number" value="<?php echo $roll_Number; ?>" > 
    <input type="hidden" name="pre_present_address" value="<?php echo $present_address; ?>" >
    <input type="hidden" name="pre_permanent_address" value="<?php echo $permanent_address; ?>" >
    <input type="hidden" name="reg_number" value="<?php echo $reg_number; ?>" >
    <input type="hidden" name="pre_doc_info" value="<?php echo $documents_info; ?>" > 
                        <div class="form-actions fluid">
                            <div class="col-md-offset-3 col-md-6">
                                <button type="submit" class="btn green" name="submit" value="Submit"><?php echo lang('save');?></button>
                                <button type="button" onclick="javascript:history.back()" class="btn default"><?php echo lang('back');?></button>
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
<script src="assets/global/plugins/jquery.form-validator.min.js" type="text/javascript"></script>
<script> $.validate(); </script>
<script>
  $( function() {
    $("#mask_date2").datepicker({
      changeDay: true,
      changeMonth: true,
      changeYear: true,
      yearRange:"1990:2015",
      dateFormat: 'dd-mm-yy'
    });
  });
  </script>
<script>
    jQuery(document).ready(function() {
//here is auto reload after 1 second for time and date in the top
        jQuery(setInterval(function() {
            jQuery("#result").load("index.php/home/iceTime");
        }, 1000));
    });
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
    function checkstatus(str) {
        var xmlhttp;
        if (str.length == 0) {
            document.getElementById("ajaxResult").innerHTML = "";
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
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("ajaxResult").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "index.php/students/reason?q=" + str, true);
        xmlhttp.send();
    } 
</script>
