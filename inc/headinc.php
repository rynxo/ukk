<?php
include '../config.php';

if (!isset($_SESSION['login_cafe'])) {
    $_SESSION['alert'] = 'Login dulu bang!';
    echo "
    <script>
    window.location.href='../index.php';
    </script>
    ";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Blank Page</title>

    <link rel="shortcut icon" href="<?= BASE; ?>img/RT.png">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= BASE ?>plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= BASE ?>dist/css/adminlte.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= BASE ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= BASE ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= BASE ?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <style>
        html {
            position: relative;
            min-height: 100%;
        }

        body {
            margin-bottom: 60px;
            /* Margin bottom by footer height */
        }

        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 60px;
            /* Set the fixed height of the footer here */
            line-height: 60px;
            /* Vertically center the text there */
            background-color: #f5f5f5;
            padding: 0 20px 0 20px;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <!-- Navbar -->
    <nav class=" navbar navbar-white navbar-light container-fluid">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item d-sm-inline-block text-warning ml-5">
                <h1><b>CAFEBISANGOPI</b></h1>
            </li>
        </ul>

        <!-- Right navbar links -->
    </nav>
    <!-- /.navbar -->