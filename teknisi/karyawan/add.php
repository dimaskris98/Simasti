	<div class="col-md-8 col-md-offset-2">
				<div class="box box-default">
					<div class="box-header with-border">
						<h2 class="box-title"><b>Tambah Karyawan</b></h2>
						<div class="box-tools pull-right">
							<a href="<?php if(isset($_SERVER['HTTP_REFERER'])){ echo $_SERVER['HTTP_REFERER']; } ?>"  class="btn btn-success">Batal</a>
								
						</div>
					</div><!-- /.box-header -->
					<div class="box-body">
						<form id="create-form" class="form-horizontal" method="post" action="" role="form" enctype="multipart/form-data">
							<div class="form-group ">
								<label for="name" class="col-md-3 control-label">Tipe Karyawan</label>
								<div class="col-md-7 col-sm-12 required">
									<input type="radio" name="tipe" id="tipe" value="organik">Organik </input>	&nbsp;	&nbsp;
									<input type="radio" name="tipe" id="tipe" value="non-organik">Non Organik </input>
								</div>
							</div>	
							<div class="form-group ">
								<label for="name" class="col-md-3 control-label">NIK</label>
								<div class="col-md-7 col-sm-12 required">
									<input class="form-control" type="text" name="nik" id="nik" value="" /> 
								</div>
							</div>
							<!-- Name -->
							<div class="form-group ">
								<label for="name" class="col-md-3 control-label">Nama</label>
								<div class="col-md-7 col-sm-12 required">
									<input class="form-control" type="text" name="nama" id="nama" value=" " /> 
								</div>
							</div> 
							<!-- email -->
							<div class="form-group ">
								<label for="name" class="col-md-3 control-label">E-Mail</label>
								<div class="col-md-7 col-sm-12 required">
									<input class="form-control" type="email" name="email" id="email" value="" /> 
								</div>
							</div> 
							<!-- tlp -->
							<div class="form-group ">
								<label for="name" class="col-md-3 control-label">Telp (Extension)</label>
								<div class="col-md-7 col-sm-12 required">
									<input class="form-control" type="number" name="tlp" id="tlp" value="" /> 
								</div>
							</div> 
							<!-- Departemen -->
							<div class="form-group">
								<label for="category_id" class="col-md-3 control-label">Departemen</label>
								<div class="col-md-7 required">
									<select class="form-control selectpicker" data-live-search="true"  title="Pilih Departemen" name="departemen" id="departemen">
										 <option value=""></option>
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
										<option value="">Pilih Bagian</option>
									</select>
								</div> 
							</div>   
							<!-- Foto --> 
							<div class="form-group ">
								<label for="name" class="col-md-3 control-label">Foto</label>
								
								<div class="col-md-7 col-sm-12 required"> 
							  <div id="preview_gambar">
									  <img id="preview" src=" " class="avatar img-circle hidden-print" style="width:100px;">
								</div>
							  <input class="form-control" type="file" name="foto" id="foto" value=" " onchange="tampilkanPreview(this,'preview')"/> 
                          </div>
							</div>
							<div class="box-footer text-right">
								
								<button type="submit" name="savekaryawan" id="savekaryawan" class="btn btn-success"><i class="fa fa-check icon-white"></i> Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>
 
 