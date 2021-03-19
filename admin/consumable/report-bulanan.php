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
    <div class="panel-info widget-shadow">
        <!-- Nav tabs -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab1" data-toggle="tab">Laporan Keseluruhan</a></li>
                <li><a href="#tab2" data-toggle="tab">Laporan Order</a></li>
                <li><a href="#tab3" data-toggle="tab">Laporan Pembagian</a></li>
            </ul>
        </div>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="tab1">
                <div class="tables">
                    <div class="row">
                        <h4 class="text-center" style="margin-top: 25px;">LAPORAN CONSUMABLE <?= strtoupper($bulanFull[date('n')] . " " . date('Y')) ?></h4>
                        <table class="table table-bordered table-responsive table-hover table-striped laporan">
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
                                        //echo "D";
                                    } else if (($d1['tgl'] < $d2['tgl'] or is_null($d2['tgl'])) and  !is_null($d1['tgl'])) {
                                        $awal = $d1['awal'];
                                        //echo "A";
                                    } else if (($d1['tgl'] > $d2['tgl'] || is_null($d1['tgl'])) and  !is_null($d2['tgl'])) {
                                        $awal = $d2['awal'];
                                        //echo "B";
                                    } else {
                                        $awal = $q['sisa'];
                                        //echo "C";
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
            <div role="tabpanel" class="tab-pane" id="tab2">
                <div class="tables">
                    <div class="row">
                        <h4 class="text-center">LAPORAN ORDER <?= strtoupper($bulanFull[date('n')] . " " . date('Y')) ?></h4>
                        <table class="table table-bordered table-hover table-responsive table-striped laporan">
                            <thead>
                                <tr class="info">
                                    <th>No.</th>
                                    <th>Consumable</th>
                                    <th>Tanggal Order</th>
                                    <th>Nomor PO</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Supplier</th>
                                    <th>Admin</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $date = date('Y-m-');
                                $sql = "SELECT * FROM order_consumable as a
                                            LEFT JOIN consumable as b ON a.id_consum = b.id
                                            LEFT JOIN users as c ON a.admin = c.id_user
                                            LEFT JOIN data_pemasok as d ON a.id_sup = d.id_sup
                                            WHERE tgl_order LIKE '$date%' ORDER BY tgl_order";
                                $query = $conn->query($sql);
                                $tot = mysqli_num_rows($query);
                                $totJumlah = 0;
                                $totHarga = 0;
                                while ($r = mysqli_fetch_assoc($query)) {
                                    $totJumlah += $r['jumlah'];
                                    $totHarga += $r['harga'];
                                ?>
                                    <tr>
                                        <td style="width: 50px;text-align: center;"><?= $no++ ?></td>
                                        <td><?= $r['nama_consumable'] ?></td>
                                        <td><?= $r['tgl_order'] ?></td>
                                        <td><?= $r['id_po'] ?></td>
                                        <td><?= $r['jumlah'] ?></td>
                                        <td>Rp.<?= harga($r['harga']) ?></td>
                                        <td><?= $r['nama_sup'] ?></td>
                                        <td><?= $r['nama'] ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr class="info">
                                    <th>Total</th>
                                    <td><?= $tot ?> Transaksi</td>
                                    <td> - </td>
                                    <td> - </td>
                                    <td><?= $totJumlah ?> Item</td>
                                    <td>Rp. <?= harga($totHarga) ?></td>
                                    <td> - </td>
                                    <td> - </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="tab3">
                <div class="tables">
                    <div class="row">
                        <h4 class="text-center">LAPORAN PEMBAGIAN <?= strtoupper($bulanFull[date('n')] . " " . date('Y')) ?></h4>
                        <table class="table table-bordered table-hover table-responsive table-striped laporan">
                            <thead>
                                <tr class="info">
                                    <th>No.</th>
                                    <th>Consumable</th>
                                    <th>Tanggal Dibagikan</th>
                                    <th>Jumlah</th>
                                    <th>Nama Karyawan</th>
                                    <th>Admin</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $date = date('Y-m-');
                                $sql = "SELECT * FROM consumable_user as a
                                            LEFT JOIN consumable as b ON a.id_consumable = b.id
                                            LEFT JOIN users as c ON a.id_user = c.id_user
                                            LEFT JOIN data_karyawan as d ON a.dibagikanke = d.nik
                                            WHERE tgldibagikan LIKE '$date%' ORDER BY tgldibagikan";
                                $query = $conn->query($sql);
                                $tot = mysqli_num_rows($query);
                                $totJumlah = 0;
                                while ($r = mysqli_fetch_assoc($query)) {
                                    $totJumlah += $r['qty'];
                                ?>
                                    <tr>
                                        <td style="width: 50px;text-align: center;"><?= $no++ ?></td>
                                        <td><?= $r['nama_consumable'] ?></td>
                                        <td><?= $r['tgldibagikan'] ?></td>
                                        <td><?= $r['qty'] ?></td>
                                        <td><?= $r['nama_karyawan'] ?></td>
                                        <td><?= $r['nama'] ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr class="info">
                                    <th>Total</th>
                                    <td><?= $tot ?> Transaksi</td>
                                    <td> - </td>
                                    <td><?= $totJumlah ?> Item</td>
                                    <td> - </td>
                                    <td> - </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>