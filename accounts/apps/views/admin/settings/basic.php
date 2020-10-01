<section class="content-header">
    <h1><a href="settings"> Settings</a></h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="settings"> Settings</a></li>
        <li class="active"> Basic settings</li>
    </li>
</ol>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Basic Settings</h3>

            <div class="box-tools">
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- /.box-header -->

        <form id="frmBasic" action="settings/basic" method="post">
            <div class="box-body">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ac_payable">Supplier on A/C Head</label>
                        <select name="ac_payable" id="ac_payable" class="form-control select2">
                            <option value="">Root</option>
                            <?php echo $payable_tree; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ac_receivable">Customer on A/C Head</label>
                        <select name="ac_receivable" id="ac_receivable" class="form-control select2">
                            <option value="">Root</option>
                            <?php echo $receivable_tree; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ac_cash">Cash Book A/C Head</label>
                        <select name="ac_cash" id="ac_cash" class="form-control select2">
                            <option value="">Root</option>
                            <?php echo $cash_tree; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ac_bank">Bank Book A/C Head</label>
                        <select name="ac_bank" id="ac_bank" class="form-control select2">
                            <option value="">Root</option>
                            <?php echo $bank_tree; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ac_sales">Sales A/C Head</label>
                        <select name="ac_sales" id="ac_sales" class="form-control select2">
                            <option value="">Root</option>
                            <?php echo $sales_tree; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ac_purchase">Purchase A/C Head</label>
                        <select name="ac_purchase" id="ac_purchase" class="form-control select2">
                            <option value="">Root</option>
                            <?php echo $purchase_tree; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ac_inventory">Inventory A/C Head</label>
                        <select name="ac_inventory" id="ac_inventory" class="form-control select2">
                            <option value="">Root</option>
                            <?php echo $inventory_tree; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ac_cogs">Cost of Goods Sold A/C Head</label>
                        <select name="ac_cogs" id="ac_cogs" class="form-control select2">
                            <option value="">Root</option>
                            <?php echo $cogs_tree; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ac_tax">Sales TAX A/C Head</label>
                        <select name="ac_tax" id="ac_tax" class="form-control select2">
                            <option value="">Root</option>
                            <?php echo $tax_tree; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tax_rate">Default Sales TAX Rate (%)</label>
                        <input type="text" name="tax_rate" id="tax_rate" class="form-control" value="<?php echo $tax_rate; ?>">
                    </div>

                </div>
            </div>
            <!-- /.box-body -->

            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <?php if (count($settings) > 0) : ?>
                <input type="hidden" name="id" value="<?php echo $settings['id']; ?>">
            <?php endif; ?>
            <div class="box-footer">
                <input type="reset" class="btn btn-danger" value="Cancel">
                <input type="submit" class="btn btn-primary pull-right" value="Save Changes">
            </div>
        </form>
    </div>
</section>
