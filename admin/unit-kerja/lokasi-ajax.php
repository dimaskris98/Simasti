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
  
	0 => 'kd_uker', 
    1 => 'nama_uker' 
);

// getting total number records without any search
	$sql = "SELECT * FROM data_uker   ";
	$query=mysqli_query($conn, $sql) or die("lokasi-ajax.php: get InventoryItems");
	$totalData = mysqli_num_rows($query);
	$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if( !empty($requestData['search']['value']) ) {
    // if there is a search parameter
	$sql = "SELECT * FROM data_uker  ";
   // $requestData['search']['value'] contains search parameter
    $sql.=" WHERE  kd_uker LIKE '%".$requestData['search']['value']."%' ";
    $sql.="OR  nama_uker LIKE '%".$requestData['search']['value']."%' "; 
    $query=mysqli_query($conn, $sql) or die("lokasi-ajax.php: get PO");
    $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query 

    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']." ".$limit."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
    $query=mysqli_query($conn, $sql) or die("lokasi-ajax.php: get PO"); // again run query with limit
    
} else {    
		
	$sql = "SELECT * FROM data_uker   ";
    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']." ". $limit."   ";
    $query=mysqli_query($conn, $sql) or die("lokasi-ajax.php: get PO");
    
}

$data = array();
$no=1;
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$kd_uker=$row['kd_uker'];
	//Total Aset
	$totalaset = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM data_aset where kd_uker='$kd_uker'"));
	$jumlahbagian = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM data_uker_bagian where kd_uker='$kd_uker'"));
	$organik = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM data_karyawan where kd_uker='$kd_uker' AND organik='organik'"));
	$nonorganik = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM data_karyawan where kd_uker='$kd_uker' AND organik='nonorganik'"));
	//Total Karyawan
	//$Organik=mysqli_fetch_array(mysqli_query($conn,"Select (g1+g2+g3+g4+g5+g6+g7+gpk) AS totalisi From data_uker where kd_uker='$kduker'"));	
	 //$terisi=mysqli_fetch_array(mysqli_query($conn,"Select (g1+g2+g3+g4+g5+g6+g7+gpk) AS totalisi From data_uker where kd_uker='$kd_uker'")); 
	 $nonOrganikDep = $row['non_organik'];
		$totalbg=0;$totalNonOrganikBag=0;
		$sqlbag = $conn->query("SELECT * FROM data_uker_bagian where kd_uker='$kd_uker' ");
		while($rowbag = $sqlbag->fetch_assoc())
		{
			$kdbag=$rowbag['kd_bag'];
			$NonOrganikBag=$rowbag['non_organik_bag'];
			$pc = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM data_aset WHERE kd_uker = '$kdbag'"));
			$totalbg+=$pc;
			$totalNonOrganikBag+=$NonOrganikBag;
			 
		}
		$totalAll=$totalaset+$totalbg; 
		$totalOrganik=$nonOrganikDep+$totalNonOrganikBag; 
	
	
	
	
    $nestedData=array(); 
    $nestedData[]=$no;
    $nestedData[] = '</td><a href="?view='.$row['kd_uker'].'" title="Detail Aset">'.$row['nama_uker'].'</a>
					</td>';  
    $nestedData[] = $jumlahbagian;
    $nestedData[] = $totalAll; 
	$nestedData[] = $organik;  
	$nestedData[] = $nonorganik;
		
    
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