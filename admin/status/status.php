<?php
 
?>
<div class="col-md-11 panel-grids">
	<h4>Label Status</h4>
</div>
<div class="col-md-1 panel-grids">
	<form role="form" action="add" method="POST" enctype="multipart/form-data">
		<button type="submit" name="status-add" class="btn btn-primary btn-md">new</button>
	</form>
</div>
<div class="col-md-12 panel-grids">
<div class="box-body table-responsive" >
    <table id="" class="tabledisplay table table-bordered table-striped">
		<thead>
			<tr><th>Id</th><th>Nama</th><th>Tipe</th><th>Aset</th> <th>Catatan</th> <th>Aksi</th></tr>
		</thead>
		<tbody>
				 <?php
 
$res = $conn->query("SELECT  * FROM status_labels ");

while($row = $res->fetch_assoc()){
	$id=$row['id']; 
	$totalaset = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM data_aset where status='$id'")); 
	if 	($row['deployable']==1){$tipe="Dapat Dibagikan";}else{$tipe="Tidak Dapat Dibagikan";}

					echo '
					<tr>
					<td>'.$row['id'].'</td>
						<td>
							<form action="detail" method="post">
								<a name="tes" href="javascript:" onclick="parentNode.submit();"> '.$row['name'].'</a>
								<input type="hidden" name="status-detail" value="'.$row['id'].'"/>
								<input type="hidden" name="back-link" value="'.$mod.'" >
							</form>
						 </td>
					 
						<td>'.$tipe.'</td>
						<td>'.$totalaset.' </td>
						<td>'.$row['notes'].' </td>
						
						 
						 
						<td>
							<form role="form" action="edit" method="POST" enctype="multipart/form-data">
								<input type="hidden" name="id" value="'.$row['id'].'" > 
								<input type="hidden" name="back-link" value="'.$mod.'" > 		
								<button type="submit" name="status-edit" class="btn btn-primary btn-sm"><span class="fa fa-pencil" aria-hidden="true"></span></button>
								<button type="submit" name="status-hapus" onclick="return confirm(\'Anda yakin akan menghapus data '.$row['name'].'?\')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
							</form>
						 </td>							
					</tr>';
					 
				}
				?>
		</tbody>
	</table>

</div>
</div>