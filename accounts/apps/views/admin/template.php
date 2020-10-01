<!DOCTYPE html>
<html>
<!-- BEGIN HEAD -->
<head>
	<?php $this->load->view('admin/head'); ?>
</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<body class="hold-transition skin-blue fixed sidebar-mini">
	<div class="wrapper">
		<!-- BEGIN HEADER -->
		<?php $this->load->view('admin/header'); ?>
		<!-- END HEADER -->

		<!-- BEGIN SIDEBAR -->
		<?php $this->load->view('admin/sidebar'); ?>
		<!-- END SIDEBAR -->

		<!-- BEGIN CONTENT -->
		<div class="content-wrapper">
			<?php $this->load->view($content); ?>
		</div>
		<!-- END CONTENT -->

		<!-- BEGIN FOOTER -->
		<?php $this->load->view('admin/footer'); ?>
		<!-- END FOOTER -->
	</div>
	<!-- BEGIN JAVASCRIPTS -->
	<?php $this->load->view('admin/js'); ?>
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->

</html>