<!-- Begin PAGE STYLES -->
<link href="assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet"/>
<!-- End PAGE STYLES -->
<!-- Begin CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- Begin Page Header-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                    <?php echo lang('des_title'); ?> <small></small>
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
        <?php if ($this->common->user_access('das_top_info', $userId)) { ?>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat blue-madison">
                        <div class="visual">
                            <i class="fa fa-group"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <?php echo $totalStudent; ?>
                            </div>
                            <div class="desc">
                                <?php echo lang('des_to_stu'); ?>
                            </div>
                        </div>
                        <div class="more dasTotalStudentTest">
                            <?php echo lang('des_th_sys'); ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat red-intense">
                        <div class="visual">
                            <span class="icon-users totalTeacherSpan" aria-hidden="true"></span>
                        </div>
                        <div class="details">
                            <div class="number">
                                <?php echo $totalTeacher; ?>
                            </div>
                            <div class="desc">
                                <?php echo lang('des_to_tea'); ?>
                            </div>
                        </div>
                        <div class="more dbilcss3">
                            <?php echo lang('des_th_sys'); ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat green-haze">
                        <div class="visual">
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <?php echo $totalParents; ?>
                            </div>
                            <div class="desc">
                                <?php echo lang('des_to_pa'); ?>
                            </div>
                        </div>
                        <div class="more dbilcss3"> 
                            <?php echo lang('des_th_sys'); ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat purple-plum">
                        <div class="visual">
                            <i class="fa fa-bar-chart-o"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <?php echo $totalAttendStudent; ?>
                            </div>
                            <div class="desc">
                                <?php echo lang('des_att_stu'); ?>
                            </div>
                        </div>
                        <div class="more dbilcss3">
                            <?php echo lang('des_to_att_stu'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        <?php } if($this->ion_auth->is_accountant()){?>
            <div class="row">
                <div class="col-md-12">
                    <a class="btn blue btn-block fee_button" onClick="javascript:return confirm('Are you sure you want to calculate all students fees for this month.')" href="index.php/home/end_stu_calcu" > Calculate Students Month End Fee </a>
                </div>
            </div>
        <?php } if ($this->common->user_access('das_grab_chart', $userId)) { ?>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <!-- BEGIN PORTLET-->
                    <div class="portlet green box">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-bullhorn"></i><?php echo lang('des_c_a_a_p'); ?>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div id="site_activities_loading">
                                <img src="assets/admin/layout/img/loading.gif" alt="loading"/>
                            </div>
                            <div id="site_activities_content" class="display-none">
                                <div id="site_activities" class="dbilcss4">
                                </div>
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
        <div class="row ">
            <?php if ($this->common->user_access('das_class_info', $userId)) { ?>
                <div class="col-md-6 col-sm-6">
                    <div class="portlet purple box">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-cogs"></i><?php echo lang('des_class_info'); ?>
                            </div>
                            <div class="tools">
                                <a class="collapse" href="javascript:;">
                                </a>
                                <a class="reload" href="javascript:;">
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="scroller dbilcss9" data-always-visible="1" data-rail-visible="0">
                                <div class="table-scrollable">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>
                                                    #
                                                </th>
                                                <th>
                                                    <?php echo lang('des_t_clas_name'); ?>
                                                </th>
                                                <th>
                                                    <?php echo lang('des_t_stu_amou'); ?>
                                                </th>
                                                <th>
                                                    <?php echo lang('des_daily_atten'); ?>%
                                                </th>
                                                <th>
                                                    <?php echo lang('des_yearly_atten'); ?>%
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach ($classInfo as $row) {
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $i; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['class_title']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['student_amount']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['attendance_percentices_daily']; ?>%
                                                    </td>
                                                    <td>
                                                        <?php echo $row['attend_percentise_yearly']; ?>%
                                                    </td>
                                                </tr>
                                                <?php
                                                $i++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="scroller-footer">
                                <div class="btn-arrow-link pull-right">
                                    <a href="index.php/sclass/allClass"><?php echo lang('des_see_f_info'); ?></a>
                                    <i class="icon-arrow-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } if ($this->common->user_access('das_message', $us