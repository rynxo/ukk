<?php

include '../config.php';

$id = $_GET['id'];

if (isset($id)) {
    $con->query("DELETE FROM user WHERE id_user = '$id'");
    echo "
    <script>
    document.location='../core/pembeli.php';
    </script>
    ";
    $_SESSION['berhasil'] = '
    <div class="alert alert-success">
    Pelanggan berhasil dihapus!
    </div>';
}
