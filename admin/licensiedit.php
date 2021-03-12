<?php
$de=$_GET['id'];
$res = $conn->query("SELECT  * FROM Licensi   
				LEFT JOIN kategori ON Licensi.id_kategori=kategori.id_kategori  
				LEFT JOIN manufaktur ON licensi.id_manufaktur=manufaktur.id_manufaktur  WHERE id='$de'"); 
				
$data = $res->fetch_array();



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
	$id=$_POST['id'];
	$nama=$_POST['nama'];
	$kategori=$_POST['kategori']; 
	$manufaktur=$_POST['manufaktur']; 
	$serial=$_POST['serial'];
	$po=$_POST['po'];
	$tglpo=$_POST['tglpo'];
	$harga=$_POST['harga'];
	$seat=$_POST['seat'];
	$sisa=$_POST['sisa'];
	 
	$qtyawal=$_POST['qtyawal'];	
	$licensiname=$_POST['licensiname'];
	$licensiemail=$_POST['licensiemail'];
	$tglkadaluarsa=$_POST['tglkadaluarsa'];
	$a=$seat-$qtyawal;
	$b=$sisa+$a;
	 
	//Memasukkan data 
	$sql 	= "UPDATE licensi SET nama_licensi='$nama', id_kategori='$kategori',id_manufaktur='$manufaktur', 
	serial='$serial',po='$po', tgl_po='$tglpo' ,harga_po='$harga' ,seats='$seat' ,sisa='$b' ,licensi_user='$licensiname'
	,licensi_email='$licensiemail' ,tgl_kadaluarsa='$tglkadaluarsa'	
		WHERE id='$id'";
 	
	$query	= mysqli_query($conn,$sql);
	 
	echo '<script>window.location="licensi"</script>';

}



?>
<h2><center>Input Licensi</center><span class="label label-default"></span></h2>
<div class="main-page signup-page">
				<div class="sign-up-row widget-shadow">
				
				<form class="form-horizontal" method="POST" action="">
				<input value="<?php echo $data['id']; ?>" type="hidden" class="form-control" name="id" id="id" />
					<div class="form-group">
						<label class="col-sm-5 control-label">
							<h4>Nama :</h4>
						</label>
						<div class="col-sm-5">
							<input type="text" name="nama" id="nama"  value="<?php echo $data['nama_licensi']; ?>"  required>
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
							<button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#popamodel" data-whatever="@mdo">Baru</button>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="form-group">
						<label class="col-sm-5 control-label">
							<h4>Produk Key :</h4>
						</label>
						<div class="col-sm-5">
						<textarea name="serial" rows="3" cols="18"><?php echo $data['serial']; ?></textarea>
							 
						</div>
						<div class="clearfix"> </div>
					</div>				 
					<div class="form-group">
						<label class="col-sm-5 control-label">
							<h4>Nomor PO :</h4>
						</label>
						<div class="col-sm-5">
								<input type="text" name="po" id="po" value="<?php echo $data['po']; ?>"  required>
						</div>
						<div class="clearfix"> </div>
					</div>					 
					<div class="form-group">
							<label class="col-md-5 control-label">
								<h4>Tanggal PO :</h4>
							</label>
							<div class="input-group input-icon left">
								<div class="col-md-6">
									<input type="date" name="tglpo" id="tglpo"  value="<?php echo $data['tgl_po']; ?>"  required>
								</div>
								<div class="col-md-1">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								</div>
								
							</div> 
							<div class="clearfix"> </div>
					</div> 	
					<div class="form-group">
						<label class="col-sm-5 control-label">
							<h4>Harga :</h4>
						</label>
						<div class="col-md-2">
								<input type="text" name="harga" id="harga"  value="<?php echo $data['harga_po']; ?>" >
						</div>
						<div class="col-sm-1">
								<span class="input-group-addon">IDR</span>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="form-group">
						<label class="col-sm-5 control-label">
							<h4>Seat :</h4>
						</label>
						<div class="col-sm-2">
								<input type="text" name="seat" id="seat"  value="<?php echo $data['seats']; ?>" >
								
								<input value="<?php echo $data['seats']; ?>" type="hidden" name="qtyawal" id="qtyawal">
								<input value="<?php echo $data['sisa']; ?>" type="hidden" name="sisa" id="sisa">
						</div> 
						<div class="clearfix"> </div>
					</div>
					<div class="form-group">
						<label class="col-sm-5 control-label">
							<h4>Licensi atas nama :</h4>
						</label>
						<div class="col-sm-2">
								<input type="text" name="licensiname" id="licensiname"  value="<?php echo $data['licensi_user']; ?>" >
						</div> 
						<div class="clearfix"> </div>
					</div>
					<div class="form-group">
						<label class="col-sm-5 control-label">
							<h4>Licensi email :</h4>
						</label>
						<div class="col-sm-2">
								<input type="email" name="licensiemail" id="licensiemail"  value="<?php echo $data['licensi_email']; ?>" >
						</div> 
						<div class="clearfix"> </div>
					</div>				 
					<div class="form-group">
							<label class="col-md-5 control-label">
								<h4>Tanggal Kadaluarsa :</h4>
							</label>
							<div class="input-group input-icon left">
								<div class="col-md-6">
									<input type="date" name="tglkadaluarsa" id="tglkadaluarsa"  value="<?php echo $data['tgl_kadaluarsa']; ?>"  required>
								</div>
								<div class="col-md-1">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								</div>
								
							</div> 
							<div class="clearfix"> </div>
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
							<input type="text" value="komponen" class="form-control" name="tipe" id="tipe" readonly>
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
 
<!--Pop Up pemasok-->
<div class="modal fade" id="poppemasok" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Model</h4>
			</div>
			
				<div class="modal-body">
				<form class="form-horizontal" method="POST" action="">
					<div class="form-group">
						<label class="col-sm-5 control-label">
							<h4>Nama Pemasok :</h4>
						</label>
						<div class="col-sm-5">
							<input type="text" name="pemasok" id="pemasok"  required>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="form-group">
						<label class="col-sm-5 control-label">
							<h4>Alamat :</h4>
						</label>
						<div class="col-sm-5">
							<input type="text" name="alamat" id="alamat"  required>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="form-group">
						<label class="col-sm-5 control-label">
							<h4>Telp :</h4>
						</label>
						<div class="col-sm-5">
							<input type="text" name="tlp" id="tlp"  required>
						</div>
						<div class="clearfix"> </div>
					</div>
					
					<div class="form-group">
				<div class="col-sm-offset-7 col-sm-5">
					<button type="submit" class="btn btn-primary" name="newpemasok">Simpan</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
					<div class="clearfix"> </div>
				</div>
		</form>
		</div>
		</div>
	</div>
</div>
