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
<div class="panel-info widget-shadow">
<form class="form-horizontal"  method="POST" action="">
<div class="form-group">
	 
	<label class="col-sm-7 control-label">
		<h4>Pilih Tahun :</h4>
	</label>
	
	<div class="col-sm-4"> 
		<input type="text" class="form-control" placeholder="Tahun" name="tahun1" id="tahun" autocomplete="off" required>
	 S/D
		<input type="text" class="form-control" placeholder="Tahun" name="tahun2" id="tahun1" autocomplete="off" required>
		</div> 					 
	<button type="submit" name="submit" class="btn btn-danger btn-md"><span >Tampilkan</span></button>
</div>
</form> 
 
<hr>

<?php 
if (isset($_POST['submit'])) {
	$tahun1=$_POST['tahun1'];
	$tahun2=$_POST['tahun2'];
	$sql="SELECT data_aset.*,data_aset.nik as tnik,data_aset.kd_uker as tuker, data_karyawan.*,data_uker.*,data_uker_bagian.* 
				, data_kategori.* FROM data_aset left join data_karyawan ON data_aset.nik=data_karyawan.nik 
				Left join data_uker ON data_aset.kd_uker=data_uker.kd_uker
				Left join data_uker_bagian ON data_aset.kd_uker=data_uker_bagian.kd_bag
				Left join data_kategori ON data_aset.kd_kategori=data_kategori.kd_kategori "; 
 
	$query=mysqli_query($conn, $sql." WHERE data_aset.tahun BETWEEN '$tahun1' AND '$tahun2' AND data_aset.sewa='1' order by data_aset.no_aset asc");
	
	$title='<center>Laporan Aset Tahun '.$tahun1.' s/d '.$tahun2.'</center>';
	 
	
?>  
<div class="box-body table-responsive">

		<?php 
		for ($i=$tahun1; $i<=$tahun2; $i++)
		{
			$jumlahAll = mysqli_num_rows(mysqli_query($conn, $sql." where data_aset.tahun='$i' AND data_aset.sewa='1'")); 
			$jumlahPc = mysqli_num_rows(mysqli_query($conn, $sql." where data_aset.tahun='$i' AND data_aset.kd_kategori='cp' AND data_aset.sewa='1'"));
			$jumlahMonitor = mysqli_num_rows(mysqli_query($conn,  $sql." where data_aset.tahun='$i' AND data_aset.kd_kategori='cm' AND data_aset.sewa='1'"));
			?>
	<div class="col-md-3 panel-grids">
		<table> 
			<form  method="POST" action="">
				<input type="hidden" name="sql" value="<?=$sql?>"></input>
				<input type="hidden" name="th" value="<?=$i?>"></input>
				<input type="hidden" name="th1" value="<?=$tahun1?>"></input>
				<input type="hidden" name="th2" value="<?=$tahun2?>"></input>
				<input type="hidden" name="cp1" value="<?=$jumlahPc?>"></input>
				<input type="hidden" name="cm1" value="<?=$jumlahMonitor?>"></input>
						 
				<tr>
					<th>Tahun</th><th>Aset</th><th>#</th><th>Kategori</th><th>Aset</th><th>#</th>
				</tr>
				<tr>
					<td valign="top" rowspan="7"><?=$i?></td><td valign="top" rowspan="7"> <?=$jumlahAll?></td><td valign="top" rowspan="7"><button type="submit" name="all" class="btn btn-primary btn-sm"><span >Detail</span></button> </td> 
				</tr>	  
				<tr> 
					<td>Dekstop</td><td> <?=$jumlahPc?></td><td><button type="submit" name="cp" class="btn btn-primary btn-sm"><span >Detail</span></button></td>
				</tr>
				<tr>
					<td>Monitor</td><td> <?=$jumlahMonitor?></td><td><button type="submit" name="cm" class="btn btn-primary btn-sm"><span >Detail</span></button></td>
				</tr>
				
			</form>
		</table><br>
	</div>				
		<?php 
		} 
		?>
</div>
<?php 		
	echo '<h2>'.$title.'</h2>';
	echo $message='<p style="text-align:right;">Tahun : '.$tahun1.' s/d '.$tahun2.'</p>';
	echo '<br>';
?>
<div class="box-body table-responsive" >
	<table id="" class="table tabledisplay table-bordered table-striped">
		<thead>
			<tr>
				<th>#</th><th>Nomor Aset</th><th>Tahun</th><th>Kategori</th><th>Model</th><th>Unit Kerja</th> <th>Catatan</th>  
			</tr>
		</thead>
		<tbody> 
			<?php
			$no=1;
				while( $row=mysqli_fetch_array($query) ) {
			?>
			<tr>
				<td><?=$no?></td>
				<td><?=$row['no_aset']?></td>
				<td><?=$row['tahun']?></td>
				<td><?=$row['nama_kategori']?></td>
				<td><?=$row['model']?></td>
				<td><?=$row["nama_uker"]?></td>
				<td><?=$row['catatan']?></td>
			</tr>
			<?php
			$no++;
				}
			?>
		</tbody>
		<tfoot>
			<tr>
				<th>#</th><th>Nomor Aset</th><th>Tahun</th><th>Kategori</th><th>Model</th><th>Unit Kerja</th> <th>Catatan</th>  
			</tr>
		</tfoot>
	</table>
</div>
<?php
 } 
 

