<!-- Content Header -->
<section class="content-header">
	<h1><a href="accounts"> Accounts</a></h1>
	<ol class="breadcrumb">
		<li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="accounts"> Accounts</a></li>
		<li class="active"> Payments Receipt Preview</li>
	</ol>
</section>

<!-- Main content -->
<section class="invoice">
	<!-- title row -->
	<div class="row">
		<div class="col-md-12">
			<h2 class="page-header">
				<?php echo $this->session->company_name; ?>
				<small class="pull-right">Date: <?php echo date_to_ui($details['payment_date']); ?></small>
			</h2>
			<h3 class="page-center">Payment Receipt</h3>
		</div>
		<!-- /.col -->
	</div>

	<!-- info row -->
	<div class="row invoice-info">
		<div class="col-md-6 invoice-col">
			<strong>Payment Receipt #</strong> <?php echo $details['payment_no']; ?><br>
			<strong>Date:</strong> <?php echo date_to_ui($details['payment_date']); ?><br>
			<strong>Memo:</strong> <?php echo $details['memo']; ?><br>
			<strong>Ref. Employee:</strong> <?php if (count($emp) > 0) { echo $emp['name']; } ?><br>
		</div>
		<!-- /.col -->
		<div class="col-md-6 invoice-col">
			<strong>Supplier Details</strong><br>
			<strong>Name:</strong> <?php echo $supplier['name']; ?><br>
			<strong>Address:</strong> <?php echo $supplier['address']; ?><br>
			<strong>Phone #:</strong> <?php echo $supplier['phone_no']; ?><br>
			<strong>Email:</strong> <?php echo $supplier['email']; ?><br>
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->

	<!-- Table row -->
	<div class="row">
		<div class="col-md-12">
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Details</th>
						<th class="col-md-4">Amount</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Payment to Supplier</td>
						<td class="right col-md-4"><?php echo number_format($details['amount'], 2); ?></td>
					</tr>
				</tbody>
			</table>
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->

	<!-- Table row -->
	<div class="row">
		<div class="col-md-12">
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th class="center">Grand Total</th>
						<th class="right col-md-4">
							<?php if ($this->session->currency_symbol_position == 'Before') { echo $this->session->currency_symbol; } ?> <?php echo number_format($details['amount'], 2); ?> <?php if ($this->session->currency_symbol_position == 'After') { echo $this->session->currency_symbol; } ?>
						</th>
					</tr>
				</thead>
			</table>
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->

	<!-- This row will not appear when printing -->
	<div class="row no-print">
		<div class="col-md-12">
			<a href="accounts/payment-print/<?php echo $details['id']; ?>" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
            <!-- <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
                <i class="fa fa-download"></i> Generate PDF
            </button> -->
        </div>
    </div>
</section>
<!-- /.content -->
<div class="clearfix"></div>