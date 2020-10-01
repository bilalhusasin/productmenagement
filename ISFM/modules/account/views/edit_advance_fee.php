<?php $user = $this->ion_auth->user()->row(); $userId = $user->id;?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                    <?php echo lang('acc_edit_adv_fee'); ?><small></small>
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
                        <?php echo lang('header_recept'); ?>
                        
                    </li>
                    <li>
                        <?php  echo lang('acc_edit_adv_fee'); ?> 
                    </li>
                    <li id="result" class="pull-right topClock"></li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12" >
                <!-- BEGIN SAMPLE FORM PORTLET-->
                <div class="portlet box green ">
                    <div class="portlet-title">
                        <div class="caption">
                             <?php  echo lang('acc_adv_fee'); ?> 
                        </div>
                        <div class="tools">
                            <a href="" class="collapse">
                            </a>
                            <a href="" class="reload">
                            </a>
                        </div>
                    </div>
                    
                    <div class="portlet-body form">
                        <?php $form_attributs = array('class' => 'form-horizontal', 'role' => 'form', 'name' => 'myForm', 'onsubmit' => 'return validateForm()');
                        echo form_open_multipart("account/editAdvanceReceipt?sid=$sid", $form_attributs);
                        ?>
                        <div class="form-body">
                            <?php
                            if (!empty($success)) {
                                echo $success;
                            } 
                            ?>
                            <input type="hidden" value="<?php echo $userId; ?>" name="created_by" readonly="">
                            <input type="hidden" value="<?php echo $advance_fee[0]['advance_date']; ?>" name="advance_date" readonly="">
                            <input type="hidden" value="<?php echo $advance_fee[0]['total_advance_amount']; ?>" name="tot_adv_amount" id="tot_adv_amount" readonly="">
                            <input type="hidden" value="" name="tot_rem_amount" id="tot_rem_amount" readonly="">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Student Id  <span class="requiredStar">  </span></label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" value="<?php echo $advance_fee[0]['student_id']; ?>" name="student_id" readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"> Registration Number <span class="requiredStar"> * </span></label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" value="<?php echo $advance_fee[0]['registration_num']; ?>" name="reg_number" readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"> Advance Amount <span class="requiredStar"> * </span></label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" value="<?php echo $advance_fee[0]['advance_amount']; ?>" name="advance_amount" id="advance_amount" data-validation="required" data-validation-error-msg="Pleas enter your payment amount.">
                                </div>
                            </div>
                        </div>
                        <div class="form-actions fluid">
                            <div class="col-md-offset-3 col-md-6">
                                <button type="submit" class="btn green" name="submit" value="submit"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Save &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </button>
                                <button type="button" class="btn btn-default no-print">
                                   <a href="javascript:history.back()"><i class="fa fa-mail-reply-all"></i> <?php echo lang('back'); ?> </a>
                                </button>
                                <button type="reset" class="btn blue"><?php echo lang('refresh'); ?></button>
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
<script type="text/javascript" src="assets/admin/layout/scripts/jQuery.print.js"></script>
<script>
    jQuery(document).ready(function () {
    //here is auto reload after 1 second for time and date in the top

        $("#print").find('.print-link').on('click', function () {
            //Print print with default options
            $.print("#print");
        });
        jQuery(setInterval(function () {
            jQuery("#result").load("index.php/home/iceTime");
        }, 5000));

        var tot_adv_amount = document.getElementById("tot_adv_amount").value; 
        var advance_amount = document.getElementById("advance_amount").value;    
    // After negative total_advance amount   
        document.getElementById("tot_rem_amount").value=parseInt(tot_adv_amount)-parseInt(advance_amount); 
         

    });
</script>
<script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-36251023-1']);
    _gaq.push(['_setDomainName', 'jqueryscript.net']);
    _gaq.push(['_trackPageview']);

    (function () {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();

</script> 
