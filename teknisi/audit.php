<?php 
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
			 if(isset($_POST['back_link']))
			 {
				$back='<form name="backform" action="detail" method="post">
						<a name="tes" href="javascript:" onclick="parentNode.submit();" class="btn btn-primary">Back</a>
						<input type="hidden" name="aset-detail" value="'.$showaset['no'].'"/>
						</form> ';
			 
			}else
			{
				$back=' <a href="javascript:history.back()" class="btn btn-primary">Back</a>'; 
			}
?>
<!-- Content Header (Page header) -->
<section class="content-header" style="padding-bottom: 30px;">
<h1 class="pull-left">Audit</h1>
    <div class="pull-right"> </div>
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

                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $showaset['no_aset'];?></h3>
                    </div>
                    <div class="box-body">
						<input type="hidden" name="_token" value="ubKrxz1Y4ThpHJrXl9MVJfGKjKmRfWwwB5JYx7Ib"/>
					<!-- Asset name -->
                            <div class="form-group ">
                                <label for="name" class="col-md-3 control-label">Model</label>
                                <div class="col-md-8">
                                    <p class="form-control-static"><?php echo $showaset['model'];?></p>
                                </div>
                            </div>
                    
                    <!-- Asset Name -->
                        <div class="form-group ">
                            <label for="name" class="col-md-3 control-label">Asset Name</label>
                            <div class="col-md-8">
                                <p class="form-control-static"><?php echo $showaset['no_aset'];?></p>
                            </div>
                        </div>

                        <!-- Locations -->
                    <!-- Location -->
						<div id="location_id" class="form-group">

							<label for="location_id" class="col-md-3 control-label">Location</label>
							<div class="col-md-7">
								<select class="js-data-ajax" data-endpoint="locations" data-placeholder="Select a Location" name="location_id" style="width: 100%" id="location_id_location_select">
													<option value="">Select a Location</option>
											</select>
							</div>

							<div class="col-md-1 col-sm-1 text-left">
														<a href='https://demo.snipeitapp.com/modals/location' data-toggle="modal"  data-target="#createModal" data-select='location_id_location_select' class="btn btn-sm btn-default">New</a>
												</div>

							

							

						</div>
                        <!-- Next Audit -->
                        <div class="form-group ">
                            <label for="name" class="col-md-3 control-label">Next Audit Date</label>
                            <div class="col-md-9">
                                <div class="input-group date col-md-5" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                                    <input type="text" class="form-control" placeholder="Next Audit Date" name="next_audit_date" id="next_audit_date" value="2019-08-26">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                                
                            </div>
                        </div>
                        <!-- Note -->
                        <div class="form-group ">
                            <label for="note" class="col-md-3 control-label">Notes</label>
                            <div class="col-md-8">
                                <textarea class="col-md-6 form-control" id="note" name="note"></textarea>
                                
                            </div>
                        </div>
						</div> <!--/.box-body-->
						<div class="box-footer">
							<a class="btn btn-link" href="https://demo.snipeitapp.com/hardware/5"> Cancel</a>
							<button type="submit" class="btn btn-success pull-right"><i class="fa fa-check icon-white"></i> Audit</button>
						</div>
                </form>
            </div>
        </div> <!--/.col-md-7-->
    </div>
</div>
</section>