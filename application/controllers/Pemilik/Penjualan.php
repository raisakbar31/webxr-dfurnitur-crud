<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan extends CI_Controller
{

    public function index()
    {
        $data = array(
            'title' => 'Penjualan ',
            'isi' => 'pemilik/penjualan/home'
        );

        $this->load->view('pemilik/layout', $data, FALSE);
        
    }

// =======================================

// ==========================================

public function update_terjual()
{
    $id = $this->input->post('id');
    $terjual_baru = $this->input->post('terjual');

    // Ambil data dokumentasi berdasarkan id
    $dokumentasi = $this->db->get_where('tb_dokumentasi', ['id_dokumentasi' => $id])->row_array();

    if ($dokumentasi) {
        $terjual_lama = $dokumentasi['terjual'];
        $stok_lama = $dokumentasi['stok'];

        // Hitung perubahan jumlah terjual
        $selisih_terjual = $terjual_baru - $terjual_lama;

        // Hitung stok baru
        $stok_baru = $stok_lama - $selisih_terjual;

        if ($stok_baru >= 0) {
            // Update terjual dan stok
            $this->db->where('id_dokumentasi', $id);
            $this->db->update('tb_dokumentasi', [
                'terjual' => $terjual_baru,
                'stok' => $stok_baru
            ]);

            // Simpan perubahan ke session untuk undo
            $this->session->set_userdata("undo_$id", [
                'terjual' => $terjual_lama,
                'stok' => $stok_lama
            ]);

            echo json_encode(['status' => 'success', 'id' => $id]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Stok tidak mencukupi']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
    }
}

public function undo_update_terjual()
{
    $id = $this->input->post('id');
    $undo_data = $this->session->userdata("undo_$id");

    if ($undo_data) {
        $this->db->where('id_dokumentasi', $id);
        $this->db->update('tb_dokumentasi', [
            'terjual' => $undo_data['terjual'],
            'stok' => $undo_data['stok']
        ]);

        // Hapus data undo dari session
        $this->session->unset_userdata("undo_$id");

        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Tidak ada data untuk undo']);
    }
}





// ==========================================

    // public function edit($id)
    // {
    //     $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'trim|required');
    //     $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');


    //     if ($this->form_validation->run() == FALSE) {
    //         $data = array(
    //             'title' => 'Edit Dokumentasi',
    //             'isi' => 'pemilik/dokumentasi/edit',
    //             'id' => $id
    //         );

    //         $this->load->view('pemilik/layout', $data, FALSE);
    //     } else {
    //         $nama_produk = $this->input->post('nama_produk');
    //         $tanggal = $this->input->post('tanggal');
    //         $deskripsi = $this->input->post('deskripsi');

    //         $config['upload_path'] = 'vendor/dokumentasi/';
    //         $config['allowed_types'] = 'jpg|png';
    //         $config['max_size']  = '9999';
    //         $config['max_width']  = '9999';
    //         $config['max_height']  = '9999';
    //         $config['encrypt_name'] = TRUE;

    //         $this->load->library('upload', $config);

    //         if (!$this->upload->do_upload('thumbnail')) {
    //             $data = array(
    //                 'nama_produk' => $nama_produk,
    //                 'tanggal' => $tanggal,
    //                 'deskripsi' => $deskripsi,
    //             );

    //             $this->db->where('id_dokumentasi', $id);
    //             $this->db->update('tb_dokumentasi', $data);
    //             $this->session->set_flashdata('pesan', '<script>alert("Berhasil update")</script>');
    //             redirect(base_url('pemilik/dokumentasi'));
    //         } else {
    //             $data = array(
    //                 'thumbnail' => $this->upload->data('file_name'),
    //                 'nama_produk' => $nama_produk,
    //                 'tanggal' => $tanggal,
    //                 'deskripsi' => $deskripsi,
    //             );

    //             $this->db->where('id_dokumentasi', $id);
    //             $this->db->update('tb_dokumentasi', $data);
    //             $this->session->set_flashdata('pesan', '<script>alert("Berhasil update")</script>');
    //             redirect(base_url('pemilik/dokumentasi'));
    //         }
    //     }
    // }

    // ==================================sort==========
    

// ===============================

    public function hapus($id)
    {
        $this->db->where('id_dokumentasi', $id);
        $this->db->delete('tb_dokumentasi');
        $this->session->set_flashdata('pesan', '<script>alert("Berhasil hapus data")</script>');
        redirect(base_url('pemilik/dokumentasi'));
    }
}

/* End of file Dokumentasi.php */
