<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $title; ?></title>
    <base href="<?php echo base_url(); ?>" />
    <meta charset="utf-8">
    <meta name="author" content="Devs Palace">
    <meta name="description" content="">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon" />
    <!-- styles -->
    <link href="assets/backend/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/backend/css/stilearn.css" rel="stylesheet" />

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <style>
        @media print{
            p.muted{
                font-weight: bold;
            }
            small.small{
                font-weight: normal;
            }
        }
        .content {
            background: none !important;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- content -->
        <div class="content" style="border: 1px solid #d7d7d7; float: left;">
            <!-- content-body -->
            <div class="content-body">
                <!-- invoice -->
                <div class="invoice-container">
                    <div class="page-header">
                        <div class="pull-right">
                            <img src="<?php echo $this->session->company_logo; ?>" width="115" class="img" style="width: 115px;">
                        </div>
                        <h3>Inventory Report <small class="small"><?php echo $company['name']; ?></small></h3>
                    </div>
                    <div class="row-fluid">
                        <div class="span6">
                            <p class="muted">Purchase Date From</p>
                            <p><?php echo date('jS M, Y ', strtotime(date_to_db($start_date))); ?></p>
                        </div>
                        <div class="span4">
                            <p class="muted">Purchase Date To</p>
                            <p><?php echo date('jS M, Y ', strtotime(date_to_db($end_date))); ?></p>
                        </div>
                    </div>
                    <div class="invoice-table">
                        <div style="width: 1100px;">
                            <div style="width: 50px; float: left;"><b>SL #</b></div>
                            <div style="width: 80px; float: left;"><b>Date</b></div>
                            <div style="width: 138px; float: left;"><b>Opening Balance</b></div>
                            <div style="width: 138px; float: left;"><b>Purchase</b></div>
                            <div style="width: 138px; float: left;"><b>Purchase Return</b></div>
                            <div style="width: 138px; float: left;"><b>Sales</b></div>
                            <div style="width: 138px; float: left;"><b>Sales Return</b></div>
                            <div style="width: 138px; float: left;"><b>Closing Balance</b></div>
                        </div>
                        <?php
                        if (count($reports['inv']) > 0) {
                            $item = array();
                            ?>
                            <div class="tbody" style="width: 1100px;">
                                <?php
                                $i = 1;
                                foreach ($reports['inv'] as $report) {
                                    ?>
                                    <div style="width: 50px; float: left;"><?php echo $i; ?></div>
                                    <div  style="width: 80px; float: left;"><?php echo date_to_ui( $report['date'] ); ?></div>
                                    <div style="width: 138px; float: left;">
                                        <?php
                                        if ($i == 1) {
                                            $j = 0;
                                            if (is_array($reports['open'])) {
                                                foreach ($reports['open'] as $key => $open) {
                                                    echo $open['name'] . ' : ' . $open['open'] . '<br>';
                                                    $item[$j] = $open['open'];
                                                    $j++;
                                                }
                                            } else {
                                                $item[$j] = 0;
                                            }
                                        } else {
                                            $j = 0;
                                            foreach ($items as $key => $value) {
                                                echo $value['name'] . ' : ' . $item[$j] . '<br>';
                                                $j++;
                                            }
                                        }
                                        ?>
                                    </div>
                                    <div style="width: 138px; float: left;">
                                        <?php
                                        $j = 0;
                                        foreach ($report['details'] as $details) {
                                            echo $details['item_name'] . ' : ' . $details['purchase_qty'] . '<br>';
                                            $item[$j] = $item[$j] + $details['purchase_qty'];
                                            $j++;
                                        }
                                        ?>
                                    </div>
                                    <div style="width: 138px; float: left;">
                                        <?php
                                        $j = 0;
                                        foreach ($report['details'] as $details) {
                                            echo $details['item_name'] . ' : ' . $details['purchase_return_qty'] . '<br>';
                                            $item[$j] = $item[$j] - $details['purchase_return_qty'];
                                            $j++;
                                        }
                                        ?>
                                    </div>
                                    <div style="width: 138px; float: left;">
                                        <?php
                                        $j = 0;
                                        foreach ($report['details'] as $details) {
                                            echo $details['item_name'] . ' : ' . $details['sales_qty'] . '<br>';
                                            $item[$j] = $item[$j] - $details['sales_qty'];
                                            $j++;
                                        }
                                        ?>
                                    </div>
                                    <div style="width: 138px; float: left;">
                                        <?php
                                        $j = 0;
                                        foreach ($report['details'] as $details) {
                                            echo $details['item_name'] . ' : ' . $details['sales_return_qty'] . '<br>';
                                            $item[$j] = $item[$j] + $details['sales_return_qty'];
                                            $j++;
                                        }
                                        ?>
                                    </div>
                                    <div style="width: 138px; float: left;">
                                        <?php
                                        $j = 0;
                                        foreach ($items as $key => $value) {
                                            echo $value['name'] . ' : ' . $item[$j] . '<br>';
                                            $j++;
                                        }
                                        ?>
                                    </div>
                                    <?php
                                    $i++;
                                }
                                ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <!--/invoice-->
            </div><!--/content-body -->
        </div><!-- /content -->

    </div><!-- /container -->
</body>
</html>