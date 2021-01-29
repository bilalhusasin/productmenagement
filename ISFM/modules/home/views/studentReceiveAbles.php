<head>
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
        size: auto;
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
</head>
<!-- End PAGE STYLES -->
<!-- Begin CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- Begin Page Header-->
        <div class="row no-print">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                    <?php echo ('Fee Receiveables Report'); ?> <small></small>
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
        <div class="row no-print"> 
            <div class="col-md-12 col-sm-12">
                <div class="portlet purple box">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-search"></i><?php echo 'Search Student Receiveables information'; ?>
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
                            <div class="col-md-2 col-sm-12"> 
                                <div class="form-group">
                                    <select onchange="classSection(this.value)" name="className" id="className" class="form-control">
                                        <option value="">Select...</option>
                                    <?php foreach($classTile as $row){?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['class_title']; ?></option>
                                    <?php } ?>
                                    </select>
                                </div> 
                            </div>

                            <div class="col-md-2 col-sm-12"> 
                                <div class="form-group">
                                    <select name="classSection" id="classSection" class="form-control">
                                        <option value="">Select...</option>  
                                    </select>
                                </div> 
                            </div>

                            <div class="col-md-2 col-sm-12"> 
                                <div class="form-group">
                                    <input type="text" class="form-control" name="studentName" id="studentName" placeholder="Enter Student Name">
                                </div> 
                            </div>
                            <div class="col-md-2 col-sm-12"> 
                                <div class="form-group">
                                    <input type="number" class="form-control" name="monthid" id="monthid" placeholder="Enter Number">
                                </div> 
                            </div>
                            <div class="col-md-2 col-sm-12"> 
                                <!-- <div class="form-group">
                                    <input type="text" class="form-control" name="searchName">
                                </div>  -->
                            </div>
                            <div class="col-md-2 col-sm-12"> 
                                <div class="form-group">
                                    <input type="submit" onclick ="filterSearch(this.value); tillData();" class="btn green" value="Submit" name="submit">
                                </div> 
                            </div> 
                        </div> 
                    <?php // echo form_close(); ?> 
                    </div>
                </div>
            </div> 
        </div>
        <hr class="no-print">
        <!-- BEGIN DASHBOARD-->
        <?php if ($this->common->user_access('das_top_info', $userId)) { ?>
            <div class="row no-print">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat blue-madison">
                        <div class="visual">
                            <i class="fa fa-group"></i>
                        </div>
                        <div class="details">
                            <div class="number" id="totalAmount">
                                <?php echo $totalStudent; ?>
                            </div>
                            <div class="">
                                <?php echo ('Total Chalan Amount'); ?>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat red-intense">
                        <div class="visual">
                            <span class="icon-users totalTeacherSpan" aria-hidden="true"></span>
                        </div>
                        <div class="details">
                            <div class="number" id="total_receiveable">
                                <?php echo $totalReceiveable; ?>
                            </div>
                            <div class="desc" >
                                <?php echo ('Total Receiveables'); ?>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat green-haze">
                        <div class="visual">
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="details">
                            <div class="number" id= "total_received">
                                <?php echo $totalStudent-$totalReceiveable; ?>
                            </div>
                            <div class="desc">
                                <?php echo ('Total Received'); ?>
                            </div>
                        </div>
                       
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat purple-plum">
                        <div class="visual">
                            <i class="fa fa-bar-chart-o"></i>
                        </div>
                        <div class="details">
                            <div class="number" id="total_paid_vouch">
                                <?php echo $count_paid ?>
                            </div>
                            <div class="desc">
                                <?php echo ('Total Paid'); ?>
                            </div>
                        </div>
                       
                    </div>
                </div>
                 <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat purple-plum">
                        <div class="visual">
                            <i class="fa fa-bar-chart-o"></i>
                        </div>
                        <div class="details">
                            <div class="number" id="total_unpaid_vouch">
                                <?php echo $count_unpaid ?>
                            </div>
                            <div class="desc">
                                <?php echo ('Total UnPaid'); ?>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        <?php } //if($this->ion_auth->is_accountant()){?>
            <!-- <div class="row">
                <div class="col-md-12">
                    <a class="btn blue btn-block fee_button" onClick="javascript:return confirm('Are you sure you want to calculate all students fees for this month.')" href="index.php/account/end_stu_calcu" > Calculate Students Month End Fee </a>
                </div>
            </div> -->
        <?php //} 
        if ($this->common->user_access('das_grab_chart', $userId)) { ?>
            <div class="row no-print">
                <div class="col-md-12 col-sm-12">
                    <!-- BEGIN PORTLET-->
                    <div class="portlet green box">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-bullhorn"></i><?php echo (' Receiveables chart'); ?>
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
        <?php } ?>
        <?php if ($this->ion_auth->is_student()) { ?>
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
               
        <div class="row" id="filterdata">
            <?php if ($this->common->user_access('das_class_info', $userId)) { ?>
                <div class="col-md-12 col-sm-12 no-print">
                    <div class="portlet purple box">
                        <div class="portlet-title no-print">
                            <div class="caption">
                                <i class="fa fa-cogs no-print"></i>Student Receiveables information
                            </div>
                            <div class="tools">
                                <a class="collapse" href="javascript:;">
                                </a>
                                <a class="reload" href="javascript:;">
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body"> 
                            <table id="sample_1" class="table table-striped table-bordered table-hover" >
                                <thead>
                                    <tr> 
                                        <th>Sr #</th>
                                        <th>Student ID</th> 
                                        <th>Student Name</th>
                                        <th>Contact#</th> 
                                        <th>Class</th>
                                        <th>Section</th> 
                                        <th>Amount</th>
                                        <th>No of Months Overdue</th> 
                                    </tr>
                                </thead> 
                                <tbody> 
                            <?php
                                $count=1;
                                foreach ($stdInfo as $row) { ?>
                                    <tr>
                                        <td> <?php echo $count++; ?> </td>
                                        <td> <?php echo $row['student_id']; ?> </td>
                                        <td> <?php echo $row['student_nam']; ?> </td>
                                        <td> <?php echo $row['phone']; ?> </td>
                                        <td> <?php echo $row['class_title']; ?> </td>
                                        <td> <?php echo $row['section']; ?> </td>
                                        <td> <?php echo $row['amount']; ?> </td>
                                        <td> 
                                            <a href="" id="<?php echo $row['student_id']; ?>" data-toggle="modal" data-target="#myModal" onclick ="stdDrildown(this.id)"  > <?php echo $row['month']; ?> 
                                            </a>
                                        </td> 
                                    </tr>
                            <?php } ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            <?php }?> 
            <!-- index.php/account/student_vocher?student_id=<?php echo $row['student_id']; ?> -->
        </div>
          <div id="abcde"></div>
        <div class="clearfix"></div> 
         
    </div>
</div>
<!-- END CONTENT -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/extensions/Scroller/js/dataTables.scroller.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script src="assets/admin/pages/scripts/table-advanced.js"></script>  
 <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script> 

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
</script> 
<script>
function filterSearch(str) {
    var className= document.getElementById("className").value; 
    if(className == ''){
        alert ('Please Select Class Name');
    } else{ 
        var classSection = document.getElementById("classSection").value;
        var studentName = document.getElementById("studentName").value;
        var monthid = document.getElementById("monthid").value;
        
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
        xmlhttp.open("GET", "index.php/home/commonFilter?c_Name=" + className + "&c_Section=" + classSection + "&s_Name=" + studentName + "&m_Id=" + monthid, true);
        xmlhttp.send();
        //getdata();
    }
     
}
function tillData(){  
    var className= document.getElementById("className").value; 
    var classSection = document.getElementById("classSection").value;
    var studentName = document.getElementById("studentName").value;
    var monthid = document.getElementById("monthid").value;
    //alert(className);
       $.ajax({
            type: "POST",
            url: "index.php/home/ajaxCommonFilterTillData",
            data: {
                "className":className,
                "classSection":classSection,
                "studentName":studentName,
                "monthid":monthid,
            },
            dataType: "json",

            //if received a response from the server
            success: function( datas, textStatus, jqXHR) {  
                 //alert(datas.totalamount);
                $("#totalAmount").html(datas.totalamount); 

                 //alert(datas.data1);
                $("#total_receiveable").html(datas.data1); 

                 //alert(datas.totalPaid);
                 $("#total_received").html(datas.totalPaid);

                  //alert(datas.paid);
                 $("#total_paid_vouch").html(datas.paid); 

                 //alert(datas.unpaid);
                 $("#total_unpaid_vouch").html(datas.unpaid);
 
            },
        }); 
} 
//  
function stdDrildown(str) {
   var student_id = str; 
    //document.getElementById("abs").innerHTML = student_id;
    var xmlhttp;
    if (str.length === 0) {
        document.getElementById("abcde").innerHTML = "";
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
                document.getElementById("abcde").innerHTML = xmlhttp.responseText;
            }
        };
    xmlhttp.open("GET", "index.php/home/ajaxStdDrildown?std=" + student_id, false);

    xmlhttp.send();
}

</script>  

<script>

var ctx = document.getElementById('myChart').getContext('2d');
// And for a doughnut chart

var myDoughnutChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
    datasets: [{
       data: [ <?php echo $totalReceiveable; ?>,  <?php echo $Deactive_stds; ?>]
        ,
     backgroundColor: ["rgb(75, 192, 192)", "rgb(54, 162, 235)"]
    }],

    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels: [
       
        'Total Receiveables',
        'Total Received'
    ]

},
    options: {},
    
});


data = {
    datasets: [{
        data: [30, 35, 40]
    }],

    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels: [
        'Total with discount',
        'Total given discounts',
        'Total without discount'
    ]
};
var myDoughnutChart = new Chart(ctx, {
    type: 'doughnut',
    data: data,
    options: options
});

    //// graph part //// 
    
</script>
 