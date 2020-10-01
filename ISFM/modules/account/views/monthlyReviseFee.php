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
                   Revise Fee <small></small>
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
                        Revise Fee
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
                            Take Revise Fee
                        </div>
                        <div class="tools">
                            <a href="" class="collapse">
                            </a>
                            <a href="" class="reload">
                            </a>
                        </div>
                    </div>
                    <?php foreach ($stu_info as $row) {
                                $data = $row;
                                
                            }
                                $student_id = $data['student_id'];
                                $class_id   = $data['class_id'];
                                $section    = $data['section']; 
                            ?>
                    
                    <div class="portlet-body form">
                        <?php $form_attributs = array('class' => 'form-horizontal', 'role' => 'form', 'name' => 'myForm', 'onsubmit' => 'return validateForm()');
                        echo form_open_multipart("account/monthlyReviseFee?student_id=$student_id&class_id=$class_id&section=$section", $form_attributs);
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
                                    <td><?php echo $data['farther_name']; ?></td>
                                </tr>
                                <tr>
                                    <td>Student ID</td>
                                    <td><?php echo $data['student_id']; ?></td>
                                </tr>
                                <tr>
                                    <td>Class Title</td>
                                    <td><?php echo $data['class_title']; ?></td>
                                </tr>
                                <tr>
                                    <td>Class Section</td>
                                    <td><?php echo $data['section']; ?></td>
                                </tr>
                                <tr>
                                    <td>registration number</td>
                                    <td><?php echo $data['registration_number']; ?></td>
                                </tr>
                                <tr>
                                    <td></td> 
                                    <td></td>
                                </tr>
                                <!-- <tr>
                                    <td>B From number</td>
                                    <td><?php echo $data['b_form']; ?></td> 
                                </tr> -->
                            </table>

                            </div>
                            </div> 
                            <input type="hidden" name="student_id" value="<?php echo $student_id; ?>" >
                            <input type="hidden" name="created_by" value="<?php echo $userId; ?>" >
                            <div class="form-group">
                                <div class="col-md-offset-3 col-md-6">
                                    <label class=" control-label">Revise Fee Reasons </label> 
                                    <input type="text" class="form-control" name="loan_reasons" id="loan_reasons" required="required">  
                                </div>
                            </div> 
                         <?php /* if(date('F')=='January'){ 
                            echo'
                            <div class="form-group">
                                <label class="col-md-2 control-label"> </label>
                                <div class="col-md-2">
                                    <label class="control-label"> Annual Fee </label>
                                    <input type="text" class="form-control" name="annual_found" id="annual_found" value="'.$an_fee.'" >
                                </div>
                                <div class="col-md-2">
                                    <label class=" control-label"> Discount Annual Fee  </label>
                                    <input type="text" class="form-control" name="discount_annual" id="discount_annual" readonly="">
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label">Total Discount </label>
                                    <input type="text" class="form-control" name="ann_total_dis" id="ann_total_dis" readonly="">
                                </div> 
                                <div class="col-md-2">
                                    <label class=" control-label">After Discount Annual Fee </label>
                                    <input type="text" class="form-control" name="after_dis_annual" id="after_dis_annual" required="required">
                                </div>
                            </div>';
                         } */ ?>
                            <div class="form-group"> 
                                <label class="col-md-2 control-label"></label>
                                <div class="col-md-2">
                                    <label class="control-label">Actual Tution Fee </label>
                                    <input type="text" class="form-control" value="<?php echo $tu_fee; ?>" name="tution_fee" id="tution_fee" readonly="">
                                </div>  
                                <div class="col-md-3">
                                    <label class=" control-label">Discounted Tution Fee (Any)</label>
                                    <input type="text" class="form-control" value="<?php echo $dis_tu_fee; ?>" name="dis_tut_fee" id="dis_tut_fee" readonly="" >
                                </div> 
                                <div class="col-md-2">
                                    <label class="control-label">Amount Revise/Due </label>
                                    <input type="text" class="form-control" name="revise_fee" id="revise_fee" onkeyup="reviseFee()">
                                </div> 
                                <div class="col-md-2">
                                    <label class=" control-label">After Revise Tution Fee </label>
                                    <input type="text" class="form-control" name="after_revise_fee" id="after_revise_fee" required="required" readonly="">
                                </div> 
