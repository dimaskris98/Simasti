 
						
					<?php 
$id=$_POST['id']; 
$row =mysqli_fetch_array(mysqli_query($conn,"SELECT perbaikan.*,data_aset.*,data_karyawan.*,data_uker.*,data_uker_bagian.* 
											from (perbaikan left JOIN data_aset on perbaikan.no_aset = data_aset.no_aset)
											LEFT JOIN data_karyawan on data_aset.nik = data_karyawan.nik
											LEFT JOIN data_uker on data_aset.kd_uker = data_uker.kd_uker 
											LEFT JOIN data_uker_bagian on data_aset.kd_uker = data_uker_bagian.kd_bag 
											WHERE id= '$id'"));
$aset=$row['no_aset'];
$rowkategori =mysqli_fetch_array(mysqli_query($conn,"SELECT data_kategori.*,data_aset.* 
											from  data_kategori left JOIN data_aset on data_kategori.kd_kategori = data_aset.kd_kategori 
											 
											WHERE no_aset= '$aset'"));  
$ukerid=$row['kd_uker'];
$datauker =mysqli_fetch_array(mysqli_query($conn,"SELECT data_uker.kd_uker,data_uker.nama_uker, 
											data_uker_bagian.kd_bag, data_uker_bagian.nama_bag
											FROM data_uker	
											LEFT JOIN data_uker_bagian ON data_uker.kd_uker=data_uker_bagian.kd_uker
											WHERE data_uker.kd_uker='$ukerid' or kd_bag='$ukerid'"));												
			if(isset($_POST['karyawan-detail']))
			 {
				 $link=$_POST['karyawan-detail'];
				$back='<form action="detail" method="post">
								<a name="tes" href="javascript:" onclick="parentNode.submit();" class="btn btn-primary">Back</a>
								<input type="hidden" name="karyawan-detail" value="'.$link.'"/>
							
						</form>';
			 
			}else
			{
				$back=' <a href="javascript:history.back()" class="btn btn-primary">Back</a>'; 
			}
?>
<div class="panel-info widget-shadow"> 
	<div class="col-md-6 panel-grids">
	
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Kode Servis : <?=$row['id']?></h3>
			</div>
			<div class="panel-body">
				<table >
					<tr>
						<td>No Aset</td><td>&nbsp;=&nbsp;</td><td><?=$row['no_aset']?></td>
					</tr>
					<tr>
						<td>Kategori</td><td>&nbsp;=&nbsp;</td><td><?=$rowkategori['nama_kategori'].' - '.$row['model']?></td>
					</tr>
					<tr>
						<td>Pengirim</td><td>&nbsp;=&nbsp;</td><td><?=$row['pengirim']?></td>
					</tr>
					<tr>
						<td>Departemen</td><td>&nbsp;=&nbsp;</td><td><?=$datauker['nama_uker']?></td>
					</tr>
					<tr>
						<td>Bagian</td><td>&nbsp;=&nbsp;</td><td><?=$datauker['nama_bag']?></td>
					</tr>
					<tr>
						<td>Keluhan</td><td>&nbsp;=&nbsp;</td><td><?=$row['keluhan']?></td>
					</tr>
				</table> 
			</div>
		</div>
	</div> 
 
	<form  class="form-horizontal" method="post" action="" role="form" enctype="multipart/form-data"> 
		<div class="col-md-6 panel-grids">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title">Input Tindakan</h3>
				</div>
				<div class="panel-body">
					<input class="form-control"  type="hidden" name="id"  value="<?=$row['id']?>" >
					<input class="form-control"  type="text" name="tindakan" >
				</div>
				<div class="form-group ">
								<label for="name" class="col-md-2 control-label">Tanggal</label>
								<div class="col-md-9">
									<div class="input-group col-md-5"   >
										<input type="text" class="form-control tglpicker" placeholder="Tanggal Selesai" name="tgl" id="tgl">
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									</div>
									
								</div>
							</div>
			</div>
			
							
		</div>
		<div class="clearfix"> </div>
		<div class="box-footer text-right">
		<?php echo $back; ?>
			<button type="submit" name="simpan" id="simpan" class="btn btn-success"><i class="fa fa-check icon-white"></i> Simpan</button>
		</div>
	</form> 
<div class="clearfix"> </div>						
</div>
<?php
	if (isset($_POST['simpan'])){
	$id=$_POST['id'];
	$tgl=$_POST['tgl'];
	$tindakan=$_POST['tindakan'];  
	
	$sql = "UPDATE perbaikan SET tgl_selesai='$tgl', tindakan='$tindakan', status_perbaikan='selesai'
			WHERE id='$id'";

	//echo $sql;	
	$query	= mysqli_query($conn,$sql);
	echo '<script>window.location="servis"</script>';

}
?>
	 
					
 