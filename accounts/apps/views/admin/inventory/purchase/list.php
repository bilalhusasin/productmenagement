<section class="content-header">
	<h1><a href="inventory"> Inventory</a></h1>
	<ol class="breadcrumb">
		<li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="inventory"> Inventory</a></li>
		<li class="active"> Purchase</li>
	</ol>
</section>

<section class="content">
	<?php $this->load->view('flash_message'); ?>

	<div class="box box-clear">
		<a href="inventory/purchase-save" class="btn btn-success btn-lg"><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;<strong>Add New Purchase</strong></a>
	</div>

	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Purchase List</h3>

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
						<th>Purchase No</th>
						<th>Purchase Date</th>
						<th>Supplier</th>
						<th>Total Qty.</th>
						<th>Total Amount</th>
						<th class="col-md-2">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($purchases as $purchase) : ?>
						<tr>
							<td><a href="inventory/purchase-preview/<?php echo $purchase['purchase_no']; ?>"><strong><?php echo $purchase['purchase_no']; ?></strong></a></td>
							<td><?php echo date('jS M, Y ', strtotime($purchase['purchase_date'])); ?></td>
							<td><?php echo $purchase['supplier_name']; ?></td>
							<td><?php echo $purchase['total_qty']; ?></td>
							<td><?php echo number_format($purchase['total_price'], 2); ?></td>
							<td class="col-md-2">
								<a class="btn-sm btn-warning" href="inventory/purchase-save/<?php echo $purchase['id']; ?>"><i class="fa fa-edit"></i> Edit</a>
								<a class="btn-sm btn-danger del" href="inventory/purchase-delete/<?php echo $purchase['id']; ?>"><i class="fa fa-remove"></i> Delete</a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
				<tfoot>
					<tr>
						<th>Purchase No</th>
						<th>Purchase Date</th>
						<th>Supplier</th>
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

