<?php 
$id=$_GET['id']; 

$showaset =mysqli_fetch_array(mysqli_query($conn,"SELECT data_aset.*,data_aset.nik as tnik,data_aset.kd_uker as tuker, data_karyawan.*,data_uker.*
			,data_uker_bagian.*,data_kategori.*,status_labels.* FROM data_aset 
			Left join data_kategori ON data_aset.kd_kategori=data_kategori.kd_kategori
			Left join data_karyawan ON data_aset.nik=data_karyawan.nik
			Left join data_uker ON data_aset.kd_uker=data_uker.kd_uker
			Left join data_uker_bagian ON data_aset.kd_uker=data_uker_bagian.kd_bag
			LEFT JOIN status_labels ON data_aset.status=status_labels.id
			WHERE no= '$id'"));
if ($showaset['sewa']=="1"){$chek="checked";}else{$chek="";}
$id_monitor=$showaset['id_monitor'];			
$asetmonitor =mysqli_fetch_array(mysqli_query($conn,"SELECT no_aset,model FROM data_aset  WHERE no= '$id_monitor'")); 
			 if($showaset['nama_uker']=="")
			 {
				   $kdunitkerja=$showaset['kd_bag'];
				    $namaunitkerja=$showaset['nama_bag'];
				
			 }else{
				 $kdunitkerja=$showaset['tuker'];
				    $namaunitkerja=$showaset['nama_uker'];
			 }
			 
	 
?>

	<div class="col-md-8 col-md-offset-2">
				<div class="box box-default">
					<div class="box-header with-border">
						<h2 class="box-title"><b>Edit Asset</b></h2>
						<div class="box-tools pull-right">
							<a href="javascript:history.back()" class="btn btn-primary">Back</a>
								
						</div>
					</div><!-- /.box-header -->
					<div class="box-body">
						<form id="create-form" class="form-horizontal" method="post" action="" role="form" enctype="multipart/form-data">
						 
						<input class="form-control" type="hidden" name="karyawan-detail" id="karyawan-detail" value="<?php echo $link;?>" /> 
						<input class="form-control" type="hidden" name="aset-detail" id="aset-detail" value="<?php echo  $aset_detail;?>" /> 
							<!-- Name -->
							<div class="form-group ">
								<label for="name" class="col-md-3 control-label">No Aset</label>
								<div class="col-md-7 col-sm-12 required">
									<input class="form-control" type="text" name="no_aset" id="no_aset" value="<?php echo $showaset['no_aset'];?>" />
									<input class="form-control" type="hidden" name="idaset" id="idaset" value="<?php echo $id;?>" /> 
								</div>
							</div>
							<!-- Name -->
							<div class="form-group ">
								<label for="name" class="col-md-3 control-label">Model</label>
								<div class="col-md-7 col-sm-12 required">
									<input class="form-control" type="text" name="model" id="model" value="<?php echo $showaset['model'];?>" /> 
								</div>
							</div> 
							<!-- Kategori -->
							<div class="form-group">
								<label for="category_id" class="col-md-3 control-label">Kategori</label>
								<div class="col-md-7 required">
									<select class="form-control select2" name="kategori" id="kategori">
										<option value="<?php echo $showaset['kd_kategori'];?>"> <?php echo $showaset['nama_kategori'];?> </option>
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
							<!-- SN -->
							<div class="form-group ">
								<label for="name" class="col-md-3 control-label">SN</label>
								<div class="col-md-7 col-sm-12 required">
									<input class="form-control" type="text" name="sn" id="sn" value="<?php echo $showaset['sn'];?>" /> 
								</div>
							</div> 
							<div class="form-group ">
								<label for="model_number" class="col-md-3 control-label">Tahun</label>
								<div class="col-md-7">
								<div class="input-group year col-md-5">
                                    <input type="text" class="form-control datepicker" placeholder="Tahun" name="tahun" id="tahun" value="<?php echo $showaset['tahun'];?>"required>
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>  
								</div>
							</div> 
							 <div class="form-group">
								<label for="category_id" class="col-md-3 control-label">Status</label>
								<div class="col-md-7 required">
									 
									<select onchange="TampilNotes(this.value)" onclick="changeValue(this.value)"   class="form-control"  title="Pilih Status" name="status" id="status"   required>
									
									  <option value="<?php echo $showaset['id'];?>"><?php echo $showaset['name'];?></option>
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
									<?php
							$idstatus=$showaset['id'];
								$showstatus =mysqli_fetch_array(mysqli_query($conn,"SELECT  * FROM status_labels  WHERE id= '$idstatus'")); 
								if ($showstatus['deployable']=="1"){
										$divstatus='<div id="divstatus" >';
										$tampilnote='<a>'.$showstatus['notes'].'</a>';
									}else{
										$divstatus='<div id="divstatus" style="display:none;">';
										$tampilnote=' <a id="tampilnote"></a>';
									}
							?>
							<?php echo $tampilnote; ?>
						 
								</div> 
							</div> 
							
							<!-- User -->
							<?php echo $divstatus; ?>
							<div  class="form-group">
								<label for="assigned_user" class="col-md-3 control-label">User</label>
								<div class="col-md-7 required">
									<select name="karyawan" id="karyawan" class="form-control select2"  >
										<option value="<?php echo $showaset['nik'];?>"><?php echo $showaset['nik'].' - '.$showaset['nama_karyawan'];?></option>
										<option value=""></option>
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
								<div class="col-md-1 panel-grids"> 
									<button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#popnewkaryawan" data-whatever="@mdo">Baru</button>
								</div>
							</div> 
							<!-- Lokasi -->
							<div  class="form-group" >
								<label for="assigned_location" class="col-md-3 control-label">Unit Kerja</label>
								<div class="col-md-7 required">
									<select  name="uker" id="uker" class="form-control select2"  >
										 
										
												<option selected value="<?php echo $kdunitkerja; ?>"><?php echo  $namaunitkerja;?></option>
												<option value=""></option>	 
											 
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
							<?php
								if (($showaset['nama_kategori']=="dekstop")or($showaset['nama_kategori']=="DEKSTOP")or($showaset['nama_kategori']=="Dekstop"))
								{
									
							?>
								<div  class="form-group">
								<label for="assigned_user" class="col-md-3 control-label">Monitor</label>
								<div class="col-md-7 required">
									<select name="id_monitor" id="id_monitor" class="form-control select2"  >
										<option value="<?php echo $showaset['id_monitor'];?>"><?php echo $asetmonitor['no_aset'].' - '.$showaset['model'];?></option>
										<option value=""></option>
										<?php
										$res = $conn->query("SELECT * FROM data_aset where kd_kategori='cm'");
										while($row = $res->fetch_assoc()){
										echo '
											<option value="'.$row['no'].'">'.$row['no_aset'].' - '.$row['model'].'</option>
										';
										 
										} 
										?>
									</select>
								</div>
								<div class="col-md-1 panel-grids"> 
									<button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#popMonitor" data-whatever="@mdo">Baru</button>
								</div>
							</div>
							<?php
								} 
							?>
							
							
							<!-- Catatan -->
							<div class="form-group ">
								<label for="name" class="col-md-3 control-label">Catatan</label>
								<div class="col-md-7 col-sm-12 required">
									<textarea class="form-control" type="text" name="catatan" id="catatan" value=""><?php echo $showaset['catatan'];?></textarea> 
								</div>
							</div> 
							<div class="box-footer text-right">
								
								<button type="submit" name="saveeditaset" id="saveeditaset" class="btn btn-success"><i class="fa fa-check icon-white"></i> Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>
<?php 
if (isset($_POST['saveeditaset'])){ 
	$status=$_POST['status'];
	$showstatus =mysqli_fetch_array(mysqli_query($conn,"SELECT *  FROM status_labels  WHERE id= '$status'"));
		if ($showstatus['deployable']=="1"){
			 $user=$_POST['karyawan'];
			 $uker=$_POST['uker'];	 
		}else{
			 $user="";
			 $uker=""; 
		}
		if ($user==""){
			if ($uker==""){ $lokasi="DI TI"; }else{ $lokasi="DI USER";	 }	  
		}else{
			$lokasi="DI USER";	 
		}
	 
	 
	$idaset=$_POST['idaset'];
	$no_aset=$_POST['no_aset'];
	$model=$_POST['model'];
	$kategori=$_POST['kategori']; 
	$sn=$_POST['sn'];
	$th=$_POST['tahun'];
	$catatan=$_POST['catatan'];  
	$kdkat =mysqli_fetch_array(mysqli_query($conn,"SELECT * from data_kategori WHERE kd_kategori= '$kategori'"));
 
		if (($showstatus['name']=="scrab")or($showstatus['name']=="SCRAB")){
			$tgl_scrab=$created_at;
			$lokasi="DI TI";
			$toscrab =mysqli_fetch_array(mysqli_query($conn,"SELECT  tahun,ip_address,os,proc,ramhd,vga
					,id_sup,sewa,po,tgl_po,harga from data_aset WHERE no='$idaset'"));
			$tahun=$toscrab['tahun']; $ip=$toscrab['ip_address']; $os=$toscrab['os']; $proc=$toscrab['proc'];
			$ramhd=$toscrab['ramhd']; $vga=$toscrab['vga']; $id_sup=$toscrab['id_sup']; $po=$toscrab['po'];
			$tgl_po=$toscrab['tgl_po']; $harga=$toscrab['harga'];
			$sql = "INSERT INTO data_aset_scrab values('','$no_aset','$tahun','$kategori','$model','$sn','$ip','$os','$proc','$ramhd','$vga',
			'$lokasi','$id_sup','$po','$tgl_po','$harga','$tgl_scrab','$catatan','$id_user','$status')";
			$delete="DELETE FROM data_aset WHERE no='$idaset'";
			$query	= mysqli_query($conn,$sql);	
			$query	= mysqli_query($conn,$delete);
		}else{
		
			if(isset($_POST["id_monitor"]) && strlen($_POST["id_monitor"])>0) 
			{
				$id_monitor=$_POST['id_monitor']; 
				$sql1 = "UPDATE data_aset SET kd_uker='$uker',nik='$user',update_at='$update_at',admin='$id_user' ,status='$status'
						,lokasi='$lokasi'
						WHERE no='$id_monitor'";	
				$query	= mysqli_query($conn,$sql1);	
			
				$sql2 = "UPDATE data_aset SET no_aset='$no_aset', tahun='$th', kd_kategori='$kategori',model='$model',   sn='$sn', 
						 kd_uker='$uker',nik='$user',update_at='$update_at',admin='$id_user',catatan='$catatan',id_monitor='$id_monitor'
						 ,status='$status',lokasi='$lokasi'
						 WHERE no='$idaset'";
						 $query	= mysqli_query($conn,$sql2);
			}else{ 
				$sql = "UPDATE data_aset SET no_aset='$no_aset',  tahun='$th', kd_kategori='$kategori',model='$model',   sn='$sn', 
				 kd_uker='$uker',nik='$user',update_at='$update_at',admin='$id_user',catatan='$catatan',id_monitor=''
				 ,status='$status',lokasi='$lokasi'
				 WHERE no='$idaset'";	
				$query	= mysqli_query($conn,$sql);
			}
		}	 
				echo '<script>window.location="'.$kdkat['nama_kategori'].'"</script>'; 
		 
}
?>	 