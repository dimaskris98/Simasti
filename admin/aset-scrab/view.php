<section class="content-header" style="padding-bottom: 30px;">
	<h1 class="pull-left"><?php echo $mod; ?></h1>
	<div class="pull-right">
		<div class="profile_details_left">
			<!--notifications of menu start -->
			<ul class="nofitications-dropdown">
				<li class="dropdown head-dpdn no-border">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-book nav_icon"></i><span>Kategori</span></a>
					<ul class="dropdown-menu">
						<li>
							<a href="Scrab">
								<div>All Scrab</div>
								<div class="clearfix"></div>
							</a>
						</li>
						<?php
						$res = $conn->query("SELECT * FROM data_kategori");
						while ($row = $res->fetch_assoc()) {
							echo '
										<li>
										<a href="Scrab-' . $row['nama_kategori'] . '">
										   <div >' . $row['nama_kategori'] . '</div>
										   <div class="clearfix"></div>	
										</a>
										</li> ';
						}

						?>
					</ul>
				</li>
			</ul>
			<div class="clearfix"> </div>
		</div>
	</div>
</section>
<section class="content">
	<div class="webui">
		<div class="row">
			<div class="col-md-12 panel-grids">
				<div class="box box-default">
					<div class="box-body table-responsive">
						<table class=" <?php echo $mod; ?> table table-bordered table-striped">
							<thead>
								<tr>
									<th>Nomor Aset</th>
									<th>Kategori</th>
									<th>Tahun</th>
									<th>Model</th>
									<th>SN</th>
									<th>Tanggal Scrab</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>