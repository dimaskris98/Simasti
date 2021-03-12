<?php

if (isset($_POST['add'])) {
	echo '<script>window.location="komponen-creat"</script>';
}


if (isset($_POST['hapus'])) {
	$id = $_POST['idd'];
	$sql 	= 'delete from komponen where id="' . $id . '"';
	$query	= mysqli_query($conn, $sql);
}

?>
<section class="content-header" style="padding-bottom: 30px;">
	<h1 class="pull-left"><?php echo $mod; ?></h1>
	<div class="pull-right">
		<form role="form" action="" method="POST" enctype="multipart/form-data">
			<button type="submit" class="btn btn-primary btn-md" name="add">Buat Baru</button>
		</form>
	</div>


</section>
<section class="content">
	<div class="webui">
		<div class="row">
			<div class="col-md-12 panel-grids">
				<div class="box box-default">
					<div class="box-body table-responsive">
						<table id="" class="tabledisplay table table-bordered table-striped">
							<thead>
								<tr>
									<th>Nama</th>
									<th>Kategori</th>
									<th>Pemasok</th>
									<th>No.PO</th>
									<th>Hargah</th>
									<th>Tanggl PO</th>
									<th>Total</th>
									<th>Sisa</th>
									<th>Min.QTY</th>
									<th>Status</th>
									<th>In/Out</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php

								$res = $conn->query("SELECT  * FROM komponen 
				LEFT JOIN kategori ON komponen.id_kategori=kategori.id_kategori 
				LEFT JOIN data_pemasok ON komponen.id_sup=data_pemasok.id_sup");
								while ($row = $res->fetch_assoc()) {

									$string = $row['id'];
									echo '
					
					<tr>
					<form role="form" action="" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="idd" value="' . $row['id'] . '" >
						<td><a href="komponen-detail?detil=' . $row['id'] . '" title="Detail Aset">' . $row['nama_komponen'] . '</a></td>
						<td>' . $row['nama_kategori'] . '</td> 
						<td>' . $row['nama_sup'] . '</td>
						<td>' . $row['po'] . '</td>
						<td>' . number_format($row['harga_po'], 0, ',', '.') . '</td>
						<td>' . $row['tgl_po'] . '</td>  
						<td>' . $row['qty'] . '</td>
						<td>' . $row['sisa'] . '</td>
						<td>' . $row['min_qty'] . '</td>';
						if ($row['sisa'] > $row['min_qty']) {
							echo '<td> <span class="label label-success" >Banyak</span></td>';
						} else if ($row['sisa'] <= $row['min_qty'] && $row['sisa'] > 0) {
							echo '<td> <span class="label label-warning" >Sedikit</span></td>';
						} else if ($row['sisa'] <= 1) {
							echo '<td> <span class="label label-danger" >Habis</span></td>';
						};
						echo '<td>';
									if ($row['sisa'] <= 0) {
										echo '<a href="javascript:void(0);" title=" disabled"><span class="label label-default" >ChekOut</span></a>';
									} else {
										echo '<a href="chekout?komp=' . $string . '" title="Edit Data"><span class="label label-success" >ChekOut</span></a>';
									}


									echo '</td>  
						<td>
						
						<a href="komponen-edit?id=' . $string . '" title="Edit Data" class="btn btn-primary btn-sm"><span class="fa fa-pencil" aria-hidden="true"></span></a>
								
					<button type="submit" name="hapus" onclick="return confirm(\'Anda yakin akan menghapus data ' . $row['nama_komponen'] . '?\')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
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
		</div>
	</div>
</section>