<?php 
include ("../konekdb.php");

if (isset($_SESSION['nikuser'])) {
    
 
$nikuser=$_SESSION['nikuser'];
$showuser =mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM users 
										Left join data_karyawan ON users.nikuser=data_karyawan.nik  
										Left join tb_teknisi ON users.id_user=tb_teknisi.id_user 
										WHERE nikuser='$nikuser'"));
$sewa=$showuser['sewa'];										
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
	
									
	if ($_SESSION['user_login']=="teknisi"){
		include ("template/t-head.php");
		include ("template/t-topbar.php");
		 
		if (isset($_GET['mod'])) {

			$mod = $_GET['mod']; 
			if (($_SESSION['user_login']=="teknisi")&&($sewa=="1")or($sewa=="0")){
				switch($mod){
					
					//PERBAIKAN
					case "servis-edit":		$view="perbaikan/edit.php" ; 		break;
					case "servis-add":		$view="perbaikan/add.php" ; 		break;
					case "servis":			$view="perbaikan/view.php" ; 		break;
					case "input-tindakan" :	$view="perbaikan/tindakan.php" ; 	break;
					//KARYAWAN
					case "organik" : 	$view="karyawan/view.php"; break;
					case "non-organik" : $view = "karyawan/view.php"; break;
					 
					case "dashboard" : 	$view = "dashboard.php"; break; 

				}
			}
			if (($_SESSION['user_login']=="teknisi")&&($sewa=="1")){

				switch($mod){

					//Aset
					case "All" : 						$view = "view.php"; break;
					case "Monitor" : 					$view = "view.php"; break;
					case "Dekstop" : 					$view = "view.php"; break;
					case "Sewa" : 						$view = "view.php"; break;
					case "registrasi-aset" : 			$view = "aset/asset-registrasi.php"; 	break; 
					case "aset-detail" : 				$view = "aset/aset-detail.php"; 		break;
					case "edit" : $view = "aset/edit.php"; break;

					 					
				}
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
	}else{     header('location:../'.$_SESSION['user_login']);}
		
} else { 
    header('location: ../login.php?error='.base64_encode('Silahkan LogIn terlebih dahulu!!!'));
    exit();
}
 
 ?> 