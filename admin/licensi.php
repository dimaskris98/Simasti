<?php

if (isset($_POST['add'])) {
	echo '<script>window.location="liccreat"</script>';
}


if (isset($_POST['hapus'])) {
	$id = $_POST['idd'];
	$sql 	= 'delete from licensi where id="' . $id . '"';
	$query	= mysqli_query($conn, $sql);
}

?>
<section class="content">
	<div class="webui">
		<div class="panel-info widget-shadow">
			<div class="col-md-11 panel-grids">
				<h4>Licensi</h4>
			</div>
			<div class="col-md-1 panel-grids">
				<form role="form" action="" method="POST" enctype="multipart/form-data">
					<button type="submit" class="btn btn-primary btn-md" name="add">Buat Baru</button>
				</form>
			</div>
			<div class="box-body table-responsive">
				<table id="" class="display table table-bordered table-striped">
					<thead>
						<tr>
							<th>Licensi</th>
							<th>Produk Key</th>
							<th>Kadaluarsa</th>
							<th>Atas nama</th>
							<th>Eemail</th>
							<th>Manufaktur</th>
							<th>Total</th>
							<th>Sisa</th>
							<th>In/Out</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php

						$res = $conn->query("SELECT  * FROM Licensi  
				LEFT JOIN manufaktur ON licensi.id_manufaktur=manufaktur.id_manufaktur");
						while ($row = $res->fetch_assoc()) {

							$string = $row['id'];
							echo '
					
					<tr>
					<form role="form" action="" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="idd" value="' . $row['id'] . '" >
						<td><a href="lic?detil=' . $row['id'] . '" title="Detail Aset">' . $row['nama_licensi'] . '</a></td>
						<td>' . $row['serial'] . '</td> 
						<td>' . $row['tgl_kadaluarsa'] . '</td>
						<td>' . $row['licensi_user'] . '</td>
						<td>' . $row['licensi_email'] . '</td>
						<td>' . $row['nama_manufaktur'] . '</td>
						<td>' . $row['seats'] . '</td>  
						<td>' . $row['sisa'] . '</td>
						<td>';
							if ($row['sisa'] <= 0) {
								echo '<a href="javascript:void(0);" title=" disabled"><span class="label label-default" >ChekOut</span></a>';
							} else {
								echo '<a href="chekout?lic=' . $string . '" title="Edit Data"><span class="label label-success" >ChekOut</span></a>';
							}


							echo '</td>  
						<td>
						
						<a href="licedit?id=' . $string . '" title="Edit Data" class="btn btn-primary btn-sm"><span class="fa fa-pencil" aria-hidden="true"></span></a>
								
					<button type="submit" name="hapus" onclick="return confirm(\'Anda yakin akan menghapus data ' . $row['nama_licensi'] . '?\')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
						</td>							
					</tr>
					</form>';
						}
						?>
					</tbody>
				</table>

			</div>
		</div>
	</div>
</section>