<?php

if (isset($_POST['minta'])) {
    $sql = $conn->query("SELECT * FROM data_kategori");
    $id = $_POST['uker'];
    $data = [];
    $idx = 0;
    while ($r = mysqli_fetch_assoc($sql)) {
        $data[$idx] = [];
        $data[$idx]['nama'] = $r['kd_kategori'];
        $data[$idx]['value'] = $_POST[$r['kd_kategori']];
        $idx++;
    }

    $insert = "INSERT INTO kebutuhan VALUES ('',?,?,?)";
    $update = "UPDATE kebutuhan SET qty = ? WHERE id_uker = ? AND id_kategori = ?";
    $check = "SELECT * FROM kebutuhan WHERE id_uker = '$id'";

    //CHECK DATA
    if ($conn->query($check)->num_rows > 0) {
    } else {
        $stmt = $conn->prepare($insert);
        $stmt->bind_param("sss", $uker, $kd, $qty);
        $stat = true;
        $message = "";
        foreach ($data as $k => $v) {
            $uker = $id;
            $kd = $v['nama'];
            $qty = $v['value'];

            if (!$stmt->execute()) {
                $stat = false;
                $message .= $conn->error;
            }
        }

        if ($stat) {
            echo "<script>alert('Permintaan berhasil ditambahkan');window.location='lokasi'</script>";
        } else {
            echo "<script>alert('$message')</script>";
        }
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}else{
    $id = "null";
}

?>

<section class="content-header">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center">FORM PERMINTAAN ASET</h2>
        </div>
    </div>
</section>
<section class="content">
    <div id="webui">
        <div class="row">
            <div class="col-md-12">
                <form action="" method="POST" class="form-horizontal" role="form">
                    <div style="width: 50%;margin: auto;" class="panel widget-shadow">
                        <div class="panel-body" style="margin-top: 30px;">
                            <div class="form-group">
                                <label for="uker" class="col-md-3 control-label">Departemen</label>
                                <div class="col-md-8">
                                    <select name="uker" class="form-control select2" title="Silahkan Pilih ..." required>
                                        <option selected disabled>Silahkan Pilih ...</option>
                                        <?php
                                        $q = $conn->query("SELECT * FROM data_uker");
                                        while ($r = $q->fetch_assoc()) { ?>
                                            <option value="<?= $r['kd_uker'] ?>" <?= $id == $r['kd_uker'] ? "selected" : ""; ?>><?= $r['kd_uker'] . " - " . $r['nama_uker'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <?php
                            $sql = "SELECT * FROM data_kategori";
                            $q = $conn->query($sql);
                            while ($r = $q->fetch_assoc()) { ?>
                                <div class="form-group col-md-6">
                                    <label for="" class="col-md-8 control-label"><?= ucfirst($r['nama_kategori']) ?></label>
                                    <div class="col-md-4">
                                        <input type="number" min="0" value="0" name="<?= $r['kd_kategori'] ?>" id="" class="form-control" placeholder="" aria-describedby="helpId">
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="panel-footer">
                            <div class="form-group with-border">
                                <div class="col-sm-offset-8 col-sm-4">
                                    <button type="reset" class="btn btn-danger">Reset</button>
                                    <button type="submit" name="minta" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>