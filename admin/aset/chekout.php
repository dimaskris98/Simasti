<?php
if (isset($_POST['savecheckout'])) {

	$aset = explode("/", $_POST['no_aset']);
	$id_aset = $aset[0];
	$no_aset = $aset[1];

	$uker = explode("/", $_POST['uker']);
	$kd_uker = $uker[0];
	$nm_uker = $uker[1];

	$karyawan = explode("/", $_POST['karyawan']);
	$nik = $karyawan[0];
	$nama = $karyawan[1];

	$catatan = $_POST['catatan'];
	$tgl_keluar = $_POST['tgl_keluar'];

	$boolean = TRUE;

	if ($_POST['monitor'] != "") {

		$aset_monitor = explode("/", $_POST['monitor']);
		$id_aset_monitor = isset($aset_monitor[0]) ? $aset_monitor[0] : "";
		$no_aset_monitor = isset($aset_monitor[1]) ? $aset_monitor[1] : "";

		//UPDATE ASET
		$sql1 	= "UPDATE data_aset SET nik='$nik',nama_karyawan = '$nama', kd_uker='$kd_uker',
				nama_unitkerja = '$nm_uker', lokasi='DI USER',id_monitor='$id_aset_monitor',
				catatan='$catatan' WHERE no='$id_aset'";
		if (!mysqli_query($conn, $sql1)) {
			$boolean = FALSE;
		}
		echoLog($conn, 'UPDATE ASET');

		//LOG ASET  
		$sqllog = "INSERT INTO data_aset_logs  VALUES ('', '$id_aset', '$no_aset','Pendistribusian ke', '$nik','$catatan','$id_user','$tgl_keluar')";
		if (!mysqli_query($conn, $sqllog)) {
			$boolean = FALSE;
		}
		echoLog($conn, 'LOG ASET');

		//UPDATE MONITOR
		$sql2 	= "UPDATE data_aset SET nik='$nik',nama_karyawan = '$nama', kd_uker='$kd_uker',
					nama_unitkerja = '$nm_uker', lokasi='DI USER',
					catatan='$catatan' WHERE no='$id_aset_monitor'";
		if (!mysqli_query($conn, $sql2)) {
			$boolean = FALSE;
		}
		echoLog($conn, 'UPDATE MONITOR');

		//log
		$sqllog = "INSERT INTO data_aset_logs  VALUES ('', '$id_aset_monitor', '$no_aset_monitor','Pendistribusian ke', '$nik','$catatan','$id_user','$tgl_keluar')";
		if (!mysqli_query($conn, $sqllog)) {
			$boolean = FALSE;
		}
		echoLog($conn, 'LOG MONITOR');

	} else {
		$sql1 	= "UPDATE data_aset SET nik='$nik',nama_karyawan = '$nama', kd_uker='$kd_uker',
					nama_unitkerja = '$nm_uker', lokasi='DI USER',id_monitor='',
					catatan='$catatan' WHERE no='$id_aset'";
		if (!mysqli_query($conn, $sql1)) {
			$boolean = FALSE;
		}
		echoLog($conn, 'UPDATE ASET');

		//log	  
		$sqllog = "INSERT INTO data_aset_logs  VALUES ('', '$id_aset', '$no_aset','Pendistribusian ke', '$nik','$catatan','$id_user','$tgl_keluar')";
		if (!mysqli_query($conn, $sqllog)) {
			$boolean = FALSE;
		}
		echoLog($conn, 'LOG ASET');
	}

	if ($boolean) {
		echo "<script>
			alert('Data distribusi berhasil disimpan');
			window.location = 'All'
			</script>";
	} else {
		echo "<script>
			alert('Data distribusi gagal disimpan');
			</script>";
	}

	// $aset_replace = explode("/", $_POST['no_aset_replace']);
	// @$id_aset_replace = $aset_replace[0];
	// @$no_aset_replace = $aset_replace[1];
	// if ($no_aset_replace != "") {

	// 	$tgl_masuk = $_POST['tgl_masuk'];
	// 	$status = $_POST['status'];
	// 	$sql3 	= "UPDATE data_aset SET nik='', kd_uker='',lokasi='DI TI'
	// 				,checkin_date='$tgl_masuk', status='$status'
	// 				WHERE no='$id_aset_replace'";
	// 	$query	= mysqli_query($conn, $sql3);

	// 	//log
	// 	$sqllog = "INSERT INTO data_aset_logs  VALUES ('', '$id_aset_replace', '$no_aset_replace','Pengembalian dari', '$nik','$catatan','$id_user','$tgl_keluar')";
	// 	$querylog	= mysqli_query($conn, $sqllog);
	// 	echo "2";
	// }

	// $monitor_replace = explode("/", $_POST['id_monitor_replace']);
	// @$id_aset_monitor_replace = $monitor_replace[0];
	// @$no_aset_monitor_replace = $monitor_replace[1];
	// if ($_POST['id_monitor_replace'] !="") {
	// 	echo "asas";
	// 	$tgl_masuk = $_POST['tgl_masuk'];
	// 	$status = $_POST['status_monitor'];
	// 	$sql4 	= "UPDATE data_aset SET nik='', kd_uker='',lokasi='DI TI'
	// 				,checkin_date='$tgl_masuk', status='$status'
	// 				WHERE no='$id_aset_monitor_replace'";
	// 	$query	= mysqli_query($conn, $sql4);

	// 	//log
	// 	$sqllog = "INSERT INTO data_aset_logs  VALUES ('', '$id_aset_monitor_replace', '$no_aset_monitor_replace','Pengembalian dari', '$nik','$catatan','$id_user','$tgl_keluar')";
	// 	$querylog	= mysqli_query($conn, $sqllog);
	// 	echo "3";
	// }
	
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
<div id="webui">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="box box-default">
				<div class="box-header with-border">
					<h2 class="box-title"><b>Check Asset Out</b></h2>

				</div><!-- /.box-header -->
				<div class="box-body">
					<form id="create-form" class="form-horizontal" method="post" action="" role="form" enctype="multipart/form-data">
						<div class="form-group ">
							<label for="name" class="col-md-3 control-label">No Aset</label>
							<div class="col-md-7 col-sm-12 required">
								<select class="form-control select2" data-live-search="true" title="Pilih Aset" name="no_aset" id="no_aset" required>
									<option value=""></option>
									<?php
									$res = $conn->query("SELECT * FROM data_aset where lokasi='DI TI'");
									while ($row = $res->fetch_assoc()) {
										echo '
													<option value="' . $row['no'] . '/' . $row['no_aset'] . '"> ' . $row['no_aset'] . ' - ' . $row['model'] . ' </option>
													';
									}

									?>
								</select>

							</div>
						</div>
						<div class="form-group ">
							<label for="model_number" class="col-md-3 control-label">Monitor</label>
							<div class="col-md-7">
								<input type="checkbox" name="chekoutmonitor" id="chekoutmonitor" onclick="ShowIfCheckedMonitoraktif()" />
								<div id="divCheckedMonitoraktif" style="display:none;">
									<select style="width:100%;" class="form-control select2" data-live-search="true" title="Pilih Monitor" name="monitor" id="monitor">
										<option value=""></option>
										<?php
										$res = $conn->query("SELECT * FROM data_aset where kd_kategori='CM' and lokasi='DI TI'");
										while ($row = $res->fetch_assoc()) {
											echo '
														<option value="' . $row['no'] . '/' . $row['no_aset'] . '"> ' . $row['no_aset'] . ' - ' . $row['model'] . ' </option>
														';
										}

										?>
									</select>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Karyawan</label>
							<div class="col-md-7 required">
								<select style="width:100%;" class="form-control select2" data-live-search="true" title="Pilih Karyawan" name="karyawan" id="karyawan" required>
									<option value=""></option>
									<?php
									$res = $conn->query("SELECT * FROM data_karyawan");
									while ($row = $res->fetch_assoc()) {
										echo '
													<option value="' . $row['nik'] . '/' . $row['nama_karyawan'] . '">' . $row['nik'] . ' - ' . $row['nama_karyawan'] . ' </option>
													';
									}

									?>
								</select>
							</div>
							<div class="col-md-1 panel-grids">
								<button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#popnewkaryawan" data-whatever="@mdo">Baru</button>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Unit Kerja</label>
							<div class="col-md-7 required">
								<select style="width:100%;" name="uker" id="uker" title="Pilih Unit Kerja" class="form-control select2" data-live-search="true" required>
									<option value=""></option>
									<?php
									$res = $conn->query("SELECT * FROM data_uker");
									while ($row = $res->fetch_assoc()) {
									?> <optgroup label="<?php echo $row['nama_uker']; ?>">
											<?php
											$kduker = $row['kd_uker'];
											$res1 = $conn->query("SELECT * FROM data_uker_bagian where kd_uker='$kduker'");

											while ($row1 = $res1->fetch_assoc()) {
											?>
												<option value="<?php echo $row1['kd_bag'] . '/' . $row1['nama_bag']; ?>"><?php echo $row1['nama_bag']; ?></option>

											<?php } ?>
										</optgroup>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group ">
							<label for="name" class="col-md-3 control-label">Tanggal</label>
							<div class="col-md-9">
								<div class="input-group date col-md-5" data-provide="datepicker" data-date-format="yyyy-mm-dd">
									<input type="text" class="form-control" placeholder="Tanggal Keluar" name="tgl_keluar" id="tgl_keluar">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								</div>

							</div>
						</div>
						<hr>
						<hr>
						<div class="form-group ">
							<label for="name" class="col-md-3 control-label">Catatan</label>
							<div class="col-md-7 col-sm-12 required">
								<textarea class="form-control" type="text" name="catatan" id="catatan"></textarea>

							</div>
						</div>
						<div class="box-footer text-right">
							<button type="submit" name="savecheckout" id="savecheckout" class="btn btn-success"><i class="fa fa-check icon-white"></i> Save</button>
						</div>
					</form>
				</div>
			</div>
		</div>

	</div>
</div>