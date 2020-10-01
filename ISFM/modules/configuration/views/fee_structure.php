<!--Start page level style-->
<link rel="stylesheet" type="text/css" href="assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/> 
<link rel="stylesheet" type="text/css" href="assets/global/jquery_ui_css/jquery-ui.css" />
<?php $user = $this->ion_auth->user()->row();
$userId = $user->id; ?>
<!--Start page level style-->
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <?php if(!empty($message)){
                    echo $message;
                }?>
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                    Set Fee Structure <small></small>
                </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <?php echo lang('home'); ?>
                    </li>
                    <li>
                        <?php echo lang('con_configu'); ?>
                    </li>
                    <li>
                        Set Fee Structure <?php // echo lang('con_set_st_fee'); ?>
                    </li>
                    <li id="result" class="pull-right topClock"></li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
          
        <div class="row">
        <?php
        if (!empty($successMessage)) {
            ?>
            <div class="col-md-12">
                <?php echo $successMessage;?>
            </div>
        <?php }?>
            <div class="col-md-4">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            Add Fee Structure
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <?php
                        $form_attributs = array('class' => 'form-horizontal', 'role' => 'form');
                        echo form_open('configuration/fee_structure', $form_attributs);
                        ?>
                        <div class="form-body">
                            <div class="col-md-12"> 
                               <input type="hidden" name="userid" value="<?php echo $userId;?>" readonly>

                                <div class="form-group">
                                    <label class="col-md-4 control-label"> Session </label>
                                    <div class="col-md-8">
                                        <input class="form-control " name="add_year"  id="mask_date1" placeholder="Select..." type="text">
                                    </div>
                                </div>
                               <div class="form-group">
                                   <label class="col-md-4 control-label"> Month </label>
                                   <div class="col-md-8">
                                    <select name="add_month" id="add_month" class="form-control" data-validation="required" data-validation-error-msg="<?php echo "Please Select Month Field First"; ?>" >
                                        <option value="">Select...</option>
                                        <option value="1">January</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                       <!-- <input type="text" class="form-control" name="add_month"  id="mask_date2" placeholder="Select Month...." > -->
 <!-- data-validation="required" data-validation-error-msg="<?php // echo "select session year First"; ?>" -->
                                   </div>
                               </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label"> Admission Fee </label>
                                    <div class="col-md-8">
                                        <input type="text" name="admission_fee" placeholder="Session Admission Fee" class="form-control"data-validation="required" data-validation-error-msg="<?php echo "Add Admission fee first"; ?>">
                                    </div>
                                </div>
                                 
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Annual Funds</label>
                                    <div class="col-md-8">
                                        <input type="text" name="annual_fund" placeholder="Annual Fund" class="form-control"data-validation="required" data-validation-error-msg="<?php echo "Add Annual fund"; ?>">
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Registration Fee</label>
                                    <div class="col-md-8">
                                        <input type="text" name="reg_fee" placeholder="Registration Fee" class="form-control"data-validation="required" data-validation-error-msg="<?php echo "Registration fee is Required"; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-actions fluid">
                            <div class="col-md-offset-3 col-md-6">
                                <button type="submit" class="btn green" name="submit" value="Submit"><?php echo lang('save'); ?></button>
                                <button type="reset" class="btn default"><?php echo lang('refresh'); ?></button>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
            
            <div class="col-md-8">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            List Of All Session
                        </div>
                        <div class="tools">
                        </div>
                    </div>
                    <div class="portlet-body table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                                <tr>
                                    <th>S.N.</th> 
                                    <th>Session Year</th>
                                    <th>Due Month</th>
                                    <th>Session Registration Fee</th>
                                    <th>Session Admission Fee</th>
                                    <th>Session Annual Fee</th>
                                    
                                    
                                     
                                    <th></th>
                                </tr>
                            </thead>
                      
                            <tbody>
                                <?php $i=1;
                                foreach ($fee_structure as $row1){
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $row1['session']; ?></td>
                                        <td>
                                    <?php $month=$row1['month']; 
                                        if($month==1){echo "January";} 
                                        elseif($month==2){echo "February";}
                                        elseif($month==3){echo "March";}
                                        elseif($month==4){echo "April";}
                                        elseif($month==5){echo "May";}
                                        elseif($month==6){echo "June";}
                                        elseif($month==7){echo "July";}
                                        elseif($month==8){echo "August";}
                                        elseif($month==9){echo "September";}
                                        elseif($month==10){echo "October";}
                                        elseif($month==11){echo "November";}
                                        elseif($month==12){echo "December";}
                                        else{echo "no month select";}
                                    ?>   
                                        </td> 
                                        <td><?php echo $row1['registration_fee']; ?></td>
                                        <td><?php echo $row1['admission_fee']; ?></td>
                                        <td><?php echo $row1['annual_fund']; ?></td> 
                                        <td>
                                             <a class="btn btn-xs default" href="index.php/configuration/edit_fee_structure?id=<?php echo $row1['id'];?>" title="Edit Session Fee"> <i class="fa fa-pencil-square-o"></i> <?php // echo lang('edit'); ?> </a>
                                             
                                            <a class="btn btn-xs red" href="index.php/configuration/delete_fee_structure?id=<?php echo $row1['id'];?>" onclick="javascript:return confirm('ARE YOU SURE YOU WANT TO DELETE THIS RECORD ')" title="Delete Session Fee"> <i class="fa fa-trash-o"></i> <?php // echo lang('delete'); ?> </a>   

                                            </td>
                                    </tr>
                                <?php $i++;} ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- END PAGE CONTENT-->

        <!-- BEGIN PAGE CONTENT-->
          
        <div class="row">
        <?php
        if (!empty($successMessage)) {
            ?>
            <div class="col-md-12">
                <?php echo $successMessage;?>
            </div>
        <?php }?>
            <div class="col-md-4">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            Add Class Fee Structure
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <?php
                        $form_attributs = array('class' => 'form-horizontal', 'role' => 'form');
                        echo form_open('configuration/update_class_fee_structure', $form_attributs);
                        ?>
                        <div class="form-body">
                            <div class="col-md-12"> 
                                <input type="hidden" name="userid" value="<?php echo $userId;?>" readonly>
                                <div class="form-group">
                                    <label class="col-md-4 control-label"> Session </label>
                                    <div class="col-md-8">
                                        <input class="form-control" name="session_year" id="mask_date2" placeholder="select..." type="text" >
    <!--  data-validation="required" data-validation-error-msg="<?php // echo "required field"; ?>" -->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label"> Class </label>
                                    <div class="col-md-8">
                                        <select class="form-control" name="class" id="class" onchange="class_id();">
                                            <option value="">Select...</option>
                                            <?php foreach ($classTile as $row){?>
                                            <option value="<?php echo $row['id']?>"><?php echo $row['class_title'];?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                 
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Tution Fee</label>
                                    <div class="col-md-8">
                                      <input type="text" name="tution_fee" id="tution_fee" placeholder="" class="form-control">
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="col-md-4 control-label">A/C Charges</label>
                                    <div class="col-md-8">
                                        <input type="text" name="ac_charges" id="ac_charges" placeholder="" class="form-control">
                                    </div>
                                </div> 
                            </div><div class="clearfix"></div>
                        </div>
                        <div class="form-actions fluid">
                            <div class="col-md-offset-3 col-md-6">
                                <button type="submit" class="btn green" name="submit" value="Submit"><?php echo lang('save'); ?></button>
                                <button type="reset" class="btn default"><?php echo lang('refresh'); ?></button>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
            
            <div class="col-md-8">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            All Class Fee Items
                        </div>
                        <div class="tools">
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="sample_2">
                            <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th> Session Year</th>
                                    <th> Class Title</th>
                                    <th>Tution Fee</th>
                                    <th>A/C Charges</th>
                                </tr>
                            </thead>
                      
                            <tbody>
                                <?php $i=1;
                                foreach ($class_fe_structure as $row2){
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $row2['session']; ?></td>
                                        <td><?php echo $this->common->class_title($row2['class_id']); ?></td>
                                        <td><?php echo $row2['tution_fee']; ?></td>
                                        <td><?php echo $row2['ac_charges']; ?></td>
                                        <!-- <td>
                                             <a class="btn btn-xs default" href="index.php/configuration/edit_fee_structure?id=<?php // echo $row2['id'];?>"> <i class="fa fa-pencil-square-o"></i> <?php // echo lang('edit'); ?> </a>
                                             
                                            <a class="btn btn-xs red" href="index.php/configuration/delete_fee_structure?id=<?php // echo $row2['id'];?>" onclick="javascript:return confirm('ARE YOU SURE YOU WANT TO DELETE THIS RECORD ')"> <i class="fa fa-trash-o"></i> <?php // echo lang('delete'); ?> </a>   
                                        
                                            </td> -->
                                    </tr>
                                <?php $i++;} ?>
                            </tbody>
                        </table>
                    </div>
                </div>
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
<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script src="assets/admin/pages/scripts/table-advanced.js"></script>
<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="assets/global/plugins/jquery.form-validator.min.js"></script>
<script>
    jQuery(document).ready(function() {
//here is auto reload after 1 second for time and date in the top
        jQuery(setInterval(function() {
            jQuery("#result").load("index.php/home/iceTime");
        }, 1000));
    });
</script>

<script>
    $.validate();

    jQuery(document).ready(function () {
        if (jQuery().datepicker) {
            $('.date-picker').datepicker({
                rtl: Metronic.isRTL(),
                orientation: "left",
                autoclose: true,
            });
            //$('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
        }

        //here is auto reload after 1 second for time and date in the top
        jQuery(setInterval(function () {
            jQuery("#result").load("index.php/home/iceTime");
        }, 1000));
    });
</script>
<script>
    function class_id(){
        var class_id  = document.getElementById("class").value;
        var session  = document.getElementById("mask_date2").value;
        //alert (class_id);
        $.ajax({
                url: 'index.php/configuration/update_class_structure',
                type: 'POST',
                data: {class_id:class_id,session:session},
                success: function (result) { 
                   var data = JSON.parse(result);
                  // alert(data)
                    $("#tution_fee").val(data.tution_fee);
                    $("#ac_charges").val(data.ac_charges); 
                }
            }); 
    }
</script>
<script>
  $( function() {
    //alert("hi")
    $( "#mask_date1" ).datepicker({
      minViewMode: 2,
      format: 'yyyy',
      rtl: Metronic.isRTL(),
      orientation: "left",
      autoclose: true,
      yearRange:"2015:2025",
    });
  });
</script>
<script>
  $( function() {
    //alert("hi")
    $( "#mask_date2" ).datepicker({
      minViewMode: 2,
      format: 'yyyy',
      rtl: Metronic.isRTL(),
      orientation: "left",
      autoclose: true,
    });
  });
</script>
 