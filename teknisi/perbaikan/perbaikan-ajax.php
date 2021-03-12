<?php
/* Database connection start */
include ("../../konekdb.php");

/* Database connection end */ 
if(isset($_POST['sewa'])){
	 $sewa=$_POST['sewa'] ;
	if($sewa=="1"){
		$sql1 ="SELECT  * FROM perbaikan WHERE sewa='1'";
		$sql2="SELECT  * FROM perbaikan WHERE sewa='1' AND";
		$sql3="sewa='1' AND";
	}else{
		$sql1 ="SELECT  * FROM perbaikan ";
		$sql2="SELECT  * FROM perbaikan ";
		$sql3=" ";
	}
 
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
   
	0 => 'id', 
    1 => 'tgl_masuk',
    2 => 'no_aset',
    3 => 'pengirim',
    4 => 'tlp',
    5 => 'keluhan',
    6 => 'tindakan',
    7 => 'tgl_selesai' 
);

// getting total number records without any search
 
$query=mysqli_query($conn, $sql1) or die("perbaikan-ajax.php: get InventoryItems");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if( !empty($requestData['search']['value']) ) {
    // if there is a search parameter 
	$sql=$sql2. " no_aset LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR " .$sql3. " pengirim LIKE '%".$requestData['search']['value']."%' "; 
    $sql.=" OR  " .$sql3. " tlp LIKE '%".$requestData['search']['value']."%' "; 
    $sql.=" OR  " .$sql3. " keluhan  LIKE '%".$requestData['search']['value']."%' "; 
    $sql.=" OR  " .$sql3. " tindakan LIKE '%".$requestData['search']['value']."%' "; 
    $sql.=" OR  " .$sql3. " tgl_selesai  LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR  " .$sql3. " tgl_masuk LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR  " .$sql3. " status_perbaikan LIKE '%".$requestData['search']['value']."%' ";
    $query=mysqli_query($conn, $sql) or die("perbaikan-ajax.php: get PO");
    $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query 

    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."    DESC  ".$limit."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
    $query=mysqli_query($conn, $sql) or die("perbaikan-ajax.php: get PO"); // again run query with limit
    
} else {    
		
	$sql = $sql1;
    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."    DESC  ".$limit."   ";
    $query=mysqli_query($conn, $sql) or die("perbaikan-ajax.php: get PO");
    
}

$data = array();
$no=1;
while( $row=mysqli_fetch_array($query) ) {  // preparing an array 
	$no_aset=$row['no_aset'];
	$showaset =mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM data_aset WHERE no_aset= '$no_aset'"));
    $nestedData=array(); 
	if ($row['status_perbaikan']=="selesai"){
		$status='<span class="badge badge-success">'.$row["status_perbaikan"].'</span>';
		$tgl_selesai=$row['tgl_selesai'] ;
		$tindakan=$row["tindakan"] ; 
	}else{
		$status='<span class="badge badge-danger">'.$row["status_perbaikan"].'</span>';
		$tgl_selesai="";
		$tindakan='<form role="form" action="input-tindakan" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="id" value="'.$row['id'].'" > 		
						<button type="submit" name="update" class="btn btn-primary btn-sm"><span  aria-hidden="true">Input Tindakan</span></button>
					</form>';
	}
    $nestedData[] =  $row["id"] ;  
    $nestedData[] = $row["tgl_masuk"] ; 
    $nestedData[] = '</td><a href="aset-detail?no='.$showaset['no'].'" title="Detail Aset">'.$row['no_aset'].'</a>';  
    $nestedData[] = $row["pengirim"];
    $nestedData[] = $row["tlp"];
    $nestedData[] = $row["keluhan"] ;   
    $nestedData[] =  $status; 
    $nestedData[] = $tindakan;  
    $nestedData[] = $tgl_selesai;  
   
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