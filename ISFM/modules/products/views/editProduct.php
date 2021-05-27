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
                          Edit Product
                        </div>
                         
                    </div>
                    <div class="portlet-body form">
                        <?php $form_attributs = array('class' => 'form-horizontal', 'role' => 'form');
                        echo form_open('products/editProducts', $form_attributs);
                        ?>
                        <div class="form-body">
                            <?php foreach($proInfo as $row){
                             $cate_id = $row['cate_id'];
                             $product_name = $row['product_name'];
                             $product_size = $row['product_size'];
                             $product_price = $row['product_price'];
                             $product_discription = $row['product_discription']; 
                             $status = $row['status'];
                            }?> 

                            <input type="hidden" name="proId" value="<?php echo $proId; ?>">
                            <input type="hidden" name="user_id" value="<?php echo $userId; ?>">
                            <div class="form-group">
                                <label class="col-md-3 control-label"> Category Name <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <select name="cate_id" class="form-control" required>
                                        <option value="<?php echo $cate_id;?>"><?php echo $this->productmodel->category_title($cate_id); ?></option>
                                            <option value="">Select...</option>
                                        <?php foreach($cateInfo as $row){?>
                                            <option value="<?php echo $row['id']?>"><?php echo $row['category_name']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div> 
                            <div class="form-group">
                                <label class="col-md-3 control-label"> Product Name <span class="requiredStar">  </span></label>
                                <div class="col-md-6">
                                    <div id="section_div">
                                        <input type="text" name="product_name" class="form-control" value="<?php echo $product_name;?>" required>
                                    </div> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"> Product size <span class="requiredStar">  </span></label>
                                <div class="col-md-6">
                                    <div id="section_div">
                                        <input type="text" name="product_size" class="form-control" value="<?php echo $product_size;?>" required>
                                    </div> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"> Product price <span class="requiredStar">  </span></label>
                                <div class="col-md-6">
                                    <div id="section_div">
                                        <input type="text" name="product_price" class="form-control" value="<?php echo $product_price;?>" required>
                                    </div> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"> Product discription <span class="requiredStar">  </span></label>
                                <div class="col-md-6">
                                    <div id="section_div">
                                        <input type="text" name="product_discription" class="form-control" value="<?php echo $product_discription;?>" required>
                                    </div> 
                                </div>
                            </div>



                            <div class="form-group">
                                <label class="col-md-3 control-label">Status<span class="requiredStar"> * </span></label>
                                <div class="col-md-6">  
                                    <select name="status" class="form-control"  required  >
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
 
 