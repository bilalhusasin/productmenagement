
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
                                    Category Detail
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse">
                                    </a>
                                    <a href="javascript:;" class="reload">
                                    </a>
                                </div>
                            </div>
                            <div class="portlet-body">

                                <?php foreach ($cateInfo as $row){
                                     
                                    $category_name = $row['category_name'];
                                    $company_name = $row['company_name']; 
                                    $company_discription = $row['company_discription'];
                                    $status = $row['status']; 
                                }?> 
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th colspan="2"> Category Detail </th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                            <tr>
                                                <td> Category Name</td>
                                                <td> <?php echo $category_name ?></td> 
                                            </tr>
                                            <tr>
                                                <td> Company Name</td>
                                                <td> <?php echo $company_name; ?> </td> 
                                            </tr>  
                                            <tr>
                                                <td> Company Discription</td>
                                                <td> <?php echo $company_discription; ?> </td> 
                                            </tr>
                                            <tr>
                                                <td> Category Status</td>
                                                <td> <?php echo $status; ?></td> 
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 profile-info datilsBodyMB">
                        <div class="portlet box green">
                            <div class="portlet-title">
                                <div class="caption">
                                    All product  
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse">
                                    </a>
                                    <a href="javascript:;" class="reload">
                                    </a>
                                </div>
                            </div>
                            <div class="portlet-body"> 
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th> Product Name </th>
                                                <th> Product size </th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(empty($proInfo)){ echo"
                                            <tr> 
                                                <td> no product Added</td> 
                                            </tr> ";
                                            } else{ foreach ($proInfo as $row){ ?>
                                      
                                            <tr> 
                                                <td> <?php echo $row['product_name']; ?></td> 
                                                <td> <?php echo $row['product_size']; ?></td> 
                                            </tr>
                                             
                                        <?php }} ?>
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
 