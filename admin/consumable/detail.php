<?php
$id = $_GET['id'];
$data = mysqli_fetch_array(mysqli_query($conn, "SELECT  * FROM consumable 
				LEFT JOIN kategori ON consumable.id_kategori=kategori.id_kategori
				LEFT JOIN manufaktur ON consumable.id_manufaktur=manufaktur.id_manufaktur WHERE id='$id'"));




?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel widget-shadow">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#tab0" data-toggle="tab">Detail Item</a></li>
						<li><a href="#tab1" data-toggle="tab">Detail Pembagian</a></li>
						<li><a href="#tab2" data-toggle="tab">Detail Order</a></li>
						<li class="pull-right"><a href="consumables"><button type="button" class="btn btn-primary">Kembali</button></a></li>
					</ul>
				</div>
				<div class="tab-content" style="min-height: 300px;">
					<div id="tab0" class="tab-pane fade in active">
						<div class="panel panel-default" style="border: none;">
							<div class="panel-heading">
								<?= $data['nama_consumable'] ?>
							</div>
							<div class="panel-body">
								<style>
									.mt {
										margin-top: 0px;
									}
								</style>
								<div class="row mt">
									<label class="col-md-2 control-label">Kode Item</label>
									<div class="pull-left">:</div>
									<div class="col-md-9"><?= $data['kode_item'] ?: "-" ?></div>
								</div>
								<div class="row mt">
									<label class="col-md-2 control-label">Warna</label>
									<div class="pull-left">:</div>
									<div class="col-md-9"><?= $data['warna'] ?: "-" ?></div>
								</div>
								<div class="row mt">
									<label class="col-md-2 control-label">No Model</label>
									<div class="pull-left">:</div>
									<div class="col-md-9"><?= $data['no_model'] ?: "-" ?></div>
								</div>
								<div class="row mt">
									<label class="col-md-2 control-label">Kategori</label>
									<div class="pull-left">:</div>
									<div class="col-md-9"><?= $data['nama_kategori'] ?: "-" ?></div>
								</div>
								<div class="row mt">
									<label class="col-md-2 control-label">Manufaktur</label>
									<div class="pull-left">:</div>
									<div class="col-md-9"><?= $data['nama_manufaktur'] ?: "-" ?></div>
								</div>
								<div class="row mt">
									<label class="col-md-2 control-label">Stok</label>
									<div class="pull-left">:</div>
									<div class="col-md-9"><?= $data['sisa'] ?: "-" ?></div>
								</div>
								<div class="row mt">
									<label class="col-md-2 control-label">Min Stok</label>
									<div class="pull-left">:</div>
									<div class="col-md-9"><?= $data['minqty'] ?: "-" ?></div>
								</div>
								<div class="row mt">
									<label class="col-md-2 control-label">Keterangan</label>
									<div class="pull-left">:</div>
									<div class="col-md-9"><?= $data['keterangan'] ?: "-" ?></div>
								</div>
							</div>
						</div>
					</div>
					<div id="tab1" class="tab-pane fade in">
						<div class="panel">
							<div class="panel-body ">
								<div class="box-header with-border">
									<h4><?php echo $data['nama_kategori'] . ' ' . $data['nama_consumable']; ?></h4>
								</div><!-- /.box-header -->
								<div class="box-body">
									<table id="example1" class="table">
										<thead>
											<tr>
												<th>Tanggal</th>
												<th>User</th>
												<th>Qty</th>
												<th>Admin</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$res = $conn->query("SELECT  *, data_karyawan.*, users.* FROM consumable_user 
													LEFT JOIN data_karyawan ON consumable_user.dibagikanke=data_karyawan.nik
													LEFT JOIN users ON consumable_user.id_user=users.id_user WHERE id_consumable='$id'");
											if ($res->num_rows > 0) {
												while ($row = $res->fetch_array()) { ?>
													<tr>
														<td><?= $row['tgldibagikan'] ?></td>
														<td><?= $row['nama_karyawan'] ?></td>
														<td><?= $row['qty'] ?></td>
														<td><?= $row['nama'] ?></td>
													</tr>
												<?php }
											} else { ?>
												<tr>
													<td colspan="4" class="text-center"><i>Data masih kosong</i></td>
												</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div id="tab2" class="tab-pane fade in">
						<div class="panel">
							<div class="panel-body ">
								<div class="box-header with-border">
									<h4><?php echo $data['nama_kategori'] . ' ' . $data['nama_consumable']; ?></h4>
								</div><!-- /.box-header -->
								<div class="box-body">
									<table id="example1" class="table">
										<thead>
											<tr>
												<th>No.</th>
												<th>Nomor PO</th>
												<th>Tanggal</th>
												<th>Jumlah</th>
												<th>Harga</th>
												<th>Supplier</th>
												<th>Admin</th>
												<th>Catatan</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$no = 1;
											$res = $conn->query("SELECT * FROM order_consumable as a 
													LEFT JOIN data_pemasok as b ON b.id_sup=a.id_sup
													LEFT JOIN users ON a.admin=users.id_user WHERE id_consum='$id'");
											if ($res->num_rows > 0) {
												while ($row = $res->fetch_array()) { ?>
													<tr>
														<td><?= $no++ ?></td>
														<td><?= $row['id_po'] ?></td>
														<td><?= $row['tgl_order'] ?></td>
														<td><?= $row['jumlah'] ?></td>
														<td>Rp. <?= $row['harga'] == "" ? "-" : harga($row['harga']) ?></td>
														<td><?= $row['nama_sup'] ?></td>
														<td><?= $row['nama'] ?></td>
														<td><?= $row['catatan'] ?></td>
													</tr>
												<?php }
											} else { ?>
												<tr>
													<td colspan="8" class="text-center"><i>Data masih kosong</i></td>
												</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>


		</div>
	</div>
</div>