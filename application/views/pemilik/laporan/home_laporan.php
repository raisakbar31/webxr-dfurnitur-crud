<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- pdf -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script> 
    
<br><button onclick="printPDF()" class="btn btn-primary">Cetak PDF</button><br><br>

<div class="card">
    
    <div class="card-body">
        <?php
        // Ambil judul halaman dari tabel tb_settings
        $judul_halaman = ''; // Isi dengan judul halaman dari tabel tb_settings

        echo '<h2 class="card-title">' . $judul_halaman . '</h2>';
        ?>

        
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <center><h4>Laporan Penjualan</h4></center><br>
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Kategori</th>
                        <th scope="col">Jumlah Produk</th>
                        <th scope="col">Produk Terjual</th>
                        <th scope="col">Kuantitas</th>
                        <th scope="col">Total Terjual</th>
                        <th scope="col">Total Pendapatan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($kategori)): ?>
                        <?php $no = 1; foreach ($kategori as $row): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row->nama_kategori ?></td>
                                <td><?= $row->jumlah_produk ?></td>
                                <td>
                                    <?php
                                    // Ambil produk yang terjual dari kategori ini
                                    $this->db->select('tb_dokumentasi.nama_produk, tb_riwayatpenjualan.kuantitas');
                                    $this->db->join('tb_dokumentasi', 'tb_riwayatpenjualan.id_dokumentasi = tb_dokumentasi.id_dokumentasi');
                                    $this->db->where('tb_dokumentasi.id_kategori', $row->id_kategori);
                                    $produk_terjual = $this->db->get('tb_riwayatpenjualan')->result();

                                    foreach ($produk_terjual as $produk) {
                                        echo $produk->nama_produk . '<br>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    // Ambil kuantitas produk yang terjual dari kategori ini
                                    foreach ($produk_terjual as $produk) {
                                        echo $produk->kuantitas . '<br>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    // Hitung total kuantitas produk terjual
                                    $this->db->select_sum('kuantitas');
                                    $this->db->join('tb_dokumentasi', 'tb_riwayatpenjualan.id_dokumentasi = tb_dokumentasi.id_dokumentasi');
                                    $this->db->where('tb_dokumentasi.id_kategori', $row->id_kategori);
                                    $total_terjual = $this->db->get('tb_riwayatpenjualan')->row()->kuantitas;
                                    echo $total_terjual;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    // Hitung total pendapatan dari kategori ini
                                    $this->db->select_sum('total_harga');
                                    $this->db->join('tb_dokumentasi', 'tb_riwayatpenjualan.id_dokumentasi = tb_dokumentasi.id_dokumentasi');
                                    $this->db->where('tb_dokumentasi.id_kategori', $row->id_kategori);
                                    $total_pendapatan = $this->db->get('tb_riwayatpenjualan')->row()->total_harga;
                                    echo 'Rp ' . number_format($total_pendapatan, 0, ',', '.');
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data kategori yang tersedia.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    async function printPDF() {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        const element = document.querySelector('.card-body');

        // Ambil judul halaman dari tabel tb_settings
        const judulHalaman = '<?php echo $judul_halaman; ?>';

        // Tambahkan header dengan judul halaman
        doc.setFontSize(18);
        doc.text(judulHalaman, 14, 20);

        const options = {
            margin: 10,
            filename: 'laporan_penjualan.pdf',
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
        };

        await html2pdf().from(element).set(options).save();
    }
</script>




<!-- ====================== -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

<!-- ===================script pdf -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>

