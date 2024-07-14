<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Setting Produk</h5>

                    <?php if ($this->session->flashdata('pesan')): ?>
                        <div class="alert alert-info">
                            <?= $this->session->flashdata('pesan'); ?>
                        </div>
                    <?php endif; ?>

                    <!-- General Form Elements -->
                    <form method="POST" enctype="multipart/form-data" action="<?= base_url('pemilik/dokumentasi/tambah') ?>">
                        <div class="row mb-3">
                            <label for="inputNumber" class="col-sm-3 col-form-label">Foto</label>
                            <div class="col-sm-9">
                                <input class="form-control" name="thumbnail" type="file" id="thumbnail" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputNumber" class="col-sm-3 col-form-label">Asset 3D</label>
                            <div class="col-sm-9">
                                <input class="form-control" name="file_d" type="file" id="file_d" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label">Nama Produk</label>
                            <div class="col-sm-9">
                                <input type="text" name="nama_produk" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mb-3">
    <label for="inputText" class="col-sm-3 col-form-label">Kategori</label>
    <div class="col-sm-9">
        <select name="id_kategori" class="form-control" required>
            <?php foreach ($kategori_produk as $kategori) : ?>
                <option value="<?= $kategori['id_kategori'] ?>"><?= $kategori['nama_kategori'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>



                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label">Harga</label>
                            <div class="col-sm-9">
                                <input type="text" name="harga" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label">Stok</label>
                            <div class="col-sm-9">
                                <input type="text" name="stok" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label">Terjual</label>
                            <div class="col-sm-9">
                                <input type="text" name="terjual" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label">Tinggi</label>
                            <div class="col-sm-9">
                                <input type="text" name="tinggi" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label">Panjang</label>
                            <div class="col-sm-9">
                                <input type="text" name="panjang" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label">Lebar</label>
                            <div class="col-sm-9">
                                <input type="text" name="lebar" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label">Bahan</label>
                            <div class="col-sm-9">
                                <input type="text" name="bahan" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label">Tanggal Upload</label>
                            <div class="col-sm-9">
                                <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label">Deskripsi Singkat (Opsional)</label>
                            <div class="col-sm-9">
                                <textarea name="deskripsi" id="" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <small class="text-danger">Format Foto Produk hanya jpg dan png</small>
                            <small class="text-danger">Format Assets 3D hanya GLB</small>                            
                        </div>
                    </form><!-- End General Form Elements -->

                </div>
            </div>

        </div>
    </div>
</section>
