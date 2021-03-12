 

<?php

include ("../konekdb.php");

$proc = $_POST['proc']; 
$ktgr = $_POST['kategori'];  
$showkat =mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM data_kategori where kd_kategori='$ktgr'")); 
		
	 
				
?>
<html >
<head>

<title>Rekap Asset Katgeori <?php echo $showkat['nama_kategori'];?> - Processor <?php echo $proc;?></title>
<link rel="shortcut icon" href="images/favicon3.ico">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Novus Admin Panel Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
   
 
<style>
table, td, th {    
    border: 1px solid black; 
	font-size: 11px;
    
}
table.a {    
    border: 0px;
    
}
tr.b{    
    border: 0px;
    
}

table { 
    border-collapse: collapse;
    width: auto;
} 
th, td {
    padding: 4px;
	word-wrap:break-word;
}
td.c {
    padding: 0px;
}
th {
    text-align: center;
}
p.tebal {
    font-weight: bold;
}

 .kolom1 {
             
                width: auto;
                 padding: 5px;
                float:left;
    } 

</style>
 
</head>

<body onload="javascript:window.print(); close();"> 
	<div class="table-responsive bs-example widget-shadow"> 
<div class="col-md-11"><h3>Kategori : <?=$showkat['nama_kategori']; ?> - Processor : <?=$proc?></h3>
</div><hr/>
	<div class="col-md-11">
		<table>
			<thead bgcolor="silver">
			 
			<tr align="center" >  
				<td  ><b>No</b></td><td ><b>Unit Kerja</b></td> <td><b>No Asset</b></td> <td><b>Model</b></td> <td><b>Tahun</b></td> <td><b>Proccessor</b></td><td><b>Nik</b></td><td><b>Nama Karyawan</b></td> 
			</tr>
			</thead>
			<tbody>
				
			<?php 
			$no=1;
			$asetDep = $conn->query("SELECT * FROM data_aset where kd_kategori='$ktgr' AND proc LIKE '%$proc%' ORDER BY kd_uker Asc");
			while($rowDep = $asetDep->fetch_assoc()){?>
				<tr  > 
					<td><?=$no;?></td><td><?=$rowDep['kd_uker'].' - '.$rowDep['nama_unitkerja']?></td>
					<td><?=$rowDep['no_aset'];?></td><td><?=$rowDep['model'];?></td><td><?=$rowDep['tahun'];?></td><td><?=$rowDep['proc'];?></td>
					<td><?=$rowDep['nik'];?></td><td><?=$rowDep['nama_karyawan'];?></td> 
				</tr>
			<?php 
			$no++;
			}
			?>
			</tbody>
		</table>
	</div> 
</div>
</body>
 


 </html>
 