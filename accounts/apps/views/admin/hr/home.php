<section class="content-header">
	<h1>H R</h1>
	<ol class="breadcrumb">
		<li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active"> H R</li>
	</ol>
</section>

<section class="content">
	<?php $this->load->view('flash_message'); ?>

	<div class="row">
		<?php if ($privileges['employee'] == 1) : ?>
			<div class="col-md-3">
				<a href="hr/emp-save">
					<div class="small-box bg-aqua">
						<div class="inner">
							<h3>Add New</h3>
							<p>Employee</p>
						</div>
						<div class="icon">
							<i class="fa fa-user"></i>
						</div>
					</div>
				</a>
			</div>
			<div class="col-md-3">
				<a href="hr/emp-list">
					<div class="small-box bg-aqua-active">
						<div class="inner">
							<h3>List All</h3>
							<p>Employee</p>
						</div>
						<div class="icon">
							<i class="fa fa-user"></i>
						</div>
					</div>
				</a>
			</div>
		<?php endif; ?>
	</div>
</section>
