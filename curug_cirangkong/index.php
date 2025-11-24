<?php
// ============================================================================
// 1. KONFIGURASI UTAMA
// ============================================================================

$site_name = "Curug Cirangkong";
$whatsapp_number = "6285315822575"; 
$lokasi_teks = "Desa Cirangkong, Kec. Ujungjaya, Kab. Sumedang, Jawa Barat";
$email_admin = "curugcrksumedang@gmail.com";
$maps_url = "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.728674269296!2d107.6643670742365!3d-6.792758666435685!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69221715555555%3A0x123456789abcdef!2sCurug%20Cirangkong!5e0!3m2!1sid!2sid!4v169876543210"; 
$video_id = "IAWpGAGT0W4"; 

// --- SOSMED ---
$link_instagram = "https://www.instagram.com/curung_cirangkong_smd?igsh=MThta3d0aGtiZGZyMQ%3D%3D&utm_source=qr"; 
$link_tiktok    = "http://www.tiktok.com/@curug.cirangkong";
$link_facebook  = "https://www.facebook.com/share/1FsRzx6KwJ/?mibextid=wwXIfr";

// --- GAMBAR UTAMA ---
$hero = [
    'judul' => "Pesona Alam Curug Cirangkong",
    'subjudul' => "Temukan ketenangan di tengah gemericik air terjun alami dan hamparan hijau Sumedang.",
    'gambar' => "img/banner.jpg" // Pastikan gambar ini ada
];

$about_img = "img/about.jpg"; 

$paket_wisata = [
    [
        'nama' => 'Tiket Masuk',
        'fitur' => ['Akses Curug Eksklusif', 'Spot Foto Instagramable', 'Toilet Bersih', 'Asuransi Pengunjung'],
        'harga' => '15.000',
        'satuan' => 'orang',
        'foto' => 'img/paket1.jpg', 
        'label' => ''
    ],
    [
        'nama' => 'Camping Ceria',
        'fitur' => ['Tiket Camping 24 Jam', 'Lahan Tenda Datar', 'Listrik & Penerangan', 'Akses Toilet & Mushola'],
        'harga' => '35.000',
        'satuan' => 'malam/org',
        'foto' => 'img/paket2.jpg', 
        'label' => 'Paling Laris'
    ],
    [
        'nama' => 'Sewa Tenda Fullset',
        'fitur' => ['Tenda Dome Kapasitas 4', 'Matras Empuk', 'Jasa Pasang & Bongkar', 'Sleeping Bag Higienis'],
        'harga' => '120.000',
        'satuan' => 'unit/malam',
        'foto' => 'img/paket3.jpg', 
        'label' => 'Terima Beres'
    ]
];

$galeri = [
    "img/galeri1.jpg", 
    "img/galeri2.jpg",
    "img/galeri3.jpg",
    "img/galeri4.jpg"
];

$faqs = [
    [
        'tanya' => 'Apakah akses jalan bisa masuk mobil?',
        'jawab' => 'Ya, akses jalan menuju lokasi sudah aspal dan beton. Bisa dilalui motor, mobil pribadi, hingga minibus (Elf/HiAce) dengan nyaman.'
    ],
    [
        'tanya' => 'Apakah boleh membawa makanan dari luar?',
        'jawab' => 'Diperbolehkan. Namun, kami sangat merekomendasikan mencicipi nasi liwet khas Sunda di warung kami yang harganya sangat terjangkau.'
    ],
    [
        'tanya' => 'Bagaimana fasilitas toilet dan ibadah?',
        'jawab' => 'Kami mengutamakan kebersihan. Tersedia toilet bersih, kamar bilas yang memadai, serta mushola yang nyaman dan sejuk.'
    ],
    [
        'tanya' => 'Cara reservasi untuk rombongan?',
        'jawab' => 'Untuk rombongan besar atau gathering, mohon hubungi WhatsApp Admin minimal H-3 agar kami dapat menyiapkan lokasi terbaik untuk Anda.'
    ]
];

