<!-- Content Header -->
<section class="content-header">
    <h1><a href="accounts"> Accounts</a></h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="accounts"> Accounts</a></li>
        <li class="active"> Journal Preview</li>
    </ol>
</section>

<!-- Main content -->
<section class="invoice">
    <!-- title row -->
    <div class="row">
        <div class="col-md-12">
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
        <div class="col-md-12 invoice-col">
            <strong>Journal #</strong> <?php echo $master['journal_no']; ?><br>
            <strong>Notes:</strong> <?php echo $master['memo']; ?><br>
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
        <div class="col-md-6">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Debit A/C Head</th>
                        <th class="col-md-4">Amount</th>
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
                                <td class="right col-md-4"><?php echo number_format($list['debit'], 2); ?></td>
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

        <div class="col-md-6">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Credit A/C Head</th>
                        <th class="col-md-4">Amount</th>
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
                                <td class="right col-md-4"><?php echo number_format($list['credit'], 2); ?></td>
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
        <div class="col-md-6">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="center">Total</th>
                        <th class="right col-md-4"><?php echo number_format($debit_amount, 2); ?></th>
                    </tr>
                </thead>
            </table>
        </div>
        <!-- /.col -->

        <div class="col-md-6">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="center">Total</th>
                        <th class="right col-md-4"><?php echo number_format($credit_amount, 2); ?></th>
                    </tr>
                </thead>
            </table>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- This row will not appear when printing -->
    <div class="row no-print">
        <div class="col-md-12">
            <a href="accounts/journal-print/<?php echo $master['id']; ?>" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
            <!-- <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
                <i class="fa fa-download"></i> Generate PDF
            </button> -->
        </div>
    </div>
</section>
<!-- /.content -->
<div class="clearfix"></div>