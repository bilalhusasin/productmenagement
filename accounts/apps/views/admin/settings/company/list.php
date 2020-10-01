<section class="content-header">
	<h1><a href="settings"> Settings</a></h1>
	<ol class="breadcrumb">
		<li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="settings"> Settings</a></li>
		<li class="active"> Company</li>
	</ol>
</section>
<section class="content">
	<?php $this->load->view('flash_message'); ?>

	<div class="box box-clear">
		<a href="settings/cmp-save" class="btn btn-success btn-lg"><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;<strong>Add New Company</strong></a>
	</div>

	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Company List</h3>

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
			<table id="data_table" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Name</th>
						<th>Address</th>
						<th>Contact Person</th>
						<th>Contact Number</th>
						<th>Email Address</th>
						<th class="col-md-3">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($companies as $company) : ?>
						<tr>
							<td><?php echo $company['name']; ?></td>
							<td><?php echo $company['address']; ?></td>
							<td><?php echo $company['contact_person']; ?></td>
							<td><?php echo $company['mobile_no']; ?></td>
							<td><?php echo $company['email']; ?></td>
							<td class="center col-md-3">
								<a class="btn-sm btn-primary" href="settings/cmp-set/<?php echo $company['id']; ?>"><i class="fa fa-refresh"></i> Set As</a>
								<a class="btn-sm btn-warning" href="settings/cmp-save/<?php echo $company['id']; ?>"><i class="fa fa-edit"></i> Edit</a>
								<a class="btn-sm btn-danger del" href="settings/cmp-delete/<?php echo $company['id']; ?>"><i class="fa fa-remove"></i> Delete</a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
				<tfoot>
					<tr>
						<th>Name</th>
						<th>Address</th>
						<th>Contact Person</th>
						<th>Contact Number</th>
						<th>Email Address</th>
						<th class="col-md-3">Action</th>
					</tr>
				</tfoot>
			</table>
		</div>
		<!-- /.box-body -->

	</div>
</section>

