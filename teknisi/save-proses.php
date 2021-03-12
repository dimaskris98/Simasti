<?php
include ("../konekdb.php");
		
if(isset($_POST["nik"]) && strlen($_POST["nik"])>0) 
	{ 
		$nik = filter_var($_POST["nik"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
		$nama = filter_var($_POST["nama"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
		$nama = filter_var($_POST["nama"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
		$uker = filter_var($_POST["uker"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
		$bagian = filter_var($_POST["bagian"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH); 
		$tipe = filter_var($_POST["tipe"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH); 
		 
		 
		$sql = "INSERT INTO data_karyawan  VALUES ('$nik', '$nama', '$uker', '$bagian','','','','$tipe')"; 
		 
		 if(mysqli_query($conn,$sql))
		 {
			//$my_id = mysqli_insert_id($conn);
			echo'<option value="'.$nik.'" selected="selected">'.$nik.' - '.$nama. ' </option>';  
		 }
	} 	 
	if(isset($_POST["isi_status"]) && strlen($_POST["isi_status"])>0) 
	{ 
		$contentToSave = filter_var($_POST["isi_status"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
		$type =filter_var($_POST["isi_type"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
		$id_user=$_SESSION['sess_id']; 
	
	 
			$sql = "INSERT INTO status_labels  VALUES ('', '$contentToSave','$id_user', '$type','')";
	 
		
		
		if(mysqli_query($conn,$sql))
		{
			
			$jsArray = "var dtstatus = new Array();\n";        
							  
									  
										   
		$my_id = mysqli_insert_id($conn);
		echo'<option value="'.$my_id.'" selected="selected">'.$contentToSave.' </option>
		';	
		$jsArray .= "dtstatus['" .$my_id. "'] = {deployable:'".addslashes($contentToSave)."'};\n"; 
	}
	}	 
	
if(isset($_POST["konten_model"]) && strlen($_POST["konten_model"])>0) 
	{ 
		$contentToSave = filter_var($_POST["konten_model"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
	  
		echo'<option value="'.$contentToSave.'" selected="selected">'.$contentToSave. ' </option>';  
		 
	}
	
if(isset($_POST["konten_aset"]) && strlen($_POST["konten_aset"])>0) 
	{ 
		$aset = filter_var($_POST["konten_aset"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
		$model = filter_var($_POST["konten_model"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
		$sn = filter_var($_POST["konten_sn"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
		$sewa = filter_var($_POST["konten_sewa"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
		$tahun = filter_var($_POST["konten_tahun"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
		if (isset($sewa)) { $ya=$sewa;  }  else{ $ya=0; } 
	 $sql = "INSERT INTO data_aset VALUES ('','$aset','$tahun','cm',
		 		'$model','$sn','','','','','','','','','',
		 		'$ya','','','','$created_at','','','','','','',
		 		'','','','$id_user','')"; 
	 
		 if(mysqli_query($conn,$sql))
		 {
		 $my_id = mysqli_insert_id($conn);
		echo'<option value="'.$my_id.'" selected="selected">'.$aset. ' - '.$model. ' </option>';  
		 }
	}
	
if(isset($_POST["content_sup"]) && strlen($_POST["content_sup"])>0) 
	{ 
		$contentToSave = filter_var($_POST["content_sup"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
		$sql = "INSERT INTO data_pemasok  VALUES ('', '$contentToSave', ' ', ' ')"; 
	 
		if(mysqli_query($conn,$sql))
		{
		$my_id = mysqli_insert_id($conn);
		echo'<option value="'.$my_id.'" selected="selected">'.$contentToSave. ' </option>';  
		}
	}

if(isset($_POST["content_kat"]) && strlen($_POST["content_kat"])>0) 
	{ 
		

		$contentToSave = filter_var($_POST["content_kat"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
		$sql = "INSERT INTO kategori  VALUES ('', '$contentToSave', 'aset')";
	 
		if(mysqli_query($conn,$sql))
		{
		$my_id = mysqli_insert_id($conn);
		echo'<option value="'.$my_id.'" selected="selected">'.$contentToSave.' </option>';  
	}
	}

if(isset($_POST["kat_consum"]) && strlen($_POST["kat_consum"])>0) 
	{ 
		

		$contentToSave = filter_var($_POST["kat_consum"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
		$sql = "INSERT INTO kategori  VALUES ('', '$contentToSave', 'consumable')";
	 
		if(mysqli_query($conn,$sql))
		{
		$my_id = mysqli_insert_id($conn);
		echo'<option value="'.$my_id.'" selected="selected">'.$contentToSave.' </option>';  
	}
	}
	 
	
if(isset($_POST["content_status"]) && strlen($_POST["content_status"])>0) 
	{ 
		$contentToSave = filter_var($_POST["content_status"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
		$type =filter_var($_POST["content_type"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
		$created_at=date("Y-m-d h:i:sa");
		$id_user=$_SESSION['sess_id']; 
	
		if ($_POST["content_type"]=="deployable") 
		{
			$sql = "INSERT INTO status_labels  VALUES ('', '$contentToSave','$id_user','created_at','1','','','')";
		}else if($_POST["content_type"]=="pending") 
		{
			$sql = "INSERT INTO status_labels  VALUES ('', '$contentToSave','$id_user','created_at','','1','','')";
		}else
		{
			$sql = "INSERT INTO status_labels  VALUES ('', '$contentToSave','$id_user','created_at','','','1','')";
		}
		
		
		
		if(mysqli_query($conn,$sql))
		{
		$my_id = mysqli_insert_id($conn);
		echo'<option value="'.$my_id.'" selected="selected">'.$contentToSave.' </option>';  
	}
	}	 
	
if (isset($_GET['q'])){
$q = intval($_GET['q']);
$shownote =mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM status_labels WHERE id = '$q'")); 
 
		echo $shownote['notes'];
	 
	 
} 
if (isset($_POST['column'])){

	$result = mysqli_query($conn,"UPDATE kebutuhan set " . $_POST["column"] . " = '".$_POST["editval"]."' WHERE  id=".$_POST["id"]);
	
}

if (isset($_POST['action'])){
	 
	$action = $_POST['action'];
	$data =mysqli_fetch_array(mysqli_query($conn,"SELECT *, data_aset.kd_uker as id_uker, data_aset.created_at as tglreg FROM data_aset
										LEFT JOIN data_kategori ON data_aset.kd_kategori=data_kategori.kd_kategori
										LEFT JOIN data_pemasok ON data_aset.id_sup=data_pemasok.id_sup
										LEFT JOIN data_karyawan ON data_aset.nik=data_karyawan.nik  
										LEFT JOIN data_uker ON data_aset.kd_uker=data_uker.kd_uker  
										LEFT JOIN data_uker_bagian ON data_aset.kd_uker=data_uker_bagian.kd_bag 
										LEFT JOIN users ON data_aset.audit_by=users.id_user
										LEFT JOIN status_labels ON data_aset.status=status_labels.id
										WHERE no='$action'"));
	 if($data['no_aset']){
		 ?>
				<div class="box box-default">
					<div class="box-header with-border">
						<h2 class="box-title"><b>Detail Aset <?=$data['no_aset']?></b></h2> 
					</div><!-- /.box-header -->
					<div class="box-body">
					
 <table class="table">
                  <tbody>
				  		<tr>
							<td>Status</td>
							<td> <table>
									<tr>
									<td><?php echo $data['name']; ?></td>
									<td>
										<label class="label label-default">
										<?php if (($data['nama_karyawan']!="")or($data['id_uker']!="")){?>
										Deployed
										<?php } else { 
											if ($data['deployable']=="1"){echo "Deployable";}else{echo "Undeployable";}
										 }?>
										</label>									
									<i class="fa fa-long-arrow-right" aria-hidden="true"></i><i class="fa fa-user"></i></td>
									<td> 	 
										<form action="detail" method="post">
											<a name="tes" href="javascript:" onclick="parentNode.submit();"> <?php echo $data['nama_karyawan'];?> </a>
											<input type="hidden" name="karyawan-detail" value="<?php echo $data['nik'];?>"/>								
										</form> 
									</td>
									</tr>
								 </table>
								
								
							
							</td>
						</tr>
						<tr>
							<td>S/N</td>
							<td><?php echo $data['sn']; ?></td>
						</tr>
						<tr>
							<td>Kategori</td>
							<td><a href="<?php echo $data['nama_kategori']; ?>"><?php echo $data['nama_kategori']; ?></a>
                             </td>
						</tr>
						<tr>
							<td>Model</td> 
							<td><?php echo $data['model']; ?></td>
						</tr>
						<tr>
							<td>Supplier</td>
							<td><a href=""><?php echo $data['nama_sup']; ?></a></td>
						</tr> 
						<tr>
							<td>Lokasi</td>
							<td><?php echo $data['lokasi']; ?></td>
						</tr>
						<?php
							$ukerid=$data['id_uker'];
							$datauker =mysqli_fetch_array(mysqli_query($conn,"SELECT data_uker.kd_uker,data_uker.nama_uker, data_uker_bagian.kd_bag, data_uker_bagian.nama_bag
																				FROM data_uker	
																				LEFT JOIN data_uker_bagian ON data_uker.kd_uker=data_uker_bagian.kd_uker
																				 WHERE data_uker.kd_uker='$ukerid' or kd_bag='$ukerid'"));
										 
						?>
						<tr>
							<td>Departemen</td>
							<td><a href="lokasi?aset=<?php echo $datauker['kd_uker'] ; ?>"><?php echo $datauker['nama_uker'] ; ?></a></td>
						</tr>
						<tr>
							<td>Bagian</td>
							<td><a href="lokasi?aset=<?php echo $datauker['kd_bag']; ?>"><?php echo  $datauker['nama_bag']; ?></a></td>
						</tr>
                    </tbody>
                </table>
					</div>
				</div>
				

<?php	
	 }else{
	 }
 

} 

?>