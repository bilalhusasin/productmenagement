<link href="assets/admin/pages/css/profile.css" rel="stylesheet" type="text/css"/>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                    <?php echo lang('tea_td'); ?> <small></small>
                </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <?php echo lang('home'); ?>
                    </li>
                    <li>
                        <?php echo lang('header_teacher'); ?>
                    </li>
                    <li>
                        <?php echo lang('header_tea_info'); ?>
                    </li>
                    <li>
                        <?php echo lang('details'); ?>
                    </li>
                    <li id="result" class="pull-right topClock"></li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-3">
                <?php
                $photo = $this->input->get('photo');
                $teacherID = $this->input->get('id');
                $userId = $this->input->get('uid');
                ?>
                <ul class="ver-inline-menu tabbable margin-bottom-10">
                    <li class="detailsPicture">
                        <img alt="" class="img-responsive" src="assets/uploads/<?php echo $photo; ?>">
                    </li>
                    <li>
                        <a href="javascript:history.back()">
                            <i class="fa fa-mail-reply-all"></i> <?php echo lang('back'); ?></a>

                    </li>
                </ul>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-8 profile-info datilsBodyMB">
                        <?php
                        foreach ($teacher as $row) {
                            $subject = $row['subject_teach'];
                            $position = $row['position_applied_for'];
                            $workingHour = $row['working_hour'];
                            $dateOfBirth = $row['birth_date'];
                            $sex = $row['sex'];
                            $pass = $row['dempass'];
                            $fatherName = $row['farther_name'];
                           // $motherName = $row['mother_name'];
                            $presentAddress = $row['present_address'];
                            $permanentAddress = $row['permanent_address'];
                            $documentsInfo = $row['files_info'];
                            foreach ($user as $row1) {
                                $userName = $row1['username'];
                                $email = $row1['email'];
                                
                                $phoneNumber = $row1['phone'];
                            }
                            ?>

                            <h1 class="teacherTitleFont"><?php echo $userName; ?></h1>
                            <div class="row">
                                <div class="col-sm-4 col-xs-6 detailsEvent">
                                    <span>: </span>
                                    <?php echo lang('tea_subj'); ?>
                                </div>
                                <div class="col-sm-6 col-xs-6 detailsEvent">
                                    <?php echo $subject; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 col-xs-6 detailsEvent">
                                    <?php echo lang('tea_posi'); ?>
                                    <span>: </span>
                                </div>
                                <div class="col-sm-6 col-xs-6 detailsEvent">
                                    <?php echo $position; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 col-xs-6 detailsEvent">
                                    <?php echo lang('tea_wh'); ?>
                                    <span>: </span>
                                </div>
                                <div class="col-sm-6 col-xs-6 detailsEvent">
                                    <?php echo $workingHour; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 col-xs-6 detailsEvent">
                                    <?php echo lang('tea_email'); ?>
                                    <span>: </span>
                                </div>
                                <div class="col-sm-6 col-xs-6 detailsEvent">
                                    <?php echo $email; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 col-xs-6 detailsEvent">
                                    <?php echo lang('tea_pass'); ?>
                                    <span>: </span>
                                </div>
                                <div class="col-sm-6 col-xs-6 detailsEvent">
                                    <?php echo $pass; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 col-xs-6 detailsEvent">
                                    <?php echo lang('tea_pn'); ?>
                                    <span>: </span>
                                </div>
                                <div class="col-sm-6 col-xs-6 detailsEvent">
                                    <?php echo $phoneNumber; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 col-xs-6 detailsEvent">
                                    <?php echo lang('tea_dob'); ?>
                                    <span>: </span>
                                </div>
                                <div class="col-sm-6 col-xs-6 detailsEvent">
                                    <?php
                                    echo $dateOfBirth;
                                    ;
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 col-xs-6 detailsEvent">
                                    <?php echo lang('tea_sex'); ?>
                                    <span>: </span>
                                </div>
                                <div class="col-sm-6 col-xs-6 detailsEvent">
                                    <?php echo $sex; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 col-xs-6 detailsEvent">
                                    <?php echo lang('tea_fn'); ?>
                                    <span>: </span>
                                </div>
                                <div class="col-sm-6 col-xs-6 detailsEvent">
                                    <?php echo $fatherName; ?>
                                </div>
                            </div>
                           
                            <div class="row">
                                <div class="col-sm-4 col-xs-6 detailsEvent">
                                    <?php echo lang('tea_prea'); ?>
                                    <span>: </span>
                                </div>
                                <div class="col-sm-6 col-xs-6 detailsEvent">
                                    <?php echo $presentAddress; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 col-xs-6 detailsEvent">
                                    <?php echo lang('tea_per_add'); ?>
                                    <span>: </span>
                                </div>
                                <div class="col-sm-6 col-xs-6 detailsEvent">
                                    <?php echo $permanentAddress ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 col-xs-6 detailsEvent">
                                    <?php echo lang('tea_docinfo'); ?>
                                    <span>: </span>
                                </div>
                                <div class="col-sm-6 col-xs-6 detailsEvent">
                                    <?php echo $documentsInfo; ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <!--end col-md-8-->
                    <div class="col-md-4">
                        <div class="portlet sale-summary">
                            <div class="portlet-title">
                                <div class="caption">
                                    <?php echo lang('tea_tede'); ?>
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="reload">
                                    </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <ul class="list-unstyled">
                                    <li>
                                        <div class="alert alert-success marginBottomNone">
                                            <strong><?php echo $position; ?></strong>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="alert alert-info marginBottomNone">
                                            <strong><?php echo $workingHour; ?></strong>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--end col-md-4-->
                </div>
                <!--end row-->
                <div class="tabbable tabbable-custom tabbable-custom-profile">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a data-toggle="tab" href="#tab_1_11">
                                <?php echo lang('tea_eq'); ?> </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab_1_11" class="tab-pane active">
                            <div class="portlet-body">
                                <table class="table table-striped table-bordered table-advance table-hover">
                                    <thead>
                                        <tr>
                                            <th>
                                                <?php echo lang('tea_dd'); ?>
                                            </th>
                                            <th class="hidden-xs">
                                                <?php echo lang('tea_scu'); ?>
                                            </th>
                                            <th>
                                                <?php echo lang('tea_subj'); ?>
                                            </th>
                                            <th>
                                                <?php echo lang('tea_result'); ?>
                                            </th>
                                             <th>
                                                <?php echo lang('tea_py'); ?>
                                            </th>
                                            <th>
                                                <?php echo lang('tea_priv'); ?>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($row['educational_qualification_1'])) {
                                            $edu_1 = $row['educational_qualification_1'];
                                            $education_1 = array_map('trim', explode(",", $edu_1));
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $education_1['0']; ?>
                                                </td>
                                                <td class="hidden-xs">
                                                    <?php echo $education_1['1']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $education_1['2']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $education_1['3']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $education_1['4']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $education_1['5']; ?>
                                                </td>
                                                
                                            </tr>
                                            <?php
                                        }
                                        if (!empty($row['educational_qualification_2'])) {
                                            $edu_2 = $row['educational_qualification_2'];
                                            $education_2 = array_map('trim', explode(",", $edu_2));
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $education_2['0']; ?>
                                                </td>
                                                <td class="hidden-xs">
                                                    <?php echo $education_2['1']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $education_2['2']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $education_2['3']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $education_2['4']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $education_2['5']; ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        if (!empty($row['educational_qualification_3'])) {
                                            $edu_3 = $row['educational_qualification_3'];
                                            $education_3 = array_map('trim', explode(",", $edu_3));
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $education_3['0']; ?>
                                                </td>
                                                <td class="hidden-xs">
                                                    <?php echo $education_3['1']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $education_3['2']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $education_3['3']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $education_3['4']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $education_3['5']; ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        if (!empty($row['educational_qualification_4'])) {
                                            $edu_4 = $row['educational_qualification_4'];
                                            $education_4 = array_map('trim', explode(",", $edu_4));
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $education_4['0']; ?>
                                                </td>
                                                <td class="hidden-xs">
                                                    <?php echo $education_4['1']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $education_4['2']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $education_4['3']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $education_4['4']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $education_4['5']; ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        if (!empty($row['educational_qualification_5'])) {
                                            $edu_5 = $row['educational_qualification_5'];
                                            $education_5 = array_map('trim', explode(",", $edu_5));
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $education_5['0']; ?>
                                                </td>
                                                <td class="hidden-xs">
                                                    <?php echo $education_5['1']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $education_5['2']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $education_5['3']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $education_5['4']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $education_5['5']; ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
                <!--- Teacher Qualification--->
                <div class="tabbable tabbable-custom tabbable-custom-profile">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a data-toggle="tab" href="#tab_1_12">
                                <?php echo lang('tea_profqual'); ?> </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab_1_12" class="tab-pane active">
                            <div class="portlet-body">
                                <table class="table table-striped table-bordered table-advance table-hover">
                                    <thead>
                                        <tr>
                                            <th>
                                                <?php echo lang('tea_teaqual'); ?>
                                            </th>
                                            <th>
                                                <?php echo lang('tea_py'); ?>
                                            </th>
                                            <th>
                                                <?php echo lang('tea_teaspec'); ?>
                                            </th>
                                            <th class="hidden-xs">
                                                <?php echo lang('tea_scu'); ?>
                                            </th>
                                            <th>
                                                <?php echo lang('tea_grade'); ?>
                                            </th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($row['teacher_qualification_1'])) {
                                            $tea_1 = $row['teacher_qualification_1'];
                                            $teacher_1 = array_map('trim', explode(",", $tea_1));
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $teacher_1['0']; ?>
                                                </td>
                                                <td class="hidden-xs">
                                                    <?php echo $teacher_1['1']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $teacher_1['2']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $teacher_1['3']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $teacher_1['4']; ?>
                                                </td>
                                                
                                            </tr>
                                            <?php
                                        }
                                        if (!empty($row['teacher_qualification_2'])) {
                                            $tea_2 = $row['teacher_qualification_2'];
                                            $teacher_2 = array_map('trim', explode(",", $tea_2));
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $teacher_2['0']; ?>
                                                </td>
                                                <td class="hidden-xs">
                                                    <?php echo $teacher_2['1']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $teacher_2['2']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $teacher_2['3']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $teacher_2['4']; ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        if (!empty($row['teacher_qualification_3'])) {
                                            $tea_3 = $row['teacher_qualification_3'];
                                            $teacher_3 = array_map('trim', explode(",", $tea_3));
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $teacher_3['0']; ?>
                                                </td>
                                                <td class="hidden-xs">
                                                    <?php echo $teacher_3['1']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $teacher_3['2']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $teacher_3['3']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $teacher_3['4']; ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
                <!-------- Services In-------------->
                
                <div class="tabbable tabbable-custom tabbable-custom-profile">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a data-toggle="tab" href="#tab_1_13">
                                <?php echo lang('tea_train'); ?> </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab_1_13" class="tab-pane active">
                            <div class="portlet-body">
                                <table class="table table-striped table-bordered table-advance table-hover">
                                    <thead>
                                        <tr>
                                            <th>
                                                <?php echo lang('tea_course'); ?>
                                            </th>
                                            <th>
                                                <?php echo lang('tea_from'); ?>
                                            </th>
                                            <th>
                                                <?php echo lang('tea_toend'); ?>
                                            </th>
                                            <th class="hidden-xs">
                                                <?php echo lang('tea_ins'); ?>
                                            </th>
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($row['course_1'])) {
                                            $cors_1 = $row['course_1'];
                                            $course_1 = array_map('trim', explode(",", $cors_1));
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $course_1['0']; ?>
                                                </td>
                                                <td class="hidden-xs">
                                                    <?php echo $course_1['1']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $course_1['2']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $course_1['3']; ?>
                                                </td>
                                                
                                                
                                            </tr>
                                            <?php
                                        }
                                        if (!empty($row['course_2'])) {
                                            $cors_2 = $row['course_2'];
                                            $course_2 = array_map('trim', explode(",", $cors_2));
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $course_2['0']; ?>
                                                </td>
                                                <td class="hidden-xs">
                                                    <?php echo $course_2['1']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $course_2['2']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $course_2['3']; ?>
                                                </td>
                                                
                                            </tr>
                                            <?php
                                        }
                                        if (!empty($row['course_3'])) {
                                            $cors_3 = $row['course_3'];
                                            $course_3 = array_map('trim', explode(",", $cors_3));
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $course_3['0']; ?>
                                                </td>
                                                <td class="hidden-xs">
                                                    <?php echo $course_3['1']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $course_3['2']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $course_3['3']; ?>
                                                </td>
                                               
                                            </tr>
                                            <?php
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
                <!-------------------------------->
                <!-------- Institute Served-------------->
                
                <div class="tabbable tabbable-custom tabbable-custom-profile">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a data-toggle="tab" href="#tab_1_14">
                                <?php echo lang('tea_experi'); ?> </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab_1_14" class="tab-pane active">
                            <div class="portlet-body">
                                <table class="table table-striped table-bordered table-advance table-hover">
                                    <thead>
                                        <tr>
                                            <th class="hidden-xs">
                                                <?php echo lang('tea_ins_serve'); ?>
                                            </th>
                                            <th>
                                                <?php echo lang('tea_from'); ?>
                                            </th>
                                            <th>
                                                <?php echo lang('tea_toend'); ?>
                                            </th>
                                            <th >
                                                <?php echo lang('tea_taught'); ?>
                                            </th>
                                            <th >
                                                <?php echo lang('tea_sub_taught'); ?>
                                            </th>
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($row['institute_served_1'])) {
                                            $ins_1 = $row['institute_served_1'];
                                            $inst_1 = array_map('trim', explode(",", $ins_1));
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $inst_1['0']; ?>
                                                </td>
                                                <td class="hidden-xs">
                                                    <?php echo $inst_1['1']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $inst_1['2']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $inst_1['3']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $inst_1['4']; ?>
                                                </td>
                                                
                                                
                                            </tr>
                                            <?php
                                        }
                                        if (!empty($row['institute_served_2'])) {
                                            $ins_2 = $row['institute_served_2'];
                                            $inst_2 = array_map('trim', explode(",", $ins_2));
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $inst_2['0']; ?>
                                                </td>
                                                <td class="hidden-xs">
                                                    <?php echo $inst_2['1']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $inst_2['2']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $inst_2['3']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $inst_2['4']; ?>
                                                </td>
                                                
                                            </tr>
                                            <?php
                                        }
                                        if (!empty($row['institute_served_3'])) {
                                            $ins_3 = $row['institute_served_3'];
                                            $inst_3 = array_map('trim', explode(",", $ins_3));
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $inst_3['0']; ?>
                                                </td>
                                                <td class="hidden-xs">
                                                    <?php echo $inst_3['1']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $inst_3['2']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $inst_3['3']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $inst_3['4']; ?>
                                                </td>
                                               
                                            </tr>
                                            <?php
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
                <!-------------------------------->
                <!-------- Adminsistrative Services-------------->
                
                <div class="tabbable tabbable-custom tabbable-custom-profile">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a data-toggle="tab" href="#tab_1_15">
                                <?php echo lang('tea_admi_exp'); ?> </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab_1_15" class="tab-pane active">
                            <div class="portlet-body">
                                <table class="table table-striped table-bordered table-advance table-hover">
                                    <thead>
                                        <tr>
                                            <th>
                                                <?php echo lang('tea_ins_serve'); ?>
                                            </th>
                                            <th>
                                                <?php echo lang('tea_from'); ?>
                                            </th>
                                            <th>
                                                <?php echo lang('tea_toend'); ?>
                                            </th>
                                            <th class="hidden-xs">
                                                <?php echo lang('tea_posi'); ?>
                                            </th>
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($row['administrative_service_1'])) {
                                            $adm_1 = $row['administrative_service_1'];
                                            $admi_1 = array_map('trim', explode(",", $adm_1));
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $admi_1['0']; ?>
                                                </td>
                                                <td class="hidden-xs">
                                                    <?php echo $admi_1['1']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $admi_1['2']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $admi_1['3']; ?>
                                                </td>
                                                
                                                
                                            </tr>
                                            <?php
                                        }
                                        if (!empty($row['administrative_service_2'])) {
                                            $adm_2 = $row['administrative_service_2'];
                                            $admi_2 = array_map('trim', explode(",", $adm_2));
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $admi_2['0']; ?>
                                                </td>
                                                <td class="hidden-xs">
                                                    <?php echo $admi_2['1']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $admi_2['2']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $admi_2['3']; ?>
                                                </td>
                                                
                                            </tr>
                                            <?php
                                        }
                                        if (!empty($row['administrative_service_3'])) {
                                            $adm_3 = $row['administrative_service_3'];
                                            $admi_3 = array_map('trim', explode(",", $adm_3));
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $admi_3['0']; ?>
                                                </td>
                                                <td class="hidden-xs">
                                                    <?php echo $admi_3['1']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $admi_3['2']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $admi_3['3']; ?>
                                                </td>
                                               
                                            </tr>
                                            <?php
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
                <!-------------------------------->
            </div>
        </div>
        <!-- END PAGE CONTENT-->
    </div>
</div>
<!-- END CONTENT -->