<?php 
if (isset($_POST['saveregitrasiaset'])){
	
	  $no_aset=$_POST['no_aset']; 
	  $tahun=$_POST['tahun']; 
	  $kd_kategori=$_POST['kategori']; 
	  $model=$_POST['model']; 
	  $sn=$_POST['sn']; 
	  $ip_address=$_POST['ip']; 
	  $os=$_POST['os']; 
	  $proc=$_POST['proc']; 
	  $ramhd=$_POST['ramhd'];
	  $vga=$_POST['vga']; 
	  $pemasok=$_POST['pemasok']; 
	  $kd_uker=$_POST['uker']; 
	  $nik=$_POST['karyawan']; 
	  $catatan=$_POST['catatan'];
	  $po=$_POST['po'];
	  $tglpo=$_POST['tglpo']; 
	  $harga=$_POST['harga'];
	  if ($_POST['karyawan']==""){$checkout_date=""; $lokasi="DI TI";}else{$checkout_date=$created_at;  $lokasi="DI USER";}
	  
	  $id_monitor=$_POST['id_monitor'];
	   $status=$_POST['status'];
	   
		if (isset($_POST['id_monitor'])) {
			 
		    $sql= "UPDATE data_aset SET  id_sup='$pemasok', kd_uker='$kd_uker', nik='$nik', po='$po',
			tgl_po='$tglpo', lokasi='$lokasi',created_at='$created_at', sewa='$sewa',catatan='$catatan',
			tahun='$tahun',admin='$id_user',status='$status'
			WHERE no='$id_monitor'";
			 $query	= mysqli_query($conn,$sql);
		 
		}  
	  
	  
	 
	$sql = "INSERT INTO data_aset VALUES ('','$no_aset','$tahun','$kd_kategori',
	'$model','$sn','$ip_address','$os','$proc','$ramhd','$vga','$kd_uker','$nik','$lokasi','$pemasok',
	'$sewa','$po','$tglpo','$harga','$created_at','','','','','','$id_monitor',
	'$checkout_date','','$catatan','$id_user','$status')";
	 $query	= mysqli_query($conn,$sql);

	
	 
 
 echo '<script>window.location="All"</script>'; 
}
 
