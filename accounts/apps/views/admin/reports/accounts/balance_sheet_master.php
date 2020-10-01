<section class="content-header">
    <h1><a href="report"> Reports</a></h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="report"> Reports</a></li>
        <li class="active"> Balance Sheet</li>
    </ol>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Balance Sheet</h3>
            <div class="box-tools">
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- /.box-header -->

        <form id="frmBalanceSheet" action="report/balance-sheet" method="post" target="_blank">
            <div class="box-body">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="closing_date">Closing Date</label>
                        <input type="text" name="closing_date" id="closing_date" class="form-control datepicker" value="<?php echo date('t/m/Y'); ?>">
                    </div>
                </div>
            </div>
            <!-- /.box-body -->

            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <div class="box-footer">
                <input type="reset" class="btn btn-danger" value="Cancel">
                <input type="submit" class="btn btn-primary pull-right" value="View Report">
            </div>
        </form>
    </div>
</section>