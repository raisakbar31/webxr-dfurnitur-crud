<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Breadcrumbs Section */
        .breadcrumbs {
            margin-top: 20px;
            padding: 20px 0;
            background-color: #e9ecef;
            border-bottom: 1px solid #ccc;
        }

        .breadcrumbs ol {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .breadcrumbs ol li {
            display: inline;
            font-size: 18px;
        }

        .breadcrumbs ol li:not(:last-child):after {
            margin: 0 10px;
        }

        /* Section Title */
        .section-title {
            text-align: center;
            margin-top: 40px;
            margin-bottom: 30px;
        }

        /* Produk Terbaru Section */
        .produk-terbaru{
            margin-bottom: -100px;
        }
        .produk-terbaru .portfolio-item {
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin: 0 10px;
        }

        .produk-terbaru .portfolio-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            background-color: whitesmoke;
        }

        .produk-terbaru .portfolio-wrap img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 8px 8px 0 0;
        }

        .produk-terbaru .portfolio-info {
            padding: 10px;
            text-align: center;
        }

        .produk-terbaru .portfolio-info h4 {
            margin-top: 0;
            font-size: 18px;
            color: #007bff;
        }

        .produk-terbaru .portfolio-info p {
            font-size: 14px;
        }

        .detaillihat a {
            display: inline-block;
            margin-right: 5px;
            padding: 5px 10px;
            color: #fff;
            background-color: #007bff;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .detaillihat a:hover {
            background-color: #0056b3;
        }

        /* Search Bar */
        .search-bar {
            margin: 30px 0;
            text-align: center;
        }

        .search-bar input {
            width: 50%;
            max-width: 500px;
            display: inline-block;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .no-products {
            text-align: center;
            color: red;
            font-size: 18px;
            margin-top: 20px;
            display: none;
        }

        .back-button {
            margin-top: 20px;
            text-align: center;
            display: none;
        }

        .back-button button {
            padding: 10px 20px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .back-button button:hover {
            background-color: #0056b3;
        }

        /* Produk Yang Kami Sediakan Section */
        .produk-item {
            margin-bottom: 30px;
        }

        .produk-item .portfolio-item {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .produk-item .portfolio-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .produk-item .portfolio-wrap img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px 8px 0 0;
        }

        .produk-item .portfolio-info {
            padding: 15px;
            text-align: center;
        }

        .produk-item .portfolio-info h4 {
            margin-top: 0;
            font-size: 18px;
            color: #007bff;
        }

        .produk-item .portfolio-info p {
            font-size: 14px;
            margin-bottom: 10px;
        }

        .produk-item .detaillihat a {
            display: inline-block;
            margin-right: 5px;
            padding: 5px 10px;
            color: #fff;
            background-color: #007bff;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .produk-item .detaillihat a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <main id="main">
        <!-- Breadcrumbs Section -->
        <section class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="<?= base_url('') ?>">Home</a></li>
                    <li>All Produk</li>
                </ol>
            </div>
        </section>
        <!-- End Breadcrumbs Section -->

               <!-- Produk Terbaru Section -->
               <section id="produkTerbaru" class="produk-terbaru">
            <div class="container">
                <div class="section-title" data-aos="fade-in" data-aos-delay="100">
                    <h2>Produk Terbaru</h2>
                    <p>Temukan produk terbaru kami di sini</p>
                </div>
                <div class="owl-carousel owl-theme">
                    <?php foreach ($dokumentasi as $row): ?>
                        <div class="item">
                            <div class="portfolio-item">
                                <div class="portfolio-wrap">
                                    <img src="<?= base_url('vendor/dokumentasi/') . $row->thumbnail ?>" class="img-fluid" alt="<?= $row->nama_produk ?>">
                                </div>
                                <div class="portfolio-info">
                                    <h4><?= $row->nama_produk ?></h4>
                                    <p><strong>Terjual:</strong> <?= $row->terjual; ?> Unit</p>
                                    <p><strong>Stok:</strong> <?= $row->stok; ?> Unit</p>
                                    <?php if ($row->diskon > 0): ?>
                                <strong>Diskon</strong>: <?= $row->diskon; ?>%<br><br>
                            <?php endif; ?>
                                    <div class="detaillihat">
                                        <a href="<?= base_url('dashboard/dokumentasi/') . $row->id_dokumentasi ?>#portfolio-details" title="More Details">Detail</a>
                                        <a href="<?= base_url('vendor/dokumentasi/') . $row->thumbnail ?>" data-gallery="portfolioGallery" class="portfolio-lightbox" title="<?= $row->nama_pengunjung ?>">Lihat</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <!-- End Produk Terbaru Section -->

        <!-- Produk Yang Kami Sediakan Section -->
        <section id="produkYangKamiSediakan">
            <div class="container">
                <div class="section-title" data-aos="fade-in" data-aos-delay="100">
                    <h2>Produk Yang Kami Sediakan</h2>
                    <p>Dapatkan pengalaman berbelanja dengan teknologi AR yang kami sediakan</p>
                </div>
                <!-- Search Bar -->
                <div class="search-bar">
                    <input type="text" id="searchInput" placeholder="Cari produk..." class="form-control">
                </div><br><br>
                <!-- Portfolio Section -->
                <div class="row" id="productContainer">
                    <?php foreach ($dokumentasi as $row): ?>
                        <div class="col-lg-4 col-md-6 mb-4 produk-item" data-product-name="<?= strtolower($row->nama_produk) ?>">
                            <div class="portfolio-item">
                                <div class="portfolio-wrap">
                                    <img src="<?= base_url('vendor/dokumentasi/') . $row->thumbnail ?>" class="img-fluid" alt="<?= $row->nama_produk ?>">
                                </div>
                                <div class="portfolio-info">
                                    <h4><?= $row->nama_produk ?></h4>
                                    <p><strong>Terjual:</strong> <?= $row->terjual; ?> Unit</p>
                                    <p><strong>Stok:</strong> <?= $row->stok; ?> Unit</p>
                                    <?php if ($row->diskon > 0): ?>
                                <strong>Diskon</strong>: <?= $row->diskon; ?>%<br> <br>
                            <?php endif; ?>
                                    <div class="detaillihat">
                                        <a href="<?= base_url('dashboard/dokumentasi/') . $row->id_dokumentasi ?>#portfolio-details" title="Detail Produk">Detail</a>
                                        <a href="<?= base_url('vendor/dokumentasi/') . $row->thumbnail ?>" data-gallery="portfolioGallery" class="portfolio-lightbox" title="<?= $row->nama_pengunjung ?>">Lihat</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="no-products" id="noProductsMessage">Produk tidak tersedia</div>
                <div class="back-button" id="backButton">
                    <button onclick="resetSearch()">Kembali</button>
                </div>
                <!-- End Portfolio Section -->
            </div>
        </section>
        <!-- End Produk Yang Kami Sediakan Section -->
    </main>

    <!-- Owl Carousel JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
        $(document).ready(function(){
            $(".owl-carousel").owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                dots: false,
                autoplay: true,
                autoplayTimeout: 3000,
                autoplayHoverPause: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    768: {
                        items: 3
                    },
                    1024: {
                        items: 5
                    }
                }
            });
        });

        const searchInput = document.getElementById('searchInput');
        const produkItems = document.querySelectorAll('.produk-item');
        const noProductsMessage = document.getElementById('noProductsMessage');
        const backButton = document.getElementById('backButton');

        noProductsMessage.style.display = 'none';

        searchInput.addEventListener('input', function() {
            const searchTerm = searchInput.value.toLowerCase();
            let found = false;

            produkItems.forEach(function(item) {
                const productName = item.getAttribute('data-product-name').toLowerCase();
                if (productName.includes(searchTerm)) {
                    item.style.display = 'block';
                    found = true;
                } else {
                    item.style.display = 'none';
                }
            });

            if (found) {
                noProductsMessage.style.display = 'none';
                backButton.style.display = 'block';
            } else {
                noProductsMessage.style.display = 'block';
                backButton.style.display = 'block';
            }
        });

        function resetSearch() {
            searchInput.value = '';
            produkItems.forEach(function(item) {
                item.style.display = 'block';
            });
            noProductsMessage.style.display = 'none';
            backButton.style.display = 'none';
        }
    </script>
</body>
</html>
