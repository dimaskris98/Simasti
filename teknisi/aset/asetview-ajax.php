<?php
/* Database connection start */
include ("../../konekdb.php");

/* Database connection end */ 
if(isset($_POST['sewa'])){
	 $sewa=$_POST['sewa'] ;
	 $kd=$_POST['kategori'] ;
	 if($sewa=="1"){
		 
		$kdk =mysqli_fetch_array(mysqli_query($conn,"SELECT *  FROM data_kategori  WHERE nama_kategori like '$kd'"));
		 $kd_kategori=$kdk['kd_kategori'];
		 if ($kd_kategori==""){ 
			 $sql1 ="SELECT data_kategori.*,data_aset.*,data_aset.nik as tnik,data_aset.kd_uker as tuker, data_karyawan.*,data_uker.*,data_uker_bagian.* 
				FROM data_aset left join data_karyawan ON data_aset.nik=data_karyawan.nik 
				Left join data_uker ON data_aset.kd_uker=data_uker.kd_uker
				Left join data_uker_bagian ON data_aset.kd_uker=data_uker_bagian.kd_bag
				Left join data_kategori ON data_aset.kd_kategori=data_kategori.kd_kategori
				WHERE data_aset.sewa='1'";
			$sql2="SELECT data_kategori.*,data_aset.*,data_aset.nik as tnik,data_aset.kd_uker as tuker, data_karyawan.*,data_uker.*,data_uker_bagian.* 
					FROM data_aset left join data_karyawan ON data_aset.nik=data_karyawan.nik
					Left join data_uker ON data_aset.kd_uker=data_uker.kd_uker
					Left join data_uker_bagian ON data_aset.kd_uker=data_uker_bagian.kd_bag
					Left join data_kategori ON data_aset.kd_kategori=data_kategori.kd_kategori
					WHERE data_aset.sewa='1'  AND";
			$sql3="data_aset.sewa='1' AND";
		 }else{
			 $sql1 ="SELECT data_kategori.*,data_aset.*,data_aset.nik as tnik,data_aset.kd_uker as tuker, data_karyawan.*,data_uker.*,data_uker_bagian.* 
				FROM data_aset left join data_karyawan ON data_aset.nik=data_karyawan.nik 
				Left join data_uker ON data_aset.kd_uker=data_uker.kd_uker
				Left join data_uker_bagian ON data_aset.kd_uker=data_uker_bagian.kd_bag
				Left join data_kategori ON data_aset.kd_kategori=data_kategori.kd_kategori
				WHERE data_aset.kd_kategori LIKE '%$kd_kategori%' AND data_aset.sewa='1' ";
			$sql2="SELECT data_kategori.*,data_aset.*,data_aset.nik as tnik,data_aset.kd_uker as tuker, data_karyawan.*,data_uker.*,data_uker_bagian.* 
					FROM data_aset left join data_karyawan ON data_aset.nik=data_karyawan.nik
					Left join data_uker ON data_aset.kd_uker=data_uker.kd_uker
					Left join data_uker_bagian ON data_aset.kd_uker=data_uker_bagian.kd_bag
					Left join data_kategori ON data_aset.kd_kategori=data_kategori.kd_kategori
					WHERE data_aset.kd_kategori LIKE '%$kd_kategori%'  AND data_aset.sewa='1'  AND";
			$sql3="data_aset.kd_kategori LIKE '%$kd_kategori%' AND data_aset.sewa='1'  AND";
		 
	 } 
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
   
  
	0 => 'no_aset', 
    1 => 'tahun',
    2 => 'model',
    3 => 'nik',
    4 => 'nama_karyawan',
    5 => 'kd_uker'  
);


// getting total number records without any search
 
$query=mysqli_query($conn, $sql1) or die("asetview-ajax.php: get InventoryItems");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if( !empty($requestData['search']['value']) ) {
    // if there is a search parameter
	 
	
   // $requestData['search']['value'] contains search parameter
    $sql=$sql2. " data_aset.no_aset LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR " .$sql3. " data_aset.kd_kategori LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR " .$sql3. " data_aset.tahun LIKE '%".$requestData['search']['value']."%' "; 
    $sql.=" OR " .$sql3. " data_aset.model LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR " .$sql3. " data_aset.nik LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR " .$sql3. " data_aset.kd_uker LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR " .$sql3. " data_uker.nama_uker LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR " .$sql3. " data_karyawan.nik LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR " .$sql3. " data_karyawan.nama_karyawan LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR " .$sql3. " data_aset.status LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR " .$sql3. " data_uker_bagian.nama_bag LIKE '%".$requestData['search']['value']."%' ";
    $query=mysqli_query($conn, $sql) or die("asetview-ajax.php: get PO");
    $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query 

    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   ".$limit."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
    $query=mysqli_query($conn, $sql) or die("asetview-ajax.php: get PO"); // again run query with limit
    
} else {    

	$sql = $sql1;
    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."    ".$limit."   ";
    $query=mysqli_query($conn, $sql) or die("asetview-ajax.php: get PO");
    
}

$data = array();
$no=1;
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	 
    $nestedData=array(); 
   
    $nestedData[] = '</td><a href="aset-detail?no='.$row['no'].'" title="Detail Aset">'.$row['no_aset'].'</a></td>';
	$nestedData[] = $row["nama_kategori"];
	$nestedData[] = $row["tahun"];
    $nestedData[] = $row["model"];
    $nestedData[] = $row["tnik"].' - '.$row["nama_karyawan"]; 
    $nestedData[] = $row["tuker"].' - '. $row["nama_uker"]. $row["nama_bag"]; 
 	
    $nestedData[] = '<td> 
		<a href="edit?id='.$row['no'].'" title="edit user"><span class="fa fa-pencil" aria-hidden="true"></span></a>
		<a href="?id='.$row['no'].'" title="Delete" onclick="return confirm(\'Anda yakin akan menghapus data ?\')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
				
	 
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