if ($mod='registrasiaset'){
	
?>	
	
<section class="content">
<!-- Content -->
    <div id="webui">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="box box-default">
					<div class="box-header with-border">
						<h2 class="box-title"><b>Registrasi Asset</b></h2>
						 
					</div><!-- /.box-header -->
					<div class="box-body">
						<form id="create-form" class="form-horizontal" method="post" action="" role="form" enctype="multipart/form-data">
						  
							<div class="form-group">
								<label  class="col-md-3 control-label">Kategori</label>
								<div class="col-md-7 required">
									<select onchange="change()" class="form-control" data-live-search="true"  title="Pilih Kategori" name="kategori" id="kategori"   required>
										<option >  </option>
										<?php 
											$res = $conn->query("SELECT * FROM data_kategori");
											while($row = $res->fetch_assoc()){
												echo '
													<option value="'.$row['kd_kategori'].'"> '.$row['nama_kategori']. ' </option>
													';
												 
											}
												
											?>	
									</select>
								</div>
							</div> 
							<div class="form-group ">
								<label for="name" class="col-md-3 control-label">No Aset</label>
								<div class="col-md-7 col-sm-12 required">
									<input class="form-control" type="text" name="no_aset" id="no_aset"/>	
									 
								</div>
							</div>
							<div class="form-group ">
								<label for="name" class="col-md-3 control-label">No PO</label>
								<div class="col-md-7 col-sm-12 required">
									<input class="form-control" type="text" name="po" id="po"/>	
									 
								</div>
							</div>
							<div class="form-group ">
								<label for="name" class="col-md-3 control-label">Tanggal PO</label>
								<div class="col-md-7 col-sm-12 required">
									<div class="input-group col-md-5">
                                    <input type="text" class="form-control tglpicker" placeholder="date"  name="tglpo" id="tglpo" value="" required>
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>  
									 
								</div>
							</div>
							
							<div class="form-group ">
								<label for="name" class="col-md-3 control-label">Harga</label>
								<div class="col-md-3 col-sm-12 required">
									<div class="input-group">
										<input class="form-control" type="number" name="harga" id="harga"  />
										<span class="input-group-addon">
												<i  class="fa fa ">IDR</i>
										</span>
									</div>
								</div>
							</div>
							  
							<div class="form-group ">
								<label for="model_number" class="col-md-3 control-label">Tahun</label>
								<div class="col-md-7">
								<div class="input-group year col-md-5">
                                    <input type="text" class="form-control datepicker" placeholder="Tahun" name="tahun" id="tahun" required>
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>  
								</div>
							</div>  
							<div class="form-group ">
								<label for="model_number" class="col-md-3 control-label">Model</label>
								 
								<div class="col-md-7 required">
									<select class="form-control select2" data-live-search="true"  title="Pilih Model" name="model" id="model">
										<option >  </option>
										<?php 
											$res = $conn->query("SELECT model FROM data_aset GROUP BY model");
											while($row = $res->fetch_assoc()){
												echo '
													<option value="'.$row['model'].'"> '.$row['model']. ' </option>
													';
												 
											}
												
											?>	
									</select>
								</div>
								
								<div class="col-md-1 panel-grids"> 
									<button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#popmodel" data-whatever="@mdo">Baru</button>
								</div>
							</div> 
							<div class="form-group ">
								<label for="model_number" class="col-md-3 control-label">Asset Tag (S/N).</label>
								<div class="col-md-7">
								<input class="form-control" type="text" name="sn" id="sn"  required />
									
								</div>
							</div>
							<div id="divos" style="display:none;">
							<div class="form-group ">
								<label for="model_number" class="col-md-3 control-label">Ip Address</label>
								<div class="col-md-7">
								<input class="form-control" type="text" name="ip" id="ip"   />
									
								</div>
							</div>
							<div class="form-group "  >
								<label for="model_number" class="col-md-3 control-label">OS</label>
								<div class="col-md-7">
								<input class="form-control" type="text" name="os" id="os"  />
									
								</div>
							</div>
							<div class="form-group ">
								<label for="model_number" class="col-md-3 control-label">Processor</label>
								<div class="col-md-7">
								<input class="form-control" type="text" name="proc" id="proc"  />
									
								</div>
							</div> 
							<div class="form-group ">
								<label for="model_number" class="col-md-3 control-label">RAM dan HDD</label>
								<div class="col-md-7">
								<input class="form-control" type="text" name="ramhd" id="ramhd"  />
									
								</div>
							</div>
							<div class="form-group ">
								<label for="model_number" class="col-md-3 control-label">VGA External</label>
								<div class="col-md-7">
								<input class="form-control" type="text" name="vga" id="vga"  />
									
								</div>
							</div></div>
							<div class="form-group">
								<label  class="col-md-3 control-label">Pemasok</label>
								<div class="col-md-7 required">
									<select class="form-control select2" data-live-search="true"  title="Pilih Pemasok" name="pemasok" id="pemasok">
										<option >  </option>
										<?php 
											$res = $conn->query("SELECT * FROM data_pemasok");
											while($row = $res->fetch_assoc()){
												echo '
													<option value="'.$row['id_sup'].'"> '.$row['nama_sup']. ' </option>
													';
												 
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
								<label for="category_id" class="col-md-3 control-label">Status</label>
								<div class="col-md-7 required">
									 
									<select onchange="TampilNotes(this.value)" onclick="changeValue(this.value)"   class="form-control"  title="Pilih Status" name="status" id="status"   required>
									<option value=" "> Pilih Status </option>
									  
										<?php 
								   $res = $conn->query("SELECT * FROM status_labels  WHERE name NOT LIKE '%scrab%'");   
									$jsArray = "var dtstatus = new Array();\n";        
								   while($row = $res->fetch_assoc()){    
										echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';    
										$jsArray .= "dtstatus['" . $row['id'] . "'] = {deployable:'".addslashes($row['deployable'])."'};\n";    
									}      
									?>    
										</select>															 
										<input  type="hidden" name="jrsn" id="jrsn"/>
									 <a id="tampilnote"></a>
						 
								</div>  
							</div> 
						 
							<div  id="divstatus" style="display:none;" class="form-group">
								<label  class="col-md-3 control-label">Karyawan</label>
								<div class="col-md-7 required">
									<select class="form-control select2" style="width: 100%" name="karyawan" id="karyawan">
										<option >  </option>
										<?php 
											$res = $conn->query("SELECT * FROM data_karyawan");
											while($row = $res->fetch_assoc()){
												echo '
													<option value="'.$row['nik'].'">'.$row['nik'].' - '.$row['nama_karyawan']. ' </option>
													';
												 
											}
											
												
											?>	
									</select>
								</div> 
								<div class="col-md-1 panel-grids"> 
									<button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#popnewkaryawan" data-whatever="@mdo">Baru</button>
								</div>
								<div class="clearfix"> </div>
						 
								<label  class="col-md-3 control-label">Unit Kerja</label>
								<div class="col-md-7 required">
									<select name="uker" id="uker" style="width: 100%" class="form-control select2">
										 <option >  </option>
										<?php 
											$res = $conn->query("SELECT * FROM data_uker");
											while($row = $res->fetch_assoc()){
										?>	<optgroup label="<?php echo $row['nama_uker'];?>">
										
												<option value="<?php echo $row['kd_uker']; ?>"><?php echo $row['nama_uker'];?></option>
													<?php 
														$kduker=$row['kd_uker'];
														$res1 = $conn->query("SELECT * FROM data_uker_bagian where kd_uker='$kduker'");
														
														while($row1 = $res1->fetch_assoc()){
													?>	 
															<option value="<?php echo $row1['kd_bag']; ?>"><?php echo $row1['nama_bag'];?></option>
															 
													<?php } ?>
											</optgroup>
										<?php } ?>
									</select> 
								</div>
							</div> 
							 
							
							<div id="divmonitor" style="display:none;">
								<div class="form-group ">
									<label for="model_number" class="col-md-3 control-label">No Aset Monitor</label>
									<div class="col-md-7"> 
									<select class="form-control select2" name="id_monitor" id="id_monitor" style="width: 100%">
											<option >  </option>
											<?php 
												$res = $conn->query("SELECT * FROM data_aset where kd_kategori='CM'");
												while($row = $res->fetch_assoc()){
													echo '
														<option value="'.$row['no_aset'].'"> '.$row['no_aset'].' - '.$row['model']. ' </option>
														';
													 
												}
													
												?>	
										</select>	
									</div>
									<div class="col-md-1 panel-grids"> 
									<button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#popMonitor" data-whatever="@mdo">Baru</button>
								</div>
								</div>
							</div> 
							<div class="form-group ">
								<label for="name" class="col-md-3 control-label">Catatan</label>
								<div class="col-md-7 col-sm-12 required">
									<textarea class="form-control" type="text" name="catatan" id="catatan" ></textarea>
									 
								</div>
							</div>						
							<div class="box-footer text-right"> 
								<button type="submit" name="saveregitrasiaset" id="saveregitrasiaset" class="btn btn-success"><i class="fa fa-check icon-white"></i> Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>

				 
		</div>
	</div>
<?php
}if (isset($_POST['registrasiaset'])){
	
?>	
	
<section class="content">
<!-- Content -->
    <div id="webui">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="box box-default">
					<div class="box-header with-border">
						<h2 class="box-title"><b>Registrasi Asset</b></h2>
						 
					</div><!-- /.box-header -->
					<div class="box-body">
						<form id="create-form" class="form-horizontal" method="post" action="" role="form" enctype="multipart/form-data">
						  
							<div class="form-group">
								<label  class="col-md-3 control-label">Kategori</label>
								<div class="col-md-7 required">
									<select onchange="change()" class="form-control select2" data-live-search="true"  title="Pilih Kategori" name="kategori" id="kategori"   required>
										
										<?php 
											$res = $conn->query("SELECT * FROM data_kategori");
											while($row = $res->fetch_assoc()){
												echo '
													<option value="'.$row['kd_kategori'].'"> '.$row['nama_kategori']. ' </option>
													';
												 
											}
												
											?>	
									</select>
								</div>
							</div> 
							<div class="form-group ">
								<label for="name" class="col-md-3 control-label">No Aset</label>
								<div class="col-md-7 col-sm-12 required">
									<input class="form-control" type="text" name="no_aset" id="no_aset"/>	
									 
								</div>
							</div>
							<div class="form-group ">
								<label for="name" class="col-md-3 control-label">No PO</label>
								<div class="col-md-7 col-sm-12 required">
									<input class="form-control" type="text" name="po" id="po"/>	
									 
								</div>
							</div>
							<div class="form-group ">
								<label for="name" class="col-md-3 control-label">Tanggal PO</label>
								<div class="col-md-7 col-sm-12 required">
									<div class="input-group date col-md-5">
                                    <input type="date" class="form-control"   name="tglpo" id="tglpo" value="" required>
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>  
									 
								</div>
							</div>
							
							<div class="form-group ">
								<label for="name" class="col-md-3 control-label">Harga</label>
								<div class="col-md-7 col-sm-12 required">
									<div class="input-group">
										<input class="form-control" type="number" name="harga" id="harga"  />
										<span class="input-group-addon">
												<i  class="fa fa ">IDR</i>
										</span>
									</div>
								</div>
							</div>
							  
							<div class="form-group ">
								<label for="model_number" class="col-md-3 control-label">Tahun</label>
								<div class="col-md-7">
								<div class="input-group year col-md-5">
                                    <input type="text" class="form-control datepicker" placeholder="Tahun" name="tahun" id="tahun" required>
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>  
								</div>
							</div>  
							<div class="form-group ">
								<label for="model_number" class="col-md-3 control-label">Model</label>
								<div class="col-md-7">
								<input class="form-control" type="text" name="model" id="model" required  />
									
								</div>
							</div> 
							<div class="form-group ">
								<label for="model_number" class="col-md-3 control-label">Asset Tag (S/N).</label>
								<div class="col-md-7">
								<input class="form-control" type="text" name="sn" id="sn"  required />
									
								</div>
							</div>
							<div id="divos" style="display:none;">
							<div class="form-group ">
								<label for="model_number" class="col-md-3 control-label">Ip Address</label>
								<div class="col-md-7">
								<input class="form-control" type="text" name="ip" id="ip"   />
									
								</div>
							</div>
							<div class="form-group "  >
								<label for="model_number" class="col-md-3 control-label">OS</label>
								<div class="col-md-7">
								<input class="form-control" type="text" name="os" id="os"  />
									
								</div>
							</div>
							<div class="form-group ">
								<label for="model_number" class="col-md-3 control-label">Processor</label>
								<div class="col-md-7">
								<input class="form-control" type="text" name="proc" id="proc"  />
									
								</div>
							</div> 
							<div class="form-group ">
								<label for="model_number" class="col-md-3 control-label">RAM dan HDD</label>
								<div class="col-md-7">
								<input class="form-control" type="text" name="ramhd" id="ramhd"  />
									
								</div>
							</div>
							<div class="form-group ">
								<label for="model_number" class="col-md-3 control-label">VGA External</label>
								<div class="col-md-7">
								<input class="form-control" type="text" name="vga" id="vga"  />
									
								</div>
							</div></div>
							<div class="form-group">
								<label  class="col-md-3 control-label">Pemasok</label>
								<div class="col-md-7 required">
									<select class="form-control select2" data-live-search="true"  title="Pilih Karyawan" name="pemasok" id="pemasok">
										
										<?php 
											$res = $conn->query("SELECT * FROM data_pemasok");
											while($row = $res->fetch_assoc()){
												echo '
													<option value="'.$row['id_sup'].'"> '.$row['nama_sup']. ' </option>
													';
												 
											}
												
											?>	
									</select>
								</div>
								
								<div class="col-md-1 panel-grids"> 
									<button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#popsupplier" data-whatever="@mdo">Baru</button>
								</div>
							</div>
							<div class="form-group ">
								<label for="model_number" class="col-md-3 control-label">Sewa</label>
								<div class="col-md-7">
								<input  type="checkbox" name="sewa" id="sewa" value="1"/>
									
								</div>
							</div>
							<div class="form-group">
								<label for="category_id" class="col-md-3 control-label">Status</label>
								<div class="col-md-7 required">
									 
									<select onchange="TampilNotes(this.value)" onclick="changeValue(this.value)"   class="form-control"  title="Pilih Status" name="status" id="status"   required>
									
									  
										<?php 
								   $res = $conn->query("SELECT * FROM status_labels ");   
									$jsArray = "var dtstatus = new Array();\n";        
								   while($row = $res->fetch_assoc()){    
										echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';    
										$jsArray .= "dtstatus['" . $row['id'] . "'] = {deployable:'".addslashes($row['deployable'])."'};\n";    
									}      
									?>    
										</select>															 
										<input  type="hidden" name="jrsn" id="jrsn"/>
									 <a id="tampilnote"></a>
						 
								</div> 
							</div> 
							<div id="divstatus" style="display:none;">
							<div class="form-group">
								<label  class="col-md-3 control-label">Karyawan</label>
								<div class="col-md-7 required">
									<select class="form-control select2" data-live-search="true"  title="Pilih Karyawan" name="karyawan" id="karyawan"    >
										
										<?php 
											$res = $conn->query("SELECT * FROM data_karyawan");
											while($row = $res->fetch_assoc()){
												echo '
													<option value="'.$row['nik'].'"> '.$row['nama_karyawan']. ' </option>
													';
												 
											}
												
											?>	
									</select>
								</div>
								<div class="col-md-1 panel-grids"> 
									<button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#popnewkaryawan" data-whatever="@mdo">Baru</button>
								</div>
							</div> 
							<div class="form-group">
								<label  class="col-md-3 control-label">Unit Kerja</label>
								<div class="col-md-7 required">
									<select name="uker" id="uker" title="Pilih Unit Kerja" class="form-control  select2" data-live-search="true"  >
										 
										<?php 
											$res = $conn->query("SELECT * FROM data_uker");
											while($row = $res->fetch_assoc()){
										?>	<optgroup label="<?php echo $row['nama_uker'];?>">
										
												<option value="<?php echo $row['kd_uker']; ?>"><?php echo $row['nama_uker'];?></option>
													<?php 
														$kduker=$row['kd_uker'];
														$res1 = $conn->query("SELECT * FROM data_uker_bagian where kd_uker='$kduker'");
														
														while($row1 = $res1->fetch_assoc()){
													?>	 
															<option value="<?php echo $row1['kd_bag']; ?>"><?php echo $row1['nama_bag'];?></option>
															 
													<?php } ?>
											</optgroup>
										<?php } ?>
									</select> 
								</div>
							</div> 
							</div>
							
							<div id="divmonitor" style="display:none;">
								<div class="form-group ">
									<label for="model_number" class="col-md-3 control-label">No Aset Monitor</label>
									<div class="col-md-7"> 
									<select class="form-control select2" data-live-search="true"  title="Pilih Monitor" name="id_monitor" id="id_monitor" >
											
											<?php 
												$res = $conn->query("SELECT * FROM data_aset where kd_kategori='CM'");
												while($row = $res->fetch_assoc()){
													echo '
														<option value="'.$row['no_aset'].'"> '.$row['no_aset'].' - '.$row['model']. ' </option>
														';
													 
												}
													
												?>	
										</select>	
									</div>
								</div>
							</div> 
							<div class="form-group ">
								<label for="name" class="col-md-3 control-label">Catatan</label>
								<div class="col-md-7 col-sm-12 required">
									<textarea class="form-control" type="text" name="catatan" id="catatan" ></textarea>
									 
								</div>
							</div>						
							<div class="box-footer text-right"> 
								<button type="submit" name="saveregitrasiaset" id="saveregitrasiaset" class="btn btn-success"><i class="fa fa-check icon-white"></i> Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>

				<div class="slideout-menu" id="help">
				<a href="#" class="slideout-menu-toggle pull-right">×</a>
				<h3>
					About Asset Models
				</h3>
				<p>Asset Models are a way to group identical assets. &quot;MBP 2013&quot;, &quot;IPhone 6s&quot;, etc. </p>
			</div>
  
		</div>
	</div>
<?php
}

if (isset($_POST['saveok'])){
	
	  $no_aset=$_POST['asset_name']; 
	  $sn=$_POST['sn']; 
	  $model_id=$_POST['model_id']; 
	  $assigned_to=$_POST['nik'];
	  $status=$_POST['status']; 
	  $lokasi=$_POST['lokasi']; 
	   if ($_POST['nik']==""){$checkout_date=""; }else{$checkout_date=$created_at; }
	 
	$sql = "INSERT INTO 1assets VALUES ('','$no_aset','$sn','$model_id',
	'$assigned_to','$id_user','$created_at','$status','$created_at','$checkout_date','$lokasi')";
	// echo $sql;
	$query	= mysqli_query($conn,$sql);
 

 echo '<script>window.location="models"</script>'; 
}

