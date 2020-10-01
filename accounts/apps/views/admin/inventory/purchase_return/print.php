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
                        <small class="pull-right">Date: <?php echo date_to_ui($master[0]['purchase_return_date']); ?></small>
                    </h2>
                    <h3 class="page-center">Purchase Return Invoice</h3>
                </div>
                <!-- /.col -->
            </div>

            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-md-6 invoice-col">
                    <strong>Purchase Return #</strong> <?php echo $master[0]['purchase_return_no']; ?><br>
                    <strong>Date:</strong> <?php echo date_to_ui($master[0]['purchase_return_date']); ?><br>
                    <strong>Notes:</strong> <?php echo $master[0]['notes']; ?><br>
                </div>
                <!-- /.col -->
                <div class="col-md-6 invoice-col">
                    <strong>Supplier Details</strong><br>
                    <address>
                        Name: <?php echo $master[0]['supplier_name']; ?><br>
                        Address: <?php echo $master[0]['supplier_address']; ?><br>
                        Mobile : <?php echo $master[0]['supplier_mobile']; ?><br>
                    </address>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>SL#</th>
                                <th>ITEM DESCRIPTIONS</th>
                                <th class="right">QTY</th>
                                <th class="right">PRICE</th>
                                <th class="right">TOTAL PRICE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $qty = 0;
                            $price = 0;
                            $i = 1;
                            foreach ($details as $detail) {
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $detail['item_name']; ?></td>
                                    <td class="right"><?php echo $detail['quantity']; ?></td>
                                    <td class="right"><?php echo number_format($detail['purchase_price'], 2); ?></td>
                                    <td class="right"><?php echo number_format($detail['quantity']*$detail['purchase_price'], 2); ?></td>
                                </tr>
                                <?php
                                $qty += $detail['quantity'];
                                $price += $detail['quantity']*$detail['purchase_price'];
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped table-hover">
                        <tr>
                            <th colspan="4">Sub - Total:</th>
                            <th>
                                <?php if ($this->session->currency_symbol_position == 'Before') { echo $this->session->currency_symbol; } ?> <?php echo number_format($price, 2); ?> <?php if ($this->session->currency_symbol_position == 'After') { echo $this->session->currency_symbol; } ?>
                            </th>
                        </tr>
                        <tr>
                            <th colspan="4">Grand Total:</th>
                            <th>
                                <?php if ($this->session->currency_symbol_position == 'Before') { echo $this->session->currency_symbol; } ?> <?php echo number_format($price, 2); ?> <?php if ($this->session->currency_symbol_position == 'After') { echo $this->session->currency_symbol; } ?>
                            </th>
                        </tr>
                    </table>
                </div>
            </div>

        </section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->
</body>
</html>
