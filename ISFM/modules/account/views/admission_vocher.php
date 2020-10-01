<head><!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<style media="print">
    @page{ 
        margin: 0;
        size: landscape;
    }
    .no-print{
        display: none;
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
    td{
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
      }  
    </style>
    <style>
        .table{
            margin-bottom: 0px !important;
        }
    </style> 
</head>
<!-- END PAGE LEVEL STYLES -->

<?php $user = $this->ion_auth->user()->row(); $userId = $user->id;?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <div class="row no-print">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                    <?php echo lang('header_stu_payme'); ?><small></small>
                </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <?php echo lang('home'); ?>
                    </li>
                    <li>
                        <?php echo lang('header_account'); ?>
                    </li>
                    <li>
                        <?php echo lang('header_stu_payme'); ?>
                    </li>
                    <li>
                       Student Voucher <?php // echo lang('header_stu_payme'); ?>
                    </li>
                    <li id="result" class="pull-right topClock"></li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="form-actions fluid">
              <div class="col-md-6">   
                  <a href="javascript:history.back()" class="btn btn-default no-print"><i class="fa fa-mail-reply-all"></i> <?php echo lang('back'); ?> </a> 
              </div>
            </div>
            <div class="col-md-12">
                <?php
                if (!empty($message)) {
                    echo '<br>' . $message;
                }
                ?>  
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green ">
                    <div class="portlet-title no-print">
                        <div class="caption "> Student Registration Fee Voucher
                            <?php // echo lang('acc_stsl'); ?>
                        </div>
                        <div class="tools">
                        </div>
                    </div>

                    <div class="portlet-body">  
                      <div class="row mr-t-neg">
                        
                    <?php  
                      foreach ($voucher as $row) {
                       
                        $class_id = $row['class_id'];
                        $session = $row['year'];
                        $student = $row['student_nam'];
                        $regfee = $row['registration_fee'];
                        $student_voucher = $row['voucher_number'];
                        $month = date('F');
                        $issue_date = $row['reg_date'];
                        $due_date = $row['due_date'];
                        $reg = $this->common->reg($row['id']);
                         
                    } ?> 
                      <div class="col-md-4 table_print" style="font-size: xx-small;" >
                        <div style="border: 1px solid #000;" > 
                            <p align="center" style="text-transform: uppercase; font-weight: 800; font-size: 14px; margin-top: 5px;">The punjab school</p> 
                            <p align="center" style="text-transform: uppercase;">NTN # 5280652</p>
                            <p align="center" style="text-transform: uppercase;">canal garden/gulshan-e-habib campus lahore</p>  
                            <p align="center" style="font-size: 9px;text-transform: uppercase;">allied bank ltd,bahria town & canal garden, lahore, a/c no. 001-004911562-002-3</p>
                            <p align="center" style="font-size: 10px;">Title of A/C Rehmat Habib Associate (The Punjab school) Franchise Campus</p>
                            <p align="center" style="font-size:10px; font-weight:800;">Registration Fee Voucher</p> 
                            <div style="border-top: 1px solid #000;border-bottom: 1px solid #000;">
                             <table class="table " style="text-transform: uppercase; ">  
                                <tr>
                                    <td>student name:</td>
                                    <th colspan="3"> <?php echo $student;?> </th>
                                </tr> 
                             </table>
                             <table class="table " style="text-transform: uppercase;"> 
                                <tr>
                                    <td >class : </td>
                                    <th > <?php echo $this->common->class_title($class_id); ?></th>
                                    <td > student Reg no :</td>
                                    <th ><?php echo $reg; ?> </th>
                                </tr> 
                                <tr>
                                    <td>period :</td>
                                    <th><?php echo $month; ?></th>
                                    <td> bank challan No :</td>
                                    <th><?php echo $student_voucher; ?> </th>
                                </tr> 
                                <tr> 
                                    <td >Session:</td>
                                    <th ><?php echo $session; ?> </th>
                                    <td> </td>
                                    <th> </th>
                                </tr>
                                <tr> 
                                    <td >Issue date :</td>
                                    <th > <?php echo $issue_date; ?> </th>
                                    <td> due date :</td>
                                    <th> <?php echo $due_date; ?></th>
                                </tr> 
                             </table>
                            </div>
                            <div>
                             <table class="table" style="text-transform: uppercase;" >
                                <tr>
                                    <th>SR#</th>
                                    <th >dcscription</th>
                                    <th >amount</th>
                                    <th >Remarks</th>     
                                </tr>  
                                <tr>
                                    <td>1</td>
                                    <td>Registration Fee</td>
                                    <td><?php echo $regfee; ?></td>
                                    <td> - </td>
                                </tr> 
                                <tr>
                                    <th colspan="2" align="center"> total amount</th> 
                                    <th> <?php echo $regfee; ?> </th>
                                    <td> </td>
                                </tr> 
                             </table>
                            </div>
                            <div style="border-top: 1px solid #000;" >
                              <table class="table">
                                <tr  >
                                    <td >Amount in words</td>
                                    <td id="sumword"> </td>
                                </tr>      
                              </table>
                            </div>
                            <div  style="border-top: 1px solid #000;" >
                              <table class="table" id="table_l">
                                 <tr>
                                   <td colspan="2" style="font-weight: 800; text-transform: uppercase;" id="tdfont"> Terma & conditions for school dues</td> 
                                 </tr>
                                 <tr>
                                   <td>1</td>
                                   <td >Fee Voucher will be issued on 1st day of the Month.</td> 
                                 </tr>
                                 <tr>
                                   <td>2</td>
                                   <td >last day for payment in 10th of due Month.</td> 
                                 </tr>
                                 <tr>
                                   <td>3</td>
                                   <td >After due date late fee @ Rs. per day will be charged.</td> 
                                 </tr>
                                 <tr>
                                   <td>4</td>
                                   <td >Name of the defaulter will be struck off after 20th of the Month.</td> 
                                 </tr>
                                 <tr>
                                   <td>5</td>
                                   <td >Re-Admission will br granted after paying Rs. 2,000/- asre-Registration Fee.</td> 
                                 </tr>
                                 <tr>
                                   <td>6</td>
                                   <td >Re-Admission con not be claimed after 10 days of name being struck off.</td> 
                                 </tr>
                                 <tr>
                                   <td>7</td>
                                   <td >In Case of challan lost Rs.100 will be charged for dublicate challan issuance.</td> 
                                 </tr>
                              </table>
                              <div align="left" style="border-top:1px solid #000; text-transform: uppercase; font-size: 10px; font-weight: 800;padding-left: 10px !important;" >
                               Student copy 
                              </div>
                               
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4 table_print" style="font-size: xx-small;" >
                        <div style="border: 1px solid #000;" > 
                            <p align="center" style="text-transform: uppercase; font-weight: 800; font-size: 14px; margin-top: 5px;">The punjab school</p> 
                            <p align="center" style="text-transform: uppercase;">NTN # 5280652</p>
                            <p align="center" style="text-transform: uppercase;">canal garden/gulshan-e-habib campus lahore</p>  
                            <p align="center" style="font-size: 9px;text-transform: uppercase;">allied bank ltd,bahria town & canal garden, lahore, a/c no. 001-004911562-002-3</p>
                            <p align="center" style="font-size: 10px;">Title of A/C Rehmat Habib Associate (The Punjab school) Franchise Campus</p>
                            <p align="center" style="font-size:10px; font-weight:800;">Registration Fee Voucher</p> 
                            <div style="border-top: 1px solid #000;border-bottom: 1px solid #000;">
                             <table class="table " style="text-transform: uppercase; ">  
                                <tr>
                                    <td>student name:</td>
                                    <th colspan="3"> <?php echo $student;?> </th>
                                </tr> 
                             </table>
                             <table class="table " style="text-transform: uppercase;"> 
                                <tr>
                                    <td >class : </td>
                                    <th > <?php echo $this->common->class_title($class_id); ?></th>
                                    <td > student Reg no :</td>
                                    <th ><?php echo $reg; ?> </th>
                                </tr> 
                                <tr>
                                    <td>period :</td>
                                    <th><?php echo $month; ?></th>
                                    <td> bank challan No :</td>
                                    <th><?php echo $student_voucher; ?> </th>
                                </tr> 
                                <tr> 
                                    <td >Session:</td>
                                    <th ><?php echo $session; ?> </th>
                                    <td> </td>
                                    <th> </th>
                                </tr>
                                <tr> 
                                    <td >Issue date :</td>
                                    <th > <?php echo $issue_date; ?> </th>
                                    <td> due date :</td>
                                    <th> <?php echo $due_date; ?></th>
                                </tr> 
                             </table>
                            </div>
                            <div>
                             <table class="table" style="text-transform: uppercase;" >
                                <tr>
                                    <th>SR#</th>
                                    <th >dcscription</th>
                                    <th >amount</th>
                                    <th >Remarks</th>     
                                </tr>  
                                <tr>
                                    <td>1</td>
                                    <td>Registration Fee</td>
                                    <td><?php echo $regfee; ?></td>
                                    <td> - </td>
                                </tr> 
                                <tr>
                                    <th colspan="2" align="center"> total amount</th> 
                                    <th> <?php echo $regfee; ?> </th>
                                    <td> </td>
                                </tr> 
                             </table>
                            </div>
                            <div style="border-top: 1px solid #000;" >
                              <table class="table">
                                <tr  >
                                    <td >Amount in words</td>
                                    <td id="sumword2"> </td>
                                </tr>      
                              </table>
                            </div>
                            <div  style="border-top: 1px solid #000;" >
                              <table class="table" id="table_l">
                                 <tr>
                                   <td colspan="2" style="font-weight: 800; text-transform: uppercase;" id="tdfont"> Terma & conditions for school dues</td> 
                                 </tr>
                                 <tr>
                                   <td>1</td>
                                   <td >Fee Voucher will be issued on 1st day of the Month.</td> 
                                 </tr>
                                 <tr>
                                   <td>2</td>
                                   <td >last day for payment in 10th of due Month.</td> 
                                 </tr>
                                 <tr>
                                   <td>3</td>
                                   <td >After due date late fee @ Rs. per day will be charged.</td> 
                                 </tr>
                                 <tr>
                                   <td>4</td>
                                   <td >Name of the defaulter will be struck off after 20th of the Month.</td> 
                                 </tr>
                                 <tr>
                                   <td>5</td>
                                   <td >Re-Admission will br granted after paying Rs. 2,000/- asre-Registration Fee.</td> 
                                 </tr>
                                 <tr>
                                   <td>6</td>
                                   <td >Re-Admission con not be claimed after 10 days of name being struck off.</td> 
                                 </tr>
                                 <tr>
                                   <td>7</td>
                                   <td >In Case of challan lost Rs.100 will be charged for dublicate challan issuance.</td> 
                                 </tr>
                              </table>
                              <div align="left" style="border-top:1px solid #000; text-transform: uppercase; font-size: 10px; font-weight: 800;padding-left: 10px !important;" >
                               school copy 
                              </div>
                               
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4 table_print" style="font-size: xx-small;" >
                        <div style="border: 1px solid #000;" > 
                            <p align="center" style="text-transform: uppercase; font-weight: 800; font-size: 14px; margin-top: 5px;">The punjab school</p> 
                            <p align="center" style="text-transform: uppercase;">NTN # 5280652</p>
                            <p align="center" style="text-transform: uppercase;">canal garden/gulshan-e-habib campus lahore</p>  
                            <p align="center" style="font-size: 9px;text-transform: uppercase;">allied bank ltd,bahria town & canal garden, lahore, a/c no. 001-004911562-002-3</p>
                            <p align="center" style="font-size: 10px;">Title of A/C Rehmat Habib Associate (The Punjab school) Franchise Campus</p>
                            <p align="center" style="font-size:10px; font-weight:800;">Registration Fee Voucher</p> 
                            <div style="border-top: 1px solid #000;border-bottom: 1px solid #000;">
                             <table class="table " style="text-transform: uppercase; ">  
                                <tr>
                                    <td>student name:</td>
                                    <th colspan="3"> <?php echo $student;?> </th>
                                </tr> 
                             </table>
                             <table class="table " style="text-transform: uppercase;"> 
                                <tr>
                                    <td >class : </td>
                                    <th > <?php echo $this->common->class_title($class_id); ?></th>
                                    <td > student Reg no :</td>
                                    <th ><?php echo $reg; ?> </th>
                                </tr> 
                                <tr>
                                    <td>period :</td>
                                    <th><?php echo $month; ?></th>
                                    <td> bank challan No :</td>
                                    <th><?php echo $student_voucher; ?> </th>
                                </tr> 
                                <tr> 
                                    <td >Session:</td>
                                    <th ><?php echo $session; ?> </th>
                                    <td> </td>
                                    <th> </th>
                                </tr>
                                <tr> 
                                    <td >Issue date :</td>
                                    <th > <?php echo $issue_date; ?> </th>
                                    <td> due date :</td>
                                    <th> <?php echo $due_date; ?></th>
                                </tr> 
                             </table>
                            </div>
                            <div>
                             <table class="table" style="text-transform: uppercase;" >
                                <tr>
                                    <th>SR#</th>
                                    <th >dcscription</th>
                                    <th >amount</th>
                                    <th >Remarks</th>     
                                </tr>  
                                <tr>
                                    <td>1</td>
                                    <td>Registration Fee</td>
                                    <td><?php echo $regfee; ?></td>
                                    <td> - </td>
                                </tr> 
                                <tr>
                                    <th colspan="2" align="center"> total amount</th> 
                                    <th> <?php echo $regfee; ?> </th>
                                    <td> </td>
                                </tr> 
                             </table>
                            </div>
                            <div style="border-top: 1px solid #000;" >
                              <table class="table">
                                <tr  >
                                    <td >Amount in words</td>
                                    <td id="sumword2"> </td>
                                </tr>      
                              </table>
                            </div>
                            <div  style="border-top: 1px solid #000;" >
                              <table class="table" id="table_l">
                                 <tr>
                                   <td colspan="2" style="font-weight: 800; text-transform: uppercase;" id="tdfont"> Terma & conditions for school dues</td> 
                                 </tr>
                                 <tr>
                                   <td>1</td>
                                   <td >Fee Voucher will be issued on 1st day of the Month.</td> 
                                 </tr>
                                 <tr>
                                   <td>2</td>
                                   <td >last day for payment in 10th of due Month.</td> 
                                 </tr>
                                 <tr>
                                   <td>3</td>
                                   <td >After due date late fee @ Rs. per day will be charged.</td> 
                                 </tr>
                                 <tr>
                                   <td>4</td>
                                   <td >Name of the defaulter will be struck off after 20th of the Month.</td> 
                                 </tr>
                                 <tr>
                                   <td>5</td>
                                   <td >Re-Admission will br granted after paying Rs. 2,000/- asre-Registration Fee.</td> 
                                 </tr>
                                 <tr>
                                   <td>6</td>
                                   <td >Re-Admission con not be claimed after 10 days of name being struck off.</td> 
                                 </tr>
                                 <tr>
                                   <td>7</td>
                                   <td >In Case of challan lost Rs.100 will be charged for dublicate challan issuance.</td> 
                                 </tr>
                              </table>
                              <div align="left" style="border-top:1px solid #000; text-transform: uppercase; font-size: 10px; font-weight: 800;padding-left: 10px !important;" >
                               bank copy 
                              </div>
                               
                            </div>
                          </div>
                        </div>
                      </div> 
                  </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
        <!-- END PAGE CONTENT-->
    </div>
</div>
<!-- END CONTENT -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/extensions/Scroller/js/dataTables.scroller.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>

<!-- ///// -->
<script src="assets/global/plugins/num_work/js/jquery.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/num_work/js/num-to-words.js" type="text/javascript"></script>

<!-- //////////////////// -->
<!-- END PAGE LEVEL PLUGINS -->
<script src="assets/admin/pages/scripts/table-advanced.js"></script>
<script>
    jQuery(document).ready(function() {
        //here is auto reload after 1 second for time and date in the top
        jQuery(setInterval(function() {
            jQuery("#result").load("index.php/home/iceTime");
        }, 1000));
    });
</script>
<script> 
var words="";
$(function() {
    $(document).ready(per);
    function per() {
        var totalamount = "<?php echo $regfee; ?>";
        words = toWords(totalamount);
        $("#sumword").html(words + "Rupees Only");
        $("#sumword2").html(words + "Rupees Only");
        $("#sumword3").html(words + "Rupees Only");
    }
});
</script> 