<?php
include '../inc/headinc.php';

if (isset($_POST['daftar'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $user = htmlspecialchars($_POST['user']);


    // var_dump($core) or die;

    $cek = $con->query("SELECT * FROM user WHERE username = '$user'");

    if ($cek->num_rows === 0) {

        $pmax = $con->query("SELECT MAX(id_user) as maxid FROM user");
        $max = $pmax->fetch_assoc();
        $last = $max['maxid'];
        $urut = (int)substr($last, 3, 3);
        $urut++;
        $text = 'USR';
        $core = $text . sprintf("%03s", $urut);

        $pass = password_hash(1234, PASSWORD_DEFAULT);

        $con->query("INSERT INTO user VALUES('$core', '$nama', '$user', '$pass', 'Pembeli')");

        echo "
            <script>
            window.location.href='../core/pembeli.php';
            </script>
            ";

        // var_dump($pass, $core) or die;

    } else {
        $_SESSION['alert'] = 'Username tidak tersedia!';
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
                    <h1>Halaman Tambah Pembeli</h1>
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
                        <label for="exampleInputEmail1">Nama</label>
                        <input type="text" class="form-control" name="nama" id="exampleInputEmail1" placeholder="Masukkan Nama">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Pengguna</label>
                        <input type="text" class="form-control" name="user" id="exampleInputEmail1" placeholder="Masukkan Username">
                    </div>
                    <P>NB. Password default adalah <b>1234</b></P>
                    <div class="row">
                        <div class="col-6">
                            <a href="<?= BASE; ?>core/pembeli.php" class="btn btn-primary btn-sm">Kembali</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" name="daftar" class="float-right btn btn-success btn-sm">Daftar</button>
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