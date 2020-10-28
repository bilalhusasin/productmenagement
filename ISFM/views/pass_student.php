 <!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/> 
<link rel="stylesheet" type="text/css" href="assets/global/jquery_ui_css/jquery-ui.css" />
              
<script src="assets/global/plugins/dataTable/js/canvasjs.min.js"></script>
<script src="assets/global/plugins/dataTable/js/jquery-1.11.3.min.js" type="text/javascript"></script>  
<script src="assets/global/plugins/dataTable/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/dataTable/js/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/dataTable/js/dataTables.scroller.min.js"></script>
<script src="assets/global/plugins/dataTable/js/buttons.flash.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/dataTable/js/jszip.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/dataTable/js/pdfmake.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/dataTable/js/vfs_fonts.js" type="text/javascript"></script>
<script src="assets/global/plugins/dataTable/js/buttons.html5.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/dataTable/js/buttons.print.min.js" type="text/javascript"></script>
<link href="assets/global/plugins/dataTable/css/jquery.dataTables.min.css" rel="stylesheet" />

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
                   Pass Student Information  <small></small>
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
                        Pass Student
                        
                    </li> 
                    <!-- <li id="result" class="pull-right topClock"></li> -->
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->      
        <!-- BEGIN PAGE CONTENT-->        
        <div class="row">
            <div class="col-md-12">
                <?php
                if (!empty($message)) {
                    echo '<br>' . $message;
                }
                ?>
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            Pass Student Information   
                        </div>
                        <div class="tools">
                        </div>
                    </div>
                    <div class="portlet-body">
                         
                        <?php $form_attributs = array('class' => 'form-horizontal', 'role' => 'form', 'name' => 'myForm', 'onsubmit' => 'return validateForm()');
                            echo form_open_multipart('users/reg_admission', $form_attributs);
                        ?>

                        <table class="table table-striped table-bordered table-hover" id="tableOne">
                            <thead>
                                <tr> 
                                    <th>Class Name</th> 
                                    <th><?php echo lang('stu_clas_Student_Name'); ?> </th>
                                    <th>Father Name</th>
                                    <th>Registration Number</th>
                                    <th>Voucher Number</th>
                                    <th>Admission Status</th>
                                    <th>Go For Admission</th> 
                                    <th>Student Status</th> 
                                    <th>Total Amount</th>
                                    <th>Payable Amount</th>
                                    <th>Total Discount</th>
                                    <th>Paid Status</th>
                                    <th> Admission Fee Voucher</th> 
                                    <th >Voucher <?php echo lang('stu_clas_Actions'); ?></th>
                                    
                                </tr>
                            </thead>
                            <tbody> 
                           
                            </tbody> 
                        </table> 
                        <?php echo form_close(); ?>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
        <!-- END PAGE CONTENT-->
         <!-- BEGIN PAGE CONTENT-->  
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet box green">
                            <div class="portlet-title no-print">
                                <div class="caption">
                                   Search Previous Pass Students 
                                </div>
                                <div class="tools">
                                    <a class="collapse" href="javascript:;"> </a>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <div class="col-md-6">
                                    <div class="portlet box purple margin-bottom-15">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <?php echo lang('acc_add_recept'); ?>
                                            </div>
                                            <div class="tools">
                                                <a class="collapse" href="javascript:;">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="portlet-body form">
                                            <!-- BEGIN FORM-->
                                            <?php
                                            $form_attributs = array('class' => 'form-horizontal', 'role' => 'form');
                                            echo form_open('account/studentDetailLedger', $form_attributs);
                                            ?>
                                            <div class="form-body">   
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label"> Session </label>
                                                    <div class="col-md-8">
                                                        <input class="form-control" name="session_year" id="session_year" placeholder="select..." type="text" onchange ="selectYear(this.value);"> 
                                                    </div>
                                                </div>  
                                                <div class="form-actions bottom fluid "> 
                                                        <button class="btn green" type="reset"><?php echo lang('refresh'); ?></button>
                                                   
                                                </div>  
                                                <?php echo form_close(); ?>
                                                <!-- END FORM-->
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>          
        <div class="row">
            <div class="col-md-12"> 
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                          Previous Pass Student Information   
                        </div>
                        <div class="tools">
                        </div>
                    </div>
                    <div class="portlet-body">
                         
                        <?php $form_attributs = array('class' => 'form-horizontal', 'role' => 'form', 'name' => 'myForm', 'onsubmit' => 'return validateForm()');
                            echo form_open_multipart('users/reg_admission', $form_attributs);
                        ?>

                        <table class="table table-striped table-bordered table-hover" id="sample_2">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Class Name</th> 
                                    <th><?php echo lang('stu_clas_Student_Name'); ?> </th>
                                    <th>Father Name</th>
                                    <th>Registration Number</th>
                                    <th>Voucher Number</th>
                                    <th>Admission Status</th>  
                                    <th>Student Status</th> 
                                    <th>Total Amount</th>
                                    <th>Payable Amount</th>
                                    <th>Total Discount</th>
                                    <th>Paid Status</th> 
                                </tr>
                            </thead>
                            <tbody  id="ajaxResult2"> 
                             
                            </tbody> 
                        </table> 
                        <?php echo form_close(); ?>
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
<!-- END PAGE LEVEL PLUGINS -->
<script src="assets/admin/pages/scripts/table-advanced.js"></script>
<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="assets/global/plugins/jquery.form-validator.min.js"></script>
<!--End Page Level Script-->
 
