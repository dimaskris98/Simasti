 

<?php

include ("../konekdb.php");
$d = $_POST['dep'];
$dep = substr($d,0,3);   
$ktgr = $_POST['kategori']; 
 echo "SELECT * FROM data_karyawan where kd_uker='$d'";
$showdep =mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM data_karyawan where kd_uker='$d'"));  
$showkat =mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM data_kategori where kd_kategori='$ktgr'")); 
		
	$jmlh = $conn->query("SELECT count(*) as total  FROM data_aset where  kd_kategori='$ktgr' AND  kd_uker like '$dep%'");
					 $count = $jmlh->fetch_array(); 
				
?>
<html >
<head>

<title>Rekap Asset Katgeori <?php echo $showkat['nama_kategori'];?></title>
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
<div class="col-md-11"><h3><?= $showdep['nama_unitkerja']; ?>, Kategori : <?=$showkat['nama_kategori']. '. Total = '.$count['total'] .' Unit'; ?></h3>
</div><hr/>
	<div class="col-md-11">
		<table>
			<thead bgcolor="silver">
			<tr  align="center" > 
				<td  rowspan="2" ><b>No</b></td><td  rowspan="2" ><b>Unit Kerja</b></td>   <td colspan="4"><b>Tersedia</b></td> 
			</tr>
			<tr align="center" >  
				<td><b>No Asset</b></td> <td><b>Model</b></td> <td><b>Tahun</b></td> <td><b>Proccessor</b></td> 
			</tr>
			</thead>
			<tbody>
				
			<?php 
			$no=1;
				  
			$resuker = $conn->query("SELECT * FROM data_karyawan where kd_uker like '$dep%' group by kd_uker");  
				while($rowuker = $resuker->fetch_assoc()){
					$kduker=$rowuker['kd_uker'];
					$countDep = $conn->query("SELECT count(*) as jumlah  FROM data_aset where kd_kategori='$ktgr' AND kd_uker='$kduker'");
					$count = $countDep->fetch_array();
					 
					?>

				<tr>
					<td rowspan="<?=$count['jumlah']+1;?>" >&nbsp;<?php echo $no;?>.</td>
					<td rowspan="<?=$count['jumlah']+1;?>" >&nbsp; <b><?php echo  $rowuker['nama_unitkerja'];?></b> Jumlah : <?= $count['jumlah']; ?> Unit </td> 
					<?php
						$asetDep = $conn->query("SELECT * FROM data_aset where kd_kategori='$ktgr' AND kd_uker='$kduker'");
						while($rowDep = $asetDep->fetch_assoc()){?>
							<tr  > 
							<td><?=$rowDep['no_aset'];?></td><td><?=$rowDep['model'];?></td><td><?=$rowDep['tahun'];?></td><td><?=$rowDep['proc'];?></td> 
							 
						</tr>
					<?php } ?>
					
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
 