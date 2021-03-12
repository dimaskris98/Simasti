
<?php

include ("../konekdb.php");
 
 @header("Content-Disposition: attachment; filename=data_aset_to_excel.csv");
 
 

 $select = mysqli_query($conn,"SELECT * FROM data_aset");
 while($row=mysqli_fetch_array($select))
 {
  $data.=$row['no_aset'].",";
  $data.=$row['tahun'].",";
  $data.=$row['kd_kategori']."\n";
 }

 echo $data;
 exit();
 
?>
 