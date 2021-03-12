<?php
$id=$_POST['id'];
 	$data =mysqli_fetch_array(mysqli_query($conn,"SELECT  * FROM consumable 
				LEFT JOIN kategori ON consumable.id_kategori=kategori.id_kategori 
				LEFT JOIN data_pemasok ON consumable.id_sup=data_pemasok.id_sup 
				LEFT JOIN manufaktur ON consumable.id_manufaktur=manufaktur.id_manufaktur WHERE id='$id'"));
?>
<h2><center>Edit Consumable</center><span class="label label-default"></span></h2>
<div class="main-page signup-page">
				<div class="sign-up-row widget-shadow">
				
				<form class="form-horizontal" method="POST" action="<?php echo $_POST['back-link'];?>">
				<input value="<?php echo $data['id']; ?>" type="hidden" class="form-control" name="id" id="id" />
					<div class="form-group">
						<label class="col-sm-5 control-label">
							<h4>Nama :</h4>
						</label>
						<div class="col-sm-3">
							<input class="form-control" type="text" name="nama" id="nama"  value="<?php echo $data['nama_consumable']; ?>" required>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="form-group">
						<label class="col-sm-5 control-label">
							<h4>Kategori :</h4>
						</label>
						<div class="col-sm-3">
								<select name="kategori" id="kategori" class="form-control" required>
								<option value="<?php echo $data['id_kategori']; ?>"><?php echo $data['nama_kategori']; ?></option>
									<?php 
										$no = 1;
										$res = $conn->query("SELECT * FROM kategori where tipe='consumable'");
										while($row = $res->fetch_assoc()){
											echo '
												<option value="'.$row['id_kategori'].'">'.$row['nama_kategori']. ' </option>
												';
											$no++;
										}
									?>
								</select>
						</div>
						<div class="col-md-1 panel-grids"> 
							<button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#popkategori" data-whatever="@mdo">Baru</button>
						</div>
						<div class="clearfix"> </div>
					</div> 
					
					<div class="form-group">
						<label class="col-sm-5 control-label">
							<h4>Manufaktur :</h4>
						</label>
						<div class="col-sm-3">
								<select name="manufaktur" id="manufaktur" class="form-control" required>
								<option value="<?php echo $data['id_manufaktur']; ?>"><?php echo $data['nama_manufaktur']; ?></option>
									<?php 
									$no = 1;
									$res = $conn->query("SELECT * FROM manufaktur");
									while($row = $res->fetch_assoc()){
										echo '
											<option value="'.$row['id_manufaktur'].'">'.$row['nama_manufaktur'].'</option>
											';
										$no++;
									}
									?>
								</select>
						</div>
						<div class="col-md-1 panel-grids"> 
							<button type="button" class="btn btn-default btn-md" data-toggle="modal" data-target="#popmanufacturer" data-whatever="@mdo">New</button> 
						</div>
						<div class="clearfix"> </div>
					</div> 
					<div class="form-group">
						<label class="col-sm-5 control-label">
							<h4>Nomor Model :</h4>
						</label>
						<div class="col-sm-3">
								<input class="form-control" value="<?php echo $data['no_model']; ?>" type="text" name="model" id="model" required>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="form-group">
						<label class="col-sm-5 control-label">
							<h4>Nomor Item :</h4>
						</label>
						<div class="col-sm-3">
								<input class="form-control" value="<?php echo $data['no_item']; ?>" type="text" name="item" id="item" required>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="form-group">
							<label class="col-sm-5 control-label">
								<h4>Tanggal Pembelian :</h4>
							</label>
							<div class="col-sm-3">
									<input class="form-control" value="<?php echo $data['tgl_po']; ?>" type="date" name="tgl" id="tgl" required>
							</div>
							<div class="clearfix"> </div>
						</div>
					<div class="form-group">
						<label class="col-sm-5 control-label">
							<h4>Pemasok :</h4>
						</label>
						<div class="col-sm-3">
								<select name="pemasok" id="pemasok" class="form-control " required>
								<option value="<?php echo $data['id_sup']; ?>"><?php echo $data['nama_sup']; ?></option>
											<?php
										 
											$no = 1;
											$res = $conn->query("SELECT * FROM data_pemasok");
											while($row = $res->fetch_assoc()){
												echo '
													<option value="'.$row['id_sup'].'">'.$row['nama_sup'].'</option>
													';
												$no++;
											}
											?>
									</select>
						</div>
						
						<div class="col-md-1 panel-grids"> 
							<button type="button" class="btn btn-default btn-md" data-toggle="modal" data-target="#popsupplier" data-whatever="@mdo">New</button>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="form-group">
						<label class="col-sm-5 control-label">
							<h4>Nomor PO :</h4>
						</label>
						<div class="col-sm-3">
								<input class="form-control" value="<?php echo $data['po']; ?>" type="text" name="po" id="po" required>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="form-group">
						<label class="col-sm-5 control-label"><h4>Harga :</h4></label>
						<div class="col-sm-3">
							<div class="input-group">
								<input class="form-control" value="<?php echo $data['harga']; ?>" type="text" name="harga" id="harga">
								<span class="input-group-addon">
									<i  class="fa fa ">IDR</i>
								</span>
							</div>
						</div>   
						<div class="clearfix"> </div>
					</div>
					<div class="form-group">
						<label class="col-sm-5 control-label">
							<h4>QTY :</h4>
						</label>
						<div class="col-sm-3">
								<input class="form-control" value="<?php echo $data['qty']; ?>" type="text" name="qty" id="qty">
								<input value="<?php echo $data['qty']; ?>" type="hidden" name="qtyawal" id="qtyawal">
								<input value="<?php echo $data['sisa']; ?>" type="hidden" name="sisa" id="sisa">
						</div> 
						<div class="clearfix"> </div>
					</div>
					<div class="form-group">
						<label class="col-sm-5 control-label">
							<h4>Min QTY :</h4>
						</label>
						<div class="col-sm-3">
								<input class="form-control"  value="<?php echo $data['minqty']; ?>" type="text" name="minqty" id="minqty"></input>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="form-group">
					 
						<div class="col-sm-offset-8 col-sm-6">
						<button type="submit" class="btn btn-primary" name="simpaconsumable-edit">Simpan</button>
						<a href="<?php echo $_POST['back-link'];?>" class="btn btn-success">Batal</a>
						</div>
						<div class="clearfix"> </div>
					</div>
				</form>
</div>
</div>