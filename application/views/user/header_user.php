<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?= $title ?></title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="<?= base_url() ?>assets/css/styles.css" rel="stylesheet" />
</head>

<body>
    <!-- Navigation-->
    <?php
    if (isset($user)) { ?>
        <span>
            <?= $user['nama'] ?>
        </span>
    <?php } ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="#!">Perpustakaan ku</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Home</a></li>
                    <?php
                    if (isset($user)) { ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Pesanan saya</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#!">Data Peminjaman</a></li>
                                <li><a class="dropdown-item" href="#!">Data Booking</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a type="button" class="nav-link" href="<?= base_url() ?>auth/logout">Logout</a></li>
                    <?php
                    } else {
                    ?>
                        <li class="nav-item"><a type="button" class="nav-link" data-bs-toggle="modal" data-bs-target="#modalregistrasi">Registrasi</a></li>
                        <li class="nav-item"><a type="button" class="nav-link" data-bs-toggle="modal" data-bs-target="#modallogin">Login</a></li>
                    <?php
                    }
                    ?>
                </ul>
                <form class="d-flex">

                    <button class="btn btn-outline-dark" type="submit">
                        <i class="bi-cart-fill me-1"></i>
                        Cart
                        <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                    </button>
                </form>
            </div>
        </div>
    </nav>
    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder"><?= $title ?></h1>
                <p class="lead fw-normal text-white-50 mb-0">Cari dan Temukan Buku Kesukaan mu</p>
            </div>
        </div>
    </header>