<section class="content-header">
	<h1><a href="accounts"> Accounts</a></h1>
	<ol class="breadcrumb">
		<li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="accounts"> Accounts</a></li>
		<li class="active"> <?php if (count($master) > 0): ?>Edit<?php else: ?>Add New<?php endif; ?> Journal</li>
	</ol>
</section>

<section class="content">
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title"><?php if (count($master) > 0): ?>Edit<?php else: ?>Add New<?php endif; ?> Journal</h3>

			<div class="box-tools">
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse">
						<i class="fa fa-minus"></i>
					</button>
				</div>
			</div>
		</div>
		<!-- /.box-header -->

		<div class="box-body">
			<form id="frmJournal">
				<div class="col-md-6">
					<div class="form-group">
						<label>Journal No</label>
						<input type="text" name="journal_no" id="journal_no" class="form-control" placeholder="Enter Journal No ..." value="<?php echo $journal_no; ?>">
					</div>
					<div class="form-group">
						<label>Narration</label>
						<textarea name="journal_memo" id="journal_memo" class="form-control" rows="3" placeholder="Narration..."><?php if (count($master) > 0) : echo $master['memo']; else : echo set_value('memo'); endif; ?></textarea>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Journal Date</label>
						<input type="text" name="journal_date" id="journal_date" class="form-control datepicker" value="<?php if (count($master) > 0) : echo $master['journal_date']; else : echo date('d/m/Y'); endif; ?>">
					</div>
				</div>
				<div class="col-md-12">
					<div class="col-md-6">
						<div class="form-group">
							<h3 class="box-header with-border">Debit Voucher</h3>
							<label>Select A/C Head</label>
							<select name="debit_chart_id" id="debit_chart_id" class="form-control select2" data-placeholder="chart_id">
								<?php echo $ac_chart_tree; ?>
							</select>
						</div>
						<div class="form-group">
							<label>Debit Amount</label>
							<input type="text" name="debit_amount" id="debit_amount" class="form-control" placeholder="00.00"value="<?php echo set_value('debit'); ?>" />
						</div>
						<div class="form-group">
							<input type="button" class="btn btn-primary pull-right" name="debit_add" id="debit_add" value="Add Debit">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<h3 class="box-header with-border">Credit Voucher</h3>
							<label>Select A/C Head</label>
							<select name="credit_chart_id" id="credit_chart_id" class="form-control select2" data-placeholder="chart_id">
								<?php echo $ac_chart_tree; ?>
							</select>
						</div>
						<div class="form-group">
							<label>Credit Amount</label>
							<input type="text" name="credit_amount"  class="form-control" id="credit_amount" placeholder="00.00" value="<?php echo set_value('credit'); ?>">
						</div>
						<div class="form-group">
							<input type="button" name="credit_add" id="credit_add" class="btn btn-primary pull-right" value="Add Credit">
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>

<section class="content">
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Voucher List</h3>
			<div class="box-tools">
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse">
						<i class="fa fa-minus"></i>
					</button>
				</div>
			</div>
		</div>
		<!-- /.box-header -->

		<div class="box-body">
			<div class="col-md-6 pull-left">
				<div id="debit_details">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th class="center">Debit A/C Head</th>
								<th class="center">Amount</th>
								<th class="center">Memo</th>
								<th class="center">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$debit_amount = 0;
							foreach ($details as $list) :
								if ($list['debit']) :
									?>
									<tr>
										<td><?php echo $list['chart_name']; ?></td>
										<td class="center"><?php echo $list['debit']; ?></td>
										<td class="center"><?php echo $list['memo']; ?></td>
										<td class="center">
											<input type="hidden" value="<?php echo $list['id']; ?>" /><span class="btn btn-danger debit_voucher_delete"><i class="fa fa-remove"></i> Delete</span>
										</td>
									</tr>
									<?php
									$debit_amount += $list['debit'];
								endif;
							endforeach;
							?>
						</tbody>
						<tfoot>
							<tr>
								<th class="left" colspan="4">&nbsp;</th>
							</tr>
							<tr>
								<th colspan="1">Total </th>
								<th colspan="3" class="right" id="debit_total"><?php echo number_format($debit_amount, 2); ?></th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
			<div class="col-md-6 pull-right">
				<div id="credit_details">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th class="center">Credit A/C Head</th>
								<th class="center">Amount</th>
								<th class="center">Memo</th>
								<th class="center">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$credit_amount = 0;
							foreach ($details as $list) :
								if ($list['credit']) :
									?>
									<tr>
										<td><?php echo $list['chart_name']; ?></td>
										<td class="center"><?php echo $list['credit']; ?></td>
										<td class="center"><?php echo $list['memo']; ?></td>
										<td class="center">
											<input type="hidden" value="<?php echo $list['id']; ?>"><span class="btn btn-danger credit_voucher_delete"><i class="fa fa-remove"></i> Delete</span>
										</td>
									</tr>
									<?php
									$credit_amount += $list['credit'];
								endif;
							endforeach;
							?>
						</tbody>
						<tfoot>
							<tr>
								<th class="left" colspan="4">&nbsp;</th>
							</tr>
							<tr>
								<th colspan="1">Total </th>
								<th colspan="3" class="right" id="credit_total"><?php echo number_format($credit_amount, 2); ?></th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>

		</div>
		<div class="box-footer" align="center">
			<input type="button" id="journal_complete" class="btn btn-success" value="Complete Journal Entry">
		</div>
		<!-- /.box-body -->
	</div>
</section>

<script>
	var journal_draft = false;
	$(window).on('beforeunload', function(){
		if(journal_draft === true)
		{
			return true;
		}
	});
	$(window).on('unload', function() {
		if (journal_draft === true)
		{
			let journal_no = $('#journal_no').val();
			$.ajax({
				type: "POST",
				url: "accounts/delete_unsaved_journal",
				data: {journal_no: journal_no},
				async: false,
				success: function(msg) {
					return true;
				}
			});
		}
	});
</script>
