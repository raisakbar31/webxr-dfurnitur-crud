<?php 
$user_id = 1; // Ganti dengan id pengguna yang sesuai
$user = $this->db->get_where('tb_users', ['id_users' => $user_id])->row_array(); 
?>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit Pengguna</h5>
                    <form method="POST" action="<?= base_url('admin/users/edit/' . $user['id_users']) ?>">
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" name="nama" value="<?= isset($user['nama']) ? $user['nama'] : '' ?>" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" name="email" value="<?= isset($user['email']) ? $user['email'] : '' ?>" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" name="password" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputRole" class="col-sm-3 col-form-label">Role</label>
                            <div class="col-sm-9">
                                <select name="role" class="form-control">
                                    <option value="admin" <?= (isset($user['role']) && $user['role'] == 'admin') ? 'selected' : '' ?>>Admin</option>
                                    <option value="user" <?= (isset($user['role']) && $user['role'] == 'user') ? 'selected' : '' ?>>User</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
