<!-- BEGIN PAGE LEVEL STYLES -->
<head>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN CONTENT -->
<style media="print">
    @page{
        size: auto;
        margin: 0;
    }
    .no-print{
        display: none;
    }
    </style>
 </head>
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title no-print">
                   single <?php echo lang('header_stu_mark_shee'); ?>  <small></small>
                </h3>
                <ul class="page-breadcrumb breadcrumb no-print">
                    <li>
                        <i class="fa fa-home"></i>
                        <?php echo lang('home'); ?>
                    </li>
                    <li>
                        <?php echo lang('header_academic'); ?>
                    </li>
                    <li>
                        <?php echo lang('header_examina'); ?>
                    </li>
                    <li>
                        <?php echo lang('header_stu_mark_shee'); ?>
                    </li>
                    <li id="result" class="pull-right topClock"></li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->

        <!-- BEGIN PAGE CONTENT-->
        <div class="row page1">
            <div class="col-md-12" id="print">
                    <div class="col-md-12 btn-group floatRight pr" >
                       <!-- <button class="btn green-meadow prin-link no-print"  onclick="jQuery('#print').print()" type="button"><i class="fa fa-print"></i> Print</button> -->
                       <button type="button" class="btn btn-default no-print">
                       <a href="javascript:history.back()">
                                   <i class="fa fa-mail-reply-all"></i> <?php  echo lang('back'); ?> </a>
                                   </button>
                    </div>    
                <!--BEGIN EXAMPLE TABLE PORTLET-->
                <div class="col-md-12 markshitMotherDive">
                    <table width="100%">
                        <tbody>
                            <tr>
                                <td style="margin-right: 10%"><img src="assets/admin/layout/img/smlogo.png" alt="logo" width="140px" height="80px"></td>
                                <td style="padding-right: 35%"><h1>The Punjab School <?php //echo $examTitle; ?> <small class="markshitMotherDiveSmol"> <?php //echo lang('exa_mrk_shee'); ?> </small></h1></td>
                            </tr>
                        </tbody>
                    </table>
                   
                    <h3> <?php echo $examTitle; ?> <small class="markshitMotherDiveSmol"><?php echo lang('exa_mrk_shee'); ?></small></h3>
                    <table align="center">
                        <tbody>
                            <tr>
                                <td style="text-align: left"><?php echo lang('exa_stna'); ?> &nbsp </td>
                                 <td style="text-align: left"> : <?php echo $studentName; ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: left"><?php echo lang('exa_sid'); ?> </td>
                                <td style="text-align: left">: <?php echo $studentId; ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: left">Section </td>
                                <td style="text-align: left">: <?php echo $section; ?></td>
                            </tr>
                        </tbody>
                    </table>
                    
                </div>
                <div class="portlet box <?php if($section=='BLUE'){echo'blue';}else if($section=='RED'){echo'red';}else if($section=='GREEN'){echo'green';}else if($section=='YELLOW'){echo'yellow';}else{echo'green';}?>">
                    <div class="portlet-title">
                        <div class="caption">
                            <?php echo lang('exa_emarshee'); ?> 
                        </div>
                        <div class="tools">
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered " id="">
                            <thead align="ceneter">
                                <tr>
                                    <th style="text-align: center;">
                                        <?php echo lang('exa_che_t_3'); ?>
                                    </th>
                                    <th style="text-align: center;">
                                        Total Marks  
                                    </th>
                                    <th style="text-align: center;">
                                       Obtained <?php echo lang('exa_mark'); ?>
                                    </th>
                                    <th style="text-align: center;">
                                       Status <?php // echo lang('exa_mark'); ?>
                                    </th>
                                    <!--<th style="text-align: center;">
                                        <?php // echo lang('exa_grade'); ?>
                                    </th>
                                    <th style="text-align: center;">
                                        <?php // echo lang('exa_point'); ?>
                                    </th>
                                    <th style="text-align: center;">
                                        <?php // echo lang('exa_result'); ?>
                                    </th> -->
                                </tr>
                            </thead>
                            <tbody align="ceneter">

                                <?php  
                                  $status=true;
                                  $tsum=0;
                                  $sum=0;
                                  $singletotal=0;
                                  $singleobtan=0; 
                                   foreach ($markshit as $row) { ?>
                                    <?php
                                             $sta=($row['mark']/$row['total_mark']*100);
                                             $num= 32;
                                     
                                 if ($sta <= $num){ 
                                       $status=false;
                                    echo " 
                                    <tr style='text-align: center; background-color: #dc3545;'>
                                        <td style='background-color: #dc3545;' >";?>
                                            <?php echo $row['exam_subject']; ?> 
                                          <?php echo"   
                                        </td>
                                        <td style='background-color: #dc3545;'>";?>
                                            <?php echo $row['total_mark']; $tsum+=$row['total_mark']; $singletotal=$row['total_mark'];   ?> 
                                        <?php  echo"
                                        </td>
                                        <td style='background-color: #dc3545;'> ";?>
                                            <?php echo $row['mark']; $sum+= $row['mark']; $singleobtan= $row['mark']; ?> 
                                        <?php  echo" 
                                        </td>
                                        <td class='bg-danger' style='background-color: #dc3545;'>
                                          FAIL

                                        </td>    
                                    </tr>  ";?><?php 
                                }
                                             else{

                                                echo "
                                    <tr style='text-align: center;'>
                                        <td  >";
                                        ?>
                                            <?php echo $row['exam_subject']; ?> 
                                       <?php echo" </td>
                                        <td>";?>
                                            <?php echo $row['total_mark'];   $tsum+=$row['total_mark'];  $singletotal=$row['total_mark'];   ?> 
                                       <?php echo" </td>
                                        <td>";?>
                                            <?php echo $row['mark'];  $sum+= $row['mark']; $singleobtan= $row['mark']; ?> 
                                       <?php echo" </td>
                                        <td>
                                          PASS
                                        </td>
                                            
                                    </tr>
                                    ";} ?>
                                <?php } ?>     
                          
                                    <tr>
                                        <th style="text-align: center;">
                                            Total Marks <?php /// echo $row['exam_subject']; ?> 
                                        </th>
                                        <th style="text-align: center;">
                                            <?php echo $tsum; ?> 
                                        </th>
                                        <th style="text-align: center;">
                                            <?php echo $sum; ?> 
                                        </th> 
                                               <?php if($status) { echo " <th class='text-success' style='text-align: center; '>PASS</th>"; }
                                                      else{
                                                        echo " <th class='text-danger' style='text-align: center;';>FAIL</th>";
                                                      }
                                               ?>         
                                    </tr>
                                     <tr>
                                        <th style="text-align: center;">
                                            Percentage <?php /// echo $row['exam_subject']; ?> 
                                        </th>
                                        <th colspan="2" style="text-align: center;">
                                            <?php   @$per= $sum/$tsum*100; echo $per."%";?> 
                                        </th>
                                        <td>
                                             
                                        </td>
                                         
                                    </tr>
                                    <tr>
                                        <th style="text-align: center;">
                                            Grade <?php /// echo $row['exam_subject']; ?> 
                                        </th>
                                        <th colspan="2" style="text-align: center;">
                                            <?php 
                                            if($per >= 85){ echo "A+";}
                                            else if($per>= 75){echo "A-";} 
                                            else if($per>= 65){echo "B";}
                                            else if($per>= 60){echo "C";} 
                                            else if($per>= 65){echo "D";}
                                            ?> 
                                        </th>
                                        <td>
                                             
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="text-align: center;">
                                            Class Average (%age) <?php /// echo $row['exam_subject']; ?> 
                                        </th>
                                        <td colspan="2">
                                            <?php // echo $row['mark']; ?> 
                                        </td>
                                         <td>
                                             
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="text-align: center;">
                                            Attendance Percentage <?php /// echo $row['exam_subject']; ?> 
                                        </th>
                                        <td colspan="2">
                                            <?php // echo $row['mark']; ?>  
                                        </td>
                                         <td>
                                             
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="4">
                                            <label for=""> Remarks</label>
                                        </th>
                                         
                                    </tr>
                                    <tr>
                                       <td colspan="4" style="text-align: left;">
                                           
                                          <?php // foreach($rem as $re){ $data = $re['remarks']; }?>
                                         <?php // echo $data ?>
                            <div class="form-group">
                                <label class="col-md-12 control-label"> Class Teacher : <?php // echo lang('admi_detailschool'); ?>  </label>
                                <div class="col-md-12">
                                    <textarea class="form-control g" name="previous_detail_school" rows="3" data-validation="required" data-validation-error-msg=" <?php // echo lang('admi_admi_detailschool_error_msg'); ?>"> </textarea>
                                </div>
                            </div>
                                       </td> 
                                          
                                    </tr>
                                   <!--  <tr>
                                      <td colspan="3" style="text-align: left;">
                                         <label for="" > Principle :</label>
                                        <textarea name="teacher_remarks" id="teacher_remarks" style="width: 100%;"></textarea>
                                      </td>    
                                   </tr> -->
                                  
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
        ga.src = ('https:' === document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();

</script>

