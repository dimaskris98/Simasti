<style type='text/css'>
p.ex1 {
    
    padding-left: 10px;
}
p.ex2 {
    
    padding-left: 30px;
}
</style>
<section class="content">
<!-- Content -->
    <div id="webui">
		<div class="row">
<?php 
if (isset($_POST['aset-detail']))
{
 	include ("aset/aset-detail.php");
}
 
if (isset($_POST['consumable-detail']))
{
 	include ("consumable/detail.php");
}
if (isset($_POST['karyawan-detail']))
{
 	include ("karyawan/detail.php");
}
if (isset($_POST['hapuskaryawan'])){ 

 $nik= $_POST['nik'];
 $sql 	= 'delete from data_karyawan where nik="'.$nik.'"'; 
	 
	 $query	= mysqli_query($conn,$sql);
	  echo '<script>window.location="organik"</script>';
}	


if (isset($_POST['status-detail']))
{
 	include ("status/detail.php");
}

if (isset($_POST['aset-scrab-detail']))
{
 	include ("aset-scrab/detail.php");
}
?>
</div>
</div>
</section>