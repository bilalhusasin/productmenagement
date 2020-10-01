<section class="content-header">
	<h1><a href="inventory"> Inventory</a></h1>
	<ol class="breadcrumb">
		<li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="inventory"> Inventory</a></li>
		<li class="active"> <?php if (count($purchase) > 0) : ?>Edit<?php else : ?>Add New<?php endif; ?> Purchase</li>
	</ol>
</section>

<section class="content">
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title"><?php if (count($purchase) > 0) : ?>Edit<?php else : ?>Add New<?php endif; ?> Purchase</h3>

			<div class="box-tools">
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse">
						<i class="fa fa-minus"></i>
					</button>
				</div>
			</div>
		</div>
		<!-- /.box-header -->

		<form id="frmPurchase" action="inventory/purchase-save" method="post">
			<div class="box-body">
				<div class="col-md-6">
					<div class="form-group">
						<label for="purchase_no">Purchase No</label>
						<input type="text" name="purchase_no" id="purchase_no" class="form-control" value="<?php if (count($purchase) > 0) : echo $purchase['purchase_no']; else : echo $purchase_no; endif ?>">
					</div>
					<div class="form-group">
						<label for="item_id">Select Item</label>
						<select name="item_id" id="item_id" class="form-control change-price select2">
							<?php foreach ($items as $item) : ?>
								<option value="<?php echo $item['id']; ?>"><?php echo $item['code'] . ' - ' . $item['name']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<label for="quantity">Quantity</label>
						<input type="text" name="quantity" id="quantity" class="form-control required" placeholder="0">
					</div>
					<div class="form-group">
						<label for="price">Price per Unit</label>
						<input type="text" name="price" id="price" class="form-control" placeholder="Price per unit">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="purchase_date">Purchase Date</label>
						<input type="text"  name="purchase_date" id="purchase_date" class="form-control datepicker" value="<?php if (count($purchase) > 0) : echo $purchase['purchase_date']; else : echo date('d/m/Y'); endif; ?>">
					</div>
					<div class="form-group">
						<label for="supplier_id">Select Supplier &nbsp;&nbsp;</label>
						<select name="supplier_id" id="supplier_id" class="form-control select2">
							<?php foreach ($suppliers as $supplier) : ?>
								<option value="<?php echo $supplier['id']; ?>" <?php if (count($purchase) > 0) : if ($supplier['id'] == $purchase['supplier_id']) : ?>selected<?php endif; endif; ?>> <?php echo $supplier['name']; ?></option>
							<?php endforeach; ?>
						</select>
						<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-supplier"><strong>Add New Supplier</strong></button>
					</div>
					<div class="form-group">
						<label for="notes">Notes</label>
						<textarea name="notes" id="notes" rows="3" class="form-control" placeholder="Notes"><?php if (count($purchase) > 0) : echo $purchase['notes']; endif; ?></textarea>
					</div>
				</div>
			</div>
			<!-- /.box-body -->

			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
			<?php if (count($purchase) > 0) : ?>
				<input type="hidden" name="id" id="purchase_id" value="<?php echo $purchase['id']; ?>">
			<?php endif; ?>
			<div class="box-footer" align="center">
				<input type="button" id="purchase_add_item" class="btn btn-primary" value="Add Item">
			</div>
		</form>
	</div>
</section>

<section class="content">
	<div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title">Item List</h3>
		</div>
		<!-- /.box-header -->

		<div class="box-body" id="purchase_details">
			<table id="data_table" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Item Code</th>
						<th>Item Name</th>
						<th>Quantity</th>
						<th>Purchase Price</th>
						<th>Total Price</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$qty = 0;
					$price = 0;
					foreach ($details as $list) :
						?>
						<tr>
							<td><?php echo $list['item_code']; ?></td>
							<td><?php echo $list['item_name']; ?></td>
							<td><?php echo $list['quantity']; ?></td>
							<td><?php echo $list['purchase_price']; ?></td>
							<td><?php echo number_format($list['quantity'] * $list['purchase_price'], 2); ?></td>
							<td>
								<input type="hidden" value="<?php echo $list['id']; ?>" /><span class="btn btn-danger purchase_item_delete"><i class="icon-trash icon-white"></i>Delete</span>
							</td>
						</tr>
						<?php
						$qty += $list['quantity'];
						$price += $list['quantity'] * $list['purchase_price'];
					endforeach;
					?>
				</tbody>
				<tfoot>
					<tr>
						<th colspan="6">Order Totals</th>
					</tr>
					<tr>
						<td colspan="2">&nbsp;</td>
						<td><?php echo $qty; ?></td>
						<td></td>
						<td><?php echo number_format($price, 2); ?></td>
						<td></td>
					</tr>
					<tr>
						<td colspan="4">Total Paid Amount</td>
						<td><input type="text" name="paid_amount" id="paid_amount"></td>
						<td></td>
					</tr>
				</tfoot>
			</table>
		</div>
		<!-- /.box-body -->

		<div class="box-footer" align="center">
			<input type="button" class="btn btn-success" id="purchase_complete" value="Complete Purchase Entry">
		</div>
	</div>
</section>

<div class="modal modal-info fade" id="modal-supplier" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Supplier Entry Form</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="code">Supplier Code</label>
					<input type="text" name="code" id="code" value="<?php echo $code; ?>" class="form-control" placeholder="Supplier Code"> Digit Only
				</div>
				<div class="form-group">
					<label for="name">Supplier Name</label>
					<input type="text" name="name" id="name" class="form-control" placeholder="Supplier Name">
				</div>
				<div class="form-group">
					<label for="address">Supplier Address</label>
					<textarea name="address" id="address" class="form-control" placeholder="Supplier Address"></textarea>
				</div>
				<div class="form-group">
					<label for="contact_person">Contact Person</label>
					<input type="text" name="contact_person" id="contact_person" class="form-control" placeholder="Contact Person">
				</div>
				<div class="form-group">
					<label for="phone_no">Phone No.</label>
					<input type="text" name="phone_no" id="phone_no" class="form-control" placeholder="Supplier's Phone No.">
				</div>
				<div class="form-group">
					<label for="notes">Notes</label>
					<textarea name="notes" id="notes" class="form-control" placeholder="Notes"></textarea>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
				<button type="button" id="add_supplier" class="btn btn-outline">Save changes</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
	var purchase_id = document.getElementById("purchase_id")
	if (purchase_id == null) {
		var purchase_draft = false;
		$(window).on('beforeunload', function(){
			if(purchase_draft === true)
			{
				return true;
			}
		});
		$(window).on('unload', function(){
			if (purchase_draft === true)
			{
				let purchase_no = $('#purchase_no').val();
				$.ajax({
					type: "POST",
					url: "inventory/purchase_unsaved_delete",
					data: {purchase_no: purchase_no},
					async: false,
					success: function(msg) {
						return true;
					}
				});
			}
		});
	}
</script>