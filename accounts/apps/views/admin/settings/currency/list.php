<section class="content-header">
	<h1><a href="settings"> Settings</a></h1>
	<ol class="breadcrumb">
		<li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="settings"> Settings</a></li>
		<li class="active"> Currency</li>
	</ol>
</section>

<section class="content">
	<?php $this->load->view('flash_message'); ?>

	<div class="box box-clear">
		<a href="settings/currency-save" class="btn btn-success btn-lg"><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;<strong>Add New Currency</strong></a>
	</div>

	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Currency List</h3>

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
						<th>Country Name</th>
						<th>Short Form</th>
						<th>Symbol</th>
						<th class="col-md-2">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($currencies as $currency) : ?>
						<tr>
							<td><?php echo $currency['fullname']; ?></td>
							<td><?php echo $currency['shortname']; ?></td>
							<td><?php echo $currency['symbol']; ?></td>
							<td class="center col-md-2">
								<a class="btn-sm btn-warning" href="settings/currency-save/<?php echo $currency['id']; ?>"><i class="fa fa-edit"></i> Edit</a>
								<a class="btn-sm btn-danger del" href="settings/currency-delete/<?php echo $currency['id']; ?>"><i class="fa fa-remove"></i> Delete</a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
				<tfoot>
					<tr>
						<th>Country Name</th>
						<th>Short Form</th>
						<th>Symbol</th>
						<th class="col-md-2">Action</th>
					</tr>
				</tfoot>
			</table>
		</div>
		<!-- /.box-body -->

	</div>
</section>

