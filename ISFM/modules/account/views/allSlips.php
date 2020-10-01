<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="assets/global/jquery_ui_css/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<style type="text/css" media="screen">
#loading{
  position:fixed;
  z-index:99999;
  top:0;
  left:0;
  bottom:0;
  right:0;
  background:rgba(0,0,0,0.9);
  transition: 1s 0.4s;
}
    
</style>
<!-- END PAGE LEVEL STYLES -->

<?php $user = $this->ion_auth->user()->row(); $userId = $user->id;?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
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
                    <!-- <li id="result" class="pull-right topClock"></li> -->
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER--> 
        <!-- BEGIN PAGE CONTENT-->
        <div id="loading" align="center">
            <img id="loading_image"  class="home-description" style="padding-top: 15%;" src="assets/images/tpsloder.gif" alt="Loading..." />
        </div>
        <!-- END PAGE CONTENT-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <?php
                if (!empty($message)) {
                    echo '<br>' . $message;
                } 
                ?>
               
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <?php echo lang('acc_stsl');?>
                        </div>
                        <div class="tools">
                            <a href="" class="collapse">
                            </a>
                            <a href="" class="reload">
                            </a>
                        </div>  
                    </div> 
                    <div class="portlet-body"> 
                        <table id="sample_1" class="table table-striped table-bordered table-hover" >
                            <thead>
                                <tr>
                                    <th> S.N. </th>
                                    <th> Year</th>
                                    <th> Month </th>
                                    <th> Due Date </th>
                                    <th> Class </th>
                                    <th> Student ID </th>
                                    <th> Voucher Number </th>
                                    <th> Student Title </th>    
                                    <th> Grand Total </th> 
                                    <th> Net/Discounted Total </th>
                                    <th> Tution Fee Discount</th>
                                    <th> Dues</th>
                                    <th> Balance</th>
                                    <th> Paid </th>
                                    <th> Method </th>
                                    <th> Revise Fee</th>
                                    <th> Payment </th>
                                    <th> Strudent Monthly Fee Voucher </th>
                                    <!-- <th> Monthly Fee Discount </th> -->
                                    <th>perform Action </th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $count=1;
                                foreach ($slips as $row) { ?>
                                    <tr <?php if($row['payment_status']=='Paid'){ echo'style="color:green;"';} ?> >
                                        <td> <?php echo $count++; ?> </td>
                                        <td> <?php echo $row['year']; ?> </td>
                                        <td> <?php echo $row['month']; ?> </td>
                                        <td> <?php echo $row['due_date']; ?> </td>
                                        <td>
                                            <?php echo $this->common->class_title($row['class_id']); ?>
                                        </td>
                                        <td> <?php echo $row['student_id']; ?> </td>
                                        <td> <?php echo $row['voucher_number']; ?> </td>
                                        <td>
                                            <?php echo $this->common->student_title($row['student_id']); ?>
                                        </td>  
                                        <td> <?php echo $row['total']; ?> </td>
                                        <td> <?php echo $row['dis_total']; ?> </td>
                                        <td> <?php echo $row['discount']; ?> </td>
                                        <td> <?php echo $row['dues']; ?> </td>
                                        <td> <?php echo $row['balance']; ?> </td>
                                        <td> <?php echo $row['paid']; ?> </td>
                                        <td> <?php echo $row['mathod']; ?> </td>
                                        <td> 
                                        <?php    
                                            if($row['payment_status']=='Paid'){
                                                echo '<span class="label label-sm label-success">Student Fee Clear</span>';
                                            } elseif ($row['payment_status']=='Not Clear' || $row['payment_status']=='Unpaid'){
                                                echo'<a href="index.php/account/monthlyReviseFee?student_id='.$row['student_id'].'&class_id='. $row['class_id']. '&u_id='. $userId. '&an_fee='. $row['annual_fee']. '&tu_fee='. $row['tution_fee']. '&fee_dis='. $row['discount']. '&dis_total='. $row['dis_total']. '&dis_tu_fee='. $row['dis_tution_fee']. '&ac_char='. $row['ac_charges']. '&year='. $row['year'].'&month='. $row['month']. '"> Revise Fee</a>';
                                            } 
                                        ?>
                                        </td>
                                        <td>
                                        <?php
                                        $status= $this->common->student_status($row['student_id']); 
                                            
                                        if($status=="Active"){
                                            if($row['payment_status']=='Unpaid'){
                                                echo '<span class="label label-sm label-danger">'. $row['payment_status'] .'</span>';
                                            } elseif ($row['payment_status']=='Not Clear'){
                                                echo '<span class="label label-sm label-warning">'. $row['payment_status'] .'</span>';
                                            } else {
                                                echo '<span class="label label-sm label-success">'. $row['payment_status'] .'</span>';
                                            }
                                        } else{
                                            echo '<span class="label label-sm label-danger">Status Defaulter</span>';
                                        }
                                        ?>
                                        </td>
                                        <td>
                                        <?php
                                            $status= $this->common->student_status($row['student_id']); 
                                            
                                        if($status=="Active"){
                                            if($row['payment_status']=='Paid'){
                                                echo '<span class="label label-sm label-success">Student Fee Clear</span>';
                                            } elseif ($row['payment_status']=='Not Clear' || $row['payment_status']=='Unpaid'){
                                                echo '<a href="index.php/account/student_vocher?student_id='. $row['student_id']. '&class_id='. $row['class_id']. '&voch_no='. $row['voucher_number']. '&month='. $row['month']. '&year='. $row['year']. '&due_date='.$row['due_date']. '">Generate Monthly Fee Voucher </a>';
                                            } 
                                        } else{
                                            echo '<span class="label label-sm label-danger">Status Deactive</span>';
                                        }
                                        ?> 
                                           <!--  <a href="index.php/account/student_vocher?student_id=<?php // echo $row['student_id']; ?>&class_id=<?php // echo $row['class_id']; ?>">Student Voucher </a> -->
                                        </td>
                                        <!-- <td>
                                        <?php 
                                        /*$status= $this->common->student_status($row['student_id']); 
                                        if($status=="Active"){
                                            if($row['payment_status']=='Paid'){
                                                echo '<span class="label label-sm label-success">Student Fee Clear</span>';
                                            } elseif ($row['payment_status']=='Not Clear' || $row['payment_status']=='Unpaid'){
                                           echo ' <a href="index.php/account/monthly_discount?student_id='.$row['student_id'].'&class_id='. $row['class_id']. '&u_id='. $userId. '&an_fee='. $row['annual_fee']. '&tu_fee='. $row['tution_fee']. '&ac_char='. $row['ac_charges']. '">Discount</a>';
                                                                               }}else{
                                             echo '<span class="label label-sm label-danger">Status Deactive</span>';
                                            }*/
                                        ?>
                                        </td> -->
                                        <td width="150px;"> 
                                        <?php
                                            $status= $this->common->student_status($row['student_id']); 
                                            
                                             if($status=="Active"){
                                             if($row['payment_status']=='Unpaid'||$row['payment_status']=='Not Clear'){
                                        ?> 
                                                <a class="btn btn-xs default" href="index.php/account/fee_pay?sid=<?php echo $row['student_id']; ?>&class_id=<?php echo $row['class_id'];?>&voch_no=<?php echo $row['voucher_number'];?>&month=<?php echo $row['month'];?>&year=<?php echo $row['year'];?>&due_date=<?php echo $row['due_date'];?>" title="Take Payment"><i class="fa fa-money"></i></a>
                                        <?php } else{echo'&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';}?> 
                                                
                                                <a class="btn btn-xs " href="index.php/account/view_invoice?sid=<?php echo $row['student_id']; ?>" title="View Invoice"><i class="fa fa-eye"></i></a>

                                                <!-- <a class="btn btn-xs green" href="index.php/account/edit_fee_pay?sid=<?php echo $row['student_id']; ?>" title="Edit"><i class="fa fa-pencil-square-o"></i> </a> -->

                                                <a class="btn btn-xs btn-danger" href="index.php/account/slipdel?sid=<?php echo $row['student_id']; ?>" onclick="javascript:return confirm('ARE YOU SURE YOU WANT TO DELETE THIS RECORD ')" title="Delete"><i class="fa fa-trash-o"></i> </a>
                                            <?php 
                                            } else{
                                            echo '<span class="label label-sm label-danger">Status Deactive</span>';
                                            }?>
                                              
                                                 
                                        </td>
                                    </tr>
                                <?php   } ?>
                            </tbody>
                        </table>
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
<!-- END PAGE LEVEL PLUGINS -->
<script src="assets/admin/pages/scripts/table-advanced.js"></script>   

<script>
    jQuery(document).ready(function() {
        //here is auto reload after 1 second for time and date in the top
        jQuery(setInterval(function() {
            jQuery("#result").load("index.php/home/iceTime");
        }, 1000));
        $("#loading").hide();
    });
</script>
<script>
    function showLooder(){
        $("#loading").show();
    }
</script>
<script>
    $('#year').datetimepicker({
    format      :   "YYYY",
    viewMode    :   "years", 
    });
</script>

 