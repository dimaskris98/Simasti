<?php
if (isset($_POST['savecheckin'])) {

	$aset = explode("/", $_POST['no_aset']);
	$id_aset = $aset[0];
	$no_aset = $aset[1];
	$status_aset = $_POST['status_aset'];

	$uker = explode("/", $_POST['uker']);
	$kd_uker = $uker[0];
	$nm_uker = $uker[1];

	$karyawan = explode("/", $_POST['karyawan']);
	$nik = $karyawan[0];
	$nama = $karyawan[1];

	$catatan = $_POST['catatan'];
	$date = date('Y-m-d');

	$boolean = TRUE;

	//UPDATE ASET
	$sql1 	= "UPDATE data_aset SET nik='',nama_karyawan='', kd_uker='',nama_unitkerja='', lokasi='DI TI',id_monitor='',catatan='$catatan',status='$status_aset'
		 WHERE no='$id_aset'";
	if (!mysqli_query($conn, $sql1)) {
		$boolean = FALSE;
	}
	echoLog($conn, 'UPDATE ASET');

	//LOG ASET
	$sqllog = "INSERT INTO data_aset_logs  VALUES ('', '$id_aset', '$no_aset','Pengembalian dari ', '$nik','$catatan','$id_user','$date')";
	echoLog($conn, 'LOG ASET');
	if (!mysqli_query($conn, $sqllog)) {
		$boolean = FALSE;
	}

	if ($_POST['monitor'] != "") {
		$aset_monitor = explode("/", $_POST['monitor']);
		$id_aset_monitor = isset($aset_monitor[0]) ? $aset_monitor[0] : "";
		$no_aset_monitor = isset($aset_monitor[1]) ? $aset_monitor[1] : "";
		$status_monitor = isset($_POST['status_monitor']) ? $_POST['status_monitor'] : "";


		//UPDATE MONITOR
		$sql2 	= "UPDATE data_aset SET nik='',nama_karyawan='', kd_uker='',nama_unitkerja='', lokasi='DI TI'
					,catatan='$catatan',status='$status_monitor'
					WHERE no='$id_aset_monitor'";
		echoLog($conn, 'UPDATE MONITOR');
		if (!mysqli_query($conn, $sql2)) {
			$boolean = FALSE;
		}

		//LOG MONITOR
		$sqllog = "INSERT INTO data_aset_logs  VALUES ('', '$id_aset_monitor', '$no_aset_monitor','Pengembalian dari ', '$nik','$catatan','$id_user','$date')";
		if (!mysqli_query($conn, $sqllog)) {
			$boolean = FALSE;
		}
		echoLog($conn, 'LOG MONITOR');
	}

	if ($_POST['aset_replace'] != "") {
		$aset_replace = explode("/", $_POST['no_aset_replace']);
		$id_aset_replace = $aset_replace[0];
		$no_aset_replace = $aset_replace[1];

		//UPDATE ASET REPLACE
		$sql3 	= "UPDATE data_aset SET nik='$nik',nama_karyawan='$nama', kd_uker='$kd_uker',nama_unitkerja='$nm_uker',lokasi='DI USER' WHERE no='$id_aset_replace'";
		if (!mysqli_query($conn, $sql3)) {
			$boolean = FALSE;
		}
		echoLog($conn, 'UPDATE ASET REPLACE');

		//LOG ASET REPLACE
		$sqllog = "INSERT INTO data_aset_logs  VALUES ('', '$id_aset_replace', '$no_aset_replace','Pendistribusian ke', '$nik','$catatan','$id_user','$date')";
		if (!mysqli_query($conn, $sqllog)) {
			$boolean = FALSE;
		}
		echoLog($conn, 'LOG ASET REPLACE');
	}

	if ($_POST['monitor_replace'] != "") {
		$monitor_replace = explode("/", $_POST['monitor_replace']);
		$id_monitor_replace = isset($monitor_replace[0]) ? $monitor_replace[0] : "";
		$no_monitor_replace = isset($monitor_replace[1]) ? $monitor_replace[1] : "";

		//UPDATE MONITOR REPLACE
		$sql4 	= "UPDATE data_aset SET nik='$nik',nama_karyawan='$nama', kd_uker='$kd_uker',nama_unitkerja='$nm_uker',lokasi='DI TI' WHERE no='$id_monitor_replace'";
		if (!mysqli_query($conn, $sql4)) {
			$boolean = FALSE;
		}
		echoLog($conn, 'ASET MONITOR REPLACE');

		//LOG MONITOR REPLACE
		$sqllog = "INSERT INTO data_aset_logs  VALUES ('', '$id_monitor_replace', '$no_monitor_replace','Pendistribusian ke', '$nik','$catatan','$id_user','$date')";
		if (!mysqli_query($conn, $sqllog)) {
			$boolean = FALSE;
		}
		echoLog($conn, 'LOG MONITOR REPLACE');
	}
	if ($boolean) {
		echo "<script>
			alert('Data pengembalian berhasil disimpan');
			window.location = 'All'
			</script>";
	} else {
		echo "<script>
			alert('Data pengembalian gagal disimpan');
			</script>";
	}
}

