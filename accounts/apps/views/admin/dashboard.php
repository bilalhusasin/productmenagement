<section class="content-header">
	<h1>Dashboard</h1>
	<ol class="breadcrumb">
		<li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
	</ol>
</section>

<section class="content">
	<div class="row">
		<?php if ($privileges['sales'] == 1) : ?>
			<div class="col-md-6">
				<!-- small box -->
				<a href="inventory/sales-list">
					<div class="small-box bg-aqua">
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
		<?php if ($privileges['customer'] == 1) : ?>
			<div class="col-md-6">
				<!-- small box -->
				<a href="inventory/customer-list">
					<div class="small-box bg-green">
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
		<?php if ($privileges['purchase'] == 1) : ?>
			<div class="col-md-6">
				<!-- small box -->
				<a href="inventory/purchase-list">
					<div class="small-box bg-yellow">
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
		<?php if ($privileges['supplier'] == 1) : ?>
			<div class="col-md-6">
				<!-- small box -->
				<a href="inventory/supplier-list">
					<div class="small-box bg-fuchsia">
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
				<!-- small box -->
				<a href="inventory/item-list">
					<div class="small-box bg-blue">
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
		<?php if ($privileges['employee'] == 1) : ?>
			<div class="col-md-6">
				<!-- small box -->
				<a href="hr/emp-list">
					<div class="small-box bg-maroon">
						<div class="inner">
							<h3>Employee</h3>
							<p>&nbsp;</p>
						</div>
						<div class="icon">
							<i class="fa fa-user"></i>
						</div>
					</div>
				</a>
			</div>
		<?php endif; ?>
		<?php if ($privileges['ac_head'] == 1) : ?>
			<div class="col-md-6">
				<!-- small box -->
				<a href="accounts/chart-list">
					<div class="small-box bg-red-active">
						<div class="inner">
							<h3>A/C Head</h3>
							<p>&nbsp;</p>
						</div>
						<div class="icon">
							<i class="fa fa-list-ol"></i>
						</div>
					</div>
				</a>
			</div>
		<?php endif; ?>
		<?php if ($privileges['journal'] == 1) : ?>
			<div class="col-md-6">
				<!-- small box -->
				<a href="accounts/journal-list">
					<div class="small-box bg-olive">
						<div class="inner">
							<h3>Journal</h3>
							<p>&nbsp;</p>
						</div>
						<div class="icon">
							<i class="fa fa-edit"></i>
						</div>
					</div>
				</a>
			</div>
		<?php endif; ?>
		<?php if ($privileges['user_section'] == 1) : ?>
			<div class="col-md-6">
				<!-- small box -->
				<a href="user/list-all">
					<div class="small-box bg-orange">
						<div class="inner">
							<h3>User</h3>
							<p>&nbsp;</p>
						</div>
						<div class="icon">
							<i class="fa fa-users"></i>
						</div>
					</div>
				</a>
			</div>
		<?php endif; ?>
		<?php if ($privileges['report_menu'] == 1) : ?>
			<div class="col-md-6">
				<!-- small box -->
				<a href="report">
					<div class="small-box bg-light-blue">
						<div class="inner">
							<h3>Reports</h3>
							<p>&nbsp;</p>
						</div>
						<div class="icon">
							<i class="fa fa-folder-open"></i>
						</div>
					</div>
				</a>
			</div>
		<?php endif; ?>
	</div>
</section>


