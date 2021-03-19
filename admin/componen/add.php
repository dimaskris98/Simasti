<?php

if (isset($_POST['simpankomponen'])) {
	$id_user = $_SESSION['sess_id'];
	$nama = $_POST['nama'];
	$kategori = $_POST['kategori'];
	$sisa = 0;
	$minqty = $_POST['minqty'];
	//Memasukkan data
	$sql = "INSERT INTO komponen VALUES 
('', '$nama', '$kategori', '$sisa', '$minqty')";
	$query	= mysqli_query($conn, $sql);
	echo '<script>window.location="?mod=komponen"</script>';
}

?>
<h2>
	<center>Input Komponen</center><span class="label label-default"></span>
</h2>
<div class="main-page signup-page">
	<div class="sign-up-row widget-shadow">
		<form class="form-horizontal" method="POST" action="">
			<div class="form-group">
				<label class="col-sm-5 control-label">
					<h4>Nama :</h4>
				</label>
				<div class="col-sm-3">
					<input class="form-control" type="text" name="nama" id="nama" required>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 control-label">
					<h4>Kategori :</h4>
				</label>
				<div class="col-sm-3">
					<select name="kategori" id="kategori" class="form-control" required>
						<option>Pilih Kategori</option>
						<?php
						$no = 1;
						$res = $conn->query("SELECT * FROM kategori where tipe='komponen'");
						while ($row = $res->fetch_assoc()) {
							echo '<option value="' . $row['id_kategori'] . '">' . $row['nama_kategori'] . ' </option>';
							$no++;
						}?>
					</select>
				</div>
				<div class="col-md-1 panel-grids">
					<button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#popkategorikomponen" data-whatever="@mdo">Baru</button>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 control-label">
					<h4>Min QTY :</h4>
				</label>
				<div class="col-sm-3">
					<input class="form-control" type="text" name="minqty" id="minqty"></input>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-8 col-sm-6">
					<button type="submit" class="btn btn-primary" name="simpankomponen">Simpan</button>
					<a href="<?php if (isset($_SERVER['HTTP_REFERER'])) {
									echo $_SERVER['HTTP_REFERER'];
								} ?>" class="btn btn-success">Batal</a>
				</div>
				<div class="clearfix"> </div>
			</div>
		</form>
	</div>
</div>