<?php
include '../../konekdb.php';

if (isset($_POST['id_consum'])) {
    $id = $_POST['id_consum'];
    $data = [];
    $date = date('Y');
    $d = "";


    if ($id == "All") {
        $kat = [];
        $id = [];
        $b = $conn->query("SELECT id,kode_item,nama_consumable as nama FROM consumable order by sisa desc limit 5");

        while ($s = mysqli_fetch_assoc($b)) {
            array_push($kat, $s['kode_item']);
            array_push($id, $s['id']);
        }

        //var_dump($id);

        for ($i = 0; $i <= count($bulan); $i++) {
            if ($i == 0) {

                $head = ['Bulan'];
                foreach ($kat as $h) {
                    array_push($head, $h);
                }
                //var_dump($head);
                array_push($data, $head);
            } else {
                $no = 1;
                $data[$i][0] = $bulan[$i];
                foreach ($id as $l) {
                    $val = mysqli_fetch_assoc(
                        mysqli_query(
                            $conn,
                            "SELECT AVG(rata) as rata FROM(
                                SELECT AVG(stok_temp) as rata FROM order_consumable          
                                    WHERE tgl_order LIKE '$date-%$i-%'
                                    AND id_consum = $l
                                UNION
                                SELECT AVG(stok_temp) as rata FROM consumable_user          
                                    WHERE tgldibagikan LIKE '$date-%$i-%'
                                    AND id_consumable = $l
                            )as a"
                        )
                    );
                    $data[$i][$no] = $val['rata'] == null ? 0 : $val['rata'];
                    $no++;
                }
            }
        }
    } else {
        $a = $conn->query("SELECT nama_consumable as nama,minqty as min FROM consumable
        WHERE id = $id");
        $nama = mysqli_fetch_assoc($a);
        $idx = 0;

        for ($i = 0; $i <= count($bulan); $i++) {
            if ($i == 0) {
                $head = ['Bulan', $nama['nama'], 'Min(' . $nama['min'] . ')'];
                array_push($data, $head);
            } else {
                $rata = mysqli_fetch_assoc(
                    mysqli_query(
                        $conn,
                        "SELECT AVG(rata) as rata FROM (
                            SELECT AVG(stok_temp) as rata FROM order_consumable          
                                 WHERE tgl_order LIKE '$date-%$i-%'
                                AND id_consum = $id
                            UNION
                            SELECT AVG (stok_temp)as rata FROM consumable_user
                                WHERE tgldibagikan LIKE '$date-%$i-%'
                                AND id_consumable = $id
                        ) as a"
                    )
                );
                $r = [$bulan[$i], (int) $rata['rata'], (int) $nama['min']];
                $data[$i] = $r;
            }
        }
    }


    echo json_encode($data);
}

if (isset($_POST['ConsOrder'])) {
    $date = date("Y-m");
    $db = [];
    $data = [];


    for ($i = 0; $i <= date('t'); $i++) {
        if ($i == 0) {
            array_push($data, ["Hari", "Order"]);
        } else {
            $day = str_pad($i, 2, "0", STR_PAD_LEFT);
            $stmt = "SELECT DATE(tgl_order) as hari, SUM(jumlah) as jml
                        FROM order_consumable as a
                        JOIN consumable as b ON a.id_consum = b.id 
                        WHERE tgl_order LIKE '$date-$day%'";
            $sql = $conn->query($stmt);
            if ($sql->num_rows > 0) {
                $r = $sql->fetch_assoc();
                if($r['jml'] == NULL){
                    array_push($data, [$day, 0]);
                }else{
                    array_push($data, [$day, $r['jml']]);
                }
            } else {
                array_push($data, [$day, 0]);
            }
        }
    }

    echo json_encode($data);
}

if (isset($_POST['ConsBagi'])) {
    $date = date("Y-m");
    $db = [];
    $data = [];


    for ($i = 0; $i <= date('t'); $i++) {
        if ($i == 0) {
            array_push($data, ["Hari", "Dibagikan"]);
        } else {
            $day = str_pad($i, 2, "0", STR_PAD_LEFT);
            $stmt = "SELECT DATE(tgldibagikan) as hari, SUM(qty) as jml
                        FROM consumable_user as a
                        JOIN consumable as b ON a.id_consumable = b.id 
                        WHERE tgldibagikan LIKE '$date-$day%'";
            $sql = $conn->query($stmt);
            if ($sql->num_rows > 0) {
                $r = $sql->fetch_assoc();
                if($r['jml'] == NULL){
                    array_push($data, [$day, 0]);
                }else{
                    array_push($data, [$day, $r['jml']]);
                }
            } else {
                array_push($data, [$day, 0]);
            }
        }
    }

    echo json_encode($data);
}

if (isset($_POST['KompOrder'])) {
    $date = date("Y-m");
    $db = [];
    $data = [];


    for ($i = 0; $i <= date('t'); $i++) {
        if ($i == 0) {
            array_push($data, ["Hari", "Order"]);
        } else {
            $day = str_pad($i, 2, "0", STR_PAD_LEFT);
            $stmt = "SELECT DATE(tgl_order) as hari, SUM(jumlah) as jml
                        FROM order_komponen as a
                        JOIN komponen as b ON a.id_komp = b.id 
                        WHERE tgl_order LIKE '$date-$day%'";
            $sql = $conn->query($stmt);
            if ($sql->num_rows > 0) {
                $r = $sql->fetch_assoc();
                if($r['jml'] == NULL){
                    array_push($data, [$day, 0]);
                }else{
                    array_push($data, [$day, $r['jml']]);
                }
            } else {
                array_push($data, [$day, 0]);
            }
        }
    }

    echo json_encode($data);
}

if (isset($_POST['KompBagi'])) {
    $date = date("Y-m");
    $db = [];
    $data = [];


    for ($i = 0; $i <= date('t'); $i++) {
        if ($i == 0) {
            array_push($data, ["Hari", "Dibagikan"]);
        } else {
            $day = str_pad($i, 2, "0", STR_PAD_LEFT);
            $stmt = "SELECT DATE(tgldibagikan) as hari, SUM(qty) as jml
                        FROM komponen_aset as a
                        JOIN komponen as b ON a.id_komponen = b.id 
                        WHERE tgldibagikan LIKE '$date-$day%'";
            $sql = $conn->query($stmt);
            if ($sql->num_rows > 0) {
                $r = $sql->fetch_assoc();
                if($r['jml'] == NULL){
                    array_push($data, [$day, 0]);
                }else{
                    array_push($data, [$day, $r['jml']]);
                }
            } else {
                array_push($data, [$day, 0]);
            }
        }
    }

    echo json_encode($data);
}
