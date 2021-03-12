<?php 
$id=$_POST['consumable-detail'];
$data =mysqli_fetch_array(mysqli_query($conn,"SELECT  * FROM consumable 
				LEFT JOIN kategori ON consumable.id_kategori=kategori.id_kategori 
				LEFT JOIN data_pemasok ON consumable.id_sup=data_pemasok.id_sup 
				LEFT JOIN manufaktur ON consumable.id_manufaktur=manufaktur.id_manufaktur WHERE id='$id'"));
 

?> 
<div class="elements  row">  
<div class="col-md-8">
<div class="panel-body widget-shadow">
<div class="box-header with-border">
						<h4><?php echo $data['nama_kategori'].' '. $data['nama_consumable'];?></h4>
						<div class="box-tools pull-right">
	<a href="<?php echo $_POST['back-link']; ?>" class="btn btn-primary">Kembali</a>
						</div>
					</div><!-- /.box-header -->
					<div class="box-body">
						 <table id="example1" class="table">
							<thead>
								<tr> 
								  <th>Tanggal</th>
								  <th>User</th>
								  <th>Qty</th>
								  <th>Admin</th>
								</tr>
							</thead>
							<tbody>
							<?php
							
								$res = $conn->query("SELECT  *, data_karyawan.*, users.* FROM consumable_user 
													LEFT JOIN data_karyawan ON consumable_user.dibagikanke=data_karyawan.nik
													LEFT JOIN users ON consumable_user.id_user=users.id_user WHERE id_consumable='$id'");
				while($row = $res->fetch_array()){ 
					echo '
						<tr> 
							<td>'.$row['tgldibagikan'].'</td>
							<td>'.$row['nama_karyawan'].'</td>
							<td>'.$row['qty'].'</td>
							<td>'.$row['nama'].'</td>
						</tr>
					
					
				';}
							?>
								 
							</tbody>
						</table>
					</div>
					</div>
</div>	


					<div class="col-md-2 profile widget-shadow">
						<h4 class="title3">Tentang Consumable</h4>
						<div  >
							<p class="ex1">Consumables are anything purchased that will be used up over time. For example, printer ink or copier paper.</p>
							<br>
							<p class="ex2">Purchase Date: <?php echo $data['tgl_po']; ?></p>
							<p class="ex2">Purchase Cost: Rp <?php echo number_format( $data['harga'], 0, ',', '.'); ?></p>
							<p class="ex2">Item No.: <?php echo $data['no_item']; ?></p>
							<p class="ex2">Manufacturer: <?php echo $data['nama_manufaktur']; ?></p>
							<p class="ex2">Order Number: <?php echo $data['po']; ?> </p>
							<br>
						</div> 
					</div>
  

 </div>