<!-- BEGIN CONTENT -->
<?php $user = $this->ion_auth->user()->row();
$userId = $user->id; ?>
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                    <?php echo lang('con_set_fee'); ?> <small></small>
                </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <?php echo lang('home'); ?>
                    </li>
                    <li>
                        <?php echo lang('con_configu'); ?>
                    </li>
                    <li>
                        <?php echo lang('con_set_st_fee'); ?>
                    </li>
                    <li>
                        Edit Fee Structure
                    </li>
                    <li id="result" class="pull-right topClock"></li>
                </ul>
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
                            Edit Fee Structure
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <?php
                        $form_attributs = array('class' => 'form-horizontal', 'role' => 'form');
                        echo form_open('configuration/edit_fee_structure', $form_attributs);
                        ?>
                        <div class="form-body">
                            <?php
                            if (!empty($successMessage)) {
                                echo $successMessage;
                            }
                            foreach ($fee_stru as $row){

                                $month=$row['month']; 
                                        if($month==1){ $monthName="January";} 
                                        elseif($month==2){$monthName="February";}
                                        elseif($month==3){$monthName="March";}
                                        elseif($month==4){$monthName="April";}
                                        elseif($month==5){$monthName="May";}
                                        elseif($month==6){$monthName= "June";}
                                        elseif($month==7){$monthName="July";}
                                        elseif($month==8){$monthName="August";}
                                        elseif($month==9){$monthName="September";}
                                        elseif($month==10){$monthName= "October";}
                                        elseif($month==11){$monthName="November";}
                                        elseif($month==12){$monthName="December";}
                                        else{echo "no month select";}
                                   
                            ?>
                            <div class="col-md-8">
                                <div class="form-group">
                                   <label class="col-md-4 control-label"> Month </label>
                                   <div class="col-md-8">
                                    <select name="add_month" id="add_month" class="form-control" data-validation="required" data-validation-error-msg="<?php echo "Please Select Month Field First"; ?>" >
                                        <option value="<?php echo $row['month']; ?>"><?php echo $monthName; ?></option>
                                        <option value="">Select...</option>
                                        <option value="1">January</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                       <!-- <input type="text" class="form-control" name="add_month"  id="mask_date2" placeholder="Select Month...." > -->
 <!-- data-validation="required" data-validation-error-msg="<?php // echo "select session year First"; ?>" -->
                                   </div>
                               </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label"> Registration fee </label>
                                    <div class="col-md-8">
                                        <input type="text" name="registration_fee" value="<?php echo $row['registration_fee']; ?>" class="form-control">
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="col-md-4 control-label"> Adsission fee </label>
                                    <div class="col-md-8">
                                        <input type="text" name="admission_fee" value="<?php echo $row['admission_fee']; ?>" class="form-control">
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Annual Funds</label>
                                    <div class="col-md-8">
                                        <input type="text" name="annual_fund" value="<?php echo $row['annual_fund']; ?>" class="form-control">
                                    </div>
                                </div>
                                <input type="text" name="session" value="<?php echo $row['session']; ?>">
                                <input type="text" name="item_id" value="<?php echo $row['id']; ?>">
                                <input type="text" name="created_by" value="<?php echo $userId; ?>">

                            </div>
                            <?php } ?>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-actions fluid">
                            <div class="col-md-offset-3 col-md-6">
                                <button type="submit" class="btn green" name="submit" value="Submit"><?php echo lang('save'); ?></button>
                                <button class="btn default" onclick="javascript:history.back()" type="button">Go Back</button>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
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
