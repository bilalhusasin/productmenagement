<!-- Begin PAGE STYLES -->
<link href="assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet"/>
<link rel="stylesheet" type="text/css" href="assets/global/jquery_ui_css/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/><!-- Begin CONTENT -->
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
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- Begin Page Header-->
        <div class="row no-print">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                    <?php echo ('Student Fee Chalan Report'); ?> <small></small>
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
                            <i class="fa fa-search"></i><?php echo 'Search Fee Chalan Report information'; ?>
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
                            <div class="col-md-3 col-sm-12"> 
                                <div class="form-group">
                                   <select name="year" id="year" class="form-control" required="required"> 
                                        <option value="">Select Year...</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                    </select>
                                </div> 
                            </div>
                            <div class="col-md-3 col-sm-12"> 
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
                            <div class="number" id="totalAmount">
                                <?php echo $total_chalan_amount; ?>
                            </div>
                            <div class="desc">
                                <label  >Total WithOut Discount</label> 
                            </div>
                        </div>
                        <div  class="more dasTotalStudentTest">
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat red-intense">
                        <div class="visual">
                            <span class="icon-users totalTeacherSpan" aria-hidden="true"></span>
                        </div>
                        <div class="details">
                            <div class="number" id="discountedTotal">
                                <?php echo $Total_with_discount; ?>
                            </div>
                            <div class="desc">
                                <?php echo ('Total After Discount'); ?>
                            </div>
                        </div>
                        <div class="more dbilcss3">
                            <!-- <?php //echo lang('des_th_sys'); ?> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat green-haze">
                        <div class="visual">
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="details">
                            <div class="number" id="discountedAmount">
                                <?php echo $total_chalan_amount - $Total_with_discount; ?>
                            </div>
                            <div class="desc">
                                <?php echo ('Discounted Amount'); ?>
                            </div>
                        </div>
                        <div class="more dbilcss3"> </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat purple-plum">
                        <div class="visual">
                            <i class="fa fa-bar-chart-o"></i>
                        </div>
                        <div class="details">
                            <div class="number" id="totalPaid">
                                <?php echo $total_paid; ?>
                            </div>
                            <div class="desc">
                                <?php echo ('Total Paid Amount'); ?>
                            </div>
                        </div>
                        <div class="more dbilcss3">
                            <?php //echo lang('des_to_att_stu'); ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat yellow">
                        <div class="visual">
                            <i class="fa fa-bar-chart-o"></i>
                        </div>
                        <div class="details">
                            <div class="number" id="totalUnpaid">
                                <?php echo $total_unpaid; ?>
                            </div>
                            <div class="desc">
                                <?php echo ('Total Unpaid Amount'); ?>
                            </div>
                        </div>
                        <div class="more dbilcss3">
                            <?php //echo lang('des_to_att_stu'); ?>
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
                                <i class="fa fa-bullhorn"></i><?php echo ('Student Fee Chalan Graph'); ?>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <canvas id="myChart"></canvas> 
                            <div id="site_activities_content" class="display-none"> </div>
                        </div>
                    </div>
                    <!-- END PORTLET-->
                </div>
            </div>
            <div class="clearfix"> </div>
        <?php } ?>
        <?php if ($this->ion_auth->is_student()) { ?>
            <div class="row">
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
                                <a href="javascript:;" class="collapse"> </a>
                                <a href="javascript:;" class="reload"> </a>
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
                                <i class="fa fa-cogs"></i><?php echo ('Student Fee Chalan information'); ?>
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
                                        <th>Sr #</th>
                                        <th>Chalan No</th>
                                        <th>Chalan Month</th>
                                        <th>Chalan Year</th>
                                        <th>Student ID</th>
                                        <th>Student Name</th>
                                        <th>Class</th>
                                        <th>Section</th>
                                        <th>Discount Title</th>
                                        <th>Discount Percentage</th>
                                        <th>Tuition Fee</th>
                                        <th>AC Charges</th>
                                        <th>Total</th>
                                        <th>Discount</th>
                                        <th>Grand Total</th>
                                        <th>Paid Amount</th> 
                                    </tr>
                                </thead>
                                <tbody>
                            <?php $count=1; foreach ($stdInfo as $value) {?>
                                    <tr> 
                                        <td> <?php echo $count++; ?> </td>
                                        <td> <?php echo $value['voucher_number']; ?> </td>
                                        <td> <?php echo $value['month']; ?> </td>
                                        <td> <?php echo $value['year']; ?> </td>
                                        <td> <?php echo $value['student_id']; ?> </td>
                                        <td> <?php echo $value['student_nam']; ?> </td>
                                        <td> <?php echo $value['class_title']; ?> </td>
                                        <td> <?php echo $value['section']; ?> </td>
                                        <td> 
                                            <?php if($value['discount_id'] == 0){ echo "No Discount";}else{
                                            echo $this->common->discount_cod($value['discount_id']); }?>
                                        </td>
                                        <td> 
                                            <?php if($value['discount_id'] == 0){ echo "No Discount";}else{
                                            echo $this->common->dis_per($value['discount_id'])."%"; }?>
                                        </td>
                                        <td> <?php echo $value['tution_fee']; ?> </td>
                                        <td> <?php echo $value['ac_charges']; ?> </td>
                                        <td> <?php echo $value['amount']; ?> </td>
                                        <td> <?php echo $value['discount']; ?> </td>
                                        <td> <?php echo $value['dis_total']; ?> </td>
                                        <td> <?php echo $value['paid']; ?> </td> 
                                    </tr> 
                            <?php } ?>
                                </tbody>
                            </table> 
                        </div>
                    </div>
                </div>
            <?php }?> 
        </div>
        <div class="clearfix"></div> 
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
<!-- END PAGE LEVEL SCRIPTS --> 

