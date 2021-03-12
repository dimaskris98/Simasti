 
<section class="content-header" style="padding-bottom: 30px;">
<?php 
if (isset($_GET['asset'])){
	
$asset=$_GET['asset'] ;
 $showaset =mysqli_fetch_array(mysqli_query($conn,"SELECT data_karyawan.*, status_labels.*, status_labels.name as status,1assets.name as aset, 1assets.* FROM 1assets  
LEFT JOIN status_labels ON 1assets.status_id=status_labels.id 
LEFT JOIN data_karyawan ON 1assets.assigned_to=data_karyawan.nik 
where 1assets.id='$asset'"));

$idmodel=$showaset['model_id'];
$showmodel =mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM 1models  
			LEFT JOIN manufaktur ON 1models.manufacturer_id=manufaktur.id_manufaktur 
			LEFT JOIN kategori ON 1models.category_id=kategori.id_kategori  
			LEFT JOIN data_pemasok ON 1models.supplier_id=data_pemasok.id_sup  
			where id='$idmodel'"));

?>
    <h1 class="pull-left">View Asset <?php echo $showaset['aset'];?></h1>
    <div class="pull-right"> 
	 
	<div class="col-md-6">
		<div class="box-tools pull-right">
		<a href="models?view=<?php echo $idmodel;?>" class="btn btn-primary">Back</a>
		</div>
		</div>
	</div>
</section>
<div id="webui">         
	<div class="row">
		<div class="col-md-12">
		<!-- Custom Tabs -->
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#details" data-toggle="tab"><span class="hidden-lg hidden-md"><i class="fa fa-info-circle"></i></span> <span class="hidden-xs hidden-sm">Details</span></a>
					</li>
					<li>
						<a href="#software" data-toggle="tab"><span class="hidden-lg hidden-md"><i class="fa fa-floppy-o"></i></span> <span class="hidden-xs hidden-sm">Licenses</span></a>
					</li>
					<li>
						<a href="#components" data-toggle="tab"><span class="hidden-lg hidden-md"><i class="fa fa-hdd-o"></i></span> <span class="hidden-xs hidden-sm">Components</span></a>
					</li>
					<li>
					  <a href="#assets" data-toggle="tab"><span class="hidden-lg hidden-md"><i class="fa fa-barcode"></i></span> <span class="hidden-xs hidden-sm">Assets</span></a>
					</li>
					<li>
					  <a href="#maintenances" data-toggle="tab"><span class="hidden-lg hidden-md"><i class="fa fa-wrench"></i></span> <span class="hidden-xs hidden-sm">Maintenances</span></a>
					</li>
					<li>
					  <a href="#history" data-toggle="tab"><span class="hidden-lg hidden-md"><i class="fa fa-history"></i></span> <span class="hidden-xs hidden-sm">History</span></a>
					</li>
					<li>
					  <a href="#files" data-toggle="tab"><span class="hidden-lg hidden-md"><i class="fa fa-files-o"></i></span> <span class="hidden-xs hidden-sm">Files</span></a>
					</li> 
				</ul>
				<div class="tab-content">
					<div class="tab-pane fade in active" id="details">
						<div class="row">
							<div class="col-md-8">
								<div class="table-responsive1">
									<table class="table1 table">
									  <tbody>
										<tr>
											<td>Status</td>
											<td> <i class="fa fa-circle text-blue"></i>
											  <?php echo $showaset['status'];?>
											  <label class="label label-default">Deployed</label>

											  <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
											  <i class="fa fa-user"></i>
											  <a href=""><?php echo $showaset['nama_karyawan'];?></a>
											</td>
										</tr>
										<tr>
										  <td>Asset Name</td>
										  <td><?php echo $showaset['aset'];?></td>
										</tr>
										<tr>
										  <td>Asset Tag</td>
										  <td><?php echo $showaset['asset_tag'];?></td>
										</tr>
										<tr>
											<td>Manufacturer</td>
											<td><a href=""><?php echo $showmodel['nama_manufaktur'];?></a></td>
										</tr>
										<tr>
										  <td>Category</td>
										  <td><a href="https://demo.snipeitapp.com/categories/1"><?php echo $showmodel['nama_kategori'];?></a> </td>
										</tr>
										<tr>
										  <td>Model</td>
										  <td><a href=""><?php echo $showmodel['name'];?></a>
										<tr>
										  <td>Model No.</td>
										  <td><?php echo $showmodel['model_number'];?></td>
										</tr>
										<tr>
											<td>Purchase Date</td>
											  <td><?php echo $showmodel['purchase_date'];?></td>
										  </tr>
										  <tr>
											<td>Purchase Cost</td>
											  <td>Rp.<?php echo number_format($showmodel['purchase_cost'], 0, ".", ".");?></td>
										  </tr>
										  <tr>
											<td>Order Number</td>
											  <td><?php echo $showmodel['order_number'];?></td>
										  </tr>
										  <tr>
											<td>Supplier</td>
											<td><a href=""><?php echo $showmodel['nama_sup'];?></a> </td>
										  </tr>
										  <tr>
											<td>Location</td>
											<td><a href=""> <?php ?></a></td>
										  </tr>
										  <tr>
											<td>Default Location</td>
											<td><a href=""> <?php ?></a></td>
										  </tr>
										  <tr>
											<td>Created at</td>
											<td><?php echo $showaset['created_at'];?></td>
										  </tr>
											<tr>
											  <td>Checkouts Date</td>
											  <td><?php ?></td>
											</tr>
										</tbody>
									</table>
								</div> <!-- /table-responsive -->
							</div><!-- /col-md-8 -->
							<div class="col-md-4">
								<div class="row">  
								<h4>Checked Out To</h4>
								<p>
								   <!-- Only users have avatars currently-->
								  
													<i class="fa fa-user"></i> <a href=" "><?php echo $showaset['nama_karyawan'];?></a>
								</p>
								</div>
								
								<div class="row">  								
								<h4>Specification</h4>
								<?php
									if ($showmodel['fieldset_id']==0){
										echo "Spek default";
									}else{
										$fieldset_id=$showmodel['fieldset_id'];
										$showfield =mysqli_fetch_array(mysqli_query($conn,"SELECT *, custom_fields.name FROM custom_field_custom_fieldset LEFT JOIN custom_fields ON custom_field_custom_fieldset.custom_field_id=custom_fields.id LEFT JOIN custom_fieldsets ON custom_field_custom_fieldset.custom_fieldset_id=custom_fieldsets.id where custom_fieldset_id='$fieldset_id'"));
								 ?>
								 
									 <i class="fa fa-ram"></i> <a href=" "><?php echo $showfield['name'];?></a>  
									 
									 <i class="fa fa-ram"></i> <a href=" "><?php echo $showfield['db_column'];?></a>  
								 
								 
								 <?php
								
									}
								?>
								</div>
								 
							</div> <!-- div.col-md-4 -->
						</div><!-- /row -->
					</div><!-- /.tab-pane asset details -->

					<div class="tab-pane fade" id="software">
						<div class="row">
							<div class="col-md-12"> 
							</div><!-- /col -->
						</div> <!-- row -->
					</div> <!-- /.tab-pane software -->

					<div class="tab-pane fade" id="components">
					  <!-- checked out assets table -->
					  <div class="row">
						  <div class="col-md-12">
											  <div class="alert alert-info alert-block">
								<i class="fa fa-info-circle"></i>
								No Results.
							  </div>
										  </div>
					  </div>
					</div> <!-- /.tab-pane components -->


					<div class="tab-pane fade" id="assets">
					  <div class="row">
						<div class="col-md-12">
						  <form method="POST" action="" accept-charset="UTF-8" class="form-inline" id="bulkForm"><input name="_token" type="hidden" value="vKlAuyqzYKEzOg5l61nUSiZhB2stB3xoIhsqyrKu">
						  <div id="toolbar">
							<select name="bulk_actions" class="form-control select2" style="width: 150px;">
							  <option value="edit">Edit</option>
							  <option value="delete">Delete</option>
							  <option value="labels">Generate Labels</option>
							</select>
							<button class="btn btn-primary" id="bulkEdit" disabled>Go</button>
						  </div>

						  <!-- checked out assets table -->
						  <div class="table-responsive">
							<table class="table table-striped snipe-table">
								<thead>
								<tr>
								  <th></th><th>Date</th><th>Admin</th><th>Action</th><th>Item</th><th>Target</th><th>Notes</th><th>Signature</th><th>Download</th><th>Changed</th>
								</tr>
								</thead>
								 <tbody>
								<tr>
								  <td></td><td>Date</td><td>Admin</td><td>Action</td><td>Item</td><td>Target</td><td>Notes</td><td>Signature</td><td>Download</td><td>Changed</td>
								</tr>
								</tbody>
							</table>
							</form>
						  </div>
						</div><!-- /col -->
					  </div> <!-- row -->
					</div> <!-- /.tab-pane software -->


					<div class="tab-pane fade" id="maintenances">
					  <div class="row">
						<div class="col-md-12">
											<div id="maintenance-toolbar">
							  <a href=" " class="btn btn-primary">Add Maintenance</a>
							</div>
							
						  <!-- Asset Maintenance table -->
							 <table class="table table-striped snipe-table">
							<thead>
							<tr>
							  <th></th><th>Date</th><th>Admin</th><th>Action</th><th>Item</th><th>Target</th><th>Notes</th><th>Signature</th><th>Download</th><th>Changed</th>
							</tr>
							</thead>
							 <tbody>
							<tr>
							  <td></td><td>Date</td><td>Admin</td><td>Action</td><td>Item</td><td>Target</td><td>Notes</td><td>Signature</td><td>Download</td><td>Changed</td>
							</tr>
							</tbody>
						  </table>

						</div> <!-- /.col-md-12 -->
					  </div> <!-- /.row -->
					</div> <!-- /.tab-pane maintenances -->

					<div class="tab-pane fade" id="history">
					  <!-- checked out assets table -->
					  <div class="row">
						<div class="col-md-12">
						  <table class="table table-striped snipe-table">
							<thead>
							<tr>
							  <th></th><th>Date</th><th>Admin</th><th>Action</th><th>Item</th><th>Target</th><th>Notes</th><th>Signature</th><th>Download</th><th>Changed</th>
							</tr>
							</thead>
							 <tbody>
							<tr>
							  <td></td><td>Date</td><td>Admin</td><td>Action</td><td>Item</td><td>Target</td><td>Notes</td><td>Signature</td><td>Download</td><td>Changed</td>
							</tr>
							</tbody>
						  </table>

						</div>
					  </div> <!-- /.row -->
					</div> <!-- /.tab-pane history -->

					<div class="tab-pane fade" id="files">
					  <div class="row">
						<div class="col-md-12">
						  <table class="table table-striped snipe-table">
							<thead>
							<tr>
							  <th></th><th>Date</th><th>Admin</th><th>Action</th><th>Item</th><th>Target</th><th>Notes</th><th>Signature</th><th>Download</th><th>Changed</th>
							</tr>
							</thead>
							 <tbody>
							<tr>
							  <td></td><td>Date</td><td>Admin</td><td>Action</td><td>Item</td><td>Target</td><td>Notes</td><td>Signature</td><td>Download</td><td>Changed</td>
							</tr>
							</tbody>
						  </table>

						</div> <!-- /.col-md-12 -->
					  </div> <!-- /.row -->
					</div> <!-- /.tab-pane files -->
				</div> <!-- /. tab-content -->
			</div> <!-- /.nav-tabs-custom -->
		</div> <!-- /. col-md-12 -->
	</div> <!-- /. row -->
</div> <!-- /. webUI -->
<?php
}else if (isset($_GET['hardware'])){
	$id=$_GET['hardware'];
	
	$showaset =mysqli_fetch_array(mysqli_query($conn,"SELECT
	data_aset.*, data_aset.kd_uker as kdukeraset,
	data_karyawan.*, data_karyawan.kd_uker as kdukerkaryawan,
	data_uker.* , data_uker_bagian.*,data_kategori.*
	FROM data_aset 
	Left join data_karyawan ON data_aset.nik=data_karyawan.nik
	Left join data_kategori ON data_aset.kd_kategori=data_kategori.kd_kategori 
	Left join data_uker ON data_aset.kd_uker=data_uker.kd_uker 
	Left join data_uker_bagian ON data_aset.kd_uker=data_uker_bagian.kd_bag  
		where no='$id' ORDER BY no ASC"));
	 $iduker=$showaset['kdukeraset'];
	
?>
<h1 class="pull-left">View Asset <?php echo $showaset['no_aset'];?></h1>
    <div class="pull-right"> 
	 
	<div class="col-md-6">
		<div class="box-tools pull-right">
		<a href="lokasi?aset=<?php echo $iduker;?>" class="btn btn-primary">Back</a>
		</div>
		</div>
	</div>
</section>
<div id="webui">         
	<div class="row">
		<div class="col-md-12">
		<!-- Custom Tabs -->
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#details" data-toggle="tab"><span class="hidden-lg hidden-md"><i class="fa fa-info-circle"></i></span> <span class="hidden-xs hidden-sm">Details</span></a>
					</li>
					<li>
						<a href="#software" data-toggle="tab"><span class="hidden-lg hidden-md"><i class="fa fa-floppy-o"></i></span> <span class="hidden-xs hidden-sm">Licenses</span></a>
					</li>
					<li>
						<a href="#components" data-toggle="tab"><span class="hidden-lg hidden-md"><i class="fa fa-hdd-o"></i></span> <span class="hidden-xs hidden-sm">Components</span></a>
					</li>
					<li>
					  <a href="#assets" data-toggle="tab"><span class="hidden-lg hidden-md"><i class="fa fa-barcode"></i></span> <span class="hidden-xs hidden-sm">Assets</span></a>
					</li>
					<li>
					  <a href="#maintenances" data-toggle="tab"><span class="hidden-lg hidden-md"><i class="fa fa-wrench"></i></span> <span class="hidden-xs hidden-sm">Maintenances</span></a>
					</li>
					<li>
					  <a href="#history" data-toggle="tab"><span class="hidden-lg hidden-md"><i class="fa fa-history"></i></span> <span class="hidden-xs hidden-sm">History</span></a>
					</li> 
				</ul>
				<div class="tab-content">
					<div class="tab-pane fade in active" id="details">
						<div class="row">
							<div class="col-md-5">
								<div class="table-responsive1">
									<table class="table">
									  <tbody>
										<tr>
											<td>Status</td><td>:</td>
											<td> <i class="fa fa-circle text-blue"></i>
											  <?php echo $showaset['status'];?>
											  <label class="label label-default">Deployed</label>

											  <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
											  <i class="fa fa-user"></i>
											  <a href=""><?php echo $showaset['nama_karyawan'];?></a>
											</td>
										</tr>
										<tr>
										  <td>No. Aset</td><td>:</td>
										  <td><?php echo $showaset['no_aset'];?></td>
										</tr>
										<tr>
										  <td>Ip Address</td><td>:</td>
										  <td><?php echo $showaset['ip_address'];?></td>
										</tr>
										<tr>
										  <td>Asset Tag</td><td>:</td>
										  <td><?php echo $showaset['sn'];?></td>
										</tr> 
										<tr>
										  <td>Kategori</td><td>:</td>
										  <td><a href=""><?php echo $showaset['nama_kategori'];?></a> </td>
										</tr>
										<tr>
										  <td>Model</td><td>:</td>
										  <td><a href=""><?php echo $showaset['model'];?></a>
										 
										</tr>
										<tr>
										  <td>Lokasi</td><td>:</td>
										  <td> <a href="lokasi?aset=<?php echo $showaset['kdukeraset'];?>"><?php echo $showaset['nama_uker'];echo $showaset['nama_bag'];?></a>
										 
										</tr>
										  <tr>
											<td>Tanggal Didaftarkan</td><td>:</td>
											<td><?php echo $showaset['created_at'];?></td>
										  </tr>
											<tr>
											  <td>Tanggal dibagikn</td><td>:</td>
											  <td><?php ?></td>
											</tr>
										</tbody>
									</table>
								</div> <!-- /table-responsive -->
							</div><!-- /col-md-8 -->
							<div class="col-md-3"></div>
							<div class="col-md-4">
								<div class="row">  
								<h4>Dibagikan Ke.</h4>
								<table class="table1 table">
									  <tbody>
										<tr>
											<td > 
											 <i class="fa fa-user"></i> <a href=" "><?php echo $showaset['nama_karyawan'];?></a></td>
										</tr>
										<tr>
										  <td>NIK : 
										  <?php echo $showaset['nik'];?></td>
										</tr> 
										</tbody>
									</table> 
								 
								</div>
								
								<div class="row">  								
								<h4>Spesifikasi</h4>
									<table class="table1 table">
									  <tbody>
										<tr>
											<td>Os</td>
											<td> <?php echo $showaset['os'];?></td>
										</tr>
										<tr>
										  <td>Processor</td>
										  <td><?php echo $showaset['proc'];?></td>
										</tr>
										<tr>
										  <td>Ram/HDD</td>
										  <td><?php echo $showaset['ramhd'];?> </td>
										</tr> 
										</tbody>
									</table> 
								</div>
								 
							</div> <!-- div.col-md-4 -->
						</div><!-- /row -->
					</div><!-- /.tab-pane asset details -->

					<div class="tab-pane fade" id="software">
						<div class="row">
							<div class="col-md-12"> 
							</div><!-- /col -->
						</div> <!-- row -->
					</div> <!-- /.tab-pane software -->

					<div class="tab-pane fade" id="components">
					  <!-- checked out assets table -->
					  <div class="row">
						  <div class="col-md-12">
											  <div class="alert alert-info alert-block">
								<i class="fa fa-info-circle"></i>
								No Results.
							  </div>
										  </div>
					  </div>
					</div> <!-- /.tab-pane components -->


					<div class="tab-pane fade" id="assets">
					  <div class="row">
						<div class="col-md-12">
						  <form method="POST" action=" " accept-charset="UTF-8" class="form-inline" id="bulkForm"> 
						  <div id="toolbar">
							<select name="bulk_actions" class="form-control select2" style="width: 150px;">
							  <option value="edit">Edit</option>
							  <option value="delete">Delete</option>
							  <option value="labels">Generate Labels</option>
							</select>
							<button class="btn btn-primary" id="bulkEdit" disabled>Go</button>
						  </div>

						  <!-- checked out assets table -->
						  <div class="table-responsive">
							<table class="table table-striped snipe-table">
								<thead>
								<tr>
								  <th></th><th>Date</th><th>Admin</th><th>Action</th><th>Item</th><th>Target</th><th>Notes</th><th>Signature</th><th>Download</th><th>Changed</th>
								</tr>
								</thead>
								 <tbody>
								<tr>
								  <td></td><td>Date</td><td>Admin</td><td>Action</td><td>Item</td><td>Target</td><td>Notes</td><td>Signature</td><td>Download</td><td>Changed</td>
								</tr>
								</tbody>
							</table>
							</form>
						  </div>
						</div><!-- /col -->
					  </div> <!-- row -->
					</div> <!-- /.tab-pane software -->


					<div class="tab-pane fade" id="maintenances">
					  <div class="row">
						<div class="col-md-12">
											<div id="maintenance-toolbar">
							  <a href="" class="btn btn-primary">Add Maintenance</a>
							</div>
							
						  <!-- Asset Maintenance table -->
							 <table class="table table-striped snipe-table">
							<thead>
							<tr>
							  <th></th><th>Date</th><th>Admin</th><th>Action</th><th>Item</th><th>Target</th><th>Notes</th><th>Signature</th><th>Download</th><th>Changed</th>
							</tr>
							</thead>
							 <tbody>
							<tr>
							  <td></td><td>Date</td><td>Admin</td><td>Action</td><td>Item</td><td>Target</td><td>Notes</td><td>Signature</td><td>Download</td><td>Changed</td>
							</tr>
							</tbody>
						  </table>

						</div> <!-- /.col-md-12 -->
					  </div> <!-- /.row -->
					</div> <!-- /.tab-pane maintenances -->

					<div class="tab-pane fade" id="history">
					  <!-- checked out assets table -->
					  <div class="row">
						<div class="col-md-12">
						  <table class="table table-striped snipe-table">
							<thead>
							<tr>
							  <th></th><th>Date</th><th>Admin</th><th>Action</th><th>Item</th><th>Target</th><th>Notes</th><th>Signature</th><th>Download</th><th>Changed</th>
							</tr>
							</thead>
							 <tbody>
							<tr>
							  <td></td><td>Date</td><td>Admin</td><td>Action</td><td>Item</td><td>Target</td><td>Notes</td><td>Signature</td><td>Download</td><td>Changed</td>
							</tr>
							</tbody>
						  </table>

						</div>
					  </div> <!-- /.row -->
					</div> <!-- /.tab-pane history -->

					<div class="tab-pane fade" id="files">
					  <div class="row">
						<div class="col-md-12">
						  <table class="table table-striped snipe-table">
							<thead>
							<tr>
							  <th></th><th>Date</th><th>Admin</th><th>Action</th><th>Item</th><th>Target</th><th>Notes</th><th>Signature</th><th>Download</th><th>Changed</th>
							</tr>
							</thead>
							 <tbody>
							<tr>
							  <td></td><td>Date</td><td>Admin</td><td>Action</td><td>Item</td><td>Target</td><td>Notes</td><td>Signature</td><td>Download</td><td>Changed</td>
							</tr>
							</tbody>
						  </table>

						</div> <!-- /.col-md-12 -->
					  </div> <!-- /.row -->
					</div> <!-- /.tab-pane files -->
				</div> <!-- /. tab-content -->
			</div> <!-- /.nav-tabs-custom -->
		</div> <!-- /. col-md-12 -->
	</div> <!-- /. row -->
</div> <!-- /. webUI -->






<?php
} 
?>