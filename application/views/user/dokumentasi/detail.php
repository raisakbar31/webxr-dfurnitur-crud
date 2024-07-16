<!-- ar=============================== -->
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!-- ============================ -->
<script src="<?= base_url('vendor/assets/') ?>fas.js"></script>
<script src="<?= base_url('vendor/assets/') ?>app.js"></script>
    <script type="module">
        import { App } from '../../vendor/assets/app.js';

        document.addEventListener("DOMContentLoaded", function(){
            const app = new App();
            window.app = app;
        });
    </script>

<script src="https://kit.fontawesome.com/bbaa37717d.js" crossorigin="anonymous"></script>

<?php
// Asumsi koneksi database sudah ada sebelumnya
// Contoh query untuk mengambil nomor telepon dari database
$query = $this->db->get('tb_settings');
$settings = $query->row();
$phone_number = $settings->phone;
?>

<main id="main">

    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Detail Item</h2>
                <ol>
                    <li><a href="<?= base_url('') ?>">Home</a></li>
                    <li><a href="<?= base_url('landingpage/allitem/') ?>">All Produk</a></li>
                    <li>Detail Produk</li>
                </ol>
            </div>

        </div>
    </section><!-- Breadcrumbs Section -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio" class="portfolio">
        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-8">
                    <div class="portfolio-details-slider swiper">
                        <div class="swiper-wrapper align-items-center">
                            <div class="swiper-slide">
                                <img src="<?= base_url('vendor/dokumentasi/') . $dokumentasi['thumbnail']; ?>" alt="Produk Thumbnail" class="img-fluid mb-3">
                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                    
                    <div class="container mt-3">
                        <div class="row text-center">
                            <div class="col-md-6">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <strong>Produk Terjual</strong>: <?= $dokumentasi['terjual'] ?> <strong>Unit <i class="fa-solid fa-cart-shopping"></i></strong>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <?php if ($dokumentasi['stok'] > 0): ?>
                                            <strong>Stok</strong>: <?= $dokumentasi['stok']; ?> <strong>Unit <i class="fa-regular fa-circle-check"></i></strong>
                                        <?php else: ?>
                                            <strong>Stok</strong>: Stok Habis  <i class="fa-regular fa-circle-xmark"></i>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="portfolio-info">
                        <!-- Fitur AR -->
                        <h2><strong>Fitur AR <i class="fa-solid fa-vr-cardboard"></i></strong></h2><br>
                       
                        <div class="card-footer">
                            <button class="ar-button" onclick="window.app.showChair('<?= $dokumentasi['file_d'] ?>');">Lihat AR <i class="fas fa-camera"></i></button>
                        </div>

                        <br>
                        <!-- Informasi Produk -->
                        <h3>Informasi Produk</h3>
                        <ul>
                            <li><strong>Nama Produk</strong>: <?= $dokumentasi['nama_produk'] ?></li>
                            <li><strong>Ukuran</strong>:</li>
                            <ul>
                                <li><strong>Tinggi</strong>: <?= $dokumentasi['tinggi']; ?> cm</li>
                                <li><strong>Panjang</strong>: <?= $dokumentasi['panjang']; ?> cm</li>
                                <li><strong>Lebar</strong>: <?= $dokumentasi['lebar']; ?> cm</li>
                            </ul>
                            <li><strong>Bahan</strong>: <?= $dokumentasi['bahan']; ?></li>
                            <li><strong>Tanggal Di Upload</strong>: <?= $dokumentasi['tanggal']; ?></li>
                            <li><strong>Deskripsi</strong>:
                                <p>"<?= $dokumentasi['deskripsi'] ?>"</p>
                            </li>
                            <li><strong>Diskon</strong>: <?= $dokumentasi['diskon']; ?>%</li>
                            <li><strong>Harga</strong>: Rp. <?= number_format($dokumentasi['harga'], 0, ',', '.'); ?></li>
                            <li><strong>Harga Setelah Diskon</strong>: <h2> <?= number_format($dokumentasi['harga'] * (100 - $dokumentasi['diskon']) / 100, 0, ',', '.'); ?></h2></li>
                        </ul>

                        <!-- Arahkan ke WhatsApp -->
                        <a href="#" onclick="checkStockAndBuy()" class="btn btn-primary">Beli <i class="fa-solid fa-cart-shopping"></i></a>

                        <script>
                            function checkStockAndBuy() {
                                var stok = <?= $dokumentasi['stok'] ?>;
                                if (stok <= 0) {
                                    alert("Maaf, stok produk ini habis. Silahkan hubungi admin untuk informasi lebih lanjut.");
                                } else {
                                    var whatsappLink = "https://api.whatsapp.com/send?phone=<?= $phone_number ?>&text=Halo%20saya%20ingin%20membeli%20produk%20berikut:%0A%0A" +
                                        "Nama%20Produk:%20<?= urlencode($dokumentasi['nama_produk']) ?>%0A" +
                                        "Tinggi:%20<?= urlencode($dokumentasi['tinggi']) ?>%20cm%0A" +
                                        "Panjang:%20<?= urlencode($dokumentasi['panjang']) ?>%20cm%0A" +
                                        "Lebar:%20<?= urlencode($dokumentasi['lebar']) ?>%20cm%0A" +
                                        "Bahan:%20<?= urlencode($dokumentasi['bahan']) ?>%0A" +
                                        "Harga:%20Rp.%20<?= urlencode($dokumentasi['harga']) ?>%0A" +
                                        "Diskon:%20<?= urlencode($dokumentasi['diskon']) ?>%20%%0A"+
                                        "Harga%20Setelah%20diskon:%20Rp.%20<?= number_format($dokumentasi['harga'] * (100 - $dokumentasi['diskon']) / 100, 0, ',', '.'); ?>%0A";

                                    window.open(whatsappLink, "_blank");
                                }
                            }
                        </script>
                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Portfolio Details Section -->

</main><!-- End #main -->

