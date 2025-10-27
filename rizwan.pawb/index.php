<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AZL EXHAUST - Toko Knalpot Terpercaya Majalengka</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #e0e0e0;
            background: #0a0a0a;
        }

        /* Header */
        header {
            background: linear-gradient(135deg, #1a1a1a 0%, #333 100%);
            color: white;
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0,0,0,0.3);
        }

        .header-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: bold;
            color: #00d4ff;
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 2rem;
        }

        nav a {
            color: white;
            text-decoration: none;
            transition: color 0.3s;
            font-weight: 500;
        }

        nav a:hover {
            color: #00d4ff;
        }

        /* Admin Link Special Style */
        nav a.admin-link {
            background: linear-gradient(135deg, #00d4ff 0%, #00b8e6 100%);
            color: #000;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            font-weight: 600;
        }

        nav a.admin-link:hover {
            background: linear-gradient(135deg, #00b8e6 0%, #0099cc 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0,212,255,0.3);
        }

        .user-actions {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .btn {
            padding: 0.5rem 1.5rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-primary {
            background: #00d4ff;
            color: #000;
        }

        .btn-primary:hover {
            background: #00b8e6;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: transparent;
            color: white;
            border: 2px solid white;
        }

        .btn-secondary:hover {
            background: white;
            color: #333;
        }

        .cart-btn {
            position: relative;
            background: #00d4ff;
            color: #000;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
        }

        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background: red;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: bold;
        }

        /* Search Bar */
        .search-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 20px;
        }

        .search-bar {
            display: flex;
            gap: 1rem;
        }

        .search-bar input {
            flex: 1;
            padding: 0.8rem;
            border: 2px solid #2a2a2a;
            border-radius: 5px;
            font-size: 1rem;
            background: #1a1a1a;
            color: #fff;
        }

        .search-bar input:focus {
            outline: none;
            border-color: #00d4ff;
        }

        .search-bar button {
            padding: 0.8rem 2rem;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://i.imgur.com/70h9YRk.jpeg');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 10rem 10px;
            text-align: center;
        }

        .hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .hero p {
            font-size: 1.3rem;
            margin-bottom: 2rem;
        }

        /* Content Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 3rem 20px;
        }

        /* Products Grid */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .product-card {
            background: #1a1a1a;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.5);
            overflow: hidden;
            transition: transform 0.3s;
            border: 1px solid #2a2a2a;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 25px rgba(0,212,255,0.3);
        }

        .product-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .product-info {
            padding: 1.5rem;
        }

        .product-name {
            font-size: 1.3rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
            color: #fff;
        }

        .product-price {
            font-size: 1.5rem;
            color: #00d4ff;
            font-weight: bold;
            margin: 1rem 0;
        }

        .product-desc {
            color: #aaa;
            margin-bottom: 1rem;
        }

        /* About Section */
        .about-section {
            background: #0f0f0f;
            padding: 3rem 20px;
        }

        .about-content {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
        }

        .about-content h2 {
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            color: #fff;
        }

        .about-content p {
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: 1rem;
            color: #aaa;
        }

        .about-image {
            width: 200px;
            height: auto;
            border-radius: 12px;
            margin: 15px auto 25px auto;
            display: block;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        }

        /* Contact Section */
        .contact-section {
            padding: 3rem 20px;
            background: #0a0a0a;
        }

        .contact-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .contact-content h2 {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 2rem;
            color: #fff;
        }

        .contact-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .contact-item {
            background: #1a1a1a;
            padding: 2rem;
            border-radius: 10px;
            text-align: center;
            border: 1px solid #2a2a2a;
        }

        .contact-item h3 {
            color: #00d4ff;
            margin-bottom: 1rem;
        }

        .contact-item p {
            color: #aaa;
        }

        /* Footer */
        footer {
            background: #1a1a1a;
            color: white;
            text-align: center;
            padding: 2rem;
            margin-top: 3rem;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.7);
            z-index: 2000;
            align-items: center;
            justify-content: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: #1a1a1a;
            padding: 2rem;
            border-radius: 10px;
            max-width: 500px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            border: 1px solid #2a2a2a;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .modal-header h2 {
            color: #fff;
        }

        .close-modal {
            font-size: 2rem;
            cursor: pointer;
            color: #aaa;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #fff;
        }

        .form-group input {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid #2a2a2a;
            border-radius: 5px;
            font-size: 1rem;
            background: #0f0f0f;
            color: #fff;
        }

        .form-group input:focus {
            outline: none;
            border-color: #00d4ff;
        }

        /* Cart Items */
        .cart-items {
            margin: 1.5rem 0;
        }

        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            border-bottom: 1px solid #2a2a2a;
        }

        .cart-item-info {
            flex: 1;
        }

        .cart-item-name {
            font-weight: bold;
            margin-bottom: 0.5rem;
            color: #fff;
        }

        .cart-item-price {
            color: #00d4ff;
        }

        .cart-item-actions {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        .qty-btn {
            padding: 0.3rem 0.8rem;
            background: #2a2a2a;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-weight: bold;
            color: #fff;
        }

        .qty-btn:hover {
            background: #3a3a3a;
        }

        .remove-btn {
            padding: 0.3rem 0.8rem;
            background: #ff4444;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .cart-total {
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 2px solid #2a2a2a;
            font-size: 1.3rem;
            font-weight: bold;
            text-align: right;
            color: #fff;
        }

        .hidden {
            display: none;
        }

        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
                gap: 1rem;
            }

            nav ul {
                gap: 1rem;
                flex-wrap: wrap;
                justify-content: center;
            }

            .hero h1 {
                font-size: 2rem;
            }

            .products-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="header-container">
            <div class="logo">AZL EXHAUST</div>
            <nav>
                <ul>
                    <li><a href="#home" onclick="showSection('home')">Home</a></li>
                    <li><a href="#about" onclick="showSection('about')">About</a></li>
                    <li><a href="#contact" onclick="showSection('contact')">Contact</a></li>
                    <li><a href="admin_login.php" class="admin-link">🛠️ Admin</a></li>
                </ul>
            </nav>
            <div class="user-actions">
                <div class="cart-btn" onclick="openCart()">
                    🛒 Cart
                    <span class="cart-count" id="cartCount">0</span>
                </div>
                <button class="btn btn-primary" id="loginBtn" onclick="openLogin()">Login</button>
                <button class="btn btn-secondary hidden" id="logoutBtn" onclick="logout()">Logout</button>
                <span id="userName" class="hidden"></span>
            </div>
        </div>
    </header>

    <!-- Search Bar -->
    <div class="search-container">
        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Cari produk knalpot...">
            <button class="btn btn-primary" onclick="searchProducts()">Cari</button>
        </div>
    </div>

    <!-- Home Section -->
    <section id="home">
        <div class="hero">
            <h1>Selamat Datang di AZL EXHAUST</h1>
            <p>Knalpot Berkualitas Tinggi untuk Performa Maksimal</p>
            <p>📍 Majalengka, Jawa Barat</p>
        </div>

        <div class="container">
            <h2 style="text-align: center; margin-bottom: 2rem; font-size: 2.5rem; color: #fff;">Produk Kami</h2>
            <div class="products-grid" id="productsGrid">
                <!-- Products will be loaded here -->
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about-section hidden">
        <div class="about-content">
            <h2>Tentang AZL EXHAUST</h2>

            <!-- Foto di bawah judul -->
            <img src="https://cdn.discordapp.com/attachments/1367685753244487761/1431971335965507625/IMG-20251026-WA0239.jpg?ex=68ff5abb&is=68fe093b&hm=04eca127356317770d2403eed7a8778c9307828ea692d9371efd883b5f0d6a91" 
                 alt="AZL EXHAUST" class="about-image">

            <p>AZL EXHAUST adalah toko knalpot terpercaya yang berlokasi di Majalengka, Jawa Barat. Kami berkomitmen untuk menyediakan produk knalpot berkualitas tinggi dengan harga yang kompetitif.</p>
            <p>Dengan pengalaman bertahun-tahun dalam industri otomotif, kami memahami kebutuhan pelanggan akan performa dan kualitas. Setiap produk yang kami jual telah melalui seleksi ketat untuk memastikan kepuasan pelanggan.</p>
            <p>Kami melayani pengiriman ke seluruh Indonesia dan siap membantu Anda menemukan knalpot yang tepat untuk kendaraan Anda.</p>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact-section hidden">
        <div class="contact-content">
            <h2>Hubungi Kami</h2>
            <div class="contact-info">
                <div class="contact-item">
                    <h3>📍 Alamat</h3>
                    <p>Heuleut, Kec. Kadipaten, Kabupaten Majalengka, Jawa Barat 45452<br>Indonesia</p>
                </div>
                <div class="contact-item">
                    <h3>📞 Telepon</h3>
                    <p>+62 853-1582-2575</p>
                </div>
                <div class="contact-item">
                    <h3>📧 Email</h3>
                    <p>rizwanadi52@gmail.com</p>
                </div>
                <div class="contact-item">
                    <h3>⏰ Jam Operasional</h3>
                    <p>Senin - Sabtu<br>08:00 - 17:00 WIB</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 AZL EXHAUST - Majalengka. All Rights Reserved.</p>
    </footer>

    <!-- Login Modal -->
    <div class="modal" id="loginModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Login</h2>
                <span class="close-modal" onclick="closeLogin()">&times;</span>
            </div>
            <form onsubmit="handleLogin(event)">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" id="username" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" id="password" required>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%;">Login</button>
            </form>
        </div>
    </div>

    <!-- Cart Modal -->
    <div class="modal" id="cartModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Keranjang Belanja</h2>
                <span class="close-modal" onclick="closeCart()">&times;</span>
            </div>
            <div class="cart-items" id="cartItems">
                <!-- Cart items will be loaded here -->
            </div>
            <div class="cart-total">
                Total: <span id="cartTotal">Rp 0</span>
            </div>
            <button class="btn btn-primary" style="width: 100%; margin-top: 1rem;" onclick="checkout()">Checkout</button>
        </div>
    </div>

    <script>
        // Product Data
        const products = [
            {
                id: 1,
                name: "RMS EXHAUST",
                price: 125000,
                image: "https://i.imgur.com/ACzf8bG.jpeg",
                description: "BAHAN TEBAL BISA DI PAKE TAWURAN"
            },
            {
                id: 2,
                name: "AFR EXHAUST",
                price: 100000,
                image: "http://i.imgur.com/KjW1ACn.jpeg",
                description: "DesaiN GACORRRR KANG dengan performa maksimal"
            },
            {
                id: 3,
                name: "WRC EXHAUST",
                price: 300000,
                image: "https://i.imgur.com/ejEB9oK.jpeg",
                description: "Style BALAP LIAR dengan kualitas premium"
            },
            {
                id: 4,
                name: "SBR EXHAUST",
                price: 430000,
                image: "https://i.imgur.com/0XtuZwD.jpeg",
                description: "Knalpot BEKAS TEKNO TUNER untuk performa harian yang optimal"
            },
            {
                id: 5,
                name: "ZRC STANDAR RACING",
                price: 250000,
                image: "https://i.imgur.com/UkVVe5S.jpeg",
                description: "Knalpot adem sekali cocok untuk tidak balap."
            }
        ];

        // State Management
        let cart = [];
        let isLoggedIn = false;
        let currentUser = '';

        // Load products on page load
        window.onload = function() {
            displayProducts(products);
        };

        // Display Products
        function displayProducts(productsToShow) {
            const grid = document.getElementById('productsGrid');
            grid.innerHTML = '';
            
            productsToShow.forEach(product => {
                const card = document.createElement('div');
                card.className = 'product-card';
                card.innerHTML = `
                    <img src="${product.image}" alt="${product.name}" class="product-image">
                    <div class="product-info">
                        <div class="product-name">${product.name}</div>
                        <div class="product-desc">${product.description}</div>
                        <div class="product-price">Rp ${product.price.toLocaleString('id-ID')}</div>
                        <button class="btn btn-primary" style="width: 100%;" onclick="addToCart(${product.id})">
                            Tambah ke Keranjang
                        </button>
                    </div>
                `;
                grid.appendChild(card);
            });
        }

        // Search Products
        function searchProducts() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const filtered = products.filter(p => 
                p.name.toLowerCase().includes(searchTerm) || 
                p.description.toLowerCase().includes(searchTerm)
            );
            displayProducts(filtered);
        }

        // Add to Cart
        function addToCart(productId) {
            if (!isLoggedIn) {
                alert('Silakan login terlebih dahulu!');
                openLogin();
                return;
            }

            const product = products.find(p => p.id === productId);
            const existingItem = cart.find(item => item.id === productId);

            if (existingItem) {
                existingItem.quantity++;
            } else {
                cart.push({...product, quantity: 1});
            }

            updateCart();
            alert('Produk berhasil ditambahkan ke keranjang!');
        }

        // Update Cart
        function updateCart() {
            const cartCount = document.getElementById('cartCount');
            const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
            cartCount.textContent = totalItems;

            const cartItemsDiv = document.getElementById('cartItems');
            if (cart.length === 0) {
                cartItemsDiv.innerHTML = '<p style="text-align: center; padding: 2rem;">Keranjang kosong</p>';
            } else {
                cartItemsDiv.innerHTML = cart.map(item => `
                    <div class="cart-item">
                        <div class="cart-item-info">
                            <div class="cart-item-name">${item.name}</div>
                            <div class="cart-item-price">Rp ${item.price.toLocaleString('id-ID')}</div>
                        </div>
                        <div class="cart-item-actions">
                            <button class="qty-btn" onclick="updateQuantity(${item.id}, -1)">-</button>
                            <span style="margin: 0 0.5rem;">${item.quantity}</span>
                            <button class="qty-btn" onclick="updateQuantity(${item.id}, 1)">+</button>
                            <button class="remove-btn" onclick="removeFromCart(${item.id})">Hapus</button>
                        </div>
                    </div>
                `).join('');
            }

            const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            document.getElementById('cartTotal').textContent = `Rp ${total.toLocaleString('id-ID')}`;
        }

        // Update Quantity
        function updateQuantity(productId, change) {
            const item = cart.find(i => i.id === productId);
            if (item) {
                item.quantity += change;
                if (item.quantity <= 0) {
                    removeFromCart(productId);
                } else {
                    updateCart();
                }
            }
        }

        // Remove from Cart
        function removeFromCart(productId) {
            cart = cart.filter(item => item.id !== productId);
            updateCart();
        }

        // Checkout
        function checkout() {
            if (cart.length === 0) {
                alert('Keranjang masih kosong!');
                return;
            }
            const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            alert(`Terima kasih ${currentUser}! Total pembayaran: Rp ${total.toLocaleString('id-ID')}\n\nPesanan Anda akan segera diproses.`);
            cart = [];
            updateCart();
            closeCart();
        }

        // Login Functions
        function openLogin() {
            document.getElementById('loginModal').classList.add('active');
        }

        function closeLogin() {
            document.getElementById('loginModal').classList.remove('active');
        }

        function handleLogin(e) {
            e.preventDefault();
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;

            if (username && password) {
                isLoggedIn = true;
                currentUser = username;
                document.getElementById('loginBtn').classList.add('hidden');
                document.getElementById('logoutBtn').classList.remove('hidden');
                document.getElementById('userName').classList.remove('hidden');
                document.getElementById('userName').textContent = `Halo, ${username}`;
                closeLogin();
                alert(`Selamat datang, ${username}!`);
            }
        }

        function logout() {
            isLoggedIn = false;
            currentUser = '';
            cart = [];
            updateCart();
            document.getElementById('loginBtn').classList.remove('hidden');
            document.getElementById('logoutBtn').classList.add('hidden');
            document.getElementById('userName').classList.add('hidden');
            alert('Anda telah logout');
        }

        // Cart Functions
        function openCart() {
            if (!isLoggedIn) {
                alert('Silakan login terlebih dahulu!');
                openLogin();
                return;
            }
            updateCart();
            document.getElementById('cartModal').classList.add('active');
        }

        function closeCart() {
            document.getElementById('cartModal').classList.remove('active');
        }

        // Section Navigation
        function showSection(section) {
            const sections = ['home', 'about', 'contact'];
            sections.forEach(s => {
                const element = document.getElementById(s);
                if (s === section) {
                    element.classList.remove('hidden');
                } else {
                    element.classList.add('hidden');
                }
            });
        }
    </script>
</body>
</html>