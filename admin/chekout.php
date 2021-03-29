<style type='text/css'>
	input.untukInput2 {
		border-bottom: 3px solid #ccc;
		border-left: none;
		border-right: none;
		border-top: none;
		outline: none;
		width: 300px;
	}

	input.niksap {
		width: 100px;
	}

	input.aset {
		width: 100px;
	}

	.label-left {
		text-align: left !important;
		font-weight: normal;
	}
</style>

<?php

if (isset($_POST['simpanlicensi'])) {

	$id_user = $_SESSION['sess_id'];
	$id_licensi = $_POST['id'];
	$seats = $_POST['seats'];

	$karyawan = $_POST['nik_sap'];
	$aset = $_POST['aset'];
	$qty = "1";
	$tgl = date("Y-m-d h:i:sa");
	$sql1 = "INSERT INTO licensi_seat 
			VALUES ('', '$seatOn', '$id_licensi', '$karyawan', '$aset', '$tgl','$id_user')";
	$query1	= mysqli_query($conn, $sql1);

	$sql = "SELECT  sisa FROM licensi WHERE id ='$id_licensi'";
	$hasil = $conn->query($sql);
	$data = $hasil->fetch_array();
	$sisalama = $data['sisa'];
	$stokbaru = $sisalama - $qty;
	$sql 	= "UPDATE licensi SET sisa='$stokbaru' WHERE id='$id_licensi'";
	$query	= mysqli_query($conn, $sql);
	echo "<script> location.href='licensi'; </script>";
}


if (isset($_POST['simpancons'])) {
	$id_user = $_SESSION['sess_id'];
	$id_consumable = $_POST['id'];
	$qty = $_POST['qty'];
	$karyawan = $_POST['nik_sap'];
	$tgl = date("Y-m-d h:i:sa");

	$sql = "SELECT  sisa FROM consumable WHERE id ='$id_consumable'";
	$hasil = $conn->query($sql);
	$data = $hasil->fetch_array();
	$sisalama = $data['sisa'];
	$stokbaru = $sisalama - $qty;

	$sql1 = "INSERT INTO consumable_user 
			VALUES ('','$id_user', '$id_consumable', '$qty', '$karyawan', '$tgl',$stokbaru)";
	$query1	= mysqli_query($conn, $sql1);

	$sql 	= "UPDATE consumable SET sisa='$stokbaru' WHERE id='$id_consumable'";
	$query	= mysqli_query($conn, $sql);
	echo "<script> location.href='consumables'; </script>";
}

