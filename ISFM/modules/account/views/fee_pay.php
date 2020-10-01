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
                    <?php echo lang('acc_slipdetails'); ?><small></small>
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
                        <?php // echo lang('header_teansec'); ?>
                        Student's Payments
                    </li>
                    <li>
                        <?php // echo lang('acc_slipdetails'); ?>
                        Take Payment
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
                             Take Payment 
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
                        echo form_open_multipart("account/fee_pay?sid=$slip_id", $form_attributs);
                        ?>
                        <div class="form-body">
                            <?php
                            if (!empty($success)) {
                                echo $success;
                            }
                            ?>
                            <?php 
                            // this $slip_data variable already change foreach loop   Not Clear Unpaid
                            $slip_data; 
                            $slip_data['dis_total'];  
                            ?>
                    <input type="hidden" name="u_id" value="<?php echo $userId; ?>" readonly=''> 
                    <input type="hidden" name="student_id" value="<?php echo $slip_id; ?>" readonly=''> 
                    <input type="hidden" name="voch_no" value="<?php echo $slip_data['voucher_number']; ?>" readonly=''>
                    <input type="hidden" name="month" value="<?php echo $slip_data['month']; ?>" readonly=''>
                    <input type="hidden" name="year" value="<?php echo $slip_data['year']; ?>" readonly=''> 
                            <div class="form-group">
                                <label class="col-md-3 control-label">Total Amount <span class="requiredStar">  </span></label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" value="<?php echo $slip_data['dis_total']; ?>" name="total" readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"> Payment Received <span class="requiredStar"> * </span></label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="paid_amount" data-validation="required" data-validation-error-msg="Pleas enter your payment amount." value="<?php echo $slip_data['dis_total']; ?>" readonly=""> 
                                </div>
                            </div>  
                            <div class="form-group">
                                <label class="col-md-3 control-label"> Payment Method <?php // echo lang('admi_blood'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-5">
                                    <select name="method" class="form-control" onchange="selectBank(this.value)" data-validation="required" data-validation-error-msg="Pleas select payment method.">
                                        <option value=""><?php echo lang('select'); ?></option>
                                        <?php foreach($pay_method as $row){?>
                                        <option value="<?php echo $row['payment_method']?>"> <?php echo $row['payment_method']?> </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div id="ajaxResult"></div>
                        </div>
                        <div class="form-actions fluid">
                            <div class="col-md-offset-3 col-md-6">
                                <button type="submit" class="btn green" name="submit" value="submit"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Pay Now &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </button>
                                <a href="javascript:history.back()" class="btn default"><i class="fa fa-mail-reply-all"></i> <?php echo lang('back'); ?> </a>
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
<script>
    function selectBank(str) {
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
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("ajaxResult").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "index.php/account/ajaxBankResult?q=" + str, true);
        xmlhttp.send();
    }
</script> 


