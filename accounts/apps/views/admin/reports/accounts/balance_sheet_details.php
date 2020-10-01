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

    <link href="assets/plugin/treetable/css/jquery.treetable.css" rel="stylesheet" type="text/css" />

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
                    <h3 class="page-center">Balance Sheet</h3>
                </div>
                <!-- /.col -->
            </div>

            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-md-6 invoice-col">
                    <strong>Closing Date:</strong> <?php echo date('jS M, Y ', strtotime(date_to_db($closing_date))); ?><br>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="invoice-table">
                        <table id="treetable1" class="table table-striped table-bordered bootstrap-datatable datatable">
                            <thead>
                                <tr>
                                    <th colspan="4" class="left">Assets</th>
                                </tr>
                                <tr>
                                    <th class="col-md-6">Name of A/C</th>
                                    <th class="center col-md-2">Debit</th>
                                    <th class="center col-md-2">Credit</th>
                                    <th class="center col-md-2">Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $net = 0;
                                $balance = 0;
                                $debit = 0;
                                $credit = 0;
                                foreach ($assets as $a1) {
                                            //print_r($a1);
                                    $aa[] = $a1;
                                    $debit = sum_subarrays_by_key($aa, "debit");
                                    $credit = sum_subarrays_by_key($aa, "credit");
                                    $balance = $debit - $credit;
                                    $net += $balance;
                                    if($balance > 0){
                                        $pre = 'Dr';
                                    } elseif($balance == 0) {
                                        $pre = ' ';
                                    }else{
                                        $pre = 'Cr';
                                    }
                                    ?>
                                    <tr data-tt-id="<?php echo $a1['id']; ?>">
                                        <td><?php echo $a1['name']; ?></td>
                                        <td class="right"><?php echo number_format($debit, 2); ?></td>
                                        <td class="right"><?php echo number_format($credit, 2); ?></td>
                                        <td class="right"><?php echo number_format(abs($balance), 2) . ' ' . $pre; ?></td>
                                    </tr>
                                    <?php
                                    $balance = 0;
                                    $debit = 0;
                                    $credit = 0;
                                    unset($aa);
                                    if (isset($a1['child'])) {
                                        foreach ($a1['child'] as $a2) {
                                            $bb[] = $a2;
                                            $debit = sum_subarrays_by_key($bb, "debit");
                                            $credit = sum_subarrays_by_key($bb, "credit");
                                            $balance = $debit - $credit;
                                            if($balance > 0){
                                                $pre = 'Dr';
                                            } elseif($balance == 0) {
                                                $pre = ' ';
                                            }else{
                                                $pre = 'Cr';
                                            }
                                            ?>
                                            <tr data-tt-id="<?php echo $a2['id']; ?>" data-tt-parent-id="<?php echo $a1['id']; ?>">
                                                <td><?php echo $a2['name']; ?></td>
                                                <td class="right"><?php echo number_format($debit, 2); ?></td>
                                                <td class="right"><?php echo number_format($credit, 2); ?></td>
                                                <td class="right"><?php echo number_format(abs($balance), 2) . ' ' . $pre; ?></td>
                                            </tr>
                                            <?php
                                            $balance = 0;
                                            $debit = 0;
                                            $credit = 0;
                                            unset($bb);
                                            if (isset($a2['child'])) {
                                                foreach ($a2['child'] as $a3) {
                                                    $cc[] = $a3;
                                                    $debit = sum_subarrays_by_key($cc, "debit");
                                                    $credit = sum_subarrays_by_key($cc, "credit");
                                                    $balance = $debit - $credit;
                                                    if($balance > 0){
                                                        $pre = 'Dr';
                                                    }elseif($balance == 0){
                                                        $pre = ' ';
                                                    }else{
                                                        $pre = 'Cr';
                                                    }
                                                    ?>
                                                    <tr data-tt-id="<?php echo $a3['id']; ?>" data-tt-parent-id="<?php echo $a2['id']; ?>">
                                                        <td><?php echo $a3['name']; ?></td>
                                                        <td class="right"><?php echo number_format($debit, 2); ?></td>
                                                        <td class="right"><?php echo number_format($credit, 2); ?></td>
                                                        <td class="right"><?php echo number_format(abs($balance), 2) . ' ' . $pre; ?></td>
                                                    </tr>
                                                    <?php
                                                    $balance = 0;
                                                    $debit = 0;
                                                    $credit = 0;
                                                    unset($cc);
                                                    if (isset($a3['child'])) {
                                                        foreach ($a3['child'] as $a4) {
                                                            $dd[] = $a4;
                                                            $debit = sum_subarrays_by_key($dd, "debit");
                                                            $credit = sum_subarrays_by_key($dd, "credit");
                                                            $balance = $debit - $credit;
                                                            if($balance > 0){
                                                                $pre = 'Dr';
                                                            } elseif($balance == 0) {
                                                                $pre = ' ';
                                                            } else {
                                                                $pre = 'Cr';
                                                            }
                                                            ?>
                                                            <tr data-tt-id="<?php echo $a4['id']; ?>" data-tt-parent-id="<?php echo $a3['id']; ?>">
                                                                <td><?php echo $a4['name']; ?></td>
                                                                <td class="right"><?php echo number_format($debit, 2); ?></td>
                                                                <td class="right"><?php echo number_format($credit, 2); ?></td>
                                                                <td class="right"><?php echo number_format(abs($balance), 2) . ' ' . $pre; ?></td>
                                                            </tr>
                                                            <?php
                                                            $balance = 0;
                                                            $debit = 0;
                                                            $credit = 0;
                                                            unset($dd);
                                                            if (isset($a4['child'])) {
                                                                foreach ($a4['child'] as $a5) {
                                                                    $ee[] = $a5;
                                                                    $debit = sum_subarrays_by_key($ee, "debit");
                                                                    $credit = sum_subarrays_by_key($ee, "credit");
                                                                    $balance = $debit - $credit;
                                                                    if($balance > 0){
                                                                        $pre = 'Dr';
                                                                    } elseif($balance == 0) {
                                                                        $pre = ' ';
                                                                    } else {
                                                                        $pre = 'Cr';
                                                                    }
                                                                    ?>
                                                                    <tr data-tt-id="<?php echo $a5['id']; ?>" data-tt-parent-id="<?php echo $a4['id']; ?>">
                                                                        <td><?php echo $a5['name']; ?></td>
                                                                        <td class="right"><?php echo number_format($debit, 2); ?></td>
                                                                        <td class="right"><?php echo number_format($credit, 2); ?></td>
                                                                        <td class="right"><?php echo number_format(abs($balance), 2) . ' ' . $pre; ?></td>
                                                                    </tr>
                                                                    <?php
                                                                    $balance = 0;
                                                                    $debit = 0;
                                                                    $credit = 0;
                                                                    unset($ee);
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }

                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <?php
                                if($net > 0)
                                {
                                    $npre = 'Dr';
                                }
                                elseif($net == 0)
                                {
                                    $npre = ' ';
                                }
                                else
                                {
                                    $npre = 'Cr';
                                }
                                ?>
                                <tr>
                                    <td colspan="3"><b>Net Balance</b></td>
                                    <td class="right"><?php echo number_format(abs($net), 2) . ' ' . $npre; ?></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="invoice-table">
                        <table id="treetable2" class="table table-striped table-bordered bootstrap-datatable datatable">
                            <thead>
                                <tr>
                                    <th colspan="4" class="left">Liability</th>
                                </tr>
                                <tr>
                                    <th class="col-md-6">Name of A/C</th>
                                    <th class="center col-md-2">Debit</th>
                                    <th class="center col-md-2">Credit</th>
                                    <th class="center col-md-2">Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $net = 0;
                                $balance = 0;
                                $debit = 0;
                                $credit = 0;
                                foreach ($liabilities as $a1)
                                {
                                    $aa[] = $a1;
                                    $debit = sum_subarrays_by_key($aa, "debit");
                                    $credit = sum_subarrays_by_key($aa, "credit");
                                    $balance = $debit - $credit;
                                    $net += $balance;
                                    if ($balance > 0)
                                    {
                                        $pre = 'Dr';
                                    }
                                    elseif ($balance == 0)
                                    {
                                        $pre = ' ';
                                    }
                                    else
                                    {
                                        $pre = 'Cr';
                                    }
                                    ?>
                                    <tr data-tt-id="<?php echo $a1['id']; ?>">
                                        <td><?php echo $a1['name']; ?></td>
                                        <td class="right"><?php echo number_format($debit, 2); ?></td>
                                        <td class="right"><?php echo number_format($credit, 2); ?></td>
                                        <td class="right"><?php echo number_format(abs($balance), 2) . ' ' . $pre; ?></td>
                                    </tr>
                                    <?php
                                    $balance = 0;
                                    $debit = 0;
                                    $credit = 0;
                                    unset($aa);
                                    if (isset($a1['child']))
                                    {
                                        foreach ($a1['child'] as $a2)
                                        {
                                            $bb[] = $a2;
                                            $debit = sum_subarrays_by_key($bb, "debit");
                                            $credit = sum_subarrays_by_key($bb, "credit");
                                            $balance = $debit - $credit;
                                            if ($balance > 0)
                                            {
                                                $pre = 'Dr';
                                            }
                                            elseif ($balance == 0)
                                            {
                                                $pre = ' ';
                                            }
                                            else
                                            {
                                                $pre = 'Cr';
                                            }
                                            ?>
                                            <tr data-tt-id="<?php echo $a2['id']; ?>" data-tt-parent-id="<?php echo $a1['id']; ?>">
                                                <td><?php echo $a2['name']; ?></td>
                                                <td class="right"><?php echo number_format($debit, 2); ?></td>
                                                <td class="right"><?php echo number_format($credit, 2); ?></td>
                                                <td class="right"><?php echo number_format(abs($balance), 2) . ' ' . $pre; ?></td>
                                            </tr>
                                            <?php
                                            $balance = 0;
                                            $debit = 0;
                                            $credit = 0;
                                            unset($bb);
                                            if (isset($a2['child']))
                                            {
                                                foreach ($a2['child'] as $a3)
                                                {
                                                    $cc[] = $a3;
                                                    $debit = sum_subarrays_by_key($cc, "debit");
                                                    $credit = sum_subarrays_by_key($cc, "credit");
                                                    $balance = $debit - $credit;
                                                    if ($balance > 0)
                                                    {
                                                        $pre = 'Dr';
                                                    }
                                                    elseif($balance == 0)
                                                    {
                                                        $pre = ' ';
                                                    }
                                                    else
                                                    {
                                                        $pre = 'Cr';
                                                    }
                                                    ?>
                                                    <tr data-tt-id="<?php echo $a3['id']; ?>" data-tt-parent-id="<?php echo $a2['id']; ?>">
                                                        <td><?php echo $a3['name']; ?></td>
                                                        <td class="right"><?php echo number_format($debit, 2); ?></td>
                                                        <td class="right"><?php echo number_format($credit, 2); ?></td>
                                                        <td class="right"><?php echo number_format(abs($balance), 2) . ' ' . $pre; ?></td>
                                                    </tr>
                                                    <?php
                                                    $balance = 0;
                                                    $debit = 0;
                                                    $credit = 0;
                                                    unset($cc);
                                                    if (isset($a3['child']))
                                                    {
                                                        foreach ($a3['child'] as $a4)
                                                        {
                                                            $dd[] = $a4;
                                                            $debit = sum_subarrays_by_key($dd, "debit");
                                                            $credit = sum_subarrays_by_key($dd, "credit");
                                                            $balance = $debit - $credit;
                                                            if ($balance > 0)
                                                            {
                                                                $pre = 'Dr';
                                                            }
                                                            elseif($balance == 0)
                                                            {
                                                                $pre = ' ';
                                                            }
                                                            else
                                                            {
                                                                $pre = 'Cr';
                                                            }
                                                            ?>
                                                            <tr data-tt-id="<?php echo $a4['id']; ?>" data-tt-parent-id="<?php echo $a3['id']; ?>">
                                                                <td><?php echo $a4['name']; ?></td>
                                                                <td class="right"><?php echo number_format($debit, 2); ?></td>
                                                                <td class="right"><?php echo number_format($credit, 2); ?></td>
                                                                <td class="right"><?php echo number_format(abs($balance), 2) . ' ' . $pre; ?></td>
                                                            </tr>
                                                            <?php
                                                            $balance = 0;
                                                            $debit = 0;
                                                            $credit = 0;
                                                            unset($dd);
                                                            if (isset($a4['child']))
                                                            {
                                                                foreach ($a4['child'] as $a5)
                                                                {
                                                                    $ee[] = $a5;
                                                                    $debit = sum_subarrays_by_key($ee, "debit");
                                                                    $credit = sum_subarrays_by_key($ee, "credit");
                                                                    $balance = $debit - $credit;
                                                                    if ($balance > 0)
                                                                    {
                                                                        $pre = 'Dr';
                                                                    }
                                                                    elseif($balance == 0)
                                                                    {
                                                                        $pre = ' ';
                                                                    }
                                                                    else
                                                                    {
                                                                        $pre = 'Cr';
                                                                    }
                                                                    ?>
                                                                    <tr data-tt-id="<?php echo $a5['id']; ?>" data-tt-parent-id="<?php echo $a4['id']; ?>">
                                                                        <td><?php echo $a5['name']; ?></td>
                                                                        <td class="right"><?php echo number_format($debit, 2); ?></td>
                                                                        <td class="right"><?php echo number_format($credit, 2); ?></td>
                                                                        <td class="right"><?php echo number_format(abs($balance), 2) . ' ' . $pre; ?></td>
                                                                    </tr>
                                                                    <?php
                                                                    $balance = 0;
                                                                    $debit = 0;
                                                                    $credit = 0;
                                                                    unset($ee);
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }

                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <?php
                                if ($net > 0)
                                {
                                    $npre = 'Dr';
                                }
                                elseif ($net == 0)
                                {
                                    $npre = ' ';
                                }
                                else
                                {
                                    $npre = 'Cr';
                                }
                                ?>
                                <tr>
                                    <td colspan="3"><b>Net Balance</b></td>
                                    <td class="right"><?php echo number_format(abs($net), 2) . ' ' . $npre; ?></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="invoice-table">
                      <table id="treetable3" class="table table-striped table-bordered bootstrap-datatable datatable">
                        <thead>
                            <tr>
                                <th colspan="4" class="left">Equity/Capital</th>
                            </tr>
                            <tr>
                                <th class="col-md-6">Name of A/C</th>
                                <th class="center col-md-2">Debit</th>
                                <th class="center col-md-2">Credit</th>
                                <th class="center col-md-2">Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $net = 0;
                            $balance = 0;
                            $debit = 0;
                            $credit = 0;
                            foreach ($equities as $a1)
                            {
                                $aa[] = $a1;
                                $debit = sum_subarrays_by_key($aa, "debit");
                                $credit = sum_subarrays_by_key($aa, "credit");
                                $balance = $debit - $credit;
                                $net += $balance;
                                if ($balance > 0)
                                {
                                    $pre = 'Dr';
                                }
                                elseif ($balance == 0)
                                {
                                    $pre = ' ';
                                }
                                else
                                {
                                    $pre = 'Cr';
                                }
                                ?>
                                <tr data-tt-id="<?php echo $a1['id']; ?>">
                                    <td><?php echo $a1['name']; ?></td>
                                    <td class="right"><?php echo number_format($debit, 2); ?></td>
                                    <td class="right"><?php echo number_format($credit, 2); ?></td>
                                    <td class="right"><?php echo number_format(abs($balance), 2) . ' ' . $pre; ?></td>
                                </tr>
                                <?php
                                $balance = 0;
                                $debit = 0;
                                $credit = 0;
                                unset($aa);
                                if (isset($a1['child']))
                                {
                                    foreach ($a1['child'] as $a2)
                                    {
                                        $bb[] = $a2;
                                        $debit = sum_subarrays_by_key($bb, "debit");
                                        $credit = sum_subarrays_by_key($bb, "credit");
                                        $balance = $debit - $credit;
                                        if ($balance > 0)
                                        {
                                            $pre = 'Dr';
                                        }
                                        elseif ($balance == 0)
                                        {
                                            $pre = ' ';
                                        }
                                        else
                                        {
                                            $pre = 'Cr';
                                        }
                                        ?>
                                        <tr data-tt-id="<?php echo $a2['id']; ?>" data-tt-parent-id="<?php echo $a1['id']; ?>">
                                            <td><?php echo $a2['name']; ?></td>
                                            <td class="right"><?php echo number_format($debit, 2); ?></td>
                                            <td class="right"><?php echo number_format($credit, 2); ?></td>
                                            <td class="right"><?php echo number_format(abs($balance), 2) . ' ' . $pre; ?></td>
                                        </tr>
                                        <?php
                                        $balance = 0;
                                        $debit = 0;
                                        $credit = 0;
                                        unset($bb);
                                        if (isset($a2['child']))
                                        {
                                            foreach ($a2['child'] as $a3)
                                            {
                                                $cc[] = $a3;
                                                $debit = sum_subarrays_by_key($cc, "debit");
                                                $credit = sum_subarrays_by_key($cc, "credit");
                                                $balance = $debit - $credit;
                                                if ($balance > 0)
                                                {
                                                    $pre = 'Dr';
                                                }
                                                elseif ($balance == 0)
                                                {
                                                    $pre = ' ';
                                                }
                                                else
                                                {
                                                    $pre = 'Cr';
                                                }
                                                ?>
                                                <tr data-tt-id="<?php echo $a3['id']; ?>" data-tt-parent-id="<?php echo $a2['id']; ?>">
                                                    <td><?php echo $a3['name']; ?></td>
                                                    <td class="right"><?php echo number_format($debit, 2); ?></td>
                                                    <td class="right"><?php echo number_format($credit, 2); ?></td>
                                                    <td class="right"><?php echo number_format(abs($balance), 2) . ' ' . $pre; ?></td>
                                                </tr>
                                                <?php
                                                $balance = 0;
                                                $debit = 0;
                                                $credit = 0;
                                                unset($cc);
                                                if (isset($a3['child']))
                                                {
                                                    foreach ($a3['child'] as $a4)
                                                    {
                                                        $dd[] = $a4;
                                                        $debit = sum_subarrays_by_key($dd, "debit");
                                                        $credit = sum_subarrays_by_key($dd, "credit");
                                                        $balance = $debit - $credit;
                                                        if ($balance > 0)
                                                        {
                                                            $pre = 'Dr';
                                                        }
                                                        elseif($balance == 0)
                                                        {
                                                            $pre = ' ';
                                                        }
                                                        else
                                                        {
                                                            $pre = 'Cr';
                                                        }
                                                        ?>
                                                        <tr data-tt-id="<?php echo $a4['id']; ?>" data-tt-parent-id="<?php echo $a3['id']; ?>">
                                                            <td><?php echo $a4['name']; ?></td>
                                                            <td class="right"><?php echo number_format($debit, 2); ?></td>
                                                            <td class="right"><?php echo number_format($credit, 2); ?></td>
                                                            <td class="right"><?php echo number_format(abs($balance), 2) . ' ' . $pre; ?></td>
                                                        </tr>
                                                        <?php
                                                        $balance = 0;
                                                        $debit = 0;
                                                        $credit = 0;
                                                        unset($dd);
                                                        if (isset($a4['child']))
                                                        {
                                                            foreach ($a4['child'] as $a5)
                                                            {
                                                                $ee[] = $a5;
                                                                $debit = sum_subarrays_by_key($ee, "debit");
                                                                $credit = sum_subarrays_by_key($ee, "credit");
                                                                $balance = $debit - $credit;
                                                                if ($balance > 0)
                                                                {
                                                                    $pre = 'Dr';
                                                                }
                                                                elseif ($balance == 0)
                                                                {
                                                                    $pre = ' ';
                                                                }
                                                                else
                                                                {
                                                                    $pre = 'Cr';
                                                                }
                                                                ?>
                                                                <tr data-tt-id="<?php echo $a5['id']; ?>" data-tt-parent-id="<?php echo $a4['id']; ?>">
                                                                    <td><?php echo $a5['name']; ?></td>
                                                                    <td class="right"><?php echo number_format($debit, 2); ?></td>
                                                                    <td class="right"><?php echo number_format($credit, 2); ?></td>
                                                                    <td class="right"><?php echo number_format(abs($balance), 2) . ' ' . $pre; ?></td>
                                                                </tr>
                                                                <?php
                                                                $balance = 0;
                                                                $debit = 0;
                                                                $credit = 0;
                                                                unset($ee);
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }

                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <?php
                            if ($net > 0)
                            {
                                $npre = 'Dr';
                            }
                            elseif ($net == 0)
                            {
                                $npre = ' ';
                            }
                            else
                            {
                                $npre = 'Cr';
                            }
                            ?>
                            <tr>
                                <td colspan="3"><b>Net Balance</b></td>
                                <td class="right"><?php echo number_format(abs($net), 2) . ' ' . $npre; ?></td>
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
    <!-- jQuery 3.3.1 -->
    <script src="assets/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="assets/plugin/treetable/js/jquery.treetable.js"></script>
    <script>
        $("#treetable1").treetable({expandable: true});
        $("#treetable2").treetable({expandable: true});
        $("#treetable3").treetable({expandable: true});
    </script>
</body>
</html>