<!--Start page level style-->
<link rel="stylesheet" type="text/css" href="assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/> 
<link rel="stylesheet" type="text/css" href="assets/global/jquery_ui_css/jquery-ui.css" />
<?php $user = $this->ion_auth->user()->row();
$userId = $user->id; ?>
<!--Start page level style-->
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <?php if(!empty($message)){
                    echo $message;
                }?>
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                    Edit Fee Discount  <small></small>
                </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <?php echo lang('home'); ?>
                    </li>
                    <li>
                        Accounts
                    </li>
                    <li>
                    Edit Fee Discount <?php // echo lang('con_set_st_fee'); ?>
                    </li>
                    <li id="result" class="pull-right topClock"></li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
          
        <div class="row">
        <?php
        if (!empty($successMessage)) {
            ?>
            <div class="col-md-12">
                <?php echo $successMessage;?>
            </div>
        <?php }?>
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                           Edit Fee Discount
                        </div>
                    </div> 
                    <?php foreach($special_discount as $row){
                        $spl_id= $row['spl_id'];
                        $session_dis= $row['session_discount'];
                        $spl_dis_reason= $row['special_dis_reason'];
                        $spl_dis_type= $row['discount_type'];
                        $spl_tution_dis= $row['special_tution_dis']; 
                        $spl_dis_month= $row['special_dis_month'];  
                        $status= $row['status'];  
                    }?>
                    <div class="portlet-body form">
                        <?php
                        $form_attributs = array('class' => 'form-horizontal', 'role' => 'form');
                        echo form_open('account/edit_Special_discount', $form_attributs);
                        ?>
                        <div class="form-body">
                            <input type="hidden" name="created_by" value="<?php echo $userId; ?>">
                            <input type="text" name="spl_id" value="<?php echo $spl_id; ?>">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="col-md-5 control-label">Class Title</label>
                                    <div class="col-md-7">
                                        <select name="class" id="class" class="form-control"> 
                                            <option value="<?php echo $spl_dis_type; ?>"><?php echo $spl_dis_type; ?></option> 
                                            <option value="All Classes">All Classes</option> 
                                        <?php 
                                          foreach($class as $row){ 
                                           echo '<option value="'.$row['id'].'">'.$row['class_title'].'</option>';
                                          }
                                        ?> 
                                        </select>
                                    </div>
                                </div>                         
                                <div class="form-group">
                                    <label class="col-md-5 control-label"> Discount Reason <span class="requiredStar"> * </span></label>
                                    <div class="col-md-7">
                                        <input class="form-control" name="first_dis_reason" id="first_dis_reason" value="<?php echo $spl_dis_reason;?>" type="text" data-validation="required" data-validation-error-msg="Please Enter Discount Reason .">
                                    </div>
                                </div>  
                                <div class="form-group">
                                    <label class="col-md-5 control-label">Tution Discount<span class="requiredStar"> * </span></label>
                                    <div class="col-md-7">    
                                        <input type="text" name="first_tu_dis" id="first_tu_dis" value="<?php echo $spl_tution_dis;?>" class="form-control" data-validation="required" data-validation-error-msg="Please Enter Tution Discount.">
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="col-md-5 control-label"> Session <span class="requiredStar"> * </span></label>
                                    <div class="col-md-7"> 
                                        <select name="first_disc_month" id="first_disc_month" class="form-control" data-validation="required" data-validation-error-msg="Please Select Discounted Month .">
                                            <option value="<?php echo $spl_dis_month; ?>"><?php echo $spl_dis_month;?></option>
                                            <option value="January">January</option>
                                            <option value="February">February</option>
                                            <option value="March">March</option>
                                            <option value="April">April</option>
                                            <option value="May">May</option>
                                            <option value="June">June</option>
                                            <option value="July">July</option>
                                            <option value="August">August</option>
                                            <option value="September">September</option>
                                            <option value="October">October</option>
                                            <option value="November">November</option>
                                            <option value="December">December</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-5 control-label">Discount Status</label>
                                    <div class="col-md-7">
                                        <select name="status" id="status" class="form-control">
                                            <option value="<?php echo $status; ?>"><?php echo $status;?></option>
                                            <option value="">Select...</option> 
                                            <option value="Active">Active</option>
                                            <option value="Deactive">Deactive</option>
                                        </select>
                                    </div>
                                </div>  
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-actions fluid">
                            <div class="col-md-offset-3 col-md-6">
                                <button type="submit" class="btn green" name="submit" value="Submit"><?php echo lang('save'); ?></button>
                                <button type="reset" class="btn blue"><?php echo lang('refresh'); ?></button>
                                <a href="javascript:history.back()" class="btn btn-default"><i class="fa fa-mail-reply-all"></i> <?php echo lang('back'); ?> </a> 
                            </div>
                        </div>
                        <?php echo form_close(); ?>
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
<script type="text/javascript" src="assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script src="assets/admin/pages/scripts/table-advanced.js"></script>  
<script type="text/javascript" src="assets/global/plugins/jquery.form-validator.min.js"></script> 

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<script> $.validate(); </script>
<script>
    jQuery(document).ready(function() {
//here is auto reload after 1 second for time and date in the top
        jQuery(setInterval(function() {
            jQuery("#result").load("index.php/home/iceTime");
        }, 1000));
    });
</script>
<script>
    $('#dis_session').datetimepicker({
    format      :   "YYYY",
    viewMode    :   "years", 
});
</script>

 