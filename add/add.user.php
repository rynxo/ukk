<?php
include '../inc/headinc.php';

if (isset($_POST['daftar'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $user = htmlspecialchars($_POST['user']);
    $peran = htmlspecialchars($_POST['peran']);
    $pass1 = htmlspecialchars($_POST['pass1']);
    $pass2 = htmlspecialchars($_POST['pass2']);


    // var_dump($core) or die;

    $cek = $con->query("SELECT * FROM user WHERE username = '$user'");

    if ($cek->num_rows === 0) {

        if ($pass1 == $pass2) {

            $pmax = $con->query("SELECT MAX(id_user) as maxid FROM user");
            $max = $pmax->fetch_assoc();
            $last = $max['maxid'];
            $urut = (int)substr($last, 3, 3);
            $urut++;
            $text = 'USR';
            $core = $text . sprintf("%03s", $urut);

            $pass = password_hash($pass1, PASSWORD_DEFAULT);

            $con->query("INSERT INTO user VALUES('$core', '$nama', '$user', '$pass', '$level')");

            echo "
            <script>
            window.location.href='../core/user.php';
            </script>
            ";

            $_SESSION['berhasil'] = '
            <div class="alert alert-success">
            User berhasil ditambahkan!
            </div>
            ';
            // var_dump($pass, $core) or die;
        } else {
            $_SESSION['alert'] = 'Password tidak sesuai!';
        }
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
                    <h1>Halaman Tambah User</h1>
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
                    <div class="form-group">
                        <label for="exampleFormControlSelect2">Peran</label>
                        <select class="form-control" name="peran" id="exampleFormControlSelect2">
                            <option value="" selected disabled>- Pilih -</option>
                            <option value="Pembeli">Pembeli</option>
                            <option value="Kasir">Kasir</option>
                            <option value="Waiter">Waiter</option>
                            <option value="Admin">Admin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="pw1" name="pass1" placeholder="Password">
                        <input type="checkbox" onclick="lihatPass()"> Lihat Password
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="pw2" name="pass2" placeholder="Password">
                        <input type="checkbox" onclick="myFunction()"> Lihat Password
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <a href="<?= BASE; ?>core/user.php" class="btn btn-primary btn-sm">Kembali</a>
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
<script>
    function lihatPass() {
        var x = document.getElementById("pw1");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
<script>
    function myFunction() {
        var x = document.getElementById("pw2");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
<?php include '../inc/footinc.php'; ?>