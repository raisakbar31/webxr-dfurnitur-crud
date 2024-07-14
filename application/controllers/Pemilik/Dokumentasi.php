<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dokumentasi extends CI_Controller
{

    public function index()
    {
        $data = array(
            'title' => 'Produk',
            'isi' => 'pemilik/dokumentasi/home'
        );

        $this->load->view('pemilik/layout', $data, FALSE);
        
    }

// =======================================

public function tambah()
{
    // Validasi input
    $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'trim|required');
    $this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');
    $this->form_validation->set_rules('harga', 'Harga', 'trim|required|numeric');
    $this->form_validation->set_rules('stok', 'Stok', 'trim|required|numeric');
    $this->form_validation->set_rules('terjual', 'Terjual', 'trim|required|numeric');
    $this->form_validation->set_rules('tinggi', 'Tinggi', 'trim|required|numeric');
    $this->form_validation->set_rules('panjang', 'Panjang', 'trim|required|numeric');
    $this->form_validation->set_rules('lebar', 'Lebar', 'trim|required|numeric');
    $this->form_validation->set_rules('bahan', 'Bahan', 'trim|required');
    $this->form_validation->set_rules('id_kategori', 'Kategori', 'trim|required');

    if ($this->form_validation->run() == FALSE) {
        // Jika validasi gagal, tampilkan kembali form tambah
        $data = array(
            'title' => 'Tambah Produk',
            'isi' => 'pemilik/dokumentasi/tambah',
            'kategori_produk' => $this->db->get('tb_kategori_produk')->result_array()
        );
        $this->load->view('pemilik/layout', $data, FALSE);
    } else {
        // Ambil data dari inputan form
        $nama_produk = $this->input->post('nama_produk');
        $tanggal = $this->input->post('tanggal');
        $deskripsi = $this->input->post('deskripsi');
        $harga = $this->input->post('harga');
        $stok = $this->input->post('stok');
        $terjual = $this->input->post('terjual');
        $tinggi = $this->input->post('tinggi');
        $panjang = $this->input->post('panjang');
        $lebar = $this->input->post('lebar');
        $bahan = $this->input->post('bahan');
        $id_kategori = $this->input->post('id_kategori');

        // Konfigurasi untuk thumbnail
        $config['upload_path'] = 'vendor/dokumentasi';
        $config['allowed_types'] = 'jpg|png';
        $config['max_size']  = '99999';
        $config['max_width']  = '9999';
        $config['max_height']  = '9999';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('thumbnail')) {
            $error = strip_tags($this->upload->display_errors());
            $this->session->set_flashdata('pesan', "<script>alert('$error')</script>");
            redirect(base_url('pemilik/dokumentasi/tambah'));
        } else {
            $thumbnail_data = $this->upload->data('file_name');

            // Mendapatkan nama file 3D
            $file_d_name = $_FILES['file_d']['name'];

            // Path untuk menyimpan file 3D
            $file_d_path = 'vendor/dokumentasi/' . $file_d_name;

            if (!move_uploaded_file($_FILES['file_d']['tmp_name'], $file_d_path)) {
                $this->session->set_flashdata('pesan', "<script>alert('Gagal mengunggah file 3D')</script>");
                redirect(base_url('pemilik/dokumentasi/tambah'));
            } else {
                $data = array(
                    'thumbnail' => $thumbnail_data,
                    'file_d' => $file_d_name,
                    'nama_produk' => $nama_produk,
                    'tanggal' => $tanggal,
                    'deskripsi' => $deskripsi,
                    'harga' => $harga,
                    'stok' => $stok,
                    'terjual' => $terjual,
                    'tinggi' => $tinggi,
                    'panjang' => $panjang,
                    'lebar' => $lebar,
                    'bahan' => $bahan,
                    'id_kategori' => $id_kategori
                );

                $this->db->insert('tb_dokumentasi', $data);
                $this->session->set_flashdata('pesan', '<script>alert("Success Post Dokumentasi")</script>');
                redirect(base_url('pemilik/dokumentasi'));
            }
        }
    }
}






// ==========================================


