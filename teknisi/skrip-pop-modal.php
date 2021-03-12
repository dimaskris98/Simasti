
<!--modal PopUp Kategori consumable-->
<div class="modal fade" id="popkategoriconsumable" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Kategori tipe consumable</h4>
			</div>
			<div class="modal-body">
			<form name="form-kategori" id="form-kategori" class="form-kategori form-horizontal" method="POST" action="">
					<div class="form-group">
						<label class="col-sm-5 control-label">
							<h4>Nama kategori :</h4>
						</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="namakat_consum" id="namakat_consum">
						</div>
						<div class="clearfix"> </div>
					</div> 
					
					<div class="form-group">
				<div class="col-sm-offset-7 col-sm-5">
					<button type="submit" class="btn btn-primary" data-dismiss="modal" name="newKatConsum" id="newKatConsum">Simpan</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
					<div class="clearfix"> </div>
				</div>
		</form>
		</div>
		</div>
	</div>
</div>
 	

	<div class="modal" id="popsupplier"  role="dialog" aria-labelledby="exampleModalLabel"> 
        <div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Create Supplier</h4>
			</div>
			
		<div class="modal-body">
		 
					<div class="form-group">
						<label class="col-sm-5 control-label">
							<h4>Name :</h4>
						</label>
						<div class="col-sm-5">
							<input type="text" name="namasupplier" id="namasupplier" >
						</div>
						<div class="clearfix"> </div>
					</div>
					
					<div class="form-group">
						<div class="col-sm-offset-7 col-sm-5">
						<button type="submit" class="btn btn-primary" data-dismiss="modal" name="Addnewsupplier" id="Addnewsupplier">Simpan</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
						<div class="clearfix"> </div>
					</div>
		 
		</div>
		</div>
	</div>
    </div>
	
	<!--Status-->
<div class="modal" id="popnewstatus"  role="dialog" aria-labelledby="exampleModalLabel"> 
        <div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Create Supplier</h4>
			</div>
			
		<div class="modal-body">
		 
					<div class="form-group">
						<label class="col-sm-4 control-label">
							<h4>Nama Status :</h4>
						</label>
						<div class="col-sm-4">
							<input class="form-control" type="text" name="namastatus" id="namastatus" >
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="form-group">
						<label class="col-sm-4 control-label">
							<h4>Tipe Status :</h4>
						</label>
						<div class="col-sm-4">
							<select class="form-control selectpicker" data-live-search="true"  title="Pilih Tipe Status" name="tipestatus" id="tipestatus"  required  >
										 <option value="1">Dapat Dibagikan</option>
										  <option value="0">Tidak Dapat Dibagikan</option>
									</select>
						</div>
						<div class="clearfix"> </div>
					</div>
					
					<div class="form-group">
						<div class="col-sm-offset-7 col-sm-5">
						<button type="submit" class="btn btn-primary" data-dismiss="modal" name="Addnewstatus" id="Addnewstatus">Simpan</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
						<div class="clearfix"> </div>
					</div>
		 
		</div>
		</div>
	</div>
    </div>
	
	<!--Karyawan-->
<div class="modal" id="popnewkaryawan"  role="dialog" aria-labelledby="exampleModalLabel"> 
        <div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Create Supplier</h4>
			</div>
			
		<div class="modal-body"> 
					<div class="form-group">
						<label class="col-sm-4 control-label">
							<h4>Tipe Karyawan :</h4>
						</label>
						<div class="col-sm-6">
									<input type="radio" name="tipe" id="tipe" value="organik">Organik </input>	&nbsp;	&nbsp;
									<input type="radio" name="tipe" id="tipe" value="non-organik">Non Organik </input>
						</div>
						<div class="clearfix"> </div>
					</div>
							
					<div class="form-group">
						<label class="col-sm-4 control-label">
							<h4>Nik :</h4>
						</label>
						<div class="col-sm-6">
							<input class="form-control" type="text" name="nik" id="nik" >
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="form-group">
						<label class="col-sm-4 control-label">
							<h4>Nama Karyawan :</h4>
						</label>
						<div class="col-sm-6">
							<input class="form-control" type="text" name="namakaryawan" id="namakaryawan" >
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="form-group">
						<label class="col-sm-4 control-label">
							<h4>Departemen :</h4>
						</label>
						<div class="col-sm-6">
							<select class="form-control selectpicker" data-live-search="true"  title="Pilih Departemen" name="departemen" id="departemen"    >
										
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
						<div class="clearfix"> </div>
					</div>
					<div class="form-group">
						<label class="col-sm-4 control-label">
							<h4>Bagian :</h4>
						</label>
						<div class="col-sm-6">
							<select class="form-control  " data-live-search="true"  title="Pilih Bagian" name="bagian" id="bagian"    >
								 
											 
							</select>
						</div>
						<div class="clearfix"> </div>
					</div>
					
					<div class="form-group">
						<div class="col-sm-offset-7 col-sm-5">
						<button type="submit" class="btn btn-primary" data-dismiss="modal" name="Addnewkaryawan" id="Addnewkaryawan">Simpan</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
						<div class="clearfix"> </div>
					</div>
		 
		</div>
		</div>
	</div>
    </div> 
	
	
<!--Aset Monitor-->
<div class="modal" id="popMonitor"  role="dialog" aria-labelledby="exampleModalLabel"> 
        <div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Aset Monitor Baru</h4>
			</div>
			
		<div class="modal-body">
		 
					<div class="form-group">
						<label class="col-sm-3 control-label">
							<h4>No Aset :</h4>
						</label>
						<div class="col-sm-5">
							<input type="text" name="aset" id="aset" >
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">
							<h4>Model :</h4>
						</label>
						<div class="col-sm-5">
							<input type="text" name="namamodel" id="namamodel" >
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">
							<h4>SN :</h4>
						</label>
						<div class="col-sm-5">
							<input type="text" name="sntag" id="sntag" >
						</div>
						<div class="clearfix"> </div>
					</div>
					 <div class="form-group ">
						<label class="col-sm-3 control-label">
								<h4>Sewa :</h4>
						</label>
								<div class="col-md-7">
								<input  type="checkbox" name="sewa" id="sewa" value="1"/>
									
								</div>
					</div>
					<div class="form-group ">
						<label class="col-sm-3 control-label">
								<h4>Tahun :</h4>
						</label>
						<div class="col-md-7">
							<div class="input-group year col-md-5">
                               <input type="text" class="form-control datepicker" placeholder="Tahun" name="tahun" id="tahun" required />
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>  
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-7 col-sm-5">
						<button type="submit" class="btn btn-primary" data-dismiss="modal" name="addMonitor" id="addMonitor">Simpan</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
						<div class="clearfix"> </div>
					</div>
		 
		</div>
		</div>
	</div>
    </div>

	
	
<!--MODEL-->
<div class="modal" id="popmodel"  role="dialog" aria-labelledby="exampleModalLabel"> 
        <div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Model Aset Baru</h4>
			</div>
			
		<div class="modal-body">
		 
					<div class="form-group">
						<label class="col-sm-3 control-label">
							<h4>Nama Model :</h4>
						</label>
						<div class="col-sm-5">
							<input type="text" name="namamodelok" id="namamodelok" >
						</div>
						<div class="clearfix"> </div>
					</div>
					
					<div class="form-group">
						<div class="col-sm-offset-7 col-sm-5">
						<button type="submit" class="btn btn-primary" data-dismiss="modal" name="addModel" id="addModel">Simpan</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
						<div class="clearfix"> </div>
					</div>
		 
		</div>
		</div>
	</div>
    </div>