<script>

var ctx = document.getElementById('myChart').getContext('2d');
// And for a doughnut chart

var myDoughnutChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
    datasets: [{
       data: [<?php echo $Active_stds; ?>, <?php echo $totalStudent- $Active_stds; ?>]
        ,
     backgroundColor: ["rgb(227, 91, 90)", "rgb(87, 142 ,190)"]
    }],

    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels: [
        'Total after discount',
        'total discounted amount'
    ]

},
    options: {},
    
});


data = {
    datasets: [{
        data: [<?php echo $Active_stds; ?>, <?php echo $totalStudent- $Active_stds; ?>, 30]
    }],

    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels: [
        'Total with discount',
        'Total given discounts',
        'Blue'
    ]
};
var myDoughnutChart = new Chart(ctx, {
    type: 'doughnut',
    data: data,
    options: options
});

</script>
<script>


window.onload = function () {

var chart = new CanvasJS.Chart("", {
    animationEnabled: true,
    title:{
        text: "Fee & Discounts",
        horizontalAlign: "left"
    },
    data: [{
        type: "doughnut",
        startAngle: 90,
        innerRadius: 40,
        indexLabelFontSize: 27,
        indexLabel: "{label} - #percent%",
        toolTipContent: "<b>{label}:</b> {y} (#percent%)",
        dataPoints: [
             { y: <?php echo $Active_stds; ?>, label: "Total with discount" },
            { y: <?php echo $totalStudent- $Active_stds; ?>, label: "Total given discounts"}
            
        ]
    }]
});
chart.render();

}


   
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


<script type="text/javascript">


function get_record(column, val)
    {
    //   var x= "<?php //echo site_url('home/ind_value'); ?>";
//alert(x);
var column_name = column;
var value = val;
var classz;
if(column_name=='section')
{
   // alert("abc");
classz= $("#classz").val();
if(classz!="")
{
    alert("mar");
//double_column("class", classz, "section", value);

$.ajax({
        url: 'home/double_value',
        type: 'GET',
        data: {
            col1: "class", val1: classz, col2: "section", val2: value 
        },
        dataType: 'text',
        
    }).done(function(result){
        alert(result);
          $("#datatable > tbody").empty();


          $.each(result, function(i, item) {
            
        var $tr = $('<tr>').append(
            $('<td>').text(i+1),
            $('<td>').text(item.voucher_number),
            $('<td>').text(item.month),
            $('<td>').text(item.student_id),
            $('<td>').text(item.student_nam),
            $('<td>').text(item.class_title),
            $('<td>').text(item.section),
            $('<td>').text(item.tution_fee),
            $('<td>').text(item.discount),
            $('<td>').text(item.dis_total)
          
        );
        //console.log($tr);
        $('#datatable').append($tr);
         
  });
          
          });




}

}

//var myTable=$("#datatable");
//alert(z);
// else{
if(value!=""){
 $.ajax({
        url: '/sms/index.php/home/ind_value',
        type: 'POST',
        data: {
            col: column_name, val: value 
        },
        dataType: 'json',
        
    }).done(function(result){
          //var response = JSON.stringify(result);
//          alert(typeof response);
   //       var xx= JSON.parse(result)
          $("#datatable > tbody").empty();
//console.log(result);
          $.each(result, function(i, item) {
            //alert("in");
        var $tr = $('<tr>').append(
            $('<td>').text(i+1),
            $('<td>').text(item.voucher_number),
            $('<td>').text(item.month),
            $('<td>').text(item.student_id),
            $('<td>').text(item.student_nam),
            $('<td>').text(item.class_title),
            $('<td>').text(item.section),
            $('<td>').text(item.tution_fee),
            $('<td>').text(item.discount),
            $('<td>').text(item.dis_total)
          
        );
        //console.log($tr);
        $('#datatable').append($tr);
         
  });
          
          });
}
//}

    }
 

</script>
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
    var monthName = document.getElementById("monthName").value;                            
    var className = document.getElementById("className").value;   
    var classSection = document.getElementById("classSection").value; 
    //alert(year + monthName + className + classSection);
    if(year == ''){
        alert ('Please Select Session First');
    } else if(monthName == ''){
        alert ('Please Select Month Name First');
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
        xmlhttp.open("GET", "index.php/home/ajaxStudentChalanReport?className=" + className + "&classSection=" + classSection + "&monthName=" + monthName + "&year=" + year, true);
        xmlhttp.send(); 
        TillData();
    }
     
}
function TillData(){
    var year = document.getElementById("year").value; 
    var monthName = document.getElementById("monthName").value;                            
    var className = document.getElementById("className").value;   
    var classSection = document.getElementById("classSection").value; 
    //alert(year + monthName + className + classSection );
       $.ajax({
            type: "POST",
            url: "index.php/home/ajaxStudentChalanReportTillData",
            data: {
                "year":year,
                "monthName":monthName, 
                "className":className,  
                "classSection":classSection, 
            },
            dataType: "json",

            //if received a response from the server
            success: function( datas, textStatus, jqXHR) {  
                //alert(datas.totalAmount - datas.discounteTotal); 
                $("#totalAmount").html(datas.totalAmount); 
                $("#discountedTotal").html(datas.discounteTotal);
                $("#discountedAmount").html(parseInt(datas.totalAmount) - parseInt(datas.discounteTotal));
                $("#totalPaid").html(datas.totalPaid); 
                $("#totalUnpaid").html(datas.totalUnpaid); 
            },
        }); 
} 
</script>