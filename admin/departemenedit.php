<?php
include('config.php');
$sql= "SELECT * FROM data_unit_kerja WHERE id='$_GET[id]'"; 
$hasil = $dbconnect->query($sql);
$data = $hasil->fetch_array();

					echo'<div>
												<div class="modal-dialog" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<h4 class="modal-title" id="exampleModalLabel">Edit Departemen ' .$data['id'].'</h4>
														</div>
														<form class="form-horizontal" method="POST" action="?mod=departemen">
															<div class="modal-body">
																<div class="sign-u">
																	<label class="col-md-4 control-label" >Direktorat:</label>
																	<div class="col-sm-5"> 
																	<input type="text" value="'.$data['direktorat'].'" class="form-control" name="dir" id="dir" required>
																	</div>
																	<div class="clearfix"> </div>
																</div>
																<div class="sign-u">
																	<label class="col-md-4 control-label" >Kompartemen:</label>
																	<div class="col-sm-5"> 
																	<input type="text" value="'.$data['kompartemen'].'" class="form-control" name="komp" id="komp" required>
																	</div>
																	<div class="clearfix"> </div>
																</div>
																<div class="sign-u">
																	<label class="col-md-4 control-label" >Departemen:</label>
																	<div class="col-sm-5"> 
																	<input type="text" value="'.$data['departemen'].'" class="form-control" name="dep" id="dep" required>
																	</div>
																	<div class="clearfix"> </div>
																</div>
																<div class="sign-u">
																	<label class="col-md-4 control-label" >Bagian:</label>
																	<div class="col-sm-5"> 
																	<input type="text" value="'.$data['bagian'].'" class="form-control" name="bag" id="bag" required>
																	</div>
																	<div class="clearfix"> </div>
																</div>
															</div>
															
															<div class="modal-footer">
																<a href="?mod=departemen" class="btn btn-success">Kembali</a>
																<button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
															<div class="clearfix"> </div></div>
														</form>
													</div>
												</div>
											</div>
';

?>