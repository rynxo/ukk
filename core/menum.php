<?php
include '../inc/header.php';

$query = $con->query("SELECT * FROM masakan WHERE type != 'makanan'");
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Halaman Menu</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Halaman Menu</a></li>
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
                <ul class="nav justify-content-between">
                    <li>
                        <a href="<?= BASE; ?>add/add.menu.php" class="m-1 btn btn-primary" style="margin: 0 10px -10px 0;"><B>TAMBAH MENU</B></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="menu.php">Halaman Makanan</a>
                    </li>
                </ul>
            </div>
            <div class="card-body" style="margin-top: -5px;">
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width='1'>No</th>
                            <th>Nama</th>
                            <th>Nama Pengguna</th>
                            <th width='150'>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        while ($row = $query->fetch_assoc()) { ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $row['nama_masakan']; ?></td>
                                <td>Rp<?= number_format($row['harga'], 0, ",", "."); ?>
                                </td>
                                <td>
                                    <a href="<?= BASE; ?>edit/edit.user.php?id=<?= $row['id_user']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-pen"></i> EDIT</a>
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