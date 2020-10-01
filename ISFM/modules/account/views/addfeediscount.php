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
                    Set Fee Discount <small></small>
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
                        Set Fee Discount <?php // echo lang('con_set_st_fee'); ?>
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
            <div class="col-md-4">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            Add Fee Discount
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <?php
                        $form_attributs = array('class' => 'form-horizontal', 'role' => 'form');
                        echo form_open('account/addfeediscount', $form_attributs);
                        ?>
                        <div class="form-body">
                            <input type="hidden" name="created_by" value="<?php echo $userId; ?>">
                            <div class="col-md-12">
                                <!-- <div class="form-group">
                                    <label class="col-md-5 control-label"> Discount Session <span class="requiredStar"> * </span></label>
                                    <div class="col-md-7">
                                        <input class="form-control" name="dis_session" id="dis_session" placeholder="Discount Session" type="text" data-validation="required" data-validation-error-msg="Please Select Discount Session.">
                                    </div>
                                </div> -->                             
                                <div class="form-group">
                                    <label class="col-md-5 control-label"> Discount Reason <span class="requiredStar"> * </span></label>
                                    <div class="col-md-7">
                                        <input class="form-control" name="dis_reason" placeholder="Discount Reason" type="text" data-validation="required" data-validation-error-msg="Please Enter Discount Reason .">
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="col-md-5 control-label">Admission Discount</label>
                                    <div class="col-md-7">
                                        <input type="text" name="admi_dis" placeholder="Admission Discount" class="form-control" >
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <label class="col-md-5 control-label">Annual Discount</label>
                                    <div class="col-md-7">
                                        <input type="text" name="ann_dis" placeholder="Annual Discount" class="form-control">
                                    </div>
                                </div> -->
                                <div class="form-group">
                                    <label class="col-md-5 control-label">Tution Discount</label>
                                    <div class="col-md-7">
                                        <input type="text" name="tu_dis" placeholder="Tution Discount" class="form-control">
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <label class="col-md-5 control-label">A/C Discount</label>
                                    <div class="col-md-7">
                                        <input type="text" name="ac_dis" placeholder="A/C Charges Discount" class="form-control">
                                    </div>
                                </div>  -->
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
            
            <div class="col-md-8">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            List Of All Discount Reasons
                        </div>
                        <div class="tools">
                        </div>
                    </div>
                    <div class="portlet-body table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th>Session Discount</th>
                                    <th>Discount Reason</th>
                                    <th>Admission Discount %</th> 
                                    <th>Tution Discount %</th> 
                                    <th>Discount Status</th>  
                                    <th>Action</th>
                                </tr>
                            </thead> 
                            <tbody>
                                <?php $i=1;
                                foreach ($fee_discount as $row1){
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $row1['session_discount']; ?></td>
                                        <td><?php echo $row1['discount_reason']; ?></td>
                                        <td><?php echo $row1['admission_discount']; ?></td>  
                                        <td><?php echo $row1['tution_discount']; ?></td>  
                                        <td>
                                        <?php if($row1['status']=='deactive'){
                                            echo '<span class="label label-sm label-danger">'. $row1['status'] .'</span>';
                                        } elseif ($row1['status']=='active'){ 
                                            echo '<span class="label label-sm label-success">'. $row1['status'] .'</span>';
                                        }?>
                                        </td>
                                        <td> 
                                            <a class="btn btn-xs default" href="index.php/account/edit_dis_reason?id=<?php echo $row1['id'];?>" title="Edit Discount Reason"> <i class="fa fa-pencil-square-o"></i> <?php // echo lang('edit'); ?> </a>
                                             
                                            <!-- <a class="btn btn-xs red" href="index.php/account/delete_discount_per?id=<?php echo $row1['id'];?>" onclick="javascript:return confirm('ARE YOU SURE YOU WANT TO DELETE THIS RECORD ')" title="Delete Discount Persentage"> <i class="fa fa-trash-o"></i> <?php // echo lang('delete'); ?> </a> --> 
                                        </td>
                                    </tr>
                                <?php $i++;} ?> 
                            </tbody>
                        </table>
                    </div>
                </div>
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
<script> $.validate(); </script>
<script>
    jQuery(document).ready(function() {
//here is auto reload after 1 second for time and date in the top
        jQuery(setInterval(function() {
            jQuery("#result").load("index.php/home/iceTime");
        }, 1000));
    });
</script>

 