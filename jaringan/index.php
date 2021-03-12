<?php 
include ("../konekdb.php");
$id_user =  $_SESSION['sess_id'];  
$created_at=date("Y-m-d"); 
$update_at=date("Y-m-d"); 
$audit_at=date("Y-m-d");

if ( isset($_SESSION['user_login']) && $_SESSION['user_login'] != '' ) {
	
									
	if ($_SESSION['user_login']=="jaringan"){
		include ("template/t-head.php");
		include ("template/t-topbar.php");
		 
		if (isset($_GET['mod'])) {

	 $mod = $_GET['mod'];
	 		
			switch($mod){
				case "Models" :				 
					$view="model/models.php" ; 
					break;
				case "Models-add" :				 
					$view="model/add.php" ; 
					break;
				case "Models-edit" :				 
					$view="model/edit.php" ; 
					break;
				case "Aset" : 
					$view="asets/asets.php" ; 
					break;
				case "Aset-add" : 
					$view="asets/add.php" ;
					break;
				case "Aset-edit" : 
					$view="asets/edit.php" ;
					break; 
				
		}
		}
		
				
		if(empty($mod)){
		$view = "template/t-isi.php";
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