<?php
if (isset($_POST['save'])){
	$nik=$_POST['nik'];
	$nama=$_POST['nama'];
	$username=$_POST['username'];
	$sewa=$_POST['sewa'];
	if(mysqli_num_rows(mysqli_query($conn,"SELECT * from users WHERE username='$username'"))>0) 
	{
		echo '<p>'.$username.' sudah terdaftar</p>';
		echo '<p>Silahkan klik <a href="user">disini</a> untuk kembali</p>';
	}
	else
	{
		$email="";
		$password=md5($_POST['pass']); 
		$level="teknisi";
		 
		$sql = "INSERT INTO users VALUES('','$nik','$nama','$email','$username','$password','$level')";
		$query	= mysqli_query($conn,$sql);  
		
		$showuser =mysqli_fetch_array(mysqli_query($conn,"SELECT id_user FROM users WHERE username= '$username'"));
		$iduser=$showuser['id_user'];
		$sql_teknisi = "INSERT INTO tb_teknisi VALUES('','$iduser','$sewa')";
		$query	= mysqli_query($conn,$sql_teknisi); 
		echo '<script>window.location="teknisi-komputer"</script>';
	}
	 
	
	 
}else if (isset($_POST['save-edit'])){
	$id=$_POST['id'];
	$username=$_POST['nama'];
	$email=$_POST['email'];
	$level=$_POST['level'];
	$password=md5($_POST['pass']); 
	$showimg =mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM data_karyawan WHERE nik= '$username'"));
	$nama=$showimg['nama_karyawan'];
	if ($showimg['img']==""){$img="";}else{$img=$showimg['img'];}
	
	
	if ($_POST['passwordconfirm']==""){
		$sql = "UPDATE users SET nikuser='$username',nama='$nama', email='$email', 
				username='$username', level_user='$level' where id_user='$id'";
		 $query	= mysqli_query($conn,$sql);  
	
	}else{
		$sql = "UPDATE users SET nikuser='$username',nama='$nama', email='$email', username='$username',
				password='$password', level_user='$level' where id_user='$id'";
		 $query	= mysqli_query($conn,$sql);  
	}	 
	 echo '<script>window.location="teknisi-komputer"</script>';
	  
} else if (isset($_POST['adduser'])){
?>
 <form action="" method="POST">
			<div class="main-page signup-page">
				<div class="sign-up-row widget-shadow">
					<h5>Personal Information :</h5>
 
					<div class="sign-u">
						<div class="sign-up1">
							<h4>NIK* :</h4>
						</div>
						<div class="sign-up2">
							<input  type="text" name="nik" id="nik" value="" required />
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="sign-u">
						<div class="sign-up1">
							<h4>Nama Lengkap* :</h4>
						</div>
						<div class="sign-up2">
							<input  type="text" name="nama" id="nama" value="" required />
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="sign-u">
						<div class="sign-up1">
							<h4>Teknisi* :</h4>
						</div>
						<div class="sign-up2">
							<select class="form-control "    title="Pilih Level" name="sewa" id="sewa">  
								<option value="0">Komputer Petro</option> 
								<option value="1">Komputer Sewa</option> 
							</select>
						</div>
						<div class="clearfix"> </div>
					</div> 
					<div class="sign-u">
						<div class="sign-up1"><h4>Username* :</h4></div>
						<div class="sign-up2">
							<input  type="text" name="username" id="username" value="" required /> </div>
						<div class="clearfix"> </div>
					</div> 
					<div class="sign-u">
						<div class="sign-up1">
							<h4>Password* :</h4>
						</div>
						<div class="sign-up2">
							 
								<input type="password" name="pass" onkeyup="validasi(event,1)"  id="pass" required>
							 <div id='hasil'></div>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="sign-u">
						<div class="sign-up1">
							<h4>Confirm Password* :</h4>
						</div>
						<div class="sign-up2">
								<input type="password" name="passwordconfirm"  onkeyup="validasi(event,2)"  required>
							<div id='cocok'></div>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="sub_home">
						
							<a href="teknisi-komputer" class="btn btn-primary btn-md">Batal</a>
							<button type="submit" name="save" id="save" class="btn btn-primary btn-md">Simpan</button>
						
						<div class="clearfix"> </div>
					</div>
				</div>
			</div>
</form>

</head>
<body> 
 <?php
} else if (isset($_GET['edit'])){
	$id_user = $_GET['edit'] ;
	$res = $conn->query("SELECT  * FROM users WHERE id_user='$id_user'");
	$data = $res->fetch_array();
?>
 <form action="" method="POST">
 <input type="hidden" name="id"   value="<?=$data['id_user']?>" />
			<div class="main-page signup-page">
				<div class="sign-up-row widget-shadow">
					<h5>Personal Information :</h5>
 
					<div class="sign-u">
						<div class="sign-up1">
							<h4>Nama Karyawan* :</h4>
						</div>
						<div class="sign-up2">
							<select class="form-control select2" data-live-search="true"  title="Pilih Karyawan" name="nama" id="nama"> 
							<option value="<?=$data['nikuser']?>"><?=$data['nikuser'].' - '.$data['nama']?></option> 
										<?php 
											$res = $conn->query("SELECT * FROM data_karyawan");
											while($row = $res->fetch_assoc()){
												echo '
													<option value="'.$row['nik'].'"> '.$row['nik'].' - '.$row['nama_karyawan']. ' </option>
													';
											}
											?>	
							</select>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="sign-u">
						<div class="sign-up1">
							<h4>Email Address* :</h4>
						</div>
						<div class="sign-up2">
							 
								<input class="form-control" type="email" name="email" id="email" value="<?=$data['email']?>" />
						 
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="sign-u">
						<div class="sign-up1">
							<h4>Level User* :</h4>
						</div>
						<div class="sign-up2">
							 
								<select class="form-control "    title="Pilih Level" name="level" id="level"> 
									<option value="<?=$data['level_user']?>"><?=$data['level_user']?></option> 
									<option value="admin">admin</option> 
									<option value="teknisi">teknisi</option> 
								</select>
							 
						</div>
						<div class="clearfix"> </div>
					</div> 
					<h6>Login Information :</h6>
					<div class="sign-u">
						<div class="sign-up1">
							<h4>Password* :</h4>
						</div>
						<div class="sign-up2">
							 
								<input type="password" name="pass" onkeyup="validasi(event,1)"  id="pass" value="<?=$data['password']?>" required>
							 <div id='hasil'></div>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="sign-u">
						<div class="sign-up1">
							<h4>Confirm Password* :</h4>
						</div>
						<div class="sign-up2">
								<input type="password" name="passwordconfirm"  onkeyup="validasi(event,2)"  >
							<div id='cocok'></div>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="sub_home">
						
							<a href="teknisi-komputer" class="btn btn-primary btn-md">Batal</a>
							<button type="submit" name="save-edit" class="btn btn-primary btn-md">Simpan</button>
						
						<div class="clearfix"> </div>
					</div>
				</div>
			</div>
</form>

</head>
<body> 
 <?php
} else if (isset($_GET['delete'])){
	 $id= $_GET['delete'] ;  
	 $query	= mysqli_query($conn,'delete from users where id_user="'.$id.'"');
	echo '<script>window.location="user"</script>';
 
} else {
?>
	
<div class="panel-info widget-shadow">		 
	<div class="col-md-11 panel-grids">
	<h4>Users</h4>
</div>
<div class="col-md-1 panel-grids">
	<form role="form" action="" method="POST" enctype="multipart/form-data">
		<button type="submit" name="adduser" class="btn btn-primary btn-md">new</button>
	</form>
</div>
	 
		<div class="box-body table-responsive" >
			<table id="" class="display table table-bordered table-striped">
				<thead>
					<tr><th>Nama</th><th>Username</th><th>Password</th><th>Level</th> <th>Aksi</th></tr>
				</thead>
				<tbody>
		<?php
				$res = $conn->query("SELECT  * FROM users where level_user='teknisi'");
				while($row = $res->fetch_assoc()){ 
				echo '
					<tr>
						<td>
							<form action="detail" method="post">
								<a name="tes" href="javascript:" onclick="parentNode.submit();"> '.$row['nama'].'</a>
								<input type="hidden" name="karyawan-detail" value="'.$row['nikuser'].'"/>
								<input type="hidden" name="back-link" value="'.$mod.'" >
							</form>
						</td>
						<td>'.$row['username'].'</td>
						<td>'.$row['password'].'</td>
						<td>'.$row['level_user'].'</td> 
						<td>
							<a href="?edit='.$row['id_user'].'" title="edit user"><span class="fa fa-pencil" aria-hidden="true"></span></a>
							<a href="?delete='.$row['id_user'].'" title="Delete" onclick="return confirm(\'Anda yakin akan menghapus data ?\')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
						</td>							
					</tr>';
				}
		?>
				</tbody>
			</table>

		</div>
	 
</div>	
<?php 
$tgl=date('Y-m-d');

$res = $conn->query("SELECT * FROM data_aset Left join data_kategori ON data_aset.kd_kategori=data_kategori.kd_kategori where status='5'");
				while($row = $res->fetch_assoc()){ 
				 
				 echo "INSERT INTO  data_aset_scrab  VALUES ('','$row[no_aset]','$row[tahun]','$row[nama_kategori]','$row[model]','$row[sn]',
			'$row[proc]','$row[ramhd]','$row[vga]',
			'DI TI','$tgl','$row[admin]','$row[status]');<br>";
			
				 echo "DELETE FROM data_aset where no='$row[no]';<br>";
				}
}



 ?>
