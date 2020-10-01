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

<body>
    <div class="wrapper">
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-md-12">
                    <h2 class="page-header">
                        <img src="<?php echo $this->session->company_logo; ?>" width="115" class="img">
                        <small class="pull-right"><?php echo $this->session->company_name; ?></small>
                    </h2>
                    <h3 class="page-center">Purchase Return Report</h3>
                </div>
                <!-- /.col -->
            </div>

            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-md-6 invoice-col">
                    <strong>Date From:</strong> <?php echo date('jS M, Y ', strtotime(date_to_db($start_date))); ?><br>
                    <strong>Date To:</strong> <?php echo date('jS M, Y ', strtotime(date_to_db($end_date))); ?>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>SL No</th>
                                <th>Purchase Return No</th>
                                <th>Purchase Return Date</th>
                                <th>Item Quantity</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            $quantity = 0;
                            $price = 0;
                            foreach ($purchase as $key => $value)
                            {
                                if ($value['item_quantity'])
                                {
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo $i; ?></td>
                                        <td align="left"><?php echo $value['purchase_return_no']; ?></td>
                                        <td align="center"><?php echo $value['purchase_return_date']; ?></td>
                                        <td align="right"><?php echo number_format($value['item_quantity']); ?></td>
                                        <td align="right"><?php echo number_format($value['total_price'], 2); ?></td>
                                    </tr>
                                    <?php
                                    $quantity += $value['item_quantity'];
                                    $price += $value['total_price'];
                                    $i++;
                                }
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td align="center" colspan="3"><b>Grand Total</b></td>
                                <td align="right"><?php echo number_format($quantity); ?></td>
                                <td align="right"><?php echo number_format($price, 2); ?></td>
                            </tr>
                        </tfoot>
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