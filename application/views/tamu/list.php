<div class="col-12">
 <table class="table table-border" id="example1">
 	<thead>
 		<tr>
 			<th>Id</th>
 			<th>Nama</th>
 			<th>Whatsapp</th>
 			<th>Email</th>
 			<th>Alamat</th>
  			<!-- <th>QR_Code</th>
 			<th>Konfirmasi</th> -->
 		</tr>
 	</thead>
 	<tbody>
 		<?php foreach ($tamu as $tamu) {?>
 			<tr>
 				<td><?php echo $tamu->id_tamu ?></td>
 				<td><?php echo $tamu->nama ?></td>
 				<td><?php echo $tamu->whatsapp ?></td>
 				<td><?php echo $tamu->email ?></td>
 				<td><?php echo $tamu->alamat ?></td>
 				<td>
 					<a href="<?php echo base_url('index.php/tamu/edit/' . $tamu->id_tamu) ?>" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> EDIT </a>

 					<a href="<?php echo base_url('index.php/tamu/delete/' . $tamu->id_tamu) ?>" class="btn btn-danger btn-xs"onclick="return confirm('Yakin gak nih mau hapus ?')">
 						 <i class="fa fa-trash-o"></i>HAPUS</a>
 				</td>
 			</tr>
 			<?php
}?>
 	</tbody>

 </table>
</div>