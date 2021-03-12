<?php
if (isset($_POST['save'])) {
	$id_aset = $_POST['no_aset_id'];
	$row = mysqli_fetch_array(mysqli_query($conn, "SELECT no_aset from data_aset WHERE no= '$id_aset'"));
	$no_aset = $row['no_aset'];
	$pengirim = $_POST['pengirim'];
	$tlp = $_POST['tlp'];
	$keluhan = $_POST['keluhan'];
	$tgl_datang = $_POST['tgl_datang'];
	$status = "open";

	$sql = "INSERT INTO perbaikan  VALUES ('', '$no_aset', '$pengirim', 
				'$tlp', '$keluhan', '$tgl_datang', '',  NULL, '$status','', '$id_user')";

	$query	= mysqli_query($conn, $sql);
	if ($query) {
		echo '<script>window.location="servis"</script>';
	} else {
		echo  mysqli_error($conn);
	}
}



?>
<div id="webui">
	<div class="row">
		<div class="col-md-7">
			<div class="box box-default">
				<div class="box-header with-border">
					<h2 class="box-title"><b>Tambah Data Perbaikan</b></h2>
					<div class="box-tools pull-right">
						<a href="javascript:history.back()" class="btn btn-primary">Back</a>

					</div>
				</div><!-- /.box-header -->
				<div class="box-body">
					<form id="create-form" class="form-horizontal" method="post" action="" role="form" enctype="multipart/form-data">
						<!-- Name -->
						<div class="form-group ">
							<label for="name" class="col-md-3 control-label">No Aset :</label>
							<div class="col-md-7 col-sm-12 required">
								<?php

								if (isset($_POST['aset-detail'])) {
									$no_aset = $_POST['no_aset'];
									$id = $_POST['id_aset'];
								?>
									<input class="form-control" type="text" name="no_aset" id="no_aset" value="<?= $no_aset; ?>" />
									<input class="form-control" type="hidden" name="no_aset_id" id="no_aset_id" value="<?= $id; ?>" />
								<?php
								} else {
								?>
									<select class="form-control select2" name="no_aset_id" id="no_aset_id" required>
										<option value=""></option>'.
										<?php
										$res = $conn->query("SELECT * FROM data_aset where lokasi='DI USER'");
										while ($row = $res->fetch_assoc()) {
											echo '
													<option value="' . $row['no'] . '"> ' . $row['no_aset'] . ' - ' . $row['model'] . ' </option>
													';
										}
										?>

									</select>
								<?php
								}
								?>
							</div>
						</div>
						<!-- Name -->
						<div class="form-group ">
							<label for="name" class="col-md-3 control-label">Pengirim :</label>
							<div class="col-md-7 col-sm-12 required">
								<input class="form-control" type="text" name="pengirim" id="pengirim" value=" " />
							</div>
						</div>
						<!-- tlp -->
						<div class="form-group ">
							<label for="name" class="col-md-3 control-label">Telp (Extension) :</label>
							<div class="col-md-3 col-sm-12 required">
								<input class="form-control" type="number" name="tlp" id="tlp" value="" />
							</div>
						</div>
						<div class="form-group ">
							<label for="name" class="col-md-3 control-label">Keluhan :</label>
							<div class="col-md-7 col-sm-12 required">
								<select name="keluhan" id="input" class="form-control select3" required="required">
								<option></option>
									<?php 
										$sql = "SELECT keluhan FROM perbaikan GROUP BY keluhan";
										$data = mysqli_query($conn,$sql);
										while($row = mysqli_fetch_assoc($data)){ ?>
											<option	value="<?= $row["keluhan"]?>"><?= $row["keluhan"]?></option>
									<?php } ?>
								</select>
								
							</div>
						</div>
						<div class="form-group ">
							<label for="name" class="col-md-3 control-label">Tanggal</label>
							<div class="col-md-9">
								<div class="input-group col-md-5">
									<input type="text" class="form-control tglpicker" placeholder="Tanggal Datang" name="tgl_datang" id="tgl_datang">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								</div>

							</div>
						</div>
						<div class="box-footer text-right">

							<button type="submit" name="save" id="save" class="btn btn-success"><i class="fa fa-check icon-white"></i>Simpan</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<div class="col-md-5" id="show-aset-detil">
		</div>
	</div>
</div>