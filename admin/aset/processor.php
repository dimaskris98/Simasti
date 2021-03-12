   
<div class="panel-info widget-shadow"> 
 

<?php    
	$a = $_POST['proc']; 
	$params = explode('/',$a);
	$proc=$params[0];
	$ktgr=$params[1];
 

?>
<div class="table-responsive bs-example widget-shadow"> 
<div class="col-md-11"><h3>Kategori : <?php
$res = $conn->query("SELECT * FROM data_kategori where kd_kategori='$ktgr'");
	while($row = $res->fetch_assoc()){ 
		echo $row['nama_kategori'];
	}
?> - Processor : <?=$proc?></h3>
</div><hr/>
	<div class="col-md-11">
		<table id="general">
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
	<div class="col-md-1">  
		<form class="form-horizontal"  method="POST" action="print-asetproc.php" target="_blank">
			<input name="proc" id="proc" type="hidden" value="<?php echo $proc;?>"></input> 
			<input name="kategori" id="kategori" type="hidden" value="<?php echo $ktgr;?>"></input> 
			<button type="submit" name="print" id="print">
				<div ><i class="fa_p fa-print nav_print"></i></div> <div class="clearfix"></div>
			</button>
		</form>							
	</div>
</div> 
</div>