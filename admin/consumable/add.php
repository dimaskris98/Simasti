 <h2>
 	<center>Create Consumable</center><span class="label label-default"></span>
 </h2>
 <div class="main-page signup-page">
 	<div class="sign-up-row widget-shadow">

 		<form class="form-horizontal" method="POST" action="add">
 			<div class="form-group">
 				<label class="col-sm-5 control-label">
 					<h4>Nama :</h4>
 				</label>
 				<div class="col-sm-3">
 					<input class="form-control" type="text" name="nama" id="nama" value="" required>
 				</div>
 				<div class="clearfix"> </div>
 			</div>
 			<div class="form-group">
 				<label class="col-sm-5 control-label">
 					<h4>Kategori :</h4>
 				</label>
 				<div class="col-sm-3">
 					<select name="kategori" id="kategori" class="form-control" required>
 						<?php
							$no = 1;
							$res = $conn->query("SELECT * FROM kategori where tipe='consumable'");
							while ($row = $res->fetch_assoc()) {
								echo '
												<option value="' . $row['id_kategori'] . '">' . $row['nama_kategori'] . ' </option>
												';
								$no++;
							}
							?>
 					</select>
 				</div>
 				<div class="col-md-1 panel-grids">
 					<button type="button" class="btn btn-default btn-md" data-toggle="modal" data-target="#popkategoriconsumable" data-whatever="@mdo">Baru</button>
 				</div>
 				<div class="clearfix"> </div>
 			</div>

 			<div class="form-group">
 				<label class="col-sm-5 control-label">
 					<h4>Manufaktur :</h4>
 				</label>
 				<div class="col-sm-3">
 					<select name="manufaktur" id="manufaktur" class="form-control" required>
 						<?php
							$no = 1;
							$res = $conn->query("SELECT * FROM manufaktur");
							while ($row = $res->fetch_assoc()) {
								echo '
											<option value="' . $row['id_manufaktur'] . '">' . $row['nama_manufaktur'] . '</option>
											';
								$no++;
							}
							?>
 					</select>
 				</div>
 				<div class="col-md-1 panel-grids">
 					<button type="button" class="btn btn-default btn-md" data-toggle="modal" data-target="#popmanufacturer" data-whatever="@mdo">Baru</button>
 				</div>
 				<div class="clearfix"> </div>
 			</div>

 			<div class="form-group">
 				<label class="col-sm-5 control-label">
 					<h4>Nomor Model :</h4>
 				</label>
 				<div class="col-sm-3">
 					<input class="form-control" value="" type="text" name="model" id="model" required>
 				</div>
 				<div class="clearfix"> </div>
 			</div>

 			<div class="form-group">
 				<label class="col-sm-5 control-label">
 					<h4>Nomor Item :</h4>
 				</label>
 				<div class="col-sm-3">
 					<input class="form-control" value="" type="text" name="item" id="item" required>
 				</div>
 				<div class="clearfix"> </div>
 			</div>

 			<div class="form-group">
 				<label class="col-sm-5 control-label">
 					<h4>Min QTY :</h4>
 				</label>
 				<div class="col-sm-3">
 					<input class="form-control" value="" type="text" name="minqty" id="minqty"></input>
 				</div>
 				<div class="clearfix"> </div>
 			</div>

 			<div class="form-group">
 				<div class="col-sm-offset-8 col-sm-6">
 					<button type="submit" class="btn btn-primary" name="simpanconsumable">Simpan</button>
 					<a href="consumables" class="btn btn-success">Batal</a>
 				</div>
 				<div class="clearfix"> </div>
 			</div>
 		</form>
 	</div>
 </div>

 