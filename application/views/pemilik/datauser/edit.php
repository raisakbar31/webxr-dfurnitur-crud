<!-- application/views/pemilik/datauser/edit.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit User</h1>
        <form action="<?php echo site_url('datauser/update'); ?>" method="post" class="needs-validation" novalidate>
            <input type="hidden" name="id_users" value="<?php echo $user->id_users; ?>">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama:</label>
                <input type="text" name="nama" class="form-control" value="<?php echo $user->nama; ?>" required>
                <div class="invalid-feedback">
                    Nama wajib diisi.
                </div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" class="form-control" value="<?php echo $user->email; ?>" required>
                <div class="invalid-feedback">
                    Email wajib diisi.
                </div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" name="password" class="form-control" value="12345" readonly>
                <div class="invalid-feedback">
                    Password wajib diisi.
                </div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password Baru:</label>
                <input type="password" name="password" class="form-control" >
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role:</label>
                <select name="role" class="form-control" required>
                    <option value="" disabled>Pilih role</option>
                    <option value="admin" <?php echo ($user->role == 'admin') ? 'selected' : ''; ?>>Admin</option>
                    <option value="pemilik" <?php echo ($user->role == 'pemilik') ? 'selected' : ''; ?>>Pemilik</option>
                    <option value="user" <?php echo ($user->role == 'user') ? 'selected' : ''; ?>>User</option>
                </select>
                <div class="invalid-feedback">
                    Role wajib dipilih.
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update</button>
            <a href="<?php echo site_url('datauser'); ?>" class="btn btn-secondary mt-3">Kembali</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Bootstrap validation
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
</body>
</html>
