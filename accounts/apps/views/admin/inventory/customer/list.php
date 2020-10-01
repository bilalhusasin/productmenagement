<section class="content-header">
	<h1><a href="inventory"> Inventory</a></h1>
	<ol class="breadcrumb">
		<li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="inventory"> Inventory</a></li>
		<li class="active"> Customer</li>
	</ol>
</section>
<section class="content">
	<?php $this->load->view('flash_message'); ?>

	<div class="box box-clear">
		<a href="inventory/customer-save" class="btn btn-success btn-lg"><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;<strong>Add New Customer</strong></a>
	</div>

	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Customer List</h3>

			<div class="box-tools">
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse">
						<i class="fa fa-minus"></i>
					</button>
				</div>
			</div>
		</div>
		<!-- /.box-header -->

		<div class="box-body">
			<table id="data_table_desc" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Code</th>
						<th>Name</th>
						<th>Address</th>
						<th>Mobile</th>
						<th>Email</th>
						<th class="col-md-2">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($customers as $customer) : ?>
						<tr>
							<td><?php echo $customer['code']; ?></td>
							<td><?php echo $customer['name']; ?></td>
							<td><?php echo $customer['address']; ?></td>
							<td><?php echo $customer['mobile']; ?></td>
							<td><?php echo $customer['email']; ?></td>
							<td class="col-md-2">
								<a class="btn-sm btn-warning" href="inventory/customer-save/<?php echo $customer['id']; ?>"><i class="fa fa-edit"></i> Edit</a>
								<a class="btn-sm btn-danger del" href="inventory/customer-delete/<?php echo $customer['id']; ?>"><i class="fa fa-remove"></i> Delete</a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
				<tfoot>
					<tr>
						<th>Code</th>
						<th>Name</th>
						<th>Address</th>
						<th>Mobile</th>
						<th>Email</th>
						<th class="col-md-2">Action</th>
					</tr>
				</tfoot>
			</table>
		</div>
		<!-- /.box-body -->
	</div>
</section>

