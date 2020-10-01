<?php if ($this->session->flashdata('success')) : ?>
	<div class="alert alert-success alert-dismissible">
		<button class="close" data-dismiss="alert">×</button>
		<strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
	</div>
<?php endif; ?>
<?php if ($this->session->flashdata('info')) : ?>
	<div class="alert alert-info alert-dismissible">
		<button class="close" data-dismiss="alert">×</button>
		<strong>Info!</strong> <?php echo $this->session->flashdata('info'); ?>
	</div>
<?php endif; ?>
<?php if ($this->session->flashdata('error')) : ?>
	<div class="alert alert-danger alert-dismissible">
		<button class="close" data-dismiss="alert">×</button>
		<strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
	</div>
<?php endif; ?>