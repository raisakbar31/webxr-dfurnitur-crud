


<style>
    /* Styles for container, card-round, card-stats, card-category, card-title, icon-big, card-list, item-list, username, status, date */
    .container {
        padding: 20px;
    }

    .card-round {
        border-radius: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        background-color: #ffffff;
    }

    .card-stats {
        transition: all 0.3s ease-in-out;
    }

    .card-stats:hover {
        transform: translateY(-5px);
    }

    .card-category {
        font-size: 0.875rem;
        font-weight: 600;
        color: #888;
    }

    .card-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-top: 10px;
    }

    .icon-big {
        width: 60px;
        height: 60px;
        line-height: 60px;
        border-radius: 50%;
        font-size: 1.6rem;
        text-align: center;
    }

    .card-list {
        border-top: 1px solid #e9ecef;
        padding-top: 10px;
    }

    .item-list {
        border-bottom: 1px solid #e9ecef;
        padding-bottom: 10px;
    }

    .item-list:last-child {
        border-bottom: none;
    }

    .username {
        font-size: 1.1rem;
        font-weight: 600;
        color: #333;
    }

    .status {
        font-size: 0.9rem;
        color: #888;
    }

    .date {
        font-size: 0.8rem;
        color: #888;
    }

    /* Button styles */
    .btn-primary {
        background-color: #5e72e4;
        border-color: #5e72e4;
        transition: all 0.3s ease-in-out;
    }

    .btn-primary:hover {
        background-color: #4e5ed9;
        border-color: #4e5ed9;
    }

    .btn-icon {
        padding: 5px;
    }

    /* Card header styles */
    .card-header {
        padding: 10px 20px;
        background-color: #f8f9fa;
        border-bottom: 1px solid #e9ecef;
    }

    /* Additional colors */
    .icon-primary {
        background-color: #3498db;
        color: #ffffff;
    }

    .icon-info {
        background-color: #1abc9c;
        color: #ffffff;
    }

    .icon-success {
        background-color: #2ecc71;
        color: #ffffff;
    }

    .icon-secondary {
        background-color: #95a5a6;
        color: #ffffff;
    }

    /* Dropdown menu */
    .dropdown-menu {
        background-color: #ffffff;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border: 1px solid #e9ecef;
    }

    .dropdown-item {
        color: #333;
    }
    .card-stats {
            transition: transform 0.2s;
        }
        .card-stats:hover {
            transform: scale(1.05);
        }
        .card-primary .icon-primary {
            background-color: #007bff;
        }
        .card-info .icon-info {
            background-color: #17a2b8;
        }
        .card-success .icon-success {
            background-color: #28a745;
        }
        .card-secondary .icon-secondary {
            background-color: #dc3545;
        }
</style>


<?php
// Ambil kata kunci pencarian
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Query data dengan filter pencarian
if (!empty($search)) {
    $this->db->like('nama_produk', $search);
    // Tambahkan kondisi pencarian berdasarkan kolom lain jika diperlukan
}
$q = $this->db->get('tb_dokumentasi')->result();

// Hitung total produk
$total_produk = count($q);

// Hitung total produk terjual
$total_terjual = 0;
foreach ($q as $row) {
    $total_terjual += $row->terjual;
}

// Query untuk menghitung total user dengan role 'user'
$this->db->where('role', 'user');
$total_users = $this->db->count_all_results('tb_users');

// Query untuk menghitung jumlah produk dengan stok kurang dari 10
$this->db->where('stok <', 10);
$total_produk_stok_kurang_dari_10 = $this->db->count_all_results('tb_dokumentasi');

$this->db->where('role', 'user');
$this->db->order_by('tgl_daftar', 'DESC'); // Asumsikan ada kolom 'created_at' untuk menyimpan tanggal pendaftaran pengguna
$this->db->limit(5); // Batasi jumlah pengguna yang diambil, misalnya 5 pengguna terbaru
$users = $this->db->get('tb_users')->result();


// Query untuk mengambil produk terlaris
$this->db->select('nama_produk, terjual');
$this->db->order_by('terjual', 'DESC');
$this->db->limit(5); // Ambil 5 produk terlaris
$produk_terlaris = $this->db->get('tb_dokumentasi')->result();

?>



<!-- grafik -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



