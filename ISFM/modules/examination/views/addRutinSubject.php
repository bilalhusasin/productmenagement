<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/jquery_ui_css/jquery-ui.css" />
<!-- BEGIN CONTENT -->
<?php $user = $this->ion_auth->user()->row(); $userId = $user->id;?>
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE CONTENT-->
        
        <div class="row">
            <div class="col-md-12 ">
                <!-- BEGIN SAMPLE FORM PORTLET-->
                <div class="portlet box green ">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-bars"></i> Make Final 
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
                        echo form_open('examination/completExamRoutin', $form_attributs);
                        ?>
                        <div class="form-body">
                            <?php
                            if (!empty($successMessage)) {
                                echo $successMessage;
                            }
                            ?> 
                            <?php
                            foreach ($examInfo as $row) {
                                $id = $row['id'];
                                $examID = $row['id'];
                                $class_id = $row['class_id'];
                                $examTitle = $row['exam_title'];
                                $startDate = $row['start_date'];
                                $startday = $row['day'];
                            }
                           ?>
                            <div class="alert alert-info">
                                <div class="form-group">
                                    <div id="div_scents">
                                        <div class="row">
                                            <div class="col-md-12">
                                        <input type="hidden" name="created_by" value="<?php echo $userId; ?>" readonly="">
                                        <input type="hidden" value="<?php echo $id; ?>" name="id" readonly="">
                                        <input type="hidden" value="<?php echo $examID; ?>" name="examId" readonly="">
                                        <input type="hidden" value="<?php echo $class_id; ?>" name="class_id" readonly="">
                                                <h3 class="arpl"><?php echo lang('exa_exam'); ?> 1</h3>
                                        <input type="hidden" name="examSubjectFild" value="run" readonly="">
                                                <div class="col-md-2 classGroupInput">
                                                    <input type="text" class="form-control" placeholder="<?php echo lang('exa_ddmmyy'); ?>" value="<?php echo $startDate; ?>" name="examDate" readonly="" data-validation="required" data-validation-error-msg="">
                                                </div>
                                                <div class="col-md-2 classGroupInput">
                                                    <input type="text" class="form-control" value="<?php echo $startday; ?>" name="day" readonly="" data-validation="required" data-validation-error-msg="">
                                                    <!-- <select class="form-control" name="day" data-validation="required" data-validation-error-msg="">
                                                        <option value=""><?php echo lang('exa_sd'); ?></option>
                                                        <?php foreach ($weeklyDay as $row2) { ?>
                                                            <option class="<?php echo $row2['status']; ?>" value="<?php echo $row2['day_name']; ?>"><?php echo $row2['day_name']; ?></option>
                                                        <?php } ?>
                                                    </select> -->
                                                </div>
                                                <div class="col-md-2 classGroupInput">
                                                    <select class="form-control" name="subject" data-validation="required" data-validation-error-msg="">
                                                        <option><?php echo lang('exa_ss'); ?></option>
                                                        <?php foreach ($subject as $row1) { ?>
                                                            <option value="<?php echo $row1['subject_title']; ?>"><?php echo $row1['subject_title']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                
                                                <div class="col-md-2 classGroupInput">
                                                    <input type="text" class="form-control" placeholder="<?php echo lang('exa_rnih'); ?>" name="romeNo" data-validation="required" data-validation-error-msg="">
                                                </div>
                                                <div class="col-md-2 classGroupInput">
                                                    <input type="text" class="form-control" placeholder="<?php echo lang('exa_start_time'); ?>" name="starTima" data-validation="required" data-validation-error-msg="">
                                                </div>
                                                <div class="col-md-2 classGroupInput">
                                                    <input type="text" class="form-control" placeholder="<?php echo lang('exa_end_time'); ?>" name="endTima" data-validation="required" data-validation-error-msg="">
                                                </div>
                                                <div class="col-md-2 classGroupInput">
                                                    <select class="form-control" name="examShift">
                                                        <option><?php echo lang('exa_sele_shi'); ?></option>
                                                        <option><?php echo lang('exa_morn_shi'); ?></option>
                                                        <option><?php echo lang('exa_even_shi'); ?></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="addRoutineSubject col-md-12">
                                    <a id="addGroup" class="floatRight btn green" >
                                        <i class="fa fa-plus"></i> <?php echo lang('exa_nexar'); ?>
                                    </a>
                                </div><div class="clearfix"> </div>
                            </div>
                        </div>
                        <div class="form-actions fluid">
                            <div class="col-md-offset-3 col-md-6">
                                <button type="submit" class="btn green" name="submit" value="Submit"><?php echo lang('save'); ?></button>
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
<script src="assets/global/plugins/jquery.form-validator.min.js" type="text/javascript"></script>
<script type="text/javascript" src="assets/global/plugins/jquery.input-ip-address-control-1.0.min.js"></script>
    <script type="text/javascript" src="assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js"></script>
    <script src="assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>
    <script src="assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript"></script>
    <script src="assets/global/plugins/typeahead/handlebars.min.js" type="text/javascript"></script>
    <script src="assets/global/plugins/typeahead/typeahead.bundle.min.js" type="text/javascript"></script>
    <script src="assets/admin/pages/scripts/components-form-tools.js"></script>
 
<script> $.validate();</script>
<script>
    $(function () {
        var maxFild = 15;
        var scntDiv = $('#div_scents');
        var i = $('#div_scents').size() + 1;

        var x = 1;
        $('#addGroup').live('click', function () {
            if (x < maxFild) {
                x++;
                $('<div id="remove" class="classGroupInput" ><hr><h3 class="arpl"><?php echo lang('exa_exam'); ?> ' + i + '</h3><input type="hidden" class="form-control" name="examSubjectFild_' + i + '" value="run"><div class="row"><div class="col-md-12"><div class="col-md-2 classGroupInput">'+
                  '<input type="text" class="form-control date-picker" onclick="ajaxdate(this.id)" id="mask_date' + i + '" placeholder="<?php echo lang('exa_ddmmyy'); ?>" name="examDate_' + i + '" data-validation="required" data-validation-error-msg="">'+
                  '</div>\n\<div class="col-md-2 classGroupInput">'+
                  '<input type="text" class="form-control" id="ajaxday' + i + '" name="day_' + i + '" readonly="" placeholder="Exam Day"></div>'+
                  '<div class="col-md-2 classGroupInput"><select class="form-control" name="subject_' + i + '"><option><?php echo lang('exa_ss'); ?></option><?php foreach ($subject as $row1) { ?><option value="<?php echo $row1["subject_title"]; ?>"><?php echo $row1["subject_title"]; ?></option><?php } ?></select></div><div class="col-md-2 classGroupInput"><input type="text" class="form-control" placeholder="<?php echo lang('exa_rnih'); ?>" name="romeNo_' + i + '" data-validation="required" data-validation-error-msg=""></div><div class="col-md-2 classGroupInput"><input type="text" class="form-control" placeholder="<?php echo lang('exa_start_time'); ?>" name="starTima_' + i + '" data-validation="required" data-validation-error-msg=""></div><div class="col-md-2 classGroupInput"><input type="text" class="form-control" placeholder="<?php echo lang('exa_end_time'); ?>" name="endTima_' + i + '" data-validation="required" data-validation-error-msg=""></div><div class="col-md-2 classGroupInput"><select class="form-control" name="examShift_' + i + '"><option><?php echo lang('exa_sele_shi'); ?></option><option><?php echo lang('exa_morn_shi'); ?></option><option><?php echo lang('exa_even_shi'); ?></option></select></div></div></div><a href="#" id="remGroup" class="arplremove">Remove</a></div>').appendTo(scntDiv);
                i++;
                return false;
            }
        });

        $('#remGroup').live('click', function () {
            if (i > 2) {
                $(this).parents('#remove').remove();
                i--;
                x--;
            }
            return false;
        });
    });
</script> 
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
   function ajaxdate(id) {
  //alert(id);
    var a=id.slice(-1);
    //alert (a);
    $(".date-picker").datepicker({
      onSelect: function(date){
      var dayNames = ["Sunday","Monday","Tuesday","Wednesday","Thursday", "Friday","Saturday"];
      var d=new Date(date).getDay();
      $('#ajaxday'+a).val(dayNames[d]);
    },
    dateFormat:'yy-mm-dd',
    changeDay: true,
    changeMonth: true,
    changeYear: true,
    yearRange:"2020:2050"
    }) .focus();
  }
  </script> 
