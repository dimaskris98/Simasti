<?php 
$namastatus= $_GET['status'];
$showstatus =mysqli_fetch_array(mysqli_query($conn,"SELECT  id FROM status_labels
									WHERE name= '$namastatus'"));
 $idstatus=$showstatus['id'];
?>
 <br>
 <div class="col-md-12 panel-grids">
<div class="box-body table-responsive" >
<table id="" class="tabledisplay table table-bordered table-striped">
<thead>
<tr>
	<th>Nomor Aset</th>
	<th>Tahun</th> 
	<th>Kategori</th>  
	<th>Model</th>  
	<th>Karyawan</th> 
	<th>Unit Kerja</th> 
	<th>Aksi</th>
</tr>
</thead>
<tbody>
				 
		</tbody>
</table>
 </div></div>