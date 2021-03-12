<?php
if ($_SESSION['user_login'] == "admin") {
?>
	<section class="content-header">
		<style>
			.no-border {
				border: unset !important;
			}
		</style>
		<h1 class="pull-left"><?php echo $mod; ?></h1>

		<div class="pull-right">

			<div class="profile_details_left">
				<!--notifications of menu start -->

				<ul class="nofitications-dropdown">

					<li class="dropdown head-dpdn no-border">
						<div class="col-md-5 ">
							<p class="pull-right">
								View by :
							</p>
						</div>
						<div class="col-md-7">
							<form action="processor" method="POST">
								<select name="proc" id="proc" class="form-control" onchange="this.form.submit();">
									<option>Processor</option>
									<?php
									$res = $conn->query("SELECT kd_kategori,proc FROM data_aset GROUP BY proc");
									while ($row = $res->fetch_assoc()) {
										echo '
												<option value="' . $row['proc'] . '/' . $row['kd_kategori'] . '">' . $row['kd_kategori'] . ' - ' . $row['proc'] . '</option> ';
										$no++;
									}
									?>
								</select>
							</form>
						</div>

					</li>



					<li class="dropdown head-dpdn no-border">

						<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-book nav_icon"></i><span>Kategori</span></a>
						<ul class="dropdown-menu">
							<li>
								<a href="All">
									<div>Semua Aset</div>
									<div class="clearfix"></div>
								</a>
							</li>
							<?php
							$res = $conn->query("SELECT * FROM data_kategori");
							while ($row = $res->fetch_assoc()) {
								echo '
										<li>
										<a href="' . $row['nama_kategori'] . '">
										   <div >' . $row['nama_kategori'] . '</div>
										   <div class="clearfix"></div>	
										</a>
										</li> ';
							}

							?>
						</ul>
					</li>

					<li class="dropdown head-dpdn no-border">
						<a href="Sewa"><i class="fa fa-book nav_icon"></i><span>Sewa</span></a>

					</li>
					<li class="dropdown head-dpdn no-border">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-book nav_icon"></i><span>Status</span></a>
						<ul class="dropdown-menu">
							<?php
							$res = $conn->query("SELECT name FROM status_labels WHERE name NOT LIKE '%scrab%'");
							while ($row = $res->fetch_assoc()) {
								echo '<li>
									<a href="hardware?status=' . $row['name'] . '">
									   <div > Aset ' . $row['name'] . '</div>
									   <div class="clearfix"></div>	
									</a>
									</li>';
							}

							?>
						</ul>
					</li>

				</ul>

				<div class="clearfix"> </div>
			</div>


		</div>


	</section class="content">
	<section class="content">
		<div class="webui">
			<div class="row">
				<?php
				if (isset($_POST['proc'])) {
					$a = $_POST['proc'];
					$params = explode('/', $a);
					echo $proc = $params[0];
					$ktgr = $params[1];
				?>
					<div class="col-md-12 panel-grids">
						<div class="box box-default">
							<div class="box-body table-responsive">
								<table id="general" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>No</th>
											<th>Unit Kerja</th>
											<th>No Asset</th>
											<th>Kategori</th>
											<th>Tahun</th>
											<th>Processor</th>
											<th>NIK</th>
											<th>Karyawan</th>
											<th>Lokasi</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 1;
										$asetDep = $conn->query("
						SELECT c.*,a.nama_bag,b.nama_karyawan FROM data_aset as c
						LEFT JOIN data_uker_bagian as a ON a.kd_bag = c.kd_uker
						LEFT JOIN data_karyawan as b ON b.nik = c.nik
						WHERE kd_kategori='$ktgr' AND proc LIKE '%$proc%' ORDER BY kd_uker ASC");
										while ($rowDep = $asetDep->fetch_assoc()) { ?>
											<tr>
												<td><?= $no; ?></td>
												<td><?= $rowDep['kd_uker'] . ' - ' . $rowDep['nama_bag'] ?></td>
												<td><?= $rowDep['no_aset']; ?></td>
												<td><?= $rowDep['model']; ?></td>
												<td><?= $rowDep['tahun']; ?></td>
												<td><?= $rowDep['proc']; ?></td>
												<td><?= $rowDep['nik']; ?></td>
												<td><?= $rowDep['nama_karyawan']; ?></td>
												<td><?= $rowDep['lokasi']; ?></td>
											</tr>
										<?php
											$no++;
										}
										?>
									</tbody>
								</table>
							</div>
						</div>

					</div>
				<?php
				} else {
				?>
					<div class="col-md-12 panel-grids">
						<div class="box box-default">
							<div class="box-body table-responsive">
								<table id="<?php echo $mod; ?>" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>Nomor Aset</th>
											<th>Kategori</th>
											<th>Tahun</th>
											<th>Model</th>
											<th>NIK</th>
											<th>Karyawan</th>
											<th>Unit Kerja</th>
											<th>Nama Unit Kerja</th>
											<th>Lokasi</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<tr>
										</tr>
									</tbody>
									<tfoot>
										<tr>
											<th>Nomor Aset</th>
											<th>Kategori</th>
											<th>Tahun</th>
											<th>Model</th>
											<th>NIK</th>
											<th>Karyawan</th>
											<th>Unit Kerja</th>
											<th>Nama Unit Kerja</th>
											<th>Lokasi</th>
											<th>Aksi</th>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>

					</div>
				<?php
				} ?>
			</div>
		</div>
	</section>

<?php } else {
	echo "ora duwe akses mrene bro";
}
?>