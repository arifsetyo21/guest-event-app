<div class="col-12">
<?php
if ($this->session->flashdata('success')) {
    echo '<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Sukses!</strong> ' . $this->session->flashdata('success') . '</div>';
}

if ($this->session->flashdata('fail')) {

    echo '<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Gagal!</strong> ' . $this->session->flashdata('fail') . '</div>';
}

?>
 <div class="row float-right mb-3">
	<a href="<?=base_url('index.php/event/add');?>"><button type="button" class="btn btn-block btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Event</button></a>
 </div>
 <table class="table table-border" id="example1">
 	<thead>
 		<tr>
 			<th>Nama</th>
 			<th>Mulai :</th>
 			<th>Selesai :</th>
 			<th>Lokasi</th>
  			<th>Notes</th>
  			<th>Status</th>
  			<th>Aksi</th>
 		</tr>
 	</thead>
 	<tbody>
		 <?php foreach ($events as $event) {?>
 			<tr>
 				<td><?php echo $event->name ?></td>
 				<td><?php echo $event->start_at_carbon ?></td>
 				<td><?=strtotime($event->end_at)?></td>
				 <td><?=time()?></td>
 				<td><?php echo $event->location ?></td>
 				<td><?php echo $event->notes ?></td>
 				<td><?php echo (strtotime($event->end_at) < time()) ? '<button type="button" class="btn btn-block btn-danger">Usang</button>' : '<button type="button" class="btn btn-block btn-success">Aktif</button>' ?></td>
 				<td>
					<a href="<?php echo base_url('index.php/event/detail/' . $event->event_id) ?>" class="btn btn-secondary btn-xs"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
 					<a href="<?php echo base_url('index.php/event/edit/' . $event->event_id) ?>" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> EDIT </a>
 					<a href="<?php echo base_url('index.php/event/delete/' . $event->event_id) ?>" class="btn btn-danger btn-xs"onclick="return confirm('Yakin gak nih mau hapus ?')"><i class="fa fa-trash" aria-hidden="true"></i> HAPUS</a>
 				</td>
			 </tr>
 			<?php }?>
 	</tbody>

 </table>
</div>