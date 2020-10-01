<section class="content-header">
	<h1>Reports</h1>
	<ol class="breadcrumb">
		<li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active"> Reports</li>
	</ol>
</section>

<section class="content">
	<?php $this->load->view('flash_message'); ?>

	<div class="row">
		<?php if ($privileges['purchase_report'] == 1) : ?>
			<div class="col-md-6">
				<a href="report/purchase">
					<div class="small-box bg-aqua">
						<div class="inner">
							<h3>Purchase Report</h3>
							<p>&nbsp;</p>
						</div>
						<div class="icon">
							<i class="fa fa-shopping-cart"></i>
						</div>
					</div>
				</a>
			</div>
		<?php endif; ?>
		<?php if ($privileges['purchase_return_report'] == 1) : ?>
			<div class="col-md-6">
				<a href="report/purchase-return">
					<div class="small-box bg-aqua-active">
						<div class="inner">
							<h3>Purchase Return Report</h3>
							<p>&nbsp;</p>
						</div>
						<div class="icon">
							<i class="fa fa-shopping-cart"></i>
							<i class="fa fa-reply"></i>
						</div>
					</div>
				</a>
			</div>
		<?php endif; ?>
		<?php if ($privileges['sales_report'] == 1) : ?>
			<div class="col-md-6">
				<a href="report/sales">
					<div class="small-box bg-purple">
						<div class="inner">
							<h3>Sales Report</h3>
							<p>&nbsp;</p>
						</div>
						<div class="icon">
							<i class="fa fa-calculator"></i>
						</div>
					</div>
				</a>
			</div>
		<?php endif; ?>
		<?php if ($privileges['sales_return_report'] == 1) : ?>
			<div class="col-md-6">
				<a href="report/sales-return">
					<div class="small-box bg-purple-active">
						<div class="inner">
							<h3>Sales Return Report</h3>
							<p>&nbsp;</p>
						</div>
						<div class="icon">
							<i class="fa fa-calculator"></i>
							<i class="fa fa-reply"></i>
						</div>
					</div>
				</a>
			</div>
		<?php endif; ?>
		<?php if ($privileges['inventory_report'] == 1) : ?>
			<div class="col-md-6">
				<a href="report/inventory">
					<div class="small-box bg-yellow">
						<div class="inner">
							<h3>Inventory Report</h3>
							<p>&nbsp;</p>
						</div>
						<div class="icon">
							<i class="fa fa-cubes"></i>
						</div>
					</div>
				</a>
			</div>
		<?php endif; ?>
		<?php if ($privileges['ledger_report'] == 1) : ?>
			<div class="col-md-6">
				<a href="report/ledger">
					<div class="small-box bg-yellow-active">
						<div class="inner">
							<h3>Ledger Report</h3>
							<p>&nbsp;</p>
						</div>
						<div class="icon">
							<i class="fa fa-align-left"></i>
						</div>
					</div>
				</a>
			</div>
		<?php endif; ?>
		<?php if ($privileges['trial_balance_report'] == 1) : ?>
			<div class="col-md-6">
				<a href="report/trial-balance">
					<div class="small-box bg-orange">
						<div class="inner">
							<h3>Trial Balance Report</h3>
							<p>&nbsp;</p>
						</div>
						<div class="icon">
							<i class="fa fa-columns"></i>
						</div>
					</div>
				</a>
			</div>
		<?php endif; ?>
		<?php if ($privileges['balance_sheet_report'] == 1) : ?>
			<div class="col-md-6">
				<a href="report/balance-sheet">
					<div class="small-box bg-orange-active">
						<div class="inner">
							<h3>Balance Sheet Report</h3>
							<p>&nbsp;</p>
						</div>
						<div class="icon">
							<i class="fa fa-balance-scale"></i>
						</div>
					</div>
				</a>
			</div>
		<?php endif; ?>
		<?php if ($privileges['income_statement_report'] == 1) : ?>
			<div class="col-md-6">
				<a href="report/income-statement">
					<div class="small-box bg-green">
						<div class="inner">
							<h3>Income Statement Report</h3>
							<p>&nbsp;</p>
						</div>
						<div class="icon">
							<i class="fa fa-line-chart"></i>
						</div>
					</div>
				</a>
			</div>
		<?php endif; ?>
		<?php if ($privileges['bills_receivable_report'] == 1) : ?>
			<div class="col-md-6">
				<a href="report/bills-receivable">
					<div class="small-box  bg-olive">
						<div class="inner">
							<h3>Bills Receivable Report</h3>
							<p>&nbsp;</p>
						</div>
						<div class="icon">
							<i class="fa fa-sign-in"></i>
						</div>
					</div>
				</a>
			</div>
		<?php endif; ?>
		<?php if ($privileges['bills_payable_report'] == 1) : ?>
			<div class="col-md-6">
				<a href="report/bills-payable">
					<div class="small-box bg-aqua">
						<div class="inner">
							<h3>Bills Payable Report</h3>
							<p>&nbsp;</p>
						</div>
						<div class="icon">
							<i class="fa fa-sign-out"></i>
						</div>
					</div>
				</a>
			</div>
		<?php endif; ?>
		<?php if ($privileges['cash_book_report'] == 1) : ?>
			<div class="col-md-6">
				<a href="report/cash-book">
					<div class="small-box bg-aqua-active">
						<div class="inner">
							<h3>Cash Book Report</h3>
							<p>&nbsp;</p>
						</div>
						<div class="icon">
							<i class="fa fa-dollar"></i>
							<i class="fa fa-book"></i>
						</div>
					</div>
				</a>
			</div>
		<?php endif; ?>
		<?php if ($privileges['bank_book_report'] == 1) : ?>
			<div class="col-md-6">
				<a href="report/bank-book">
					<div class="small-box bg-red-active">
						<div class="inner">
							<h3>Bank Book Report</h3>
							<p>&nbsp;</p>
						</div>
						<div class="icon">
							<i class="fa fa-bank"></i>
							<i class="fa fa-book"></i>
						</div>
					</div>
				</a>
			</div>
		<?php endif; ?>
	</div>
</section>
