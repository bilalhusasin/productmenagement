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
                        <?php echo lang('con_configu'); ?>
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
                    <?php foreach($fee_discount as $row){
                        $session_dis= $row['session_discount'];
                        $dis_reason= $row['discount_reason'];
                        $admission_dis= $row['admission_discount']; 
                        $tution_dis= $row['tution_discount']; 
                        $status= $row['status'];
                        $id= $row['id'];
                    }?>
                    <div class="portlet-body form">
                        <?php
                        $form_attributs = array('class' => 'form-horizontal', 'role' => 'form');
                        echo form_open('account/edit_dis_reason', $form_attributs);
                        ?>
                        <div class="form-body">
                            <input type="hidden" name="created_by" value="<?php echo $userId; ?>">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <div class="col-md-8"> 
                                <!--<div class="form-group">
                                    <label class="col-md-4 control-label"> Discount Session <span class="requiredStar"> * </span></label>
                                    <div class="col-md-8">
                                        <input class="form-control" name="dis_session" id="dis_session" value="<?php echo $session_dis; ?>" type="text" data-validation="required" data-validation-error-msg="Please Select Discount Session.">
                                    </div>
                                </div>    -->                         
                                <div class="form-group">
                                    <label class="col-md-4 control-label"> Discount Reason </label>
                                    <div class="col-md-8">
                                        <input class="form-control" name="dis_reason" type="text" value="<?php echo $dis_reason; ?>" data-validation="required" data-validation-error-msg="<?php echo 'Add fee Discount Reason';?>">
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Admission Discount</label>
                                    <div class="col-md-8">
                                        <input type="text" name="admi_dis" value="<?php echo $admission_dis; ?>" class="form-control">
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <label class="col-md-4 control-label">Annual Discount</label>
                                    <div class="col-md-8">
                                        <input type="text" name="ann_dis" value="<?php echo $annual_dis; ?>" class="form-control"  >
                                    </div>
                                </div> -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Tution Discount</label>
                                    <div class="col-md-8">
                                        <input type="text" name="tu_dis" value="<?php echo $tution_dis; ?>" class="form-control" >
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <label class="col-md-4 control-label">A/C Discount</label>
                                    <div class="col-md-8">
                                        <input type="text" name="ac_dis" value="<?php echo $ac_dis; ?>" class="form-control" >
                                    </div>
                                </div> -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Discount Status</label>
                                    <div class="col-md-8">
                                        <select name="status" id="status" class="form-control">
                                            <option value="<?php echo $status; ?>"><?php echo $status;?></option>
                                            <option value="">Select...</option> 
                                            <option value="active">Active</option>
                                            <option value="deactive">Deactive</option>
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

 