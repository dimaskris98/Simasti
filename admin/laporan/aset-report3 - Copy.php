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
		<h4>Data audit tanggal :</h4>
	</label>
	
	<div class="col-sm-4"> 
		<input name="tgl1" type="date">
	 S/D
		<input name="tgl2" type="date">
		</div> 					 
	<button type="submit" name="submit" class="btn btn-danger btn-md"><span >Tampilkan</span></button>
</div>
</form> 
 
<hr>

<?php 
if (isset($_POST['submit'])) {
	$tgl1=$_POST['tgl1'];
	$tgl2=$_POST['tgl2'];
	$sql ="SELECT data_aset.*,data_aset.nik as tnik,data_aset.kd_uker as tuker, data_karyawan.*,data_uker.*,data_uker_bagian.* 
				FROM data_aset left join data_karyawan ON data_aset.nik=data_karyawan.nik 
				Left join data_uker ON data_aset.kd_uker=data_uker.kd_uker
				Left join data_uker_bagian ON data_aset.kd_uker=data_uker_bagian.kd_bag
				WHERE data_aset.update_at BETWEEN '$tgl1' AND '$tgl2' ";
 

	$query1=mysqli_query($conn, $sql);
	$jumlahPc = mysqli_num_rows(mysqli_query($conn, $sql."AND kd_kategori='cp'"));
	$jumlahMonitor = mysqli_num_rows(mysqli_query($conn, $sql."AND kd_kategori='cm'"));
	$jumlahLaptop = mysqli_num_rows(mysqli_query($conn, $sql."AND kd_kategori='nb'"));
	$jumlahPrinter = mysqli_num_rows(mysqli_query($conn, $sql."AND kd_kategori='pr'"));
	$jumlahProyektor = mysqli_num_rows(mysqli_query($conn, $sql."AND kd_kategori='pj'"));
	$jumlahPrintScan = mysqli_num_rows(mysqli_query($conn, $sql."AND kd_kategori='ps'"));
	
?> 
		<table id="" class="table table-bordered table-striped">
			 
			<tbody> 
				 <form  method="POST" action="">
							<input type="hidden" name="sql" value="<?=$sql?>"></input>
							<input type="hidden" name="tgl" value="<?=$tgl1?> s/d <?=$tgl2?>"></input>
					<tr>
						<td>Dekstop <?=$jumlahPc?> Unit 
							<button type="submit" name="cp" class="btn btn-default btn-sm"><span >Detail</span></button> 
						</td>
						<td>Monitor <?=$jumlahMonitor?> Unit  
								<button type="submit" name="cm" class="btn btn-default btn-sm"><span >Detail</span></button> 
						</td>
						<td>Laptop <?=$jumlahLaptop?> Unit  
								<button type="submit" name="nb" class="btn btn-default btn-sm"><span >Detail</span></button> 
						</td>
						<td>Printer <?=$jumlahPrinter?> Unit  
								<button type="submit" name="pr" class="btn btn-default btn-sm"><span >Detail</span></button> 
						</td>
						<td>Proyektor <?=$jumlahProyektor?> Unit  
								<button type="submit" name="pj" class="btn btn-default btn-sm"><span >Detail</span></button> 
						</td>
						<td>Printer-Scanner <?=$jumlahPrintScan?> Unit  
								<button type="submit" name="ps" class="btn btn-default btn-sm"><span >Detail</span></button> 
						</td>
					</tr>
				 </form>
			</tbody> 
		</table>
 
	<div class="box-body table-responsive" >
		<table id="" class="table tabledisplay table-bordered table-striped">
			<thead>
				<tr>
					<th>#</th>
					<th>Tanggal</th>
					<th>Nomor Aset</th>
					<th>Tahun</th> 
					<th>Model</th>  
					<th>Unit Kerja</th> 
					<th>Catatan</th>  
				</tr>
			</thead>
			<tbody> 
				<?php
				$no=1;
					while( $row=mysqli_fetch_array($query1) ) {
				?>
					<tr>
						<td><?=$no?></td>
						<td><?=$row['update_at']?></td>
						<td><?=$row['no_aset']?></td>
						<td><?=$row['tahun']?></td>
						<td><?=$row['model']?></td>
						<td><?=$row["nama_uker"]. $row["nama_bag"]?></td>
						<td><?=$row['catatan']?></td>
					
					</tr>
				<?php
				$no++;
					}
				?>
			</tbody> 
		</table>
	</div>
<?php
 } 

 if (isset($_POST['cp'])) {
	$sql=$_POST['sql'];
	$tgl=$_POST['tgl']; 
	$query=mysqli_query($conn, $sql."AND kd_kategori='cp'");
	 $title='<center>Data Aset Kategori  Dekstop</center>';
	echo '<h2>'.$title.'</h2>';
	echo '<br>';
	echo $message='<p style="text-align:right;">audit tanggal : '.$tgl.'</p>';
?>

<div class="box-body table-responsive" >
		<table id="" class="table tabledisplay table-bordered table-striped">
			<thead>
				<tr>
					<th>#</th>
					<th>Tanggal</th>
					<th>Nomor Aset</th>
					<th>Tahun</th> 
					<th>Model</th>  
					<th>Unit Kerja</th> 
					<th>Catatan</th>  
				</tr>
			</thead>
			<tbody> 
				<?php
				$no=1;
					while( $row=mysqli_fetch_array($query) ) {
				?>
					<tr>
						<td><?=$no?></td>
						<td><?=$row['update_at']?></td>
						<td><?=$row['no_aset']?></td>
						<td><?=$row['tahun']?></td>
						<td><?=$row['model']?></td>
						<td><?=$row["nama_uker"]. $row["nama_bag"]?></td>
						<td><?=$row['catatan']?></td>
					
					</tr>
				<?php
				$no++;
					}
				?>
			</tbody>
			<tfoot>
				<tr> 
					<th>#</th>
					<th>Tanggal</th>
				<th>Nomor Aset</th>
				<th>Tahun</th> 
				<th>Model</th>  
				<th>Unit Kerja</th> 
				<th>Catatan</th> 
				</tr>
			</tfoot>
		</table>
	</div>
<?php
}
else if (isset($_POST['cm'])) {
	$sql=$_POST['sql'];
	$tgl=$_POST['tgl'];
	$query=mysqli_query($conn, $sql."AND kd_kategori='cm'");
	 $title='<center>Data Aset Kategori  Monitor</center>';
	echo '<h2>'.$title.'</h2>';
	echo '<br>';
	echo $message='<p style="text-align:right;">audit tanggal : '.$tgl.'</p>';
?>
<div class="box-body table-responsive" >
		<table id="" class="table tabledisplay table-bordered table-striped">
			<thead>
				<tr>
					<th>#</th>
					<th>Tanggal</th>
					<th>Nomor Aset</th>
					<th>Tahun</th> 
					<th>Model</th>  
					<th>Unit Kerja</th> 
					<th>Catatan</th>  
				</tr>
			</thead>
			<tbody> 
				<?php
				$no=1;
					while( $row=mysqli_fetch_array($query) ) {
				?>
					<tr>
						<td><?=$no?></td>
						<td><?=$row['update_at']?></td>
						<td><?=$row['no_aset']?></td>
						<td><?=$row['tahun']?></td>
						<td><?=$row['model']?></td>
						<td><?=$row["nama_uker"]. $row["nama_bag"]?></td>
						<td><?=$row['catatan']?></td>
					
					</tr>
				<?php
				$no++;
					}
				?>
			</tbody>
			<tfoot>
				<tr> 
					<th>#</th>
					<th>Tanggal</th>
				<th>Nomor Aset</th>
				<th>Tahun</th> 
				<th>Model</th>  
				<th>Unit Kerja</th> 
				<th>Catatan</th> 
				</tr>
			</tfoot>
		</table>
	</div>
<?php
}
else if (isset($_POST['nb'])) {
	$sql=$_POST['sql'];
	$tgl=$_POST['tgl'];
	$query=mysqli_query($conn, $sql."AND kd_kategori='nb'");
	 $title='<center>Data Aset Kategori  Laptop</center>';
	echo '<h2>'.$title.'</h2>';
	echo '<br>';
	echo $message='<p style="text-align:right;">audit tanggal : '.$tgl.'</p>';
?>
<div class="box-body table-responsive" >
		<table id="" class="table tabledisplay table-bordered table-striped">
			<thead>
				<tr>
					<th>#</th>
					<th>Tanggal</th>
					<th>Nomor Aset</th>
					<th>Tahun</th> 
					<th>Model</th>  
					<th>Unit Kerja</th> 
					<th>Catatan</th>  
				</tr>
			</thead>
			<tbody> 
				<?php
				$no=1;
					while( $row=mysqli_fetch_array($query) ) {
				?>
					<tr>
						<td><?=$no?></td>
						<td><?=$row['update_at']?></td>
						<td><?=$row['no_aset']?></td>
						<td><?=$row['tahun']?></td>
						<td><?=$row['model']?></td>
						<td><?=$row["nama_uker"]. $row["nama_bag"]?></td>
						<td><?=$row['catatan']?></td>
					
					</tr>
				<?php
				$no++;
					}
				?>
			</tbody>
			<tfoot>
				<tr> 
					<th>#</th>
					<th>Tanggal</th>
				<th>Nomor Aset</th>
				<th>Tahun</th> 
				<th>Model</th>  
				<th>Unit Kerja</th> 
				<th>Catatan</th> 
				</tr>
			</tfoot>
		</table>
	</div>
<?php
}
else if (isset($_POST['pr'])) {
	$sql=$_POST['sql'];
	$tgl=$_POST['tgl'];
	$query=mysqli_query($conn, $sql."AND kd_kategori='pr'");
	 $title='<center>Data Aset Kategori  Printer</center>';
	echo '<h2>'.$title.'</h2>';
	echo '<br>';
	echo $message='<p style="text-align:right;">audit tanggal : '.$tgl.'</p>';
?>
<div class="box-body table-responsive" >
		<table id="" class="table tabledisplay table-bordered table-striped">
			<thead>
				<tr>
					<th>#</th>
					<th>Tanggal</th>
					<th>Nomor Aset</th>
					<th>Tahun</th> 
					<th>Model</th>  
					<th>Unit Kerja</th> 
					<th>Catatan</th>  
				</tr>
			</thead>
			<tbody> 
				<?php
				$no=1;
					while( $row=mysqli_fetch_array($query) ) {
				?>
					<tr>
						<td><?=$no?></td>
						<td><?=$row['update_at']?></td>
						<td><?=$row['no_aset']?></td>
						<td><?=$row['tahun']?></td>
						<td><?=$row['model']?></td>
						<td><?=$row["nama_uker"]. $row["nama_bag"]?></td>
						<td><?=$row['catatan']?></td>
					
					</tr>
				<?php
				$no++;
					}
				?>
			</tbody>
			<tfoot>
				<tr> 
					<th>#</th>
					<th>Tanggal</th>
				<th>Nomor Aset</th>
				<th>Tahun</th> 
				<th>Model</th>  
				<th>Unit Kerja</th> 
				<th>Catatan</th> 
				</tr>
			</tfoot>
		</table>
	</div>
<?php
}
else if (isset($_POST['ps'])) {
	$sql=$_POST['sql'];
	$tgl=$_POST['tgl'];
	$query=mysqli_query($conn, $sql."AND kd_kategori='ps'");
	 $title='<center>Data Aset Kategori  Printer-Scanner</center>';
	echo '<h2>'.$title.'</h2>';
	echo '<br>';
	echo $message='<p style="text-align:right;">audit tanggal : '.$tgl.'</p>';
?>
<div class="box-body table-responsive" >
		<table id="" class="table tabledisplay table-bordered table-striped">
			<thead>
				<tr>
					<th>#</th>
					<th>Tanggal</th>
					<th>Nomor Aset</th>
					<th>Tahun</th> 
					<th>Model</th>  
					<th>Unit Kerja</th> 
					<th>Catatan</th>  
				</tr>
			</thead>
			<tbody> 
				<?php
				$no=1;
					while( $row=mysqli_fetch_array($query) ) {
				?>
					<tr>
						<td><?=$no?></td>
						<td><?=$row['update_at']?></td>
						<td><?=$row['no_aset']?></td>
						<td><?=$row['tahun']?></td>
						<td><?=$row['model']?></td>
						<td><?=$row["nama_uker"]. $row["nama_bag"]?></td>
						<td><?=$row['catatan']?></td>
					
					</tr>
				<?php
				$no++;
					}
				?>
			</tbody>
			<tfoot>
				<tr> 
					<th>#</th>
					<th>Tanggal</th>
				<th>Nomor Aset</th>
				<th>Tahun</th> 
				<th>Model</th>  
				<th>Unit Kerja</th> 
				<th>Catatan</th> 
				</tr>
			</tfoot>
		</table>
	</div>
<?php
}
else if (isset($_POST['pj'])) {
	$sql=$_POST['sql'];
	$tgl=$_POST['tgl'];
	$query=mysqli_query($conn, $sql."AND kd_kategori='pj'");
	 $title='<center>Data Aset Kategori  Proyektor</center>';
	echo '<h2>'.$title.'</h2>';
	echo '<br>';
	echo $message='<p style="text-align:right;">audit tanggal : '.$tgl.'</p>';
?>
<div class="box-body table-responsive" >
		<table id="" class="table tabledisplay table-bordered table-striped">
			<thead>
				<tr>
					<th>#</th>
					<th>Tanggal</th>
					<th>Nomor Aset</th>
					<th>Tahun</th> 
					<th>Model</th>  
					<th>Unit Kerja</th> 
					<th>Catatan</th>  
				</tr>
			</thead>
			<tbody> 
				<?php
				$no=1;
					while( $row=mysqli_fetch_array($query) ) {
				?>
					<tr>
						<td><?=$no?></td>
						<td><?=$row['update_at']?></td>
						<td><?=$row['no_aset']?></td>
						<td><?=$row['tahun']?></td>
						<td><?=$row['model']?></td>
						<td><?=$row["nama_uker"]. $row["nama_bag"]?></td>
						<td><?=$row['catatan']?></td>
					
					</tr>
				<?php
				$no++;
					}
				?>
			</tbody>
			<tfoot>
				<tr> 
					<th>#</th>
					<th>Tanggal</th>
				<th>Nomor Aset</th>
				<th>Tahun</th> 
				<th>Model</th>  
				<th>Unit Kerja</th> 
				<th>Catatan</th> 
				</tr>
			</tfoot>
		</table>
	</div>
<?php
}
?>
 </div> 