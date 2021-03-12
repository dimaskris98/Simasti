
<?php
if  (isset($_GET['delete'])) {
	$no=$_GET['delete'];
	$sql 	= "delete from data_aset WHERE no=$no"; 
	$query	= mysqli_query($conn,$sql);
	echo '<script>window.location="All"</script>'; 
}else
{
	$no=$_GET['no']; 
	$query=mysqli_query($conn,"SELECT *, data_aset.kd_uker as id_uker, data_aset.created_at as tglreg FROM data_aset
										LEFT JOIN data_kategori ON data_aset.kd_kategori=data_kategori.kd_kategori
										LEFT JOIN data_pemasok ON data_aset.id_sup=data_pemasok.id_sup
										LEFT JOIN data_karyawan ON data_aset.nik=data_karyawan.nik  
										LEFT JOIN data_uker ON data_aset.kd_uker=data_uker.kd_uker  
										LEFT JOIN data_uker_bagian ON data_aset.kd_uker=data_uker_bagian.kd_bag 
										LEFT JOIN users ON data_aset.audit_by=users.id_user
										LEFT JOIN status_labels ON data_aset.status=status_labels.id
										WHERE no='$no'");
	$data =mysqli_fetch_array($query);
	 if(mysqli_num_rows($query)==0)
  { 
    echo '<section class="content"><div id="webui"><div class="row"><div class="col-md-4"></div>
					<div class="col-md-4 " align="center">
					<p>" No Aset tidak ditemukan "</p>';
?>
		Klik <a href="javascript:history.back()" >disini</a> untuk kembali
<?php
		echo'</div><div class="col-md-4"></div></div>
		</div>
	</section>';
  }
  else
  {
     
  
	
$no_aset=$data['no_aset']; 
if(isset($_POST['karyawan-detail']))
			 {
				 $link=$_POST['karyawan-detail'];
				$back=' <form action="detail" method="post">
								<a name="tes" href="javascript:" onclick="parentNode.submit();"> '.$link.' </a>
								<input type="hidden" name="karyawan-detail" value="'.$link.'"/>
							
						</form>';
			 
			}else
			{
				$back=' <a href="javascript:history.back()" class="btn btn-default">Back</a>'; 
			}
 
			  ?>
<section class="content-header" style="padding-bottom: 30px;">
          <h1 class="pull-left">
            View Asset <?php echo $data['no_aset']; ?>
      


          </h1>
          <div class="pull-right">
           <?php $back;
			  ?>
				<div class="dropdown pull-right">
				<a href="<?php if(isset($_SERVER['HTTP_REFERER'])){ echo $_SERVER['HTTP_REFERER']; } ?>" class="btn btn-primary">Kembali</a>
				<a href="edit?id=<?=$data['no']?>" title="edit "  class="btn btn-primary"> Edit </a>
				<a class="btn btn-danger" href="?delete=<?=$data['no']?>" title="Delete" onclick="return confirm('Anda yakin akan menghapus <?=$data['no_aset']?> ?')">
					<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
				</a>
			
				</div>
          </div>



        </section>
 <section class="content">
          <!-- Notifications -->
          <div class="row">
<div class="col-md-12">
    <!-- Custom Tabs -->
    <div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
        <li class="active">
          <a href="#details" data-toggle="tab"><span class="hidden-lg hidden-md"><i class="fa fa-info-circle"></i></span> <span class="hidden-xs hidden-sm">Details</span></a>
        </li>
        <li>
          <a href="#software" data-toggle="tab"><span class="hidden-lg hidden-md"><i class="fa fa-floppy-o"></i></span> <span class="hidden-xs hidden-sm">Licensi</span></a>
        </li>
        <li>
          <a href="#components" data-toggle="tab"><span class="hidden-lg hidden-md"><i class="fa fa-hdd-o"></i></span> <span class="hidden-xs hidden-sm">Komponen</span></a>
        </li>
        <li>
          <a href="#maintenances" data-toggle="tab"><span class="hidden-lg hidden-md"><i class="fa fa-wrench"></i></span> <span class="hidden-xs hidden-sm">Perbaikan</span></a>
        </li>
        <li>
          <a href="#history" data-toggle="tab"><span class="hidden-lg hidden-md"><i class="fa fa-wrench"></i></span> <span class="hidden-xs hidden-sm">Log</span></a>
        </li>
		</ul>
      <div class="tab-content">
        <div class="tab-pane fade in active" id="details">
          <div class="row">
            <div class="col-md-8">
              <div class="table-responsive" style="margin-top: 10px;">
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
										<a href="<?=$data['organik']?>?nik=<?=$data['nik']?>" title="Detail Aset"><?=$data['nama_karyawan']?></a>
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
							<td>No. PO</td>
							<td><?php echo $data['po']; ?> </td>
						</tr> 
						<tr>
							<td>Tanggal PO</td>
							<td> <?php if ($data['tgl_po']!="0000-00-00"){ echo  tanggal_indo($data['tgl_po']);} ?> </td>
						</tr> 
						<tr>
							<td>Harga</td>
							<td><?php echo rupiah($data['harga']); ?></td>
						</tr> 
						<tr>
							<td>Supplier</td>
							<td><a href=""><?php echo $data['nama_sup']; ?></a></td>
						</tr> 
						<tr>
							<td>Sewa</td>
							<td><?php 
								if ($data['sewa']=="1"){ echo "Sewa";}else{echo"Tidak";} 
								$alihsewa =mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM aset_alih_sewa WHERE no_aset_pg='$no_aset'"));
								if(isset($alihsewa['no_aset_sewa'])){
								echo ' - Ex. Sewa denga No Aset : <a href="#">'.$alihsewa['no_aset_sewa'].'</a>';
								}
								?>
								
							</td>
						</tr> 
						<tr>
							<td>Catatan</td>
							<td><?php echo $data['catatan']; ?></td>
						</tr>
						<tr>
							<td>Lokasi</td>
							<td><?php echo $data['lokasi'].' - '.$data['nama_bag'].$data['nama_uker']; ?></td>
						</tr>
						<?php
							$ukerid=$data['id_uker'];
							$datauker =mysqli_fetch_array(mysqli_query($conn,"SELECT data_uker.kd_uker,data_uker.nama_uker, 
																				data_uker_bagian.kd_bag, data_uker_bagian.nama_bag
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
						<tr>
							<td width="150">Tanggal registrasi</td>
							<td><?php if ($data['tglreg']!="0000-00-00"){ echo tanggal_indo($data['tglreg']);} ?></td>
						</tr>
						<tr>
							<td width="150">Tanggal Keluar</td>
							<td><?php if ($data['checkout_date']!="0000-00-00"){ echo tanggal_indo($data['checkout_date']);}   ?></td>
						</tr>
						<tr>
							<td>Tanggal update</td>
								<td><?php if ($data['update_at']!="0000-00-00"){ echo tanggal_indo($data['update_at']);}   ?></td>
						</tr>
						<tr>
							<td>Tanggal Audit</td>
								<td><?php if ($data['audit_at']!="0000-00-00"){ echo tanggal_indo($data['audit_at']). " (by ".$data['nama']." )";}  ?></td>
						</tr>
						<tr>
							<td>Audit Selanjutnya</td>
								<td><?php if ($data['audit_next']!="0000-00-00"){ echo tanggal_indo($data['audit_next']);}   ?></td>
						</tr> 
                    </tbody>
                </table>
				<?php
					if(isset($data['id_monitor'] ) && strlen($data['id_monitor'])>0) 
						{
							$id_monitor=$data['id_monitor']; 
							$asetmonitor =mysqli_fetch_array(mysqli_query($conn,"SELECT no,no_aset,model FROM data_aset  WHERE no= '$id_monitor'")); 
						 
				?>
					<table class="table">
					  <tbody>
							
							<tr>
								<td colspan="2"><h4>Monitor</h4></td> 
							</tr>
							<tr>
								<td width="150">No Aset</td>
								<td><a href="aset-detail?no=<?=$asetmonitor['no']?>" title="Detail Aset"><?=$asetmonitor['no_aset']?></a> </td>
							</tr>
							<tr>
								<td width="150">Model</td>
								<td><?php echo $asetmonitor['model']; ?></td>
							</tr> 
						</tbody>
					</table>
				<?php 		}
				?>
				<table class="table">
                  <tbody>
				  		
						<tr>
							<td colspan="2"><h4>Spesifikasi</h4></td> 
						</tr>
						<tr>
							<td width="150">System Operasi</td>
							<td><?php echo $data['os']; ?></td>
						</tr>
						<tr>
							<td width="150">Processor</td>
							<td><?php echo $data['proc']; ?></td>
						</tr>
						<tr>
							<td width="150">Ram n Hdd</td>
							<td><?php echo $data['ramhd']; ?></td>
						</tr>
						<tr>
							<td width="150">Vga External</td>
							<td><?php echo $data['vga']; ?></td>
						</tr>
						<tr>
							<td width="150">Ip Address</td>
							<td><?php echo $data['ip_address']; ?></td>
						</tr>
                    </tbody>
                </table>
              </div> <!-- /table-responsive -->
            </div><!-- /col-md-8 -->
				<?php 
					if (!empty($data['nik'])){
						$nik=$data['nik'];
						 $karyawan =mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM data_karyawan  
										LEFT JOIN data_uker ON data_karyawan.kd_uker=data_uker.kd_uker  
										LEFT JOIN data_uker_bagian ON data_karyawan.kd_uker=data_uker_bagian.kd_bag
										WHERE nik='$nik'"));
										 
				?>	
			<div class="col-md-4"> 
                <h4>Checked Out To</h4>
                <p>
					<table><tr><td>
					<i class="fa fa-user"></i>
					</td><td><a href="<?=$data['organik']?>?nik=<?=$data['nik']?>" title="Detail Aset"><?=$data['nama_karyawan']?></a></a></td></tr></table>
                </p>
                <ul class="list-unstyled" style="line-height: 25px;">
                                      <li><i class="fa fa-envelope-o"></i> <a href=""><?php echo $karyawan['email']; ?></a></li>
                  
                                      <li>
                      <i class="fa fa-phone"></i>
                      <a href=""><?php echo $karyawan['tlp']; ?></a>
                    </li>
					<li><?php echo $karyawan['nama_uker']. $karyawan['nama_bag']; ?></li>
                    
                </ul>

	        </div> <!-- div.col-md-4 -->
				<?php } ?>
           
          </div><!-- /row -->
        </div><!-- /.tab-pane asset details -->

        <div class="tab-pane fade" id="software">
          <div class="row">
            <div class="col-md-12">
              <!-- Licenses assets table -->
              
                <div class="col-md-12">
                  <div class="alert alert-info alert-block">
                    <i class="fa fa-info-circle"></i>
                    No Results.
                  </div>
                </div>
                          </div><!-- /col -->
          </div> <!-- row -->
        </div> <!-- /.tab-pane software -->

        <div class="tab-pane fade" id="components">
		
          <!-- checked out assets table -->
			<div class="row">
				<div class="col-md-12">
				<?php
			$res = $conn->query("SELECT  *, data_aset.*, users.* FROM komponen_aset
			LEFT JOIN data_aset ON komponen_aset.id_aset=data_aset.no
			LEFT JOIN users ON komponen_aset.id_user=users.id_user WHERE id_aset='$no'");
			$row_cnt = $res->num_rows;
			if($row_cnt>0)
			{ 
			?>
				<div id="maintenance-toolbar">
					<form role="form" action="servis-add" method="POST" enctype="multipart/form-data">
						<input type="hidden" value="<?php echo $no;?>" name="id_aset" id="id_aset"></input>
						<input type="hidden" value="<?php echo $no_aset;?>" name="no_aset" id="no_aset"></input>
						<button type="submit" name="aset-detail" class="btn btn-primary btn-md">Perbaikan aset</button>
					</form> 
                  
                </div>
                <br>
              <!-- Asset Maintenance table -->
               <table id="example1" class="table">
					<thead>
						<tr>
							<th>Tanggal</th><th>Asset</th><th>No. Serial</th><th>Admin</th>
						</tr>
					</thead>
					<tbody>
						<?php
							while($row = $res->fetch_array()){ 
								echo '
									<tr> 
										<td>'.$row['tgldibagikan'].'</td>
										<td><a href="aset-detail?no='.$row['no'].'" title="Detail Aset">'.$row['no_aset'].'</a></td>
										<td>'.$row['serial'].'</td>
										<td>'.$row['nama'].'</td>
									</tr>
							';}
						?>
								 
						</tbody>
					</table>
				<?php 
					}else{
				?>
				
					<div class="alert alert-info alert-block">
						<i class="fa fa-info-circle"></i>
						No Results.
					</div>	
			<?php 
			}
		?>
                </div>
			</div>
        </div> <!-- /.tab-pane components -->

        <div class="tab-pane fade" id="maintenances">
          <div class="row">
            <div class="col-md-12">
                <div id="maintenance-toolbar">
					<form role="form" action="servis-add" method="POST" enctype="multipart/form-data">
						<input type="hidden" value="<?php echo $no;?>" name="id_aset" id="id_aset"></input>
						<input type="hidden" value="<?php echo $no_aset;?>" name="no_aset" id="no_aset"></input>
						<button type="submit" name="aset-detail" class="btn btn-primary btn-md">Perbaikan aset</button>
					</form> 
                  
                </div>
                <br>
              <!-- Asset Maintenance table -->
               <table id="" class="tabledisplay table table-bordered table-striped">
					<thead>
					<tr>
						<th>Tanggal</th> 
						<th>Pengirim</th> 
						<th>Tlp</th>  
						<th>Keluhan</th>  
						<th>Tindakan</th> 
						<th>Tanggal Selesai</th> 
						<th>Admin/Teknisi</th>
					</tr>
					</thead>
					<tbody>
									 <?php
					 
					$res3 = $conn->query("SELECT * from perbaikan 
										Left join users ON perbaikan.admin=users.id_user
										where no_aset='$no_aset' ");
					while($row3 = $res3->fetch_assoc()){ 
					if (empty($row3['tgl_selesai'])){$selesai="";}else{$selesai=tanggal_indo($row3['tgl_selesai']);}
									echo '
									<tr>
										 <td>'.tanggal_indo($row3['tgl_masuk']).'</td> 
										 <td>'.$row3['pengirim'].'</td>
										 <td>'.$row3['tlp'].'</td>
										 <td>'.$row3['keluhan'].'</td>
										 <td>'.$row3['tindakan'].'</td>
										 <td>'.$selesai.' </td>
										 <td>'.$row3['nama'].' </td> 		
									</tr>';
									 
								}
								?>
						</tbody>
				</table>
            </div> <!-- /.col-md-12 -->
          </div> <!-- /.row -->
        </div> <!-- /.tab-pane maintenances -->
  
        <div class="tab-pane fade" id="history">
          <div class="row">
            <div class="col-md-12"> 
                <br>
            <table id="" class="tabledisplay table table-bordered table-striped">
					<thead>
					<tr>
						<th>Tanggal</th> 
						<th>Admin</th>   
						<th>Item</th> 
						<th>Aksi</th> 
						<th>Target</th> 
						<th>Catatan</th>  
					</tr>
					</thead>
					<tbody>
									 <?php
					 
					$res3 = $conn->query("SELECT * from data_aset_logs
											LEFT JOIN data_aset ON data_aset_logs.no_aset=data_aset.no_aset  
											LEFT JOIN data_karyawan ON data_aset_logs.target=data_karyawan.nik  
											LEFT JOIN users ON data_aset_logs.admin=users.id_user
											where aset_id='$no' ORDER BY tgl DESC"); 
					while($row3 = $res3->fetch_assoc()){ 
									echo '
									<tr>
										 <td>'.tanggal_indo($row3['tgl']).'</td> 
										 <td>'.$row3['nama'].'</td>
										 <td>'.$row3['no_aset'].' - '.$row3['model'].'</td>
										 <td>'.$row3['aksi'].'</td>
										 <td>'.$row3['nama_karyawan'].'</td> 
										 <td>'.$row3['catatan'].'</td> 
										 						
									</tr>';
									 
								}
								?>
						</tbody>
				</table>
                
              
            </div> <!-- /.col-md-12 -->
          </div> <!-- /.row -->
        </div> <!-- /.tab-pane history -->
  
      </div> <!-- /. tab-content -->
    </div> <!-- /.nav-tabs-custom -->
  </div> <!-- /. col-md-12 -->
  
  </div>
<?php }} ?>	

