<?php
include '../inc/header.php';

$query = $con->query("SELECT * FROM meja WHERE id_meja != 1");
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
                <a href="<?= BASE; ?>add/add.meja.php" onclick="return confirm('Apakah anda ingin menambahkan meja')" class="m-1 btn btn-primary" style="margin: 0 10px -10px 0;"><B>TAMBAH MEJA</B></a>
            </div>
            <div class="card-body" style="margin-top: -5px;">
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width='1'>No</th>
                            <th>Nomor Meja</th>
                            <th>Status Meja</th>
                            <th width='100'>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        while ($row = $query->fetch_assoc()) { ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $row['no_meja']; ?></td>
                                <td><?= $row['status_meja']; ?>
                                </td>
                                <td>
                                    <a href="<?= BASE; ?>edit/edit.meja.php?id=<?= $row['id_meja']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-pen"></i> EDIT</a>
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