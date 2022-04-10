<?php


include_once '../config.php';

$p = $con->query("SELECT MAX(no_meja) as maxid FROM meja");
$max = $p->fetch_assoc();
$max = $max['maxid'];
$max++;


$cek = $con->query("INSERT INTO meja VALUES ('', '$max', 'kosong')");

echo "
<script>
document.location='../core/meja.php';
</script>
";

$_SESSION['berhasil'] = '
<div class="alert alert-success">
Meja berhasil ditambahkan!
</div>
';
