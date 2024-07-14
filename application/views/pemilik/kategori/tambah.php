<div class="card">
    <div class="card-body">
        <h2 class="card-title">Tambah Kategori</h2>
        <?= form_open('pemilik/kategori/tambah') ?>
            <div class="form-group">
                <label for="nama_kategori">Nama Kategori</label>
                <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" required>
            </div>
            <div class="form-group">
                <label for="deskripsi_kategori">Deskripsi Kategori</label>
                <textarea class="form-control" id="deskripsi_kategori" name="deskripsi_kategori" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
        <?= form_close() ?>
    </div>
</div>