<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
         
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12 ">
                <!-- BEGIN SAMPLE FORM PORTLET-->
                <div class="portlet box green ">
                    <div class="portlet-title">
                        <div class="caption">
                            Add admin
                        </div> 
                    </div>
                    <div class="portlet-body form">
                        <?php
                        $form_attributs = array('class' => 'form-horizontal', 'role' => 'form');
                        echo form_open_multipart('users/addNewUsers', $form_attributs);
                        ?>
                        <div class="form-body">
                            <?php
                            if (!empty($success)) {
                                echo $success;
                            }
                            ?> 
                         
                            <div class="col-lg-9"  >
                                <div class="form-group">
                                    <label class="col-md-3 control-label"> name <span class="requiredStar"> * </span></label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control " placeholder="" name="name"  >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Email <span class="requiredStar"> * </span></label>
                                    <div class="col-md-6">
                                        <input type="email" class="form-control" onkeyup="checkEmail(this.value)" placeholder="demo@demo.com" name="email" placeholder=""  required>
                                        <div id="checkEmail" class="col-md-12"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Password <span class="requiredStar"> * </span></label>
                                    <div class="col-md-6">
                                        <input type="password" class="form-control" name="password" placeholder=""  data-validation="required" data-validation-error-msg="">
                                        <span class="help-block">Password have to 8-20 letter</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"> User Group <span class="requiredStar"> * </span></label>
                                    <div class="col-md-6">
                                        <select class="form-control" name="group" onchange="selectgroup(this.value)">
                                            <option value=""><?php echo lang('select'); ?></option>
                                        <?php
                                        foreach($groupsname as $row){
                                        echo '<option value="'.$row['id'].'" class="text-uppercase">'.$row['name'].'</option>';
                                        }
                                        ?> 
                                        </select>                                   
                                    </div>
                                </div> 
                                <div id="ajaxResult"></div>
                                 
                            </div> 
                            <div class="form-actions fluid">
                                <div class="col-md-offset-3 col-md-6">
                                    <button type="submit" class="btn green" name="submit" value="submit"> Submit</button>
                                    <button type="reset" class="btn default"> Refresh </button>
                                
                                </div>
                            </div> 
                            
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div> 
                <!-- END SAMPLE FORM PORTLET-->
            </div>
        </div>
        <!-- END PAGE CONTENT-->
    </div>
</div>
<!-- END CONTENT -->

<script>
     jQuery(document).ready(function () {
        ComponentsFormTools.init();
    });
    function checkEmail(str) {
        var xmlhttp;
        if (str.length === 0) {
            document.getElementById("checkEmail").innerHTML = "";
            return;
        }
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                document.getElementById("checkEmail").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "index.php/commonController/checkEmail?val=" + str, true);
        xmlhttp.send();
    }

    jQuery(document).ready(function () {
//here is auto reload after 1 second for time and date in the top
        jQuery(setInterval(function () {
            jQuery("#result").load("index.php/home/iceTime");
        }, 1000));
    });

     function selectgroup(str) {
        var xmlhttp;
        if (str.length == 0) {
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
        }
        xmlhttp.open("GET", "index.php/users/ajaxselectgroup?q=" + str, true);
        xmlhttp.send();
    }
</script>

 