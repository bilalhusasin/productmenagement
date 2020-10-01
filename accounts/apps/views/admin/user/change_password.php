<section class="content-header">
    <h1>User</h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="user"> User</a></li>
        <li class="active"> Change password</li>
    </ol>
</section>

<section class="content">
    <?php $this->load->view('flash_message'); ?>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Change password</h3>
            <div class="box-tools">
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- /.box-header -->

        <form id="frmChangePassword" action="user/change-password" method="post">
            <div class="box-body">
                <div class="form-group">
                    <label for="current_password">Current Password</label>
                    <input type="password" name="current_password" id="current_password" class="form-control" placeholder="Current Password">
                </div>
                <div class="form-group">
                    <label for="new_password">New Password</label>
                    <input type="password" name="new_password" id="new_password" class="form-control" placeholder="New Password">
                </div>
                <div class="form-group">
                    <label for="confirm_new_password">Confirm New Password</label>
                    <input type="password" name="confirm_new_password" id="confirm_new_password" class="form-control" placeholder="Confirm New Password">
                </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <input type="reset" class="btn btn-danger" value="Cancel">
                <input type="submit" class="btn btn-primary pull-right" value="Save Changes">
            </div>
        </form>
    </div>
</section>
