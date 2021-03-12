<style type='text/css'>
	p.ex1 {

		padding-left: 10px;
	}

	p.ex2 {

		padding-left: 30px;
	}
</style>

<?php

$res = $conn->query("SELECT  * FROM komponen 
				LEFT JOIN kategori ON komponen.id_kategori=kategori.id_kategori 
				LEFT JOIN data_pemasok ON komponen.id_sup=data_pemasok.id_sup WHERE id='$_GET[detil]'");

$data = $res->fetch_array();


?>
<div class="row">
	<div class="col-md-offset-11 col-md-1">
		<a href="komponen" class="btn btn-primary">Kembali</a>
	</div>
</div>
<div class="row">
	<div class="col-md-8">
		<div class="panel-body widget-shadow">
			<h4><?php echo $data['nama_kategori'] . ' ' . $data['nama_komponen']; ?></h4>
			<hr>
			<table id="example1" class="table">
				<thead>
					<tr>
						<th>Tanggal</th>
						<th>Asset</th>
						<th>No. Serial</th>
						<th>Admin</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$res = $conn->query("SELECT  *, data_aset.*, users.* FROM komponen_aset
				LEFT JOIN data_aset ON komponen_aset.id_aset=data_aset.no
				LEFT JOIN users ON komponen_aset.id_user=users.id_user WHERE id_komponen='$_GET[detil]'");
					while ($row = $res->fetch_array()) {
						echo '
						<tr> 
							<td>' . $row['tgldibagikan'] . '</td>
							<td><a href="aset-detail?no=' . $row['no'] . '" title="Detail Aset">' . $row['no_aset'] . '</a></td>
							<td>' . $row['serial'] . '</td>
							<td>' . $row['nama'] . '</td>
						</tr>
					
					
				';
					}
					?>

				</tbody>
			</table>
		</div>
	</div>


	<div class="col-md-2 profile widget-shadow">
		<h4 class="title3">Tentang Komponen</h4>
		<div>
			<p class="ex1">Consumables are anything purchased that will be used up over time. For example, printer ink or copier paper.</p>
			<br>
			<p class="ex2">Purchase Date: <?php echo $data['tgl_po']; ?></p>
			<p class="ex2">Purchase Cost: Rp <?php echo number_format($data['harga_po'], 0, ',', '.'); ?></p>
			<p class="ex2">Order Number: <?php echo $data['po']; ?> </p>
			<br>
		</div>
	</div>


</div>