<script>
    $.validate();

    jQuery(document).ready(function () {
        if (jQuery().datepicker) {
            $('.date-picker').datepicker({
                rtl: Metronic.isRTL(),
                orientation: "left",
                autoclose: true,
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
  $( function() {
    //alert("hi")
    $( "#session_year" ).datepicker({
      minViewMode: 2,
      format: 'yyyy',
      rtl: Metronic.isRTL(),
      orientation: "left",
      autoclose: true,
      yearRange:"2015:2025",
    });
  });
</script>
<script>  
function selectYear(str){ 
        var year= document.getElementById("session_year").value; 
       // alert(year);
    request = $.ajax({
        url: "index.php/account/ajaxPreiousPassStudents", // ajaxClassExam
        type: "GET",
       data: { q: year } 
    });
    request.done(function (response){ 
    if(response)
    {
        //alert(response); 
        $('#ajaxResult2').html(response);  
    }
    else{
        alert(" Please Enter Correct Student Id.");
    }
    })
}
</script>
<script type="text/javascript">
         var table;  
$(document).ready(function ()  
{  
 // Setup - add a text input to each footer cell
/*    $('#datatable tfoot th').each( function () {
        var title = $(this).text();
        //console.log(title);
        $(this).html( '<input type="text" style="width:90px;" placeholder="'+$(this).text()+'" />' );
    } );*/

      table = $('#tableOne').dataTable(  
    {
        "bSort": false,
        "pagingType": "full_numbers",
        "dom": 'Bfrtip',
        "lengthMenu": [[10, 25, 50, -1],[10, 25, 50, "All"]

    ], 
"data" : <?php echo json_encode($status); ?>,
"columns": [
            
            { data: "class_id" },
            { data: "student_nam" },
            { data: "father_name"},
            { data: "reg_number" },
            { data: "voucher_number" },
            { data: "admission_status",
                "render": function (data, type, row) {
                    if (row.admission_status === 'Admitted') {
                     return '<span class="label label-sm label-success">'+row.admission_status+'</span>';
                    } else if (row.admission_status === 'Not Admitted') {
                     return '<span class="label label-sm label-danger">'+row.admission_status+'</span>';
                    } else {
                     return 'Not Record';
                    } 
                }
            },
            { data: "admission_status",
                "render": function (data, type, row) {
                    if (row.admission_status === 'Admitted') {
                        return '<span class="label label-sm label-success">'+row.admission_status+'</span>';
                    } else if (row.admission_status === 'Not Admitted') {
                        if (row.paid_status === 'Paid') {
                            return '<a href="index.php/users/goForAdmissions?reg_id='+row.reg_number+'">Go For Admission</a>';
                        } else if(row.paid_status === 'unpaid'){
                            return '<span class="label label-sm label-danger"> Pay Voucher And Go For Admission </span>';
                        }  
                    } else {
                     return 'Not Record';
                    } 
                }
            },
            { data: "status" },
            { data: "actual_tot" },
            { data: "total" },
            { data: "disc_tot" },
            { data: "paid_status",
                "render": function (data, type, row) {
                    if (row.paid_status === 'unpaid') {
                     return '<span class="label label-sm label-danger">'+row.paid_status +'</span>';
                    } else {
                     return '<span class="label label-sm label-success">'+row.paid_status +'</span>';
                    } 
                }
            },
            { data: "paid_status", 

                "render": function (data, type, row) {
                   if (row.paid_status === 'Paid') {
                     return '<span class="label label-sm label-success">Student Fee Clear</span>';
                   } else {
                     return '<a href="index.php/users/admi_fee_vouch?r_num='+row.reg_number+ '">Generate Admission Fee Voucher </a>';
                    } 
                }
            },

            { data: "paid_status",
                "render": function (data, type, row) {
                   if (row.paid_status === 'Paid') {
                     var takePayment= '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
                   } else if(row.paid_status === 'unpaid') {
                   var takePayment= '<a class="btn btn-xs default" href="index.php/account/admi_fee_pay?reg_id='+row.reg_number+'&admi_fee='+row.total+'" title="Take Payment"><i class="fa fa-money"></i></a>';
                    }
                   return takePayment + '<a  class="btn btn-xs " href="index.php/account/view_admi_invoice?reg_num='+row.reg_number+'" title="View Invoice"><i class="fa fa-eye"></i></a>';
                }
            }
        ],
        deferRender:    true,
          scrollY:        "300px",
        scrollX:        true,
        scrollCollapse: true,
        fixedColumns:   true,
         scroller:       true,
        /*initComplete: function () {
            // Apply the search
            this.api().columns().every( function () {
                var that = this;
 
                $( 'input', this.footer() ).on( 'keyup change clear', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        },*/
        
       /* "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 7 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 7, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 7 ).footer() ).html(
                'Page Total: '+pageTotal +' '+'\n Grand Total: '+ total +'  '
            );


//// column 8 //// 
 // Total over all pages
            total1 = api
                .column( 8 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal1 = api
                .column( 8, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 8 ).footer() ).html(
                'Page Total: '+pageTotal1 +' '+'\n Grand Total: '+ total1 +'  '
            );

//// column 9 //// 
 // Total over all pages
            total2 = api
                .column( 9 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal2 = api
                .column( 9, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 9 ).footer() ).html(
                'Page Total: '+pageTotal2 +' '+'\n Grand Total: '+ total2 +'  '
            );
            //// column 10 //// 
 // Total over all pages
            total3 = api
                .column( 10 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal3 = api
                .column( 10, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 10 ).footer() ).html(
                'Page Total: '+pageTotal3 +' '+'\n Grand Total: '+ total3 +'  '
            );

            //// column 11 //// 
 // Total over all pages
            total4 = api
                .column( 11 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal4 = api
                .column( 11, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 11 ).footer() ).html(
                'Page Total: '+pageTotal4 +' '+'\n Grand Total: '+ total4 +'  '
            );

            //// column 12 //// 
 // Total over all pages
            total5 = api
                .column( 12 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal5 = api
                .column( 12, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 12 ).footer() ).html(
                'Page Total: '+pageTotal5 +' '+'\n Grand Total: '+ total5 +'  '
            );
        }*/
    }); 
});  
</script>