function echoLog($conn, $message)
{
	if (mysqli_affected_rows($conn) > 0) {
		echo "<script>console.log('$message berhasil ditambah')</script>";
	} else {
		$c = mysqli_error($conn);
		echo "<script>console.log('$c')</script>";
	}
}
?>
<Div id="webui">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="box box-default">
				<div class="box-header with-border">
					<h2 class="box-title"><b>Check Asset In</b></h2>

				</div><!-- /.box-header -->
				<div class="box-body">
					<form id="create-form" class="form-horizontal" method="post" action="" role="form" enctype="multipart/form-data">
						<div class="form-group ">
							<label for="name" class="col-md-3 control-label">No Aset</label>
							<div class="col-md-7 col-sm-12 required">
								<select class="form-control selectpicker" data-live-search="true" title="Pilih Aset" name="no_aset" id="no_aset" required>
									<option value=""></option>
									<?php
									$res = $conn->query("SELECT * FROM data_aset where lokasi='DI USER'");
									while ($row = $res->fetch_assoc()) {
										echo '
													<option value="' . $row['no'] . '/' . $row['no_aset'] . '"> ' . $row['no_aset'] . ' - ' . $row['model'] . ' </option>
													';
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="category_id" class="col-md-3 control-label">Status</label>
							<div class="col-md-7 required">
								<select onchange="TampilNotes(this.value)" class="form-control" title="Pilih Aset" name="status_aset" id="status">
									<option value=""></option>
									<?php
									$res = $conn->query("SELECT * FROM status_labels");
									while ($row = $res->fetch_assoc()) {
										echo '<option value="' . $row['id'] . '"> ' . $row['name'] . ' </option>';
									}
									?>
								</select>
								<a id="tampilnote"></a>
							</div>
						</div>
						<div class="form-group ">
							<label for="model_number" class="col-md-3 control-label">Monitor</label>
							<div class="col-md-7">
								<input type="checkbox" name="penggantianmonitor" id="penggantianmonitor" onclick="showMonitor1('divMonitor')" />
							</div>
						</div>

						<div id="divMonitor" style="display:none;">
							<div class="form-group ">
								<label for="model_number" class="col-md-3 control-label">No Aset</label>
								<div class="col-md-7">
									<select class="form-control selectpicker" data-live-search="true" title="Pilih Monitor" name="monitor" id="monitor">
										<option value=""></option>
										<?php
										$res = $conn->query("SELECT * FROM data_aset where kd_kategori='CM' and lokasi='DI USER'");
										while ($row = $res->fetch_assoc()) {
											echo '<option value="' . $row['no'] . '/' . $row['no_aset'] . '"> ' . $row['no_aset'] . ' - ' . $row['model'] . ' </option>';
										}

										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="category_id" class="col-md-3 control-label">Status</label>
								<div class="col-md-7 required">
									<select onchange="TampilNotes(this.value)" class="form-control" placeholder="Pilih Status" name="status_monitor" id="status_monitor">
										<option value=""></option>
										<?php
										$res = $conn->query("SELECT * FROM status_labels");
										while ($row = $res->fetch_assoc()) {
											echo '<option value="' . $row['id'] . '"> ' . $row['name'] . ' </option>';
										}
										?>
									</select>
									<a id="tampilnote"></a>

								</div>
							</div>
						</div>
						<hr>
						<div class="form-group">
							<label class="col-md-3 control-label">Karyawan</label>
							<div class="col-md-7 required">
								<select class="form-control selectpicker" data-live-search="true" title="Pilih Karyawan" name="karyawan" id="karyawan" required>
									<option value=""></option>
									<?php
									$res = $conn->query("SELECT * FROM data_karyawan");
									while ($row = $res->fetch_assoc()) {
										echo '
													<option value="' . $row['nik'] . '/' . $row['nama_karyawan'] . '"> ' . $row['nik'] . '-' . $row['nama_karyawan'] . ' </option>
													';
									}

									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Unit Kerja</label>
							<div class="col-md-7 required">
								<select name="uker" id="uker" title="Pilih Unit Kerja" class="form-control  selectpicker" data-live-search="true" required>
									<option value=""></option>
									<?php
									$res = $conn->query("SELECT * FROM data_uker");
									while ($row = $res->fetch_assoc()) {
									?> <optgroup label="<?php echo $row['nama_uker']; ?>">

											<option value="<?php echo $row['kd_uker'] . '/' . $row['nama_uker']; ?>"><?php echo $row['nama_uker']; ?>
											</option>
											<?php
											$kduker = $row['kd_uker'];
											$res1 = $conn->query("SELECT * FROM data_uker_bagian where kd_uker='$kduker'");

											while ($row1 = $res1->fetch_assoc()) {
											?>
												<option value="<?php echo $row1['kd_bag'] . '/' . $row1['nama_bag']; ?>"><?php echo $row1['nama_bag']; ?>
												</option>

											<?php } ?>
										</optgroup>
									<?php } ?>
								</select>
							</div>
						</div>

						<hr>


						<div class="form-group ">
							<label for="model_number" class="col-md-3 control-label">Penggantian</label>
							<div class="col-md-7">
								<input type="checkbox" name="penggantian" id="penggantian" onclick="showMonitor1('divChecked')" />
							</div>
						</div>
						<div id="divChecked" style="display:none;">
							<div class="form-group ">
								<label for="name" class="col-md-3 control-label">No Aset</label>
								<div class="col-md-7 col-sm-12 required">
									<select class="form-control selectpicker" data-live-search="true" title="Pilih Aset" name="aset_replace" id="no_aset_replace">
										<option value=""></option>
										<?php
										$res = $conn->query("SELECT * FROM data_aset where lokasi='DI USER'");
										while ($row = $res->fetch_assoc()) {
											echo '<option value="' . $row['no'] . '/' . $row['no_aset'] . '"> ' . $row['no_aset'] . ' - ' . $row['model'] . ' </option>';
										} ?>
									</select>
								</div>
							</div>
							<hr>
							<div class="form-group ">
								<label for="model_number" class="col-md-3 control-label">Monitor</label>
								<div class="col-md-7">
									<input type="checkbox" name="penggantianmonitor" id="penggantianmonitor" onclick="showMonitor1('divCheckedMonitor')" />
								</div>
							</div>
							<div id="divCheckedMonitor" style="display:none;">
								<div class="form-group ">
									<label for="model_number" class="col-md-3 control-label">No Aset</label>
									<div class="col-md-7">
										<select class="form-control selectpicker" data-live-search="true" title="Pilih Monitor" name="monitor_replace" id="monitor_replace">
											<option value=""></option>
											<?php
											$res = $conn->query("SELECT * FROM data_aset where kd_kategori='CM' and lokasi='DI USER'");
											while ($row = $res->fetch_assoc()) {
												echo '<option value="' . $row['no'] . '/' . $row['no_aset'] . '"> ' . $row['no_aset'] . ' - ' . $row['model'] . ' </option>';
											}

											?>
										</select>
									</div>
								</div>
							</div>
						</div>
						<hr>
						<div class="form-group ">
							<label for="name" class="col-md-3 control-label">Catatan</label>
							<div class="col-md-7 col-sm-12 required">
								<textarea class="form-control" type="text" name="catatan" id="catatan"></textarea>

							</div>
						</div>
						<div class="box-footer text-right">
							<button type="submit" name="savecheckin" id="savecheckin" class="btn btn-success"><i class="fa fa-check icon-white"></i> Save</button>
						</div>
					</form>
					<script>
						function showMonitor1(id) {
							var x = document.getElementById(id);
							if (x.style.display === "none") {
								x.style.display = "block";
							} else {
								x.style.display = "none";
							}
						}
					</script>
				</div>
			</div>
		</div>
	</div>
</div>