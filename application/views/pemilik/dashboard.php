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

?>

<?php
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
?>


<div class="container">
          <div class="page-inner">
            <div
              class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
              <div class="ms-md-auto py-2 py-md-0">
                <a href="#" class="btn btn-primary btn-round">Add Customer</a>
              </div>
            </div>
            <div class="row">
            <div class="col-sm-6 col-md-3">

    <div class="card card-stats card-round">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-icon">
                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <div class="col col-stats ms-3 ms-sm-0">
                    <div class="numbers">
                        <p class="card-category">Produk</p>
                        <h4 class="card-title"><?= $total_produk ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-sm-6 col-md-3">
    <div class="card card-stats card-round">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-icon">
                    <div class="icon-big text-center icon-info bubble-shadow-small">
                        <i class="fas fa-user-check"></i>
                    </div>
                </div>
                <div class="col col-stats ms-3 ms-sm-0">
                    <div class="numbers">
                        <p class="card-category">Total Produk Terjual</p>
                        <h4 class="card-title"><?= $total_terjual ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-sm-6 col-md-3">
    <div class="card card-stats card-round">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-icon">
                    <div class="icon-big text-center icon-success bubble-shadow-small">
                        <i class="fas fa-luggage-cart"></i>
                    </div>
                </div>
                <div class="col col-stats ms-3 ms-sm-0">
                    <div class="numbers">
                        <p class="card-category">Total Akun Pelanggan</p>
                        <h4 class="card-title"><?= $total_users ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-sm-6 col-md-3">
    <div class="card card-stats card-round">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-icon">
                    <div class="icon-big text-center icon-secondary bubble-shadow-small">
                        <i class="far fa-check-circle"></i>
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
    <button class="btn btn-primary">
        Cek Stok Sekarang
    </button>
</a>
        </div>
    </div>
</div>


            <div class="row">
              <div class="col-md-8">
              <div class="card card-round">
                  <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                      <div class="card-title">Transaction History</div>
                      <div class="card-tools">
                        <div class="dropdown">
                          <button
                            class="btn btn-icon btn-clean me-0"
                            type="button"
                            id="dropdownMenuButton"
                            data-bs-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                          >
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <div
                            class="dropdown-menu"
                            aria-labelledby="dropdownMenuButton"
                          >
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#"
                              >Something else here</a
                            >
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <!-- Projects table -->
                      <table class="table align-items-center mb-0">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">Payment Number</th>
                            <th scope="col" class="text-end">Date & Time</th>
                            <th scope="col" class="text-end">Amount</th>
                            <th scope="col" class="text-end">Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th scope="row">
                              <button
                                class="btn btn-icon btn-round btn-success btn-sm me-2"
                              >
                                <i class="fa fa-check"></i>
                              </button>
                              Payment from #10231
                            </th>
                            <td class="text-end">Mar 19, 2020, 2.45pm</td>
                            <td class="text-end">$250.00</td>
                            <td class="text-end">
                              <span class="text-end">Completed</span>
                            </td>
                          </tr>
                         
                        </tbody>
                      </table>
                    </div>
                  </div>
              
              </div>
            </div>
        <!-- ================================================================================================ -->
        <div class="row">
    <div class="col-md-4">
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

<style>
    .item-list {
        border-bottom: 1px solid #e9ecef;
        padding-bottom: 10px;
    }
    .item-list:last-child {
        border-bottom: none;
    }
    .username {
        font-size: 1.1rem;
    }
    .status {
        font-size: 0.9rem;
    }
    .date {
        font-size: 0.8rem;
    }
</style>




          </div>
        </div>