<?php

include_once '../config.php';

$id = $_GET['id'];

if (isset($id)) {
    $con->query("DELETE FROM user WHERE id_user = '$id'");
    echo "
    <script>
    window.location.href='../core/user.php';
    </script>
    ";
    $_SESSION['berhasil'] = '
    <div class="alert alert-success">
    User berhasil dihapus!
    </div>
    ';
}
