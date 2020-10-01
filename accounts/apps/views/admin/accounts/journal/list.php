<section class="content-header">
	<h1><a href="accounts"> Accounts</a></h1>
	<ol class="breadcrumb">
		<li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="accounts"> Accounts</a></li>
		<li class="active"> Journal</li>
	</ol>
</section>

<section class="content">
	<?php $this->load->view('flash_message'); ?>

	<div class="box box-clear">
		<a href="accounts/journal-save" class="btn btn-success btn-lg"><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;<strong>Add New Journal</strong></a>
	</div>

	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">List All</h3>

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
						<th>Journal No</th>
						<th>Journal Date</th>
						<th>Debit A/C Head</th>
						<th>Debit Amount</th>
						<th>Credit A/C Head</th>
						<th>Credit Amount</th>
						<th class="col-md-2">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($journals as $key => $value) : ?>
						<tr>
							<td><a href="accounts/journal-preview/<?php echo $value['id']; ?>"><strong><?php echo $value['journal_no']; ?></strong></a></td>
							<td><?php echo date('jS M, Y ', strtotime($value['journal_date'])); ?></td>
							<td><?php echo $value['debit_ac']; ?></td>
							<td><?php echo number_format($value['debit_amount'], 2); ?></td>
							<td><?php echo $value['credit_ac']; ?></td>
							<td><?php echo number_format($value['credit_amount'], 2); ?></td>
							<td class="col-md-2">
								<a class="btn-sm btn-warning" href="accounts/journal_save/<?php echo $value['id']; ?>"><i class="fa fa-edit"></i> Edit</a>
								<a class="btn-sm btn-danger del" href="accounts/delete_journal/<?php echo $value['id']; ?>"><i class="fa fa-remove"></i> Delete</a>
							</td>
						</tr>
						<?php endforeach; ?>
				</tbody>
				<tfoot>
					<tr>
						<th>Journal No</th>
						<th>Journal Date</th>
						<th>Debit A/C Head</th>
						<th>Debit Amount</th>
						<th>Credit A/C Head</th>
						<th>Credit Amount</th>
						<th class="col-md-2">Action</th>
					</tr>
				</tfoot>
			</table>
		</div>
		<!-- /.box-body -->
	</div>
</section>

