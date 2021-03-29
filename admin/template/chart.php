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
                    $res = mysqli_query(
                        $conn,
                        "SELECT * FROM(
                            (SELECT stok_temp as stok, tgl_order as tgl FROM order_consumable          
                                WHERE tgl_order LIKE '$date-%$i-%'
                                AND id_consum = $l 
                                ORDER BY tgl DESC LIMIT 1)
                            UNION
                            (SELECT stok_temp as stok, tgldibagikan as tgl FROM consumable_user          
                                WHERE tgldibagikan LIKE '$date-%$i-%'
                                AND id_consumable = $l
                                ORDER BY tgl DESC LIMIT 1)
                        )as a ORDER BY a.tgl DESC LIMIT 1"
                    );
                    $val = [];
                    if ($res->num_rows > 0 || date('n') != $i) {
                        $val = $res->fetch_assoc();
                    } else if ($res->num_rows <= 0 && date('n') == $i) {
                        $sql = $conn->query("SELECT sisa as stok FROM consumable WHERE id = $l");
                        $val = $sql->fetch_assoc();
                    }

                    $data[$i][$no] = $val['stok'] == null ? 0 : $val['stok'];
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
                $res = mysqli_query(
                    $conn,
                    "SELECT * FROM(
                        (SELECT stok_temp as stok, tgl_order as tgl FROM order_consumable          
                            WHERE tgl_order LIKE '$date-%$i-%'
                            AND id_consum = $id 
                            ORDER BY tgl DESC LIMIT 1)
                        UNION
                        (SELECT stok_temp as stok, tgldibagikan as tgl FROM consumable_user          
                            WHERE tgldibagikan LIKE '$date-%$i-%'
                            AND id_consumable = $id
                            ORDER BY tgl DESC LIMIT 1)
                    )as a ORDER BY a.tgl DESC LIMIT 1"
                );
                $val = [];
                if ($res->num_rows > 0 || date('n') != $i) {
                    $val = $res->fetch_assoc();
                } else if ($res->num_rows <= 0 && date('n') == $i) {
                    $sql = $conn->query("SELECT sisa as stok FROM consumable WHERE id = $id");
                    $val = $sql->fetch_assoc();
                }
                $r = [$bulan[$i], (int) $val['stok'], (int) $nama['min']];
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
                if ($r['jml'] == NULL) {
                    array_push($data, [$day, 0]);
                } else {
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
                if ($r['jml'] == NULL) {
                    array_push($data, [$day, 0]);
                } else {
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
                if ($r['jml'] == NULL) {
                    array_push($data, [$day, 0]);
                } else {
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
                if ($r['jml'] == NULL) {
                    array_push($data, [$day, 0]);
                } else {
                    array_push($data, [$day, $r['jml']]);
                }
            } else {
                array_push($data, [$day, 0]);
            }
        }
    }

    echo json_encode($data);
}

