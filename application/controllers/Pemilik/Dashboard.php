<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function index()
    {
        // Hitung total pendapatan dari semua kategori
        $this->db->select_sum('total_harga');
        $total_pendapatan_keseluruhan = $this->db->get('tb_riwayatpenjualan')->row()->total_harga;

        $data = array(
            'title' => 'Dashboard',
            'isi' => 'pemilik/dashboard',
            'total_pendapatan_keseluruhan' => $total_pendapatan_keseluruhan,
        );

        $this->load->view('pemilik/layout', $data);
    }

}

?>
