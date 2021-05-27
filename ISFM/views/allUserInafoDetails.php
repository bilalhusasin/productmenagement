<link href="assets/admin/pages/css/profile.css" rel="stylesheet" type="text/css"/>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content"> 
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-3">
                <?php 
                $teacherID = $this->input->get('id');
                $userId = $this->input->get('uid');
                $groupId = $this->input->get('gid');
                ?>
                <ul class="ver-inline-menu tabbable margin-bottom-10">
                    <li class="detailsPicture">
                        <img alt="" class="img-responsive" src="assets/uploads/<?php echo $photo; ?>">
                    </li>
                    <?php if ($this->ion_auth->is_admin()) { ?>
                    <li>
                        <a href="index.php/users/edit_user?id=<?php echo $teacherID; ?>&uid=<?php echo $userId;?>&gid=<?php echo $groupId;?>">
                        <i class="fa fa-cog"></i> <?php echo lang('hrm_edit_info'); ?> </a>
                        <span class="after">
                        </span>
                    </li>
                    <?php } ?>
                    <li>
                        <a href="javascript:history.back()">
                        <i class="fa fa-mail-reply-all"></i><?php echo lang('back'); ?> </a>
                    </li>
                </ul>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-8 profile-info datilsBodyMB">
                        <?php
                        foreach ($userinfo as $row) {
                        foreach ($user as $row1) {
                        $userName = $row1['username'];
                        $email = $row1['email']; 
                        }
                        ?>
                        <h1 class="teacherTitleFont"><?php echo $userName; ?></h1>
                         
                        <div class="row">
                            <div class="col-sm-4 col-xs-6 detailsEvent">
                                <?php echo lang('hrm_email'); ?>
                                <span>: </span>
                            </div>
                            <div class="col-sm-6 col-xs-6 detailsEvent">
                                <?php echo $email; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-xs-6 detailsEvent">
                                Password
                                <span>: </span>
                            </div>
                            <div class="col-sm-6 col-xs-6 detailsEvent">
                                <?php echo $row['dempass']; ?>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-sm-4 col-xs-6 detailsEvent">
                                User Status <span>: </span>
                            </div>
                            <div class="col-sm-6 col-xs-6 detailsEvent">
                                <?php echo $row['status']; ?>
                            </div>
                        </div> 
                        <?php } ?>
                    </div>
                    <!--end col-md-8-->
                    <div class="col-md-4">
                        <div class="portlet sale-summary">
                            <div class="portlet-title">
                                <div class="caption">
                                    <?php echo lang('hrm_empdes'); ?>
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="reload">
                                    </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <ul class="list-unstyled">
                                    <li>
                                        <div class="alert alert-success marginBottomNone">
                                            <strong><?php echo $this->common->group_name($row['group_id']); ?></strong>
                                        </div>
                                    </li> 
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--end col-md-4-->
                </div>
                <!--end row--> 
            </div>
        </div>
        <!-- END PAGE CONTENT-->
    </div>
</div>
<!-- END CONTENT -->