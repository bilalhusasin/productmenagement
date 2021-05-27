 

<?php
// this query is get currently login user id
 $user = $this->ion_auth->user()->row(); $userId = $user->id;?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
         
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
            <?php
                // this check is display success message alert
                if (!empty($success)) {
                    echo $success;
                }
            ?>
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            All Category
                        </div>
                    </div>

                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                                <tr>
                                    <th> Sr# </th>
                                    <th> Categroy Name </th>
                                    <th> Company Name </th>
                                    <th> Company Discription </th>
                                    <th> Categroy Status </th> 
                                    <th> &nbsp; </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count=1; foreach ($cateInfo as $row) { ?>
                                <tr>
                                    <td> <?php echo $count++; ?> </td>
                                    <td> <?php echo $row['category_name']; ?> </td>
                                    <td> <?php echo $row['company_name']; ?> </td>
                                    <td> <?php echo $row['company_discription']; ?> </td>
                                    <td> <?php echo $row['status']; ?> </td> 
                                    <td>
                                        <a class="btn btn-xs green" href="index.php/products/categoryDetails?c_id=<?php echo $row['id']; ?>" title="Category Detail"> <i class="fa fa-send-o"></i>   </a>
                                         
                                        <a class="btn btn-xs blue" href="index.php/products/editCategory?c_id=<?php echo $row['id']; ?>" title="Edit Category Info"> <i class="fa fa-pencil"></i> </a>
                                         
                                        <a class="btn btn-xs red" href="index.php/products/delproduct?id=<?php echo $row['id']; ?>" onClick="javascript:return confirm('Are you sure you want to delete this Category?')" title="Delete Category Detail"> <i class="fa fa-trash-o"></i>  </a>
                                         
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
<!-- END PAGE LEVEL PLUGINS --> 
 