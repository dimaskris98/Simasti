<?php

if (isset($_POST['simpan'])){
	 
	$nama=$_POST['nama_sup'];
	$alamat=$_POST['alamat_sup'];
	$tlp=$_POST['tlp_sup'];
	
//Memasukkan data
	$sql = "INSERT INTO data_pemasok VALUES ('', '$nama', '$alamat', '$tlp')";
	$query	= mysqli_query($conn, $sql); 
	echo '<script>alert('.$nama.')</script>';
	echo '<script>window.location=Supplier</script>';
}

?>
 <div id="kanan">
	<div class="col-md-11 panel-grids">
		<h4>Daftar Pemasok</h4>
	</div>
		<div class="col-md-1 panel-grids"> 
			<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal1" data-whatever="@mdo">Baru</button>
			<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
													<div class="modal-dialog" role="document">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																	<h4 class="modal-title" id="exampleModalLabel">Creat Data Pemasok Baru</h4>
															</div>
															<form class="form-horizontal" method="POST" action="?mod=pemasok">
																<div class="modal-body">

																	<div class="sign-u">
																		<label class="col-md-4 control-label" >Nama Pemasok:</label>
																		<div class="col-sm-5"> 
																		<input type="text" class="form-control" name="nama_sup" id="nama_sup" required>
																		</div>
																		<div class="clearfix"> </div>
																	</div>
																	<div class="sign-u">
																		<label class="col-md-4 control-label" >Alamat :</label>
																		<div class="col-sm-5"> 
																		<input type="text" class="form-control" name="alamat_sup" id="alamat_sup" required>
																		</div>
																		<div class="clearfix"> </div>
																	</div>
																	<div class="sign-u">
																		<label class="col-md-4 control-label" >Tlp :</label>
																		<div class="col-sm-5"> 
																		<input type="text" class="form-control" name="tlp_sup" id="tlp_sup" required>
																		</div>
																		<div class="clearfix"> </div>
																	</div>
																</div>
																
																<div class="modal-footer">
																	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																	<button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
																<div class="clearfix"> </div></div>
															</form>
														</div>
													</div>
												</div>
		</div> 
	<div class="col-md-12 panel-grids">
	
	<div class="box-body table-responsive" >
		
	<form role="form" action="" method="POST" enctype="multipart/form-data">
		<table id="example1" class="table table-bordered table-striped">
		
			<thead>
				<tr><th>No</th><th>Kode Sup</th><th>Nama</th><th>Alamat</th><th>Tlp</th><th>Aksi</th></tr>
			</thead>
			<tbody>
					 <?php
					 
					$no = 1;
					$res = $conn->query("SELECT * FROM data_pemasok");
					while($row = $res->fetch_assoc()){
						echo '
						
						<tr>
							<input type="text" name="idd" value="'.$row['id_sup'].'" hidden>
							<td>'.$no.'</td>
							<td>'.$row['id_sup'].'</td>
							<td>'.$row['nama_sup'].'</td>
							<td>'.$row['alamat_sup'].'</td>
							<td>'.$row['tlp_sup'].'</td>
							<td>
							<a href="?mod=editpemasok&id='.$row['id_sup'].'" title="Edit Data"  ><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
							<a href="?mod=editpemasok&idd='.$row['id_sup'].'" title="Hapus Data"  onclick="return confirm(\'Anda yakin akan menghapus '.$row['nama_sup'].'?\')" ><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
							</td>							
						</tr>
						'; 
						$no++;
					}
					?>
			</tbody>
		</table>
		</form>
	</div>
	</div>
</div>
<?php ob_flush();?>