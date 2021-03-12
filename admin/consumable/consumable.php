<?php

if (isset($_POST['simpaconsumable-edit'])) {
	$id = $_POST['id'];
	$nama = $_POST['nama'];
	$kategori = $_POST['kategori'];
	$manufaktur = $_POST['manufaktur'];
	$model = $_POST['model'];
	$item = $_POST['item'];
	$tgl = $_POST['tgl'];
	$pemasok = $_POST['pemasok'];
	$po = $_POST['po'];
	$harga = $_POST['harga'];
	$qtyawal = $_POST['qtyawal'];
	$qty = $_POST['qty'];
	$sisa = $_POST['sisa'];
	$a = $qty - $qtyawal;
	$b = $sisa + $a;

	$minqty = $_POST['minqty'];
	//Memasukkan data 
	$sql 	= "UPDATE consumable SET nama_consumable='$nama', id_kategori='$kategori', id_manufaktur='$manufaktur', 
		no_model='$model', no_item='$item', po='$po', tgl_po='$tgl',id_sup='$pemasok' ,harga='$harga' 
		,qty='$qty' ,sisa='$b' ,minqty='$minqty', status='Banyak'
		WHERE id='$id'";
	$query	= mysqli_query($conn, $sql);
}
?>

<section class="content-header">
	<div class="pull-left">
		<h4>Consumable</h4>
	</div>
	<div class="pull-right">
		<form role="form" action="add" method="POST" enctype="multipart/form-data">
			<button type="submit" name="consumable-add" class="btn btn-primary btn-md">new</button>
		</form>
	</div>
</section>
<br>
<section class="content">
	<div class="webui">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-default">
					<div class="box-body table-responsive">
						<table id="" class="tabledisplay table table-bordered table-striped">
							<thead>
								<tr>
									<th>Nama</th>
									<th>Kategori</th>
									<th>Manufaktur</th>
									<th>No Model</th>
									<th>No Item</th>
									<th>Total</th>
									<th>Sisa</th>
									<th>Min.QTY</th>
									<th>No.PO</th>
									<th>Harga</th>
									<th>Tanggl PO</th>
									<th>Status</th>
									<th>In/Out</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php

								$res = $conn->query("SELECT  * FROM consumable 
				LEFT JOIN kategori ON consumable.id_kategori=kategori.id_kategori 
				LEFT JOIN manufaktur ON consumable.id_manufaktur=manufaktur.id_manufaktur");
								while ($row = $res->fetch_assoc()) {
									$string = $row['id'];
									echo '
					<tr>
						<td>
							<form action="detail" method="post">
								<a name="tes" href="javascript:" onclick="parentNode.submit();"> ' . $row['nama_consumable'] . '</a>
								<input type="hidden" name="consumable-detail" value="' . $row['id'] . '"/>
								<input type="hidden" name="back-link" value="' . $mod . '" >
							</form>
						 </td>
						<td>' . $row['nama_kategori'] . '</td>
						<td>' . $row['nama_manufaktur'] . '</td>
						<td>' . $row['no_model'] . '</td>
						<td>' . $row['no_item'] . '</td>
						<td>' . $row['qty'] . '</td>
						<td>' . $row['sisa'] . '</td>
						<td>' . $row['minqty'] . '</td>
						<td>' . $row['po'] . '</td>
						<td>' . number_format($row['harga'], 0, ',', '.') . '</td>
						<td>' . $row['tgl_po'] . '</td>';
									if ($row['sisa'] > $row['minqty']) {
										echo '<td> <span class="label label-success" >Banyak</span></td>';
									} else if ($row['sisa'] <= $row['minqty'] && $row['sisa'] > 1) {
										echo '<td> <span class="label label-warning" >Sedikit</span></td>';
									} else if ($row['sisa'] <= 1) {
										echo '<td> <span class="label label-danger" >Habis</span></td>';
									};
									echo '
						  
						<td>';
									if ($row['sisa'] <= 1) {
										echo '<a href="javascript:void(0);" title=" disabled"><span class="label label-default" >ChekOut</span></a>';
									} else {
										echo '<a href="chekout?cons=' . $string . '" title="Edit Data"><span class="label label-success" >ChekOut</span></a>';
									}
									echo '</td>  
						<td>
							<form role="form" action="edit" method="POST" enctype="multipart/form-data">
								<input type="hidden" name="id" value="' . $row['id'] . '" > 
								<input type="hidden" name="back-link" value="' . $mod . '" > 		
								<button type="submit" name="consumable-edit" class="btn btn-primary btn-sm"><span class="fa fa-pencil" aria-hidden="true"></span></button>
								<button type="submit" name="consumable-hapus" onclick="return confirm(\'Anda yakin akan menghapus data ' . $row['nama_consumable'] . '?\')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
							</form>
						 </td>							
					</tr>';
								}
								?>
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