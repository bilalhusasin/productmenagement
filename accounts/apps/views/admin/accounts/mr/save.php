<section class="content-header">
    <h1><a href="accounts"> Accounts</a></h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="accounts"> Accounts</a></li>
        <li class="active"> <?php if (count($mr) > 0) : ?>Edit<?php else : ?>Add New<?php endif; ?> Money Receipt</li>
    </ol>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?php if (count($mr) > 0) : ?>Edit<?php else : ?>Add New<?php endif; ?> Money Receipt</h3>

            <div class="box-tools">
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- /.box-header -->

        <form id="frmMRSave" action="accounts/mr-save" method="post">
            <div class="box-body">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Money Receipt No</label>
                        <input type="text" name="mr_no" id="mr_no" class="form-control" value="<?php if (count($mr) > 0) : echo $mr['mr_no']; else : echo $mr_no; endif; ?>">
                    </div>
                    <div class="form-group">
                        <label>Money Receipt Date</label>
                        <input type="text" name="mr_date" id="mr_date" class="form-control datepicker" value="<?php if (count($mr) > 0) : echo $mr['mr_date']; else : echo date('d/m/Y'); endif; ?>">
                    </div>
                    <div class="form-group">
                        <label>Select Customer</label>
                        <select name="customer_id" id="customer_id" class="form-control select2">
                            <?php foreach ($customers as $customer): ?>
                                <option value="<?php echo $customer['id']; ?>" <?php if (count($mr) > 0) : if ($mr['customer_id'] == $customer['id']) : echo 'selected'; endif; endif; ?>> <?php echo $customer['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Ref. Employee</label>
                        <select name="emp_id" id="emp_id" class="form-control select2">
                            <?php foreach ($emps as $emp) : ?>
                                <option value="<?php echo $emp['id']; ?>" <?php if( count($mr) > 0 ): if ($mr['emp_id'] == $emp['id']) : echo 'selected'; endif; endif; ?>><?php echo $emp['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Amount</label>
                        <input type="text" name="amount" id="amount" class="form-control" placeholder="00.00" value="<?php if (count($mr) > 0) : echo $mr['amount']; endif; ?>">
                    </div>
                    <div class="form-group">
                        <label>Payment Type</label>
                        <select name="payment_type" id="payment_type" class="form-control select2">
                            <option value="cash" <?php if (count($mr) > 0) : if ($mr['payment_type'] == 'cash') : echo 'selected'; endif; endif; ?>>Cash</option>
                            <option value="cheque" <?php if (count($mr) > 0) : if ($mr['payment_type'] == 'cheque') : echo 'selected'; endif; endif; ?>>Cheque
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Memo</label>
                        <textarea name="memo" id="memo" class="form-control" placeholder="Memo"><?php if (count($mr) > 0) : echo $mr['memo']; endif; ?></textarea>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->

            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <?php if (count($mr) > 0) : ?>
                <input type="hidden" name="id" value="<?php echo $mr['id']; ?>">
            <?php endif; ?>
            <div class="box-footer">
                <input type="reset" class="btn btn-danger" value="Cancel">
                <input type="submit" class="btn btn-primary pull-right" value="Save Changes">
            </div>
        </form>
    </div>
</section>