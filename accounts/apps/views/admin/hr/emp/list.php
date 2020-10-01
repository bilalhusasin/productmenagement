<section class="content-header">
	<h1>H R</h1>
	<ol class="breadcrumb">
		<li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="hr"> H R</a></li>
		<li class="active"> List</li>
	</ol>
</section>

<section class="content">
	<?php $this->load->view('flash_message'); ?>

	<div class="box box-clear">
		<a href="hr/emp-save" class="btn btn-success btn-lg"><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;<strong>Add New Employee</strong></a>
	</div>

	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Employee List</h3>

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
						<th>Code</th>
						<th>Full Name</th>
						<th>Present Address</th>
						<th>Mobile No</th>
						<th>Joining</th>
						<th class="col-md-2">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($emps as $emp) : ?>
						<tr>
							<td><a href="hr/emp-details/<?php echo $emp['id']; ?>"><strong><?php echo $emp['code']; ?></strong></a></td>
							<td><?php echo $emp['name']; ?></td>
							<td><?php echo $emp['present_address']; ?></td>
							<td><?php echo $emp['mobile']; ?></td>
							<td><?php echo date('jS F Y ', strtotime($emp['joining'])); ?></td>
							<td class="center col-md-2">
								<a class="btn-sm btn-warning" href="hr/emp-save/<?php echo $emp['id']; ?>"><i class="fa fa-edit"></i> Edit</a>
								<a class="btn-sm btn-danger del" href="hr/emp-delete/<?php echo $emp['id']; ?>"><i class="fa fa-remove"></i> Delete</a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
				<tfoot>
					<tr>
						<th>Code</th>
						<th>Full Name</th>
						<th>Present Address</th>
						<th>Mobile No</th>
						<th>Joining</th>
						<th class="col-md-2">Action</th>
					</tr>
				</tfoot>
			</table>
		</div>
		<!-- /.box-body -->
	</div>
</section>

