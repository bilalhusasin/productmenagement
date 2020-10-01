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
                    <h3 class="page-center">Inventory Report</h3>
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
                                <th>SL #</th>
                                <th>Date</th>
                                <th>Opening Balance</th>
                                <th>Purchase</th>
                                <th>Purchase Return</th>
                                <th>Sales</th>
                                <th>Sales Return</th>
                                <th>Closing Balance</th>
                            </tr>
                        </thead>
                        <?php
                        if (count($reports['inv']) > 0)
                        {
                            $item = array();
                            ?>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($reports['inv'] as $report)
                                {
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td class="left"><?php echo date_to_ui($report['date']); ?></td>
                                        <td class="left">
                                            <?php
                                            foreach ($report['details'] as $details)
                                            {
                                                echo $details['item_name'] . ' : ' . $details['open_qty'] . '<br>';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            foreach ($report['details'] as $details)
                                            {
                                                echo $details['item_name'] . ' : ' . $details['purchase_qty'] . '<br>';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            foreach ($report['details'] as $details)
                                            {
                                                echo $details['item_name'] . ' : ' . $details['purchase_return_qty'] . '<br>';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            foreach ($report['details'] as $details)
                                            {
                                                echo $details['item_name'] . ' : ' . $details['sales_qty'] . '<br>';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            foreach ($report['details'] as $details)
                                            {
                                                echo $details['item_name'] . ' : ' . $details['sales_return_qty'] . '<br>';
                                            }
                                            ?>
                                        </td>
                                        <td class="left">
                                            <?php
                                            foreach ($report['details'] as $details)
                                            {
                                                echo $details['item_name'] . ' : ' . $details['close_qty'] . '<br>';
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td align="center" colspan="8">&nbsp;</td>
                                </tr>
                            </tfoot>
                            <?php
                        }
                        else
                        {
                            ?>
                            <tbody>
                                <tr>
                                    <td align="center" colspan="8">&nbsp;</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td align="center" colspan="8">&nbsp;</td>
                                </tr>
                            </tfoot>
                            <?php
                        }
                        ?>
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