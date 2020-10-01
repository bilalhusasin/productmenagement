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
                    <h3 class="page-center">Bank Book</h3>
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
                                <th class="col-md-2">Journal Date</th>
                                <th class="center col-md-2">Journal No.</th>
                                <th class="center col-md-3">Name of A/C</th>
                                <th class="col-md-3">Transaction By/To</th>
                                <th class="center col-md-2">Debit</th>
                                <th class="center col-md-2">Credit</th>
                                <!--<th class="center">Balance</th>-->
                            </tr>
                        </thead>
                        <?php
                        $debit = 0;
                        $credit = 0;
                        foreach ($previous as $pre)
                        {
                            $debit += $pre['debit'];
                            $credit += $pre['credit'];
                        }
                        if ($opening_sum['opening'] > 0)
                        {
                            $debit += $opening_sum['opening'];
                        }
                        else
                        {
                            $credit += $opening_sum['opening'];
                        }
                        $opening = $debit - $credit;
                        ?>
                        <tbody>
                            <tr style="font-size: 16px; font-weight: bold;">
                                <td colspan="4">Balance Forwarded</td>
                                <td colspan="2" class="right"><?php echo number_format(($debit - $credit), 2); ?></td>
                            </tr>
                            <?php foreach ($charts as $chart) : ?>
                                <tr>
                                    <td><?php echo date('jS M, Y ', strtotime($chart['journal_date'])); ?></td>
                                    <td class="center"><b><a href="accounts/journal_preview/<?php echo $chart['journal_id']; ?>" target="_blank"><?php echo $chart['journal_no']; ?></a></b></td>
                                    <td><?php echo $chart['chart_name']; ?></td>
                                    <td><?php echo $chart['ref_journal']; ?></td>
                                    <td class="right"><?php echo number_format($chart['debit'], 2); ?></td>
                                    <td class="right"><?php echo number_format($chart['credit'], 2); ?></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td colspan="5"><?php echo $chart['master_memo']; ?></td>
                                </tr>
                                <?php
                                $debit += $chart['debit'];
                                $credit += $chart['credit'];
                                ?>
                            <?php endforeach; ?>
                        </tbody>
                        <?php $closing = ($debit - $credit); ?>
                        <tfoot>
                            <tr style="font-size: 16px; font-weight: bold;">
                                <td colspan="4"> Closing Balance</td>
                                <td colspan="2" class="right">
                                    <?php
                                    if ($closing > 0)
                                    {
                                        echo number_format($closing, 2) . ' Dr';
                                    }
                                    else
                                    {
                                        echo number_format(abs($closing), 2) . ' Cr';
                                    }
                                    ?>
                                </td>
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