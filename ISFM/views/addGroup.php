<link rel="stylesheet" type="text/css" href="assets/global/plugins/select2/select2.css"/>

<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css"/>

<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<?php $user = $this->ion_auth->user()->row(); $userId = $user->id;?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                    Add Group Title <small></small>
                </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <?php echo lang('home'); ?>
                    </li>
                    <li>
                        <?php echo lang('header_account'); ?>
                    </li>
                    <li>
                         Add Group Title
                    </li>
                    <li id="result" class="pull-right topClock"></li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12 ">
                <?php
                if (!empty($message)) {
                    echo '<br>' . $message;
                }
                ?>
                <!-- BEGIN SAMPLE FORM PORTLET-->
                <div class="portlet box green ">
                    <div class="portlet-title">
                        <div class="caption">
                          Add New Group Title For HRM Section.
                        </div>
                        <div class="tools">
                            <a href="" class="collapse">
                            </a>
                            <a href="" class="reload">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <?php
                        $form_attributs = array('class' => 'form-horizontal', 'role' => 'form');
                        echo form_open('users/addGroup', $form_attributs);
                        ?>
                        <input type="hidden" name="created_by" value="<?php echo $userId; ?>" readonly>
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Group Title<span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <input class="form-control text-lowercase" type="text" placeholder="" name="groupTitle" required="required" onkeyup="this.value = this.value.toLowerCase();">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"> Three characters ID Sub Title <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                   <input class="form-control" type="text" placeholder="XYZ" name="idSubTitle" required="required" onkeyup="this.value = this.value.toUpperCase();" maxlength="3">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo lang('acc_descrip'); ?> <span class="requiredStar">  </span></label>
                                <div class="col-md-6">
                                    <textarea class="form-control" rows="3" name="description"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Status<span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <select  class="form-control" name="status" required="">
                                        <option value=""><?php echo lang('select'); ?></option>
                                        <option value="Active">Active</option>
                                        <option value="Deactive">Deactive</option>
                                    </select>
                                </div>
                            </div> 
                        </div>
                        <div class="form-actions fluid">
                            <div class="col-md-offset-3 col-md-6">
                                <button type="submit" class="btn green" name="submit" value="Submit">Add Group</button>
                                <button type="reset" class="btn default"><?php echo lang('refresh'); ?></button>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
                <!-- END SAMPLE FORM PORTLET-->
            </div>

            <div class="col-md-12">
                <!-- BEGIN All account list-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <?php echo lang('acc_loat'); ?> 
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
                                         Group Name 
                                    </th> 
                                    <th>
                                        ID Sub Title 
                                    </th>
                                    <th>
                                        <?php echo lang('acc_descrip'); ?>
                                    </th>
                                    <th>
                                         Status
                                    </th>
                                    <?php if($this->common->user_access('edit_dele_acco',$userId)){ ?>
                                        <th>

                                        </th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; foreach ($allgroups as $row) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $i; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['id_sub_title']; ?>
                                        </td> 
                                        <td>
                                            <?php echo $row['description']; ?>
                                        </td>
                                        <td>
                                            <?php
                                            if($row['status']=='Deactive'){
                                                echo '<span class="label label-sm label-danger">'. $row['status'] .'</span>';
                                            } else {
                                                echo '<span class="label label-sm label-success">'. $row['status'] .'</span>';
                                            }?> 
                                        </td>
                                        <?php if($this->common->user_access('edit_dele_acco',$userId)){ ?>
                                        <td>
                                            <a class="btn btn-xs default" href="index.php/users/editGroupInfo?id=<?php echo $row['id']; ?>"> <i class="fa fa-pencil-square-o"></i> <?php echo lang('edit'); ?> </a>
                                            <!-- <a class="btn btn-xs red" href="index.php/users/deleteGroup?id=<?php // echo $row['id']; ?>" onclick="javascript:return confirm('Are you sure you want to delete this Group and related information?')"> <i class="fa fa-trash-o"></i> <?php // echo lang('delete'); ?> </a> -->                                           
                                         </td>
                                            <?php } ?>
                                    </tr>
                                <?php $i++;} ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END All account list-->
            </div>
        </div>
        <!-- END PAGE CONTENT-->
    </div>
</div>
<!-- END CONTENT -->
<script type="text/javascript" src="assets/global/plugins/select2/select2.min.js"></script>

<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>

<script type="text/javascript" src="assets/global/plugins/datatables/extensions/Scroller/js/dataTables.scroller.min.js"></script>

<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>

<!-- END PAGE LEVEL PLUGINS -->

<script src="assets/admin/pages/scripts/table-advanced.js"></script>

<script>
    jQuery(document).ready(function () {
        //here is auto reload after 1 second for time and date in the top
        jQuery(setInterval(function () {
            jQuery("#result").load("index.php/home/iceTime");
        }, 1000));
    });
</script>

