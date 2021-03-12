<?php
include ("../konekdb.php");
$sql = mysqli_query($connect,"SELECT nama_model FROM aset_model_jaringan ORDER BY id DESC limit 1");
$result = array();
 
while($row = mysqli_fetch_array($sql)){
	array_push($result, array('nama_model' => $row[0]));
}
echo json_encode(array("result" => $result));
?>