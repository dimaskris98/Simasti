
<?php
if (isset($_POST["simpanalih"]) ) 
	{
	$kodeaset=$_POST["kodeaset"];
  $tr=$_POST['duallistbox_demo1'] ;		
?>
<form id="tes" class="form-horizontal" method="post" action="" role="form" enctype="multipart/form-data"> 
<div class="box box-default">
		<div class="box-header with-border">
			<h3 class="box-title">Ketikkan No Aset PG sesuai dengan No.Aset Sewa yang di alihkan. Klik simpan.</h3>				 
		</div><!-- /.box-header -->				
		<div class="box-body">	
	<div class="form-group ">
		<label class="col-sm-3 control-label">
			<h4>Kode Aset :</h4>
		</label>
		<div class="col-md-7">
			<input  type="text" name="kode" id="kode" required />
		</div>
	 
		<label class="col-sm-3 control-label">
			<h4>Tahun Aset :</h4>
		</label>
		<div class="col-md-7">
			<input  type="text" name="th" id="th" required />
		</div>
	</div>		 
	<div class="form-group ">
<?php 
		$no=1;$notr=1;
		foreach ( $tr as $names)
		{
			echo' <label class="col-md-2 control-label">'. $no.'. '.$names.'</label><div class="col-md-2">';
			echo' <input class="form-control" placeholder="Ketikan Aset PG...." type="text" name="'.$no.'" required /><br/>';
			echo '<input type="hidden" name="s-'.$notr.'" value="'.$names.'"/>';
			echo'</div>
			';
		$no++;$notr++;
		}
		echo  '<input type="hidden" name="jml" value="'.$no.'"  >';
		echo  '<input type="hidden" name="jmltr" value="s-'.$notr.'"  >';
		echo  '<input type="hidden" name="kodeaset" value="'.$kodeaset.'"  >';
?></div>
 </div></div>
<div class="box-footer text-right">
	<a href="Pengalihan-Aset-Sewa" class="btn btn-danger"> Batal</a>
	<button type="submit" name="simpan" id="simpan" class="btn btn-success">Simpan</button>
</div>	
</form>

<?php	 
	}
	
	if (isset($_POST["simpan"]) )
			
	{
		$kodeaset=$_POST["kodeaset"];
		$kd=$_POST["kode"];
		$th=$_POST["th"];
		$notr= explode('-',$_POST['jmltr'],2); 
		$notr[1]-1;
		$no=$_POST['jml'] -1 ;
		for ($i=1; $i <= $no; $i++)
		{
			 $sewa=$_POST[ 's-'.$i ];
			 $cppg=$_POST[ $i ];
			 $asetpg=$kd.'.'.$cppg.'.'.$th;
			if ($cppg!=""){
			 $sql = "INSERT INTO aset_alih_sewa values('$sewa','$asetpg','$kodeaset','$created_at')";
			 $sqlupdate="update data_aset SET no_aset='$asetpg',sewa='0'  where no_aset='$sewa' and kd_kategori='$kodeaset'";
				 
			$query	= mysqli_query($conn,$sql);	
			$query	= mysqli_query($conn,$sqlupdate);
			}
		}
		echo '<script>window.location="Pengalihan-Aset-Sewa"</script>';  
	}
?>