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
                <li><a href="#tab4" data-toggle="tab">Grafik Laporan</a></li>
            </ul>
        </div>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="tab1">
                <div class="tables">
                    <div class="row">
                        <h4 class="text-center" style="margin-top: 25px;">LAPORAN KOMPONEN <?= strtoupper($bulanFull[date('n')] . " " . date('Y')) ?></h4>
                        <table id="allKomp" class="table table-bordered table-responsive table-hover table-striped">
                            <thead>
                                <tr class="info">
                                    <th style="width: 50px;">No.</th>
                                    <th>Komponen</th>
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
                                $query = $conn->query("SELECT id,sisa,nama_komponen as nama FROM komponen");
                                while ($q = mysqli_fetch_assoc($query)) {
                                    $awal;
                                    $d1 = mysqli_fetch_assoc($conn->query("SELECT tgl_order as tgl,stok_temp - jumlah as awal FROM order_komponen WHERE tgl_order LIKE '$date%' AND id_komp = ${q['id']} ORDER BY tgl_order LIMIT 1"));
                                    $d2 = mysqli_fetch_assoc($conn->query("SELECT tgldibagikan as tgl,stok_temp + qty as awal FROM komponen_aset WHERE tgldibagikan LIKE '$date%' AND id_komponen = ${q['id']} ORDER BY tgldibagikan LIMIT 1"));
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
                                    $order = mysqli_fetch_assoc($conn->query("SELECT SUM(jumlah) as ord FROM order_komponen WHERE id_komp = ${q['id']} AND tgl_order LIKE '$date%'"));
                                    $bagi = mysqli_fetch_assoc($conn->query("SELECT SUM(qty) as bagi FROM komponen_aset WHERE id_komponen = ${q['id']} AND tgldibagikan LIKE '$date%'"));
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><a href="komponen-detail?id=<?= $q['id'] ?>" title="Detail Aset"><?= $q['nama'] ?></a></td>
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
                        <table id="orderKomp" class="table table-bordered table-hover table-responsive table-striped">
                            <thead>
                                <tr class="info">
                                    <th>No.</th>
                                    <th>komponen</th>
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
                                $sql = "SELECT * FROM order_komponen as a
                                            LEFT JOIN komponen as b ON a.id_komp = b.id
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
                                        <td><a href="komponen-detail?id=<?= $r['id'] ?>" title="Detail Aset"><?= $r['nama_komponen'] ?></a></td>
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
                        <table id="bagiKomp" class="table table-bordered table-hover table-responsive table-striped">
                            <thead>
                                <tr class="info">
                                    <th>No.</th>
                                    <th>Komponen</th>
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
                                $sql = "SELECT * FROM komponen_aset as a
                                            LEFT JOIN komponen as b ON a.id_komponen = b.id
                                            LEFT JOIN users as c ON a.id_user = c.id_user
                                            LEFT JOIN data_aset as d ON a.id_aset = d.no
                                            WHERE tgldibagikan LIKE '$date%' ORDER BY tgldibagikan";
                                $query = $conn->query($sql);
                                $tot = mysqli_num_rows($query);
                                $totJumlah = 0;
                                while ($r = mysqli_fetch_assoc($query)) {
                                    $totJumlah += $r['qty'];
                                ?>
                                    <tr>
                                        <td style="width: 50px;text-align: center;"><?= $no++ ?></td>
                                        <td><a href="komponen-detail?id=<?= $r['id'] ?>" title="Detail Aset"><?= $r['nama_komponen'] ?></a></td>
                                        <td><?= $r['tgldibagikan'] ?></td>
                                        <td><?= $r['qty'] ?></td>
                                        <td><?= $r['no_aset'] ?></td>
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
            <!-- GRAFIK LAPORAN -->
            <div class="tab-pane" id="tab4" role="tabpanel">
                <div class="row">
                    <div style="width: 1000px;margin: auto;margin-top: 15px;margin-bottom: 15px;">
                        <div class="row">
                            <button id="cetakKompOrder" class="btn btn-default pull-right" type="button">Cetak</button>
                        </div>
                        <div id="laporanKompOrder" style="width: 1000px;"></div>
                    </div>
                </div>
                <div class="row">
                    <div style="width: 1000px;margin: auto;margin-top: 15px;margin-bottom: 15px;">
                        <div class="row">
                            <button id="cetakKompBagi" class="btn btn-default pull-right" type="button">Cetak</button>
                        </div>
                        <div id="laporanKompBagi" style="width: 1000px;"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        $('#bagiKomp').DataTable({
            "ordering": true,
            "searchable": true,
            dom: 'Blftr',
            "lengthMenu": [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            buttons: [{
                extend: 'print',
                text: '<span class="fa fa-print" aria-hidden="true"></span>',
                titleAttr: 'Print',
                columns: ':not(.select-checkbox)',
                orientation: 'landscape'
            }, {
                extend: "excel",
                title: "LAPORAN PEMBAGIAN KOMPONEN <?= strtoupper($bulanFull[date('n')]) . " " . date('Y') ?>"
            }, 'copy', 'csv', 'pdf']
        });
        $('#orderKomp').DataTable({
            "ordering": true,
            "searchable": true,
            dom: 'Blftr',
            "lengthMenu": [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            buttons: [{
                extend: 'print',
                text: '<span class="fa fa-print" aria-hidden="true"></span>',
                titleAttr: 'Print',
                columns: ':not(.select-checkbox)',
                orientation: 'landscape'
            }, {
                extend: "excel",
                title: "LAPORAN ORDER KOMPONEN <?= strtoupper($bulanFull[date('n')]) . " " . date('Y') ?>"
            }, 'copy', 'csv', 'pdf']
        });
        $('#allKomp').DataTable({
            "ordering": true,
            "searchable": true,
            dom: 'Blftr',
            "lengthMenu": [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            buttons: [{
                extend: 'print',
                text: '<span class="fa fa-print" aria-hidden="true"></span>',
                titleAttr: 'Print',
                columns: ':not(.select-checkbox)',
                orientation: 'landscape'
            }, {
                extend: "excel",
                title: "LAPORAN KOMPONEN <?= strtoupper($bulanFull[date('n')]) . " " . date('Y') ?>"
            }, 'copy', 'csv', 'pdf']
        });

        google.charts.load('current', {
			'packages': ['corechart', 'bar']
		});

        google.charts.setOnLoadCallback(function() {
            drawKompOrder();
            drawKompBagi();
        })

        function drawKompOrder() {
            let json = $.ajax({
                url: "template/chart.php",
                type: "POST",
                dataType: "json",
                data: {
                    'KompOrder': "1"
                },
                async: false
            }).responseText;
            var data = google.visualization.arrayToDataTable($.parseJSON(json));

            var options = {
                title: "LAPORAN KOMPONEN ORDER <?= strtoupper($bulanFull[date('n')]) . " " . date('Y') ?>",
                titlePosition: "out",
                width: 1000,
                height: 350,
                legend: {
                    position: 'none'
                },
                animation: {
                    startup: true,
                    duration: 1000,
                    easing: 'out',
                },
                hAxis: {
                    title: 'Tanggal'
                },
                vAxis: {
                    title: 'Order',
                    minValue: 0
                },
                bar: {
                    groupWidth: "75%"
                },
            };

            var div = document.getElementById('laporanKompOrder');
            var barChart = new google.visualization.ColumnChart(div);

            google.visualization.events.addListener(barChart, "ready", function() {
                var btn = document.getElementById('cetakKompOrder');

                $(btn).on("click", function() {

                    var url = barChart.getImageURI().replace("data:image/png;base64,", "");
                    console.log(url)
                    var byte = base64ToArrayBuffer(url);
                    var blob = new Blob([byte], {
                        type: "image/jpeg"
                    });
                    window.open(URL.createObjectURL(blob), "_blank");
                })
            })
            barChart.draw(data, options);
        }
        //CHART LAPORAN KOMPONEN BAGI
        function drawKompBagi() {
            let json = $.ajax({
                url: "template/chart.php",
                type: "POST",
                dataType: "json",
                data: {
                    'KompBagi': "1"
                },
                async: false
            }).responseText;
            var data = google.visualization.arrayToDataTable($.parseJSON(json));

            var options = {
                title: "LAPORAN KOMPONEN PEMBAGIAN <?= strtoupper($bulanFull[date('n')]) . " " . date('Y') ?>",
                titlePosition: "out",
                width: 1000,
                height: 350,
                legend: {
                    position: 'none'
                },
                animation: {
                    startup: true,
                    duration: 1000,
                    easing: 'out',
                },
                hAxis: {
                    title: 'Tanggal'
                },
                vAxis: {
                    title: 'Dibagikan',
                    minValue: 0
                },
                bar: {
                    groupWidth: "75%"
                },
            };

            var div = document.getElementById('laporanKompBagi');
            var barChart = new google.visualization.ColumnChart(div);

            google.visualization.events.addListener(barChart, "ready", function() {
                var btn = document.getElementById('cetakKompBagi');

                $(btn).on("click", function() {

                    var url = barChart.getImageURI().replace("data:image/png;base64,", "");
                    console.log(url)
                    var byte = base64ToArrayBuffer(url);
                    var blob = new Blob([byte], {
                        type: "image/jpeg"
                    });
                    window.open(URL.createObjectURL(blob), "_blank");
                })
            })
            barChart.draw(data, options);
        }


    })
</script>