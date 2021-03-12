<section class="content">
<!-- Content -->
    <div id="webui">
		<div class="row">
<?php 
 

if (isset($_POST['consumable-hapus']))
{
	$id=$_POST['id'];
	$sql 	= 'delete from consumable where id="'.$id.'"'; 
	$query	= mysqli_query($conn,$sql);
	echo '<script>window.location=" '.$_POST['back-link'].'"</script>'; 
}

if (isset($_POST['consumable-edit']))
{
 	include ("consumable/edit.php");
}

if (isset($_POST['editaset']))
{
 	include ("aset/edit.php");
 
}

if (isset($_POST['auditaset']))
{
 	include ("aset/audit.php");
 
}

if (isset($_POST['saveeditaset'])){ 
	 
	 $idaset=$_POST['idaset'];
	$no_aset=$_POST['no_aset'];
	 $model=$_POST['model'];
	 $kategori=$_POST['kategori']; 
	 $sn=$_POST['sn'];
	 $user=$_POST['user'];
	 $catatan=$_POST['catatan']; 
		$lokasi=$_POST['lokasi'];
	 $sql 	= "UPDATE data_aset SET no_aset='$no_aset', kd_kategori='$kategori',model='$model',   sn='$sn', 
		 kd_uker='$lokasi',nik='$user',update_at='$update_at',admin='$id_user',catatan='$catatan'
		 WHERE no='$idaset'";
 
  	
		switch($kategori){	
			case "CP" : $back="Dekstop"; break; 
			case "NB" : $back="Laptop"; break; 
			case "CM" : $back="Monitor"; break; 
			case "PJ" : $back="Proyektor";  break;  
			case "PR" : $back="Printer";  break; 
			case "PS" : $back="PrintScanner";  break; 
			case "SC" : $back="Scanner";  break; 
			case "cp" : $back="Dekstop"; break; 
			case "nb" : $back="Laptop"; break; 
			case "cm" : $back="Monitor"; break; 
			case "pj" : $back="Proyektor"; break; 
			case "pr" : $back="Printer"; break; 
			case "ps" :	$back="PrintScanner"; break; 
			case "sc" : $back="Scanner"; break; 
			case "" : $back="All";  break; 
		} 
		 
	 
		 $query	= mysqli_query($conn,$sql);
 echo '<script>window.location=" '.$back.'"</script>'; 
}

if (isset($_POST['saveauditaset'])){ 
	 
	 $kategori=$_POST['kategori']; 
	 $idaset=$_POST['id']; 
	 $karyawan=$_POST['karyawan'];
	 $uker=$_POST['uker'];
	 $next_audit_date=$_POST['next_audit_date'];
	 $catatan=$_POST['catatan'];
	 
	 $sql 	= "UPDATE data_aset SET nik='$karyawan', kd_uker='$uker'
	 ,audit_at='$audit_at',audit_next='$next_audit_date',audit_by='$id_user',catatan='$catatan'
		 WHERE no='$idaset'";
 
  	
		switch($kategori){	
			case "CP" : $back="Dekstop"; break; 
			case "NB" : $back="Laptop"; break; 
			case "CM" : $back="Monitor"; break; 
			case "PJ" : $back="Proyektor";  break;  
			case "PR" : $back="Printer";  break; 
			case "PS" : $back="PrintScanner";  break; 
			case "SC" : $back="Scanner";  break; 
			case "cp" : $back="Dekstop"; break; 
			case "nb" : $back="Laptop"; break; 
			case "cm" : $back="Monitor"; break; 
			case "pj" : $back="Proyektor"; break; 
			case "pr" : $back="Printer"; break; 
			case "ps" :	$back="PrintScanner"; break; 
			case "sc" : $back="Scanner"; break; 
			case "" : $back="All";  break; 
		} 
		 
	 
		 $query	= mysqli_query($conn,$sql);
 echo '<script>window.location=" '.$back.'"</script>'; 
}
 
if (isset($_POST['hapuscp'])){
	$id=$_POST['idd']; 
	 $kdkat = $_POST['kategori'];	
		switch($kdkat){	
			case "CP" : $back="Dekstop"; break; 
			case "NB" : $back="Laptop"; break; 
			case "CM" : $back="Monitor"; break; 
			case "PJ" : $back="Proyektor";  break;  
			case "PR" : $back="Printer";  break; 
			case "PS" : $back="PrintScanner";  break; 
			case "SC" : $back="Scanner";  break; 
			case "cp" : $back="Dekstop"; break; 
			case "nb" : $back="Laptop"; break; 
			case "cm" : $back="Monitor"; break; 
			case "pj" : $back="Proyektor"; break; 
			case "pr" : $back="Printer"; break; 
			case "ps" :	$back="PrintScanner"; break; 
			case "sc" : $back="Scanner"; break; 
			case "" : $back="All";  break; 
		} 
		 $sql 	= 'delete from data_aset where no="'.$id.'"'; 
	 
	 $query	= mysqli_query($conn,$sql);
 echo '<script>window.location=" '.$back.'"</script>'; 
}
?>






</div>
</div>
</section>