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
   
	0 => 'id_sup', 
    1 => 'nama_sup',
    2 => 'alamat_sup',
    3 => 'tlp_sup' 
);

// getting total number records without any search
	$sql = "SELECT  * FROM data_pemasok ";
$query=mysqli_query($conn, $sql) or die("organik-ajax.php: get InventoryItems");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if( !empty($requestData['search']['value']) ) {
    // if there is a search parameter
	$sql = "SELECT * FROM data_pemasok  "; 
	$sql.=" WHERE id_sup LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR nama_sup LIKE '%".$requestData['search']['value']."%' "; 
    $sql.=" OR alamat_sup LIKE '%".$requestData['search']['value']."%' "; 
    $sql.=" OR tlp_sup  LIKE '%".$requestData['search']['value']."%' ";  
    $query=mysqli_query($conn, $sql) or die("organik-ajax.php: get PO");
    $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query 

    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."    DESC  ".$limit."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
    $query=mysqli_query($conn, $sql) or die("organik-ajax.php: get PO"); // again run query with limit
    
} else {    
		
	$sql = "SELECT * FROM data_pemasok  ";
    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."    DESC  ".$limit."   ";
    $query=mysqli_query($conn, $sql) or die("organik-ajax.php: get PO");
    
}

$data = array();
$no=1;
while( $row=mysqli_fetch_array($query) ) {  // preparing an array 
$id_sup=$row["id_sup"] ;
	$totalaset = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM data_aset where id_sup='$id_sup'"));
    $nestedData=array(); 
    $nestedData[] =  $no; 
    $nestedData[] = $row["nama_sup"] ;  
    $nestedData[] = $row["alamat_sup"];
    $nestedData[] = $row["tlp_sup"]; 
    $nestedData[] = $totalaset.' Unit'; 
    $nestedData[] = '
	<form role="form" action="Sup-edit" method="POST" enctype="multipart/form-data">
		<input type="hidden" name="idd" value="'.$row['id_sup'].'" >  
						<input type="hidden" name="id" value="'.$row['id_sup'].'" > 			
		<button type="submit" name="edit" class="btn btn-primary btn-sm"><span class="fa fa-pencil" aria-hidden="true"></span></button>
		<button type="submit" name="hapus" onclick="return confirm(\'Anda yakin akan menghapus data '.$row['nama_sup'].'?\')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
	</form> ';        
    
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