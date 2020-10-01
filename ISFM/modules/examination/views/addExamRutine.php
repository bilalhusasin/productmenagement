<!-- BEGIN PAGE LEVEL STYLES -->
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
                <h3 class="page-title"><?php echo lang('header_cr_ex_ro'); ?><small></small>
                </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <?php echo lang('home'); ?>
                    </li>
                    <li>
                        <?php echo lang('header_academic'); ?>
                    </li>
                    <li>
                        <?php echo lang('header_examina'); ?>
                    </li>
                    <li>
                        <?php echo lang('header_cr_ex_ro'); ?>
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
                            <i class="fa fa-bars"></i> <?php echo lang('exa_anewc'); ?>
                        </div>
                        <div class="tools">
                            <a href="" class="collapse">
                            </a>
                            <a href="" class="reload">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <?php
                        $form_attributs = array('class' => 'form-horizontal', 'role' => 'form');
                        echo form_open('examination/addExam', $form_attributs);
                        ?>
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label"> <?php echo lang('exa_etit'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="" name="examTitle" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3"> <?php echo lang('exa_start_date'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-4">
                                    <input class="form-control" id="maskdate" type="text" name="startDate" placeholder="yyyy-mm-dd" required="">
                                     
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"> Start Day<span class="requiredStar"> * </span></label>
                                <div class="col-md-6 classGroupInput">
                                    <input type="text" class="form-control" id="dayname" name="weekdays" required="" readonly="">
                                </div>
                            </div> 
                            <div class="form-group">
                                <label class="col-md-3 control-label"> <?php echo lang('exa_class'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <select class="form-control" name="class_id" required="required" onchange="selectClass(this.value)">
                                        <option value=""><?php echo lang('select'); ?></option>
                                        <?php foreach ($s_class as $row) { ?>
                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['class_title']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div id="ajaxResult"></div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"> <?php echo lang('exa_total_time'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-6 classGroupInput">
                                    <select class="form-control" name="totleTime" required="">
                                        <option><?php echo lang('select'); ?></option>
                                        <option><?php echo lang('exa_30min'); ?></option>
                                        <option><?php echo lang('exa_1h'); ?></option>
                                        <option><?php echo lang('exa_1h30m'); ?></option>
                                        <option><?php echo lang('exa_2h'); ?></option>
                                        <option><?php echo lang('exa_2h30m'); ?></option>
                                        <option><?php echo lang('exa_3h'); ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"> <?php echo lang('exa_iife'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-6 radio-list">
                                  <label class="radio-inline">
                                    <input type="radio" name="final" id="optionsRadios4" value="Final" > <?php echo lang('exa_yes'); ?> </label>
                                  <label class="radio-inline">
                                    <input type="radio" name="final" id="optionsRadios5" value="NoFinal" checked> <?php echo lang('exa_no'); ?> </label>
                                </div>
                            </div>
                            <div class="form-actions fluid">
                                <div class="col-md-offset-3 col-md-6">
                                    <button type="submit" class="btn green" name="submit" value="Submit"><?php echo lang('exa_crear'); ?></button>
                                    <button type="reset" class="btn default"><?php echo lang('refresh'); ?></button>
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
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script type="text/javascript" src="assets/global/plugins/jquery.input-ip-address-control-1.0.min.js"></script>
    <script type="text/javascript" src="assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js"></script>
    <script src="assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>
    <script src="assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript"></script>
    <script src="assets/global/plugins/typeahead/handlebars.min.js" type="text/javascript"></script>
    <script src="assets/global/plugins/typeahead/typeahead.bundle.min.js" type="text/javascript"></script>
    <script src="assets/admin/pages/scripts/components-form-tools.js"></script>
   
    <script>
        jQuery(document).ready(function () {
            ComponentsFormTools.init();
        });
    </script>
    <script type="text/javascript">
        var RecaptchaOptions = {
            theme: 'custom',
            custom_theme_widget: 'recaptcha_widget'
        };

        jQuery(document).ready(function () {
            //here is auto reload after 1 second for time and date in the top
            jQuery(setInterval(function () {
                jQuery("#result").load("index.php/home/iceTime");
            }, 1000));
        });
    </script>
    <script>
$(function() {
  $('#maskdate').datepicker({
    onSelect: function(date){
      var dayNames = ["Sunday","Monday","Tuesday","Wednesday","Thursday", "Friday","Saturday"];
      var d=new Date(date).getDay();
      $('#dayname').val(dayNames[d]);
    },
    dateFormat:'yy-mm-dd',
    changeDay: true,
    changeMonth: true,
    changeYear: true,
    yearRange:"2020:2050"
  })
});
</script>
     
    <script>
    function selectClass(str) {
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
        xmlhttp.open("GET", "index.php/examination/ajaxSelectClass?q=" + str, true);
        xmlhttp.send();
    }
    </script>
