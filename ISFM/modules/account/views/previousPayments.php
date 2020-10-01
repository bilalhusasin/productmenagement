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
                    <?php  //echo lang('advance_payment'); ?> Student Previous Payments<small></small>
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
                        <?php // echo lang('header_recept'); ?>Student Previous Payments
                    </li>
                    <li id="result" class="pull-right topClock"></li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
                <?php
                    if (!empty($message)) {
                    echo '<br>' . $message;
                    }   
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet box green">
                            <div class="portlet-title">
                                <div class="caption">
                                    <?php // echo lang('acc_adv_recept'); ?> Student Wise Previous Payments
                                </div>
                                <div class="tools">
                                    <a class="collapse" href="javascript:;"> </a>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <div class="col-md-6">
                                    <div class="portlet box purple margin-bottom-15">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <?php echo lang('acc_add_recept'); ?>
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
                                            echo form_open('account/previousPayments', $form_attributs);
                                            ?>
                                            <div class="form-body">  
                                                <!-- <div class="form-group">
                                                    <label class="col-md-3 control-label"> Student ID <?php // echo lang('acc_accotit'); ?><span class="requiredStar"> * </span></label>
                                                    <div class="col-md-9">
                                                        <select class="form-control" name="account_id" data-validation="required" data-validation-error-msg="<?php echo lang('acc_psaaf'); ?>">
                                                            <option value=""><?php echo lang('select'); ?></option>
                                                            <?php foreach ($expa_title as $row) { ?>
                                                                <option value="<?php echo $row['id']; ?>"><?php echo $row['account_title']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div> -->
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label"> Student ID <span class="requiredStar"> * </span></label>
                                                    <div class="col-md-7">
                                                        <input type="text" class="form-control" name="student_id" id="student_id" data-validation="required" data-validation-error-msg="Please Given the Correct Student ID." onkeyup="StudentId(this.value)">
                                                    </div>
                                                </div> 
                                                <!-- <div class="form-group">
                                                    <label class="col-md-4 control-label"> Net Advance Amount<span class="requiredStar"> * </span></label>
                                                    <div class="col-md-7">
                                                        <input type="text" class="form-control" name="amount" data-validation="required" data-validation-error-msg="Please give the amount.">
                                                    </div>
                                                </div>
                                                <div class="form-actions bottom fluid ">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <button class="btn green" type="submit" name="submit" value="Submit">Submit</button>
                                                        <button class="btn red" type="reset"><?php echo lang('refresh'); ?></button>
                                                    </div>
                                                </div> -->
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
        <div class="row">
            <div class="col-md-12">
                <div class="row">  
                    <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet box green-haze">
                            <div class="portlet-title">
                                <div class="caption">
                                    <?php // echo lang('acc_adv_recept_list'); ?> List Of Single Student Previous Unpaid Vouchers
                                </div>
                                <div class="tools"> </div>
                            </div> 
                            <div class="portlet-body"> 
                                <table class="table table-striped table-bordered table-hover" id="sample_1">
                                    <thead>
                                        <tr>
                                            <th> S.N. </th>
                                            <th> Year</th>
                                            <th> Month </th>
                                            <th> Due Date </th>
                                            <th> Class </th>
                                            <th> Student ID </th>
                                            <th> Voucher Number </th>
                                            <th> Student Title </th>    
                                            <th> Grand Total </th> 
                                            <th> Net/Discounted Total </th>
                                            <th> Tution Fee Discount</th>
                                            <th> Dues</th>
                                            <th> Balance</th>
                                            <th> Paid </th>
                                            <th> Method </th> 
                                            <th> Payment </th>
                                            <th> Strudent Monthly Fee Voucher </th> 
                                            <th> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody  id="ajaxResult2">  
                                          
                                    </tbody> 
                                </table>
                            </div>
                        </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                    </div>  
                    <div class="clearfix"></div>  
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row">  
                    <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet box green-haze">
                            <div class="portlet-title">
                                <div class="caption">
                                    <?php // echo lang('acc_adv_recept_list'); ?> List Of Previous Unpaid Vouchers
                                </div>
                                <div class="tools"> </div>
                            </div> 
                            <div class="portlet-body"> 
                                <table class="table table-striped table-bordered table-hover" id="sample_2">
                                    <thead>
                                        <tr>
                                            <th> S.N. </th>
                                            <th> Year</th>
                                            <th> Month </th>
                                            <th> Due Date </th>
                                            <th> Class </th>
                                            <th> Student ID </th>
                                            <th> Voucher Number </th>
                                            <th> Student Title </th>    
                                            <th> Grand Total </th> 
                                            <th> Net/Discounted Total </th>
                                            <th> Tution Fee Discount</th>
                                            <th> Dues</th>
                                            <th> Balance</th>
                                            <th> Paid </th>
                                            <th> Method </th> 
                                            <th> Payment </th>
                                            <th> Strudent Monthly Fee Voucher </th> 
                                            <th> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody >  
                            <?php 
                                $count=1;
                                foreach ($slip_unpaid as $row) { 
                                 echo'  
                                    <tr>                    
                                        <td> '. $count++ .'</td>
                                        <td> '. $row['year'] .'</td>
                                        <td> '. $row['month'].'</td>
                                        <td> '. $row['due_date'].'</td>
                                        <td> '. $this->common->class_title($row['class_id']).'</td>
                                        <td> '. $row['student_id'].'</td>
                                        <td> '. $row['voucher_number'].'</td>
                                        <td> '. $this->common->student_title($row['student_id']).'</td>  
                                        <td> '. $row['total'].'</td>
                                        <td> '. $row['dis_total'].'</td>
                                        <td> '. $row['discount'].'</td>
                                        <td> '. $row['dues'].'</td>
                                        <td> '. $row['balance'].'</td>
                                        <td> '. $row['paid'].'</td>
                                        <td> '. $row['mathod'].'</td> 
                                        <td>';
                                        echo'<span class="label label-sm label-danger">'. $row['payment_status'] .'</span>';
                                    echo'</td>  
                                        <td>';
                                        echo '<a href="index.php/account/student_vocher?student_id='. $row['student_id']. '&class_id='. $row['class_id'].'&voch_no='.$row['voucher_number'].'&month='.$row['month'].'&year='.$row['year']. '&due_date='.$row['due_date']. '">'."Generate Monthly Fee Voucher".' </a>';
                                    echo'</td>
                                        <td > ';  
                                        echo'<a class="btn btn-xs default" href="index.php/account/fee_pay?sid='.$row['student_id'].'&class_id='.$row['class_id'].'&voch_no='.$row['voucher_number'].'&month='.$row['month'].'&year='.$row['year'].'&due_date='.$row['due_date'].'" title="Take Payment"><i class="fa fa-money"></i></a>';
                                        '</td> 
                                    </tr>';
                                }                           
                            ?>
                                    </tbody> 
                                </table>
                            </div>
                        </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                    </div>  
                    <div class="clearfix"></div>  
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
    <script>
       /*  function StudentId(str) {
           //alert("hi");
          var xmlhttp;
           if (str.length === 0) {
               document.getElementById("ajaxResult").innerHTML = "";
               return;
           }
           if (window.XMLHttpRequest) {
           // code for IE7+, Firefox, Chrome, Opera, Safari
               xmlhttp = new XMLHttpRequest();
           } else {
           // code for IE6, IE5
               xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
           }
               xmlhttp.onreadystatechange = function () {
           if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
               document.getElementById("ajaxResult").innerHTML = xmlhttp.responseText;
           }
           };
               xmlhttp.open("GET", "index.php/account/ajaxstudentDetailLedger?q=" + str, true);
               xmlhttp.send(); 
       } */
    </script>
    <script>  
function StudentId(){ 
        var student_id= document.getElementById("student_id").value; 
        //alert(student_id);
    request = $.ajax({
        url: "index.php/account/ajaxPreviousPayments", // ajaxClassExam
        type: "GET",
       data: { q: student_id } 
    });
    request.done(function (response){ 
    if(response)
    {
        //alert(response);
        $('#ajaxResult2').html(response);
    }
    else{
        //alert("An Error Occurred While Select Student Id & Please Enter Correct Student Id.");
    }
    })
}
</script>

