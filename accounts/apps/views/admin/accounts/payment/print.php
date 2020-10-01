<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title; ?></title>
    <base href="<?php echo base_url(); ?>">
    <meta charset="utf-8">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="assets/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/adminlte/dist/css/AdminLTE.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body onload="window.print();">
    <div class="wrapper">
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-md-12">
                    <h2 class="page-header">
                        <?php echo $this->session->company_name; ?>
                        <small class="pull-right">Date: <?php echo date_to_ui($details['payment_date']); ?></small>
                    </h2>
                    <h3 class="page-center">Payment Receipt</h3>
                </div>
                <!-- /.col -->
            </div>

            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-md-6 invoice-col">
                    <strong>Payment Receipt #</strong> <?php echo $details['payment_no']; ?><br>
                    <strong>Date:</strong> <?php echo date_to_ui($details['payment_date']); ?><br>
                    <strong>Memo:</strong> <?php echo $details['memo']; ?><br>
                    <strong>Ref. Employee:</strong> <?php if (count($emp) > 0) { echo $emp['name']; } ?><br>
                </div>
                <!-- /.col -->
                <div class="col-md-6 invoice-col">
                    <strong>Supplier Details</strong><br>
                    <strong>Name:</strong> <?php echo $supplier['name']; ?><br>
                    <strong>Address:</strong> <?php echo $supplier['address']; ?><br>
                    <strong>Phone #:</strong> <?php echo $supplier['phone_no']; ?><br>
                    <strong>Email:</strong> <?php echo $supplier['email']; ?><br>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Details</th>
                                <th class="col-md-4">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Payment to Supplier</td>
                                <td class="right col-md-4"><?php echo number_format($details['amount'], 2); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="center">Grand Total</th>
                                <th class="right col-md-4">
                                    <?php if ($this->session->currency_symbol_position == 'Before') { echo $this->session->currency_symbol; } ?> <?php echo number_format($details['amount'], 2); ?> <?php if ($this->session->currency_symbol_position == 'After') { echo $this->session->currency_symbol; } ?>
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->
</body>
</html>
