<?php
$de = $_GET['id'];
$res = $conn->query("SELECT  * FROM komponen 
				LEFT JOIN kategori ON komponen.id_kategori=kategori.id_kategori 
				WHERE id='$de'");

$data = $res->fetch_array();



if (isset($_POST['newKategori'])) {
	$nama = $_POST['nama'];
	$tipe = $_POST['tipe'];
	//Memasukkan data
	$sql = "INSERT INTO kategori ( id_kategori, nama_kategori, tipe) VALUES ('', '$nama', '$tipe')";
	$query	= mysqli_query($conn, $sql);
}



if (isset($_POST['newpemasok'])) {
	$nama = $_POST['pemasok'];
	$alamat = $_POST['alamat'];
	$tlp = $_POST['tlp'];
	//Memasukkan data 
	$sql = "INSERT INTO data_pemasok VALUES ('', '$nama','$alamat','$tlp')";
	$query	= mysqli_query($conn, $sql);
}

if (isset($_POST['simpakomponen'])) {
	$id = $_POST['id'];
	$nama = $_POST['nama'];
	$kategori = $_POST['kategori'];
	$sisa = $_POST['sisa'];
	$stok = $_POST['stok'];
	$minqty = $_POST['minqty'];
	//Memasukkan data 
	$sql = "UPDATE komponen SET nama_komponen='$nama', id_kategori='$kategori', sisa='$stok', sisa='$sisa' ,min_qty='$minqty' 
		WHERE id='$id'";

	//echo $sql;	
	$query	= mysqli_query($conn, $sql);
	echo '<script>window.location="?mod=komponen"</script>';
}



?>
<h2>
	<center>Edit Komponen</center><span class="label label-default"></span>
</h2>
<div class="main-page signup-page">
	<div class="sign-up-row widget-shadow">

		<form class="form-horizontal" method="POST" action="">
			<input value="<?php echo $data['id']; ?>" type="hidden" class="form-control" name="id" id="id" />
			<div class="form-group">
				<label class="col-sm-5 control-label">
					<h4>Nama :</h4>
				</label>
				<div class="col-sm-3">
					<input class="form-control" type="text" name="nama" id="nama" value="<?php echo $data['nama_komponen']; ?>" required>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 control-label">
					<h4>Kategori :</h4>
				</label>
				<div class="col-sm-3">
					<select name="kategori" id="kategori" class="form-control" required>
						<option value="<?php echo $data['id_kategori']; ?>"><?php echo $data['nama_kategori']; ?></option>
						<?php
						$no = 1;
						$res = $conn->query("SELECT * FROM kategori where tipe='komponen'");
						while ($row = $res->fetch_assoc()) {
							echo '<option value="' . $row['id_kategori'] . '">' . $row['nama_kategori'] . ' </option>';
							$no++;
						}
						?>
					</select>
				</div>
				<div class="col-md-1 panel-grids">
					<button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#popkategori" data-whatever="@mdo">Baru</button>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 control-label">
					<h4>Stok :</h4>
				</label>
				<div class="col-sm-2">
					<input class="form-control" value="<?php echo $data['stok']; ?>" type="text" name="stok" id="sisa">
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 control-label">
					<h4>Sisa :</h4>
				</label>
				<div class="col-sm-2">
					<input class="form-control" value="<?php echo $data['sisa']; ?>" type="text" name="sisa" id="sisa">
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 control-label">
					<h4>Min QTY :</h4>
				</label>
				<div class="col-sm-2">
					<input class="form-control" value="<?php echo $data['min_qty']; ?>" type="text" name="minqty" id="minqty"></input>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="form-group">

				<div class="col-sm-offset-8 col-sm-6">
					<button type="submit" class="btn btn-primary" name="simpakomponen">Simpan</button>
					<a href="<?php if (isset($_SERVER['HTTP_REFERER'])) {
									echo $_SERVER['HTTP_REFERER'];
								} ?>" class="btn btn-success">Batal</a>
				</div>
				<div class="clearfix"> </div>
			</div>
		</form>
	</div>
</div>

<!--Pop Up Kategori-->
<div class="modal fade" id="popkategori" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Kategori tipe consumable</h4>
			</div>
			<div class="modal-body">
				<form name="form-kategori" id="form-kategori" class="form-kategori form-horizontal" method="POST" action="">
					<div class="form-group">
						<label class="col-sm-5 control-label">
							<h4>Nama kategori :</h4>
						</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="nama" id="nama" required>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="form-group">
						<label class="col-sm-5 control-label">
							<h4>Tipe Kategori :</h4>
						</label>
						<div class="col-sm-5">
							<input type="text" value="komponen" class="form-control" name="tipe" id="tipe" readonly>
						</div>
						<div class="clearfix"> </div>
					</div>

					<div class="form-group">
						<div class="col-sm-offset-7 col-sm-5">
							<button type="submit" class="btn btn-primary" name="newKategori">Simpan</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
						<div class="clearfix"> </div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!--Pop Up pemasok-->
<div class="modal fade" id="poppemasok" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Model</h4>
			</div>

			<div class="modal-body">
				<form class="form-horizontal" method="POST" action="">
					<div class="form-group">
						<label class="col-sm-5 control-label">
							<h4>Nama Pemasok :</h4>
						</label>
						<div class="col-sm-5">
							<input type="text" name="pemasok" id="pemasok" required>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="form-group">
						<label class="col-sm-5 control-label">
							<h4>Alamat :</h4>
						</label>
						<div class="col-sm-5">
							<input type="text" name="alamat" id="alamat" required>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="form-group">
						<label class="col-sm-5 control-label">
							<h4>Telp :</h4>
						</label>
						<div class="col-sm-5">
							<input type="text" name="tlp" id="tlp" required>
						</div>
						<div class="clearfix"> </div>
					</div>

					<div class="form-group">
						<div class="col-sm-offset-7 col-sm-5">
							<button type="submit" class="btn btn-primary" name="newpemasok">Simpan</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
						<div class="clearfix"> </div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>