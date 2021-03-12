 <?php 
 if(isset($_POST['update']))
			 { echo '<script>window.location="servis-edit"</script>';}
 ?>
<section class="content-header" style="padding-bottom: 30px;">
<h1 class="pull-left"><?php echo $mod;?></h1>
<div class="pull-right">
<form role="form" action="servis-add" method="POST" enctype="multipart/form-data">
		<button type="submit" name="servis-add" class="btn btn-primary btn-md">Tambah Data</button>
	</form> 
 </div>
 

        </section>
		<br>
		 <div class="col-md-12 panel-grids">
<div class="box-body table-responsive" >
 
<table id="Perbaikantable" class=" table table-bordered table-hover table-striped">
<thead>
<tr>
	<th>Id</th>
	<th>Tanggal</th> 
	<th>No Aset</th>
	<th>Pengirim</th> 
	<th>Tlp</th>  
	<th>Keluhan</th> 
	<th>Status</th>  
	<th>Tindakan</th> 
	<th>Tanggal Selesai</th> 
</tr>
</thead>
<tbody>   
</tbody>
</table>
</div>
</div>
 
