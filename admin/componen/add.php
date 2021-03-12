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

//if (isset($_POST['newpemasok'])){
	//$nama=$_POST['pemasok']; 
	//$alamat=$_POST['alamat']; 
	//$tlp=$_POST['tlp']; 
//Memasukkan data 
//$sql = "INSERT INTO data_pemasok VALUES ('', '$nama','$alamat','$tlp')";
//$query	= mysqli_query($conn,$sql);
//}

if (isset($_POST['simpankomponen'])){
	$id_user=$_SESSION['sess_id'] ;
	$nama=$_POST['nama'];
	$kategori=$_POST['kategori']; 
	$pemasok=$_POST['pemasok']; 
	$tgl=$_POST['tgl'];
	$po=$_POST['po'];
	$harga=$_POST['harga'];
	$qty=$_POST['qty'];
	$sisa=$_POST['qty'];
	$minqty=$_POST['minqty'];
//Memasukkan data
$sql = "INSERT INTO komponen 
VALUES 
('', '$nama', '$kategori', '$pemasok', '$po','$tgl', '$harga', '$qty', '$sisa', '$minqty', '$id_user')";
$query	= mysqli_query($conn,$sql);
echo '<script>window.location="?mod=komponen"</script>';
}



?>
<h2><center>Input Komponen</center><span class="label label-default"></span></h2>
<div class="main-page signup-page">
				<div class="sign-up-row widget-shadow">
				
				<form class="form-horizontal" method="POST" action="">
					<div class="form-group">
						<label class="col-sm-5 control-label">
							<h4>Nama :</h4>
						</label>
						<div class="col-sm-3">
							<input class="form-control" type="text" name="nama" id="nama"  required>
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
				$res = $conn->query("SELECT * FROM kategori where tipe='komponen'");
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
							<h4>Nomor PO :</h4>
						</label>
						<div class="col-sm-3">
								<input class="form-control" type="text" name="po" id="po" required>
						</div>
						<div class="clearfix"> </div>
					</div>					 
					<div class="form-group">
							<label class="col-md-5 control-label">
								<h4>Tanggal Pembelian :</h4>
							</label>
							<div class="col-sm-3">
							<div class="input-group ">
                                    <input type="text" class="form-control tglpicker" placeholder="date"  name="tgl" id="tgl" value="" required>
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div> 
								
							</div>
							 
							
							 
							<div class="clearfix"> </div>
						</div>
					<div class="form-group">
						<label class="col-sm-5 control-label">
							<h4>Pemasok :</h4>
						</label>
						<div class="col-sm-3">
								<select name="pemasok" id="pemasok" class="form-control select2" required>
								<option >Pilih Pemasok</option>
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
							<button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#popsupplier" data-whatever="@mdo">Baru</button>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="form-group">
						<label class="col-sm-5 control-label">
							<h4>Harga :</h4>
						</label>
						<div class="col-md-2">
								<input  class="form-control" type="text" name="harga" id="harga">
						</div>
						<div class="col-sm-1">
								<span class="input-group-addon">IDR</span>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="form-group">
						<label class="col-sm-5 control-label">
							<h4>QTY :</h4>
						</label>
						<div class="col-sm-2">
								<input class="form-control"  type="text" name="qty" id="qty">
						</div> 
						<div class="clearfix"> </div>
					</div>
					<div class="form-group">
						<label class="col-sm-5 control-label">
							<h4>Min QTY :</h4>
						</label>
						<div class="col-sm-5">
								<input class="form-control"  type="text" name="minqty" id="minqty"></input>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="form-group">
					 
						<div class="col-sm-offset-8 col-sm-6">
						<button type="submit" class="btn btn-primary" name="simpankomponen">Simpan</button>
						<a href="<?php if(isset($_SERVER['HTTP_REFERER'])){ echo $_SERVER['HTTP_REFERER']; } ?>"  class="btn btn-success">Batal</a>
						</div>
						<div class="clearfix"> </div>
					</div>
				</form>
</div>
</div>
 
  
