<section class="content-header">
	<h1><a href="inventory"> Inventory</a></h1>
	<ol class="breadcrumb">
		<li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="inventory"> Inventory</a></li>
		<li class="active"> Sales Return</li>
	</ol>
</section>

<section class="content">
	<?php $this->load->view('flash_message'); ?>

	<div class="box box-clear">
		<a href="inventory/sales-return-save" class="btn btn-success btn-lg"><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;<strong>Add New Sales Return</strong></a>
	</div>

	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Sales Return List</h3>

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
						<th>Sales Return No</th>
						<th>Sales Return Date</th>
						<th>Customer</th>
						<th>Total Qty.</th>
						<th>Total Amount</th>
						<th class="col-md-2">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($sales_returns as $sales_return) : ?>
						<tr>
							<td><a href="inventory/sales-return-preview/<?php echo $sales_return['sales_return_no']; ?>"><strong><?php echo $sales_return['sales_return_no']; ?></strong></a></td>
							<td><?php echo date('jS M, Y ', strtotime($sales_return['sales_return_date'])); ?></td>
							<td><?php echo $sales_return['customer_name']; ?></td>
							<td><?php echo $sales_return['item_qty']; ?></td>
							<td><?php echo number_format($sales_return['amount'], 2); ?></td>
							<td class="col-md-2">
								<a class="btn-sm btn-warning" href="inventory/sales-save/<?php echo $sales_return['id']; ?>"><i class="fa fa-edit"></i> Edit</a>
								<a class="btn-sm btn-danger del" href="inventory/sales-delete/<?php echo $sales_return['id']; ?>"><i class="fa fa-remove"></i> Delete</a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
				<tfoot>
					<tr>
						<th>Sales Return No</th>
						<th>Sales Return Date</th>
						<th>Customer</th>
						<th>Total Qty.</th>
						<th>Total Amount</th>
						<th class="col-md-2">Action</th>
					</tr>
				</tfoot>
			</table>
		</div>
		<!-- /.box-body -->
	</div>
</section>

