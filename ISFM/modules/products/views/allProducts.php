 
<?php $user = $this->ion_auth->user()->row(); $userId = $user->id;?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
         
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <?php
                if (!empty($success)) {
                echo $success;
                }
                ?>
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            All Products
                        </div>
                    </div>

                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                                <tr>
                                    <th>Sr#</th>
                                    <th>Categroy Name</th>
                                    <th>Products Name</th>
                                    <th>Products Size</th>
                                    <th>Products Price</th>
                                    <th>Products Discription</th>
                                    <th>Products Status</th> 
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count=1; foreach ($proInfo as $row) { ?>
                                <tr>
                                    <td> <?php echo $count++; ?></td>
                                    <td> <?php echo $this->productmodel->category_title($row['cate_id']);?> </td>
                                    <td> <?php echo $row['product_name']; ?></td>
                                    <td> <?php echo $row['product_size']; ?></td>
                                    <td> <?php echo $row['product_price']; ?></td>
                                    <td> <?php echo $row['product_discription']; ?></td>
                                    <td> <?php echo $row['status']; ?></td> 
                                    <td>
                                        <a class="btn btn-xs green" href="index.php/products/productDetails?p_id=<?php echo $row['id']; ?>" title="Class Detail"> <i class="fa fa-send-o"></i>  </a>

                                         
                                        <a class="btn btn-xs blue" href="index.php/products/editProducts?c_id=<?php echo $row['id']; ?>" title="Category Info Edit"> <i class="fa fa-pencil"></i> </a>
                                        
                                        <a class="btn btn-xs red" href="index.php/products/delProduct?id=<?php echo $row['id']; ?>" onClick="javascript:return confirm('Are you sure you want to delete this product ?')" title="Delete Class Detail"> <i class="fa fa-trash-o"></i>   </a>
                                        
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
        <!-- END PAGE CONTENT-->
    </div>
</div>
<!-- END CONTENT -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
 