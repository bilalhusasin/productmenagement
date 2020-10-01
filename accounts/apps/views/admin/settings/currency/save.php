<section class="content-header">
    <h1>Settings</h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="settings"> Settings</a></li>
        <li class="active"> <?php if (count($currency) > 0) : ?>Edit <?php else : ?>Add New<?php endif; ?> Currency</li>
    </ol>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?php if (count($currency) > 0) : ?>Edit <?php else : ?>Add New<?php endif; ?> Currency</h3>

            <div class="box-tools">
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- /.box-header -->

        <form id="frmCurrency" action="settings/currency-save" method="post">
            <div class="box-body">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="fullname">Country Name</label>
                        <input type="text" name="fullname" id="fullname" class="form-control" value="<?php if (count($currency) > 0): echo $currency['fullname']; endif; ?>">
                    </div>
                    <div class="form-group">
                        <label for="shortname">Short Form</label>
                        <input type="text" name="shortname" id="shortname" class="form-control" value="<?php if (count($currency) > 0) : echo $currency['shortname']; endif; ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="symbol">Symbol</label>
                        <input type="text" name="symbol" id="symbol" class="form-control" value="<?php if (count($currency) > 0) : echo $currency['symbol']; endif; ?>">
                    </div>
                    <div class="form-group">
                        <label for="status">Select Status</label>
                        <select name="status" id="status" class="form-control select2" data-placeholder="Select Status">
                            <option value=""></option>
                            <option value="active" <?php if (count($currency) > 0 && $currency['status'] == 'Active') : echo 'selected'; endif; ?>>Active</option>
                            <option value="inactive" <?php if (count($currency) > 0 && $currency['status'] == 'Inactive') : echo 'selected'; endif;?>>Inactive</option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->

            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <?php if (count($currency) > 0) : ?>
                <input type="hidden" name="id" value="<?php echo $currency['id']; ?>">
            <?php endif; ?>
            <div class="box-footer">
                <input type="reset" class="btn btn-danger" value="Cancel">
                <input type="submit" class="btn btn-primary pull-right" value="Save Changes">
            </div>
        </form>
    </div>
</section>
