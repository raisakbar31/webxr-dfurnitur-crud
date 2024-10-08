<?php
// Ambil kata kunci pencarian
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Query data dengan filter pencarian
if (!empty($search)) {
    $this->db->like('nama_produk', $search);
    // Tambahkan kondisi pencarian berdasarkan kolom lain jika diperlukan
}
$q = $this->db->get('tb_dokumentasi')->result();
?>
<div class="card">
    <div class="card-body">
        <div class="card-title d-flex justify-content-between align-items-center">
            <h2>
                <a href="<?= base_url('admins/dokumentasi/tambah') ?>" class="btn btn-primary">+ Tambah</a>
            </h2>
            <form action="<?= base_url('admins/dokumentasi') ?>" method="GET" class="form-inline mb-3 float-end">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari...">
                    <button type="submit" class="btn btn-outline-secondary">Cari</button>
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" style="width: 10% !important;">Thumbnail</th>
                        <th scope="col">3D</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Stok</th>
                        <th scope="col">Terjual</th>
                        <th scope="col">Dimensi <br>(T x P x L)</th>
                        <th scope="col">Tanggal Upload</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($q)): ?>
                        <?php $no = 1; foreach ($q as $row): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <img src="<?= base_url('vendor/dokumentasi/') . $row->thumbnail ?>" class="img-thumbnail" alt="Thumbnail">
                                </td>
                                <td><?= $row->file_d ?></td>
                                <td><?= $row->nama_produk ?></td>
                                <td>Rp <?= $row->harga ?></td>
                                <td><?= $row->stok ?></td>
                                <td><?= $row->terjual ?></td>
                                <td><?= $row->tinggi ?> x <?= $row->panjang ?> x <?= $row->lebar ?> cm</td>
                                <td><?= date('d/m/Y', strtotime($row->tanggal)) ?></td>
                                <td>
                                    <?php
                                    $deskripsi = strip_tags($row->deskripsi); // Hapus tag HTML dari deskripsi
                                    $deskripsi = preg_replace('/\s+/', ' ', $deskripsi); // Hapus spasi berlebih
                                    $deskripsi = trim($deskripsi); // Hapus spasi di awal dan akhir

                                    $words = explode(' ', $deskripsi); // Pecah deskripsi menjadi array kata
                                    $short_description = implode(' ', array_slice($words, 0, 10)); // Ambil 10 kata awal
                                    echo $short_description . '...'; // Tampilkan deskripsi pendek diikuti elipsis
                                    ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('admins/dokumentasi/edit/') . $row->id_dokumentasi ?>" class="btn btn-primary btn-sm" title="Edit"><i class="bi bi-pencil"></i></a>
                                    <a href="<?= base_url('admins/dokumentasi/hapus/') . $row->id_dokumentasi ?>" onclick="return confirm('Yakin hapus data ini?')" class="btn btn-danger btn-sm" title="Hapus"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="12" class="text-center">Tidak ada data dokumentasi yang tersedia.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>