<div class="container">
    <div class="page-inner">
        <!-- <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div class="ms-md-auto py-2 py-md-0">
                <a href="#" class="btn btn-primary btn-round">Tambah Pelanggan</a>
            </div>
        </div> -->

        <div class="row">
            <div class="col-md-6">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">Grafik Data Produk</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="produkChart" style="max-height: 400px;"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">Grafik Produk Terlaris</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="produkTerlarisChart" style="max-height: 400px;"></canvas>
                    </div>
                </div>
            </div>
        </div>



 <div class="container mt-5">
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round card-primary">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                    <i class="bi bi-cart-plus"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Produk</p>
                                    <h4 class="card-title"><?= $total_produk ?></h4>
                                </div>
                            </div>
                        </div>
                        <a class="nav-link collapsed" href="<?= base_url('pemilik/dokumentasi') ?>">
                            <button class="btn btn-primary mt-2 w-100">Cek Produk</button>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round card-info">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-info bubble-shadow-small">
                                    <i class="bi bi-shop"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Total Produk Terjual</p>
                                    <h4 class="card-title"><?= $total_terjual ?></h4>
                                </div>
                            </div>
                        </div>
                        <a class="nav-link collapsed" href="<?= base_url('pemilik/laporan') ?>">
                            <button class="btn btn-primary mt-2 w-100">Cek Laporan</button>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round card-success">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-success bubble-shadow-small">
                                    <i class="bi bi-person"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Total Akun Pelanggan</p>
                                    <h4 class="card-title"><?= $total_users ?></h4>
                                </div>
                            </div>
                        </div>
                        <a class="nav-link collapsed" href="<?= base_url('pemilik/user') ?>">
                            <button class="btn btn-primary mt-2 w-100">Cek Akun Pelanggan</button>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round card-secondary">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                    <i class="bi bi-exclamation-circle"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Stok Kurang dari 10</p>
                                    <h4 class="card-title"><?= $total_produk_stok_kurang_dari_10 ?></h4>
                                </div>
                            </div>
                        </div>
                        <a class="nav-link collapsed" href="<?= base_url('pemilik/dokumentasi') ?>">
                            <button class="btn btn-primary mt-2 w-100">Cek Stok Sekarang</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>


        <div class="row">
            <div class="col-md-6">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">Total Pendapatan</div>
                            <h4>Rp <?= number_format($total_pendapatan_keseluruhan, 0, ',', '.') ?></h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card card-round">
                    <div class="card-body">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">Pelanggan Yang Baru Bergabung</div>
                            <div class="card-tools">
                                <div class="dropdown">
                                    <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-list py-4">
                            <?php if (!empty($users)): ?>
                                <?php foreach ($users as $user): ?>
                                    <div class="item-list d-flex align-items-center mb-3">
                                        <div class="info-user ms-3">
                                            <div class="username font-weight-bold"><?= $user->nama ?></div>
                                            <div class="status text-muted"><?= $user->email ?></div>
                                            <div class="date text-muted">Daftar: <?= date('d M Y', strtotime($user->tgl_daftar)) ?></div>
                                        </div>
                                        <div class="ms-auto">
                                            <button class="btn btn-icon btn-link op-8 me-1">
                                                <i class="far fa-envelope"></i>
                                            </button>
                                            <button class="btn btn-icon btn-link btn-danger op-8">
                                                <i class="fas fa-ban"></i>
                                            </button>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="text-center">Tidak ada pengguna baru.</div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>




<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Ambil konteks canvas
        var ctx = document.getElementById('produkChart').getContext('2d');

        // Buat data untuk Chart.js
        var data = {
            labels: ['Total Produk', 'Total Terjual', 'Total Akun Pelanggan', 'Stok < 10'],
            datasets: [{
                label: 'Jumlah',
                data: [<?= $total_produk ?>, <?= $total_terjual ?>, <?= $total_users ?>, <?= $total_produk_stok_kurang_dari_10 ?>],
                backgroundColor: ['#3498db', '#1abc9c', '#e74c3c', '#f39c12'],
                borderColor: ['#2980b9', '#16a085', '#c0392b', '#e67e22'],
                borderWidth: 1
            }]
        };

        // Buat opsi konfigurasi untuk Chart.js
        var options = {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.dataset.label + ': ' + tooltipItem.raw;
                        }
                    }
                }
            }
        };

        // Buat chart bar
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        });
    });
</script>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Ambil konteks canvas untuk grafik produk terlaris
        var ctxProdukTerlaris = document.getElementById('produkTerlarisChart').getContext('2d');

        // Data untuk produk terlaris
        var dataProdukTerlaris = {
            labels: [<?= implode(', ', array_map(function($produk) {
                return "'".$produk->nama_produk."'";
            }, $produk_terlaris)) ?>],
            datasets: [{
                label: 'Jumlah Terjual',
                data: [<?= implode(', ', array_map(function($produk) {
                    return $produk->terjual;
                }, $produk_terlaris)) ?>],
                backgroundColor: '#3498db',
                borderColor: '#2980b9',
                borderWidth: 1
            }]
        };

        // Opsi konfigurasi untuk grafik produk terlaris
        var optionsProdukTerlaris = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.dataset.label + ': ' + tooltipItem.raw;
                        }
                    }
                }
            }
        };

        // Buat chart bar untuk produk terlaris
        var myChartProdukTerlaris = new Chart(ctxProdukTerlaris, {
            type: 'bar',
            data: dataProdukTerlaris,
            options: optionsProdukTerlaris
        });
    });
</script>
