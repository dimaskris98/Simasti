<?php
$id=$_POST['id'];
 	$data =mysqli_fetch_array(mysqli_query($conn,"SELECT  * FROM status_labels WHERE id='$id'"));
?>
 <h2><center>Edit Label Status</center><span class="label label-default"></span></h2>
<div class="main-page signup-page">
				<div class="sign-up-row widget-shadow">
				
				<form class="form-horizontal" method="POST" action="edit">
				<input class="form-control" type="hidden" name="id" id="id" value="<?php echo $data['id'];?>">
					<div class="form-group">
						<label class="col-sm-3 control-label">
							<h4>Nama Status :</h4>
						</label>
						<div class="col-md-7 col-sm-12 required">
							<input class="form-control" type="text" name="namastatus" id="namastatus" value="<?php echo $data['name'];?>">
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">
							<h4>Tipe Status :</h4>
						</label>
						<div class="col-md-7 col-sm-12 required">
							<select class="form-control "  title="Pilih Tipe Status" name="tipestatus" id="tipestatus"  required  >
							<?php if ($data['deployable']==1){echo'<option value="1">Dapat Dibagikan</option>';}else{ echo'<option value="0">Tidak Dapat Dibagikan</option>';} ?>
							  <option value="1">Dapat Dibagikan</option>
							  <option value="0">Tidak Dapat Dibagikan</option>
							</select>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="form-group ">
								<label class="col-sm-3 control-label">
							<h4>Catatan :</h4>
						</label>
								<div class="col-md-7 col-sm-12 required">
									<textarea class="form-control" type="text" name="catatan" id="catatan" > <?php echo $data['notes'];?></textarea>
									 
								</div>
							</div>	
					<div class="form-group">
						<div class="col-sm-offset-8 col-sm-5">
						<button type="submit" class="btn btn-primary" data-dismiss="modal" name="updatestatus" id="updatestatus">Simpan</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
						<div class="clearfix"> </div>
					</div>
				</form>
</div>
</div>  