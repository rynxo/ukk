<?php
include '../inc/header.php';

$query = $con->query("SELECT pesanan.*, meja.*, user.* FROM pesanan INNER JOIN meja ON meja.id_meja = pesanan.id_meja INNER JOIN user ON pesanan.id_user = user.id_user ORDER BY tgl_pesanan DESC");
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Halaman User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Halaman User</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <?php if (isset($_SESSION['berhasil'])) { ?>
                <div class="m-3 col-4">
                    <?= $_SESSION['berhasil'];
                    unset($_SESSION['berhasil'])
                    ?>
                </div>
            <?php } ?>
            <div class="card-header">
                <a href="<?= BASE; ?>add/add.user.php" class="m-1 btn btn-primary" style="margin: 0 10px -10px 0;"><B>TAMBAH USER</B></a>
            </div>
            <div class="card-body" style="margin-top: -5px;">
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width='1'>No</th>
                            <th>Tanggal Pemesanan</th>
                            <th>Nama Pembeli</th>
                            <th>No Meja</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        while ($row = $query->fetch_assoc()) { ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $row['tgl_pesanan']; ?></td>
                                <td><?= $row['nama']; ?></td>
                                <?php if ($row['no_meja'] == 0) { ?>
                                    <td>Dibawa Pulang</td>
                                <?php } else { ?>
                                    <td><?= $row['no_meja']; ?></td>
                                <?php } ?>
                                <td>Rp<?= number_format($row['total_harga'], 0, ",", "."); ?></td>
                                <td>
                                    <a href="<?= BASE; ?>delete/delete.user.php?id=<?= $row['id_user']; ?>" onclick="return confirm('apakah anda yakin?')" class="btn btn-dark btn-sm"><i class="fas fa-trash"></i> HAPUS</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                Footer
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include '../inc/footer.php'; ?>