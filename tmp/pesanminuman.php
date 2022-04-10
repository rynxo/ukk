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
$id_pes = $_GET['id_pes'];
$panggilmeja = $con->query("SELECT pesanan.*, meja.* FROM pesanan LEFT JOIN meja ON pesanan.id_meja = meja.id_meja WHERE id_pesanan = '$id_pes'");
$row = $panggilmeja->fetch_assoc();
$meja = $row['no_meja'];
// var_dump($meja) or die;
$pesanan = $con->query("SELECT detail_pesanan.*, masakan.* FROM detail_pesanan LEFT JOIN masakan ON detail_pesanan.id_masakan = masakan.id_masakan WHERE id_pesanan = '$id_pes'");
if (isset($_POST['submit'])) {
    $id_pes = $_GET['id_pes'];
    $id_mas = $_POST['id_masakan'];
    $qty = $_POST['qty'];
    $ket = $_POST['keterangan_pesanan'];

    $panggil = $con->query("SELECT harga FROM masakan WHERE id_masakan = '$id_mas'");
    $rego = $panggil->fetch_assoc();
    $harga = $rego['harga'] * $qty;
    $status = 'sedang dimasak';

    $panggilid = $con->query("SELECT MAX(id_detail) as maxid FROM detail_pesanan");
    $row = $panggilid->fetch_assoc();
    $last = $row['maxid'];
    $urutan = (int)substr($last, 3, 3);
    $urutan++;
    $huruf = 'DTL';
    $intine = $huruf . sprintf("%03s", $urutan);

    // var_dump($intine) or die;
    $con->query("INSERT INTO detail_pesanan VALUES ('$intine', '$id_pes', '$id_mas', '$qty', '$harga', '$ket', '$status')");
    echo "
    <script>
    window.location.href='pesanminuman.php?id_pes=$id_pes';
    </script>
    ";
}
if (isset($_POST['selesai'])) {
    $panggilpesanan = $con->query("SELECT SUM(sub_total) FROM detail_pesanan WHERE id_pesanan = '$id_pes'");
    $querypesanan = $panggilpesanan->fetch_assoc();
    $total = $querypesanan['SUM(sub_total)'];

    // var_dump($total) or die;
    $con->query("UPDATE pesanan SET total_harga = '$total' WHERE id_pesanan = '$id_pes'");
    // echo "
    // <script>
    // window.location.href='bla.php';
    // </script>
    // ";
}
if (isset($_POST['hapuspes'])) {
    $id = $_POST['id_pesanan'];
    $con->query("DELETE FROM detail_pesanan WHERE id_detail = '$id'");
    echo "
    <script>
    window.location.href='pesanmakanan.php?id_pes=$id_pes';
    </script>
    ";
    // var_dump($id) or die;
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Form Pemesanan Minuman</h1>
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
                    <h1 class="text-center"><b>MINUMAN</b></h1>
                    <ul class="nav nav-pills justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link" href="pesanmakanan.php?id_pes=<?= $id_pes; ?>">Makanan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="">Minuman</a>
                        </li>
                    </ul>
                    <div class="row">
                        <?php if ($row['status_pesanan'] == 'dimakan ditempat') { ?>
                            <h6 class="ml-auto" style="margin-bottom: -23px;">Meja <?= $meja; ?></h6>
                        <?php 
                    } else { ?>
                            <h6 class="ml-auto mt-2" style="margin-bottom: -23px;">Dibawa Pulang</h6>
                        <?php 
                    } ?>
                    </div>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="">Pilih Salah Satu!</label>
                            <select name="id_masakan" class="form-control" id="selek">
                                <?php $pakan = $con->query("SELECT * FROM masakan WHERE type = 'minuman'"); ?>
                                <?php while ($row = $pakan->fetch_assoc()) { ?>
                                    <option class="w-25" value="<?= $row['id_masakan']; ?>"><?= $row['nama_masakan']; ?> | Rp<?= number_format($row['harga'], 0, ",", ".") ?></option>
                                <?php 
                            } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="qty" class="">Jumlah</label>
                            <input type="number" name="qty" id="qty" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="keterangan_pesanan" class="">Pesan Tambahan</label>
                            <textarea type="number" name="keterangan_pesanan" id="keterangan_pesanan" class="form-control" placeholder="Pesan Tambahan"></textarea>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-danger m-2" name="submit">Tambahkan Pesanan</button>
                            <a class="btn btn-primary m-2" href="nota.php?id_pes=<?= $id_pes; ?>" onclick="return confirm('Sudah Selesai Pesan Kak?')">Selesai</a>
                        </div>
                    </form>
                    <hr>
                    <?php if (isset($pesanan)) {
                        ?>
                        <?php while ($row = $pesanan->fetch_assoc()) { ?>
                            <div class="row" style="margin-top: -25px;">
                                <div class="col-9">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $row['nama_masakan']; ?></h5>
                                        <p class="card-text"><?= $row['qty']; ?> <?= $row['nama_masakan']; ?> | Rp<?= number_format($row['sub_total'], 2, ",", '.') ?></p>
                                        <!-- <p class="card-text" style="margin: -20px 0 -2px 0; font-weight:bold; font-size:large"><?= $row['status_detail_masakan']; ?></p> -->
                                    </div>
                                </div>
                                <div class="col-3">
                                    <form action="" method="post">
                                        <div class="card-body m-2">
                                            <input type="hidden" name="id_pesanan" value="<?= $row['id_detail']; ?>">
                                            <!-- <a href="hapuspesanan.php?id_detail=<?= $row['id_detail']; ?>" class="card-"><i class="fas fa-trash"></i></a> -->
                                            <button name="hapuspes" onclick="return confirm('Apakah anda yakin ingin menghapus pesanan?')" class="btn btn-primary btn-sm"><i class="fas fa-trash"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php 
                    } ?>
                    <?php 
                } ?>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>

    </section>
    <!-- /.content -->
</div>
<?php include 'bawah.php'; ?>