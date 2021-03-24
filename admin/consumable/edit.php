<?php
$id = $_POST['id'];
$data = mysqli_fetch_array(mysqli_query($conn, "SELECT  * FROM consumable 
				LEFT JOIN kategori ON consumable.id_kategori=kategori.id_kategori
				LEFT JOIN manufaktur ON consumable.id_manufaktur=manufaktur.id_manufaktur WHERE id='$id'"));
?>
<h2>
	<center>Edit Consumable</center><span class="label label-default"></span>
</h2>
<div class="main-page signup-page">
	<div class="sign-up-row widget-shadow">
		<form class="form-horizontal" method="POST" action="<?php echo $_POST['back-link']; ?>">
			<input value="<?php echo $data['id']; ?>" type="hidden" class="form-control" name="id" id="id" />
			<div class="form-group">
				<label class="col-sm-5 control-label">
					Nama :
				</label>
				<div class="col-sm-3">
					<input class="form-control" type="text" name="nama" id="nama" value="<?php echo $data['nama_consumable']; ?>" required>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="form-group">
 				<label class="col-sm-5 control-label">Kode Item :</label>
 				<div class="col-sm-3">
 					<input class="form-control" value="<?php echo $data['kode_item']; ?>" type="text" name="item" id="item" required>
 				</div>
 				<div class="clearfix"> </div>
 			</div>
			 <div class="form-group">
 				<label class="col-sm-5 control-label">Warna :</label>
 				<div class="col-sm-3">
 					<input class="form-control" value="<?php echo $data['warna']; ?>" type="text" name="warna" id="warna" required>
 				</div>
 				<div class="clearfix"> </div>
 			</div>
			<div class="form-group">
				<label class="col-sm-5 control-label">
					Kategori :
				</label>
				<div class="col-sm-3">
					<select name="kategori" id="kategori" class="form-control" required>
						<option value="<?php echo $data['id_kategori']; ?>"><?php echo $data['nama_kategori']; ?></option>
						<?php
						$no = 1;
						$res = $conn->query("SELECT * FROM kategori where tipe='consumable'");
						while ($row = $res->fetch_assoc()) {
							echo '<option value="' . $row['id_kategori'] . '">' . $row['nama_kategori'] . ' </option>';
							$no++;
						}
						?>
					</select>
				</div>
				<div class="col-md-1 panel-grids">
					<button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#popkategoriconsumable" data-whatever="@mdo">Baru</button>
				</div>
				<div class="clearfix"> </div>
			</div>

			<div class="form-group">
				<label class="col-sm-5 control-label">
					Manufaktur :
				</label>
				<div class="col-sm-3">
					<select name="manufaktur" id="manufaktur" class="form-control" required>
						<option value="<?php echo $data['id_manufaktur']; ?>"><?php echo $data['nama_manufaktur']; ?></option>
						<?php
						$no = 1;
						$res = $conn->query("SELECT * FROM manufaktur");
						while ($row = $res->fetch_assoc()) {
							echo '<option value="' . $row['id_manufaktur'] . '">' . $row['nama_manufaktur'] . '</option>';
							$no++;
						}
						?>
					</select>
				</div>
				<div class="col-md-1 panel-grids">
					<button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#popmanufacturer" data-whatever="@mdo">Baru</button>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 control-label">
					Nomor Model :
				</label>
				<div class="col-sm-3">
					<input class="form-control" value="<?php echo $data['no_model']; ?>" type="text" name="model" id="model" required>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 control-label">
					Stok :
				</label>
				<div class="col-sm-3">
					<input class="form-control" value="<?php echo $data['sisa']; ?>" type="text" name="sisa" id="sisa">
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 control-label">
					Min QTY :
				</label>
				<div class="col-sm-3">
					<input class="form-control" value="<?php echo $data['minqty']; ?>" type="text" name="minqty" id="minqty"></input>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="form-group">
 				<label for="keterangan" class="col-md-5 control-label">Keterangan :</label>
 				<div class="col-md-3">
 					<textarea name="keterangan" id="keterangan" style="max-width: 100%; resize: vertical;overflow-y: auto;" rows="5" class="form-control"><?= $data['keterangan'] ?></textarea>
 				</div>
 			</div>
			<div class="form-group">
				<div class="col-sm-offset-8 col-sm-6">
					<button type="submit" class="btn btn-primary" name="simpaconsumable-edit">Simpan</button>
					<a href="<?php echo $_POST['back-link']; ?>" class="btn btn-success">Batal</a>
				</div>
				<div class="clearfix"> </div>
			</div>
		</form>
	</div>
</div>