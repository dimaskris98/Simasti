<?php
$id = $_POST['consumable-detail'];
$data = mysqli_fetch_array(mysqli_query($conn, "SELECT  * FROM consumable 
				LEFT JOIN kategori ON consumable.id_kategori=kategori.id_kategori
				LEFT JOIN manufaktur ON consumable.id_manufaktur=manufaktur.id_manufaktur WHERE id='$id'"));




?>
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="panel widget-shadow">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#tab1" data-toggle="tab">Detail Pembagian</a></li>
						<li><a href="#tab2" data-toggle="tab">Detail Order</a></li>
						<li class="pull-right"><a href="<?= $_POST['back-link']; ?>"><button type="button" class="btn btn-primary">Kembali</button></a></li>
					</ul>
				</div>
				<div class="tab-content">
					<div id="tab1" class="tab-pane fade in active">
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
											while ($row = $res->fetch_array()) { ?>
												<tr>
													<td><?= $row['tgldibagikan'] ?></td>
													<td><?= $row['nama_karyawan'] ?></td>
													<td><?= $row['qty'] ?></td>
													<td><?= $row['nama'] ?></td>
												</tr>
											<?php }	?>
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
											while ($row = $res->fetch_array()) { ?>
												<tr>
													<td><?= $no++ ?></td>
													<td><?= $row['id_po'] ?></td>
													<td><?= $row['tgl_order'] ?></td>
													<td><?= $row['jumlah'] ?></td>
													<td>Rp.<?= $row['harga'] == "" ? "-" : $row['harga'] ?></td>
													<td><?= $row['nama_sup'] ?></td>
													<td><?= $row['nama'] ?></td>
													<td><?= $row['catatan'] ?></td>
												</tr>
											<?php }	?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>


		</div>
		<div class="col-md-4">
			<div class="panel panel-primary">
				<div class="panel-heading text-center">
					<h4>Tentang Consumable</h4>
				</div>
				<div class="panel-body">

					<div>
						<p class="ex1">Consumables are anything purchased that will be used up over time. For example, printer ink or copier paper.</p>
						<br>
						<p class="ex2">Item No.: <?php echo $data['no_item']; ?></p>
						<p class="ex2">Item Model: <?php echo $data['no_model']; ?></p>
						<p class="ex2">Manufacturer: <?php echo $data['nama_manufaktur']; ?></p>
						<br>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>