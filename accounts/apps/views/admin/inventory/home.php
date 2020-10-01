<section class="content-header">
	<h1>Inventory</h1>
	<ol class="breadcrumb">
		<li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active"> Inventory</li>
	</ol>
</section>

<section class="content">
	<?php $this->load->view('flash_message'); ?>

	<div class="row">
		<?php if ($privileges['sales'] == 1) : ?>
			<div class="col-md-6">
				<a href="inventory/sales-list">
					<div class="small-box bg-aqua-active">
						<div class="inner">
							<h3>Sales</h3>
							<p>&nbsp;</p>
						</div>
						<div class="icon">
							<i class="fa fa-calculator"></i>
						</div>
					</div>
				</a>
			</div>
		<?php endif; ?>
		<?php if ($privileges['sales_return'] == 1) : ?>
			<div class="col-md-6">
				<a href="inventory/sales-return-list">
					<div class="small-box bg-blue-active">
						<div class="inner">
							<h3>Sales Return</h3>
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
		<?php if ($privileges['purchase'] == 1) : ?>
			<div class="col-md-6">
				<a href="inventory/purchase-list">
					<div class="small-box bg-yellow-active">
						<div class="inner">
							<h3>Purchase</h3>
							<p>&nbsp;</p>
						</div>
						<div class="icon">
							<i class="fa fa-shopping-cart"></i>
						</div>
					</div>
				</a>
			</div>
		<?php endif; ?>
		<?php if ($privileges['purchase_return'] == 1) : ?>
			<div class="col-md-6">
				<a href="inventory/purchase-return-list">
					<div class="small-box bg-orange-active">
						<div class="inner">
							<h3>Purchase Return</h3>
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
		<?php if ($privileges['customer'] == 1) : ?>
			<div class="col-md-6">
				<a href="inventory/customer-list">
					<div class="small-box bg-green-active">
						<div class="inner">
							<h3>Customer</h3>
							<p>&nbsp;</p>
						</div>
						<div class="icon">
							<i class="fa fa-child"></i>
						</div>
					</div>
				</a>
			</div>
		<?php endif; ?>
		<?php if ($privileges['supplier'] == 1) : ?>
			<div class="col-md-6">
				<a href="inventory/supplier-list">
					<div class="small-box bg-olive-active">
						<div class="inner">
							<h3>Supplier</h3>
							<p>&nbsp;</p>
						</div>
						<div class="icon">
							<i class="fa fa-truck"></i>
						</div>
					</div>
				</a>
			</div>
		<?php endif; ?>
		<?php if ($privileges['item'] == 1) : ?>
			<div class="col-md-6">
				<a href="inventory/item-list">
					<div class="small-box bg-purple-active">
						<div class="inner">
							<h3>Item</h3>
							<p>&nbsp;</p>
						</div>
						<div class="icon">
							<i class="fa fa-tags"></i>
						</div>
					</div>
				</a>
			</div>
		<?php endif; ?>
	</div>
</section>
