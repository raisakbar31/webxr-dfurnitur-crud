  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="" class="logo d-flex align-items-center">
            <span class="d-none d-lg-block"><?= $settings['judul_halaman'] ?></span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <span class="d-none d-md-block dropdown-toggle ps-2"><?= $users['nama']; ?></span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <!-- <li>
                        <a class="dropdown-item d-flex align-items-center" href="<?= base_url('pemilik/profil') ?>">
                            <i class="bi bi-person"></i>
                            <span>Profil Saya</span>
                        </a>
                    </li> -->
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" target="_blank" href="<?= base_url('') ?>">
                            <i class="bi bi-globe"></i>
                            <span>Ke Landing Page</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="<?= base_url('admin/logout') ?>">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Keluar woy janc</span>
                        </a>
                    </li>

                </ul>
                <!-- End Profile Dropdown Items -->
                 
            </li>
            
            <!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url('pemilik/dashboard') ?>">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
  

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#kategori-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-cart-plus"></i>
                <span>Data Produk</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="kategori-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                <a class="nav-link collapsed" href="<?= base_url('pemilik/kategori') ?>">
            <i class="bi bi-cart-plus"></i>
                <span>Kategori Produk</span>
            </a>
                </li>
                <li>
                <a class="nav-link collapsed" href="<?= base_url('pemilik/dokumentasi') ?>">
            <i class="bi bi-cart-plus"></i>
                <span>Produk</span>
            </a>
                </li>
            </ul>
        </li>















        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#penjualan-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-shop"></i>
                <span>Penjualan</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="penjualan-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?= base_url('pemilik/penjualan') ?>">
                        <i class="bi bi-circle"></i><span>Penjualan</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('pemilik/riwayatpenjualan') ?>">
                        <i class="bi bi-circle"></i><span>Riwayat Penjualan</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url('pemilik/quote') ?>">
                <i class="bi bi-chat-quote-fill"></i>
                <span>Kata Pengunjung</span>
            </a>
        </li>
        <li class="nav-item">
        <a class="nav-link collapsed" href="<?= base_url('pemilik/laporan') ?>">
            <i class="bi bi-file-earmark-text-fill"></i>
                <span>Laporan</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url('pemilik/settings') ?>">
                <i class="bi bi-gear"></i>
                <span>Settings</span>
            </a>
        </li>

    </ul>
</aside>

<main id="main" class="main">
    <div class="pagetitle mb-3">
        <h1><?= $title ?></h1>
    </div><!-- End Page Title -->

      <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Bootstrap core JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

