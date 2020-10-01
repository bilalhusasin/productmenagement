$(document).ready(function() {
	/** Custom JS */

	/** Add sales item */
	$(document).on('click', '#sales_add_item', function(event) {
		var sales_no = $('#sales_no').val();
		var sales_date = $('#sales_date').val();
		var customer_id = $('#customer_id').val();
		var item_id = $('#item_id').val();
		var quantity = $('#quantity').val();
		var price = $('#price').val();
		var notes = $('#notes').val();

		if ( ! sales_no) {
			alert('Please give a sales no.');
			return false;
		}
		if ( ! item_id) {
			alert('Please select an Item.');
			return false;
		}
		if ( ! customer_id) {
			alert('Please select a Customer.');
			return false;
		}
		if ( ! quantity) {
			alert('Quantity must be greated than zero.');
			return false;
		}

		$.ajax({
			type: "POST",
			url: "inventory/sales_save",
			data: {sales_no: sales_no, sales_date: sales_date, customer_id: customer_id, item_id: item_id, quantity: quantity, price: price, notes: notes},
			success: function(msg) {
				sales_draft = true;
				if (msg == "invalid") {
					alert("Not enough stock for sale!");
				} else {
					$("#sales_details").children().remove();
					$("#sales_details").html(msg);
					$("#data_table").dataTable();
				}
			}
		});
		$('#sales_no').attr('disabled', true);
		$('#sales_date').attr('disabled', true);
		$('#customer_id').prop('disabled', true);
		$('#quantity').val('');
		$('#price').val('');
		$('#quantity').focus();
	});

	/** Delete sales item */
	$(document).on('click', '.sales_item_delete', function(event) {
		if ( ! confirm("Are you sure you want to delete this item?")) {
			return false;
		}
		var sales_no = $('#sales_no').val();
		var item_id = $(this).prev().val();
		$.ajax({
			type: "POST",
			url: "inventory/sales_item_delete",
			data: {sales_no: sales_no, item_id: item_id},
			success: function(msg) {
				$("#sales_details").children().remove();
				$("#sales_details").html(msg);
				$("#data_table").dataTable();
			}
		});
	});

	/** Calculate discounted amount */
	$(document).on('keyup', '#discount', function(event) {
		var discount = $('#discount').val();
		var paid_amount = $('#paid_amount').attr('data-org-amount');
		var new_paid_amount = paid_amount;
		if (discount == 0) {

		}
		new_paid_amount = paid_amount - discount;
		$('#paid_amount').val(new_paid_amount);
	});

	/** Complete sales */
	$(document).on('click', '#sales_complete', function(event) {
		sales_draft = false;
		var sales_no = $('#sales_no').val();
		var paid_amount = $('#paid_amount').val();
		// var discount = $('#discount').val();
		var customer_id = $('#customer_id').val();
		var emp_id = $('#emp_id').val();
		var sales_date = $('#sales_date').val();
		var notes = $('#notes').val();
		$.ajax({
			type: "POST",
			url: "inventory/sales_complete",
			data: {sales_no: sales_no, paid_amount: paid_amount, sales_date: sales_date, customer_id: customer_id, emp_id: emp_id, notes: notes},
			success: function(msg) {
				event.preventDefault();
				window.location.replace(msg);
			}
		});
	});

	/** Add sales return item */
	$(document).on('click', '#sales_return_add_item', function(event) {
		var sales_return_no = $('#sales_return_no').val();
		var sales_return_date = $('#sales_return_date').val();
		var customer_id = $('#customer_id').val();
		var item_id = $('#item_id').val();
		var quantity = $('#quantity').val();
		var price = $('#price').val();
		var notes = $('#notes').val();
		if( ! sales_return_no) {
			alert('Please give a sales return no.');
			return false;
		}
		if( ! item_id) {
			alert('Please select an Item.');
			return false;
		}
		if( ! customer_id) {
			alert('Please select a Customer.');
			return false;
		}
		if( ! quantity) {
			alert('Quantity must be greated than zero.');
			return false;
		}

		$.ajax({
			type: "POST",
			url: "inventory/sales_return_save",
			data: {sales_return_no: sales_return_no, sales_return_date: sales_return_date, customer_id: customer_id, item_id: item_id, quantity: quantity, price: price, notes: notes},
			success: function(msg) {
				sales_return_draft = true;
				if (msg == "invalid") {
					alert("Return quantity can't be more than sold quantity!");
				} else {
					$("#sales_return_details").children().remove();
					$("#sales_return_details").html(msg);
					$("#data_table").dataTable();
				}

			}
		});
		$('#sales_return_no').attr('disabled', true);
		$('#sales_return_date').attr('disabled', true);
		$('#quantity').val('');
		$('#price').val('');
		$('#quantity').focus();
	});

	/** Delete sales return item */
	$(document).on('click', '.sales_return_item_delete', function(event) {
		if ( ! confirm("Are you sure you want to delete this item?")) {
			return false;
		}
		var sales_return_no = $('#sales_return_no').val();
		var item_id = $(this).prev().val();
		$.ajax({
			type: "POST",
			url: "inventory/sales_return_item_delete",
			data: {sales_return_no: sales_return_no, item_id: item_id},
			success: function(msg) {
				$("#sales_return_details").children().remove();
				$("#sales_return_details").html(msg);
				$("#data_table").dataTable();
			}
		});
	});

	/** Complete sales return */
	$(document).on('click', '#sales_return_complete', function(event) {
		sales_return_draft = false;
		var sales_return_no = $('#sales_return_no').val();
		var paid_amount = $('#paid_amount').val();
		var customer_id = $('#customer_id').val();
		var emp_id = $('#emp_id').val();
		var sales_return_date = $('#sales_return_date').val();
		var notes = $('#notes').val();
		$.ajax({
			type: "POST",
			url: "inventory/sales_return_complete",
			data: {sales_return_no: sales_return_no, paid_amount: paid_amount, sales_return_date: sales_return_date, customer_id: customer_id, emp_id: emp_id, notes: notes},
			success: function(msg) {
				window.location.replace(msg);
			}
		});
	});

	/** Add purchase item */
	$(document).on('click', '#purchase_add_item', function(event) {
		var purchase_no = $('#purchase_no').val();
		var purchase_date = $('#purchase_date').val();
		var supplier_id = $('#supplier_id').val();
		var item_id = $('#item_id').val();
		var quantity = $('#quantity').val();
		var price = $('#price').val();
		var notes = $('#notes').val();
		if ( ! purchase_no) {
			alert('Please give a purchase no.');
			return false;
		}
		if ( ! item_id) {
			alert('Please select an Item.');
			return false;
		}
		if ( ! price) {
			alert('Please give Item price.');
			return false;
		}
		if ( ! supplier_id) {
			alert('Please select a supplier.');
			return false;
		}
		if ( ! quantity) {
			alert('Quantity must be greated than zero.');
			return false;
		}
		$.ajax({
			type: "POST",
			url: "inventory/purchase_save",
			data: {purchase_no: purchase_no, purchase_date: purchase_date, supplier_id: supplier_id, item_id: item_id, quantity: quantity, price: price, notes: notes},
			success: function(msg) {
				purchase_draft = true;
				$("#purchase_details").children().remove();
				$("#purchase_details").html(msg);
				$("#data_table").dataTable();
			}
		});
		$('#purchase_no').attr('disabled', true);
		$('#purchase_date').attr('disabled', true);
		$('#supplier_id').prop('disabled', true);
		$('#quantity').val('');
		$('#price').val('');
		$('#quantity').focus();
	});

	/** Delete purchase item */
	$(document).on('click', '.purchase_item_delete', function(event) {
		if ( ! confirm("Are you sure you want to delete this item?")) {
			return false;
		}
		var purchase_no = $('#purchase_no').val();
		var item_id = $(this).prev().val();
		$.ajax({
			type: "POST",
			url: "inventory/purchase_item_delete",
			data: {purchase_no: purchase_no, item_id: item_id},
			success: function(msg) {
				$("#purchase_details").children().remove();
				$("#purchase_details").html(msg);
				$("#data_table").dataTable();
			}
		});
	});

	/** Complete purchase */
	$(document).on('click', '#purchase_complete', function(event) {
		purchase_draft = false;
		var purchase_no = $('#purchase_no').val();
		var paid_amount = $('#paid_amount').val();
		var supplier_id = $('#supplier_id').val();
		var purchase_date = $('#purchase_date').val();
		var notes = $('#notes').val();
		$.ajax({
			type: "POST",
			url: "inventory/purchase_complete",
			data: {purchase_no: purchase_no, paid_amount: paid_amount, purchase_date: purchase_date, supplier_id: supplier_id, notes: notes},
			success: function(msg) {
				window.location.replace(msg);
			}
		});
	});

	/** Add purchase return item */
	$(document).on('click', '#purchase_return_add_item', function(event) {
		var purchase_return_no = $('#purchase_return_no').val();
		var purchase_return_date = $('#purchase_return_date').val();
		var supplier_id = $('#supplier_id').val();
		var item_id = $('#item_id').val();
		var quantity = $('#quantity').val();
		var price = $('#price').val();
		var notes = $('#notes').val();
		if( ! purchase_return_no) {
			alert('Please give a purchase return no.');
			return false;
		}
		if( ! item_id) {
			alert('Please select an Item.');
			return false;
		}
		if( ! supplier_id) {
			alert('Please select a supplier.');
			return false;
		}
		if( ! quantity) {
			alert('Quantity can not be empty.');
			return false;
		}
		if( ! price) {
			alert('Price can not be empty.');
			return false;
		}
		$.ajax({
			type: "POST",
			url: "inventory/purchase_return_save",
			data: {purchase_return_no: purchase_return_no, purchase_return_date: purchase_return_date, supplier_id: supplier_id, item_id: item_id, quantity: quantity, price: price, notes: notes},
			success: function(msg) {
				purchase_return_draft = true;
				if (msg == "invalid") {
					alert("Return quantity can't be more than purchase quantity!");
				} else {
					$("#purchase_return_details").children().remove();
					$("#purchase_return_details").html(msg);
					$("#data_table").dataTable();
				}
			}
		});
		$('#purchase_return_no').attr('disabled', true);
		$('#purchase_return_date').attr('disabled', true);
		$('#quantity').val('');
		$('#price').val('');
		$('#quantity').focus();
	});

	/** Delete purchase return item */
	$(document).on('click', '.purchase_return_item_delete', function(event) {
		if ( ! confirm("Are you sure you want to delete this item?")) {
			return false;
		}
		var purchase_return_no = $('#purchase_return_no').val();
		var item_id = $(this).prev().val();
		$.ajax({
			type: "POST",
			url: "inventory/purchase_return_item_delete",
			data: {purchase_return_no: purchase_return_no, item_id: item_id},
			success: function(msg) {
				$("#purchase_return_details").children().remove();
				$("#purchase_return_details").html(msg);
				$("#data_table").dataTable();
			}
		});
	});

	/** Complete purchase return */
	$(document).on('click', '#purchase_return_complete', function(event) {
		purchase_return_draft = false;
		var purchase_return_no = $('#purchase_return_no').val();
		var paid_amount = $('#paid_amount').val();
		var supplier_id = $('#supplier_id').val();
		var purchase_return_date = $('#purchase_return_date').val();
		var notes = $('#notes').val();
		$.ajax({
			type: "POST",
			url: "inventory/purchase_return_complete",
			data: {purchase_return_no: purchase_return_no, paid_amount: paid_amount, purchase_return_date: purchase_return_date, supplier_id: supplier_id, notes: notes},
			success: function(msg) {
				window.location.replace(msg);
			}
		});
	});

	/** Add debit voucher */
	$(document).on('click', '#debit_add', function(event) {
		var journal_no = $('#journal_no').val();
		var journal_date = $('#journal_date').val();
		var journal_memo = $('#journal_memo').val();

		var debit_chart_id = $('#debit_chart_id').val();
		var debit_amount = $('#debit_amount').val();
		var debit_memo = $('#debit_memo').val();

		$.ajax({
			type: "POST",
			url: "accounts/debit_add",
			data: {journal_no: journal_no, journal_date: journal_date, journal_memo: journal_memo, debit_chart_id: debit_chart_id, debit_amount: debit_amount, debit_memo: debit_memo},
			success: function(msg) {
				journal_draft = true;
				$("#debit_details").children().remove();
				$("#debit_details").html(msg);
				var str = $('#debit_total').text();
				var total_debit = str.replace(",", "");
				$('#credit_amount').val(total_debit);
			}
		});
		$('#journal_no').attr('disabled', true);
		$('#journal_date').attr('disabled', true);
		$('#debit_amount').val('');
		$('#debit_memo').val('');
		$('#debit_amount').focus();
	});

	/** Add credit voucher */
	$(document).on('click', '#credit_add', function(event) {
		var journal_no = $('#journal_no').val();
		var journal_date = $('#journal_date').val();
		var journal_memo = $('#journal_memo').val();

		var credit_chart_id = $('#credit_chart_id').val();
		var credit_amount = $('#credit_amount').val();
		var credit_memo = $('#credit_memo').val();

		$.ajax({
			type: "POST",
			url: "accounts/credit_add",
			data: {journal_no: journal_no, journal_date: journal_date, journal_memo: journal_memo, credit_chart_id: credit_chart_id, credit_amount: credit_amount, credit_memo: credit_memo},
			success: function(msg) {
				journal_draft = true;
				$("#credit_details").children().remove();
				$("#credit_details").html(msg);
				var debit = $('#debit_total').text();
				var total_debit = debit.replace(",", "");
				var credit = $('#credit_total').text();
				var total_credit = credit.replace(",", "");
				var rest_credit = total_debit - total_credit;
				$('#credit_amount').val(rest_credit);
			}
		});
		$('#journal_no').attr('disabled', true);
		$('#journal_date').attr('disabled', true);
		$('#credit_amount').val('');
		$('#credit_memo').val('');
		$('#credit_amount').focus();
	});

	/** Delete debit voucher */
	$(document).on('click', '.debit_voucher_delete', function(event) {
		if (confirm("Are you sure you want to delete this item?")) {
			var journal_no = $('#journal_no').val();
			var voucher_id = $(this).prev().val();
			$.ajax({
				type: "POST",
				url: "accounts/delete_voucher/debit",
				data: {journal_no: journal_no, voucher_id: voucher_id},
				success: function(msg) {
					journal_draft = true;
					$("#debit_details").children().remove();
					$("#debit_details").html(msg);
				}
			});
		}
	});

	/** Delete credit voucher */
	$(document).on('click', '.credit_voucher_delete', function(event) {
		if (confirm("Are you sure you want to delete this item?")) {
			var journal_no = $('#journal_no').val();
			var voucher_id = $(this).prev().val();
			$.ajax({
				type: "POST",
				url: "accounts/delete_voucher/credit",
				data: {journal_no: journal_no, voucher_id: voucher_id},
				success: function(msg) {
					journal_draft = true;
					$("#credit_details").children().remove();
					$("#credit_details").html(msg);
				}
			});
		}
	});

	/** Complete Journal */
	$(document).on('click', '#journal_complete', function(event) {
		journal_draft = false;
		var debit_total = $('#debit_total').text();
		var debit = Number(debit_total.replace(/[^0-9\.]+/g, ""));
		var credit_total = $('#credit_total').text();
		var credit = Number(credit_total.replace(/[^0-9\.]+/g, ""));
		var balance;
		if (debit !== credit) {
			if (debit > credit) {
				balance = debit - credit;
				alert('Credit voucher still need ' + balance + ' amount.');
				$("#credit_amount").focus();
			} else {
				balance = credit - debit;
				alert('Debit voucher still need ' + balance + ' amount.');
				$("#debit_amount").focus();
			}
			return false;
		}
		var journal_no = $('#journal_no').val();
		var journal_date = $('#journal_date').val();
		var journal_memo = $('#journal_memo').val();
		$.ajax({
			type: "POST",
			url: "accounts/journal_complete",
			data: {journal_no: journal_no, journal_date: journal_date, journal_memo: journal_memo},
			success: function(msg) {
				window.location.replace(msg);
			}
		});
	});

	/** Add Supplier from Purchase */
	$(document).on('click', '#add_supplier', function(event) {
		var code = $('#code').val();
		var name = $('#name').val();
		var address = $('#address').val();
		var contact_person = $('#contact_person').val();
		var phone_no = $('#phone_no').val();
		var notes = $('#notes').val();
		var status = 'Active';
		if (name == "") {
			var nameField = document.getElementById('name');
			nameField.insertAdjacentHTML('afterend', '<span class="help-block">Supplier name required</span>');
			nameField.closest('.form-group').classList.add('has-error');
			nameField.focus();
			return false;
		}

		$.ajax({
			type: "POST",
			url: "inventory/add_new_supplier",
			data: {code: code, name: name, address: address, contact_person: contact_person, phone_no: phone_no, notes: notes, status: status},
			success: function(msg) {
				$("#supplier_id").select2("destroy");
				$("#supplier_id option").remove();
				$("#supplier_id").append(msg);
				$("#supplier_id").select2();
			}
		});
		$('#modal-supplier').modal('hide');
	});

	/** Add Customer from Sales */
	$(document).on('click', '#add_customer', function(event) {
		var code = $('#code').val();
		var name = $('#name').val();
		var address = $('#address').val();
		var mobile = $('#mobile').val();
		var country = $('#country').val();
		var email = $('#email').val();
		var notes = $('#notes').val();
		var status = $('#status').val();
		if (name == "") {
			var nameField = document.getElementById('name');
			nameField.insertAdjacentHTML('afterend', '<span class="help-block">Customer name required</span>');
			nameField.closest('.form-group').classList.add('has-error');
			nameField.focus();
			return false;
		}

		$.ajax({
			type: "POST",
			url: "inventory/add_new_customer",
			data: {code: code, name: name, address: address, mobile: mobile, country: country, email: email, notes: notes, status: status},
			success: function(msg) {
				$("#customer_id").select2("destroy");
				$("#customer_id option").remove();
				$("#customer_id").append(msg);
				$("#customer_id").select2();
			}
		});
		$('#modal-customer').modal('hide');
	});

	/** Datatable */
	$('#data_table').DataTable({
		responsive: true
	});

	/** Datatable DESC by first column */
	$('#data_table_desc').DataTable({
		responsive: true,
		"order": [[ 0, "desc" ]]
	});

	/** Initialize Select2 Elements */
	$('.select2').select2({
		theme: "bootstrap",
		width: 'auto',
	});

	/** Chagne item price as per select from dropdown */
	$('#item_id.change-price').on('select2:select', function (e) {
		var select_data = e.params.data;
		// console.log(select_data.id);
		$.ajax({
			type: "POST",
			url: "inventory/get_item_price",
			data: {id: select_data.id},
			success: function(msg) {
				$("#price").val(msg);
			}
		});
	});

	/** Datemask dd/mm/yyyy */
	// $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
	/** Datemask2 mm/dd/yyyy */
	// $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
	/** Make date mask as per data-inputmask */
	//$('[data-mask]').inputmask()
	/** Datepicker */
	$('[data-form=datepicker]').datepicker({autoclose: true, format: 'dd/mm/yyyy'});
	/** Datepicker */
	$('.datepicker').datepicker({autoclose: true, format: 'dd/mm/yyyy'});
});

/** Delete confirmation */
$(".del").click(function() {
	if ( ! confirm("Are you sure you want to delete this item?")) {
		return false;
	}
});