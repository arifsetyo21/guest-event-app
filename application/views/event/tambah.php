<div class="col-md-12">

 <?php
//notifikasi error
echo validation_errors('<div class="alert alert-warning">', '</div>');

if ($this->session->flashdata('success')) {
    echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '<a class="float-right" href=' . base_url('index.php/event') . '>Ke Daftar Event</a> </div>';
}

//formm open
echo form_open(base_url('index.php/event/add'), ' class="form-horizontal"');

?>

<div class="form-group">
  <label class="col-md-2 control-label">Nama Event</label>
  <div class="col-md-5">
    <input type="text" name="name" class="form-control" placeholder="Pernikahan bapak dan ibuk" value="<?php echo set_value('nama') ?>" required>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Waktu Mulai</label>
  <div class="col-md-5">
    <input type="datetime-local" name="start_at" class="form-control" placeholder="20 Desember 2020" value="<?php echo set_value('whatsapp') ?>" required>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Waktu Selesai</label>
  <div class="col-md-5">
    <input type="datetime-local" name="end_at" class="form-control"  placeholder="21 Desember 2020" value="<?php echo set_value('email') ?>" required>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Alamat</label>
  <div class="col-md-5">
    <input type="text" name="location" class="form-control"  placeholder="Jl. Kemangi 16, Pagarbesi" value="<?php echo set_value('alamat') ?>" required >
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label" >Keterangan</label>
  <div class="col-md-5">
    <input type="text" name="notes" class="form-control"  placeholder="Selalu Jaga Protocol" value="<?php echo set_value('konfirmasi') ?>" required >
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