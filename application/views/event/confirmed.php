<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Buku tamu digital</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url('vendor/');?>plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url('vendor/');?>dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?=base_url('vendor/');?>plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?=base_url('assets/');?>style.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
   <script src="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.js"></script>

   <link rel="stylesheet" href="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.css" />
</head>
<body>


<script src="<?=base_url('vendor/');?>plugins/jquery/jquery.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?=base_url('vendor/');?>plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=base_url('vendor/');?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url('vendor/');?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=base_url('vendor/');?>dist/js/demo.js"></script>
<script src="<?=base_url('vendor/');?>plugins/moment/moment.min.js"></script>
<script src="<?=base_url('vendor/');?>plugins/daterangepicker/daterangepicker.js"></script>
<!-- ChartJS -->
<script src="<?=base_url('vendor/');?>plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?=base_url('vendor/');?>plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?=base_url('vendor/');?>plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?=base_url('vendor/');?>plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?=base_url('vendor/');?>plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?=base_url('vendor/');?>plugins/moment/moment.min.js"></script>
<script src="<?=base_url('vendor/');?>plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?=base_url('vendor/');?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?=base_url('vendor/');?>plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?=base_url('vendor/');?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url('vendor/');?>dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?=base_url('vendor/');?>dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="<?=base_url('vendor/');?>dist/js/demo.js"></script> -->
<script src="<?=base_url('vendor/');?>plugins/select2/js/select2.min.js"></script>
<script>
   $(document).ready(function(){
      var id = $(this).parents("tr").attr("id");
      swal({
         title: "Kedatangan Anda Telah Di Konfirmasi!",
         type: "success",
         confirmButtonClass: "btn-success",
         confirmButtonText: "Konfirmasi!",
         closeOnConfirm: true,
      },
      function(isConfirm) {
         if (isConfirm) {
            window.close();
         } else {
            swal("Cancelled", "Your imaginary file is safe :)", "error");
            window.close();
         }
      });
   });
</script>
</body>
</html>