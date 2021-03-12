<?php  
	$nik= $_POST['nik'];
	$data =mysqli_fetch_array(mysqli_query($conn,"SELECT data_karyawan.*,data_karyawan.kd_uker as kd_uker_karyawan, data_uker.kd_uker as kd_dep, 
										data_uker.nama_uker as departemen, data_uker_bagian.kd_bag as kd_bagian, data_uker_bagian.nama_bag as bagian
										FROM data_karyawan 
										Left join data_uker ON data_karyawan.kd_uker=data_uker.kd_uker
										Left join data_uker_bagian ON data_karyawan.kd_bag=data_uker_bagian.kd_bag 
										WHERE nik='$nik'"));	
			 
				$back='<form action="detail" method="post">
								<a name="tes" href="javascript:" onclick="parentNode.submit();" class="btn btn-primary">Back</a>
								<input type="hidden" name="karyawan-detail" value="'.$nik.'"/>
							
						</form>';
		 					
			
?>
<div id="webui">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="box box-default">
				<div class="box-header with-border">
						<h2 class="box-title"><b>Aset didaftarkan ke - <?php echo $data['nama_karyawan'];?></b></h2>
						<div class="box-tools pull-right">
							<?php echo $back; ?>
								
						</div>
					</div> <!-- /.box-header -->
					<div class="box-body">
						<form id="create-form" class="form-horizontal" method="post" action="" role="form" enctype="multipart/form-data">
						   
							<input  type="hidden" name="karyawan" id="karyawan" value="<?php echo $data['nik'];?>" />
							<div class="form-group ">
								<label for="name" class="col-md-3 control-label">No Aset</label>
								<div class="col-md-7 col-sm-12 required"> 
									<select class="form-control selectpicker" data-live-search="true"  title="Pilih Aset" name="no_aset" id="no_aset"  required  >
										 <option value=""></option>
										<?php 
											$res = $conn->query("SELECT * FROM data_aset where lokasi='DI TI'");
											while($row = $res->fetch_assoc()){
												echo '
													<option value="'.$row['no'].'"> '.$row['no_aset'].' - '.$row['model']. ' </option>
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
												$res = $conn->query("SELECT * FROM data_aset 
																		LEFT JOIN status_labels ON data_aset.status=status_labels.id
																		where kd_kategori='CM' and lokasi='DI TI'");
												while($row = $res->fetch_assoc()){
													echo '
														<option value="'.$row['no'].'"> '.$row['no_aset'].' - '.$row['model']. ' </option>
														';
													 
												}
													
												?>	
										</select>	
									</div>
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