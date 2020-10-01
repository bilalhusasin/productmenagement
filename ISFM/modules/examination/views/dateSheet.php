<link rel="stylesheet" href="assets/global/plugins/jquery-ui/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="assets/global/jquery_ui_css/jquery-ui.css" />
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
                          <div class="portlet-body form">
                            <form name="reg" onsubmit="return validate()" method="post" action="index.php/examination/dateSheet"/>
                        <?php
                        //$form_attributs = array('class' => 'form-horizontal', 'role' => 'form' , 'name' => 'reg');
                        //echo form_open('examination/dateSheet', $form_attributs);
                        ?><div class="form-body">
                            <?php
                            if (!empty($successMessage)) {
                                echo $successMessage;
                            }
                            ?> 
                            
                            <h3 class="arpl"><?php echo lang('exa_dateSheet'); ?></h3>
                                                
                        <table class="table table-striped table-bordered table-hover" id="sample_1" width="100%">
                            <thead>
                                <tr  style="text-align: center">
                                    <input type="hidden" class="form-control" name="examSubjectFild" value="run">
                   
                                    <th width="6%" >
                                        <?php echo lang('exa_date'); ?>
                                    </th>
                                    <th width="7%" >
                                       PLAYGROUP
                                    </th>
                                    <th width="7%" >
                                        NURSERY
                                    </th>
                                    <th width="7%">
                                        PREP
                                    </th>
                                    
                                    <th width="7%" >
                                        ONE
                                    </th>
                                    <th width="7%" >
                                        TWO
                                    </th>
                                    <th width="7%" >
                                        THREE
                                    </th>
                                    <th width="7%">
                                        FOUR
                                    </th>
                                    <th width="7%" >
                                        FIVE
                                    </th>
                                    <th width="7%" >
                                        SIX
                                    </th>
                                    <th width="7%" >
                                        SEVEN
                                    </th>
                                    
                                  
                                </tr>
                            </thead>
                  

                            <tbody id="tb">
                                                            
                                <tr style="text-align: center" id="t1">
                                    
                                    <td >
                                     <input type="text" class="form-control"  name="examDate" id="mask_date2" data-validation="required" data-validation-error-msg="">          
                                    </td>
                                      <td >
                                        <select class="form-control" name="subject_playgroup" data-validation="required" data-validation-error-msg="">
                                           <option value=""><?php echo lang('exa_ss'); ?></option>
                                             <?php foreach ($sheet1 as $row1) { ?>
                                                <option value="-">-</option>
                                                  <option value="<?php echo $row1['subject']; ?>"><?php echo $row1['subject']; ?></option>
                                                        <?php } ?>
                                            </select>
                                            <h6>Room Num</h6>
                                <input type="text" class="form-control" name="subject_playgroup_1" data-validation="required" data-validation-error-msg="" id="1">
                                <h6>Time</h6>
                                 <input type="text" class="form-control" name="subject_playgroup_2">
                                               
                                    </td>
                                      <td ><select class="form-control" name="subject_nursery" data-validation="required" data-validation-error-msg=""> 
                                           <option value="-"><?php echo lang('exa_ss'); ?></option>
                                              <option value="-">-</option>
                                                <?php foreach ($sheet2 as $row1) { ?>
                                                  <option value="<?php echo $row1['subject']; ?>"><?php echo $row1['subject']; ?></option>
                                                        <?php } ?>
                                            </select>
                                            <h6>Room Num</h6>
                                <input type="text" class="form-control" name="subject_nursery_1"data-validation="required" data-validation-error-msg="" id="2">
                                <h6>Time</h6>
                                <input type="text" class="form-control" name="subject_nursery_2">
                                    </td>
                                      <td ><select class="form-control" name="subject_prep" data-validation="required" data-validation-error-msg="">
                                           <option value="-"><?php echo lang('exa_ss'); ?></option>
                                              <option value="-">-</option>
                                                <?php foreach ($sheet3 as $row1) { ?>
                                                  <option value="<?php echo $row1['subject']; ?>"><?php echo $row1['subject']; ?></option>
                                                        <?php } ?>
                                            </select>
                                            <h6>Room Num</h6>
                                <input type="text" class="form-control" name="subject_prep_1"   data-validation="required" data-validation-error-msg="" id="3">
                                <h6>Tmie</h6>
                                <input type="text" class="form-control" name="subject_prep_2">
                                    </td>
                                      <td ><select class="form-control" name="subject_one" data-validation="required" data-validation-error-msg="">
                                           <option value="-"><?php echo lang('exa_ss'); ?></option>
                                             <option value="-">-</option>
                                               <?php foreach ($sheet4 as $row1) { ?>
                                                  <option value="<?php echo $row1['subject']; ?>"><?php echo $row1['subject']; ?></option>
                                                        <?php } ?>
                                            </select>
                                            <h6>Room Num</h6>
                                <input type="text" class="form-control" name="subject_one_1"   data-validation="required" data-validation-error-msg="" id="4">
                                <h6>Time</h6>
                                <input type="text" class="form-control" name="subject_one_2">
                                    </td>
                                      <td ><select class="form-control" name="subject_two" data-validation="required" data-validation-error-msg="">
                                           <option value="-"><?php echo lang('exa_ss'); ?></option>
                                              <option value="-">-</option>
                                                <?php foreach ($sheet5 as $row1) { ?>
                                                  <option value="<?php echo $row1['subject']; ?>"><?php echo $row1['subject']; ?></option>
                                                        <?php } ?>
                                            </select>
                                    <h6>Room Num</h6>
                                <input type="text" class="form-control" name="subject_two_1"   data-validation="required" data-validation-error-msg="" id="5">
                                <h6>Time</h6>
                                <input type="text" class="form-control" name="subject_two_2">
                                    </td>
                                      <td ><select class="form-control" name="subject_three" data-validation="required" data-validation-error-msg="">
                                           <option value="-"><?php echo lang('exa_ss'); ?></option>
                                               <option value="-">-</option>
                                                 <?php foreach ($sheet6 as $row1) { ?>
                                                    <option value="<?php echo $row1['subject']; ?>"><?php echo $row1['subject']; ?></option>
                                                        <?php } ?>
                                            </select>
                                            <h6>Room Num</h6>
                                <input type="text" class="form-control" name="subject_three_1"   data-validation="required" data-validation-error-msg="" id="6">
                                <h6>Time</h6>
                                <input type="text" class="form-control" name="subject_three_2" >
                                    </td>
                                      <td ><select class="form-control" name="subject_four" data-validation="required" data-validation-error-msg="">
                                         <option value="-"><?php echo lang('exa_ss'); ?></option>
                                            <option value="-">-</option>
                                              <?php foreach ($sheet7 as $row1) { ?>
                                                <option value="<?php echo $row1['id']; ?>">
                                                    <?php echo $row1['subject']; ?></option>
                                                        <?php } ?>
                                            </select>
                                            <h6>Room Num</h6>
                                <input type="text" class="form-control" name="subject_four_1"   data-validation="required" data-validation-error-msg="" id="7">
                                <h6>Time</h6>
                                <input type="text" class="form-control" name="subject_four_2" >
                                    </td>
                                      <td><select class="form-control" name="subject_five" data-validation="required" data-validation-error-msg="">
                                        <option value="-"><?php echo lang('exa_ss'); ?></option>
                                           <option value="-">-</option>
                                              <?php foreach ($sheet8 as $row1) { ?>
                                                 <option value="<?php echo $row1['id']; ?>"><?php echo $row1['subject']; ?></option>
                                                        <?php } ?>
                                               </select>
                                         <h6>Room Num</h6>
                                <input type="text" class="form-control" name="subject_five_1"   data-validation="required" data-validation-error-msg="" id="8">
                                <h6>Time</h6>
                                <input type="text" class="form-control" name="subject_five_2">
                                    </td>
                                      <td ><select class="form-control" name="subject_six" data-validation="required" data-validation-error-msg="">
                                         <option class="-"><?php echo lang('exa_ss'); ?></option>
                                            <option value="-">-</option>
                                               <?php foreach ($sheet9 as $row1) { ?>
                                                 <option value="<?php echo $row1['subject']; ?>"><?php echo $row1['subject']; ?></option>
                                                        <?php } ?>
                                               </select>
                                            <h6>Room Num</h6>
                                <input type="text" class="form-control" name="subject_six_1"   data-validation="required" data-validation-error-msg="" id="9">
                                <h6>Time</h6>
                                <input type="text" class="form-control" name="subject_six_2">
                                    </td>
                                      <td ><select class="form-control" name="subject_seven" data-validation="required" data-validation-error-msg="">
                                         <option value="-"><?php echo lang('exa_ss'); ?></option>
                                            <option value="-">-</option>
                                               <?php foreach ($sheet10 as $row1) { ?>
                                                  <option value="<?php echo $row1['subject']; ?>"><?php echo $row1['subject']; ?></option>
                                                        <?php } ?>
                                            </select>
                                            <h6>Room Num</h6>
                                <input type="text" class="form-control" name="subject_seven_1"   data-validation="required" data-validation-error-msg="" id="10">
                                <h6>Time</h6>
                                <input type="text" class="form-control" name="subject_seven_2" >
                                    </td>
                                    
                                    
                                
                                </tr>
                                
                            </tbody>
                            
                    </table>

                            </div>
                            
                          
                        </div>
                        <div class="addRoutineSubject col-md-12">
                          <button type="submit" class="btn floatRight green" name="submit" value="Submit" id="submit"><?php echo lang('exa_nexar'); ?></button>
                                    <!--<a id="addGroup" class="floatRight btn green">
                                        <i class="fa fa-plus"></i> <?php echo lang('exa_nexar'); ?>
                                    </a>-->
                                </div><div class="clearfix"> </div>
                            </div>
                            <div class="form-actions fluid">
                            <div class="col-md-offset-3 col-md-6">
                            <a href="index.php/examination/completeDateSheet" class="btn default"><?php //echo lang('save'); ?>View</a>
                              <!--<button type="submit" class="btn green" name="submit" value="Submit"><?php //echo lang('save'); ?></button>-->
                                <button type="reset" class="btn default"><?php echo lang('refresh'); ?></button>
                            </div>
                        </div><div class="clearfix"> </div>
                       </form>     
  <?php //echo form_close(); ?>

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

