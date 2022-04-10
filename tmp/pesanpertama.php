<?php include 'atas.php';
if (!isset($_SESSION['tumbas'])) {
    if (!isset($_SESSION['mlebuk'])) {
        echo "
        <script>
        window.location.href='login.php';
        </script>
        ";
        exit;
    }
}
if (isset($_POST['bali'])) {
    if (isset($_SESSION['mlebuk'])) {
        echo "
        <script>
        window.location.href='index.php';
        </script>
        ";
    } elseif (isset($_SESSION['tumbas'])) {
        echo "
        <script>
        window.location.href='akun.php';
        </script>
        ";
    }
}
if (isset($_POST['submit'])) {
    $user = $_SESSION['id_user'];
    $status = $_POST['status_pesanan'];
    $meja = $_POST['meja'];
    $tanggal = date('Y-m-d');
    // $panggil = $con->query("SELECT * FROM pesanan ORDER BY id_pesanan DESC limit 1");
    // $row = $panggil->fetch_assoc();
    // $lastid = $row['id_pesanan'];
    // if ($lastid == '') {
    //     $idsakir = "PSN1";
    // } else {
    //     $id_pes = substr($lastid, 3);
    //     $id_pes = intval($id_pes);
    //     $idsakir = "PSN" . ($id_pes + 1);
    // }
    $panggil = $con->query("SELECT MAX(id_pesanan) as maxid FROM pesanan");
    $row = $panggil->fetch_assoc();
    $lastid = $row['maxid'];
    $urutan = (int)substr($lastid, 3, 3);
    $urutan++;
    $huruf = "PSN";
    $id = $huruf . sprintf("%03s", $urutan);
    // var_dump($_POST) or die;
    if ($status == 'dibawa pulang') {
        // var_dump($status) or die;
        $CEK = $con->query("INSERT INTO pesanan VALUES ('$id', '$tanggal', '$user', 1 , NULL, '$status')");
        echo "
        <script>
        window.location.href='pesanmakanan.php?id_pes=$id';
        </script>
        ";
    } else {
        // var_dump($meja) or die;
        $CEK = $con->query("INSERT INTO pesanan VALUES ('$id', '$tanggal', '$user', '$meja', NULL, '$status')");
        echo "
        <script>
        window.location.href='pesanmakanan.php?id_pes=$id';
        </script>
        ";
    }
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>PHP</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Resto Kita</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="d-flex justify-content-center">
            <div class="card col-lg-3 col-12">
                <div class="card-body">
                    <h1 class="text-center">RESTO KITA</h1>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="">Pilih Salah Satu!</label>
                            <select name="status_pesanan" class="form-control" id="selek">
                                <option value="dimakan ditempat">Dimakan Ditempat</option>
                                <option value="dibawa pulang">Dibawa Pulang</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Pilih Meja!</label>
                            <select name="meja" class="form-control">
                                <?php $mejo = $con->query("SELECT * FROM meja WHERE status_meja = 'kosong'");
                                while ($row = $mejo->fetch_assoc()) {
                                ?>
                                    <option class="w-25" value="<?= $row['id_meja']; ?>">MEJA <?= $row['no_meja']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="row justify-content-between">
                            <button class="btn btn-primary m-2" name="bali">Kembali</button>
                            <button class="btn btn-primary m-2" name="submit">Selanjutnya</button>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>

    </section>
    <!-- /.content -->
</div>
<?php include 'bawah.php'; ?>