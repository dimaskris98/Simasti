<style>
	.open ul li {
		margin-bottom: 0px !important;
		border: none !important;
		font-size: 14px;
		padding-bottom: 0px;
	}
</style>

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
				<h3><?php echo $totalaset = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM komponen")); ?></h3>
				<p>total komponen</p>
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
				<div class="row">
					<h3 class="text-center">DATA KESELURUHAN</h3>
				</div>
				<div class="row">
					<div class="col-md-12">
						<form class="form" id="pieFilter">
							<input type="hidden" name="dataTotal" value="filter">
							<div class="form-group">
								<div class="row">
									<div class="col-md-3 col-md-offset-4">
										<select id="barang" name="barang" class="form-control " title="Pilih Data">
											<option value="asset">Data Asset</option>
											<option value="consumable">Data Consumable</option>
											<option value="komponen">Data Komponen</option>
										</select>
										<script>
											document.getElementById('barang').addEventListener('change', function() {
												if (this.value == "consumable" || this.value == "komponen" ) {
													document.getElementById('jenis').disabled = true;
												} else {
													document.getElementById('jenis').disabled = false;
												}
											})
										</script>
									</div>
									<div class="col-md-3">
										<select id="jenis" name="jenis" class="form-control" title="Pilih Jenis">
											<option value="total">Total</option>
											<option value="alokasi">Alokasi</option>
											<option value="gudang">Gudang</option>
										</select>
									</div>
									<div class="col-md-2">
										<button name="dataTotal" value="filter" class="btn btn-success">Tampilkan</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div style="width: 700px;margin:auto;margin-top: 15px;margin-bottom: 15px;" id="piechart1">
				</div>
			</div>


		</div>
		<div class="row">
			<div class="col-md-12">
				<h4 class="text-center"> Data Perbaikan Tahun <?= date('Y') ?></h4>
				<form class="form" id="perbaikanFilter">
					<input type="hidden" name="perbaikan" value="filter">
					<div class="form-group">
						<div class="row">
							<div class="col-md-3 col-md-offset-7">
								<select id="service-kat" name="kategori" class="form-control" title="Pilih Kategori">
									<option value="All" selected>All</option>
									<?php
									$result = $conn->query("SELECT kd_kategori as kd,nama_kategori as nama FROM data_kategori");
									while ($r = $result->fetch_assoc()) { ?>
										<option value="<?= strtoupper($r['kd']) ?>"><?= $r['nama'] ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="col-md-2">
								<button name="perbaikan" value="filter" class="btn btn-success">Tampilkan</button>
							</div>
						</div>
					</div>
				</form>
				<div style="width: 750px; margin: auto;margin-top: 15px;margin-bottom: 15px;" id="perbaikanChart">
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<h4 class="text-center"> Trend Data Consumable Tahun <?= date('Y') ?></h4>
				<form class="form" id="trendFilter">
					<input type="hidden" name="trend" value="filter">
					<div class="form-group">
						<div class="row">
							<div class="col-md-4 col-md-offset-6">
								<select name="id_consum" class="selectpicker" data-live-search="true" title="Pilih Consumable">
									<option value="All">All</option>
									<?php
									$a = $conn->query("SELECT id,kode_item, nama_consumable as nama 
										FROM consumable");
									while ($s = mysqli_fetch_assoc($a)) {
										echo "<option value='${s['id']}'>${s['kode_item']} - ${s['nama']}</option>";
									}
									?>
								</select>
							</div>
							<div class="col-md-2">
								<button name="trend" value="filter" class="btn btn-success">Tampilkan</button>
							</div>
						</div>
					</div>
				</form>
				<div style="width: 750px;height: 300px; margin: auto;margin-top: 15px;margin-bottom: 15px;" id="consumableChart">
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
<script>
	document.addEventListener("DOMContentLoaded", function() {
		google.charts.load('current', {
			'packages': ['corechart', 'bar']
		});

		google.charts.setOnLoadCallback(function() {
			drawPie1Chart();
			drawPerbaikanChart();
			drawKonsum2();
		});
		// DRAW PIE CHART
		function drawPie1Chart(data = {
			'dataTotal': "default"
		}) {

			let json = $.ajax({
				url: "template/chart.php",
				type: "POST",
				dataType: "json",
				data: data,
				async: false
			}).responseText;


			var data = google.visualization.arrayToDataTable($.parseJSON(json));

			var options = {
				animation: {
					startup: true,
					duration: 1000,
					easing: 'out',
				},
				width: 700,
				height: 300,
				is3D: true,
			};

			var piechart = new google.visualization.PieChart(document.getElementById('piechart1'));
			piechart.draw(data, options);
		}

		$("#pieFilter").submit(function(e) {
			e.preventDefault();
			drawPie1Chart($(this).serialize());

		});

		function drawPerbaikanChart(data = {
			'perbaikan': "All"
		}) {

			let json = $.ajax({
				url: "template/chart.php",
				type: "POST",
				dataType: "json",
				data: data,
				async: false
			}).responseText;

			var data = google.visualization.arrayToDataTable($.parseJSON(json));

			var options = {
				width: "100%",
				height: 300,
				animation: {
					startup: true,
					duration: 1000,
					easing: 'out',
				},
				hAxis: {
					title: 'Bulan'
				},
				vAxis: {
					title: 'Keluhan',
				},
				bar: {
					groupWidth: "75%"
				},
				legend: {
					position: "bottom"
				}
			};

			var barChart = new google.visualization.ColumnChart(document.getElementById('perbaikanChart'));
			barChart.draw(data, options);
		}

		$("#perbaikanFilter").submit(function(e) {
			e.preventDefault();
			drawPerbaikanChart($(this).serialize());

		});

		function drawKonsum2(data = {"id_consum":"All"}) {

			let json = $.ajax({
				url: "template/chart.php",
				type: "POST",
				dataType: "json",
				data: data,
				async: false
			}).responseText;

			var data2 = google.visualization.arrayToDataTable($.parseJSON(json));
			console.log($('[name="id_consum"]').val());
			if ($('[name="id_consum"]').val() == "All" || data.id_consum == "All" ) {
				var series = {}
			} else {
				var series = {
					1: {
						lineDashStyle: [2, 2]
					}
				};
			}

			var options = {
				title: null,
				animation: {
					duration: 1000,
					easing: 'out',
					startup: true,
				},
				legend: {
					position: 'bottom'
				},
				series: series,
				hAxis: {
					title: 'Bulan'
				},
				vAxis: {
					title: 'Stok',
					minValue: 0
				}
			};

			var chart = new google.visualization.LineChart(document.getElementById('consumableChart'));
			chart.draw(data2, options);
		}

		$('#trendFilter').on("submit", function(e) {
			e.preventDefault();
			drawKonsum2($(this).serialize());
		});

	})
</script>