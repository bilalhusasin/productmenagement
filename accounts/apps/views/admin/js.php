<!-- Bootstrap 3.3.7 -->
<script src="assets/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<!-- <script src="assets/adminlte/bower_components/raphael/raphael.min.js"></script> -->
<!-- <script src="assets/adminlte/bower_components/morris.js/morris.min.js"></script> -->
<!-- Sparkline -->
<!-- <script src="assets/adminlte/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script> -->
<!-- jvectormap -->
<!-- <script src="assets/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script> -->
<!-- <script src="assets/adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script> -->
<!-- jQuery Knob Chart -->
<!-- <script src="assets/adminlte/bower_components/jquery-knob/dist/jquery.knob.min.js"></script> -->
<!-- daterangepicker -->
<script src="assets/adminlte/bower_components/moment/min/moment.min.js"></script>
<script src="assets/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- <script src="assets/adminlte/plugins/input-mask/jquery.inputmask.js"></script>
<script src="assets/adminlte/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="assets/adminlte/plugins/input-mask/jquery.inputmask.extensions.js"></script> -->
<!-- <script src="assets/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script> -->
<!-- datepicker -->
<script src="assets/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="assets/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="assets/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- DataTables -->
<script type="text/javascript" src="assets/js/DataTables/datatables.min.js"></script>
<!-- FastClick -->
<script src="assets/adminlte/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="assets/adminlte/dist/js/adminlte.min.js"></script>
<script src="assets/plugin/jquery-popup-overlay/jquery.popupoverlay.js"></script>
<script type="text/javascript">
    $(function($) {
        // this script needs to be loaded on every page where an ajax POST might happen
        // For CSRF check
        $.ajaxSetup({
            data: {
                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
            }
        });
    });
</script>
<script src="assets/js/apps.js"></script>