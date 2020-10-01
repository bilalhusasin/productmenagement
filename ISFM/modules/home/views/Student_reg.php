<!-- Begin PAGE STYLES -->
<link href="assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet"/>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

 <script src="https://code.jquery.com/jquery-1.11.3.min.js" type="text/javascript"></script>  
        <script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js" type="text/javascript"></script>
       
        <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js" type="text/javascript"></script>
        <script src="https://cdn.datatables.net/scroller/2.0.2/js/dataTables.scroller.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" type="text/javascript"></script>
          <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js" type="text/javascript"></script>
           <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js" type="text/javascript"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css" /> 
         <script type="text/javascript">
         var table;  
$(document).ready(function ()  
{  

 // Setup - add a text input to each footer cell
    $('#datatable tfoot th').each( function () {
        var title = $(this).text();
        console.log(title);
        $(this).html( '<input type="text" placeholder="'+$(this).text()+'" />' );
    } );

      table = $('#datatable').dataTable(  
    {
        "bSort": false,
        "pagingType": "full_numbers",
        "dom": 'Bfrtip',
        "lengthMenu": [[10, 25, 50, -1],[10, 25, 50, "All"]

    ], 
"data" : <?php echo json_encode($stdInfo); ?>,
"columns": [
            
            { data: "reg_date" },
            { data: "reg_number" },

            { data: "student_nam" },
            { data: "father_name" },
            { data: "class_title" },
            
            
            { data: "total" }
            
        ],

    "buttons": [
            { extend: 'copyHtml5', footer: true },
            { extend: 'excelHtml5', footer: true },
            { extend: 'csvHtml5', title: 'Student Registration Report(TPS)',footer: true },
            { extend: 'pdfHtml5',  title: 'Student Registration Report(TPS)',footer: true }
        ],
        deferRender:    true,
          scrollY:        "300px",
        scrollX:        true,
        scrollCollapse: true,
        fixedColumns:   true,
         scroller:       true,
          initComplete: function () {
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
        },
        "footerCallback": function ( row, data, start, end, display ) {
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
                .column( 5 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 5, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 5 ).footer() ).html(
                'Page Total: '+pageTotal +' pkr'+'\n Grand Total: '+ total +'  pkr'
            );
        }



    }); 


   

});  



 

        </script>
