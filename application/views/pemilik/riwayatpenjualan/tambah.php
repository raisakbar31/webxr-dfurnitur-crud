<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="card">
    <div class="card-body">
        <h2 class="card-title">Tambah Data Penjualan</h2>
        <form action="<?= base_url('pemilik/riwayatpenjualan/tambah') ?>" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" required>
            </div>
            <div class="mb-3">
                <label for="no_wa" class="form-label">Nomer Whatsapp</label>
                <input type="number" class="form-control" id="no_wa" name="no_wa" required>
            </div>
            <div class="mb-3">
                <label for="nama_produk" class="form-label">Nama Produk</label>
                <div class="input-group">
                    <input type="text" id="search_produk" class="form-control" placeholder="Cari Nama Produk">
                    <select class="form-select mt-2" id="nama_produk" name="nama_produk" required>
                        <option value="">Pilih Nama Produk</option>
                        <?php foreach ($produk as $item) : ?>
                            <option value="<?= $item ?>"><?= $item ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label for="kuantitas" class="form-label">Kuantitas</label>
                <input type="number" class="form-control" id="kuantitas" name="kuantitas" required>
            </div>
            <div class="mb-3">
                <label for="ongkir" class="form-label">Ongkos Kirim</label>
                <input type="number" class="form-control" id="ongkir" name="ongkir" required>
            </div>
            <div class="mb-3">
                <label for="diskon" class="form-label">Diskon (%)</label>
                <input type="number" class="form-control" id="diskon" name="diskon">
            </div>
            <div class="mb-3">
                <label for="status_pembayaran" class="form-label">Status Pembayaran</label>
                <select class="form-select" id="status_pembayaran" name="status_pembayaran" required>
                    <option value="Lunas">Lunas</option>
                    <option value="Belum Lunas">Belum Lunas</option>
                </select>
            </div>
            <div class="row mb-3">
                <label for="bukti_pembayaran" class="col-sm-3 col-form-label">Bukti Pembayaran</label>
                <div class="col-sm-9">
                    <input class="form-control" name="bukti_pembayaran" type="file" id="bukti_pembayaran" >
                </div>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat Pengiriman</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                <select class="form-select" id="metode_pembayaran" name="metode_pembayaran" required>
                    <option value="Offline Di Toko">Offline Di Toko</option>
                    <option value="Transfer Bank">Transfer Bank</option>
                    <option value="COD">COD</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal Pembelian</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
            </div>
            <div class="mb-3">
                <label for="status_anggota" class="form-label">Status Anggota</label>
                <select class="form-select" id="status_anggota" name="status_anggota" required>
                    <option value="Terdaftar">Terdaftar</option>
                    <option value="Tidak Terdaftar">Tidak Terdaftar</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="catatan" class="form-label">Catatan</label>
                <textarea class="form-control" id="catatan" name="catatan" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?= base_url('pemilik/riwayatpenjualan') ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Pencarian nama produk
        $('#search_produk').on('keyup', function() {
            var searchText = $(this).val().toLowerCase();
            $('#nama_produk option').each(function() {
                var optionText = $(this).text().toLowerCase();
                if (optionText.indexOf(searchText) !== -1) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });

        // Mengambil harga produk berdasarkan nama produk yang dipilih
        $('#nama_produk').change(function() {
            var nama_produk = $(this).val();
            if (nama_produk) {
                $.ajax({
                    url: "<?= base_url('pemilik/get_harga_produk') ?>",
                    method: "POST",
                    data: {nama_produk: nama_produk},
                    dataType: "json",
                    success: function(data) {
                        if (data) {
                            $('#harga').val(data.harga);
                        } else {
                            $('#harga').val('');
                        }
                    }
                });
            } else {
                $('#harga').val('');
            }
        });
    });
</script>
