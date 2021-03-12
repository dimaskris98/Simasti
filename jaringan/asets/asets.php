 
<?php
if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') { 
				 echo '<div id=" " class="pesan alert alert-success" role="alert">
  <strong>Sukses!</strong> '.$_SESSION['pesan'].'</a>.
</div>';
            }
 
    //        mengatur session pesan menjadi kosong
            $_SESSION['pesan'] = '';
?>
<div class="row">
<h2 class="pull-left"><?php echo $mod;?></h2>
<div class="pull-right"> 											
   <form role="form" action="<?php echo $mod;?>-add" method="POST" enctype="multipart/form-data">
		<button type="submit" name="status-add" class="btn btn-primary btn-md">new</button>
	</form>
</div>
</div>
 

<div class="tables">
<div class="table-responsive bs-example widget-shadow">
    <table id="" class="table display table-bordered table-striped">
		<thead>
			<tr><th>Id</th><th>Nama Model</th><th>Tahun</th><th>Janis Aset</th> <th>Jumlah</th> <th>Aksi</th></tr>
		</thead>
		<tbody>
				 <?php
					 
					$res = $conn->query("SELECT  * FROM aset_model_jaringan ");

					while($row = $res->fetch_assoc())
					{   
						echo '
						<tr>
						<td>'.$row['id_model'].'</td>
							<td>
								<form action="detail" method="post">
									<a name="tes" href="javascript:" onclick="parentNode.submit();"> '.$row['nama_model'].'</a> 
								</form>
							 </td>
						 
							<td>'.$row['tahun_model'].'</td>
							<td>'.$row['jenis_aset_model'].' </td>
							<td>'.$row['qty'].' </td>
							
							 
							 
							<td>
							
							<a href="'.$mod.'-edit?id='.$row['id_model'].'" class="btn btn-primary btn-xs"><span class="fa fa-pencil" aria-hidden="true"></span></a>  
									<button type="submit" name="consumable-hapus" onclick="return confirm(\'Anda yakin akan menghapus data '.$row['nama_model'].'?\')" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
								
							 </td>							
						</tr>';
						 
					}
				?>
		</tbody>
	</table>

	</div> 
</div> 