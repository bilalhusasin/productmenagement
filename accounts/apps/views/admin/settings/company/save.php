<section class="content-header">
    <h1>Settings</h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="settings"> Settings</a></li>
        <li class="active"> <?php if (count($company) > 0) : ?>Edit <?php else : ?> Add New <?php endif; ?> Company</li>
    </ol>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?php if (count($company) > 0) : ?>Edit <?php else : ?> Add New <?php endif; ?> Company</h3>

            <div class="box-tools">
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- /.box-header -->

        <form id="frmCmp" action="settings/cmp-save" enctype="multipart/form-data" method="post">
            <div class="box-body">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Company Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="<?php if (count($company) > 0) : echo $company['name']; endif; ?>">
                    </div>
                    <div class="form-group">
                        <label for="currency_id">Select Currency</label>
                        <select name="currency_id" id="currency_id" class="form-control select2" data-placeholder="Select Currency">
                            <option value=""></option>
                            <?php foreach ($currencies as $currency) : ?>
                                <option value="<?php echo $currency['id']; ?>" <?php if (count($company) > 0 && $company['currency_id'] == $currency['id']) : echo 'selected'; endif; ?>><?php echo $currency['fullname'] . ' - ( ' . $currency['symbol'] . ' )'; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="currency_symbol_position">Currency Symbol Position</label>
                        <select name="currency_symbol_position" id="currency_symbol_position" class="form-control select2" data-placeholder="Select Currency Symbol Position">
                            <option value=""></option>
                            <option value="Before" <?php if (count($company) > 0 && $company['currency_symbol_position'] == 'Before') : echo 'selected'; endif;?>>Before</option>
                            <option value="After" <?php if (count($company) > 0 && $company['currency_symbol_position'] == 'After') : echo 'selected'; endif;?>>After</option>
                        </select>
                    </div>
                    <?php if (count($company) > 0 && $company['logo'] != '') : ?>
                        <div class="form-group">
                            <label>Current Logo</label>
                            <img src="uploads/companies/<?php echo $company['logo']; ?>">
                        </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="contact_person">Contact Person</label>
                        <input type="text" name="contact_person" id="contact_person" class="form-control" value="<?php if (count($company) > 0) : echo $company['contact_person']; endif; ?>">
                    </div>
                    <div class="form-group">
                        <label for="mobile_no">Contact Number</label>
                        <input type="text" name="mobile_no" id="mobile_no" class="form-control" value="<?php if (count($company) > 0) : echo $company['mobile_no']; endif; ?>">
                    </div>
                    <?php if (empty($company)) : ?>
                        <div class="form-group">
                            <label for="email">Power User's Email</label>
                            <input type="text" name="email" id="email" class="form-control" value="<?php if (count($company) > 0) : echo $company['email']; endif; ?>">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" value="">
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea name="address" id="address" class="form-control"><?php if (count($company) > 0) : echo $company['address']; endif; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="text" name="phone" id="phone" class="form-control" value="<?php if(count($company) > 0) : echo $company['phone']; endif; ?>">
                    </div>
                    <div class="form-group">
                        <label for="area">Area</label>
                        <input type="text" name="area" id="area" class="form-control" value="<?php if (count($company) > 0) : echo $company['area']; endif; ?>">
                    </div>
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" name="city" id="city" class="form-control" value="<?php if (count($company) > 0) : echo $company['city']; endif; ?>">
                    </div>
                    <div class="form-group">
                        <label for="zip">Zip</label>
                        <input type="text" name="zip" id="zip" class="form-control" value="<?php if(count($company) > 0): echo $company['zip']; endif; ?>">
                    </div>
                    <div class="form-group">
                        <label for="country">Country</label>
                        <input type="text" name="country" id="country" class="form-control" value="<?php if (count($company) > 0) : echo $company['country']; endif; ?>">
                    </div>
                    <div class="form-group">
                        <label>Select Status</label>
                        <select name="status" id="status" class="form-control select2" data-placeholder="Select Status">
                            <option value=""></option>
                            <option value="Active" <?php if (count($company) > 0 && $company['status'] == 'Active') : echo 'selected'; endif; ?>>Active</option>
                            <option value="Inactive" <?php if (count($company) > 0 && $company['status'] == 'Inactive') : echo 'selected'; endif;?>>Inactive</option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->

            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <?php if (count($company) > 0) : ?>
                <input type="hidden" name="id" value="<?php echo $company['id']; ?>">
            <?php endif; ?>
            <div class="box-footer">
                <input type="reset" class="btn btn-danger" value="Cancel">
                <input type="submit" class="btn btn-primary pull-right" value="Save Changes">
            </div>
        </form>
    </div>
</section>
