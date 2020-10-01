<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="assets/global/plugins/select2/select2.css"/>
<link href="assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<!-- BEGIN THEME STYLES -->
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                    <?php echo lang('att_employ_att'); ?> <small></small>
                </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <?php echo lang('home'); ?>
                    </li>
                    <li>
                        <?php echo lang('header_hrm'); ?>
                    </li>
                    <li>
                        <?php echo lang('header_employ_atten'); ?>
                    </li>
                    <li>
                        <?php echo lang('header_tak_emplo_atte'); ?>
                    </li>
                    <li id="result" class="pull-right topClock"></li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <?php // foreach($teacher as $tea){ $tid = $tea['id']; } ?>
        <?php // $te = $this->attendancemodule->teach($tid); ?>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <?php echo lang('att_eaiah'); ?>
                        </div>
                        <div class="tools">
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <?php
                        $form_attributs = array('class' => 'form-horizontal', 'role' => 'form');
                        echo form_open('dailyAttendance/teacherAttendance', $form_attributs);
                        ?>
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">Select User Group</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                        <select onchange="selectUserGroup(this.value)" name="groups" class="form-control select2me" data-placeholder="" required="required">
                                            <option value=""><?php echo lang('select'); ?></option>
                                            <?php  foreach ($group_title as $row1){?>
                                                <option value="<?php echo $row1['id']; ?>"><?php  echo $row1['name']; ?></option>
                                            <?php  } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="ajaxResult">
                        </div>
                        <!-- <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3"><?php echo lang('att_selemploy');?></label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <select name="teacher" class="form-control select2me" data-placeholder="" required>
                                            <option value=""><?php echo lang('select'); ?></option>
                                            <?php  foreach ($teacher as $row){?>
                                                <option value="<?php echo $row['user_id']; ?>"><?php  echo $row['full_name']; ?></option>
                                            <?php  } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">Status</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-check-square-o"></i>
                                        </span>
                                        <select name="presAbsent" class="form-control select2me" required>
                                            <option value="Absent"><?php echo lang('att_absent'); ?></option>
                                            <option value="Present"><?php echo lang('att_present'); ?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions fluid">
                            <div class="col-sm-offset-3 col-md-9">
                                <button class="btn blue" type="submit" name="submit" value="Submit"><?php echo lang('att_submit'); ?></button>
                                <button class="btn default" type="reset"><?php echo lang('refresh'); ?></button>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                        <!-- END FORM-->
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
        <!-- END PAGE CONTENT-->
    </div>
</div>
<!-- END CONTENT -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="assets/global/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script src="assets/admin/pages/scripts/components-dropdowns.js"></script>

<script>
    jQuery(document).ready(function () {
        //here is auto reload after 1 second for time and date in the top
        jQuery(setInterval(function () {
            jQuery("#result").load("index.php/home/iceTime");
        }, 1000));
    });
    function selectUserGroup(str) {
        var xmlhttp;
        if (str.length == 0) {
        document.getElementById("ajaxResult").innerHTML = "";
        return;
    }
        if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
        } else {
    // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            document.getElementById("ajaxResult").innerHTML = xmlhttp.responseText;
        }
        }
    xmlhttp.open("GET", "index.php/dailyAttendance/selectUsergroup?q=" + str, true);
    xmlhttp.send();
    }
</script>
