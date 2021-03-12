<?php
/* Database connection start */
include ("../../konekdb.php");

/* Database connection end */ 

// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;
if ($requestData['length']=="-1"){
		$limit="";
	}else{
		$limit="   LIMIT ".$requestData['start']." ,".$requestData['length'];
		 
	}

$columns = array( 
// datatable column index  => database column name
   
  
	0 => 'nik', 
    1 => 'nama_karyawan',
    2 => 'kd_uker',
    3 => 'kd_bag',
    4 => 'email',
    5 => 'tlp'  
);

// getting total number records without any search
	$sql = "SELECT data_karyawan.*,data_karyawan.kd_uker as kd_uker_karyawan, data_uker.kd_uker as kd_dep, data_uker.nama_uker as departemen, data_uker_bagian.kd_bag as kd_bagian, data_uker_bagian.nama_bag as bagian";
	$sql.=" FROM data_karyawan 
		Left join data_uker ON data_karyawan.kd_uker=data_uker.kd_uker
		Left join data_uker_bagian ON data_karyawan.kd_bag=data_uker_bagian.kd_bag";
$query=mysqli_query($conn, $sql) or die("organik-ajax.php: get InventoryItems");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if( !empty($requestData['search']['value']) ) {
    // if there is a search parameter
	$sql = "SELECT data_karyawan.*,data_karyawan.kd_uker as kd_uker_karyawan, data_uker.kd_uker as kd_dep, data_uker.nama_uker as departemen, data_uker_bagian.kd_bag as kd_bagian, data_uker_bagian.nama_bag as bagian";
	$sql.=" FROM data_karyawan 
		Left join data_uker ON data_karyawan.kd_uker=data_uker.kd_uker
		Left join data_uker_bagian ON data_karyawan.kd_bag=data_uker_bagian.kd_bag";
   // $requestData['search']['value'] contains search parameter
    $sql.=" WHERE data_karyawan.nik LIKE '%".$requestData['search']['value']."%' ";
    $sql.="OR data_karyawan.nama_karyawan LIKE '%".$requestData['search']['value']."%' ";
    $sql.="OR data_uker.kd_uker LIKE '%".$requestData['search']['value']."%' ";
    $sql.="OR data_uker.nama_uker LIKE '%".$requestData['search']['value']."%' ";
    $sql.="OR data_uker_bagian.kd_bag LIKE '%".$requestData['search']['value']."%' ";
    $sql.="OR data_uker_bagian.nama_bag LIKE '%".$requestData['search']['value']."%' ";
    $query=mysqli_query($conn, $sql) or die("organik-ajax.php: get PO");
    $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query 

    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   ".$limit."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
    $query=mysqli_query($conn, $sql) or die("organik-ajax.php: get PO"); // again run query with limit
    
} else {    
		
	$sql = "SELECT data_karyawan.*,data_karyawan.kd_uker as kd_uker_karyawan, data_uker.kd_uker as kd_dep, data_uker.nama_uker as departemen, 
	data_uker_bagian.kd_bag as kd_bagian, data_uker_bagian.nama_bag as bagian";
	$sql.=" FROM data_karyawan 
		Left join data_uker ON data_karyawan.kd_uker=data_uker.kd_uker
		Left join data_uker_bagian ON data_karyawan.kd_bag=data_uker_bagian.kd_bag";
    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  ".$limit."   ";
    $query=mysqli_query($conn, $sql) or die("organik-ajax.php: get PO");
    
}

$data = array();
$no=1;
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$asetnik=$row['nik'];
    $nestedData=array(); 
   
    $nestedData[] = '</td>
						<form action="detail" method="post">
								<a name="tes" href="javascript:" onclick="parentNode.submit();"> '.$row['nik'].' - '.$row['nama_karyawan'].'</a>
								<input type="hidden" name="karyawan-detail" value="'.$row['nik'].'"/>
							
						</form>
					</td>';  
    $nestedData[] = $row["email"];
    $nestedData[] = $row["tlp"];
    $nestedData[] = $row["kd_uker_karyawan"]. ' - ' .$row["departemen"]; 
    $nestedData[] = $row["kd_bag"]. ' - ' .$row["bagian"]; 
    $nestedData[] = $totalaset = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM data_aset where nik='$asetnik'")); 
    $nestedData[] = '<td>
	<form role="form" action="edit" method="POST" enctype="multipart/form-data">
		<input type="hidden" name="nik" value="'.$row['nik'].'" > 		
		<button type="submit" name="editkaryawan" class="btn btn-primary btn-sm"><span class="fa fa-pencil" aria-hidden="true"></span></button>
		<button type="submit" name="hapuskaryawan" onclick="return confirm(\'Anda yakin akan menghapus data '.$row['nik'].'?\')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
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