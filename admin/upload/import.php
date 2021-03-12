 
<section class="content-header" style="padding-bottom: 30px;">

    <div class="pull-right"> 
	<div class="box-tools pull-right"></div>
	</div>
</section>
<section class="content">
     <!-- Content -->
<div id="webui">     
    <div class="row">
        <!-- left column -->
        <div class="col-md-3">
            
        </div>
		<div class="col-md-6">
        <div class="box box-default">
		<div class="box-header with-border">
			<h3 class="box-title">Form Import Data Asset</h3>
			<div class="box-tools pull-right">
				<a href="." class="btn btn-danger pull-right"><span class="glyphicon glyphicon-remove"></span> Cancel</a>
			</div>
		</div><!-- /.box-header -->		
		<div class="box-body">
				<form method="post" action="" enctype="multipart/form-data">
					 <div class="form-group ">
					<a href="upload/Format-aset.xlsx" class="btn btn-default">
						<span class="glyphicon glyphicon-download"></span>
						Download Format
					</a><br><br>
					</div>
					<div class="form-group "> 
                            <div class="col-md-10">
                                <input type="file" class="form-control pull-left" placeholder="file" name="file" id="file"> 
                            </div> 
							 <div class="col-md-2">
                                <button type="submit" name="import" class="btn btn-success btn-md">Import</button>
                            </div> 
					</div> 
				</form> 
	 
								
    
		</div>
        </div>
        </div> <!--/.col-md-7-->
    </div>
	<div class="row">
        <!-- left column -->
        <div class="col-md-3">
            
        </div>
		<div class="col-md-6"><?php  if (isset($_SESSION['msg'])){ echo  $_SESSION['msg'];  $_SESSION['msg']="";} ?></div></div>
</div>
</section>
<?php		 
			// Jika user telah mengklik tombol Preview
			if(isset($_POST['import'])){
			 $_SESSION['msg']="";
				
			
				ini_set("memory_limit","200M");
				ini_set('max_execution_time', 6000);
				ini_set('upload_max_filesize', '100M');
			
				$nama_file_baru = 'data.xlsx';
				  
				
				// Cek apakah terdapat file data.xlsx pada folder tmp
				// if(isset($_POST['file'])){echo "<br>ada<br>";}else{echo "<br>Tidak ada<br>";}
				 
				$tipe_file = $_FILES['file']['type']; // Ambil tipe file yang akan diupload
				$tmp_file = $_FILES['file']['tmp_name'];
				 
				 
			 
		if($tipe_file == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"){
					
				?> 	 
							<div class="content">
								 <i>Jangan Ditutup halaman ini sampai proses upload data selesai</i> 
								<div class="progress progress-striped active">
									 <div  id="progress"></div>
								</div>
								<span><div id="info"></div></span>
							</div>
					 	 
<?php	
					move_uploaded_file($tmp_file, 'tmp/'.$nama_file_baru);
					
					// Load librari PHPExcel nya
					require_once 'PHPExcel/PHPExcel.php';
					
					$excelreader = new PHPExcel_Reader_Excel2007();
					$loadexcel = $excelreader->load('tmp/'.$nama_file_baru); // Load file yang tadi diupload ke folder tmp
					$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
					 
					 $totalbaris = 1;
					foreach($sheet as $row){
							if(empty($row['A'])) continue;
							
							$no_aset = $row['A'];
					 $totalbaris++;	
					}
					$numrow = 1;  
					foreach($sheet as $row){ // Lakukan perulangan dari data yang ada di excel
						
						$barisreal = $numrow;
					 
						$percent = intval($barisreal/$totalbaris * 100)."%";
			 
						
						if(empty($row['A'])) continue;
							
							$no_aset = $row['A'];
							$tahun = $row['B'];
							$kd_kategori = $row['C'];
							$model = $row['D'];
							$sn = $row['E'];
							$ip = $row['F'];
							$os = $row['G'];
							$proc = $row['H']; 
							$ramhd = $row['I'];
							$vga = $row['J'];
							$kd_uker = $row['K'];
							$nik = $row['L'];
							if(!empty($row['M']) ){$tgl_keluar = date('Y-m-d', strtotime($row['M'] ));}else{$tgl_keluar ='';}
							if(!empty($row['N']) ){$tgl_po = date('Y-m-d', strtotime($row['N'] ));}else{$tgl_po ='';} 
							$po = $row['O'];
							$harga = $row['P'];
							$id_sup = $row['Q'];
							$sewa = $row['R'];
							$catatan = $row['S']; 
							$status = $row['T']; 
							if(!empty($kd_uker) or !empty($nik)){$lokasi="DI USER";}else{$lokasi="DI TI";}
					 
						if($numrow > 1){
							$query = "INSERT INTO data_aset VALUES ('', '$no_aset', '$tahun', '$kd_kategori', '$model', '$sn', '$ip', '$os', '$proc'
										  , '$ramhd', '$vga', '$kd_uker', '$nik', '$lokasi', '$id_sup', '$sewa', '$po'
										  , '$tgl_po', '$harga', '$tgl_po', '', '', '', '', '', '', '$tgl_keluar', '', '$catatan', '$id_user ', '$status ')";
							//echo $query;
							mysqli_query($conn, $query); 
							flush();
							?>
							 <script language="javascript">
							document.getElementById("progress").innerHTML='<div  class="bar  blue" style="width:<?php echo $percent;?>"><span><?php echo $percent;?></span></div>';
							document.getElementById("info").innerHTML='<?php echo $barisreal; ?> data berhasil diinsert (<?php echo $percent;?> selesai)';
							
							 </script>
							 
							<?php
							$_SESSION['msg']="<div class=\"alert alert-success\"><strong>Success! </strong> $barisreal data berhasil diimport ke database.
											<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\" title=\"close\">×</a></div>";
						}else{
							$_SESSION['msg']="<div class=\"alert alert-danger\"><strong>Danger!</strong>Import data gagal.
											<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\" title=\"close\">×</a></div>";
										 
						}
						
						$numrow++; 
						 
					}
					
					
					
					 
					echo '<script>window.location="import"</script>'; 
					 
				}else{ // Jika file yang diupload bukan File Excel 2007 (.xlsx)
					// Munculkan pesan validasi
					echo "<div class='alert alert-danger'>
					Hanya File Excel 2007 (.xlsx) yang diperbolehkan
					<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\" title=\"close\">×</a></div>";
					
				}
	 
				  
			}
			?>