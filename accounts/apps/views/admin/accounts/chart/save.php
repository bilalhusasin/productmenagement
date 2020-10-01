<section class="content-header">
    <h1>Accounts</h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="accounts"> Accounts</a></li>
        <li class="active"> <?php if (count($chart) > 0) : ?>Edit<?php else : ?>Add New<?php endif; ?> A/C Head</li>
    </ol>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?php if (count($chart) > 0) : ?>Edit<?php else : ?>Add New<?php endif; ?> A/C Head</h3>

            <div class="box-tools">
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- /.box-header -->

        <form id="frmChartSave" action="accounts/chart-save" method="post">
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
                        <label for="code">A/C Code</label>
                        <input type="text" name="code" id="code" class="form-control" placeholder="Enter A/C Code ..." value="<?php if (count($chart) > 0) : echo $chart['code']; endif; ?>">
                    </div>
                    <div class="form-group">
                        <label for="name">A/C Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter A/C Name ..."  value="<?php if (count($chart) > 0) : echo $chart['name']; endif; ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="opening">Opening Balance</label>
                        <input type="text" name="opening" id="opening" class="form-control" placeholder="Enter Opening Balance ..." value="<?php if (count($chart) > 0) : echo $chart['opening']; endif; ?>">
                    </div>
                    <div class="form-group">
                        <label for="memo">Memo</label>
                        <textarea name="memo" id="memo" class="form-control" placeholder="Enter Memo..." ><?php if (count($chart) > 0) : echo $chart['memo']; endif; ?></textarea>
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
