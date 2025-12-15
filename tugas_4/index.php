<?php
// ============================================================================
// 1. BAGIAN PHP (LOGIKA BACKEND)
// ============================================================================
session_start(); 

// --- Konfigurasi Database ---
$host = "localhost";
$user = "root";
$pass = "";
$db   = "wisata_db";

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) { die("Koneksi Database Gagal: " . mysqli_connect_error()); }

// --- Data Website ---
$site_name = "Curug Cirangkong";
$wa_number = "6283856449099"; // NOMOR WA ADMIN

// --- Link Sosmed ---
$link_ig     = "https://www.instagram.com/curung_cirangkong_smd";
$link_tiktok = "https://www.tiktok.com/@curug.cirangkong";
$link_fb     = "https://www.facebook.com/share/1FsRzx6KwJ/";

// --- Cek Status Admin ---
$isAdmin = false;
if(isset($_SESSION['login']) && $_SESSION['role'] == 'admin'){
    $isAdmin = true;
}

// --- Logika Simpan Pesanan ---
$pesan_sukses = false;
$pesan_error = "";
$nominal_sukses = 0; 

if(isset($_POST['simpan_pesanan'])){
    if(!isset($_SESSION['login'])){
        echo "<script>alert('Silakan Login dulu untuk memesan!'); window.location='login.php';</script>";
        exit;
    }

    $id_user = $_SESSION['id_user'];
    $nama    = mysqli_real_escape_string($conn, $_POST['nama']);
    $hp      = mysqli_real_escape_string($conn, $_POST['hp']);
    $tgl     = $_POST['tanggal'];
    $durasi  = $_POST['durasi'];
    $peserta = $_POST['peserta'];
    $jenis_paket = isset($_POST['jenis_paket']) ? $_POST['jenis_paket'] : '-';

    $inap  = isset($_POST['penginapan']) ? 1 : 0;
    $trans = isset($_POST['transport']) ? 1 : 0;
    $makan = isset($_POST['makan']) ? 1 : 0;
    
    $harga_paket = $_POST['harga_paket_value']; 
    $total_tagihan = $_POST['total_tagihan_value'];     

    if(!empty($nama)){
        $sql = "INSERT INTO pesanan (id_user, nama_pemesan, nomor_hp, tanggal_pesan, waktu_perjalanan, jumlah_peserta, layanan_penginapan, layanan_transport, layanan_makan, harga_paket, total_tagihan) 
                VALUES ('$id_user', '$nama', '$hp', '$tgl', '$durasi', '$peserta', '$inap', '$trans', '$makan', '$harga_paket', '$total_tagihan')";
        
        if(mysqli_query($conn, $sql)){
            $pesan_sukses = true;
            $nominal_sukses = $total_tagihan; 
        } else {
            $pesan_error = "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wisata <?= $site_name ?></title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        h1, h2, h3 { font-family: 'Playfair Display', serif; }
        
        .hero-bg {
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.7)), url('img/banner.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        
        /* Glass Nav */
        .glass-nav {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
        .dark .glass-nav {
            background: rgba(17, 24, 39, 0.9);
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
    </style>
</head>
<body class="bg-stone-50 text-gray-800 transition-colors duration-300 dark:bg-gray-900 dark:text-gray-200">

    <?php if($isAdmin): ?>
    <a href="admin.php" class="fixed bottom-24 left-5 z-[9999] bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-3 rounded-full shadow-lg shadow-indigo-500/50 flex items-center gap-2 transition transform hover:scale-105 animate-bounce">
        <i class="fa-solid fa-user-shield text-xl"></i>
        <span class="font-bold text-sm">Lihat Pesanan</span>
    </a>
    <?php endif; ?>

    <button id="theme-toggle" class="fixed bottom-5 left-5 z-[9999] bg-gray-800 dark:bg-yellow-400 text-white dark:text-gray-900 w-12 h-12 rounded-full shadow-lg flex items-center justify-center transition transform hover:rotate-12">
        <i id="theme-icon" class="fa-solid fa-moon text-xl"></i>
    </button>

    <?php if($pesan_sukses): ?>
    <div class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/80 backdrop-blur-sm p-4 animate-[fadeIn_0.3s_ease-out]">
        <div class="bg-gray-900 border border-gray-700 rounded-3xl shadow-2xl w-full max-w-sm overflow-hidden relative animate-[zoomIn_0.3s_ease-out]">
            <button onclick="window.location.href='index.php'" class="absolute top-4 right-4 text-gray-400 hover:text-white transition z-10 p-2"><i class="fa-solid fa-xmark text-xl"></i></button>
            
            <div class="p-8 text-center" id="area_pembayaran">
                <div class="w-20 h-20 bg-emerald-500 rounded-full flex items-center justify-center mx-auto mb-6 shadow-[0_0_20px_rgba(16,185,129,0.5)] animate-bounce">
                    <i class="fa-solid fa-check text-4xl text-white"></i>
                </div>
                <h2 class="text-2xl font-bold text-white mb-2">Pemesanan Berhasil!</h2>
                <p class="text-gray-400 text-sm mb-6">Silakan selesaikan pembayaran melalui:</p>
                <div class="bg-white rounded-xl p-4 mb-6 shadow-inner">
                    <p class="text-emerald-800 font-bold text-sm mb-2 tracking-widest">DANA / QRIS</p>
                    <img src="img/qris.jpg" class="w-40 h-40 mx-auto border-2 border-dashed border-gray-300 rounded-lg p-1" alt="Scan QRIS" onerror="this.src='https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=BayarWisataCurug'">
                    <p class="text-[10px] text-gray-400 mt-2">Scan QR di atas</p>
                </div>
                <div class="relative flex py-2 items-center mb-6">
                    <div class="flex-grow border-t border-gray-700"></div>
                    <span class="flex-shrink-0 mx-4 text-gray-500 text-xs font-bold">ATAU TRANSFER MANUAL</span>
                    <div class="flex-grow border-t border-gray-700"></div>
                </div>
                <div class="bg-gray-800 rounded-xl p-4 mb-6 border border-gray-700">
                    <p class="text-emerald-400 font-mono text-xl font-bold tracking-wider">0838-5644-9099</p>
                    <p class="text-gray-400 text-xs mt-1">a.n. Rizwan</p>
                </div>
                
                <button onclick="selesaikanPembayaran('<?= $nominal_sukses ?>')" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-xl transition shadow-lg shadow-blue-900/50 transform hover:-translate-y-1">
                    Saya Sudah Bayar
                </button>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <nav class="fixed w-full z-40 glass-nav transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <a href="index.php" class="text-2xl font-bold text-emerald-800 dark:text-emerald-400 flex items-center gap-2">
                    <i class="fa-solid fa-leaf text-emerald-500"></i> <?= $site_name ?>
                </a>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="#home" class="font-medium hover:text-emerald-600 dark:text-gray-300 dark:hover:text-emerald-400">Beranda</a>
                    <a href="#paket" class="font-medium hover:text-emerald-600 dark:text-gray-300 dark:hover:text-emerald-400">Paket</a>
                    <a href="#booking" class="font-medium hover:text-emerald-600 dark:text-gray-300 dark:hover:text-emerald-400">Booking</a>
                    <a href="#lokasi" class="font-medium hover:text-emerald-600 dark:text-gray-300 dark:hover:text-emerald-400">Lokasi</a>
                    
                    <?php if(isset($_SESSION['login'])): ?>
                        <div class="flex items-center gap-3 pl-4 border-l border-gray-300 dark:border-gray-600">
                            <span class="font-bold text-emerald-800 dark:text-emerald-400">Halo, <?= $_SESSION['nama'] ?></span>
                            <a href="logout.php" class="bg-red-500 text-white px-4 py-2 rounded-full text-xs hover:bg-red-600 transition">Logout</a>
                        </div>
                    <?php else: ?>
                        <a href="login.php" class="bg-emerald-700 text-white px-6 py-2.5 rounded-full hover:bg-emerald-800 transition font-bold shadow-lg">Login User</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <section id="home" class="hero-bg h-screen flex items-center justify-center text-center px-4 relative">
        <div data-aos="zoom-in-up" data-aos-duration="1000">
            <span class="inline-block py-1 px-3 rounded-full bg-white/20 backdrop-blur-sm border border-white/30 text-white text-xs font-bold tracking-widest mb-6 uppercase">Wisata Alam Sumedang</span>
            <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 leading-tight drop-shadow-lg">
                Pesona Alam <br> <?= $site_name ?>
            </h1>
            <div class="flex gap-4 justify-center mt-8">
                <a href="#booking" class="bg-emerald-600 hover:bg-emerald-700 text-white px-8 py-4 rounded-full font-bold transition shadow-lg hover:-translate-y-1">
                    Booking Sekarang
                </a>
                <a href="https://www.youtube.com/shorts/Gpcf-QepXds" target="_blank" class="bg-white/10 backdrop-blur-md border border-white/50 text-white px-8 py-4 rounded-full font-bold hover:bg-white/20 transition flex items-center gap-2">
                    <i class="fa-solid fa-play"></i> Tonton Video
                </a>
            </div>
        </div>
    </section>

    <section id="tentang" class="py-24 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 grid md:grid-cols-2 gap-12 items-center">
            <div data-aos="fade-right">
                <img src="img/about.jpg" class="rounded-3xl shadow-2xl rotate-2 hover:rotate-0 transition duration-500" alt="Tentang Curug" onerror="this.src='https://placehold.co/600x400?text=Foto+Curug'">
            </div>
            <div data-aos="fade-left">
                <span class="text-emerald-600 dark:text-emerald-400 font-bold uppercase tracking-widest text-sm">Tentang Kami</span>
                <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-6 mt-2">Surga Tersembunyi di Sumedang</h2>
                <p class="text-gray-600 dark:text-gray-300 leading-relaxed mb-6">
                    Curug Cirangkong menawarkan pengalaman wisata alam yang otentik. Dengan air yang jernih dan udara yang sejuk, lokasi ini sangat cocok untuk camping, gathering, atau sekadar melepas penat dari hiruk pikuk kota.
                </p>
                <ul class="space-y-3 mb-8 text-gray-700 dark:text-gray-300">
                    <li class="flex items-center gap-3"><i class="fa-solid fa-check text-emerald-500"></i> Air Terjun Alami</li>
                    <li class="flex items-center gap-3"><i class="fa-solid fa-check text-emerald-500"></i> Camping Ground Luas</li>
                    <li class="flex items-center gap-3"><i class="fa-solid fa-check text-emerald-500"></i> Fasilitas Toilet & Mushola</li>
                </ul>
            </div>
        </div>
    </section>

    <section id="paket" class="py-24 bg-stone-100 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 dark:text-white">Pilihan Paket Wisata</h2>
            <p class="text-gray-500 dark:text-gray-400 mt-2">Pilih paket liburan sesuai kebutuhan Anda</p>
        </div>

        <div class="max-w-7xl mx-auto px-4 grid md:grid-cols-3 gap-8">
            <div class="bg-white dark:bg-gray-800 rounded-3xl p-2 shadow-xl hover:-translate-y-2 transition duration-300" data-aos="fade-up">
                <img src="img/paket1.jpg" class="rounded-2xl w-full h-56 object-cover mb-4" onerror="this.src='https://placehold.co/400x300'">
                <div class="p-4">
                    <h3 class="text-xl font-bold mb-2 dark:text-white">Tiket Masuk</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">Akses seharian penuh ke area Curug dan spot foto.</p>
                    <div class="flex justify-between items-center">
                        <span class="text-emerald-600 dark:text-emerald-400 font-bold text-lg">Rp 15.000</span>
                        <button onclick="pilihPaket('Tiket Masuk', 15000)" class="text-gray-900 dark:text-gray-200 font-semibold text-sm hover:text-emerald-600 cursor-pointer">Pesan <i class="fa-solid fa-arrow-right"></i></button>
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-3xl p-2 shadow-xl hover:-translate-y-2 transition duration-300" data-aos="fade-up" data-aos-delay="100">
                <img src="img/paket2.jpg" class="rounded-2xl w-full h-56 object-cover mb-4" onerror="this.src='https://placehold.co/400x300'">
                <div class="p-4">
                    <h3 class="text-xl font-bold mb-2 dark:text-white">Camping Ceria</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">Nikmati malam di alam terbuka (Lahan Only).</p>
                    <div class="flex justify-between items-center">
                        <span class="text-emerald-600 dark:text-emerald-400 font-bold text-lg">Rp 35.000</span>
                        <button onclick="pilihPaket('Camping Ceria', 35000)" class="text-gray-900 dark:text-gray-200 font-semibold text-sm hover:text-emerald-600 cursor-pointer">Pesan <i class="fa-solid fa-arrow-right"></i></button>
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-3xl p-2 shadow-xl hover:-translate-y-2 transition duration-300" data-aos="fade-up" data-aos-delay="200">
                <img src="img/paket3.jpg" class="rounded-2xl w-full h-56 object-cover mb-4" onerror="this.src='https://placehold.co/400x300'">
                <div class="p-4">
                    <h3 class="text-xl font-bold mb-2 dark:text-white">Sewa Tenda Fullset</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">Tenda Dome Kapasitas 4 + Matras + Sleeping Bag.</p>
                    <div class="flex justify-between items-center">
                        <span class="text-emerald-600 dark:text-emerald-400 font-bold text-lg">Rp 120.000</span>
                        <button onclick="pilihPaket('Sewa Tenda Fullset', 120000)" class="text-gray-900 dark:text-gray-200 font-semibold text-sm hover:text-emerald-600 cursor-pointer">Pesan <i class="fa-solid fa-arrow-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-white dark:bg-gray-800 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">Kata Mereka</h2>
                <p class="text-emerald-600 dark:text-emerald-400 font-bold uppercase tracking-widest text-sm">Testimoni Pengunjung</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-gray-50 dark:bg-gray-700 p-8 rounded-2xl shadow-lg hover:-translate-y-2 transition" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-yellow-400 mb-4 flex gap-1"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                    <p class="text-gray-600 dark:text-gray-300 italic mb-6">"Tempatnya adem banget, cocok buat healing dari hiruk pikuk Jakarta. Airnya jernih, fasilitas toilet juga bersih. Recommended!"</p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gray-200 dark:bg-gray-600 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-user text-gray-400 dark:text-gray-300 text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 dark:text-white">Rizwan Kukubima</h4>
                            <span class="text-xs text-gray-500 dark:text-gray-400">Jakarta</span>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 p-8 rounded-2xl shadow-lg hover:-translate-y-2 transition" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-yellow-400 mb-4 flex gap-1"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                    <p class="text-gray-600 dark:text-gray-300 italic mb-6">"Camping di sini seru parah! Paket sewanya murah, alatnya bersih. Pagi-pagi langsung bisa main air di curug. Mantap jiwa."</p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gray-200 dark:bg-gray-600 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-user text-gray-400 dark:text-gray-300 text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 dark:text-white">Tatang Bohlam</h4>
                            <span class="text-xs text-gray-500 dark:text-gray-400">Bandung</span>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 p-8 rounded-2xl shadow-lg hover:-translate-y-2 transition" data-aos="fade-up" data-aos-delay="300">
                    <div class="text-yellow-400 mb-4 flex gap-1"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star-half-stroke"></i></div>
                    <p class="text-gray-600 dark:text-gray-300 italic mb-6">"Akses jalan sudah bagus, mobil bisa masuk. Makanan di warungnya juga enak-enak dan murah. Pasti bakal balik lagi sih."</p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gray-200 dark:bg-gray-600 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-user text-gray-400 dark:text-gray-300 text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 dark:text-white">Revan Etanol</h4>
                            <span class="text-xs text-gray-500 dark:text-gray-400">Sumedang</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="booking" class="py-24 bg-emerald-900 dark:bg-emerald-950 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
        
        <div class="max-w-5xl mx-auto px-4 relative z-10">
            <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl overflow-hidden flex flex-col md:flex-row transition-colors">
                <div class="md:w-1/3 bg-gray-900 dark:bg-black text-white p-10 flex flex-col justify-center">
                    <h3 class="text-3xl font-serif mb-4">Formulir Pemesanan</h3>
                    <p class="text-gray-400 mb-8">Silakan lengkapi data di samping untuk menghitung estimasi biaya perjalanan wisata Anda.</p>
                    <div class="mt-auto">
                        <p class="text-xs text-gray-500 uppercase tracking-widest mb-2">Kontak Admin</p>
                        <p class="text-xl font-bold text-emerald-400">+<?= $wa_number ?></p>
                    </div>
                </div>

                <div class="md:w-2/3 p-10">
                    <form method="POST" action="">
                        <div class="mb-4">
                             <label class="block text-sm font-bold text-emerald-700 dark:text-emerald-400 mb-1">Paket yang Dipilih:</label>
                             <input type="text" id="input_jenis_paket" name="jenis_paket" class="w-full bg-emerald-50 dark:bg-gray-700 border border-emerald-200 dark:border-gray-600 rounded-lg p-3 font-bold text-gray-700 dark:text-white focus:outline-none" readonly placeholder="Klik 'Pesan' di menu Paket atas...">
                        </div>
                        <input type="hidden" id="harga_dasar" value="0">

                        <div class="grid md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Nama Pemesan</label>
                                <input type="text" name="nama" value="<?= isset($_SESSION['nama']) ? $_SESSION['nama'] : '' ?>" class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg p-3 focus:outline-none focus:border-emerald-500 dark:text-white" placeholder="Nama Lengkap" required>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Nomor WhatsApp</label>
                                <input type="number" name="hp" class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg p-3 focus:outline-none focus:border-emerald-500 dark:text-white" placeholder="08xxxxx" required>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Tanggal Kunjungan</label>
                            <input type="date" name="tanggal" class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg p-3 dark:text-white" required>
                        </div>

                        <div class="grid grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Durasi (Hari)</label>
                                <input type="number" id="durasi" name="durasi" value="1" min="1" oninput="hitungTotal()" class="w-full text-center font-bold text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-gray-700 border border-emerald-100 dark:border-gray-600 rounded-lg p-3" required>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Peserta (Org)</label>
                                <input type="number" id="peserta" name="peserta" value="1" min="1" oninput="hitungTotal()" class="w-full text-center font-bold text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-gray-700 border border-emerald-100 dark:border-gray-600 rounded-lg p-3" required>
                            </div>
                        </div>

                        <div class="mb-8 bg-gray-50 dark:bg-gray-700/50 p-4 rounded-xl border border-gray-100 dark:border-gray-600">
                            <p class="font-bold text-gray-700 dark:text-gray-200 mb-3 text-sm">Pilih Layanan Tambahan:</p>
                            <div class="space-y-3">
                                <label class="flex items-center space-x-3 cursor-pointer p-2 hover:bg-white dark:hover:bg-gray-700 rounded transition">
                                    <input type="checkbox" id="check_inap" name="penginapan" value="1000000" onclick="hitungTotal()" class="w-5 h-5 text-emerald-600 rounded focus:ring-emerald-500">
                                    <span class="text-sm dark:text-gray-300">Penginapan (Rp 1.000.000)</span>
                                </label>
                                <label class="flex items-center space-x-3 cursor-pointer p-2 hover:bg-white dark:hover:bg-gray-700 rounded transition">
                                    <input type="checkbox" id="check_trans" name="transport" value="1200000" onclick="hitungTotal()" class="w-5 h-5 text-emerald-600 rounded focus:ring-emerald-500">
                                    <span class="text-sm dark:text-gray-300">Transportasi (Rp 1.200.000)</span>
                                </label>
                                <label class="flex items-center space-x-3 cursor-pointer p-2 hover:bg-white dark:hover:bg-gray-700 rounded transition">
                                    <input type="checkbox" id="check_makan" name="makan" value="500000" onclick="hitungTotal()" class="w-5 h-5 text-emerald-600 rounded focus:ring-emerald-500">
                                    <span class="text-sm dark:text-gray-300">Servis/Makan (Rp 500.000)</span>
                                </label>
                            </div>
                        </div>

                        <div class="flex justify-between items-end mb-8 border-t dark:border-gray-600 pt-4">
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Harga Paket (Per Org/Hari)</p>
                                <input type="text" id="display_harga_paket" class="font-bold text-gray-800 dark:text-white bg-transparent border-none p-0 w-32 focus:ring-0" readonly value="Rp 0">
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-gray-500 dark:text-gray-400">Total Tagihan</p>
                                <input type="text" id="display_total_tagihan" class="font-bold text-3xl text-emerald-600 dark:text-emerald-400 bg-transparent border-none p-0 w-full text-right focus:ring-0" readonly value="Rp 0">
                            </div>
                        </div>

                        <input type="hidden" id="input_harga_paket" name="harga_paket_value">
                        <input type="hidden" id="input_total_tagihan" name="total_tagihan_value">

                        <div class="flex gap-3">
                            <button type="submit" name="simpan_pesanan" class="flex-1 bg-gray-900 dark:bg-emerald-700 text-white py-3 rounded-xl font-bold hover:bg-emerald-600 dark:hover:bg-emerald-600 transition shadow-lg">Konfirmasi Pesanan</button>
                            <button type="button" onclick="hitungTotal()" class="bg-emerald-100 dark:bg-gray-700 text-emerald-700 dark:text-emerald-400 px-4 rounded-xl hover:bg-emerald-200 dark:hover:bg-gray-600"><i class="fa-solid fa-calculator"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section id="lokasi" class="relative">
        <div class="h-96 w-full hover:shadow-2xl transition duration-500">
            <iframe 
                width="100%" 
                height="100%" 
                id="gmap_canvas" 
                src="https://maps.google.com/maps?q=Curug%20Cirangkong%20Sumedang&t=&z=15&ie=UTF8&iwloc=&output=embed" 
                frameborder="0" 
                scrolling="no" 
                marginheight="0" 
                marginwidth="0">
            </iframe>
        </div>
        <div class="absolute top-0 left-0 w-full h-10 bg-gradient-to-b from-emerald-900 dark:from-emerald-950 to-transparent pointer-events-none"></div>
    </section>

    <footer class="bg-gray-950 text-white py-12 border-t border-gray-900">
        <div class="max-w-7xl mx-auto px-4 grid md:grid-cols-3 gap-8 text-center md:text-left">
            <div>
                <h2 class="text-2xl font-serif font-bold mb-4 flex items-center justify-center md:justify-start gap-2">
                    <i class="fa-solid fa-leaf text-emerald-500"></i> <?= $site_name ?>
                </h2>
                <p class="text-gray-400 text-sm">Destinasi wisata alam terbaik untuk keluarga dan teman di Sumedang.</p>
            </div>
            <div>
                <h4 class="font-bold mb-4 text-emerald-400">Hubungi Kami</h4>
                <ul class="text-sm text-gray-400 space-y-2">
                    <li><i class="fa-brands fa-whatsapp mr-2"></i> +<?= $wa_number ?></li>
                    <li><i class="fa-solid fa-envelope mr-2"></i> curugcrksumedang@gmail.com</li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-4 text-emerald-400">Sosial Media</h4>
                <div class="flex justify-center md:justify-start gap-4">
                    <a href="<?= $link_ig ?>" target="_blank" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-pink-600 transition"><i class="fa-brands fa-instagram"></i></a>
                    <a href="<?= $link_tiktok ?>" target="_blank" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-white hover:text-black transition"><i class="fa-brands fa-tiktok"></i></a>
                    <a href="<?= $link_fb ?>" target="_blank" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-blue-600 transition"><i class="fa-brands fa-facebook-f"></i></a>
                </div>
            </div>
        </div>
        <div class="text-center mt-12 pt-8 border-t border-gray-900 text-gray-600 text-xs">
            © <?= date('Y') ?> Project Capstone Riz. All Rights Reserved.
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();

        const themeToggle = document.getElementById('theme-toggle');
        const themeIcon = document.getElementById('theme-icon');
        const html = document.documentElement;

        if (localStorage.getItem('theme') === 'dark') {
            html.classList.add('dark');
            themeIcon.classList.remove('fa-moon');
            themeIcon.classList.add('fa-sun');
        }

        themeToggle.addEventListener('click', () => {
            html.classList.toggle('dark');
            if (html.classList.contains('dark')) {
                localStorage.setItem('theme', 'dark');
                themeIcon.classList.remove('fa-moon');
                themeIcon.classList.add('fa-sun');
            } else {
                localStorage.setItem('theme', 'light');
                themeIcon.classList.remove('fa-sun');
                themeIcon.classList.add('fa-moon');
            }
        });

        // FUNGSI PILIH PAKET
        function pilihPaket(nama, harga) {
            document.getElementById('input_jenis_paket').value = nama;
            document.getElementById('harga_dasar').value = harga;
            
            // Scroll ke form booking
            document.getElementById('booking').scrollIntoView({ behavior: 'smooth' });

            hitungTotal();
        }

        // FUNGSI HITUNG TOTAL OTOMATIS
        function hitungTotal() {
            let hargaDasar = parseFloat(document.getElementById('harga_dasar').value) || 0;
            let durasi = parseFloat(document.getElementById('durasi').value) || 1;
            let peserta = parseFloat(document.getElementById('peserta').value) || 1;
            
            let tambahan = 0;
            if(document.getElementById('check_inap').checked) tambahan += parseFloat(document.getElementById('check_inap').value);
            if(document.getElementById('check_trans').checked) tambahan += parseFloat(document.getElementById('check_trans').value);
            if(document.getElementById('check_makan').checked) tambahan += parseFloat(document.getElementById('check_makan').value);
            
            // Rumus: (Harga Paket x Peserta x Durasi) + Tambahan
            let total = (hargaDasar * peserta * durasi) + tambahan;

            // Format Rupiah
            let formatter = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            });

            document.getElementById('display_harga_paket').value = formatter.format(hargaDasar);
            document.getElementById('display_total_tagihan').value = formatter.format(total);

            // Simpan ke Input Hidden buat dikirim ke PHP
            document.getElementById('input_harga_paket').value = hargaDasar;
            document.getElementById('input_total_tagihan').value = total;
        }

        // PERBAIKAN FINAL (WA FIX): 
        // 1. Pake json_encode biar nama aman
        // 2. Pake Intl.NumberFormat biar rupiah aman
        // 3. AUTO REDIRECT DIHAPUS -> Biar WA ke-load sempurna!
        function selesaikanPembayaran(nominal){
            let nama = <?= json_encode(isset($_SESSION['nama']) ? $_SESSION['nama'] : 'Tamu') ?>;
            let wa = "<?= $wa_number ?>";
            let totalFormatted = "";

            // Format Rupiah Pakai Cara Modern (Anti Error)
            let numericNominal = Number(nominal);
            if(!isNaN(numericNominal) && numericNominal > 0){
                totalFormatted = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(numericNominal);
            } else {
                 // Fallback ambil dari tampilan kalau data PHP kosong
                totalFormatted = document.getElementById('display_total_tagihan').value;
            }

            let text = "Halo Admin, saya " + nama + " sudah melakukan pembayaran sebesar " + totalFormatted + ". Mohon dicek.";
            
            // Buka WA (Tanpa Auto Refresh)
            let url = "https://wa.me/" + wa + "?text=" + encodeURIComponent(text);
            window.open(url, '_blank');
        }
    </script>
</body>
</html>