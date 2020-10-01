<!--Start page level style-->
<link rel="stylesheet" type="text/css" href="assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>
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
                    <?php echo lang('con_set_fee'); ?> <small></small>
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
                        <?php echo lang('con_set_st_fee'); ?>
                    </li>
                    <li id="result" class="pull-right topClock"></li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
         <?php if($this->ion_auth->is_accountant()){?>
            <div class="row">
                <div class="col-md-12">
                    <a class="btn blue btn-block fee_button" onClick="showLooder();  javascript:return confirm('Are you sure you want to calculate all students fees for this month.')" href="index.php/account/end_stu_calcu" > Calculate Students Month End Fee </a>
                </div>
                <div id="loading" align="center">
                  <img id="loading_image"  class="home-description" style="padding-top: 15%;" src="assets/images/tpsloder.gif" alt="Loading..." />
                </div>
            </div>
        <?php }?>
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
                            Add New Monthly Fee Item
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <?php
                        $form_attributs = array('class' => 'form-horizontal', 'role' => 'form');
                        echo form_open('configuration/setStuFee', $form_attributs);
                        ?>
                        <div class="form-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Class</label>
                                    <div class="col-md-8">
                                        <select class="form-control" name="class" id="class" onchange="class_id(this.value);">
                                            <option value="">Select...</option>
                                            <?php foreach ($classTile as $row){?>
                                            <option value="<?php echo $row['id']?>"><?php echo $row['class_title'];?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div> 
                                <div id="ajaxResult"></div>
                                <div id="ajaxResult2"></div>
                                <!-- <div class="form-group">
                                    <label class="col-md-4 control-label"> Admission Fee </label>
                                    <div class="col-md-8">
                                        <input type="text" name="admission_fee" placeholder="" class="form-control">
                                    </div>
                                </div> -->
                                <!-- <div class="form-group">
                                     <label class="col-md-4 control-label "> Annual Funds </label>
                                     <div class="col-md-8 ">
                                         <input type="text" id = "annual_founds" name="annual_founds" placeholder="" class="form-control" readonly="">
                                     </div>
                                 </div>
                                 <div class="form-group">
                                     <label class="col-md-4 control-label "> Tution Fee </label>
                                     <div class="col-md-8 ">
                                         <input type="text" name="tution_fee" id="tution_fee" placeholder="" class="form-control" readonly="">
                                     </div>
                                 </div>
                                 <div class="form-group">
                                     <label class="col-md-4 control-label "> A/C Charges </label>
                                     <div class="col-md-8 ">
                                         <input type="text" name="ac_charges" id="ac_charges" placeholder="" class="form-control" >
                                     </div>
                                 </div> --> 
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Issue Date :</label>
                                    <div class="col-md-8">
                                         <input class="form-control date-picker" type="text" name="issue_date" id="issue_date" placeholder="dd-mm-yyyy" data-validation-format="dd-mm-yyyy">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Due Date :</label>
                                    <div class="col-md-8">
                                         <input class="form-control date-picker" type="text" name="due_date" id="due_date" placeholder="dd-mm-yyyy" data-validation-format="dd-mm-yyyy">
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
                            All Fee Items
                        </div>
                        <div class="tools">
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th>Session</th>
                                    <th>Class</th>
                                    <th>Fee Month</th> 
                                    <th>Annual Founds</th>
                                    <th>Tuition Fee</th>
                                    <th>A/C Charges</th> 
                                    <th>Issue Date</th>
                                    <th>Due Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                      
                            <tbody>
                                <?php $i=1;
                                foreach ($fee_item as $row1){
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $row1['session']; ?></td>
                                        <td><?php echo $this->common->class_title($row1['class_id']); ?></td>
                                        <td><?php echo $row1['month']; ?></td> 
                                        <td><?php echo $row1['annual_fund']; ?></td>
                                        <td><?php echo $row1['tution_fee']; ?></td>
                                        <td><?php echo $row1['ac_charges']; ?></td>
                                        <td><?php echo $row1['issue_date']; ?></td>
                                        <td><?php echo $row1['due_date']; ?></td>
                                        <td>
                                            <a class="btn btn-xs default" href="index.php/configuration/fee_item_edit?id=<?php echo $row1['id'];?>"> <i class="fa fa-pencil-square-o"></i> <?php echo lang('edit'); ?> </a>

                                            <a class="btn btn-xs red" href="index.php/configuration/delete_fee_item?id=<?php echo $row1['id'];?>&class_id=<?php echo $row1['class_id'];?>" onclick="javascript:return confirm('ARE YOU SURE YOU WANT TO DELETE THIS RECORD ')"> <i class="fa fa-trash-o"></i> <?php echo lang('delete'); ?> </a>


                                              <!--   <a class="btn btn-xs red" href="index.php/configuration/delete_fee_item?id=<?php // echo $row1['id'];?>" onclick="javascript:return confirm('<?php // echo lang('lib_bdeconf'); ?>')"> <i class="fa fa-trash-o"></i> <?php //echo lang('delete'); ?> </a> -->

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
     $("#loading").hide();
    });
</script>
<script>
    function showLooder(){
        $("#loading").show();
    }
</script>
<script>
    $.validate();

    jQuery(document).ready(function () {
        if (jQuery().datepicker) {
            $('.date-picker').datepicker({
                rtl: Metronic.isRTL(),
                orientation: "left",
                autoclose: true
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
    function class_id(str) {
        var xmlhttp;
        if (str.length === 0) {
        document.getElementById("ajaxResult").innerHTML = "";
        return;
        }
        if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
        }
        else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
        document.getElementById("ajaxResult").innerHTML = xmlhttp.responseText;
        }
        };
        xmlhttp.open("GET", "index.php/configuration/get_data?q=" + str, true);
        xmlhttp.send();
    }
</script> 
<script>
    function sessionId(){ 
        var class_id  = document.getElementById("class").value;
        var session  = document.getElementById("session").value;
    request = $.ajax({
        url: "index.php/configuration/ajaxClassMonthFee", // ajaxClassExam
        type: "POST",
       data: { class_id : class_id , session: session } 
    });
    request.done(function (response){
    //     console.log(response);
    if(response)
    { 
        //alert(response);
        $('#ajaxResult2').html(response);
    }
    else{
        alert("Error occured while select exam term");
    }
    })
    }
    
</script>