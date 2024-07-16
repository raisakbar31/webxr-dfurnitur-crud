<?php
// Ambil kata kunci pencarian dan pengurutan
$search = isset($_GET['search']) ? $_GET['search'] : '';
$sort = isset($_GET['sort']) ? $_GET['sort'] : '';

// Query data dengan filter pencarian dan pengurutan
$this->db->select('tb_dokumentasi.id_dokumentasi, tb_dokumentasi.thumbnail, tb_dokumentasi.nama_produk, tb_dokumentasi.id_kategori, tb_dokumentasi.diskon, tb_kategori_produk.nama_kategori');
$this->db->from('tb_dokumentasi');
$this->db->join('tb_kategori_produk', 'tb_dokumentasi.id_kategori = tb_kategori_produk.id_kategori', 'left');
if (!empty($search)) {
    $this->db->like('nama_produk', $search);
}
$q = $this->db->get()->result();
?>

<div class="card">
    <div class="card-body">
        <div class="card-title d-flex justify-content-between align-items-center">
            <h2>
                <?php if (!empty($search)): ?>
                    <a href="<?= base_url('pemilik/dokumentasi') ?>" class="btn btn-outline-primary ms-2">Kembali</a>
                <?php endif; ?>
            </h2>
            <form action="<?= base_url('pemilik/dokumentasi') ?>" method="GET" class="form-inline mb-3 float-end">
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
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Diskon</th>
                        <th scope="col">Kategori</th>
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
                                <td><?= $row->nama_produk ?></td>
                                <td>
                                    <input type="text" class="form-control update-diskon" style="width: 80px;" data-id="<?= $row->id_dokumentasi ?>" value="<?= $row->diskon ?>">
                                </td>
                                <td><?= $row->nama_kategori ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data dokumentasi yang tersedia.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    $('.update-diskon').on('change', function() {
        var id = $(this).data('id');
        var diskon_baru = $(this).val();

        $.ajax({
            url: '<?= base_url('pemilik/diskon/update_diskon') ?>',
            method: 'POST',
            data: {id: id, diskon: diskon_baru},
            success: function(response) {
                var result = JSON.parse(response);
                if (result.status === 'success') {
                    alert('Diskon berhasil diperbarui');
                } else {
                    alert('Gagal memperbarui diskon');
                }
            },
            error: function() {
                alert('Terjadi kesalahan, silakan coba lagi');
            }
        });
    });
});
</script>