if (isset($_POST['all']) ||isset($_POST['cp']) || isset($_POST['cm']))
{
	$sql=$_POST['sql'];
	$th=$_POST['th'];
	$tahun1=$_POST['th1'];
	$tahun2=$_POST['th2']; 
	$jumlahPc=$_POST['cp1'];
	$jumlahMonitor=$_POST['cm1'];
	if (isset($_POST['cp'])){$where=" where data_aset.tahun='$th' AND data_aset.kd_kategori='cp' AND data_aset.sewa='1' order by data_aset.no_aset asc"; $txtkd="Dekstop"; $title='<center>Laporan Aset Tahun '.$th.' Kategori '.$txtkd.'</center>';}
	else if (isset($_POST['cm'])){$where=" where data_aset.tahun='$th' AND data_aset.kd_kategori='cm' AND data_aset.sewa='1' order by data_aset.no_aset asc"; $txtkd="Monitor"; $title='<center>Laporan Aset Tahun '.$th.' Kategori '.$txtkd.'</center>';}
	else {$where=" where data_aset.tahun='$th' AND data_aset.sewa='1'"; 
	$title='<center>Laporan Aset Tahun '.$th.'</center>';}
	
	$query=mysqli_query($conn, $sql.$where);
	
	
	
	//echo $message='<p style="text-align:right;">audit tanggal : '.$tgl.'</p>';
?>
<div class="box-body table-responsive">

		<?php 
		for ($i=$tahun1; $i<=$tahun2; $i++)
		{
			$jumlahAll = mysqli_num_rows(mysqli_query($conn, $sql." where data_aset.tahun='$i'  AND data_aset.sewa='1'")); 
			$jumlahPc = mysqli_num_rows(mysqli_query($conn, $sql." where data_aset.tahun='$i' AND data_aset.kd_kategori='cp' AND data_aset.sewa='1'"));
			$jumlahMonitor = mysqli_num_rows(mysqli_query($conn,  $sql." where data_aset.tahun='$i' AND data_aset.kd_kategori='cm' AND data_aset.sewa='1'"));
		?>
	<div class="col-md-3 panel-grids">
		<table> 
			<form  method="POST" action="">
				<input type="hidden" name="sql" value="<?=$sql?>"></input>
				<input type="hidden" name="th" value="<?=$i?>"></input>
				<input type="hidden" name="th1" value="<?=$tahun1?>"></input>
				<input type="hidden" name="th2" value="<?=$tahun2?>"></input>
				<input type="hidden" name="cp1" value="<?=$jumlahPc?>"></input>
				<input type="hidden" name="cm1" value="<?=$jumlahMonitor?>"></input> 
						 
				<tr>
					<th>Tahun</th><th>Aset</th><th>#</th><th>Kategori</th><th>Aset</th><th>#</th>
				</tr>
				<tr>
					<td valign="top" rowspan="7"><?=$i?></td><td valign="top" rowspan="7"> <?=$jumlahAll?></td><td valign="top" rowspan="7"><button type="submit" name="all" class="btn btn-primary btn-sm"><span >Detail</span></button> </td> 
				</tr>	  
				<tr> 
					<td>Dekstop</td><td> <?=$jumlahPc?></td><td><button type="submit" name="cp" class="btn btn-primary btn-sm"><span >Detail</span></button></td>
				</tr>
				<tr>
					<td>Monitor</td><td> <?=$jumlahMonitor?></td><td><button type="submit" name="cm" class="btn btn-primary btn-sm"><span >Detail</span></button></td>
				</tr>	
			</form>
		</table><br>
	</div>				
		<?php 
		} 
		?>
</div>
<?php 		
	echo '<h2>'.$title.'</h2>';
	echo $message='<p style="text-align:right;">Tahun : '.$th.'</p>';
	echo '<br>';
?>
<div class="box-body table-responsive" >
	<table id="" class="table tabledisplay table-bordered table-striped">
		<thead>
			<tr>
				<th>#</th><th>Nomor Aset</th><th>Tahun</th><th>Kategori</th><th>Model</th><th>Unit Kerja</th> <th>Catatan</th>  
			</tr>
		</thead>
		<tbody> 
			<?php
			$no=1;
				while( $row=mysqli_fetch_array($query) ) {
			?>
			<tr>
				<td><?=$no?></td>
				<td><?=$row['no_aset']?></td>
				<td><?=$row['tahun']?></td>
				<td><?=$row['nama_kategori']?></td>
				<td><?=$row['model']?></td>
				<td><?=$row["nama_uker"].$row["nama_bag"]?></td>
				<td><?=$row['catatan']?></td>
			</tr>
			<?php
			$no++;
				}
			?>
		</tbody>
		<tfoot>
			<tr>
				<th>#</th><th>Nomor Aset</th><th>Tahun</th><th>Kategori</th><th>Model</th><th>Unit Kerja</th> <th>Catatan</th>  
			</tr>
		</tfoot>
	</table>
</div>
<?php
} 
?>
</div> 