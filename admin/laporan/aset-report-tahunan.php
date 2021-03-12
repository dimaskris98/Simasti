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
		<input type="text" class="form-control" placeholder="Tahun" name="tahun1" id="tahun" required>
	 S/D
		<input type="text" class="form-control" placeholder="Tahun" name="tahun2" id="tahun1" required>
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
				FROM data_aset left join data_karyawan ON data_aset.nik=data_karyawan.nik 
				Left join data_uker ON data_aset.kd_uker=data_uker.kd_uker
				Left join data_uker_bagian ON data_aset.kd_uker=data_uker_bagian.kd_bag "; 
 
	$query=mysqli_query($conn, $sql." WHERE data_aset.tahun BETWEEN '$tahun1' AND '$tahun2' ");
	
	$title='<center>Laporan Aset Tahun '.$tahun1.' s/d '.$tahun2.'</center>';
	 
	
?>  
<div class="box-body table-responsive">

		<?php 
		for ($i=$tahun1; $i<=$tahun2; $i++)
		{
			$jumlahAll = mysqli_num_rows(mysqli_query($conn, $sql." where data_aset.tahun='$i' ")); 
			$jumlahPc = mysqli_num_rows(mysqli_query($conn, $sql." where data_aset.tahun='$i' AND data_aset.kd_kategori='cp'"));
			$jumlahMonitor = mysqli_num_rows(mysqli_query($conn,  $sql." where data_aset.tahun='$i' AND data_aset.kd_kategori='cm'"));
			$jumlahLaptop = mysqli_num_rows(mysqli_query($conn, $sql." where data_aset.tahun='$i' AND data_aset.kd_kategori='nb'"));
			$jumlahPrinter = mysqli_num_rows(mysqli_query($conn, $sql." where data_aset.tahun='$i' AND data_aset.kd_kategori='pr'"));
			$jumlahProyektor = mysqli_num_rows(mysqli_query($conn, $sql." where data_aset.tahun='$i' AND data_aset.kd_kategori='pj'"));
			$jumlahPrintScan = mysqli_num_rows(mysqli_query($conn, $sql." where data_aset.tahun='$i' AND data_aset.kd_kategori='ps'"));
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
				<input type="hidden" name="nb1" value="<?=$jumlahLaptop?>"></input>
				<input type="hidden" name="pr1" value="<?=$jumlahPrinter?>"></input>
				<input type="hidden" name="ps1" value="<?=$jumlahPrintScan?>"></input>
				<input type="hidden" name="pj1" value="<?=$jumlahProyektor?>"></input> 
						 
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
				<tr>
					<td>Laptop</td><td> <?=$jumlahLaptop?></td><td><button type="submit" name="nb" class="btn btn-primary btn-sm"><span >Detail</span></button></td>
				</tr>
				<tr>
					<td>Printer</td><td> <?=$jumlahPrinter?></td><td><button type="submit" name="pr" class="btn btn-primary btn-sm"><span >Detail</span></button></td>
				</tr>
				<tr>
					<td>Proyektor</td><td><?=$jumlahProyektor?></td><td><button type="submit" name="pj" class="btn btn-primary btn-sm"><span >Detail</span></button></td>
				</tr>
				<tr>
					<td>Printer-Scanner</td><td> <?=$jumlahPrintScan?></td><td><button type="submit" name="ps" class="btn btn-primary btn-sm"><span >Detail</span></button></td>
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
				<th>#</th><th>Nomor Aset</th><th>Tahun</th><th>Model</th><th>Unit Kerja</th> <th>Catatan</th>  
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
				<th>#</th><th>Nomor Aset</th><th>Tahun</th><th>Model</th><th>Unit Kerja</th> <th>Catatan</th>  
			</tr>
		</tfoot>
	</table>
</div>
<?php
 } 
 

