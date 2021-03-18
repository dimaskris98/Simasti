<?php
include '../../konekdb.php';

if (isset($_POST['id_consum'])) {
    $id = $_POST['id_consum'];
    $data = [];
    $date = date('Y');
    $d = "";
    $kat = [];
    $a = $conn->query("SELECT nama_consumable as nama,minqty as min FROM consumable
	                    WHERE id = $id");
    $nama = mysqli_fetch_assoc($a);
    $idx = 0;

    for ($i = 0; $i <= count($bulan); $i++) {
        if ($i == 0) {
            $head = ['Bulan', $nama['nama'], 'Min'];
            array_push($data, $head);
        } else {
            $rata = mysqli_fetch_assoc(
                mysqli_query(
                    $conn,
                    "SELECT AVG(stok_temp) as rata FROM order_consumable as a          
                                WHERE tgl_order LIKE '$date-%$i-%'
                                AND id_consum = $id"
                )
            );
            $r = [$bulan[$i],(int) $rata['rata'],(int) $nama['min']];
            $data[$i] = $r;
        }
    }

    echo json_encode($data);
}
