<!-- application/views/pemilik/datauser/tambah.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Tambah User jancok</h1>
        <form action="<?= site_url('datauser/tambah'); ?>" method="post" class="needs-validation" novalidate>            <div class="mb-3">
                <label for="nama" class="form-label">Nama:</label>
                <input type="text" name="nama" class="form-control <?= (form_error('nama') != '') ? 'is-invalid' : ''; ?>" value="<?= set_value('nama'); ?>" required>
                <div class="invalid-feedback">
                    <?= form_error('nama'); ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" class="form-control <?= (form_error('email') != '') ? 'is-invalid' : ''; ?>" value="<?= set_value('email'); ?>" required>
                <div class="invalid-feedback">
                    <?= form_error('email'); ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" name="password" class="form-control <?= (form_error('password') != '') ? 'is-invalid' : ''; ?>" required>
                <div class="invalid-feedback">
                    <?= form_error('password'); ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role:</label>
                <select name="role" class="form-control <?= (form_error('role') != '') ? 'is-invalid' : ''; ?>" required>
                    <option value="" disabled selected>Pilih role</option>
                    <option value="admin" <?= (set_value('role') == 'admin') ? 'selected' : ''; ?>>Admin</option>
                    <option value="pemilik" <?= (set_value('role') == 'pemilik') ? 'selected' : ''; ?>>Pemilik</option>
                    <option value="user" <?= (set_value('role') == 'user') ? 'selected' : ''; ?>>User</option>
                </select>
                <div class="invalid-feedback">
                    <?= form_error('role'); ?>
                </div>
                <input type="hidden" name="tgl_daftar" value="<?= date('Y-m-d H:i:s'); ?>">
                 <button type="submit" class="btn btn-primary mt-3">Simpan</button>
             <a href="<?= base_url('pemilik/datauser') ?>" class="btn btn-secondary mt-3">Batal</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
