<?php
$namastatus = $_GET['status'];
$showstatus = mysqli_fetch_array(mysqli_query($conn, "SELECT  id FROM status_labels
									WHERE name= '$namastatus'"));
$idstatus = $showstatus['id'];
?>
<section class="content-header">
	<h3 class="pull-left">Aset dengan Status <?php echo $_GET['status']; ?></h3>
	<div class="pull-right">
		<div class="profile_details_left">
			<!--notifications of menu start -->
			<ul class="nofitications-dropdown">
				<li class="dropdown head-dpdn no-border">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						<i class="fa fa-book nav_icon"></i><span>Kategori</span></a>
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
</section>
<br>
<section class="content">
	<div class="webui">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-default">
					<div class="box-body table-responsive">
						<table id="<?php echo $namastatus; ?>" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Nomor Aset</th>
									<th>Kategori</th>
									<th>Tahun</th>
									<th>Model</th>
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
									<th>Aksi</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>