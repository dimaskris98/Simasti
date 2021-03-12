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
    1 => 'nik_sap',
    2 => 'nama',
    3 => 'tmp_lahir',
    4 => 'tgl_lahir',
    5 => 'j_kelamin',
    6 => 'kd_unitkerja'  
);

// getting total number records without any search
	$sql = "SELECT * FROM karyawan";	
$query=mysqli_query($conn, $sql) or die("organik-ajax.php: get InventoryItems");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if( !empty($requestData['search']['value']) ) {
    // if there is a search parameter
	 $sql1 = "SELECT * FROM karyawan";
   // $requestData['search']['value'] contains search parameter
    $sql1.="  where nik LIKE '%".$requestData['search']['value']."%' ";
    $sql1.="OR nik_sap LIKE '%".$requestData['search']['value']."%' ";
    $sql1.="OR nama LIKE '%".$requestData['search']['value']."%' "; 
    $sql1.="OR tmp_lahir LIKE '%".$requestData['search']['value']."%' "; 
    $sql1.="OR tgl_lahir LIKE '%".$requestData['search']['value']."%' "; 
    $sql1.="OR j_kelamin LIKE '%".$requestData['search']['value']."%' ";  
    $sql1.="OR kd_unitkerja LIKE '%".$requestData['search']['value']."%' "; 
	
    $query=mysqli_query($conn, $sql1) or die("organik-ajax.php: get PO");
    $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query 

    $sql1.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   ".$limit."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
    $query=mysqli_query($conn, $sql1) or die("organik-ajax.php: get PO"); // again run query with limit
    
} else {    
	$sql2 = "SELECT * FROM karyawan";
    $sql2.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  ".$limit."   ";
    $query=mysqli_query($conn, $sql2) or die("organik-ajax.php: get PO");
    
}
function dep($kode){
	$a=substr($kode,0,1);
	$b=substr($kode,1,1);
	$c=substr($kode,2,1);
	$d=substr($kode,3,1);
	$e=substr($kode,4,1);
	$f=substr($kode,5,1);
	if (($a!=0)&&($b==0)&&($c==0)&&($d==0)&&($e==0)&&($f==0)){
		$text ="Direktorat";
	}else if (($a!=0)&&($b==0)&&($c==0)&&($d==0)&&($e!=0)&&($f==0)){
		$text ="SU Direktorat";
	}else if (($a!=0)&&($b!=0)&&($c==0)&&($d==0)&&($e==0)&&($f==0)){
		$text ="kompartemen";
	}else if (($a!=0)&&($b!=0)&&($c!=0)&&($d==0)&&($e==0)&&($f==0)){
		$text ="Departemen";
	}else if (($a!=0)&&($b!=0)&&($c!=0)&&($d!=0)&&($e==0)&&($f==0)){
		$text ="Bagian";
	}else{
		$text ="pelaksana";
	}
	
	return $text;
}
$data = array();
$no=1;
while( $row=mysqli_fetch_array($query) ) { 
	$dep= dep($row['kd_unitkerja']); 
 
    $nestedData=array(); 
   
    $nestedData[] = '</td>
						<form action="detail" method="post">
								<a name="tes" href="javascript:" onclick="parentNode.submit();"> '.$row['nik'].'</a>
								<input type="hidden" name="karyawan-detail" value="'.$row['nik'].'"/>
								 
							
						</form>
					</td>';  
    $nestedData[] = $row["nik_sap"];
    $nestedData[] = $row["nama"];
    $nestedData[] = $row["tmp_lahir"]; 
    $nestedData[] = $row["tgl_lahir"];
    $nestedData[] = $row["j_kelamin"];
    $nestedData[] = $row["kd_unitkerja"]; 
    $nestedData[] = $dep; 
    $nestedData[] = $dep;  
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