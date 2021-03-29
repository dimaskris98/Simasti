<?php


$id = $_POST['idd'];

$showaset = mysqli_fetch_array(mysqli_query($conn, "SELECT  * FROM data_aset
			Left join data_kategori ON data_aset.kd_kategori=data_kategori.kd_kategori
			LEFT JOIN status_labels ON data_aset.status=status_labels.id
			WHERE no= '$id'"));
if ($showaset['sewa'] == "1") {
	$chek = "checked";
} else {
	$chek = "";
}
$id_monitor = $showaset['id_monitor'];
$asetmonitor = mysqli_fetch_array(mysqli_query($conn, "SELECT no_aset,model FROM data_aset  WHERE no= '$id_monitor'"));

$kdunitkerja = $showaset['kd_uker'];
$namaunitkerja = $showaset['nama_unitkerja'];


if (isset($_POST['aset-detail'])) {
	$aset_detail = $_POST['aset-detail'];
	$link = "";
	$back = '<a name="tes" href="aset-detail?no=' . $id . '" onclick="parentNode.submit();" class="btn btn-primary">Back</a>';
} else if (isset($_POST['karyawan-detail'])) {
	$aset_detail = "";
	$link = $_POST['karyawan-detail'];
	$back = '<form action="detail" method="post">
				<a name="tes" href="javascript:" onclick="parentNode.submit();" class="btn btn-primary">Back</a>
				<input type="hidden" name="karyawan-detail" value="' . $link . '"/>	
			</form>';
} else {
	if (isset($_SERVER['HTTP_REFERER'])) {
		$b = $_SERVER['HTTP_REFERER'];
	}
	$back = ' <a href="' . $b . '" class="btn btn-primary">Back</a>';
	$link = "";
	$aset_detail = "";
}
?>

<div class="col-md-8 col-md-offset-2">
	<div class="box box-default">
		<div class="box-header with-border">
			<h2 class="box-title"><b>Edit Asset</b></h2>
			<div class="box-tools pull-right">
				<?php echo $back; ?>

			</div>
		</div><!-- /.box-header -->
		<div class="box-body">
			<form id="create-form" class="form-horizontal" method="post" action="" role="form" enctype="multipart/form-data">

				<input class="form-control" type="hidden" name="karyawan-detail" id="karyawan-detail" value="<?php echo $link; ?>" />
				<input class="form-control" type="hidden" name="aset-detail" id="aset-detail" value="<?php echo  $aset_detail; ?>" />
				<!-- Name -->
				<div class="form-group ">
					<label for="name" class="col-md-3 control-label">No Aset</label>
					<div class="col-md-7 col-sm-12 required">
						<input class="form-control" type="text" name="no_aset" id="no_aset" value="<?php echo $showaset['no_aset']; ?>" />
						<input class="form-control" type="hidden" name="idaset" id="idaset" value="<?php echo $id; ?>" />
					</div>
				</div>
				<!-- Model -->
				<div class="form-group ">
					<label for="model_number" class="col-md-3 control-label">Model</label>

					<div class="col-md-7 required">
						<select class="form-control" title="Pilih Model" name="model" id="model">
							<option value="<?= $showaset['model'] ?>"> <?= $showaset['model'] ?> </option>
							<option value="">Silahkan Pilih...</option>
							<?php
							$res = $conn->query("SELECT model FROM data_aset where kd_kategori='$showaset[kd_kategori]' GROUP BY model ORDER BY model ASC");
							while ($row = $res->fetch_assoc()) {
								echo '<option value="' . $row['model'] . '"> ' . $row['model'] . ' </option>';
							}

							?>
						</select>
					</div>

					<div class="col-md-1 panel-grids">
						<button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#popmodel" data-whatever="@mdo">Baru</button>
					</div>
				</div>
				<!-- Kategori -->
				<div class="form-group">
					<label for="category_id" class="col-md-3 control-label">Kategori</label>
					<div class="col-md-7 required">
						<select class="form-control select2" name="kategori" id="kategori">
							<option value="<?php echo $showaset['kd_kategori']; ?>"> <?php echo $showaset['nama_kategori']; ?> </option>
							<?php
							$res = $conn->query("SELECT * FROM data_kategori");
							while ($row = $res->fetch_assoc()) {
								echo '
													<option value="' . $row['kd_kategori'] . '"> ' . $row['nama_kategori'] . ' </option>
													';
							}
							?>
						</select>
					</div>
				</div>
				<!-- SN -->
				<div class="form-group ">
					<label for="name" class="col-md-3 control-label">SN</label>
					<div class="col-md-7 col-sm-12 required">
						<input class="form-control" type="text" name="sn" id="sn" value="<?php echo $showaset['sn']; ?>" />
					</div>
				</div>
				<div class="form-group ">
					<label for="model_number" class="col-md-3 control-label">Tahun</label>
					<div class="col-md-7">
						<div class="input-group year col-md-5">
							<input type="text" class="form-control datepicker" placeholder="Tahun" name="tahun" id="tahun" value="<?php echo $showaset['tahun']; ?>" required>
							<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
						</div>
					</div>
				</div>
				<div class="form-group ">
					<label for="model_number" class="col-md-3 control-label">Sewa</label>
					<div class="col-md-7">
						<input type="checkbox" name="sewa" id="sewa" value="1" <?= $chek ?> />

					</div>
				</div>

				<div class="form-group">
					<label for="category_id" class="col-md-3 control-label">Status</label>
					<div class="col-md-7 required">

						<select onchange="TampilNotes(this.value)" onclick="changeValue(this.value)" class="form-control" title="Pilih Status" name="status" id="status" required>
							<option value="<?php echo $showaset['id']; ?>"><?php echo $showaset['name']; ?></option>
							<?php
							$res = $conn->query("SELECT * FROM status_labels ");
							$jsArray = "var dtstatus = new Array();\n";
							while ($row = $res->fetch_assoc()) {
								echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
								$jsArray .= "dtstatus['" . $row['id'] . "'] = {deployable:'" . addslashes($row['deployable']) . "'};\n";
							}
							?>
						</select>
						<input type="hidden" name="jrsn" id="jrsn" />
						<a id="tampilnote"></a>

					</div>
				</div>

				<!-- User -->
				<?php
				$idstatus = $showaset['id'];
				$showstatus = mysqli_fetch_array(mysqli_query($conn, "SELECT  * FROM status_labels  WHERE id= '$idstatus'"));
				if ($showstatus['deployable'] == "1") {
					$divstatus = '<div  id="divstatus" >';
					$tampilnote = '<a>' . $showstatus['notes'] . '</a>';
				} else {
					$divstatus = '<div  id="divstatus" style="display:none;" class="form-group">';
					$tampilnote = ' <a id="tampilnote"></a>';
				}
				echo $divstatus;
				?>


				<div class="form-group ">
					<label for="name" class="col-md-3 control-label">Tanggal Keluar</label>
					<div class="col-md-7 col-sm-12 required">
						<div class="input-group col-md-5">
							<input type="text" class="form-control tglpicker" placeholder="Tanggal Keluar" name="tglkeluar" id="tglkeluar" value="<?= $showaset['checkout_date']; ?>" required>
							<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
						</div>

					</div>
				</div>
				<div class="form-group">
					<label for="assigned_user" class="col-md-3 control-label">Karyawan</label>
					<div class="col-md-7 required">
						<select class="form-control selectpicker" data-live-search="true" style="width: 100%" name="karyawan" id="karyawan">
							<option value="<?php echo $showaset['nik']; ?>"><?php echo $showaset['nik'] . ' - ' . $showaset['nama_karyawan']; ?></option>
							<option value=""></option>
							<?php
							$res = $conn->query("SELECT * FROM data_karyawan");
							while ($row = $res->fetch_assoc()) {
								echo '<option value="' . $row['nik'] . '">' . $row['nik'] . ' - ' . $row['nama_karyawan'] . '</option>';
							}
							?>
						</select>
					</div>
					<div class="col-md-1 panel-grids">
						<button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#popnewkaryawan" data-whatever="@mdo">Baru</button>
					</div>
				</div>


		</div>
		<?php
		if (($showaset['nama_kategori'] == "dekstop") or ($showaset['nama_kategori'] == "DEKSTOP") or ($showaset['nama_kategori'] == "Dekstop")) {

		?>
			<div class="form-group">
				<label for="assigned_user" class="col-md-3 control-label">Monitor</label>
				<div class="col-md-7 required">
					<select name="id_monitor" id="id_monitor" class="form-control select2">
						<option value="<?php echo $asetmonitor['no_aset']; ?>"><?php echo $asetmonitor['no_aset'] . ' - ' . $asetmonitor['model']; ?></option>
						<option value=""></option>
						<?php
						$res = $conn->query("SELECT * FROM data_aset where kd_kategori='cm'");
						while ($row = $res->fetch_assoc()) {
							echo '<option value="' . $row['no'] . '">' . $row['no_aset'] . ' - ' . $row['model'] . '</option>';
						}?>
					</select>
				</div>
				<div class="col-md-1 panel-grids">
					<button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#popMonitor" data-whatever="@mdo">Baru</button>
				</div>
			</div>
		<?php
		}?>


		<!-- Catatan -->
		<div class="form-group ">
			<label for="name" class="col-md-3 control-label">Catatan</label>
			<div class="col-md-7 col-sm-12 required">
				<textarea class="form-control" type="text" name="catatan" id="catatan" value=""><?php echo $showaset['catatan']; ?></textarea>
			</div>
		</div>
		<div class="box-footer text-right">
			<button type="submit" name="saveeditaset" id="saveeditaset" class="btn btn-success"><i class="fa fa-check icon-white"></i> Save</button>
		</div>
		</form>
	</div>
</div>
</div>