<?php 

if (isset($_POST['editkaryawan']))
{
  
 
 
 $id=$_POST['nik']; 
$showkaryawan =mysqli_fetch_array(mysqli_query($conn,"SELECT  * FROM  data_karyawan  WHERE nik= '$id'")); 
		 
?>

	<div class="col-md-8 col-md-offset-2">
				<div class="box box-default">
					<div class="box-header with-border">
						<h2 class="box-title"><b>Edit Karyawan</b></h2>
						<div class="box-tools pull-right">
							<a href="<?php if(isset($_SERVER['HTTP_REFERER'])){ echo $_SERVER['HTTP_REFERER']; } ?>"  class="btn btn-success">Batal</a>
						</div>
					</div><!-- /.box-header -->
					<div class="box-body">
						<form id="create-form" class="form-horizontal" method="post" action="" role="form" enctype="multipart/form-data">
						 <div class="form-group ">
								<label for="name" class="col-md-3 control-label">Tipe Karyawan</label>
								<div class="col-md-7 col-sm-12 required">
									<input type="radio" name="tipe" id="tipe" value="organik" <?php if($showkaryawan['organik']=='organik') echo "checked"; ?> >Organik </input>	&nbsp;	&nbsp;
									<input type="radio" name="tipe" id="tipe" value="non-organik" <?php if($showkaryawan['organik']=='non-organik') echo "checked"; ?>>Non Organik </input>
								</div>
							</div>	
							<!-- Name -->
							<div class="form-group ">
								<label for="name" class="col-md-3 control-label">NIK</label>
								<div class="col-md-7 col-sm-12 required">
									<input class="form-control" type="text" name="nik" id="nik" value="<?php echo $showkaryawan['nik'];?>" />
									<input class="form-control" type="hidden" name="nik2" id="nik2" value="<?php echo $showkaryawan['nik'];?>" /> 
								</div>
							</div>
							<!-- Name -->
							<div class="form-group ">
								<label for="name" class="col-md-3 control-label">Nama</label>
								<div class="col-md-7 col-sm-12 required">
									<input class="form-control" type="text" name="nama" id="nama" value="<?php echo $showkaryawan['nama_karyawan'];?>" /> 
								</div>
							</div> 
							<!-- email -->
							<div class="form-group ">
								<label for="name" class="col-md-3 control-label">E-Mail</label>
								<div class="col-md-7 col-sm-12 required">
									<input class="form-control" type="email" name="email" id="email" value="<?php echo $showkaryawan['email'];?>" /> 
								</div>
							</div> 
							<!-- tlp -->
							<div class="form-group ">
								<label for="name" class="col-md-3 control-label">Telp (Extension)</label>
								<div class="col-md-7 col-sm-12 required">
									<input class="form-control" type="number" name="tlp" id="tlp" value="<?php echo $showkaryawan['tlp'];?>" /> 
								</div>
							</div> 
							<!-- Departemen -->
							<div class="form-group">
								<label for="category_id" class="col-md-3 control-label">Departemen</label>
								<div class="col-md-7 required">
									<select class="form-control selectpicker" data-live-search="true"  title="Pilih Departemen" name="departemen" id="departemen">
										<option selected value="<?php echo $showkaryawan['dep'];?>"> <?php echo $showkaryawan['dep'];?> </option>
										<?php 
											$res = $conn->query("SELECT * FROM data_uker");
											while($row = $res->fetch_assoc()){
												echo '
													<option value="'.$row['kd_uker'].'"> '.$row['nama_uker']. ' </option>
													';
											}
											?>	
									</select>
								</div> 
							</div>  
							<!-- Bagian -->
							
							<div class="form-group">
								<label for="category_id" class="col-md-3 control-label">Bagian</label>
								<div class="col-md-7 required">
									<select class="form-control"  title="Pilih Bagian" name="bagian" id="bagian">
										<option value="<?php echo $showkaryawan['kd_uker'];?>"> <?php echo $showkaryawan['nama_unitkerja'];?> </option>
									</select>
								</div> 
							</div>   
							<!-- Foto --> 
							<div class="form-group ">
								<label for="name" class="col-md-3 control-label">Foto</label>
								<div class="col-md-7 col-sm-12 required">
						 
							 
						<?php if ($showkaryawan['img']==""){$poto="default-sm.png";}else{$poto=$showkaryawan['img'];} ?>
								<div id="preview_gambar">
									  <img id="preview" src="images/karyawan/<?php echo $poto; ?>" class="avatar img-circle hidden-print" style="width:100px;">
								</div>
							  <input class="form-control" type="file" name="foto" id="foto" value=" " onchange="tampilkanPreview(this,'preview')"/> 
                          </div>
							</div>
							<div class="box-footer text-right">
								
								<button type="submit" name="saveeditkaryawan" id="saveeditkaryawan" class="btn btn-success"><i class="fa fa-check icon-white"></i> Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>
 
 <?php
 }

