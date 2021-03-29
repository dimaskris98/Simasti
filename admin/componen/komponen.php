<?php

if (isset($_POST['add'])) {
	echo '<script>window.location="komponen-creat"</script>';
}


if (isset($_POST['hapus'])) {
	$id = $_POST['idd'];
	$sql 	= 'delete from komponen where id="' . $id . '"';
	$query	= mysqli_query($conn, $sql);
}

?>
<section class="content-header" style="padding-bottom: 30px;">
	<h1 class="pull-left"><?php echo $mod; ?></h1>
	<div class="pull-right">
		<form role="form" action="" method="POST" enctype="multipart/form-data">
			<button type="submit" class="btn btn-primary btn-md" name="add">Buat Baru</button>
			<a href="komponen-order" class="btn btn-primary btn-md">Order</a>
		</form>
	</div>


</section>
<section class="content">
	<div class="webui">
		<div class="row">
			<div class="col-md-12 panel-grids">
				<div class="box box-default">
					<div class="box-body table-responsive">
						<table id="" class="tabledisplay table table-bordered table-striped">
							<thead>
								<tr>
									<th>Nama</th>
									<th>Kategori</th>
									<th>Stok</th>
									<th>Sisa</th>
									<th>Min.QTY</th>
									<th>Keterangan</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php

								$res = $conn->query("SELECT  * FROM komponen 
														LEFT JOIN kategori ON komponen.id_kategori=kategori.id_kategori");
								while ($row = $res->fetch_assoc()) {
									$string = $row['id']; ?>
									<tr>
										<form role="form" action="" method="POST" enctype="multipart/form-data">
											<input type="hidden" name="idd" value="<?= $row['id'] ?>">
											<td><a href="komponen-detail?id=<?= $row['id'] ?>" title="Detail Aset"><?= $row['nama_komponen'] ?></a></td>
											<td><?= $row['nama_kategori'] ?></td>
											<td><?= $row['stok'] ?></td>
											<td><?= $row['sisa'] ?></td>
											<td><?= $row['min_qty'] ?></td>
											<td><?= $row['keterangan'] ?></td>
											<td>
												<?php
												if ($row['sisa'] <= 0) {
													echo '<a class="btn btn-primary btn-sm" disabled>Bagikan</a>';
												} else {
													echo '<a href="chekout?komp=' . $string . '" title="Edit Data"><span class="btn btn-primary btn-sm" >Bagikan</span></a>';
												} ?>
												<a href="komponen-order?id=<?= $row['id'] ?>" data-toggle="tooltip" title="Order" class="btn btn-success btn-sm">Order</a>
												|
												<a href="komponen-edit?id=<?= $string ?>" title="Edit Data" class="btn btn-primary btn-sm"><span class="fa fa-pencil" aria-hidden="true"></span></a>
												<button type="submit" name="hapus" onclick="return confirm('Anda yakin akan menghapus data <?= $row['nama_komponen'] ?>?')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
											</td>
									</tr>
									</form>
								<?php 	}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>