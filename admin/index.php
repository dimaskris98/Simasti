<?php 
include ("../konekdb.php");

if (isset($_SESSION['nikuser'])) {
    
 
$nikuser=$_SESSION['nikuser'];
$showuser =mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM users 
										Left join data_karyawan ON users.nikuser=data_karyawan.nik 
										WHERE nikuser='$nikuser'"));
										
$id_user =  $_SESSION['sess_id'];  
$checkout_date=date("Y-m-d"); 
$checkin_date=date("Y-m-d");  
$created_at=date("Y-m-d"); 
$update_at=date("Y-m-d"); 
$audit_at=date("Y-m-d"); 
} else {
    header('location:../login.php');
    exit();
}


if ( isset($_SESSION['user_login']) && $_SESSION['user_login'] != '' ) {
	
									
	if ($_SESSION['user_login']=="admin"){
		include ("template/t-head.php");
		include ("template/t-topbar.php");
		 
		if (isset($_GET['mod'])) {

			$mod = $_GET['mod']; 
			switch($mod){
				case "pekerja" : $view="employ/view.php" ; break;
				
				//PERBAIKAN
				case "servis-edit" : $view="perbaikan/edit.php" ; break;
				case "servis-add" :$view="perbaikan/add.php" ; break;
				case "servis" :$view="perbaikan/view.php" ; break;
				case "input-tindakan" :$view="perbaikan/tindakan.php" ; break;
				
				case "hardware" : $view="view.php" ;  break;
				
				//KARYAWAN
				case "organik" : 	$view="karyawan/view.php"; break;
				case "non-organik" : $view = "karyawan/view.php"; break; 
				case "karyawan-add" : $view = "karyawan/add.php"; break;
				case "karyawan-edit" : $view = "karyawan/edit.php"; break; 
				case "update-karyawan" : $view = "karyawan/update.php"; break;  
				case "update-manual" : $view = "karyawan/update-karyawan.php"; break; 
				 
				case "CheckIn" : $view = "view.php"; break;
				case "CheckOut" : $view = "view.php"; break;
				case "Profile" : $view = "users/Profile.php"; 	break;
				
				//TEKNISI
				case "teknisi-komputer" : $view = "teknisi/view-teknisi.php"; break;
				
				//USER
				case "user" : $view = "users/user.php"; break; 
				
				//Export & Import 			
				case "exp-imp" : $view = "export-import/export-import.php"; break; 
				
				case "Supplier" : $view = "pemasok/view.php"; break; 
				case "Sup-add" : $view = "pemasok/add.php"; 	break;	 
				case "Sup-edit" : $view = "pemasok/edit.php"; break;
				
				case "importact" : $view = "upload/import-proses.php"; break; 
				case "edit" : $view = "edit.php"; break; 			
				case "add" : $view = "add.php"; break; 
				case "detail" : $view = "detail.php"; break;
				case "consumables" : $view="consumable/consumable.php" ;  break;
				
				case "lokasi" : $view = "unit-kerja/lokasi.php"; break; 
				case "lokasi-add" : $view = "unit-kerja/lokasi-add.php"; break; 
				case "rincian" : $view = "view-detail.php"; break;  
				 
				
				//KOMPONEN
				case "komponen" : $view = "componen/komponen.php"; break;
				case "komponen-creat" : $view = "componen/add.php"; break;
				case "komponen-edit" : $view = "componen/edit.php"; break;
				case "komponen-detail" : $view = "componen/detail.php"; break;
				
				//LICENSI
				case "licensi" : $view = "licensi.php"; break;
				case "liccreat" : $view = "licensitambah.php"; break;
				case "licedit" : $view = "licensiedit.php"; break;
				case "lic" : $view = "licensi-detil.php"; break;
				
				case "kebutuhan" : $view = "kebutuhan.php"; break; 
				
			 
				//Laporan ASET
				case "laporan-aset" : 				$view = "laporan/aset-report.php"; 				break; 
				case "laporan-aset-update" : 	$view = "laporan/aset-report-update.php"; 			break;
				case "laporan-aset-per-kategori" : 	$view = "laporan/aset-report-kategori.php"; 	break;
				case "laporan-audit" : 				$view = "laporan/aset-report-audit.php"; 		break; 
				case "laporan-aset-per-tahun" : 	$view = "laporan/aset-report-tahunan.php"; 		break;
				case "laporan-aset-takbertuan" : 	$view = "laporan/aset-report-takbertuan.php"; 	break; 
				case "laporan-aset-sewa" : 			$view = "laporan/aset-sewa.php"; 				break;
				case "laporan-aset-kolom" : 			$view = "laporan/aset-report-proc.php"; 	break;

				//Laporan Consumable
				case "conlap-bulanan" :				$view = "consumable/report-bulanan.php"; 		break;
			 
				//Aset
				case "All" : 						$view = "view.php"; break;
				case "Monitor" : 					$view = "view.php"; break;
				case "Dekstop" : 					$view = "view.php"; break;
				case "Laptop" : 					$view = "view.php"; break;
				case "Printer" : 					$view = "view.php"; break;
				case "Printer-Scanner" : 			$view = "view.php"; break;
				case "Scanner" : 					$view = "view.php"; break;
				case "Proyektor" : 					$view = "view.php"; break; 
				case "Sewa" : 						$view = "view.php"; break;
				case "registrasi-aset" : 			$view = "aset/asset-registrasi.php"; 	break;  
				case "Pengalihan-Aset-Sewa" : 		$view = "aset/pengalihan-aset.php"; 	break;
				case "Proses-Pengalihan-Aset" : 	$view = "aset/pengalihan-proses.php"; 	break; 	
				case "Scrab" : 						$view = "aset-scrab/view.php"; 			break; 	
				case "aset-detail" : 				$view = "aset/aset-detail.php"; 		break;
				case "processor" : 					$view = "aset/view.php"; 		break;
				case "Camera" : 					$view = "aset/view.php"; 		break;
				
				//Consumable
				case "con-pembagian" : 				$view = "consumable/pembagian.php"; break;
				case "con-order" : 				$view = "consumable/order.php"; break;
				
				case "dashboard" : $view = "dashboard.php"; break; 
				case "rincian" : $view = "asetdetail.php"; break; 
				case "chekout" : $view = "chekout.php"; break;
				case "chekin" : $view = "chekin.php"; break;  
				case "kategori" : $view = "kategori.php"; break;
				case "editkategori" : $view = "kategoriedit.php"; break;
				//Print
				case "print-aset" : $view = "laporan/print.php"; break;
				case "print-kategori-aset" : $view = "laporan/print-aset-report-kategori.php"; break;
				case "print-proc" : $view = "laporan/print-aset-report-kategori.php"; break;
				 
				
			}
		}
										
												
								 
				
			if(empty($mod)){
				$view = "template/t-isi.php";
			}else{
				$res = $conn->query("SELECT * FROM data_kategori");
				while($row = $res->fetch_assoc()){
					if($mod=="Scrab-".$row['nama_kategori']){
						$view = "aset-scrab/view.php";
					}
				} 
			}
		include $view;
		include ("template/t-footer.php");
		include ("skrip-ajax.php");
		include ("skrip-pop-modal.php");
	}else{
		header('location:../'.$_SESSION['user_login']);
	}
		
} else { 
    header('location: ../login.php?error='.base64_encode('Silahkan LogIn terlebih dahulu!!!'));
    exit();
}
 
 ?> 