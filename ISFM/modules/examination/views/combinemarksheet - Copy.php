<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                   Overall Student Mark's Sheet <?php // echo lang('header_stu_mark_shee'); ?>  <small></small>
                </h3>
                <ul class="page-breadcrumb breadcrumb">
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
                       Overall Student Mark's Sheet <?php // echo lang('header_stu_mark_shee'); ?>
                    </li>
                    <li id="result" class="pull-right topClock"></li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->

        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12" id="print">
                <div class="col-md-12 btn-group floatRight">
                    <button class="btn green-meadow prin-link" onclick="jQuery('#print').print()" type="button"><i class="fa fa-print"></i> Print</button>
                    <button type="button" class="btn btn-default">
                    <a href="javascript:history.back()">
                                <i class="fa fa-mail-reply-all"></i> <?php echo lang('back'); ?> </a>
                                </button>
                </div>       
                <!--BEGIN EXAMPLE TABLE PORTLET-->
                <div class="col-md-12 markshitMotherDive">
                    <h1>The Punjab School <?php //echo $examTitle; ?> <small class="markshitMotherDiveSmol"><?php //echo lang('exa_mrk_shee'); ?></small></h1>
                    <h3> Overall Result <? // echo $examTitle; ?> <small class="markshitMotherDiveSmol"><?php echo lang('exa_mrk_shee'); ?></small></h3>
                    <?php echo lang('exa_stna'); ?> : &nbsp;&nbsp;<?php echo $studentName; ?><br>
                    <?php echo lang('exa_sid'); ?> : &nbsp;&nbsp;<?php echo $studentId ;  ?><br>
                </div>
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <?php echo lang('exa_emarshee'); ?> 
                        </div>
                        <div class="tools">
                        </div>
                    </div>
                    <div class="portlet-body">
                      <div class="row" > 
                       <div class="col-md-4"> 
                        <table class="table table-striped table-bordered table-hover" > <!-- id="sample_1" -->
                            <h3>First Term Examination</h3>
                            <thead align="ceneter">
                                <tr>
                                    <th rowspan="2" style="text-align: center;">
                                       Subjects <?php // echo lang('exa_che_t_3'); ?>
                                    </th>
                                    <th colspan="2" style="text-align: center;">
                                       First Term Examination<?php// echo lang('exa_mark'); ?>
                                    </th> 
                                </tr>
                                <tr> 
                                    <th style="text-align: center;">
                                       Maximum Marks<?php// echo lang('exa_mark'); ?>
                                    </th>
                                    <th style="text-align: center;">
                                       Obtained Marks <?php // echo lang('exa_mark'); ?>
                                    </th> 
                                </tr>
                            </thead>
                            <tbody align="ceneter"> 
                                <tr style="text-align: center;">
                                    <?php foreach($first as $first){ ?>
                                      <script>
                                          localStorage.setItem("tsum", "<?php  echo $second['id']; ?>");
                                      </script>
                                       <td style="text-align: center;">
                                           <?php echo $first['exam_subject']; ?> 
                                       </td>
                                       <td style="text-align: center;" id="myDiv" class="tsum<?php echo $second['id']; ?>">
                                           <?php echo $first['total_mark']; $tdata=$first['total_mark']; @$tsum+=$first['total_mark']; ?> 
                                       </td>
                                       <td style="text-align: center;" class="osum<?php echo $second['id']; ?>"> 
                                           <?php echo $first['mark'];  @$sum+= $first['mark'];  ?> 
                                       </td> 
                                   </tr>
                                <?php }?>
                            
                                    <tr>
                                        <th style="text-align: center;">
                                            Total Marks<?php // echo $row['exam_subject']; ?> 
                                        </th>
                                        <th style="text-align: center;">
                                            <?php echo $tsum; ?> 
                                        </th>
                                        <th style="text-align: center;">
                                            <?php echo $sum; ?> 
                                        </th> 
                                    </tr>
                                     <tr>
                                        <th style="text-align: center;">
                                            Percentage<?php // echo $row['exam_subject']; ?> 
                                        </th>
                                        <th colspan="2" style="text-align: center;">
                                          <?php  @$per= $sum/$tsum*100; echo $per." %";?> 
                                        </th> 
                                         
                                    </tr>
                                    <tr>
                                        <th style="text-align: center;">
                                            Grade<?php /// echo $row['exam_subject']; ?> 
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
                                    </tr>
                                    <tr>
                                        <th style="text-align: center;">
                                            Class Average (%age)<?php /// echo $row['exam_subject']; ?> 
                                        </th>
                                        <td colspan="2">
                                          first term  avg %<?php// echo $row['mark']; ?> 
                                        </td>
 
                                    </tr>  
                            </tbody>
                        </table>
                        </div> 
                        <div class="col-md-4"> 
                        <table class="table table-striped table-bordered table-hover" id="t2"> <!-- id="sample_1" -->
                            <h3>Second Term Examination</h3>
                            <thead align="ceneter">
                                <tr>
                                    <th rowspan="2" style="text-align: center;">
                                       Subjects <?php // echo lang('exa_che_t_3'); ?>
                                    </th>
                                    <th colspan="2" style="text-align: center;">
                                       Second Term Examination<?php// echo lang('exa_mark'); ?>
                                    </th> 
                                </tr>
                                <tr> 
                                    <th style="text-align: center;">
                                       Maximum Marks<?php// echo lang('exa_mark'); ?>
                                    </th>
                                    <th style="text-align: center;">
                                       Obtained Marks <?php // echo lang('exa_mark'); ?>
                                    </th> 
                                </tr>
                            </thead>
                            <tbody align="ceneter"> 
                                <tr style="text-align: center;">

                                    <?php foreach($second as $second){ ?>
                                      <script>
                                          localStorage.setItem("tsum", "<?php echo $second['id']; ?>");
                                      </script>
                                       <td style="text-align: center;">
                                           <?php echo $second['exam_subject']; ?> 
                                       </td>
                                       <td style="text-align: center;" id="myDiv1" class="tsum<?php echo $second['id']; ?>">
                                           <?php echo $second['total_mark'];  @$stsum+=$second['total_mark']; ?> 
                                       </td>
                                       <td style="text-align: center;" class="osum<?php echo $second['id']; ?>"> 
                                           <?php echo $second['mark'];  @$sobsum+= $second['mark'];?> 
                                       </td> 
                                   </tr>
                                <?php }?> 
                                    <tr>
                                        <th style="text-align: center;">
                                            Total Marks<?php /// echo $row['exam_subject']; ?> 
                                        </th>
                                        <th style="text-align: center;">
                                            <?php echo $stsum; ?> 
                                        </th>
                                        <th style="text-align: center;">
                                            <?php echo $sobsum; ?> 
                                        </th> 
                                    </tr>
                                     <tr>
                                        <th style="text-align: center;">
                                            Percentage<?php /// echo $row['exam_subject']; ?> 
                                        </th>
                                        <th colspan="2" style="text-align: center;">
                                          <?php  @$sper= $sobsum/$stsum*100; echo $sper." %";?> 
                                        </th> 
                                         
                                    </tr>
                                    <tr>
                                        <th style="text-align: center;">
                                            Grade<?php /// echo $row['exam_subject']; ?> 
                                        </th>
                                        <th colspan="2" style="text-align: center;">
                                            <?php 
                                            if($sper >= 85){ echo "A+";}
                                            else if($sper>= 75){echo "A-";} 
                                            else if($sper>= 65){echo "B";}
                                            else if($sper>= 60){echo "C";} 
                                            else if($sper>= 65){echo "D";}
                                            ?> 
                                        </th>  
                                    </tr>
                                    <tr>
                                        <th style="text-align: center;">
                                            Class Average (%age)<?php /// echo $row['exam_subject']; ?> 
                                        </th>
                                        <td colspan="2">
                                          first term  avg %<?php// echo $row['mark']; ?> 
                                        </td>
 
                                    </tr>  
                            </tbody>
                        </table>
                        </div> 
                        <div class="col-md-4"> 
                        <table class="table table-striped table-bordered table-hover" id="t3"> <!-- id="sample_1" -->
                            <h3>final Term Examination</h3>
                            <thead align="ceneter">
                                <tr>
                                    <th rowspan="2" style="text-align: center;">
                                       Subjects <?php // echo lang('exa_che_t_3'); ?>
                                    </th>
                                    <th colspan="2" style="text-align: center;">
                                       final Term Examination<?php// echo lang('exa_mark'); ?>
                                    </th> 
                                </tr>
                                <tr> 
                                    <th style="text-align: center;">
                                       Maximum Marks<?php// echo lang('exa_mark'); ?>
                                    </th>
                                    <th style="text-align: center;">
                                       Obtained Marks <?php // echo lang('exa_mark'); ?>
                                    </th> 
                                </tr>
                            </thead>
                            <tbody align="ceneter"> 
                                <tr style="text-align: center;">
                                    <?php foreach($final as $final){ ?>
                            
                                       <td style="text-align: center;">
                                           <?php echo $final['exam_subject']; ?> 
                                       </td>
                                       <td style="text-align: center;" class="tsum">
                                           <?php echo $final['total_mark']; @$ftsum+=$final['total_mark']; ?> 
                                       </td>
                                       <td style="text-align: center;" class="osum"> 
                                           <?php echo $final['mark'];  @$fobsum+= $final['mark'];?> 
                                       </td> 
                                   </tr>
                                <?php }?> 
                                    <tr>
                                        <th style="text-align: center;">
                                            Total Marks<?php /// echo $row['exam_subject']; ?> 
                                        </th>
                                        <th style="text-align: center;">
                                            <?php echo $ftsum; ?> 
                                        </th>
                                        <th style="text-align: center;">
                                            <?php echo $fobsum; ?> 
                                        </th> 
                                    </tr>
                                     <tr>
                                        <th style="text-align: center;">
                                            Percentage<?php /// echo $row['exam_subject']; ?> 
                                        </th>
                                        <th colspan="2" style="text-align: center;">
                                          <?php  @$fper= $fobsum/$ftsum*100; echo $fper." %";?> 
                                        </th> 
                                         
                                    </tr>
                                    <tr>
                                        <th style="text-align: center;">
                                            Grade<?php /// echo $row['exam_subject']; ?> 
                                        </th>
                                        <th colspan="2" style="text-align: center;">
                                            <?php 
                                            if($fper >= 85){ echo "A+";}
                                            else if($fper>= 75){echo "A-";} 
                                            else if($fper>= 65){echo "B";}
                                            else if($fper>= 60){echo "C";} 
                                            else if($fper>= 65){echo "D";}
                                            ?> 
                                        </th>  
                                    </tr>
                                    <tr>
                                        <th style="text-align: center;">
                                            Class Average (%age)<?php /// echo $row['exam_subject']; ?> 
                                        </th>
                                        <td colspan="2">
                                          first term  avg %<?php// echo $row['mark']; ?> 
                                        </td>
 
                                    </tr>  
                            </tbody>
                        </table>
                        </div> 
                      </div> 
                      <!-- Consolidated Result div and table start-->
                      <div class="row">
                          <div class="col-md-12"> 
                        <table class="table table-striped table-bordered table-hover" > <!-- id="sample_1" -->
                            <thead align="ceneter">
                                <tr>
                                    <th rowspan="2" style="text-align: center;">
                                       Subjects <?php // echo lang('exa_che_t_3'); ?>
                                    </th>
                                    <th colspan="2" style="text-align: center;">
                                       Consolidated Result<?php// echo lang('exa_mark'); ?>
                                    </th> 
                                </tr>
                                <tr> 
                                    <th style="text-align: center;">
                                       Maximum Marks<?php// echo lang('exa_mark'); ?>
                                    </th>
                                    <th style="text-align: center;">
                                       Obtained Marks <?php // echo lang('exa_mark'); ?>
                                    </th> 
                                </tr>
                            </thead>
                            <tbody align="ceneter"> 
                                <tr style="text-align: center;">
                                    <?php //foreach($con as $con){ ?>
                            
                                       <td style="text-align: center;">
                                           <?php //echo $con['exam_subject']; ?> 
                                       </td>
                                       <td style="text-align: center;">
                                           <?php //echo "abs"; ?> 
                                       </td>
                                       <td style="text-align: center;"> 
                                           <?php //echo "abs"; ?> 
                                       </td> 
                                   </tr>
                                <?php //}?> 
                                    <tr>
                                        <th style="text-align: center;">
                                            Total Marks<?php // echo $row['exam_subject']; ?> 
                                        </th>
                                        <th style="text-align: center;">
                                            <?php $gsum=$tsum+$stsum+$ftsum; echo $gsum; ?> 
                                        </th> 

                                        <th style="text-align: center;">
                                            <?php $gob_sum= $sum+$sobsum+$fobsum; echo $gob_sum; ?> 
                                        </th>
                                    </tr>
                                     <tr>
                                        <th style="text-align: center;">
                                            Percentage<?php // echo $row['exam_subject']; ?> 
                                        </th>
                                        <th colspan="2" style="text-align: center;">
                                          <?php  @$gper= $gob_sum/$gsum*100; echo $gper." %";?> 
                                        </th> 
                                         
                                    </tr>
                                    <tr>
                                        <th style="text-align: center;">
                                            Grade<?php /// echo $row['exam_subject']; ?> 
                                        </th>
                                        <th colspan="2" style="text-align: center;">
                                            <?php 
                                            if($gper >= 85){ echo "A+";}
                                            else if($gper>= 75){echo "A-";} 
                                            else if($gper>= 65){echo "B";}
                                            else if($gper>= 60){echo "C";} 
                                            else if($gper>= 65){echo "D";} 
                                            ?> 
                                        </th>  
                                    </tr>
                                    <tr>
                                        <th style="text-align: center;">
                                            Class Average (%age)<?php /// echo $row['exam_subject']; ?> 
                                        </th>
                                        <td colspan="2">
                                          first term  avg %<?php// echo $row['mark']; ?> 
                                        </td> 
                                    </tr>  
                            </tbody>
                        </table>
                        </div> 
                      </div>
                <?php 
                //echo $class_id; ?>
               <?php  //echo $examId; ?>
               <?php  //echo $studentId;  ?>
              <!--  <br>second  term
              <br>  
                       <table class="table table-striped table-bordered table-hover">
                           
                           <tr>
                               <td>subject name</td>
                               <td>total mark</td>
                               <td>obtain mark</td>
                               <td></td>
                           </tr>
                           <?php //foreach($first as $first){ ?>
                           <tr>
                               
                               <td><?php //echo $first['exam_subject']; ?></td>
                               <td><?php //echo @$first['total_mark']; ?></td>
                               <td><?php //echo @$first['mark']; ?></td>
                           </tr>
                       <?php //}?>
                       </table>second  term
              <br>  
                       <table class="table table-striped table-bordered table-hover">
                           
                           <tr>
                               <td>subject name</td>
                               <td>total mark</td>
                               <td>obtain mark</td>
                               <td></td>
                           </tr>
                           <?php //foreach($second as $second){ ?>
                           <tr>
                               
                               <td><?php //echo $second['exam_subject']; ?></td>
                               <td><?php //echo @$second['total_mark']; ?></td>
                               <td><?php //echo @$second['mark']; ?></td>
                           </tr>
                       <?php //}?>
                       </table>
              Final  term
              <br> 
                       <table class="table table-striped table-bordered table-hover">
                           
                           <tr>
                               <td>subject name</td>
                               <td>total mark</td>
                               <td>obtain mark</td>
                               <td></td>
                           </tr>
                           <?php 
                          // foreach($final as $final){
                           ?>
                           <tr>
                               
                               <td><?php //echo $final['exam_subject']; ?></td>
                               <td><?php //echo @$final['total_mark']; ?></td>
                               <td><?php //echo @$final['mark']; ?></td>
                           </tr>
                       <?php //}?>
                       </table>
                      <br>
               -->

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
<script>
    var cl_id=localStorage.getItem("tsum"); 
    var sum = 0;
$('.tsum'+cl_id).each(function(){
    sum += parseFloat($(this).text());  // Or this.innerHTML, this.innerText
});

var osum = 0;
$('.osum').each(function(){
    osum += parseFloat($(this).text());  // Or this.innerHTML, this.innerText
});
alert(cl_id);
alert(sum);
//alert(osum);
$(document).ready(function(){ 
  var element = document.getElementById("myDiv");
  element.classList.remove("tsum");
  var element1 = document.getElementById("myDiv1");
  element1.classList.remove("tsum");

});

</script>

