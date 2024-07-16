<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Quote extends CI_Controller
{

    public function index()
    {
        $data = array(
            'title' => 'Apa Kata Pengunjung ?',
            'isi' => 'admin/quote/all'
        );

        $this->load->view('admin/layout', $data, FALSE);
    }
public function tambah()
{
    $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
    $this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'trim|required');
    $this->form_validation->set_rules('quote', 'Quote', 'trim|required');

    if ($this->form_validation->run() == FALSE) {
        $data = array(
            'title' => 'Tambah Apa Kata Pengunjung',
            'isi' => 'admin/quote/tambah'
        );
        $this->load->view('admin/layout', $data, FALSE);
    } else {
        $nama = $this->input->post('nama');
        $pekerjaan = $this->input->post('pekerjaan');
        $quote = $this->input->post('quote');

        // Konfigurasi untuk upload gambar
        $config['upload_path'] = 'vendor/quote/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
        $config['max_size']  = '9999';
        $config['max_width']  = '9999';
        $config['max_height']  = '9999';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('profile')) {
            // Jika upload gagal, tangkap pesan error dan tampilkan dengan benar
            $error = $this->upload->display_errors('<p>', '</p>');
            $this->session->set_flashdata('pesan', "<div class='alert alert-danger'>$error</div>");
            redirect(base_url('admins/quote'));
        } else {
            // Jika upload berhasil, ambil data upload
            $upload_data = $this->upload->data();
            $file_name = $upload_data['file_name'];

            // Data yang akan dimasukkan ke dalam database
            $data = array(
                'nama' => $nama,
                'pekerjaan' => $pekerjaan,
                'quote' => $quote,
                'profile' => $file_name  // Simpan nama file di sini
            );

            // Masukkan data ke dalam tabel tb_quote
            $this->db->insert('tb_quote', $data);

            // Set pesan sukses menggunakan flashdata
            $this->session->set_flashdata('pesan', '<div class="alert alert-success">Berhasil tambah data</div>');

            // Redirect ke halaman admins/quote dengan pesan sukses
            redirect(base_url('admins/quote'));
        }
    }
}

    

    public function hapus($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tb_quote');
        $this->session->set_flashdata('pesan', '<script>alert("Berhasil hapus data")</script>');
        redirect(base_url('admins/quote'));
    }
}

/* End of file Quote.php */
