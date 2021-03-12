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
		<h4>Pilih Processor:</h4>
	</label>
	
	<div class="col-sm-3">
		<select name="proc" id="proc" class="form-control selectpicker" data-live-search="true">
	 <?php 
		$res = $conn->query("SELECT proc FROM data_aset GROUP BY proc");
		while($row = $res->fetch_assoc()){
		echo '
			<option value="'.$row['proc'].'">'.$row['proc'].'</option> ';
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
	$proc = $_POST['proc']; 
 

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
			<?php } ?>
			
</div>