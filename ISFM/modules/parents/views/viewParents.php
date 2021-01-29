<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                  View Parents Informations  <?php // echo lang('par_epi'); ?><small></small>
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
                        <?php echo lang('header_parent_info'); ?>
                    </li>
                    <li>
                        View Parents Info <?php // echo lang('header_give_pare_acc'); ?>
                    </li>
                   <!--  <li id="result" class="pull-right topClock"></li> -->
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
         <div class="row">
            <!---Start Left Site Content-->
            <div class="col-md-12">
                <div class="col-md-8 stuInfoTableBG">
                    <div class="row">
                        <div class="col-md-12 profile-info">

                                <?php
                                  //echo $section;
                                    foreach($perants_info as $row){
                                        $id            =$row['id'];
                                        $student_id    =$row['student_id'];
                                        $parents = $row['parents_name'];
                                      //  $guardian_name =$row['parents_name'];
                                        $email         =$row['email'];
                                        $password      =$row['dempass'];
                                        $Relation      =$row['relation'];
                                        $cell_number   =$row['phone'];
                                    }  
                                ?>
                             
                                <h1 class="teacherTitleFont"><b><?php  echo $parents; ?></b></h1>
                                
                                <div class="row">
                                    <div class="col-sm-4 col-xs-6 detailsEvent">
                                        Parents CNIC # 
                                        <span>: </span>
                                    </div>

                                    <div class="col-sm-6 col-xs-6 detailsEvent">
                                        <?php  echo $row['parents_cnic']; ?>
                                    </div>
                                </div>
                                <!-- <div class="row">
                                    <div class="col-sm-4 col-xs-6 detailsEvent"> Guardian Name 
                                        <span>: </span>
                                    </div>
                                    <div class="col-sm-6 col-xs-6 detailsEvent">
                                        <?php // echo $guardian_name; ?>
                                    </div>
                                </div> -->
                                <div class="row">
                                   <div class="col-sm-4 col-xs-6 detailsEvent"> Parents Email 
                                       <span>: </span>
                                   </div>
                                   <div class="col-sm-6 col-xs-6 detailsEvent">
                                       <?php echo $email; ?>
                                   </div>
                                </div>
                                <div class="row">
                                   <div class="col-sm-4 col-xs-6 detailsEvent"> Password 
                                       <span>: </span>
                                   </div>
                                   <div class="col-sm-6 col-xs-6 detailsEvent">
                                       <?php // echo $password; ?>*********
                                   </div>
                                </div>  
                                <div class="row">
                                    <div class="col-sm-4 col-xs-6 detailsEvent">Relation 
                                        <span>: </span>
                                    </div>
                                    <div class="col-sm-6 col-xs-6 detailsEvent">
                                        <?php echo $Relation; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4 col-xs-6 detailsEvent">
                                        Cell Number 
                                        <span>: </span>
                                    </div>
                                    <div class="col-sm-6 col-xs-6 detailsEvent">
                                        <?php echo $cell_number; ?>
                                    </div>
                                </div> 
                                  
                        </div>
                    </div>
                    <!--end row-->
                </div>
                <div class="col-md-4">
                    <ul class="ver-inline-menu tabbable margin-bottom-10">
                        <li class="detailsPicture">
                            <img alt="" class="img-responsive" src="assets/uploads/<?php echo $photo; ?>">
                        </li>  
                        <li>  
                          <span class="after"> </span>
                        </li> 
                        <li>
                            <a href="javascript:history.back()">
                                <i class="fa fa-mail-reply-all"></i> <?php echo lang('back'); ?> </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!---End Left Site Content-->
            <!---Start Right Site Content-->
            <div class="col-md-4">
                 
            </div>
            <!---Start Rigth Site Content-->
        </div>
        <!-- END PAGE CONTENT-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <!---Start Left Site Content-->
        <?php
        //echo $section;
            foreach($student_info as $row){ 
        ?>
            <div class="col-md-4 stuInfoTableBG"> 
                <div class="col-md-12 stuInfoTableBG">  
                    <h4 class="teacherTitleFont"><b><?php  echo $row['student_nam']; ?></b></h4>
                    <div class="row">
                        <div class="col-sm-6 col-xs-6 detailsEvent"> Student ID # <span>: </span></div>
                        <div class="col-sm-6 col-xs-6 detailsEvent">
                            <?php  echo $row['student_id']; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-xs-6 detailsEvent"> Student Class <span>: </span></div>
                        <div class="col-sm-6 col-xs-6 detailsEvent">
                            <?php  echo $row['class_title']; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-xs-6 detailsEvent"> Class Section <span>: </span></div>
                        <div class="col-sm-6 col-xs-6 detailsEvent">
                            <?php  echo $row['section']; ?>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-sm-6 col-xs-6 detailsEvent"> Father Name <span>: </span></div>
                        <div class="col-sm-6 col-xs-6 detailsEvent">
                            <?php  echo $row['farther_name']; ?>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-sm-6 col-xs-6 detailsEvent"> Mother Name <span>: </span></div>
                        <div class="col-sm-6 col-xs-6 detailsEvent">
                            <?php  echo $row['mother_name']; ?>
                        </div>
                    </div>  
                </div>
            </div>
        <?php } ?>
            <!---End Left Site Content--> 
        </div>
        <!-- END PAGE CONTENT-->
    </div>
</div>
<!-- END CONTENT -->

<script>
    jQuery(document).ready(function () {
        //here is auto reload after 1 second for time and date in the top
        jQuery(setInterval(function () {
            jQuery("#result").load("index.php/home/iceTime");
        }, 1000));
    });
</script>
