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
        size: landscape;
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
                    <?php echo ('Sibling Students Information'); ?> <small></small>
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
                            <i class="fa fa-search"></i><?php echo 'Search Siblings Student information'; ?>
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
                            <div class="col-md-3 col-sm-12"> 
                                <div class="form-group">
                                    <input class="form-control" type="text" name="f_cnic" id="f_cnic" maxlength="15" placeholder="xxxxx-xxxxxxx-x">
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
                                <div class="form-group">
                                    <select name="classSection" id="classSection" class="form-control">
                                        <option value="">Select Class Section...</option>  
                                    </select>
                                </div>
                            </div> 
                             
                            <div class="col-md-3 col-sm-12"> 
                                <div class="form-group">
                                    <input type="button" onclick ="filterSearch(this.value); " class="btn green" value="Submit" name="submit">
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
                    <div class="dashboard-stat blue-madison">
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
                    <div class="dashboard-stat red-intense">
                        <div class="visual">
                            <span class="icon-users totalTeacherSpan" aria-hidden="true"></span>
                        </div>
                        <div class="details">
                            <div class="number" id="siblingStudent">
                                <?php echo $siblingtotal; ?>
                            </div>
                            <div class="desc">
                                <?php echo ('Sibling Students'); ?>
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
                                <i class="fa fa-bullhorn"></i><?php echo ('Monthly Collections'); ?>
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
                                <i class="fa fa-cogs"></i><?php echo ('Sibling Students Information'); ?>
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
                                        <th> Registration Number </th>
                                        <th> Student ID </th> 
                                        <th> Student Name </th>
                                        <th> Father Name </th>
                                        <th> Father CNIC</th>
                                        <th> Class </th>
                                        <th> Section </th> 
                                        <th> Discount </th> 
                                        <th> Year </th>
                                        <th> Address </th>  
                                    </tr>
                                </thead> 
                                <tbody > 
                            <?php  
                            $arr = array(); 
                            // this array get value on page load
                            foreach ($stdInfo as $key => $item) {
                               $arr[$item['father_cnic']][$key] = $item;
                              
                            }
                            $count= 1;
                            // this array change 2 dimanstional array to array
                                foreach ($arr as $item1) {
                                    // this array show records in front view
                                    foreach ($item1 as $value) { ?> 
                                    <tr>
                                        <td><?php echo $count++; ?> </td> 
                                        <td><?php echo $value['registration_number']; ?> </td>
                                        <td><?php echo $value['student_id']; ?> </td>
                                        <td><?php echo $value['student_nam']; ?> </td>
                                        <td><?php echo $value['farther_name']; ?> </td>
                                        <td>
                                            <a href="" id="<?php echo $value['father_cnic']; ?>" data-toggle="modal" data-target="#myModal" onclick ="siblingDrildown(this.id)"  ><?php echo $value['father_cnic']; ?>
                                            </a> 
                                        </td>
                                        <td><?php echo $value['class_title']; ?> </td>
                                        <td><?php echo $value['section']; ?> </td>
                                        <td><?php echo $this->common->discount_cod($value['discount_cat']); ?> </td>
                                        <td><?php echo $value['year']; ?> </td>  
                                        <td><?php echo $value['permanent_address']; ?> </td>  
                                    </tr>
                            <?php   }
                                } ?>
                                </tbody> 
                            </table> 
                            <div class="scroller-footer">
                                <div class="btn-arrow-link pull-right">
                                    <a href="index.php/sclass/allClass"><?php echo lang('des_see_f_info'); ?></a>
                                    <i class="icon-arrow-right"></i>
                                </div>
                            </div>
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
 
$('#f_cnic').keydown(function(){

  //allow  backspace, tab, ctrl+A, escape, carriage return
  if (event.keyCode == 8 || event.keyCode == 9 
                    || event.keyCode == 27 || event.keyCode == 13 
                    || (event.keyCode == 65 && event.ctrlKey === true) )
                        return;
  if((event.keyCode < 48 || event.keyCode > 57))
   event.preventDefault();

  var length = $(this).val().length; 
              
  if(length == 5 || length == 13)
   $(this).val($(this).val()+'-');

 });
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
    var f_cnic= document.getElementById("f_cnic").value;                            
    var className= document.getElementById("className").value;   
    var classSection = document.getElementById("classSection").value; 
    //alert(className + classSection);
    // if(className == ''){
    //     alert ('Please Select Class Name First');
    // }   else{  
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
        xmlhttp.open("GET", "index.php/home/ajaxSiblingStudent?className=" + className + "&classSection=" + classSection + "&f_cnic=" + f_cnic, true);
        xmlhttp.send(); 
        TillData();
    //}
     
}
function TillData(){
    var f_cnic = document.getElementById("f_cnic").value;  
    var className = document.getElementById("className").value;   
    var classSection = document.getElementById("classSection").value; 
       //alert(className + classSection);
       $.ajax({
            type: "POST",
            url: "index.php/home/ajaxSiblingStudentsTillData",
            data: {
                "f_cnic" : f_cnic,
                "className":className,  
                "classSection":classSection, 
            },
            dataType: "json",

            //if received a response from the server
            success: function( datas, textStatus, jqXHR) {  
                //alert(datas.siblingStudent);
                $("#totalStudent").html(datas.totalStudent);   
                $("#activeStudent").html(datas.activeStudent);
                $("#siblingStudent").html(datas.siblingStudent); 
                // $("#maleStudent").html(datas.maleStudent); 
                // $("#femaleStudent").html(datas.femaleStudent); 
            },
        }); 
} 

// sibling drildown
function siblingDrildown(str) {
   var cnic = str; 
    // alert(cnic);
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
    xmlhttp.open("GET", "index.php/home/ajaxsiblingDrildown?f_cnic=" + cnic, false);

    xmlhttp.send();
}
</script>

 