 <section class="content-header">
 	<?php

		if (isset($_POST['simpansup'])) {

			$nama = $_POST['nama_sup'];
			$alamat = $_POST['alamat_sup'];
			$tlp = $_POST['tlp_sup'];

			//Memasukkan data
			$sql = "INSERT INTO data_pemasok VALUES ('', '$nama', '$alamat', '$tlp')";
			$query	= mysqli_query($conn, $sql);
			echo '<script type="text/javascript">alert("' . $nama . '")</script>';
			echo '<script>window.location="Supplier"</script>';
		}

		?>

 	<div class="pull-right">

 		<button type="submit" name="karyawan-add" class="btn btn-primary btn-md" data-toggle="modal" data-target="#exampleModal1" data-whatever="@mdo">Tambah Pemasok</button>

 	</div>
 	<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
 		<div class="modal-dialog" role="document">
 			<div class="modal-content">
 				<div class="modal-header">
 					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
 					<h4 class="modal-title" id="exampleModalLabel">Creat Data Pemasok Baru</h4>
 				</div>
 				<form class="form-horizontal" method="POST" action="">
 					<div class="modal-body">

 						<div class="sign-u">
 							<label class="col-md-4 control-label">Nama Pemasok:</label>
 							<div class="col-sm-5">
 								<input type="text" class="form-control" name="nama_sup" id="nama_sup" required>
 							</div>
 							<div class="clearfix"> </div>
 						</div>
 						<div class="sign-u">
 							<label class="col-md-4 control-label">Alamat :</label>
 							<div class="col-sm-5">
 								<input type="text" class="form-control" name="alamat_sup" id="alamat_sup" required>
 							</div>
 							<div class="clearfix"> </div>
 						</div>
 						<div class="sign-u">
 							<label class="col-md-4 control-label">Tlp :</label>
 							<div class="col-sm-5">
 								<input type="text" class="form-control" name="tlp_sup" id="tlp_sup" required>
 							</div>
 							<div class="clearfix"> </div>
 						</div>
 					</div>

 					<div class="modal-footer">
 						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
 						<button type="submit" class="btn btn-primary" name="simpansup">Simpan</button>
 						<div class="clearfix"> </div>
 					</div>
 				</form>
 			</div>
 		</div>
 	</div>


 </section>
 <br>
 <section class="content">
 	<div class="webui">
 		<div class="row">
 			<div class="col-md-12 panel-grids">
 				<div class="box box-default">
 					<div class="box-body table-responsive">
 						<table id="tabelpemasok" class="table table-bordered table-striped">
 							<thead>
 								<tr>
 									<th>No.</th>
 									<th>Nama</th>
 									<th>Alamat</th>
 									<th>Tlp</th>
 									<th>Total Aset</th>
 									<th>Aksi</th>
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