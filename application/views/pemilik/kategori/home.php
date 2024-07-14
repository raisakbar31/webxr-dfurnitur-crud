<div class="card">
    <div class="card-body">
        <div class="card-title d-flex justify-content-between align-items-center">
            <h2>
                <a href="<?= base_url('pemilik/kategori/tambah') ?>" class="btn btn-primary">+ Tambah Kategori</a>
            </h2>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Kategori</th>
                        <th scope="col">Deskripsi Kategori</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($kategori)): ?>
                        <?php $no = 1; foreach ($kategori as $row): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row->nama_kategori ?></td>
                                <td><?= $row->deskripsi_kategori ?></td>
                                <td>
                                    <a href="<?= base_url('pemilik/kategori/edit/') . $row->id_kategori ?>" class="btn btn-primary btn-sm" title="Edit"><i class="bi bi-pencil"></i></a>
                                    <a href="<?= base_url('pemilik/kategori/hapus/') . $row->id_kategori ?>" onclick="return confirm('Yakin hapus kategori ini?')" class="btn btn-danger btn-sm" title="Hapus"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada data kategori yang tersedia.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
