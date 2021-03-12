
<?php 

if (isset($_POST['simpan'])){
	
	  $nama=$_POST['nama']; 
	  $tahun=$_POST['tahun']; 
	  $jenis=$_POST['jenis']; 
	  $qty=$_POST['qty']; 
	
	  
		$sql = "INSERT INTO aset_model_jaringan  VALUES ('', '$nama','$tahun', '$jenis','$qty')";
	 $query	= mysqli_query($conn,$sql); 
	  
	 $_SESSION['pesan'] =  $nama. ' Berhasil ditambahkan';
		 
 echo '<script>window.location=" '.$mod.'"</script>'; 
	 
	 
	
 
}
?>
 <h2><center>Creat Aset Model</center><span class="label label-default"></span></h2>

	<div class="sign-up-row widget-shadow">
				
				<form class="form-horizontal" method="POST" action=""> 
					<div class="form-group">
						<label class="col-sm-3 control-label">
							<h4>Nama Model :</h4>
						</label>
						<div class="col-md-7 col-sm-12 required">
							<input class="form-control" type="text" name="nama" id="nama" >
						</div>
						<div class="clearfix"> </div>
					</div> 
					<div class="form-group">
						<label class="col-sm-3 control-label">
							<h4>Tahun Model :</h4>
						</label>
						<div class="col-md-7 col-sm-12 required">
							<div class="input-group year col-md-5">
                                    <input type="text" class="form-control datepicker" placeholder="Tahun" name="tahun" id="tahun" required>
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">
							<h4>Jenis Aset :</h4>
						</label>
						<div class="col-md-7 col-sm-12 required">
							<input class="form-control" type="text" name="jenis" id="jenis" >
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">
							<h4>Jumlah :</h4>
						</label>
						<div class="col-md-7 col-sm-12 required">
							<input class="form-control" type="number" name="qty" id="qty"  >
						</div>
						<div class="clearfix"> </div>
					</div>  
					<div class="form-group">
						<div class="col-sm-offset-8 col-sm-5">
						<button type="submit" class="btn btn-primary  btn-sm"   name="simpan" id="simpan">Simpan</button>
						<a href="Aset" class="btn btn-primary btn-sm">Kembali</a>  
						</div>
						<div class="clearfix"> </div>
					</div>
				</form>
	</div>
  
