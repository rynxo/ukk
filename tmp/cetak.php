<?php
include 'config.php';



// include autoload
require 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$document = new Dompdf();


// $document->loadHtml($html);
$page = file_get_contents("nota.php");
// $document->loadHtml($page);

$id = $_GET['id_pes'];
$panggil = $con->query("SELECT detail_pesanan.*, masakan.* FROM detail_pesanan LEFT JOIN masakan ON detail_pesanan.id_masakan = masakan.id_masakan WHERE id_pesanan = '$id'");

$panggilmeja = $con->query("SELECT pesanan.*, meja.* FROM pesanan LEFT JOIN meja ON pesanan.id_meja = meja.id_meja WHERE id_pesanan = '$id'");
$meja = $panggilmeja->fetch_assoc();
if ($meja['no_meja'] == 0) {
    $mejo = 'Dibawa Pulang';
} else {
    $mejo = 'MEJA ' . $meja['no_meja'];
}
$tgl = $meja['tgl_pesanan'];
$newtanggal = date("d-m-Y", strtotime($tgl));
// var_dump($meja) or die;
$pesan = $con->query("SELECT SUM(sub_total) FROM detail_pesanan WHERE id_pesanan = '$id'");
$bayar = $pesan->fetch_assoc();

$total = $bayar['SUM(sub_total)'];


$output = "
<html>
<style>
    body {
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }

    h1,
    h5 {
        text-align: end;
    }

    h5, img {
        margin: -15px 0 0 0;
    }

    h6 {
        margin: -0px 0 0 10px;
    }

    h3 {
        margin: 0;
    }

    h4 {
        margin: 5px 0 0 4px;
    }

    b {
        margin: 0 0 0 4px;
    }

    img {
        display: block;
        margin-left: 50px;
        margin-bottom:20px;
    }
    .kecil{
        font-size: 10px;
        margin: -5px 0 0 10px;
    }
</style>

<body>
    <img src='img/LOGORT.png' width='200'>
    <h5>Waktu Pesan : " . $newtanggal . "</h5>
    <hr>
    <table>
        <h4>" . $mejo . "</h4>
        <tr>
            <td>
                <h3>Pesanan</h3>
            </td>
            <td>
                <h3> : " . $id . "</h3>
            </td>
        </tr>
        <tr>
            <td>
            </td>
            <td></td>
            <td></td>
        </tr>";
while ($row = $panggil->fetch_assoc()) {
    if ($row['keterangan_pesanan'] == '') {
        $ket = '';
    } else {
        $ket = 'ket : ' . $row['keterangan_pesanan'];
    }
    $output .= "
                <tr>
                    <td>" . $row['nama_masakan'] . "</td>
                    <td>:</td>
                    <td>" . $row['qty'] . "</td>
                    <td>:</td>
                    <td>" . number_format($row['sub_total'], 2, ",", '.') . "</td>
                </tr>
                <tr>
                <td class='kecil' colspan='6'>" . $ket . "</td>
                </tr>
                ";
}
$output .= "
            </table>
    <hr>
    <table>
        <tr>
            <td>Total Harga : " . number_format($total, 2, ",", ".") . "</td>
        </tr>
        <tr>
        </tr>
    </table>
    <b>
        NB : Pembayaran Hanya Dapat Dilakukan Dikasir " . date("d-m-Y") . "
    </b>
</body>

</html>";

$document->loadHtml($output);

$document->setPaper(array(0, 0, 300, 600), 'portrait');

$document->render();

$document->stream("NOTA RESTO KITA", array("attachment" => 0));
