<section class="content-header">
	<h1>User</h1>
	<ol class="breadcrumb">
		<li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active"> User</li>
	</ol>
</section>

<section class="content">
	<?php $this->load->view('flash_message'); ?>

	<div class="row">
		<?php if ($privileges['user_section'] == 1) : ?>
			<div class="col-md-3">
				<a href="user/save">
					<div class="small-box bg-aqua">
						<div class="inner">
							<h3>Add New</h3>
							<p>User</p>
						</div>
						<div class="icon">
							<i class="fa fa-users"></i>
						</div>
					</div>
				</a>
			</div>
			<div class="col-md-3">
				<a href="user/list-all">
					<div class="small-box bg-aqua-active">
						<div class="inner">
							<h3>List All</h3>
							<p>User</p>
						</div>
						<div class="icon">
							<i class="fa fa-users"></i>
						</div>
					</div>
				</a>
			</div>
		<?php endif; ?>
	</div>
</section>