?>

<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wisata <?= $site_name ?></title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js"></script>
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap');
        
        body { font-family: 'Plus Jakarta Sans', sans-serif; overflow-x: hidden; }
        h1, h2, h3, h4, .font-serif { font-family: 'Playfair Display', serif; }
        
        html { scroll-padding-top: 100px; }

        .glass-nav {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .modal { transition: opacity 0.3s ease-in-out; }

        /* Animation smoother */
        [data-aos] {
            transition-timing-function: cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
    </style>
</head>
<body class="bg-stone-50 text-gray-700 selection:bg-emerald-200 selection:text-emerald-900">

    <nav class="glass-nav fixed w-full z-50 transition-all duration-300" x-data="{ isOpen: false, atTop: true }" 
         @scroll.window="atTop = (window.pageYOffset > 20) ? false : true"
         :class="{ 'shadow-sm': !atTop, 'py-2': atTop, 'py-1': !atTop }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center">
                    <a href="#" class="text-2xl font-bold text-emerald-700 flex items-center gap-2 font-serif tracking-tight">
                        <i class="fa-solid fa-leaf text-emerald-500"></i> <?= $site_name ?>
                    </a>
                </div>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#beranda" class="text-sm font-medium hover:text-emerald-600 transition tracking-wide">BERANDA</a>
                    <a href="#tentang" class="text-sm font-medium hover:text-emerald-600 transition tracking-wide">TENTANG</a>
                    <a href="#paket" class="text-sm font-medium hover:text-emerald-600 transition tracking-wide">PAKET</a>
                    <a href="#galeri" class="text-sm font-medium hover:text-emerald-600 transition tracking-wide">GALERI</a>
                    <a href="#faq" class="text-sm font-medium hover:text-emerald-600 transition tracking-wide">FAQ</a>
                    <a href="#lokasi" class="text-sm font-medium hover:text-emerald-600 transition tracking-wide">LOKASI</a>
                    <a href="https://wa.me/<?= $whatsapp_number ?>" class="bg-emerald-700 text-white px-6 py-2.5 rounded-full hover:bg-emerald-800 transition shadow-lg hover:shadow-emerald-200 transform hover:-translate-y-0.5 text-sm font-semibold tracking-wide flex items-center gap-2">
                        <i class="fa-brands fa-whatsapp"></i> BOOKING
                    </a>
                </div>

                <div class="flex items-center md:hidden">
                    <button @click="isOpen = !isOpen" class="text-gray-600 hover:text-emerald-600 focus:outline-none p-2">
                        <i class="fa-solid" :class="isOpen ? 'fa-xmark' : 'fa-bars text-xl'"></i>
                    </button>
                </div>
            </div>
        </div>

        <div x-show="isOpen" x-transition @click.away="isOpen = false" class="md:hidden bg-white/95 backdrop-blur-md border-t border-gray-100 absolute w-full shadow-xl">
            <div class="px-6 pt-4 pb-6 space-y-3">
                <a href="#beranda" @click="isOpen = false" class="block py-2 text-gray-800 hover:text-emerald-600 font-medium">Beranda</a>
                <a href="#tentang" @click="isOpen = false" class="block py-2 text-gray-800 hover:text-emerald-600 font-medium">Tentang Kami</a>
                <a href="#paket" @click="isOpen = false" class="block py-2 text-gray-800 hover:text-emerald-600 font-medium">Paket Wisata</a>
                <a href="#galeri" @click="isOpen = false" class="block py-2 text-gray-800 hover:text-emerald-600 font-medium">Galeri Foto</a>
                <a href="#lokasi" @click="isOpen = false" class="block py-2 text-gray-800 hover:text-emerald-600 font-medium">Lokasi</a>
            </div>
        </div>
    </nav>

    <section id="beranda" class="relative h-screen flex items-center justify-center text-center text-white overflow-hidden">
        
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-stone-900/90 z-10"></div>
            <img src="<?= $hero['gambar'] ?>" class="w-full h-full object-cover animate-[subtleZoom_20s_infinite]" alt="Banner Utama" onerror="this.style.display='none';">
        </div>
        
        <div class="relative z-20 px-4 max-w-4xl mx-auto mt-10" data-aos="zoom-in-up" data-aos-duration="1200">
            <span class="inline-block py-1 px-3 rounded-full bg-white/20 backdrop-blur-sm border border-white/30 text-xs font-bold tracking-widest mb-6 uppercase" data-aos="fade-down" data-aos-delay="200">Wisata Alam Sumedang</span>
            <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight drop-shadow-2xl font-serif">
                <?= $hero['judul'] ?>
            </h1>
            <p class="text-lg md:text-2xl mb-10 text-gray-100 font-light max-w-2xl mx-auto leading-relaxed opacity-90">
                <?= $hero['subjudul'] ?>
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="#paket" class="group bg-emerald-600 hover:bg-emerald-700 text-white px-8 py-4 rounded-full font-semibold transition duration-300 shadow-xl hover:shadow-emerald-500/30 flex items-center gap-2 cursor-pointer relative z-40 hover:-translate-y-1">
                    Jelajahi Paket <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                </a>
                <a href="#video-tour" class="group bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/50 text-white px-8 py-4 rounded-full font-semibold transition duration-300 flex items-center gap-2 cursor-pointer relative z-40 hover:-translate-y-1">
                    <i class="fa-solid fa-play text-xs border border-white rounded-full p-1.5"></i> Tonton Video
                </a>
            </div>
        </div>
    </section>

    <section id="tentang" class="py-24 bg-stone-50 overflow-hidden relative z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-16 items-center">
                <div class="relative" data-aos="fade-right" data-aos-duration="1000">
                    <div class="absolute -top-4 -left-4 w-2/3 h-2/3 border-2 border-emerald-200 rounded-3xl z-0"></div>
                    <img src="<?= $about_img ?>" alt="Tentang Curug" class="relative z-10 rounded-2xl shadow-2xl w-full h-auto object-cover aspect-[4/3] hover:scale-[1.02] transition duration-500" onerror="this.src='https://placehold.co/600x400?text=Foto+About';">
                    <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-emerald-100 rounded-full blur-2xl -z-10"></div>
                </div>
                
                <div data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                    <span class="text-emerald-600 font-bold uppercase tracking-widest text-sm mb-2 block">Tentang Kami</span>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 font-serif leading-tight">Keindahan Alam <span class="italic text-emerald-700">Asri & Menenangkan</span></h2>
                    <p class="text-gray-600 text-lg leading-relaxed mb-6 font-light">
                        Rasakan sensasi kembali ke alam di <strong><?= $site_name ?></strong>. Kami menyediakan tempat wisata yang tidak hanya indah dipandang, tetapi juga bersih, aman, dan nyaman.
                    </p>
                    
                    <div class="grid grid-cols-2 gap-6 mb-8">
                        <div class="flex items-center gap-3" data-aos="zoom-in" data-aos-delay="400">
                            <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600"><i class="fa-solid fa-tree"></i></div>
                            <span class="font-medium text-gray-700">Alam Asri</span>
                        </div>
                        <div class="flex items-center gap-3" data-aos="zoom-in" data-aos-delay="500">
                            <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600"><i class="fa-solid fa-water"></i></div>
                            <span class="font-medium text-gray-700">Air Jernih</span>
                        </div>
                    </div>

                    <div id="video-tour" class="mt-6 rounded-2xl overflow-hidden shadow-xl border-4 border-white" data-aos="fade-up" data-aos-delay="600">
                        <iframe class="w-full aspect-video" src="https://www.youtube.com/embed/<?= $video_id ?>" title="Video Wisata" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="paket" class="py-24 relative bg-emerald-900">
        <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] z-0"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16 text-white" data-aos="fade-down">
                <h2 class="text-4xl md:text-5xl font-bold font-serif mb-4">Pilihan Paket Wisata</h2>
                <p class="text-emerald-100 text-lg font-light">Temukan paket liburan hemat yang sesuai dengan gaya petualangan Anda</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <?php foreach($paket_wisata as $index => $p): ?>
                <div class="group bg-white rounded-3xl shadow-2xl overflow-hidden hover:-translate-y-3 transition-all duration-300 flex flex-col relative" 
                     data-aos="fade-up" 
                     data-aos-duration="800"
                     data-aos-delay="<?= $index * 150 ?>"> <?php if($p['label']): ?>
                        <div class="absolute top-4 right-4 bg-gradient-to-r from-yellow-400 to-orange-500 text-white text-xs font-bold px-4 py-1.5 rounded-full shadow-lg z-20 uppercase tracking-wide">
                            <?= $p['label'] ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="h-64 overflow-hidden relative">
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/0 transition duration-500 z-10"></div>
                        <img src="<?= $p['foto'] ?>" alt="<?= $p['nama'] ?>" class="w-full h-full object-cover group-hover:scale-110 transition duration-700 ease-in-out" onerror="this.src='https://placehold.co/600x400?text=Foto+Paket';">
                    </div>
                    
                    <div class="p-8 flex-1 flex flex-col">
                        <h3 class="text-2xl font-bold mb-2 font-serif text-gray-800 group-hover:text-emerald-700 transition"><?= $p['nama'] ?></h3>
                        <div class="mb-6 flex items-end gap-1 pb-4 border-b border-gray-100">
                            <span class="text-3xl font-bold text-emerald-600">Rp <?= $p['harga'] ?></span>
                            <span class="text-gray-400 text-sm mb-1">/ <?= $p['satuan'] ?></span>
                        </div>
                        
                        <ul class="space-y-3 mb-8 flex-1">
                            <?php foreach($p['fitur'] as $f): ?>
                                <li class="flex items-center gap-3 text-gray-600 text-sm">
                                    <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center text-xs"><i class="fa-solid fa-check"></i></span>
                                    <?= $f ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        
                        <a href="https://wa.me/<?= $whatsapp_number ?>?text=Halo Admin, saya ingin pesan <?= $p['nama'] ?>" target="_blank" class="block w-full py-3.5 text-center rounded-xl bg-gray-900 text-white font-bold hover:bg-emerald-600 transition-colors duration-300 shadow-lg relative z-20 cursor-pointer">
                            Booking Sekarang
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section id="galeri" class="py-24 bg-stone-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12" data-aos="fade-right">
                <div>
                    <span class="text-emerald-600 font-bold uppercase tracking-widest text-sm mb-2 block">Dokumentasi</span>
                    <h2 class="text-4xl font-bold text-gray-900 font-serif">Galeri Momen</h2>
                </div>
                <a href="<?= $link_instagram ?>" target="_blank" class="text-emerald-600 hover:text-emerald-800 font-medium mt-4 md:mt-0 flex items-center gap-2 group">
                    Lihat Instagram <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition"></i>
                </a>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                <?php foreach($galeri as $idx => $img): ?>
                <div class="group relative overflow-hidden rounded-2xl cursor-pointer h-64 md:h-80 shadow-lg <?= $idx === 0 ? 'md:col-span-2 md:row-span-2 md:h-full' : '' ?>" 
                     onclick="openModal('<?= $img ?>')" 
                     data-aos="<?= $idx % 2 == 0 ? 'fade-up-right' : 'fade-up-left' ?>" 
                     data-aos-delay="<?= $idx * 100 ?>">
                    <img src="<?= $img ?>" alt="Galeri" class="w-full h-full object-cover transition duration-700 group-hover:scale-110 group-hover:brightness-90" onerror="this.parentElement.style.display='none';">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end justify-start p-6">
                        <p class="text-white font-serif italic text-lg transform translate-y-4 group-hover:translate-y-0 transition duration-300">View Moments</p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section id="faq" class="py-24 bg-white relative">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 font-serif">Pertanyaan Umum</h2>
                <p class="text-gray-500 mt-2 font-light">Informasi yang sering ditanyakan oleh pengunjung kami</p>
            </div>
            
            <div class="space-y-4">
                <?php foreach($faqs as $index => $faq): ?>
                <div class="group border border-gray-100 rounded-2xl bg-stone-50 hover:bg-white hover:shadow-lg transition-all duration-300" 
                     x-data="{ expanded: false }" 
                     data-aos="fade-up" 
                     data-aos-delay="<?= $index * 50 ?>"> <button @click="expanded = !expanded" class="w-full px-8 py-5 text-left flex justify-between items-center focus:outline-none">
                        <span class="font-bold text-gray-800 text-lg group-hover:text-emerald-700 transition"><?= $faq['tanya'] ?></span>
                        <span class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center transition-transform duration-300" :class="expanded ? 'rotate-180 bg-emerald-600 text-white' : ''">
                            <i class="fa-solid fa-chevron-down text-sm"></i>
                        </span>
                    </button>
                    <div x-show="expanded" x-collapse class="px-8 pb-6 text-gray-600 leading-relaxed border-t border-gray-100">
                        <?= $faq['jawab'] ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section id="lokasi" class="py-24 bg-stone-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-5 gap-8 bg-white rounded-3xl p-4 shadow-xl overflow-hidden" data-aos="flip-up" data-aos-duration="1000">
                <div class="md:col-span-2 p-8 flex flex-col justify-center">
                    <span class="text-emerald-600 font-bold uppercase tracking-widest text-xs mb-2">Peta Lokasi</span>
                    <h2 class="text-3xl font-bold text-gray-900 font-serif mb-6">Temukan Jalan Menuju Surga Tersembunyi</h2>
                    <p class="text-gray-600 mb-8 leading-relaxed"><i class="fa-solid fa-location-dot text-emerald-500 mr-2"></i> <?= $lokasi_teks ?></p>
                    <a href="<?= $maps_url ?>" target="_blank" class="inline-flex items-center justify-center gap-2 bg-gray-900 text-white px-6 py-3 rounded-xl hover:bg-emerald-600 transition w-full sm:w-auto transform hover:-translate-y-1">
                        <i class="fa-solid fa-map-location-dot"></i> Buka Google Maps
                    </a>
                </div>
                <div class="md:col-span-3 h-[400px] md:h-auto min-h-[300px] bg-gray-200 rounded-2xl overflow-hidden relative">
                    <iframe src="<?= $maps_url ?>" width="100%" height="100%" style="border:0; filter: grayscale(20%) contrast(1.2);" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-gray-900 text-white pt-20 pb-10 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-emerald-500 via-teal-400 to-cyan-500"></div>
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid md:grid-cols-4 gap-12 mb-16">
                <div class="md:col-span-1">
                    <div class="text-3xl font-bold text-emerald-400 mb-6 font-serif flex items-center gap-2">
                        <i class="fa-solid fa-leaf"></i> Curug<br>Cirangkong
                    </div>
                    <p class="text-gray-400 leading-relaxed mb-6 text-sm">
                        Menyatu dengan alam, menyegarkan jiwa. Destinasi wisata keluarga terbaik di Sumedang.
                    </p>
                    <div class="flex space-x-3">
                        <a href="<?= $link_instagram ?>" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-pink-600 transition text-white border border-gray-700 hover:border-pink-600 hover:-translate-y-1"><i class="fa-brands fa-instagram"></i></a>
                        <a href="<?= $link_tiktok ?>" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-black hover:border-white transition text-white border border-gray-700 hover:-translate-y-1"><i class="fa-brands fa-tiktok"></i></a>
                        <a href="<?= $link_facebook ?>" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-blue-600 transition text-white border border-gray-700 hover:border-blue-600 hover:-translate-y-1"><i class="fa-brands fa-facebook-f"></i></a>
                    </div>
                </div>

                <div>
                    <h4 class="text-white font-bold mb-6 font-serif tracking-wide">Jelajahi</h4>
                    <ul class="space-y-3 text-gray-400 text-sm">
                        <li><a href="#beranda" class="hover:text-emerald-400 transition flex items-center gap-2 hover:translate-x-1"><span class="w-1 h-1 bg-emerald-500 rounded-full"></span> Beranda</a></li>
                        <li><a href="#paket" class="hover:text-emerald-400 transition flex items-center gap-2 hover:translate-x-1"><span class="w-1 h-1 bg-emerald-500 rounded-full"></span> Paket Wisata</a></li>
                        <li><a href="#galeri" class="hover:text-emerald-400 transition flex items-center gap-2 hover:translate-x-1"><span class="w-1 h-1 bg-emerald-500 rounded-full"></span> Galeri</a></li>
                        <li><a href="#faq" class="hover:text-emerald-400 transition flex items-center gap-2 hover:translate-x-1"><span class="w-1 h-1 bg-emerald-500 rounded-full"></span> FAQ</a></li>
                    </ul>
                </div>

                <div class="md:col-span-2">
                    <h4 class="text-white font-bold mb-6 font-serif tracking-wide">Hubungi Kami</h4>
                    <ul class="space-y-4 text-gray-400 text-sm">
                        <li class="flex items-start gap-4">
                            <i class="fa-solid fa-location-dot text-emerald-500 mt-1 text-lg"></i>
                            <span><?= $lokasi_teks ?></span>
                        </li>
                        <li class="flex items-center gap-4">
                            <i class="fa-brands fa-whatsapp text-emerald-500 text-lg"></i>
                            <span class="font-mono text-lg text-white tracking-wider">+<?= $whatsapp_number ?></span>
                        </li>
                        <li class="flex items-center gap-4">
                            <i class="fa-solid fa-envelope text-emerald-500 text-lg"></i>
                            <span><?= $email_admin ?></span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-center md:text-left">
                <p class="text-gray-600 text-sm">
                    © <?= date('Y') ?> <strong class="text-gray-400"><?= $site_name ?></strong>. All Rights Reserved.
                </p>
                <p class="text-gray-700 text-xs">Designed with <i class="fa-solid fa-heart text-red-900 animate-pulse"></i> for Nature.</p>
            </div>
        </div>
    </footer>

    <div id="imageModal" class="fixed inset-0 z-[9999] bg-black/95 hidden flex items-center justify-center modal p-4 backdrop-blur-sm" onclick="closeModal()">
        <button class="absolute top-6 right-6 text-white/50 hover:text-white text-5xl transition">×</button>
        <img id="modalImage" src="" class="max-w-full max-h-[85vh] rounded-lg shadow-2xl border-4 border-white/10">
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Init Animation
        AOS.init({
            once: true, 
            offset: 50, 
            duration: 800, 
            easing: 'ease-out-cubic', 
        });

        // Modal Logic
        const modal = document.getElementById('imageModal');
        const modalImg = document.getElementById('modalImage');
        function openModal(src) {
            modal.classList.remove('hidden');
            setTimeout(() => modal.classList.remove('opacity-0'), 10);
            modalImg.src = src;
        }
        function closeModal() {
            modal.classList.add('opacity-0');
            setTimeout(() => modal.classList.add('hidden'), 300);
        }
        
        // Smooth Scroll Logic
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if(target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
    </script>
</body>
</html>