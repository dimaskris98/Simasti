<?php
if (isset($_POST['saveregitrasiaset'])) {

	$no_aset = $_POST['no_aset'];
	$tahun = $_POST['tahun'];
	$kd_kategori = $_POST['kategori'];
	$model = $_POST['model'];
	$sn = $_POST['sn'];
	$ip_address = $_POST['ip'];
	$os = $_POST['os'];
	$proc = $_POST['proc'];
	$ramhd = $_POST['ramhd'];
	$vga = $_POST['vga'];
	$pemasok = $_POST['pemasok'];
	$nik = $_POST['karyawan'];
	$showkaryawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM  data_karyawan WHERE nik= '$nik'"));
	$kd_uker = $showkaryawan['kd_uker'];
	$nama_unitkerja = $showkaryawan['nama_unitkerja'];
	$karyawan = $showkaryawan['nama_karyawan'];
	$catatan = $_POST['catatan'];
	$po = $_POST['po'];
	$tglpo = $_POST['tglpo'];
	$harga = $_POST['harga'];
	if ($_POST['karyawan'] == "") {
		$checkout_date = "";
		$lokasi = "DI TI";
	} else {
		$checkout_date = $_POST['tglkeluar'];
		$lokasi = "DI USER";
	}
	if (isset($_POST['sewa'])) {
		$sewa = $_POST['sewa'];
	} else {
		$sewa = 0;
	}
	$id_monitor = $_POST['id_monitor'];
	$status = $_POST['status'];
	if (isset($_POST['id_monitor'])) {
		$sql = "UPDATE data_aset SET  id_sup='$pemasok', kd_uker='$kd_uker', nama_unitkerja='$nama_unitkerja', nama_karyawan='$karyawan', nik='$nik', po='$po',
			tgl_po='$tglpo', lokasi='$lokasi',created_at='$created_at', sewa='$sewa',catatan='$catatan',
			tahun='$tahun',admin='$id_user',status='$status'
			WHERE no='$id_monitor'";
		$query	= mysqli_query($conn, $sql);
	}
	$sql = "INSERT INTO data_aset VALUES ('','$no_aset','$tahun','$kd_kategori',
	'$model','$sn','$ip_address','$os','$proc','$ramhd','$vga','$kd_uker','$nama_unitkerja','$nik','$karyawan','$lokasi','$pemasok',
	'$sewa','$po','$tglpo','$harga','$created_at','','','','','','$id_monitor',
	'$checkout_date','','$catatan','$id_user','$status')";
	$query	= mysqli_query($conn, $sql);
	echo '<script>window.location="All"</script>';
}
if ($mod = 'registrasiaset') {
?>
	<section class="content">
		<!-- Content -->
		<div id="webui">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-default">
						<div class="box-header with-border">
							<h2 class="box-title"><b>Registrasi Asset</b></h2>
						</div><!-- /.box-header -->
						<div class="box-body">
							<form id="create-form" class="form-horizontal" method="post" action="" role="form" enctype="multipart/form-data">
								<fieldset>
									<legend>Data Registrasi</legend>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group ">
												<label for="name" class="col-md-3 control-label">No PO</label>
												<div class="col-md-8 col-sm-12 required">
													<input class="form-control" type="text" name="po" id="po" />
												</div>
											</div>
											<div class="form-group ">
												<label for="name" class="col-md-3 control-label">Tanggal PO</label>
												<div class="col-md-8 col-sm-12 required">
													<div class="input-group">
														<input type="text" class="form-control tglpicker" placeholder="date" name="tglpo" id="tglpo" value="" required>
														<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
													</div>
												</div>
											</div>
											<div class="form-group ">
												<label for="name" class="col-md-3 control-label">Harga</label>
												<div class="col-md-8 col-sm-12 required">
													<div class="input-group">
														<input class="form-control" type="number" name="harga" id="harga" />
														<span class="input-group-addon">
															<i class="fa fa ">IDR</i>
														</span>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-md-3 control-label">Pemasok</label>
												<div class="col-md-7 required">
													<select class="form-control" title="Pilih Pemasok" name="pemasok" id="pemasok">
														<option value="">Silahkan Pilih...</option>
														<?php
														$res = $conn->query("SELECT * FROM data_pemasok");
														while ($row = $res->fetch_assoc()) {
															echo '
													<option value="' . $row['id_sup'] . '"> ' . $row['nama_sup'] . ' </option>
													';
														}
														?>
													</select>
												</div>
												<div class="col-md-1 ">
													<button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#popsupplier" data-whatever="@mdo">Baru</button>
												</div>
											</div>
											<div class="form-group ">
												<label for="model_number" class="col-md-3 control-label">Tahun</label>
												<div class="col-md-7">
													<div class="input-group year">
														<input type="text" class="form-control datepicker" placeholder="Tahun" name="tahun" id="tahun" required>
														<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
													</div>
												</div>
											</div>
										</div>

									</div>

								</fieldset>
								<fieldset>
									<legend>Data Asset</legend>
									<div class="form-group">
										<div class="col-md-2 col-sm-12 required">
											<input class="form-control" type="text" name="no_aset" id="no_aset" placeholder="No Asset" />
										</div>
										<div class="col-md-3 required">
											<select onchange="change()" class="form-control" title="Pilih Kategori" name="kategori" id="kategori" required>
												<option value="" disabled selected>Pilih Kategori</option>
												<?php
												$res = $conn->query("SELECT * FROM data_kategori");
												while ($row = $res->fetch_assoc()) {
													echo '
													<option value="' . $row['kd_kategori'] . '"> ' . $row['nama_kategori'] . ' </option>
													';
												}
												?>
											</select>
										</div>
										<div class="col-md-3 required">
										<select class="form-control select3" title="Pilih Model" name="model" id="model">
											<option value="">Silahkan Pilih...</option>
											<?php
											$res = $conn->query("SELECT model FROM data_aset GROUP BY model ORDER BY model ASC");
											while ($row = $res->fetch_assoc()) {
												echo '
													<option value="' . $row['model'] . '"> ' . $row['model'] . ' </option>
													';
											}
											?>
										</select>
									</div>
									</div>

								</fieldset>

								<div class="form-group ">
									<label for="model_number" class="col-md-3 control-label">Model</label>
									
									<div class="col-md-1 ">
										<button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#popmodel" data-whatever="@mdo">Baru</button>
									</div>
								</div>
								<div class="form-group ">
									<label for="model_number" class="col-md-3 control-label">Asset Tag (S/N).</label>
									
								</div>
								<div id="divos" style="display:none;">
									<div class="form-group ">
										<label for="model_number" class="col-md-3 control-label">Ip Address</label>
										<div class="col-md-7">
											<input class="form-control" type="text" name="ip" id="ip" />
										</div>
									</div>
									<div class="form-group ">
										<label for="model_number" class="col-md-3 control-label">OS</label>
										<div class="col-md-7">
											<input class="form-control" type="text" name="os" id="os" />
										</div>
									</div>
									<div class="form-group ">
										<label for="model_number" class="col-md-3 control-label">Processor</label>
										<div class="col-md-7">
											<input class="form-control" type="text" name="proc" id="proc" />
										</div>
									</div>
									<div class="form-group ">
										<label for="model_number" class="col-md-3 control-label">RAM dan HDD</label>
										<div class="col-md-7">
											<input class="form-control" type="text" name="ramhd" id="ramhd" />
										</div>
									</div>
									<div class="form-group ">
										<label for="model_number" class="col-md-3 control-label">VGA External</label>
										<div class="col-md-7">
											<input class="form-control" type="text" name="vga" id="vga" />
										</div>
									</div>
								</div>

								<div class="form-group ">
									<label for="model_number" class="col-md-3 control-label">Sewa</label>
									<div class="col-md-7">
										<input type="checkbox" name="sewa" id="sewa" value="1" />
									</div>
								</div>
								<div class="form-group">
									<label for="category_id" class="col-md-3 control-label">Status</label>
									<div class="col-md-7 required">
										<select onchange="TampilNotes(this.value)" onclick="changeValue(this.value)" class="form-control" title="Pilih Status" name="status" id="status" required>
											<option value="">Silahkan Pilih...</option>
											<?php
											$res = $conn->query("SELECT * FROM status_labels  WHERE name NOT LIKE '%scrab%'");
											$jsArray = "var dtstatus = new Array();\n";
											while ($row = $res->fetch_assoc()) {
												echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
												$jsArray .= "dtstatus['" . $row['id'] . "'] = {deployable:'" . addslashes($row['deployable']) . "'};\n";
											}
											?>
										</select>
										<input type="hidden" name="jrsn" id="jrsn" />
									</div>
									<div class="col-md-7 col-md-offset-3">
										<a id="tampilnote"></a>
									</div>
								</div>
								<div id="divstatus" style="display:none;">
									<div class="form-group ">
										<label for="name" class="col-md-3 control-label">Tanggal Keluar</label>
										<div class="col-md-7 col-sm-12">
											<div class="input-group col-md-5">
												<input type="text" class="form-control tglpicker" placeholder="Tanggal Keluar" name="tglkeluar" id="tglkeluar" value="">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Karyawan</label>
										<div class="col-md-7 required">
											<select class="form-control selectpicker" data-live-search="true" style="width: 100%" name="karyawan" id="karyawan">
												<option value="">Silahkan Pilih...</option>
												<?php
												$res = $conn->query("SELECT * FROM data_karyawan");
												while ($row = $res->fetch_assoc()) {
													echo '<option value="' . $row['nik'] . '">' . $row['nik'] . ' - ' . $row['nama_karyawan'] . ' </option>';
												}
												?>
											</select>
										</div>
										<div class="col-md-1 ">
											<button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#popnewkaryawan" data-whatever="@mdo">Baru</button>
										</div>
									</div>
								</div>
								<div id="divmonitor" style="display:none;">
									<div class="form-group ">
										<label for="model_number" class="col-md-3 control-label">No Aset Monitor</label>
										<div class="col-md-7">
											<select class="form-control" name="id_monitor" id="id_monitor" style="width: 100%">
												<option value="">Silahkan Pilih...</option>
												<?php
												$res = $conn->query("SELECT * FROM data_aset where kd_kategori='CM'");
												while ($row = $res->fetch_assoc()) {
													echo '
														<option value="' . $row['no_aset'] . '"> ' . $row['no_aset'] . ' - ' . $row['model'] . ' </option>
														';
												}
												?>
											</select>
										</div>
										<div class="col-md-1">
											<button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#popMonitor" data-whatever="@mdo">Baru</button>
										</div>
									</div>
								</div>
								<div class="form-group ">
									<label for="name" class="col-md-3 control-label">Catatan</label>
									<div class="col-md-7 col-sm-12 required">
										<textarea class="form-control" type="text" name="catatan" id="catatan"></textarea>

									</div>
								</div>
								<div class="box-footer text-right">
									<button type="submit" name="saveregitrasiaset" id="saveregitrasiaset" class="btn btn-success"><i class="fa fa-check icon-white"></i> Save</button>
								</div>
							</form>
						</div>
					</div>
				</div>


			</div>
		</div>
	<?php
}


	?>

	</section>