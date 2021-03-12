<?php  

 $back=$_POST['back-link'];
 $idstatus=$_POST['status-detail'];
?>
<section class="content-header" style="padding-bottom: 30px;">
<h1 class="pull-left"><?php echo $mod;?></h1>
<div class="pull-right"> 										
    <a href="<?php echo $back;?> " class="btn btn-primary ">Back</a> 
 
</div>
						

        </section>

 <div class="col-md-12 panel-grids">
<div class="box-body table-responsive" >
<table id="" class="tabledisplay table table-bordered table-striped">
<thead>
<tr>
	<th>Nomor Aset</th>
	<th>Tahun</th> 
	<th>Kategori</th>  
	<th>Model</th>  
	<th>Karyawan</th> 
	<th>Unit Kerja</th> 
	<th>Aksi</th>
</tr>
</thead>
<tbody>
				 <?php
 
$res = $conn->query("SELECT data_kategori.*,data_aset.*,data_aset.nik as tnik,data_aset.kd_uker as tuker, data_karyawan.*,data_uker.*,data_uker_bagian.* FROM data_aset
					left join data_karyawan ON data_aset.nik=data_karyawan.nik
					Left join data_uker ON data_aset.kd_uker=data_uker.kd_uker
					Left join data_uker_bagian ON data_aset.kd_uker=data_uker_bagian.kd_bag
					Left join data_kategori ON data_aset.kd_kategori=data_kategori.kd_kategori
					where status='$idstatus' ");
while($row = $res->fetch_assoc()){ 
					echo '
					<tr>
						<td>
							<form action="detail" method="post">
								<a name="tes" href="javascript:" onclick="parentNode.submit();"> '.$row['no_aset'].'</a>
								<input type="hidden" name="aset-detail" value="'.$row['no'].'"/> 
							</form>
						 </td>
						 <td>'.$row['tahun'].'</td>
						 <td>'.$row['nama_kategori'].'</td>
						 <td>'.$row['model'].'</td>
						 <td>'.$row['tnik'].' - '.$row["nama_karyawan"].'</td>
						 <td>'.$row['tuker'].' - '. $row["nama_uker"]. $row["nama_bag"].'</td>
						<td>
							<form role="form" action="edit" method="POST" enctype="multipart/form-data">
								<input type="hidden" name="idd" value="'.$row['no'].'" >  
								<input type="hidden" name="kategori" value="'.$row['kd_kategori'].'" > 	
								<button type="submit" name="editaset" class="btn btn-primary btn-sm"><span class="fa fa-pencil" aria-hidden="true"></span></button>
								<button type="submit" name="hapuscp" onclick="return confirm(\'Anda yakin akan menghapus data '.$row['no_aset'].'?\')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
							</form>
						 </td>							
					</tr>';
					 
				}
				?>
		</tbody>
</table>
 </div></div>