public function edit($id)
{
    // Ambil data produk berdasarkan $id
    $q = $this->db->get_where('tb_dokumentasi', ['id_dokumentasi' => $id])->row_array();

    // Ambil data kategori produk untuk dropdown
    $kategori_produk = $this->db->get('tb_kategori_produk')->result_array();

    // Validasi form
    $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'trim|required');
    $this->form_validation->set_rules('harga', 'Harga', 'trim|required|numeric');
    $this->form_validation->set_rules('tinggi', 'Tinggi', 'trim|required|numeric');
    $this->form_validation->set_rules('panjang', 'Panjang', 'trim|required|numeric');
    $this->form_validation->set_rules('lebar', 'Lebar', 'trim|required|numeric');
    $this->form_validation->set_rules('bahan', 'Bahan', 'trim|required');
    $this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');

    if ($this->form_validation->run() == FALSE) {
        // Jika validasi gagal, tampilkan kembali form edit dengan data yang sudah ada
        $data = array(
            'title' => 'Edit Dokumentasi',
            'isi' => 'pemilik/dokumentasi/edit',
            'q' => $q,
            'kategori_produk' => $kategori_produk
        );
        $this->load->view('pemilik/layout', $data, FALSE);
    } else {
        // Ambil data dari inputan form
        $nama_produk = $this->input->post('nama_produk');
        $harga = $this->input->post('harga');
        $tinggi = $this->input->post('tinggi');
        $panjang = $this->input->post('panjang');
        $lebar = $this->input->post('lebar');
        $bahan = $this->input->post('bahan');
        $tanggal = $this->input->post('tanggal');
        $id_kategori = $this->input->post('id_kategori');

        // Konfigurasi upload thumbnail
        $config['upload_path'] = 'vendor/dokumentasi';
        $config['allowed_types'] = 'jpg|png';
        $config['max_size']  = '99999';
        $config['max_width']  = '9999';
        $config['max_height']  = '9999';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        // Cek apakah ada file thumbnail yang diupload
        if ($_FILES['thumbnail']['name']) {
            if (!$this->upload->do_upload('thumbnail')) {
                $error = strip_tags($this->upload->display_errors());
                $this->session->set_flashdata('pesan', "<script>alert('$error')</script>");
                redirect(base_url('pemilik/dokumentasi/edit/' . $id));
            } else {
                $thumbnail_data = $this->upload->data('file_name');
            }
        } else {
            $thumbnail_data = $q['thumbnail'];
        }

        // Cek apakah ada file asset 3D yang diupload
        if ($_FILES['file_d']['name']) {
            // Mendapatkan nama file 3D
            $file_d_name = $_FILES['file_d']['name'];

            // Path untuk menyimpan file 3D
            $file_d_path = 'vendor/dokumentasi/' . $file_d_name;

            if (!move_uploaded_file($_FILES['file_d']['tmp_name'], $file_d_path)) {
                $this->session->set_flashdata('pesan', "<script>alert('Gagal mengunggah file 3D')</script>");
                redirect(base_url('pemilik/dokumentasi/edit/' . $id));
            }
        } else {
            $file_d_name = $q['file_d'];
        }

        // Data untuk diupdate
        $data = array(
            'thumbnail' => $thumbnail_data,
            'file_d' => $file_d_name,
            'nama_produk' => $nama_produk,
            'harga' => $harga,
            'tinggi' => $tinggi,
            'panjang' => $panjang,
            'lebar' => $lebar,
            'bahan' => $bahan,
            'tanggal' => $tanggal,
            'id_kategori' => $id_kategori
        );

        // Update data di database
        $this->db->where('id_dokumentasi', $id);
        $this->db->update('tb_dokumentasi', $data);

        // Set flashdata untuk pesan sukses
        $this->session->set_flashdata('pesan', '<script>alert("Data berhasil diupdate")</script>');

        // Redirect ke halaman dokumentasi
        redirect(base_url('pemilik/dokumentasi'));
    }
}


// ======================update stok dan tombol redo===================
public function update_stok()
{
    $id = $this->input->post('id');
    $stok_baru = $this->input->post('stok');
    $stok_lama = $this->input->post('stok_lama');

    $this->db->where('id_dokumentasi', $id);
    $this->db->update('tb_dokumentasi', ['stok' => $stok_baru]);

    echo json_encode(['status' => 'success', 'stok_lama' => $stok_lama]);
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


// =====================edit data di home=====================

