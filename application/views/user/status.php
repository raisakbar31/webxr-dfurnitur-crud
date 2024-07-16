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


<style>
    .containerstatus {
        padding: 20px;
        background-color: #f8f9fa;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .containerstatus h2 {
        margin-bottom: 20px;
        font-weight: 700;
        color: #343a40;
    }
    .form-group input {
        border-radius: 5px;
    }
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        border-radius: 5px;
        padding: 10px 20px;
        font-size: 16px;
        transition: background-color 0.3s, border-color 0.3s;
    }
    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }
    .table {
        margin-top: 20px;
        background-color: #ffffff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .table th, .table td {
        vertical-align: middle;
    }
    .alert {
        margin-top: 20px;
        border-radius: 5px;
    }
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


<!-- application/views/user/status.php -->
<div class="container mt-5">
    <div class="containerstatus">
        <h2 class="text-center">Status Pesanan</h2>
        <h3 class="text-center">D Furnitur</h3><br><br>
        <a href="<?= base_url('dashboard') ?>"> Kembali Ke Landing Page</a><br><br>
        <div class="row">
            <div class="col-md-12">
                <form action="<?= base_url('user/status') ?>" method="post">
                    <div class="form-group">
                        <label for="search_id">Cari berdasarkan ID Penjualan:</label>
                        <input type="text" class="form-control" id="search_id" name="search_id" placeholder="Masukkan ID Penjualan">
                    </div><br>
                    <button type="submit" class="btn btn-primary">Cari</button>
                </form>
            </div>
        </div>
        <hr>
        <?php if ($this->input->post('search_id')): ?>
            <?php if ($orders): ?>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Nama Pelanggan</th>
                                    <th>Nama Produk</th>
                                    <th>Alamat Pengiriman</th>
                                    <th>Kuantitas</th>
                                    <th>Total Harga</th>
                                    <th>Metode Pembayaran</th>
                                    <th>Status Pembayaran</th>
                                    <th>Catatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($orders as $order): ?>
                                    <tr>
                                        <td><?= $order->nama_pelanggan ?></td>
                                        <td><?= $order->nama_produk ?></td>
                                        <td><?= $order->alamat_pengiriman ?></td>
                                        <td><?= $order->kuantitas ?></td>
                                        <td><?= $order->total_harga ?></td>
                                        <td><?= $order->metode_pembayaran ?></td>
                                        <td><?= $order->status_pembayaran ?></td>
                                        <td><?= $order->catatan ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php else: ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-warning" role="alert">
                            Tidak ada data ditemukan.
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>
