<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                    <?php echo lang('tea_eti'); ?> <small></small>
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
                        <?php echo lang('edit'); ?>
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
                <!-- BEGIN SAMPLE FORM PORTLET-->
                <div class="portlet box green ">
                    <div class="portlet-title">
                        <div class="caption">
                            <?php echo lang('tea_ctfib'); ?>
                        </div>
                        <div class="tools">
                            <a href="" class="collapse">
                            </a>
                            <a href="" class="reload">
                            </a>
                        </div>
                    </div>
                    <?php
                    $T_id = $this->input->get('id');
                    $u_Id = $this->input->get('uid');
                    ?>
                    <?php
                    foreach ($userInfo as $row) {
                        $first_name = $row['first_name'];
                        $lest_name = $row['last_name'];
                        $email = $row['email'];
                        $phone = $row['phone'];
                    }
                    foreach ($teacherInfo as $row1) {
                        $farther_name = $row1['farther_name'];
                        $mother_name = $row1['mother_name'];
                        $birth_date = $row1['birth_date'];
                        $sex = $row1['sex'];
                        $present_address = $row1['present_address'];
                        $permanent_address = $row1['permanent_address'];
                        $position = $row1['position'];
                        $subject = $row1['subject'];
                        $working_hour = $row1['working_hour'];
                        if (!empty($row1['educational_qualification_1'])) {
                            $edu_1 = $row1['educational_qualification_1'];
                            $education_1 = array_map('trim', explode(",", $edu_1));
                        }
                        if (!empty($row1['educational_qualification_2'])) {
                            $edu_2 = $row1['educational_qualification_2'];
                            $education_2 = array_map('trim', explode(",", $edu_2));
                        }
                        if (!empty($row1['educational_qualification_3'])) {
                            $edu_3 = $row1['educational_qualification_3'];
                            $education_3 = array_map('trim', explode(",", $edu_3));
                        }
                        if (!empty($row1['educational_qualification_4'])) {
                            $edu_4 = $row1['educational_qualification_4'];
                            $education_4 = array_map('trim', explode(",", $edu_4));
                        }
                        if (!empty($row1['educational_qualification_5'])) {
                            $edu_5 = $row1['educational_qualification_5'];
                            $education_5 = array_map('trim', explode(",", $edu_5));
                        }
                        $cv = $row1['cv'];
                        $educational_certificat = $row1['educational_certificat'];
                        $exprieance_certificatte = $row1['exprieance_certificatte'];
                        $files_info = $row1['files_info'];
                    }
                    ?>
                    <div class="portlet-body form">
                        <?php
                        $form_attributs = array('class' => 'form-horizontal', 'role' => 'form');
                        echo form_open("teachers/edit_teacher?id=$T_id&uid=$u_Id", $form_attributs);
                        ?>
                        <div class="form-group atFormTop">
                            <label class="col-md-3 control-label"><?php echo lang('tea_fn'); ?></label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="first_name" value="<?php echo $first_name; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo lang('tea_ln'); ?></label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="last_name" value="<?php echo $lest_name; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo lang('tea_fn'); ?></label>
                            <div class="col-md-6">
                                <input type="text" name="father_name" class="form-control" value="<?php echo $farther_name; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo lang('tea_mn'); ?></label>
                            <div class="col-md-6">
                                <input type="text" name="mother_name" class="form-control" value="<?php echo $mother_name; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('tea_dob'); ?><span class="requiredStar"> * </span></label>
                            <div class="col-md-4">
                                <input class="form-control" name="birthdate" value="<?php echo $birth_date; ?>" id="mask_date2" type="text"/>
                                <span class="help-block"><?php echo lang('tea_dformet'); ?> </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo lang('tea_sex'); ?><span class="requiredStar"> * </span></label>
                            <div class="col-md-6 marginLeftSex">
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input type="radio" name="sex" value="Male" id="optionsRadios4" <?php
                                        if ($sex == 'Male') {
                                            echo 'checked';
                                        }
                                        ?>><?php echo lang('tea_male'); ?></label>
                                    <label class="radio-inline">
                                        <input type="radio" name="sex" value="Female" id="optionsRadios5"  <?php
                                        if ($sex == 'Female') {
                                            echo 'checked';
                                        }
                                        ?>> <?php echo lang('tea_female'); ?></label>
                                    <label class="radio-inline">
                                        <input type="radio" name="sex" value="Other" id="optionsRadios6"  <?php
                                        if ($sex == 'Other') {
                                            echo 'checked';
                                        }
                                        ?>> <?php echo lang('tea_other'); ?></label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo lang('tea_prea'); ?></label>
                            <div class="col-md-6">
                                <textarea rows="3" name="present_address" class="form-control"><?php echo $present_address; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo lang(''); ?></label>
                            <div class="col-md-6">
                                <textarea rows="3" name="permanent_address" class="form-control"><?php echo $permanent_address; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo lang('tea_email'); ?></label>
                            <div class="col-md-6">
                                <div class="input-group col-md-12">
                                    <span class="input-group-addon">
                                        <i class="fa fa-envelope"></i>
                                    </span>
                                    <input type="text" name="email" value="<?php echo $email; ?>" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo lang('tea_pn'); ?></label>
                            <div class="col-md-6">
                                <div class="input-group col-md-12">
                                    <span class="input-group-addon">
                                        <i class="fa fa-phone"></i>
                                    </span>
                                    <input type="text" name="phone" value="<?php echo $phone; ?>" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo lang('tea_pp'); ?><span class="requiredStar"> * </span></label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="position" value="<?php echo $position; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo lang('tea_fs'); ?> <span class="requiredStar"> * </span></label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="facultiesSubject" value="<?php echo $subject; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo lang('tea_wh'); ?><span class="requiredStar"> * </span></label>
                            <div class="col-md-6">
                                <select name="workingHoure" class="form-control">
                                    <option value="<?php echo $working_hour; ?>"><?php echo $working_hour; ?></option>
                                    <option value="Part time"><?php echo lang('tea_pt'); ?></option>
                                    <option value="Full time"><?php echo lang('tea_ft'); ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo lang('tea_eq'); ?><span class="requiredStar"> * </span></label>
                            <div class="col-md-2">
                                <H4 class="eduFormTitle"><?php echo lang('tea_dd'); ?></H4>
                                <input class="form-control eduForm" name="dd_1" type="text" value="<?php
                                if (!empty($education_1['0'])) {
                                    echo $education_1['0'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="dd_2" type="text" value="<?php
                                if (!empty($education_2['0'])) {
                                    echo $education_2['0'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="dd_3" type="text" value="<?php
                                if (!empty($education_3['0'])) {
                                    echo $education_3['0'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="dd_4" type="text" value="<?php
                                if (!empty($education_4['0'])) {
                                    echo $education_4['0'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="dd_5" type="text" value="<?php
                                if (!empty($education_5['0'])) {
                                    echo $education_5['0'];
                                }
                                ?>">
                            </div>
                            <div class="col-md-3">
                                <H4 class="eduFormTitle"><?php echo lang('tea_scu'); ?></H4>
                                <input class="form-control eduForm" name="scu_1" type="text" 