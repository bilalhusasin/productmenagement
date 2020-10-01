<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>H R</h1>
	<ol class="breadcrumb">
		<li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="hr"> H R</a></li>
		<li class="active"> Employee Details</li>
	</ol>
</section>

<!-- Main content -->
<section class="invoice">
	<!-- title row -->
	<div class="row">
		<div class="col-md-12">
			<h2 class="page-header">
				<i class="fa fa-user"></i> <?php echo $emp['name']; ?>
				<small class="pull-right"><strong>Joining:</strong> <?php echo date_to_ui($emp['joining']); ?></small>
			</h2>
		</div>
		<!-- /.col -->
	</div>
	<!-- info row -->
	<div class="row invoice-info">
		<div class="col-md-6 invoice-col">
			<strong>Present Address:</strong>
			<address>
				<?php echo $emp['present_address']; ?>
			</address>
		</div>
		<!-- /.col -->
		<div class="col-md-6 invoice-col">
			<strong>Permanent Address:</strong>
			<address>
				<?php echo $emp['permanent_address']; ?>
			</address>
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->

	<!-- Table row -->
	<div class="row">
		<div class="col-md-12 table-responsive">
			<table class="table table-bordered table-striped">
				<tbody>
					<tr>
						<td class="col-md-3">Father's Name:</td>
						<td class="col-md-9"><?php echo $emp['father_name']; ?></td>
					</tr>
					<tr>
						<td>Mother's Name:</td>
						<td><?php echo $emp['mother_name']; ?></td>
					</tr>
					<!-- <tr>
						<td>Date of Birth:</td>
						<td><?php //echo date_to_ui($emp['dob']); ?></td>
					</tr> -->
					<!-- <tr>
						<td>Voter ID:</td>
						<td><?php //echo $emp['voter_id']; ?></td>
					</tr> -->
					<tr>
						<td>Department:</td>
						<td><?php echo $emp['department']; ?></td>
					</tr>
					<tr>
						<td>Designamtion:</td>
						<td><?php echo $emp['designation']; ?></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><?php echo $emp['email']; ?></td>
					</tr>
					<tr>
						<td>Mobile:</td>
						<td><?php echo $emp['mobile']; ?></td>
					</tr>
					<tr>
						<td>Notes:</td>
						<td><?php echo $emp['notes']; ?></td>
					</tr>
				</tbody>
			</table>
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->


</section>
<!-- /.content -->
<div class="clearfix"></div>