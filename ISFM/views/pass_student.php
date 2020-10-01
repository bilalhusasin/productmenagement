 <!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<!-- END PAGE LEVEL STYLES -->
<?php $user = $this->ion_auth->user()->row();
$userId = $user->id; ?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                   Pass Student Information  <small></small>
                </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <?php echo lang('home'); ?>
                        
                    </li>
                    <li>
                        <?php echo lang('header_stu_paren'); ?>
                        
                    </li>
                    <li>
                        <?php echo lang('header_stude'); ?>
                        
                    </li>
                    <li>
                        Pass Student
                        
                    </li> 
                    <!-- <li id="result" class="pull-right topClock"></li> -->
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->      
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
                            Pass Student Information   
                        </div>
                        <div class="tools">
                        </div>
                    </div>
                    <div class="portlet-body">
                         
                        <?php $form_attributs = array('class' => 'form-horizontal', 'role' => 'form', 'name' => 'myForm', 'onsubmit' => 'return validateForm()');
                            echo form_open_multipart('users/reg_admission', $form_attributs);
                        ?>

                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                                <tr>
                                    <th>.No</th>
                                    <th>Class Name</th> 
                                    <th><?php echo lang('stu_clas_Student_Name'); ?> </th>
                                    <th>Father Name</th>
                                    <th>Registration Number</th>
                                    <th>Voucher Number</th>
                                    <th>Admission Status</th>
                                    <th>Go For Admission</th>
                                    <!-- <th>
                                        <?php echo lang('stu_clas_Address'); ?>
                                    </th>
                                    <th>
                                        B Form Number
                                    </th> -->
                                    <th>Student Status</th> 
                                    <th>Total Amount</th>
                                    <th>Payable Amount</th>
                                    <th>Total Discount</th>
                                    <th>Paid Status</th>
                                    <th> Admission Fee Voucher</th>
                                    <!-- <th>Admission Fee Discount </th> -->
                                    <th >Voucher <?php echo lang('stu_clas_Actions'); ?></th>
                                </tr>
                            </thead>
                            <tbody> 
                            <?php 
                                $count = 1;
                                foreach ($status as $row) {
                                    $class_id = $row['class_id'];
                                    $reg_num = $row['reg_number'];
                                    $vouch_num=$row['voucher_number'];
                                    $month=$row['month'];

                                   ?>
                                    <tr>
                                        <td> <?php echo $count++; ?> </td>
                                        <td> <?php echo $this->common->class_title($class_id); ?> </td> 
                                        <td class="text-uppercase"> <?php echo $row['student_nam']; ?> </td>
                                        <td class="text-uppercase"> <?php echo $row['father_name']; ?> </td>
                                        <td> <?php echo $reg_num; ?> </td>
                                        <td>  <?php echo $vouch_num; ?> </td>
                                        <td>
                                            <?php if($row['admission_status']=="Admitted"){
                                                echo '<span class="label label-sm label-success">'.$row['admission_status'].'</span>';
                                            } elseif($row['admission_status']=="Not Admitted"){
                                                echo '<span class="label label-sm label-danger">'.$row['admission_status'].'</span>';
                                            } 
                                            ?> 
                                        </td>
                                        <td>
                                            <?php if($row['admission_status']=="Admitted"){
                                                echo '<span class="label label-sm label-success">'.$row['admission_status'].'</span>';
                                            } elseif($row['admission_status']=="Not Admitted"){
                                                if($row['paid_status']=='Paid'){
                                                    echo '<a href="index.php/users/goForAdmissions?reg_id='.$reg_num.'">Go For Admission</a>';
                                                } else{
                                                    echo' Pay Voucher And Go For Admission';       
                                                } 
                                            } 
                                            ?> 
                                        </td>

                                        <!-- <td> <?php // echo $row['present_address']; ?> </td>
                                        <td> <?php // echo $row['b_form']; ?> </td>  -->
                                        <td> <?php echo $row['status']; ?> </td>
                                        <td> <?php echo $row['actual_tot']; ?>  </td>
                                        <td> <?php echo $row['total']; ?>  </td>
                                        <td> <?php echo $row['disc_tot']; ?> </td>
                                        <td>  
                                            <?php
                                            if($row['paid_status']=='unpaid'){
                                                echo '<span class="label label-sm label-danger">'. $row['paid_status'] .'</span>';
                                            } else {
                                                echo '<span class="label label-sm label-success">'. $row['paid_status'] .'</span>';
                                            }?> 
                                        </td> 
                                        <td>
                                           <?php   if($row['paid_status']=='Paid'){
                                                echo '<span class="label label-sm label-success">Student Fee Clear</span>';
                                            } elseif ($row['paid_status']=='unpaid'){
                                                echo '<a href="index.php/users/admi_fee_vouch?r_num='. $row['reg_number']. '">Generate Admission Fee Voucher </a>';
                                            } ?>  
                                        </td>
                                        <!-- <td>
                                              <?php   /*if($row['paid_status']=='Paid'){
                                                  echo '<span class="label label-sm label-success">Student Fee Clear</span>';
                                              } elseif ($row['paid_status']=='unpaid'){
                                                  echo '<a href="index.php/account/discount?reg_id='.$reg_num.'">Discount</a>';
                                              }*/ ?> 
                                          </td> -->  
                                        <td>  
                                            <?php   if($row['paid_status']=='Paid'){ 
                                               echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"; 
                                            } elseif ($row['paid_status']=='unpaid'){
                                                echo '<a class="btn btn-xs default" href="index.php/account/admi_fee_pay?reg_id='.$reg_num.'&admi_fee='.$row['total'].'" title="Take Payment"><i class="fa fa-money"></i></a>';
                                            } ?> 
                                            <a  class="btn btn-xs " href="index.php/account/view_admi_invoice?reg_num=<?php echo $reg_num; ?>" title="View Invoice"><i class="fa fa-eye"></i></a>

                                                <!-- <a class="btn btn-xs green" href="index.php/account/edit_fee_pay?sid=<?php echo $row['student_id']; ?>" title="Edit"><i class="fa fa-pencil-square-o"></i> </a> -->

                                            <!-- <a class="btn btn-xs btn-danger" href="index.php/account/slipdel?sid=<?php echo $row['student_id']; ?>" onclick="javascript:return confirm('ARE YOU SURE YOU WANT TO DELETE THIS RECORD ')" title="Delete"><i class="fa fa-trash-o"></i> </a> -->
                                             
                                        </td>
                                    </tr>                                    
                                <?php  } ?>  
                            </tbody> 
                        </table> 
                        <?php echo form_close(); ?>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
        <!-- END PAGE CONTENT-->
    </div>
</div>
<!-- END CONTENT -->


<!--Begin Page Level Script-->
<script type="text/javascript" src="assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<script src="assets/admin/pages/scripts/table-advanced.js"></script>
<!--End Page Level Script-->
<script>
    jQuery(document).ready(function() {
        //here is auto reload after 1 second for time and date in the top
        jQuery(setInterval(function() {
            jQuery("#result").load("index.php/home/iceTime");
        }, 1000));
    });
</script>
<script>
    /// this function will deled
/*function getVouchVal(){

        var Id= document.getElementById("id").value;
        var Class_id= document.getElementById("class_id").value; 
        var Reg_number= document.getElementById("reg_number").value;
        var Created_by= document.getElementById("created_by").value; 

    request = $.ajax({
        url: "index.php/users/admi_fee_vouch", // ajaxClassExam
        type: "GET",
       data: { id : Id, class_id: Class_id, r_num:Reg_number, u_id:Created_by } 
    });
    request.done(function (response){
    //     console.log(response);
    //alert(response);
     
    })
}*/
</script>