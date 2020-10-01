<section class="content-header">
	<h1><a href="inventory"> Inventory</a></h1>
	<ol class="breadcrumb">
		<li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="inventory"> Inventory</a></li>
		<li class="active"> Purchase Return</li>
	</ol>
</section>

<section class="content">
	<?php $this->load->view('flash_message'); ?>

	<div class="box box-clear">
		<a href="inventory/purchase-return-save" class="btn btn-success btn-lg"><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;<strong>Add New Purchase Return</strong></a>
	</div>

	<div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title">Purchase Return List</h3>

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
						<th>Purchase Return No</th>
						<th>Purchase Return Date</th>
						<th>Supplier</th>
						<th>Total Qty.</th>
						<th>Total Amount</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($purchase_returns as $purchase_return) : ?>
						<tr>
							<td><a href="inventory/purchase-return-preview/<?php echo $purchase_return['purchase_return_no']; ?>"><strong>
								<?php echo $purchase_return['purchase_return_no']; ?></strong></a>
							</td>
							<td><?php echo date('jS M, Y ',strtotime($purchase_return['purchase_return_date'])); ?></td>
							<td><?php echo $purchase_return['supplier_name']; ?></td>
							<td><?php echo $purchase_return['total_qty']; ?></td>
							<td><?php echo number_format($purchase_return['total_price'], 2); ?></td>
							<td class="actions center">
								<a class="btn-sm btn-warning" href="inventory/purchase-return-save/<?php echo $purchase_return['id']; ?>"><i class="ion-edit"></i> Edit</a>
								<a class="btn-sm btn-danger del" href="inventory/purchase-return-delete/<?php echo $purchase_return['id']; ?>"><i class="ion-trash-b"></i> Delete</a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
				<tfoot>

				</tfoot>
			</table>
		</div>
		<!-- /.box-body -->
	</div>
</section>

