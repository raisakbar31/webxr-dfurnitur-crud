<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{
    public function index()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/register');
        } else {
            $nama = $this->input->post('nama');
            $email = $this->input->post('email');
            $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT); // Enkripsi password
            $role = 'user'; // Atur nilai default untuk role
            $tgl_daftar = date('Y-m-d H:i:s'); // Tanggal pendaftaran

            // Simpan ke database (contoh menggunakan Query Builder)
            $data = array(
                'nama' => $nama,
                'email' => $email,
                'password' => $password,
                'role' => $role,
                'tgl_daftar' => $tgl_daftar
            );
            $this->db->insert('tb_users', $data);

            // Set flashdata untuk pesan berhasil dengan JavaScript
            $this->session->set_flashdata('pesan', '
                <script>
                    alert("Selamat Anda berhasil registrasi dan silahkan login");
                    window.location.href = "'.base_url('admin').'";
                </script>
            ');

            redirect(base_url('register')); // Redirect kembali ke halaman register
        }
    }
}
?>
