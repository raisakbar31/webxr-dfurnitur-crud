<?php
$search = isset($_GET['search']) ? $_GET['search'] : '';

if (!empty($search)) {
    $this->db->like('nama_produk', $search);
}
$q = $this->db->get('tb_dokumentasi')->result();
?>
<div class="card">
    <div class="card-body">
        <div class="card-title d-flex justify-content-between align-items-center">
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
                        <th scope="col" style="width: 10%;">Thumbnail</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Stok</th>
                        <th scope="col" style="width: 15%;">Terjual</th>
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
                                <td><?= $row->nama_produk ?></td>
                                <td>Rp <?= $row->harga ?></td>
                                <td><?= $row->stok ?></td>
                                <td>
                                    <input type="text" class="form-control update-terjual" style="width: 80px; display: inline;" data-id="<?= $row->id_dokumentasi ?>" value="<?= $row->terjual ?>">
                                    <button type="button" class="btn btn-warning btn-sm undo-update" data-id="<?= $row->id_dokumentasi ?>" id="undo-<?= $row->id_dokumentasi ?>" style="display: none;">Undo</button>
                                </td>
                                <td>
                                    <a href="<?= base_url('pemilik/penjualan/hapus/') . $row->id_dokumentasi ?>" onclick="return confirm('Yakin hapus data ini?')" class="btn btn-danger btn-sm" title="Hapus"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data dokumentasi yang tersedia.</td>
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
    $('.update-terjual').on('change', function() {
        var id = $(this).data('id');
        var terjual = $(this).val();
        $.ajax({
            url: '<?= base_url('pemilik/penjualan/update_terjual') ?>',
            method: 'POST',
            data: {id: id, terjual: terjual},
            success: function(response) {
                var result = JSON.parse(response);
                if (result.status === 'success') {
                    alert('Data berhasil diperbarui');
                    $('#undo-' + id).show();  // Tampilkan tombol undo
                } else {
                    alert(result.message);
                }
            },
            error: function() {
                alert('Terjadi kesalahan, silakan coba lagi');
            }
        });
    });

    $('.undo-update').on('click', function() {
        var id = $(this).data('id');
        $.ajax({
            url: '<?= base_url('pemilik/penjualan/undo_update_terjual') ?>',
            method: 'POST',
            data: {id: id},
            success: function(response) {
                var result = JSON.parse(response);
                if (result.status === 'success') {
                    alert('Perubahan dibatalkan');
                    location.reload();  // Muat ulang halaman untuk memperbarui tampilan
                } else {
                    alert(result.message);
                }
            },
            error: function() {
                alert('Terjadi kesalahan, silakan coba lagi');
            }
        });
    });
});
</script>
