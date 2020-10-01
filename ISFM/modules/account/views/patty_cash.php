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
                    Petty Cash <small></small>
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
                        Petty Cash
                        
                    </li>
                    <li>
                    
                    </li>
                    <li id="result" class="pull-right topClock"></li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->        
        <!-- BEGIN PAGE CONTENT-->        
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            Petty Cash Information 
                        </div>
                        <div class="tools">
                        </div>
                    </div>
                    <div class="portlet-body">
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
                                        <?php echo lang('stu_clas_Student_Name'); ?>
                                    </th>
                                    <th>
                                        Registration Number
                                    </th>
                                   
                                   
                                   
                                    <th>
                                        Cash In Hand
                                    </th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0;
                                foreach ($stu as $row) {
                                    $id = $row['id'];
                                    $class_id = $row['class_id'];
                                   
                                    $total = $row['cash'];
                                    
                                   
                                   ?>

                                    <tr>
                                        <td>
                                            <?php echo $i++; ?>
                                        </td>
                                        <td>
                                            <?php echo $this->common->class_title($class_id); ?>
                                        </td>
                                        
                                         <td>
                                             <?php echo $row['name']; ?>
                                         </td>
                                        
                                       
                                        
                                        <td>
                                            <?php echo $row['reg_number']; ?>
                                        </td>
                                        <td>
                                            <?php echo $total; ?>
                                           
                                        </td>
                                        
                                       
                                       
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        
                    </div>
                     <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>
                                       Total Cash Debit
                                    </th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                               
                                    <tr>
                                        <td>
                                            <?php echo @$total * $i; ?>
                                        </td>
                                        
                                        
                                       
                                       
                                    </tr>
                               
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
