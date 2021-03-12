<?php 
	 
$id=$_POST['nik']; 
$showkaryawan =mysqli_fetch_array(mysqli_query($conn,"SELECT  data_karyawan.*, data_karyawan.kd_uker as kd_uker_karyawan, data_uker.kd_uker as kd_dep, 
									data_uker.nama_uker as departemen, data_uker_bagian.kd_bag as kd_bagian, data_uker_bagian.nama_bag as bagian 
									FROM  data_karyawan 
									Left join data_uker ON  data_karyawan.kd_uker=data_uker.kd_uker
									Left join data_uker_bagian ON  data_karyawan.kd_bag=data_uker_bagian.kd_bag
									WHERE nik= '$id'")); 
	 
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
										<option selected value="<?php echo $showkaryawan['kd_dep'];?>"> <?php echo $showkaryawan['departemen'];?> </option>
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
										<option value="<?php echo $showkaryawan['kd_bag'];?>"> <?php echo $showkaryawan['bagian'];?> </option>
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
 
 