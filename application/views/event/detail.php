<link rel="stylesheet" href="<?=base_url('vendor/');?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<div class="col-12">
   <!-- Default box -->
   <div class="card">
      <div class="card-header">
         <h3 class="card-title"><?=$event->name?></h3>
         <div class="card-tools">
         <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
         <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
         </div>
      </div>
      <div class="card-body">
         <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-info"></i> Detail Event!</h5>
            <dl class="row" style="margin-bottom: 0;">
               <dt class="col-sm-3">Nama Event</dt>
               <dd class="col-sm-9"><?=$event->name?></dd>
               <dt class="col-sm-3">Waktu Mulai</dt>
               <dd class="col-sm-9"><?=$event->start_at_carbon?></dd>
               <dt class="col-sm-3">Waktu Selesai</dt>
               <dd class="col-sm-9"><?=$event->end_at_carbon?></dd>
               <dt class="col-sm-3">Lokasi</dt>
               <dd class="col-sm-9"><?=$event->location?></dd>
               <dt class="col-sm-3">Notes</dt>
               <dd class="col-sm-9"><?=$event->notes?></dd>
            </dl>
         </div>
      <!-- /.card-body -->
      <div class="card-footer">

      </div>
      <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Daftar Tamu pada Event Ini</h3>

                <div class="card-tools">
                   <!-- Button trigger modal add event -->
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-event">
                     <i class="fa fa-plus" aria-hidden="true"></i> Tambah Tamu
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                     <th>Nama</th>
                     <th>Whatsapp</th>
                     <th>Email</th>
                     <th>Alamat</th>
                     <th>QR_Code</th>
                     <th>Waktu Datang</th>
                     <th>Konfirmasi</th>
                    </tr>
                  </thead>
                  <tbody>
                     <?php foreach ($tamu as $tamu_single) {?>
                    <tr>
                     <td><?=$tamu_single->nama?></td>
                     <td><?=$tamu_single->whatsapp?></td>
                     <td><?=$tamu_single->email?></td>
                     <td><?=$tamu_single->alamat?></td>
                     <td><img style="width: 100px;" src="<?=base_url() . 'assets/images/' . $tamu_single->qr_code_img?>"></td>
                     <td><?=($tamu_single->time_attended == null) ? '' : $tamu_single->time_attended?></td>
                     <td>
                        <button type="button" class="btn btn-block <?php echo ($tamu_single->confirmation_status == 'datang') ? 'btn-success' : 'btn-danger' ?>"><?=$tamu_single->confirmation_status?></button>
                     </td>
                     <td>
                        <a href="<?php echo base_url('index.php/event/deleteEventsTamu/' . $event->event_id . '/' . $tamu_single->events_tamu_id) ?>" class="btn btn-danger btn-xs"onclick="return confirm('Yakin gak nih mau hapus ?')"><i class="fa fa-trash" aria-hidden="true"></i> HAPUS</a>
                     </td>
                    </tr>
                    <?php }?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      <!-- /.card-footer-->
   </div>
   <!-- /.card -->
</div>
<!-- Modal -->
<div class="modal fade" id="modal-add-event" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title float-left">Tambah Tamu</h4>
      </div>
      <div class="modal-body">
         <div class="row">
            <div class="col-md-12">
               <?=form_open(base_url('index.php/event/addEventTamu/' . $event->event_id), ' class="form-horizontal"');?>
               <div class="form-group">
                  <select class="form-control select2" style="width: 100%;" id="js-tamu-add-to-event" name="tamu_id">
                     <?php foreach ($tamuNotInvitedList as $tamu) {?>
                        <option value="<?=$tamu->id_tamu?>"><?=$tamu->nama . ' - ' . $tamu->email . ' - ' . $tamu->alamat?></option>
                     <?php }?>
                  </select>
               </div>
               <button type="submit" class="btn btn-primary">Simpan</button>
               <?=form_close();?>

               <?=form_open(base_url('index.php/tamu/addTamuAndAttachToEvent/' . $event->event_id), ' class="form-horizontal"');?>
               <h2 style="margin-top: 50px;">Tambah Tamu Baru</h2>
               <div class="form-group">
                  <label for="nama">Nama Tamu</label>
                  <input type="text" class="form-control" id="nama" placeholder="Alexander Pierce" name="nama" required>
               </div>
               <div class="form-group">
                  <label for="whatsapp">Whatsapp</label>
                  <input type="text" class="form-control" id="whatsapp" placeholder="08122334455" name="whatsapp" required>
               </div>
               <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" placeholder="admin@example.org" name="email" required>
               </div>
               <div class="form-group">
                  <label for="alamat">Alamat</label>
                  <input type="alamat" class="form-control" id="alamat" placeholder="Klaten" name="alamat" required>
               </div>
               <button type="submit" class="btn btn-primary">Tambah Tamu</button>
               <?=form_close();?>
            </div>
         </div>
      </div>
      <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
      </div>
   </div>
   </div>
</div>