if (isset($_GET['model'])){ 
$idmodel=$_GET['model'] ;
$showmodel =mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM 1models WHERE id = '$idmodel'")); 
 
?> 

<section class="content">
<!-- Content -->
    <div id="webui">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="box box-default">
					<div class="box-header with-border">
						<h2 class="box-title"><b>Registrasi Asset</b></h2>
						<div class="box-tools pull-right">
								 <a href="models" class="btn btn-primary">Back</a>
						</div>
					</div><!-- /.box-header -->
					<div class="box-body">
						<form id="create-form" class="form-horizontal" method="post" action="" role="form" enctype="multipart/form-data">
							<!-- Name -->
							<div class="form-group ">
								<label for="name" class="col-md-3 control-label">Asset Model Name</label>
								<div class="col-md-7 col-sm-12 required">
									<input class="form-control" type="text" name="id_model" id="name" readonly value="<?php echo $showmodel['name'].' #'.$showmodel['order_number'];?>" />	
									<input class="form-control" type="hidden" name="model_id" id="model_id" readonly value="<?php echo $showmodel['id'];?>" />
								</div>
							</div>
							 
							<!-- Asset Name -->
							<div class="form-group ">
								<label for="model_number" class="col-md-3 control-label">Asset Name.</label>
								<div class="col-md-7">
								<input class="form-control" type="text" name="asset_name" id="asset_name" required  />
									
								</div>
							</div>
							<!-- Servis Tag -->
							<div class="form-group ">
								<label for="model_number" class="col-md-3 control-label">Asset Tag (S/N).</label>
								<div class="col-md-7">
								<input class="form-control" type="text" name="sn" id="sn"  required />
									
								</div>
							</div>
							<!-- Status -->
							<div class="form-group">
								<label for="category_id" class="col-md-3 control-label">Status</label>
								<div class="col-md-7 required">
									<select onchange="TampilNotes(this.value)" onclick="change()"   class="form-control"  placeholder="Pilih Status" name="status" id="status"   required>
										<option value=""></option>
										<?php 
											$res = $conn->query("SELECT * FROM status_labels");
											while($row = $res->fetch_assoc()){
												echo '
													<option value="'.$row['id'].'"> '.$row['name']. ' </option>
													';
												 
											}
												
											?>	
									</select>
									 <a id="tampilnote"></a>
						 
								</div> 
							</div> 
							<div id="divos" style="display:none;">
							<div class="form-group ">
								<label for="model_number" class="col-md-3 control-label">checkout to</label>
								<div class="col-md-7">
								<select title="Pilih Karyawan" name="nik" id="nik" class="form-control  select2" data-live-search="true">
									 	<?php
										$res = $conn->query("SELECT * FROM data_karyawan");
										while($row = $res->fetch_assoc()){
										echo '
											<option value="'.$row['nik'].'">'.$row['nik'].' - '.$row['nama_karyawan'].'</option>
										';
										 
										}
										?>
									</select>
								 
								</div> 
							</div>  
							<div  class="form-group" >
								<label for="assigned_location" class="col-md-3 control-label">Unit Kerja</label>
								<div class="col-md-7 required">
									<select title="Pilih Unit Kerja" name="lokasi" id="lokasi" class="form-control  select2" data-live-search="true">
										  
											 
										<?php 
											$res = $conn->query("SELECT * FROM data_uker");
											while($row = $res->fetch_assoc()){
										?>	<optgroup label="<?php echo $row['nama_uker'];?>">
										
												<option value="<?php echo $row['kd_uker']; ?>"><?php echo $row['nama_uker'];?></option>
													<?php 
														$kduker1=$row['kd_uker'];
														$res1 = $conn->query("SELECT * FROM data_uker_bagian where kd_uker='$kduker1'");
														
														while($row1 = $res1->fetch_assoc()){
													?>	 
															<option value="<?php echo $row1['kd_bag']; ?>"><?php echo $row1['nama_bag'];?></option>
															 
													<?php } ?>
											</optgroup>
										<?php } ?>
									</select>
								</div>
							</div>
							</div>
							<div class="box-footer text-right">
								<a class="btn btn-link text-left" href="models">Cancel</a>
								<button type="submit" name="saveok" id="saveok" class="btn btn-success"><i class="fa fa-check icon-white"></i> Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>

				<div class="slideout-menu" id="help">
				<a href="#" class="slideout-menu-toggle pull-right">×</a>
				<h3>
					About Asset Models
				</h3>
				<p>Asset Models are a way to group identical assets. &quot;MBP 2013&quot;, &quot;IPhone 6s&quot;, etc. </p>
			</div>
  
		</div>
	</div>
<?php
}
?>
  
</section>

 