<
<!-- End PAGE STYLES -->
<!-- Begin CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- Begin Page Header-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                    <?php echo ('Registration Report'); ?> <small></small>
                </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <?php echo lang('des_home'); ?>
                    </li>
                    <li id="result" class="pull-right topClock"></li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <?php
        $user = $this->ion_auth->user()->row();
        $userId = $user->id;
        ?>
        <!-- BEGIN DASHBOARD-->
        <?php if ($this->common->user_access('das_top_info', $userId)) { ?>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat blue-madison">
                        <div class="visual">
                            <i class="fa fa-group"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <?php echo $totalStudent; ?>
                            </div>
                            <div class="desc">
                                <?php echo ('Total Students'); ?>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat red-intense">
                        <div class="visual">
                            <span class="icon-users totalTeacherSpan" aria-hidden="true"></span>
                        </div>
                        <div class="details">
                            <div class="number">
                                <?php echo $total_paid; ?>
                            </div>
                            <div class="desc">
                                <?php echo ('Paid Students'); ?>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat green-haze">
                        <div class="visual">
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <?php echo $Deactive_stds; ?>
                            </div>
                            <div class="desc">
                                <?php echo ('Unpaid Students'); ?>
                            </div>
                        </div>
                       
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat purple-plum">
                        <div class="visual">
                            <i class="fa fa-bar-chart-o"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <?php echo $Active_stds; ?>
                            </div>
                            <div class="desc">
                                <?php echo ('Total Amount'); ?>
                            </div>
                        </div>

                        
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat purple-plum">
                        <div class="visual">
                            <i class="fa fa-bar-chart-o"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <?php echo $get_total; ?>
                            </div>
                            <div class="desc">
                                <?php echo ('Expected Amount'); ?>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        <?php } //if($this->ion_auth->is_accountant()){?>
            <!-- <div class="row">
                <div class="col-md-12">
                    <a class="btn blue btn-block fee_button" onClick="javascript:return confirm('Are you sure you want to calculate all students fees for this month.')" href="index.php/account/end_stu_calcu" > Calculate Students Month End Fee </a>
                </div>
            </div> -->
        <?php //} 
        if ($this->common->user_access('das_grab_chart', $userId)) { ?>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <!-- BEGIN PORTLET-->
                    <div class="portlet green box">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-bullhorn"></i><?php echo ('Class wise Registration Trend'); ?>
                            </div>
                        </div>
                        <div class="portlet-body">
                          <canvas id="myChart"></canvas>
                                </div>

                           
                            <div id="site_activities_content" class="display-none">
                                
                            </div>
                        </div>
                    </div>
                    <!-- END PORTLET-->
                </div>
            
            <div class="clearfix">
            </div>
        <?php } ?>
        <?php if ($this->ion_auth->is_student()) { ?>
            <div class="row">
                <div class="col-md-12 ">
                    <!-- BEGIN SAMPLE FORM PORTLET-->
                    <div class="portlet box green ">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-bars"></i><?php
                                $class_id;
                                echo $this->common->class_title($class_id);
                                ?> <?php echo lang('des_ful_rou'); ?>.
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse">
                                </a>
                                <a href="javascript:;" class="reload">
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body form">

                            <div class="alert alert-warning">
                                <div class="portlet-body">
                                    <?php
                                    foreach ($day as $row3) {
                                        $dayTitle = $row3['day_name'];
                                        $dayStatus = $row3['status'];
                                        ?>
                                        <div class="row">
                                            <div class="col-md-12 dbilcss5">
                                                <div class="col-sm-2 day <?php echo $dayStatus; ?>">
                                                    <?php echo $dayTitle; ?>
                                                </div>
                                                <?php
                                                //$query = array();
                                                $query = $this->common->getWhere22('class_routine', 'day_title', $dayTitle, 'class_id', $class_id);
                                                foreach ($query as $row4) {
                                                    ?>
                                                    <div class="">
                                                        <div class="col-sm-2 effect left_to_right dbilcss6">
                                                            <div class="backDiv subject">
                                                                <p class="dbilcss7"><?php echo $row4['subject']; ?></p>
                                                                <p class="dbilcss7"><?php echo $row4['subject_teacher']; ?></p>
                                                                <p class="dbilcss8"><?php echo $row4['start_time']; ?> - <?php echo $row4['end_time']; ?></p>
                                                                <p class="dbilcss8">Rome: <?php echo $row4['room_number']; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END SAMPLE FORM PORTLET-->
                </div>
            </div>
        <?php } ?>        
        <div class="row ">
            <?php if ($this->common->user_access('das_class_info', $userId)) { ?>
                <div class="col-md-12 col-sm-12">
                    <div class="portlet purple box">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-cogs"></i><?php echo ('Student Registration information'); ?>
                            </div>
                            <div class="tools">
                                <a class="collapse" href="javascript:;">
                                </a>
                                <a class="reload" href="javascript:;">
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="" data-always-visible="1" data-rail-visible="0">
                                <div class="">
                                    <table id="datatable" class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                               
                                                <th>Date
                                                </th>
                                                <th>Student Reg
                                                </th>
                                               
                                              
                                                <th>Student Name
                                                </th>
                                                <th>Father Name
                                                </th>
                                                <th>Class
                                                </th>
                                                <th>Amount
                                                </th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                        </tbody>
                                        <tfoot>
                                             <tr>
                                               
                                                <th>Date
                                                </th>
                                                <th>Student Reg
                                                </th>
                                               
                                                <th>Student Name
                                                </th>
                                                <th>Father Name
                                                </th>
                                                <th>Class
                                                </th>
                                                <th>Amount
                                                </th>
                                                
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            <?php }?>
                
            <?php  if ($this->common->user_access('das_employ_attend', $userId)) { ?>

                

                
            <?php } ?>
            <?php if ($this->common->user_access('das_notice', $userId)) { ?>  
                
            <?php } ?>
        </div>
        </div>
        <div class="clearfix"></div>
        <div class="row ">
            <div class="col-md-12 col-sm-12">
                <!-- BEGIN PORTLET-->
                
                <!-- END PORTLET-->
            </div>

        </div>
        <!-- END DASHBOARD STATS -->
    </div>
</div>
<!-- END CONTENT -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
<script src="assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
<script src="assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
<script src="assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
<script src="assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
<script src="assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
<script src="assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>

<script src="assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>

<script src="assets/global/plugins/jquery.pulsate.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
<script src="assets/global/plugins/fullcalendar/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="assets/admin/pages/scripts/index.js" type="text/javascript"></script>
<script src="assets/admin/pages/scripts/tasks.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

<script>

//var ctx = document.getElementById('myChart').getContext('2d');
var canvas = document.getElementById('myChart');
var data = {
    labels: [
<?php
foreach ($date_wise_students as $cap) {
    echo "'" . $cap['title'] . "', ";
}
?>
    ],
    datasets: [
        {
            label: "Registration amount with respect to class",
            backgroundColor: "rgb(227, 91, 90)",
            borderColor: "rgba(255,99,132,1)",
            borderWidth: 2,
            hoverBackgroundColor: "rgba(255,99,132,0.4)",
            hoverBorderColor: "rgba(255,99,132,1)",
            data: [
<?php
foreach ($date_wise_students as $cap) {
    echo $cap['sumz'].",";
}
?>
            ],
        }




    ]
};
var option = {
animation: {
                duration:5000
}

};


var myBarChart = Chart.Bar(canvas,{
    data:data,
  options:option
});

</script>





<script>
    //// graph part //// 
<?php
/*foreach ($date_wise_students as $cap) {
    echo "['" . $cap['count_year'] . "', " . $cap['id'] . "],";
}*/
?>
           
</script>


<script>

    jQuery(document).ready(function () {
        if (!jQuery().fullCalendar) {
            return;
        }
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

        var h = {};


        $('#calendar').fullCalendar('destroy'); // destroy the calendar
        $('#calendar').fullCalendar({//re-initialize the calendar
            header: h,
            defaultView: 'month', // change default view with available options from http://arshaw.com/fullcalendar/docs/views/Available_Views/ 
            slotMinutes: 15,
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar !!!
            drop: function (date, allDay) { // this function is called when something is dropped

                // retrieve the dropped element's stored Event Object
                var originalEventObject = $(this).data('eventObject');
                // we need to copy it, so that multiple events don't have a reference to the same object
                var copiedEventObject = $.extend({}, originalEventObject);

                // assign it the date that was reported
                copiedEventObject.start = date;
                copiedEventObject.allDay = allDay;
                copiedEventObject.className = $(this).attr("data-class");

                // render the event on the calendar
                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }
            },
            events: [
<?php
foreach ($event as $eve) {
    $title = $eve['title'];
    $star_date = explode("-", $eve['start_date']);
    $s_d = $star_date[0];
    $s_m = $star_date[1] - 1;
    $s_y = $star_date[2];
    $end_date = explode("-", $eve['end_date']);
    $e_d = $end_date[0];
    $e_m = $end_date[1] - 1;
    $e_y = $end_date[2];
    $color = $eve['color'];
    $url = $eve['url'];
    echo '{title: "' . $eve['title'] . '",
                        start: new Date(' . $s_y . ',' . $s_m . ',' . $s_d . '),
                        end: new Date(' . $e_y . ',' . $e_m . ',' . $e_d . '),
                        backgroundColor: Metronic.getBrandColor("' . $color . '"),
                        url: "' . $url . '",},';
}
?>
            ]
        });
    });

    var $p = $('#ellipsis p');
    var divh = $('#ellipsis').height();
    while ($p.outerHeight() > divh) {
        $p.text(function (index, text) {
            return text.replace(/\W*\s(\S)*$/, '...');
        });
    }
</script>
