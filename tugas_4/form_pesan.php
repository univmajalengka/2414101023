<!DOCTYPE html>
<html>
<head>
    <title>Form Pemesanan Paket Wisata</title>
    </head>
<body>
    <h2>Form Pemesanan Paket Wisata</h2>
    <form action="simpan_pesanan.php" method="POST">
        <label>Nama Pemesan:</label><br>
        <input type="text" name="nama" required><br>

        <label>Waktu Pelaksanaan Perjalanan (Hari):</label><br>
        <input type="number" id="durasi" name="durasi" value="1" min="1" onchange="hitungTotal()"><br>

        <label>Jumlah Peserta:</label><br>
        <input type="number" id="peserta" name="peserta" value="1" min="1" onchange="hitungTotal()"><br>

        <p>Pelayanan Paket Perjalanan:</p>
        <input type="checkbox" id="check_inap" name="penginapan" value="1000000" onclick="hitungTotal()">
        <label>Penginapan (Rp 1.000.000)</label><br>

        <input type="checkbox" id="check_trans" name="transport" value="1200000" onclick="hitungTotal()">
        <label>Transportasi (Rp 1.200.000)</label><br>

        <input type="checkbox" id="check_makan" name="makan" value="500000" onclick="hitungTotal()">
        <label>Servis/Makan (Rp 500.000)</label><br>

        <br>
        <label>Harga Paket Perjalanan (Per Orang/Hari):</label><br>
        <input type="text" id="harga_paket" name="harga_paket" readonly><br>

        <label>Jumlah Tagihan:</label><br>
        <input type="text" id="total_tagihan" name="total_tagihan" readonly><br>

        <br>
        <button type="submit" name="simpan">Simpan</button>
        <button type="button" onclick="hitungTotal()">Hitung</button>
        <button type="reset">Reset</button>
    </form>

    <script>
        function hitungTotal() {
            // 1. Ambil nilai durasi dan peserta
            let durasi = parseInt(document.getElementById('durasi').value) || 0;
            let peserta = parseInt(document.getElementById('peserta').value) || 0;

            // 2. Cek checkbox layanan [cite: 21, 22, 23, 24]
            let hargaInap = document.getElementById('check_inap').checked ? 1000000 : 0;
            let hargaTrans = document.getElementById('check_trans').checked ? 1200000 : 0;
            let hargaMakan = document.getElementById('check_makan').checked ? 500000 : 0;

            // 3. Hitung Harga Paket (Total layanan dipilih) [cite: 27]
            let hargaPaket = hargaInap + hargaTrans + hargaMakan;

            // 4. Hitung Total Tagihan (Paket x Hari x Peserta) [cite: 28]
            // Catatan: Rumus disesuaikan dengan logika umum: Total = (Harga Layanan * Peserta * Hari)
            let totalTagihan = hargaPaket * durasi * peserta;

            // 5. Tampilkan ke input field
            document.getElementById('harga_paket').value = hargaPaket;
            document.getElementById('total_tagihan').value = totalTagihan;
        }
    </script>
</body>
</html>