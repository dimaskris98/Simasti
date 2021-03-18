<section class="content">
<!-- Content -->
    <div id="webui">
		<div class="row">
<?php 
if (isset($_POST['consumable-add']))
{
 include ("consumable/add.php");
}

if (isset($_POST['simpanconsumable'])){
	$nama=$_POST['nama'];
	$kategori=$_POST['kategori'];
	$manufaktur=$_POST['manufaktur'];
	$model=$_POST['model'];
	$item=$_POST['item'];
	$minqty=$_POST['minqty'];
//Memasukkan data
$sql = "INSERT INTO consumable 
VALUES 
('', '$nama', '$kategori', '$manufaktur', '$model', '$item',0, '$minqty')";
$query	= mysqli_query($conn,$sql); 
 echo '<script>window.location="consumables"</script>';
} 


if (isset($_POST['registrasiaset']))
{
 include ("aset/aset-registrasi.php");
}



if (isset($_POST['status-add']))
{
 include ("status/add.php");
}
if (isset($_POST['simpanstatus']))
{
	$status =  $_POST["namastatus"] ;
	$type = $_POST["tipestatus"] ;
	$id_user=$_SESSION['sess_id']; 
	$catatan=$_POST['catatan']; 
	
	 
			$sql = "INSERT INTO status_labels  VALUES ('', '$status','$id_user', '$type','$catatan')";
	  $query	= mysqli_query($conn,$sql); 
		echo '<script>window.location="Labelstatus"</script>';
}

if (isset($_POST['checkinto']))
{
 include ("karyawan/checkin.php");
}
if (isset($_POST['savecheckout'])){
	
	  $no_aset=$_POST['no_aset']; 
	  $kd_uker=$_POST['uker']; 
	  $nik=$_POST['karyawan']; 
	  $catatan=$_POST['catatan']; 
	  $id_monitor=$_POST['monitor']; 
	  $tgl_keluar=$_POST['tgl_keluar'];
	
	  
	  $sql1 	= "UPDATE data_aset SET nik='$nik', kd_uker='$kd_uker', lokasi='DI USER',id_monitor='$id_monitor'
	 ,checkout_date='$tgl_keluar',catatan='$catatan' 
		 WHERE no='$no_aset'"; 
	 $query	= mysqli_query($conn,$sql1);
	 
	   
	if ($id_monitor!=""){
		$sql2 	= "UPDATE data_aset SET nik='$nik', kd_uker='$kd_uker', lokasi='DI USER'
					,checkout_date='$tgl_keluar',catatan='$catatan'
					WHERE no='$id_monitor'"; 
		 $query	= mysqli_query($conn,$sql2);
		 
		} 
	
	 
	
 
	
$_POST['karyawan-detail']=$nik;
			 include ("karyawan/detail.php"); 
	 
	
 
}
?>
</div>
</div>
</section>
