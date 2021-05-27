<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
         <?php $user = $this->ion_auth->user()->row();
$userId = $user->id; ?>
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12 ">
                <!-- BEGIN SAMPLE FORM PORTLET-->
                <div class="portlet box green ">
                    <div class="portlet-title">
                        <div class="caption">
                            </i>  Edit Category
                        </div>
                         
                    </div>
                    <div class="portlet-body form">
                        <?php $form_attributs = array('class' => 'form-horizontal', 'role' => 'form');
                        echo form_open('products/editCategory', $form_attributs);
                        ?>
                        <div class="form-body">
                            <?php foreach($cateInfo as $row){
                             $category_name = $row['category_name'];
                             $company_name = $row['company_name'];
                             $company_discription = $row['company_discription'];
                             $status = $row['status'];
                            }?> 

                            <input type="hidden" name="cateId" value="<?php echo $cateId; ?>">
                            <input type="hidden" name="user_id" value="<?php echo $userId; ?>">
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label"> Category Name <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="category_name" value="<?php echo $category_name;?>" required >
                                </div>
                            </div> 
                            <div class="form-group">
                                <label class="col-md-3 control-label"> Company Name <span class="requiredStar">  </span></label>
                                <div class="col-md-6">
                                    <div id="section_div">
                                        <input type="text" name="company_name" class="form-control" value="<?php echo $company_name;?>" required>
                                    </div> 
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="col-md-3 control-label"> Company Discriptions <span class="requiredStar">  </span></label>
                                <div class="col-md-6">
                                    <div id="section_div">
                                        <input type="text" name="company_discription" class="form-control" value="<?php echo $company_discription;?>">
                                    </div> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Status<span class="requiredStar"> * </span></label>
                                <div class="col-md-6">  
                                    <select name="status" class="form-control" required>
                                        <option value="<?php echo $status;?>"><?php echo $status; ?></option>
                                        <option value="">Select...</option>
                                        <option value="Active">Active</option>
                                        <option value="Deactive">Deactive</option> 
                                    </select>
                                </div>
                            </div> 
                        </div>
                        <div class="form-actions fluid">
                            <div class="col-md-offset-3 col-md-6">
                                <button type="submit" name="submit" class="btn green" value="Edit Category">Edit Category</button>
                                <button type="reset" class="btn default">Refresh</button>
                                <a type="button" class="btn default" href="javascript:history.back()">
                                    <i class="fa fa-mail-reply-all"></i> Go Back </a>
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
 
 