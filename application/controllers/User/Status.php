<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Status extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load required libraries and helpers
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('url');
    }

    public function index()
    {
        // Check if user is logged in
        if (!$this->session->userdata('users')) {
            // Jika user belum login, arahkan ke halaman login atau sesuai kebijakan Anda
            redirect(base_url('admin'));
        }

        // Form validation and other logic
        $this->form_validation->set_rules('search_id', 'Search ID', 'trim');

        // Load data from database
        $settings = $this->db->get('tb_settings')->row_array();
        $dokumentasi = $this->db->get('tb_dokumentasi', 6)->result();
        $quote = $this->db->get('tb_quote')->result();

        // Jika ada input pencarian
        $orders = [];
        if ($this->form_validation->run() && $this->input->post('search_id')) {
            $search_id = $this->input->post('search_id');
            $this->db->where('id_penjualan', $search_id);
            $orders = $this->db->get('tb_riwayatpenjualan')->result();
        } else {
            // Ambil semua data order jika tidak ada pencarian
            $orders = $this->db->get('tb_riwayatpenjualan')->result();
        }

        $data = array(
            'title' => 'D Furnitur',
            'isi' => 'user/status',
            'settings' => $settings,
            'dokumentasi' => $dokumentasi,
            'quote' => $quote,
            'orders' => $orders,
            'user' => $this->session->userdata('users') // Ambil data pengguna dari session
        );

        $this->load->view('user/status', $data, FALSE);
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

/* End of file Status.php */
