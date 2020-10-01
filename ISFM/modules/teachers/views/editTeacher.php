<!-- BEGIN CONTENT -->
<link rel="stylesheet" href="assets/global/plugins/jquery-ui/jquery-ui.css">
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
                       
                        $birth_date = $row1['birth_date'];
                        $sex = $row1['sex'];
                        $present_address = $row1['present_address'];
                        $permanent_address = $row1['permanent_address'];
                        $position = $row1['position_applied_for'];
                        $subject = $row1['subject_teach'];
                        $classes = $row1['classes_teach'];
                        $married = $row1['married'];
                        $divorced = $row1['divorced'];
                        $widow = $row1['widow_widower'];
                        $spouse = $row1['spouse_name'];
                        $spouse_qual = $row1['spouse_qualification'];
                        $spouse_pro = $row1['spouse_profession'];
                        $no_child = $row1['number_of_children'];
                        $elder = $row1['elder_child_age'];
                        $young = $row1['young_child_age'];
                        $nationality = $row1['nationality'];
                        $religion = $row1['religion'];
                        $sect = $row1['sect'];
                        $place_birth = $row1['place_of_birth'];
                        $country = $row1['country'];
                        $tea_degree = $row1['teachers_degree'];
                        $tea_cnic = $row1['teachers_cnic'];
                        $tea_eoib = $row1['teachers_eoib'];
                        $word = $row1['msword'];
                        $excel = $row1['msexcel'];
                        $power_p = $row1['power_point'];
                        $internet = $row1['internet'];
                        $work_place = $row1['work_place'];
                        $telephone = $row1['phone'];
                        $ext_activity = $row1['extra_activity'];

                        $a = $row1['activity_1'];
                        $b = $row1['activity_2'];
                        $c = $row1['activity_3'];
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
                        $appli = $row1['applied_before'];
                        //-------------------Techer Qualification--------------
                         if (!empty($row1['teacher_qualification_1'])) {
                            $teaqual_1 = $row1['teacher_qualification_1'];
                            $teacher_1 = array_map('trim', explode(",", $teaqual_1));
                        }
                        if (!empty($row1['teacher_qualification_2'])) {
                            $teaqual_2 = $row1['teacher_qualification_2'];
                            $teacher_2 = array_map('trim', explode(",", $teaqual_2));
                        }
                        if (!empty($row1['teacher_qualification_3'])) {
                            $teaqual_3 = $row1['teacher_qualification_3'];
                            $teacher_3 = array_map('trim', explode(",", $teaqual_3));
                        }
                       
                        //-------------------------course----------------------------------
                         if (!empty($row1['course_1'])) {
                            $course_1 = $row1['course_1'];
                            $cors_1 = array_map('trim', explode(",", $course_1));
                        }
                        if (!empty($row1['course_2'])) {
                            $course_2 = $row1['course_2'];
                            $cors_2 = array_map('trim', explode(",", $course_2));
                        }
                        if (!empty($row1['course_3'])) {
                            $course_3 = $row1['course_3'];
                            $cors_3 = array_map('trim', explode(",", $course_3));
                        }
                        
                        //-------------------------Institue Served-----------------------------------
                         if (!empty($row1['institute_served_1'])) {
                            $institute_serve_1 = $row1['institute_served_1'];
                            $ins_1 = array_map('trim', explode(",", $institute_serve_1));
                        }
                        if (!empty($row1['institute_served_2'])) {
                            $institute_serve_2 = $row1['institute_served_2'];
                            $ins_2 = array_map('trim', explode(",", $institute_serve_2));
                        }
                        if (!empty($row1['institute_served_3'])) {
                            $institute_serve_3 = $row1['institute_served_3'];
                            $ins_3 = array_map('trim', explode(",", $institute_serve_3));
                        }
                       //----------------------------Admin Served---------------------------------------
                        if (!empty($row1['administrative_service_1'])) {
                            $admin_serve_1 = $row1['administrative_service_1'];
                            $admin_1 = array_map('trim', explode(",", $admin_serve_1));
                        }
                        if (!empty($row1['administrative_service_2'])) {
                            $admin_serve_2 = $row1['administrative_service_2'];
                            $admin_2 = array_map('trim', explode(",", $admin_serve_2));
                        }
                        if (!empty($row1['administrative_service_3'])) {
                            $admin_serve_3 = $row1['administrative_service_3'];
                            $admin_3 = array_map('trim', explode(",", $admin_serve_3));
                        }
                        //----------------------------organization refrence--------------------------------------
                        if (!empty($row1['organization_name_1'])) {
                            $orgname_1 = $row1['organization_name_1'];
                            $org_1 = array_map('trim', explode(",", $orgname_1));
                        }
                        if (!empty($row1['organization_name_2'])) {
                            $orgname_2 = $row1['organization_name_2'];
                            $org_2 = array_map('trim', explode(",", $orgname_2));
                        }
                        if (!empty($row1['organization_name_3'])) {
                            $orgname_3 = $row1['organization_name_3'];
                            $org_3 = array_map('trim', explode(",", $orgname_3));
                        }
                       
                        //----------------------------------------------------------
                        $recomen = $row1['recommendation'];
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
                <div id="div1">
                    <div class="form-group col-md-12">
                        <div class="form-group atFormTop">
                            <label class="col-md-3 control-label"><?php echo lang('tea_position'); ?></label>
                            <div class="col-md-6">
                                <input type="text" class="form-control a" name="applied" value="<?php echo $position; ?>">
                            </div>
                        </div>
                        <div class="form-group" style="margin-left: 24%">
                                        <div class="col-md-4">
                                            <label class="col-md-3 control-label">
                                                <?php echo lang('tea_sub'); ?>
                                            </label>
                                            <input type="text" class="form-control b" name="sub1" value="<?php echo $subject; ?>">

                                        </div>
                                        <div class="col-md-4">
                                            <label class="col-md-3 control-label">
                                                <?php echo lang('tea_cls'); ?>
                                            </label>
                                            <input type="text" class="form-control c" name="cls" value="<?php echo $classes; ?>">
                                        </div>
                                    </div>
                    </div>



                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo lang('tea_fn'); ?></label>
                            <div class="col-md-6">
                                <input type="text" class="form-control d" name="first_name" value="<?php echo $first_name; ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo lang('tea_fn'); ?></label>
                            <div class="col-md-6">
                                <input type="text" name="father_name" class="form-control e" value="<?php echo $farther_name; ?>">
                            </div>
                        </div>
                      
                        
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('tea_dob'); ?><span class="requiredStar"> * </span></label>
                            <div class="col-md-4">
                                <input class="form-control f" name="birthdate" value="<?php echo $birth_date; ?>" id="mask_date1" type="text"/>
                                <span class="help-block"><?php echo lang('tea_dformet'); ?> </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo lang('tea_sex'); ?><span class="requiredStar"> * </span></label>
                            <div class="col-md-6 marginLeftSex g">
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
                                    
                                </div>
                            </div>
                        </div>

                            <div class="form-group">
                                    <label class="col-md-3 control-label">
                                        <?php echo lang('tea_marid'); ?> <span class="requiredStar"> * </span>
                                    </label>
                                    <label class="col-md-1 control-label"></label>
                                    <div class="col-md-6 marginLeftSex h">

                                        <div class="radio-list">
                                            <label class="radio-inline">
                                             <input type="radio" name="married" value="yes" id="optionsRadios5"  <?php
                                        if ($married == 'yes') {
                                            echo 'checked';
                                        }
                                        ?>><?php echo lang('tea_yes'); ?></label>
                                        
                                            <label class="radio-inline">
                                             <input type="radio" name="married" value="no" id="optionsRadios5"  <?php
                                        if ($married == 'no') {
                                            echo 'checked';
                                        }
                                        ?>> <?php echo lang('tea_no'); ?> </label>
                                        

                                        </div>
                                    </div>
                                </div>
                                    <div class="form-group">
                                    <label class="col-md-3 control-label">
                                        <?php echo lang('tea_divo'); ?>
                                    </label>
                                    <label class="col-md-1 control-label"></label>
                                    <div class="col-md-6 marginLeftSex i">

                                        <div class="radio-list">
                                            <label class="radio-inline">
                                            <input type="radio" name="divorced" value="yes" id="optionsRadios5"  <?php
                                        if ($divorced == 'yes') {
                                            echo 'checked';
                                        }
                                        ?>><?php echo lang('tea_yes'); ?></label>
                                        
                                            <label class="radio-inline">
                                            <input type="radio" name="divorced" value="no" id="optionsRadios5"  <?php
                                        if ($divorced == 'no') {
                                            echo 'checked';
                                        }
                                        ?>> <?php echo lang('tea_no'); ?> </label>
                                        

                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">
                                        <?php echo lang('tea_widow'); ?> </label>
                                    <label class="col-md-1 control-label"></label>
                                    <div class="col-md-6 marginLeftSex j">

                                        <div class="radio-list">
                                            <label class="radio-inline">
                                           <input type="radio" name="widow" value="yes" id="optionsRadios5"  <?php
                                        if ($widow == 'yes') {
                                            echo 'checked';
                                        }
                                        ?>><?php echo lang('tea_yes'); ?></label>
                                        
                                            <label class="radio-inline">
                                            <input type="radio" name="widow" value="no" id="optionsRadios5"  <?php
                                        if ($widow == 'no') {
                                            echo 'checked';
                                        }
                                        ?>> <?php echo lang('tea_no'); ?> </label>
                                        

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                <label class="col-md-3 control-label">
                                    <?php echo lang('tea_spnm'); ?> <span class="requiredStar"> * </span>
                                </label>
                                <div class="col-md-6">
                                    <input type="text" name="spouse_name" class="form-control k" value="<?php echo $spouse; ?>">
                                </div>
                            </div>
                            <div class="form-group" style="margin-left: 24%">
                                <div class="col-md-3">
                                    <label class="col-md-6 control-label">
                                        <?php echo lang('tea_spquail'); ?>
                                    </label>
                                    <input type="text" name="spouse_qualification" class="form-control l" value="<?php echo $spouse_qual; ?>">
                                </div>
                                <div class="col-md-3">
                                    <label class="col-md-6 control-label">
                                        <?php echo lang('tea_spprof'); ?>
                                    </label>
                                   <input type="text" name="spouse_profession" class="form-control m" value="<?php echo $spouse_pro; ?>">
                                </div>
                            </div>
                            <div class="form-group" style="margin-left: 24%">

                                <div class="col-md-3">
                                    <label class="col-md-12">
                                        <?php echo lang('tea_nochild'); ?>
                                    </label>
                                    <input type="text" name="no_children" class="form-control n" value="<?php echo $no_child; ?>">

                                </div>
                                <div class="col-md-3">
                                    <label class="col-md-12">
                                        <?php echo lang('tea_eldchild'); ?>
                                    </label>
                                   <input type="text" name="elder_child" class="form-control o" value="<?php echo $elder; ?>">

                                </div>
                                <div class="col-md-3">
                                    <label class="col-md-12">
                                        <?php echo lang('tea_yungchild'); ?>
                                    </label>
                                     <input type="text" name="young_child" class="form-control p" value="<?php echo $young; ?>">

                                </div>
                            </div>
                            <div class="form-group" style="margin-left: 24%">

                                <div class="col-md-3">
                                    <label class="col-md-12">
                                        <?php echo lang('tea_nati'); ?>
                                    </label>
                                   <input type="text" name="nationality" class="form-control q" value="<?php echo $nationality; ?>">

                                </div>
                                <div class="col-md-4">
                                    <label class="col-md-9">
                                        <?php echo lang('tea_reli'); ?>
                                    </label>
                                    <div class="col-md-8">
                                            <select name="religion" class="form-control s">
                                             <option value="<?php echo $religion; ?>"></option>">
                                               
                                             </option>
                                            <option value="islam">
                                                <?php echo lang('tea_reli_is'); ?>
                                            </option>
                                              <option value="hinduism">
                                                <?php echo lang('tea_reli_hi'); ?>
                                              </option>
                                               <option value="christian">
                                                <?php echo lang('tea_reli_ch'); ?>
                                              </option>
                                               <option value="sikh">
                                                <?php echo lang('tea_reli_si'); ?>
                                              </option>
                                            </select>
                                        </div>

                                </div>
                                
                                <div class="col-md-3" style="margin-left: -9%">
                                    <label class="col-md-12">
                                        <?php echo lang('tea_sect'); ?>
                                    </label>
                                    <input type="text" name="sect" class="form-control t" value="<?php echo $sect; ?>">

                                </div>
                            </div>
                            <div class="form-group" style="margin-left: 24%">

                                <div class="col-md-3">
                                    <label class="col-md-12">
                                        <?php echo lang('tea_pb'); ?>
                                    </label>
                                  <input type="text" name="place_birth" class="form-control u" value="<?php echo $place_birth; ?>">

                                </div>
                                <div class="col-md-3">
                                    <label class="col-md-12">
                                        <?php echo lang('tea_count'); ?>
                                    </label>
                                   <input type="text" name="country" class="form-control v" value="<?php echo $country; ?>">

                                </div>
                                
                            </div>






                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo lang('tea_prea'); ?></label>
                            <div class="col-md-6">
                                <textarea rows="3" name="present_address" class="form-control w"><?php echo $present_address; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo lang(''); ?></label>
                            <div class="col-md-6">
                                <textarea rows="3" name="permanent_address" class="form-control x"><?php echo $permanent_address; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo lang('tea_pn'); ?></label>
                            <div class="col-md-6">
                                <div class="input-group col-md-12">
                                    <span class="input-group-addon">
                                        <i class="fa fa-phone"></i>
                                    </span>
                                    <input type="text" name="phone" value="<?php echo $phone; ?>" class="form-control y">
                                </div>
                            </div>
                        </div>
                        <div class="form-actions fluid">
                                <div class="col-md-offset-3 col-md-6">
                                    <button type="button" id="btn_hidde" class="btn btn-success btn-lg"> Next </button>
                                </div>
                            </div>
