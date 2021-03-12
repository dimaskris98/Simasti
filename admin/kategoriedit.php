<?php
include('config.php');
$sql= "SELECT * FROM data_kategori WHERE id_kategori='$_GET[id]'"; 
$hasil = $dbconnect->query($sql);
$data = $hasil->fetch_array();

					echo'<div>
												<div class="modal-dialog" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<h4 class="modal-title" id="exampleModalLabel">Edit Kategori</h4>
														</div>
														<form class="form-horizontal" method="POST" action="?mod=kategori">
															<div class="modal-body">
																<div class="sign-u">
																	<label class="col-md-4 control-label" >Nama Kategori:</label>
																	<div class="col-sm-5"> 
																	<input type="hidden" value="'.$data['id_kategori'].'" class="form-control" name="id_kategori" id="id_kategori" required>
																	<input type="text" value="'.$data['nama_kategori'].'" class="form-control" name="nama_kategori" id="nama_Kategori" required>
																	</div>
																	<div class="clearfix"> </div>
																</div>
																<div class="sign-u">
																	<label class="col-md-4 control-label" >Tipe Kategori:</label>
																	<div class="col-sm-5">
																		<select name="tipe_kategori" id="tipe" class="form-control">
																		<option>'.$data['tipe_kategori'].'</option>
																		<option>Aset</option>
																		<option>Aksesoris</option>
																		<option>Komponen</option>
																		</select>
																	</div>
																	<div class="clearfix"> </div>
																</div>
															</div>
															
															<div class="modal-footer">
																<button type="button" onclick=(window.location="?mod=kategori") class="btn btn-danger" data-dismiss="modal">Close</button>
																<button type="submit" class="btn btn-primary" name="simpanedit">Simpan</button>
															
															<div class="clearfix"> </div></div>
														</form>
													</div>
												</div>
											</div>
';

?>