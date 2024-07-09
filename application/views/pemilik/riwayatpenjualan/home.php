<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<div class="card">
    <div class="card-body">
        <div class="card-title d-flex justify-content-between align-items-center">
            <h2>
                <a href="<?= base_url('pemilik/riwayatpenjualan/tambah') ?>" class="btn btn-primary">+ Tambah</a>
            </h2>
        </div>
        
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Pelanggan</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Harga Produk</th>
                        <th scope="col">Kuantitas</th>
                        <th scope="col">Diskon</th>
                        <th scope="col">Total Harga</th>
                        <th scope="col">Status Pembayaran</th>
                        <th scope="col">Tanggal Pembelian</th>
                        <th scope="col">Catatan</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($q)): ?>
                        <?php $no = 1; foreach ($q as $row): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row->nama_pelanggan ?></td>
                                <td><?= $row->nama_produk ?></td> <!-- Menampilkan nama produk -->
                                <td><?= $row->harga ?></td>
                                <td><?= $row->kuantitas ?></td>
                                <td><?= $row->diskon ?></td>
                                <td><?= $row->total_harga ?></td>
                                <td><?= $row->status_pembayaran ?></td>
                                <td><?= $row->tanggal_pembelian ?></td>
                                <td><?= $row->catatan ?></td>
                                <td>
                                    <button class="btn btn-primary btn-sm" onclick="showDetail(<?= $row->id_penjualan ?>)" title="Detail"><i class="bi bi-eye-fill"></i></button>
                                    <a href="<?= base_url('pemilik/riwayatpenjualan/edit/') . $row->id_penjualan ?>" class="btn btn-primary btn-sm" title="Edit"><i class="bi bi-pencil"></i></a>
                                    <a href="<?= base_url('pemilik/riwayatpenjualan/hapus/') . $row->id_penjualan ?>" onclick="return confirm('Yakin hapus data ini?')" class="btn btn-danger btn-sm" title="Hapus"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="17" class="text-center">Tidak ada data riwayat penjualan yang tersedia.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal untuk menampilkan detail penjualan -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Penjualan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tr>
                        <th>ID Penjualan</th>
                        <td id="id_penjualan"></td>
                    </tr>
                    <tr>
                        <th>Nama Pelanggan</th>
                        <td id="nama_pelanggan"></td>
                    </tr>
                    <tr>
                        <th>Nama Produk</th>
                        <td id="nama_produk"></td> <!-- Menampilkan nama produk -->
                    </tr>
                    <tr>
                        <th>ID Dokumentasi</th>
                        <td id="id_dokumentasi"></td>
                    </tr>
                    <tr>
                        <th>Alamat Pengiriman</th>
                        <td id="alamat_pengiriman"></td>
                    </tr>
                    <tr>
                        <th>No WhatsApp</th>
                        <td id="no_wa"></td>
                    </tr>
                    <tr>
                        <th>Kuantitas</th>
                        <td id="kuantitas"></td>
                    </tr>
                    <tr>
                        <th>Diskon</th>
                        <td id="diskon"></td>
                    </tr>
                    <!-- Hanya menampilkan Harga Setelah Diskon di dalam modal -->
                    <tr>
                        <th>Harga Setelah Diskon</th>
                        <td id="harga_setelah_diskon"></td>
                    </tr>
                    <tr>
                        <th>Ongkos Kirim</th>
                        <td id="ongkos_kirim"></td>
                    </tr>
                    <tr>
                        <th>Total Harga satuan</th>
                        <td id="total_harga"></td>
                    </tr>
                    <tr>
                        <th>Metode Pembayaran</th>
                        <td id="metode_pembayaran"></td>
                    </tr>
                    <tr>
                        <th>Status Pembayaran</th>
                        <td id="status_pembayaran"></td>
                    </tr>
                    <tr>
                        <th>Tanggal Pembelian</th>
                        <td id="tanggal_pembelian"></td>
                    </tr>
                    <tr>
                        <th>Status Anggota</th>
                        <td id="status_anggota"></td>
                    </tr>
                    <tr>
                        <th>Catatan</th>
                        <td id="catatan"></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    function showDetail(id_penjualan) {
        // Lakukan request AJAX untuk mengambil data detail penjualan
        $.ajax({
            url: "<?= base_url('pemilik/riwayatpenjualan/detail/') ?>" + id_penjualan,
            method: "GET",
            dataType: "json",
            success: function(data) {
                // Hitung total harga berdasarkan harga setelah diskon dan ongkos kirim
                var totalHarga = parseFloat(data.harga_setelah_diskon) + parseFloat(data.ongkos_kirim);
                
                // Isi data ke dalam modal
                $('#id_penjualan').text(data.id_penjualan);
                $('#nama_pelanggan').text(data.nama_pelanggan);
                $('#nama_produk').text(data.nama_produk); // Menampilkan nama produk
                $('#id_dokumentasi').text(data.id_dokumentasi);
                $('#alamat_pengiriman').text(data.alamat_pengiriman);
                $('#no_wa').text(data.no_wa);
                $('#kuantitas').text(data.kuantitas);
                $('#diskon').text(data.diskon);
                $('#harga_setelah_diskon').text(data.harga_setelah_diskon);
                $('#ongkos_kirim').text(data.ongkos_kirim);
                $('#total_harga').text(totalHarga); // Menampilkan total harga dengan dua angka desimal
                $('#metode_pembayaran').text(data.metode_pembayaran);
                $('#status_pembayaran').text(data.status_pembayaran);
                $('#tanggal_pembelian').text(data.tanggal_pembelian);
                $('#status_anggota').text(data.status_anggota);
                $('#catatan').text(data.catatan);

                // Tampilkan modal
                $('#detailModal').modal('show');
            }
        });
    }
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
