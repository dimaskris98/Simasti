<?php

if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: " . $conn->connect_error;
}
if (!isset($_SESSION['sess_id'])) {
    mysqli_close($conn); // Menutup koneksi
    header('location: ../login.php?error=' . base64_encode('Anda harus Login dulu!!!')); // Mengarahkan ke Home Page
}
$tgl = date('Y-m-d');

$jmlh_cp = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM data_aset WHERE kd_kategori = 'cp'"));
$jmlh_nb = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM data_aset WHERE kd_kategori = 'nb'"));
$jmlh_pr = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM data_aset WHERE kd_kategori = 'pr'"));
$jmlh_ps = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM data_aset WHERE kd_kategori = 'ps'"));
$jmlh_sc = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM data_aset WHERE kd_kategori = 'sc'"));
$jmlh_pj = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM data_aset WHERE kd_kategori = 'pj'"));

$showkategori = $conn->query("SELECT * FROM  data_kategori");


function sup_id($param = "Sup")
{
    //$tgl=date('dmy');
    $dataMax = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUBSTR(MAX(id_sup),-5) AS ID  FROM data_pemasok")); // ambil data maximal dari id transaksi

    if ($dataMax['ID'] == '') { // bila data kosong
        $ID = $param . "00001";
    } else {
        $MaksID = $dataMax['ID'];
        $MaksID++;
        if ($MaksID < 10) $ID = $param . "0000" . $MaksID; // nilai kurang dari 10
        else if ($MaksID < 100) $ID = $param . "000" . $MaksID; // nilai kurang dari 100
        else if ($MaksID < 1000) $ID = $param . "00" . $MaksID; // nilai kurang dari 1000
        else if ($MaksID < 10000) $ID = $param . "0" . $MaksID; // nilai kurang dari 10000
        else $ID = $MaksID; // lebih dari 10000
    }

    return $ID;
}

function distribusi_id($param = "dis")
{
    //$tgl=date('dmy');
    $dataMax = mysqli_fetch_assoc(mysqli_query(
        $conn,
        "SELECT SUBSTR(MAX(id_distribusi),-5) AS ID  FROM tb_distribusi"
    )); // ambil data maximal dari id transaksi

    if ($dataMax['ID'] == '') { // bila data kosong
        $ID = $param . "00001";
    } else {
        $MaksID = $dataMax['ID'];
        $MaksID++;
        if ($MaksID < 10) $ID = $param . "0000" . $MaksID; // nilai kurang dari 10
        else if ($MaksID < 100) $ID = $param . "000" . $MaksID; // nilai kurang dari 100
        else if ($MaksID < 1000) $ID = $param . "00" . $MaksID; // nilai kurang dari 1000
        else if ($MaksID < 10000) $ID = $param . "0" . $MaksID; // nilai kurang dari 10000
        else $ID = $MaksID; // lebih dari 10000
    }

    return $ID;
}

function barang_id($param = "pg")
{
    //$tgl=date('dmy');
    $dataMax = mysqli_fetch_assoc(mysqli_query(
        $conn,
        "SELECT SUBSTR(MAX(kode_barang),-5) AS ID  FROM tb_barang"
    )); // ambil data maximal dari id transaksi

    if ($dataMax['ID'] == '') { // bila data kosong
        $ID = $param . "00001";
    } else {
        $MaksID = $dataMax['ID'];
        $MaksID++;
        if ($MaksID < 10) $ID = $param . "0000" . $MaksID; // nilai kurang dari 10
        else if ($MaksID < 100) $ID = $param . "000" . $MaksID; // nilai kurang dari 100
        else if ($MaksID < 1000) $ID = $param . "00" . $MaksID; // nilai kurang dari 1000
        else if ($MaksID < 10000) $ID = $param . "0" . $MaksID; // nilai kurang dari 10000
        else $ID = $MaksID; // lebih dari 10000
    }

    return $ID;
}
