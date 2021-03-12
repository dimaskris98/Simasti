<?php 
$id=$_POST['idd']; 

$showaset =mysqli_fetch_array(mysqli_query($conn,"SELECT  data_kategori.*,data_aset_scrab.* ,status_labels.* FROM data_aset_scrab 
			Left join data_kategori ON data_aset_scrab.kd_kategori=data_kategori.kd_kategori 
			LEFT JOIN status_labels ON data_aset_scrab.status=status_labels.id
			WHERE idscrab= '$id'")); 
			 
			 
			 if(isset($_POST['aset-scrab-detail']))
			 {
				$aset_detail=$_POST['aset-scrab-detail'];
				$link="";
				$back='<form name="backform" action="detail" method="post">
						<a name="tes" href="javascript:" onclick="parentNode.submit();" class="btn btn-primary">Back</a>
						<input type="hidden" name="aset-scrab-detail" value="'.$showaset['idscrab'].'"/>
						</form> ';
			 
			} else
			{
				$back=' <a href="javascript:history.back()" class="btn btn-primary">Back</a>'; 
				 $link="";
				  $aset_detail="";
			}
?>

	<div class="col-md-8 col-md-offset-2">
				<div class="box box-default">
					<div class="box-header with-border">
						<h2 class="box-title"><b>Edit Asset</b></h2>
						<div class="box-tools pull-right">
							<?php echo $back; ?>
								
						</div>
					</div><!-- /.box-header -->
					<div class="box-body">
						<form id="create-form" class="form-horizontal" method="post" action="" role="form" enctype="multipart/form-data"> 
						
						<input class="form-control" type="hidden" name="link" id="link" value="<?php echo "Scrab-".$showaset['nama_kategori'];?>" /> 
						<input class="form-control" type="hidden" name="aset-scrab-detail" id="aset-detail" value="<?php echo  $aset_detail;?>" /> 
							<!-- Name -->
							<div class="form-group ">
								<label for="name" class="col-md-3 control-label">No Aset</label>
								<div class="col-md-7 col-sm-12 required">
									<input class="form-control" type="text" name="no_aset" id="no_aset" value="<?php echo $showaset['no_aset'];?>" />
									<input class="form-control" type="hidden" name="idaset" id="idaset" value="<?php echo $id;?>" /> 
								</div>
							</div>  
							<div class="form-group ">
								<label for="model_number" class="col-md-3 control-label">Tahun</label>
								<div class="col-md-7">
								<div class="input-group year col-md-5">
                                    <input type="text" class="form-control datepicker" placeholder="Tahun" name="tahun" id="tahun" value="<?php echo $showaset['tahun'];?>" required>
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>  
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
									<select class="form-control"  data-placeholder="Select a Category" name="kategori" id="kategori">
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
							  
								 
							
							 
							<!-- Catatan -->
							<div class="form-group ">
								<label for="name" class="col-md-3 control-label">Catatan</label>
								<div class="col-md-7 col-sm-12 required">
									<textarea class="form-control" type="text" name="catatan" id="catatan" value=""><?php echo $showaset['catatan'];?></textarea> 
								</div>
							</div> 
							<div class="box-footer text-right">
								
								<button type="submit" name="saveeditasetscrab" id="saveeditasetscrab" class="btn btn-success"><i class="fa fa-check icon-white"></i> Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>
 
 