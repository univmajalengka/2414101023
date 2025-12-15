<?php
session_start();
require 'koneksi.php';

// --- CEK KEAMANAN (HANYA ADMIN BOLEH MASUK SINI BRO!) ---
if(!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin'){
    header("Location: login.php");
    exit;
}

// Ambil data pesanan dari database (Join table user biar tau siapa yg pesen)
$query = "SELECT pesanan.*, users.username FROM pesanan 
          LEFT JOIN users ON pesanan.id_user = users.id_user 
          ORDER BY pesanan.id DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Dashboard Admin - God Mode</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Plus Jakarta Sans', sans-serif; } </style>
</head>
<body class="bg-gray-100">

    <nav class="bg-gray-900 text-white p-4 shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="bg-emerald-500 p-2 rounded-lg text-white">
                    <i class="fa-solid fa-user-shield text-xl"></i>
                </div>
                <div>
                    <h1 class="font-bold text-lg leading-none">Admin Panel</h1>
                    <span class="text-xs text-gray-400">Management System</span>
                </div>
            </div>
            
            <div class="flex items-center gap-4">
                <a href="index.php" target="_blank" class="text-gray-300 hover:text-white text-sm transition">
                    <i class="fa-solid fa-globe"></i> Lihat Website
                </a>
                <div class="h-6 w-px bg-gray-700"></div>
                <span class="font-semibold text-emerald-400">Halo, <?= $_SESSION['nama'] ?></span>
                <a href="logout.php" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-lg text-sm font-bold transition shadow-lg shadow-red-900/50">
                    <i class="fa-solid fa-power-off"></i> Logout
                </a>
            </div>
        </div>
    </nav>

    <div class="max-w-[95%] mx-auto p-6 mt-8">
        
        <div class="flex justify-between items-end mb-6">
            <div>
                <h2 class="text-3xl font-bold text-gray-800">Daftar Pesanan Masuk</h2>
                <p class="text-gray-500">Pantau semua transaksi customer lu di sini.</p>
            </div>
            <button onclick="window.print()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-md transition">
                <i class="fa-solid fa-print"></i> Cetak Laporan
            </button>
        </div>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="p-4 text-sm font-semibold tracking-wide">No</th>
                            <th class="p-4 text-sm font-semibold tracking-wide">Customer</th>
                            <th class="p-4 text-sm font-semibold tracking-wide">Tgl Tour</th>
                            <th class="p-4 text-sm font-semibold tracking-wide text-center">Durasi</th>
                            <th class="p-4 text-sm font-semibold tracking-wide text-center">Org</th>
                            <th class="p-4 text-sm font-semibold tracking-wide text-center">Layanan</th>
                            <th class="p-4 text-sm font-semibold tracking-wide">Total Tagihan</th>
                            <th class="p-4 text-sm font-semibold tracking-wide text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 divide-y divide-gray-100">
                        <?php 
                        $i=1; 
                        while($row = mysqli_fetch_assoc($result)) : 
                            // Convert 1/0 jadi Badge
                            $inap = $row['layanan_penginapan'] ? '<span class="bg-blue-100 text-blue-700 px-2 py-0.5 rounded text-xs font-bold">Inap</span>' : '';
                            $trans = $row['layanan_transport'] ? '<span class="bg-orange-100 text-orange-700 px-2 py-0.5 rounded text-xs font-bold">Mobil</span>' : '';
                            $makan = $row['layanan_makan'] ? '<span class="bg-green-100 text-green-700 px-2 py-0.5 rounded text-xs font-bold">Makan</span>' : '';
                        ?>
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="p-4 text-center font-mono text-gray-400"><?= $i++ ?></td>
                            <td class="p-4">
                                <div class="font-bold text-gray-900"><?= $row['nama_pemesan'] ?></div>
                                <div class="text-xs text-gray-500"><i class="fa-brands fa-whatsapp text-emerald-500"></i> <?= $row['nomor_hp'] ?></div>
                            </td>
                            <td class="p-4">
                                <div class="font-semibold"><?= date('d M Y', strtotime($row['tanggal_pesan'])) ?></div>
                            </td>
                            <td class="p-4 text-center">
                                <span class="font-bold"><?= $row['waktu_perjalanan'] ?></span> Hari
                            </td>
                            <td class="p-4 text-center">
                                <span class="font-bold"><?= $row['jumlah_peserta'] ?></span> Org
                            </td>
                            <td class="p-4 text-center">
                                <div class="flex gap-1 justify-center flex-wrap max-w-[150px]">
                                    <?= $inap ?: '<span class="text-gray-300">-</span>' ?>
                                    <?= $trans ?>
                                    <?= $makan ?>
                                </div>
                            </td>
                            <td class="p-4 font-bold text-emerald-600 text-lg">
                                Rp <?= number_format($row['total_tagihan'], 0, ',', '.') ?>
                            </td>
                            <td class="p-4 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="edit_pesanan.php?id=<?= $row['id'] ?>" class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-lg transition shadow-md tooltip" title="Edit Data">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href="hapus.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin mau hapus data punya <?= $row['nama_pemesan'] ?>?')" class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-lg transition shadow-md tooltip" title="Hapus Data">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            
            <?php if(mysqli_num_rows($result) == 0): ?>
                <div class="p-10 text-center text-gray-400">
                    <i class="fa-solid fa-box-open text-6xl mb-4 opacity-50"></i>
                    <p>Belum ada pesanan masuk nih, bos.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>