if (isset($_POST['simpankomponen'])) {
	$id_user = $_SESSION['sess_id'];
	$idkomponen = $_POST['id'];
	$aset = $_POST['aset'];
	$serial = $_POST['serial'];
	$qty = '1';
	$tgl = date("Y-m-d h:i:sa");

	$sql = "SELECT sisa FROM komponen WHERE id ='$idkomponen'";
	$hasil = $conn->query($sql);
	$data = $hasil->fetch_array();
	$sisalama = $data['sisa'];
	$stokbaru = $sisalama - $qty;

	$sql1 = "INSERT INTO komponen_aset 
	VALUES ('','$idkomponen', '$aset', '$serial', '$tgl', '$id_user',$stokbaru,$qty)";
	$query1	= mysqli_query($conn, $sql1);

	//updet data komponen

	$sql 	= "UPDATE komponen SET sisa='$stokbaru' WHERE id='$idkomponen'";
	$query	= mysqli_query($conn, $sql);
	echo "<script> location.href='komponen'; </script>";
}
if (isset($_POST['simpanaset'])) {
	echo $model_id = $_POST['model_id'];
	$idaset = $_POST['idaset'];
	$nik_sap = $_POST['user'];
	$lokasi = $_POST['location'];
	$checkout_at = $_POST['checkout_at'];

	$sql 	= "UPDATE 1assets SET assigned_to='$nik_sap', checkout_date='$checkout_at', location='$lokasi' WHERE id='$idaset'";

	$query	= mysqli_query($conn, $sql);
	echo '<script>window.location="models?view=' . $model_id . '"</script>';
}
//asset
if (isset($_GET['asset'])) {
	$aset_id = $_GET['asset'];
	$showaset = mysqli_fetch_array(mysqli_query($conn, "SELECT 1models.id as idmodel,1models.name as namamodel, 1models.*,data_karyawan.*, status_labels.*, status_labels.name as status,1assets.name as aset ,1assets.id as idaset , 1assets.* FROM 1assets LEFT JOIN 1models ON 1assets.model_id=1models.id LEFT JOIN status_labels ON 1assets.status_id=status_labels.id LEFT JOIN data_karyawan ON 1assets.assigned_to=data_karyawan.nik where 1assets.id='$aset_id'"));
?>
	<div class="row">
		<!-- left column -->
		<div class="col-md-7">
			<div class="box box-default">
				<form class="form-horizontal" method="post" action="" autocomplete="off">
					<div class="box-header with-border">
						<h3 class="box-title"> Asset Tag <?php echo $showaset['asset_tag']; ?></h3>
					</div>
					<div class="box-body">
						<input type="hidden" name="_token" value="vKlAuyqzYKEzOg5l61nUSiZhB2stB3xoIhsqyrKu">
						<!-- Model name -->
						<div class="form-group ">
							<label for="name" class="col-md-3 control-label">Model</label>
							<div class="col-md-8">
								<p class="form-control-static"><?php echo $showaset['namamodel']; ?></p>
								<input class="form-control" type="hidden" name="model_id" id="model_id" readonly value="<?php echo $showaset['idmodel']; ?>" />
							</div>
						</div>

						<!-- Asset Name -->
						<div class="form-group ">
							<label for="name" class="col-md-3 control-label">Asset Name</label>
							<div class="col-md-7">
								<p class="form-control-static"><?php echo $showaset['aset']; ?></p>
								<input class="form-control" type="hidden" name="idaset" id="idaset" readonly value="<?php echo $aset_id; ?>" />
							</div>
						</div>
						<div class="form-group">
							<label for="assigned_user" class="col-md-3 control-label">User</label>
							<div class="col-md-7 required">

								<select name="user" id="user" class="form-control  selectpicker" data-live-search="true" required>
									<option>Select User</option>
									<?php
									$res = $conn->query("SELECT * FROM data_karyawan");
									while ($row = $res->fetch_assoc()) {
										echo '
							<option value="' . $row['nik'] . '">' . $row['nik'] . ' - ' . $row['nama_karyawan'] . '</option>
						';
									}
									?>
								</select>
							</div>
						</div>
						<!-- Location -->
						<div class="form-group">
							<label for="assigned_location" class="col-md-3 control-label">Location</label>
							<div class="col-md-7 required">
								<select title="Pilih Unit Kerja" name="location" id="location" class="form-control  selectpicker" data-live-search="true" required>

									<?php
									$res = $conn->query("SELECT * FROM data_uker");
									while ($row = $res->fetch_assoc()) {
									?> <optgroup label="<?php echo $row['nama_uker']; ?>">

											<option value="<?php echo $row['kd_uker']; ?>"><?php echo $row['nama_uker']; ?></option>
											<?php
											$kduker = $row['kd_uker'];
											$res1 = $conn->query("SELECT * FROM data_uker_bagian where kd_uker='$kduker'");

											while ($row1 = $res1->fetch_assoc()) {
											?>
												<option value="<?php echo $row1['kd_bag']; ?>"><?php echo $row1['nama_bag']; ?></option>

											<?php } ?>
										</optgroup>
									<?php } ?>
								</select>
							</div>
						</div>
						<!-- Checkout/Checkin Date -->
						<div class="form-group ">
							<label for="name" class="col-md-3 control-label">Checkout Date</label>
							<div class="col-md-8">
								<div class="input-group date col-md-5" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-end-date="0d">
									<input type="date" class="form-control" placeholder="Select Date (YYYY-MM-DD)" name="checkout_at" id="checkout_at" value="">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								</div>

							</div>
						</div>
					</div>
					<!--/.box-body-->
					<div class="box-footer">
						<a class="btn btn-link" href="models?view=<?php echo $showaset['idmodel']; ?>"> Cancel</a>
						<button type="submit" name="simpanaset" id="simpanaset" class="btn btn-success pull-right"><i class="fa fa-check icon-white"></i> Checkout</button>
					</div>
				</form>
			</div>
		</div>
		<!--/.col-md-7-->

		<!-- right column -->
		<div class="col-md-5" id="current_assets_box" style="display:none;">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Assets currently checked out to this user</h3>
				</div>
				<div class="box-body">
					<div id="current_assets_content">
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
}
//Consumables
if (isset($_GET['cons'])) {
	$de =  $_GET['cons'];
	$sql = "SELECT *	FROM consumable
				LEFT JOIN kategori ON consumable.id_kategori=kategori.id_kategori 
				LEFT JOIN manufaktur ON consumable.id_manufaktur=manufaktur.id_manufaktur
				WHERE id='$de'";
	$hasil = $conn->query($sql);
	$data = $hasil->fetch_array();
?>
	<div class="row">
		<div class="col-md-3">
		</div>
		<div class="col-md-8 general-grids widget-shadow">
			<h4><?= $data['nama_consumable'] ?> (Sisa <?= $data['sisa'] ?>)</h4>
			<hr>
			<form class="form-horizontal" method="POST" action="">
				<input type="hidden" name="id" id="id" value="<?= $data['id'] ?>" required>
				<div class="form-group">
					<label for="nama" class="control-label col-md-3 label-left">Nama</label>
					<label for="nama" class="control-label col-md-1 label-left">:</label>
					<label for="" class="control-label col-md-8 label-left"><?= $data['nama_kategori'] ?> <?= $data['nama_consumable'] ?></label>
				</div>
				<div class="form-group">
					<label for="nama" class="control-label col-md-3 label-left">Dibagikan Ke </label>
					<label for="nama" class="control-label col-md-1 label-left">:</label>
					<div class="col-md-8">
						<select class="form-control selectpicker" data-live-search="true" title="Pilih Karyawan" name="nik_sap" id="nik_sap" required>
							<?php
							$res = $conn->query("SELECT * FROM data_karyawan ORDER BY nik ASC");
							while ($row = $res->fetch_assoc()) {
								echo '<option value="' . $row['nik'] . '">' . $row['nik'] . ' - ' . $row['nama_karyawan'] . ' </option>';
							}
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="qty" class="control-label label-left col-md-3">Jumlah</label>
					<label class="control-label label-left col-md-1">:</label>
					<div class="col-md-8">
						<input class="aset form-control" type="text" name="qty" id="qty" required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-8 col-sm-6">
						<button type="submit" class="btn btn-success" name="simpancons">Simpan</button>
						<a href="<?php if (isset($_SERVER['HTTP_REFERER'])) {
										echo $_SERVER['HTTP_REFERER'];
									} ?>" class="btn btn-primary">Kembali</a>
					</div>
					<div class="clearfix"> </div>
				</div>
			</form>
		</div>
	</div>
