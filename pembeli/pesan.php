<?php
include '../inc/headinc.php';

if (isset($_POST['tambah'])) {
    // var_dump($_POST) or die(mysqli_error($con));

    $nama_masakan = htmlspecialchars($_POST['nama']);
    $harga = htmlspecialchars($_POST['harga']);
    $type = htmlspecialchars($_POST['jenis']);
    $status_masakan = 'tersedia';

    if ($harga > 0) {
        $panggil = $con->query("SELECT MAX(id_masakan) as maxid FROM masakan");
        $row = $panggil->fetch_assoc();
        $last = $row['maxid'];
        $urut = (int)substr($last, 3, 3);
        $urut++;
        $kata = 'MKN';
        $core = $kata . sprintf("%03s", $urut);
        // var_dump($core) or die;



        $con->query("INSERT INTO masakan (id_masakan, nama_masakan, type, status_masakan, harga) VALUES ('$core', '$nama_masakan', '$type', 'tersedia', '$harga')");
        echo "
        <script>
        document.location='../core/menu.php';
        </script>
        ";
        $_SESSION['berhasil'] = '
        <div class="alert alert-success">
        Menu berhasil ditambahkan!
        </div>
        ';
    } else {
        $_SESSION['alert'] = '
        Masukkan harga yang benar!
        ';
    }
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="container col-6">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pesan Sekarang!</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card container">
            <div class="card-body" style="margin-top: -5px;">
                <?php if (isset($_SESSION['alert'])) { ?>
                    <div class="alert alert-danger">
                        <?= $_SESSION['alert'];
                        unset($_SESSION['alert']) ?>
                    </div>
                <?php } ?>
                <form method="POST">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Menu</label>
                        <input type="text" class="form-control" name="nama" id="exampleInputEmail1" placeholder="Masukkan Nama" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Harga</label>
                        <input type="number" class="form-control" min="0" name="harga" id="exampleInputEmail1" placeholder="Masukkan Harga" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect2">Jenis Menu</label>
                        <select class="form-control" name="jenis" id="exampleFormControlSelect2" required>
                            <option value="" selected disabled>- Pilih -</option>
                            <option value="makanan">Makanan</option>
                            <option value="minuman">Minuman</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <a href="<?= BASE; ?>core/menu.php" class="btn btn-primary btn-sm">Kembali</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" name="tambah" class="float-right btn btn-success btn-sm">Selanjutnya</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include '../inc/footinc.php'; ?>