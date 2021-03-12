 
	<div class="box box-default">
		<div class="box-header with-border">
			<h2 class="box-title"><b>Pengalihan Aset Sewa</b></h2>				 
		</div><!-- /.box-header -->
			<div class="box-body">
			<form method="post" action=""> 
				<button type="submit" name="PC" id="PC" class="btn btn-success"><i class="fa fa-check icon-white"></i>Dekstop / PC</button>
				
				<button type="submit" name="mon" id="mon" class="btn btn-success"><i class="fa fa-check icon-white"></i>Monitor</button>
			</form>
			</div>
				<div class="box-body">
		<?php
			if (isset($_POST["PC"]) ){ ?>
					<p>*).Pilih Aset di kotak kiri untuk kemudian klik tombol proses </p>
					<form id="demoform" class="form-horizontal" method="post" action="Proses-Pengalihan-Aset" role="form" enctype="multipart/form-data">
					<div class="col-md-12">
						<select class="col-md-6"  multiple="multiple" size="15" name="duallistbox_demo1[]" id="duallist">
						<?php 
						
						$res = $conn->query("SELECT * FROM data_aset where sewa='1' and kd_kategori='cp'");
						while($row = $res->fetch_assoc()){
						echo '
						<option value="'.$row['no_aset'].'"> '.$row['no_aset']. ' - '.$row['kd_kategori'].  ' - '.$row['model']. ' </option>
						';
						}
						?>
						</select>
						<input type="hidden" name="kodeaset" value="cp"  >
						<div class="box-footer text-right">
							<button type="submit" name="simpanalih" id="simpanalih" class="btn btn-success"><i class="fa fa-check icon-white"></i> Proses</button>
						</div>
					</div>
					</form> 
		<?php	} elseif (isset($_POST["mon"]) ) {?>
				<div class="box-body">
					<p>*).Pilih Aset di kotak kiri untuk kemudian klik tombol proses </p>
					<form id="demoform" class="form-horizontal" method="post" action="Proses-Pengalihan-Aset" role="form" enctype="multipart/form-data">
					<div class="col-md-12">
						<select class="col-md-6"  multiple="multiple" size="15" name="duallistbox_demo1[]" id="duallist">
						<?php 
						
						$res = $conn->query("SELECT * FROM data_aset where sewa='1' and kd_kategori='cm'");
						while($row = $res->fetch_assoc()){
						echo '
						<option value="'.$row['no_aset'].'"> '.$row['no_aset']. ' - '.$row['kd_kategori'].  ' - '.$row['model']. ' </option>
						';
						}
						?>
						</select>
						<input type="hidden" name="kodeaset" value="cm"  >
						<div class="box-footer text-right">
							<button type="submit" name="simpanalih" id="simpanalih" class="btn btn-success"><i class="fa fa-check icon-white"></i> Proses</button>
						</div>
					</div>
					</form> 
		<?php	} ?>
				</div><!-- /.box-body -->
		
	</div><!-- /.box -->
  
 