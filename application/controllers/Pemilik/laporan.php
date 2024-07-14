<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public function index()
    {
        // Ambil data kategori dari database
        $this->db->select('tb_kategori_produk.id_kategori, tb_kategori_produk.nama_kategori, COUNT(tb_dokumentasi.id_dokumentasi) as jumlah_produk');
        $this->db->join('tb_dokumentasi', 'tb_kategori_produk.id_kategori = tb_dokumentasi.id_kategori', 'left');
        $this->db->group_by('tb_kategori_produk.id_kategori');
        $kategori = $this->db->get('tb_kategori_produk')->result();

        $data = array(
            'title' => 'Laporan',
            'isi' => 'pemilik/laporan/home_laporan',
            'kategori' => $kategori,
        );

        $this->load->view('pemilik/layout', $data);
    }

}

?>
