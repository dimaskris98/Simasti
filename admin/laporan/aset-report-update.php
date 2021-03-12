<style>
	table,
	td,
	th {
		border: 1px solid black;
		font-size: 12px;
	}

	table.a {
		border: 0px;

	}

	tr.b {
		border: 0px;

	}

	table {
		border-collapse: collapse;
		width: auto;
	}

	th,
	td {
		padding: 4px;
		word-wrap: break-word;
	}

	td.c {
		padding: 0px;
	}

	th {
		text-align: center;
	}

	p.tebal {
		font-weight: bold;
	}

	.kolom1 {

		width: auto;
		padding: 5px;
		float: left;
	}
</style>
<div class="panel-info widget-shadow">
	<form class="form-horizontal" method="POST" action="">
		<div class="form-group">

			<label class="col-sm-7 control-label">
				<h4>Pilih Tanggal :</h4>
			</label>

			<div class="col-sm-4">
				<input type="text" class="form-control tglpicker" placeholder="Tanggal" name="tanggal1" id="tglpicker" required>
				S/D
				<input type="text" class="form-control tglpicker" placeholder="Tanggal" name="tanggal2" id="tglpicker" required>
			</div>
			<button type="submit" name="submit" class="btn btn-danger btn-md"><span>Tampilkan</span></button>
		</div>
	</form>

	<hr>

	<?php
	if (isset($_POST['submit'])) {
		$tanggal1 = $_POST['tanggal1'];
		$tanggal2 = $_POST['tanggal2'];
		$sql = "SELECT  * FROM data_aset";

		$query = mysqli_query($conn, $sql . " WHERE update_at BETWEEN '$tanggal1' AND '$tanggal2' OR checkout_date BETWEEN '$tanggal1' AND '$tanggal2' order by update_at ASC");

		$title = '<center>Laporan Aset Tanggal ' . $tanggal1 . ' s/d ' . $tanggal2 . '</center>';


		echo '<h2>' . $title . '</h2>';
		echo $message = '<p style="text-align:right;">Tanggal : ' . $tanggal1 . ' s/d ' . $tanggal2 . '</p>';
		echo '<br>';
	?>
		<div class="box-body table-responsive">
			<table id="" class="table tabledisplay table-bordered table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>Nomor Aset</th>
						<th>Tahun</th>
						<th>Model</th>
						<th>Unit Kerja</th>
						<th>Tanggal Registrasi</th>
						<th>Tanggal Keluar</th>
						<th>Tanggal Update</th>
						<th>Catatan</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					while ($row = mysqli_fetch_array($query)) {
					?>
						<tr>
							<td><?= $no ?></td>
							<td><?= $row['no_aset'] ?></td>
							<td><?= $row['tahun'] ?></td>
							<td><?= $row['model'] ?></td>
							<td><?= $row["nama_unitkerja"] ?></td>
							<td><?= $row['created_at'] ?></td>
							<td><?= $row['checkout_date'] ?></td>
							<td><?= $row['update_at'] ?></td>
							<td><?= $row['catatan'] ?></td>
						</tr>
					<?php
						$no++;
					}
					?>
				</tbody>
				<tfoot>
					<tr>
						<th>#</th>
						<th>Nomor Aset</th>
						<th>Tahun</th>
						<th>Model</th>
						<th>Unit Kerja</th>
						<th>Tanggal Registrasi</th>
						<th>Tanggal Keluar</th>
						<th>Tanggal Update</th>
						<th>Catatan</th>
					</tr>
				</tfoot>
			</table>
		</div>
	<?php
	}
