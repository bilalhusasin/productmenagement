<!-- Begin PAGE STYLES --> 
<link href="assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet"/>
<link rel="stylesheet" type="text/css" href="assets/global/jquery_ui_css/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<style media="print">
    @page{ 
        margin: 25px !important;
        size: portrait;
    }  
    .no-print{
        display: none;
    }
    .display{ 
        display: block !important; 
    } 
    .table{
        margin-bottom: 0px !important;
    }
        /* avoid cutting tr's in half */
    
    div table  {  
    }
     
    .table_print {
    table-layout: fixed !important;
    width: 33%;
    float: left;
    font-size: 6px !important;
    overflow: none;
      }
     td{
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: normal;
    overflow-wrap: break-word;
    padding-top: 6px !important;
    padding-bottom: 6px !important;
    font-size: 8px !important;
      }
      th{
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: normal;
    overflow-wrap: break-word;
    padding-top: 6px !important;
    padding-bottom: 6px !important;
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
        .display{ 
        display: none; 
    }
    </style> 
<!-- Begin CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- Begin Page Header-->
        <div class="row no-print">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                    <?php echo ('Daily Recovery Report'); ?> <small></small>
                </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <?php echo lang('des_home'); ?>
                    </li>
                    <li id="result" class="pull-right topClock"></li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <?php
        $user = $this->ion_auth->user()->row();
        $userId = $user->id;
        ?>
        <!-- BEGIN DASHBOARD-->
        <div class="row no-print"> 
            <div class="col-md-12 col-sm-12">
                <div class="portlet purple box">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-search"></i><?php echo 'Search Daily Recovery Report'; ?>
                        </div>
                        <div class="tools">
                            <a class="collapse" href="javascript:;">
                            </a>
                            <a class="reload" href="javascript:;">
                            </a>
                        </div>
                    </div>

                    <div class="portlet-body"> 
                    <?php 
                        /*$form_attributs = array('class' => 'form-horizontal', 'role' => 'form');
                        echo form_open('home/commonFilter', $form_attributs);*/
                         
                        
                    ?>
                    <div class="row ">
                        <div class="col-md-12">    
                            <div class="col-md-2 col-sm-12"> 
                                <div class="form-group">
                                   <select name="year" id="year" class="form-control" required="required"> 
                                        <option value="">Select Year...</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                    </select>
                                </div> 
                            </div>
                            <div class="col-md-2 col-sm-12"> 
                                <div class="form-group">
                                   <select name="monthName" id="monthName" class="form-control" required="required"> 
                                        <option value="">Select Month...</option>
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
                            <div class="col-md-2 col-sm-12"> 
                                <div class="form-group">
                                   <select name="mathodName" id="mathodName" class="form-control" required="required"> 
                                        <option value="">Select Mathod...</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Bank">Bank</option>
                                    </select>
                                </div> 
                            </div>    
                            <div class="col-md-2 col-sm-12"> 
                                <div class="form-group">
                                    <select onchange="classSection(this.value)" name="className" id="className" class="form-control" required="required">
                                        <option value="">Select Class Title...</option>
                                    <?php foreach($classTile as $row){?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['class_title']; ?></option>
                                    <?php } ?>
                                    </select>
                                </div> 
                            </div>
                            <div class="col-md-2 col-sm-12"> 
                                <div class="form-group">
                                    <select name="classSection" id="classSection" class="form-control">
                                        <option value="">Select Class Section...</option>  
                                    </select>
                                </div>
                            </div>  
                            <div class="col-md-2 col-sm-12"> 
                                <div class="form-group">
                                    <input type="button" onclick ="filterSearch(this.value); " class="btn green" value="Submit" name="submit">
                                </div> 
                            </div> 
                        </div>
                    </div> 
                    <?php // echo form_close(); ?> 
                    </div>
                </div>
            </div> 
        </div>
        <hr class="no-print">
        <?php if ($this->common->user_access('das_top_info', $userId)) { ?>
            <div class="row no-print">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat blue-madison">
                        <div class="visual">
                            <i class="fa fa-group"></i>
                        </div>
                        <div class="details">
                            <div class="number" id="totalStudent">
                                <?php echo $totalStudent; ?>
                            </div>
                            <div class="desc">
                                <?php echo ('Total Students '); ?>
                            </div>
                        </div>
                        <div class="more dasTotalStudentTest">
                            <?php echo (''); ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat yellow">
                        <div class="visual">
                            <i class="fa fa-group"></i>
                        </div>
                        <div class="details">
                            <div class="number" id="activeStudent">
                                <?php echo $activeStudent; ?>
                            </div>
                            <div class="desc">
                                <?php echo ('Active Students '); ?>
                            </div>
                        </div>
                        <div class="more dasTotalStudentTest">
                            <?php echo (''); ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat purple">
                        <div class="visual">
                            <i class="fa fa-group"></i>
                        </div>
                        <div class="details">
                            <div class="number" id="paidVoucher">
                                <?php echo $paidVouchers; ?>
                            </div>
                            <div class="desc">
                                <?php echo ('Paid Vouchers '); ?>
                            </div>
                        </div>
                        <div class="more dasTotalStudentTest">
                            <?php echo (''); ?>
                        </div>
                    </div>
                </div> 
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat red-intense">
                        <div class="visual">
                            <span class="icon-users totalTeacherSpan" aria-hidden="true"></span>
                        </div>
                        <div class="details">
                            <div class="number" id="totalPaid">
                                <?php echo $totalPaid + $overDue + $onlineTotalPaid + $onlineOverDue; ?>
                            </div>
                            <div class="desc">
                                <?php echo ('Grand Total'); ?>
                            </div>
                        </div>
                        <div class="more dbilcss3">
                            <?php echo (''); ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat green box">
                        <div class="visual">
                            <span class="icon-users totalTeacherSpan" aria-hidden="true"></span>
                        </div>
                        <div class="details">
                            <div class="number" id="totalFee">
                                <?php echo $totalFee; ?>
                            </div>
                            <div class="desc">
                                <?php echo ('Expected Total'); ?>
                            </div>
                        </div>
                        <div class="more dbilcss3">
                            <?php echo (''); ?>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat green-haze">
                        <div class="visual">
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="details">
                            <div class="number" id="maleStudent">
                                 <?php echo $maleStudent; ?>
                            </div>
                            <div class="desc">
                                <?php echo ('Male Students'); ?>
                            </div>
                        </div>
                        <div class="more dbilcss3"> 
                            <?php echo (''); ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat purple-plum">
                        <div class="visual">
                            <i class="fa fa-female"></i>
                        </div>
                        <div class="details">
                            <div class="number" id="femaleStudent">
                                <?php echo $femaleStudent; ?>
                            </div>
                            <div class="desc">
                                <?php echo ('Female Students'); ?>
                            </div>
                        </div>
                        <div class="more dbilcss3">
                            <?php echo (''); ?>
                        </div>
                    </div>
                </div> -->
            </div>
            <div class="clearfix"></div>
        <?php } if ($this->common->user_access('das_grab_chart', $userId)) { ?>
            <div class="row no-print">
                <div class="col-md-12 col-sm-12">
                    <!-- BEGIN PORTLET-->
                    <div class="portlet green box">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-bullhorn"></i><?php echo ('Daily Recovery Report'); ?>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <canvas id="myChart"></canvas>
                            <div id="site_activities_content" class="display-none">
                                
                            </div>
                        </div>
                    </div>
                    <!-- END PORTLET-->
                </div>
            </div>
            <div class="clearfix">
            </div>
        <?php } if ($this->ion_auth->is_student()) { ?>
            <div class="row no-print">
                <div class="col-md-12 ">
                    <!-- BEGIN SAMPLE FORM PORTLET-->
                    <div class="portlet box green ">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-bars"></i><?php
                                $class_id;
                                echo $this->common->class_title($class_id);
                                ?> <?php echo lang('des_ful_rou'); ?>.
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse">
                                </a>
                                <a href="javascript:;" class="reload">
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body form">

                            <div class="alert alert-warning">
                                <div class="portlet-body">
                                    <?php
                                    foreach ($day as $row3) {
                                        $dayTitle = $row3['day_name'];
                                        $dayStatus = $row3['status'];
                                        ?>
                                        <div class="row">
                                            <div class="col-md-12 dbilcss5">
                                                <div class="col-sm-2 day <?php echo $dayStatus; ?>">
                                                    <?php echo $dayTitle; ?>
                                                </div>
                                                <?php
                                                //$query = array();
                                                $query = $this->common->getWhere22('class_routine', 'day_title', $dayTitle, 'class_id', $class_id);
                                                foreach ($query as $row4) {
                                                    ?>
                                                    <div class="">
                                                        <div class="col-sm-2 effect left_to_right dbilcss6">
                                                            <div class="backDiv subject">
                                                                <p class="dbilcss7"><?php echo $row4['subject']; ?></p>
                                                                <p class="dbilcss7"><?php echo $row4['subject_teacher']; ?></p>
                                                                <p class="dbilcss8"><?php echo $row4['start_time']; ?> - <?php echo $row4['end_time']; ?></p>
                                                                <p class="dbilcss8">Rome: <?php echo $row4['room_number']; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END SAMPLE FORM PORTLET-->
                </div>
            </div>
        <?php } ?>        
        <div class="row " id="filterdata">
            <?php if ($this->common->user_access('das_class_info', $userId)) { ?>
                <div class="col-md-12 col-sm-12">
                    <div class="portlet purple box">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-cogs"></i><?php echo ('Daily Recovery Report'); ?>
                            </div>
                            <div class="tools">
                                <a class="collapse" href="javascript:;"> </a>
                                <a class="reload" href="javascript:;"> </a>
                            </div>
                        </div>
                        <div class="portlet-body"> 
                            <table id="sample_1" class="table table-striped table-hover">
                                <thead>
                                    <tr> 
                                        <th> Sr.# </th>  
                                        <th> Current Date </th>
                                        <th> Current Month </th> 
                                        <th> OverDue </th> 
                                        <th> Total</th> 
                                        <th> Online Recovery (Current)</th>
                                        <th> Online Recovery (OverDue) </th> 
                                        <th> Online Total </th> 
                                        <th> Grand Total </th>
                                        <th> Month To Date </th> 
                                        <th> Expected Total </th> 
                                    </tr>
                                </thead> 
                                <tbody >  
                                    <tr>
                                        <td> 1 </td> 
                                        <td> <?php echo date('d-m-Y');?></td>
                                        <td> <?php echo $totalPaid; ?> </td>
                                        <td> <?php echo $overDue; ?> </td> 
                                        <td> <?php echo $total = ($totalPaid + $overDue); ?> </td> 
                                        <td> <?php echo $onlineTotalPaid; ?></td>
                                        <td> <?php echo $onlineOverDue; ?></td>
                                        <td> <?php echo $onlinetotal = ($onlineTotalPaid + $onlineOverDue); ?></td>
                                        <td> <?php echo $total + $onlinetotal; ?></td>
                                        <td> <?php echo $total + $onlinetotal; ?></td>
                                        <td> <?php echo $totalFee; ?> </td>  
                                    </tr> 
                                </tbody> 
                            </table> 
                            <!-- <div class="scroller-footer">
                                <div class="btn-arrow-link pull-right">
                                    <a href="index.php/sclass/allClass"><?php echo lang('des_see_f_info'); ?></a>
                                    <i class="icon-arrow-right"></i>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            <?php }?>  
        </div>
        <div id="abcde"></div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- END CONTENT -->
 
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/extensions/Scroller/js/dataTables.scroller.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script src="assets/admin/pages/scripts/table-advanced.js"></script>
  
<script>

function classSection(str) {
    var xmlhttp;
    if (str.length === 0) {
        document.getElementById("classSection").innerHTML = "";
        return;
    }
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                document.getElementById("classSection").innerHTML = xmlhttp.responseText;
            }
        };
    xmlhttp.open("GET", "index.php/home/ajaxClassSectionApp?q=" + str, true);
    xmlhttp.send();
}
function filterSearch(str) {
    var year = document.getElementById("year").value;
    var mathodName = document.getElementById("mathodName").value;
    var monthName = document.getElementById("monthName").value;                            
    var className = document.getElementById("className").value;   
    var classSection = document.getElementById("classSection").value; 
    //alert(year + monthName + className + classSection);
    if(year == ''){
        alert ('Please Select Session First');
    } else if(monthName == ''){
        alert ('Please Select Month Name First');
    } else if(mathodName == ''){
        alert ('Please Select Mathod First');
    } else{  
        var xmlhttp;
        if (str.length === 0) {
            document.getElementById("filterdata").innerHTML = "";
            return;
        }
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                    document.getElementById("filterdata").innerHTML = xmlhttp.responseText;
                }
            };
        xmlhttp.open("GET", "index.php/home/ajaxRecoveryReport?className=" + className + "&classSection=" + classSection + "&monthName=" + monthName + "&mathodName=" + mathodName + "&year=" + year, true);
        xmlhttp.send(); 
        TillData();
    }
     
}
function TillData(){
    var year = document.getElementById("year").value;
    var mathodName = document.getElementById("mathodName").value;
    var monthName = document.getElementById("monthName").value;                            
    var className = document.getElementById("className").value;   
    var classSection = document.getElementById("classSection").value; 
    //alert(year + mathodName + monthName + className + classSection );
       $.ajax({
            type: "POST",
            url: "index.php/home/ajaxRecoveryReportTillData",
            data: {
                "year":year,
                "mName":monthName,
                "mathName":mathodName,
                "clName":className,  
                "clSection":classSection, 
            },
            dataType: "json",

            //if received a response from the server
            success: function( datas, textStatus, jqXHR) {  
                //alert(datas.overDue);
                // $("#totalStudent").html(datas.totalStudent);   
                // $("#activeStudent").html(datas.activeStudent);
                $("#paidVoucher").html(datas.paidVoucher); 
                $("#totalPaid").html(datas.totalPaid); 
                $("#totalFee").html(datas.totalFee); 
            },
        }); 
} 

// sibling drildown
// function siblingDrildown(str) {
//    var cnic = str; 
//     // alert(cnic);
//     //document.getElementById("abs").innerHTML = student_id;
//     var xmlhttp;
//     if (str.length === 0) {
//         document.getElementById("abcde").innerHTML = "";
//         return;
//     }
//     if (window.XMLHttpRequest) {
//         // code for IE7+, Firefox, Chrome, Opera, Safari
//         xmlhttp = new XMLHttpRequest();
//     } else {
//         // code for IE6, IE5
//         xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
//     }
//         xmlhttp.onreadystatechange = function() {
//             if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
//                 document.getElementById("abcde").innerHTML = xmlhttp.responseText;
//             }
//         };
//     xmlhttp.open("GET", "index.php/home/ajaxsiblingDrildown?f_cnic=" + cnic, false);

//     xmlhttp.send();
// }
</script>

 