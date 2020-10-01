<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>
<!-- END PAGE LEVEL STYLES -->
<?php $user = $this->ion_auth->user()->row(); 
$userId = $user->id;?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                    Extend Due Date  <small></small>
                </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <?php echo lang('home'); ?>
                    </li>
                    <li>
                        <?php echo lang('header_account'); ?>
                    </li>
                    <li>
                        Extend Due Date
                    </li>
                    <li id="result" class="pull-right topClock"></li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB--> 
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet box green">
                            <div class="portlet-title">
                                <div class="caption">
                                    Change Due Date
                                </div>
                                <div class="tools">
                                    <a class="collapse" href="javascript:;">
                                    </a>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <div class="col-md-6">
                                    <div class="portlet box purple margin-bottom-15">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                Select Due Date
                                            </div>
                                            <div class="tools">
                                                <a class="collapse" href="javascript:;">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="portlet-body form">
                                            <!-- BEGIN FORM-->
                                            <?php
                                            $form_attributs = array('class' => 'form-horizontal', 'role' => 'form');
                                            echo form_open('account/changeDueDate', $form_attributs);
                                            ?>
                                            <div class="form-body">
                                                <?php
                                                if (!empty($message)) {
                                                    echo '<br>' . $message;
                                                }
                                                ?>  
                <div class="form-group">
                    <label class="col-md-3 control-label"> Select Date<span class="requiredStar"> * </span></label>
                    <div class="col-md-9 ">
                        <div class="input-group input-large date-picker input-daterange" data-date="" data-date-format="yyyy-mm-dd">
                            <input id="date0ne" type="text" class="form-control" name="due_date" value="<?php echo $due_date; ?>">  
                        </div> 
                                                    <!-- /input-group -->
                        <span class="help-block"><?php echo lang('acc_seledr'); ?></span>
                    </div>
                </div>  
                <input type="hidden" name="std_id" value="<?php echo $std_id; ?>" readonly="">
                <input type="hidden" name="class_id" value="<?php echo $class_id; ?>" readonly="">
                <input type="hidden" name="voch_no" value="<?php echo $voch_no; ?>" readonly="">
                <input type="hidden" name="month" value="<?php echo $month; ?>" readonly="">
                <input type="hidden" name="year" value="<?php echo $year; ?>" readonly=""> 
                <input type="hidden" name="created_by" value="<?php echo $userId; ?>" readonly=""> 
                                                <div class="form-actions bottom fluid ">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <button class="btn green" name="submit" type="submit" value="submit">Submit</button>
                                                        <button class="btn red" type="reset"><?php echo lang('refresh'); ?></button>
                                                    </div>
                                                </div>
                                                <?php echo form_close(); ?>
                                                <!-- END FORM-->
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script type="text/javascript" src="assets/global/plugins/bootstrap-daterangepicker/moment.min.js"></script>
    <script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script type="text/javascript" src="assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/admin/pages/scripts/components-pickers.js"></script>
    <script type="text/javascript" src="assets/global/plugins/select2/select2.min.js"></script>
    <script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
    <script type="text/javascript" src="assets/global/plugins/datatables/extensions/Scroller/js/dataTables.scroller.min.js"></script>
    <script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script src="assets/admin/pages/scripts/table-advanced.js"></script>
    <script src="assets/global/plugins/jquery.form-validator.min.js" type="text/javascript"></script>
    <script> $.validate();</script>
    <script>
        function expanse() {
            var dateone = document.getElementById("date0ne").value;
            var dateTwo = document.getElementById("datetwo").value;
            // Returns successful data submission message when the entered information is stored in database.
            var dataString = 'rngstrt=' + dateone + '&rngfin=' + dateTwo;
            if (dateone == '' || dateTwo == '') {
                alert("Please select Expanse date range first.");
            } else {
                // AJAX code to submit form.
                $.ajax({
                    type: "POST",
                    url: "index.php/account/exp_list_da_ra",
                    data: dataString,
                    cache: false,
                    success: function (html) {
//            alert(html);
                        $("#ajaxresult").html(html);
                    }
                });
            }
            return false;
        } 
        jQuery(document).ready(function () {

            //here is auto reload after 1 second for time and date in the top
            jQuery(setInterval(function () {
                jQuery("#result").load("index.php/home/iceTime");
            }, 1000));
            ComponentsPickers.init();
        });

    </script>

