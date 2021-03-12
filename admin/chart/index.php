<?php
$conn = new mysqli("localhost", "root", "", "bootstrap");
			if ($conn->connect_errno) {
				echo "Failed to connect to MySQL: " . $conn->connect_error;
			}
?>			
<html>
<head>
<meta charset="utf-8">
<title></title>
<link rel="stylesheet" href="./../asset/global.css">
<link rel="stylesheet" href="./../asset/bootstrap.min.css">

</head>
<body> 
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="box box-primary">
                                <div class="box-header">
                                <h3 class="box-title"><center>Lihat Grafik Servis</center></h3> 
								<a href="./../view_selesai.php" class="btn btn-success">Kembali</a>						

								</div></div></div>
                             </div>


<form class="form-horizontal" method="POST" action="chart2.php">                                   
<b>Tahun :</b>
<select name="tahun">
<?php
$mulai= date('Y');
for($i = $mulai;$i>=2015;$i--){
    $sel = $i == date('Y') ? ' selected="selected"' : '';
    echo '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';
}
$tahun = $_POST['tahun'];
?>

</select>
<button type="submit" class="btn btn-success btn-xs">Tampilkan</button>
</form>

                              
</body>
</html>
