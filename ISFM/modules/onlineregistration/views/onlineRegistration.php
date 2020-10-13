<!DOCTYPE html>
<html lang="en" >
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8"/>
        <title><?php echo lang('system_title'); ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <meta content="BFTech | Beyond Future Technologies" name="description"/>
        <meta content="BFTech" name="author"/>

        <!--Base tag start-->
        <base href="<?php echo $this->config->base_url(); ?>">
        <!--Base tag end-->

        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
        <link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
        <link href="assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN THEME STYLES -->
        <link href="assets/global/css/components.css" rel="stylesheet" type="text/css"/>
        <link href="assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
        <link href="assets/admin/layout/css/layout.min.css" rel="stylesheet" type="text/css"/>
        <link id="style_color" href="assets/admin/layout/css/themes/default.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
        <!-- END THEME STYLES -->
        <link rel="shortcut icon" href="favicon.ico"/>
        <script src="assets/global/plugins/jquery-1.11.0.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>

    </head>
    <!-- END HEAD -->
    <!-- BEGIN BODY -->
    <body class="page-header-fixed page-quick-sidebar-over-content page-header-fixed-mobile page-footer-fixed1">
        <!-- BEGIN HEADER -->
<!--BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/jquery_ui_css/jquery-ui.css" />
<!-- END PAGE LEVEL STYLES -->
<?php // $user = $this->ion_auth->user()->row(); $userId = $user->id;?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content"> 
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12 ">
                <!-- BEGIN SAMPLE FORM PORTLET-->
                <div class="portlet box green ">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-bars"></i> <?php echo lang('admi_form_title'); ?>
                        </div>
                         
                    </div>
                    <div class="portlet-body form">
                        <?php $form_attributs = array('class' => 'form-horizontal', 'role' => 'form', 'name' => 'myForm', 'onsubmit' => 'return validateForm()');
                        echo form_open_multipart('onlineregistration/reg', $form_attributs);
                        ?>
                        <div class="form-body">
                            <?php
                            $this->load->helper("display_message_helper");
                            echo error_message('alert');
                            // if (!empty($success)) {
                            //     //echo $success;

                            // } 
                            ?>
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
                    <input type="hidden" name="created_by" value="<?php echo $userId; ?>">
                        <div class="row" style="margin-left: 5%">
                            <div class="col-md-4"> 
                              <div class="form-group">
                                <div class="col-md-8" >
                                     Registration Number 
                                    <input type="text" class="form-control a" name="regnum" value="<?php echo $auto_reg_number; ?>" readonly="">
                                </div>
                              </div>
                            </div>
                            <div class="col-md-4"> 
                              <!-- <div class="form-group"> 
                                <div class="col-md-6">
                                      Date Of Registration<span class="requiredStar"> * </span>
                                    <input type="text" class="form-control" name="date" id="date" placeholder="yyyy-mm-dd">
                                </div>
                              </div> -->
                              <?php if(!empty($session_fee)){echo '<span class="label label-sm label-success">Online  Registration Open</span>';} else{echo '<span class="label label-sm label-danger"> Please Set The Registration Fee First</span>';}?>
                            </div>
                            <div class="col-md-4"> 
                              <div class="form-group">  
                                <div class="col-md-6">
                                     Due Date For Fee<span class="requiredStar"> * </span>
                                    <input type="text" class="form-control" name="due_date" id="due_date" placeholder="yyyy-mm-dd">
                                </div>
                              </div>
                            </div> 
                        </div>
                        <div id="div1" <?php if(!empty($session_fee)){echo "";} else{ echo "hidden";}?> > 
                            <hr>
                        <h3 style="padding-left: 4%; font-weight: 700;">Student Information </h3> 
                    <div class="row"> 
                        <div class="col-md-9 col-sm-12" style="padding-left: 8%"> 
                            <div class="form-group">
                                <label class="col-md-3 control-label">Academic Session <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <input onchange="selectSession(this.value);" type="text" class="form-control a" id="session" value="<?php echo date('Y');?>"  readonly="">
                                    <div id="ajaxResult"></div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                            <label class="col-md-3 control-label"> <?php echo lang('stu_sel_cla_Class'); ?><span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <select onchange="classSection(this.value)"  class="form-control" name="class" data-validation="required" data-validation-error-msg="">
                                        <option value=""><?php echo lang('stu_sel_cla_select'); ?></option>
                                    <?php foreach ($s_class as $row) { ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['class_title']; ?></option>
                                    <?php } ?>
                                    </select>                                 
                                </div>  
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo lang('admi_FirstName'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control a" name="first_name" data-validation="required" data-validation-error-msg="<?php echo lang('admi_firstName_error_msg'); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo lang('admi_LastName'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control b" placeholder="" name="last_name" data-validation="required" data-validation-error-msg="<?php echo lang('admi_LastName_error_msg'); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3"><?php echo lang('admi_DateOfBirth'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-4">
                                    <input class="form-control c" name="birthdate" id="birthdate" placeholder="yyyy-mm-dd" type="text" >
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Student B-Form Number <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control d" name="bfnumb" placeholder="" data-validation="required" data-validation-error-msg="enter B-form Number">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"> Father Name <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control d" name="father_name" placeholder="" data-validation="required" data-validation-error-msg="Enter Father Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Father CNIC <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control e" name="father_cnic" placeholder="" data-validation="required" data-validation-error-msg="<?php echo lang('admi_nationality_error_msg'); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"> Father Occupation <?php // echo lang('admi_Mother_occup'); ?></label>
                                <div class="col-md-6">
                                    <select name="father_occupation" class="form-control" >
                                        <option value=""><?php echo lang('admi_father_occupation_op1'); ?></option>
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
                        <div class="col-md-3 col-sm-12" >
                            <label class="control-label " style="padding-left: 8%"><?php echo lang('admi_students_photo');?> <!-- <span class="requiredStar"> * </span> --></label>
                            <div class="form-group last">
                                
                                <div class="" style="padding-left: 8%">
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
                                <label class="col-md-3 control-label"> Postal Address <!-- <span class="requiredStar"> * </span> --></label>
                                <div class="col-md-6">
                                    <textarea class="form-control" name="address" rows="3"></textarea>             
                                </div>
                            </div>

                            <div class="form-group ">
                                <label class="col-md-3 control-label"> Phone Number <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control f" name="phone" placeholder="" data-validation="required" data-validation-error-msg="<?php echo lang('admi_sect_error_msg'); ?>">
                                </div>
                            </div>
                             
                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php  echo lang('admi_Sex'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-4 marginLeftSex">
                                    <div class="radio-list">
                                        <label class="radio-inline">
                                            <input type="radio" name="sex" id="optionsRadios4" class="g" value="Male" data-validation="required" data-validation-error-msg="<?php echo lang('admi_sex_error_msg'); ?>"> <?php  echo lang('admi_Male'); ?></label>
                                        <label class="radio-inline">
                                            <input type="radio" name="sex" id="optionsRadios5" class="g" value="Female"> <?php echo lang('admi_Female'); ?> </label>
                                        
                                    </div>
                                </div>
                            </div>
                           
                              
                            <div class="form-group">
                                <label class="col-md-3 control-label">Previous School<span class="requiredStar">  </span></label>
                                <div class="col-md-2">
                                    <H4 class="eduFormTitle"> <?php echo lang('admi_Name'); ?></H4>
                                    <input class="form-control eduForm" name="school_nam1" type="text" placeholder="" data-validation=" " data-validation-error-msg="">
                                    <input class="form-control eduForm" name="school_nam2" type="text" placeholder="" >
                                    <input class="form-control eduForm" name="school_nam3" type="text" placeholder="" > 
                                </div>
                                <div class="col-md-3">
                                    <H4 class="eduFormTitle"> Class</H4>
                                    <input class="form-control eduForm" name="class1" type="text" placeholder="" data-validation=" " data-validation-error-msg="">
                                    <input class="form-control eduForm" name="class2" type="text" placeholder="" >
                                    <input class="form-control eduForm" name="class3" type="text" placeholder="" > 
                                </div>
                                <div class="col-md-2">
                                    <H4 class="eduFormTitle"> Since</H4>
                                    <input class="form-control eduForm date-picker" name="from1" type="text" placeholder="" data-validation=" " data-validation-error-msg="">
                                    <input class="form-control eduForm date-picker" name="from2" type="text" placeholder="" >
                                    <input class="form-control eduForm date-picker" name="from3" type="text" placeholder="" > 
                                </div> 
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"> Particulars of real Brothers/Sisters (if any) already studying in any institution.<span class="requiredStar">  </span></label>
                                <div class="col-md-2">
                                    <H4 class="eduFormTitle"> <?php echo lang('admi_Name'); ?>Child</H4>
                                    <input class="form-control eduForm" name="name1" type="text" placeholder="" data-validation=" " data-validation-error-msg="">
                                    <input class="form-control eduForm" name="name2" type="text" placeholder="" >
                                    <input class="form-control eduForm" name="name3" type="text" placeholder="" > 
                                </div>
                                <div class="col-md-3">
                                    <H4 class="eduFormTitle"> School/College/University</H4>
                                    <input class="form-control eduForm" name="school1" type="text" placeholder="" data-validation=" " data-validation-error-msg="">
                                    <input class="form-control eduForm" name="school2" type="text" placeholder="" >
                                    <input class="form-control eduForm" name="school3" type="text" placeholder="" > 
                                </div>
                                <div class="col-md-2">
                                    <H4 class="eduFormTitle"> Class</H4>
                                    <input class="form-control eduForm " name="clas1" type="text" placeholder="" data-validation=" " data-validation-error-msg="">
                                    <input class="form-control eduForm " name="clas2" type="text" placeholder="" >
                                    <input class="form-control eduForm " name="clas3" type="text" placeholder="" > 
                                </div> 
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">  Particulars of real Brother/Sister (if any) who have applied or applying for admission in school<span class="requiredStar">  </span></label>
                                <div class="col-md-2">
                                    <H4 class="eduFormTitle"> <?php echo lang('admi_Name'); ?>Child</H4>
                                    <input class="form-control eduForm" name="ch_name1" type="text" placeholder="" data-validation=" " data-validation-error-msg="">
                                    <input class="form-control eduForm" name="ch_name2" type="text" placeholder="" >
                                    <input class="form-control eduForm" name="ch_name3" type="text" placeholder="" > 
                                </div>
                                <div class="col-md-2">
                                    <H4 class="eduFormTitle"> Class</H4>
                                    <input class="form-control eduForm" name="cls1" type="text" placeholder="" data-validation=" " data-validation-error-msg="">
                                    <input class="form-control eduForm" name="cls2" type="text" placeholder="" >
                                    <input class="form-control eduForm" name="cls3" type="text" placeholder="" > 
                                </div>
                                <div class="col-md-4">
                                    <H4 class="eduFormTitle"> Registration Number</H4>
                                    <input class="form-control eduForm " name="regnumb1" type="text" placeholder="" data-validation=" " data-validation-error-msg="">
                                    <input class="form-control eduForm" name="regnumb2" type="text" placeholder="" >
                                    <input class="form-control eduForm" name="regnumb3" type="text" placeholder="" > 
                                </div> 
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"> How Did You Came To Know Us</label>
                                <div class="col-md-9">
                                    <div class="checkbox-list">
                                        <label>
                                            <input type="checkbox" name="nw" value="news paper"> News Paper </label>
                                        <label>
                                            <input type="checkbox" name="bb" value="bilboards"> Bilboards</label>
                                        <label>
                                            <input type="checkbox" name="strem" value="streamers"> Streamers </label>
                                        <label>
                                            <input type="checkbox" name="flyer" value="flayers"> Flyers/Pamphlets </label>
                                        <label>
                                            <input type="checkbox" name="mouth" value="word of mouth">  Words of Mouth  </label>
                                            <label>
                                            <input type="checkbox" name="other" value="other"> Other</label>
                                    </div>
                                </div>
                            </div>   
                            <div class="form-actions fluid">
                              <div class="col-md-offset-3 col-md-6">
                                <button type="submit" class="btn green btn-lg" name="submit" id="submit_data" value="submit"><?php echo lang('save');?></button>
                                <button type="reset" class="btn default"><?php  echo lang('refresh');?></button>
                                 
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


<!-- End FOOTER -->
<!-- Start Javasceipt -->
<!-- Start Common Script For All System -->
<script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script type="text/javascript" src="assets/global/plugins/select2/select2.min.js"></script>
<script src="assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<!-- Start Common Script For All System -->
<script>
    jQuery(document).ready(function() {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        QuickSidebar.init() // init quick sidebar
        TableAdvanced.init();
    });
</script>
<!-- End javasceipt -->

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
  <script>
    $('#yearPicker').datetimepicker({
        format      :   "YYYY",
        viewMode    :   "years", 
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
  <!-- <script>
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
      
  </script> -->
  <!-- <script>
    $(document).ready(function(){
    //form ma lagy huvy button ko disable krny k lia code
  jQuery("#submit_data").prop('disabled', true);
  var toValidate = jQuery('.ln, .lr, .lq, .la, .lp, .lo, .lm'), 
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
      
  </script> -->
<script>
/*$(document).ready(function(){
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
}); */
// 
   // form ko hide and show krny k liya code  
  /*$("#btn_hidde").click(function(){
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
   
});*/
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
    function selectSession(str) {
        var xmlhttp;
        if (str.length === 0) {
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
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
        document.getElementById("ajaxResult").innerHTML = xmlhttp.responseText;
        }
        };
        xmlhttp.open("GET", "index.php/users/reg_session_fee?q=" + str, true);
        xmlhttp.send();
    }
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
    });
</script>
<!-- END PAGE LEVEL script-->

</body>
<!-- End BODY -->
</html>