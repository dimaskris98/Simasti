<section class="content">
	<!-- Content -->
	<div id="webui">
		<div class="row">
			<?php
			if (isset($_POST['consumable-hapus'])) {
				$id = $_POST['id'];
				$sql 	= 'delete from consumable where id="' . $id . '"';
				$query	= mysqli_query($conn, $sql);
				echo '<script>window.location=" ' . $_POST['back-link'] . '"</script>';
			}

			if (isset($_POST['consumable-edit'])) {
				include("consumable/edit.php");
			}

			if (isset($_POST['editaset'])) {
				include("aset/edit.php");
			}

			if (isset($_POST['auditaset'])) {
				include("aset/audit.php");
			}

			if (isset($_POST['saveeditaset'])) {
				$status = $_POST['status'];
				$showstatus = mysqli_fetch_array(mysqli_query($conn, "SELECT *  FROM status_labels  WHERE id= '$status'"));
				if ($showstatus['deployable'] == "1") {
					$user = $_POST['karyawan'];
				} else {
					$user = "";
				}
				$showkaryawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM  data_karyawan WHERE nik= '$user'"));
				$uker = $showkaryawan['kd_uker'];
				$nama_unitkerja = addslashes($showkaryawan['nama_unitkerja']);
				$karyawan = addslashes($showkaryawan['nama_karyawan']);

				if ($user == "") {
					if ($uker == "") {
						$lokasi = "DI TI";
					} else {
						$lokasi = "DI USER";
					}
				} else {
					$lokasi = "DI USER";
				}


				$idaset = $_POST['idaset'];
				$no_aset = $_POST['no_aset'];
				$model = $_POST['model'];
				$kategori = $_POST['kategori'];
				$sn = $_POST['sn'];
				$th = $_POST['tahun'];
				$catatan = $_POST['catatan'];

				$tglkeluar = $_POST['tglkeluar'];
				if (isset($_POST['sewa'])) {
					$sewa = $_POST['sewa'];
				} else {
					$sewa = 0;
				}

				if (($showstatus['name'] == "scrab") or ($showstatus['name'] == "SCRAB")) {
					$tgl_scrab = $created_at;
					$lokasi = "DI TI";
					$toscrab = mysqli_fetch_array(mysqli_query($conn, "SELECT  tahun,ip_address,os,proc,ramhd,vga
					,id_sup,sewa,po,tgl_po,harga,catatan from data_aset WHERE no='$idaset'"));
					$tahun = $toscrab['tahun'];
					$ip = $toscrab['ip_address'];
					$os = $toscrab['os'];
					$proc = $toscrab['proc'];
					$ramhd = $toscrab['ramhd'];
					$vga = $toscrab['vga'];
					$id_sup = $toscrab['id_sup'];
					$po = $toscrab['po'];
					$tgl_po = $toscrab['tgl_po'];
					$harga = $toscrab['harga'];
					$catatan = $toscrab['catatan'];
					$sql = "INSERT INTO data_aset_scrab values('','$no_aset','$tahun','$kategori','$model','$sn','$ip','$os','$proc','$ramhd','$vga',
			'$tgl_scrab','$id_user','$po','$tgl_po','$id_sup','$harga','$lokasi','$status',$catatan)";
					$delete = "DELETE FROM data_aset WHERE no='$idaset'";
					$query1	= mysqli_query($conn, $sql);
					$query2	= mysqli_query($conn, $delete);
				} else {

					if (isset($_POST["id_monitor"]) && strlen($_POST["id_monitor"]) > 0) {
						$id_monitor = $_POST['id_monitor'];
						$sql1 = "UPDATE data_aset SET kd_uker='$uker',nik='$user',
				update_at='$update_at',
				admin='$id_user' ,
				status='$status'
						,lokasi='$lokasi'
						WHERE no='$id_monitor'";
						$query3	= mysqli_query($conn, $sql1);

						$sql2 = "UPDATE data_aset SET no_aset='$no_aset', tahun='$th', kd_kategori='$kategori',model='$model',   sn='$sn',				
						 kd_uker='$uker',nik='$user',update_at='$update_at',admin='$id_user',catatan='$catatan',id_monitor='$id_monitor'
						 ,status='$status',lokasi='$lokasi',sewa='$sewa'
						 WHERE no='$idaset'";
						$query4	= mysqli_query($conn, $sql2);
					} else {
						$sql = "UPDATE data_aset SET no_aset='$no_aset',  tahun='$th', kd_kategori='$kategori',model='$model',   sn='$sn' ,
				 kd_uker='$uker',nik='$user',update_at='$update_at',admin='$id_user',catatan='$catatan',id_monitor='',checkout_date='$tglkeluar'
				 ,status='$status',lokasi='$lokasi',sewa='$sewa'
				 WHERE no='$idaset'";
						$query5	= mysqli_query($conn, $sql);
					}
				}
				//echo $sql1;

				if (!empty($_POST['karyawan-detail'])) {

					$_POST['karyawan-detail'];
					include("karyawan/detail.php");
				} else if($status == "3"){
					echo '<script>window.location="All"</script>';
				}else if (!empty($_POST['aset-detail'])) {
					echo '<script>window.location="aset-detail?no=' . $idaset . '"</script>';
				} else if ($sewa == "1") {
					echo '<script>window.location="Sewa"</script>';
				} else {
					echo '<script>window.location="All"</script>';
				}
			}

			if (isset($_POST['saveauditaset'])) {

				$kategori = $_POST['kategori'];
				$idaset = $_POST['id'];
				$karyawan = $_POST['karyawan'];
				$uker = $_POST['uker'];
				$next_audit_date = $_POST['next_audit_date'];
				$catatan = $_POST['catatan'];

				$sql 	= "UPDATE data_aset SET nik='$karyawan', kd_uker='$uker'
	 ,audit_at='$audit_at',audit_next='$next_audit_date',audit_by='$id_user',catatan='$catatan'
		 WHERE no='$idaset'";


				switch ($kategori) {
					case "CP":
						$back = "Dekstop";
						break;
					case "NB":
						$back = "Laptop";
						break;
					case "CM":
						$back = "Monitor";
						break;
					case "PJ":
						$back = "Proyektor";
						break;
					case "PR":
						$back = "Printer";
						break;
					case "PS":
						$back = "PrinterScanner";
						break;
					case "SC":
						$back = "Scanner";
						break;
					case "cp":
						$back = "Dekstop";
						break;
					case "nb":
						$back = "Laptop";
						break;
					case "cm":
						$back = "Monitor";
						break;
					case "pj":
						$back = "Proyektor";
						break;
					case "pr":
						$back = "Printer";
						break;
					case "ps":
						$back = "PrinterScanner";
						break;
					case "sc":
						$back = "Scanner";
						break;
					case "":
						$back = "All";
						break;
				}


				$query	= mysqli_query($conn, $sql);
				if (!empty($_POST['karyawan-detail'])) {
					$_POST['karyawan-detail'];
					include("karyawan/detail.php");
				} else if (!empty($_POST['aset-detail'])) {
					$_POST['aset-detail'];
					include("aset/aset-detail.php");
				} else {
					echo '<script>window.location=" ' . $back . '"</script>';
				}
			}

			if (isset($_POST['hapuscp'])) {
				$id = $_POST['idd'];
				$kdkat = $_POST['kategori'];
				switch ($kdkat) {
					case "CP":
						$back = "Dekstop";
						break;
					case "NB":
						$back = "Laptop";
						break;
					case "CM":
						$back = "Monitor";
						break;
					case "PJ":
						$back = "Proyektor";
						break;
					case "PR":
						$back = "Printer";
						break;
					case "PS":
						$back = "PrinterScanner";
						break;
					case "SC":
						$back = "Scanner";
						break;
					case "cp":
						$back = "Dekstop";
						break;
					case "nb":
						$back = "Laptop";
						break;
					case "cm":
						$back = "Monitor";
						break;
					case "pj":
						$back = "Proyektor";
						break;
					case "pr":
						$back = "Printer";
						break;
					case "ps":
						$back = "PrinterScanner";
						break;
					case "sc":
						$back = "Scanner";
						break;
					case "":
						$back = "All";
						break;
				}
				$sql 	= 'delete from data_aset where no="' . $id . '"';

				$query	= mysqli_query($conn, $sql);
				echo '<script>window.location=" ' . $back . '"</script>';
			}





			if (isset($_POST['status-edit'])) {
				include("status/edit.php");
			}
			if (isset($_POST['status-hapus'])) {

				$id = $_POST['id'];
				$sql 	= 'delete from status_labels where id="' . $id . '"';

				$query	= mysqli_query($conn, $sql);
				echo '<script>window.location="Labelstatus"</script>';
			}

			if (isset($_POST['updatestatus'])) {
				$id =  $_POST["id"];
				$status =  $_POST["namastatus"];
				$type = $_POST["tipestatus"];
				$id_user = $_SESSION['sess_id'];
				$catatan = $_POST['catatan'];


				$sql = "UPDATE status_labels SET name='$status', user_id='$id_user', deployable='$type', notes='$catatan' WHERE id='$id'";
				$query	= mysqli_query($conn, $sql);
				echo '<script>window.location="Labelstatus"</script>';
			}



			if (isset($_POST['editasetscrab'])) {
				include("aset-scrab/edit.php");
			}

			if (isset($_POST['saveeditasetscrab'])) {

				$back = $_POST['link'];
				$tahun = $_POST['tahun'];
				$no_aset = $_POST['no_aset'];
				$model = $_POST['model'];
				$sn = $_POST['sn'];
				$kategori = $_POST['kategori'];
				$idaset = $_POST['idaset'];
				$catatan = $_POST['catatan'];

				$sql 	= "UPDATE data_aset_scrab SET no_aset='$no_aset', model='$model'
	 ,sn='$sn',kd_kategori='$kategori',catatan='$catatan',tahun='$tahun'
		 WHERE idscrab='$idaset'";
				$query	= mysqli_query($conn, $sql);
				if (!empty($_POST['aset-scrab-detail'])) {
					$_POST['aset-scrab-detail'];
					include("aset-scrab/detail.php");
				} else {
					echo '<script>window.location=" ' . $back . '"</script>';
				}
			}
			if (isset($_POST['hapusscrab'])) {
				$id = $_POST['idd'];
				$back = $_POST['kategori'];
				$sql 	= 'delete from data_aset_scrab where idscrab="' . $id . '"';
				$query	= mysqli_query($conn, $sql);
				echo '<script>window.location=" ' . $back . '"</script>';
			}
			?>
		</div>
	</div>
</section>