 
<?php
$host="localhost";
	$user="root";
	$pass="";
	$db="dbsimasti";
	 

// menghubungkan ke db

$conn = new mysqli($host, $user, $pass, $db);

if (isset($_POST['export'])) { 
	if  ($_POST['jenis']!="")  { 
		if  ($_POST['kategori']!="" && $_POST['jenis']!="")  { 
			$where=" where data_aset.kd_kategori='".$_POST['kategori']."' AND data_aset.sewa='".$_POST['jenis']."'";
			$judul=$_POST['kategori'].'-'.$_POST['jenis'];
		}else{
			$where=" where data_aset.sewa='".$_POST['jenis']."'";
			$judul=$_POST['jenis'];
		}
	 
	}else if  ($_POST['kategori']!="")  { 
	 $where=" where data_aset.kd_kategori='".$_POST['kategori']."'";
	 $judul=$_POST['kategori'];
	} else{
		$where="";
		$judul="Simasti";
	}
	
 header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
	header("Content-Disposition: attachment; filename=$judul-export.xls");
?>
	<table border="1">
	<tr>
		<th>NO.</th><th>No Asset</th><th>Tahun</th><th>Kategori</th>
		<th>Model</th><th>SN</th><th>IP Address</th><th>OS</th><th>Proc</th>
		<th>Ram/HDD</th><th>VGA</th><th>Kode UKerja</th><th>Unit Kerja</th>
		<th>NIK</th><th>Nama Karyawan</th><th>Supplier</th>
		<th>status</th><th>Catatan</th>
	</tr>
	<?php
	$no=1;
	$res = $conn->query("SELECT status_labels.*,data_pemasok.*, data_kategori.*, data_aset.*,data_aset.nik as tnik,data_aset.kd_uker as tuker  FROM data_aset 
left join status_labels ON data_aset.status=status_labels.id 
left join data_pemasok ON data_aset.id_sup=data_pemasok.id_sup
left join data_kategori ON data_aset.kd_kategori=data_kategori.kd_kategori" . $where);
				 
		while($row = $res->fetch_assoc()){
		echo '
		<tr>
			<td>'.$no.'</td>
			<td>'.$row['no_aset'].'</td><td>'.$row['tahun'].'</td><td>'.$row['nama_kategori'].'</td><td>'.$row['model'].'</td>
			<td>'.$row['sn'].'</td><td>'.$row['ip_address'].'</td><td>'.$row['os'].'</td><td>'.$row['proc'].'</td>
			<td>'.$row['ramhd'].'</td><td>'.$row['vga'].'</td><td>'.$row['kd_uker'].'</td><td>'.$row['nama_unitkerja'].'</td>
			<td>'.$row['nik'].'</td><td>'.$row['nama_karyawan'].'</td><td>'.$row['nama_sup'].'</td><td>'.$row['name'].'</td> <td>'.$row['catatan'].'</td> 
		</tr>
				';
				$no++;
		}
	?>
</table>
<?php
}
?>
