<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dokumentasi extends CI_Controller
{

    public function index()
    {
        $data = array(
            'title' => 'Produk',
            'isi' => 'admin/dokumentasi/home'
        );

        $this->load->view('admin/layout', $data, FALSE);
        
    }

// =======================================

public function tambah()
{
    $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'trim|required');
    $this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');
    $this->form_validation->set_rules('harga', 'Harga', 'trim|required|numeric');
    $this->form_validation->set_rules('stok', 'Stok', 'trim|required|numeric');
    $this->form_validation->set_rules('terjual', 'Terjual', 'trim|required|numeric');
    $this->form_validation->set_rules('tinggi', 'Tinggi', 'trim|required|numeric');
    $this->form_validation->set_rules('panjang', 'Panjang', 'trim|required|numeric');
    $this->form_validation->set_rules('lebar', 'Lebar', 'trim|required|numeric');
    $this->form_validation->set_rules('bahan', 'Bahan', 'trim|required');

    if ($this->form_validation->run() == FALSE) {
        $data = array(
            'title' => 'Tambah Produk',
            'isi' => 'admin/dokumentasi/tambah'
        );
        $this->load->view('admin/layout', $data, FALSE);
    } else {
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
            redirect(base_url('admins/dokumentasi/tambah'));
        } else {
            $thumbnail_data = $this->upload->data('file_name');
            
            // Mendapatkan nama file 3D
            $file_d_name = $_FILES['file_d']['name'];

            // Path untuk menyimpan file 3D
            $file_d_path = 'vendor/dokumentasi/' . $file_d_name;

            if (!move_uploaded_file($_FILES['file_d']['tmp_name'], $file_d_path)) {
                $this->session->set_flashdata('pesan', "<script>alert('Gagal mengunggah file 3D')</script>");
                redirect(base_url('admins/dokumentasi/tambah'));
            } else {
                $data = array(
                    'thumbnail' => $thumbnail_data,
                    'file_d' => $file_d_name, // Menyimpan nama file 3D ke dalam database
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
                );

                $this->db->insert('tb_dokumentasi', $data);
                $this->session->set_flashdata('pesan', '<script>alert("Success Post Dokumentasi")</script>');
                redirect(base_url('admins/dokumentasi'));
            }
        }
    }
}





// ==========================================


public function edit($id)
{
    $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'trim|required');
    $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
    $this->form_validation->set_rules('harga', 'Harga', 'trim|required|numeric');
    $this->form_validation->set_rules('stok', 'Stok', 'trim|required|numeric');
    $this->form_validation->set_rules('terjual', 'Terjual', 'trim|required|numeric');
    $this->form_validation->set_rules('tinggi', 'Tinggi', 'trim|required|numeric');
    $this->form_validation->set_rules('panjang', 'Panjang', 'trim|required|numeric');
    $this->form_validation->set_rules('lebar', 'Lebar', 'trim|required|numeric');
    $this->form_validation->set_rules('bahan', 'Bahan', 'trim|required');

    if ($this->form_validation->run() == FALSE) {
        $data = array(
            'title' => 'Edit Dokumentasi',
            'isi' => 'admin/dokumentasi/edit',
            'id' => $id
        );

        $this->load->view('admin/layout', $data, FALSE);
    } else {
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

        $config['upload_path'] = 'vendor/dokumentasi/';
        $config['allowed_types'] = '*'; // Mengizinkan semua jenis file
        $config['max_size']  = '99999999'; // Atur sesuai kebutuhan Anda
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        $this->db->where('id_dokumentasi', $id);
        $existing_data = $this->db->get('tb_dokumentasi')->row_array();

        // Handle thumbnail upload
        if (!$this->upload->do_upload('thumbnail')) {
            $thumbnail_data = $existing_data['thumbnail'];
        } else {
            $thumbnail_data = $this->upload->data('file_name');
        }

        // Handle file_d upload
        if (!$this->upload->do_upload('file_d')) {
            $file_d_data = $existing_data['file_d'];
        } else {
            $file_d_data = $this->upload->data('file_name');
        }

        // Calculate the change in terjual and adjust stok accordingly
        $change_in_terjual = $terjual - $existing_data['terjual'];
        $new_stok = $existing_data['stok'] - $change_in_terjual;

        if ($new_stok < 0) {
            $this->session->set_flashdata('pesan', '<script>alert("Stok tidak mencukupi")</script>');
            redirect(base_url('admins/dokumentasi/edit/' . $id));
        }

        $data = array(
            'thumbnail' => $thumbnail_data,
            'file_d' => $file_d_data,
            'nama_produk' => $nama_produk,
            'tanggal' => $tanggal,
            'deskripsi' => $deskripsi,
            'harga' => $harga,
            'stok' => $new_stok,
            'terjual' => $terjual,
            'tinggi' => $tinggi,
            'panjang' => $panjang,
            'lebar' => $lebar,
            'bahan' => $bahan,
        );

        $this->db->where('id_dokumentasi', $id);
        if ($this->db->update('tb_dokumentasi', $data)) {
            $this->session->set_flashdata('pesan', '<script>alert("Berhasil update")</script>');
        } else {
            $this->session->set_flashdata('pesan', '<script>alert("Gagal update data")</script>');
        }
        redirect(base_url('admins/dokumentasi'));
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
    //             'isi' => 'admin/dokumentasi/edit',
    //             'id' => $id
    //         );

    //         $this->load->view('admin/layout', $data, FALSE);
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
    //             redirect(base_url('admins/dokumentasi'));
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
    //             redirect(base_url('admins/dokumentasi'));
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
        redirect(base_url('admins/dokumentasi'));
    }
}

/* End of file Dokumentasi.php */
