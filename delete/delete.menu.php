<?php

include_once '../config.php';

$id = $_GET['id'];

if (isset($id)) {

    $con->query("DELETE FROM masakan WHERE id_masakan = '$id'");
    echo "
    <script>
    document.location='../core/menu.php';
    </script>
    ";
    $_SESSION['berhasil'] = '
    <div class="alert alert-success">
    Menu berhasil dihapus!
    </div>
    ';
}
