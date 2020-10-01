
<!-- BEGIN CONTENT -->


<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                    <?php echo lang('header_all_exam_date'); ?> <small></small>
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
                        <?php echo lang('header_all_exam_date'); ?>
                    </li>
                    <li id="result" class="pull-right topClock"></li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- BEGIN PAGE CONTENT-->
         
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <?php echo lang('exa_dateSheet'); ?>
                        </div>
                        <div class="tools">
                        </div>
                    </div>
                    
                  
                  
                    <div class="portlet-body">
                         <div class="alert alert-warning">
                            <div class="col-md-12 clearfix">
                                <a class="btn red-sunglo noprint" href="index.php/examination/deleteDateSheet" onclick="javascript:return confirm('<?php echo lang('exa_routi_del_conf'); ?>')"> <?php echo lang('exa_delete_ex_rou'); ?> </a>
                            </div>
                            <div>
                                <button class="btn default printRoutine noprint" onClick="window.print()"> <i class="fa fa-print"></i> <?php echo lang('exa_perou'); ?> </button>
                   <div class="row">
                                    <div class="col-md-12 textAlignCenter">
                                        <H2>The Punjab School</H2>
                                        <p>
                                        <h4 class="rtsh">Date Sheet : Final Date Sheet </h4>
                                        
                                        </p>
                                    </div>
                                </div>
                        <table class="table table-striped table-bordered table-hover table-responsive" id="sample_1">
                            <thead>
                                <tr  style="text-align: center">
                                    <th width="5%">
                                        <?php echo lang('exa_date'); ?>
                                    </th>
                                    <th width="7%">
                                        <?php echo lang('exa_nur'); ?>
                                    </th>
                                    <th width="7%">
                                        <?php echo lang('exa_prep'); ?>
                                    </th>
                                    <th width="7%">
                                        <?php echo lang('exa_I'); ?>
                                    </th>
                                    <th width="7%">
                                        <?php echo lang('exa_II'); ?>
                                    </th>
                                    <th width="7%">
                                        <?php echo lang('exa_III'); ?>
                                    </th>
                                    <th width="7%">
                                        <?php echo lang('exa_IV'); ?>
                                    </th>
                                    <th width="7%">
                                        <?php echo lang('exa_V'); ?>
                                    </th>
                                    <th width="7%">
                                        <?php echo lang('exa_VI'); ?>
                                    </th>
                                    <th width="7%">
                                        <?php echo lang('exa_VII'); ?>
                                    </th>
                                    <th width="7%">
                                        <?php echo lang('exa_VIII'); ?>
                                    </th>
                                    <th width="7%">
                                        <?php echo lang('exa_IX'); ?>
                                    </th>
                                    <th width="8%"> 
                                        <?php echo lang('exa_X'); ?>
                                    </th>
                                  
                                </tr>
                            </thead>
                   
                            <tbody>
                                 <?php foreach($sheet as $row){ 
                                    $compId = $row['id'];
                                    if (!empty($row['nursery'])) {
                            $nurs = $row['nursery'];
                            $nursery_1 = array_map('trim', explode(",", $nurs));
                        }
                          if (!empty($row['prep'])) {
                            $prep = $row['prep'];
                            $prep_1 = array_map('trim', explode(",", $prep));
                        }if (!empty($row['class_1'])) {
                            $class_1 = $row['class_1'];
                            $class_1 = array_map('trim', explode(",", $class_1));
                        }if (!empty($row['class_2'])) {
                            $class_2 = $row['class_2'];
                            $class_2 = array_map('trim', explode(",", $class_2));
                        }if (!empty($row['class_3'])) {
                            $class_3 = $row['class_3'];
                            $class_3 = array_map('trim', explode(",", $class_3));
                        }if (!empty($row['class_4'])) {
                            $class_4 = $row['class_4'];
                            $class_4 = array_map('trim', explode(",", $class_4));
                        }if (!empty($row['class_5'])) {
                            $class_5 = $row['class_5'];
                            $class_5 = array_map('trim', explode(",", $class_5));
                        }if (!empty($row['class_6'])) {
                            $class_6 = $row['class_6'];
                            $class_6 = array_map('trim', explode(",", $class_6));
                        }if (!empty($row['class_7'])) {
                            $class_7 = $row['class_7'];
                            $class_7 = array_map('trim', explode(",", $class_7));
                        }if (!empty($row['class_8'])) {
                            $class_8 = $row['class_8'];
                            $class_8 = array_map('trim', explode(",", $class_8));
                        }if (!empty($row['class_9'])) {
                            $class_9 = $row['class_9'];
                            $class_9 = array_map('trim', explode(",", $class_9));
                        }if (!empty($row['class_10'])) {
                            $class_10 = $row['class_10'];
                            $class_10 = array_map('trim', explode(",", $class_10));
                        }

                                    ?>
                                <tr style="text-align: center">
                                    
                                        <td width="7%">          
                                    <?php echo $row['exam_date']; ?>
                                    </td>
                                      <td width="7%">
                                        
                                        <?php
                                if (!empty($nursery_1['0'])) {
                                    echo $nursery_1['0'];
                                }?><br><h6>room number</h6>
                                <?php if (!empty($nursery_1['1'])) {
                                    echo $nursery_1['1'];
                                }
                                ?><h6>Time</h6>
                                <?php if (!empty($nursery_1['2'])) {
                                    echo $nursery_1['2'];
                                }
                                ?>
                                    </td>
                                      <td width="7%">
                                       <?php
                                if (!empty($prep_1['0'])) {
                                    echo $prep_1['0'];
                                }?><br><h6>room number</h6>
                                <?php if (!empty($prep_1['1'])) {
                                    echo $prep_1['1'];
                                }
                                ?><h6>Time</h6>
                                <?php if (!empty($prep_1['2'])) {
                                    echo $prep_1['2'];
                                }
                                ?>
                                    </td>
                                      <td width="7%"> 
                                       <?php
                                if (!empty($class_1['0'])) {
                                    echo $class_1['0'];
                                }?><br><h6>room number</h6>
                                <?php if (!empty($class_1['1'])) {
                                    echo $class_1['1'];
                                }
                                ?><h6>Time</h6>
                                <?php if (!empty($class_1['2'])) {
                                    echo $class_1['2'];
                                }
                                ?>                                     </td>
                                      <td width="7%">   
                                      <?php
                                if (!empty($class_2['0'])) {
                                    echo $class_2['0'];
                                }?><br><h6>room number</h6>
                                <?php if (!empty($class_2['1'])) {
                                    echo $class_2['1'];
                                }
                                ?>  <h6>Time</h6>
                                <?php if (!empty($class_2['2'])) {
                                    echo $class_2['2'];
                                }
                                ?>                              
                                    </td>
                                      <td width="7%">
                                        <?php
                                if (!empty($class_3['0'])) {
                                    echo $class_3['0'];
                                }?><br><h6>room number</h6>
                                <?php if (!empty($class_3['1'])) {
                                    echo $class_3['1'];
                                }
                                ?> <h6>Time</h6>
                                <?php if (!empty($class_3['2'])) {
                                    echo $class_3['2'];
                                }
                                ?> 
                                    </td>
                                      <td width="7%">
                                         <?php
                                if (!empty($class_4['0'])) {
                                    echo $class_4['0'];
                                }?><br><h6>room number</h6>
                                <?php if (!empty($class_4['1'])) {
                                    echo $class_4['1'];
                                }
                                ?> <h6>Time</h6>
                                <?php if (!empty($class_4['2'])) {
                                    echo $class_4['2'];
                                }
                                ?> 
                                    </td>
                                      <td width="7%">
                                         <?php
                                if (!empty($class_5['0'])) {
                                    echo $class_5['0'];
                                }?><br><h6>room number</h6>
                                <?php if (!empty($class_5['1'])) {
                                    echo $class_5['1'];
                                }
                                ?> <h6>Time</h6>
                                <?php if (!empty($class_5['2'])) {
                                    echo $class_5['2'];
                                }
                                ?> 
                                    </td>
                                      <td width="7%">
                                         <?php
                                if (!empty($class_6['0'])) {
                                    echo $class_6['0'];
                                }?><br><h6>room number</h6>
                                <?php if (!empty($class_6['1'])) {
                                    echo $class_6['1'];
                                }
                                ?> <h6>Time</h6>
                                <?php if (!empty($class_6['2'])) {
                                    echo $class_6['2'];
                                }
                                ?> 
                                    </td>
                                      <td width="7%">
                                         <?php
                                if (!empty($class_7['0'])) {
                                    echo $class_7['0'];
                                }?><br><h6>room number</h6>
                                <?php if (!empty($class_7['1'])) {
                                    echo $class_7['1'];
                                }
                                ?> <h6>Time</h6>
                                <?php if (!empty($class_7['2'])) {
                                    echo $class_7['2'];
                                }
                                ?> 
                                    </td>
                                      <td width="7%">
                                         <?php
                                if (!empty($class_8['0'])) {
                                    echo $class_8['0'];
                                }?><br><h6>room number</h6>
                                <?php if (!empty($class_8['1'])) {
                                    echo $class_8['1'];
                                }
                                ?> <h6>Time</h6>
                                <?php if (!empty($class_8['2'])) {
                                    echo $class_8['2'];
                                }
                                ?> 
                                    </td>
                                      <td width="7%">
                                         <?php
                                if (!empty($class_9['0'])) {
                                    echo $class_9['0'];
                                }?><br><h6>room number</h6>
                                <?php if (!empty($class_9['1'])) {
                                    echo $class_9['1'];
                                }
                                ?> <h6>Time</h6>
                                <?php if (!empty($class_9['2'])) {
                                    echo $class_9['2'];
                                }
                                ?> 
                                    </td>
                                    <td width="7%">
                                         <?php
                                if (!empty($class_10['0'])) {
                                    echo $class_10['0'];
                                }?><br><h6>room number</h6>
                                <?php if (!empty($class_10['1'])) {
                                    echo $class_10['1'];
                                }
                                ?> <h6>Time</h6>
                                <?php if (!empty($class_10['2'])) {
                                    echo $class_10['2'];
                                }
                                ?> 
                                    </td>
                                </tr>
                            <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
                     </div>

                 </div>
               
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>


        </div>
    </div>
        <!-- END PAGE CONTENT-->
    </div>
</div>
<!-- END CONTENT -->


<script>
    jQuery(document).ready(function() {
//here is auto reload after 1 second for time and date in the top
        jQuery(setInterval(function() {
            jQuery("#result").load("index.php/home/iceTime");
        }, 1000));
    });
</script>

