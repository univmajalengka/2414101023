<?php
include 'config.php';

// Handle add to cart
if (isset($_POST['add_to_cart'])) {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit();
    }
    
    $product_id = $_POST['product_id'];
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]++;
    } else {
        $_SESSION['cart'][$product_id] = 1;
    }
    header('Location: index.php?page=home&added=1');
    exit();
}

// Handle search
$search_query = isset($_GET['search']) ? $_GET['search'] : '';
$filtered_products = $products;

if ($search_query != '') {
    $filtered_products = array_filter($products, function($product) use ($search_query) {
        return stripos($product['name'], $search_query) !== false || 
               stripos($product['description'], $search_query) !== false;
    });
}

$page = isset($_GET['page']) ? $_GET['page'] : 'home';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kyo Space - Premium Coffee</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
        }
        
        /* Header */
        header {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: white;
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        nav {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }
        
        .logo {
            font-size: 1.8rem;
            font-weight: bold;
            color: #ecf0f1;
        }
        
        .nav-links {
            display: flex;
            list-style: none;
            gap: 2rem;
            align-items: center;
        }
        
        .nav-links a {
            color: white;
            text-decoration: none;
            transition: color 0.3s;
            font-weight: 500;
        }
        
        .nav-links a:hover {
            color: #3498db;
        }
        
        .cart-icon {
            position: relative;
            padding: 8px 15px;
            background: #3498db;
            border-radius: 5px;
        }
        
        .cart-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #e74c3c;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 0.8rem;
        }
        
        /* Search Bar */
        .search-container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
        }
        
        .search-form {
            display: flex;
            gap: 10px;
        }
        
        .search-input {
            flex: 1;
            padding: 12px 20px;
            border: 2px solid #ddd;
            border-radius: 25px;
            font-size: 1rem;
            outline: none;
            transition: border-color 0.3s;
        }
        
        .search-input:focus {
            border-color: #3498db;
        }
        
        .search-btn {
            padding: 12px 30px;
            background: #3498db;
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s;
        }
        
        .search-btn:hover {
            background: #2980b9;
        }
        
        /* Main Content */
        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }
        
        /* Hero Section */
        .hero {
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=1200') center/cover;
            color: white;
            padding: 100px 20px;
            text-align: center;
            border-radius: 10px;
            margin-bottom: 40px;
        }
        
        .hero h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }
        
        .hero p {
            font-size: 1.2rem;
            max-width: 600px;
            margin: 0 auto;
        }
        
        /* Products Grid */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }
        
        .product-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        }
        
        .product-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }
        
        .product-info {
            padding: 20px;
        }
        
        .product-name {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: #2c3e50;
        }
        
        .product-description {
            color: #7f8c8d;
            margin-bottom: 15px;
        }
        
        .product-price {
            font-size: 1.3rem;
            color: #27ae60;
            font-weight: bold;
            margin-bottom: 15px;
        }
        
        .btn {
            width: 100%;
            padding: 12px;
            background: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: bold;
            transition: background 0.3s;
        }
        
        .btn:hover {
            background: #2980b9;
        }
        
        /* About Section */
        .about-section {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        
        .about-section h2 {
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 2rem;
        }
        
        .about-section p {
            color: #7f8c8d;
            line-height: 1.8;
            margin-bottom: 15px;
        }
        
        /* Contact Form */
        .contact-form {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            max-width: 600px;
            margin: 0 auto;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #2c3e50;
            font-weight: bold;
        }
        
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            font-family: inherit;
        }
        
        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }
        
        /* Footer */
        footer {
            background: #2c3e50;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 60px;
        }
        
        .alert {
            padding: 15px;
            background: #27ae60;
            color: white;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <div class="logo">☕ Kyo Space</div>
            <ul class="nav-links">
                <li><a href="index.php?page=home">Home</a></li>
                <li><a href="index.php?page=about">About</a></li>
                <li><a href="index.php?page=contact">Contact</a></li>
                <?php if (isLoggedIn()): ?>
                    <li><a href="cart.php" class="cart-icon">
                        🛒 Cart
                        <?php 
                        $cart_count = array_sum($_SESSION['cart']);
                        if ($cart_count > 0): 
                        ?>
                            <span class="cart-count"><?php echo $cart_count; ?></span>
                        <?php endif; ?>
                    </a></li>
                    <li><a href="logout.php">Logout (<?php echo $_SESSION['username']; ?>)</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <?php if ($page == 'home'): ?>
        <div class="search-container">
            <form method="GET" action="index.php" class="search-form">
                <input type="hidden" name="page" value="home">
                <input type="text" name="search" class="search-input" placeholder="Search coffee..." value="<?php echo htmlspecialchars($search_query); ?>">
                <button type="submit" class="search-btn">Search</button>
            </form>
        </div>
    <?php endif; ?>

    <div class="container">
        <?php if (isset($_GET['added'])): ?>
            <div class="alert">✓ Product added to cart successfully!</div>
        <?php endif; ?>

        <?php if ($page == 'home'): ?>
            <div class="hero">
                <h1>Welcome to Kyo Space</h1>
                <p>Experience the finest coffee crafted with passion and perfection</p>
            </div>

            <h2 style="text-align: center; color: #2c3e50; margin-bottom: 30px;">Our Coffee Menu</h2>
            
            <?php if (empty($filtered_products)): ?>
                <p style="text-align: center; color: #7f8c8d; font-size: 1.2rem;">No products found for "<?php echo htmlspecialchars($search_query); ?>"</p>
            <?php else: ?>
                <div class="products-grid">
                    <?php foreach ($filtered_products as $product): ?>
                        <div class="product-card">
                            <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" class="product-image">
                            <div class="product-info">
                                <h3 class="product-name"><?php echo $product['name']; ?></h3>
                                <p class="product-description"><?php echo $product['description']; ?></p>
                                <div class="product-price"><?php echo formatPrice($product['price']); ?></div>
                                <form method="POST">
                                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                    <button type="submit" name="add_to_cart" class="btn">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        <?php elseif ($page == 'about'): ?>
            <div class="about-section">
                <h2>About Kyo Space</h2>
                <p>Kyo Space adalah cafe premium yang menghadirkan pengalaman kopi terbaik untuk Anda. Didirikan dengan passion untuk memberikan kualitas tertinggi dalam setiap cangkir.</p>
                <p>Kami menggunakan biji kopi pilihan dari berbagai belahan dunia dan diracik oleh barista profesional kami. Setiap cangkir kopi dibuat dengan penuh cinta dan dedikasi.</p>
                <p>Nikmati suasana nyaman dan modern di Kyo Space, tempat sempurna untuk bekerja, bersantai, atau bertemu dengan teman-teman Anda.</p>
                <h3 style="margin-top: 30px; margin-bottom: 15px;">Our Values</h3>
                <ul style="color: #7f8c8d; line-height: 2;">
                    <li>🌟 Quality First - Hanya biji kopi terbaik</li>
                    <li>💚 Sustainable - Mendukung petani lokal</li>
                    <li>❤️ Passion - Dibuat dengan cinta</li>
                    <li>🎯 Excellence - Kesempurnaan di setiap detail</li>
                </ul>
            </div>

        <?php elseif ($page == 'contact'): ?>
            <div class="contact-form">
                <h2 style="text-align: center; color: #2c3e50; margin-bottom: 30px;">Contact Us</h2>
                <form method="POST" action="contact_process.php">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label>Subject</label>
                        <input type="text" name="subject" required>
                    </div>
                    <div class="form-group">
                        <label>Message</label>
                        <textarea name="message" required></textarea>
                    </div>
                    <button type="submit" class="btn">Send Message</button>
                </form>
                <div style="margin-top: 30px; text-align: center; color: #7f8c8d;">
                    <p><strong>Address:</strong> Jl. Coffee Street No. 123, Jakarta</p>
                    <p><strong>Phone:</strong> +62 812-3456-7890</p>
                    <p><strong>Email:</strong> hello@kyospace.com</p>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <footer>
        <p>&copy; 2025 Kyo Space. All rights reserved. Made with ☕ and ❤️</p>
    </footer>
</body>
</html>