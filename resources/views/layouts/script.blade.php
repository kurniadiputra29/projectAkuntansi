<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>window.jQuery || document.write('<script src="src/js/vendor/jquery-3.3.1.min.js"><\/script>')</script>
<script src="/ProjectAkuntan/plugins/popper.js/dist/umd/popper.min.js"></script>
<script src="/ProjectAkuntan/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/ProjectAkuntan/plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
<script src="/ProjectAkuntan/plugins/screenfull/dist/screenfull.js"></script>
<!-- datatable -->
<script src="/ProjectAkuntan/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/ProjectAkuntan/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/ProjectAkuntan/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="/ProjectAkuntan/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<script src="/ProjectAkuntan/plugins/jvectormap/jquery-jvectormap.min.js"></script>
<script src="/ProjectAkuntan/plugins/jvectormap/tests/assets/jquery-jvectormap-world-mill-en.js"></script>
<script src="/ProjectAkuntan/plugins/moment/moment.js"></script>
<script src="/ProjectAkuntan/plugins/tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="/ProjectAkuntan/plugins/d3/dist/d3.min.js"></script>
<script src="/ProjectAkuntan/plugins/c3/c3.min.js"></script>
<script src="/ProjectAkuntan/plugins/owl.carousel/dist/owl.carousel.min.js"></script>
<script src="/ProjectAkuntan/plugins/chartist/dist/chartist.min.js"></script>
<script src="/ProjectAkuntan/plugins/flot-charts/jquery.flot.js"></script>
<script src="/ProjectAkuntan/plugins/flot-charts/jquery.flot.categories.js"></script>
<script src="/ProjectAkuntan/plugins/flot-charts/curvedLines.js"></script>
<script src="/ProjectAkuntan/plugins/flot-charts/jquery.flot.tooltip.min.js"></script>
<script src="/ProjectAkuntan/plugins/jquery-knob/dist/jquery.knob.min.js"></script>
<script src="/ProjectAkuntan/plugins/amcharts3/amcharts/amcharts.js"></script>
<script src="/ProjectAkuntan/plugins/amcharts3/amcharts/gauge.js"></script>
<script src="/ProjectAkuntan/plugins/amcharts3/amcharts/serial.js"></script>
<script src="/ProjectAkuntan/plugins/amcharts3/amcharts/themes/light.js"></script>
<script src="/ProjectAkuntan/plugins/amcharts3/amcharts/pie.js"></script>
<script src="/ProjectAkuntan/plugins/ammap3/ammap/ammap.js"></script>
<script src="/ProjectAkuntan/plugins/ammap3/ammap/maps/js/usaLow.js"></script>

<script src="/ProjectAkuntan/dist/js/theme.min.js"></script>
<script src="/ProjectAkuntan/js/widget-chart.js"></script>
<script src="/ProjectAkuntan/js/widget-statistic.js"></script>
<script src="/ProjectAkuntan/js/datatables.js"></script>

{{-- <script src="/ProjectAkuntan/js/alerts.js"></script>
<script src="/ProjectAkuntan/js/calendar.js"></script>
<script src="/ProjectAkuntan/js/carousel.js"></script>
<script src="/ProjectAkuntan/js/chart-amcharts.js"></script>
<script src="/ProjectAkuntan/js/chart-chartist.js"></script>
<script src="/ProjectAkuntan/js/chart-flot.js"></script>
<script src="/ProjectAkuntan/js/chart-knob.js"></script>
<script src="/ProjectAkuntan/js/charts.js"></script>

<script src="/ProjectAkuntan/js/form-advanced.js"></script>

<script src="/ProjectAkuntan/js/form-picker.js"></script>
<script src="/ProjectAkuntan/js/forms.js"></script>
<script src="/ProjectAkuntan/js/layout.js"></script>
<script src="/ProjectAkuntan/js/range-slider.js"></script>
<script src="/ProjectAkuntan/js/rating.js"></script>
<script src="/ProjectAkuntan/js/tables.js"></script>
<script src="/ProjectAkuntan/js/widgets.js"></script>
<script src="/ProjectAkuntan/js/widget-chart.js"></script>
<script src="/ProjectAkuntan/js/widget-data.js"></script>
<script src="/ProjectAkuntan/js/widget-statistic.js"></script>
<script src="/ProjectAkuntan/dist/js/theme.min.js"></script> --}}

<script src="/ProjectAkuntan/js/form-components.js"></script>
<!-- <script src="/ProjectAkuntan/dist/js/theme.js"></script> -->
<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script>
    (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
    function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
    e=o.createElement(i);r=o.getElementsByTagName(i)[0];
    e.src='https://www.google-analytics.com/analytics.js';
    r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
    ga('create','UA-XXXXX-X','auto');ga('send','pageview');
</script>
<script>
  $(function () {
    $("#submit").click( function() {
      var password = $("#password").val();
      var retri = $("#retri").val();
      if (password != retri) {
        alert("Passwords do not match !!");
        return false;
      }
      return true;
    });
  })
</script>






