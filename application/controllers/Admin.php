<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    // Fungsi index untuk halaman login
    public function index()
    {
        // Set aturan validasi untuk email dan password
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        // Jika validasi gagal, tampilkan halaman login
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/login');
        } else {
            // Ambil input email dan password dari form
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            // Cek user di database berdasarkan email
            $users = $this->db->get_where('tb_users', ['email' => $email])->row_array();

            // Jika user ditemukan
            if ($users) {
                // Verifikasi password
                if (password_verify($password, $users['password'])) {
                    // Siapkan data user untuk session
                    $data = array(
                        'users' => $users
                    );
                    // Set data user ke session
                    $this->session->set_userdata($data);

                    // Arahkan ke dashboard sesuai role user
                    switch ($users['role']) {
                        case 'admin':
                            redirect(base_url('admins/dashboard'));
                            break;
                        case 'pemilik':
                            redirect(base_url('pemilik/dashboard'));
                            break;
                        case 'user':
                            redirect(base_url('user/dashboard'));
                            break;
                        default:
                            // Jika role tidak dikenali, logout
                            $this->session->unset_userdata('users');
                            $this->session->set_flashdata('pesan', '<script>alert("Role tidak dikenali")</script>');
                            redirect(base_url('admin'));
                            break;
                    }
                } else {
                    // Jika password salah
                    $this->session->set_flashdata('pesan', '<script>alert("Password Salah")</script>');
                    redirect(base_url('admin'));
                }
            } else {
                // Jika user tidak ditemukan
                $this->session->set_flashdata('pesan', '<script>alert("Akun tidak ditemukan")</script>');
                redirect(base_url('register'));
            }
        }
    }




    

    // Fungsi logout
    public function logout()
    {
        // Hapus data user dari session
        $this->session->unset_userdata('users');
        // Arahkan ke halaman utama
        redirect(base_url('admin'));
    }
}

/* End of file Admin.php */