<input type="hidden" value="<?php echo $dis_total;?>" name="discount_total" id="discount_total" placeholder="c" readonly="">
<input type="hidden" name="af_dis_total" id="af_dis_total" placeholder="d" readonly="">
<input type="hidden" name="year" id="year" value="<?php echo $year; ?>" readonly="" >
<input type="hidden" name="month" id="month" value="<?php echo $month; ?>" readonly="">
                            </div>
                            <!-- <div class="form-group">
                                <label class="col-md-2 control-label"></label>
                                <div class="col-md-2">
                                    <label class="control-label">Actual AC Charges</label>
                                    <input type="text" class="form-control" value="<?php echo $ac_char; ?>" name="ac_charges" id="ac_charges">
                                </div> 
                               <div class="col-md-2">
                                   <label class=" control-label">Discount AC Charges </label>
                                   <input type="text" class="form-control" name="dis_ac_char" id="dis_ac_char" readonly="">
                               </div>
                                <div class="col-md-2">
                                    <label class="control-label">Total Discount </label>
                                <input type="text" class="form-control" name="ac_total_dis" id="ac_total_dis" readonly="">
                                </div> 
                                <div class="col-md-2">
                                    <label class=" control-label">After Discount AC Charges </label>
                                    <input type="text" class="form-control" name="after_dis_ac_char" id="after_dis_ac_char" required="required">
                                </div>
                            </div>  -->
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
    function reviseFee(){
        // get revise fee value 
          var revise_fee = document.getElementById("revise_fee").value; 
          var dis_tut_fee = document.getElementById("dis_tut_fee").value; 
          var discount_total = document.getElementById("discount_total").value;  
          var discount_total = document.getElementById("discount_total").value;    
    // After Revise Tution Fee  
        document.getElementById("after_revise_fee").value=parseInt(dis_tut_fee)-parseInt(revise_fee); 
        document.getElementById("af_dis_total").value=parseInt(discount_total)-parseInt(revise_fee); 
     
    }
    
</script> 
<script>
    /*function dis_persen(){
        var discount_persentage = document.getElementById("discount_reasons").value;  
        var annual_found = document.getElementById("annual_found").value;
        var tution_fee = document.getElementById("tution_fee").value;
        var ac_charges = document.getElementById("ac_charges").value; 
        //display discount persentage s
        document.getElementById("discount_annual").value=parseInt(discount_persentage);
        document.getElementById("dis_tut_fee").value=parseInt(discount_persentage);
        document.getElementById("dis_ac_char").value=parseInt(discount_persentage); 
        //total discount admission and annual fee  
        document.getElementById("ann_total_dis").value=parseInt(annual_found)*parseInt(discount_persentage)/100; 
        document.getElementById("tut_total_dis").value=parseInt(tution_fee)*parseInt(discount_persentage)/100;  
        document.getElementById("ac_total_dis").value=parseInt(ac_charges)*parseInt(discount_persentage)/100; 
        // remaning total 
        
        var ann_total_dis = document.getElementById("ann_total_dis").value; 
        var tut_total_dis = document.getElementById("tut_total_dis").value;
        var ac_total_dis = document.getElementById("ac_total_dis").value;
        
        
        document.getElementById("after_dis_annual").value=parseInt(annual_found)-parseInt(ann_total_dis);
        document.getElementById("after_dis_tut_fe").value=parseInt(tution_fee)-parseInt(tut_total_dis);
        document.getElementById("after_dis_ac_char").value=parseInt(ac_charges)-parseInt(ac_total_dis);
    } */
</script>

<script>
    /*function ac_dis(){
        // get persentage value
          var dis_per2 = document.getElementById("dis_per2").value; 
          var ac_charges = document.getElementById("ac_charges").value;
    // display discount persentage value
         // document.getElementById("dis_ac_char").value=parseInt(dis_per2);  
    //total discount tution fee and annual fee  
        document.getElementById("ac_total_dis").value=parseInt(ac_charges)*parseInt(dis_per2)/100; 
    // 
        var ac_total_dis = document.getElementById("ac_total_dis").value;
    // after discount tution fee
        document.getElementById("after_dis_ac_char").value=parseInt(ac_charges)-parseInt(ac_total_dis);
    }*/
</script>

