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
                <?php echo lang('stu_clas_pageTitle'); ?> <small></small>
                </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li><i class="fa fa-home"></i> <?php echo lang('home'); ?> </li>
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
                <ul class="ver-inline-menu" style="width: 12%">
                    <li>
                        <a href="javascript:history.back()"><i class="fa fa-mail-reply-all"></i> <?php echo lang('back'); ?> </a>
                    </li>
                </ul>
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
                        
                        <?php $form_attributs = array('class' => 'form-horizontal', 'role' => 'form', 'name' => 'myForm', 'onsubmit' => 'return validateForm()');
                        echo form_open_multipart('users/reg_admission', $form_attributs);
                        ?>
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                                <tr>
                                    <th>
                                        Sr.No
                                    </th>
                                    <th>
                                        Class Name
                                    </th>
                                    <th>
                                        <?php echo lang('stu_clas_Photo'); ?>
                                    </th>
                                    <th>
                                        <?php echo lang('stu_clas_Student_Name'); ?>
                                    </th> 
                                    <th>
                                        Father Name
                                    </th>
                                    <th>
                                        Registration Number
                                    </th>
                                    <th>
                                        Registration Status
                                    </th>
                                    <th>
                                        Student Discount
                                    </th> 
                                    <th>
                                        Result Status
                                    </th>
                                    
                                    <th>
                                        <?php echo lang('stu_clas_Actions'); ?>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $i = 1;
                                $count = 1;
                                foreach ($stu as $row) {
                                $class_id = $row['class_id'];
                                $reg_no = $row['reg_number']; 
                            ?>
                                <tr>
                                    <td> <?php echo $count++; ?> </td>
                                    <td>
                                        <input type="text" name="class_title_<?php echo $i; ?>" value="<?php echo $this->common->class_title($class_id); ?>" class="form-control" readonly="">
                                        <input type="hidden" name="class_id_<?php echo $i; ?>" value="<?php echo $row['class_id']; ?>" >
                                    </td>
                                    <td>
                                        <div class="tableImage">
                                            <img src="assets/uploads/<?php echo $photo; ?>" alt="">
                                        </div>
                                    </td>
                                    <td>
                                        <input type="text" name="satudentName_<?php echo $i; ?>" value="<?php echo $row['student_nam']; ?>" class="form-control" readonly="">
                                    </td>
                                    <td>
                                        <input type="text" name="fatherName_<?php echo $i; ?>" value="<?php echo $row['father_name']; ?>" class="form-control" readonly="">
                                    </td>
                                    <td>
                                        <input type="text" name="register_num_<?php echo $i; ?>" value="<?php echo $row['reg_number']; ?>" class="form-control" readonly="">
                                    </td>
                                    <td> 
                                        <?php if(empty($row['result_status'])){
                                            echo '<span class="label-success">New Registration</span>';
                                            } elseif($row['result_status']=='fail'){ echo '<span class="label-danger">&nbsp&nbsp&nbsp'.$row['result_status'].'&nbsp&nbsp&nbsp</span>';
                                            }
                                        ?>
                                    </td>
                                    <td> 
                                        <select class="form-control" name="dis_reason_<?php echo $i; ?>"> 
                                        <?php foreach ($fee_dis as $dis){?>
                                            <option value="<?php echo $dis['id']; ?>"><?php echo $dis['discount_reason']; ?></option> 
                                        <?php } ?>
                                        </select>
                                    </td> 
                                    <td>
                                        <select class="form-control" name="status_<?php echo $i; ?>" >
                                    <?php 
                                        if(empty($row['result_status'])){
                                            echo '<option value="">'. lang("select").'</option>';
                                        } else{
                                            echo'<option value="'. $row['result_status'].'">'. $row['result_status'].'</option>';
                                        }
                                    ?> 
                                            <option value="pass">Pass</option>
                                            <option value="fail">Fail</option>
                                        </select>
                                    </td>
                                    
                                    <td width="150px"> 
                                        
                                        <a class="btn btn-xs green" href="index.php/users/editregstu?reg_num=<?php echo $row['reg_number']; ?>" title="Student Info Edit"><i class="fa fa-pencil-square-o"></i> </a>

                                        <!-- <a class="btn btn-xs btn-danger" href="index.php/users/reg_delete?reg_num=<?php echo $row['reg_number']; ?>" onclick="javascript:return confirm('ARE YOU SURE YOU WANT TO DELETE THIS RECORD ')" title="Delete"><i class="fa fa-trash-o"></i> </a>  -->
                                    </td>  
<input type="hidden" name="present_address_<?php echo $i; ?>" value="<?php echo $row['present_address'];?>" readonly="">
<input type="hidden" name="vouch_num_<?php echo $i; ?>" value="<?php echo date('m').date('y').$row['reg_number']; ?>">
<input type="hidden" name="gender_<?php echo $i; ?>" value="<?php echo $row['gender'];?>"  >
<input type="hidden" name="created_by_<?php echo $i; ?>" value="<?php echo $userId;?>" >
<input type="hidden" name="reg_id_<?php echo $i; ?>" value="<?php echo $row['id'];?>" >
<input type="hidden" name="reg_year_<?php echo $i; ?>" value="<?php echo $row['year']; ?>" >
<input type="hidden" name="user_id_<?php echo $i; ?>" value="<?php echo $row['user_id']; ?>" >
<input type="hidden" name="reg_date_<?php echo $i; ?>" value="<?php echo $row['reg_date'];?>" >
<input type="hidden" name="due_date_<?php echo $i; ?>" value="<?php echo $row['due_date'];?>" >
<input type="hidden" name="first_name_<?php echo $i; ?>" value="<?php echo $row['first_name'];?>" >
<input type="hidden" name="last_name_<?php echo $i; ?>" value="<?php echo $row['last_name'];?>" >
<input type="hidden" name="session_<?php echo $i; ?>" value="<?php echo $row['session']; ?>" >
<input type="hidden" name="b_form_<?php echo $i; ?>" value="<?php echo $row['b_form']; ?>" >
<input type="hidden" name="father_cnic_<?php echo $i; ?>" value="<?php echo $row['father_cnic']; ?>" >
<input type="hidden" name="father_occupation_<?php echo $i; ?>" value="<?php echo $row['father_occupation']; ?>" >
<input type="hidden" name="birth_date_<?php echo $i; ?>" value="<?php echo $row['birth_date']; ?>" >
<input type="hidden" name="phone_<?php echo $i; ?>" value="<?php echo $row['phone']; ?>" >
<input type="hidden" name="in_velu" value="<?php echo $i; ?>" >
                                </tr>
                                
                                <?php  $i++; } ?>
                                
                            </tbody>
                        </table>
                        <input class="btn green" type="submit" name="submit" value="admission for student ">
                        <button class="btn default" type="reset"><?php echo lang('refresh'); ?></button>
                        
                        
                        
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