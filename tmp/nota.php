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
$id_user = $_SESSION['id_user'];
// var_dump($id_user) or die;
$id_pes = $_GET['id_pes'];
$pesanan = $con->query("SELECT detail_pesanan.*, masakan.* FROM detail_pesanan LEFT JOIN masakan ON detail_pesanan.id_masakan = masakan.id_masakan WHERE id_pesanan = '$id_pes'");
if (isset($_GET['id_pes'])) {
    $pesan = $con->query("SELECT SUM(sub_total) FROM detail_pesanan WHERE id_pesanan = '$id_pes'");
    $bayar = $pesan->fetch_assoc();

    $total = $bayar['SUM(sub_total)'];


    $panggilpesan = $con->query("SELECT pesanan.*, meja.* FROM pesanan LEFT JOIN meja ON pesanan.id_meja = meja.id_meja WHERE id_pesanan = '$id_pes'");
    $pes = $panggilpesan->fetch_assoc();
    $remeja = $pes['id_meja'];
    $no = $pes['no_meja'];
    if ($remeja == 1) {
        $meja = 'Dibawa Pulang';
    } else {
        // var_dump($remeja) or die;
        $meja = "MEJA $no";
    }

    // $con->query("UPDATE pesanan SET total_harga = '$total' WHERE id_pesanan = '$id_pes'");
    if ($total == 0 || null) {

        $_SESSION['alert'] = 'Segera pesan untuk menyelesaikan pemesanan!!';
        echo "
        <script>
        window.location.href='pesanmakanan.php?id_pes=$id_pes';
        </script>
        ";
    } else {
        $con->query("UPDATE pesanan SET total_harga = '$total' WHERE id_pesanan = '$id_pes'");
        $p = $con->query("DELETE FROM pesanan WHERE total_harga IS NULL and id_user = '$id_user' ");
        // var_dump($p) or die;
    }
}
if (isset($_POST['kembali'])) {
    if (isset($_SESSION['tumbas'])) {
        echo "
        <script>
        window.location.href='akun.php';
        </script>
        ";
    } else {
        echo "
        <script>
        window.location.href='index.php';
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
                    <img src="img/LOGORT.png" width="200" style="display:block; margin:0 auto 5px auto" alt="">
                    <h6 class="text-center"><?= $pes['tgl_pesanan']; ?></h6>
                    <hr>
                    <div class="row">
                        <h5 class="ml-auto"><?= $meja; ?></h5>

                    </div>
                    <?php if (isset($pesanan)) {
                    ?>
                        <?php while ($row = $pesanan->fetch_assoc()) { ?>
                            <?php if ($row['keterangan_pesanan'] == '') {
                                $ket = 'Tidak ada keterangan tambahan';
                            } else {
                                $ket = $row['keterangan_pesanan'];
                            } ?>
                            <div class="row" style="margin-top: -25px;">
                                <div class="col-12">
                                    <div class="card-body">
                                        <h5 class="card-title text-uppercase"><b><?= $row['nama_masakan']; ?></b></h5>
                                        <p class="card-text"><?= $row['qty']; ?> <?= $row['nama_masakan']; ?> | Rp<?= number_format($row['sub_total'], 2, ",", '.') ?></p>
                                        <p class="card-text" style="margin: -17px 0 0 0; font-size: 12px"><?= $ket ?></p>
                                        <!-- <p class="card-text" style="margin: -20px 0 -2px 0; font-weight:bold; font-size:large"><?= $row['status_detail_masakan']; ?></p> -->
                                    </div>
                                </div>
                            </div>
                        <?php
                        } ?>
                    <?php
                    } ?>
                    <hr>
                    <div class="">
                        <div class="card-body" style="margin-top: -20px;">
                            <h5 class="card-title mb-4">Total Harga : Rp<?= number_format($total, 2, ",", "."); ?></h5>
                            <p class="card-text text-center">Terima kasih telah melakukan pemesanan mandiri</p>
                        </div>
                    </div>
                    <!-- Rp<?= number_format($total, 2, ",", "."); ?> -->
                </div>
                <!-- /.card-body -->
                <form action="" method="post">
                    <div class="mb-3 ml-2">
                        <button name="kembali" class="btn btn-primary">Home</button>
                        <a href="cetak.php?id_pes=<?= $id_pes; ?>" onclick="return confirm('Apakah anda ingin mencetak nota?')" class="btn btn-success">Cetak Nota</a>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>

    </section>
    <!-- /.content -->
</div>
<?php include 'bawah.php' ?>