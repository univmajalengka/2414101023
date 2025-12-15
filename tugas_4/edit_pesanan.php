<?php
session_start();
require 'koneksi.php';

// Cek Admin
if(!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin'){
    header("Location: login.php");
    exit;
}

// Ambil ID dari URL
$id = $_GET['id'];
$query = "SELECT * FROM pesanan WHERE id = $id";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

// Kalo tombol Update ditekan
if(isset($_POST['update'])){
    $nama    = $_POST['nama'];
    $hp      = $_POST['hp'];
    $tgl     = $_POST['tanggal'];
    $durasi  = $_POST['durasi'];
    $peserta = $_POST['peserta'];
    
    // Checkbox Logic
    $inap  = isset($_POST['penginapan']) ? 1 : 0;
    $trans = isset($_POST['transport']) ? 1 : 0;
    $makan = isset($_POST['makan']) ? 1 : 0;
    
    // Harga dari JS
    $harga_paket = $_POST['harga_paket_value']; 
    $total_tagihan = $_POST['total_tagihan_value'];     

    $sql = "UPDATE pesanan SET 
            nama_pemesan='$nama', 
            nomor_hp='$hp', 
            tanggal_pesan='$tgl', 
            waktu_perjalanan='$durasi', 
            jumlah_peserta='$peserta',
            layanan_penginapan='$inap',
            layanan_transport='$trans',
            layanan_makan='$makan',
            harga_paket='$harga_paket',
            total_tagihan='$total_tagihan'
            WHERE id=$id";

    if(mysqli_query($conn, $sql)){
        echo "<script>alert('Data Berhasil Diupdate!'); window.location='admin.php';</script>";
    } else {
        echo "<script>alert('Gagal Update!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Edit Pesanan - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Plus Jakarta Sans', sans-serif; } </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen py-10">

    <div class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-2xl border border-gray-200">
        <div class="flex justify-between items-center mb-6 border-b pb-4">
            <h2 class="text-2xl font-bold text-gray-800">✏️ Edit Pesanan</h2>
            <a href="admin.php" class="text-gray-500 hover:text-red-500 font-bold text-sm"><i class="fa-solid fa-xmark"></i> Batal</a>
        </div>

        <form method="POST">
            <div class="grid md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block font-bold text-sm text-gray-600 mb-1">Nama Pemesan</label>
                    <input type="text" name="nama" value="<?= $data['nama_pemesan'] ?>" class="w-full border rounded-lg p-2.5 bg-gray-50 focus:ring-2 focus:ring-blue-500 outline-none" required>
                </div>
                <div>
                    <label class="block font-bold text-sm text-gray-600 mb-1">WhatsApp</label>
                    <input type="text" name="hp" value="<?= $data['nomor_hp'] ?>" class="w-full border rounded-lg p-2.5 bg-gray-50 focus:ring-2 focus:ring-blue-500 outline-none" required>
                </div>
            </div>

            <div class="mb-4">
                <label class="block font-bold text-sm text-gray-600 mb-1">Tanggal Kunjungan</label>
                <input type="date" name="tanggal" value="<?= $data['tanggal_pesan'] ?>" class="w-full border rounded-lg p-2.5 bg-gray-50 focus:ring-2 focus:ring-blue-500 outline-none" required>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block font-bold text-sm text-gray-600 mb-1">Durasi (Hari)</label>
                    <input type="number" id="durasi" name="durasi" value="<?= $data['waktu_perjalanan'] ?>" oninput="hitungTotal()" class="w-full text-center font-bold text-blue-600 border rounded-lg p-2.5 outline-none" required>
                </div>
                <div>
                    <label class="block font-bold text-sm text-gray-600 mb-1">Peserta (Org)</label>
                    <input type="number" id="peserta" name="peserta" value="<?= $data['jumlah_peserta'] ?>" oninput="hitungTotal()" class="w-full text-center font-bold text-blue-600 border rounded-lg p-2.5 outline-none" required>
                </div>
            </div>

            <div class="bg-blue-50 p-4 rounded-xl border border-blue-100 mb-6">
                <p class="font-bold text-blue-800 mb-2 text-sm">Ubah Layanan:</p>
                <div class="space-y-2">
                    <label class="flex items-center space-x-3 cursor-pointer">
                        <input type="checkbox" id="check_inap" name="penginapan" value="1000000" onclick="hitungTotal()" class="w-5 h-5 text-blue-600 rounded" <?= $data['layanan_penginapan'] ? 'checked' : '' ?>>
                        <span class="text-sm font-medium">Penginapan (Rp 1jt)</span>
                    </label>
                    <label class="flex items-center space-x-3 cursor-pointer">
                        <input type="checkbox" id="check_trans" name="transport" value="1200000" onclick="hitungTotal()" class="w-5 h-5 text-blue-600 rounded" <?= $data['layanan_transport'] ? 'checked' : '' ?>>
                        <span class="text-sm font-medium">Transportasi (Rp 1.2jt)</span>
                    </label>
                    <label class="flex items-center space-x-3 cursor-pointer">
                        <input type="checkbox" id="check_makan" name="makan" value="500000" onclick="hitungTotal()" class="w-5 h-5 text-blue-600 rounded" <?= $data['layanan_makan'] ? 'checked' : '' ?>>
                        <span class="text-sm font-medium">Servis/Makan (Rp 500rb)</span>
                    </label>
                </div>
            </div>

            <div class="bg-gray-800 text-white p-4 rounded-xl mb-6 flex justify-between items-center">
                <span class="text-sm text-gray-400">Total Tagihan Baru:</span>
                <span class="text-2xl font-bold" id="display_total">Rp 0</span>
            </div>

            <input type="hidden" id="input_harga_paket" name="harga_paket_value">
            <input type="hidden" id="input_total_tagihan" name="total_tagihan_value">

            <button type="submit" name="update" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl transition shadow-lg">
                Simpan Perubahan
            </button>
        </form>
    </div>

    <script>
        function hitungTotal() {
            let durasi  = parseInt(document.getElementById('durasi').value) || 0;
            let peserta = parseInt(document.getElementById('peserta').value) || 0;

            let hargaInap  = document.getElementById('check_inap').checked ? 1000000 : 0;
            let hargaTrans = document.getElementById('check_trans').checked ? 1200000 : 0;
            let hargaMakan = document.getElementById('check_makan').checked ? 500000 : 0;

            let hargaPaket = hargaInap + hargaTrans + hargaMakan;
            let totalTagihan = hargaPaket * durasi * peserta;

            let formatter = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 });

            document.getElementById('display_total').innerText = formatter.format(totalTagihan);
            document.getElementById('input_harga_paket').value = hargaPaket;
            document.getElementById('input_total_tagihan').value = totalTagihan;
        }
        window.onload = hitungTotal;
    </script>

</body>
</html>