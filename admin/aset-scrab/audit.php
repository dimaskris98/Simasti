<?php 

$tomorrow = mktime(0,0,0,date("m"),date("d"),date("Y")+1);

$id=$_POST['idd'];
$showaset =mysqli_fetch_array(mysqli_query($conn,"SELECT data_aset.*,data_aset.nik as tnik,data_aset.kd_uker as tuker, data_karyawan.*,data_uker.*,data_uker_bagian.*,data_kategori.* FROM data_aset 
			Left join data_kategori ON data_aset.kd_kategori=data_kategori.kd_kategori
			Left join data_karyawan ON data_aset.nik=data_karyawan.nik
			Left join data_uker ON data_aset.kd_uker=data_uker.kd_uker
			Left join data_uker_bagian ON data_aset.kd_uker=data_uker_bagian.kd_bag
			WHERE no= '$id'")); 
			 if($showaset['nama_uker']=="")
			 {
				   $kdunitkerja=$showaset['kd_bag'];
				    $namaunitkerja=$showaset['nama_bag'];
				
			 }else{
				 $kdunitkerja=$showaset['tuker'];
				    $namaunitkerja=$showaset['nama_uker'];
			 }
			 
			 if(isset($_POST['aset-detail']))
			 {
				$aset_detail=$_POST['aset-detail'];
				$link="";
				$back='<form name="backform" action="detail" method="post">
						<a name="tes" href="javascript:" onclick="parentNode.submit();" class="btn btn-primary">Back</a>
						<input type="hidden" name="aset-detail" value="'.$showaset['no'].'"/>
						</form> ';
			 
			}else if(isset($_POST['karyawan-detail']))
			 {
				 $aset_detail="" ;
				$link=$_POST['karyawan-detail'];
				$back='<form action="detail" method="post">
								<a name="tes" href="javascript:" onclick="parentNode.submit();" class="btn btn-primary">Back</a>
								<input type="hidden" name="karyawan-detail" value="'.$link.'"/>
							
						</form>';
			 
			}else
			{
				$back=' <a href="javascript:history.back()" class="btn btn-primary">Back</a>'; 
				 $link="";
				  $aset_detail="";
			}
?>
<!-- Content Header (Page header) -->
<section class="content-header" style="padding-bottom: 30px;">
<h1 class="pull-left">Audit</h1>
    <div class="pull-right"> 
	<div class="box-tools pull-right">
							<?php echo $back; ?>
								
						</div>
	</div>
</section>
<section class="content">
     <!-- Content -->
<div id="webui">     
    <style>

        .input-group {
            padding-left: 0px !important;
        }
    </style>

    <div class="row">
        <!-- left column -->
        <div class="col-md-7">
            <div class="box box-default">

                <form method="POST" action="" class="form-horizontal" enctype="multipart/form-data"> 
				<input class="form-control" type="hidden" name="karyawan-detail" id="karyawan-detail" value="<?php echo $link;?>" /> 
						<input class="form-control" type="hidden" name="aset-detail" id="aset-detail" value="<?php echo $aset_detail;?>" /> 
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $showaset['no_aset'];?></h3>
                    </div>
                    <div class="box-body">
						<input type="hidden" name="id" value="<?php echo $showaset['no'];?>"/>
						<input type="hidden" name="kategori" value="<?php echo $showaset['kd_kategori'];?>"/>
					<!-- Asset name -->
                            <div class="form-group ">
                                <label for="name" class="col-md-3 control-label">Model</label>
                                <div class="col-md-8">
                                    <p class="form-control-static"><?php echo $showaset['model'];?></p>
                                </div>
                            </div>
                    
                    <!-- Asset Name -->
                        <div class="form-group ">
                            <label for="name" class="col-md-3 control-label">Nomer Aset</label>
                            <div class="col-md-8">
                                <p class="form-control-static"><?php echo $showaset['no_aset'];?></p>
                            </div>
                        </div>

                        <!-- Locations -->
                    
							<div class="form-group">
								<label  class="col-md-3 control-label">Karyawan</label>
								<div class="col-md-7 required">
									<select class="form-control selectpicker" data-live-search="true"  title="Pilih Karyawan" name="karyawan" id="karyawan">
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
									<select name="uker" id="uker" title="Pilih Unit Kerja" class="form-control  selectpicker" data-live-search="true"  >
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
                        <!-- Next Audit -->
                        <div class="form-group ">
                            <label for="name" class="col-md-3 control-label">Next Audit Date</label>
                            <div class="col-md-9">
                                <div class="input-group date col-md-5" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                                    <input type="text" class="form-control" placeholder="Next Audit Date" name="next_audit_date" id="next_audit_date" value="<?php echo date("Y/m/d", $tomorrow); ?>">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                                
                            </div>
                        </div>
                        <!-- Note -->
                        <div class="form-group ">
                            <label for="note" class="col-md-3 control-label">Notes</label>
                            <div class="col-md-8">
                                <textarea class="col-md-6 form-control" id="catatan" name="catatan"></textarea>
                                
                            </div>
                        </div>
						</div> <!--/.box-body-->
						<div class="box-footer">
							 
							<button type="submit" name="saveauditaset" class="btn btn-success pull-right"><i class="fa fa-check icon-white"></i> Audit</button>
						</div>
                </form>
            </div>
        </div> <!--/.col-md-7-->
    </div>
</div>
</section>