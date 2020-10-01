<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                <?php echo lang('sub_for_class'); ?> <small></small>
                </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <i class="fa fa-home"></i><?php echo lang('home'); ?>
                        
                    </li>
                    <li>
                        <?php echo lang('sub_subject'); ?>
                        
                    </li>
                    <li>
                        <?php echo lang('header_all_subject'); ?>
                    </li>
                    <li id="result" class="pull-right topClock"></li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12 ">
                <?php
                if (!empty($success)) {
                echo $success;
                }
                ?>
                <!-- BEGIN SAMPLE FORM PORTLET-->
                <div class="portlet box green ">
                    <div class="portlet-title">
                        <div class="caption">
                            <?php $class_id =$this->input->get('c_id');
                            echo $this->common->class_title($class_id)." All Subjects.";
                            // echo lang('sub_all_subject');
                            ?>
                        </div>
                        <div class="tools">
                            <a href="" class="collapse">
                            </a>
                            <a href="" class="reload">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form subjectDetailsPadintTop">
                        <div class="col-sm-10 col-sm-offset-1">
                            <div class="row">
                                <table class="table table-striped table-bordered table-hover" id="sample_1">
                                    <thead>
                                        <tr>
                                            <th>
                                                #
                                            </th>
                                            <th>
                                                 Subject Title
                                            </th>
                                            <th>
                                                 Subject Writer
                                            </th>
                                            <th>
                                               Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $i=1;
                                        foreach ($SubjectInfo as $row) { ?>
                                        <tr>
                                            <td>
                                                <?php echo $i; ?>
                                            </td>
                                            <td>
                                                <?php  // echo $row['id']; ?>
                                                <?php  echo $row['subject_title']; ?>
                                                <?php  // echo $row['class_id']; ?>
                                            </td>
                                            <td>
                                                <?php  echo $row['writer_name']; ?>
                                            </td>
                                            <td>
                                                <a class="btn btn-xs green" href="index.php/subjects/classSubjectEdit?s_id=<?php echo $row['id'];?>&c_id=<?php echo $row['class_id'];?>" title="Edit Subject"> <i class="fa fa-pencil"></i> </a>
                                                
                                                <a class="btn btn-xs red" href="index.php/subjects/classSubjectDelete?s_id=<?php echo $row['id'];?>&c_id=<?php echo $row['class_id'];?>" onClick="javascript:return confirm('Are you sure you want to delete this Subject?')"title="Delete Subject"> <i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <?php $i++; } ?>
                                    </tbody>
                                </table>
                                <!-- <div class="col-sm-12">
                                    <?php foreach ($SubjectInfo as $row) { ?>
                                    <div class="alert alert-info">
                                        <h2 class="marginTopNone"><?php echo $row['subject_title']; ?></h2>
                                        <strong><?php echo $row['writer_name']; ?></strong>.
                                    </div>
                                    <?php } ?>
                                </div> -->
                            </div>
                            </div><div class="clearfix"> </div>
                            <div class="form-actions fluid">
                                <div class="col-md-offset-3 col-md-9">
                                   <!--  <a class="btn green" type="button">Edit Subject </a> -->
                                    <button onclick="location.href = 'javascript:history.back()'" class="btn default" type="button"> <?php echo lang('back'); ?> </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END SAMPLE FORM PORTLET-->
                </div>
            </div>
            <!-- END PAGE CONTENT-->
        </div>
    </div>
    <!-- END CONTENT -->
    <script>
    jQuery(document).ready(function() {
    //here is auto reload after 1 second for time and date in the top
    jQuery(setInterval(function() {
    jQuery("#result").load("index.php/home/iceTime");
    }, 1000));
    });
    </script>