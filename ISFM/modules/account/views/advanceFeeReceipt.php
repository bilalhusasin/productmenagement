<head>
    <style media="print">
    @page{ 
        margin: 0;
        size: auto;
        

    }
    .ta {
        float: left !important;
    width: 33% !important;
    }
    .no-print{
        display: none;
    }
    .table{
        margin-bottom: 0px !important;
    }
        /* avoid cutting tr's in half */
    .addwidth{
        width: 33% !important;
    }
    }
    div table  {  
    }
     
    .table_print {
    table-layout: fixed !important;
    width: 33%;
    float: left;
    font-size: 12px !important;
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
                    <?php echo lang('acc_adv_fee_detail'); ?><small></small>
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
                        <?php echo lang('header_recept'); ?> 
                    </li>
                    <li>
                        <?php echo lang('acc_adv_fee_detail'); ?> 
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
                            <?php echo lang('acc_adv_recei'); ?>
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
                           
                            <div class="form-body textAlignCenter">
                                <h2><?php echo $schoolName; ?></h2> 
    <div class="row" >
        <div class="col-md-4 ta" >
            <div class="logo"> 
                    <img src="assets/admin/layout/img/foretell.png" alt="logo" width="220" class="logo-default"/> 
            </div>
        </div>
        <div class=" col-md-4 ta" > 
            <div class="">
                <table class="table table-hover">

                    <tr>
                        <td ><?php echo lang('acc_stuname'); ?> :</td>
                        <td ><?php echo $student_info[0]['student_nam'] ?></td>
                    </tr>
                    <tr>
                        <td ><?php echo lang('acc_sid'); ?> : </td>
                        <td><?php echo $advance_fee[0]['student_id']; ?></td>
                    </tr>
                    <tr>
                        <td ><?php echo'Registration Number'; ?> : </td>
                        <td> <?php echo $advance_fee[0]['registration_num']; ?> </td>
                    </tr>
                    <tr>
                        <td ><?php echo lang('acc_clastitle'); ?> : </td>
                        <td><?php echo $student_info[0]['class_title'];?></td>
                    </tr>
                    <tr>
                        <td ><?php echo "Class Section" ?> : </td>
                        <td><?php echo $student_info[0]['section'];?></td>
                    </tr>

                </table>
            </div>
        </div>
    </div> 
                                
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
                                                    <th>
                                                        <?php echo lang('srno'); ?>
                                                    </th>
                                                    <th class="textAlignCenter">
                                                         Advance Fee Month
                                                    </th>
                                                    <th class="textAlignCenter">
                                                         Advance Fee date
                                                    </th>
                                                    <th class="textAlignCenter">
                                                        <?php echo lang('acc_amount'); ?> <i class="<?php echo $currency; ?>"></i>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php // $i=1;foreach ($items as $row1){?>
                                                <tr>
                                                    <td ><?php // echo $i; ?>1</td>
                                                    <td class="textAlignCenter">
                                                        <?php // echo $this->accountmodel->item_title($row1)[0]; 
                                                       echo  $advance_fee[0]['advance_month']; ?>

                                                    </td>
                                                    <td class="textAlignCenter">
                                                        <?php // echo $this->accountmodel->item_title($row1)[0]; 
                                                       echo  $advance_fee[0]['advance_date']; ?>

                                                    </td>
                                                    <td class="textAlignCenter"><?php echo $advance_fee[0]['advance_amount']; // echo $this->accountmodel->item_amount($row1[0]);?></td>
                                                </tr>
                                                <?php // $i++; }?>
                                                <tr >
                                                    <td colspan="3" class="totalBalencetd" style="text-align:center;">
                                                        Sub Total
                                                    </td>
                                                    <td class="totalBalenceamount textAlignCenter" style="text-align:center;">
                                                        &nbsp;  <?php echo $advance_fee[0]['advance_amount']; ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- END EXAMPLE TABLE PORTLET-->
                            </div>
                        </div> 
				<div class="clearfix"></div>
                        <div class="form-actions fluid">
                            <div class="textAlignCenter">   
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

