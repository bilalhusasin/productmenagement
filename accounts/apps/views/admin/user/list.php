<section class="content-header">
	<h1>User</h1>
	<ol class="breadcrumb">
		<li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="user"> User</a></li>
		<li class="active"> List</li>
	</ol>
</section>

<section class="content">
	<?php $this->load->view('flash_message'); ?>

	<div class="box box-clear">
		<a href="user/save" class="btn btn-success btn-lg"><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;<strong>Add New User</strong></a>
	</div>

	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">User List</h3>

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
						<th>Email</th>
						<th>Company</th>
						<th>Created</th>
						<th>Status</th>
						<th>User Type</th>
						<th class="col-md-3">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($users as $user) : ?>
						<tr>
							<td><?php echo $user['name']; ?></td>
							<td><?php echo $user['email']; ?></td>
							<td><?php echo $user['c_name']; ?></td>
							<td><?php echo $user['created']; ?></td>
							<td><?php echo $user['status']; ?></td>
							<td><?php echo $user['type']; ?></td>
							<td class="center col-md-3">
								<?php if ($this->session->user_type != 'User') : ?>
									<a class="btn-sm btn-success" href="user/privileges/<?php echo $user['id']; ?>"><i class="fa fa-lock"></i> Permission</a>
								<?php endif; ?>
								<a class="btn-sm btn-warning" href="user/save/<?php echo $user['id']; ?>"><i class="fa fa-edit"></i> Edit</a>
								<a class="btn-sm btn-danger del" href="user/delete/<?php echo $user['id']; ?>"><i class="fa fa-remove"></i> Delete</a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
				<tfoot>
					<tr>
						<th>Name</th>
						<th>Email</th>
						<th>Company</th>
						<th>Created</th>
						<th>Status</th>
						<th>User Type</th>
						<th class="col-md-3">Action</th>
					</tr>
				</tfoot>
			</table>
		</div>
		<!-- /.box-body -->

	</div>
</section>

