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
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                <?php echo lang('hrm_einfo'); ?> <small></small>
                </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <?php echo lang('home'); ?>
                    </li>
                    <li>
                        <?php echo lang('header_hrm'); ?>
                    </li>
                    <li>
                        <?php echo lang('header_employ_manage'); ?>
                    </li>
                    <li>
                        <?php echo lang('header_employ_list'); ?>
                    </li>
                    <li id="result" class="pull-right topClock"></li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->
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
                                        <?php echo lang('srno'); ?>
                                    </th>
                                    <th>
                                        <?php echo lang('hrm_photos'); ?>
                                    </th>
                                    <th>
                                        <?php echo lang('hrm_tn'); ?>
                                    </th>
                                    <th>
                                        <?php echo lang('hrm_ut'); ?>
                                    </th>
                                    <th>
                                        <?php echo lang('hrm_address'); ?>
                                    </th>
                                    <th>
                                        Working Hours
                                    </th>
                                    <th>
                                        <?php echo lang('hrm_stat'); ?>
                                    </th>
                                    <th>
                                        <?php echo lang('hrm_act'); ?>
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
                                        <div class="tableImage">
                                            <img src="assets/uploads/<?php echo $row['users_photo']; ?>" alt="">
                                        </div>
                                    </td>
                                    <td>
                                        <?php echo $row['full_name']; ?>
                                    </td>
                                    <td class="text-capitalize">
                                        <?php
                                        $grup_id = $row['group_id'];
                                        echo $this->common->group_title($grup_id);
                                        /*if ($grup_id == '1') {
                                        echo 'Admin';
                                        }elseif ($grup_id == '4') {
                                        echo 'Teacher';
                                        }elseif ($grup_id == '6') {
                                        echo 'Accountant';
                                        }elseif ($grup_id == '11') {
                                        echo 'Janitorial';
                                        }*/
                                        ?>
                                    </td>
                                    <td >
                                        <?php echo $row['present_address']; ?>
                                    </td>
                                    <td>
                                        <span class="label label-sm label-success"></span><?php echo $row['working_hour']; ?>
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
                                        <a class="btn btn-xs green" href="index.php/users/allUserInafoDetails?id=<?php echo $row['id']; ?>&uid=<?php echo $row['user_id']; ?>&gid=<?php echo $row['group_id'];?>&photo=<?php echo $row['users_photo']; ?>" title="User Details"> <i class="fa fa-file-text-o"></i></a>
                                        <?php // if ($this->ion_auth->is_admin()) { ?>
                                        <a class="btn btn-xs default" href="index.php/users/edit_user?id=<?php echo $row['id']; ?>&uid=<?php echo $row['user_id'];?>&gid=<?php echo $row['group_id'];?>" title="User Edit Details"> <i class="fa fa-pencil-square"></i>  </a>
                                        <a class="btn btn-xs red" href="index.php/users/teacherDelete?id=<?php echo $row['id']; ?>&uid=<?php echo $row['user_id']; ?>" onClick="javascript:return confirm('Are you sure you want to delete this teacher?')" title="User Delete Details"> <i class="fa fa-trash-o"></i> </a>
                                        <?php // } ?>
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