<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

    public function index()
    {
        // Ambil data kategori dari database
        $data['kategori'] = $this->db->get('tb_kategori_produk')->result();
        
        $data = array(
            'title' => 'Kategori Produk',
            'isi' => 'pemilik/kategori/home',
            'kategori' => $this->db->get('tb_kategori_produk')->result()
        );

        $this->load->view('pemilik/layout', $data, FALSE);
    }

    public function tambah()
    {
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'trim|required');
        $this->form_validation->set_rules('deskripsi_kategori', 'Deskripsi Kategori', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'Tambah Kategori',
                'isi' => 'pemilik/kategori/tambah'
            );
            $this->load->view('pemilik/layout', $data, FALSE);
        } else {
            $data = array(
                'nama_kategori' => $this->input->post('nama_kategori'),
                'deskripsi_kategori' => $this->input->post('deskripsi_kategori')
            );

            $this->db->insert('tb_kategori_produk', $data);
            $this->session->set_flashdata('pesan', '<script>alert("Kategori berhasil ditambahkan")</script>');
            redirect(base_url('pemilik/kategori'));
        }
    }

    public function edit($id)
    {
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'trim|required');
        $this->form_validation->set_rules('deskripsi_kategori', 'Deskripsi Kategori', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'Edit Kategori',
                'isi' => 'pemilik/kategori/edit',
                'kategori' => $this->db->get_where('tb_kategori_produk', array('id_kategori' => $id))->row()
            );
            $this->load->view('pemilik/layout', $data, FALSE);
        } else {
            $data = array(
                'nama_kategori' => $this->input->post('nama_kategori'),
                'deskripsi_kategori' => $this->input->post('deskripsi_kategori')
            );

            $this->db->where('id_kategori', $id);
            $this->db->update('tb_kategori_produk', $data);
            $this->session->set_flashdata('pesan', '<script>alert("Kategori berhasil diperbarui")</script>');
            redirect(base_url('pemilik/kategori'));
        }
    }

    public function hapus($id)
    {
        $this->db->where('id_kategori', $id);
        $this->db->delete('tb_kategori_produk');
        $this->session->set_flashdata('pesan', '<script>alert("Kategori berhasil dihapus")</script>');
        redirect(base_url('pemilik/kategori'));
    }
}

/* End of file Kategori.php */
?>
