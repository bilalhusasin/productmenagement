<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title; ?></title>
    <base href="<?php echo base_url(); ?>" />
    <meta charset="utf-8" />
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
                <div class="col-xs-12 col-md-12 col-sm-12">
                    <h2 class="page-header">
                        <?php echo $this->session->company_name; ?>
                        <small class="pull-right">Date: <?php echo date_to_ui($master['journal_date']); ?></small>
                    </h2>
                    <h3 class="page-center">Journal Voucher</h3>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-xs-12 col-md-12 col-sm-12 invoice-col">
                    <strong>Journal #</strong> <?php echo $master['journal_no']; ?><br>
                    <strong>Narration:</strong> <?php echo $master['memo']; ?><br>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <?php
                $d = 0;
                $c = 0;
                foreach ($details as $list) {
                    if ($list['debit']) {
                        $d++;
                    } else {
                        $c++;
                    }
                }
                ?>
                <div class="col-xs-6 col-md-6 col-sm-6">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Debit A/C Head</th>
                                <th class="col-xs-4 col-md-4 col-sm-4">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $debit_amount = 0;
                            foreach ($details as $list) {
                                if ($list['debit']) {
                                    ?>
                                    <tr>
                                        <td><?php echo $list['chart_name']; ?></td>
                                        <td class="right col-xs-4 col-md-4 col-sm-4"><?php echo number_format($list['debit'], 2); ?></td>
                                    </tr>
                                    <?php
                                    $debit_amount += $list['debit'];
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->

                <div class="col-xs-6 col-md-6 col-sm-6">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Credit A/C Head</th>
                                <th class="col-xs-4 col-md-4 col-sm-4">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $credit_amount = 0;
                            foreach ($details as $list) {
                                if ($list['credit']) {
                                    ?>
                                    <tr>
                                        <td><?php echo $list['chart_name']; ?></td>
                                        <td class="right col-xs-4 col-md-4 col-sm-4"><?php echo number_format($list['credit'], 2); ?></td>
                                    </tr>
                                    <?php
                                    $credit_amount += $list['credit'];
                                }
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
                <div class="col-xs-6 col-md-6 col-sm-6">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="center">Total</th>
                                <th class="right col-xs-4 col-md-4 col-sm-4"><?php echo number_format($debit_amount, 2); ?></th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!-- /.col -->

                <div class="col-xs-6 col-md-6 col-sm-6">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="center">Total</th>
                                <th class="right col-xs-4 col-md-4 col-sm-4"><?php echo number_format($credit_amount, 2); ?></th>
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
