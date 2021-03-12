<?php

if (isset($_POST['newKategori'])){
$nama = $_POST['nama'];
$tipe = $_POST['tipe'];
//Memasukkan data
$sql = "INSERT INTO kategori ( id_kategori, nama_kategori, tipe) VALUES ('', '$nama', '$tipe')";
$query	= mysqli_query($conn,$sql);

}

if (isset($_POST['newmanufaktur'])){
	$nama=$_POST['manufaktur']; 
//Memasukkan data

$sql = "INSERT INTO manufaktur  VALUES ('', '$nama')";
$query	= mysqli_query($conn,$sql);
}


if (isset($_POST['simpanlicensi'])){ 
	$nama=$_POST['nama'];
	$kategori=$_POST['kategori']; 
	$manufaktur=$_POST['manufaktur']; 
	$serial=$_POST['serial'];
	$po=$_POST['po'];
	$tglpo=$_POST['tglpo'];
	$harga=$_POST['harga'];
	$seat=$_POST['seat'];
	$sisa=$_POST['seat'];
	$licensiname=$_POST['licensiname'];
	$licensiemail=$_POST['licensiemail'];
	$tglkadaluarsa=$_POST['tglkadaluarsa'];
//Memasukkan data
$sql = "INSERT INTO licensi 
VALUES 
('', '$nama', '$serial','$tglpo', '$po', '$harga', '$seat', '$sisa', '$licensiname', '$licensiemail', '$tglkadaluarsa', '$kategori', '$manufaktur')";
$query	= mysqli_query($conn,$sql);
 
echo '<script>window.location="licensi"</script>';
}



?>
<h2><center>Input Licensi</center><span class="label label-default"></span></h2>
<div class="main-page signup-page">
				<div class="sign-up-row widget-shadow">
				
				<form class="form-horizontal" method="POST" action="">
					<div class="form-group">
						<label class="col-sm-5 control-label">
							<h4>Nama :</h4>
						</label>
						<div class="col-sm-5">
							<input type="text" name="nama" id="nama"  required>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="form-group">
						<label class="col-sm-5 control-label">
							<h4>Kategori :</h4>
						</label>
						<div class="col-sm-3">
								<select name="kategori" id="kategori" class="form-control" required>
								<option>Pilih Kategori</option>
									<?php
			 
				
				$no = 1;
				$res = $conn->query("SELECT * FROM kategori where tipe='licensi'");
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
								<option>Pilih Manufaktur</option>
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
							<button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#popamodel" data-whatever="@mdo">Baru</button>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="form-group">
						<label class="col-sm-5 control-label">
							<h4>Produk Key :</h4>
						</label>
						<div class="col-sm-5">
							<textarea name="serial" rows="3" cols="18"> </textarea>
						</div>
						<div class="clearfix"> </div>
					</div>				 
					<div class="form-group">
						<label class="col-sm-5 control-label">
							<h4>Nomor PO :</h4>
						</label>
						<div class="col-sm-5">
								<input type="text" name="po" id="po" required>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="form-group ">
						<label class="col-md-5 control-label">
							<h4>Tanggal PO :</h4>
						</label>
						<div class="col-md-2">
							<div class="input-group">
								<input class="col-md-1 form-control" type="date" name="tglpo" id="tglpo" />
								<span class="input-group-addon">
											<i class="fa fa-calendar"></i>
								</span>
							</div>
						</div> 
					</div> 
					<div class="form-group ">
						<label class="col-md-5 control-label">
							<h4>Harga :</h4>
						</label>
						<div class="col-md-3">
							<div class="input-group">
								<input class="col-md-5 form-control" type="text" name="harga" id="harga" />
								<span class="input-group-addon">
											<i  >IDR</i>
								</span>
							</div>
						</div> 
					</div> 	 
					<div class="form-group">
						<label class="col-sm-5 control-label">
							<h4>Seat :</h4>
						</label>
						<div class="col-sm-2">
								<input type="text" name="seat" id="seat">
						</div> 
						<div class="clearfix"> </div>
					</div>
					<div class="form-group">
						<label class="col-sm-5 control-label">
							<h4>Licensi atas nama :</h4>
						</label>
						<div class="col-sm-2">
								<input type="text" name="licensiname" id="licensiname">
						</div> 
						<div class="clearfix"> </div>
					</div>
					<div class="form-group">
						<label class="col-sm-5 control-label">
							<h4>Licensi email :</h4>
						</label>
						<div class="col-sm-2">
								<input type="email" name="licensiemail" id="licensiemail">
						</div> 
						<div class="clearfix"> </div>
					</div>
					<div class="form-group ">
						<label class="col-md-5 control-label">
							<h4>Tanggal Kadaluarsa :</h4>
						</label>
						<div class="col-md-2">
							<div class="input-group">
								<input class="col-md-1 form-control" type="date" name="tglkadaluarsa" id="tglkadaluarsa" value="" />
								<span class="input-group-addon">
											<i class="fa fa-calendar"></i>
								</span>
							</div>
						</div> 
					</div>	
					<div class="form-group">
					 
						<div class="col-sm-offset-8 col-sm-6">
						<button type="submit" class="btn btn-primary" name="simpanlicensi">Simpan</button>
						<a href="licensi"  class="btn btn-success">Batal</a>
						</div>
						<div class="clearfix"> </div>
					</div>
				</form>
</div>
</div>

<!--Pop Up Kategori-->
<div class="modal fade" id="popkategori" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Kategori tipe consumable</h4>
			</div>
			<div class="modal-body">
			<form name="form-kategori" id="form-kategori" class="form-kategori form-horizontal" method="POST" action="">
					<div class="form-group">
						<label class="col-sm-5 control-label">
							<h4>Nama kategori :</h4>
						</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="nama" id="nama" required>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="form-group">
						<label class="col-sm-5 control-label">
							<h4>Tipe Kategori :</h4>
						</label>
						<div class="col-sm-5">
							<input type="text" value="licensi" class="form-control" name="tipe" id="tipe" readonly>
						</div>
						<div class="clearfix"> </div>
					</div>
					
					<div class="form-group">
				<div class="col-sm-offset-7 col-sm-5">
					<button type="submit" class="btn btn-primary" name="newKategori">Simpan</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
					<div class="clearfix"> </div>
				</div>
		</form>
		</div>
		</div>
	</div>
</div>
 

<!--Pop Up Manufaktur-->
<div class="modal fade" id="popamodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Model</h4>
			</div>
			
				<div class="modal-body">
				<form class="form-horizontal" method="POST" action="">
					<div class="form-group">
						<label class="col-sm-5 control-label">
							<h4>Nama Manufaktur :</h4>
						</label>
						<div class="col-sm-5">
							<input type="text" name="manufaktur" id="manufaktur"  required>
						</div>
						<div class="clearfix"> </div>
					</div>
					
					<div class="form-group">
				<div class="col-sm-offset-7 col-sm-5">
					<button type="submit" class="btn btn-primary" name="newmanufaktur">Simpan</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
					<div class="clearfix"> </div>
				</div>
		</form>
		</div>
		</div>
	</div>
</div>