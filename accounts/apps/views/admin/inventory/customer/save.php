<section class="content-header">
	<h1><a href="inventory"> Inventory</a></h1>
	<ol class="breadcrumb">
		<li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="inventory"> Inventory</a></li>
		<li class="active"> <?php if (count($customer) > 0) : ?>Edit<?php else : ?>Add New<?php endif; ?> Customer
		</li>
	</ol>
</section>

<section class="content">
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title"><?php if (count($customer) > 0) : ?>Edit<?php else : ?>Add New<?php endif; ?> Customer</h3>

			<div class="box-tools">
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse">
						<i class="fa fa-minus"></i>
					</button>
				</div>
			</div>
		</div>
		<!-- /.box-header -->

		<form id="frmCustomer" action="inventory/customer-save" method="post">
			<div class="box-body">
				<div class="col-md-6">
					<div class="form-group">
						<label for="code">Customer Code</label>
						<input type="text" name="code" id="code" class="form-control" placeholder="Customer Code" value="<?php if (count($customer) > 0) : echo $customer['code'];  else : echo $code; endif; ?>"> Digit Only
					</div>
					<div class="form-group">
						<label for="name">Customer Name</label>
						<input type="text" name="name" id="name" class="form-control" placeholder="Customer Name" value="<?php if (count($customer) > 0) : echo $customer['name']; endif; ?>">
					</div>
					<div class="form-group">
						<label for="address">Address</label>
						<textarea name="address" id="address" class="form-control" placeholder="Customer Address" ><?php if (count($customer) > 0) : echo $customer['address']; endif; ?></textarea>
					</div>
					<div class="form-group">
						<label for="mobile">Mobile</label>
						<input type="text" name="mobile" id="mobile" class="form-control" placeholder="Customer Mobile Number" value="<?php if (count($customer) > 0) : echo $customer['mobile']; endif; ?>">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="country">Country</label>
						<input type="text" name="country" id="country" class="form-control" placeholder="Country" value="<?php if (count($customer) > 0) : echo $customer['country']; endif; ?>">
					</div>
					<div class="form-group">
						<label for="email">Email</label>
						<input type="text" name="email" id="email" class="form-control" placeholder="Email" value="<?php if (count($customer) > 0) : echo $customer['email']; endif; ?>">
					</div>
					<div class="form-group">
						<label for="notes">Notes</label>
						<textarea name="notes" id="notes" class="form-control" placeholder="Customer Notes"><?php if (count($customer) > 0) : echo $customer['notes']; endif; ?></textarea>
					</div>
					<div class="form-group">
						<label for="status">Select Status</label>
						<select  name="status" id="status" class="form-control select2">
							<option value="active" <?php if (count($customer) > 0 && $customer['status'] == 'active') : echo 'selected'; endif; ?>>Active</option>
							<option value="inactive" <?php if (count($customer) > 0 && $customer['status'] == 'inactive') : echo 'selected'; endif; ?>>Inactive</option>
						</select>
					</div>
				</div>
			</div>
			<!-- /.box-body -->

			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
			<?php if (count($customer) > 0) : ?>
				<input type="hidden" name="id" value="<?php echo $customer['id']; ?>">
			<?php endif; ?>
			<div class="box-footer">
				<input type="reset" class="btn btn-danger" value="Cancel">
				<input type="submit" class="btn btn-primary pull-right" value="Save Changes">
			</div>
		</form>
	</div>
</section>
