<?php

if (isset($_POST['simpaconsumable-edit'])) {
	$id = $_POST['id'];
	$nama = $_POST['nama'];
	$kategori = $_POST['kategori'];
	$manufaktur = $_POST['manufaktur'];
	$model = $_POST['model'];
	$item = $_POST['item'];
	$sisa = $_POST['sisa'];
	$minqty = $_POST['minqty'];
	$warna = $_POST['warna'];
	$keterangan = $_POST['keterangan'];
	//Memasukkan data 
	$sql 	= "UPDATE consumable SET nama_consumable='$nama', id_kategori='$kategori', id_manufaktur='$manufaktur', 
		no_model='$model', kode_item='$item', sisa='$sisa', minqty='$minqty', warna = '$warna', keterangan = '$keterangan' 
		WHERE id='$id'";
	$query	= mysqli_query($conn, $sql);
	echo $conn->error;
}
?>

<section class="content-header">
	<h1 class="pull-left"><?php echo $mod; ?></h1>
	<div class="pull-right">
		<form role="form" action="add" method="POST" enctype="multipart/form-data">
			<button type="submit" name="consumable-add" class="btn btn-primary btn-md">Baru</button>
			<a href="con-order" class="btn btn-primary btn-md">Order</a>
		</form>
	</div>
</section>
<br>
<section class="content">
	<div class="webui">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-default">
					<div class="box-body table-responsive tables">
						<table id="" class="tabledisplay table table-bordered table-striped">
							<thead>
								<tr>
									<th style="width: 30px;">No.</th>
									<th>Kode Item</th>
									<th>Nama</th>
									<th>Warna</th>
									<th>Kategori</th>
									<th>Manufaktur</th>
									<th>No Model</th>
									<th>Sisa</th>
									<th>Status</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								$res = $conn->query("SELECT  * FROM consumable 
														LEFT JOIN kategori ON consumable.id_kategori=kategori.id_kategori 
														LEFT JOIN manufaktur ON consumable.id_manufaktur=manufaktur.id_manufaktur");
								while ($row = $res->fetch_assoc()) {
									$string = $row['id'];
								?>
									<tr>
										<td><?= $no++ ?></td>
										<td><a href="consumable-detail?id=<?= $row['id'] ?>"><?= $row['kode_item'] ?></a>
										</td>
										<td><?= $row['nama_consumable'] ?></td>
										<td><?= $row['warna'] ?></td>
										<td><?= $row['nama_kategori'] ?></td>
										<td><?= $row['nama_manufaktur'] ?></td>
										<td><?= $row['no_model'] ?></td>
										<td><?= $row['sisa'] ?></td>
										<td><?= $row['sisa'] > $row['minqty']
												? "<span class='label label-success'>Stok Aman</span>"
												: "<span class='label label-danger'>Harus Beli</span>" ?></td>
										<td>
											<form role="form" action="edit" method="POST" enctype="multipart/form-data">
												<input type="hidden" name="id" value="<?= $row['id'] ?>">
												<input type="hidden" name="back-link" value="<?= $mod ?>">
												<?php
												if ($row['sisa'] <= 1) {
													echo '<a href="javascript:void(0);" title=" disabled"><span class="btn btn-sm btn-primary" >Bagikan</span></a>';
												} else {
													echo '<a href="chekout?cons=' . $string . '" title="Edit Data"><span class="btn btn-primary btn-sm" >Bagikan</span></a>';
												}
												?>
												<a href="con-order?id=<?= $row['id'] ?>" data-toggle="tooltip" title="Order" class="btn btn-success btn-sm">Order</a>
												|
												<button type="submit" data-toggle="tooltip" title="Edit" name="consumable-edit" class="btn btn-primary btn-sm"><span class="fa fa-pencil" aria-hidden="true"></span></button>
												<button type="submit" data-toggle="tooltip" title="Hapus" name="consumable-hapus" onclick="return confirm('Anda yakin akan menghapus data <?= $row['nama_consumable'] ?>?')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
												
											</form>
										</td>
									</tr>
								<?php }	?>
							</tbody>
						</table>

					</div>
				</div>

			</div>
		</div>
	</div>
</section>

<div class="">

</div>