<script src="assets/global/plugins/jquery.form-validator.min.js" type="text/javascript"></script>
<script type="text/javascript" src="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
<script type="text/javascript" src="assets/global/plugins/jquery.input-ip-address-control-1.0.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js"></script>
<script src="assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript"></script>
<script src="assets/global/plugins/typeahead/handlebars.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/typeahead/typeahead.bundle.min.js" type="text/javascript"></script>
<script src="assets/admin/pages/scripts/components-form-tools.js"></script>
<script src="assets/global/plugins/jquery-ui/jquery-ui.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery.form-validator.min.js" type="text/javascript"></script>
<script>
<script> $.validate();</script>
<script>
    jQuery(document).ready(function() {
//here is auto reload after 1 second for time and date in the top
        jQuery(setInterval(function() {
            jQuery("#result").load("index.php/home/iceTime");
        }, 1000));
    });
</script>

<script>
   
    $( function() {
    $( "#mask_date2",  ).datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: "1920:2050"
    });
  } );
   
  </script>
 
  <script>
  $(document).ready(function(){
    $('#submit').mouseover(function(){
      var key1 = $('#1').val();
      var key2 = $('#2').val();
      var key3 = $('#3').val();
      var key4 = $('#4').val();
      var key5 = $('#5').val();
      var key6 = $('#6').val();
      var key7 = $('#7').val();
      var key8 = $('#8').val();
      var key9 = $('#9').val();
      var key10 = $('#10').val();
      var key11 = $('#11').val();
      var key12 = $('#12').val();
      if(key1 == key2){
      	if(key1 != null){}else{
        alert('Room Numbers are Same');
    		}
      }else if (key1 == key3) {
        alert('Room Numbers are Same');
      }else if (key1 == key4) {
        alert('Room Numbers are Same');
      }else if (key1 == key5) {
        alert('Room Numbers are Same');
      }else if (key1 == key6) {
        alert('Room Numbers are Same');
      }else if (key1 == key7) {
        alert('Room Numbers are Same');
      }else if (key1 == key8) {
        alert('Room Numbers are Same');
      }else if (key1 == key9) {
        alert('Room Numbers are Same');
      }else if (key1 == key10) {
        alert('Room Numbers are Same');
      }else if (key1 == key11) {
        alert('Room Numbers are Same');
      }else if (key1 == key12) {
        alert('Room Numbers are Same');
      }else if (key2 == key3) {
      	if(key2 != null){}else{
        alert('Room Numbers are Same');
    		}
      }else if (key2 == key4) {
        alert('Room Numbers are Same');
      }else if (key2 == key5) {
        alert('Room Numbers are Same');
      }else if (key2 == key6) {
        alert('Room Numbers are Same');
      }else if (key2 == key7) {
        alert('Room Numbers are Same');
      }else if (key2 == key8) {
        alert('Room Numbers are Same');
      }else if (key2 == key9) {
        alert('Room Numbers are Same');
      }else if (key2 == key10) {
        alert('Room Numbers are Same');
      }else if (key2 == key11) {
        alert('Room Numbers are Same');
      }else if (key2 == key12) {
        alert('Room Numbers are Same');
      }else if (key3 == key4) {
        if(key3 != null){}else{
        alert('Room Numbers are Same');
    		}
      }else if (key3 == key5) {
        alert('Room Numbers are Same');
      }else if (key3 == key6) {
        alert('Room Numbers are Same');
      }else if (key3 == key7) {
        alert('Room Numbers are Same');
      }else if (key3 == key8) {
        alert('Room Numbers are Same');
      }else if (key3 == key9) {
        alert('Room Numbers are Same');
      }else if (key3 == key10) {
        alert('Room Numbers are Same');
      }else if (key3 == key11) {
        alert('Room Numbers are Same');
      }else if (key3 == key12) {
        alert('Room Numbers are Same');
      }else if (key4 == key5) {
      	if(key4 != null){}else{
        alert('Room Numbers are Same');
    		}
      }else if (key4 == key6) {
        alert('Room Numbers are Same');
      }else if (key4 == key7) {
        alert('Room Numbers are Same');
      }else if (key4 == key8) {
        alert('Room Numbers are Same');
      }else if (key4 == key9) {
        alert('Room Numbers are Same');
      }else if (key4 == key10) {
        alert('Room Numbers are Same');
      }else if (key4 == key11) {
        alert('Room Numbers are Same');
      }else if (key4 == key12) {
        alert('Room Numbers are Same');
      }else if (key5 == key6) {
        if(key5 != null){}else{
        alert('Room Numbers are Same');
    		}
      }else if (key5 == key7) {
        alert('Room Numbers are Same');
      }else if (key5 == key8) {
        alert('Room Numbers are Same');
      }else if (key5 == key9) {
        alert('Room Numbers are Same');
      }else if (key5 == key10) {
        alert('Room Numbers are Same');
      }else if (key5 == key11) {
        alert('Room Numbers are Same');
      }else if (key5 == key12) {
        alert('Room Numbers are Same');
      }else if (key6 == key7) {
        if(key6 != null){}else{
        alert('Room Numbers are Same');
    		}
      }else if (key6 == key8) {
        alert('Room Numbers are Same');
      }else if (key6 == key9) {
        alert('Room Numbers are Same');
      }else if (key6 == key10) {
        alert('Room Numbers are Same');
      }else if (key6 == key11) {
        alert('Room Numbers are Same');
      }else if (key6 == key12) {
        alert('Room Numbers are Same');
      }else if (key7 == key8) {
        if(key7 != null){}else{
        alert('Room Numbers are Same');
    		}
      }else if (key7 == key9) {
        alert('Room Numbers are Same');
      }else if (key7 == key10) {
        alert('Room Numbers are Same');
      }else if (key7 == key11) {
        alert('Room Numbers are Same');
      }else if (key7 == key12) {
        alert('Room Numbers are Same');
      }else if (key8 == key9) {
        if(key8 != null){}else{
        alert('Room Numbers are Same');
    		}
      }else if (key8 == key10) {
        alert('Room Numbers are Same');
      }else if (key8 == key11) {
        alert('Room Numbers are Same');
      }else if (key8 == key12) {
        alert('Room Numbers are Same');
      }else if (key9 == key10) {
        if(key9 != null){}else{
        alert('Room Numbers are Same');
    		}
      }else if (key9 == key11) {
        alert('Room Numbers are Same');
      }else if (key9 == key12) {
        alert('Room Numbers are Same');
      }else if (key10 == key11) {
        if(key10 != null){}else{
        alert('Room Numbers are Same');
    		}
      }else if (key10 == key12) {
        alert('Room Numbers are Same');
      }else if (key11 == key12) {
        if(key11 != null){}else{
        alert('Room Numbers are Same');
    		}
      }
    });

  });  
  </script>
