<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Datauser extends CI_Controller
{
    public function index()
    {
        // Memuat library database
        $this->load->database();

        // Mengambil parameter pencarian dan pengurutan dari URL
        $search = $this->input->get('search');
        $sort = $this->input->get('sort');

        // Membangun query
        $this->db->select('*');
        $this->db->from('tb_users');

        // Menerapkan filter pencarian jika ada
        if (!empty($search)) {
            $this->db->like('nama', $search);
            $this->db->or_like('email', $search);
        }

        // Menerapkan pengurutan jika ada
        if ($sort == 'tgl_asc') {
            $this->db->order_by('tgl_daftar', 'ASC');
        } elseif ($sort == 'tgl_desc') {
            $this->db->order_by('tgl_daftar', 'DESC');
        }

        // Menjalankan query
        $query = $this->db->get();
        $users = $query->result();

        // Menyiapkan data untuk ditampilkan di view
        $data = array(
            'title' => 'Setting Profile',
            'users' => $users,
            'search' => $search,
            'isi' => 'pemilik/datauser/home'
        );

        // Memuat view dengan data yang telah disiapkan
        $this->load->view('pemilik/layout', $data, FALSE);
    }
    
    public function tambah()
    {
        // Validasi input
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[tb_users.email]', [
            'is_unique' => 'Email sudah digunakan, silakan gunakan email lain.'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('role', 'Role', 'trim|required');
    
        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, tampilkan kembali form tambah dengan pesan error
            $data = array(
                'title' => 'Tambah User',
                'isi' => 'pemilik/datauser/tambah'
            );
            $this->load->view('pemilik/layout', $data, FALSE);
        } else {
            // Ambil data dari inputan form
            $nama = $this->input->post('nama');
            $email = $this->input->post('email');
            $password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
            $role = $this->input->post('role');
            $tgl_daftar = date('Y-m-d H:i:s');
    
            // Data untuk dimasukkan ke database
            $data = array(
                'nama' => $nama,
                'email' => $email,
                'password' => $password,
                'role' => $role,
                'tgl_daftar' => $tgl_daftar
            );
    
            // Masukkan data ke database
            $this->db->insert('tb_users', $data);
    
            // Set pesan sukses menggunakan flashdata
            $this->session->set_flashdata('pesan', 'User berhasil ditambahkan.');
    
            // Redirect ke halaman datauser dengan pesan sukses
            redirect(base_url('pemilik/datauser'));
        }
    }
    
    

    public function edit($id_users = NULL)
    {
        // Memuat library database
        $this->load->database();

        // Mengambil data user berdasarkan id_users
        $this->db->select('*');
        $this->db->from('tb_users');
        $this->db->where('id_users', $id_users);
        $query = $this->db->get();
        $user = $query->row();

        // Menyiapkan data untuk view edit user
        $data = array(
            'title' => 'Edit User',
            'user' => $user,
            'isi' => 'pemilik/datauser/edit'
        );

        // Memuat view edit user dengan layout yang sudah ditentukan
        $this->load->view('pemilik/layout', $data, FALSE);
    }

    public function update()
    {
        // Memuat library database
        $this->load->database();

        // Mengambil data input dari form edit user
        $id_users = $this->input->post('id_users');
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $role = $this->input->post('role');

        // Menyiapkan data untuk update
        $data = array(
            'nama' => $nama,
            'email' => $email,
            'role' => $role
        );

        // Memperbarui password jika diinput
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_BCRYPT); // Mengenkripsi password
        }

        // Melakukan update data user di dalam tabel tb_users
        $this->db->where('id_users', $id_users);
        $this->db->update('tb_users', $data);

        // Mengalihkan (redirect) ke halaman datauser setelah update
        redirect('datauser');
    }
}
