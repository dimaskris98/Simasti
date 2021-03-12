<?php
/* Database connection start */
include("../../konekdb.php");

/* Database connection end */

// storing  request (ie, get/post) global array to a variable  
$requestData = $_REQUEST;

if ($requestData['length'] == "-1") {
    $limit = "";
} else {
    $limit = "   LIMIT " . $requestData['start'] . " ," . $requestData['length'];
}

$columns = array(
    // datatable column index  => database column name

    0 => 'id',
    1 => 'tgl_masuk',
    2 => 'no_aset',
    3 => 'pengirim',
    4 => 'nama_unitkerja',
    5 => 'tlp',
    6 => 'keluhan',
    7 => 'tindakan',
    8 => 'tgl_selesai',
    9 => 'nama'
);

// getting total number records without any search
$sql = "SELECT  perbaikan.*,a.nama_unitkerja,users.nama FROM perbaikan 
left join data_aset a ON perbaikan.no_aset=a.no_aset
left join users ON users.id_user=perbaikan.admin";
//$query = mysqli_query($conn, $sql) or die("perbaikan-ajax.php: get InventoryItems");
$query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if (!empty($requestData['search']['value'])) {
    // if there is a search parameter
    $sql = "SELECT a.nama_unitkerja,perbaikan.*,users.nama FROM perbaikan 
			left join data_aset a ON perbaikan.no_aset=a.no_aset
			left join users ON users.id_user=perbaikan.admin";
    $sql .= " WHERE perbaikan.no_aset LIKE '%" . $requestData['search']['value'] . "%' ";
    $sql .= " OR perbaikan.pengirim LIKE '%" . $requestData['search']['value'] . "%' ";
    $sql .= " OR perbaikan.tlp LIKE '%" . $requestData['search']['value'] . "%' ";
    $sql .= " OR perbaikan.keluhan  LIKE '%" . $requestData['search']['value'] . "%' ";
    $sql .= " OR perbaikan.tindakan LIKE '%" . $requestData['search']['value'] . "%' ";
    $sql .= " OR perbaikan.tgl_selesai  LIKE '%" . $requestData['search']['value'] . "%' ";
    $sql .= " OR perbaikan.tgl_masuk LIKE '%" . $requestData['search']['value'] . "%' ";
    $sql .= " OR perbaikan.status_perbaikan LIKE '%" . $requestData['search']['value'] . "%' ";
    $sql .= " OR users.nama LIKE '%" . $requestData['search']['value'] . "%' ";
    $sql .= " OR a.nama_unitkerja LIKE '%" . $requestData['search']['value'] . "%' ";
    $query = mysqli_query($conn, $sql) or die("perbaikan-ajax.php: get PO1");
    $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query 

    $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "    DESC  " . $limit . "   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
    $query = mysqli_query($conn, $sql) or die("perbaikan-ajax.php: get PO2"); // again run query with limit

} else {

    $sql = "SELECT  perbaikan.*,a.nama_unitkerja,users.nama FROM perbaikan 
    left join data_aset a ON perbaikan.no_aset=a.no_aset
    left join users ON users.id_user=perbaikan.admin";
    $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "    DESC  " . $limit . "   ";
    $query = mysqli_query($conn, $sql) or die("perbaikan-ajax.php: get PO3");
}

$data = array();
$no = 1;
while ($row = mysqli_fetch_array($query)) {  // preparing an array 
    $no_aset = $row['no_aset'];
    $showaset = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM data_aset WHERE no_aset= '$no_aset'"));
    $nestedData = array();
    if ($row['status_perbaikan'] == "selesai") {
        $status = '<span class="badge badge-success">' . $row["status_perbaikan"] . '</span>';
        $tgl_selesai = $row['tgl_selesai'];
        $tindakan = $row["tindakan"];
    } else {
        $status = '<span class="badge badge-danger">' . $row["status_perbaikan"] . '</span>';
        $tgl_selesai = "";
        $tindakan = '<form role="form" action="input-tindakan" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="id" value="' . $row['id'] . '" > 		
						<button type="submit" name="update" class="btn btn-primary btn-sm"><span  aria-hidden="true">Input Tindakan</span></button>
					</form>';
    }
    $nestedData[] =  $row["id"];
    $nestedData[] = $row["tgl_masuk"];
    $nestedData[] = '</td><a href="aset-detail?no=' . $showaset['no'] . '" title="Detail Aset">' . $row['no_aset'] . '</a>';
    $nestedData[] = $row["pengirim"];
    $nestedData[] = $row["nama_unitkerja"];
    $nestedData[] = $row["tlp"];
    $nestedData[] = $row["keluhan"];
    $nestedData[] = $row["ticket"];
    $nestedData[] =  $status;
    $nestedData[] = $tindakan;
    $nestedData[] = $tgl_selesai;
    $nestedData[] = $row["nama"];

    $data[] = $nestedData;
    $no++;
}



$json_data = array(
    "draw"            => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
    "recordsTotal"    => intval($totalData),  // total number of records
    "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
    "data"            => $data   // total data array
);

echo json_encode($json_data);  // send data as json format
