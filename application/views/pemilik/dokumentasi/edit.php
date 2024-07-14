<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit Dokumentasi</h5>

                    <?php if ($this->session->flashdata('pesan')) : ?>
                        <div class="alert alert-info">
                            <?= $this->session->flashdata('pesan'); ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" enctype="multipart/form-data">
                        <div class="row mb-3 mt-3">
                            <label for="thumbnail" class="col-md-4 col-lg-3 col-form-label">Foto saat ini</label>
                            <div class="col-md-8 col-lg-9">
                                <img src="<?= base_url('vendor/dokumentasi/') ?><?= $q['thumbnail']; ?>" width="100%" alt="Thumbnail">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="thumbnail" class="col-sm-3 col-form-label">Foto </label>
                            <div class="col-sm-9">
                                <input class="form-control" name="thumbnail" type="file" id="thumbnail">
                                (Saat ini: <?= $q['thumbnail'] ?>)
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="file_d" class="col-sm-3 col-form-label">Asset 3D </label>
                            <div class="col-sm-9">
                                <input class="form-control" name="file_d" type="file" id="file_d">
                                (Saat ini: <?= $q['file_d'] ?>)
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="nama_produk" class="col-sm-3 col-form-label">Nama Produk</label>
                            <div class="col-sm-9">
                                <input type="text" name="nama_produk" value="<?= $q['nama_produk'] ?>" class="form-control" >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="harga" class="col-sm-3 col-form-label">Harga</label>
                            <div class="col-sm-9">
                                <input type="text" name="harga" value="<?= $q['harga'] ?>" class="form-control" >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="tinggi" class="col-sm-3 col-form-label">Tinggi</label>
                            <div class="col-sm-9">
                                <input type="text" name="tinggi" value="<?= $q['tinggi'] ?>" class="form-control" >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="panjang" class="col-sm-3 col-form-label">Panjang</label>
                            <div class="col-sm-9">
                                <input type="text" name="panjang" value="<?= $q['panjang'] ?>" class="form-control" >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="lebar" class="col-sm-3 col-form-label">Lebar</label>
                            <div class="col-sm-9">
                                <input type="text" name="lebar" value="<?= $q['lebar'] ?>" class="form-control" >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="bahan" class="col-sm-3 col-form-label">Bahan</label>
                            <div class="col-sm-9">
                                <input type="text" name="bahan" value="<?= $q['bahan'] ?>" class="form-control" >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="tanggal" class="col-sm-3 col-form-label">Tanggal Upload</label>
                            <div class="col-sm-9">
                                <input type="date" name="tanggal" class="form-control" value="<?= $q['tanggal'] ?>" >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="id_kategori" class="col-sm-3 col-form-label">Kategori</label>
                            <div class="col-sm-9">
                                <select name="id_kategori" class="form-control" required>
                                    <?php foreach ($kategori_produk as $kategori) : ?>
                                        <option value="<?= $kategori['id_kategori'] ?>" <?= ($kategori['id_kategori'] == $q['id_kategori']) ? 'selected' : '' ?>>
                                            <?= $kategori['nama_kategori'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <small class="text-danger">Format Foto Produk hanya jpg dan png</small>
                            <small class="text-danger">Format Asset 3D adalah semua tipe file</small>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</section>
