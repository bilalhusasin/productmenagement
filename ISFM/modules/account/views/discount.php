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
                    Discount <small></small>
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
                        Take Discount
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
                             Take Discount
                        </div>
                        <div class="tools">
                            <a href="" class="collapse">
                            </a>
                            <a href="" class="reload">
                            </a>
                        </div>
                    </div>
                    <?php 
                    foreach ($stu as $row) {
                         $data = $row;
                    }
                        $reg_num = $data['reg_number'];
                    ?>
                    
                    <div class="portlet-body form">
                        <?php $form_attributs = array('class' => 'form-horizontal', 'role' => 'form', 'name' => 'myForm', 'onsubmit' => 'return validateForm()');
                        echo form_open_multipart("account/fee_discount?reg_num=$reg_num", $form_attributs);
                        ?>
                        <div class="form-body">
                            <?php
                            if (!empty($success)) {
                                echo $success;
                            }
                            ?>
                            
                            <div class="row">
                             
                            <div class="col-md-offset-3 col-md-6">
                                <h2>Student Information</h2>
                            <table class="table">
                                <tr>
                                    <td>student name</td>
                                    <td><?php echo $data['student_nam']; ?></td>
                                </tr>
                                <tr>
                                    <td>father name</td>
                                    <td><?php echo $data['father_name']; ?></td>
                                </tr>
                                <tr>
                                    <td>registration number</td>
                                    <td><?php echo $data['reg_number']; ?></td>
                                </tr>
                                <tr>
                                    <td>B From number</td>
                                    <td><?php echo $data['b_form']; ?></td> 
                                </tr>
                            </table>

                            </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-offset-3 col-md-6">
                                    <label class=" control-label"> Reasons For Discount <span class="requiredStar"> * </span> </label>
                                    <select type="text" class="form-control" name="discount_persentage" id="discount_persentage" data-validation="required" onchange="dis_persen();">
                                        <option value="">Select...</option>
                                    <?php foreach($fee_discount as $row){ ?>
                                        <option value="<?php echo $row['percentage'].'_'.$row['discount_reason']?>"><?php echo $row['discount_reason'].' Discount '.$row['percentage'].'%'?></option>
                                    <?php } ?> 
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="student_id" value="<?php echo $reg_num; ?>" >
                            <input type="hidden" name="created_by" value="<?php echo $userId; ?>" >
                            <div class="form-group">
                                <label class="col-md-1 control-label"></label>
                                <div class="col-md-2">
                                    <label class="control-label">Admission Fee </label>
                                    <input type="text" class="form-control" value="<?php echo $data['admission_fee']; ?>" name="admission_fee" id="admission_fee" readonly="">
                                </div> 
                                 
                                <div class="col-md-2">
                                    <label class=" control-label">Discount Admission Fee </label>
                                    <input type="text" class="form-control" placeholder="Enter Discount" name="dis_admi_fee" id="dis_admi_fee" onkeyup="admission_dis();" required="required" readonly="">
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label">Total Discount </label>
                                    <input type="text" class="form-control" name="admi_total_dis" id="admi_total_dis" readonly="">
                                </div> 
                                <div class="col-md-3">
                                    <label class=" control-label">After Discount Admission Fee </label>
                                    <input type="text" class="form-control" name="after_dis_admi_fe" id="after_dis_admi_fe" required="required" readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-1 control-label"> </label>
                                <div class="col-md-2">
                                    <label class="control-label"> Annual Fee </label>
                                    <input type="text" class="form-control" name="annual_found" id="annual_found" value="<?php echo $data['annual_found']; ?>" readonly="">
                                </div>
                                <div class="col-md-2">
                                    <label class=" control-label"> Discount Annual Fee  </label>
                                    <input type="text" class="form-control" placeholder="Enter Discount" name="discount_annual" id="discount_annual" onkeyup="annual_fee_dis();" required="required" readonly="">
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label">Total Discount </label>
                                    <input type="text" class="form-control" name="ann_total_dis" id="ann_total_dis" readonly="">
                                </div> 
                                <div class="col-md-3">
                                    <label class=" control-label">After Discount Annual Fee </label>
                                    <input type="text" class="form-control" name="after_dis_annual" id="after_dis_annual" required="required" readonly="">
                                </div>
                            </div>                              
                        </div>
                        <div class="form-actions fluid">
                            <div class="col-md-offset-3 col-md-6">
                                <button type="submit" class="btn green" name="submit" value="submit"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Discount &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </button>
                                <button type="button" class="btn btn-default no-print">
                                  <a href="javascript:history.back()"><i class="fa fa-mail-reply-all"></i> <?php echo lang('back'); ?> </a>
                                </button>
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
    function dis_persen(){
        var discount_persentage = document.getElementById("discount_persentage").value; 
        var admission_fee = document.getElementById("admission_fee").value; 
        var annual_found = document.getElementById("annual_found").value;
        //display discount persentage
        document.getElementById("dis_admi_fee").value=parseInt(discount_persentage);
        document.getElementById("discount_annual").value=parseInt(discount_persentage); 
        //total discount admission and annual fee  
        document.getElementById("admi_total_dis").value=parseInt(admission_fee)*parseInt(discount_persentage)/100; 
        document.getElementById("ann_total_dis").value=parseInt(annual_found)*parseInt(discount_persentage)/100; 
        // remaning total 
        var admi_total_dis = document.getElementById("admi_total_dis").value;
        var ann_total_dis = document.getElementById("ann_total_dis").value; 
        
        document.getElementById("after_dis_admi_fe").value=parseInt(admission_fee)-parseInt(admi_total_dis);
        document.getElementById("after_dis_annual").value=parseInt(annual_found)-parseInt(ann_total_dis);
    } 
</script>
<script>
    /*function admission_dis(){
          var admission_fee = document.getElementById("admission_fee").value; 
          var dis_admi_fee  = document.getElementById("dis_admi_fee").value; 
          document.getElementById("after_dis_admi_fe").value=parseInt(admission_fee)-parseInt(dis_admi_fee);      
    }*/
    
</script>
<script>
    /*function annual_fee_dis(){
          var annual_found = document.getElementById("annual_found").value; 
          var discount_annual  = document.getElementById("discount_annual").value; 
          document.getElementById("after_dis_annual").value=parseInt(annual_found)-parseInt(discount_annual);      
    }*/
</script>

