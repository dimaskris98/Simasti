<style type='text/css'>
p.ex1 {
    
    padding-left: 10px;
}
p.ex2 {
    
    padding-left: 30px;
}
</style>

<?php
$res = $conn->query("SELECT  * FROM Licensi 
				LEFT JOIN kategori ON Licensi.id_kategori=kategori.id_kategori  
				LEFT JOIN manufaktur ON licensi.id_manufaktur=manufaktur.id_manufaktur  WHERE id='$_GET[detil]'"); 
				
$data1 = $res->fetch_array(); 
$seat=1;
$totalper = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM licensi_seat WHERE id_licensi='$_GET[detil]'"));
   


?>
<div class="col-sm-offset-11 col-sm-4">
	<a href="licensi" class="btn btn-primary">Kembali</a>
					</div> 
<div class="elements  row">  
<div class="col-md-8">
<div class="panel-body widget-shadow">
						<h4><?php echo $data1['nama_kategori'].' '. $data1['nama_licensi'];?></h4>
						 <table id="example1" class="table">
							<thead>
								<tr> 
								  <th>Seat</th>
								  <th>Tanggal</th>
								  <th>Karyawan</th> 
								  <th>No. Asset</th> 
								  <th>Admin</th>
								  <th>Chekin/out</th>
								</tr>
							</thead>
							<tbody>
							<?php    
							$res = $conn->query(" SELECT * FROM licensi_seat
							LEFT JOIN data_aset ON Licensi_seat.no_aset=data_aset.no_aset
							LEFT JOIN data_karyawan ON Licensi_seat.id_karyawan=data_karyawan.nik
							 LEFT JOIN  users ON Licensi_seat.id_user=users.id_user
												WHERE id_licensi='$_GET[detil]'  order by tgldibagikan ASC");  
								 
				while($row = $res->fetch_array()){ 
					echo '
						<tr> 
							<td>'.$seat++.'</td>
							<td>'.$row['tgldibagikan'].'</td>
							<td>'.$row['nama_karyawan'].'</td>
							<td><a href="rincian?aset='.$row['no_aset'].'" title="Detail Aset">'.$row['no_aset'].'</a></td>
							<td>'.$row['nama'].'</td>
							<td>'.$row['nama'].'</td>
						</tr>
					
					
				';}
				
							?>
								 
							</tbody>
						</table>
					</div>
</div>	


					<div class="col-md-2 profile widget-shadow">
						<h4 class="title3">Tentang <?php echo $data1['tipe']; ?></h4>
						<div  >
							 
							<p class="ex2">Manufactur: <?php echo $data1['nama_manufaktur']; ?></p>
							<p class="ex2">Product Kay: <?php echo $data1['serial']; ?></p>
							<p class="ex2">Purchase Date: <?php echo $data1['tgl_po']; ?></p>
							<p class="ex2">Purchase Cost: Rp <?php echo number_format( $data1['harga_po'], 0, ',', '.'); ?></p>  
							<p class="ex2">Order Number: <?php echo $data1['po']; ?> </p>
							<br>
						</div> 
					</div>
  

 </div>