 <?php
	$no = $_POST['aset-scrab-detail'];
	$back = $_POST['back'];

	$data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM data_aset_scrab
										LEFT JOIN data_kategori ON data_aset_scrab.kd_kategori=data_kategori.kd_kategori
										LEFT JOIN data_pemasok ON data_aset_scrab.id_sup=data_pemasok.id_sup
										LEFT JOIN status_labels ON data_aset_scrab.status=status_labels.id
										WHERE idscrab=$no"));
	?>
 <section class="content-header" style="padding-bottom: 30px;">
 	<h1 class="pull-left">
 		View Asset <?php echo $data['no_aset']; ?>
 	</h1>
 	<div class="pull-right">
 		<a href="javascript:history.back()" class="btn btn-default">Back</a>
 		&nbsp;&nbsp;
 		<div class="dropdown pull-right">
 			<button class="btn btn-default dropdown-toggle" data-toggle="dropdown">Actions
 				<span class="caret"></span>
 			</button>
 			<ul class="dropdown-menu pull-right" role="menu" aria-labelledby="dropdownMenu1">
 				<form role="form" action="edit" method="POST" enctype="multipart/form-data">
 					<input type="hidden" name="idd" value="<?php echo $data['idscrab']; ?>">
 					<input type="hidden" name="kategori" value="<?php echo $data['kd_kategori']; ?>">
 					<input type="hidden" name="aset-scrab-detail" value="<?php echo $no; ?>">
 					<li role="presentation">&nbsp;&nbsp;&nbsp;&nbsp;<button style="padding: 0; border: none; background:none;" type="submit" name="editasetscrab">Edit</button> </li>
 					<li role="presentation">&nbsp;&nbsp;&nbsp;&nbsp;<button style="padding: 0; border: none; background:none;" type="submit" name="auditasetscrab">Audit</button> </li>
 				</form>
 				<form role="form" action="<?= $back ?> " method="POST" enctype="multipart/form-data">
 					<li role="presentation">&nbsp;&nbsp;&nbsp;&nbsp;
 						<button style="padding: 0; border: none; background:none;" type="submit" name="auditasetscrab">Back</button>
 					</li>
 				</form>
 			</ul>
 		</div>
 	</div>
 </section>
 <section class="content">
 	<!-- Notifications -->
 	<div class="row">
 		<div class="col-md-12">
 			<!-- Custom Tabs -->
 			<div class="nav-tabs-custom">
 				<div class="tab-content">
 					<div class="tab-pane fade in active" id="details">
 						<div class="row">
 							<div class="col-md-8">
 								<div class="table-responsive" style="margin-top: 10px;">
 									<table class="table">
 										<tbody>
 											<tr>
 												<td>Status</td>
 												<td> <?php echo $data['name']; ?></td>
 											</tr>
 											<tr>
 												<td>S/N</td>
 												<td><?php echo $data['sn']; ?></td>
 											</tr>
 											<tr>
 												<td>Kategori</td>
 												<td><a href="<?php echo $data['nama_kategori']; ?>"><?php echo $data['nama_kategori']; ?></a>
 												</td>
 											</tr>
 											<tr>
 												<td>Model</td>
 												<td><?php echo $data['model']; ?></td>
 											</tr>
 											<tr>
 												<td>No. PO</td>
 												<td><?php echo $data['po']; ?> </td>
 											</tr>
 											<tr>
 												<td>Tanggal PO</td>
 												<td> <?php if ($data['tgl_po'] != "0000-00-00") {
															echo  tanggal_indo($data['tgl_po']);
														} ?> </td>
 											</tr>
 											<tr>
 												<td>Harga</td>
 												<td><?php echo rupiah($data['harga']); ?></td>
 											</tr>
 											<tr>
 												<td>Supplier</td>
 												<td><a href=""><?php echo $data['nama_sup']; ?></a></td>
 											</tr>
 											<tr>
 												<td>Catatan</td>
 												<td><?php echo $data['catatan']; ?></td>
 											</tr>
 											<tr>
 												<td>Lokasi</td>
 												<td><?php echo $data['lokasi']; ?></td>
 											</tr>

 											<tr>
 												<td width="150">Tanggal Scrab</td>
 												<td><?php if ($data['tgl_scrab'] != "0000-00-00") {
															echo tanggal_indo2($data['tgl_scrab']);
														} ?></td>
 											</tr>
 										</tbody>
 									</table>
 									<table class="table">
 										<tbody>
 											<tr>
 												<td colspan="2">
 													<h4>Spesifikasi</h4>
 												</td>
 											</tr>
 											<tr>
 												<td width="150">System Operasi</td>
 												<td><?php echo $data['os']; ?></td>
 											</tr>
 											<tr>
 												<td width="150">Processor</td>
 												<td><?php echo $data['proc']; ?></td>
 											</tr>
 											<tr>
 												<td width="150">Ram n Hdd</td>
 												<td><?php echo $data['ramhd']; ?></td>
 											</tr>
 											<tr>
 												<td width="150">Vga External</td>
 												<td><?php echo $data['vga']; ?></td>
 											</tr>
 											<tr>
 												<td width="150">Ip Address</td>
 												<td><?php echo $data['ip']; ?></td>
 											</tr>
 										</tbody>
 									</table>
 								</div> <!-- /table-responsive -->
 							</div><!-- /col-md-8 -->
 							<?php
								if (!empty($data['nik'])) {
									$nik = $data['nik'];
									$karyawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM data_karyawan  
										LEFT JOIN data_uker ON data_karyawan.kd_uker=data_uker.kd_uker  
										LEFT JOIN data_uker_bagian ON data_karyawan.kd_uker=data_uker_bagian.kd_bag
										WHERE nik='$nik'"));
								?>
 								<div class="col-md-4">
 									<h4>Checked Out To</h4>
 									<p>
 									<table>
 										<tr>
 											<td>
 												<i class="fa fa-user"></i>
 											</td>
 											<td>
 												<form action="detail" method="post">
 													<a name="tes" href="javascript:" onclick="parentNode.submit();"><?php echo $karyawan['nama_karyawan']; ?></a>
 													<input type="hidden" name="karyawan-detail" value="<?php echo $karyawan['nik']; ?>" />
 												</form>
 											</td>
 										</tr>
 									</table>
 									</p>
 									<ul class="list-unstyled" style="line-height: 25px;">
 										<li><i class="fa fa-envelope-o"></i> <a href=""><?php echo $karyawan['email']; ?></a></li>
 										<li>
 											<i class="fa fa-phone"></i>
 											<a href=""><?php echo $karyawan['tlp']; ?></a>
 										</li>
 										<li><?php echo $karyawan['nama_uker'] . $karyawan['nama_bag']; ?></li>
 									</ul>
 								</div> <!-- div.col-md-4 -->
 							<?php } ?>
 						</div><!-- /row -->
 					</div><!-- /.tab-pane asset details -->
 				</div> <!-- /. tab-content -->
 			</div> <!-- /.nav-tabs-custom -->
 		</div> <!-- /. col-md-12 -->
 	</div>