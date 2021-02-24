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
</head>
  
<!-- End PAGE STYLES -->
<!-- Begin CONTENT -->
<div class="page-content-wrapper ">
    <div class="page-content">
        <!-- Begin Page Header-->
        <div class="row no-print">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                    <?php echo ('Registration Report'); ?> <small></small>
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
                            <i class="fa fa-search"></i><?php echo 'Search Student information'; ?>
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
                                    <select name="classSession" id="classSession" class="form-control">
                                        <option value="">Select Status...</option>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>  
                                    </select>
                                </div> 
                            </div> 
                            <div class="col-md-3 col-sm-12"> 
                                <div class="form-group">
                                    <select onchange="classSection(this.value)" name="className" id="className" class="form-control" required="required">
                                        <option value="">Select Class Title...</option>
                                    <?php foreach($classTile as $row){?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['class_title']; ?></option>
                                    <?php } ?>
                                    </select>
                                </div> 
                            </div>

                            <div class="col-md-3 col-sm-12"> 
                                  
                            </div>

                            <div class="col-md-2 col-sm-12"> 
                                <!-- <div class="form-group">
                                    <select name="status" id="status" class="form-control">
                                        <option value="">Select Status...</option>
                                        <option value="Active">Active</option>
                                        <option value="Deactive">Deactive</option>
                                        <option value="Schoolleft">Schoolleft</option>
                                        <option value="Defaulter">Defaulter</option> 

                                    </select>
                                </div>  -->
                            </div> 
                            <div class="col-md-2 col-sm-12"> 
                                <div class="form-group">
                                    <input type="button" onclick =" filterSearch(this.value); " class="btn green" value="Submit" name="submit">
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
                            <div class="number" id="total_Resgiter_Student">
                                <?php echo $totalStudent; ?>
                            </div>
                            <div class="desc">
                                <?php echo ('Total Students'); ?>
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
                            <div class="number" id="paid_Register_Student">
                                <?php echo $paid_registration_fee; ?>
                            </div>
                            <div class="desc">
                                <?php echo ('Paid Students'); ?>
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
                            <div class="number" id="unpaid_Register_Student">
                                <?php echo $unpaid_registration_fee; ?>
                            </div>
                            <div class="desc">
                                <?php echo ('Unpaid Students'); ?>
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
                            <div class="number" id="total_Paid_Register_Fee">
                                <?php echo $total_paid_reg_fee; ?>
                            </div>
                            <div class="desc">
                                <?php echo ('Total Amount'); ?>
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
                            <div class="number" id="total_Registration_Fee">
                                <?php echo $aspected_total; ?>
                            </div>
                            <div class="desc">
                                <?php echo ('Expected Amount'); ?>
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
                                <i class="fa fa-bullhorn"></i><?php echo ('Class wise Registration Trend'); ?>
                            </div>
                        </div>
                        <div class="portlet-body">
                          <canvas id="myChart"></canvas>
                                </div>

                           
                            <div id="site_activities_content" class="display-none">
                                
                            </div>
                        </div>
                    </div>
                    <!-- END PORTLET-->
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
        <div class="row " id="filterdata">
            <?php if ($this->common->user_access('das_class_info', $userId)) { ?>
                <div class="col-md-12 col-sm-12">
                    <div class="portlet purple box">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-cogs"></i><?php echo ('Student Registration information'); ?>
                            </div>
                            <div class="tools">
                                <a class="collapse" href="javascript:;"></a>
                                <a class="reload" href="javascript:;"></a>
                            </div>
                        </div>
                        <div class="portlet-body"> 
                            <table id="sample_1" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th> Date</th>
                                        <th> Session</th>
                                        <th> Student Reg</th>
                                        <th> Student Name</th>
                                        <th> Father Name</th>
                                        <th> Father CNIC</th>
                                        <th> Class</th>
                                        <th> Gender</th>
                                        <th> Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                foreach ($stdInfo as $value) { ?>
                                    <tr>
                                        <td><?php echo $value['reg_date']; ?> </td>
                                        <td><?php echo $value['session']; ?> </td>
                                        <td><?php echo $value['reg_number']; ?> </td>
                                        <td><?php echo $value['student_nam']; ?> </td>
                                        <td><?php echo $value['father_name']; ?> </td>
                                        <td><?php echo $value['father_cnic']; ?> </td>
                                        <td><?php echo $value['class_title']; ?> </td>
                                        <td><?php echo $value['gender']; ?> </td>
                                        <td><?php echo $value['total']; ?> </td>
                                    </tr>
                                <?php } ?>
                                </tbody> 
                            </table> 
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        </div> 
        <!-- END DASHBOARD STATS -->
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
function filterSearch(str) {
    var className= document.getElementById("className").value;  
    var classSession = document.getElementById("classSession").value;
    
    if(classSession == ''){
        alert ('Please Select Class Session');
    }   else{  
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
        xmlhttp.open("GET", "index.php/home/ajaxStudentRegisterReport?className=" + className + "&classSession=" + classSession, true);
        xmlhttp.send(); 
        TillData();
    }
     
}
function TillData(){  
    var className= document.getElementById("className").value;  
    var classSession = document.getElementById("classSession").value; 
    //alert(className);
       $.ajax({
            type: "POST",
            url: "index.php/home/ajaxStudentRegisterReportTillData",
            data: {
                "className":className, 
                "classSession":classSession,
            },
            dataType: "json",

            //if received a response from the server
            success: function( datas, textStatus, jqXHR) {  
                //alert(datas.totalRegisterStudent);
                $("#total_Resgiter_Student").html(datas.totalRegisterStudent);   
                $("#paid_Register_Student").html(datas.totalPaidRegisterStudent);
                $("#unpaid_Register_Student").html(datas.totalUnpaidRegisterStudent); 
                $("#total_Paid_Register_Fee").html(datas.totalPaidAmount); 
                $("#total_Registration_Fee").html(datas.totalRegistrationFee); 
            },
        }); 
} 
</script>

<script>

//var ctx = document.getElementById('myChart').getContext('2d');
var canvas = document.getElementById('myChart');
var data = {
    labels: [
<?php
foreach ($date_wise_students as $cap) {
    echo "'" . $cap['title'] . "', ";
}
?>
    ],
    datasets: [
        {
            label: "Registration amount with respect to class",
            backgroundColor: "rgb(227, 91, 90)",
            borderColor: "rgba(255,99,132,1)",
            borderWidth: 2,
            hoverBackgroundColor: "rgba(255,99,132,0.4)",
            hoverBorderColor: "rgba(255,99,132,1)",
            data: [
<?php
foreach ($date_wise_students as $cap) {
    echo $cap['sumz'].",";
}
?>
            ],
        }




    ]
};
var option = {
animation: {
                duration:5000
}

};


var myBarChart = Chart.Bar(canvas,{
    data:data,
  options:option
});

</script>





<script>
    //// graph part //// 
<?php
/*foreach ($date_wise_students as $cap) {
    echo "['" . $cap['count_year'] . "', " . $cap['id'] . "],";
}*/
?>
           
</script>


<script>

    jQuery(document).ready(function () {
        if (!jQuery().fullCalendar) {
            return;
        }
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

        var h = {};


        $('#calendar').fullCalendar('destroy'); // destroy the calendar
        $('#calendar').fullCalendar({//re-initialize the calendar
            header: h,
            defaultView: 'month', // change default view with available options from http://arshaw.com/fullcalendar/docs/views/Available_Views/ 
            slotMinutes: 15,
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar !!!
            drop: function (date, allDay) { // this function is called when something is dropped

                // retrieve the dropped element's stored Event Object
                var originalEventObject = $(this).data('eventObject');
                // we need to copy it, so that multiple events don't have a reference to the same object
                var copiedEventObject = $.extend({}, originalEventObject);

                // assign it the date that was reported
                copiedEventObject.start = date;
                copiedEventObject.allDay = allDay;
                copiedEventObject.className = $(this).attr("data-class");

                // render the event on the calendar
                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }
            },
            events: [
<?php
foreach ($event as $eve) {
    $title = $eve['title'];
    $star_date = explode("-", $eve['start_date']);
    $s_d = $star_date[0];
    $s_m = $star_date[1] - 1;
    $s_y = $star_date[2];
    $end_date = explode("-", $eve['end_date']);
    $e_d = $end_date[0];
    $e_m = $end_date[1] - 1;
    $e_y = $end_date[2];
    $color = $eve['color'];
    $url = $eve['url'];
    echo '{title: "' . $eve['title'] . '",
                        start: new Date(' . $s_y . ',' . $s_m . ',' . $s_d . '),
                        end: new Date(' . $e_y . ',' . $e_m . ',' . $e_d . '),
                        backgroundColor: Metronic.getBrandColor("' . $color . '"),
                        url: "' . $url . '",},';
}
?>
            ]
        });
    });

    var $p = $('#ellipsis p');
    var divh = $('#ellipsis').height();
    while ($p.outerHeight() > divh) {
        $p.text(function (index, text) {
            return text.replace(/\W*\s(\S)*$/, '...');
        });
    }
</script>
