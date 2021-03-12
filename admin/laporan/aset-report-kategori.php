 <style>
table, td, th {    
    border: 1px solid black;
    font-size: 12px;
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
<?php 
//$res = $conn->query("SELECT *  FROM data_aset 
//Left join pic on data_aset.kd_uker=pic.kd_uker 
//WHERE data_aset.nama_karyawan LIKE '%addslashes%'  GROUP BY data_aset.nik");
	//	while($row = $res->fetch_assoc()){ 
		//echo "UPDATE data_aset SET nik='$row[nik]', nama_karyawan='addslashes($row[nama])' WHERE kd_uker='$row[kd_uker]' AND nik LIKE '000001';<br>";
		 
		//}

?>
<div class="panel-info widget-shadow">
<form class="form-horizontal"  method="POST" action="">
<div class="form-group">
	 
	<label class="col-sm-2 control-label">
		<h4>Pilih Departemen :</h4>
	</label>
	
	<div class="col-sm-3">
		<select name="dep" id="dep" class="form-control selectpicker" data-live-search="true" place-holder="Pilih Nama Departemen">
		<option> </option>
		<?php
		 
		
			$res = $conn->query("SELECT * FROM data_karyawan group by kd_uker");
		while($row = $res->fetch_assoc()){
		echo '
			<option value="'.$row['kd_uker'].'">'.$row['nama_unitkerja'].'</option>
		';
		$no++;
		}
		?>
		</select>
		

	</div>
	  
	 
	
 

	 

	<label class="col-sm-2 control-label">
		<h4>Kategori :</h4>
	</label>
	
	<div class="col-sm-3">
		<select name="ktgr" id="ktgr" class="form-control selectpicker" data-live-search="true" required>
		<option></option>
		<?php
		 
		
		
		$res = $conn->query("SELECT * FROM data_kategori");
		while($row = $res->fetch_assoc()){
		echo '
			<option value="'.$row['kd_kategori'].'">'.$row['nama_kategori'].'</option>
		';
		$no++;
		}
		?>
		</select>
		

	</div>
	  
	 
	
 

	 
	<button type="submit" name="submit"" class="btn btn-danger btn-md"><span >Tampilkan</span></button>
</div>
</form> 
 

<?php 
if (isset($_POST['submit'])) { 
	$ktgr = $_POST['ktgr'];
 $d=$_POST['dep'];
	$dep = substr($d,0,3);  
$showdep =mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM data_karyawan where kd_uker='$d'"));
$showkat =mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM data_kategori where kd_kategori='$ktgr'"));   
	$jmlh = $conn->query("SELECT count(*) as total  FROM data_aset where  kd_kategori='$ktgr' AND  kd_uker like '$dep%'");
					 $count = $jmlh->fetch_array();
 
?>
<div class="table-responsive bs-example widget-shadow"> 
<div class="col-md-11"><h3><?= $showdep['nama_unitkerja']; ?>, Kategori : <?= $showkat['nama_kategori']. '. Total = '.$count['total'] .' Unit';?></h3>
</div><hr/>
	<div class="col-md-11">
		<table>
			<thead bgcolor="silver">
			<tr  align="center" > 
				<td  rowspan="2" ><b>No</b></td><td  rowspan="2" ><b>Unit Kerja</b></td>   <td colspan="6"><b>Tersedia</b></td> 
			</tr>
			<tr align="center" >  
				<td><b>No Asset</b></td> <td><b>Model</b></td> <td><b>Tahun</b></td> <td><b>Proccessor</b></td> <td><b>Nik</b></td> <td><b>Nama Karyawan</b></td> 
			</tr>
			</thead>
			<tbody>
				
			<?php 
			$no=1;
				  
			$resuker = $conn->query("SELECT * FROM data_karyawan where kd_uker like'$dep%' group by kd_uker");  
				while($rowuker = $resuker->fetch_assoc()){
					 $kduker=$rowuker['kd_uker'];
					
					$countDep = $conn->query("SELECT count(*) as jumlah  FROM data_aset where kd_kategori='$ktgr' AND kd_uker='$kduker'");
					 $count = $countDep->fetch_array(); 
					?>

				<tr>
					<td rowspan="<?=$count['jumlah']+1;?>" >&nbsp;<?php echo $no;?>.</td>
					<td rowspan="<?=$count['jumlah']+1;?>" >&nbsp; <b><?php echo $kduker . ' - ' .  $rowuker['nama_unitkerja'];?></b> Jumlah : <?= $count['jumlah']; ?> Unit </td> 
					<?php
						$asetDep = $conn->query("SELECT * FROM data_aset where kd_kategori='$ktgr' AND kd_uker='$kduker'");
						while($rowDep = $asetDep->fetch_assoc()){?>
							<tr  > 
							<td><?=$rowDep['no_aset'];?></td><td><?=$rowDep['model'];?></td><td><?=$rowDep['tahun'];?></td><td><?=$rowDep['proc'];?></td>
							<td><?=$rowDep['nik'];?></td><td><?=$rowDep['nama_karyawan'];?></td> 
							 
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
	<div class="col-md-1">  
		<form class="form-horizontal"  method="POST" action="print-aset-report-kategori.php" target="_blank">
			<input name="dep" id="dep" type="hidden" value="<?php echo $d;?>"></input> 
			<input name="kategori" id="kategori" type="hidden" value="<?php echo $ktgr;?>"></input> 
			<button type="submit" name="print" id="print">
				<div ><i class="fa_p fa-print nav_print"></i></div> <div class="clearfix"></div>
			</button>
									
	</div>
</div>
			<?php } ?>
			
</div>