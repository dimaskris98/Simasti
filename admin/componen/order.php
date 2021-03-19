<?php
if (isset($_POST['submit'])) {
    $id_komp = $_POST['id_komp'];
    $id_po = $_POST['id_po'];
    $id_sup = $_POST['id_sup'];
    $jml = $_POST['jml'];
    $harga = $_POST['harga'];
    $catatan = $_POST['catatan'];

    $stat = true;
    $message = "";

    $stok = mysqli_fetch_assoc(mysqli_query($conn, "SELECT sisa FROM komponen WHERE id = '$id_komp'"));
    $stok = $stok['sisa'] + $jml;
    $stmt = $conn->prepare("INSERT INTO order_komponen  VALUES ('',?,DEFAULT,?,?,?,?,?,?,?)");
    $stmt->bind_param("iiiiiiis", $id_po, $id_komp, $jml,$harga, $stok, $id_user, $id_sup,$catatan);
    if ($stmt->execute()) {
        $stmt = $conn->prepare("UPDATE komponen SET sisa = ? WHERE id = ? ");
        $stmt->bind_param("ii", $stok, $id_komp);
        if ($stmt->execute()) {
            echo "<script>
                    alert('Order berhasil ditambahkan');
                    window.location = 'komponen'
                </script>";
        } else {
            $stat = false;
            $message = $conn->error();
        }
    } else {
        $stat = false;
        $message = $conn->error();
    }

    if (!$stat) {
        echo "<script> alert('$message') </script>";
    }
}

?>

<section class="content-header">
    <h1 class="pull-left">
    </h1>
    <div class="pull-right">
    </div>
</section>
<section class="content">
    <div id="webui">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="box box-default">
                    <form action="" method="post" class="form-horizontal">
                        <div class="box-header with-border">
                            <h2 class="box-title">
                                Order Komponen
                            </h2>
                            <div class="box-tools pull-right">
                                <a href="<?php if (isset($_SERVER['HTTP_REFERER'])) {
                                                echo $_SERVER['HTTP_REFERER'];
                                            } ?>" class="btn btn-success">Batal</a>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="id_con" class="control-label col-md-3">Komponen</label>
                                <div class="col-md-7 required">
                                    <select name="id_komp" id="id_komp" title="Pilih Komponen" class="form-control select2" required>
                                        <option value=""></option>
                                        <?php
                                        $sql = "SELECT id,nama_komponen as nama FROM komponen";
                                        $query = $conn->query($sql);
                                        while ($row = mysqli_fetch_assoc($query)) { ?>
                                            <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="id_con" class="control-label col-md-3">Nomor PO</label>
                                <div class="col-md-7 required">
                                    <input type="text" name="id_po" id="id_po" class="form-control" value="" required="required" title="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="id_con" class="control-label col-md-3">Pemasok</label>
                                <div class="col-md-7">
                                    <select name="id_sup" id="id_sup" title="Pilih Consumable" class="form-control select2">
                                        <option value=""></option>
                                        <?php
                                        $sql = "SELECT id_sup,nama_sup as nama FROM data_pemasok";
                                        $query = $conn->query($sql);
                                        while ($row = mysqli_fetch_assoc($query)) { ?>
                                            <option value="<?= $row['id_sup'] ?>"><?= $row['nama'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#popsupplier" data-whatever="@mdo">Baru</button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="id_con" class="control-label col-md-3">Jumlah</label>
                                <div class="col-md-3 required">
                                    <div class="input-group">
                                        <input type="number" name="jml" id="jml" class="form-control" value="" required="required" pattern="" title="">
                                        <span class="input-group-addon">PCS</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="id_con" class="control-label col-md-3">Harga</label>
                                <div class="col-md-3 required">
                                    <div class="input-group">
                                        <input type="number" name="harga" id="harga" class="form-control" value="" required="required" pattern="" title="">
                                        <span class="input-group-addon">IDR</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="id_con" class="control-label col-md-3">Catatan</label>
                                <div class="col-md-7">
                                    <textarea class="form-control" name="catatan" id="catatan" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer with-border">
                            <div class="form-group">
                                <div class="col-md-3 col-md-offset-9">
                                    <button type="reset" class="btn btn-danger" name="submit">Reset</button>
                                    <button type="submit" class="btn btn-success" name="submit">Submit</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>