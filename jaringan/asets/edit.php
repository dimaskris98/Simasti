<?php
 $id=$_GET['id'];
 
 if (isset($_POST['simpan'])){ 
	  
	 $nama=$_POST['nama']; 
	 $tahun=$_POST['tahun'];
	 $jenis=$_POST['jenis'];
	 $qty=$_POST['qty'];  
	 
	 $sql 	= "UPDATE aset_model_jaringan SET nama_model='$nama', tahun_model='$tahun'
	 ,jenis_aset_model='$jenis',qty='$qty' 
		 WHERE id_model='$id'";
 
		 
	 
		$query	= mysqli_query($conn,$sql); 
				echo '<script>window.location=" '.$mod.'"</script>'; 
			 
}

 $data =mysqli_fetch_array(mysqli_query($conn,"SELECT  * FROM aset_model_jaringan WHERE id_model='$id'"));
?>
<h2><center>Edit Aset Model</center><span class="label label-default"></span></h2>
 
	<div class="sign-up-row widget-shadow">
				
				<form class="form-horizontal" method="POST" action="">
				<input class="form-control" type="hidden" name="id" id="id" value="<?php echo $data['id_model'];?>">
					<div class="form-group">
						<label class="col-sm-3 control-label">
							<h4>Nama Model :</h4>
						</label>
						<div class="col-md-7 col-sm-12 required">
							<input class="form-control" type="text" name="nama" id="nama" value="<?php echo $data['nama_model'];?>">
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">
							<h4>Tahun Model :</h4>
						</label>
						<div class="col-md-7 col-sm-12 required">
							<div class="input-group year col-md-5">
                                    <input type="text" class="form-control datepicker" placeholder="Tahun" name="tahun" id="tahun" value="<?php echo $data['tahun_model'];?>" required>
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
							<input class="form-control" type="text" name="jenis" id="jenis" value="<?php echo $data['jenis_aset_model'];?>">
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">
							<h4>Jumlah :</h4>
						</label>
						<div class="col-md-7 col-sm-12 required">
							<input class="form-control" type="number" name="qty" id="qty" value="<?php echo $data['qty'];?>">
						</div>
						<div class="clearfix"> </div>
					</div>  
					<div class="form-group">
						<div class="col-sm-offset-8 col-sm-5">
						<button type="submit" class="btn btn-primary  btn-sm"   name="simpan" id="simpan">Simpan</button>
						<a href="<?php echo $mod;?>" class="btn btn-primary btn-sm">Kembali</a>  
						</div>
						<div class="clearfix"> </div>
					</div>
				</form>
 
</div>  