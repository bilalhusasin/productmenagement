<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<!-- END PAGE LEVEL STYLES -->
<?php $user = $this->ion_auth->user()->row();
$userId = $user->id; ?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content"> 
         
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <?php echo lang('hrm_elist'); ?>
                        </div>
                        <div class="tools">
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                                <tr>
                                    <th>
                                        SR#
                                    </th> 
                                    <th>
                                        Employee's Name
                                    </th>  
                                    <th>
                                       status
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($usersInfo as $row) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $i; ?>
                                    </td> 
                                    <td>
                                        <?php echo $row['full_name']; ?>
                                    </td>   
                                    <td>
                                        <?php
                                        if($row['status']=='Deactive'){
                                        echo '<span class="label label-sm label-danger">'. $row['status'] .'</span>';
                                        } else {
                                        echo '<span class="label label-sm label-success">'. $row['status'] .'</span>';
                                        }?>
                                    </td>
                                    <td>
                                        <a class="btn btn-xs green" href="index.php/users/allUserInafoDetails?id=<?php echo $row['id']; ?>&uid=<?php echo $row['user_id']; ?>&gid=<?php echo $row['group_id'];?>" title="User Details"> <i class="fa fa-file-text-o"></i></a>
                                        
                                    </td>
                                </tr>
                                <?php
                                $i++;
                                }
                                ?>
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
<!--Begin Page Level Script-->
<script type="text/javascript" src="assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<script src="assets/admin/pages/scripts/table-advanced.js"></script>
<!--End Page Level Script-->
<script>
    jQuery(document).ready(function() {
        //here is auto reload after 1 second for time and date in the top
        jQuery(setInterval(function() {
            jQuery("#result").load("index.php/home/iceTime");
        }, 1000));
    });
</script>
<!-- END PAGE LEVEL script -->