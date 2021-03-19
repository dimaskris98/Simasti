<?php
$id = $_GET['detil'];
$data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM komponen 
				LEFT JOIN kategori ON komponen.id_kategori=kategori.id_kategori WHERE id='$id'"));




?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel widget-shadow">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#tab1" data-toggle="tab">Detail Pembagian</a></li>
						<li><a href="#tab2" data-toggle="tab">Detail Order</a></li>
						<li class="pull-right"><a href="komponen"><button type="button" class="btn btn-primary">Kembali</button></a></li>
					</ul>
				</div>
				<div class="tab-content">
					<div id="tab1" class="tab-pane fade in active">
						<div class="panel">
							<div class="panel-body ">
								<div class="box-header with-border">
									<h4><?php echo $data['nama_kategori'] . ' ' . $data['nama_komponen']; ?></h4>
								</div><!-- /.box-header -->
								<div class="box-body">
									<table id="example1" class="table">
										<thead>
											<tr>
												<th>No.</th>
												<th>Tanggal</th>
												<th>Aset</th>
												<th>Admin</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$no=1;
											$res = $conn->query("SELECT * FROM komponen_aset as a 
													LEFT JOIN data_aset as b ON a.id_aset=b.no
													LEFT JOIN users as c ON a.id_user=c.id_user WHERE id_komponen='$id'");
											while ($row = $res->fetch_array()) { ?>
												<tr>
													<td><?= $no++; ?></td>
													<td><?= $row['tgldibagikan'] ?></td>
													<td><?= $row['no_aset'] ?></td>
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
									<h4><?php echo $data['nama_kategori'] . ' ' . $data['nama_komponen']; ?></h4>
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
											$res = $conn->query("SELECT * FROM order_komponen as a 
													LEFT JOIN data_pemasok as b ON b.id_sup=a.id_sup
													LEFT JOIN users ON a.admin=users.id_user WHERE id_komp='$id'");
											while ($row = $res->fetch_array()) { ?>
												<tr>
													<td><?= $no++ ?></td>
													<td><?= $row['id_po'] ?></td>
													<td><?= $row['tgl_order'] ?></td>
													<td><?= $row['jumlah'] ?></td>
													<td>Rp.<?= $row['harga'] == "" ? "-" : harga($row['harga']) ?></td>
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
	</div>
</div>