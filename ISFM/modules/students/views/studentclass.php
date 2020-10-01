<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<!-- END PAGE LEVEL STYLES -->
<?php $user = $this->ion_auth->user()->row();
$userId = $user->id; ?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                    <?php echo lang('stu_clas_pageTitle'); ?> <small></small>
                </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <?php echo lang('home'); ?>
                        
                    </li>
                    <li>
                        <?php echo lang('header_stu_paren'); ?>
                        
                    </li>
                    <li>
                        <?php echo lang('header_stude'); ?>
                        
                    </li>
                    <li>
                        <?php echo lang('header_stu_info'); ?>
                        
                    </li>
                    <li>
                    <?php echo $this->common->class_title($class_id); ?> 
                    </li>
                    <li id="result" class="pull-right topClock"></li>
                </ul>
                <button onclick="location.href = 'javascript:history.back()'" class="btn white" type="button"> <?php echo lang('back'); ?> </button>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->        
        <!-- BEGIN PAGE CONTENT-->        
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <?php echo $this->common->class_title($class_id) .' '.$status. " Student Information Section";
                            if (!empty($section)) {
                                echo "&nbsp".$section;
                            }
                            ?>    
                        </div>
                        <div class="tools"> </div> 
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                                <tr>
                                    <th><?php echo lang('stu_clas_Student_ID'); ?></th>
                                    <th><?php echo lang('stu_clas_Roll_No'); ?> </th>
                                    <th> <?php echo lang('stu_clas_Photo'); ?> </th>
                                    <th> Class Title </th>
                                    <th> Class Section </th>
                                    <th> <?php echo lang('stu_clas_Student_Name'); ?> </th>
                                    <th> <?php echo lang('stu_clas_Phone_No'); ?> </th>
                                    <th> <?php echo lang('stu_clas_Address'); ?> </th>
                                    <th> Status </th>
                                    <th> <?php echo lang('stu_clas_Actions'); ?> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($studentInfo as $row) {
                                    // get student information from "student_info" table.
                                    $studentId=$row['student_id'];
                                    $rollnumber=$row['roll_number'];
                                    $photo = $row['student_photo'];
                                    $class = $row['class_title'];
                                    $section = $row['section'];
                                    $stuname = $row['student_nam'];
                                    $phone=$row['phone'];
                                    $address = $row['present_address'];
                                    $status = $row['status'];
                                    ?>
                                    <tr>
                                        <td><?php echo $studentId; ?></td>
                                        <td><?php echo $rollnumber; ?> </td>
                                        <td>
                                            <div class="tableImage">
                                                <img src="assets/uploads/<?php echo $photo; ?>" alt="">
                                            </div>
                                        </td>
                                        <td><?php echo $class; ?> </td>
                                        <td><?php echo $section; ?> </td>
                                        <td><?php echo $stuname; ?> </td>
                                        <td><?php echo $phone; ?> </td>
                                        <td><?php echo $address; ?></td>
                                        <td>
                                        <?php 
                                         if($status=="Active"){ 
                                            echo '<span class="label label-sm label-success">'.$status.'</span>';
                                          }elseif($status=="Defaulter"){ 
                                            echo '<span class="label label-sm label-danger">'.$status.'</span>';
                                          }elseif($status=="Schoolleft"){ 
                                            echo '<span class="label label-sm" style="background-color: #1e0e0e;">'.$status.'</span>';
                                          }
                                        ?>
                                        </td>
                                        <td >
                                            <a class="btn btn-xs green tableActionButtonMargin" href="index.php/students/students_details?id=<?php echo $row['id']; ?>&sid=<?php echo $studentId; ?>" title="Detail Student Info"> <i class="fa fa-file-text-o"></i> <?php // echo lang('stu_clas_Details'); ?> </a>
                                            
                                            <?php if($this->common->user_access('stud_edit_delete',$userId)){ ?>
                                                <a class="btn btn-xs default tableActionButtonMargin" href="index.php/students/editStudent?id=<?php echo $row['id']; ?>&sid=<?php echo $studentId; ?>&class_id=<?php echo $class_id; ?>&section=<?php echo $section; ?>" title="Edit Student Info"> <i class="fa fa-pencil-square"></i> <?php // echo lang('stu_clas_Edit'); ?> </a>
                                                
                                                <a class="btn btn-xs red tableActionButtonMargin" href="index.php/students/delete?id=<?php echo $row['id']; ?>&sid=<?php echo $studentId; ?>" onClick="javascript:return confirm('Are you sure you want to delete this student?')" title="Delete Student Info"> <i class="fa fa-trash-o"></i> <?php // echo lang('stu_clas_Delete'); ?> </a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div> 
                <!-- END EXAMPLE TABLE PORTLET--> 
            </div>
        </div>
        <!-- END PAGE CONTENT-->
    </div>
</div>
<!-- END CONTENT -->


<!--Begin Page Level Script-->
<script type="text/javascript" src="assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<script src="assets/admin/pages/scripts/table-advanced.js"></script>
<!--End Page Level Script-->
<script>
    jQuery(document).ready(function() {
        //here is auto reload after 1 second for time and date in the top
        jQuery(setInterval(function() {
            jQuery("#result").load("index.php/home/iceTime");
        }, 1000));
    });
</script>
