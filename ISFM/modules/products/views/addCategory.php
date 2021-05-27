
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
         <?php $user = $this->ion_auth->user()->row();
$userId = $user->id; ?>
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12 ">
                <?php if (!empty($success)) {
                    echo $success;
                } ?>
                <!-- BEGIN SAMPLE FORM PORTLET-->
                <div class="portlet box green ">
                    <div class="portlet-title">
                        <div class="caption">
                             Add Category
                        </div> 
                    </div>
                    <div class="portlet-body form">
                        <?php $form_attributs = array('class' => 'form-horizontal', 'role' => 'form');
                        echo form_open('products/addCategory', $form_attributs);
                        ?>
                        <input type="hidden" name="user_id" value="<?php echo $userId; ?>">
                            <div class="form-body"> 
                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Categroy Name<span class="requiredStar">  </span></label>
                                    <div class="col-md-6">
                                        <input type="text" name="cat_name" class="form-control" placeholder="Add Category Name" required >
                                    </div>
                                </div>
                              
                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Company Name <span class="requiredStar">  </span></label>
                                    <div class="col-md-6">
                                        <input type="text" name="company_name" class="form-control" placeholder="Add Company Name">
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Company Discription <span class="requiredStar">  </span></label>
                                    <div class="col-md-6">
                                        <textarea id="" rows="4" cols="50" name="discription" class="form-control" placeholder="Add Company Discription">  </textarea>
                                    </div>
                                </div> 
                            </div>
                            <div class="form-actions fluid">
                                <div class="col-md-offset-3 col-md-6">
                                    <button type="submit" name="submit" class="btn green" value="Add Category">  Add Category </button> 
                                    <button type="reset" class="btn default"> Cancel </button>
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
