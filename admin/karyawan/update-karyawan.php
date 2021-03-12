<?php
	$no=0;
	$query=mysqli_query($conn, "SELECT * FROM karyawan_update") ;
	echo $jmlh=mysqli_num_rows($query). " Karyawan telah terupdate <br>" ;
?> 
<a href="organik" class="btn btn-primary btn-md">Kembali</a>
<hr> 
<?php
	 
	while( $row=mysqli_fetch_array($query) ) { 
	$no++;
		 $nama=Addslashes($row['nama_karyawan']);
		$bag=Addslashes($row['nama_unitkerja']);
		$dep=Addslashes($row['dep']);
		 $sql = "INSERT INTO  data_karyawan VALUES('$row[nik]', '$nama', '$row[kd_uker]', '$bag', '$dep', '$row[email]', '$row[tlp]', '$row[img]','$row[organik]') 
			ON DUPLICATE KEY UPDATE nama_karyawan='$nama',email='$row[email]', tlp='$row[tlp]', img='$row[img]', 
						 kd_uker='$row[kd_uker]',nama_unitkerja='$bag' ,dep='$dep',organik='$row[organik]'";
	  $query1	= mysqli_query($conn,$sql); 
	  echo "<br>" .$no.". Update "   .$row['nik']. " - " .$nama. " Sukses";
	}

 ?>