</div>
                    <div style="display: none" id="div2">

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
                            <label class="col-md-3 control-label"><?php echo lang('tea_wp'); ?><span class="requiredStar"> * </span></label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="work_place" value="<?php echo $work_place; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo lang('tea_tel'); ?> <span class="requiredStar"> * </span></label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="tel" value="<?php echo $telephone; ?>">
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
                            <label class="col-md-3 control-label"><?php echo lang('tea_ap'); ?><span class="requiredStar"> * </span></label>
                            <div class="col-md-6 marginLeftSex">
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input type="radio" name="applied" value="yes" id="optionsRadios4" <?php
                                        if ($appli == 'yes') {
                                            echo 'checked';
                                        }
                                        ?>><?php echo lang('tea_yes'); ?></label>
                                    <label class="radio-inline">
                                        <input type="radio" name="applied" value="no" id="optionsRadios5"  <?php
                                        if ($appli == 'no') {
                                            echo 'checked';
                                        }
                                        ?>> <?php echo lang('tea_no'); ?></label>
                                    
                                    </div>
                            </div>
                        </div>

<!-------------------------------Teachers Qualification------------------->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo lang('tea_eq'); ?><span class="requiredStar"> * </span></label>
                            <div class="col-md-1">
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
                            <div class="col-md-2">
                                <H4 class="eduFormTitle"><?php echo lang('tea_scu'); ?></H4>
                                <input class="form-control eduForm" name="scu_1" type="text" value="<?php
                                if (!empty($education_1['1'])) {
                                    echo $education_1['1'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="scu_2" type="text" value="<?php
                                if (!empty($education_2['1'])) {
                                    echo $education_2['1'];
                                }
                                ?>">
                                
                                
                                <input class="form-control eduForm" name="scu_3" type="text" value="<?php
                                if (!empty($education_3['1'])) {
                                    echo $education_3['1'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="scu_4" type="text" value="<?php
                                if (!empty($education_4['1'])) {
                                    echo $education_4['1'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="scu_5" type="text" value="<?php
                                if (!empty($education_5['1'])) {
                                    echo $education_5['1'];
                                }
                                ?>">
                            </div>
                             <div class="col-md-2">
                                <H4 class="eduFormTitle"><?php echo lang('tea_sub'); ?></H4>
                                <input class="form-control eduForm" name="subj_1" type="text" value="<?php
                                if (!empty($education_1['2'])) {
                                    echo $education_1['2'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="subj_2" type="text" value="<?php
                                if (!empty($education_2['2'])) {
                                    echo $education_2['2'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="subj_3" type="text" value="<?php
                                if (!empty($education_3['2'])) {
                                    echo $education_3['2'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="subj_4" type="text" value="<?php
                                if (!empty($education_4['2'])) {
                                    echo $education_4['2'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="subj_5" type="text" value="<?php
                                if (!empty($education_5['2'])) {
                                    echo $education_5['2'];
                                }
                                ?>">
                            </div>
                              <div class="col-md-1">
                                <H4 class="eduFormTitle"><?php echo lang('tea_py'); ?></H4>
                                <input class="form-control eduForm" name="paYear_1" id="mask_date28" type="text" value="<?php
                                if (!empty($education_1['4'])) {
                                    echo $education_1['4'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="paYear_2" id="mask_date3" type="text" value="<?php
                                if (!empty($education_2['4'])) {
                                    echo $education_2['4'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="paYear_3" id="mask_date4" type="text" value="<?php
                                if (!empty($education_3['4'])) {
                                    echo $education_3['4'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="paYear_4" id="mask_date5" type="text" value="<?php
                                if (!empty($education_4['4'])) {
                                    echo $education_4['4'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="paYear_5" id="mask_date6" type="text" value="<?php
                                if (!empty($education_5['4'])) {
                                    echo $education_5['4'];
                                }
                                ?>">
                            </div>
                            <div class="col-md-1">
                                <H4 class="eduFormTitle"><?php echo lang('tea_result'); ?></H4>
                                <input class="form-control eduForm" name="result_1" type="text" value="<?php
                                if (!empty($education_1['3'])) {
                                    echo $education_1['3'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="result_2" type="text" value="<?php
                                if (!empty($education_2['3'])) {
                                    echo $education_2['3'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="result_3" type="text" value="<?php
                                if (!empty($education_3['3'])) {
                                    echo $education_3['3'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="result_4" type="text" value="<?php
                                if (!empty($education_4['3'])) {
                                    echo $education_4['3'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="result_5" type="text" value="<?php
                                if (!empty($education_5['3'])) {
                                    echo $education_5['3'];
                                }
                                ?>">
                            </div>
                          
                             <div class="col-md-1" style="margin-left: 2%">
                                <H4 class="eduFormTitle"><?php echo lang('tea_priv'); ?></H4>
                                <input class="form-control eduForm" name="reg_1" type="text" value="<?php
                                if (!empty($education_1['5'])) {
                                    echo $education_1['5'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="reg_2" type="text" value="<?php
                                if (!empty($education_2['5'])) {
                                    echo $education_2['5'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="reg_3" type="text" value="<?php
                                if (!empty($education_3['5'])) {
                                    echo $education_3['5'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="reg_4" type="text" value="<?php
                                if (!empty($education_4['5'])) {
                                    echo $education_4['5'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="reg_5" type="text" value="<?php
                                if (!empty($education_5['5'])) {
                                    echo $education_5['5'];
                                }
                                ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo lang('tea_exactiv'); ?><span class="requiredStar"> * </span></label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="extra_activity" value="<?php echo $ext_activity; ?>">
                            </div>
                        </div>
        <!---------------------------------teacher qualification---------------------->
        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo lang('tea_profqual'); ?><span class="requiredStar"> * </span></label>
                            <div class="col-md-1">
                                <H4 class="eduFormTitle"><?php echo lang('tea_teaqual'); ?></H4>
                                <input class="form-control eduForm" name="teaqual_1" type="text" value="<?php
                                if (!empty($teacher_1['0'])) {
                                    echo $teacher_1['0'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="teaqual_2" type="text" value="<?php
                                if (!empty($teacher_2['0'])) {
                                    echo $teacher_2['0'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="teaqual_3" type="text" value="<?php
                                if (!empty($teacher_3['0'])) {
                                    echo $teacher_3['0'];
                                }
                                ?>">
                              
                            </div>
                            <div class="col-md-1">
                                <H4 class="eduFormTitle"><?php echo lang('tea_teayear'); ?></H4>
                                <input class="form-control eduForm" name="teayear_1" id="mask_date25" type="text" value="<?php
                                if (!empty($teacher_1['1'])) {
                                    echo $teacher_1['1'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="teayear_2" id="mask_date26" type="text" value="<?php
                                if (!empty($teacher_2['1'])) {
                                    echo $teacher_2['1'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="teayear_3" id="mask_date28" type="text" value="<?php
                                if (!empty($teacher_3['1'])) {
                                    echo $teacher_3['1'];
                                }
                                ?>">
                               
                            </div>
                             <div class="col-md-2">
                                <H4 class="eduFormTitle"><?php echo lang('tea_teaspec'); ?></H4>
                                <input class="form-control eduForm" name="teaspec_1" type="text" value="<?php
                                if (!empty($teacher_1['2'])) {
                                    echo $teacher_1['2'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="teaspec_2" type="text" value="<?php
                                if (!empty($teacher_2['2'])) {
                                    echo $teacher_2['2'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="teaspec_3" type="text" value="<?php
                                if (!empty($teacher_3['2'])) {
                                    echo $teacher_3['2'];
                                }
                                ?>">
                                
                            </div>
                              <div class="col-md-3">
                                <H4 class="eduFormTitle"><?php echo lang('tea_scu'); ?></H4>
                                <input class="form-control eduForm" name="scul_1" type="text" value="<?php
                                if (!empty($teacher_1['3'])) {
                                    echo $teacher_1['3'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="scul_2" type="text" value="<?php
                                if (!empty($teacher_2['3'])) {
                                    echo $teacher_2['3'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="scul_3" type="text" value="<?php
                                if (!empty($teacher_3['3'])) {
                                    echo $teacher_3['3'];
                                }
                                ?>">
                                
                            </div>
                             <div class="col-md-1">
                                <H4 class="eduFormTitle"><?php echo lang('tea_grade'); ?></H4>
                                <input class="form-control eduForm" name="grade_1" type="text" value="<?php
                                if (!empty($teacher_1['3'])) {
                                    echo $teacher_1['3'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="grade_2" type="text" value="<?php
                                if (!empty($teacher_2['3'])) {
                                    echo $teacher_2['3'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="grade_3" type="text" value="<?php
                                if (!empty($teacher_3['3'])) {
                                    echo $teacher_3['3'];
                                }
                                ?>">
                                
                            </div>
                        </div>
<!-----------------------------------Computer Skills--------------------------------->
<div class="form-group">
                            <label class="col-md-3 control-label"><?php echo lang('tea_compskil'); ?> </label>
                            <div class="col-md-9">
                                <div class="" style="padding-top: 2%">
                                    <label>
                                        <input type="checkbox" name="msword" <?php
                                        if (!empty($word)) {
                                            echo 'checked value="submited"';
                                        }
                                        ?>> <?php echo lang('tea_word'); ?> </label>
                                    <label>
                                        <input type="checkbox" name="msexcel"  <?php
                                        if (!empty($excel)) {
                                            echo 'checked value="submited"';
                                        }
                                        ?>> <?php echo lang('tea_excel'); ?></label>
                                    <label>
                                        <input type="checkbox" name="power_point" <?php
                                        if (!empty($power_p)) {
                                            echo 'checked value="submited"';
                                        }
                                        ?>> <?php echo lang('tea_powerp'); ?></label>
                                        <label>
                                        <input type="checkbox" name="internet" <?php
                                        if (!empty($internet)) {
                                            echo 'checked value="submited"';
                                        }
                                        ?>> <?php echo lang('tea_internet'); ?></label>
                                </div>
                            </div>
                        </div>
       <!----------------------------------Serice Trannings--------------------------------------->
        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo lang('tea_train'); ?><span class="requiredStar"> * </span></label>
                            <div class="col-md-3">
                                <H4 class="eduFormTitle"><?php echo lang('tea_course'); ?></H4>
                                <input class="form-control eduForm" name="cource_1" type="text" value="<?php
                                if (!empty($cors_1['0'])) {
                                    echo $cors_1['0'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="cource_2" type="text" value="<?php
                                if (!empty($cors_2['0'])) {
                                    echo $cors_2['0'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="cource_3" type="text" value="<?php
                                if (!empty($cors_3['0'])) {
                                    echo $cors_3['0'];
                                }
                                ?>">
                              
                            </div>
                            <div class="col-md-1">
                                <H4 class="eduFormTitle"><?php echo lang('tea_from'); ?></H4>
                                <input class="form-control eduForm" name="from_1" id="mask_date7" type="text" value="<?php
                                if (!empty($cors_1['1'])) {
                                    echo $cors_1['1'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="from_2" id="mask_date8" type="text" value="<?php
                                if (!empty($cors_2['1'])) {
                                    echo $cors_2['1'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="from_3" id="mask_date9" type="text" value="<?php
                                if (!empty($cors_3['1'])) {
                                    echo $cors_3['1'];
                                }
                                ?>">
                               
                            </div>
                             <div class="col-md-1">
                                <H4 class="eduFormTitle"><?php echo lang('tea_toend'); ?></H4>
                                <input class="form-control eduForm" name="toend_1" id="mask_date10" type="text" value="<?php
                                if (!empty($cors_1['2'])) {
                                    echo $cors_1['2'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="toend_2" id="mask_date11" type="text" value="<?php
                                if (!empty($cors_2['2'])) {
                                    echo $cors_2['2'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="toend_3" id="mask_date12" type="text" value="<?php
                                if (!empty($cors_3['2'])) {
                                    echo $cors_3['2'];
                                }
                                ?>">
                                
                            </div>
                              <div class="col-md-2">
                                <H4 class="eduFormTitle"><?php echo lang('tea_ins'); ?></H4>
                                <input class="form-control eduForm" name="ins_1" type="text" value="<?php
                                if (!empty($cors_1['3'])) {
                                    echo $cors_1['3'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="ins_2" type="text" value="<?php
                                if (!empty($cors_2['3'])) {
                                    echo $cors_2['3'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="ins_3" type="text" value="<?php
                                if (!empty($cors_3['3'])) {
                                    echo $cors_3['3'];
                                }
                                ?>">
                                
                            </div>
                            
                        </div>
            <!--------------------- Teaching Experience------------------------------------------------------>

              <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo lang('tea_experi'); ?><span class="requiredStar"> * </span></label>
                            <div class="col-md-3">
                                <H4 class="eduFormTitle"><?php echo lang('tea_ins_serve'); ?></H4>
                                <input class="form-control eduForm" name="ins_serve_1" type="text" value="<?php
                                if (!empty($ins_1['0'])) {
                                    echo $ins_1['0'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="ins_serve_2" type="text" value="<?php
                                if (!empty($ins_2['0'])) {
                                    echo $ins_2['0'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="ins_serve_3" type="text" value="<?php
                                if (!empty($ins_3['0'])) {
                                    echo $ins_3['0'];
                                }
                                ?>">
                              
                            </div>
                            <div class="col-md-1">
                                <H4 class="eduFormTitle"><?php echo lang('tea_from'); ?></H4>
                                <input class="form-control eduForm" name="fromt_1" id="mask_date13" type="text" value="<?php
                                if (!empty($ins_1['1'])) {
                                    echo $ins_1['1'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="fromt_2" id="mask_date14" type="text" value="<?php
                                if (!empty($ins_2['1'])) {
                                    echo $ins_2['1'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="fromt_3" id="mask_date15" type="text" value="<?php
                                if (!empty($ins_3['1'])) {
                                    echo $ins_3['1'];
                                }
                                ?>">
                               
                            </div>
                             <div class="col-md-1">
                                <H4 class="eduFormTitle"><?php echo lang('tea_toend'); ?></H4>
                                <input class="form-control eduForm" name="toendt_1" id="mask_date16" type="text" value="<?php
                                if (!empty($ins_1['2'])) {
                                    echo $ins_1['2'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="toendt_2" id="mask_date17" type="text" value="<?php
                                if (!empty($ins_2['2'])) {
                                    echo $ins_2['2'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="toendt_3" id="mask_date18" type="text" value="<?php
                                if (!empty($ins_3['2'])) {
                                    echo $ins_3['2'];
                                }
                                ?>">
                                
                            </div>
                              <div class="col-md-2">
                                <H4 class="eduFormTitle"><?php echo lang('tea_taught'); ?></H4>
                                <input class="form-control eduForm" name="class_taught_1" type="text" value="<?php
                                if (!empty($ins_1['3'])) {
                                    echo $ins_1['3'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="class_taught_2" type="text" value="<?php
                                if (!empty($ins_2['3'])) {
                                    echo $ins_2['3'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="class_taught_3" type="text" value="<?php
                                if (!empty($ins_3['3'])) {
                                    echo $ins_3['3'];
                                }
                                ?>">
                                
                            </div>
                              <div class="col-md-2">
                                <H4 class="eduFormTitle"><?php echo lang('tea_sub_taught'); ?></H4>
                                <input class="form-control eduForm" name="sub_taught_1" type="text" value="<?php
                                if (!empty($ins_1['3'])) {
                                    echo $ins_1['3'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="sub_taught_2" type="text" value="<?php
                                if (!empty($ins_2['3'])) {
                                    echo $ins_2['3'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="sub_taught_3" type="text" value="<?php
                                if (!empty($ins_3['3'])) {
                                    echo $ins_3['3'];
                                }
                                ?>">
                                
                            </div>
                            
                        </div>
        <!---------------------------------------- Adminstrtive Experience--------------------------------->
         <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo lang('tea_admi_exp'); ?><span class="requiredStar"> * </span></label>
                            <div class="col-md-3">
                                <H4 class="eduFormTitle"><?php echo lang('tea_ins_serve'); ?></H4>
                                <input class="form-control eduForm" name="ins_servea_1" type="text" value="<?php
                                if (!empty($admin_1['0'])) {
                                    echo $admin_1['0'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="ins_servea_2" type="text" value="<?php
                                if (!empty($admin_2['0'])) {
                                    echo $admin_2['0'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="ins_servea_3" type="text" value="<?php
                                if (!empty($admin_3['0'])) {
                                    echo $admin_3['0'];
                                }
                                ?>">
                              
                            </div>
                            <div class="col-md-1">
                                <H4 class="eduFormTitle"><?php echo lang('tea_from'); ?></H4>
                                <input class="form-control eduForm" name="froma_1" id="mask_date19" type="text" value="<?php
                                if (!empty($admin_1['1'])) {
                                    echo $admin_1['1'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="froma_2" id="mask_date20" type="text" value="<?php
                                if (!empty($admin_2['1'])) {
                                    echo $admin_2['1'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="froma_3" id="mask_date21" type="text" value="<?php
                                if (!empty($admin_3['1'])) {
                                    echo $admin_3['1'];
                                }
                                ?>">
                               
                            </div>
                             <div class="col-md-1">
                                <H4 class="eduFormTitle"><?php echo lang('tea_toend'); ?></H4>
                                <input class="form-control eduForm" name="toenda_1" id="mask_date22" type="text" value="<?php
                                if (!empty($admin_1['2'])) {
                                    echo $admin_1['2'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="toenda_2" id="mask_date23" type="text" value="<?php
                                if (!empty($admin_2['2'])) {
                                    echo $admin_2['2'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="toenda_3" id="mask_date24" type="text" value="<?php
                                if (!empty($admin_3['2'])) {
                                    echo $admin_3['2'];
                                }
                                ?>">
                                
                            </div>
                              <div class="col-md-2">
                                <H4 class="eduFormTitle"><?php echo lang('tea_posi'); ?></H4>
                                <input class="form-control eduForm" name="posi_1" type="text" value="<?php
                                if (!empty($admin_1['3'])) {
                                    echo $admin_1['3'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="posi_2" type="text" value="<?php
                                if (!empty($admin_2['3'])) {
                                    echo $admin_2['3'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="posi_3" type="text" value="<?php
                                if (!empty($admin_3['3'])) {
                                    echo $admin_3['3'];
                                }
                                ?>">
                            </div>
                        </div>
<!---------------------------------------- Organize------------------------------------->
                 <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo lang('tea_organize'); ?></label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="a" value="<?php echo $a; ?>">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="b" value="<?php echo $b; ?>">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="c" value="<?php echo $c; ?>">
                            </div>
                        </div>

<!--------------------Refrence ------------------------>
<div class="form-group">
                            <label class="col-md-3 control-label"><?php echo lang('tea_refrence'); ?><span class="requiredStar"> * </span></label>
                            <div class="col-md-3">
                                <H4 class="eduFormTitle"><?php echo lang('tea_orgname'); ?></H4>
                                <input class="form-control eduForm" name="orgname_1" type="text" value="<?php
                                if (!empty($org_1['0'])) {
                                    echo $org_1['0'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="orgname_2" type="text" value="<?php
                                if (!empty($org_2['0'])) {
                                    echo $org_2['0'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="orgname_3" type="text" value="<?php
                                if (!empty($org_3['0'])) {
                                    echo $org_3['0'];
                                }
                                ?>">
                              
                            </div>
                            <div class="col-md-2">
                                <H4 class="eduFormTitle"><?php echo lang('tea_orgadd'); ?></H4>
                                <input class="form-control eduForm" name="orgadd_1" type="text" value="<?php
                                if (!empty($org_1['1'])) {
                                    echo $org_1['1'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="orgadd_2" type="text" value="<?php
                                if (!empty($org_2['1'])) {
                                    echo $org_2['1'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="orgadd_3" type="text" value="<?php
                                if (!empty($org_3['1'])) {
                                    echo $org_3['1'];
                                }
                                ?>">
                               
                            </div>
                             <div class="col-md-2">
                                <H4 class="eduFormTitle"><?php echo lang('tea_orgtel'); ?></H4>
                                <input class="form-control eduForm" name="orgtel_1" type="text" value="<?php
                                if (!empty($org_1['2'])) {
                                    echo $org_1['2'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="orgtel_2" type="text" value="<?php
                                if (!empty($org_2['2'])) {
                                    echo $org_2['2'];
                                }
                                ?>">
                                <input class="form-control eduForm" name="orgtel_3" type="text" value="<?php
                                if (!empty($org_3['2'])) {
                                    echo $org_3['2'];
                                }
                                ?>">
                                
                            </div>
                             
                        </div>




<div class="form-group">
                            <label class="col-md-3 control-label"><?php echo lang('tea_why'); ?></label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="recommendation" value="<?php echo $recomen; ?>">
                            </div>

                        </div>
                        <div class="alert alert-success">
                            <strong><?php echo lang('tea_note'); ?>:</strong> <?php echo lang('tea_sadi'); ?>
                        </div>
                     
                        
                        <div class="form-actions fluid">
                            <div class="col-md-offset-3 col-md-6">
                                <button type="submit" class="btn green" name="submit" value="Update"><?php echo lang('save'); ?></button>
                                <button type="reset" onclick="javascript:history.back()" class="btn default"><?php echo lang('back'); ?></button>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
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
    jQuery(document).ready(function () {
        //here is auto reload after 1 second for time and date in the top
        jQuery(setInterval(function () {
            jQuery("#result").load("index.php?module=home&view=iceTime");
        }, 1000));
    });
</script>
<script>
    $( function() {
    $( "#mask_date1",  ).datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: "1920:2050"
    });
  } );
$( function() {
    $( "#mask_date3" ).datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: "1920:2050"
    });
  } );
$( function() {
    $( "#mask_date4" ).datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: "1920:2050"
    });
  } );
$( function() {
    $( "#mask_date5" ).datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: "1920:2050"
    });
  } );
$( function() {
    $( "#mask_date6" ).datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: "1920:2050"
    });
  } );
$( function() {
    $( "#mask_date7" ).datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: "1920:2050"
    });
  } );
$( function() {
    $( "#mask_date8" ).datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: "1920:2050"
    });
  } );
$( function() {
    $( "#mask_date9" ).datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: "1920:2050"
    });
  } );
$( function() {
    $( "#mask_date10" ).datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: "1920:2050"
    });
  } );
$( function() {
    $( "#mask_date11" ).datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: "1920:2050"
    });
  } );
$( function() {
    $( "#mask_date12" ).datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: "1920:2050"
    });
  } );
$( function() {
    $( "#mask_date13" ).datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: "1920:2050"
    });
  } );
$( function() {
    $( "#mask_date14" ).datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: "1920:2050"
    });
  } );
$( function() {
    $( "#mask_date15" ).datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: "1920:2050"
    });
  } );
$( function() {
    $( "#mask_date16" ).datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: "1920:2050"
    });
  } );
$( function() {
    $( "#mask_date17" ).datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: "1920:2050"
    });
  } );
$( function() {
    $( "#mask_date18" ).datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: "1920:2050"
    });
  } );
$( function() {
    $( "#mask_date19" ).datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: "1920:2050"
    });
  } );
$( function() {
    $( "#mask_date20" ).datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: "1920:2050"
    });
  } );
$( function() {
    $( "#mask_date21" ).datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: "1920:2050"
    });
  } );
$( function() {
    $( "#mask_date22" ).datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: "1920:2050"
    });
  } );
$( function() {
    $( "#mask_date23" ).datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: "1920:2050"
    });
  } );
$( function() {
    $( "#mask_date24" ).datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: "1920:2050"
    });
  } );
$( function() {
    $( "#mask_date25" ).datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: "1920:2050"
    });
  } );
$( function() {
    $( "#mask_date26" ).datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: "1920:2050"
    });
  } );
$( function() {
    $( "#mask_date27" ).datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: "1920:2050"
    });
  } );
$( function() {
    $( "#mask_date28" ).datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: "1920:2050"
    });
  } );
</script>
<script>
    $( document ).ready( function () {
        //form ma lagy huvy button ko disable krny k lia code
        jQuery( "#btn_hidde" ).prop( 'disabled', true );

        var toValidate = jQuery( '.a, .b, .c, .d, .e, .f, .g, .h, .i, .j, .k, .l, .m, .n, .o, .p, .q, .r, .s, .t, .u, .v, .w, .x, .y, .z' ),
            valid = false;
        toValidate.keyup( function () {
            if ( jQuery( this ).val().length > 0 ) {
                jQuery( this ).data( 'valid', true );
            } else {
                jQuery( this ).data( 'valid', false );
            }
            toValidate.each( function () {
                if ( jQuery( this ).data( 'valid' ) == true ) {
                    valid = true;
                } else {
                    valid = false;
                }
            } );
            if ( valid === true ) {
                jQuery( "#btn_hidde" ).prop( 'disabled', false );
            } else {
                jQuery( "#btn_hidde" ).prop( 'disabled', true );
            }
        } );
        // form ko hide and show krny k liya code  
        $( "#btn_hidde" ).click( function () {
            $( "#div1" ).hide();
            $( "#btn_hidde" ).hide();
            $( "#div2" ).show();
        } );
        $( "#pre_btn" ).click( function () {
            $( "#div2" ).hide();
            $( "#btn_hidde" ).show();
            $( "#div1" ).show();
        } );

    } );
</script>