if (isset($_POST['all']) ||isset($_POST['cp']) || isset($_POST['cm']) || isset($_POST['nb']) || isset($_POST['pr']) || isset($_POST['ps']) || isset($_POST['pj']))
{
	$sql=$_POST['sql'];
	$i=$_POST['th'];
	$tahun1=$_POST['th1'];
	$tahun2=$_POST['th2']; 
	$jumlahPc=$_POST['cp1'];
	$jumlahMonitor=$_POST['cm1'];
	$jumlahLaptop=$_POST['nb1'];
	$jumlahPrinter=$_POST['pr1'];
	$jumlahPrintScan=$_POST['ps1'];
	$jumlahProyektor=$_POST['pj1']; 
	if (isset($_POST['cp'])){$where=" where data_aset.tahun='$i' AND data_aset.kd_kategori='cp'"; $txtkd="Dekstop"; $title='<center>Laporan Aset Tahun '.$i.' Kategori '.$txtkd.'</center>';}
	else if (isset($_POST['cm'])){$where=" where data_aset.tahun='$i' AND data_aset.kd_kategori='cm'"; $txtkd="Monitor"; $title='<center>Laporan Aset Tahun '.$i.' Kategori '.$txtkd.'</center>';}
	else if (isset($_POST['nb'])){$where=" where data_aset.tahun='$i' AND data_aset.kd_kategori='nb'"; $txtkd="Laptop"; $title='<center>Laporan Aset Tahun '.$i.' Kategori '.$txtkd.'</center>';}
	else if (isset($_POST['pr'])){$where=" where data_aset.tahun='$i' AND data_aset.kd_kategori='pr'"; $txtkd="Printer"; $title='<center>Laporan Aset Tahun '.$i.' Kategori '.$txtkd.'</center>';}
	else if (isset($_POST['ps'])){$where=" where data_aset.tahun='$i' AND data_aset.kd_kategori='ps'"; $txtkd="Printer-Scanner"; $title='<center>Laporan Aset Tahun '.$i.' Kategori '.$txtkd.'</center>';}
	else if (isset($_POST['pj'])){$where=" where data_aset.tahun='$i' AND data_aset.kd_kategori='pj'"; $txtkd="Proyektor"; $title='<center>Laporan Aset Tahun '.$i.' Kategori '.$txtkd.'</center>';}
	else {$where=" where data_aset.tahun='$i'"; 
	$title='<center>Laporan Aset Tahun '.$i.'</center>';}
	
	$query=mysqli_query($conn, $sql.$where);
	
	
	
	//echo $message='<p style="text-align:right;">audit tanggal : '.$tgl.'</p>';
?>
<div class="box-body table-responsive">

		<?php 
		for ($i=$tahun1; $i<=$tahun2; $i++)
		{
			$jumlahAll = mysqli_num_rows(mysqli_query($conn, $sql." where data_aset.tahun='$i' ")); 
			$jumlahPc = mysqli_num_rows(mysqli_query($conn, $sql." where data_aset.tahun='$i' AND data_aset.kd_kategori='cp'"));
			$jumlahMonitor = mysqli_num_rows(mysqli_query($conn,  $sql." where data_aset.tahun='$i' AND data_aset.kd_kategori='cm'"));
			$jumlahLaptop = mysqli_num_rows(mysqli_query($conn, $sql." where data_aset.tahun='$i' AND data_aset.kd_kategori='nb'"));
			$jumlahPrinter = mysqli_num_rows(mysqli_query($conn, $sql." where data_aset.tahun='$i' AND data_aset.kd_kategori='pr'"));
			$jumlahProyektor = mysqli_num_rows(mysqli_query($conn, $sql." where data_aset.tahun='$i' AND data_aset.kd_kategori='pj'"));
			$jumlahPrintScan = mysqli_num_rows(mysqli_query($conn, $sql." where data_aset.tahun='$i' AND data_aset.kd_kategori='ps'"));
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
				<input type="hidden" name="nb1" value="<?=$jumlahLaptop?>"></input>
				<input type="hidden" name="pr1" value="<?=$jumlahPrinter?>"></input>
				<input type="hidden" name="ps1" value="<?=$jumlahPrintScan?>"></input>
				<input type="hidden" name="pj1" value="<?=$jumlahProyektor?>"></input> 
						 
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
				<tr>
					<td>Laptop</td><td> <?=$jumlahLaptop?></td><td><button type="submit" name="nb" class="btn btn-primary btn-sm"><span >Detail</span></button></td>
				</tr>
				<tr>
					<td>Printer</td><td> <?=$jumlahPrinter?></td><td><button type="submit" name="pr" class="btn btn-primary btn-sm"><span >Detail</span></button></td>
				</tr>
				<tr>
					<td>Proyektor</td><td><?=$jumlahProyektor?></td><td><button type="submit" name="pj" class="btn btn-primary btn-sm"><span >Detail</span></button></td>
				</tr>
				<tr>
					<td>Printer-Scanner</td><td> <?=$jumlahPrintScan?></td><td><button type="submit" name="ps" class="btn btn-primary btn-sm"><span >Detail</span></button></td>
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
	echo $message='<p style="text-align:right;">Tahun : '.$i.'</p>';
	echo '<br>';
?>
<div class="box-body table-responsive" >
	<table id="" class="table tabledisplay table-bordered table-striped">
		<thead>
			<tr>
				<th>#</th><th>Nomor Aset</th><th>Tahun</th><th>Model</th><th>Unit Kerja</th> <th>Catatan</th>  
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
				<th>#</th><th>Nomor Aset</th><th>Tahun</th><th>Model</th><th>Unit Kerja</th> <th>Catatan</th>  
			</tr>
		</tfoot>
	</table>
</div>
<?php
} 
?>
</div> 