<?php
include_once '../config.php';
$id = $_GET['id'];

$query = $con->query("SELECT * FROM meja WHERE id_meja = '$id'");
$row = $query->fetch_assoc();
$status = $row['status_meja'];

if ($status == 'penuh') {
    $con->query("UPDATE meja SET status_meja = 'kosong' WHERE id_meja = '$id'");
    echo "
    <script>
    document.location='../core/meja.php';
    </script>
    ";

    $_SESSION['berhasil'] = '
    <div class="alert alert-success">
    Meja berhasil diubah!
    </div>
    ';
} elseif ($status == 'kosong') {
    $con->query("UPDATE meja SET status_meja = 'penuh' WHERE id_meja = '$id'");
    echo "
    <script>
    document.location='../core/meja.php';
    </script>
    ";

    $_SESSION['berhasil'] = '
    <div class="alert alert-success">
    Meja berhasil diubah!
    </div>
    ';
}
