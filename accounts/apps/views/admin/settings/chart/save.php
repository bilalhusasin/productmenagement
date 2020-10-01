<section class="content-header">
    <h1>Settings</h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="settings"> Settings</a></li>
        <li class="active"> <?php if (count($chart) > 0) : ?>Edit<?php  else : ?>Add New<?php endif; ?> Default A/C Head</li>
    </ol>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?php if (count($chart) > 0) : ?>Edit<?php  else : ?>Add New<?php endif; ?> Default A/C Head</h3>

            <div class="box-tools">
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- /.box-header -->

        <form action="settings/chart-save" method="post">
            <div class="box-body">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="parent_id">Under A/C of</label>
                        <select name="parent_id" id="parent_id" class="form-control select2">
                            <option value="">Root</option>
                            <?php echo $ac_chart_tree; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="type">Account Class</label>
                        <select name="type" id="type" class="form-control select2">
                            <option value="">Default</option>
                            <option value="Receivable" <?php if (count($chart) > 0 && $chart['type'] == 'Receivable') : echo 'selected'; endif; ?>>Receivable</option>
                            <option value="Payable" <?php if (count($chart) > 0 && $chart['type'] == 'Payable') : echo 'selected'; endif; ?>>Payable</option>
                            <option value="Cash" <?php if (count($chart) > 0 && $chart['type'] == 'Cash') : echo 'selected'; endif; ?>>Cash</option>
                            <option value="Bank" <?php if (count($chart) > 0 && $chart['type'] == 'Bank') : echo 'selected'; endif; ?>>Bank</option>
                            <option value="Sales" <?php if (count($chart) > 0 && $chart['type'] == 'Sales') : echo 'selected'; endif; ?>>Sales</option>
                            <option value="Purchase" <?php if (count($chart) > 0 && $chart['type'] == 'Purchase') : echo 'selected'; endif; ?>>Purchase</option>
                            <option value="Inventory" <?php if (count($chart) > 0 && $chart['type'] == 'Inventory') : echo 'selected'; endif; ?>>Inventory</option>
                            <option value="COGS" <?php if (count($chart) > 0 && $chart['type'] == 'COGS') : echo 'selected'; endif; ?>>Cost of Goods Sold</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="code">A/C Code</label>
                        <input type="text" name="code" id="code" class="form-control" placeholder="Enter A/C Code ..." value="<?php if (count($chart) > 0) : echo $chart['code']; endif; ?>">
                    </div>
                    <div class="form-group">
                        <label for="name">A/C Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter A/C Name ..." value="<?php if (count($chart) > 0) : echo $chart['name']; endif; ?>">
                    </div>
                    <div class="form-group">
                        <label for="memo">Memo</label>
                        <textarea name="memo" id="notes" class="form-control" placeholder="Enter Memo..."><?php if (count($chart) > 0) : echo $chart['memo']; endif;?></textarea>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->

            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <?php if (count($chart) > 0) : ?>
                <input type="hidden" name="id" value="<?php echo $chart['id']; ?>">
            <?php endif; ?>
            <div class="box-footer">
                <input type="reset" class="btn btn-danger" value="Cancel">
                <input type="submit" class="btn btn-primary pull-right" value="Save Changes">
            </div>
        </form>
    </div>
</section>
