<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                    Result Information<small></small>
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
                       Full Class Result
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
                            <?php echo $this->common->class_title($class_id) .' '. "Full Class Result List Section";
                            if (!empty($section)) {
                                echo "&nbsp".$section;
                            }
                            ?> 
                        </div>
                        <div class="tools">
                        </div>
                    </div>
                    <div class="portlet-body">
                        
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <?php if(!empty($fullResult)){?>
                            <thead> 
                                <tr> 
                                    <th rowspan="2"> 
                                        <?php echo lang('srno'); ?>
                                    </th>
                                    <th rowspan="2">
                                        Student Id
                                    </th>
                                    <th rowspan="2">
                                       Student Name
                                    </th>
                                <?php
                                foreach ($sub as $key ) {
                                ?>
                                    <th>
                                        <?php echo $key['exam_subject']; ?>
                                    </th>
                                <?php } ?> 
                                    <th>
                                        Total
                                    </th>
                                    <th rowspan="2">
                                        %age
                                    </th>
                                    <th rowspan="2">
                                        Grade
                                    </th>
                                </tr>
                                <tr>  
                                <?php 
                                $total=0;
                                 foreach ($tmark as $ke ) {
                                ?>
                                    <th>
                                        <?php echo $ke['total_mark'];  $total+=$ke['total_mark']; ?>
                                    </th>
                                <?php } ?>
                                     
                                    <th>
                                          <?php echo $total; ?>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $id = 0;
                                $flag = 0;
                                $obtain=0;
                                $per=0;
                                foreach ($fullResult as $row ) {
                                    


                                    
                                    if($id != $row['student_id'])
                                        { ?>
                                            <?php
                                      if($i != 1)
                                        { ?>   
                                    <td> <?php  echo $obtain;  ?></td>
                                    <td> <?php $per=($obtain/$total*100); echo $per." %"; $obtain=0;?></td>
                                    <td> 
                                         <?php 
                                            if($per >= 85){ echo "A+";}
                                            else if($per>= 75){echo "A-";} 
                                            else if($per>= 65){echo "B";}
                                            else if($per>= 60){echo "C";} 
                                            else if($per>= 50){echo "D";}
                                            else if($per<= 49){echo "Fail";}
                                        ?>
                                    </td>

                                    </tr>
                                <?php } ?>
                                    <tr >
                                        <td><?php  echo $i; $i++;?></td>
                                        <td><?php echo $row['student_id']; $id=$row['student_id']; if($i != 2) $flag=1;?> </td>
                                        <td><?php echo $row['student_name'];?>  </td>
                                        <?php } else $flag = 0; ?>
                                        <?php 
                                             $sta=($row['mark']/$row['total_mark']*100);
                                              
                                if ($sta <= 40){
                                       echo' <td style="background-color: red;">' ;?>
                                        <?php echo $row['mark'];  $obtain+=$row['mark']; ?>
                                    <?php echo'
                                        </td>';}
                                        else{
                                        echo'<td >'; ?> 
                                        <?php echo $row['mark'];  $obtain+=$row['mark']; ?>
                                        <?php  
                                        echo'  
                                        </td>';}
                                        ?>
                                <?php    
                                }
                                ?>
                                        <td> <?php echo $obtain;?></td>
                                        <td> <?php $per=($obtain/$total*100); echo $per ." %";?></td>
                                        <td> 
                                        <?php 
                                            if($per >= 85){ echo "A+";}
                                            else if($per>= 75){echo "A-";} 
                                            else if($per>= 65){echo "B";}
                                            else if($per>= 50){echo "C";} 
                                            else if($per>= 40){echo "D";}
                                            else if($per<= 39){echo "Fail";}
                                        ?>
                                        </td>
                                    </tr> 
                            </tbody>
                            <?php 
                        }
                        else{
                            echo'<div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                        <div class="alert alert-warning">
                                <strong>Info!</strong> ' ."This class Result Not Fond" . '
                        </div></div></div>';
                        }

                        ?>
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
<script>
    jQuery(document).ready(function () {
//here is auto reload after 1 second for time and date in the top
        jQuery(setInterval(function () {
            jQuery("#result").load("index.php/home/iceTime");
        }, 1000));
    });
</script>
<!-- END PAGE LEVEL script -->