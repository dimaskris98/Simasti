 <section class="content">
 	<!-- Content -->
 	<div id="webui">
 		<div class="row">
 			<?php

				if (isset($_POST['saveeditaset'])) {
					$idaset = $_POST['idaset'];
					$no_aset = $_POST['no_aset'];
					$model = $_POST['model'];
					$kategori = $_POST['kategori'];
					$sn = $_POST['sn'];
					$catatan = $_POST['catatan'];

					if (isset($_POST['uker'])) {
						$lokasi = $_POST['uker'];
					} else {
						$lokasi = "";
					}
					if (isset($_POST['user'])) {
						$user = $_POST['user'];
					} else {
						$user = "";
					}
					$catatan = $_POST['catatan'];

					$sql 	= "UPDATE data_aset SET no_aset='$no_aset', kd_kategori='$kategori',model='$model',   sn='$sn', 
					kd_uker='$lokasi',nik='$user',update_at='$update_at',audit_at='$audit_at',admin='$id_user',catatan='$catatan'
					WHERE no='$idaset'";
					echo  $sql;
					// $query	= mysqli_query($conn,$sql);
					//  echo '<script>window.location="lokasi?aset='.$iduker.'"</script>'; 
				}

				if (isset($_POST['savepermintaan'])) {
					$idview = $_POST['idview'];
					$iduker = $_POST['iduker'];
					$idbag = $_POST['idbag'];


					$res = $conn->query("SELECT * FROM data_kategori ");
					while ($row = $res->fetch_assoc()) {
						$idkategori = $row['kd_kategori'];
						$qty = $_POST[$idkategori];
						if (!empty($_POST['iduker'])) {
							$query	= mysqli_query($conn, "INSERT into kebutuhan value('','$iduker','$idkategori',' $qty')");
						} else {
							$query	= mysqli_query($conn, "INSERT into kebutuhan value('','$idbag','$idkategori',' $qty')");
						}
					}
					echo '<script>window.location="lokasi?view=' . $idview . '"</script>';
				}

				if (isset($_POST['hapus2'])) {
					$id = $_POST['idmodel'];
					$sql 	= "delete from 1models where id='$id'";
					$query	= mysqli_query($conn, $sql);
				}

				if (isset($_POST['hapus1'])) {
					$id = $_POST['iddel'];
					$view = $_POST['id_model'];
					$sql 	= "delete from 1assets where id='$id'";

					$query	= mysqli_query($conn, $sql);
					echo '<script>window.location="models?view=' . $view . '"</script>';
				} else if (isset($_POST['permintaanuker'])) {
					$kd_uker = $_POST['id_uker'];
					$showuker = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM data_uker WHERE kd_uker = '$kd_uker'"));
					$showbag = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM data_uker_bagian WHERE kd_uker = '$kd_uker'"));
				?>
 				<div id="webui">
 					<div class="row">
 						<div class="col-md-12 col-md-offset-2">
 							<div class="box box-default">
 								<div class="box-header">
 									<h2 class="box-title"><b>Input Permintaan <?php echo $showuker['nama_uker']; ?></b></h2>
 									<div class="box-tools pull-right">
 										<a href="models" class="btn btn-primary">Back</a>
 									</div>
 								</div><!-- /.box-header -->
 								<div class="box-body">
 									<form id="create-form" class="form-horizontal" method="post" action="" role="form" enctype="multipart/form-data">
 										<!-- Name -->
 										<?php
											$res = $conn->query("SELECT * FROM data_kategori ");
											while ($row = $res->fetch_assoc()) {
											?>
 											<div class="form-group ">
 												<label class="col-md-4 control-label"><?php echo $row['nama_kategori']; ?></label>
 												<div class="col-md-6">
 													<div class="input-group">
 														<input class="form-control" type="hidden" name="idkategori" id="idkategori" value="<?php echo $row['kd_kategori']; ?> " />
 														<input class="form-control" type="hidden" name="idbag" id="idbag" value="<?php echo $showbag['kd_bag']; ?> " />
 														<input class="form-control" type="hidden" name="iduker" id="iduker" value="<?php echo $kd_uker; ?> " />
 														<input class="form-control" type="number" name="<?php echo $row['kd_kategori']; ?>" id="<?php echo $row['kd_kategori']; ?>" value=" " />
 														<span class="input-group-addon">
 															Unit
 														</span>
 													</div>
 												</div>
 											</div>
 										<?php
											}
											?>
 										<div class="box-footer text-right">
 											<a class="btn btn-link text-left" href="models">Cancel</a>
 											<button type="submit" name="savepermintaan" id="save" class="btn btn-success"><i class="fa fa-check icon-white"></i> Save</button>
 										</div>
 									</form>
 								</div>
 							</div>
 						</div>

 						<div class="slideout-menu" id="help">
 							<a href="#" class="slideout-menu-toggle pull-right">×</a>
 							<h3>
 								About Asset Models
 							</h3>
 							<p>Asset Models are a way to group identical assets. &quot;MBP 2013&quot;, &quot;IPhone 6s&quot;, etc. </p>
 						</div>
 					</div>
 				</div>
 			<?php
				} else if (isset($_GET['view'])) {
					$kd_uker = $_GET['view'];
					$showuker = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM data_uker WHERE kd_uker = '$kd_uker'"));
				?>
 				<div class="col-md-12">
 					<div class="box box-default">
 						<div class="box-header">
 							<h2 class="box-title"><b><?php echo $showuker['nama_uker']; ?></b></h2>
 							<div class="box-tools pull-right">
 								<a href="lokasi-kebutuhan?id=<?= $kd_uker ?>" class="btn btn-primary">Input Permintaan</a>
 								<a href="lokasi" class="btn btn-primary">Back</a>
 							</div>
 						</div><!-- /.box-header -->
 						<!-- /.box-header -->
 						<div class="box-body">
 							<div class="row">
 								<div class="col-md-12">
 									<div class="table-responsive ">
 										<table id="" class="tabledisplay table table-striped snipe-table">
 											<thead>
 												<tr>
 													<th style="text-align:center;" rowspan="2">No.</th>
 													<th rowspan="2" align="center">Nama Unit Kerja</th>
 													<th style="text-align:center;" colspan="8">Jumlah Aset</th>
 												</tr>
 												<tr>
 													<?php
														$res = $conn->query("SELECT * FROM data_kategori ");
														while ($row = $res->fetch_assoc()) {
															echo '<th  style="text-align:center;">' . $row['nama_kategori'] . ' </th>';
														}
														?>
 												</tr>
 											</thead>
 											<tbody>
 												<?php
													$no = 1;
													$res = $conn->query("SELECT * FROM data_uker_bagian where kd_uker='$kd_uker'");
													while ($row = $res->fetch_assoc()) {
														$kd_bag = $row['kd_bag'];
													?>
 													<tr>
 														<td><?= $no++ ?></td>
 														<td>
 															<a href="lokasi?aset=<?= $row['kd_bag'] ?>" title="Detail Aset"><?= $row['nama_bag'] ?></a>
 														</td>
 														<form name="formates" role="form" action="" method="POST" enctype="multipart/form-data">
 															<?php
																$res1 = $conn->query("SELECT * FROM data_kategori ");
																while ($row1 = $res1->fetch_assoc()) {
																	$idkat = $row1['kd_kategori'];
																	$isi2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM data_aset where kd_kategori='$idkat' AND kd_uker='$kd_bag'"));
																	$a = "SELECT * FROM data_aset where kd_kategori='$idkat' AND kd_uker='$kd_bag'";
																	echo '<td style="text-align:center;">' . $isi2 . '</td>';
																} ?>
 													</tr>
 												<?php } ?>
 											</tbody>
 										</table>
 									</div>
 								</div>
 							</div>
 						</div> <!-- /.box-body-->
 					</div> <!-- /.box-default-->
 				</div> <!-- /.col-md-12-->

 			<?php
				} else if (isset($_GET['aset'])) {
					$kd_uker = $_GET['aset'];
					$showuker = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM data_uker WHERE kd_uker = '$kd_uker'"));
					if ($showuker['kd_uker'] == "") {
						$showbag = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM data_uker_bagian WHERE kd_bag = '$kd_uker'"));
						$kd = $showbag['kd_uker'];
						$namauker = $showbag['nama_bag'];
					} else {
						$kd = $showuker['kd_uker'];
						$namauker = $showuker['nama_uker'];
					}

				?>
 				<div class="box-header">
 					<h2 class="box-title"><b>Daftar Aset di <?php echo $namauker; ?></b></h2>
 					<div class="box-tools pull-right">
 						<a href="lokasi?view=<?php echo $kd; ?>" class="btn btn-primary">Back</a>
 					</div>
 				</div>
 				<?php
					$kduker = $_GET['aset'];
					$res = $conn->query("SELECT  * FROM data_kategori");
					while ($row = $res->fetch_assoc()) {
						$kd_kategori = $row['kd_kategori'];
						$jmlaset = mysqli_num_rows(mysqli_query($conn, "SELECT  * FROM data_aset where data_aset.kd_kategori='$kd_kategori' AND data_aset.kd_uker='$kduker'"));
						if ($jmlaset >= 1) {
					?><div class="box box-default">
 							<div class="box-header with-border">
 								<h2 class="box-title"><b><?php echo $row['nama_kategori']; ?></b></h2>

 							</div><!-- /.box-header -->
 							<div class="box-body">
 								<div class="table-responsive bs-example">
 									<table id="" class="tabledisplay table table-striped snipe-table">

 										<thead>
 											<tr>
 												<th>No</th>
 												<th>Nomor Aset</th>
 												<th>Tahun</th>
 												<th>Model</th>
 												<th>SN</th>
 												<th>NIK</th>
 												<th>Sewa</th>
 												<th>Catatan</th>
 												<th>Action</th>
 											</tr>
 										</thead>
 										<tbody>
 											<?php

												$no = 1;
												$res1 = $conn->query("SELECT  * FROM data_aset 
Left join data_karyawan ON data_aset.nik=data_karyawan.nik
Left join data_uker ON data_aset.kd_uker=data_uker.kd_uker 
Left join data_uker_bagian ON data_aset.kd_uker=data_uker_bagian.kd_bag  
		where data_aset.kd_kategori='$kd_kategori' AND data_aset.kd_uker='$kduker' ORDER BY no ASC");

												while ($row1 = $res1->fetch_assoc()) {
													echo '
		<tr>
		
		<td>' . $no . '</td>
		<td><a href="aset-detail?no=' . $row1['no'] . '" title="Detail Aset">' . $row1['no_aset'] . '</a></td>
		<td>' . $row1['tahun'] . '</td> 
		<td>' . $row1['model'] . '</td>
		<td>' . $row1['sn'] . '</td>  
		<td>' . $row1['nama_karyawan'] . '</td>';
													if ($row1['sewa'] == 0) {
														echo '<td>Tidak</td>';
													} else {
														echo '<td>Sewa</td>';
													}
													echo '
		<td>' . $row1['catatan'] . '</td> 
		<td><table border="0"><tr><td>
		
		<form role="form" action="edit" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="idd" value="' . $row1['no'] . '" >
			<input type="hidden" name="iduker" value="' . $kduker . '" >
			<button type="submit" name="editaset" class="btn btn-primary btn-sm"><span class="fa fa-pencil" aria-hidden="true">Edit</span></button>
		</form>
		</td>
		<td>
		<form role="form" action="edit" method="POST" enctype="multipart/form-data">
				<input type="hidden" name="idd"  value="' . $row1['no'] . '"> 
				<input type="hidden" name="kategori"  value="' . $row1['kd_kategori'] . '">
				<button type="submit" name="auditaset" class="btn btn-primary btn-sm"><span class="fa fa-check" aria-hidden="true">Audit</span></button>	
			</form>
			</td></tr></table>
		</td>
		</tr>';
													$no++;
												}
												?>
 										</tbody>
 									</table>
 								</div>
 							</div>
 						</div>
 				<?php
						}
					}
				} else {

					?>

 				<div class="col-md-12">
 					<div class="box box-default">
 						<div class="box-header">
 							<h2 class="box-title"><b>View Unit Kerja</b></h2>
 							<div class="box-tools pull-right">
 								<a href="lokasi-add" class="btn btn-primary">Unit Kerja Baru</a>
 								<a href="lokasi-kebutuhan" class="btn btn-primary">Input Permintaan</a>
 							</div>
 						</div><!-- /.box-header -->
 						<div class="box-body">
 							<div class="table-responsive bs-example">
 								<table class="table lokasidata  table-bordered table-striped">
 									<thead>
 										<tr>
 											<th>No.</th>
 											<th>Nama Unit Kerja</th>
 											<th>Bagian</th>
 											<th>Assets</th>
 										</tr>
 									</thead>
 									<tbody>
 										</tr>
 									</tbody>
 								</table>
 							</div>
 						</div><!-- /.box-body -->
 					</div><!-- /.box -->
 				</div> <!-- /.col-md-9-->

 			<?php } ?>
 		</div>
 	</div>
 </section>