<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/jquery_ui_css/jquery-ui.css" />
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE CONTENT-->
       


       
        <div class="row">
            <div class="col-md-12 "><ul class="ver-inline-menu" style="width: 12%">
                 <li>
                            <a href="javascript:history.back()">
                                <i class="fa fa-mail-reply-all"></i> <?php echo lang('back'); ?> </a>
                        </li>
                    </ul>
                <!-- BEGIN SAMPLE FORM PORTLET-->
                <div class="portlet box green ">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-bars"></i> Edit Final Exam Sheet 
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
                        echo form_open('examination/updatexam', $form_attributs);
                        ?>
                        <div class="form-body">
                            <?php
                            if (!empty($successMessage)) {
                                echo $successMessage;
                            }
                            ?> 
                            <div class="alert alert-info">
                                <div class="form-group">
                                    <div id="div_scents">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <?php foreach ($routine as $row2){
                                                    $id = $row2['id'];
                                                    $examId = $row2['exam_id'];
                                                    $class_id = $row2['class_id'];
                                                    $subject = $row2['exam_subject'];
                                                    $date = $row2['exam_date'];
                                                    $room = $row2['rome_number'];
                                                    $day = $row2['day'];
                                                    $start = $row2['start_time'];
                                                    $end = $row2['end_time'];
                                                    $shift = $row2['exam_shift'];
                                                    $type = $row2['type'];


                                                 ?>
                                                  <input type="hidden" class="form-control" name="id" value="<?php echo $id ?>">
                                                  <input type="hidden" class="form-control" name="exam_id" value="<?php echo $examId ?>">
                                                  <input type="hidden" class="form-control" name="class_id" value="<?php echo $class_id ?>">
                                                <input type="hidden" class="form-control" name="examSubjectFild" value="run">
                                                <div class="col-md-2 classGroupInput">
                                                    <input type="text" id="mask_date2" class="form-control" placeholder="<?php echo lang('exa_ddmmyy'); ?>" value="<?php echo $date; ?>" name="examDate" data-validation="required" data-validation-error-msg="">
                                                </div>
                                                <div id="ajaxResult"></div>
                                                <div class="col-md-2 classGroupInput">
                                                    
                                                    <input type="text" class="form-control" id="day" value="<?php echo $day; ?>" name="day" readonly>
                                                    
                                                </div>

                                                <div class="col-md-2 classGroupInput">
                                                    <select class="form-control" name="subject" data-validation="required" data-validation-error-msg="">
                                                        <option><?php echo $subject; ?></option>
                                                        <?php foreach ($subject as $row1) { ?>
                                                            <option value="<?php echo $row1['subject_title']; ?>"><?php echo $row1['subject_title']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 classGroupInput">
                                                    <input type="text" class="form-control" placeholder="<?php echo lang('exa_rnih'); ?>" name="romeNo" value="<?php echo $room; ?>" data-validation="required" data-validation-error-msg="">
                                                </div>
                                                <div class="col-md-2 classGroupInput"> <select class="form-control" name="starTima">
                                                        <option><?php echo $start ?></option>
                                                        <option value="12:00-AM">12:00-AM</option>
                                                        <option value="01:00-AM">01:00-AM</option>
                                                        <option value="02:00-AM">02:00-AM</option>
                                                        <option value="03:00-AM">03:00-AM</option>
                                                        <option value="04:00-AM">04:00-AM</option>
                                                        <option value="05:00-AM">05:00-AM</option>
                                                        <option value="06:00-AM">06:00-AM</option>
                                                        <option value="07:00-AM">07:00-AM</option>
                                                        <option value="08:00-AM">08:00-AM</option>
                                                        <option value="09:00-AM">09:00-AM</option>
                                                        <option value="10:00-AM">10:00-AM</option>
                                                        <option value="11:00-AM">11:00-AM</option>
                                                        <option value="12:00-PM">12:00-PM</option>
                                                        <option value="01:00-PM">01:00-PM</option>
                                                        <option value="02:00-PM">02:00-PM</option>
                                                        <option value="03:00-PM">03:00-PM</option>
                                                        <option value="04:00-PM">04:00-PM</option>
                                                        <option value="05:00-PM">05:00-PM</option>
                                                        <option value="06:00-PM">06:00-PM</option>
                                                        <option value="07:00-PM">07:00-PM</option>
                                                        <option value="08:00-PM">08:00-PM</option>
                                                        <option value="09:00-PM">09:00-PM</option>
                                                        <option value="10:00-PM">10:00-PM</option>
                                                        <option value="11:00-PM">11:00-PM</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 classGroupInput">
                                                    <select class="form-control" name="endTima">
                                                        <option><?php echo $end ; ?></option>
                                                        <option value="12:00-AM">12:00-AM</option>
                                                        <option value="01:00-AM">01:00-AM</option>
                                                        <option value="02:00-AM">02:00-AM</option>
                                                        <option value="03:00-AM">03:00-AM</option>
                                                        <option value="04:00-AM">04:00-AM</option>
                                                        <option value="05:00-AM">05:00-AM</option>
                                                        <option value="06:00-AM">06:00-AM</option>
                                                        <option value="07:00-AM">07:00-AM</option>
                                                        <option value="08:00-AM">08:00-AM</option>
                                                        <option value="09:00-AM">09:00-AM</option>
                                                        <option value="10:00-AM">10:00-AM</option>
                                                        <option value="11:00-AM">11:00-AM</option>
                                                        <option value="12:00-PM">12:00-PM</option>
                                                        <option value="01:00-PM">01:00-PM</option>
                                                        <option value="02:00-PM">02:00-PM</option>
                                                        <option value="03:00-PM">03:00-PM</option>
                                                        <option value="04:00-PM">04:00-PM</option>
                                                        <option value="05:00-PM">05:00-PM</option>
                                                        <option value="06:00-PM">06:00-PM</option>
                                                        <option value="07:00-PM">07:00-PM</option>
                                                        <option value="08:00-PM">08:00-PM</option>
                                                        <option value="09:00-PM">09:00-PM</option>
                                                        <option value="10:00-PM">10:00-PM</option>
                                                        <option value="11:00-PM">11:00-PM</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 classGroupInput">
                                                    <select class="form-control" name="examShift">
                                                        <option><?php echo $shift; ?></option>
                                                        <option><?php echo lang('exa_morn_shi'); ?></option>
                                                        <option><?php echo lang('exa_even_shi'); ?></option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 classGroupInput">
                                                    <select onchange="selectClass(this.value)" class="form-control" name="type">
                                                        <option><?php echo $type; ?></option>
                                                        <option value="oral">Oral</option>
                                                        <option value="written">Written</option>
                                                    </select>
                                                </div><div class="clearfix"> </div>
                                                
                                            <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                 <div class="clearfix"> </div>
                            </div>
                        </div>
                        <div class="form-actions fluid">
                            <div class="col-md-offset-3 col-md-6">
                                <button type="submit" class="btn green" name="submit" value="Submit">Update</button>
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
  $( function() {
    $( "#mask_date2" ).datepicker({
      dateFormat: 'dd-mm-yy',
      altField: "#day",
      altFormat: "DD"
    });
  } );
  </script>
<script>
    function selectClass(str) {
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
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                document.getElementById("ajaxResult").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "index.php/examination/ajaxoraldate?q=" + str, true);
        xmlhttp.send();
    }
</script>
    

