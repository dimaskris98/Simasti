<?php

if(isset($_POST['simpanedit'])){
	$id=$_POST['id_sup'];
	$nama=$_POST['nama_sup'];
	$alamat=$_POST['alamat_sup'];
	$tlp=$_POST['tlp_sup'];
	$sql 	= "UPDATE data_pemasok SET nama_sup='$nama', alamat_sup='$alamat', tlp_sup='$tlp' WHERE id_sup='$id'";
	$query	= mysqli_query($conn, $sql);
	echo '<script>window.location="Supplier"</script>'; 
}
else if (isset($_POST['hapus']))
{
	$idd=$_POST['idd'];
	$sql 	= 'delete from data_pemasok where id_sup="'.$idd.'"';
	$query	= mysqli_query($conn, $sql);
	echo '<script>window.location = document.referrer</script>';
}
else 
{ 
	$sql= "SELECT * FROM data_pemasok WHERE id_sup='$_POST[id]'"; 
	$hasil = $conn->query($sql);
	$data = $hasil->fetch_array();
?>
	<div id="kanan" >
		<div class="modal-dialog" role="document">
			<div id="kanan"class="modal-content">
				<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<h4 class="modal-title" id="exampleModalLabel">Edit Pemasok <?=$data['nama_sup']?></h4>
														</div>
														<form class="form-horizontal" method="POST" action="">
															<div class="modal-body">
																<div class="sign-u">
																	<label class="col-md-4 control-label" >Nama Pemasok:</label>
																	<div class="col-sm-5"> 
																	<input type="hidden" value="<?=$data['id_sup']?>" class="form-control" name="id_sup" id="id_sup" required>
																	<input type="text" value="<?=$data['nama_sup']?>" class="form-control" name="nama_sup" id="nama_sup" required>
																	</div>
																	<div class="clearfix"> </div>
																</div>
																<div class="sign-u">
																	<label class="col-md-4 control-label" >Alamat :</label>
																	<div class="col-sm-5"> 
																	<input type="text" value="<?=$data['alamat_sup']?>" class="form-control" name="alamat_sup" id="alamat_sup" required>
																	</div>
																	<div class="clearfix"> </div>
																</div>
																<div class="sign-u">
																	<label class="col-md-4 control-label" >Tlp :</label>
																	<div class="col-sm-5"> 
																	<input type="text" value="<?=$data['tlp_sup']?>" class="form-control" name="tlp_sup" id="tlp_sup" required>
																	</div>
																	<div class="clearfix"> </div>
																</div>
															</div>
															
															<div class="modal-footer">
																<a type="button" href="Supplier" class="btn btn-danger" data-dismiss="modal">Close</a>
																<button type="submit" class="btn btn-primary" name="simpanedit">Simpan</button>
															
															<div class="clearfix"> </div></div>
														</form>
													</div>
												</div>
											</div>
<?php } ?>