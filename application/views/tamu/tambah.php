<div class="col-md-12">
 <?php 
//notifikasi error
echo validation_errors ('<div class="alert alert-warning">','</div>');

//formm open
echo form_open(base_url('index.php/tamu/tambah'),' class="form-horizontal"');

?>

<div class="form-group">
  <label class="col-md-2 control-label">Nama Tamu</label>
  <div class="col-md-5">
    <input type="text" name="nama" class="form-control" placeholder="Nama Tamu" value="<?php echo set_value('nama') ?>" required>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Whatsapp</label>
  <div class="col-md-5">
    <input type="text" name="whatsapp" class="form-control" placeholder="Nomer Whatsapp Tamu" value="<?php echo set_value('whatsapp') ?>" required>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Email</label>
  <div class="col-md-5">
    <input type="text" name="email" class="form-control"  placeholder="email tamu" value="<?php echo set_value('email') ?>" required>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Alamat</label>
  <div class="col-md-5">
    <input type="text" name="alamat" class="form-control"  placeholder="Alamat Tamu" value="<?php echo set_value('alamat') ?>" required >
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label" >Konfirmasi</label>
  <div class="col-md-5">
    <input type="text" name="konfirmasi" class="form-control"  placeholder="Konfirmasi Tamu" value="<?php echo set_value('konfirmasi') ?>" required >
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