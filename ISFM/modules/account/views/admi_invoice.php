<head>
    <style media="print">
    @page{ 
        margin: 0;
        size: auto;
    }
    .no-print{
        display: none;
    }
    .print{
        display: block;
    }

    .table{
        margin-bottom: 0px !important;
    }
        /* avoid cutting tr's in half */
    }
    div table  {  
    }
     
    .table_print {
    table-layout: fixed !important;
    width: 33%;
    float: left;
    font-size: 6px !important;
    overflow: none;
      }
    /* td{
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: normal;
    overflow-wrap: break-word;
    padding-top: 6px !important;
    padding-bottom: 6px !important;
    font-size: 8px !important;
      }
      th{
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: normal;
    overflow-wrap: break-word;
    padding-top: 6px !important;
    padding-bottom: 6px !important;
    font-size: 8px !important;
      } 
    #tdfont{
        font-size: 9px !important;
        padding-top: 4px !important;
    } 
    p{
    font-size: 6px !important; 
      }  */
    </style>
    <!-- <style>
        .table{
            margin-bottom: 0px !important;
        }
    </style>  -->
</head>



<?php $user = $this->ion_auth->user()->row(); $userId = $user->id;?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title no-print">
                    <?php echo lang('acc_slipdetails'); ?><small></small>
                </h3>
                <ul class="page-breadcrumb breadcrumb no-print">
                    <li>
                        <i class="fa fa-home"></i>
                        <?php echo lang('home'); ?>
                    </li>
                    <li>
                        <?php echo lang('header_account'); ?>
                    </li>
                    <li>
                        <?php // echo lang('header_teansec'); ?>
                        Student's Payments
                    </li>
                    <li>
                        <?php // echo lang('acc_slipdetails'); ?>
                        Admission Fee Invoice
                    </li>
                    <li id="result" class="pull-right topClock"></li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12" >
                <!-- BEGIN SAMPLE FORM PORTLET-->
                <div class="portlet box green ">
                    <div class="portlet-title no-print">
                        <div class="caption">
                            <?php echo lang('acc_stsdetails'); ?>
                        </div>
                        <div class="tools">
                            <a href="" class="collapse">
                            </a>
                            <a href="" class="reload">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form" id="print">
                       <!--  <div class="col-md-12 btn-group floatRight">
                           <button class="btn green-meadow  prin-link" onclick="jQuery('#print').print()" type="button"><i class="fa fa-print"></i> Print </button>
                       </div> -->
                        <?php  
                              $class_title   =$this->common->class_title($infodata[0]['class_id']);  
                              
                               
                        ?>
                            <div class="form-body textAlignCenter">
                                <h2><?php echo $schoolName; ?></h2>
                                <h4><?php echo lang('acc_clastitle'); ?> : <?php echo $class_title; ?></h4>
                                <p>
                                    <strong> <?php echo lang('acc_stuname'); ?> : <?php echo $infodata[0]['student_nam'];?></strong><br>
                                    <?php echo 'Registration ID'; ?> : <?php echo $infodata[0]['reg_number']; ?><br>
                                    <? // echo lang('date'); ?>  <?php // if(!empty($row['date'])){echo date("d-m-Y", $row['date']); }else {echo 'Bill Not Paid';}?> 
                                </p>
                                <?php //  echo lang('acc_traslipno'); : ?>  &nbsp;<strong><?php // echo $id; ?></strong>
                            </div>
                        <?php  // $items = explode( ',', $slip_text); ?>
                        <div class="row">
                            <div class="col-md-offset-2 col-md-8">
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <div class="portlet box actionSlipBorder ">
                                    <div class="portlet-body">
                                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                                            <thead>
                                                <tr>
                                                    <th> <?php echo lang('srno'); ?> </th>
                                                    <th> Fee Title </th>
                                                    <th class="textAlignCenter">
                                                        <?php echo lang('acc_amount'); ?> <i class="<?php echo $currency; ?>"></i>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody> 
                                                <tr>
                                                    <td> 1 </td>
                                                    <td> Admission and Monthly Fee </td>
                                                    <td class="textAlignCenter"> <?php echo $infodata[0]['total']; ?> </td>
                                                </tr> 
                                                <tr >
                                                    <td colspan="2" class="totalBalencetd" style="text-align:center;">
                                                        Sub Total
                                                    </td>
                                                    <td class="totalBalenceamount" style="text-align:center;">
                                                        &nbsp;  <?php echo $infodata[0]['total']; ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- END EXAMPLE TABLE PORTLET-->
                            </div>
                        </div>
                        <div class="col-md-12 print <?php if ($infodata[0]['paid_status'] == 'Paid') {echo 'paid_box';} else {echo 'unpaid_box';} ?> ">
                            <div class="in_ta_voice">
                                <table class="table-hover" height="200px">
                                    <thead>
                                        <tr>
                                            <th> Title </th>
                                            <th> Amount <i class="<?php echo $currency; ?>"></i> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th class="">  Grand Total </th>
                                            <th> <?php echo $infodata[0]['actual_tot']; ?> </th>
                                        </tr>
                                        <tr>
                                            <td class=""> Total Dsicount </td>
                                            <td> <?php echo $infodata[0]['disc_tot']; ?> </td>
                                        </tr>
                                         
                                        <tr> 
                                            <th class=""> Payable Total </th>
                                            <th> <?php echo $infodata[0]['total']; ?> </th>
                                        </tr>  
                                    </tbody>
                                </table>
                            </div>
                        </div>
				<div class="clearfix"></div>
                        <div class="form-actions fluid no-print">
                            <div class="col-md-offset-3 col-md-6">
                                <?php if ($infodata[0]['paid_status'] != 'Paid') { 
                                    echo'<a class="btn green" href="index.php/account/admi_fee_pay?reg_id='.$infodata[0]['reg_number'].'&admi_fee='.$infodata[0]['total'].'"> Take Payment </a>';
                                 } ?>
                                <button class="btn red no-print" onclick="location.href = 'javascript:history.back()'"><?php echo lang('back'); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END SAMPLE FORM PORTLET-->
            </div>
        </div>
        <!-- END PAGE CONTENT-->
    </div>
</div>
<!-- END CONTENT -->
<script type="text/javascript" src="assets/admin/layout/scripts/jQuery.print.js"></script>
<script>
    jQuery(document).ready(function () {
    //here is auto reload after 1 second for time and date in the top

        $("#print").find('.print-link').on('click', function () {
            //Print print with default options
            $.print("#print");
        });
        jQuery(setInterval(function () {
            jQuery("#result").load("index.php/home/iceTime");
        }, 5000));
    });
</script>
<script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-36251023-1']);
    _gaq.push(['_setDomainName', 'jqueryscript.net']);
    _gaq.push(['_trackPageview']);

    (function () {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();

</script>

