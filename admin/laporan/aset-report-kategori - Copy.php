 
<div class="panel-info widget-shadow">
<form class="form-horizontal"  method="POST" action="">
<div class="form-group">
	 
	<label class="col-sm-2 control-label">
		<h4>Pilih Departemen :</h4>
	</label>
	
	<div class="col-sm-3">
		<select name="dep" id="dep" class="form-control selectpicker" data-live-search="true" place-holder="Pilih Nama Departemen">
		<option> </option>
		<?php
		 
		
		
		$res = $conn->query("SELECT * FROM data_uker");
		while($row = $res->fetch_assoc()){
		echo '
			<option value="'.$row['kd_uker'].'">'.$row['nama_uker'].'</option>
		';
		$no++;
		}
		?>
		</select>
		

	</div>
	  
	 
	
 

	 

	<label class="col-sm-2 control-label">
		<h4>Kategori :</h4>
	</label>
	
	<div class="col-sm-3">
		<select name="ktgr" id="ktgr" class="form-control selectpicker" data-live-search="true" required>
		<option></option>
		<?php
		 
		
		
		$res = $conn->query("SELECT * FROM data_kategori");
		while($row = $res->fetch_assoc()){
		echo '
			<option value="'.$row['kd_kategori'].'">'.$row['nama_kategori'].'</option>
		';
		$no++;
		}
		?>
		</select>
		

	</div>
	  
	 
	
 

	 
	<button type="submit" name="submit"" class="btn btn-danger btn-md"><span >Tampilkan</span></button>
</div>
</form> 
 


<?php 
if (isset($_POST['submit'])) { 
	$ktgr = $_POST['ktgr']; 
	$dep = $_POST['dep']; 
 

?>
 
  
<table  id="example2" class="  table-bordered ">
<thead>
<tr  align="center" >  
<th>No</th><th>Unit Kerja</th>  
<th colspan="3">Tersedia</th> 
</tr>
</thead>
<tbody>
	
<?php
if (empty($dep)){
	$sql="SELECT * FROM data_uker";
}else{
	$sql="SELECT * FROM data_uker where kd_uker='$dep'";
}

$no=1;
	  
$resuker = $conn->query($sql);  
	while($rowuker = $resuker->fetch_assoc()){
		$kduker=$rowuker['kd_uker'];
	 
		?>

	<tr>
		<td >&nbsp;<?php echo $no;?>.</td>
		<td>&nbsp;
			<b><?php echo  $rowuker['nama_uker'];?></b>
		</td>
		<td>
			<table class="table" >
				<tr align="center">
					<th>Tahun</th><th>Processor</th><th>QTY</th>
				</tr>
				<tr><?php
					$th = $conn->query("SELECT * FROM data_aset where kd_kategori='$ktgr' AND kd_uker='$kduker' GROUP BY tahun");  
					while($rowth = $th->fetch_assoc()){?>
					<td><?php echo $rowth['tahun'];?></td> 
					<td>
						<table >
						<?php
						$proc1 = $conn->query("SELECT *,count(proc) as totalproc FROM data_aset where kd_kategori='$ktgr' AND kd_uker='$kduker' AND tahun='$rowth[tahun]' group by proc"); 
						while($rowproc1 = $proc1->fetch_assoc()){
							?>
							<tr><td><?php echo $rowproc1['proc'];?></td></tr>
						<?php } ?>
				
						</table>
					</td>
					<td>
						<table>
						<?php
						$proc2 = $conn->query("SELECT *,count(proc) as totalproc FROM data_aset where kd_kategori='$ktgr' AND kd_uker='$kduker' AND tahun='$rowth[tahun]' group by proc"); 
						while($rowproc2 = $proc2->fetch_assoc()){
							?><tr><td><?php echo $rowproc2['totalproc'];?></td></tr>
						<?php } ?>
						</table>
					 
					 </td> 
				</tr>
				<?php } ?>
				 
			</table>
		</td> 
	</tr>
		 
	<?php
		$resbag = $conn->query("SELECT * FROM data_uker_bagian where kd_uker='$kduker' ");  
		while($rowbag = $resbag->fetch_assoc()){
			$kdbag= $rowbag['kd_bag'];
			?>
		
	<tr>
		<td> 
		</td>  
		<td>&nbsp;&nbsp;-
			<?php echo $rowbag['nama_bag']; ?> 
		</td> 
		<td>
		
			<table class="table ">
				<tr>
					<?php
							$th = $conn->query("SELECT * FROM data_aset where kd_kategori='$ktgr' AND kd_uker='$kdbag' GROUP BY tahun");  
							while($rowth = $th->fetch_assoc()){
					?>
					<td>
						<?php echo $rowth['tahun'];?>
					</td> 
					<td>
						<table >
							<?php
							$proc3 = $conn->query("SELECT *,count(proc) as totalproc FROM data_aset where kd_kategori='$ktgr' AND kd_uker='$kdbag' AND tahun='$rowth[tahun]' group by proc"); 
					 
							while($rowproc3 = $proc3->fetch_assoc()){
							?>
							<tr><td>&nbsp;&nbsp;&nbsp;<?php echo $rowproc3['proc'];?></td></tr>
							
							
							<?php } ?>
						</table>
					</td>
					 <td>
						<table >
							<?php
							$proc4 = $conn->query("SELECT *,count(proc) as totalproc FROM data_aset where kd_kategori='$ktgr' AND kd_uker='$kdbag' AND tahun='$rowth[tahun]' group by proc"); 
							while($rowproc4 = $proc4->fetch_assoc()){
								?><tr><td><?php echo $rowproc4['totalproc'];?></td></tr>
							
							<?php } ?>
						</table>
					 </td> 
				</tr>
				<?php } ?>
			</table>
		</td> 
		</tr>
	 <?php } ?>

	 <?php
	 $no++;
	}

?>
  
</tbody>
</table>
	 
 
			<?php } ?>
</div>