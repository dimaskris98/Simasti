
<div class="row">
	<div class="form-three widget-shadow">
	 
<form class="form-horizontal"  method="POST" action="">
		<label for="selector1" class="col-sm-1 control-label">Kategori</label>
		<div class="col-sm-2">
			<select name="kategori" id="kategori" class="form-control1" place_holder="asas">
			<option></option>
				<?php
		$res = $conn->query("SELECT * FROM data_kategori");
		while($row = $res->fetch_assoc()){
		echo '
			<option value="'.$row['kd_kategori'].'">'.$row['nama_kategori'].'</option>
			
		';
		}
		?>
			</select>
		</div>
	 
		<label for="selector1" class="col-sm-1 control-label">lokasi</label>
		<div class="col-sm-2">
			<select name="lokasi" id="lokasi" class="form-control1">
				<option></option>
		<?php
		$res1 = $conn->query("SELECT lokasi FROM data_aset GROUP BY lokasi");
		while($row1 = $res1->fetch_assoc()){
		echo '
			<option value="'.$row1['lokasi'].'">'.$row1['lokasi'].'</option>
		';
		}
		?>
			</select>
		</div>
		
 	<label for="selector1" class="col-sm-1 control-label">Tahun</label>
		<div class="col-sm-2">
			 <input class="form-control datepicker" type="text" name="tahun" id="tahun" required  />
		</div>
 
	
	 
	<button type="submit" name="tampil"" class="btn btn-danger btn-md"><span >Tampilkan</span></button>
	</form> 
</div>
</div>

<div class="row">
	<div class="form-three widget-shadow">

 <?php  

if (isset($_POST['hapus'])){
	$id=$_POST['idd'];
$sql 	= 'delete from data_aset where no="'.$id.'"';
$query	= mysql_query($sql);
}

if (isset($_POST['tampil'])) {
	 
	 $kategori=$_POST['kategori'];
	 $lokasi=$_POST['lokasi'];
	 $tahun=$_POST['tahun'];	
	
	

 //LEFT JOIN data_uker ON data_aset.kd_uker=data_uker.kd_uker
	
	if (!empty($kategori)){
		if((!empty($kategori)) AND (!empty($lokasi))) {
			if((!empty($kategori)) AND (!empty($lokasi)) AND (!empty($tahun))) {
				//echo "Asset Kategori ".$nama_kategori." tahun ".$tahun." yang ada ".$lokasi;	
				$res = $conn->query("SELECT * FROM data_aset 
				left join data_uker ON data_aset.kd_uker=data_uker.kd_uker
				left join data_uker_bagian ON data_aset.kd_uker=data_uker_bagian.kd_bag
				where kd_kategori='$kategori' AND lokasi='$lokasi' AND tahun='$tahun' ORDER BY no ASC");
			
			}else{
					$res = $conn->query("SELECT * FROM data_aset
				left join data_uker ON data_aset.kd_uker=data_uker.kd_uker
				left join data_uker_bagian ON data_aset.kd_uker=data_uker_bagian.kd_bag
				 
				 where kd_kategori='$kategori' AND lokasi='$lokasi' ORDER BY no ASC");
			}
		}else if((!empty($tahun)) AND (!empty($kategori))) {
			$res = $conn->query("SELECT * FROM data_aset 
				left join data_uker ON data_aset.kd_uker=data_uker.kd_uker
				left join data_uker_bagian ON data_aset.kd_uker=data_uker_bagian.kd_bag
				 where kd_kategori='$kategori' AND  tahun='$tahun' ORDER BY no ASC");
		}
			else{
			$res = $conn->query("SELECT * FROM data_aset 
				left join data_uker ON data_aset.kd_uker=data_uker.kd_uker
				left join data_uker_bagian ON data_aset.kd_uker=data_uker_bagian.kd_bag
				 where kd_kategori='$kategori' ORDER BY no ASC");
		}
	}else if (!empty($lokasi)){
		if((!empty($lokasi)) AND (!empty($tahun))) {
		$res = $conn->query("SELECT * FROM data_aset 
				left join data_uker ON data_aset.kd_uker=data_uker.kd_uker
				left join data_uker_bagian ON data_aset.kd_uker=data_uker_bagian.kd_bag
				 where lokasi='$lokasi' AND tahun='$tahun' ORDER BY no ASC");
		}else{
			$res = $conn->query("SELECT * FROM data_aset 
				left join data_uker ON data_aset.kd_uker=data_uker.kd_uker
				left join data_uker_bagian ON data_aset.kd_uker=data_uker_bagian.kd_bag
				 where lokasi='$lokasi' ORDER BY no ASC");
			}
	}else if (!empty($tahun)){
		$res = $conn->query("SELECT * FROM data_aset 
				left join data_uker ON data_aset.kd_uker=data_uker.kd_uker
				left join data_uker_bagian ON data_aset.kd_uker=data_uker_bagian.kd_bag
				 where tahun='$tahun' ORDER BY no ASC");
		 
	}
	
	

?>
<table id="" class="table tabledisplay table-bordered table-striped">
<thead>
<tr>
<th>Nomor Aset</th>
<th>Tahun</th> 
<th>Model</th>
<th>Processor</th>
<th>SN</th> 
<th>Unit Kerja</th>
<th>NIK</th>
<th>lokasi Asset</th>
<th>Sewa</th>
</tr>
</thead>
<tbody>

<?php	 
	 
	while($row = $res->fetch_assoc()){
	echo '
	<tr>
	 
	 
	<td><form action="detail" method="post">
								<a name="tes" href="javascript:" onclick="parentNode.submit();"> '.$row['no_aset'].'</a>
								<input type="hidden" name="aset-detail" value="'.$row['no'].'"/>
							
						</form>
						 </td>
	<td>'.$row['tahun'].'</td> 
	<td>'.$row['model'].'</td>
	<td>'.$row['proc'].'</td>
	<td>'.$row['sn'].'</td>
	<td>'.$row['nama_uker'].$row['nama_bag'].'</td> 
	<td>'.$row['nik'].'</td> 
	<td>'.$row['lokasi'].'</td>	';
	if ($row['sewa']>0){echo'<td>Asset PG</td>	';}else{echo'<td>Asset PG</td>	';}
	echo'
	</tr>
	 '; 
	}
}
?>
</tbody>
</table>
</div>
</div>