<!--BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/jquery_ui_css/jquery-ui.css" />
 
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
                        echo form_open_multipart('users/editregstu', $form_attributs);
                        ?>
                        <div class="form-body">
                            <?php
                            if (!empty($success)) {
                                echo $success;
                            }
                            ?>
                            <?php foreach($voucher as $row){
                            $class_id = $row['class_id']; 
                                $reg = $row['reg_number'];
                                $date = $row['reg_date'];
                                $first_name = $row['first_name'];
                                $last_name = $row['last_name'];
                                $session = $row['session'];
                                $dob = $row['birth_date'];
                                $bf = $row['b_form'];
                                $fname = $row['father_name'];
                                $cnic = $row['father_cnic'];
                                $ocup = $row['father_occupation'];
                                $add = $row['present_address'];
                                $phone = $row['phone'];
                                $sex = $row['gender'];
                                $due = $row['due_date'];
                              
                        if (!empty($row1['previous_info1'])) {
                            $bs_1 = $row1['previous_info1'];
                            $education_1 = array_map('trim', explode(",", $bs_1));
                        }
                        if (!empty($row1['previous_info2'])) {
                            $bs_2 = $row1['previous_info2'];
                            $education_2 = array_map('trim', explode(",", $bs_2));
                        }
                        if (!empty($row1['previous_info3'])) {
                            $bs_3 = $row1['previous_info3'];
                            $education_3 = array_map('trim', explode(",", $bs_3));
                        }

                        if (!empty($row1['sibling_info1'])) {
                            $scol_uni1 = $row1['sibling_info1'];
                            $teacher_1 = array_map('trim', explode(",", $scol_uni1));
                        }
                        if (!empty($row1['sibling_info2'])) {
                            $scol_uni2 = $row1['sibling_info2'];
                            $teacher_2 = array_map('trim', explode(",", $scul_uni2));
                        }
                        if (!empty($row1['sibling_info3'])) {
                            $scol_uni3 = $row1['sibling_info3'];
                            $teacher_3 = array_map('trim', explode(",", $scol_uni3));
                        }

                        if (!empty($row1['sibling_info4'])) {
                            $be_1 = $row1['sibling_info4'];
                            $teacher_4 = array_map('trim', explode(",", $be_1));
                        }
                        if (!empty($row1['sibling_info5'])) {
                            $be_2 = $row1['sibling_info5'];
                            $teacher_5 = array_map('trim', explode(",", $be_2));
                        }
                        if (!empty($row1['sibling_info6'])) {
                            $be_3 = $row1['sibling_info6'];
                            $teacher_6 = array_map('trim', explode(",", $be_3));
                        }

 
                                 } ?> 
                            <div class="row">
                                 <div class="col-lg-12 " style="padding-left: 8%;"> 
                                <div class="col-md-4">
                                    <img src="assets/admin/layout/img/smlogo.png" alt="Punjab School">
                                </div>
                                <div class="col-md-6" align="center" style=" padding-top: 3%">
                                    <span style="font-weight: 700; font-size: 16px;" >The Punjab School</span><br>
                                    <span style="font-weight: 700; font-size: 16px;">CANAL GARDENS GULSHAN-E-HABIB CAMPUS LAHORE</span><br>
                                    <span style="font-weight: 700; font-size: 16px;">REGISTRATION FORM</span>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row" style="margin-left: 5%"    >
                            <div class="col-md-4"> <div class="form-group">
                                
                                <div class="col-md-6">
                                    Registration Number
                                    <input type="text" class="form-control a" name="regnum" value="<?php echo $reg; ?>" readonly="" >
                                </div>
                            </div></div>
                            <div class="col-md-4"> <div class="form-group">
                               
                                <div class="col-md-6">
                                    Date Of Registration
                                    <input type="text" class="form-control" name="date" id="date" value="<?php echo $date; ?>" readonly="">
                                </div>
                            </div></div>
                            <div class="col-md-4"> <div class="form-group">
                               
                                <div class="col-md-6">
                                    Due Date for Fee
                                    <input type="text" class="form-control " name="due_date" id="due_date"name="date" value="<?php echo $due; ?>">
                                </div>
                            </div></div>

                        </div>
                       
                            <hr>
                        <h3 style="padding-left: 4%; font-weight: 700;">Student Information </h3> 
                    <div class="row"> 
                        <div class="col-lg-9 " style="padding-left: 8%"> 
                            <div class="form-group">
                                 <label class="col-md-3 control-label"> <?php echo lang('stu_sel_cla_Class'); ?> </label>
                            <div class="col-md-6">  
                                <select onchange="classSection(this.value)"  class="form-control" name="class_id" data-validation="required" data-validation-error-msg="">
                                    <option value="<?php echo $class_id; ?>"><?php echo  $this->common->class_title($class_id); ?></option>
                                <?php foreach ($s_class as $row) { ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['class_title'];?></option>
                                <?php } ?>
                            </select>
                                                 
                             </div>  
                         </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Academic Session<span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control a" name="session" value="<?php echo $session ?>" data-validation="required" data-validation-error-msg="enter session">
                                </div>
                            </div>
                        
                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo lang('admi_FirstName'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control a" name="first_name" value="<?php echo $first_name ?>" data-validation="required" data-validation-error-msg="<?php echo lang('admi_firstName_error_msg'); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo lang('admi_LastName'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control b" placeholder="" name="last_name" value="<?php echo $last_name ?>" data-validation="required" data-validation-error-msg="<?php echo lang('admi_LastName_error_msg'); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3"><?php echo lang('admi_DateOfBirth'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-4">
                                    <input class="form-control c" name="birthdate" id="birthdate" value="<?php echo $dob ?>"    placeholder="dd/mm/yyyy" type="text" >
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Student B-Form Number <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control d" name="bfnumb" value="<?php echo $bf ?>" placeholder="" data-validation="required" data-validation-error-msg="enter B-form Number">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"> Father Name <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control d" name="father_name" value="<?php echo $fname ?>" placeholder="" data-validation="required" data-validation-error-msg="Enter Father Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Father CNIC <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control e" name="father_cnic" value="<?php echo $cnic ?>" placeholder="" data-validation="required" data-validation-error-msg="<?php echo lang('admi_nationality_error_msg'); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"> Father Occupation <?php // echo lang('admi_Mother_occup'); ?></label>
                                <div class="col-md-6">
                                    <select name="father_occupation" class="form-control" >
                                        <option value=""><?php echo $ocup ?></option>
                                        <option value="Business">Business Man<?php // echo lang('admi_father_occupation_op2'); ?></option>
                                        <option value="Employer">Employer <?php // echo lang('admi_father_occupation_op3'); ?></option>
                                        <option value="Banker">Banker <?php // echo lang('admi_father_occupation_op4'); ?></option>
                                        <option value="Teachers">Teachers <?php // echo lang('admi_father_occupation_op5'); ?></option>
                                        <option value="Farmer">Farmer <?php // echo lang('admi_father_occupation_op6'); ?></option>
                                        <option value="Car Driver">Car Driver <?php // echo lang('admi_father_occupation_op7'); ?></option>
                                        <option value="Other">Other <?php // echo lang('admi_father_occupation_op8'); ?></option>
                                    </select>
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
                            <label class="control-label "><?php echo lang('admi_students_photo');?> <!-- <span class="requiredStar"> * </span> --></label>
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
                         
                            <div class="form-group">
                                <label class="col-md-3 control-label"> PostalAddress <!-- <span class="requiredStar"> * </span> --></label>
                                <div class="col-md-6">
                                    <textarea class="form-control" name="address" rows="3"><?php echo $add; ?></textarea>
                       <!--  data-validation="required" data-validation-error-msg="<?php // echo lang('admi_admi_detailschool_error_msg'); ?>" -->             
                                </div>
                            </div>

                            <div class="form-group ">
                                <label class="col-md-3 control-label"> Phone Number <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control f" name="phone" value="<?php echo $phone ?>" data-validation="required" data-validation-error-msg="<?php echo lang('admi_sect_error_msg'); ?>">
                                </div>
                            </div>
                             
                         <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo lang('tea_sex'); ?><span class="requiredStar"> * </span></label>
                            <div class="col-md-6 marginLeftSex g">
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input type="radio" name="sex" value="Male" id="optionsRadios4" <?php
                                        if ($sex == 'Male') {
                                            echo 'checked';
                                        }
                                        ?>><?php echo lang('tea_male'); ?></label>
                                    <label class="radio-inline">
                                        <input type="radio" name="sex" value="Female" id="optionsRadios5"  <?php
                                        if ($sex == 'Female') {
                                            echo 'checked';
                                        }
                                        ?>> <?php echo lang('tea_female'); ?></label>
                                    
                                </div>
                            </div>
                        </div>
                              
                            <div class="form-group">
                                <label class="col-md-3 control-label">Previous School<span class="requiredStar">  </span></label>
                                <div class="col-md-2">
                                    <H4 class="eduFormTitle"> <?php echo lang('admi_Name'); ?></H4>
                                    <input class="form-control eduForm" name="school_nam1" value="<?php
                                if (!empty($education_1['0'])) {
                                    echo $education_1['0'];
                                }
                                ?>" type="text" placeholder="" data-validation=" " data-validation-error-msg="">
                                    <input class="form-control eduForm" name="school_nam2" value="<?php
                                if (!empty($education_2['0'])) {
                                    echo $education_2['0'];
                                }
                                ?>" type="text" placeholder="" >
                                    <input class="form-control eduForm" name="school_nam3" value="<?php
                                if (!empty($education_3['0'])) {
                                    echo $education_3['0'];
                                }
                                ?>" type="text" placeholder="" > 
                                </div>
                                <div class="col-md-3">
                                    <H4 class="eduFormTitle"> Class</H4>
                                    <input class="form-control eduForm" name="class1" type="text" value="<?php
                                if (!empty($education_1['1'])) {
                                    echo $education_1['1'];
                                }
                                ?>" placeholder="" data-validation=" " data-validation-error-msg="">
                                    <input class="form-control eduForm" name="class2" type="text" value="<?php
                                if (!empty($education_2['1'])) {
                                    echo $education_2['1'];
                                }
                                ?>" placeholder="" >
                                    <input class="form-control eduForm" name="class3" type="text" value="<?php
                                if (!empty($education_3['1'])) {
                                    echo $education_3['1'];
                                }
                                ?>" placeholder="" > 
                                </div>
                                <div class="col-md-2">
                                    <H4 class="eduFormTitle"> Since</H4>
                                    <input class="form-control eduForm date-picker" name="from1" value="<?php
                                if (!empty($education_1['2'])) {
                                    echo $education_1['2'];
                                }
                                ?>" type="text" placeholder="" data-validation=" " data-validation-error-msg="">
                                    <input class="form-control eduForm date-picker" name="from2" value="<?php
                                if (!empty($education_2['2'])) {
                                    echo $education_2['2'];
                                }
                                ?>" type="text" placeholder="" >
                                    <input class="form-control eduForm date-picker" name="from3" type="text" value="<?php
                                if (!empty($education_3['2'])) {
                                    echo $education_3['2'];
                                }
                                ?>" placeholder="" > 
                                </div> 
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"> Particulars of real Brothers/Sisters (if any) already studying in any institution.<span class="requiredStar">  </span></label>
                                <div class="col-md-2">
                                    <H4 class="eduFormTitle"> <?php echo lang('admi_Name'); ?>Child</H4>
                                    <input class="form-control eduForm" name="name1" value="<?php
                                if (!empty($teacher_1['0'])) {
                                    echo $teacher_1['0'];
                                }
                                ?>" type="text" placeholder="" data-validation=" " data-validation-error-msg="">
                                    <input class="form-control eduForm" name="name2" value="<?php
                                if (!empty($teacher_2['0'])) {
                                    echo $teacher_2['0'];
                                }
                                ?>" type="text" placeholder="" >
                                    <input class="form-control eduForm" name="name3" value="<?php
                                if (!empty($teacher_3['0'])) {
                                    echo $teacher_3['0'];
                                }
                                ?>" type="text" placeholder="" > 
                                </div>
                                <div class="col-md-3">
                                    <H4 class="eduFormTitle"> School/College/University</H4>
                                    <input class="form-control eduForm" name="school1" value="<?php
                                if (!empty($teacher_1['1'])) {
                                    echo $teacher_1['1'];
                                }
                                ?>" type="text" placeholder="" data-validation=" " data-validation-error-msg="">
                                    <input class="form-control eduForm" name="school2" value="<?php
                                if (!empty($teacher_2['1'])) {
                                    echo $teacher_2['1'];
                                }
                                ?>" type="text" placeholder="" >
                                    <input class="form-control eduForm" name="school3" value="<?php
                                if (!empty($teacher_3['1'])) {
                                    echo $teacher_3['1'];
                                }
                                ?>" type="text" placeholder="" > 
                                </div>
                                <div class="col-md-2">
                                    <H4 class="eduFormTitle"> Class</H4>
                                    <input class="form-control eduForm " name="clas1" value="<?php
                                if (!empty($teacher_1['2'])) {
                                    echo $teacher_1['2'];
                                }
                                ?>" type="text" placeholder="" data-validation=" " data-validation-error-msg="">
                                    <input class="form-control eduForm " name="clas2" value="<?php
                                if (!empty($teacher_2['2'])) {
                                    echo $teacher_2['2'];
                                }
                                ?>" type="text" placeholder="" >
                                    <input class="form-control eduForm " name="clas3" value="<?php
                                if (!empty($teacher_3['2'])) {
                                    echo $teacher_3['2'];
                                }
                                ?>" type="text" placeholder="" > 
                                </div> 
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">  Particulars of real Brother/Sister (if any) who have applied or applying for admission in school<span class="requiredStar">  </span></label>
                                <div class="col-md-2">
                                    <H4 class="eduFormTitle"> <?php echo lang('admi_Name'); ?>Child</H4>
                                    <input class="form-control eduForm" name="ch_name1" value="<?php
                                if (!empty($teacher_4['0'])) {
                                    echo $teacher_4['0'];
                                }
                                ?>" type="text" placeholder="" data-validation=" " data-validation-error-msg="">
                                    <input class="form-control eduForm" name="ch_name2" value="<?php
                                if (!empty($teacher_5['0'])) {
                                    echo $teacher_5['0'];
                                }
                                ?>" type="text" placeholder="" >
                                    <input class="form-control eduForm" name="ch_name3" value="<?php
                                if (!empty($teacher_6['0'])) {
                                    echo $teacher_6['0'];
                                }
                                ?>" type="text" placeholder="" > 
                                </div>
                                <div class="col-md-2">
                                    <H4 class="eduFormTitle"> Class</H4>
                                    <input class="form-control eduForm" name="cls1" value="<?php
                                if (!empty($teacher_4['1'])) {
                                    echo $teacher_4['1'];
                                }
                                ?>" type="text" placeholder="" data-validation=" " data-validation-error-msg="">
                                    <input class="form-control eduForm" name="cls2" value="<?php
                                if (!empty($teacher_5['1'])) {
                                    echo $teacher_5['1'];
                                }
                                ?>" type="text" placeholder="" >
                                    <input class="form-control eduForm" name="cls3" value="<?php
                                if (!empty($teacher_6['1'])) {
                                    echo $teacher_6['1'];
                                }
                                ?>" type="text" placeholder="" > 
                                </div>
                                <div class="col-md-4">
                                    <H4 class="eduFormTitle"> Registration Number</H4>
                                    <input class="form-control eduForm " name="regnumb1" value="<?php
                                if (!empty($teacher_4['2'])) {
                                    echo $teacher_4['2'];
                                }
                                ?>" type="text" placeholder="" data-validation=" " data-validation-error-msg="">
                                    <input class="form-control eduForm" name="regnumb2" value="<?php
                                if (!empty($teacher_5['2'])) {
                                    echo $teacher_5['2'];
                                }
                                ?>" type="text" placeholder="" >
                                    <input class="form-control eduForm" name="regnumb3" value="<?php
                                if (!empty($teacher_6['2'])) {
                                    echo $teacher_6['2'];
                                }
                                ?>" type="text" placeholder="" > 
                                </div> 
                            </div>
                        
                       
    
                   
                    
                      
                            <div class="form-actions fluid">
                              <div class="col-md-offset-3 col-md-6">
                                <button type="submit" class="btn green btn-lg" name="submit" id="submit_data" value="submit">update</button>
                            <button type="reset" class="btn default"><?php  echo lang('refresh');?></button>
                                 
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
    $.validate();

    jQuery(document).ready(function () {
        if (jQuery().datepicker) {
            $('.date-picker').datepicker({
                rtl: Metronic.isRTL(),
                orientation: "left",
                autoclose: true
            });
            //$('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
        }

        //here is auto reload after 1 second for time and date in the top
        jQuery(setInterval(function () {
            jQuery("#result").load("index.php/home/iceTime");
        }, 1000));
    });
</script>
 
  <script> 
  $(document).ready(function() { 
        $(function() { 
        $("#date").datepicker({
            changeDay: true,
            changeMonth: true,
            changeYear: true,
            yearRange:"2000:2050",
            dateFormat: 'yy-mm-dd'
                    
        }); 
        });   
    });
    $(document).ready(function() { 
        $(function() { 
        $("#due_date").datepicker({
            changeDay: true,
            changeMonth: true,
            changeYear: true,
            yearRange:"2000:2050",
            dateFormat: 'yy-mm-dd'
                    
        }); 
        });   
    }); 
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