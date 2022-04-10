<?php
include '../inc/headinc.php';



$id = $_GET['id'];

$panggiluser = $con->query("SELECT * FROM user WHERE id_user = '$id'");
$row = $panggiluser->fetch_assoc();

if ($row['level'] == 'Pembeli') {
}

if (isset($_POST['edit'])) {
    $id = $row['id_user'];
    $nama = $_POST['nama'];
    $user = $_POST['user'];
    $peran = $_POST['peran'];

    $con->query("UPDATE user SET nama = '$nama', username = '$user', level = '$peran' WHERE id_user = '$id'");
    echo "
    <script>
    window.location.href='../core/user.php';
    </script>
    ";
    $_SESSION['berhasil'] = '
    <div class="alert alert-success">
    User berhasil diedit!
    </div>
    ';
}


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
                        <input type="text" class="form-control" name="nama" id="exampleInputEmail1" value="<?= $row['nama']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Pengguna</label>
                        <input type="text" class="form-control" name="user" id="exampleInputEmail1" value="<?= $row['username']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect2">Peran</label>
                        <select class="form-control" name="peran" id="exampleFormControlSelect2">
                            <option value="<?= $row['level']; ?>"><?= $row['level']; ?></option>
                            <?php if ($row['level'] == 'Kasir') { ?>
                                <option value="Waiter">Waiter</option>
                                <option value="Admin">Admin</option>
                            <?php } elseif ($row['level'] == 'Waiter') { ?>
                                <option value="Kasir">Kasir</option>
                                <option value="Admin">Admin</option>
                            <?php } else { ?>
                                <option value="Kasir">Kasir</option>
                                <option value="Waiter">Waiter</option>
                                <option value="Admin">Admin</option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <a href="<?= BASE; ?>core/user.php" class="btn btn-primary btn-sm">Kembali</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" name="edit" class="float-right btn btn-success btn-sm">Edit User</button>
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