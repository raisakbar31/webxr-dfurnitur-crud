<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?= $title ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?= base_url('vendor/landingpage/') ?>assets/img/favicon.png" rel="icon">
    <link href="<?= base_url('vendor/landingpage/') ?>assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS animasi -->
    <link
    rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <!-- Template Main CSS File -->
    <link href="<?= base_url('vendor/landingpage/') ?>assets/css/style.css" rel="stylesheet">

    <!-- Style -->
    <style>
        *{
            margin: 0;
            padding: 0px;
    
        }
        #hero {
            background: linear-gradient(rgba(55, 142, 181, 0.5), rgba(55, 142, 181, 0.2)), url("<?= base_url('vendor/images/') . $settings['sampul_website'] ?>") no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

        .btn-biru {
            display: inline-block;
            background: #67b0d1;
            padding: 6px 44px 8px 30px;
            color: #fff;
            border-radius: 50px;
            transition: 0.3s;
            position: relative;
        }

        .kontak {
            background: url("../img/about-bg.jpg") center center no-repeat;
            background-size: cover;
            padding: 60px 0;
            position: inherit;
        }
    </style>
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="navbar navbar-expand-lg fixed-top">
        <div class="container d-flex align-items-center justify-content-between">

            <div class="logo">
                <h1 class="text-light"><a href="<?= base_url('dashboard'); ?>"><span><?= $settings['judul_halaman'] ?></span></a></h1>
            </div>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Dashboard </a></li>
                    <li><a class="nav-link scrollto" href="#tentang">Tentang</a></li>
                    <li><a class="nav-link scrollto" href="#dokumentasi">produk</a></li>
                    <li><a class="nav-link scrollto" href="#testimonials">Kata Pengunjung</a></li>
                    <!-- <li><a class="nav-link scrollto" href="#team">Team</a></li> -->
                    <li><a class="nav-link scrollto" href="#contact">kontak</a></li>
                    <ul class="navbar-nav flex-row">
      <li class="nav-item me-3 me-lg-1 dropdown">
        <a
          class="nav-link dropdown-toggle d-sm-flex align-items-sm-center"
          href="#"
          id="navbarDropdownUser"
          role="button"
          data-bs-toggle="dropdown"
          aria-expanded="false"
        >
          <img
            src="https://mdbcdn.b-cdn.net/img/new/avatars/1.webp"
            class="rounded-circle"
            height="22"
            alt="User Avatar"
            loading="lazy"
          />
          <strong class="d-none d-sm-block ms-1"><?= $user['nama'] ?></strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownUser">
          <li>
            <a class="dropdown-item" href="<?= base_url('admin/logout'); ?>">Keluar</a>
          </li>
          <li>
            <a class="dropdown-item" href="<?= base_url('user/dashboard'); ?>">Profil</a>
          </li>
          <li>
            <a class="dropdown-item" href="<?= base_url('user/Status'); ?>">Status Orderan</a>
          </li>
        </ul>
      </li>
    </ul>
                     </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero">
        <div class="hero-container" data-aos="fade-up">
            <h1><?= $settings['text_sambutan']; ?></h1>
            <h2><?= $settings['desc_sambutan'] ?></h2>
            <!-- <a href="#about" class="btn-get-started scrollto"><i class="bx bx-chevrons-down"></i></a> -->
                <a href="<?= base_url('dashboard/allitem'); ?>" class=" animate__animated animate__headShake animate__infinite	infinite tombolmariberbelanja" href="<?= base_url('landingpage/allitem'); ?>">Mari Berbelanja Dengan Fitur AR  <i class="fa-solid fa-vr-cardboard"></i></a>
                <br><br> <h2>selamat datang <?= $user['nama'] ?> dan selamat menikmati diskon sampai dengan 50% </h2> <br>
            </div>
    </section><!-- End Hero -->