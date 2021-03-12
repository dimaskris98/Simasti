 <?php
 if (isset($_GET['nik'])){
			$no=$_GET['nik'];
		 
				$data =mysqli_fetch_array(mysqli_query($conn,"SELECT data_karyawan.*,data_karyawan.kd_uker as kd_uker_karyawan, data_uker.kd_uker as kd_dep, 
										data_uker.nama_uker as departemen, data_uker_bagian.kd_bag as kd_bagian, data_uker_bagian.nama_bag as bagian
										FROM data_karyawan 
										Left join data_uker ON data_karyawan.kd_uker=data_uker.kd_uker
										Left join data_uker_bagian ON data_karyawan.kd_bag=data_uker_bagian.kd_bag 
										WHERE nik='$no'"));
 
								
			  ?>
<section class="content-header" style="padding-bottom: 30px;">
          <h1 class="pull-left">
            <?php echo $data['nama_karyawan']; ?> 
          </h1>
          <div class="pull-right">
   
          </div>



        </section>
<section class="content">
          <!-- Content -->
            <div id="webui">
          
<div class="row">
  <div class="col-md-12">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs hidden-print">

        <li class="active">
          <a href="#details" data-toggle="tab" aria-expanded="true">
            <span class="hidden-lg hidden-md">
            <i class="fa fa-info-circle"></i>
            </span>
            <span class="hidden-xs hidden-sm">Info</span>
          </a>
        </li>

        <li class="">
          <a href="#asset_tab" data-toggle="tab" aria-expanded="false">
            <span class="hidden-lg hidden-md">
            <i class="fa fa-barcode"></i>
            </span>
            <span class="hidden-xs hidden-sm">Assets</span>
          </a>
        </li>

        <li class="">
          <a href="#licenses_tab" data-toggle="tab" aria-expanded="false">
            <span class="hidden-lg hidden-md">
            <i class="fa fa-floppy-o"></i>
            </span>
            <span class="hidden-xs hidden-sm">Licenses</span>
          </a>
        </li>

        <li class="">
          <a href="#accessories_tab" data-toggle="tab" aria-expanded="false">
            <span class="hidden-lg hidden-md">
            <i class="fa fa-keyboard-o"></i>
            </span> <span class="hidden-xs hidden-sm">Accessories</span>
          </a>
        </li>

        <li class="">
          <a href="#consumables_tab" data-toggle="tab" aria-expanded="false">
            <span class="hidden-lg hidden-md">
            <i class="fa fa-tint"></i></span>
            <span class="hidden-xs hidden-sm">Consumables</span>
          </a>
        </li>
  <li class="">
          <a href="#history" data-toggle="tab" aria-expanded="false">
            <span class="hidden-lg hidden-md">
            <i class="fa fa-tint"></i></span>
            <span class="hidden-xs hidden-sm">History</span>
          </a>
        </li>
 
                 
              </ul>

      <div class="tab-content">
        <div class="tab-pane active" id="details">
          <div class="row"> 
                        <div class="col-md-2 text-center">
						<?php if ($data['img']==""){ ?>
							 <img src="images/karyawan/default-sm.png" class="avatar img-circle hidden-print" style="width:150px; hight:150px;">
						<?php } else {?>
							<img src="images/karyawan/<?php echo $data['img']; ?>" class="avatar img-circle hidden-print" style="width:150px; hight:150px;">
						<?php } ?>
                             
                          </div>

            <div class="col-md-8">
				<div class="table table-responsive">
					<table class="table table-striped">
						<tbody>
								<td>NIK</td><td><?php echo $data['nik']; ?></td>
							</tr>
							<tr>
								<td class="col-md-2">Name</td> <td><?php echo $data['nama_karyawan']; ?></td>
							</tr>
							<tr>
								<td>Username</td><td><?php echo $data['nik']; ?></td>
							</tr> 
							<tr>
								<td>Email</td><td><a href="mailto:<?php echo $data['email']; ?>"><?php echo $data['email']; ?></a></td>
							</tr>
							<tr>
								<td>Phone</td><td><a href="tel:1-359-355-3264 x947"><?php echo $data['tlp']; ?></a></td>
							</tr> 
							<tr>
								<td>Department</td><td><a href="lokasi?aset=<?php echo $data['kd_uker'] ; ?>"><?php echo $data['departemen'] ; ?></a></td>
							</tr>
							<tr>
								<td>Bagian</td><td><a href="lokasi?aset=<?php echo $data['kd_bag'] ; ?>"><?php echo $data['bagian'] ; ?></a></td>
							</tr>  
						</tbody>
					</table>
				</div>
            </div> <!--/col-md-8-->

            <!-- Start button column -->
            <div class="col-md-2">
                <div class="col-md-12" style="padding-top: 5px;">
					<form role="form" action="edit" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="nik" value="<?php echo $data['nik']; ?>" >  
						<input type="hidden" name="karyawan-detail" value="<?php echo $data['nik']; ?>" >  
							<button  style="width: 100%;" class="btn btn-md btn-default hidden-print" type="submit" name="editkaryawan" >Edit User</button> 
						</form>
                  
                </div>
                <div class="col-md-12" style="padding-top: 5px;">
				<a href="<?=$mod?>" class="btn btn-md btn-default" style="width: 100%;">Kembali</a>
                </div>
                <div class="col-md-12" style="padding-top: 5px;">
                  <a href="" style="width: 100%;" class="btn btn-md btn-default hidden-print">Print All Assigned</a>
                </div>
				<div class="col-md-12" style="padding-top: 5px;">
					<form role="form" action="" method="POST" enctype="multipart/form-data">
						 <input type="hidden" name="nik" value="<?php echo $data['nik']; ?>">  
	
						<button type="submit" name="hapuskaryawan" onclick="return confirm('Anda yakin akan menghapus data <?php echo $data['nik']; ?>')" 
						class="btn btn-md btn-warning hidden-print" style="width: 100%;">Delete</button>
					</form>
                    
                 </div>
            </div>
            <!-- End button column -->
          </div> <!--/.row-->
        </div><!-- /.tab-pane -->

        <div class="tab-pane" id="asset_tab">
          <!-- checked out assets table --> 
			 
			 
				
 
			<div class="box-body table-responsive" > 
				 
				<form role="form" action="add" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="nik" value="<?php echo $data['nik']; ?>"> 
					<button type="submit" name="checkinto" class="btn btn-primary btn-md">Distribusi Aset</button>
				</form> 
				 <br>
				<table class="display table table-striped tabledisplay">
					<thead>
						<tr>
							<th class="col-md-3">No Aset</th>
							<th class="col-md-3">Kategori</th>
							<th class="col-md-3">Tahun</th>
							<th class="col-md-3">Model</th>
							<th class="col-md-2">S/N</th> 
							<th class="col-md-2">Sewa</th> 
							<th class="col-md-1 hidden-print">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$res1 = $conn->query("SELECT  * FROM data_aset 
						Left join data_karyawan ON data_aset.nik=data_karyawan.nik
						Left join data_uker ON data_aset.kd_uker=data_uker.kd_uker 
						Left join data_uker_bagian ON data_aset.kd_uker=data_uker_bagian.kd_bag  
								where data_aset.nik='$no' ORDER BY no ASC");
				
						while($row1 = $res1->fetch_assoc()){
						echo '
						<tr>
						<td><a href="aset-detail?no='.$row1['no'].'" title="Detail Aset">'.$row1['no_aset'].'</a></td>
						<td>'.$row1['kd_kategori'].'</td> 
						<td>'.$row1['tahun'].'</td> 
						<td>'.$row1['model'].'</td>
						<td>'.$row1['sn'].'</td>';
						if ($row1['sewa']==0)
						{echo'<td>Tidak</td>'; }else{echo'<td>Sewa</td>';}
						echo' 
						<td>
							<table><tr><td>
							<form role="form" action="edit" method="POST" enctype="multipart/form-data">
								<input type="hidden" name="idd" value="'.$row1['no'].'" >
								<input type="hidden" name="karyawan-detail" value="'.$row1['nik'].'"/>
								<button type="submit" name="editaset" class="btn btn-primary btn-sm"><span class="fa fa-pencil" aria-hidden="true"></span></button>
							</form>
							</td>
							<td>
						<form role="form" action="edit" method="POST" enctype="multipart/form-data">
								<input type="hidden" name="idd"  value="'.$row1['no'].'"> 
								<input type="hidden" name="karyawan-detail" value="'.$row1['nik'].'"/>
								<button type="submit" name="auditaset" class="btn btn-primary btn-sm"><span class="fa fa-check" aria-hidden="true"></span></button>	
							</form>
						</td> </tr></table>
						</td>
						</tr>';
						$no++;
						}
						?>
			 
	 
						 
					</tbody>
				</table>
			</div>
        </div><!-- /asset_tab -->

        <div class="tab-pane" id="licenses_tab">
          <div class="table-responsive">
            <table class="display table table-hover tabledisplay">
              <thead>
                <tr>
                  <th class="col-md-5">Name</th>
                  <th class="col-md-6">Serial</th>
                  <th class="col-md-1 hidden-print">Action</th>
                </tr>
              </thead>
              <tbody>
                              </tbody>
          </table>
          </div>
        </div><!-- /licenses-tab -->

        <div class="tab-pane" id="accessories_tab">
          <div class="table-responsive">
            <table class="display table table-hover">
              <thead>
                <tr>
                  <th class="col-md-5">Name</th>
                  <th class="col-md-1 hidden-print">Action</th>
                </tr>
              </thead>
              <tbody>
                                </tbody>
            </table>
          </div>
        </div><!-- /accessories-tab -->

        <div class="tab-pane" id="consumables_tab">
          <div class="table-responsive">
            <table class="display table table-striped tabledisplay">
              <thead>
                <tr>
                  <th class="col-md-8">Name</th>
                  <th class="col-md-4">Date</th>
                </tr>
              </thead>
              <tbody>
                              </tbody>
          </table>
          </div>
        </div><!-- /consumables-tab -->
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
											where target='$no' ORDER BY tgl DESC"); 
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
      </div><!-- /.tab-content -->
    </div><!-- nav-tabs-custom -->
  </div>
</div>

            </div>

        </section>
 <?php } else { ?>
  <section class="content-header" style="padding-bottom: 30px;">
<h1 class="pull-left"><?php echo $mod;
if($mod=="organik"){$tombol="non-organik";}else{$tombol="organik";}
?></h1>
<div class="pull-right">

<form role="form" action="add" method="POST" enctype="multipart/form-data">
<a href="<?=$tombol?>" class="btn btn-default"><?=$tombol?> </a>
		<button type="submit" name="karyawan-add" class="btn btn-primary btn-md">Tambah Karyawan</button>
	</form> 
 </div>
 

        </section>
		<br>
 <div class="col-md-12 panel-grids">
	<div class="box-body table-responsive" >
		<table id="organiktabel" class="table table-bordered table-striped">
		<thead>
		<tr> 
		<th>NIK - Nama Karyawan</th> 
		<th>E-mail</th>  
		<th>Tlp</th> 
		<th>Departemen</th>
		<th>Bagian</th>
		<th>Asets</th>
		<th>Aksi</th>
		</tr>
		</thead>
		<tbody> 
		</tbody>
		</table>
	</div>
</div>
<?php } ?>