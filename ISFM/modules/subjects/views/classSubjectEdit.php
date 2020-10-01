
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                   Edit Subject For Class <small></small>
                </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <i class="fa fa-home"></i><?php echo lang('home'); ?>
                        
                    </li>
                    <li>
                        <?php echo lang('sub_subject'); ?>
                        
                    </li>
                    <li>
                        Edit Subject
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
                <?php if (!empty($message)) {
                    echo $message;
                }  
                ?>
                <!-- BEGIN SAMPLE FORM PORTLET-->
                <?php  
                     
                    foreach($subInfo as $row){
                        $sub_title = $row['subject_title'];
                        $sub_writer = $row['writer_name'];
                        $class_id = $row['class_id'];
                        $subject_id = $row['id'];
                    } 
                     ?>
                <div class="portlet box green ">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-book"></i> <?php echo $this->common->class_title($class_id);?> Class Subject Edit
                        </div>
                        <div class="tools">
                            <a href="" class="collapse">
                            </a>
                            <a href="" class="reload">
                            </a>
                        </div>
                    </div> 
                    <div class="portlet-body form">
                        <?php $form_attributs = array('class' => 'form-horizontal', 'role' => 'form');
                        echo form_open('subjects/classSubjectEdit', $form_attributs);
                        ?>
                            <div class="form-body">
                                <!-- <div class="form-group">
                                    <label class="col-md-3 control-label"> <?php echo lang('class'); ?> <span class="requiredStar"> * </span></label>
                                    <div class="col-md-6">
                                        <select class="form-control" name="class_id" data-validation="required" data-validation-error-msg="">
                                            <option value=""><?php echo lang('select'); ?></option>
                                            <?php foreach ($class as $row) { ?>
                                                <option value="<?php echo $row['id']; ?>"><?php echo $row['class_title']; ?></option>
                                <?php } ?>
                                        </select>
                                    </div>
                                </div> -->
<input type="hidden" name="class_id" value="<?php echo $class_id;?>">
<input type="hidden" name="subject_id" value="<?php echo $subject_id;?>">
                                <div class="form-group">
                                    <label class="col-md-3 control-label"> <?php echo lang('sub_title'); ?> <span class="requiredStar">  </span></label>
                                    <div class="col-md-6">
                                        <input type="text" name="subject_title" class="form-control" value="<?php echo $sub_title;?>" data-validation="required" data-validation-error-msg="">
                                    </div>
                                </div>
                              
                                <div class="form-group">
                                    <label class="col-md-3 control-label"> <?php echo lang('sub_aut_name'); ?> <span class="requiredStar">  </span></label>
                                    <div class="col-md-6">
                                        <input type="text" name="writer_name" class="form-control" value="<?php echo $sub_writer;?>">
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                        <label class="col-md-3 control-label"> <?php echo lang('sub_opt_subj'); ?> </label>
                                        <div class="radio-list">
                                                <label class="radio-inline">
                                                <input type="radio" name="optionalSubject" id="optionsRadios4" value="1"> Yes </label>
                                                <label class="radio-inline">
                                                <input type="radio" name="optionalSubject" id="optionsRadios5" value="0" checked> No </label>
                                        </div>
                                </div> -->
                            </div>
                            <div class="form-actions fluid">
                                <div class="col-md-offset-3 col-md-6">
                                    <button type="submit" name="submit" class="btn green" value="Add Subject"> <?php echo lang('sub_addsub_but'); ?> </button>
                                     <button onclick="location.href = 'javascript:history.back()'" class="btn default" type="button"> <?php echo lang('back'); ?> </button>
                                    <button type="reset" class="btn default"> <?php echo lang('cancel'); ?> </button>
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
    jQuery(document).ready(function() {
//here is auto reload after 1 second for time and date in the top
        jQuery(setInterval(function() {
            jQuery("#result").load("index.php/home/iceTime");
        }, 1000));
    });
</script>
<script src="assets/global/plugins/jquery.form-validator.min.js" type="text/javascript"></script>
<script> $.validate(); </script>
