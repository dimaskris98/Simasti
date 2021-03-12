<section class="content">
<!-- Content -->
    <div id="webui">
		<div class="row">
<?php 
 

if (isset($_POST['consumable-hapus']))
{
	$id=$_POST['id'];
	$sql 	= 'delete from consumable where id="'.$id.'"'; 
	$query	= mysqli_query($conn,$sql);
	echo '<script>window.location=" '.$_POST['back-link'].'"</script>'; 
}

if (isset($_POST['consumable-edit']))
{
 	include ("consumable/edit.php");
}

if (isset($_POST['editaset']))
{
 	include ("aset/edit.php");
 
}

if (isset($_POST['auditaset']))
{
 	include ("aset/audit.php");
 
}

if (isset($_POST['saveeditaset'])){ 
	$status=$_POST['status'];
	$showstatus =mysqli_fetch_array(mysqli_query($conn,"SELECT *  FROM status_labels  WHERE id= '$status'"));
		if ($showstatus['deployable']=="1"){
			 $user=$_POST['karyawan'];
			 $uker=$_POST['uker'];	 
		}else{
			 $user="";
			 $uker=""; 
		}
		if ($user==""){
			if ($uker==""){ $lokasi="DI TI"; }else{ $lokasi="DI USER";	 }	  
		}else{
			$lokasi="DI USER";	 
		}
	 
	 
	$idaset=$_POST['idaset'];
	$no_aset=$_POST['no_aset'];
	$model=$_POST['model'];
	$kategori=$_POST['kategori']; 
	$sn=$_POST['sn'];
	$th=$_POST['tahun'];
	$catatan=$_POST['catatan']; 
	if (isset($_POST['sewa'])) { $sewa=$_POST['sewa'];  }  else{ $sewa=0; } 
	 
		if (($showstatus['name']=="scrab")or($showstatus['name']=="SCRAB")){
			$tgl_scrab=$created_at;
			$lokasi="DI TI";
			$toscrab =mysqli_fetch_array(mysqli_query($conn,"SELECT  tahun,ip_address,os,proc,ramhd,vga
					,id_sup,sewa,po,tgl_po,harga from data_aset WHERE no='$idaset'"));
			$tahun=$toscrab['tahun']; $ip=$toscrab['ip_address']; $os=$toscrab['os']; $proc=$toscrab['proc'];
			$ramhd=$toscrab['ramhd']; $vga=$toscrab['vga']; $id_sup=$toscrab['id_sup']; $po=$toscrab['po'];
			$tgl_po=$toscrab['tgl_po']; $harga=$toscrab['harga'];
			$sql = "INSERT INTO data_aset_scrab values('','$no_aset','$tahun','$kategori','$model','$sn','$ip','$os','$proc','$ramhd','$vga',
			'$lokasi','$id_sup','$po','$tgl_po','$harga','$tgl_scrab','$catatan','$id_user','$status')";
			$delete="DELETE FROM data_aset WHERE no='$idaset'";
			$query	= mysqli_query($conn,$sql);	
			$query	= mysqli_query($conn,$delete);
		}else{
		
			if(isset($_POST["id_monitor"]) && strlen($_POST["id_monitor"])>0) 
			{
				$id_monitor=$_POST['id_monitor']; 
				$sql1 = "UPDATE data_aset SET kd_uker='$uker',nik='$user',update_at='$update_at',admin='$id_user' ,status='$status'
						,lokasi='$lokasi'
						WHERE no='$id_monitor'";	
				$query	= mysqli_query($conn,$sql1);	
			
				$sql2 = "UPDATE data_aset SET no_aset='$no_aset', tahun='$th', kd_kategori='$kategori',model='$model',   sn='$sn', 
						 kd_uker='$uker',nik='$user',update_at='$update_at',admin='$id_user',catatan='$catatan',id_monitor='$id_monitor'
						 ,status='$status',lokasi='$lokasi',sewa='$sewa'
						 WHERE no='$idaset'";
						 $query	= mysqli_query($conn,$sql2);
			}else{ 
				$sql = "UPDATE data_aset SET no_aset='$no_aset',  tahun='$th', kd_kategori='$kategori',model='$model',   sn='$sn', 
				 kd_uker='$uker',nik='$user',update_at='$update_at',admin='$id_user',catatan='$catatan',id_monitor=''
				 ,status='$status',lokasi='$lokasi',sewa='$sewa'
				 WHERE no='$idaset'";	
				$query	= mysqli_query($conn,$sql);
			}
		}	
	
	
 
  	 
		//echo $sql;
		
		if (!empty($_POST['karyawan-detail']))
		{
			 
				$_POST['karyawan-detail'];
				include ("karyawan/detail.php"); 
			 
		}
		 else if(!empty($_POST['aset-detail'])) 
		{
		 
				$_POST['aset-detail'];
				include ("aset/detail.php"); 
				 
		}else if($sewa=="1") 
		{
		  echo '<script>window.location="Sewa"</script>'; 
				 
		}else{
				echo '<script>window.location="All"</script>'; 
			}
}

if (isset($_POST['saveauditaset'])){ 
	 
	 $kategori=$_POST['kategori']; 
	 $idaset=$_POST['id']; 
	 $karyawan=$_POST['karyawan'];
	 $uker=$_POST['uker'];
	 $next_audit_date=$_POST['next_audit_date'];
	 $catatan=$_POST['catatan'];
	 
	 $sql 	= "UPDATE data_aset SET nik='$karyawan', kd_uker='$uker'
	 ,audit_at='$audit_at',audit_next='$next_audit_date',audit_by='$id_user',catatan='$catatan'
		 WHERE no='$idaset'";
 
  	
		switch($kategori){	
			case "CP" : $back="Dekstop"; break; 
			case "NB" : $back="Laptop"; break; 
			case "CM" : $back="Monitor"; break; 
			case "PJ" : $back="Proyektor";  break;  
			case "PR" : $back="Printer";  break; 
			case "PS" : $back="PrinterScanner";  break; 
			case "SC" : $back="Scanner";  break; 
			case "cp" : $back="Dekstop"; break; 
			case "nb" : $back="Laptop"; break; 
			case "cm" : $back="Monitor"; break; 
			case "pj" : $back="Proyektor"; break; 
			case "pr" : $back="Printer"; break; 
			case "ps" :	$back="PrinterScanner"; break; 
			case "sc" : $back="Scanner"; break; 
			case "" : $back="All";  break; 
		} 
		 
	 
		$query	= mysqli_query($conn,$sql);
		if (!empty($_POST['karyawan-detail']))
		{
				 $_POST['karyawan-detail'];
				 include ("karyawan/detail.php"); 
			 
		}
		 else if(!empty($_POST['aset-detail'])) 
		{
				  $_POST['aset-detail'];
				 include ("aset/detail.php"); 
				 
		}else{
				echo '<script>window.location=" '.$back.'"</script>'; 
			}
}
 
if (isset($_POST['hapuscp'])){
	$id=$_POST['idd']; 
	 $kdkat = $_POST['kategori'];	
		switch($kdkat){	
			case "CP" : $back="Dekstop"; break; 
			case "NB" : $back="Laptop"; break; 
			case "CM" : $back="Monitor"; break; 
			case "PJ" : $back="Proyektor";  break;  
			case "PR" : $back="Printer";  break; 
			case "PS" : $back="PrinterScanner";  break; 
			case "SC" : $back="Scanner";  break; 
			case "cp" : $back="Dekstop"; break; 
			case "nb" : $back="Laptop"; break; 
			case "cm" : $back="Monitor"; break; 
			case "pj" : $back="Proyektor"; break; 
			case "pr" : $back="Printer"; break; 
			case "ps" :	$back="PrinterScanner"; break; 
			case "sc" : $back="Scanner"; break; 
			case "" : $back="All";  break; 
		} 
		 $sql 	= 'delete from data_aset where no="'.$id.'"'; 
	 
	 $query	= mysqli_query($conn,$sql);
 echo '<script>window.location=" '.$back.'"</script>'; 
}


if (isset($_POST['editkaryawan']))
{
 	include ("karyawan/edit.php");
 
}

if (isset($_POST['saveeditkaryawan'])){ 
	 
	$tipe=$_POST['tipe'];
	 $nik2=$_POST['nik2'];
	 $nik=$_POST['nik'];
	$nama=$_POST['nama'];
	 $email=$_POST['email'];
	 $tlp=$_POST['tlp']; 
	 $departemen=$_POST['departemen'];
	 $bagian=$_POST['bagian'];
		$foto = $_FILES['foto']['name'];
		$data =mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM data_karyawan WHERE nik= '$nik'")); 
	 if (empty($foto)){ 
		if(is_file("images/karyawan/".$data['img'])) // Jika foto ada
					  unlink("images/karyawan/".$data['img']); // Hapus file foto sebelumnya yang ada di folder images
		  $sql 	= "UPDATE data_karyawan SET nik='$nik', nama_karyawan='$nama',email='$email', tlp='$tlp', img='', 
						 kd_uker='$departemen',kd_bag='$bagian' ,organik='$tipe' 
						 WHERE nik='$nik2'";
			 
				 
	 }else{
		 
			 $foto = $_FILES['foto']['name'];
			$tmp = $_FILES['foto']['tmp_name'];
			$type=explode(".",$foto);
			
				   
				if(is_file("images/karyawan/".$data['img'])) // Jika foto ada
					  unlink("images/karyawan/".$data['img']); // Hapus file foto sebelumnya yang ada di folder images

				  
			 
				$fotobaru =$nik.'.'.$type[1];
				 
				$path = "images/karyawan/".$fotobaru;
			 
				if(move_uploaded_file($tmp, $path)){ // Cek apakah gambar berhasil diupload atau tidak
					
			 
				 $sql 	= "UPDATE data_karyawan SET nik='$nik', nama_karyawan='$nama',email='$email', tlp='$tlp', img='$fotobaru', 
						 kd_uker='$departemen',kd_bag='$bagian' 
						 WHERE nik='$nik2'";
		 
				 }else{
				  
				  echo "Maaf, Gambar gagal untuk diupload.";
				  
				}
			 
	 }
	 $query	= mysqli_query($conn,$sql); 

		  if($query){ 
				  echo '<script>window.location="'.$tipe.'?nik='.$nik.'"</script>'; 
		  }else{
			// Jika Gagal, Lakukan :
			echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
			 echo '<script>window.location="'.$tipe.'?nik='.$nik.'"</script>'; 
			
		  }

  
}
if (isset($_POST['hapuskaryawan'])){ 

 $nik= $_POST['nik'];
 $sql 	= 'delete from data_karyawan where nik="'.$nik.'"'; 
	 
	 $query	= mysqli_query($conn,$sql);
	  echo '<script>window.location="organik"</script>';
}	


if (isset($_POST['status-edit']))
{
 	include ("status/edit.php");
 
}
if (isset($_POST['status-hapus'])){ 

 $id= $_POST['id'];
 $sql 	= 'delete from status_labels where id="'.$id.'"'; 
	 
	 $query	= mysqli_query($conn,$sql);
	  echo '<script>window.location="Labelstatus"</script>';
}	

if (isset($_POST['updatestatus']))
{
 	$id =  $_POST["id"] ;
	$status =  $_POST["namastatus"] ;
	$type = $_POST["tipestatus"] ;
	$id_user=$_SESSION['sess_id']; 
	$catatan=$_POST['catatan']; 
	
	 
			$sql = "UPDATE status_labels SET name='$status', user_id='$id_user', deployable='$type', notes='$catatan' WHERE id='$id'";
	  $query	= mysqli_query($conn,$sql); 
		echo '<script>window.location="Labelstatus"</script>'; 
 
}



if (isset($_POST['editasetscrab']))
{
 	include ("aset-scrab/edit.php");
 
}

if (isset($_POST['saveeditasetscrab'])){ 
	 
	 $back=$_POST['link'];
	 $tahun=$_POST['tahun'];
	 $no_aset=$_POST['no_aset'];
	 $model=$_POST['model'];
	 $sn=$_POST['sn'];
	 $kategori=$_POST['kategori']; 
	 $idaset=$_POST['idaset'];  
	 $catatan=$_POST['catatan'];
	 
	 $sql 	= "UPDATE data_aset_scrab SET no_aset='$no_aset', model='$model'
	 ,sn='$sn',kd_kategori='$kategori',catatan='$catatan',tahun='$tahun'
		 WHERE idscrab='$idaset'";
 
   
	 
	 
		  $query	= mysqli_query($conn,$sql);
		 if(!empty($_POST['aset-scrab-detail'])) 
		{
				  $_POST['aset-scrab-detail'];
				 include ("aset-scrab/detail.php"); 
				 
		}else{
				 echo '<script>window.location=" '.$back.'"</script>'; 
			}
}
if (isset($_POST['hapusscrab'])){
	$id=$_POST['idd']; 
	 $back = $_POST['kategori'];	
		 
		 $sql 	= 'delete from data_aset_scrab where idscrab="'.$id.'"'; 
	 
	$query	= mysqli_query($conn,$sql);
  echo '<script>window.location=" '.$back.'"</script>'; 
}





?>






</div>
</div>
</section>