 <?php

	if (isset($_POST['restore'])) {
		$conn = mysqli_connect("localhost", "root", "", "dbsimasti");
		function restoreMysqlDB($filePath, $conn)
		{
			$sql = '';
			$error = '';

			if (file_exists($filePath)) {
				$lines = file($filePath);

				foreach ($lines as $line) {

					// Ignoring comments from the SQL script
					if (substr($line, 0, 2) == '--' || $line == '') {
						continue;
					}

					$sql .= $line;

					if (substr(trim($line), -1, 1) == ';') {
						$result = mysqli_query($conn, $sql);
						if (!$result) {
							$error .= mysqli_error($conn) . "\n";
						}
						$sql = '';
					}
				} // end foreach

				if ($error) {
					$response = array(
						"type" => "error",
						"message" => $error
					);
				} else {
					$response = array(
						"type" => "success",
						"message" => "Database Restore Completed Successfully."
					);
				}
				exec('rm ' . $filePath);
			} // end if file exists

			return $response;
		}
		if (!empty($_FILES)) {
			// Validating SQL file type by extensions
			if (!in_array(strtolower(pathinfo($_FILES["backup_file"]["name"], PATHINFO_EXTENSION)), array(
				"sql"
			))) {
				$response = array(
					"type" => "error",
					"message" => "Invalid File Type"
				);
			} else {
				if (is_uploaded_file($_FILES["backup_file"]["tmp_name"])) {
					move_uploaded_file($_FILES["backup_file"]["tmp_name"], $_FILES["backup_file"]["name"]);
					$response = restoreMysqlDB($_FILES["backup_file"]["name"], $conn);
				}
			}
		}
	}
	?>

 <div class="panel-info widget-shadow">

 	<div class="row">
 		<div class="col-md-6">
 			<div class="box box-default">
 				<div class="box-header with-border">
 					<h3 class="box-title">Back Up DATABASE</h3>

 				</div><!-- /.box-header -->
 				<div class="box-body">
 					<form method="post" action="export-import/proses-backup.php" enctype="multipart/form-data">
 						<div class="form-group ">
 							* Klik untuk <input type="submit" name="backup" value="Back Up DataBase" class="btn btn-success btn-md">
 						</div>
 					</form>



 				</div>
 			</div>
 		</div>
 		<div class="col-md-6">
 			<div class="box box-default">
 				<div class="box-header with-border">
 					<h3 class="box-title">Restore DATABASE</h3>
 					<?php
						if (!empty($response)) {
						?>
 						<div class="response <?php echo $response["type"]; ?>">
 							<?php echo nl2br($response["message"]); ?>
 						</div>
 					<?php
						}
						?>
 				</div><!-- /.box-header -->
 				<div class="box-body">

 					<form method="post" action="" enctype="multipart/form-data" id="frm-restore">
 						<div class="form-group ">
 							<div>Choose Backup File</div>
 							<div class="col-md-6">
 								<input type="file" class="form-control pull-left" name="backup_file" class="input-file" />
 							</div>

 							<div class="col-md-2">
 								<input type="submit" name="restore" value="Restore" class="btn btn-success btn-md">
 							</div>
 						</div>
 					</form>


 				</div>
 			</div>
 		</div>
 		<!--/.col-md-7-->
 	</div>
 	<div class="row">
 		<div class="col-md-6">
 			<div class="box box-default">
 				<div class="box-header with-border">
 					<h3 class="box-title">Form Import Data Asset</h3>

 				</div><!-- /.box-header -->
 				<div class="box-body">
 					<form method="post" action="" enctype="multipart/form-data">
 						<div class="form-group ">
 							<a href="upload/Format-aset.xlsx" class="btn btn-default">
 								<span class="glyphicon glyphicon-download"></span>
 								Download Format
 							</a><br><br>
 						</div>
 						<div class="form-group ">
 							<div class="col-md-6">
 								<input type="file" class="form-control pull-left" placeholder="file" name="file" id="file">
 							</div>
 							<div class="col-md-2">
 								<button type="submit" name="import" class="btn btn-success btn-md">Import</button>
 							</div>
 						</div>
 					</form>



 				</div>
 			</div>
 		</div>
 		<div class="col-md-6">
 			<div class="box box-default">
 				<div class="box-header with-border">
 					<h3 class="box-title">Form Export Data Asset to Excel</h3>

 				</div><!-- /.box-header -->
 				<div class="box-body">
 					<form class="form-horizontal" method="POST" action="export-import/proses-export.php">
 						<div class="form-group">
 							<label class="col-sm-3 control-label">
 								<h4>Jenis Aset :</h4>
 							</label>
 							<div class="col-sm-6">
 								<select name="jenis" id="jenis">
 									<option value="">Silahkan pilih</option>
 									<option value="0">Non Sewa</option>
 									<option Value="1">Sewa</option>
 								</select>
 							</div>
 						</div>
 						<div class="form-group">
 							<label class="col-sm-3 control-label">
 								<h4>Kategori :</h4>
 							</label>

 							<div class="col-sm-4">
 								<select class="form-control select2" data-live-search="true" name="kategori" id="kategori">

 									<option value="">Silahkan pilih</option>
 									<?php



										$res = $conn->query("SELECT * FROM data_kategori");
										while ($row = $res->fetch_assoc()) {
											echo '
									<option value="' . $row['kd_kategori'] . '">' . $row['nama_kategori'] . '</option>
								';
											$no++;
										}
										?>
 								</select>
 							</div>
 						</div>
 						<div class="form-group ">
 							<div class="col-md-4">
 							</div>
 							<div class="col-md-4">
 								<button type="submit" name="export" class="btn btn-success btn-md"><span>Export to Excel</span></button>
 							</div>
 						</div>
 					</form>

 				</div>
 			</div>
 		</div>
 		<!--/.col-md-7-->
 	</div>
 	<div class="row">

 		<div class="col-md-6"><?php if (isset($_SESSION['msg'])) {
									echo  $_SESSION['msg'];
									$_SESSION['msg'] = "";
								} ?></div>
 	</div>

 </div>
 <?php
	function checkRow($val)
	{
		return isset($val) ? $val : "";
	}
	// Jika user telah mengklik tombol Preview
	if (isset($_POST['import'])) {
		$_SESSION['msg'] = "";


		ini_set("memory_limit", "200M");
		ini_set('max_execution_time', 6000);
		ini_set('upload_max_filesize', '100M');

		$nama_file_baru = 'data.xlsx';


		// Cek apakah terdapat file data.xlsx pada folder tmp
		// if(isset($_POST['file'])){echo "<br>ada<br>";}else{echo "<br>Tidak ada<br>";}

		$tipe_file = $_FILES['file']['type']; // Ambil tipe file yang akan diupload
		$tmp_file = $_FILES['file']['tmp_name'];



		if ($tipe_file == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") {

	?>
 		<div class="content">
 			<i>Jangan Ditutup halaman ini sampai proses upload data selesai</i>
 			<div class="progress progress-striped active">
 				<div id="progress"></div>
 			</div>
 			<span>
 				<div id="info"></div>
 			</span>
 		</div>

 		<?php
			move_uploaded_file($tmp_file, 'tmp/' . $nama_file_baru);

			// Load librari PHPExcel nya
			require_once 'PHPExcel/PHPExcel.php';

			$excelreader = new PHPExcel_Reader_Excel2007();
			$loadexcel = $excelreader->load('tmp/' . $nama_file_baru); // Load file yang tadi diupload ke folder tmp
			$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true, true);

			$totalbaris = 0;
			foreach ($sheet as $row) {
				if (empty($row['A']) || $row['A'] == "NO ASSET") continue;
				$no_aset = $row['A'];
				$totalbaris++;
			}
			// echo "<pre>".$totalbaris."</pre>";
			$numrow = 1;
			foreach ($sheet as $row) { // Lakukan perulangan dari data yang ada di excel
				$barisreal = $numrow;
				$percent = intval($barisreal / $totalbaris * 100) . "%";
				// echo "<pre>".$percent."</pre>";
				if (empty($row['A']) || $row['A'] == "NO ASSET") continue;
				// echo '<pre>';
				// print_r($row);
				// echo '</pre>';
				$no_aset = $row['A'];
				$tahun = $row['B'];
				$kd_kategori = $row['C'];
				$model = $row['D'];
				$sn = $row['E'];
				$ip = $row['F'];
				$os = $row['G'];
				$proc = $row['H'];
				$ramhd = $row['I'];
				$vga = $row['J'];
				$kd_uker = $row['K'];
				$nm_uker = $row['L'];
				$nik = $row['M'];
				$nm_kar = $row['N'];
				$tgl_keluar = $row['O'];
				if (!empty($row['O'])) {
					$tgl_keluar = date('Y-m-d', strtotime($row['O']));
				} else {
					$tgl_keluar = '';
				}
				if (!empty($row['P'])) {
					$tgl_po = date('Y-m-d', strtotime($row['O']));
				} else {
					$tgl_po = '';
				}
				$po = $row['Q'];
				$harga = $row['R'];
				$id_sup = $row['S'];
				$sewa = $row['T'];
				$catatan = array_key_exists('U', $row) ? $row['U'] : "";
				$status = array_key_exists('V', $row) ? $row['V'] : "";
				if (!empty($kd_uker) or !empty($nik)) {
					$lokasi = "DI USER";
				} else {
					$lokasi = "DI TI";
				}

				if ($numrow > 0) {
					$query = "INSERT INTO data_aset VALUES ('', '$no_aset', '$tahun', '$kd_kategori', '$model', '$sn', '$ip', '$os', '$proc'
										  , '$ramhd', '$vga', '$kd_uker','$nm_uker', '$nik','$nm_kar', '$lokasi', '$id_sup', '$sewa', '$po'
										  , '$tgl_po', '$harga', '$tgl_po', '', '', '', '', '', '', '$tgl_keluar', '', '$catatan', '$id_user ', '$status')";
					//echo $query;
					if (mysqli_query($conn, $query)) { ?>
 					<script language="javascript">
 						document.getElementById("progress").innerHTML = '<div  class="bar  blue" style="width:<?php echo $percent; ?>"><span><?php echo $percent; ?></span></div>';
 						document.getElementById("info").innerHTML = '<?php echo $barisreal; ?> data berhasil diinsert (<?php echo $percent; ?> selesai)';
 					</script>
 					<?php
						  
					} else {
						echo "<pre>".mysqli_error($conn)."</pre>";
					}
					flush();
					$_SESSION['msg'] = "<div class=\"alert alert-success\"><strong>Success! </strong> $barisreal data berhasil diimport ke database.
											<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\" title=\"close\">×</a></div>";
				} else {
					$_SESSION['msg'] = "<div class=\"alert alert-danger\"><strong>Danger!</strong>Import data gagal.
											<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\" title=\"close\">×</a></div>";
				}

				$numrow++;
			}




			// '<script>window.location="exp-imp"</script>'; 

		} else { // Jika file yang diupload bukan File Excel 2007 (.xlsx)
			// Munculkan pesan validasi
			echo "<div class='alert alert-danger'>
					Hanya File Excel 2007 (.xlsx) yang diperbolehkan
					<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\" title=\"close\">×</a></div>";
		}
	}
	?>