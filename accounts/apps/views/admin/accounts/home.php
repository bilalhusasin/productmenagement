<section class="content-header">
	<h1>Accounts</h1>
	<ol class="breadcrumb">
		<li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active"> Accounts</li>
	</ol>
</section>

<section class="content">
	<?php $this->load->view('flash_message'); ?>

	<div class="row">
		<?php if ($privileges['journal'] == 1) : ?>
			<div class="col-md-6">
				<a href="accounts/journal-list">
					<div class="small-box bg-aqua-active">
						<div class="inner">
							<h3>Journal</h3>
							<p>&nbsp;</p>
						</div>
						<div class="icon">
							<i class="fa fa-columns"></i>
						</div>
					</div>
				</a>
			</div>
		<?php endif; ?>
		<?php if ($privileges['ac_head'] == 1) : ?>
			<div class="col-md-6">
				<a href="accounts/chart-list">
					<div class="small-box bg-purple-active">
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
		<?php if ($privileges['money_receipt'] == 1) : ?>
			<div class="col-md-6">
				<a href="accounts/mr-list">
					<div class="small-box bg-yellow-active">
						<div class="inner">
							<h3>Money Receipt</h3>
							<p>&nbsp;</p>
						</div>
						<div class="icon">
							<i class="fa fa-copy"></i>
						</div>
					</div>
				</a>
			</div>
		<?php endif; ?>
		<?php if ($privileges['payment_receipt'] == 1) : ?>
			<div class="col-md-6">
				<a href="accounts/payment-list">
					<div class="small-box bg-orange-active">
						<div class="inner">
							<h3>Payment Receipt</h3>
							<p>&nbsp;</p>
						</div>
						<div class="icon">
							<i class="fa fa-file-text"></i>
						</div>
					</div>
				</a>
			</div>
		<?php endif; ?>
	</div>
</section>