<?php
}
?>
<?php
if (isset($_GET['komp'])) {
	$de =  $_GET['komp'];
	$sql = "SELECT *	FROM komponen WHERE id='$de'";
	$hasil = $conn->query($sql);
	$data = $hasil->fetch_array();
	$data['id'];
	$data['nama_komponen'];
?>
	<div class="row">
		<div class="col-md-3">
		</div>
		<div class="col-md-8 general-grids widget-shadow">
			<h4><?= $data['nama_komponen'] . ' (Sisa ' . $data['sisa'] . ')' ?></h4>
			<hr>
			<form class="form-horizontal" method="POST" action="">
				<input type="hidden" name="id" id="id" value="<?= $data['id'] ?>" required>
				<h4>Nama Komponen : <?= $data['nama_komponen'] ?></h4>
				<hr>
				<div class="form-group">
					<label class="col-md-4" for="">Pilih Aset : </label>
					<div class="col-md-8">
						<select class="form-control selectpicker" data-live-search="true" title="Pilih Asset" name="aset" id="aset" required>
							<?php
							$res = $conn->query("SELECT * FROM data_aset ORDER BY no ASC");
							while ($row = $res->fetch_assoc()) {
								echo '<option value="' . $row['no'] . '"> ' . $row['no_aset'] . ' - ' . $row['model'] . ' </option>';
							} ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4" for="">No Serial</label>
					<div class="col-md-8">
						<input class="form-control" type="text" name="serial" id="serial" required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-8 col-sm-6">
						<button type="submit" class="btn btn-success" name="simpankomponen">Simpan</button>
						<a href="<?php if (isset($_SERVER['HTTP_REFERER'])) {
										echo $_SERVER['HTTP_REFERER'];
									} ?>" class="btn btn-primary">Kembali</a>
					</div>
					<div class="clearfix"> </div>
				</div>
			</form>
		</div>
	</div>
