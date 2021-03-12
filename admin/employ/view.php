  <section class="content-header" style="padding-bottom: 30px;">
<h1 class="pull-left"><?php echo $mod;
if($mod=="organik"){$tombol="non-organik";}else{$tombol="organik";}
?></h1>
<div class="pull-right">

<form role="form" action="add" method="POST" enctype="multipart/form-data">
<a href="<?=$tombol?>" class="btn btn-default"><?=$tombol?> </a>
		<button type="submit" name="karyawan-add" class="btn btn-primary btn-md">Tambah Karyawan</button>
	</form> 
 </div>
 

        </section>
		<br>
 <div class="col-md-12 panel-grids">
	<div class="box-body table-responsive" >
		<table id="employtb" class="table table-bordered table-striped">
		<thead>
		<tr> 
		<th>Nik</th> 
		<th>Nik SAP</th>  
		<th>Nama Karyawan</th> 
		<th>Tempat Lahir</th>  
		<th>Tgl Lahir</th> 
		<th>L/P</th>
		<th>Kd Unitkerja</th> 
		<th>Departemen</th> 
		<th>Bagian</th> 
		<th>Aksi</th>
		</tr>
		</thead>
		<tbody> 
		</tbody>
		</table>
	</div>
</div>