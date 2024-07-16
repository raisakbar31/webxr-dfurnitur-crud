<!-- application/views/pemilik/datauser/home.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-4"><?php echo $title; ?></h1>
        <a href="<?php echo site_url('pemilik/datauser/tambah'); ?>" class="btn btn-primary mb-3">+ Tambah</a>
        <?php if (!empty($search)) : ?>
            <a href="<?php echo site_url('pemilik/datauser'); ?>" class="btn btn-outline-primary ms-2 mb-3">Kembali</a>
        <?php endif; ?>

        <form action="<?php echo site_url('pemilik/datauser'); ?>" method="GET" class="form-inline mb-3 float-end">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari..." value="<?php echo $search; ?>">
                <button type="submit" class="btn btn-outline-secondary">Cari</button>
            </div>
        </form>

        <div class="d-flex justify-content-end mb-3">
            <a href="<?php echo site_url('pemilik/datauser?sort=tgl_asc'); ?>" class="btn btn-secondary me-2">Urutkan Tanggal: Terlama ke Terbaru</a>
            <a href="<?php echo site_url('pemilik/datauser?sort=tgl_desc'); ?>" class="btn btn-secondary">Urutkan Tanggal: Terbaru ke Terlama</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Tanggal Daftar</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($users)) : ?>
                        <?php $no = 1; foreach ($users as $user) : ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $user->nama; ?></td>
                                <td><?php echo $user->email; ?></td>
                                <td><?php echo $user->role; ?></td>
                                <td><?php echo date('d/m/Y', strtotime($user->tgl_daftar)); ?></td>
                                <td>
                                    <a href="<?php echo site_url('pemilik/datauser/edit/' . $user->id_users); ?>" class="btn btn-primary btn-sm" title="Edit"><i class="bi bi-pencil"></i></a>
                                    <a href="<?php echo site_url('pemilik/datauser/delete/' . $user->id_users); ?>" onclick="return confirm('Yakin hapus data ini?')" class="btn btn-danger btn-sm" title="Hapus"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data user yang tersedia.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
