<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
<link rel="stylesheet" href="assets/global/plugins/jquery-ui/jquery-ui.css">
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN CONTENT -->

<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title">
					<?php echo lang('tea_ant'); ?> <small></small>
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
						<?php echo lang('header_a_nteac'); ?>
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
							<?php echo lang('tea_gtifnt'); ?>
						</div>
						<div class="tools">
							<a href="" class="collapse">
                            </a>
						
							<a href="" class="reload">
                            </a>
						
						</div>
					</div>
					<div class="portlet-body form">
						<?php
						$form_attributs = array( 'class' => 'form-horizontal', 'role' => 'form' );
						echo form_open_multipart( 'users/addTeacher', $form_attributs );
						?>
						<div class="form-body">
							<?php
							if ( !empty( $success ) ) {
								echo $success;
							}
							?>
						<div id="div1">
								<div>
									<h2 style="padding-left: 4%; font-weight: 700;">Teachers Information</h2>
									<h2 style="padding-left: 4%; font-weight: 200;">Please Read The Following instructions carefully</h2>
									<p style="padding-left: 12%;"> 1. Complete the Application Form By Yourself </p>
									<p style="padding-left: 12%;"> 2. All the columns must be filled in or crossed out, as the case may be. </p>
									<p style="padding-left: 12%;"> 3. Attach attested copies of the following with the application form</p>
									
						<div class="form-group">
							<div class="form-group" >
							<h4 class="col-md-3 control-label" style="font-weight: 600"> <?php echo lang('tea_dd') ?>
								 <!--<span class="requiredStar"> * </span>-->
							</h4>
							<div class="col-md-6" style="padding-top: 1%">

						 <input type='file' name="degree">
    					  
 							 </div>
 							</div>
 							<div class="form-group" >
					    
									 
							<h4 class="col-md-3 control-label" style="font-weight: 600">C.N.I.C Pic
								  <!--<span class="requiredStar"> * </span>-->
							</h4>
							<div class="col-md-6" style="padding-top: 1%">

						 <input type='file' name="cnic"> 
    					  
 							 </div>
 							</div>
					   
									
										<div class="form-group">
							<h4 class="col-md-3 control-label" style="font-weight: 600"> E.O.I.B 
							</h4>
							<div class="col-md-6" style="padding-top: 1%">

						 <input type='file' name="eoib"> <br/>
    					  
 							 </div>
					    </div>
					</div>
									<p style="padding-left: 8%;"> N.B.</p>
									<p style="padding-left: 14%;"> a. Only the applicants possessing the relevant  qualification mentioned  below may apply for the required post.</p>
									<p style="padding-left: 16%;"> 1. Master Level Subjects. English, Urdu, Mathematics, Physics, Chemistry, Biology, History, Geography, Political Science, Pakistan Studies, Islamiat, Fine Art and Computer Science.</p>
									<p style="padding-left: 16%;"> 2.Graduation Level Subjects. English Literature, Urdu Literature, Mathematics, Physics, Chemistry, Biology, History, Zoology, Psychology, Political Science, Pakistan Studies, Islamiat, Fine Art and Computer Science.</p>
									<p style="padding-left: 14%;"> b. The applicant will be called for an interview only if there exists a vacancy</p>
									<p style="padding-left: 14%;"> c. The application will remain valid for one year.</p>
									<p style="padding-left: 14%;"> d. Incomplete/Incorrectly filled in application form will not be entered..</p>
								</div>
								<hr>
								<div class="col-md-9" style="padding-left: 8%">
									<div class="form-group">
										<label class="col-md-3 control-label">
											<?php echo lang('tea_position'); ?> <span class="requiredStar"> * </span>
										</label>
										<div class="col-md-6">
											<input type="text" class="form-control a" placeholder="Position Applied For" name="applied_posi" data-validation="required" data-validation-error-msg="">
											<span class="help-block">
												<?php echo lang('tea_mark'); ?> </span>
										</div>

									</div>

									<div class="form-group" style="margin-left: 24%">
										<div class="col-md-4">
											<label class="col-md-3 control-label">
												<?php echo lang('tea_sub'); ?>
											</label>
											<input class="form-control eduForm b" name="sub1" type="text" placeholder="" data-validation="required" data-validation-error-msg="">

										</div>
										<div class="col-md-4">
											<label class="col-md-3 control-label">
												<?php echo lang('tea_cls'); ?>
											</label>
											<input class="form-control eduForm c" name="cls" type="text" placeholder="" data-validation="required" data-validation-error-msg="">

										</div>
									</div>
								</div>

								<div class="col-lg-9" style="padding-left: 8%">
									<div class="form-group">
										<label class="col-md-3 control-label">
											<?php echo lang('tea_nm'); ?> <span class="requiredStar"> * </span>
										</label>
										<div class="col-md-6">
											<input type="text" class="form-control d" placeholder="First Name" name="first_name" data-validation="required" data-validation-error-msg="">
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">
											<?php echo lang('tea_fn'); ?> <span class="requiredStar"> * </span>
										</label>
										<div class="col-md-6">
											<input type="text" class="form-control e" name="father_name" placeholder="" data-validation="required" data-validation-error-msg="">
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label">
											<?php echo lang('tea_cnic'); ?> <span class="requiredStar"> * </span>
										</label>
										<div class="col-md-6">
											<input type="text" class="form-control f" name="cnic" id="mask_cnic" data-validation="required" data-validation-error-msg=""/>
											<span class="help-block">
												<?php echo lang('tea_cnict'); ?> </span>
										</div>
									</div>
									  <div class="form-group">
                                <label class="control-label col-md-3"><?php echo lang('tea_dob'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-4">
                                	<input class="form-control eduForm date-picker g" name="birthdate" type="text" placeholder="">
                                    
                                    <span class="help-block"><?php echo lang('tea_dformet'); ?> </span>
                                </div>
                            </div>
						</div>
								<div class="col-lg-3">

									<div class="form-group last">
										<label>
											<?php echo lang('tea_photo'); ?>  
										</label>
										<div>
											<div class="fileinput fileinput-new" data-provides="fileinput">
												<div class="fileinput-new thumbnail">
													<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""/>
												</div>
												<div class="fileinput-preview fileinput-exists thumbnail uploadImagePreview">
												</div>
												<div>
													<span class="btn default btn-file">
                                                <span class="fileinput-new"><?php echo lang('tea_si'); ?> </span>
												
													<span class="fileinput-exists">
														<?php echo lang('tea_change'); ?> </span>
													<input type="file" name="userfile"  >
													</span>
													<a href="#" class="btn red fileinput-exists" data-dismiss="fileinput">
														<?php echo lang('tea_remove'); ?> </a>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="form-group" style="margin-right: 28%; padding-left: 10%">
									<label class="col-md-3 control-label">
										<?php echo lang('tea_sex'); ?> <span class="requiredStar"> * </span>
									</label>
									<div class="col-md-6 marginLeftSex h">
										<div class="radio-list">
											<label class="radio-inline">
                                            <input type="radio" name="sex" id="optionsRadios4" value="Male" data-validation="required" data-validation-error-msg=""><?php echo lang('tea_male'); ?></label>
										
											<label class="radio-inline">
                                            <input type="radio" name="sex" id="optionsRadios5" value="Female" data-validation="required" data-validation-error-msg=""> <?php echo lang('tea_female'); ?> </label>
										
											 
										
										</div>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label">
										<?php echo lang('tea_marid'); ?>  
									</label>
									<label class="col-md-1 control-label"></label>
									<div class="col-md-6 marginLeftSex i">

										<div class="radio-list">
											<label class="radio-inline">
                                            <input type="radio" name="married" id="optionsRadios4" value="yes" data-validation="required" data-validation-error-msg=""><?php echo lang('tea_yes'); ?></label>
										
											<label class="radio-inline">
                                            <input type="radio" name="married" id="optionsRadios5" value="no" data-validation="required" data-validation-error-msg=""> <?php echo lang('tea_no'); ?> </label>
										

										</div>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label">
										<?php echo lang('tea_divo'); ?>
									</label>
									<label class="col-md-1 control-label"></label>
									<div class="col-md-6 marginLeftSex j">

										<div class="radio-list">
											<label class="radio-inline">
                                            <input type="radio" name="divorced" id="optionsRadios4" value="yes" data-validation="required" data-validation-error-msg=""><?php echo lang('tea_yes'); ?></label>
										
											<label class="radio-inline">
                                            <input type="radio" name="divorced" id="optionsRadios5" value="no" data-validation="required" data-validation-error-msg=""> <?php echo lang('tea_no'); ?> </label>
										

										</div>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label">
										<?php echo lang('tea_widow'); ?> </label>
									<label class="col-md-1 control-label"></label>
									<div class="col-md-6 marginLeftSex k">

										<div class="radio-list">
											<label class="radio-inline">
                                            <input type="radio" name="widow" id="optionsRadios4" value="yes" data-validation="required" data-validation-error-msg=""><?php echo lang('tea_yes'); ?></label>
										
											<label class="radio-inline">
                                            <input type="radio" name="widow" id="optionsRadios5" value="no" data-validation="required" data-validation-error-msg=""> <?php echo lang('tea_no'); ?> </label>
										

										</div>
									</div>
								</div>
							

							<div class="form-group">
								<label class="col-md-3 control-label">
									<?php echo lang('tea_spnm'); ?>  
								</label>
								<div class="col-md-6">
									<input type="text" class="form-control l" name="spouse_name" placeholder="" >
								</div>
							</div>
							<div class="form-group" style="margin-left: 24%">
								<div class="col-md-3">
									<label class="col-md-6 control-label">
										<?php echo lang('tea_spquail'); ?>
									</label>
									<input class="form-control eduForm m" name="spouse_qualification" type="text" placeholder="" >
								</div>
								<div class="col-md-3">
									<label class="col-md-6 control-label">
										<?php echo lang('tea_spprof'); ?>
									</label>
									<input class="form-control eduForm n" name="spouse_profession" type="text" placeholder="">
								</div>
							</div>
							<div class="form-group" style="margin-left: 24%">

								<div class="col-md-3">
									<label class="col-md-12">
										<?php echo lang('tea_nochild'); ?>
									</label>
									<input class="form-control eduForm o" name="no_children" type="text" placeholder="" >

								</div>
								<div class="col-md-3">
									<label class="col-md-12">
										<?php echo lang('tea_eldchild'); ?>
									</label>
									<input class="form-control eduForm p" name="elder_child" type="text" placeholder="" >

								</div>
								<div class="col-md-3">
									<label class="col-md-12">
										<?php echo lang('tea_yungchild'); ?>
									</label>
									<input class="form-control eduForm q" name="young_child" type="text" placeholder="" >

								</div>
							</div>
							<div class="form-group" style="margin-left: 24%">

								<div class="col-md-3">
									<label class="col-md-12">
										<?php echo lang('tea_nati'); ?>
									</label>
									<input class="form-control eduForm r" name="nationality" type="text" placeholder="" data-validation="required" data-validation-error-msg="">

								</div>
								<div class="col-md-4">
									<label class="col-md-9">
										<?php echo lang('tea_reli'); ?>
									</label>
									<div class="col-md-8">
							            	<select name="religion" class="form-control s" data-validation="required" data-validation-error-msg="">
									         <option value="">
									         	<?php echo lang('select'); ?>
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
									<input class="form-control eduForm t" name="sect" type="text" placeholder="" data-validation="required" data-validation-error-msg="">

								</div>
							</div>
							<div class="form-group" style="margin-left: 24%">

								<div class="col-md-3">
									<label class="col-md-12">
										<?php echo lang('tea_pb'); ?>
									</label>
									<input class="form-control eduForm u" name="place_birth" type="text" placeholder="" data-validation="required" data-validation-error-msg="">

								</div>
								<div class="col-md-3">
									<label class="col-md-12">
										<?php echo lang('tea_count'); ?>
									</label>
									<input class="form-control eduForm v" name="country" type="text" placeholder="" data-validation="required" data-validation-error-msg="">

								</div>
								
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">
									<?php echo lang('tea_prea'); ?> <span class="requiredStar"> * </span>
								</label>
								<div class="col-md-6">
									<textarea class="form-control w" name="present_address" rows="3" data-validation="required" data-validation-error-msg=""></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">
									<?php echo lang('tea_per_add'); ?> <span class="requiredStar"> * </span>
								</label>
								<div class="col-md-6">
									<textarea class="form-control x" name="permanent_address" rows="3" data-validation="required" data-validation-error-msg=""></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">
									<?php echo lang('tea_pn'); ?> <span class="requiredStar"> * </span>
								</label>
								<div class="col-md-1">
									<input type="text" class="form-control y" name="phoneCode" placeholder="+880" data-validation="required" data-validation-error-msg="" value="<?php
                                    if (!empty($countryPhoneCode)) {
                                        echo $countryPhoneCode;
                                    }
                                    ?>">
								</div>
								<div class="col-md-4">
									<input type="text" class="form-control z" name="phone" placeholder="" data-validation="required" data-validation-error-msg="">
									<span class="help-block">
										<?php echo lang('tea_1600'); ?>
									</span>
								</div>
							</div>
							<div class="form-actions fluid">
								<div class="col-md-offset-3 col-md-6">
									<button type="button" id="btn_hidde" class="btn btn-success btn-lg"> Next </button>
								</div>
							</div>
						</div>
					
					<div style="display: none;" id="div2" >
                        
                  
						<div class="form-group" >
							<label class="col-md-3 control-label">
								<?php echo lang('tea_email'); ?> <span class="requiredStar"> * </span>
							</label>
							<div class="col-md-6">
								<input type="email" class="form-control" onkeyup="checkEmail(this.value)" placeholder="demo@demo.com" name="email" placeholder="" data-validation="required" data-validation-error-msg="">
								<div id="checkEmail" class="col-md-12"></div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">
								<?php echo lang('tea_pass'); ?> <span class="requiredStar"> * </span>
							</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password" placeholder="" data-validation="required" data-validation-error-msg="">
								
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">
								<?php echo lang('tea_wp'); ?> <span class="requiredStar"> * </span>
							</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="work_place" placeholder="" data-validation="required" data-validation-error-msg="">
								
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">
								<?php echo lang('tea_tel'); ?> <span class="requiredStar"> * </span>
							</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="tel" placeholder="" data-validation="required" data-validation-error-msg="">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">
								<?php echo lang('tea_wh'); ?> <span class="requiredStar"> * </span>
							</label>
							<div class="col-md-6">
								<select name="workingHoure" class="form-control" data-validation="required" data-validation-error-msg="">
									<option value="">
										<?php echo lang('select'); ?>
									</option>
									<option value="Part time">
										<?php echo lang('tea_pt'); ?>
									</option>
									<option value="Full time">
										<?php echo lang('tea_ft'); ?>
									</option>
								</select>
							</div>
						</div>
						<div class="form-group" style="margin-left: 10%">
							<label class="col-md-3 control-label">
								<?php echo lang('tea_ap'); ?> <span class="requiredStar"> * </span>
							</label>
							<div class="col-md-6 marginLeftSex">
								<div class="radio-list">
									<label class="radio-inline">
                                            <input type="radio" name="applied" id="optionsRadios4" value="Yes" data-validation="required" data-validation-error-msg=""><?php echo lang('tea_yes'); ?></label>
								
									<label class="radio-inline">
                                            <input type="radio" name="applied" id="optionsRadios5" value="No" data-validation="required" data-validation-error-msg=""> <?php echo lang('tea_no'); ?> </label>
								
								</div>
							</div>
						</div>
						<!------------------------------ Teacher Education---------------------------------------->
						<div class="form-group">
							<label class="col-md-3 control-label">
								<?php echo lang('tea_eq'); ?><span class="requiredStar"> * </span>
							</label>
							<div class="col-md-1">
								<H4 class="eduFormTitle">
									<?php echo lang('tea_dd'); ?>
								</H4>
								<input class="form-control eduForm" name="dd_1" type="text" placeholder="" data-validation="required" data-validation-error-msg="">
								<input class="form-control eduForm" name="dd_2" type="text" placeholder="">
								<input class="form-control eduForm" name="dd_3" type="text" placeholder="">
								<input class="form-control eduForm" name="dd_4" type="text" placeholder="">
								<input class="form-control eduForm" name="dd_5" type="text" placeholder="">
							</div>
							<div class="col-md-2">
								<H4 class="eduFormTitle">
									<?php echo lang('tea_scu'); ?>
								</H4>
								<input class="form-control eduForm" name="scu_1" type="text" placeholder="" data-validation="required" data-validation-error-msg="">
								<input class="form-control eduForm" name="scu_2" type="text" placeholder="">
								<input class="form-control eduForm" name="scu_3" type="text" placeholder="">
								<input class="form-control eduForm" name="scu_4" type="text" placeholder="">
								<input class="form-control eduForm" name="scu_5" type="text" placeholder="">
							</div>
							<div class="col-md-2">
								<H4 class="eduFormTitle">
									<?php echo lang('tea_sub'); ?>
								</H4>
								<input class="form-control eduForm" name="subj_1" type="text" placeholder="" data-validation="required" data-validation-error-msg="">
								<input class="form-control eduForm" name="subj_2" type="text" placeholder="">
								<input class="form-control eduForm" name="subj_3" type="text" placeholder="">
								<input class="form-control eduForm" name="subj_4" type="text" placeholder="">
								<input class="form-control eduForm" name="subj_5" type="text" placeholder="">
							</div>
							<div class="col-md-1">
								<H4 class="eduFormTitle">
									<?php echo lang('tea_py'); ?>
								</H4>
								<input class="form-control eduForm date-picker" name="paYear_1" type="text" placeholder="">
								<input class="form-control eduForm date-picker" name="paYear_2" type="text"  placeholder="">
								<input class="form-control eduForm date-picker" name="paYear_3" type="text"  placeholder="">
								<input class="form-control eduForm date-picker" name="paYear_4" type="text"   placeholder="">
								<input class="form-control eduForm date-picker" name="paYear_5" type="text"  placeholder="">
							</div>
							<div class="col-md-1">
								<H4 class="eduFormTitle">
									<?php echo lang('tea_grade'); ?>
								</H4>
								<input class="form-control eduForm" name="result_1" type="text" placeholder="" data-validation="required" data-validation-error-msg="">
								<input class="form-control eduForm" name="result_2" type="text" placeholder="">
								<input class="form-control eduForm" name="result_3" type="text" placeholder="">
								<input class="form-control eduForm" name="result_4" type="text" placeholder="">
								<input class="form-control eduForm" name="result_5" type="text" placeholder="">
							</div>
								<div class="col-md-1" style="margin-left: 2%">
								<H4 class="eduFormTitle">
									<?php echo lang('tea_priv'); ?>
								</H4>
								<input class="form-control eduForm" name="reg_1" type="text" placeholder="" data-validation="required" data-validation-error-msg="">
								<input class="form-control eduForm" name="reg_2" type="text" placeholder="">
								<input class="form-control eduForm" name="reg_3" type="text" placeholder="">
								<input class="form-control eduForm" name="reg_4" type="text" placeholder="">
								<input class="form-control eduForm" name="reg_5" type="text" placeholder="">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">
								<?php echo lang('tea_exactiv'); ?> <span class="requiredStar"> * </span>
							</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="extra_activity" placeholder="" data-validation="required" data-validation-error-msg="">
							</div>
						</div>
						<!------------------------------ Teacher Quaification----------------------------------------->
						<div class="form-group">
							<label class="col-md-3 control-label">
								<?php echo lang('tea_profqual'); ?><span class="requiredStar"> * </span>
							</label>
							<div class="col-md-1">
								<H4 class="eduFormTitle">
									<?php echo lang('tea_teaqual'); ?>
								</H4>
								<input class="form-control eduForm" name="teaqual_1" type="text" placeholder="" data-validation="required" data-validation-error-msg="">
								<input class="form-control eduForm" name="teaqual_2" type="text" placeholder="">
								<input class="form-control eduForm" name="teaqual_3" type="text" placeholder="">
							</div>
							<div class="col-md-1">
								<H4 class="eduFormTitle">
									<?php echo lang('tea_teayear'); ?>
								</H4>
								<input class="form-control eduForm date-picker" name="teayear_1" type="text"   placeholder="" >
								<input class="form-control eduForm date-picker" name="teayear_2" type="text"   placeholder="">
								<input class="form-control eduForm date-picker" name="teayear_3" type="text"  placeholder="">
							</div>
							<div class="col-md-2">
								<H4 class="eduFormTitle">
									<?php echo lang('tea_teaspec'); ?>
								</H4>
								<input class="form-control eduForm" name="teaspec_1" type="text" placeholder="" data-validation="required" data-validation-error-msg="">
								<input class="form-control eduForm" name="teaspec_2" type="text" placeholder="">
								<input class="form-control eduForm" name="teaspec_3" type="text" placeholder="">
							</div>
							<div class="col-md-3">
								<H4 class="eduFormTitle">
									<?php echo lang('tea_scu'); ?>
								</H4>
								<input class="form-control eduForm" name="scul_1" type="text" placeholder="" data-validation="required" data-validation-error-msg="">
								<input class="form-control eduForm" name="scul_2" type="text" placeholder="">
								<input class="form-control eduForm" name="scul_3" type="text" placeholder="">
							</div>
							<div class="col-md-2">
								<H4 class="eduFormTitle">
									<?php echo lang('tea_grade'); ?>
								</H4>
								<input class="form-control eduForm" name="grade_1" type="text" placeholder="" data-validation="required" data-validation-error-msg="">
								<input class="form-control eduForm" name="grade_2" type="text" placeholder="">
								<input class="form-control eduForm" name="grade_3" type="text" placeholder="">
							</div>
						</div>
						<!----------------- Computer Skills------------------>
						<div class="form-group">
							<label class="col-md-3 control-label">
								<?php echo lang('tea_compskil'); ?><span class="requiredStar"> * </span>
							</label>
							<div class="col-md-9">
								<div class="" style="padding-top: 2%">
									<label>
                                            <input name="msword" value="msword" type="checkbox"> <?php echo lang('tea_word'); ?></label>
								
									<label>
                                            <input name="excel" value="msexcel" type="checkbox"> <?php echo lang('tea_excel'); ?> </label>
								
									<label>
                                            <input name="powerp" value="power_point" type="checkbox"> <?php echo lang('tea_powerp'); ?></label>
								
									<label>
                                            <input name="internet" value="internet" type="checkbox"> <?php echo lang('tea_internet'); ?></label>
								
								</div>
							</div>
						</div>
						<!----------------------------------Serice Trannings--------------------------------------->
						<div class="form-group">
							<label class="col-md-3 control-label">
								<?php echo lang('tea_train'); ?><span class="requiredStar"> * </span>
							</label>
							<div class="col-md-3">
								<H4 class="eduFormTitle">
									<?php echo lang('tea_course'); ?>
								</H4>
								<input class="form-control eduForm" name="cource_1" type="text" placeholder="" data-validation="required" data-validation-error-msg="">
								<input class="form-control eduForm" name="cource_2" type="text" placeholder="">
								<input class="form-control eduForm" name="cource_3" type="text" placeholder="">
							</div>
							<div class="col-md-1">
								<H4 class="eduFormTitle">
									<?php echo lang('tea_from'); ?>
								</H4>
								<input class="form-control eduForm date-picker" name="from_1" type="text"   placeholder="" >
								<input class="form-control eduForm date-picker" name="from_2" type="text"  placeholder="">
								<input class="form-control eduForm date-picker" name="from_3" type="text"   placeholder="">
							</div>
							<div class="col-md-1">
								<H4 class="eduFormTitle">
									<?php echo lang('tea_toend'); ?>
								</H4>
								<input class="form-control eduForm date-picker" name="toend_1" type="text"  placeholder="" >
								<input class="form-control eduForm date-picker" name="toend_2" type="text"  placeholder="">
								<input class="form-control eduForm date-picker" name="toend_3" type="text"   placeholder="">
							</div>
							<div class="col-md-2">
								<H4 class="eduFormTitle">
									<?php echo lang('tea_ins'); ?>
								</H4>
								<input class="form-control eduForm" name="ins_1" type="text" placeholder="" data-validation="required" data-validation-error-msg="">
								<input class="form-control eduForm" name="ins_2" type="text" placeholder="">
								<input class="form-control eduForm" name="ins_3" type="text" placeholder="">
							</div>
						</div>
						<!--------------------- Teaching Experience------------------------------------------------------>
						<div class="form-group">
							<label class="col-md-3 control-label">
								<?php echo lang('tea_experi'); ?><span class="requiredStar"> * </span>
							</label>
							<div class="col-md-3">
								<H4 class="eduFormTitle">
									<?php echo lang('tea_ins_serve'); ?>
								</H4>
								<input class="form-control eduForm" name="ins_serve_1" type="text" placeholder="" data-validation="required" data-validation-error-msg="">
								<input class="form-control eduForm" name="ins_serve_2" type="text" placeholder="">
								<input class="form-control eduForm" name="ins_serve_3" type="text" placeholder="">
							</div>
							<div class="col-md-1">
								<H4 class="eduFormTitle">
									<?php echo lang('tea_from'); ?>
								</H4>
								<input class="form-control eduForm date-picker" name="fromt_1" type="text"   placeholder="" >
								<input class="form-control eduForm date-picker" name="fromt_2" type="text"   placeholder="">
								<input class="form-control eduForm date-picker" name="fromt_3" type="text" placeholder="">
							</div>
							<div class="col-md-1">
								<H4 class="eduFormTitle">
									<?php echo lang('tea_toend'); ?>
								</H4>
								<input class="form-control eduForm date-picker" name="toendt_1" type="text"   placeholder="" >
								<input class="form-control eduForm date-picker" name="toendt_2" type="text"   placeholder="">
								<input class="form-control eduForm date-picker" name="toendt_3" type="text"   placeholder="">
							</div>
							<div class="col-md-2">
								<H4 class="eduFormTitle">
									<?php echo lang('tea_taught'); ?>
								</H4>
								<input class="form-control eduForm" name="class_taught_1" type="text" placeholder="" data-validation="required" data-validation-error-msg="">
								<input class="form-control eduForm" name="class_taught_2" type="text" placeholder="">
								<input class="form-control eduForm" name="class_taught_3" type="text" placeholder="">
							</div>
							<div class="col-md-2">
								<H4 class="eduFormTitle">
									<?php echo lang('tea_sub_taught'); ?>
								</H4>
								<input class="form-control eduForm" name="sub_taught_1" type="text" placeholder="" data-validation="required" data-validation-error-msg="">
								<input class="form-control eduForm" name="sub_taught_2" type="text" placeholder="">
								<input class="form-control eduForm" name="sub_taught_3" type="text" placeholder="">
							</div>
						</div>
						<!---------------------------------------- Adminstrtive Experience--------------------------------->
						<div class="form-group">
							<label class="col-md-3 control-label">
								<?php echo lang('tea_admi_exp'); ?><span class="requiredStar"> * </span>
							</label>
							<div class="col-md-3">
								<H4 class="eduFormTitle">
									<?php echo lang('tea_ins_serve'); ?>
								</H4>
								<input class="form-control eduForm" name="ins_servea_1" type="text" placeholder="" data-validation="required" data-validation-error-msg="">
								<input class="form-control eduForm" name="ins_servea_2" type="text" placeholder="">
								<input class="form-control eduForm" name="ins_servea_3" type="text" placeholder="">
							</div>
							<div class="col-md-1">
								<H4 class="eduFormTitle">
									<?php echo lang('tea_from'); ?>
								</H4>
								<input class="form-control eduForm date-picker" name="froma_1" type="text"   placeholder="" >
								<input class="form-control eduForm date-picker" name="froma_2" type="text"   placeholder="">
								<input class="form-control eduForm date-picker" name="froma_3" type="text"   placeholder="">
							</div>
							<div class="col-md-1">
								<H4 class="eduFormTitle">
									<?php echo lang('tea_toend'); ?>
								</H4>
								<input class="form-control eduForm date-picker" name="toenda_1" type="text"   placeholder="" >
								<input class="form-control eduForm date-picker" name="toenda_2" type="text"   placeholder="">
								<input class="form-control eduForm date-picker" name="toenda_3" type="text"   placeholder="">
							</div>
							<div class="col-md-2">
								<H4 class="eduFormTitle">
									<?php echo lang('tea_posi'); ?>
								</H4>
								<input class="form-control eduForm" name="posi_1" type="text" placeholder="" data-validation="required" data-validation-error-msg="">
								<input class="form-control eduForm" name="posi_2" type="text" placeholder="">
								<input class="form-control eduForm" name="posi_3" type="text" placeholder="">
							</div>
						</div>
						<!---------------------------------------- Organize------------------------------------->
						<div class="form-group">
							<label class="col-md-3 control-label">
								<?php echo lang('tea_organize'); ?> <span class="requiredStar"> * </span>
							</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="a" placeholder="" >
							</div>
							<div class="col-md-6">
								<input type="text" class="form-control" name="b" placeholder="" >
							</div>
							<div class="col-md-6">
								<input type="text" class="form-control" name="c" placeholder="" >
							</div>
						</div>
						<!--------------------Refrence ------------------------>
						<div class="form-group">
							<label class="col-md-3 control-label">
								<?php echo lang('tea_refrence'); ?><span class="requiredStar"> * </span>
							</label>
							<div class="col-md-3">
								<H4 class="eduFormTitle">
									<?php echo lang('tea_orgname'); ?>
								</H4>
								<input class="form-control eduForm" name="orgname_1" type="text" placeholder="" data-validation="required" data-validation-error-msg="">
								<input class="form-control eduForm" name="orgname_2" type="text" placeholder="">
								<input class="form-control eduForm" name="orgname_3" type="text" placeholder="">
							</div>
							<div class="col-md-2">
								<H4 class="eduFormTitle">
									<?php echo lang('tea_orgadd'); ?>
								</H4>
								<input class="form-control eduForm" name="orgadd_1" type="text" placeholder="" data-validation="required" data-validation-error-msg="">
								<input class="form-control eduForm" name="orgadd_2" type="text" placeholder="">
								<input class="form-control eduForm" name="orgadd_3" type="text" placeholder="">
							</div>
							<div class="col-md-2">
								<H4 class="eduFormTitle">
									<?php echo lang('tea_orgtel'); ?>
								</H4>
								<input class="form-control eduForm" name="orgtel_1" type="text" placeholder="" data-validation="required" data-validation-error-msg="">
								<input class="form-control eduForm" name="orgtel_2" type="text" placeholder="">
								<input class="form-control eduForm" name="orgtel_3" type="text" placeholder="">
							</div>
						</div>
						<!----------------- Office Use Only---------------------->
						<div>
							<div class="form-group">
								<label class="col-md-3 control-label">
									<?php echo lang('tea_why'); ?> <span class="requiredStar"> * </span>
								</label>
								<div class="col-md-6">
									<textarea class="form-control" name="recommendation" rows="3" data-validation="required" data-validation-error-msg=""></textarea>
								</div>
							</div>
							
						</div>
						<!-- <div class="form-group last">
                                <label class="control-label col-md-3"><?php// echo lang('tea_photo'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-9">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail">
                                            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""/>
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail uploadImagePreview">
                                        </div>
                                        <div>
                                            <span class="btn default btn-file">
                                                <span class="fileinput-new"><?php// echo lang('tea_si'); ?> </span>
                                                <span class="fileinput-exists"><?php// echo lang('tea_change'); ?> </span>
                                                <input type="file" name="userfile" data-validation="required" data-validation-error-msg="">
                                            </span>
                                            <a href="#" class="btn red fileinput-exists" data-dismiss="fileinput"><?php// echo lang('tea_remove'); ?> </a>
                                        </div>
                                    </div>
                                </div>
                            </div>-->
						<div class="alert alert-success">
							<strong>
								<?php echo lang('tea_note'); ?> :</strong>
							<?php echo lang('tea_sadi'); ?>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label"> </label>
							<div class="col-md-9">
								<div class="checkbox-list">
									<label>
                                            <input name="cv" value="submited" type="checkbox"> <?php echo lang('tea_cv'); ?></label>
								
									<label>
                                            <input name="educational_certificat" value="submited" type="checkbox"> <?php echo lang('tea_ec'); ?> </label>
								
									<label>
                                            <input name="exc" value="submited" type="checkbox"> <?php echo lang('tea_exc'); ?></label>
								
								</div>
							</div>
						</div>
					
						<div class="form-group">
							<label class="col-md-3 control-label">
								<?php echo lang('tea_sfi'); ?> <span class="requiredStar">  </span>
							</label>
							<div class="col-md-6">
								<input type="text" name="submited_info" class="form-control" placeholder="<?php echo lang('tea_fntaoi'); ?>" data-validation="required" data-validation-error-msg="">
							</div>
						</div>
						

						<div class="form-actions fluid">
							<div class="col-md-offset-3 col-md-6">
								<button type="submit" class="btn green" name="submit" value="submit">
									<?php echo lang('tea_si'); ?>
								</button>
								<button type="button" class="btn btn-primary" id="pre_btn">Previous</button>								<button type="reset" class="btn default">
									<?php echo lang('refresh'); ?>
								</button>
							</div>
						</div>
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
<!-- BEGIN PAGE LEVEL script -->
<script type="text/javascript" src="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
<script type="text/javascript" src="assets/global/plugins/jquery.input-ip-address-control-1.0.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js"></script>
<script src="assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript"></script>
<script src="assets/global/plugins/typeahead/handlebars.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/typeahead/typeahead.bundle.min.js" type="text/javascript"></script>
<script src="assets/admin/pages/scripts/components-form-tools.js"></script>
<script src="assets/global/plugins/jquery-ui/jquery-ui.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery.form-validator.min.js" type="text/javascript"></script>
<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="assets/global/plugins/jquery.form-validator.min.js"></script>
<script>
    $.validate();

    jQuery(document).ready(function () {
        if (jQuery().datepicker) {
            $('.date-picker').datepicker({
                rtl: Metronic.isRTL(),
                orientation: "left",
                autoclose: true
            });
            //$('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
        }

        //here is auto reload after 1 second for time and date in the top
        jQuery(setInterval(function () {
            jQuery("#result").load("index.php/home/iceTime");
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
	$.validate();
</script>
<script>
	jQuery( document ).ready( function () {
		ComponentsFormTools.init();
	} );

	function checkEmail( str ) {
		var xmlhttp;
		if ( str.length === 0 ) {
			document.getElementById( "checkEmail" ).innerHTML = "";
			return;
		}
		if ( window.XMLHttpRequest ) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		} else {
			// code for IE6, IE5
			xmlhttp = new ActiveXObject( "Microsoft.XMLHTTP" );
		}
		xmlhttp.onreadystatechange = function () {
			if ( xmlhttp.readyState === 4 && xmlhttp.status === 200 ) {
				document.getElementById( "checkEmail" ).innerHTML = xmlhttp.responseText;
			}
		};
		xmlhttp.open( "GET", "index.php/commonController/checkEmail?val=" + str, true );
		xmlhttp.send();
	}

	jQuery( document ).ready( function () {
		//here is auto reload after 1 second for time and date in the top
		jQuery( setInterval( function () {
			jQuery( "#result" ).load( "index.php/home/iceTime" );
		}, 1000 ) );
	} );
</script> 
<script type="text/javascript">
	var RecaptchaOptions = {
		theme: 'custom',
		custom_theme_widget: 'recaptcha_widget'
	};
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
<!-- END PAGE LEVEL script -->