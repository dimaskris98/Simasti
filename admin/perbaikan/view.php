 <?php
	if (isset($_POST['update'])) {
		echo '<script>window.location="servis-edit"</script>';
	}
	?>
 <section class="content-header">
 	<h1 class="pull-left"><?php echo $mod; ?></h1>
 	<div class="pull-right">
 		<form role="form" action="servis-add" method="POST" enctype="multipart/form-data">
 			<button type="submit" name="servis-add" class="btn btn-primary btn-md">Tambah Data</button>
 		</form>
 	</div>


 </section>
 <br>
 <section clas="content">
 	<div class="webui">
 		<div class="row">
 			<div class="col-md-12">
 				<div class="box box-default">
 					<div class="box-body table-responsive">
 						<table id="Perbaikantable" class=" table table-bordered table-hover table-striped">
 							<thead>
 								<tr>
 									<th>Id</th>
 									<th>Tanggal</th>
 									<th>No Aset</th>
 									<th>Pengirim</th>
 									<th>Unit Kerja</th>
 									<th>Tlp</th>
 									<th>Keluhan</th>
 									<th>Tiket</th>
 									<th>Status</th>
 									<th>Tindakan</th>
 									<th>Tanggal Selesai</th>
 									<th>Teknisi</th>
 								</tr>
 							</thead>
 							<tbody>
 							</tbody>
 						</table>
 					</div>
 				</div>

 			</div>
 		</div>
 	</div>
 </section>