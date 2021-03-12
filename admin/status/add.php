 <h2><center>Creat Label Status</center><span class="label label-default"></span></h2>
<div class="main-page signup-page">
				<div class="sign-up-row widget-shadow">
				
				<form class="form-horizontal" method="POST" action="add">
					<div class="form-group">
						<label class="col-sm-3 control-label">
							<h4>Nama Status :</h4>
						</label>
						<div class="col-md-7 col-sm-12 required">
							<input class="form-control" type="text" name="namastatus" id="namastatus" >
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">
							<h4>Tipe Status :</h4>
						</label>
						<div class="col-md-7 col-sm-12 required">
							<select class="form-control selectpicker" data-live-search="true"  title="Pilih Tipe Status" name="tipestatus" id="tipestatus"  required  >
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
									<textarea class="form-control" type="text" name="catatan" id="catatan" ></textarea>
									 
								</div>
							</div>	
					<div class="form-group">
						<div class="col-sm-offset-8 col-sm-5">
						<button type="submit" class="btn btn-primary" data-dismiss="modal" name="simpanstatus" id="simpanstatus">Simpan</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
						<div class="clearfix"> </div>
					</div>
				</form>
</div>
</div>
