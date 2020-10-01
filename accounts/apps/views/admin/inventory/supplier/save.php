<section class="content-header">
    <h1><a href="inventory"> Inventory</a></h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="inventory"> Inventory</a></li>
        <li class="active"> <?php if (count($supplier) > 0) : ?>Edit<?php  else : ?>Add New<?php endif; ?> Supplier
        </li>
    </ol>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?php if (count($supplier) > 0) : ?>Edit<?php  else : ?>Add New<?php endif; ?> Supplier</h3>

            <div class="box-tools">
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- /.box-header -->

        <form id="frmSupplier" action="inventory/supplier-save" method="post">
            <div class="box-body">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="code">Supplier Code</label>
                        <input type="text" name="code" id="code" class="form-control" placeholder="Supplier Code" value="<?php if (count($supplier) > 0) : echo $supplier['code']; else : echo $code; endif; ?>"> Digit Only
                    </div>
                    <div class="form-group">
                        <label for="name">Supplier Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Supplier Name" value="<?php if (count($supplier) > 0) : echo $supplier['name']; endif; ?>">
                    </div>
                    <div class="form-group">
                        <label for="phone_no">Phone No</label>
                        <input type="text" name="phone_no" id="phone_no" class="form-control" placeholder="Phone No" value="<?php if (count($supplier) > 0) : echo $supplier['phone_no']; endif; ?>">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea type="text" name="address" id="address" class="form-control" placeholder="Supplier Address"><?php if (count($supplier) > 0) : echo $supplier['address']; endif; ?></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="contact_person">Contact Person</label>
                        <input type="text" name="contact_person" id="contact_person" class="form-control" placeholder="Contact Person" value="<?php if (count($supplier) > 0) : echo $supplier['contact_person']; endif; ?>">
                    </div>
                    <div class="form-group">
                        <label for="notes">Notes</label>
                        <textarea type="text" name="notes" id="notes" class="form-control" placeholder="Supplier Notes"><?php if (count($supplier) > 0) : echo $supplier['notes']; endif; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="status">Select Status</label>
                        <select name="status" id="status" data-placeholder="Select Status" class="form-control select2">
                            <option value="Active" <?php if (count($supplier) > 0 && $supplier['status'] == 'Active') : echo 'selected'; endif; ?>>Active</option>
                            <option value="Inactive" <?php if (count($supplier) > 0 && $supplier['status'] == 'Inactive') : echo 'selected'; endif;?>>Inactive</option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->

            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <?php if (count($supplier) > 0) : ?>
                <input type="hidden" name="id" value="<?php echo $supplier['id']; ?>">
            <?php endif; ?>
            <div class="box-footer">
                <input type="reset" class="btn btn-danger" value="Cancel">
                <input type="submit" class="btn btn-primary pull-right" value="Save Changes">
            </div>
        </form>
    </div>
</section>
