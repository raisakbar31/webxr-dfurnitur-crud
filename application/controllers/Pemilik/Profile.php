<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{

    public function index()
    {
        $data = array(
            'title' => 'setting Profile',
            'isi' => 'pemilik/settings/profile'
        );

        $this->load->view('pemilik/layout', $data, FALSE);
        
    }
    // Controller: application/controllers/Admin.php (contoh nama controller)
public function users_edit($user_id)
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data = [
            'nama' => $this->input->post('nama'),
            'email' => $this->input->post('email'),
            'role' => $this->input->post('role'),
        ];

        // Jika password diisi, update juga password
        $password = $this->input->post('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        // Lakukan update ke database
        $this->db->where('id_users', $user_id);
        $this->db->update('tb_users', $data);

        // Redirect ke halaman atau lakukan tindakan lain setelah update
        redirect('admin/users'); // Contoh redirect ke halaman daftar pengguna
    } else {
        // Tampilkan halaman form edit jika tidak ada post data
        $this->load->view('admin/users_edit', ['user_id' => $user_id]);
    }
}

}
?>