<?php
/* Database connection start */
include ("../../konekdb.php");
$sq="SELECT data_aset.*,a.nama_bag,b.nama_karyawan as nama FROM data_aset
    LEFT JOIN data_uker_bagian as a ON a.kd_bag = data_aset.kd_uker
    LEFT JOIN data_karyawan as b ON b.nik = data_aset.nik";
/* Database connection end */ 
if(isset($_POST['kategori'])){
	 $kd=$_POST['kategori'] ;
	 if($kd=="Sewa"){
		 $sql1 =$sq." WHERE sewa='1'";
			$sql2=$sq." WHERE sewa='1'  AND";
			$sql3=" sewa='1' AND";
		 
	 }else{
		 $kdk =mysqli_fetch_array(mysqli_query($conn,"SELECT *  FROM data_kategori  WHERE nama_kategori like '$kd'"));
		 $kd_kategori=$kdk['kd_kategori'];
		 if ($kd_kategori==""){ 
			//$sql1 ="SELECT * FROM data_aset";
            $sql1 = $sq;
			 $sql2=$sq." WHERE ";
			 $sql3=" ";
		 }else{
			 $sql1 = $sq." WHERE kd_kategori LIKE '%$kd_kategori%'";
			$sql2 = $sq." WHERE kd_kategori LIKE '%$kd_kategori%' AND";
			$sql3 = "kd_kategori LIKE '%$kd_kategori%' AND";
			 
		 }
	 }	
} 

// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;
if ($requestData['length']=="-1"){
		$limit="";
	}else{
		$limit=" LIMIT ".$requestData['start']." ,".$requestData['length'];
		 
	}
 

$columns = array( 
// datatable column index  => database column name
    0 => 'no_aset', 
    1 => 'kd_kategori',
    2 => 'tahun',
    3 => 'model',
    4 => 'nik',
    5 => 'nama',
    6 => 'kd_uker',
    7 => 'nama_bag',
    8 => 'lokasi'
	
);


// getting total number records without any search
 
$query=mysqli_query($conn, $sql1) or die("asetview-ajax.php: get InventoryItems");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

if( !empty($requestData['search']['value']) ) {
    // if there is a search parameter
	 
	
   // $requestData['search']['value'] contains search parameter
    $sql=$sql2. " no_aset LIKE '%".$requestData['search']['value']."%'";
    $sql.=" OR " .$sql3. "  kd_kategori LIKE '%".$requestData['search']['value']."%'";
    $sql.=" OR " .$sql3. "  tahun LIKE '%".$requestData['search']['value']."%'";
    $sql.=" OR " .$sql3. "  model LIKE '%".$requestData['search']['value']."%'";
    $sql.=" OR " .$sql3. "  data_aset.nik LIKE '%".$requestData['search']['value']."%'";
    $sql.=" OR " .$sql3. "  data_aset.kd_uker LIKE '%".$requestData['search']['value']."%'";
    $sql.=" OR " .$sql3. "  a.nama_bag LIKE '%".$requestData['search']['value']."%'";
    $sql.=" OR " .$sql3. "  b.nama_karyawan LIKE '%".$requestData['search']['value']."%'";
    $sql.=" OR " .$sql3. "  status LIKE '%".$requestData['search']['value']."%'";
    $sql.=" OR " .$sql3. "  lokasi LIKE '%".$requestData['search']['value']."%'";
    $query=mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query 

    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   ".$limit."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
    $query=mysqli_query($conn, $sql) or die("asetview-ajax.php: get PO2"); // again run query with limit
    
} else {    

	$sql = $sql1;
    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."    ".$limit."   ";
    $query=mysqli_query($conn, $sql) or die("asetview-ajax.php: get PO3");
    
}

$data = array();
$no=1;
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	 
    $nestedData=array(); 
   
    $nestedData[] = '</td><a href="aset-detail?no='.$row['no'].'" title="Detail Aset">'.$row['no_aset'].'</a></td>';
	$nestedData[] = $row["kd_kategori"];
	$nestedData[] = $row["tahun"];
    $nestedData[] = $row["model"];
    $nestedData[] = $row["nik"];
    $nestedData[] = $row["nama"]; 
    $nestedData[] = $row["kd_uker"] ; 
    $nestedData[] = $row["nama_bag"] ; 
    $nestedData[] = $row["lokasi"] ; 
 	
    $nestedData[] = '<td> 
	<form role="form" action="edit" method="POST" enctype="multipart/form-data">
		<input type="hidden" name="idd" value="'.$row['no'].'" > 
		<input type="hidden" name="kategori" value="'.$row['kd_kategori'].'" >  		
		<button type="submit" name="editaset" class="btn btn-primary btn-sm"><span class="fa fa-pencil" aria-hidden="true"></span></button>
		<button type="submit" name="hapuscp" onclick="return confirm(\'Anda yakin akan menghapus data '.$row['no_aset'].'?\')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
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