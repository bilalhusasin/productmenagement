<section class="content-header">
    <h1><a href="accounts"> Accounts</a></h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="accounts"> Accounts</a></li>
        <li class="active"> <?php if (count($payment) > 0) : ?>Edit<?php else : ?>Add New<?php endif; ?> Payment Receipt</li>
    </ol>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?php if (count($payment) > 0) : ?>Edit<?php else : ?>Add New<?php endif; ?> Payment Receipt</h3>

            <div class="box-tools">
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- /.box-header -->

        <form id="salesPaymentSave" action="accounts/payment-save" method="post">
            <div class="box-body">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Payment Receipt No</label>
                        <input type="text" name="payment_no" id="payment_no" class="form-control" value="<?php if (count($payment) > 0) : echo $payment['payment_no']; else : echo $payment_no; endif; ?>">
                    </div>
                    <div class="form-group">
                        <label>Payment Receipt Date</label>
                        <input type="text" name="payment_date" id="payment_date" class="form-control datepicker" value="<?php if (count($payment) > 0) : $payment['payment_date']; else : echo date('d/m/Y'); endif; ?>">
                    </div>
                    <div class="form-group">
                        <label>Select Supplier</label>
                        <select name="supplier_id" id="supplier_id" class="form-control select2">
                            <?php foreach ($suppliers as $supplier) : ?>
                                <option value="<?php echo $supplier['id']; ?>" <?php if (count($payment) > 0) : if ($payment['supplier_id'] == $supplier['id']) : echo 'selected'; endif; endif; ?>><?php echo $supplier['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Ref. Employee</label>
                        <select name="emp_id" id="emp_id" class="form-control select2">
                            <?php foreach ($emps as $emp) : ?>
                                <option value="<?php echo $emp['id']; ?>" <?php if (count($payment) > 0 ) : if ($payment['emp_id'] == $emp['id']) : echo 'selected'; endif; endif; ?>><?php echo $emp['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Amount</label>
                        <input type="text" name="amount" id="amount" class="form-control" placeholder="00.00" value="<?php if (count($payment) > 0) : echo $payment['amount']; endif; ?>">
                    </div>
                    <div class="form-group">
                        <label>Payment Type</label>
                        <select name="payment_type" id="payment_type" class="form-control select2">
                            <option value="cash" <?php if (count($payment) > 0) : if ($payment['payment_type'] == 'cash') : echo 'selected'; endif; endif; ?>>Cash</option>
                            <option value="cheque" <?php if (count($payment) > 0) : if ($payment['payment_type'] == 'cheque') : echo 'selected'; endif; endif; ?>>Cheque</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Memo</label>
                        <textarea name="memo" id="memo" placeholder="Memo" class="form-control">
                            <?php if(count($payment) > 0): echo $payment['memo']; endif; ?>
                        </textarea>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->

            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <?php if(count($payment) > 0): ?>
                <input type="hidden" name="id" value="<?php echo $payment['id']; ?>">
            <?php endif; ?>
            <div class="box-footer">
                <input type="reset" class="btn btn-danger" value="Cancel">
                <input type="submit" class="btn btn-primary pull-right" value="Save Changes">
            </div>
        </form>
    </div>
</section>