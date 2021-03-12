
<?php 
if (isset($_POST['savecheckout'])){
	
	 
	$aset=explode("/",$_POST['no_aset']);
	$id_aset=$aset[0];
	$no_aset=$aset[1];
	  $kd_uker=$_POST['uker']; 
	  $nik=$_POST['karyawan']; 
	  $catatan=$_POST['catatan']; 
	  $id_monitor=$_POST['monitor'];
	  $aset_monitor=explode("/",$_POST['monitor']);
					$id_aset_monitor=$aset_monitor[0];
					$no_aset_monitor=$aset_monitor[1];
	  $tgl_keluar=$_POST['tgl_keluar'];
		
		
	 //log	  
	$sqllog = "INSERT INTO data_aset_logs  VALUES ('', '$id_aset', '$no_aset','Pendistribusian ke', '$nik','$catatan','$id_user','$tgl_keluar')";
	 $querylog	= mysqli_query($conn,$sqllog); 
	
	  
	$sql1 	= "UPDATE data_aset SET nik='$nik', kd_uker='$kd_uker', lokasi='DI USER',id_monitor='$id_aset_monitor'
	 ,checkout_date='$tgl_keluar',catatan='$catatan' 
	 WHERE no='$id_aset'"; 
	  $query	= mysqli_query($conn,$sql1);
	 
	   
	if ($id_monitor!=""){
		
		$sql2 	= "UPDATE data_aset SET nik='$nik', kd_uker='$kd_uker', lokasi='DI USER'
					,checkout_date='$tgl_keluar',catatan='$catatan'
					WHERE no='$id_aset_monitor'"; 
					
		 $query	= mysqli_query($conn,$sql2);
		 
		  //log
		 $sqllog = "INSERT INTO data_aset_logs  VALUES ('', '$id_aset_monitor', '$no_aset_monitor','Pendistribusian ke', '$nik','$catatan','$id_user','$tgl_keluar')";
			$querylog	= mysqli_query($conn,$sqllog);
		 
		} 
		
		$aset_replace=explode("/",$_POST['no_aset_replace']);
			$id_aset_replace=$aset_replace[0];
			$no_aset_replace=$aset_replace[1];
	if ($no_aset_replace!=""){
				
		$tgl_masuk=$_POST['tgl_masuk']; 
		$status=$_POST['status']; 
		$sql3 	= "UPDATE data_aset SET nik='', kd_uker='',lokasi='DI TI'
					,checkin_date='$tgl_masuk', status='$status'
					WHERE no='$id_aset_replace'"; 
		 $query	= mysqli_query($conn,$sql3);
		 
		 //log
		 $sqllog = "INSERT INTO data_aset_logs  VALUES ('', '$id_aset_replace', '$no_aset_replace','Pengembalian dari', '$nik','$catatan','$id_user','$tgl_keluar')";
			$querylog	= mysqli_query($conn,$sqllog);
		} 
	 
	$monitor_replace=explode("/",$_POST['id_monitor_replace']);
			$id_aset_monitor_replace=$monitor_replace[0];
			$no_aset_monitor_replace=$monitor_replace[1];
	if ($monitor_replace!=""){
		$tgl_masuk=$_POST['tgl_masuk'];		
		$status=$_POST['status_monitor']; 
		$sql4 	= "UPDATE data_aset SET nik='', kd_uker='',lokasi='DI TI'
					,checkin_date='$tgl_masuk', status='$status'
					WHERE no='$id_aset_monitor_replace'"; 
		 $query	= mysqli_query($conn,$sql4);
		 
		  //log
		 $sqllog = "INSERT INTO data_aset_logs  VALUES ('', '$id_aset_monitor_replace', '$no_aset_monitor_replace','Pengembalian dari', '$nik','$catatan','$id_user','$tgl_keluar')";
			$querylog	= mysqli_query($conn,$sqllog);
		} 
	
	
	 echo '<script>window.location="CheckOut"</script>'; 
	
 
}
?>
<div id="webui">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="box box-default">
					<div class="box-header with-border">
						<h2 class="box-title"><b>Check Asset Out</b></h2>
						 
					</div><!-- /.box-header -->
					<div class="box-body">
						<form id="create-form" class="form-horizontal" method="post" action="" role="form" enctype="multipart/form-data">
						   
							 
							<div class="form-group ">
								<label for="name" class="col-md-3 control-label">No Aset</label>
								<div class="col-md-7 col-sm-12 required"> 
									<select class="form-control selectpicker" data-live-search="true"  title="Pilih Aset" name="no_aset" id="no_aset"  required  >
										<option value=""></option>
										<?php 
											$res = $conn->query("SELECT * FROM data_aset where lokasi='DI TI'");
											while($row = $res->fetch_assoc()){
												echo '
													<option value="'.$row['no'].'/'.$row['no_aset'].'"> '.$row['no_aset'].' - '.$row['model']. ' </option>
													';
												 
											}
												
											?>	
									</select>									
									 
								</div>
							</div> 
							<div class="form-group ">
								<label for="model_number" class="col-md-3 control-label">Monitor</label>
								<div class="col-md-7">
									<input  type="checkbox" name="chekoutmonitor" id="chekoutmonitor"  onclick="ShowIfCheckedMonitoraktif()" />
									<div id="divCheckedMonitoraktif" style="display:none;">
										<select class="form-control selectpicker" data-live-search="true"  title="Pilih Monitor" name="monitor" id="monitor"    >
											 <option value=""></option>
											<?php 
												$res = $conn->query("SELECT * FROM data_aset where kd_kategori='CM' and lokasi='DI TI'");
												while($row = $res->fetch_assoc()){
													echo '
														<option value="'.$row['no'].'/'.$row['no_aset'].'"> '.$row['no_aset'].' - '.$row['model']. ' </option>
														';
													 
												}
													
												?>	
										</select>	
									</div>
								</div>
							</div>  
							<div class="form-group">
								<label  class="col-md-3 control-label">Karyawan</label>
								<div class="col-md-7 required">
									<select class="form-control selectpicker" data-live-search="true"  title="Pilih Karyawan" name="karyawan" id="karyawan"  required  >
										 <option value=""></option>
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
							</div> 
							<div class="form-group">
								<label  class="col-md-3 control-label">Unit Kerja</label>
								<div class="col-md-7 required">
									<select name="uker" id="uker" title="Pilih Unit Kerja" class="form-control  selectpicker" data-live-search="true"  required>
										  <option value=""></option>
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
							<div class="form-group ">
                            <label for="name" class="col-md-3 control-label">Tanggal</label>
                            <div class="col-md-9">
                                <div class="input-group date col-md-5" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                                    <input type="text" class="form-control" placeholder="Tanggal Keluar" name="tgl_keluar" id="tgl_keluar">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                                
                            </div>
                        </div>	
						<hr>
							   
							 
							<div class="form-group ">
								<label for="model_number" class="col-md-2 control-label">Penggantian</label>
								<div class="col-md-9">
								<input  type="checkbox" name="penggantian" id="penggantian"  onclick="ShowIfChecked()" />
									
								</div>
							</div>
							<div id="divChecked" style="display:none;">
							<div class="form-group ">
								<label for="name" class="col-md-3 control-label">No Aset</label>
								<div class="col-md-7 col-sm-12 required"> 
									<select class="form-control selectpicker" data-live-search="true"  title="Pilih Aset" name="no_aset_replace" id="no_aset_replace"    >
										 <option value=""></option>
										<?php 
											$res = $conn->query("SELECT * FROM data_aset where lokasi='DI USER'");
											while($row = $res->fetch_assoc()){
												echo '
													<option value="'.$row['no'].'/'.$row['no_aset'].'"> '.$row['no_aset'].' - '.$row['model']. ' </option>
													';
												 
											}
												
											?>	
									</select>									
									 
								</div>
							</div> 
								<div class="form-group">
									<label for="category_id" class="col-md-3 control-label">Status</label>
									<div class="col-md-7 required">
										<select onchange="TampilNotes(this.value)" class="form-control"   title="Pilih Aset" name="status" id="status" >
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
							 <hr>
						 <div class="form-group ">
								<label for="model_number" class="col-md-2 control-label">Monitor</label>
								<div class="col-md-9">
								<input  type="checkbox" name="penggantianmonitor" id="penggantianmonitor"  onclick="ShowIfCheckedMonitor()" />
									
								</div>
							</div>
						 <div id="divCheckedMonitor" style="display:none;">
								<div class="form-group ">
									<label for="model_number" class="col-md-3 control-label">No Aset</label>
									<div class="col-md-7"> 
									<select class="form-control selectpicker" data-live-search="true"  title="Pilih Monitor" name="id_monitor_replace" id="id_monitor_replace" >
											<option value=""></option>
											<?php 
												$res = $conn->query("SELECT * FROM data_aset where kd_kategori='CM' and lokasi='DI USER'");
												while($row = $res->fetch_assoc()){
													echo '
														<option value="'.$row['no'].'/'.$row['no_aset'].'"> '.$row['no_aset'].' - '.$row['model']. ' </option>
														';
													 
												}
													
												?>	
										</select>	
									</div>
								</div>
								
								<div class="form-group">
									<label for="category_id" class="col-md-3 control-label">Status</label>
									<div class="col-md-7 required">
										<select onchange="TampilNotes(this.value)" class="form-control"  placeholder="Pilih Status" name="status_monitor" id="status_monitor" >
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
								</div><hr> 
							<div class="form-group ">
                            <label for="name" class="col-md-3 control-label">Tanggal</label>
                            <div class="col-md-9">
                                <div class="input-group date col-md-5" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                                    <input type="text" class="form-control" placeholder="Tanggal Pengembalian" name="tgl_masuk" id="tgl_masuk">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                                
                            </div>
                        </div>
							</div> <hr>
							<div class="form-group ">
								<label for="name" class="col-md-3 control-label">Catatan</label>
								<div class="col-md-7 col-sm-12 required">
									<textarea class="form-control" type="text" name="catatan" id="catatan" ></textarea>
									 
								</div>
							</div>						
							<div class="box-footer text-right"> 
								<button type="submit" name="savecheckout" id="savecheckout" class="btn btn-success"><i class="fa fa-check icon-white"></i> Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>

		</div>
	</div>