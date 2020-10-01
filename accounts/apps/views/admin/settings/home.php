<section class="content-header">
	<h1>Settings</h1>
	<ol class="breadcrumb">
		<li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active"> Settings</li>
	</ol>
</section>

<section class="content">
	<?php $this->load->view('flash_message'); ?>

	<div class="row">
		<?php if ($privileges['basic_settings'] == 1) : ?>
			<div class="col-md-6">
				<a href="settings/basic">
					<div class="small-box bg-red-active">
						<div class="inner">
							<h3>Basic Settings</h3>
							<p>&nbsp;</p>
						</div>
						<div class="icon">
							<i class="fa fa-cogs"></i>
						</div>
					</div>
				</a>
			</div>
		<?php endif; ?>
		<?php if ($privileges['currency_settings'] == 1) : ?>
			<div class="col-md-6">
				<a href="settings/currency-list">
					<div class="small-box bg-blue-active">
						<div class="inner">
							<h3>Currency</h3>
							<p>&nbsp;</p>
						</div>
						<div class="icon">
							<i class="fa fa-usd"></i>
						</div>
					</div>
				</a>
			</div>
		<?php endif; ?>
	</div>
	<div class="row">
		<?php if ($this->session->user_type == 'Admin') : ?>
			<?php if ($privileges['company_settings'] == 1) : ?>
				<div class="col-md-6">
					<a href="settings/cmp-list">
						<div class="small-box bg-green-active">
							<div class="inner">
								<h3>Company</h3>
								<p>&nbsp;</p>
							</div>
							<div class="icon">
								<i class="fa fa-bank"></i>
							</div>
						</div>
					</a>
				</div>
			<?php endif; ?>
			<?php if ($privileges['default_ac_head_settings'] == 1) : ?>
				<div class="col-md-6">
					<a href="settings/chart-list">
						<div class="small-box bg-orange-active">
							<div class="inner">
								<h3>Default A/C Head</h3>
								<p>&nbsp;</p>
							</div>
							<div class="icon">
								<i class="fa fa-list-ol"></i>
							</div>
						</div>
					</a>
				</div>
			<?php endif; ?>
		<?php endif; ?>
	</div>
</section>
