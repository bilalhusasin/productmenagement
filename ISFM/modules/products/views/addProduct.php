
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
                            Add Product
                        </div> 
                    </div>
                    <div class="portlet-body form">
                        <?php $form_attributs = array('class' => 'form-horizontal', 'role' => 'form');
                        echo form_open('products/addProduct', $form_attributs);
                        ?>
                        <input type="hidden" name="user_id" value="<?php echo $userId; ?>">
                            <div class="form-body"> 
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Category Name<span class="requiredStar"> * </span></label>
                                    <div class="col-md-6">  
                                        <select name="cat_id" class="form-control"  required>
                                            <!-- data-validation="required" data-validation-error-msg="Select Category Name." -->
                                              
                                            <option value="">Select...</option>
                                        <?php foreach($cateInfo as $row ){?>
                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['category_name']; ?></option> 
                                        <?php }?>
                                        </select>
                                    </div>
                                </div> 
                                  
                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Product Name <span class="requiredStar">  </span></label>
                                    <div class="col-md-6">
                                        <input type="text" name="product_name" class="form-control" placeholder="Add product Name" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Product Size <span class="requiredStar">  </span></label>
                                    <div class="col-md-6">
                                        <input type="text" name="product_size" class="form-control" placeholder="Add product size" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Product Price <span class="requiredStar">  </span></label>
                                    <div class="col-md-6">
                                        <input type="text" name="product_price" class="form-control" placeholder="Add product price">
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Product Discription <span class="requiredStar">  </span></label>
                                    <div class="col-md-6">
                                        <textarea id="" rows="4" cols="50" name="discription" class="form-control">  </textarea>
                                    </div>
                                </div> 
                            </div>
                            <div class="form-actions fluid">
                                <div class="col-md-offset-3 col-md-6">
                                    <button type="submit" name="submit" class="btn green" value="Add Product">  Add Product </button>
                                      
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
  
