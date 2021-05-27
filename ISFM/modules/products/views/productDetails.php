 
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
         
        
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                     
                    <div class="col-md-12 profile-info datilsBodyMB">
                        <div class="portlet box green">
                            <div class="portlet-title">
                                <div class="caption">
                                    Product Detail
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse">
                                    </a>
                                    <a href="javascript:;" class="reload">
                                    </a>
                                </div>
                            </div>
                            <div class="portlet-body">

                                <?php foreach ($proInfo as $row){
                                    $cate_id = $row['cate_id'];
                                    $product_name = $row['product_name'];
                                    $product_size = $row['product_size'];
                                    $product_price = $row['product_price'];
                                    $product_discription = $row['product_discription'];
                                    $status = $row['status']; 
                                }?>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th colspan="2"> Product Detail </th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                            <tr>
                                                <td> Category Name</td>
                                                <td> <?php echo $this->productmodel->category_title($cate_id); ?></td> 
                                            </tr>
                                            <tr>
                                                <td> Product Name</td>
                                                <td> <?php echo $product_name; ?> </td> 
                                            </tr> 
                                            <tr>
                                                <td> Product Size</td>
                                                <td> <?php echo $product_size; ?> </td> 
                                            </tr>
                                            <tr>
                                                <td> Product Price</td>
                                                <td> <?php echo $product_price; ?> </td> 
                                            </tr>
                                            <tr>
                                                <td> Product Discription</td>
                                                <td> <?php echo $product_discription; ?> </td> 
                                            </tr>
                                            <tr>
                                                <td> Product Status</td>
                                                <td> <?php echo $status; ?></td> 
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!--end row-->
                        <div class="col-md-offset-3 col-md-6">
                            <a class="btn blue btn-block classDetailsFont" href="javascript:history.back()">
                                <i class="fa fa-mail-reply-all"></i> Go Back </a>
                        </div>
            </div>
        </div>
        <!-- END PAGE CONTENT-->
    </div>
</div>
<!-- END CONTENT -->
 