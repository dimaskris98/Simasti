 <h2>
 	<center>Create Consumable</center><span class="label label-default"></span>
 </h2>
 <div class="main-page signup-page">
 	<div class="sign-up-row widget-shadow">
 		<form class="form-horizontal" method="POST" action="add">
 			<div class="form-group">
 				<label class="col-sm-5 control-label">Nama :</label>
 				<div class="col-sm-3">
 					<input class="form-control" type="text" name="nama" id="nama" value="" required>
 				</div>
 				<div class="clearfix"> </div>
 			</div>
 			<div class="form-group">
 				<label class="col-sm-5 control-label">Kode Item :</label>
 				<div class="col-sm-3">
 					<input class="form-control" value="" type="text" name="item" id="item" required>
 				</div>
 				<div class="clearfix"> </div>
 			</div>
 			<div class="form-group">
 				<label class="col-sm-5 control-label">Warna :</label>
 				<div class="col-sm-3">
 					<input class="form-control" value="" type="text" name="warna" id="warna" required>
 				</div>
 				<div class="clearfix"> </div>
 			</div>
 			<div class="form-group">
 				<label class="col-sm-5 control-label">Kategori :</label>
 				<div class="col-sm-3">
 					<select name="kategori" id="kategori" class="form-control" required>
 						<?php
							$no = 1;
							$res = $conn->query("SELECT * FROM kategori where tipe='consumable'");
							while ($row = $res->fetch_assoc()) {
								echo '<option value="' . $row['id_kategori'] . '">' . $row['nama_kategori'] . ' </option>';
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
 				<label class="col-sm-5 control-label">Manufaktur :</label>
 				<div class="col-sm-3">
 					<select name="manufaktur" id="manufaktur" class="form-control" required>
 						<?php
							$no = 1;
							$res = $conn->query("SELECT * FROM manufaktur");
							while ($row = $res->fetch_assoc()) {
								echo '<option value="' . $row['id_manufaktur'] . '">' . $row['nama_manufaktur'] . '</option>';
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
 				<label class="col-sm-5 control-label">Nomor Model :</label>
 				<div class="col-sm-3">
 					<input class="form-control" value="" type="text" name="model" id="model" required>
 				</div>
 				<div class="clearfix"> </div>
 			</div>

 			<div class="form-group">
 				<label class="col-sm-5 control-label">Min QTY :</label>
 				<div class="col-sm-3">
 					<input class="form-control" value="" type="text" name="minqty" id="minqty"></input>
 				</div>
 				<div class="clearfix"> </div>
 			</div>
 			<div class="form-group">
 				<label class="col-sm-5 control-label">
 					Sisa :
 				</label>
 				<div class="col-sm-3">
 					<input class="form-control" value="" type="text" name="sisa" id="sisa">
 				</div>
 				<div class="clearfix"> </div>
 			</div>
 			<div class="form-group">
 				<label for="keterangan" class="col-md-5 control-label">Keterangan :</label>
 				<div class="col-md-3">
 					<textarea name="keterangan" id="keterangan" style="max-width: 100%; resize: vertical;overflow-y: auto;" rows="5" class="form-control"></textarea>
 				</div>
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