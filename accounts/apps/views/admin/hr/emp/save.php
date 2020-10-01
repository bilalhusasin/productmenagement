<section class="content-header">
    <h1>H R</h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="hr"> H R</a></li>
        <li class="active"> <?php if (count($emp) > 0) : ?>Edit<?php else : ?>Add New<?php endif; ?> Employee</li>
    </ol>
</section>
<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?php if (count($emp) > 0) : ?>Edit<?php else : ?>Add New<?php endif; ?> Employee</h3>

            <div class="box-tools">
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- /.box-header -->

        <form id="frmEmp" action="hr/emp-save" method="post">
            <div class="box-body">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Employee Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Employee Name" value="<?php if (count($emp) > 0) : echo $emp['name']; endif; ?>">
                    </div>
                    <div class="form-group">
                        <label for="father_name">Father's Name</label>
                        <input type="text" name="father_name" id="father_name" class="form-control" placeholder="Father's Name" value="<?php if (count($emp) > 0) : echo $emp['father_name']; endif; ?>">
                    </div>
                    <div class="form-group">
                        <label for="mother_name">Mother's Name</label>
                        <input type="text" name="mother_name" id="mother_name" class="form-control" placeholder="Mother's Name" value="<?php if (count($emp) > 0) : echo $emp['mother_name']; endif; ?>">
                    </div>
                    <div class="form-group">
                        <label for="present_address">Present Address</label>
                        <textarea name="present_address" id="present_address" class="form-control" placeholder="Present Address"><?php if (count($emp) > 0) : echo $emp['present_address']; endif; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="permanent_address">Permanent Address</label>
                        <textarea name="permanent_address" id="permanent_address" class="form-control"  placeholder="Permanent Address"><?php if (count($emp) > 0) : echo $emp['permanent_address']; endif; ?></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="designation">Designation</label>
                        <input type="text" name="designation" id="designation" class="form-control" placeholder="Designation" value="<?php if (count($emp) > 0) : echo $emp['designation']; endif; ?>">
                    </div>
                    <div class="form-group">
                        <label for="department">Department</label>
                        <input type="text" name="department" id="department" class="form-control" placeholder="Department" value="<?php if (count($emp) > 0) : echo $emp['department']; endif; ?>">
                    </div>
                    <div class="form-group">
                        <label for="purchase_date">Date of Join</label>
                        <input type="text" name="purchase_date" id="purchase_date" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask value="<?php if (count($emp) > 0): echo $emp['joining'];  else : echo date('d/m/Y'); endif; ?>">
                    </div>
                    <div class="form-group">
                        <label for="mobile">Mobile</label>
                        <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Mobile Number" value="<?php if (count($emp) > 0) : echo $emp['mobile']; endif; ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control" placeholder="Email" value="<?php if (count($emp) > 0) : echo $emp['email']; endif; ?>">
                    </div>
                    <div class="form-group">
                        <label for="notes">Notes</label>
                        <textarea name="notes" id="notes" class="form-control" placeholder="Customer Notes"><?php if (count($emp) > 0) : echo $emp['notes']; endif; ?></textarea>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->

            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <?php if (count($emp) > 0) : ?>
                <input type="hidden" name="id" value="<?php echo $emp['id']; ?>">
            <?php endif; ?>
            <div class="box-footer">
                <input type="reset" class="btn btn-danger" value="Cancel">
                <input type="submit" class="btn btn-primary pull-right" value="Save Changes">
            </div>
        </form>
    </div>
</section>
