
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.5
    </div>
    <strong>Copyright &copy; 2020 <a href="http://adminlte.io">Buku Tamu Digital</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<div class="modal fade" id="modal-search-tamu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title float-left">Cari Tamu</h4>
      </div>
      <div class="modal-body">
         <div class="row">
            <div class="col-md-12">
               <div class="form-group">
                  <label for="nama">Nama Tamu</label>
                  <input type="text" class="form-control" id="nama" placeholder="Alexander Pierce" name="nama" required onkeyup="searchTamu()">
               </div>
            </div>
            <div class="col-md-12 mt-3 tabel-tamu" hidden>
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Daftar Tamu Dicari</h3>

                  <!-- <div class="card-tools">
                    <ul class="pagination pagination-sm float-right">
                      <li class="page-item"><a class="page-link" href="#">«</a></li>
                      <li class="page-item"><a class="page-link" href="#">1</a></li>
                      <li class="page-item"><a class="page-link" href="#">2</a></li>
                      <li class="page-item"><a class="page-link" href="#">3</a></li>
                      <li class="page-item"><a class="page-link" href="#">»</a></li>
                    </ul>
                  </div> -->
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Nama</th>
                        <th>Whatsapp</th>
                        <th style="width: 40px">Asal</th>
                        <th style="width: 40px"></th>
                      </tr>
                    </thead>
                    <tbody id="tamu-list">
                      <tr>
                        <td>1.</td>
                        <td>Arif Setyo Nugroho</td>
                        <td>081225720280</td>
                        <td>Boyolali</td>
                        <td><a href="<?php echo base_url('index.php/event/detail/') ?>" class="btn btn-secondary btn-xs"><i class="fa fa-info-circle" aria-hidden="true"></i></a></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
            </div>
          </div>
        <div class="modal-footer mt-3">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        </div>
    </div>
  </div>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
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
   $(document).ready(function() {
      $('#js-tamu-add-to-event').select2();
   });

   function searchTamu() {
    showTableTamu()
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("tamu-list").innerHTML = '';
        let tamus = JSON.parse(this.responseText);

        let i = 0;
        let tamusTable = tamus.map(tamu => {
          let row = '<tr>'
          row += '<td>' + ++i + '</td>'
          row += '<td>' + tamu.nama + '</td>'
          row += '<td>' + tamu.whatsapp + '</td>'
          row += '<td>' + tamu.alamat + '</td>'
          row += '<td><a href="/index.php/tamu/edit/' + tamu.id_tamu + '" class="btn btn-secondary btn-xs"><i class="fa fa-info-circle" aria-hidden="true"></i></a></td>';
          row += '</tr>'

          return row
        });
        document.getElementById("tamu-list").innerHTML = tamusTable
      }
    };

    let searchKeyword = document.querySelector('#nama').value.trim();

    xhttp.open("GET", "/index.php/tamu/searchTamu/" + searchKeyword, true);
    xhttp.send();
  }

  function showTableTamu() {
    let tamuTable = document.querySelector('div.col-md-12.mt-3.tabel-tamu');
    tamuTable.removeAttribute('hidden')
  }
</script>
</body>
</html>
