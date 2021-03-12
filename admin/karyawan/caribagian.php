<?php
  // Kredensial database
	$host="localhost";
	$user="root";
	$pass="";
	$db="dbsimasti";
	 

// menghubungkan ke db

$conn = new mysqli($host, $user, $pass, $db);
   /*********************************************************/
   
  $option = '<option value=""> - Pilih Bagian - </option>';
   
   $jk = isset($_GET['jk']) ?  $_GET['jk'] :'';
   $sql = "SELECT * FROM data_uker_bagian where kd_uker='".$jk."'";
   if($res = $conn->query($sql)) {
      while ($row = $res->fetch_assoc()) {
	     $option .= "<option value='".$row['kd_bag']."'>".$row['nama_bag']."</option>";
      }
   }
   echo $option;
    
?>