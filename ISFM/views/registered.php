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
                   Registered <?php echo lang('stu_clas_pageTitle'); ?> <small></small>
                </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li> <i class="fa fa-home"></i> <?php echo lang('home'); ?> </li>
                    <li> <?php echo lang('header_stu_paren'); ?> </li>
                    <li> <?php echo lang('header_stude'); ?> </li>
                    <li> Registered Students </li>
                    <li> </li>
                    <li id="result" class="pull-right topClock"></li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->        
        <!-- BEGIN PAGE CONTENT-->        
        <div class="row">
            <div class="col-md-12">
                <?php
                    $this->load->helper("display_message_helper");
                    echo error_message('alert');
               /* if (!empty($message)) {
                    echo '<br>' . $message;
                } */
                ?>
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            Registered Students   
                        </div>
                        <div class="tools">
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                                <tr>
                                    <th> Sr.No </th>
                                    <th> Session </th>
                                    <th> Class Name </th>
                                    <th> <?php echo lang('stu_clas_Student_Name'); ?> </th> 
                                    <th> Registration Number </th> 
                                    <th> Registration Fee </th>
                                    <th> Voucher Number </th>
                                    <th> Registration Fee Voucher </th>
                                    <th> Status </th> 
                                    <th> <?php echo lang('stu_clas_Actions'); ?> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($stu as $row) {
                                    $id = $row['id'];
                                    $class_id = $row['class_id'];
                                    $total = $row['total'];
                                    $status = $row['status'];
                                    $registration_fee = $row['registration_fee'];
                                    $session=$row['session'];
                                    $reg_number=$row['reg_number'];
                                    $vouch_num=$row['voucher_number'];
                                   ?>
                                    <tr>
                                        <td> <?php echo $i++; ?> </td>
                                        <td> <?php echo $row['session'];?> </td>
                                        <td> <?php echo $this->common->class_title($class_id); ?> </td>
                                        <td> <?php echo $row['student_nam'];?> </td>
                                        <td> <?php echo $row['reg_number'];?> </td>
                                        <td> <?php echo $row['registration_fee'];; ?> </td>
                                        <td> <?php echo $row['voucher_number'];; ?> </td>
                                        <td> 
                                            <?php
                                            if($status=='Unpaid'){
                                                echo '<a href="index.php/users/vouch?regnum=' .$reg_number.'">Genrate Registration Fee voucher </a>';
                                            } else {
                                               echo '<span class="label label-sm label-success" id="status"> Registration Fee Clear</span>';
                                            }?>
                                            
                                        </td>
                                        <td id="td" >
                                           <?php
                                            if($status=='Unpaid'){
                                                echo '<span class="label label-sm label-danger" id="status">'. $status .'</span>';
                                            } else {
                                                echo '<span class="label label-sm label-success" id="status">'. $status .'</span>';
                                            }?>
                                        </td> 
                                        <td width="100px"> 
                                           
                                            <?php /*if($this->ion_auth->is_accountant()){*/ ?>
                                                <?php if($row['status']=='Unpaid'||$row['status']=='Not Clear'){ ?>
                                                <a class="btn btn-xs default" href="index.php/users/reg_pay?id=<?php echo $row['id']; ?>&regfee=<?php echo $row['registration_fee']; ?>&regnum=<?php echo $reg_number?>" title="Take Payment"><i class="fa fa-money"></i></a>
                                                <?php }?> 
                                                
                                                <a class="btn btn-xs green" href="index.php/users/editregstu?reg_num=<?php echo $reg_number; ?>" title="Edit Student Info"><i class="fa fa-pencil-square-o"></i> </a>
                                                <?php
                                            if($status=='Unpaid'){
                                               echo' <a class="btn btn-xs btn-danger" href="index.php/users/reg_delete?reg_num='. $reg_number.'" onclick="javascript:return confirm('.'ARE YOU SURE YOU WANT TO DELETE THIS RECORD '.')" title="Delete"><i class="fa fa-trash-o"></i> </a>';
                                            } else{ echo "";}
                                             ?>
                                            <?php  //} ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <?php $form_attributs = array('class' => 'form-horizontal', 'role' => 'form', 'name' => 'myForm', 'onsubmit' => 'return validateForm()');
                        echo form_open_multipart('users/sub_total', $form_attributs);
                        ?>
                        <?php foreach($sit as $si){
                            $name = $si['id'];
                        } ?>
                        <!-- <input type="hidden" name="account_id" value="<?php echo $name ?>">
                        <input type="hidden" value="<?php echo $total * $i ?>" name="amount">
                        <input type="submit" class="btn btn-xl green" id="submit"  name="income" value="Submit" > -->
                    <?php // if($this->ion_auth->is_admin()){ ?>
                         <a href="index.php/users/reg_student"  class="btn btn-xl green">After Pay Registration Fee View Students</a>
                    <?php // } ?>
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
    $(document).ready(function(){
        $('#submit').click(function(){
        var a = $('#status').text();
        
        $.post("index.php/users/empty",
            {status: a },
              function(data,status){
      alert(data);
     

            });
});
    }); 
</script>
<script>
</script>
