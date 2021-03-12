<style type='text/css'>
input.untukInput2 {
  border-bottom: 3px solid #ccc;
  border-left: none;
  border-right: none;
  border-top: none;
  outline: none;
  width:300px;
 }
input.niksap {
  width:80px;
 }
input.aset {
  width:100px;
 }
</style>
<?php
include('config.php');

if (isset($_GET['aset'])){
$sql= "SELECT *, aset_model.nama_model
					FROM tb_aset
					INNER JOIN (aset_model INNER JOIN data_kategori ON aset_model.id_kategori=data_kategori.id_kategori)
					ON tb_aset.id_model=aset_model.id_model

WHERE no_aset='$_GET[aset]'"; 
$hasil = $dbconnect->query($sql);
$data = $hasil->fetch_array();
$data['no_aset'];
$data['nama_model'];


if (isset($_POST['simpan'])){
	$aset=$data['no_aset']; 
//Memasukkan data
$sql 	= "UPDATE tb_aset SET id_status='11', nik_sap='0' WHERE no_aset='$aset'";
$query	= mysql_query($sql);
echo "<script> location.href='?mod=hardware'; </script>";
}
?>
<div class="row">
<div class="col-md-3">
</div>
	<div class="col-md-8 general-grids widget-shadow">
		<h4>No Aset : <?php  echo $data['no_aset'];?></h4>
		<hr>
		<form class="form-horizontal" method="POST" action="">
		<table class="table">
			<tr>
				<td>Model</td><td>:</td>
				<td><?php  echo $data['nama_model'];?></td>
			</tr>
			<tr>
				<td colspan="3"> Dikembalikan ke Departemen Teknologi Informasi</td>
			</tr> 
		</table> 
		<div class="form-group">
						<div class="col-sm-offset-8 col-sm-6">
						<button type="submit" class="btn btn-success" name="simpan">Simpan</button>
						<a href="?mod=hardware" class="btn btn-primary">Kembali</a>
						</div>
						<div class="clearfix"> </div>
					</div>
		</form>
	</div>
</div>
<?php

}

if (isset($_GET['komponen'])){
$sql= "SELECT *	FROM tb_komponen WHERE id_komponen='$_GET[komponen]'"; 
$hasil = $dbconnect->query($sql);
$data = $hasil->fetch_array();
$data['id_komponen'];
$data['nama_komponen'];


if (isset($_POST['simpankomponen'])){
	$iddistribusi=distribusi_id();
	$idkomponen=$data['id_komponen'];
	$nama=$data['nama_komponen'];
	$qty=$_POST['qty'];
	$tgl=date("Y-m-d h:i:sa");
	$aset=$_POST['aset'];
	$sql = "INSERT INTO tb_distribusi (id_distribusi, id_komponen, id_aksesoris, qty, no_aset,tgl) 
									VALUES ('$iddistribusi','$idkomponen', '', '$qty', '$aset', '$tgl')";
$query	= mysql_query($sql);

//updet data komponen
$sql = "INSERT INTO tb_distribusi_history (id, id_distribusi, nama) 
									VALUES ('','$iddistribusi', '$nama')";
$query	= mysql_query($sql);
//updet data komponen
$sql= "SELECT  stok,sisa FROM tb_komponen WHERE id_komponen ='$idkomponen'"; 
	$hasil = $dbconnect->query($sql);
	$data = $hasil->fetch_array();
	
	$sisalama=$data['sisa'];
	
	$stokbaru=$sisalama-$qty;

$sql 	= "UPDATE tb_komponen SET sisa='$stokbaru' WHERE id_komponen='$idkomponen'";
$query	= mysql_query($sql);
echo "<script> location.href='?mod=komponen'; </script>";
}

echo'
<div class="row">
<div class="col-md-3">
</div>
	<div class="col-md-8 general-grids widget-shadow">
		<h4>'.$data['nama_komponen']. ' (Sisa '.$data['sisa']. ')</h4>
		<hr>
		<form class="form-horizontal" method="POST" action="">
		<table class="table">
			<tr>
				<td>Model</td><td>:</td>
				<td>'.$data['nama_komponen'].'</td>
			</tr>
			<tr>
				<td colspan="3"> Dibagikan Ke</td>
			</tr>
			<tr>
				<td>Pilih Aset</td><td>:</td>
				<td>
					<input class="aset" type="text" name="aset" id="aset"  onkeydown="isi_otomatis()" onchange="isi_otomatis()" onkeyup="isi_otomatis()" required>		
					<input class="untukInput2" type="text" placeholder="Model Aset" name="model" id="model"/>
				</td>
			</tr>
			<tr>
				<td>Qty</td><td>:</td>
				<td><input class="aset" type="text" name="qty" id="qty" required>		
					</td>
			</tr>
		</table> 
		<div class="form-group">
						<div class="col-sm-offset-8 col-sm-6">
						<button type="submit" class="btn btn-success" name="simpankomponen">Simpan</button>
						<a href="?mod=komponen" class="btn btn-primary">Kembali</a>
						</div>
						<div class="clearfix"> </div>
					</div>
		</form>
	</div>
</div>
';

}
?>

