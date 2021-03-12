<?php

if (isset($_POST["addLokasi"])) {
    $message = "Data berhasil ditambahkan";
    $kode_uker = $_POST["kd_uker"];
    $nama_uker = $_POST["nm_uker"];


    $sql = mysqli_prepare($conn, "INSERT INTO data_uker (kd_uker,nama_uker) VALUES (?,?)");
    $sql->bind_param("ss", $kode_uker, $nama_uker);

    if ($sql->execute()) {
        if (isset($_POST["kd_bag"])) {
            $kode_bag = $_POST["kd_bag"];
            $nama_bag = $_POST["nm_bag"];
            for ($i = 0; $i < count($kode_bag); $i++) {
                $sql = mysqli_prepare($conn, "INSERT INTO data_uker_bagian (kd_uker,kd_bag,nama_bag) VALUES (?,?,?)");
                $sql->bind_param("sss", $kode_uker, $kode_bag[$i], $nama_bag[$i]);
                if(!$sql->execute()){
                    $message = "Data tidak berhasil ditambahkan";
                }
            }
            echo "<script type='text/javascript'>alert(\"".$message."\")</script>";
        }
    } else {
         echo "<script type='text/javascript'>alert(\"".mysqli_error($conn)."\")</script>";
    }
}

?>
<section class="content">
    <div class="webui">
        <div class="row">
            <div class="col-md-8  col-md-offset-2">
                <div class="box box-default">
                    <form id="addNewUnitKerja" class="form-horizontal" method="post" action="" role="form" enctype="multipart/form-data">
                        <div class="box-header with-border">
                            <h2 class="box-title"><b>Tambah Unit Kerja Baru</b></h2>
                            <div class="box-tools pull-right">
                                <a href="<?php if (isset($_SERVER['HTTP_REFERER'])) {
                                                echo $_SERVER['HTTP_REFERER'];
                                            } ?>" class="btn btn-success">Batal</a>

                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div class="form-group ">
                                <label for="name" class="col-md-3 control-label">Kode Unit Kerja</label>
                                <div class="col-md-7 col-sm-12 required">
                                    <input class="form-control" type="text" name="kd_uker" id="kd_uker" value="" required />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="name" class="col-md-3 control-label">Nama Unit Kerja</label>
                                <div class="col-md-7 col-sm-12 required">
                                    <input class="form-control" type="text" name="nm_uker" id="nm_uker" value="" required />
                                </div>
                            </div>


                        </div>
                        <div class="box-header with-border">
                            <h2 class="box-title"><b>Tambah Unit Kerja Bagian</b></h2>
                            <div class="box-tools pull-right">
                                <a id="tambahbag" class="btn btn-primary">Tambah Bagian</a>

                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body" id="bagian-form">
                        </div>
                        <div class="box-footer text-right">
                            <button type="submit" name="addLokasi" id="addLokasi" class="btn btn-success"><i class="fa fa-check icon-white"></i> Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>