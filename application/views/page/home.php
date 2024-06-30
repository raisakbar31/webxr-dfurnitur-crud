<script src="https://kit.fontawesome.com/bbaa37717d.js" crossorigin="anonymous"></script>
<main id="main">
    <link rel="stylesheet" href="../../../vendor/allpagecss.css">
    <style>
        .portfolio-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .portfolio-item {
            width: calc(33.33% - 20px); /* Setiap item mengambil 33.33% lebar dengan jarak 20px */
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 20px;
        }

        .portfolio-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .portfolio-wrap img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .portfolio-info {
            padding: 15px;
            text-align: center;
        }
        .portfolio-info h4 {
            margin-top: 0;
            font-size: 20px;
            color: #007bff;
        }

        .portfolio-info strong {
            color: #333;
        }

        .detaillihat a {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            color: #fff;
            background-color: #007bff;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .detaillihat a:hover {
            background-color: #0056b3;
        }
        .btn-biru {
    display: inline-block;
    padding: 12px 24px;
    background-color: #007bff;
    color: #fff;
    border-radius: 5px;
    text-decoration: none;
    text-align: center;
    font-size: 18px;
    font-weight: bold;
    border: 2px solid #0056b3;
    transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
}

.btn-biru:hover {
    background-color: #0056b3;
    border-color: #0042a3;
    color: #fff;
}


        @media (max-width: 992px) {
            .portfolio-item {
                width: calc(50% - 20px); /* Pada layar lebih kecil, setiap item mengambil 50% lebar dengan jarak 20px */
            }
        }

        @media (max-width: 576px) {
            .portfolio-item {
                width: 100%; /* Pada layar sangat kecil, setiap item mengambil 100% lebar */
            }
        }
    </style>

    <!-- ======= About Section ======= -->
    <section id="tentang" class="about">
        <div class="container">

            <div class="row no-gutters">
                <div class="content col-xl-5 d-flex align-items-stretch" data-aos="fade-up">
                    <div class="content">
                        <h3>Apa itu <?= $settings['judul_halaman'] ?> ?</h3>
                        <p>
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Repudiandae deserunt ipsam ut odit magnam corporis laudantium quidem amet corrupti, nostrum nihil recusandae alias veniam sunt quas labore sit at ab facilis modi nisi consectetur! Officia excepturi et esse minus rem?
                        </p>
                        <!-- <a href="#" class="about-btn">Baca Selengkapnya <i class="bx bx-chevron-right"></i></a> -->
                    </div>
                </div>
                <div class="col-xl-7 d-flex align-items-stretch">
                    <div class="icon-boxes d-flex flex-column justify-content-center">
                        <div class="row">
                            <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="100">
                                <i class="bx bx-receipt"></i>
                                <h4>Penjualan Furnitur/Mebel</h4>
                                <h5>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque, accusantium?
                                </h5>
                            </div>
                            <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="200">
                                <i class="bx bx-cube-alt"></i>
                                <h4> Jasa Custom Furniture/Mebel</h4>
                                <h5>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque, accusantium?
                                </h5>
                            </div>
                            <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="300">
                                <i class="bx bx-images"></i>
                                <h4>Desain Interior</h4>
                                <h5>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque, accusantium?
                                </h5>
                            </div>
                            <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="400">
                                <i class="bx bx-shield"></i>
                                <h4>Desain eksterior</h4>
                                <h5>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque, accusantium?
                                </h5>
                            </div>
                        </div>
                    </div>
                    <!-- End .content-->
                </div>
            </div>

        </div>
    </section><!-- End About Section -->

    <!-- ======= Produk sorting algoritma ======= -->
    

    <?php
// Sorting dokumentasi based on 'terjual' in descending order
usort($dokumentasi, function ($a, $b) {
    return $b->terjual - $a->terjual;
});
?>

