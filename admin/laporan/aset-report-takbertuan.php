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
    
	width:100%;
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
<div class="panel-info widget-shadow">
<form class="form-horizontal"  method="POST" action="">
<div class="form-group"> 
	<label class="col-sm-9 control-label">
		<h4>Kategori :</h4>
	</label>
	
	<div class="col-sm-2">
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
  
<div class="box-body table-responsive" >


<?php 
if (isset($_POST['submit'])) { 
	$ktgr = $_POST['ktgr'];  
 

?>
<table >
							<thead bgcolor="silver">
								<tr width="100%"> 
									<td align="center" rowspan="2">No</td>
									<td align="center" rowspan="2">No Asset</td>
									<td align="center" rowspan="2">Kategori</td>
									<td align="center" rowspan="2">Model</td>
									<td align="center" colspan="2">PIC</td>									
									<td align="center" rowspan="2">Sewa</td>									
									<td align="center" colspan="3">Lokasi</td> 
								</tr>
								<tr> 
									<td align="center">NIK</td><td align="center">Nama</td> 
									<td align="center">Departemen</td><td align="center">Bagian</td> <td align="center">lokasi</td> 
								</tr>
							</thead>
	<tbody> 
<?php
	$no = 1;
	$res1 = $conn->query("SELECT *, data_uker.*, data_karyawan.*  FROM data_aset 
											LEFT JOIN data_uker ON data_aset.kd_uker=data_uker.kd_uker 
											LEFT JOIN data_uker_bagian ON data_aset.kd_uker=data_uker_bagian.kd_bag
											LEFT JOIN data_karyawan ON data_aset.nik=data_karyawan.nik 
											LEFT JOIN data_kategori ON data_aset.kd_kategori=data_kategori.kd_kategori 
											where data_aset.kd_kategori='$ktgr' and data_aset.nik='' and data_aset.lokasi='di user' 
											ORDER BY tahun ASC");
	while($row1 = $res1->fetch_assoc()){ 
		if ($row1['sewa']=="1"){$sewa="Y";}else{$sewa="T";}
?>
	<tr>
		<td align="center" scope="row"><?=$no?></td> 
		<td align="center"><a><?=$row1['no_aset']?></a></td>
		<td align="center"><?=$row1['nama_kategori']?></td>
		<td align="center"><?=$row1['model']?></td>
		<td align="center"><?=$row1['nik']?></td>
		<td align="center"><?=$row1['nama_karyawan']?></td>
		<td align="center"><?=$sewa?></td>
		<td align="center"><?=$row1['nama_uker']?></td>
		<td align="center"><?=$row1['nama_bag']?></td>
		<td align="center"><?=$row1['lokasi']?></td>
	</tr>
	 
<?php
	$no++;}
?>
	</tbody>
</table>
<?php
}
?>
 
</div> 
</div>
 