<section class="content-header">
	<h1><a href="settings"> Settings</a></h1>
	<ol class="breadcrumb">
		<li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="settings"> Settings</a></li>
		<li class="active"> Default A/C Head</li>
	</ol>
</section>
<section class="content">
	<?php $this->load->view('flash_message'); ?>

	<div class="box box-clear">
		<a href="settings/chart-save" class="btn btn-success btn-lg"><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;<strong>Add New Default A/C Head</strong></a>
	</div>

	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Default A/C Head List</h3>

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
						<th>Code of A/C</th>
						<th>Name of A/C</th>
						<th>A/C Class</th>
						<th>Created</th>
						<th>Status</th>
						<th class="col-md-2">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($charts as $chart) : ?>
						<tr>
							<td><?php echo $chart['code']; ?></td>
							<td><?php echo $chart['name']; ?></td>
							<td><span class="label label-info"><?php echo $chart['type']; ?></span></td>
							<td class="right"><?php echo date('jS M, Y ', strtotime($chart['created_at'])); ?></td>
							<td class="center"><?php if ($chart['status']== 'Active') : ?><span class="label label-success">Active</span><?php else : ?><span class="label label-important">Inactive</span><?php endif; ?></td>
							<td class="center col-md-2">
								<a class="btn-sm btn-warning" href="settings/chart-save/<?php echo $chart['id']; ?>"><i class="fa fa-edit"></i> Edit</a>
								<a class="btn-sm btn-danger del" href="settings/chart-delete/<?php echo $chart['id']; ?>"><i class="fa fa-remove"></i> Delete</a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
				<tfoot>
					<tr>
						<th>Code of A/C</th>
						<th>Name of A/C</th>
						<th>A/C Class</th>
						<th>Created</th>
						<th>Status</th>
						<th class="col-md-2">Actions</th>
					</tr>
				</tfoot>
			</table>
		</div>
		<!-- /.box-body -->
	</div>
</section>

