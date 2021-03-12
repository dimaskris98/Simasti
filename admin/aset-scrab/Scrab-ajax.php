<?php
/* Database connection start */
include ("../../konekdb.php");

/* Database connection end */ 
 $a=explode('-',$_POST['kategori'],2);
 if(isset($a[1])){
	 $kd=$a[1];
	 $kdk =mysqli_fetch_array(mysqli_query($conn,"SELECT *  FROM data_kategori  WHERE nama_kategori like '$kd'"));
	 $kd_kategori=$kdk['kd_kategori'];
	 $sql1 = "SELECT * FROM data_aset_scrab  
			Left join data_kategori ON data_aset_scrab.kd_kategori=data_kategori.kd_kategori
			WHERE data_aset_scrab.kd_kategori LIKE '%$kd_kategori%' ";
		$sql2="SELECT * FROM data_aset_scrab 
				Left join data_kategori ON data_aset_scrab.kd_kategori=data_kategori.kd_kategori 
				WHERE data_aset_scrab.kd_kategori LIKE '%$kd_kategori%' AND";
		$sql3="data_aset_scrab.kd_kategori LIKE '%$kd_kategori%' AND";
	}else{
		 $sql1 = "SELECT * FROM data_aset_scrab Left join data_kategori ON data_aset_scrab.kd_kategori=data_kategori.kd_kategori
					 ";  
		 $sql2=" SELECT * FROM data_aset_scrab 
					Left join data_kategori ON data_aset_scrab.kd_kategori=data_kategori.kd_kategori WHERE ";
		 $sql3=" ";
		}
 
// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;
if ($requestData['length']=="-1"){
		$limit="";
	}else{
		$limit="   LIMIT ".$requestData['start']." ,".$requestData['length'];
		 
	}


$columns = array( 
// datatable column index  => database column name
   
  
	0 => 'no_aset', 
    1 => 'tahun',
    2 => 'model',
    3 => 'kd_kategori',
    4 => 'tgl_scrab',
    5 => 'sn'  
);

// getting total number records without any search
 
$query=mysqli_query($conn, $sql1) or die("asetview-Scrab-ajax.php: get InventoryItems");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if( !empty($requestData['search']['value']) ) {
    // if there is a search parameter
	 
    $sql= $sql2. " model  LIKE '%".$requestData['search']['value']."%'";
    $sql.=" OR " .$sql3. " tahun LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR " .$sql3. " no_aset LIKE '%".$requestData['search']['value']."%' "; 
    $sql.=" OR " .$sql3. " tgl_scrab LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR " .$sql3. " sn LIKE '%".$requestData['search']['value']."%'";
    $query=mysqli_query($conn, $sql) or die("asetview-Scrab-ajax.php: get PO");
    $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query 

    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   ".$limit."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
    $query=mysqli_query($conn, $sql) or die("asetview-Scrab-ajax.php: get PO"); // again run query with limit
    
} else {    

	$sql = $sql1;
    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."    ".$limit."   ";
    $query=mysqli_query($conn, $sql) or die("asetview-Scrab-ajax.php: get PO");
    
}

$data = array();
$no=1;
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
    $nestedData=array(); 
   
    $nestedData[] = '</td>
						<form action="detail" method="post">
								<a name="tes" href="javascript:" onclick="parentNode.submit();"> '.$row['no_aset'].'</a>
								<input type="hidden" name="back" value="Scrab-'.$row['nama_kategori'].'" >
								<input type="hidden" name="aset-scrab-detail" value="'.$row['idscrab'].'"/>
							
						</form>
					</td>';
    $nestedData[] = $row["nama_kategori"];
    $nestedData[] = $row["tahun"];
    $nestedData[] = $row["model"];
    $nestedData[] = $row["sn"];
    $nestedData[] = $row["tgl_scrab"]; 
    $nestedData[] = '<td>
	<form role="form" action="edit" method="POST" enctype="multipart/form-data">
		<input type="hidden" name="idd" value="'.$row['idscrab'].'" >  
		<input type="hidden" name="kategori" value="Scrab-'.$row['nama_kategori'].'" > 	
		<button type="submit" name="editasetscrab" class="btn btn-primary btn-sm"><span class="fa fa-pencil" aria-hidden="true"></span></button>
		<button type="submit" name="hapusscrab" onclick="return confirm(\'Anda yakin akan menghapus data '.$row['no_aset'].'?\')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
	</form>
	</td>';        
    
    $data[] = $nestedData;
    $no++;
}


$json_data = array(
            "draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
            "recordsTotal"    => intval( $totalData ),  // total number of records
            "recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );

echo json_encode($json_data);  // send data as json format

?>