if (isset($_POST['dataTotal'])) {

    function pieAsset($conn, $jenis = "total")
    {
        $data = [];
        $head = ['Kategori', 'Jumlah'];
        array_push($data, $head);
        $result = $conn->query("SELECT * FROM  data_kategori");

        while ($row = $result->fetch_assoc()) {
            $kategori = $row['kd_kategori'];
            $sql = "SELECT * FROM data_aset WHERE kd_kategori = '$kategori'";
            if ($jenis == "alokasi") {
                $sql .= "AND lokasi = 'DI USER'";
            } else if ($jenis == "gudang") {
                $sql .= "AND NOT lokasi = 'DI USER' ";
            }
            $total = mysqli_num_rows(mysqli_query($conn, $sql));
            $r = [
                $row['nama_kategori'] . " ($total)",
                (int)$total ?: 0
            ];
            array_push($data, $r);
        }
        echo json_encode($data);
    }

    function pieConsumable($conn, $jenis = "total")
    {
        $data = [];
        $head = ['Kategori', 'Jumlah'];
        array_push($data, $head);
        $result = $conn->query("SELECT * FROM  kategori WHERE tipe = 'consumable'");

        while ($row = $result->fetch_assoc()) {
            $kategori = $row['id_kategori'];
            $sql = "SELECT sisa FROM consumable WHERE id_kategori = '$kategori'";
            $total = mysqli_fetch_assoc(mysqli_query($conn, $sql));
            $r = [
                $row['nama_kategori'] . " (${total['sisa']})",
                (int)$total['sisa'] ?: 0
            ];
            array_push($data, $r);
        }
        echo json_encode($data);
    }

    function pieKomponen($conn, $jenis = "total")
    {
        $data = [];
        $head = ['Kategori', 'Jumlah'];
        array_push($data, $head);
        $result = $conn->query("SELECT * FROM  kategori WHERE tipe = 'komponen'");

        while ($row = $result->fetch_assoc()) {
            $kategori = $row['id_kategori'];

            if ($jenis == "alokasi") {
                $sql = "SELECT SUM(qty) as sisa FROM komponen_aset as a
                        LEFT JOIN komponen as b ON a.id_komponen = b.id
                        WHERE b.id_kategori = '$kategori'";
            } else if ($jenis == "gudang") {
                $sql = "SELECT SUM(sisa) as sisa FROM komponen WHERE id_kategori = '$kategori'";
            } else {
                $sql = "SELECT SUM(stok) as sisa FROM komponen WHERE id_kategori = '$kategori'";
            }
            $total = mysqli_fetch_assoc(mysqli_query($conn, $sql));
            $r = [
                $row['nama_kategori'] . " (${total['sisa']})",
                (int)$total['sisa'] ?: 0
            ];
            array_push($data, $r);
        }
        echo json_encode($data);
    }

    if ($_POST['dataTotal'] == "default") {
        pieAsset($conn);
    } else if ($_POST['dataTotal'] == "filter") {
        $d = $_POST['barang'];
        @$j = $_POST['jenis'];
        if ($d == "asset") {
            pieAsset($conn, $j);
        } else if ($d == "consumable") {
            pieConsumable($conn);
        } else if ($d == "komponen") {
            pieKomponen($conn, $j);
        }
    }
}

if (isset($_POST['perbaikan'])) {
    $data = [];
    $date = date('Y');

    if ($_POST['perbaikan'] == "All" or $_POST['kategori'] == "All") {
        $result = $conn->query("SELECT * FROM  data_kategori");
        $kategori = ['Bulan'];
        while ($kat = $result->fetch_assoc()) {
            array_push($kategori, strtoupper($kat['kd_kategori']));
        }

        for ($i = 0; $i <= count($bulan); $i++) {
            if ($i == 0) {
                array_push($data, $kategori);
            } else {
                $r = [$bulan[$i]];
                for ($j = 1; $j < count($kategori); $j++) {
                    $kd = $kategori[$j];
                    $sql = "SELECT count(keluhan) as total FROM perbaikan as a
                        LEFT JOIN data_aset as b ON a.no_aset = b.no_aset
                        WHERE b.kd_kategori = '$kd' AND tgl_masuk LIKE '$date-%$i-__' ";
                    $keluhan = ($conn->query($sql))->fetch_assoc();
                    array_push($r, (int)$keluhan['total']);
                }
                array_push($data, $r);
            }
        }
    } else {
        $kd = $_POST['kategori'];

        for ($i = 0; $i <= count($bulan); $i++) {
            if ($i == 0) {
                $head = ($conn->query("SELECT nama_kategori as nama FROM data_kategori WHERE kd_kategori = '$kd'"))->fetch_assoc();
                array_push($data, ['Bulan', $head['nama']]);
            } else {
                $sql = "SELECT count(keluhan) as total FROM perbaikan as a
                        LEFT JOIN data_aset as b ON a.no_aset = b.no_aset
                        WHERE b.kd_kategori = '$kd' AND tgl_masuk LIKE '$date-%$i-__' ";
                $keluhan = ($conn->query($sql))->fetch_assoc();
                array_push($data, [$bulan[$i], (int)$keluhan['total']]);
            }
        }
    }

    echo json_encode($data);
}
