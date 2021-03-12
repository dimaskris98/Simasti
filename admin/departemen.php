<?php
if (isset($_POST['simpan'])){ 
$direktorat=$_POST['dir'];
$kompartemen=$_POST['komp'];
$departemen=$_POST['dep'];
$bagian=$_POST['bag'];
//Memasukkan data
$sql = "INSERT INTO data_unit_kerja (id, direktorat, kompartemen, departemen, bagian) VALUES ('', '$direktorat', '$kompartemen', '$departemen', '$bagian')";
$query	= mysql_query($sql);
}

if (isset($_POST['hapus'])){
$id=$_POST['idd'];
$sql 	= 'delete from data_unit_kerja where id="'.$id.'"';
$query	= mysql_query($sql);

}

if(isset($_POST['simpanedit'])){
$direktorat=$_POST['dir'];
$kompartemen=$_POST['komp'];
$departemen=$_POST['dep'];
$bagian=$_POST['bag'];
	$sql 	= "UPDATE data_unit_kerja SET direktorat='$direktorat', kompartemen='$kompartemen', departemen='$departemen', bagian='$bagian', WHERE id='$id'";
	$query	= mysql_query($sql);
  }
?>
<div class="col-md-11 panel-grids">
	<h4>Kategori</h4>
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
														<form class="form-horizontal" method="POST" action="?mod=departemen">
															<div class="modal-body">
																<div class="sign-u">
																	<label class="col-md-4 control-label" >Direktorat:</label>
																	<div class="col-sm-5"> 
																	<input type="text" class="form-control" name="dir" id="dir" required>
																	</div>
																	<div class="clearfix"> </div>
																</div>
																<div class="sign-u">
																	<label class="col-md-4 control-label" >Kompartemen:</label>
																	<div class="col-sm-5"> 
																	<input type="text" class="form-control" name="komp" id="komp" required>
																	</div>
																	<div class="clearfix"> </div>
																</div>
																<div class="sign-u">
																	<label class="col-md-4 control-label" >Departemen:</label>
																	<div class="col-sm-5"> 
																	<input type="text" class="form-control" name="dep" id="dep" required>
																	</div>
																	<div class="clearfix"> </div>
																</div>
																<div class="sign-u">
																	<label class="col-md-4 control-label" >Bagian:</label>
																	<div class="col-sm-5"> 
																	<input type="text" class="form-control" name="bag" id="bag" required>
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
								<tr><th>No</th><th>Direktorat</th><th>Kompartemen</th><th>Departemen</th><th>Bagian</th><th>Aksi</th></tr>
							</thead>
							<tbody>
									 <?php
												
									$conn = new mysqli("localhost", "root", "", "bootstrap");
									if ($conn->connect_errno) {
										echo "Failed to connect to MySQL: " . $conn->connect_error;
									}
									
									$no = 1;
									$res = $conn->query("SELECT * FROM data_unit_kerja");
									while($row = $res->fetch_assoc()){
										echo '
										
										<tr>
											<input type="text" name="idd" value="'.$row['id'].'" hidden>
											<td>'.$no.'</td>
											<td>'.$row['direktorat'].'</td>
											<td>'.$row['kompartemen'].'</td>
											<td>'.$row['departemen'].'</td>
											<td>'.$row['bagian'].'</td>
											<td>
											<a href="?mod=editdepartemen&id='.$row['id'].'" title="Edit Data" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
										
										<button type="submit" name="hapus" onclick="return confirm(\'Anda yakin akan menghapus data '.$row['bagian'].'?\')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
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