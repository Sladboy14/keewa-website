<?php
    session_start();

    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
        exit();
    }
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../Css/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
</head>

<style>
    .kotak {
        border: solid;
    }
    .summary-kategori{
        background-color: #0a6b4a;
        border-radius: 15px;
    }
    .summary-produk{
        background-color: #0a516b;
        border-radius: 15px;
    }
    .no-decoration{
        text-decoration: none;
    }
    
</style>

<body>
    <?php require "navbar.php"; ?>
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="fas fa-home"></i> Home
                </li>
            </ol>
        </nav>
        <h2>Hallo Admin</h2>

        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="summary-kategori p-3">
                        <div class="row">
                            <div class="col-6">
                                <i class="fas fa-align-justify fa-7x text-black-50"></i>
                            </div>
                            <div class="col-6 text-white">
                                <h3 class="fs-2">kategori</h3>
                                <p class="fs-4"> kategori</p>
                                <P><a href="kategori.php" class="text-white no-decoration">Lihat Detail</a></p>
                            </div>
                        </div>
                    </div>
                </div>

            <div class="col-lg-4 col-md-6 col-12 mb-3">
                <div class="summary-produk p-3">
                    <div class="row">
                        <div class="col-6">
                            <i class="fas fa-box fa-7x text-black-50"></i>
                        </div>
                    <div class="col-6 text-white">
                        <h3 class="fs-2">Produk</h3>
                        <p class="fs-4"> produk</p>
                        <P><a href="produk.php" class="text-white no-decoration">Lihat Detail</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../Css/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>
</html>

     