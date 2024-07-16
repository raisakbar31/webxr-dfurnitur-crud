<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Diskon extends CI_Controller
{
    public function index()
    {
        $data = array(
            'title' => 'Diskon Produk',
            'isi' => 'pemilik/diskon/home'
        );

        $this->load->view('pemilik/layout', $data, FALSE);
    }

    public function update_diskon()
    {
        $id = $this->input->post('id');
        $diskon_baru = $this->input->post('diskon');

        $this->db->where('id_dokumentasi', $id);
        $this->db->update('tb_dokumentasi', ['diskon' => $diskon_baru]);

        echo json_encode(['status' => 'success']);
    }
}
