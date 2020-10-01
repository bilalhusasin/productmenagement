<section class="content-header">
	<h1><a href="inventory"> Inventory</a></h1>
	<ol class="breadcrumb">
		<li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="inventory"> Inventory</a></li>
		<li class="active">Supplier</li>
	</ol>
</section>

<section class="content">
	<?php $this->load->view('flash_message'); ?>

	<div class="box box-clear">
		<a href="inventory/supplier-save" class="btn btn-success btn-lg"><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;<strong>Add New Supplier</strong></a>
	</div>

	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Supplier List</h3>

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
						<th>Company Name</th>
						<th>Address</th>
						<th>Contact Person</th>
						<th>Phone No</th>
						<th class="col-md-2">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($suppliers as $key => $value) : ?>
						<tr>
							<td><?php echo $value['code']; ?></td>
							<td align="left"><?php echo $value['name']; ?></td>
							<td align="left"><?php echo $value['address']; ?></td>
							<td align="left"><?php echo $value['contact_person']; ?></td>
							<td align="left"><?php echo $value['phone_no']; ?></td>
							<td class="col-md-2">
								<a class="btn-sm btn-warning" href="inventory/supplier-save/<?php echo $value['id']; ?>"><i class="fa fa-edit"></i> Edit</a>
								<a class="btn-sm btn-danger del" href="inventory/supplier-delete/<?php echo $value['id']; ?>"><i class="fa fa-remove"></i> Delete</a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
				<tfoot>
					<tr>
						<th>Code</th>
						<th>Company Name</th>
						<th>Address</th>
						<th>Contact Person</th>
						<th>Phone No</th>
						<th class="col-md-2">Action</th>
					</tr>
				</tfoot>
			</table>
		</div>
		<!-- /.box-body -->
	</div>
</section>

