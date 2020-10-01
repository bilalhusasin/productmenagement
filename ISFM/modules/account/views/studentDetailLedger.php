<head><!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>
<style media="print">
    @page{ 
        margin: 0;
        size: auto;
    }
    .no-print{
        display: none;
    }
    .table{
        margin-bottom: 0px !important;
    }
        /* avoid cutting tr's in half */
    }
    div table  {  
    }
     
    .table_print {
    table-layout: fixed !important;
    width: 33%;
    float: left;
    font-size: 4px !important;
    overflow: none; 
      }
    td{
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: normal;
    overflow-wrap: break-word;
    padding-top: 2px !important;
    padding-bottom: 2px !important;
    font-size: 8px !important;
      }
      th{
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: normal;
    overflow-wrap: break-word;
    padding-top: 2px !important;
    padding-bottom: 2px !important;
    font-size: 8px !important;
      } 
    #tdfont{
        font-size: 9px !important;
        padding-top: 4px !important;
    }
    p{
    font-size: 6px !important; 
      }  
    </style>
    <style>
        .table{
            margin-bottom: 0px !important;
        }
    </style> 
</head>
<!-- END PAGE LEVEL STYLES -->
<?php $user = $this->ion_auth->user()->row(); 
$userId = $user->id;?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <div class="row no-print">
            <div class="col-md-12 ">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                    <?php  //echo lang('advance_payment'); ?> Student Wise Detail Ledger<small></small>
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
                        <?php // echo lang('header_recept'); ?>Student Detail Ledger
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
        <div class="row no-print">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet box green">
                            <div class="portlet-title no-print">
                                <div class="caption">
                                    <?php // echo lang('acc_adv_recept'); ?> Student Wise Detail Ledger
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
                                            echo form_open('account/studentDetailLedger', $form_attributs);
                                            ?>
                                            <div class="form-body">   
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label"> Student ID <span class="requiredStar"> * </span></label>
                                                    <div class="col-md-7">
                                                        <input type="text" class="form-control" name="student_id" id="student_id" onkeyup="StudentId(this.value); s_id(this.value)">
                                                    </div>
                                                </div> 
                                                <!--  
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
        <div class="row" >
            <div class="col-md-12" style="text-align: center;">
                <h2> The Punjab School</h2>
                <h4> Student Wise Detail Ledger</h4> 
            </div>
            <div id="ajaxResult"></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row">  
                    <div class="col-md-12">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet box green-haze">
                            <div class="portlet-title no-print">
                                <div class="caption">
                                    <?php // echo lang('acc_adv_recept_list'); ?>Student Wise Detail Ledger
                                </div>
                            <div class="tools">
                        </div>
                     </div> 
                        <div class="portlet-body"> 
                        <table class="table table-striped table-bordered table-hover" id="">
                            <thead>
                                <tr class='textAlignCenter'>
                                    <th rowspan="2" class='textAlignCenter'> <?php echo lang('srno'); ?> </th>
                                    <th rowspan="2" class='textAlignCenter'> Dated </th>
                                    <th rowspan="2" class='textAlignCenter'> Voucher No </th>
                                    <th class='textAlignCenter'> Particulars </th> 
                                    <th rowspan="2" class='textAlignCenter'> Debit </th>
                                    <th rowspan="2" class='textAlignCenter'> Credit </th>
                                    <th rowspan="2" class='textAlignCenter'> Balance </th>  
                                </tr>
                                <tr>
                                     
                                    <th class='textAlignCenter'> Account Head </th>
                                     
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
        /*function expanse() {
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
        } */
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
        //document.getElementById("s_id").value=student_id; 
        //alert(student_id);
    request = $.ajax({
        url: "index.php/account/ajaxstudentDetailLedger", // ajaxClassExam
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
        alert(" Please Enter Correct Student Id.");
    }
    })
}
</script>
<script>  
function s_id(str) {
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
               xmlhttp.open("GET", "index.php/account/ajaxSnameSid?q=" + str, true);
               xmlhttp.send(); 
       }
</script>

