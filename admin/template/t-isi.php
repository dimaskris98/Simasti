<div class="row">
	<!-- panel -->
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-teal">
			<div class="inner">
				<h3><?php echo $totalaset = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM data_aset")); ?></h3>
				<p>total assets</p>
			</div>
			<div class="icon">
				<i class="fa fa-barcode"></i>
			</div>
			<a href="All" class="small-box-footer">More Info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div><!-- ./col -->

	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-maroon">
			<div class="inner">
				<h3><?php echo $totalaset = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM licensi")); ?></h3>
				<p>total licenses</p>
			</div>
			<div class="icon">
				<i class="fa fa-floppy-o"></i>
			</div>
			<a href="licensi" class="small-box-footer">More Info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div><!-- ./col -->

	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-orange">
			<div class="inner">
				<h3><?php echo $totalaset = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM aksesoris")); ?></h3>
				<p>total accessories</p>
			</div>
			<div class="icon">
				<i class="fa fa-keyboard-o"></i>
			</div>
			<a href="" class="small-box-footer">More Info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div><!-- ./col -->

	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-purple">
			<div class="inner">
				<h3><?php echo $totalaset = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM consumable")); ?></h3>
				<p>total consumables</p>
			</div>
			<div class="icon">
				<i class="fa fa-tint"></i>
			</div>
			<a href="consumables" class="small-box-footer">More Info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div><!-- ./col -->
</div>

<div class="row">
	<div class="col-md-4 stats-info widget">
		<div class="stats-title">
			<h4 class="title">Data Asset Per-Kategori</h4>
		</div>
		<div class="stats-body">
			<ul class="list-unstyled">
				<?php
				$result = $conn->query("SELECT * FROM  data_kategori");
				while ($row = $result->fetch_assoc()) {
					$kategori = $row['kd_kategori'];
					$total = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM data_aset"));
					$totalper = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM data_aset WHERE kd_kategori = '$kategori'"));
					$pcaset = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM data_aset WHERE kd_kategori = '$kategori' and sewa=0"));
					$pcsewa = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM data_aset WHERE kd_kategori = '$kategori' and sewa='1'"));
					if ($total > 0) {
						$persen = $totalper / $total * 100;
						$hasil = round($persen, 1);
					} else {
						$hasil = 0;
					}

					if ($pcsewa > 0) {
				?>


						<li><?php echo $row['nama_kategori'] . " - " . $totalper . " Unit"; ?>

							<span class="pull-right"><?php echo $hasil; ?>%</span>
							<div class="progress progress-striped active progress-right">
								<div class="bar green" style="width:<?php echo $hasil; ?>%;"></div>
							</div>
							<ul>

								<span>&nbsp;&nbsp;&nbsp;&nbsp;Asset - <?php echo $pcaset; ?> Unit</span>
								<span><br>&nbsp;&nbsp;&nbsp;&nbsp;Sewa - <?php echo $pcsewa; ?> Unit</span>
							</ul>
						</li>
					<?php
					} else {
					?>


						<li><?php echo $row['nama_kategori'] . " - " . $totalper . " Unit"; ?>
							<span class="pull-right"><?php echo $hasil; ?>%</span>
							<div class="progress progress-striped active progress-right">
								<div class="bar green" style="width:<?php echo $hasil; ?>%;"></div>
							</div>
						</li>
				<?php
					}
				}
				?>
			</ul>
		</div>
	</div>
	<div class="col-md-8 stats-info stats-last widget-shadow">
		<div class="row">
			<div class="col-md-12">
				<h4 class="text-center"> Data Aset </h4>
				<div style="width: 700px;margin:auto;margin-top: 15px;margin-bottom: 15px;" id="piechart1">
				</div>
			</div>


		</div>
		<div class="row">
			<div class="col-md-12">
				<h4 class="text-center"> Data Perbaikan Tahun <?= date('Y') ?></h4>
				<div style="width: 500px; margin: auto;margin-top: 15px;margin-bottom: 15px;" id="perbaikanChart">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h4 class="text-center"> Data Komponen </h4>
				<div style="width: 700px;margin:auto;margin-top: 15px;margin-bottom: 15px;" id="komponenChart">
				</div>
			</div>
		</div>
	</div>
	<div class="clearfix"> </div>
</div>
<div class="clearfix"> </div>
<div class="row">
	<form class="form-horizontal" method="POST" action="dashboard">
		<button type="submit" name="submit" class="btn btn-danger btn-md" onClick="mod=dashboard"><span>detail</span></button>
	</form>
</div>