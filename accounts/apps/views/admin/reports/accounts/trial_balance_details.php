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
                    <h3 class="page-center">Trial Balance Report</h3>
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
                                <th class="col-md-8">Name of A/C</th>
                                <th class="col-md-2">Debit</th>
                                <th class="col-md-2">Credit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $debit = 0;
                            $credit = 0;
                            foreach ($trial_balance as $balance) :
                                ?>
                                <tr>
                                    <td><?php echo $balance['chart_name']; ?></td>
                                    <td class="right"><?php echo number_format($balance['total_debit'], 2); ?></td>
                                    <td class="right"><?php echo number_format($balance['total_credit'], 2); ?></td>
                                </tr>
                                <?php
                                $debit += $balance['total_debit'];
                                $credit += $balance['total_credit'];
                            endforeach;
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td><b>Total</b></td>
                                <td class="right"><b><?php echo number_format($debit, 2); ?></b></td>
                                <td class="right"><b><?php echo number_format($credit, 2); ?></b></td>
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