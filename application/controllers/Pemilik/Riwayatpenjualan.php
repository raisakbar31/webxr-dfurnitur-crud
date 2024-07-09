<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Riwayatpenjualan extends CI_Controller
{
    public function index()
    {
        // Ambil data riwayat penjualan dari database dengan join tabel dokumentasi
        $this->db->select('rp.*, d.nama_produk, d.harga');
        $this->db->from('tb_riwayatpenjualan rp');
        $this->db->join('tb_dokumentasi d', 'rp.id_dokumentasi = d.id_dokumentasi', 'left');
        $query = $this->db->get();
        $data['q'] = $query->result();

        // Setup data untuk view
        $data['title'] = 'Riwayat Penjualan';
        $data['isi'] = 'pemilik/riwayatpenjualan/home';

        // Load view dengan data yang sudah diambil
        $this->load->view('pemilik/layout', $data);
    }

    public function detail($id_penjualan)
    {
        // Ambil data detail penjualan berdasarkan id_penjualan dengan join tabel dokumentasi
        $this->db->select('rp.*, d.nama_produk, d.harga');
        $this->db->from('tb_riwayatpenjualan rp');
        $this->db->join('tb_dokumentasi d', 'rp.id_dokumentasi = d.id_dokumentasi', 'left');
        $this->db->where('rp.id_penjualan', $id_penjualan);
        $query = $this->db->get();
        $data = $query->row();

        // Menghitung harga setelah diskon
        $diskon = $data->diskon; // Ambil nilai diskon dari data
        $harga_produk = $data->harga; // Ambil harga produk dari data

        // Hitung harga setelah diskon
        $harga_setelah_diskon = $harga_produk - ($harga_produk * ($diskon / 100));
        $data->harga_setelah_diskon = $harga_setelah_diskon;

        // Hitung total harga (contoh sederhana, bisa disesuaikan dengan kebutuhan Anda)
        $total_harga = $harga_setelah_diskon * $data->kuantitas; // Misalnya, total harga adalah harga setelah diskon dikalikan dengan kuantitas

        // Simpan total harga ke dalam database
        $this->db->where('id_penjualan', $id_penjualan);
        $this->db->update('tb_riwayatpenjualan', ['total_harga' => $total_harga]);

        // Tambahkan total harga ke data yang dikirimkan sebagai JSON
        $data->total_harga = $total_harga;

        echo json_encode($data); // Mengirim data sebagai JSON
    }

    // ========================================tambah=========================================

    public function tambah()
    {
        // Set rules validasi untuk form tambah data penjualan
        $this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'trim|required');
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'trim|required');
        $this->form_validation->set_rules('kuantitas', 'Kuantitas', 'trim|required|numeric');
        $this->form_validation->set_rules('diskon', 'Diskon', 'trim|numeric');
        $this->form_validation->set_rules('status_pembayaran', 'Status Pembayaran', 'trim|required');
        $this->form_validation->set_rules('alamat', 'Alamat Pengiriman', 'trim|required');
        $this->form_validation->set_rules('metode_pembayaran', 'Metode Pembayaran', 'trim|required');
        $this->form_validation->set_rules('tanggal', 'Tanggal Pembelian', 'trim|required');
        $this->form_validation->set_rules('status_anggota', 'Status Anggota', 'trim|required');
        $this->form_validation->set_rules('catatan', 'Catatan', 'trim');
    
        // Ambil data produk dari tabel tb_dokumentasi untuk ditampilkan sebagai pilihan
        $this->db->select('nama_produk');
        $query = $this->db->get('tb_dokumentasi');
        $produk = $query->result_array();
        $data['produk'] = array_column($produk, 'nama_produk');
    
        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, tampilkan kembali form tambah dengan pesan error
            $data['title'] = 'Tambah Data Penjualan';
            $data['isi'] = 'pemilik/riwayatpenjualan/tambah';
            $this->load->view('pemilik/layout', $data);
        } else {
            // Ambil data dari form
            $nama_pelanggan = $this->input->post('nama_pelanggan');
            $nama_produk = $this->input->post('nama_produk');
            $kuantitas = $this->input->post('kuantitas');
            $diskon = $this->input->post('diskon');
            $status_pembayaran = $this->input->post('status_pembayaran');
            $alamat = $this->input->post('alamat');
            $metode_pembayaran = $this->input->post('metode_pembayaran');
            $tanggal_pembelian = $this->input->post('tanggal');
            $status_anggota = $this->input->post('status_anggota');
            $catatan = $this->input->post('catatan');
    
            // Ambil id_dokumentasi dan harga dari tb_dokumentasi berdasarkan nama_produk
            $this->db->select('id_dokumentasi, harga');
            $this->db->from('tb_dokumentasi');
            $this->db->where('nama_produk', $nama_produk);
            $query = $this->db->get();
            $dokumentasi = $query->row();
    
            // Hitung total harga
            $harga_produk = $dokumentasi->harga;
            $total_harga = $kuantitas * $harga_produk * ((100 - $diskon) / 100);
    
            // Upload bukti pembayaran
            $config['upload_path'] = 'vendor/dokumentasi/'; // sesuaikan dengan lokasi penyimpanan file
            $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
            $this->load->library('upload', $config);
    
            if ($this->upload->do_upload('bukti_pembayaran')) {
                $upload_data = $this->upload->data();
                $bukti_pembayaran = $upload_data['file_name'];
            } else {
                $bukti_pembayaran = '';
            }
    
            // Data yang akan disimpan ke dalam tb_riwayatpenjualan
            $data_penjualan = [
                'nama_pelanggan' => $nama_pelanggan,
                'id_dokumentasi' => $dokumentasi->id_dokumentasi,
                'alamat_pengiriman' => $alamat,
                'kuantitas' => $kuantitas,
                'diskon' => $diskon,
                'ongkos_kirim' => $this->input->post('ongkir'),
                'total_harga' => $total_harga,
                'metode_pembayaran' => $metode_pembayaran,
                'bukti_pembayaran' => $bukti_pembayaran,
                'status_pembayaran' => $status_pembayaran,
                'tanggal_pembelian' => $tanggal_pembelian,
                'status_anggota' => $status_anggota,
                'catatan' => $catatan,
                'nama_produk' => $nama_produk
            ];
    
            // Insert data ke dalam tb_riwayatpenjualan
            $this->db->insert('tb_riwayatpenjualan', $data_penjualan);
    
            // Redirect ke halaman riwayat penjualan dengan pesan sukses
            $this->session->set_flashdata('pesan', '<div class="alert alert-success">Data penjualan berhasil ditambahkan.</div>');
            redirect(base_url('pemilik/riwayatpenjualan'));
        }
    }

    // ====================edit==============

    public function edit($id)
    {
        // Set rules validasi untuk form edit data penjualan
        $this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'trim|required');
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'trim|required');
        $this->form_validation->set_rules('kuantitas', 'Kuantitas', 'trim|required|numeric');
        $this->form_validation->set_rules('diskon', 'Diskon', 'trim|numeric');
        $this->form_validation->set_rules('status_pembayaran', 'Status Pembayaran', 'trim|required');
        $this->form_validation->set_rules('alamat', 'Alamat Pengiriman', 'trim|required');
        $this->form_validation->set_rules('metode_pembayaran', 'Metode Pembayaran', 'trim|required');
        $this->form_validation->set_rules('tanggal', 'Tanggal Pembelian', 'trim|required');
        $this->form_validation->set_rules('status_anggota', 'Status Anggota', 'trim|required');
        $this->form_validation->set_rules('catatan', 'Catatan', 'trim');
    
        // Ambil data produk dari tabel tb_dokumentasi untuk ditampilkan sebagai pilihan
        $this->db->select('nama_produk');
        $query = $this->db->get('tb_dokumentasi');
        $produk = $query->result_array();
        $data['produk'] = array_column($produk, 'nama_produk');
    
        // Ambil data penjualan dari database berdasarkan id_penjualan
        $q = $this->db->get_where('tb_riwayatpenjualan', ['id_penjualan' => $id])->row_array();
    
        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, tampilkan kembali form edit dengan pesan error
            $data['title'] = 'Edit Data Penjualan';
            $data['isi'] = 'pemilik/riwayatpenjualan/edit';
            $data['q'] = $q; // Kirimkan juga data penjualan yang akan diedit
            $this->load->view('pemilik/layout', $data);
        } else {
            // Ambil data dari form
            $nama_pelanggan = $this->input->post('nama_pelanggan');
            $nama_produk = $this->input->post('nama_produk');
            $kuantitas = $this->input->post('kuantitas');
            $diskon = $this->input->post('diskon');
            $status_pembayaran = $this->input->post('status_pembayaran');
            $alamat = $this->input->post('alamat');
            $metode_pembayaran = $this->input->post('metode_pembayaran');
            $tanggal_pembelian = $this->input->post('tanggal');
            $status_anggota = $this->input->post('status_anggota');
            $catatan = $this->input->post('catatan');
    
            // Ambil id_dokumentasi dan harga dari tb_dokumentasi berdasarkan nama_produk
            $this->db->select('id_dokumentasi, harga');
            $this->db->from('tb_dokumentasi');
            $this->db->where('nama_produk', $nama_produk);
            $query = $this->db->get();
            $dokumentasi = $query->row();
    
            // Hitung total harga
            $harga_produk = $dokumentasi->harga;
            $total_harga = $kuantitas * $harga_produk * ((100 - $diskon) / 100);
    
            // Upload bukti pembayaran (jika ada perubahan)
            $config['upload_path'] = 'vendor/dokumentasi/'; // Sesuaikan dengan lokasi penyimpanan file
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $this->load->library('upload', $config);
    
            if ($this->upload->do_upload('bukti_pembayaran')) {
                $upload_data = $this->upload->data();
                $bukti_pembayaran = $upload_data['file_name'];
            } else {
                $bukti_pembayaran = $q['bukti_pembayaran']; // Gunakan bukti pembayaran yang sudah ada jika tidak ada upload baru
            }
    
            // Data yang akan diupdate ke dalam tb_riwayatpenjualan
            $data_penjualan = [
                'nama_pelanggan' => $nama_pelanggan,
                'nama_produk' => $nama_produk,
                'kuantitas' => $kuantitas,
                'diskon' => $diskon,
                'status_pembayaran' => $status_pembayaran,
                'alamat' => $alamat,
                'metode_pembayaran' => $metode_pembayaran,
                'tanggal' => $tanggal_pembelian,
                'status_anggota' => $status_anggota,
                'catatan' => $catatan,
                'total_harga' => $total_harga,
                'bukti_pembayaran' => $bukti_pembayaran
            ];
    
            // Update data ke dalam tb_riwayatpenjualan berdasarkan $id
            $this->db->where('id_penjualan', $id);
            $this->db->update('tb_riwayatpenjualan', $data_penjualan);
    
            // Redirect ke halaman riwayat penjualan dengan pesan sukses
            $this->session->set_flashdata('pesan', '<div class="alert alert-success">Data penjualan berhasil diupdate.</div>');
            redirect(base_url('pemilik/riwayatpenjualan'));
        }
    }
            




    public function hapus($id)
    {
        $this->db->where('id_penjualan', $id);
        $this->db->delete('tb_riwayatpenjualan');
        $this->session->set_flashdata('pesan', '<script>alert("Berhasil hapus data")</script>');
        redirect(base_url('pemilik/riwayatpenjualan/'));
    }





}
?>
