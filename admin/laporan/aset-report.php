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

	table.dataTable thead th {
		border-bottom: 2px solid #ddd !important;
	}

	table {
		border-collapse: collapse;
		width: auto;
	}

	th,
	td {
		vertical-align: middle !important;
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

			<label class="col-sm-8 control-label">
				<h4>Unit Kerja :</h4>
			</label>

			<div class="col-sm-3">
				<select name="uker" id="uker" class="  selectpicker" data-live-search="true" required>
					<option>Pilih Unit Kerja</option>
					<?php
					$res = $conn->query("SELECT * FROM data_aset group by kd_uker");
					while ($row = $res->fetch_assoc()) {
						echo '<option value="' . $row['kd_uker'] . '">' . $row['nama_unitkerja'] . '</option>';
					}
					?>
				</select>
			</div>
			<button type="submit" name="submit" class="btn btn-danger btn-md"><span>Tampilkan</span></button>
		</div>
	</form>

	<?php
	if (isset($_POST['submit'])) {
		$kduker = $_POST['uker'];
		$newkd = substr($kduker, 0, 3);
		$terisi = mysqli_fetch_array(mysqli_query($conn, "Select (g1+g2+g3+g4+g5+g6+g7+gpk) AS totalisi From data_uker where kd_uker='$kduker'"));
		$terisiNonOrganik = mysqli_fetch_array(mysqli_query($conn, "Select SUM(non_organik_bag) AS totalisiNonOrganik From data_uker_bagian where kd_uker='$kduker'"));
		$formasibag = mysqli_fetch_array(mysqli_query($conn, "Select SUM(formasi) AS total From data_uker_bagian where kd_uker='$kduker'"));
		$formasibagnonorganik = mysqli_fetch_array(mysqli_query($conn, "Select SUM(formasi_non_organik) AS formasi_non_organik From data_uker_bagian where kd_uker='$kduker'"));
		$jumlahaset = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM data_aset WHERE kd_uker = '$kduker'"));
		$res = $conn->query("SELECT * FROM  data_uker where kd_uker='$kduker'");
		//SELECT * , data_uker_bagian.* FROM  data_uker INNER JOIN data_uker_bagian ON data_uker.kd_uker=data_uker_bagian.kd_uker where data_uker.kd_uker='$kduker'	 
		$uker = [];
		while ($ker = $res->fetch_assoc()) {
			$uker = $ker;
			$totalformasi = $formasibag['total'] + $ker['formasi_uker'];
			$totalFormasiNonOrganik = $formasibagnonorganik['formasi_non_organik'] + $ker['formasi_non_organik'];
			$totalterisiNonOrganik = $terisiNonOrganik['totalisiNonOrganik'] + $ker['non_organik'];
		}
	?>

		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab1" data-toggle="tab">Laporan Aset</a></li>
				<li><a href="#tab2" data-toggle="tab">Laporan Total</a></li>
				<li><a href="#tab3" data-toggle="tab">Laporan Detail Unit Kerja</a></li>
			</ul>
		</div>

		<div class="tab-content">
			<div id="tab1" class="tab-pane fade in active">
				<div class="tables">
					<!-- TABEL DISTRIBUSI ASET -->
					<div class="row">
						<h4 class="text-center">LAPORAN DISTRIBUSI ASET</h4>
						<div class="clearfix"></div>
						<table class="table table-condensed table-hover table-responsive table-striped table-bordered" id="lapDisDep">
							<thead>
								<tr class="info">
									<th width="50px" rowspan="2">No.</th>
									<th rowspan="2">No.Aset</th>
									<th rowspan="2">Model</th>
									<th rowspan="2">Unit Kerja</th>
									<th colspan="2">PIC</th>
									<th width="50px" rowspan="2">Sewa</th>
								</tr>
								<tr class="info">
									<th>NIK</th>
									<th style="border-right-width: 1px;">Nama</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$sqlUker = "SELECT kd_bag FROM data_uker_bagian WHERE kd_uker = '$kduker'";
								$sql = "SELECT * FROM data_aset WHERE kd_uker = '$kduker' OR kd_uker IN ($sqlUker)";
								if (!($query = mysqli_query($conn, $sql))) {
									echo mysqli_error($conn);
								};
								$no = 1;
								while ($row = mysqli_fetch_assoc($query)) { ?>
									<tr>
										<td class="text-center" scope="row"><?= $no ?></td>
										<td><?= $row['no_aset'] ?></td>
										<td><?= $row['model'] ?></td>
										<td><?= $row['nama_unitkerja'] ?></td>
										<td><?= $row['nik'] ?></td>
										<td><?= $row['nama_karyawan'] ?></td>
										<td class="text-center"><?= $row['sewa'] == "1" ? "Ya" : "Tidak" ?></td>
									</tr>
								<?php $no++;
								}
								?>
							</tbody>
							<tfoot>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
			<div id="tab2" class="tab-pane fade">
				<div class="tables">
					<!-- TABLE DIS ASLI -->
					<div class="row" style="width: 75%;margin: auto;">
						<h4 class="text-center"><strong>LAPORAN TOTAL ASET</strong></h4>
						<div class="clearfix"></div>
						<table class="table table-hover table-responsive table-condensed table-bordered table-striped laporan">
							<thead>
								<tr class="info">
									<th rowspan="3">Nama Unit Kerja/Bagian</th>
									<th rowspan="3">Formasi</th>
									<th colspan="9">Jumlah Aset</th>
								</tr>
								<tr class="info">
									<?php
									$res = $conn->query("SELECT * FROM data_kategori  ORDER BY id ASC");
									while ($row = $res->fetch_assoc()) {
										$kdkat = $row['kd_kategori'];
										if ($kdkat == 'cp') {
											echo '<th colspan="2" align="center">' . $row['nama_kategori'] . ' </th>';
										} else {
											echo '<th rowspan="2" align="center">' . $row['nama_kategori'] . ' </th>';
										}
									}

									?>
								</tr>
								<tr class="info">
									<th>PG</th>
									<th style="border-right-width: 1px">Sewa</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><a href="#<?= $uker['kd_uker'] ?>"><?= $uker['nama_uker'] ?></a></td>
									<td align="center"><?= $uker['formasi_uker'] ?></td>
									<?php
									$res = $conn->query("SELECT * FROM data_kategori ORDER BY id ASC");
									while ($row = $res->fetch_assoc()) {
										$kdkat = $row['kd_kategori'];
										$tot = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM data_aset
													WHERE data_aset.kd_uker='$kduker' and data_aset.kd_kategori='$kdkat'"));
										if ($kdkat == 'cp') {
											$pcaset = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM data_aset WHERE kd_uker='$kduker' and kd_kategori = 'cp' and sewa='0'"));
											$pcsewa = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM data_aset WHERE kd_uker='$kduker' and kd_kategori = 'cp' and sewa='1'"));
											echo '<td align="center">' . $pcaset . ' </td>
														  <td align="center">' . $pcsewa . ' </td>';
										} else {
											echo '<td align="center">' . $tot . ' </td>';
										}
									} ?>
								</tr>
								<?php
								$showbag = $conn->query("SELECT * FROM data_uker_bagian where kd_uker='$kduker'");
								while ($rowbag = $showbag->fetch_assoc()) {
									$kdbag = $rowbag['kd_bag'];
									$totalasetbagian = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM data_aset WHERE kd_uker = '$kdbag'")); ?>
									<tr>
										<td><a href="#<?= $kdbag ?>"><?= $rowbag['nama_bag'] ?></a></td>
										<td align="center"><?= $rowbag['formasi'] ?></td>
										<?php
										$res = $conn->query("SELECT * FROM data_kategori ORDER BY id ASC");
										while ($row = $res->fetch_assoc()) {
											$kdkat = $row['kd_kategori'];
											$totbag = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM data_aset WHERE data_aset.kd_uker='$kdbag' and data_aset.kd_kategori='$kdkat'"));
											if ($kdkat == 'cp') {
												$pcaset = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM data_aset WHERE kd_uker='$kdbag' and kd_kategori = 'cp' and sewa='0'"));
												$pcsewa = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM data_aset WHERE kd_uker='$kdbag' and kd_kategori = 'cp' and sewa='1'"));
												echo '<td align="center">' . $pcaset . ' </td><td align="center">' . $pcsewa . ' </td>';
											} else {
												echo '<td align="center"> ' . $totbag . ' </td>';
											}
										} ?>
									</tr>
								<?php } ?>
							</tbody>
							<tfoot>
								<tr class="info">
									<td>Sub Total<br></td>
									<td align="center"><?= $totalformasi ?><br></td>
									<?php
									$totalall = 0;
									$totalpg = 0;
									$totalsewa = 0;
									$res = $conn->query("SELECT * FROM data_kategori ORDER BY id ASC ");
									while ($row = $res->fetch_assoc()) {
										$kdkat = $row['kd_kategori'];
										if ($kdkat == 'cp') {
											$pcaset = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM data_aset WHERE kd_uker='$kduker' and kd_kategori = 'cp' and sewa='0'"));
											$pcsewa = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM data_aset WHERE kd_uker='$kduker' and kd_kategori = 'cp' and sewa='1'"));
										} else {
											$dep = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM data_aset WHERE kd_kategori='$kdkat' AND kd_uker = '$kduker'"));
										}
										$totalbg = 0;
										$totalbgpg = 0;
										$totalbgsewa = 0;

										$sqlbag = $conn->query("SELECT * FROM data_uker_bagian where kd_uker='$kduker' ");
										while ($rowbag = $sqlbag->fetch_assoc()) {
											$kdbag = $rowbag['kd_bag'];
											if ($kdkat == 'cp') {
												$pcasetbg = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM data_aset WHERE kd_uker='$kdbag' and kd_kategori = 'cp' and sewa='0'"));
												$pcsewabg = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM data_aset WHERE kd_uker='$kdbag' and kd_kategori = 'cp' and sewa='1'"));
												$totalbgpg += $pcasetbg;
												$totalbgsewa += $pcsewabg;
											} else {
												$pc = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM data_aset WHERE kd_kategori='$kdkat' AND kd_uker = '$kdbag'"));
											}

											$totalbg += $pc;
										}

										$totalall = $totalbg + $dep;
										$totalpg = $totalbgpg + $pcaset;
										$totalsewa = $totalbgsewa + $pcsewa;
										if ($kdkat == 'cp') {
											echo '<td align="center">' . $totalpg . '<br></td><td align="center">' . $totalsewa . '<br></td>';
										} else {
											echo '<td align="center">' . $totalall . '<br></td>';
										}
									}

									?>
								</tr>
							</tfoot>
						</table>
					</div>
					<div class="clearfix">
						<hr>
					</div>
					<!-- TABLE KEBUTUHAN -->
					<div class="row" style="width: 75%;margin: auto;">
						<h4 class="text-center"><strong>LAPORAN PERMINTAAN KEBUTUHAN</strong></h4>
						<div class="clearfix"></div>
						<table style="width: 100%" class="table table-striped table-responsive table-bordered laporan">
							<thead>
								<tr class="info">
									<th rowspan="2">Nama Unit Kerja/Bagian</th>
									<th colspan="8">Kebutuhan Aset</th>
								</tr>
								<tr class="info">
									<?php
									//kebutuhan
									$res = $conn->query("SELECT * FROM data_kategori  ORDER BY id ASC");
									while ($row = $res->fetch_assoc()) {
										$kdkat = $row['kd_kategori'];
										echo '<th align="center">' . $row['nama_kategori'] . ' </th>';
									} ?>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><a href="#<?= $uker['kd_uker']; ?>"><?= $uker['nama_uker']; ?></a></td>
									<?php
									//kebutuhan
									$res = $conn->query("SELECT * FROM data_kategori ORDER BY id ASC");
									while ($row = $res->fetch_assoc()) {
										$kdkat = $row['kd_kategori'];
										$reskebutuhan = $conn->query("SELECT * FROM kebutuhan where id_uker='$kduker' and id_kategori='$kdkat'");
										$rowcount = mysqli_num_rows($reskebutuhan);
										if (($rowcount) == 0) {
											echo '<td align="center">0</td>';
										} else {
											while ($rowreskebutuhan = $reskebutuhan->fetch_assoc()) { ?>
												<td style="text-align:center;"><?php echo $rowreskebutuhan['qty']; ?></td>
									<?php
											}
										}
									} ?>
								</tr>
								<?php
								$showbag = $conn->query("SELECT * FROM  data_uker_bagian where kd_uker='$kduker'");
								while ($rowbag = $showbag->fetch_assoc()) {
									$kdbag = $rowbag['kd_bag']; ?>
									<tr>
										<td><a href="#<?= $rowbag['kd_bag']; ?>"><?= $rowbag['nama_bag']; ?></a></td>
										</td>
										<?php
										//kebutuhan
										$res = $conn->query("SELECT * FROM data_kategori ORDER BY id ASC");
										while ($row = $res->fetch_assoc()) {
											$kdkat = $row['kd_kategori'];
											$reskebutuhan = $conn->query("SELECT * FROM kebutuhan where id_uker='$kdbag' and id_kategori='$kdkat'");
											$rowcount = mysqli_num_rows($reskebutuhan);
											if (($rowcount) == 0) {
												echo '<td align="center">0</td>';
											} else {
												while ($rowreskebutuhan = $reskebutuhan->fetch_assoc()) { ?>
													<td style="text-align:center;" contenteditable="true" onBlur="saveToDatabase(this,'qty','<?php echo $rowreskebutuhan['id']; ?>')" onClick="showEdit(this);"><?php echo $rowreskebutuhan['qty']; ?></td>
										<?php
												}
											}
										}

										?>
									</tr>
								<?php
								}
								?>
							</tbody>
							<tfoot>
								<tr class="info">
									<td>Sub Total</td>
									<?php
									$sub_kalimat = substr($kduker, 0, 3);
									$res = $conn->query("SELECT * FROM data_kategori ORDER BY id ASC");
									while ($row = $res->fetch_assoc()) {
										$kdkat = $row['kd_kategori'];
										$reskebutuhan = $conn->query("SELECT sum(qty) as totalkebutuhan FROM kebutuhan WHERE id_uker LIKE '$sub_kalimat%' and id_kategori='$kdkat'");
										while ($rowreskebutuhan = $reskebutuhan->fetch_assoc()) {
											if ($rowreskebutuhan['totalkebutuhan'] == 0) {
												echo '<td align="center">0</td>';
											} else {
												echo '<td align="center"> ' . $rowreskebutuhan['totalkebutuhan'] . '</td>';
											}
										}
									} ?>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
			<div id="tab3" class="tab-pane fade">
				<div class="tables">
					<?php
					$no1 = 1;
					$totalasetdep = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM data_aset where kd_uker='$kduker'"));
					var_dump($uker);
					if (!empty($uker)) { ?>
						<div class="row">
							<h4 class="text-center"><strong>LAPORAN <?= $uker['nama_uker'] ?> </strong></h4>
							<h5 class="text-center">Total Aset = <?= $totalasetdep ?></h5>
							<div class="clearfix"></div>
							<?php
							$res = $conn->query("SELECT * FROM data_kategori  ORDER BY id ASC");
							while ($row = $res->fetch_assoc()) {
								$kdkat = $row['kd_kategori'];
								$sql = "SELECT * FROM data_aset WHERE data_aset.kd_uker='${uker['kd_uker']}' and data_aset.kd_kategori='$kdkat'";
								$tot = mysqli_num_rows(mysqli_query($conn, $sql));
								if ($tot > 0) {
									if ($kdkat == "cp") { ?>
										<div class="col-md-12">
											<p class="tebal"> <?= $row['nama_kategori'] ?> : <?= $tot ?> Unit</p>
											<?php
											$sql = "SELECT proc, count(proc) as totproc FROM data_aset WHERE data_aset.kd_uker='$kduker' and data_aset.kd_kategori='$kdkat' GROUP BY proc";
											$th = $conn->query($sql);
											while ($rowth = $th->fetch_assoc()) {
												echo "<a><i>${rowth['proc']} - ${rowth['totproc']} unit, </i></a>";
											} ?>
											<table table-layout="auto" width="100%" class="table table-responsive table-hover table-striped table-bordered">
												<thead>
													<tr class="info">
														<th rowspan="2">No</th>
														<th rowspan="2">No Asset</th>
														<th rowspan="2">Model</th>
														<th colspan="3">Spesifikasi</th>
														<th colspan="2">PIC</th>
														<th rowspan="2">Sewa</th>
														<th rowspan="2">No.Asset Monitor</th>
													</tr>
													<tr class="info">
														<td align="center">OS</td>
														<td align="center">Processor</td>
														<td align="center">Ram/Hdd</td>
														<td align="center">NIK</td>
														<td align="center">Nama</td>
													</tr>
												</thead>
												<tbody>
													<?php
													$no = 1;
													$res1 = $conn->query("SELECT *, data_uker.*, data_karyawan.*  FROM data_aset 
																			LEFT JOIN data_uker ON data_aset.kd_uker=data_uker.kd_uker 
																			LEFT JOIN data_karyawan ON data_aset.nik=data_karyawan.nik 
																			WHERE data_aset.kd_uker='$kduker' and data_aset.kd_kategori='$kdkat'
																		ORDER BY proc ASC");
													while ($row1 = $res1->fetch_assoc()) { ?>
														<tr>
															<td scope="row"><?= $no ?></td>
															<td><a><?= $row1['no_aset'] ?></a></td>
															<td><?= $row1['model'] ?></td>
															<td><?= $row1['os'] ?></td>
															<td><?= $row1['proc'] ?></td>
															<td><?= $row1['ramhd'] ?></td>
															<td><?= $row1['nik'] ?></td>
															<td><?= $row1['nama_karyawan'] ?></td>
															<td align="center"><?= $row1['sewa'] == 0 ? "Tidak" : "Ya" ?></td>
															<td>
																<?php
																$id_monitor = $row1['id_monitor'];
																$showaset = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM data_aset  WHERE no= '$id_monitor'"));
																echo $showaset['no_aset'];
																?>
															</td>
														</tr>
													<?php
														$no++;
													} ?>
												</tbody>
											</table>
										</div>
							<?php }
								}
							} ?>
						</div>
					<?php } ?>
				</div>
			</div>
			<div id="tab4" class="tab-pane fade">
			</div>
		</div>

		<div class="tables">
			<!-- TABEL STRUKTUR 
						<div class="table-responsive bs-example widget-shadow">
						<h4>INFORMASI STRUKTUR</h4>
						<div class="col-md-11">
							<table>
								<thead bgcolor="silver">
									<tr>
										<th rowspan="2">Unit Kerja</th>
										<th colspan="2">Total Formasi</th>
										<th colspan="8">Grade</th>
										<th colspan="2">Terisi</th>
									</tr>
									<tr>
										<td>Organik</td>
										<td>Non Organik</td>
	
										<td>1</td>
										<td>2</td>
										<td>3</td>
										<td>4</td>
										<td>5</td>
										<td>6</td>
										<td>7</td>
										<td>PK</td>
										<td>Organik</td>
										<td>Non Organik</td>
									</tr>
								</thead>
								<tbody>
									<tr align="center">
										<td><a href="#<?= $ker['kd_uker'] ?>"><?= $ker['nama_uker'] ?></a></td>
										<td><?= $totalformasi ?></td>
										<td><?= $totalFormasiNonOrganik ?></td>
										<td><?= $ker['g1'] ?></td>
										<td><?= $ker['g2'] ?></td>
										<td><?= $ker['g3'] ?></td>
										<td><?= $ker['g4'] ?></td>
										<td><?= $ker['g5'] ?></td>
										<td><?= $ker['g6'] ?></td>
										<td><?= $ker['g7'] ?></td>
										<td><?= $ker['gpk'] ?></td>
										<td><?= $terisi['totalisi'] ?></td>
										<td><?= $totalterisiNonOrganik ?></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="col-md-1">
							<form class="form-horizontal" method="POST" action="print.php" target="_blank">
								<input name="id" id="id" type="hidden" value="<?php echo $kduker; ?>"></input>
								<button type="submit" name="print" id="print">
	
									<div><i class="fa_p fa-print nav_print"></i></div>
									<div class="clearfix"></div>
								</button>
							</form>
	
						</div>
					</div> -->

		</div>
		<hr>
		<div class="tables">
			<div class="table-responsive">
			<?php
			$res = $conn->query("SELECT * FROM data_kategori  ORDER BY id ASC");
			while ($row = $res->fetch_assoc()) {
				$kdkat = $row['kd_kategori'];
				$tot = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM data_aset 
											where data_aset.kd_uker='$kduker' and data_aset.kd_kategori='$kdkat'"));

				if ($tot > 0) {
					if ($kdkat == 'cp') {
						echo '					
						<div class="col-md-12">
						<p class="tebal"> ' . $row['nama_kategori'] . ' : ' . $tot . ' Unit</p>
						';
						$th = $conn->query("SELECT proc, count(proc) as totproc FROM data_aset 
											where data_aset.kd_uker='$kduker' and data_aset.kd_kategori='$kdkat' GROUP BY proc");
						while ($rowth = $th->fetch_assoc()) {
							echo '<a><i>' . $rowth['proc'] . ' - ' . $rowth['totproc'] . ' unit, </i></a>';
						}
						echo '
						<table  table-layout="auto" width= "100%"  >
							<thead bgcolor="silver">
								<tr height="20px"  width="100%"> 
									<th rowspan="2">No</th><th rowspan="2">No Asset</th><th rowspan="2">Model</th>';
						if ($kdkat == "cp") {
							echo '<th colspan="3">Spesifikasi</th>';
						} else if ($kdkat == "nb") {
							echo '<th colspan="3">Spesifikasi</th>';
						} else {
							echo '';
						}
						echo '<th colspan="2">PIC</th>
									<th rowspan="2">Sewa</th>
									<th rowspan="2">No.Asset Monitor</th>
								</tr>
								<tr>';
						if ($kdkat == "cp") {
							echo '<td align="center">OS</td><td align="center">Processor</td><td align="center">Ram/Hdd</td> ';
						} else if ($kdkat == "nb") {
							echo '<td align="center">OS</td><td align="center">Processor</td><td align="center">Ram/Hdd</td> ';
						} else {
							echo '';
						}
						echo '<td align="center">NIK</td><td align="center">Nama</td>
									
								</tr>
							</thead>
							<tbody>';
						$no = 1;

						$res1 = $conn->query("SELECT *, data_uker.*, data_karyawan.*  FROM data_aset 
											LEFT JOIN data_uker ON data_aset.kd_uker=data_uker.kd_uker 
											LEFT JOIN data_karyawan ON data_aset.nik=data_karyawan.nik 
											where data_aset.kd_uker='$kduker' and data_aset.kd_kategori='$kdkat'
											ORDER BY proc ASC");
						while ($row1 = $res1->fetch_assoc()) {
							echo '<tr> <th scope="row">' . $no . '</th> <td><a>' . $row1['no_aset'] . '</a></td><td>' . $row1['model'] . '</td>';
							if ($kdkat == "cp") {
								echo '<td>' . $row1['os'] . '</td><td>' . $row1['proc'] . '</td><td>' . $row1['ramhd'] . '</td>';
							} else if ($kdkat == "nb") {
								echo '<td>' . $row1['os'] . '</td><td>' . $row1['proc'] . '</td><td>' . $row1['ramhd'] . '</td>';
							} else {
								echo '';
							}
							echo '<td>' . $row1['nik'] . '</td>
							<td>' . $row1['nama_karyawan'] . '</td>
							<td align="center">';
							if ($row1['sewa'] == "1") {
								echo "YA";
							} else {
								echo "TIDAK";
							}
							$id_monitor = $row1['id_monitor'];
							$showaset = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM data_aset  WHERE no= '$id_monitor'"));
							echo '</td><td>' . $showaset['no_aset'] . '</td>
							</tr> </tr>';
							$no++;
						}
						echo '</tbody>
						</table> 
						<br>
					
					</div>';
					} else if (($kdkat == 'cm') or ($kdkat == 'CM')) {
						echo '					
						<div class="col-md-12">
						<p class="tebal"> ' . $row['nama_kategori'] . ' : ' . $tot . ' Unit</p>
						';
						$th = $conn->query("SELECT proc, count(proc) as totproc FROM data_aset 
											where data_aset.kd_uker='$kduker' and data_aset.kd_kategori='$kdkat' GROUP BY proc");
						while ($rowth = $th->fetch_assoc()) {
							echo '<a><i>' . $rowth['proc'] . ' - ' . $rowth['totproc'] . ' unit, </i></a>';
						}
						echo '
						<table  table-layout="auto" width= "100%"  >
							<thead bgcolor="silver">
								<tr height="20px"  width="100%"> 
									<th rowspan="2">No</th><th rowspan="2">No Asset</th><th rowspan="2">Model</th>
									<th colspan="2">PIC</th>
									<th rowspan="2">Sewa</th> 
								</tr>
								<tr>
								<td align="center">NIK</td><td align="center">Nama</td>
									
								</tr>
							</thead>
							<tbody>';
						$no = 1;

						$res1 = $conn->query("SELECT *, data_uker.*, data_karyawan.*  FROM data_aset 
											LEFT JOIN data_uker ON data_aset.kd_uker=data_uker.kd_uker 
											LEFT JOIN data_karyawan ON data_aset.nik=data_karyawan.nik 
											where data_aset.kd_uker='$kduker' and data_aset.kd_kategori='$kdkat'
											ORDER BY proc ASC");
						while ($row1 = $res1->fetch_assoc()) {
							echo '
							<tr> 
								<th scope="row">' . $no . '</th> <td><a>' . $row1['no_aset'] . '</a></td><td>' . $row1['model'] . '</td>
							<td>' . $row1['nik'] . '</td>
							<td>' . $row1['nama_karyawan'] . '</td>
							<td align="center">';
							if ($row1['sewa'] == "1") {
								echo "YA";
							} else {
								echo "TIDAK";
							}

							echo '</td> 
							</tr>';
							$no++;
						}
						echo '</tbody>
						</table> 
						<br>
					
					</div>';
					} else {
						echo '					
						<div class="col-md-12">
						<p class="tebal"> ' . $row['nama_kategori'] . ' : ' . $tot . ' Unit</p>';
						if ($kdkat == "nb") {
							$th = $conn->query("SELECT proc, count(proc) as totproc FROM data_aset 
											where data_aset.kd_uker='$kduker' and data_aset.kd_kategori='$kdkat' GROUP BY proc");
							while ($rowth = $th->fetch_assoc()) {
								echo '<a><i>' . $rowth['proc'] . ' - ' . $rowth['totproc'] . ' unit, </i></a>';
							}
						}
						echo '
						<table  table-layout="auto" width= "100%"  >
							<thead bgcolor="silver">
								<tr height="20px"  width="100%"> 
									<th rowspan="2">No</th><th rowspan="2">No Asset</th><th rowspan="2">Model</th>';
						if ($kdkat == "cp") {
							echo '<th colspan="3">Spesifikasi</th>';
						} else if ($kdkat == "nb") {
							echo '<th colspan="3">Spesifikasi</th>';
						} else {
							echo '';
						}
						echo '<th colspan="2">PIC</th>
								</tr>
								<tr>';
						if ($kdkat == "cp") {
							echo '<td align="center">OS</td><td align="center">Processor</td><td align="center">Ram/Hdd</td> ';
						} else if ($kdkat == "nb") {
							echo '<td align="center">OS</td><td align="center">Processor</td><td align="center">Ram/Hdd</td> ';
						} else {
							echo '';
						}
						echo '<td align="center">NIK</td><td align="center">Nama</td> 
								</tr>
							</thead>
							<tbody>';
						$no = 1;
						$res1 = $conn->query("SELECT *, data_uker.*, data_karyawan.*  FROM data_aset 
											LEFT JOIN data_uker ON data_aset.kd_uker=data_uker.kd_uker 
											LEFT JOIN data_karyawan ON data_aset.nik=data_karyawan.nik 
											where data_aset.kd_uker='$kduker' and data_aset.kd_kategori='$kdkat'
											ORDER BY tahun ASC");
						while ($row1 = $res1->fetch_assoc()) {
							echo '<tr> <th scope="row">' . $no . '</th> <td><a>' . $row1['no_aset'] . '</a></td><td>' . $row1['model'] . '</td>';
							if ($kdkat == "cp") {
								echo '<td>' . $row1['os'] . '</td><td>' . $row1['proc'] . '</td><td>' . $row1['ramhd'] . '</td>';
							} else if ($kdkat == "nb") {
								echo '<td>' . $row1['os'] . '</td><td>' . $row1['proc'] . '</td><td>' . $row1['ramhd'] . '</td>';
							} else {
								echo '';
							}
							echo '<td>' . $row1['nik'] . '</td>
							<td>' . $row1['nama_karyawan'] . '</td> </tr> </tr>';
							$no++;
						}
						echo '</tbody>
						</table> 
						<br>
					
					</div>';
					}
				}
				$no1++;
			}
			echo '</div>';

			$showbag = $conn->query("SELECT * FROM  data_uker_bagian where kd_uker='$kduker'");
			while ($rowbag = $showbag->fetch_assoc()) {
				$kdbag = $rowbag['kd_bag'];
				$totalaset = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM data_aset 
											where kd_uker='$kdbag'"));

				echo '
<div class="table-responsive bs-example widget-shadow">
<h4 id="' . $rowbag['kd_bag'] . '">' . $rowbag['nama_bag'] . ' Total Aset = ' . $totalaset . '</h4>
';
				$no1 = 1;
				$res = $conn->query("SELECT *  FROM data_kategori ORDER BY id ASC");
				while ($row = $res->fetch_assoc()) {
					$kdkat = $row['kd_kategori'];
					$tot = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM data_aset  
											where data_aset.kd_uker='$kdbag' and data_aset.kd_kategori='$kdkat'"));
					$no2 = 1;
					if ($tot > 0) {
						if ($kdkat == 'cp') {
							echo '					
						<div class="col-md-12">
						<p class="tebal"> ' . $row['nama_kategori'] . ' : ' . $tot . ' Unit</p>
						';
							$th = $conn->query("SELECT proc, count(proc) as totproc FROM data_aset 
											where data_aset.kd_uker='$kdbag' and data_aset.kd_kategori='$kdkat' GROUP BY proc");
							while ($rowth = $th->fetch_assoc()) {
								echo '<a><i>' . $rowth['proc'] . ' - ' . $rowth['totproc'] . ' unit, </i></a>';
							}
							echo '
						<table  table-layout="auto" width= "100%"  >
							<thead bgcolor="silver">
								<tr height="20px"  width="100%"> 
									<th rowspan="2">No</th><th rowspan="2">No Asset</th><th rowspan="2">Model</th>';
							if ($kdkat == "cp") {
								echo '<th colspan="3">Spesifikasi</th>';
							} else if ($kdkat == "nb") {
								echo '<th colspan="3">Spesifikasi</th>';
							} else {
								echo '';
							}
							echo '<th colspan="2">PIC</th>
									<th rowspan="2">Sewa</th>
									<th rowspan="2">No.Asset Monitor</th>
								</tr>
								<tr>';
							if ($kdkat == "cp") {
								echo '<td align="center">OS</td><td align="center">Processor</td><td align="center">Ram/Hdd</td> ';
							} else if ($kdkat == "nb") {
								echo '<td align="center">OS</td><td align="center">Processor</td><td align="center">Ram/Hdd</td> ';
							} else {
								echo '';
							}
							echo '<td align="center">NIK</td><td align="center">Nama</td> 
								</tr>
							</thead>
							<tbody>';
							$no = 1;
							$res1 = $conn->query("SELECT *, data_uker.*, data_karyawan.*  FROM data_aset 
											LEFT JOIN data_uker ON data_aset.kd_uker=data_uker.kd_uker 
											LEFT JOIN data_karyawan ON data_aset.nik=data_karyawan.nik 
											where data_aset.kd_uker='$kdbag' and data_aset.kd_kategori='$kdkat' 
											ORDER BY tahun ASC");
							while ($row1 = $res1->fetch_assoc()) {
								echo '<tr> <th scope="row">' . $no . '</th> <td><a>' . $row1['no_aset'] . '</a></td><td>' . $row1['model'] . '</td>';
								if ($kdkat == "cp") {
									echo '<td>' . $row1['os'] . '</td><td>' . $row1['proc'] . '</td><td>' . $row1['ramhd'] . '</td>';
								} else if ($kdkat == "nb") {
									echo '<td>' . $row1['os'] . '</td><td>' . $row1['proc'] . '</td><td>' . $row1['ramhd'] . '</td>';
								} else {
									echo '';
								}
								echo '<td>' . $row1['nik'] . '</td>
							<td>' . $row1['nama_karyawan'] . '</td>
							<td align="center">';
								if ($row1['sewa'] == "1") {
									echo "YA";
								} else {
									echo "TIDAK";
								}

								echo '</td>';
								$id_monitor = $row1['id_monitor'];
								$showaset = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM data_aset  WHERE no= '$id_monitor'"));
								echo '</td><td>' . $showaset['no_aset'] . '</td>
							</tr> </tr>';
								$no++;
							}
							echo '</tbody>
						</table> 
						<br>
					
					</div>';
						} else if (($kdkat == 'cm') or ($kdkat == 'CM')) {
							echo '					
						<div class="col-md-12">
						<p class="tebal"> ' . $row['nama_kategori'] . ' : ' . $tot . ' Unit</p>
						';
							$th = $conn->query("SELECT proc, count(proc) as totproc FROM data_aset 
											where data_aset.kd_uker='$kdbag' and data_aset.kd_kategori='$kdkat' GROUP BY proc");
							while ($rowth = $th->fetch_assoc()) {
								echo '<a><i>' . $rowth['proc'] . ' - ' . $rowth['totproc'] . ' unit, </i></a>';
							}
							echo '
						<table  table-layout="auto" width= "100%"  >
							<thead bgcolor="silver">
								<tr height="20px"  width="100%"> 
									<th rowspan="2">No</th><th rowspan="2">No Asset</th><th rowspan="2">Model</th>';

							echo '<th colspan="2">PIC</th>
									<th rowspan="2">Sewa</th> 
								</tr>
								<tr>
									<td align="center">NIK</td><td align="center">Nama</td> 
								</tr>
							</thead>
							<tbody>';
							$no = 1;
							$res1 = $conn->query("SELECT *, data_uker.*, data_karyawan.*  FROM data_aset 
											LEFT JOIN data_uker ON data_aset.kd_uker=data_uker.kd_uker 
											LEFT JOIN data_karyawan ON data_aset.nik=data_karyawan.nik 
											where data_aset.kd_uker='$kdbag' and data_aset.kd_kategori='$kdkat' 
											ORDER BY tahun ASC");
							while ($row1 = $res1->fetch_assoc()) {
								echo '<tr> <th scope="row">' . $no . '</th> <td><a>' . $row1['no_aset'] . '</a></td><td>' . $row1['model'] . '</td> 
							<td>' . $row1['nik'] . '</td>
							<td>' . $row1['nama_karyawan'] . '</td>
							<td align="center">';
								if ($row1['sewa'] == "1") {
									echo "YA";
								} else {
									echo "TIDAK";
								}

								echo '</td> 
							</tr> </tr>';
								$no++;
							}
							echo '</tbody>
						</table> 
						<br>
					
					</div>';
						} else {
							echo '					
						<div class="col-md-12">
						<p class="tebal"> ' . $row['nama_kategori'] . ' : ' . $tot . ' Unit</p>
						';
							if ($kdkat == "nb") {
								$th = $conn->query("SELECT proc, count(proc) as totproc FROM data_aset 
											where data_aset.kd_uker='$kdbag' and data_aset.kd_kategori='$kdkat' GROUP BY proc");
								while ($rowth = $th->fetch_assoc()) {
									echo '<a><i>' . $rowth['proc'] . ' - ' . $rowth['totproc'] . ' unit, </i></a>';
								}
							}
							echo '
						<table  table-layout="auto" width= "100%"  >
							<thead bgcolor="silver">
								<tr height="20px"  width="100%"> 
									<th rowspan="2">No</th><th rowspan="2">No Asset</th><th rowspan="2">Model</th>';
							if ($kdkat == "cp") {
								echo '<th colspan="3">Spesifikasi</th>';
							} else if ($kdkat == "nb") {
								echo '<th colspan="3">Spesifikasi</th>';
							} else {
								echo '';
							}
							echo '<th colspan="2">PIC</th>
								</tr>
								<tr>';
							if ($kdkat == "cp") {
								echo '<td align="center">OS</td><td align="center">Processor</td><td align="center">Ram/Hdd</td> ';
							} else if ($kdkat == "nb") {
								echo '<td align="center">OS</td><td align="center">Processor</td><td align="center">Ram/Hdd</td> ';
							} else {
								echo '';
							}
							echo '<td align="center">NIK</td><td align="center">Nama</td> 
								</tr>
							</thead>
							<tbody>';
							$no = 1;
							$res1 = $conn->query("SELECT *, data_uker.*, data_karyawan.*  FROM data_aset 
											LEFT JOIN data_uker ON data_aset.kd_uker=data_uker.kd_uker 
											LEFT JOIN data_karyawan ON data_aset.nik=data_karyawan.nik 
											where data_aset.kd_uker='$kdbag' and data_aset.kd_kategori='$kdkat'
											ORDER BY tahun ASC");
							while ($row1 = $res1->fetch_assoc()) {
								echo '<tr> <th scope="row">' . $no . '</th> <td><a>' . $row1['no_aset'] . '</a></td><td>' . $row1['model'] . '</td>';
								if ($kdkat == "cp") {
									echo '<td>' . $row1['os'] . '</td><td>' . $row1['proc'] . '</td><td>' . $row1['ramhd'] . '</td>';
								} else if ($kdkat == "nb") {
									echo '<td>' . $row1['os'] . '</td><td>' . $row1['proc'] . '</td><td>' . $row1['ramhd'] . '</td>';
								} else {
									echo '';
								}
								echo '<td>' . $row1['nik'] . '</td>
							<td>' . $row1['nama_karyawan'] . '</td> </tr> </tr>';
								$no++;
							}
							echo '</tbody>
						</table> 
						<br>
					
					</div>';
						}
					}
					$no1++;
				}
				echo '</div>';
			}
		}
			?>
			</div>
		</div>