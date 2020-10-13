<?php 
function error_message($style="")// by default On Page - set 'alert' for pop-up
 {  
 
  $ci = &get_instance();
  $msgtypes=array('success','warning','error');
  $msgtype='';
  $msg='';
  foreach($msgtypes as $msgt)
  {
	  $msg=$ci->session->flashdata($msgt);
	  if($msg!='')
	  {
		  $msgtype=$msgt;
		  break;
	  }
  }
  
   if( $msgtype!='' && $msg!='')
   {	 
   
	 if($style=="alert")
	  {
		  ?>
<!--           <div id="alert_box"><div class="alert_area">
            <div class="close">
                <span onclick="$('#alert_box').fadeOut(100);"; class="txt">Close [x]</span>
            </div>
            <div style=" width:100%; text-align:left;"> 
 -->

            <div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                <!-- <strong>Success!</strong> Student Registration Successfully processed. -->
      
		  <?php
	  }
 ?>
 
 
 
        <div class="<?php echo $msgtype;?>" >
            <?php echo $msg; ?>
        </div> 
  
  
  
   
   <?php if($style=="alert")
		{
		  ?>
            </div>     

<!--               </div>
             </div>
            </div> -->
		  <?php
		}
  
    }   
  }