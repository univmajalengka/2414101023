// Tambahkan fungsi ini di bagian JavaScript dalam index.php

// Update Checkout Function
function checkout() {
    if (cart.length === 0) {
        alert('Keranjang masih kosong!');
        return;
    }
    
    // Save cart to session storage untuk diambil oleh pemesanan.php
    const cartData = JSON.stringify(cart);
    document.cookie = `cart=${encodeURIComponent(cartData)}; path=/`;
    
    // Redirect to pemesanan.php
    window.location.href = 'pemesanan.php';
}

// Tambahkan button di navigation untuk akses cepat ke halaman pesanan
// Ganti bagian nav di HTML dengan yang ini:

/*
<nav>
    <ul>
        <li><a href="#home" onclick="showSection('home')">Home</a></li>
        <li><a href="#about" onclick="showSection('about')">About</a></li>
        <li><a href="#contact" onclick="showSection('contact')">Contact</a></li>
        <li><a href="pemesanan.php" style="background: #00d4ff; color: #000; padding: 0.5rem 1rem; border-radius: 5px;">🛍️ Pesan Sekarang</a></li>
        <li><a href="admin