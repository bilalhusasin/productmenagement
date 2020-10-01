<section class="content-header">
    <h1>Privilege</h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="user"> User</a></li>
        <li class="active"> Privilege</li>
    </ol>
</section>

<section class="content">
    <?php $this->load->view('flash_message'); ?>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">User Privilege of <?php echo $ref_user['name']; ?></h3>
        </div>
        <!-- /.box-header -->

        <form id="frmPrivileges" action="user/privileges" method="post">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="inventory_menu">Inventory Menu</label>
                            <select name="inventory_menu" id="inventory_menu" class="form-control select2" data-placeholder="Select User Type">
                                <option value="0" <?php if ($privilege){ if ($privilege['inventory_menu'] == 0){ echo 'selected'; } } ?>>No</option>
                                <option value="1" <?php if ($privilege){ if ($privilege['inventory_menu'] == 1 ){ echo 'selected'; } }?>>Yes</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sales">Sales Section</label>
                            <select name="sales" id="sales" class="form-control select2" data-placeholder="Select User Type">
                                <option value="0" <?php if ($privilege){ if ($privilege['sales'] == 0){ echo 'selected'; } } ?>>No</option>
                                <option value="1" <?php if ($privilege){ if ($privilege['sales'] == 1 ){ echo 'selected'; } }?>>Yes</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sales_return">Sales Return Section</label>
                            <select name="sales_return" id="sales_return" class="form-control select2" data-placeholder="Select User Type">
                                <option value="0" <?php if ($privilege){ if ($privilege['sales_return'] == 0){ echo 'selected'; } } ?>>No</option>
                                <option value="1" <?php if ($privilege){ if ($privilege['sales_return'] == 1 ){ echo 'selected'; } }?>>Yes</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="purchase">Purchase Section</label>
                            <select name="purchase" id="purchase" class="form-control select2" data-placeholder="Select User Type">
                                <option value="0" <?php if ($privilege){ if ($privilege['purchase'] == 0){ echo 'selected'; } } ?>>No</option>
                                <option value="1" <?php if ($privilege){ if ($privilege['purchase'] == 1 ){ echo 'selected'; } }?>>Yes</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="purchase_return">Purchase Return Section</label>
                            <select name="purchase_return" id="purchase_return" class="form-control select2" data-placeholder="Select User Type">
                                <option value="0" <?php if ($privilege){ if ($privilege['purchase_return'] == 0){ echo 'selected'; } } ?>>No</option>
                                <option value="1" <?php if ($privilege){ if ($privilege['purchase_return'] == 1 ){ echo 'selected'; } }?>>Yes</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="customer">Customer Section</label>
                            <select name="customer" id="customer" class="form-control select2" data-placeholder="Select User Type">
                                <option value="0" <?php if ($privilege){ if ($privilege['customer'] == 0){ echo 'selected'; } } ?>>No</option>
                                <option value="1" <?php if ($privilege){ if ($privilege['customer'] == 1 ){ echo 'selected'; } }?>>Yes</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="supplier">Supplier Section</label>
                            <select name="supplier" id="supplier" class="form-control select2" data-placeholder="Select User Type">
                                <option value="0" <?php if ($privilege){ if ($privilege['supplier'] == 0){ echo 'selected'; } } ?>>No</option>
                                <option value="1" <?php if ($privilege){ if ($privilege['supplier'] == 1 ){ echo 'selected'; } }?>>Yes</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="item">Item Section</label>
                            <select name="item" id="item" class="form-control select2" data-placeholder="Select User Type">
                                <option value="0" <?php if ($privilege){ if ($privilege['item'] == 0){ echo 'selected'; } } ?>>No</option>
                                <option value="1" <?php if ($privilege){ if ($privilege['item'] == 1 ){ echo 'selected'; } }?>>Yes</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="accounts_menu">Accounts Menu</label>
                            <select name="accounts_menu" id="accounts_menu" class="form-control select2" data-placeholder="Select User Type">
                                <option value="0" <?php if ($privilege){ if ($privilege['accounts_menu'] == 0){ echo 'selected'; } } ?>>No</option>
                                <option value="1" <?php if ($privilege){ if ($privilege['accounts_menu'] == 1 ){ echo 'selected'; } }?>>Yes</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="journal">Journal Section</label>
                            <select name="journal" id="journal" class="form-control select2" data-placeholder="Select User Type">
                                <option value="0" <?php if ($privilege){ if ($privilege['journal'] == 0){ echo 'selected'; } } ?>>No</option>
                                <option value="1" <?php if ($privilege){ if ($privilege['journal'] == 1 ){ echo 'selected'; } }?>>Yes</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="money_receipt">Money Receipt Section</label>
                            <select name="money_receipt" id="money_receipt" class="form-control select2" data-placeholder="Select User Type">
                                <option value="0" <?php if ($privilege){ if ($privilege['money_receipt'] == 0){ echo 'selected'; } } ?>>No</option>
                                <option value="1" <?php if ($privilege){ if ($privilege['money_receipt'] == 1 ){ echo 'selected'; } }?>>Yes</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="ac_head">A/C Head Section</label>
                            <select name="ac_head" id="ac_head" class="form-control select2" data-placeholder="Select User Type">
                                <option value="0" <?php if ($privilege){ if ($privilege['ac_head'] == 0){ echo 'selected'; } } ?>>No</option>
                                <option value="1" <?php if ($privilege){ if ($privilege['ac_head'] == 1 ){ echo 'selected'; } }?>>Yes</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="payment_receipt">Payment Receipt Section</label>
                            <select name="payment_receipt" id="payment_receipt" class="form-control select2" data-placeholder="Select User Type">
                                <option value="0" <?php if ($privilege){ if ($privilege['payment_receipt'] == 0){ echo 'selected'; } } ?>>No</option>
                                <option value="1" <?php if ($privilege){ if ($privilege['payment_receipt'] == 1 ){ echo 'selected'; } }?>>Yes</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="hr_menu">HR Menu</label>
                            <select name="hr_menu" id="hr_menu" class="form-control select2" data-placeholder="Select User Type">
                                <option value="0" <?php if ($privilege){ if ($privilege['hr_menu'] == 0){ echo 'selected'; } } ?>>No</option>
                                <option value="1" <?php if ($privilege){ if ($privilege['hr_menu'] == 1 ){ echo 'selected'; } }?>>Yes</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="employee">Employee Section</label>
                            <select name="employee" id="employee" class="form-control select2" data-placeholder="Select User Type">
                                <option value="0" <?php if ($privilege){ if ($privilege['employee'] == 0){ echo 'selected'; } } ?>>No</option>
                                <option value="1" <?php if ($privilege){ if ($privilege['employee'] == 1 ){ echo 'selected'; } }?>>Yes</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="report_menu">Report Menu</label>
                            <select name="report_menu" id="report_menu" class="form-control select2" data-placeholder="Select User Type">
                                <option value="0" <?php if ($privilege){ if ($privilege['report_menu'] == 0){ echo 'selected'; } } ?>>No</option>
                                <option value="1" <?php if ($privilege){ if ($privilege['report_menu'] == 1 ){ echo 'selected'; } }?>>Yes</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sales_report">Sales Report</label>
                            <select name="sales_report" id="sales_report" class="form-control select2" data-placeholder="Select User Type">
                                <option value="0" <?php if ($privilege){ if ($privilege['sales_report'] == 0){ echo 'selected'; } } ?>>No</option>
                                <option value="1" <?php if ($privilege){ if ($privilege['sales_report'] == 1 ){ echo 'selected'; } }?>>Yes</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sales_return_report">Sales Return Report</label>
                            <select name="sales_return_report" id="sales_return_report" class="form-control select2" data-placeholder="Select User Type">
                                <option value="0" <?php if ($privilege){ if ($privilege['sales_return_report'] == 0){ echo 'selected'; } } ?>>No</option>
                                <option value="1" <?php if ($privilege){ if ($privilege['sales_return_report'] == 1 ){ echo 'selected'; } }?>>Yes</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="purchase_report">Purchase Report</label>
                            <select name="purchase_report" id="purchase_report" class="form-control select2" data-placeholder="Select User Type">
                                <option value="0" <?php if ($privilege){ if ($privilege['purchase_report'] == 0){ echo 'selected'; } } ?>>No</option>
                                <option value="1" <?php if ($privilege){ if ($privilege['purchase_report'] == 1 ){ echo 'selected'; } }?>>Yes</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="purchase_return_report">Purchase Return Report</label>
                            <select name="purchase_return_report" id="purchase_return_report" class="form-control select2" data-placeholder="Select User Type">
                                <option value="0" <?php if ($privilege){ if ($privilege['purchase_return_report'] == 0){ echo 'selected'; } } ?>>No</option>
                                <option value="1" <?php if ($privilege){ if ($privilege['purchase_return_report'] == 1 ){ echo 'selected'; } }?>>Yes</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="inventory_report">Inventory Report</label>
                            <select name="inventory_report" id="inventory_report" class="form-control select2" data-placeholder="Select User Type">
                                <option value="0" <?php if ($privilege){ if ($privilege['inventory_report'] == 0){ echo 'selected'; } } ?>>No</option>
                                <option value="1" <?php if ($privilege){ if ($privilege['inventory_report'] == 1 ){ echo 'selected'; } }?>>Yes</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="ledger_report">Ledger Report</label>
                            <select name="ledger_report" id="ledger_report" class="form-control select2" data-placeholder="Select User Type">
                                <option value="0" <?php if ($privilege){ if ($privilege['ledger_report'] == 0){ echo 'selected'; } } ?>>No</option>
                                <option value="1" <?php if ($privilege){ if ($privilege['ledger_report'] == 1 ){ echo 'selected'; } }?>>Yes</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="trial_balance_report">Trial Balance Report</label>
                            <select name="trial_balance_report" id="trial_balance_report" class="form-control select2" data-placeholder="Select User Type">
                                <option value="0" <?php if ($privilege){ if ($privilege['trial_balance_report'] == 0){ echo 'selected'; } } ?>>No</option>
                                <option value="1" <?php if ($privilege){ if ($privilege['trial_balance_report'] == 1 ){ echo 'selected'; } }?>>Yes</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="balance_sheet_report">Balance Sheet Report</label>
                            <select name="balance_sheet_report" id="balance_sheet_report" class="form-control select2" data-placeholder="Select User Type">
                                <option value="0" <?php if ($privilege){ if ($privilege['balance_sheet_report'] == 0){ echo 'selected'; } } ?>>No</option>
                                <option value="1" <?php if ($privilege){ if ($privilege['balance_sheet_report'] == 1 ){ echo 'selected'; } }?>>Yes</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="income_statement_report">Income Statement Report</label>
                            <select name="income_statement_report" id="income_statement_report" class="form-control select2" data-placeholder="Select User Type">
                                <option value="0" <?php if ($privilege){ if ($privilege['income_statement_report'] == 0){ echo 'selected'; } } ?>>No</option>
                                <option value="1" <?php if ($privilege){ if ($privilege['income_statement_report'] == 1 ){ echo 'selected'; } }?>>Yes</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="bills_receivable_report">Bills Receivable Report</label>
                            <select name="bills_receivable_report" id="bills_receivable_report" class="form-control select2" data-placeholder="Select User Type">
                                <option value="0" <?php if ($privilege){ if ($privilege['bills_receivable_report'] == 0){ echo 'selected'; } } ?>>No</option>
                                <option value="1" <?php if ($privilege){ if ($privilege['bills_receivable_report'] == 1 ){ echo 'selected'; } }?>>Yes</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="bills_payable_report">Bills Payable Report</label>
                            <select name="bills_payable_report" id="bills_payable_report" class="form-control select2" data-placeholder="Select User Type">
                                <option value="0" <?php if ($privilege){ if ($privilege['bills_payable_report'] == 0){ echo 'selected'; } } ?>>No</option>
                                <option value="1" <?php if ($privilege){ if ($privilege['bills_payable_report'] == 1 ){ echo 'selected'; } }?>>Yes</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cash_book_report">Cash Book Report</label>
                            <select name="cash_book_report" id="cash_book_report" class="form-control select2" data-placeholder="Select User Type">
                                <option value="0" <?php if ($privilege){ if ($privilege['cash_book_report'] == 0){ echo 'selected'; } } ?>>No</option>
                                <option value="1" <?php if ($privilege){ if ($privilege['cash_book_report'] == 1 ){ echo 'selected'; } }?>>Yes</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="bank_book_report">Bank Book Report</label>
                            <select name="bank_book_report" id="bank_book_report" class="form-control select2" data-placeholder="Select User Type">
                                <option value="0" <?php if ($privilege){ if ($privilege['bank_book_report'] == 0){ echo 'selected'; } } ?>>No</option>
                                <option value="1" <?php if ($privilege){ if ($privilege['bank_book_report'] == 1 ){ echo 'selected'; } }?>>Yes</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="settings_menu">Settings Menu</label>
                            <select name="settings_menu" id="settings_menu" class="form-control select2" data-placeholder="Select User Type">
                                <option value="0" <?php if ($privilege){ if ($privilege['settings_menu'] == 0){ echo 'selected'; } } ?>>No</option>
                                <option value="1" <?php if ($privilege){ if ($privilege['settings_menu'] == 1 ){ echo 'selected'; } }?>>Yes</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="currency_settings">Currency Section</label>
                            <select name="currency_settings" id="currency_settings" class="form-control select2" data-placeholder="Select User Type">
                                <option value="0" <?php if ($privilege){ if ($privilege['currency_settings'] == 0){ echo 'selected'; } } ?>>No</option>
                                <option value="1" <?php if ($privilege){ if ($privilege['currency_settings'] == 1 ){ echo 'selected'; } }?>>Yes</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="company_settings">Company Section</label>
                            <select name="company_settings" id="company_settings" class="form-control select2" data-placeholder="Select User Type">
                                <option value="0" <?php if ($privilege){ if ($privilege['company_settings'] == 0){ echo 'selected'; } } ?>>No</option>
                                <option value="1" <?php if ($privilege){ if ($privilege['company_settings'] == 1 ){ echo 'selected'; } }?>>Yes</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="basic_settings">Basic Section</label>
                            <select name="basic_settings" id="basic_settings" class="form-control select2" data-placeholder="Select User Type">
                                <option value="0" <?php if ($privilege){ if ($privilege['basic_settings'] == 0){ echo 'selected'; } } ?>>No</option>
                                <option value="1" <?php if ($privilege){ if ($privilege['basic_settings'] == 1 ){ echo 'selected'; } }?>>Yes</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="default_ac_head_settings">Default A/C Head Section</label>
                            <select name="default_ac_head_settings" id="default_ac_head_settings" class="form-control select2" data-placeholder="Select User Type">
                                <option value="0" <?php if ($privilege){ if ($privilege['default_ac_head_settings'] == 0){ echo 'selected'; } } ?>>No</option>
                                <option value="1" <?php if ($privilege){ if ($privilege['default_ac_head_settings'] == 1 ){ echo 'selected'; } }?>>Yes</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user_menu">User Menu</label>
                            <select name="user_menu" id="user_menu" class="form-control select2" data-placeholder="Select User Type">
                                <option value="0" <?php if ($privilege){ if ($privilege['user_menu'] == 0){ echo 'selected'; } } ?>>No</option>
                                <option value="1" <?php if ($privilege){ if ($privilege['user_menu'] == 1 ){ echo 'selected'; } }?>>Yes</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user_section">User Section</label>
                            <select name="user_section" id="user_section" class="form-control select2" data-placeholder="Select User Type">
                                <option value="0" <?php if ($privilege){ if ($privilege['user_section'] == 0){ echo 'selected'; } } ?>>No</option>
                                <option value="1" <?php if ($privilege){ if ($privilege['user_section'] == 1 ){ echo 'selected'; } }?>>Yes</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->

            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <?php if (count($privilege) > 0) : ?>
                <input type="hidden" name="id" value="<?php echo $privilege['id']; ?>">
            <?php endif; ?>
            <input type="hidden" name="ref_user" value="<?php echo $ref_user['id']; ?>">
            <div class="box-footer">
                <input type="reset" class="btn btn-danger" value="Cancel">
                <input type="submit" class="btn btn-primary pull-right" value="Save Changes">
            </div>
        </form>
    </div>
    <!-- /.box -->
</section>
