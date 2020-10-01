<section class="content-header">
	<h1><a href="inventory"> Inventory</a></h1>
	<ol class="breadcrumb">
		<li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="inventory"> Inventory</a></li>
		<li class="active"> <?php if (count($sales) > 0) : ?>Edit<?php else : ?>Add New<?php endif; ?> Sales</li>
	</ol>
</section>

<section class="content">
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title"><?php if (count($sales) > 0) : ?>Edit<?php else : ?>Add New<?php endif; ?> Sales</h3>

			<div class="box-tools">
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse">
						<i class="fa fa-minus"></i>
					</button>
				</div>
			</div>
		</div>
		<!-- /.box-header -->

		<form id="frmSales" action="inventory/sales-save" method="post">
			<div class="box-body">
				<div class="col-md-6">
					<div class="form-group">
						<label for="sales_no">Sales No</label>
						<input type="text" name="sales_no" id="sales_no" class="form-control" value="<?php if (count($sales) > 0) : echo $sales['sales_no']; else : echo $sales_no; endif; ?>">
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
						<input type="text" name="quantity" id="quantity" class="form-control" placeholder="0">
					</div>
					<div class="form-group">
						<label for="price">Price per Unit</label>
						<input type="text" name="price" id="price" class="form-control" placeholder="Keep Blank for Default Price">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="sales_date">Sales Date</label>
						<input type="text" name="sales_date" id="sales_date" class="form-control datepicker" value="<?php if(count($sales) > 0) : echo date_to_ui($sales['sales_date']);  else : echo date('d/m/Y'); endif; ?>">
					</div>
					<div class="form-group">
						<label for="customer_id">Select Customer &nbsp;&nbsp;</label>
						<select name="customer_id" id="customer_id" class="form-control select2 col-md-6">
							<?php foreach ($customers as $customer) : ?>
								<option value="<?php echo $customer['id']; ?>" <?php if (count($sales) > 0) : if ($customer['id'] == $sales['customer_id']) : ?>selected<?php endif; endif; ?>><?php echo $customer['name']; ?></option>
							<?php endforeach; ?>
						</select>
						<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-customer"><strong>Add New Customer</strong></button>
					</div>
					<div class="form-group">
						<label for="notes">Notes</label>
						<textarea name="notes" id="notes" rows="3" class="form-control" placeholder="Notes"><?php if (count($sales) > 0) : echo $sales['notes']; endif; ?></textarea>
					</div>
				</div>
			</div>
			<!-- /.box-body -->

			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
			<?php if (count($sales) > 0) : ?>
				<input type="hidden" name="id" id="sales_id" value="<?php echo $sales['id']; ?>">
			<?php endif; ?>
			<div class="box-footer" align="center">
				<button type="button" id="sales_add_item" class="btn btn-primary"><strong>Add Item</strong></button>
			</div>
		</form>
	</div>
</section>

<section class="content">
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Sales Item List</h3>

			<div class="box-tools">
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse">
						<i class="fa fa-minus"></i>
					</button>
				</div>
			</div>
		</div>
		<!-- /.box-header -->

		<div class="box-body" id="sales_details">
			<table id="sales_details_table" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Item Code</th>
						<th>Item Name</th>
						<th>Quantity</th>
						<th>Sales Price</th>
						<th>Total Price</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$qty = 0;
					$price = 0;
					$tax_amount = 0;
					$total_amount = 0;
					foreach ($details as $list) :
						?>
						<tr>
							<td><?php echo $list['item_code']; ?></td>
							<td><?php echo $list['item_name']; ?></td>
							<td><?php echo $list['quantity']; ?></td>
							<td><?php echo $list['sale_price']; ?></td>
							<td><?php echo number_format($list['quantity'] * $list['sale_price'], 2); ?></td>
							<td>
								<input type="hidden" value="<?php echo $list['id']; ?>"><span class="btn del btn-danger sales_item_delete"><i class="fa fa-remove"></i> Delete</span>
							</td>
						</tr>
						<?php
						$qty += $list['quantity'];
						$price += $list['quantity'] * $list['sale_price'];
					endforeach;
					if ($price > 0)
					{
						$tax_amount = ($tax_percent * $price) / 100;
						$total_amount = $price + $tax_amount;
					}
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
						<td colspan="4" class="right">Sales TAX</td>
						<td><?php echo number_format($tax_amount, 2); ?></td>
						<td></td>
					</tr>
					<!-- <tr>
						<td colspan="4" class="right">Discount</td>
						<td><input type="text" name="discount" id="discount" value="<?php echo number_format($price, 2); ?>"></td>
						<td></td>
					</tr> -->
					<tr>
						<td colspan="4">Total Paid Amount</td>
						<td><input type="text" name="paid_amount" id="paid_amount" placeholder="Total Paid Amount" value="<?php if ($total_amount > 0) { echo $total_amount; } ?>"></td>
						<td></td>
					</tr>
				</tfoot>
			</table>
		</div>
		<!-- /.box-body -->

		<div class="box-footer" align="center">
			<input type="button" id="sales_complete" class="btn btn-success" value="Complete Sales Entry">
		</div>
	</div>
</section>

<div class="modal modal-info fade" id="modal-customer" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Customer Entry Form</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="code">Customer Code</label>
					<input type="text" name="code" id="code" value="<?php echo $code; ?>" class="form-control" placeholder="Customer Code"> Digit Only
				</div>
				<div class="form-group">
					<label for="name">Customer Name</label>
					<input type="text" name="name" id="name" class="form-control" placeholder="Customer Name">
				</div>
				<div class="form-group">
					<label for="address">Address</label>
					<textarea name="address" id="address" class="form-control" placeholder="Customer Address"></textarea>
				</div>
				<div class="form-group">
					<label for="mobile">Mobile</label>
					<input type="text" name="mobile" id="mobile" class="form-control" placeholder="Customer Mobile Number">
				</div>
				<div class="form-group">
					<label for="country">Country</label>
					<input type="text" name="country" id="country" class="form-control" placeholder="Customer Country">
				</div>
				<div class="form-group">
					<label for="email">Email</label>
					<input type="text" name="email" id="email" class="form-control" placeholder="Customer Email Address">
				</div>
				<div class="form-group">
					<label for="notes">Notes</label>
					<textarea name="notes" id="notes" class="form-control" placeholder="Customer Notes"></textarea>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
				<button type="button" id="add_customer" class="btn btn-outline">Save changes</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
	var sales_id = document.getElementById("sales_id")
	if (sales_id == null) {
		var sales_draft = false;
		$(window).on('beforeunload', function(){
			if(sales_draft === true)
			{
				return true;
			}
		});
		$(window).on('unload', function(){
			if (sales_draft === true)
			{
				let sales_no = $('#sales_no').val();
				$.ajax({
					type: "POST",
					url: "inventory/sales_unsaved_delete",
					data: {sales_no: sales_no},
					async: false,
					success: function(msg) {
						return true;
					}
				});
			}
		});
	}
</script>