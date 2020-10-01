<section class="content-header">
	<h1><a href="accounts"> Accounts</a></h1>
	<ol class="breadcrumb">
		<li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="accounts"> Accounts</a></li>
		<li class="active">	Payment Receipt</li>
	</ol>
</section>

<section class="content">
	<?php $this->load->view('flash_message'); ?>

	<div class="box box-clear">
		<a href="accounts/payment-save" class="btn btn-success btn-lg"><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;<strong>Add New Payment Receipt</strong></a>
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
			<table id="data_table" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Payment No</th>
						<th>Payment Date</th>
						<th>Amount</th>
						<th>Ref. Employee</th>
						<th class="col-md-2">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($payments as $key => $value) : ?>
						<tr>
							<td><a href="accounts/payment-preview/<?php echo $value['id']; ?>"><strong><?php echo $value['payment_no']; ?></strong></a></td>
							<td><?php echo date('jS F Y ', strtotime($value['payment_date'])); ?></td>
							<td><?php echo number_format($value['amount'], 2); ?></td>
							<td><?php echo $value['emp_name']; ?></td>
							<td class="col-md-2">
								<a class="btn-sm btn-warning" href="accounts/payment-save/<?php echo $value['id']; ?>"><i class="fa fa-edit"></i> Edit</a>
								<a class="btn-sm btn-danger del" href="accounts/payment-delete/<?php echo $value['id']; ?>"><i class="fa fa-remove"></i> Delete</a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
				<tfoot>
					<tr>
						<th>Payment No</th>
						<th>Payment Date</th>
						<th>Amount</th>
						<th>Ref. Employee</th>
						<th class="col-md-2">Action</th>
					</tr>
				</tfoot>
			</table>

		</div>
		<!-- /.box-body -->
	</div>
</section>

