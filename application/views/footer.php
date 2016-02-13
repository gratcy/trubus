        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->

        <script src="<?php echo site_url('application/views/assets/js/jquery-ui-1.10.3.min.js'); ?>" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="<?php echo site_url('application/views/assets/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
        <!-- Morris.js charts -->
        <script src="<?php echo site_url('application/views/assets/js/raphael-min.js'); ?>"></script>
<!--
        <script src="<?php echo site_url('application/views/assets/js/plugins/morris/morris.min.js'); ?>" type="text/javascript"></script>
-->
        <!-- Sparkline -->
        <script src="<?php echo site_url('application/views/assets/js/plugins/sparkline/jquery.sparkline.min.js'); ?>" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="<?php echo site_url('application/views/assets/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo site_url('application/views/assets/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'); ?>" type="text/javascript"></script>
        <!-- fullCalendar -->
        <script src="<?php echo site_url('application/views/assets/js/plugins/fullcalendar/fullcalendar.min.js'); ?>" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="<?php echo site_url('application/views/assets/js/plugins/jqueryKnob/jquery.knob.js'); ?>" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="<?php echo site_url('application/views/assets/js/plugins/daterangepicker/daterangepicker.js'); ?>" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="<?php echo site_url('application/views/assets/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'); ?>" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="<?php echo site_url('application/views/assets/js/plugins/iCheck/icheck.min.js'); ?>" type="text/javascript"></script>

        <!-- AdminLTE App -->
        <script src="<?php echo site_url('application/views/assets/js/AdminLTE/app.js'); ?>" type="text/javascript"></script>
        
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        
        <script src="<?php echo site_url('application/views/assets/js/js.js'); ?>"></script>
        <!-- AdminLTE for demo purposes -->
		<script src="<?php echo site_url('application/views/assets/chosen/chosen.jquery.min.js'); ?>" type="text/javascript"></script>

        <script>
            $(function () {
				$('.form-group select').chosen({search_contains: true, no_results_text: "Oops, nothing found!"}); 
				if ($('div.alert-danger').length > 0) {
					$(this).postTMP('<?php echo __get_PTMP(); ?>');
				}
			});
			$( document ).ajaxComplete(function() {
				$('.form-group select').chosen({search_contains: true, no_results_text: "Oops, nothing found!"}); 
			});
			
			$('select[name="switchbranch"]').change(function(){
				window.location.href = './switchbranch/' + $(this).val();
			});
        </script>
    </body>
</html>
