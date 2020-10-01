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
                    Set Fee Structure <small></small>
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
                        Set Fee Structure <?php // echo lang('con_set_st_fee'); ?>
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
                           Edit Payment Method
                        </div>
                    </div>
                    <?php foreach($pay_method as $row){
                          $pay_method= $row['payment_method'];
                          $account_name= $row['account_name'];
                          $account_number= $row['account_number'];
                          $status= $row['status'];
                          $id= $row['id'];
                    }?>
                    <div class="portlet-body form">
                        <?php
                        $form_attributs = array('class' => 'form-horizontal', 'role' => 'form');
                        echo form_open('account/edit_pay_method', $form_attributs);
                        ?>
                        <div class="form-body">
                            <input type="hidden" name="created_by" value="<?php echo $userId; ?>">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <div class="col-md-8">                              
                                <div class="form-group">
                                    <label class="col-md-4 control-label"> Payment Method </label>
                                    <div class="col-md-8">
                                        <input class="form-control " name="pay_method" placeholder="payment method" type="text" value="<?php echo $pay_method; ?>">
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="col-md-4 control-label"> Account Name </label>
                                    <div class="col-md-8">
                                        <input type="text" name="account_name" value="<?php echo $account_name; ?>" placeholder="Session Admission Fee" class="form-control" data-validation="required" data-validation-error-msg="<?php echo "Add Admission fee first"; ?>">
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="col-md-4 control-label"> Account Number </label>
                                    <div class="col-md-8">
                                        <input type="text" name="account_number" value="<?php echo $account_number; ?>" placeholder="Session Admission Fee" class="form-control" data-validation="required">
                                    </div>
                                </div>  
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Account Status</label>
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
                                <button type="reset" class="btn default"><?php echo lang('refresh'); ?></button>
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
<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="assets/global/plugins/jquery.form-validator.min.js"></script>
<script>
    jQuery(document).ready(function() {
//here is auto reload after 1 second for time and date in the top
        jQuery(setInterval(function() {
            jQuery("#result").load("index.php/home/iceTime");
        }, 1000));
    });
</script>

 