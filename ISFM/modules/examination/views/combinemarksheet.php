<head>
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<!-- END PAGE LEVEL STYLES -->
<style media="print">
    @page{ 
        margin: 0;
        size: auto;
    }
    .no-print{
        display: none;
    }
     
        /* avoid cutting tr's in half */
    div table  { 
            page-break-inside:avoid;
            
    }
     
  .table_print {
    table-layout: fixed !important;
    width: 33%;
    float: left;
    font-size: 8px !important;
    overflow: none;
  }
  td{
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: normal;
    overflow-wrap: break-word;
    font-size: 8px !important;
  }
  th{
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: normal;
    overflow-wrap: break-word;
    font-size: 10px !important;
  }
  h1{
    font-size: 24px !important; 
  }
  h3{
    font-size: 12px !important; 
  }

p{
    font-size: 8px !important; 
  }
    </style>
    <style>
      div table{
        page-break-inside:avoid;
      }
         

    </style>
 </head>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title no-print">
                   Overall Student Mark's Sheet <?php // echo lang('header_stu_mark_shee'); ?>  <small></small>
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
                          <!-- <button class="btn green-meadow prin-link no-print" onclick="jQuery('#print').print()" type="button"><i class="fa fa-print"></i> Print</button> -->
                          <button type="button" class="btn btn-default no-print">
                          <a href="javascript:history.back()">
                                      <i class="fa fa-mail-reply-all"></i> <?php echo lang('back'); ?> </a>
                                      </button>
                      </div>        
                <!--BEGIN EXAMPLE TABLE PORTLET-->
                <div class="col-md-12 markshitMotherDive">

                    <h1>The Punjab School <?php //echo $examTitle; ?> <small class="markshitMotherDiveSmol"><?php //echo lang('exa_mrk_shee'); ?></small></h1>
                    <h3> Overall Result <?php // echo $examTitle; ?> <small class="markshitMotherDiveSmol"><?php echo lang('exa_mrk_shee'); ?></small></h3>
                    <p><?php echo lang('exa_stna'); ?> : &nbsp;&nbsp;<?php echo $studentName; ?><br></p>
                    <p> Class Section : &nbsp;&nbsp;<?php echo $section ;  ?><br></p>
                    <p><?php echo lang('exa_sid'); ?> : &nbsp;&nbsp;<?php echo $studentId ;  ?><br></p>
                </div>
                <div class="portlet box <?php if($section=='BLUE'){echo'blue';}else if($section=='RED'){echo'red';}else if($section=='GREEN'){echo'green';}else if($section=='YELLOW'){echo'yellow';}?>">
                    <div class="portlet-title">
                        <div class="caption">
                            <?php echo lang('exa_emarshee'); ?> 
                        </div>
                        <div class="tools">
                        </div>
                    </div>
                    <div class="portlet-body">
                      <div class="row">
                        <?php 
                             
                        foreach($results as $key => $subj){
                           // print_r($subj) ;
                           $tsum=0;
                           $sum=0;
                          ?>
                        <div class="col-md-4"> 
                        <table class="table table-striped table-bordered table_print" > <!-- id="sample_1" -->
                            <!-- <h3>First Term Examination</h3> -->
                            <thead align="ceneter">
                                <tr>
                                    <th rowspan="2" style="text-align: center;">
                                       Subjects <?php // echo lang('exa_che_t_3'); ?>
                                    </th>
                                    <th colspan="2" style="text-align: center; color: #28a745; text-transform: uppercase;" >
                                       <?php echo $key; ?>  <?php// echo lang('exa_mark'); ?>
                                    </th> 
                                    <th rowspan="2" style="text-align: center;">
                                       Status <?php // echo lang('exa_mark'); ?>
                                    </th>
                                </tr>
                                <tr> 
                                    <th style="text-align: center;">
                                       Maximum Marks <?php// echo lang('exa_mark'); ?>
                                    </th>
                                    <th style="text-align: center;">
                                       Obtained Marks <?php // echo lang('exa_mark'); ?>
                                    </th> 
                                   
                                </tr>
                            </thead>
                            <tbody align="ceneter"> 
                               <?php    
                               $status=true;
                                    foreach($subj as $key => $first){ ?>
                                      <?php
                                             $sta=($first['mark']/$first['total_mark']*100);
                                             $num= 32;
                                              
                                if ($sta <= $num ){ 
                                     $status=false;
                                  echo "
                                   <tr style='text-align: center; width: auto;' >     
                                       <td style='text-align: center;background-color:#dc3545;'>";?> 
                                           <?php echo $first['exam_subject']; ?> 
                                           <?php echo"
                                       </td>
                                       <td style='text-align: center; background-color:#dc3545;' id='myDiv' >";?>
                                           <?php echo $first['total_mark']; $singletotal = $first['total_mark']; $tsum+=$first['total_mark']; ?> 
                                          <?php echo" 
                                       </td>
                                       <td style='text-align: center; background-color:#dc3545;' > ";?>
                                           <?php echo $first['mark']; $singleobtan=$first['mark'];  $sum+= $first['mark'];  ?> 
                                       <?php echo"
                                       </td> 
                                       <td style='text-align: center; background-color:#dc3545;' > 
                                           Fail
                                       </td>

                                   </tr>";?><?php
                                }
                                else{
                                  echo "
                                   <tr style='text-align: center; width: auto;' >     
                                       <td style='text-align: center;'>";?>
                                            
                                          
                                           <?php echo $first['exam_subject']; ?> 
                                           <?php echo"
                                       </td>
                                       <td style='text-align: center;' id='myDiv' >";?>
                                           <?php echo $first['total_mark']; $singletotal = $first['total_mark']; $tsum+=$first['total_mark']; ?> 
                                          <?php echo" 
                                       </td>
                                       <td style='text-align: center;' > ";?>
                                           <?php echo $first['mark']; $singleobtan=$first['mark'];  $sum+= $first['mark'];  ?> 
                                       <?php echo"
                                       </td> 
                                       <td style='text-align: center;' > 
                                           Pass
                                       </td>

                                   </tr>";} ?>
                                <?php } ?> 
                            
                                    <tr>
                                        <th style="text-align: center;">
                                            Total Marks <?php // echo $row['exam_subject']; ?> 
                                        </th>
                                        <th style="text-align: center;">
                                            <?php echo $tsum; ?> 
                                        </th>
                                        <th style="text-align: center;">
                                            <?php echo $sum; ?> 
                                        </th> 
                                         
                                          <?php if($status) { echo " <th style='text-align: center; color:#28a745;'>PASS</th>"; }
                                                      else{
                                                        echo "<th style='text-align: center; color:#dc3545;'>FAIL</th>";
                                                      }
                                          ?>
                                        
                                    </tr>
                                     <tr>
                                        <th style="text-align: center;">
                                            Percentage <?php // echo $row['exam_subject']; ?> 
                                        </th>
                                        <th colspan="2" style="text-align: center;">
                                          <?php  @$per= $sum/$tsum*100; echo $per." %";?> 
                                        </th> 
                                         <th style="text-align: center;">
                                            
                                        </th>
                                    </tr>
                                    <tr>
                                        <th style="text-align: center;">
                                            Grade <?php // echo $row['exam_subject']; ?> 
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
                                        <th style="text-align: center;">
                                            
                                        </th> 
                                    </tr>
                                    <!-- <tr>
                                        <th style="text-align: center;">
                                            Class Average (%age) <?php /// echo $row['exam_subject']; ?> 
                                        </th>
                                        <td colspan="2">
                                          first term  avg % <?php// echo $row['mark']; ?> 
                                        </td>
                                        <th style="text-align: center;">
                                            
                                        </th>
                                    </tr>   -->
                            </tbody>
                        </table>
                        </div> 
                      <?php } ?>
                      </div> 
                      <!-- Consolidated Result div and table start-->
                      <?php $query=$this->db->query("SELECT DISTINCT exam_subject FROM `result_shit`");
                         $sub = $query->result_array();
                                       //echo print_r($sub[0]);

                      ?>
                      <div class="row">
                        <div class="col-md-12"> 
                        <table class="table table-striped table-bordered table-hover" > <!-- id="sample_1" -->
                            <thead align="ceneter">
                                <tr>
                                    <th rowspan="2" style="text-align: center;">
                                       Subjects <?php // echo lang('exa_che_t_3'); ?>
                                    </th>
                                    <th colspan="2" style="text-align: center;">
                                       Consolidated Result <?php// echo lang('exa_mark'); ?>
                                    </th> 
                                </tr>
                                <tr> 

                                    <th style="text-align: center;">
                                       Maximum Marks <?php// echo lang('exa_mark'); ?>
                                    </th>
                                    <th style="text-align: center;">
                                       Obtained Marks <?php // echo lang('exa_mark'); ?>
                                    </th> 
                                </tr>
                            </thead>
                            <tbody align="ceneter"> 
                                <tr style="text-align: center;">

                                    <?php 
                                    $i = 0;
                                    foreach($sub as $subject){
                                        $subj = $subject['exam_subject'];
                                    $query= $this->db->query("SELECT SUM(mark) as Obt_Marks , SUM(total_mark) as t_Marks FROM `result_shit` WHERE `student_id`=$studentId AND `exam_subject`='$subj'");
                                    $data = $query->result_array();
                                       //echo print_r($data);
 
                                    ?>
                                    <?php foreach($data as $con){ ?>
                              
                                       <td style="text-align: center;">
                                           <?php echo $subj; ?> 
                                       </td>
                                       <td style="text-align: center;">
                                           <?php echo $con['t_Marks'];  @$t_mark+=$con['t_Marks']; ?> 
                                       </td>
                                       <td style="text-align: center;"> 
                                           <?php echo $con['Obt_Marks']; @$O_mark+=$con['Obt_Marks'];?> 
                                       </td> 
                                   </tr>
                                <?php 
                                     }
                                     $i++;}
                            ?> 
                                    <tr>
                                        <th style="text-align: center;">
                                            Total Marks <?php // echo $row['exam_subject']; ?> 
                                        </th>
                                        <th style="text-align: center;">
                                            <?php echo $t_mark; //$gsum=$tsum+$stsum+$ftsum; echo $gsum; ?> 
                                        </th> 

                                        <th style="text-align: center;">
                                            <?php echo $O_mark; //$gob_sum= $sum+$sobsum+$fobsum; echo $gob_sum; ?> 
                                        </th>
                                    </tr>
                                     <tr>
                                        <th style="text-align: center;">
                                            Percentage <?php // echo $row['exam_subject']; ?> 
                                        </th>
                                        <th colspan="2" style="text-align: center;">
                                          <?php echo $gper=$O_mark/$t_mark*100 ." %"; // @$gper= $gob_sum/$gsum*100; echo $gper." %";?> 
                                        </th> 
                                         
                                    </tr>
                                    <tr>
                                        <th style="text-align: center;">
                                            Grade <?php /// echo $row['exam_subject']; ?> 
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
                                    <!-- <tr>
                                        <th style="text-align: center;">
                                            Status <?php /// echo $row['exam_subject']; ?> 
                                        </th>
                                        <th colspan="2" style="text-align: center;">
                                             
                                        </th>  
                                    </tr> -->
                                    <tr>
                                        <th style="text-align: center;">
                                            Class Average (%age) <?php /// echo $row['exam_subject']; ?> 
                                        </th>
                                        <td colspan="2">
                                          first term  avg % <?php// echo $row['mark']; ?> 
                                        </td> 
                                    </tr>  
                            </tbody>
                        </table>
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
    var data="<?php echo $data; ?>"
    alert(data);
    /*var cl_id=localStorage.getItem("tsum"); 
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

});*/

</script>

