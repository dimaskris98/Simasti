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
	$totkat = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM data_kategori"));
?>	
	<table>
			<thead bgcolor="silver">
				<tr >  
					<th >KD Unit Kerja/Bagian</th> 
					<th  >Nama Unit Kerja/Bagian</th> 
					<th  >Kebutuhan</th>  
					<th  >Jumlah</th>  
					<th  >Action</th> 
				 <?php
					$res = $conn->query("SELECT * FROM data_uker where kd_uker='$kduker'");
						while($row = $res->fetch_assoc())
						{ ?>
				</tr>  
				<tr>
					<td rowspan="<?php echo $totkat+1;?>"><?php echo $row['kd_uker'];?></td>
					<td rowspan="<?php echo $totkat+1;?>"><?php echo $row['nama_uker'];?></td>
					
					
					
					<?php
						$res1 = $conn->query("SELECT * FROM data_kategori");
						while($row1 = $res1->fetch_assoc())
						{ 
					 
							echo'<tr>
									<th>'.$row1['nama_kategori'].'</th>'; 
							
							$kdkat=$row1['kd_kategori'];
							$showkebutuhan =mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM  kebutuhan where id_uker='$kduker' AND id_kategori='$kdkat'"));
							 //kolom kebutuhan bagian
							?> 
							<td>
							<span id="editqty<?php echo  $showkebutuhan['id']; ?>" class="textnya"><?php echo  $showkebutuhan['qty']; ?></span>
                <input type="text" name="qty" value="<?php echo $showkebutuhan['qty'];  ?>" class="form-control formnya" id="boxqty<?php echo $showkebutuhan['id'];  ?>" style="display:none;" />
				<input type="text" name="kduker" value="<?php echo $kduker;  ?>" class="form-control" id="boxuker<?php echo $kduker;  ?>" style="display:none;" />
				<input type="text" name="kdkategori" value="<?php echo $kdkat;  ?>" class="form-control" id="boxkategori<?php echo $kdkat;  ?>"style="display:none;"  />
				
						</td>
						
						
						<td>
				
							<a id="<?php echo $showkebutuhan['id']; ?>" class="btn btn-success editrow erow<?php echo $showkebutuhan['id']; ?>">Edit</a>
							<a id="<?php echo $showkebutuhan['id']; ?>" class="btn btn-success updaterow urow<?php echo $showkebutuhan['id']; ?>" style="display:none;">Update</a>
						
						</td>
								 
						<?php
							  echo'</tr>'; 
						}
					?>
				</tr> 
				 
					<?php 
					}
						
					?>	
				
			</thead>
			<tbody>
			</tbody>
	
		 
<?php
			}
?>