<?php
}

if (isset($_GET['lic'])) {
	$de = $_GET['lic'];
	$sql = "SELECT * FROM licensi WHERE id='$de'";
	$hasil = $conn->query($sql);
	$data = $hasil->fetch_array();
	$data['id'];
	$data['nama_licensi'];


	echo '
	<div class="row">
		<div class="col-md-3">
		</div>
		<div class="col-md-8 general-grids widget-shadow">
			<h4>' . $data['nama_licensi'] . ' (Sisa ' . $data['sisa'] . ')</h4>
			<hr>
			<form class="form-horizontal" method="POST" action="">
				<input type="hidden" name="id" id="id" value="' . $data['id'] . '" required>
				<input type="hidden" name="seats" id="seats" value="' . $data['seats'] . '" required>
				<table class="table" border="0">
					<tr>
						<td colspan="4">Nama : ' . $data['nama_licensi'] . '</td>
					</tr>
					<tr>
						<td colspan="4">Serial : ' . $data['serial'] . '</td>
					</tr>
					<tr>
						<td colspan="4">
							<hr>
						</td>
					</tr>
					<tr>
						<td colspan="4"> Dibagikan Ke</td>
					</tr>
					<tr>
						<td colspan="4">
							<div class=" tool-tips  " id="accordion" role="tablist" aria-multiselectable="true">

								<div class="panel panel-default">
									<div class="panel-heading" role="tab" id="headingOne">
										<h4 class="panel-title">
											<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
												Pilih Karyawan
											</a>
										</h4>
									</div>
									<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
										<div class="panel-body">
											<table class="table">
												<tr>
													<td>NIK</td>
													<td>:</td>
													<td>
														<input class="aset form-control" type="text" name="nik_sap" id="nik_sap" onkeydown="nama_otomatis()" onchange="nama_otomatis()" onkeyup="nama_otomatis()">

													</td>
													<td>
														<input class="untukInput2" type="text" placeholder="Nama Karyawan" name="nama" id="nama" />
													</td>
												</tr>
											</table>
										</div>
									</div>
								</div>
								<div class="panel panel-default">
									<div class="panel-heading" role="tab" id="headingTwo">
										<h4 class="panel-title">
											<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
												Pilih Asset
											</a>
										</h4>
									</div>
									<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
										<div class="panel-body">
											<table class="table">
												<tr>
													<td>No. Aset</td>
													<td>:</td>
													<td>
														<input class="aset form-control" type="text" name="aset" id="aset" onkeydown="isi_otomatis()" onchange="isi_otomatis()" onkeyup="isi_otomatis()">
													</td>
													<td>
														<input class="untukInput2" type="text" placeholder="Model Aset" name="model" id="model" />
													</td>
												</tr>
											</table>
										</div>
									</div>
								</div>
							</div>

						</td>
					</tr>
				</table>
				<div class="form-group">
					<div class="col-sm-offset-8 col-sm-6">
						<button type="submit" class="btn btn-success" name="simpanlicensi">Simpan</button>'; ?>
	<a href="<?php if (isset($_SERVER['HTTP_REFERER'])) {
					echo $_SERVER['HTTP_REFERER'];
				} ?>" class="btn btn-primary">Kembali</a>
<?php echo '</div>
						<div class="clearfix"> </div>
					</div>
		</form>
	</div>
</div>


				
';
}


?>