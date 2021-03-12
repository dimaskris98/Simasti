 

		
<?php

if (isset($mod)){
		switch($mod){
			case "All" :
			include ("aset/view.php");
			break;
			case "Monitor" :
			include ("aset/view.php");
			break;
			case "Dekstop" :
			include ("aset/view.php");
			break;
			case "Laptop" :
			include ("aset/view.php");
			break;
			case "Printer" :
			include ("aset/view.php");
			break;
			case "Printer-Scanner" :
			include ("aset/view.php");
			break;
			case "Scanner" :
			include ("aset/view.php");
			break;
			case "Proyektor" :
			include ("aset/view.php");
			break;
			case "Camera" :
			include ("aset/view.php");
			break;
			case "Sewa" :
			include ("aset/view.php");
			break;
			case "registrasi" :
			include ("aset/asset-registrasi.php");
			break;
			case "CheckIn" :
			include ("aset/chekin.php");
			break;
			case "CheckOut" : 
			include ("aset/chekout.php");
			break;
			case "hardware" :
			include ("aset/hardware.php");
			break;
			case "Scrab" :
			include ("aset/view.php");
			break;
			case "processor" :
			include ("aset/view.php");
			break;
			 
			
		
	}
}

?>