<?php
if (isset($_POST['simpankategori'])) {
	$kategori = $_POST['nama_kategori'];
	$tipe = $_POST['tipe_kategori'];
	//Memasukkan data
	$sql = "INSERT INTO kategori (id_kategori, nama_kategori, tipe, tgl) VALUES ('', '$kategori', '$tipe','$created_at')";
	$query	= mysqli_query($sql);
}

if (isset($_POST['hapus'])) {
	$id = $_POST['idd'];
	$sql 	= 'delete from  kategori where id_kategori="' . $id . '"';
	$query	= mysqli_query($conn, $sql);
	echo '<script>window.location = document.referrer</script>';
}

if (isset($_POST['simpanedit'])) {
	$id = $_POST['id_kategori'];
	$kategori = $_POST['nama_kategori'];
	$tipe = $_POST['tipe_kategori'];
	$sql 	= "UPDATE kategori SET nama_kategori='$kategori', tipe='$tipe' WHERE id_kategori='$id'";
	$query	= mysqli_query($sql);
}

if (isset($_GET['edit'])) {
	$res = $conn->query("SELECT * FROM  kategori WHERE id_kategori='$_GET[edit]'");
	$data = $res->fetch_array();
?>
	<div>
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="exampleModalLabel">Edit Kategori</h4>
				</div>
				<form class="form-horizontal" method="POST" action="?mod=kategori">
					<div class="modal-body">
						<div class="sign-u">
							<label class="col-md-4 control-label">Nama Kategori:</label>
							<div class="col-sm-5">
								<input type="hidden" value="<?= $data['id_kategori'] ?>" class="form-control" name="id_kategori" id="id_kategori" required>
								<input type="text" value="<?= $data['nama_kategori'] ?>" class="form-control" name="nama_kategori" id="nama_Kategori" required>
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class="sign-u">
							<label class="col-md-4 control-label">Tipe Kategori:</label>
							<div class="col-sm-5">
								<select name="tipe_kategori" id="tipe" class="form-control">
									<option><?= $data['tipe'] ?></option>
									<option>Aset</option>
									<option>Aksesoris</option>
									<option>Komponen</option>
								</select>
							</div>
							<div class="clearfix"> </div>
						</div>
					</div>

					<div class="modal-footer">
						<button type="button" onclick=(window.location="?mod=kategori" ) class="btn btn-danger" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary" name="simpanedit">Simpan</button>

						<div class="clearfix"> </div>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php
}
?>
<div class="col-md-11 panel-grids">
	<h4>Kategori Material</h4>
</div>
<div class="col-md-1 panel-grids">
	<button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#exampleModal1" data-whatever="@mdo">Baru</button>
	<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="exampleModalLabel">Buat Kategori</h4>
				</div>
				<form name="form3" id="form3" class="form-horizontal" method="POST" action="">
					<div class="modal-body">
						<div class="sign-u">
							<label class="col-md-3 control-label">Nama Kategori:</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="nama_kategori" id="nama_kategori" required>
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class="sign-u">
							<label class="col-md-3 control-label">Tipe Kategori:</label>
							<div class="col-sm-8">
								<select name="tipe_kategori" id="tipe" class="form-control">
									<option>Aset</option>
									<option>Aksesoris</option>
									<option>Komponen</option>
								</select>
							</div>
							<div class="clearfix"> </div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary" name="simpankategori">Simpan</button>
						<div class="clearfix"> </div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
<div class="col-md-12 panel-grids">
	<div class="box-body table-responsive">
		<form role="form" action="" method="POST" enctype="multipart/form-data">
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>Kategori</th>
						<th>Tipe</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php

					$no = 1;
					$res = $conn->query("SELECT * FROM  kategori");
					while ($row = $res->fetch_assoc()) {
						echo '
					
					<tr>
						<input type="text" name="idd" value="' . $row['id_kategori'] . '" hidden>
						<td>' . $no . '</td>
						<td>' . $row['nama_kategori'] . '</td>
						<td>' . $row['tipe'] . '</td>
						<td>
						<a href="?edit=' . $row['id_kategori'] . '" title="Edit Data" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
					
					<button type="submit" name="hapus" onclick="return confirm(\'Anda yakin akan menghapus data ' . $row['nama_kategori'] . '?\')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
						</td>							
					</tr>
					';
						$no++;
					}
					?>
				</tbody>
			</table>
		</form>
	</div>
</div>
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalLabel">Edit Kategori</h4>
			</div>
			<form name="form3" id="form3" class="form-horizontal" method="POST" action="">
				<div class="modal-body">
					<div class="sign-u">
						<label class="col-md-3 control-label">Nama Kategori:</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="nama_kategori" id="nama_kategori" required>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="sign-u">
						<label class="col-md-3 control-label">Tipe Kategori:</label>
						<div class="col-sm-8">
							<select name="tipe_kategori" id="tipe" class="form-control">
								<option>Aset</option>
								<option>Aksesoris</option>
								<option>Komponen</option>
							</select>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary" name="simpankategori">Simpan</button>
					<div class="clearfix"> </div>
				</div>
			</form>
		</div>
	</div>
</div>