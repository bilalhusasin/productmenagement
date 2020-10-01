<section class="content-header">
    <h1>User</h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="user"> User</a></li>
        <li class="active"> <?php if (count($user) > 0) : ?>Edit<?php else : ?>Add New<?php endif; ?> User</li>
    </ol>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?php if (count($user) > 0) : ?>Edit<?php else : ?>Add New<?php endif; ?> User</h3>

            <div class="box-tools">
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- /.box-header -->

        <form id="frmUser" action="user/save" method="post">
            <div class="box-body">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Full Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Full name" value="<?php if (count($user) > 0) : echo $user['name']; endif; ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control" value="<?php
                        if (count($user) > 0) : echo $user['email']; endif; ?>" autocomplete=off placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password"> <?php if (count($user) > 0) : echo 'Keep blank for unchange.'; endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password"> <?php if (count($user) > 0) : echo 'Keep blank for unchange.'; endif; ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <?php if ($this->session->user_type == 'Admin') : ?>
                        <div class="form-group">
                            <label for="company_id">Company</label>
                            <select name="company_id" id="company_id" data-placeholder="Select Company" class="form-control select2">
                                <option value=""></option>
                                <?php foreach ($companies as $company) : ?>
                                    <option value="<?php echo $company['id']; ?>" <?php if (count($user) > 0 && $company['id'] == $user['company_id']) { echo 'selected'; } ?>><?php echo $company['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    <?php endif; ?>
                    <?php if ($this->session->user_type != 'User') : ?>
                        <div class="form-group">
                            <label for="status">User Type</label>
                            <select name="type" id="status" class="form-control select2" data-placeholder="Select User Type">
                                <option value=""></option>
                                <?php if ($this->session->user_type == 'Admin'): ?>
                                    <option value="Admin" <?php if (count($user) > 0 && $user['type'] == 'Admin') : echo 'selected'; endif; ?>>Admin User</option>
                                <?php endif; ?>
                                <option value="Power User" <?php if (count($user) > 0 && $user['type'] == 'Power User') : echo 'selected'; endif; ?>>Power User</option>
                                <option value="User" <?php if (count($user) > 0 && $user['type'] == 'User') : echo 'selected'; endif; ?>>User</option>
                            </select>
                        </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control select2" data-placeholder="Select Status">
                            <option value=""></option>
                            <option value="Active" <?php if (count($user) > 0 && $user['status'] == 'Active') : echo 'selected'; endif; ?>>Active</option>
                            <option value="Inactive" <?php if (count($user) > 0 && $user['status'] == 'Inactive') : echo 'selected'; endif; ?>>Inactive</option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->

            <input type="hidden" class="form-control" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <?php if (count($user) > 0) : ?>
                <input type="hidden" name="id"  value="<?php echo $user['id']; ?>">
            <?php endif; ?>
            <div class="box-footer">
                <input type="reset" class="btn btn-danger" value="Cancel">
                <input type="submit" class="btn btn-primary pull-right" value="Save Changes">
            </div>
        </form>
    </div>
</section>
