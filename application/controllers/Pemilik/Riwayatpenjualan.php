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
    // Set validation rules for the sales data form
    $this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'trim|required');
    $this->form_validation->set_rules('no_wa', 'Nomer Whatsapp', 'trim|required');
    $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'trim|required');
    $this->form_validation->set_rules('kuantitas', 'Kuantitas', 'trim|required|numeric');
    $this->form_validation->set_rules('diskon', 'Diskon', 'trim|numeric');
    $this->form_validation->set_rules('ongkir', 'Ongkos Kirim', 'trim|required|numeric');
    $this->form_validation->set_rules('status_pembayaran', 'Status Pembayaran', 'trim|required');
    $this->form_validation->set_rules('alamat', 'Alamat Pengiriman', 'trim|required');
    $this->form_validation->set_rules('metode_pembayaran', 'Metode Pembayaran', 'trim|required');
    $this->form_validation->set_rules('tanggal', 'Tanggal Pembelian', 'trim|required');
    $this->form_validation->set_rules('status_anggota', 'Status Anggota', 'trim|required');
    $this->form_validation->set_rules('catatan', 'Catatan', 'trim');

    // Get product data from 'tb_dokumentasi' table to display as options
    $produk = $this->db->get('tb_dokumentasi')->result_array();
    $data['produk'] = array_column($produk, 'nama_produk');

    if ($this->form_validation->run() == FALSE) {
        // If validation fails, reload the add sales form with error messages
        $data['title'] = 'Tambah Data Penjualan';
        $data['isi'] = 'pemilik/riwayatpenjualan/tambah';
        $this->load->view('pemilik/layout', $data);
    } else {
        // Retrieve data from the form
        $nama_pelanggan = $this->input->post('nama_pelanggan');
        $no_wa = $this->input->post('no_wa');
        $nama_produk = $this->input->post('nama_produk');
        $kuantitas = $this->input->post('kuantitas');
        $diskon = $this->input->post('diskon');
        $ongkos_kirim = $this->input->post('ongkir');
        $status_pembayaran = $this->input->post('status_pembayaran');
        $alamat = $this->input->post('alamat');
        $metode_pembayaran = $this->input->post('metode_pembayaran');
        $tanggal_pembelian = $this->input->post('tanggal');
        $status_anggota = $this->input->post('status_anggota');
        $catatan = $this->input->post('catatan');

        // Fetch id_dokumentasi and harga from 'tb_dokumentasi' based on nama_produk
        $dokumentasi = $this->db->get_where('tb_dokumentasi', ['nama_produk' => $nama_produk])->row();

        if ($dokumentasi) {
            // Calculate total harga after discount
            $harga_produk = $dokumentasi->harga;
            $harga_setelah_diskon = $harga_produk * (100 - $diskon) / 100;
            $total_harga = $harga_setelah_diskon * $kuantitas + $ongkos_kirim;

            // Check if stock is sufficient
            if ($dokumentasi->stok >= $kuantitas) {
                // Prepare data to be inserted into 'tb_riwayatpenjualan'
                $data_penjualan = [
                    'nama_pelanggan' => $nama_pelanggan,
                    'no_wa' => $no_wa,
                    'id_dokumentasi' => $dokumentasi->id_dokumentasi,
                    'alamat_pengiriman' => $alamat,
                    'kuantitas' => $kuantitas,
                    'diskon' => $diskon,
                    'ongkos_kirim' => $ongkos_kirim,
                    'total_harga' => $total_harga,
                    'metode_pembayaran' => $metode_pembayaran,
                    'bukti_pembayaran' => '', // Handle file upload separately if needed
                    'status_pembayaran' => $status_pembayaran,
                    'tanggal_pembelian' => $tanggal_pembelian,
                    'status_anggota' => $status_anggota,
                    'catatan' => $catatan,
                    'nama_produk' => $nama_produk
                ];

                // Insert data into 'tb_riwayatpenjualan'
                $this->db->insert('tb_riwayatpenjualan', $data_penjualan);

                // Update 'tb_dokumentasi' to reduce stok and increase terjual
                $this->db->where('id_dokumentasi', $dokumentasi->id_dokumentasi);
                $this->db->set('stok', 'stok - ' . $kuantitas, FALSE);
                $this->db->set('terjual', 'terjual + ' . $kuantitas, FALSE);
                $this->db->update('tb_dokumentasi');

                // Redirect to the sales history page with success message
                $this->session->set_flashdata('pesan', '<div class="alert alert-success">Data penjualan berhasil ditambahkan.</div>');
                redirect(base_url('pemilik/riwayatpenjualan'));
            } else {
                // If stock is insufficient, show error message
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Stok produk tidak mencukupi.</div>');
                redirect(base_url('pemilik/riwayatpenjualan/tambah'));
            }
        } else {
            // If product not found in 'tb_dokumentasi', show error message
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Produk tidak ditemukan.</div>');
            redirect(base_url('pemilik/riwayatpenjualan/tambah'));
        }
    }
}

    // ====================edit==============
    // ====================edit==============

    public function edit($id)
    {
        // Aturan validasi form
        $this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'trim|required');
        $this->form_validation->set_rules('no_wa', 'Nomer Whatsapp', 'trim|required');
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'trim|required');
        $this->form_validation->set_rules('kuantitas', 'Kuantitas', 'trim|required|numeric');
        $this->form_validation->set_rules('diskon', 'Diskon', 'trim|numeric');
        $this->form_validation->set_rules('ongkir', 'Ongkos Kirim', 'trim|required|numeric');
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
            // Ambil data penjualan berdasarkan id
            $this->db->select('rp.*, d.nama_produk');
            $this->db->from('tb_riwayatpenjualan rp');
            $this->db->join('tb_dokumentasi d', 'rp.id_dokumentasi = d.id_dokumentasi', 'left');
            $this->db->where('rp.id_penjualan', $id);
            $query = $this->db->get();
            $data['penjualan'] = $query->row_array();

            // Jika data tidak ditemukan, tampilkan pesan error
            if (!$data['penjualan']) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Data penjualan tidak ditemukan.</div>');
                redirect(base_url('pemilik/riwayatpenjualan'));
            }

            // Setup data untuk view
            $data['title'] = 'Edit Data Penjualan';
            $data['isi'] = 'pemilik/riwayatpenjualan/edit';
            $this->load->view('pemilik/layout', $data);
        } else {
            // Ambil data dari form
            $nama_pelanggan = $this->input->post('nama_pelanggan');
            $no_wa = $this->input->post('no_wa');
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
            $harga_setelah_diskon = $kuantitas * $harga_produk * ((100 - $diskon) / 100);
            $total_harga = $harga_setelah_diskon + $this->input->post('ongkir');

            // Upload bukti pembayaran jika ada
            $config['upload_path'] = 'vendor/dokumentasi/'; // sesuaikan dengan lokasi penyimpanan file
            $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('bukti_pembayaran')) {
                $upload_data = $this->upload->data();
                $bukti_pembayaran = $upload_data['file_name'];
            } else {
                $bukti_pembayaran = $this->input->post('bukti_pembayaran_lama'); // gunakan bukti pembayaran lama jika tidak ada upload baru
            }

            // Data yang akan diperbarui ke dalam tb_riwayatpenjualan
            $data_penjualan = [
                'nama_pelanggan' => $nama_pelanggan,
                'no_wa' => $no_wa,
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
                'catatan' => $catatan
            ];

            // Update data di dalam tb_riwayatpenjualan berdasarkan id_penjualan
            $this->db->where('id_penjualan', $id);
            $this->db->update('tb_riwayatpenjualan', $data_penjualan);

            // Redirect ke halaman riwayat penjualan dengan pesan sukses
            $this->session->set_flashdata('pesan', '<div class="alert alert-success">Data penjualan berhasil diperbarui.</div>');
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
