<div class="col-md-12">

 <?php
//notifikasi error
echo validation_errors('<div class="alert alert-warning">', '</div>');

if ($this->session->flashdata('success')) {
    echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '<a class="float-right" href=' . base_url('index.php/event') . '>Ke Daftar Event</a> </div>';
}

//formm open
echo form_open(base_url('index.php/event/edit/' . $event->event_id), ' class="form-horizontal"');

?>

<input type="hidden" name="id" value="<?=$event->event_id?>"></input>
<div class="form-group">
  <label class="col-md-2 control-label">Nama Event</label>
  <div class="col-md-5">
    <input type="text" name="name" class="form-control" placeholder="Pernikahan bapak dan ibuk" value="<?php echo $event->name ?>" required>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Waktu Mulai</label>
  <div class="col-md-5">
    <input type="datetime-local" name="start_at" class="form-control" placeholder="20 Desember 2020" value="<?php echo rtrim(date(DATE_W3C, strtotime($event->start_at)), "+00:00"); ?>" required>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Waktu Selesai</label>
  <div class="col-md-5">
    <input type="datetime-local" name="end_at" class="form-control"  placeholder="21 Desember 2020" value="<?php echo rtrim(date(DATE_W3C, strtotime($event->end_at)), "+00:00"); ?>" required>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Alamat</label>
  <div class="col-md-5">
    <input type="text" name="location" class="form-control"  placeholder="Jl. Kemangi 16, Pagarbesi" value="<?php echo $event->location ?>" required >
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label" >Keterangan</label>
  <div class="col-md-5">
    <input type="text" name="notes" class="form-control"  placeholder="Selalu Jaga Protocol" value="<?php echo $event->notes ?>" required >
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label"></label>
  <div class="col-md-5">
      <button class="btn btn-success " name="submit" type="submit">
        <i class="fa fa-save "></i> SIMPAN
      </button>
      <button class="btn btn-info " name="reset" type="reset">
        <i class="fa fa-times "> </i> RESET </button>
  </div>
</div>
<?php
echo form_close(); ?>
</div>