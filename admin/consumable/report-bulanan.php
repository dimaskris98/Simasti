<style>
    table,
    td,
    th {
        border: 1px solid black;
        font-size: 12px;
    }

    table.a {
        border: 0px;

    }

    tr.b {
        border: 0px;

    }

    table.dataTable thead th,
    table.dataTable thead td,
    table.dataTable.no-footer {
        border-bottom: 2px solid #ddd !important;
    }

    .dt-but table {
        border-collapse: collapse;
        width: auto;
    }

    th,
    td {
        vertical-align: middle !important;
    }

    th,
    td {
        padding: 4px;
        word-wrap: break-word;

    }

    td.c {
        padding: 0px;
    }

    th {
        text-align: center;
    }

    p.tebal {
        font-weight: bold;
    }

    .kanan {
        float: right;
    }

    .kolom1 {

        width: auto;
        padding: 5px;
        float: left;
    }
</style>
<section class="content-header">
</section>
<section class="content">
    <div id="webui">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default tables">
                    <div class="box-header">
                        <h4 class="text-center" style="margin-top: 25px;">LAPORAN CONSUMABLE BULAN</h4>
                    </div>
                    <div class="box-body" style="margin: auto; width: 75%">
                        <table class="table table-bordered table-responsive table-hover table-striped lapDetail">
                            <thead>
                                <tr class="info">
                                    <th style="width: 50px;">No.</th>
                                    <th>Consumable</th>
                                    <th>Stok Awal</th>
                                    <th>Order</th>
                                    <th>Pembagian</th>
                                    <th>Stok Akhir</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $date = date('Y-m-');
                                $query = $conn->query("SELECT id,sisa,nama_consumable as nama FROM consumable");
                                while ($q = mysqli_fetch_assoc($query)) {
                                    $awal;
                                    $d1 = mysqli_fetch_assoc($conn->query("SELECT tgl_order as tgl,stok_temp - jumlah as awal FROM order_consumable WHERE tgl_order LIKE '$date%' AND id_consum = ${q['id']} ORDER BY tgl_order LIMIT 1"));
                                    $d2 = mysqli_fetch_assoc($conn->query("SELECT tgldibagikan as tgl,stok_temp - qty as awal FROM consumable_user WHERE tgldibagikan LIKE '$date%' AND id_consumable = ${q['id']} ORDER BY tgldibagikan LIMIT 1"));
                                    if (is_null($d1['tgl']) and is_null($d2['tgl'])) {
                                        $awal = $q['sisa'];
                                        echo "D";
                                    } else if (($d1['tgl'] < $d2['tgl'] OR is_null($d2['tgl'])) AND  !is_null($d1['tgl'])) {
                                        $awal = $d1['awal'];
                                        echo "A";
                                    } else if (($d1['tgl'] > $d2['tgl'] || is_null($d1['tgl']))AND  !is_null($d2['tgl'])) {
                                        $awal = $d2['awal'];
                                        echo "B";
                                    } else {
                                        $awal = $q['sisa'];
                                        echo "C";
                                    }
                                    $order = mysqli_fetch_assoc($conn->query("SELECT SUM(jumlah) as ord FROM order_consumable WHERE id_consum = ${q['id']} AND tgl_order LIKE '$date%'"));
                                    $bagi = mysqli_fetch_assoc($conn->query("SELECT SUM(qty) as bagi FROM consumable_user WHERE id_consumable = ${q['id']} AND tgldibagikan LIKE '$date%'"));
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $q['nama'] ?></td>
                                        <td><?= $awal ?: 0 ?></td>
                                        <td><?= $order['ord'] ?: 0 ?></td>
                                        <td><?= $bagi['bagi'] ?: 0 ?></td>
                                        <td><?= $q['sisa'] ?: 0 ?></td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>