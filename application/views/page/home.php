<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/bbaa37717d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../../vendor/allpagecss.css">
    <style>
        .portfolio-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .portfolio-item {
            width: calc(33.33% - 20px);
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

        .card {
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            margin: 10px;
        }

        .card-body {
            padding: 20px;
        }

        .testimonial-img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            object-fit: cover;
            margin-bottom: 15px;
        }

        .testimonial-name {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .testimonial-job {
            font-size: 16px;
            color: #777;
            margin-bottom: 15px;
        }

        .testimonial-quote {
            font-size: 16px;
            color: #333;
        }

        .quote-icon-left,
        .quote-icon-right {
            color: #777;
        }

        .testimonial-slider {
            position: relative;
            overflow: hidden;
        }

        .testimonial-slider-inner {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .testimonial-item {
            min-width: 100%;
            box-sizing: border-box;
        }

        .testimonial-slider-controls {
            position: absolute;
            top: 50%;
            width: 100%;
            display: flex;
            justify-content: space-between;
            transform: translateY(-50%);
        }

        .testimonial-slider-control {
            background: rgba(0, 0, 0, 0.5);
            color: #fff;
            border: none;
            padding: 10px;
            cursor: pointer;
        }
        .icon {
            color: red;
        }

        @media (max-width: 992px) {
            .portfolio-item {
                width: calc(50% - 20px);
            }
        }

        @media (max-width: 576px) {
            .portfolio-item {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <main id="main">
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
                                    <h4>Jasa Custom Furniture/Mebel</h4>
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
                    </div>
                </div>
            </div>
        </section><!-- End About Section -->

        <!-- ======= Produk Sorting Algorithm Section ======= -->
        <?php
        // Sorting dokumentasi based on 'terjual' in descending order
        usort($dokumentasi, function ($a, $b) {
            return $b->terjual - $a->terjual;
        });
        ?>

        <main id="main">
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
                                        <a href="<?= base_url('landingpage/dokumentasi/') . $row->id_dokumentasi ?>#portfolio-details" title="More Details"><i class="fa-solid fa-arrow-up-right-from-square"></i> Lihat Produk</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        </main>

        <!-- ======= Testimonials Section ======= -->
        <section id="testimonials" class="testimonials">
            <div class="container" data-aos="fade-up">
            <div class="section-title" data-aos="fade-in" data-aos-delay="100">
                <h2>Apa Kata Pengunjung</h2>
                <p>Quote, Saran, Masukan, Pendapat Pengunjung D furnitur</p>
            </div>

                <div class="testimonial-slider">
                    <div class="testimonial-slider-inner">
                    <?php foreach ($quote as $row) : ?>
                        <div class="testimonial-item">
                            <div class="card">
                                <div class="card-body text-center">
                                <img src="<?= base_url('vendor/quote/') . $row->profile ?>" class="testimonial-img" alt="">
                                    <h3 class="testimonial-name"><?= $row->nama ?></h3>
                                    <h4 class="testimonial-job"><?= $row->pekerjaan ?></h4>
                                    <p class="testimonial-quote">
                                        <i class="quote-icon-left fa fa-quote-left"></i>
                                        <?= $row->quote; ?>
                                        <i class="quote-icon-right fa fa-quote-right"></i>
                                    </p>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->
                        <?php endforeach; ?>
                    </div>

                    <div class="testimonial-slider-controls">
                        <button class="testimonial-slider-control prev"><i class="fa fa-chevron-left"></i></button>
                        <button class="testimonial-slider-control next"><i class="fa fa-chevron-right"></i></button>
                    </div>
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
                <div class="col-lg-4">
                    <div class="info-box mb-4">
                    <i class="bi bi-geo-alt-fill"></i>
                        <h3>Alamat</h3>
                        <p><?= $settings['alamat'] ?></p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="info-box  mb-4">
                    <i class="bi bi-envelope-at-fill"></i>
                        <h3>Email</h3>
                        <p><?= $settings['email'] ?></p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="info-box  mb-4">
                    <i class="bi bi-telephone-fill"></i>
                        <h3>Telepon</h3>
                        <p><?= $settings['phone'] ?></p>
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-lg-15 ">
                    <iframe class="mb-4 mb-lg-0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126730.90042398356!2d107.43351809726559!3d-6.9690806!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e929c4a63671%3A0x49c2b6931760a4b1!2sdnjfurniture!5e0!3m2!1sid!2sid!4v1721111718253!5m2!1sid!2sid" frameborder="0" style="border:0; width: 100%; height: 384px;" allowfullscreen></iframe>
                </div>

                <!-- <div class="col-lg-6">
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
                </div> -->

            </div>

        </div>
    </section><!-- End Contact Section -->

    </main><!-- End #main -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const slider = document.querySelector('.testimonial-slider-inner');
            const items = document.querySelectorAll('.testimonial-item');
            const prevButton = document.querySelector('.testimonial-slider-control.prev');
            const nextButton = document.querySelector('.testimonial-slider-control.next');
            let currentIndex = 0;

            function updateSlider() {
                slider.style.transform = `translateX(-${currentIndex * 100}%)`;
            }

            prevButton.addEventListener('click', function() {
                currentIndex = (currentIndex > 0) ? currentIndex - 1 : items.length - 1;
                updateSlider();
            });

            nextButton.addEventListener('click', function() {
                currentIndex = (currentIndex < items.length - 1) ? currentIndex + 1 : 0;
                updateSlider();
            });
        });
    </script>
</body>
</html>
