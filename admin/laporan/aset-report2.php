<style>
table, td, th {    
    border: 1px solid black;
    font-size: 12px;
}
table.a {    
    border: 0px;
    
}
tr.b{    
    border: 0px;
    
}

table { 
    border-collapse: collapse;
    width: auto;
}

th, td {
    padding: 4px;
	word-wrap:break-word;
}
td.c {
    padding: 0px;
}
th {
    text-align: center;
}
p.tebal {
    font-weight: bold;
}

 .kolom1 {
             
                width: auto;
                 padding: 5px;
                float:left;
    } 

</style>
<div class="panel-info widget-shadow">
<form class="form-horizontal"  method="POST" action="">
<div class="form-group">
	 
	<label class="col-sm-8 control-label">
		<h4>Unit Kerja :</h4>
	</label>
	
	<div class="col-sm-3">
		<select name="uker" id="uker" class="  selectpicker" data-live-search="true" required>
		<option>Pilih Unit Kerja</option>
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
	<button type="submit" name="submit"" class="btn btn-danger btn-md"><span >Tampilkan</span></button>
</div>
</form> 
 


<?php 
if (isset($_POST['submit'])) { 
	$kduker = $_POST['uker'];
	$terisi=mysqli_fetch_array(mysqli_query($conn,"Select (g1+g2+g3+g4+g5+g6+g7+gpk) AS totalisi From data_uker where kd_uker='$kduker'")); 
	$terisiNonOrganik=mysqli_fetch_array(mysqli_query($conn,"Select SUM(non_organik_bag) AS totalisiNonOrganik From data_uker_bagian where kd_uker='$kduker'"));
	$formasibag=mysqli_fetch_array(mysqli_query($conn,"Select SUM(formasi) AS total From data_uker_bagian where kd_uker='$kduker'")); 
	$formasibagnonorganik=mysqli_fetch_array(mysqli_query($conn,"Select SUM(formasi_non_organik) AS formasi_non_organik From data_uker_bagian where kd_uker='$kduker'")); 
	$jumlahaset = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM data_aset WHERE kd_uker = '$kduker'"));
	$res = $conn->query("SELECT * FROM  data_uker where kd_uker='$kduker'");
		//SELECT * , data_uker_bagian.* FROM  data_uker INNER JOIN data_uker_bagian ON data_uker.kd_uker=data_uker_bagian.kd_uker where data_uker.kd_uker='$kduker'	 
			while($ker = $res->fetch_assoc()){
				$totalformasi=$formasibag['total']+$ker['formasi_uker'];
				$totalFormasiNonOrganik=$formasibagnonorganik['formasi_non_organik']+$ker['formasi_non_organik'];
				$totalterisiNonOrganik=$terisiNonOrganik['totalisiNonOrganik']+$ker['non_organik'];
				
 ?>

 <div class="tables">
 <div class="table-responsive bs-example widget-shadow"> 
 <h4>INFORMASI STRUKTUR</h4>
	 <div class="col-md-11">
		<table >
			<thead bgcolor="silver">
				<tr>
					<th rowspan="2">Unit Kerja</th>
					<th colspan="2">Total Formasi</th>
					<th colspan="8">Grade</th>
					<th colspan="2">Terisi</th>
				</tr>
				<tr>
					<td>Organik</td><td>Non Organik</td>
				 
					<td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td><td>PK</td>
					<td>Organik</td><td>Non Organik</td>
				</tr>
			</thead>
			<tbody>
				<?php echo'
				<tr align="center">
					<td ><a   href="#'.$ker['kd_uker'].'">'.$ker['nama_uker'].'</a></td>  
					<td >'.$totalformasi.'</td>
					<td >'.$totalFormasiNonOrganik.'</td> 
					<td  >'.$ker['g1'].'</td> 
					<td  >'.$ker['g2'].'</td> 
					<td  >'.$ker['g3'].'</td> 
					<td  >'.$ker['g4'].'</td> 
					<td  >'.$ker['g5'].'</td> 
					<td  >'.$ker['g6'].'</td> 
					<td  >'.$ker['g7'].'</td> 
					<td  >'.$ker['gpk'].'</td>
					<td >'.$terisi['totalisi'].'</td> 
					<td >'.$totalterisiNonOrganik.'</td>
				</tr>
			</tbody>
		</table>
	</div>';
			 	?>
	<div class="col-md-1">  
		
	<a href="print.php?id=<?php echo $kduker;?>"  target="_blank">
	
									   <div ><i class="fa_p fa-print nav_print"></i></div>
									   <div class="clearfix"></div>	
									</a>
	</div>
</div>
<div class="table-responsive bs-example widget-shadow">
	<h4>DISTRIBUSI ASSET</h4>
	 
		<table>
			<thead bgcolor="silver">
				<tr >  
					<th rowspan="3">Nama Unit Kerja/Bagian</th> 
					<th rowspan="3">Formasi</th> 
					<th colspan="8">Jumlah Aset</th>  
					<th bgcolor="white" style=" border: 0px;"></th>  
					<th colspan="8">Kebutuhan Aset</th> 
				<tr>
					<?php
					
						$res = $conn->query("SELECT * FROM data_kategori  ORDER BY id ASC");
						while($row = $res->fetch_assoc())
						{ 
						$kdkat=$row['kd_kategori'];
						if ($kdkat=='cp'){
							echo'<td colspan="2" align="center">'.$row['nama_kategori'].' </td>';
						}else{
							echo'<td rowspan="2" align="center">'.$row['nama_kategori'].' </td>';
							}
						}
					 echo'<td rowspan="2" bgcolor="white" style=" border: 0px;"></td>';
					 
						//kebutuhan
						$res = $conn->query("SELECT * FROM data_kategori  ORDER BY id ASC");
						while($row = $res->fetch_assoc())
						{ 
						$kdkat=$row['kd_kategori'];
						 
							echo'<td rowspan="2" align="center">'.$row['nama_kategori'].' </td>';
						 
						}
					?>	
				</tr>  
				<tr><td>PG</td><td>Sewa</td></tr> 
			</thead>
			
				<?php
			echo '<tbody>
					<tr>
						<td   ><a   href="#'.$ker['kd_uker'].'">'.$ker['nama_uker'].'</a></td> 
						<td align="center" >'.$ker['formasi_uker'].'</td>';
						$res = $conn->query("SELECT * FROM data_kategori ORDER BY id ASC");
						while($row = $res->fetch_assoc())
						{ 
							$kdkat=$row['kd_kategori'];
							$tot = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM data_aset  
																where data_aset.kd_uker='$kduker' and data_aset.kd_kategori='$kdkat'"));
							if ($kdkat=='cp'){
								$pcaset = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM data_aset WHERE kd_uker='$kduker' and kd_kategori = 'cp' and sewa='0'"));
								$pcsewa = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM data_aset WHERE kd_uker='$kduker' and kd_kategori = 'cp' and sewa='1'"));
								echo'<td align="center">'.$pcaset.' </td><td align="center">'.$pcsewa.' </td>';
						}else{
								echo'<td align="center">'.$tot.' </td>';
							}
						
						}
						echo'<td bgcolor="white" style=" border: 0px;"></td>';
						//kebutuhan
							$res = $conn->query("SELECT * FROM data_kategori ORDER BY id ASC");
							while($row = $res->fetch_assoc())
							{ 
								$kdkat=$row['kd_kategori'];
								$reskebutuhan = $conn->query("SELECT * FROM kebutuhan where id_uker='$kduker' and id_kategori='$kdkat'");
								$rowcount=mysqli_num_rows($reskebutuhan);  
									if(($rowcount)==0){
										echo'<td align="center">0</td>';
									}else{
										while($rowreskebutuhan = $reskebutuhan->fetch_assoc())
										{ 
										echo'<td align="center"> '. $rowreskebutuhan['qty'].'</td>';
										}
									}
							}
				echo'</tr> '; 
				$showbag = $conn->query("SELECT * FROM  data_uker_bagian where kd_uker='$kduker'"); 
				while($rowbag = $showbag->fetch_assoc()){
				$kdbag=$rowbag['kd_bag'];
				$totalasetbagian = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM data_aset WHERE kd_uker = '$kdbag'"));
					echo '<tr>  
					<td><a   href="#'.$kdbag.'">'.$rowbag['nama_bag'].'</a></td>
					<td align="center">'.$rowbag['formasi'].'</td>';
					
							 
							$res = $conn->query("SELECT * FROM data_kategori ORDER BY id ASC");
							while($row = $res->fetch_assoc())
							{ 
								$kdkat=$row['kd_kategori'];
								$totbag = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM data_aset 
																	where data_aset.kd_uker='$kdbag' and data_aset.kd_kategori='$kdkat'"));
								if ($kdkat=='cp'){
								$pcaset = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM data_aset WHERE kd_uker='$kdbag' and kd_kategori = 'cp' and sewa='0'"));
								$pcsewa = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM data_aset WHERE kd_uker='$kdbag' and kd_kategori = 'cp' and sewa='1'"));
							echo'<td align="center">'.$pcaset.' </td><td align="center">'.$pcsewa.' </td>';
						}else{
								echo'<td align="center"> '. $totbag.' </td>';
							}
									
								
							
								
							 
							}
							echo'<td bgcolor="white" style=" border: 0px;"></td>';
				 
							//kebutuhan
							$res = $conn->query("SELECT * FROM data_kategori ORDER BY id ASC");
							while($row = $res->fetch_assoc())
							{ 
								$kdkat=$row['kd_kategori'];
								$reskebutuhan = $conn->query("SELECT * FROM kebutuhan where id_uker='$kdbag' and id_kategori='$kdkat'");
								$rowcount=mysqli_num_rows($reskebutuhan);  
									if(($rowcount)==0){
										echo'<td align="center">0</td>';
									}else{
										while($rowreskebutuhan = $reskebutuhan->fetch_assoc())
										{ 
										echo'<td align="center"> '. $rowreskebutuhan['qty'].'</td>';
										}
									}
							}
 	
			 		
				echo'</tr>';	
				}
				echo'<tr bgcolor="silver"><td align="right">Sub Total<br></td><td align="center">'.$totalformasi.'<br></td>';
				$totalall=0;
				$totalpg=0;$totalsewa=0;
				$res = $conn->query("SELECT * FROM data_kategori ORDER BY id ASC ");
					while($row = $res->fetch_assoc())
				{
					$kdkat=$row['kd_kategori'];
					if ($kdkat=='cp'){
						$pcaset = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM data_aset WHERE kd_uker='$kduker' and kd_kategori = 'cp' and sewa='0'"));
						$pcsewa = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM data_aset WHERE kd_uker='$kduker' and kd_kategori = 'cp' and sewa='1'"));
						}else{
							$dep = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM data_aset WHERE kd_kategori='$kdkat' AND kd_uker = '$kduker'"));
							}
						$totalbg=0;$totalbgpg=0;$totalbgsewa=0;
						
					$sqlbag = $conn->query("SELECT * FROM data_uker_bagian where kd_uker='$kduker' ");
					while($rowbag = $sqlbag->fetch_assoc())
					{
						$kdbag=$rowbag['kd_bag'];
							if ($kdkat=='cp'){
								$pcasetbg = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM data_aset WHERE kd_uker='$kdbag' and kd_kategori = 'cp' and sewa='0'"));
								$pcsewabg = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM data_aset WHERE kd_uker='$kdbag' and kd_kategori = 'cp' and sewa='1'"));
								$totalbgpg+=$pcasetbg;
								$totalbgsewa+=$pcsewabg;
							}else{
								$pc = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM data_aset WHERE kd_kategori='$kdkat' AND kd_uker = '$kdbag'"));
							}
							
							$totalbg+=$pc;
							
					
					}
					 
					$totalall=$totalbg+$dep;
					$totalpg=$totalbgpg+$pcaset;
					$totalsewa=$totalbgsewa+$pcsewa;
					if ($kdkat=='cp'){
						echo'<td align="center">' .$totalpg.'<br></td><td align="center">' .$totalsewa.'<br></td>';
						}else{
							echo'<td align="center">' .$totalall.'<br></td>';
							}
					
				}
				echo'<td bgcolor="white"  style=" border: 0px;"></td>';
				$sub_kalimat = substr($kduker,0,3);
				 
				 
					 
							$res = $conn->query("SELECT * FROM data_kategori ORDER BY id ASC");
							while($row = $res->fetch_assoc())
							{ 
								$kdkat=$row['kd_kategori'];
								$reskebutuhan = $conn->query("SELECT sum(qty) as totalkebutuhan FROM kebutuhan WHERE id_uker LIKE '$sub_kalimat%' and id_kategori='$kdkat'");
								 
									while($rowreskebutuhan = $reskebutuhan->fetch_assoc())
									{ 
									 if ($rowreskebutuhan['totalkebutuhan']==0){
										 echo'<td align="center">0</td>';
									 }else{
									 echo'<td align="center"> '. $rowreskebutuhan['totalkebutuhan'].'</td>';
									 }
										
										
										 
									}
							}
					
				 
				
				echo'</tr>
			</tbody>
		</table>';
			}
		?>
			
		 
</div>		
 
<?php
 
$totalasetdep = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM data_aset 
											where kd_uker='$kduker'"));
	 
$tampilnama =mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM data_uker WHERE kd_uker = '$kduker'")); 
echo'
 <div class="table-responsive bs-example widget-shadow">
<h4 id="'.$tampilnama['0'].'">'.$tampilnama['1'].' Total Aset = '.$totalasetdep.'</h4>';  
$no1 = 1;
$res = $conn->query("SELECT * FROM data_kategori  ORDER BY id ASC");
	while($row = $res->fetch_assoc())
	{ 
						$kdkat=$row['kd_kategori'];
						$tot = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM data_aset 
											where data_aset.kd_uker='$kduker' and data_aset.kd_kategori='$kdkat'"));
				
				if ($tot>0){ 
					if ($kdkat=='cp'){ 
					echo'					
						<div class="col-md-12">
						<p class="tebal"> '.$row['nama_kategori'].' : ' .$tot.' Unit</p>
						';
						$th = $conn->query("SELECT proc, count(proc) as totproc FROM data_aset 
											where data_aset.kd_uker='$kduker' and data_aset.kd_kategori='$kdkat' GROUP BY proc");  
							while($rowth = $th->fetch_assoc()){echo '<a><i>'.$rowth['proc'].' - '.$rowth['totproc'].' unit, </i></a>';}
						echo'
						<table  table-layout="auto" width= "100%"  >
							<thead bgcolor="silver">
								<tr height="20px"  width="100%"> 
									<th rowspan="2">No</th><th rowspan="2">No Asset</th><th rowspan="2">Model</th>';
									if  ($kdkat=="cp"){ echo'<th colspan="3">Spesifikasi</th>';}
									else if ($kdkat=="nb"){ echo'<th colspan="3">Spesifikasi</th>';}else{ echo'';}
									echo'<th colspan="2">PIC</th>
									<th rowspan="2">Sewa</th>
								</tr>
								<tr>';
									if  ($kdkat=="cp")
									{ echo'<td align="center">OS</td><td align="center">Processor</td><td align="center">Ram/Hdd</td> ';}
									else if  ($kdkat=="nb")
									{ echo'<td align="center">OS</td><td align="center">Processor</td><td align="center">Ram/Hdd</td> ';}
									else { echo'';}
									echo'<td align="center">NIK</td><td align="center">Nama</td> 
									
								</tr>
							</thead>
							<tbody>';
							$no = 1;
					$res1 = $conn->query("SELECT *, data_uker.*, data_karyawan.*  FROM data_aset 
											LEFT JOIN data_uker ON data_aset.kd_uker=data_uker.kd_uker 
											LEFT JOIN data_karyawan ON data_aset.nik=data_karyawan.nik 
											where data_aset.kd_uker='$kduker' and data_aset.kd_kategori='$kdkat'
											ORDER BY proc ASC");
					while($row1 = $res1->fetch_assoc()){ 
							echo'<tr> <th scope="row">'.$no.'</th> <td><a>'.$row1['no_aset'].'</a></td><td>'.$row1['model'].'</td>';
							if  ($kdkat=="cp")
							{ echo'<td>'.$row1['os'].'</td><td>'.$row1['proc'].'</td><td>'.$row1['ramhd'].'</td>';}
							else if  ($kdkat=="nb")
							{ echo'<td>'.$row1['os'].'</td><td>'.$row1['proc'].'</td><td>'.$row1['ramhd'].'</td>';}
							else { echo'';}
							echo'<td>'.$row1['nik'].'</td>
							<td>'.$row1['nama_karyawan'].'</td>
							<td align="center">';
							if ($row1['sewa']=="1"){echo "YA";}else{echo "TIDAK";}
							
							echo'</td>
							</tr> </tr>';
							$no++;}
					echo'</tbody>
						</table> 
						<br>
					
					</div>'; 
					 
					}else{
						echo'					
						<div class="col-md-12">
						<p class="tebal"> '.$row['nama_kategori'].' : ' .$tot.' Unit</p>';
						if ($kdkat=="nb"){  
						$th = $conn->query("SELECT proc, count(proc) as totproc FROM data_aset 
											where data_aset.kd_uker='$kduker' and data_aset.kd_kategori='$kdkat' GROUP BY proc");  
							while($rowth = $th->fetch_assoc()){echo '<a><i>'.$rowth['proc'].' - '.$rowth['totproc'].' unit, </i></a>';}
						}							
					echo'
						<table  table-layout="auto" width= "100%"  >
							<thead bgcolor="silver">
								<tr height="20px"  width="100%"> 
									<th rowspan="2">No</th><th rowspan="2">No Asset</th><th rowspan="2">Model</th>';
									if  ($kdkat=="cp"){ echo'<th colspan="3">Spesifikasi</th>';}
									else if ($kdkat=="nb"){ echo'<th colspan="3">Spesifikasi</th>';}else{ echo'';}
									echo'<th colspan="2">PIC</th>
								</tr>
								<tr>';
									if  ($kdkat=="cp")
									{ echo'<td align="center">OS</td><td align="center">Processor</td><td align="center">Ram/Hdd</td> ';}
									else if  ($kdkat=="nb")
									{ echo'<td align="center">OS</td><td align="center">Processor</td><td align="center">Ram/Hdd</td> ';}
									else { echo'';}
									echo'<td align="center">NIK</td><td align="center">Nama</td> 
								</tr>
							</thead>
							<tbody>';
							$no = 1;
					$res1 = $conn->query("SELECT *, data_uker.*, data_karyawan.*  FROM data_aset 
											LEFT JOIN data_uker ON data_aset.kd_uker=data_uker.kd_uker 
											LEFT JOIN data_karyawan ON data_aset.nik=data_karyawan.nik 
											where data_aset.kd_uker='$kduker' and data_aset.kd_kategori='$kdkat'
											ORDER BY tahun ASC");
					while($row1 = $res1->fetch_assoc()){ 
							echo'<tr> <th scope="row">'.$no.'</th> <td><a>'.$row1['no_aset'].'</a></td><td>'.$row1['model'].'</td>';
							if  ($kdkat=="cp")
							{ echo'<td>'.$row1['os'].'</td><td>'.$row1['proc'].'</td><td>'.$row1['ramhd'].'</td>';}
							else if  ($kdkat=="nb")
							{ echo'<td>'.$row1['os'].'</td><td>'.$row1['proc'].'</td><td>'.$row1['ramhd'].'</td>';}
							else { echo'';}
							echo'<td>'.$row1['nik'].'</td>
							<td>'.$row1['nama_karyawan'].'</td> </tr> </tr>';
							$no++;}
					echo'</tbody>
						</table> 
						<br>
					
					</div>';
					
					}
				}	
				$no1++;
	}
echo'</div>';

$showbag = $conn->query("SELECT * FROM  data_uker_bagian where kd_uker='$kduker'");
while($rowbag = $showbag->fetch_assoc()){
 $kdbag=$rowbag['kd_bag'];
  $totalaset = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM data_aset 
											where kd_uker='$kdbag'"));
 
	echo '
<div class="table-responsive bs-example widget-shadow">
<h4 id="'.$rowbag['kd_bag'].'">'.$rowbag['nama_bag'].' Total Aset = '.$totalaset.'</h4>
';
$no1 = 1;
$res = $conn->query("SELECT *  FROM data_kategori ORDER BY id ASC");
while($row = $res->fetch_assoc())
{ 
						 $kdkat=$row['kd_kategori'];
						$tot = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM data_aset  
											where data_aset.kd_uker='$kdbag' and data_aset.kd_kategori='$kdkat'"));
						$no2 = 1;					
				if ($tot>0){ 
					if ($kdkat=='cp'){
					echo'					
						<div class="col-md-12">
						<p class="tebal"> '.$row['nama_kategori'].' : ' .$tot.' Unit</p>
						';
						$th = $conn->query("SELECT proc, count(proc) as totproc FROM data_aset 
											where data_aset.kd_uker='$kdbag' and data_aset.kd_kategori='$kdkat' GROUP BY proc");  
							while($rowth = $th->fetch_assoc()){echo '<a><i>'.$rowth['proc'].' - '.$rowth['totproc'].' unit, </i></a>';} 
					echo'
						<table  table-layout="auto" width= "100%"  >
							<thead bgcolor="silver">
								<tr height="20px"  width="100%"> 
									<th rowspan="2">No</th><th rowspan="2">No Asset</th><th rowspan="2">Model</th>';
									if  ($kdkat=="cp"){ echo'<th colspan="3">Spesifikasi</th>';}
									else if ($kdkat=="nb"){ echo'<th colspan="3">Spesifikasi</th>';}else{ echo'';}
									echo'<th colspan="2">PIC</th>
									<th rowspan="2">Sewa</th>
								</tr>
								<tr>';
									if  ($kdkat=="cp")
									{ echo'<td align="center">OS</td><td align="center">Processor</td><td align="center">Ram/Hdd</td> ';}
									else if  ($kdkat=="nb")
									{ echo'<td align="center">OS</td><td align="center">Processor</td><td align="center">Ram/Hdd</td> ';}
									else { echo'';}
									echo'<td align="center">NIK</td><td align="center">Nama</td> 
								</tr>
							</thead>
							<tbody>';
							$no = 1;
					$res1 = $conn->query("SELECT *, data_uker.*, data_karyawan.*  FROM data_aset 
											LEFT JOIN data_uker ON data_aset.kd_uker=data_uker.kd_uker 
											LEFT JOIN data_karyawan ON data_aset.nik=data_karyawan.nik 
											where data_aset.kd_uker='$kdbag' and data_aset.kd_kategori='$kdkat' and data_aset.sewa='0'
											ORDER BY tahun ASC");
					while($row1 = $res1->fetch_assoc()){ 
							echo'<tr> <th scope="row">'.$no.'</th> <td><a>'.$row1['no_aset'].'</a></td><td>'.$row1['model'].'</td>';
							if  ($kdkat=="cp")
							{ echo'<td>'.$row1['os'].'</td><td>'.$row1['proc'].'</td><td>'.$row1['ramhd'].'</td>';}
							else if  ($kdkat=="nb")
							{ echo'<td>'.$row1['os'].'</td><td>'.$row1['proc'].'</td><td>'.$row1['ramhd'].'</td>';}
							else { echo'';}
							echo'<td>'.$row1['nik'].'</td>
							<td>'.$row1['nama_karyawan'].'</td>
							<td align="center">';
							if ($row1['sewa']=="1"){echo "YA";}else{echo "TIDAK";}
							
							echo'</td>
							</tr> </tr>';
							$no++;}
					echo'</tbody>
						</table> 
						<br>
					
					</div>';
					}else{
						echo'					
						<div class="col-md-12">
						<p class="tebal"> '.$row['nama_kategori'].' : ' .$tot.' Unit</p>
						';
						if ($kdkat=="nb"){  
						$th = $conn->query("SELECT proc, count(proc) as totproc FROM data_aset 
											where data_aset.kd_uker='$kdbag' and data_aset.kd_kategori='$kdkat' GROUP BY proc");  
							while($rowth = $th->fetch_assoc()){echo '<a><i>'.$rowth['proc'].' - '.$rowth['totproc'].' unit, </i></a>';}
						}							
					echo'
						<table  table-layout="auto" width= "100%"  >
							<thead bgcolor="silver">
								<tr height="20px"  width="100%"> 
									<th rowspan="2">No</th><th rowspan="2">No Asset</th><th rowspan="2">Model</th>';
									if  ($kdkat=="cp"){ echo'<th colspan="3">Spesifikasi</th>';}
									else if ($kdkat=="nb"){ echo'<th colspan="3">Spesifikasi</th>';}else{ echo'';}
									echo'<th colspan="2">PIC</th>
								</tr>
								<tr>';
									if  ($kdkat=="cp")
									{ echo'<td align="center">OS</td><td align="center">Processor</td><td align="center">Ram/Hdd</td> ';}
									else if  ($kdkat=="nb")
									{ echo'<td align="center">OS</td><td align="center">Processor</td><td align="center">Ram/Hdd</td> ';}
									else { echo'';}
									echo'<td align="center">NIK</td><td align="center">Nama</td> 
								</tr>
							</thead>
							<tbody>';
							$no = 1;
					$res1 = $conn->query("SELECT *, data_uker.*, data_karyawan.*  FROM data_aset 
											LEFT JOIN data_uker ON data_aset.kd_uker=data_uker.kd_uker 
											LEFT JOIN data_karyawan ON data_aset.nik=data_karyawan.nik 
											where data_aset.kd_uker='$kdbag' and data_aset.kd_kategori='$kdkat'
											ORDER BY tahun ASC");
					while($row1 = $res1->fetch_assoc()){ 
							echo'<tr> <th scope="row">'.$no.'</th> <td><a>'.$row1['no_aset'].'</a></td><td>'.$row1['model'].'</td>';
							if  ($kdkat=="cp")
							{ echo'<td>'.$row1['os'].'</td><td>'.$row1['proc'].'</td><td>'.$row1['ramhd'].'</td>';}
							else if  ($kdkat=="nb")
							{ echo'<td>'.$row1['os'].'</td><td>'.$row1['proc'].'</td><td>'.$row1['ramhd'].'</td>';}
							else { echo'';}
							echo'<td>'.$row1['nik'].'</td>
							<td>'.$row1['nama_karyawan'].'</td> </tr> </tr>';
							$no++;}
					echo'</tbody>
						</table> 
						<br>
					
					</div>';
					
					}
				}
$no1++;	
}
echo'</div>';
}
 
}
?>
 </div> 
 </div> 