if (isset($_POST['saveeditkaryawan'])){ 
	 
	$tipe=$_POST['tipe'];
	 $nik2=$_POST['nik2'];
	 $nik=$_POST['nik'];
	$nama=$_POST['nama'];
	 $email=$_POST['email'];
	 $tlp=$_POST['tlp'];
	 
	$departemen=$_POST['departemen']; 
	$kd_bag=$_POST['bagian'];
		
		if (empty($kd_bag)){
			
				$unitkerja =mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM  data_uker WHERE kd_uker= '$departemen'")); 
			$bag=$unitkerja['nama_uker']; 
			$dep=$unitkerja['nama_uker'];
		}else if (isset($kd_uker)){
			 $karyawana =mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM data_karyawan WHERE nik= '$nik2'")); 
            $kd_uker=$karyawana['kd_uker']; 								
			$bag=$karyawana['nama_unetkerja'];
			$dep=$karyawana['dep'];
		}else{
			$unitkerja =mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM data_uker_bagian 
								LEFT JOIN data_uker ON data_uker_bagian.kd_uker=data_uker.kd_uker
								WHERE kd_bag= '$kd_bag'")); 
            $kd_uker=$unitkerja['kd_bag']; 								
			$bag=$unitkerja['nama_bag']; 
			$dep=$unitkerja['nama_uker'];
		}
		 
	 
		$foto = $_FILES['foto']['name'];
		$data =mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM data_karyawan WHERE nik= '$nik'")); 
	 if (empty($foto)){ 
		if(is_file("images/karyawan/".$data['img'])) // Jika foto ada
					  unlink("images/karyawan/".$data['img']); // Hapus file foto sebelumnya yang ada di folder images
		  $sql 	= "UPDATE data_karyawan SET nik='$nik', nama_karyawan='$nama',email='$email', tlp='$tlp', img='', 
						 kd_uker='$kd_uker',nama_unitkerja='$bag' ,dep='$dep',organik='$tipe' 
						 WHERE nik='$nik2'";
			 
				 
	 }else{
		 
			 $foto = $_FILES['foto']['name'];
			$tmp = $_FILES['foto']['tmp_name'];
			$type=explode(".",$foto);
			
				   
				if(is_file("images/karyawan/".$data['img'])) // Jika foto ada
					  unlink("images/karyawan/".$data['img']); // Hapus file foto sebelumnya yang ada di folder images

				  
			 
				$fotobaru =$nik.'.'.$type[1];
				 
				$path = "images/karyawan/".$fotobaru;
			 
				if(move_uploaded_file($tmp, $path)){ // Cek apakah gambar berhasil diupload atau tidak
					
				 $sql 	= "UPDATE data_karyawan SET nik='$nik', nama_karyawan='$nama',email='$email', tlp='$tlp', img='$fotobaru', 
						 kd_uker='$kd_uker',nama_unitkerja='$bag' ,dep='$dep',organik='$tipe' 
						 WHERE nik='$nik2'"; 
		 
				 }else{
				  
				  echo "Maaf, Gambar gagal untuk diupload.";
				  
				}
			 
	 }
	 $query	= mysqli_query($conn,$sql); 

		  if($query){ 
			  echo '<script>window.location="'.$tipe.'?nik='.$nik.'"</script>'; 
		  }else{
			// Jika Gagal, Lakukan :
			echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
			 echo '<script>window.location="'.$tipe.'?nik='.$nik.'"</script>'; 
			
		}

  
}
 if (isset($_POST['hapuskaryawan'])){ 

 $nik= $_POST['nik'];
 $sql 	= 'delete from data_karyawan where nik="'.$nik.'"'; 
	 
	 $query	= mysqli_query($conn,$sql);
	  echo '<script>window.location="organik"</script>';
}	
 ?>