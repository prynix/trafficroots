    <!-- Mainly scripts -->
    <script src="{{ URL::asset('js/jquery-2.1.1.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ URL::asset('js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

    <!-- Data Tables -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs-3.3.7/jszip-3.1.3/pdfmake-0.1.27/dt-1.10.15/af-2.2.0/b-1.3.1/b-colvis-1.3.1/b-html5-1.3.1/b-print-1.3.1/cr-1.3.3/fc-3.2.2/fh-3.1.2/kt-2.2.1/r-2.1.1/sc-1.4.2/se-1.2.2/datatables.min.js"></script>
    <!-- Flot -->
    <script src="{{ URL::asset('js/plugins/flot/jquery.flot.js') }}"></script>
    <script src="{{ URL::asset('js/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
    <script src="{{ URL::asset('js/plugins/flot/jquery.flot.spline.js') }}"></script>
    <script src="{{ URL::asset('js/plugins/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ URL::asset('js/plugins/flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ URL::asset('js/plugins/flot/jquery.flot.time.js') }}"></script>

    <!-- Peity -->
    <script src="{{ URL::asset('js/plugins/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ URL::asset('js/demo/peity-demo.js') }}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ URL::asset('js/inspinia.js') }}"></script>
    <script src="{{ URL::asset('js/plugins/pace/pace.min.js') }}"></script>

    <!-- jQuery UI -->
    <script src="{{ URL::asset('js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

    <!-- GITTER -->
    <script src="{{ URL::asset('js/plugins/gritter/jquery.gritter.min.js') }}"></script>

    <!-- Sparkline -->
    <script src="{{ URL::asset('js/plugins/sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Sparkline demo data  -->
    <script src="{{ URL::asset('js/demo/sparkline-demo.js') }}"></script>

    <!-- ChartJS-->
    <script src="{{ URL::asset('js/plugins/chartJs/Chart.min.js') }}"></script>

    <!-- Toastr -->
    <script src="{{ URL::asset('js/plugins/toastr/toastr.min.js') }}"></script>
    
    <!-- jQuerySteps -->
    <script src="{{ URL::asset('js/plugins/staps/jquery.steps.min.js') }}"></script>
       
  
    <script type="text/javascript">
toastr.options = {
  "closeButton": true,
  "debug": false,
  "progressBar": true,
  "preventDuplicates": false,
  "positionClass": "toast-top-right",
  "onclick": null,
  "showDuration": "400",
  "hideDuration": "400",
  "timeOut": "2000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "slideDown",
  "hideMethod": "slideUp"
}
    </script>
    <!-- Input Mask -->
    <script src="{{ URL::asset('js/plugins/jasny/jasny-bootstrap.min.js') }}"></script>
    <!-- SUMMERNOTE -->
    <script src="{{ URL::asset('js/plugins/summernote/summernote.min.js') }}"></script>
    
   <!-- Input Mask-->
   <script src="{{ URL::asset('js/plugins/jasny/jasny-bootstrap.min.js') }}"></script>

   <!-- Data picker -->
   <script src="{{ URL::asset('js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
   
    <!-- Clock picker -->
    <script src="{{ URL::asset('js/plugins/clockpicker/clockpicker.js') }}"></script>
    
    <!-- Date range use moment.js same as full calendar plugin -->
    <script src="{{ URL::asset('js/plugins/fullcalendar/moment.min.js') }}"></script>
    
    <!-- Date range picker -->
    <script src="{{ URL::asset('js/plugins/daterangepicker/daterangepicker.js') }}"></script>
    
<!-- end globals -->
<!-- page level scripts -->
@yield('js')
<!-- end page level scripts -->