<main id="main">
    <link rel="stylesheet" href="../../../vendor/allpagecss.css">
    <section id="dokumentasi" class="portfolio">
        <div class="container">
            <div class="section-title" data-aos="fade-in" data-aos-delay="100">
                <h2>Produk Yang Kami Sediakan</h2>
                <p>Dapatkan pengalaman berbelanja dengan teknologi AR yang kami sediakan</p>
            </div>

            <div class="portfolio-container" data-aos="fade-up">
        <?php foreach ($dokumentasi as $index => $row): ?>
            <div class="portfolio-item">
                <div class="portfolio-wrap">
                    <img src="<?= base_url('vendor/dokumentasi/') . $row->thumbnail ?>" class="img-fluid" alt="">
                </div>
                <div class="portfolio-info">
                <h4><?= $row->nama_produk ?></h4>
                    <strong>Produk Terjual</strong>: <?= $row->terjual; ?> <strong>Unit <i class="fa-solid fa-cart-shopping"></i></strong><br>
                    <?php if ($row->stok == 0): ?>
                <strong>Stok</strong>: 0 (Stok Habis) <i class="fa-regular fa-circle-xmark"></i>
            <?php else: ?>
                <strong>Stok</strong>: <?= $row->stok; ?> <strong>Unit <i class="fa-regular fa-circle-check"></i></strong>
            <?php endif; ?>
                    <div class="detaillihat">
                        <a href="<?= base_url('landingpage/dokumentasi/') . $row->id_dokumentasi ?>#portfolio-details" title="More Details"><i class="fa-solid fa-arrow-up-right-from-square"></i> Detail</a>
                        <a href="<?= base_url('vendor/dokumentasi/') . $row->thumbnail ?>" data-gallery="portfolioGallery" class="portfolio-lightbox" title="<?= $row->nama_pengunjung ?>"><i class="fa-regular fa-eye"></i> Lihat</a>
                    </div>
                </div>
            </div>
            <?php if (($index + 1) % 3 == 0): ?>
                </div><div class="portfolio-container" data-aos="fade-up">
            <?php endif; ?>
        <?php endforeach; ?>
    </div><br>

            <div class="row" data-aos="fade-up">
                <div class="col-lg-12 d-flex justify-content-center">
                <a href="<?= base_url('landingpage/allitem'); ?>" class="btn-biru text-center">Lihat Semua Produk Yang Kami Miliki <i class="fa-solid fa-caret-down"></i></a> 
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->


    
    <!-- End Produk sorting algoritma -->

    <!-- ======= Testimonials Section ======= -->
    <section id="katapengunjung" class="testimonials section-bg">
        <div class="container">

            <div class="section-title" data-aos="fade-in" data-aos-delay="100">
                <h2>Apa Kata Pengunjung</h2>
                <p>Quote, Saran, Masukan, Pendapat Pengunjung D furnitur</p>
            </div>

            <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
                <div class="swiper-wrapper">

                    <?php
                    foreach ($quote as $row) :
                    ?>
                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <p>
                                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                    <?= $row->quote; ?>
                                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                </p>
                                <img src="<?= base_url('vendor/quote/') ?><?= $row->profile ?>" class="testimonial-img" alt="">
                                <h3><?= $row->nama ?></h3>
                                <h4><?= $row->pekerjaan ?></h4>
                            </div>
                        </div><!-- End testimonial item -->
                    <?php
                    endforeach;
                    ?>

                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>
    </section><!-- End Testimonials Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact kontak">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Contact</h2>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="info-box mb-4">
                        <i class="bx bx-map"></i>
                        <h3>Alamat</h3>
                        <p>Kabupaten Tanah Datar, Sumatera Barat 27281</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="info-box  mb-4">
                        <i class="bx bx-envelope"></i>
                        <h3>Email</h3>
                        <p><?= $settings['email'] ?></p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="info-box  mb-4">
                        <i class="bx bx-phone-call"></i>
                        <h3>Telepon</h3>
                        <p><?= $settings['phone'] ?></p>
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-lg-6 ">
                    <iframe class="mb-4 mb-lg-0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.6833452086385!2d100.61921621445525!3d-0.4712910354122696!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e2ad2d2be29c7dd%3A0xb19e3eb230efffbc!2sIstano%20Rajo%20Basa%20Pagaruyung!5e0!3m2!1sid!2sid!4v1670599428431!5m2!1sid!2sid" frameborder="0" style="border:0; width: 100%; height: 384px;" allowfullscreen></iframe>
                </div>

                <div class="col-lg-6">
                    <form action="<?= base_url('landingpage') ?>" method="post" role="form" class="php-email-form">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                            </div>
                            <div class="col-md-6 form-group mt-3 mt-md-0">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                        </div>
                        <div class="form-group mt-3">
                            <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                        </div>
                        <div class="my-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div>
                        <div class="text-center"><button type="submit">Send Message</button></div>
                    </form>
                </div>

            </div>

        </div>
    </section><!-- End Contact Section -->

</main><!-- End #main -->