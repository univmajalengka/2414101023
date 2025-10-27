<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin_login.php');
    exit();
}

// Initialize products in session if not exists
if (!isset($_SESSION['products'])) {
    $_SESSION['products'] = [
        [
            'id' => 1,
            'name' => 'RMS EXHAUST',
            'price' => 125000,
            'image' => 'https://i.imgur.com/ACzf8bG.jpeg',
            'description' => 'BAHAN TEBAL BISA DI PAKE TAWURAN'
        ],
        [
            'id' => 2,
            'name' => 'AFR EXHAUST',
            'price' => 100000,
            'image' => 'http://i.imgur.com/KjW1ACn.jpeg',
            'description' => 'DesaiN GACORRRR KANG dengan performa maksimal'
        ],
        [
            'id' => 3,
            'name' => 'WRC EXHAUST',
            'price' => 300000,
            'image' => 'https://i.imgur.com/ejEB9oK.jpeg',
            'description' => 'Style BALAP LIAR dengan kualitas premium'
        ],
        [
            'id' => 4,
            'name' => 'SBR EXHAUST',
            'price' => 430000,
            'image' => 'https://i.imgur.com/0XtuZwD.jpeg',
            'description' => 'Knalpot BEKAS TEKNO TUNER untuk performa harian yang optimal'
        ],
        [
            'id' => 5,
            'name' => 'ZRC STANDAR RACING',
            'price' => 250000,
            'image' => 'https://i.imgur.com/UkVVe5S.jpeg',
            'description' => 'Knalpot adem sekali cocok untuk tidak balap.'
        ]
    ];
}

$message = '';
$message_type = '';
$current_view = $_GET['view'] ?? 'dashboard';

// Handle actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    if ($action === 'add') {
        // Add new product
        $new_id = max(array_column($_SESSION['products'], 'id')) + 1;
        $_SESSION['products'][] = [
            'id' => $new_id,
            'name' => $_POST['name'],
            'price' => intval($_POST['price']),
            'image' => $_POST['image'],
            'description' => $_POST['description']
        ];
        $message = 'Produk berhasil ditambahkan!';
        $message_type = 'success';
        
    } elseif ($action === 'edit') {
        // Edit product
        $id = intval($_POST['id']);
        foreach ($_SESSION['products'] as &$product) {
            if ($product['id'] === $id) {
                $product['name'] = $_POST['name'];
                $product['price'] = intval($_POST['price']);
                $product['image'] = $_POST['image'];
                $product['description'] = $_POST['description'];
                break;
            }
        }
        $message = 'Produk berhasil diupdate!';
        $message_type = 'success';
        
    } elseif ($action === 'delete') {
        // Delete product
        $id = intval($_POST['id']);
        $_SESSION['products'] = array_filter($_SESSION['products'], function($p) use ($id) {
            return $p['id'] !== $id;
        });
        $_SESSION['products'] = array_values($_SESSION['products']); // Reindex array
        $message = 'Produk berhasil dihapus!';
        $message_type = 'success';
    }
}

// Get product for editing
$edit_product = null;
if (isset($_GET['edit'])) {
    $edit_id = intval($_GET['edit']);
    foreach ($_SESSION['products'] as $product) {
        if ($product['id'] === $edit_id) {
            $edit_product = $product;
            $current_view = 'form';
            break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - AZL EXHAUST</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #0a0a0a;
            color: #e0e0e0;
            min-height: 100vh;
        }

        /* Header */
        .admin-header {
            background: linear-gradient(135deg, #1a1a1a 0%, #333 100%);
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.3);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header-content {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .header-title h1 {
            color: #00d4ff;
            font-size: 1.8rem;
        }

        .header-title p {
            color: #aaa;
            font-size: 0.9rem;
        }

        .header-actions {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .admin-name {
            color: #fff;
            font-weight: 600;
        }

        /* Navigation Tabs */
        .nav-tabs {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .nav-tab {
            padding: 0.8rem 1.5rem;
            background: #1a1a1a;
            color: #aaa;
            text-decoration: none;
            border-radius: 8px 8px 0 0;
            border: 1px solid #2a2a2a;
            transition: all 0.3s;
        }

        .nav-tab:hover {
            background: #2a2a2a;
            color: #fff;
        }

        .nav-tab.active {
            background: #00d4ff;
            color: #000;
            font-weight: 600;
        }

        .btn {
            padding: 0.6rem 1.5rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
            font-size: 1rem;
        }

        .btn-primary {
            background: #00d4ff;
            color: #000;
        }

        .btn-primary:hover {
            background: #00b8e6;
            transform: translateY(-2px);
        }

        .btn-danger {
            background: #ff4444;
            color: white;
        }

        .btn-danger:hover {
            background: #cc0000;
        }

        .btn-secondary {
            background: #2a2a2a;
            color: white;
        }

        .btn-secondary:hover {
            background: #3a3a3a;
        }

        .btn-sm {
            padding: 0.4rem 1rem;
            font-size: 0.9rem;
        }

        /* Container */
        .container {
            max-width: 1400px;
            margin: 2rem auto;
            padding: 0 20px;
        }

        /* Message */
        .message {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 2rem;
            text-align: center;
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .message.success {
            background: #27ae60;
            color: white;
        }

        .message.error {
            background: #ff4444;
            color: white;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: linear-gradient(135deg, #1a1a1a 0%, #2a2a2a 100%);
            padding: 2rem;
            border-radius: 12px;
            border: 1px solid #2a2a2a;
            text-align: center;
            transition: transform 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,212,255,0.2);
        }

        .stat-card h3 {
            color: #aaa;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .stat-card .stat-value {
            color: #00d4ff;
            font-size: 2.5rem;
            font-weight: bold;
        }

        .stat-card .stat-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
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
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #2a2a2a;
            transition: all 0.3s;
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-8px);
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
            line-height: 1.5;
        }

        .product-id {
            position: absolute;
            top: 10px;
            left: 10px;
            background: rgba(0,0,0,0.7);
            color: #00d4ff;
            padding: 0.3rem 0.8rem;
            border-radius: 5px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .product-actions {
            display: flex;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        /* Form Section */
        .form-section {
            background: #1a1a1a;
            padding: 2.5rem;
            border-radius: 12px;
            border: 1px solid #2a2a2a;
            max-width: 900px;
            margin: 0 auto;
        }

        .form-section h2 {
            color: #00d4ff;
            margin-bottom: 2rem;
            font-size: 2rem;
        }

        .form-grid {
            display: grid;
            gap: 1.5rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            margin-bottom: 0.5rem;
            color: #fff;
            font-weight: 600;
        }

        .form-group input,
        .form-group textarea {
            padding: 0.8rem;
            border: 2px solid #2a2a2a;
            border-radius: 6px;
            background: #0f0f0f;
            color: #fff;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #00d4ff;
            box-shadow: 0 0 0 3px rgba(0,212,255,0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        /* Section Container */
        .section-container {
            background: #1a1a1a;
            padding: 2rem;
            border-radius: 12px;
            border: 1px solid #2a2a2a;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .section-header h2 {
            color: #00d4ff;
            font-size: 2rem;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }

        .empty-state-icon {
            font-size: 5rem;
            margin-bottom: 1rem;
        }

        .empty-state h3 {
            color: #fff;
            margin-bottom: 1rem;
        }

        .empty-state p {
            color: #aaa;
            margin-bottom: 2rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
            }

            .nav-tabs {
                flex-wrap: wrap;
            }

            .products-grid {
                grid-template-columns: 1fr;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="admin-header">
        <div class="header-content">
            <div class="header-title">
                <h1>🛠️ Admin Dashboard</h1>
                <p>Kelola Produk AZL EXHAUST</p>
            </div>
            <div class="header-actions">
                <span class="admin-name">👤 <?php echo htmlspecialchars($_SESSION['admin_username']); ?></span>
                <a href="index.php" class="btn btn-secondary btn-sm" target="_blank">🌐 Lihat Website</a>
                <a href="admin_logout.php" class="btn btn-danger btn-sm">🚪 Logout</a>
            </div>
        </div>
    </header>

    <!-- Navigation Tabs -->
    <div class="nav-tabs">
        <a href="?view=dashboard" class="nav-tab <?php echo $current_view === 'dashboard' ? 'active' : ''; ?>">
            📊 Dashboard
        </a>
        <a href="?view=products" class="nav-tab <?php echo $current_view === 'products' ? 'active' : ''; ?>">
            📦 Semua Produk
        </a>
        <a href="?view=form" class="nav-tab <?php echo $current_view === 'form' ? 'active' : ''; ?>">
            ➕ Tambah Produk
        </a>
    </div>

    <div class="container">
        <?php if ($message): ?>
            <div class="message <?php echo $message_type; ?>">
                ✓ <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <?php if ($current_view === 'dashboard'): ?>
            <!-- Stats Section -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">📦</div>
                    <h3>Total Produk</h3>
                    <div class="stat-value"><?php echo count($_SESSION['products']); ?></div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">💰</div>
                    <h3>Harga Tertinggi</h3>
                    <div class="stat-value">
                        Rp <?php echo number_format(max(array_column($_SESSION['products'], 'price')), 0, ',', '.'); ?>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">💵</div>
                    <h3>Harga Terendah</h3>
                    <div class="stat-value">
                        Rp <?php echo number_format(min(array_column($_SESSION['products'], 'price')), 0, ',', '.'); ?>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">📈</div>
                    <h3>Rata-rata Harga</h3>
                    <div class="stat-value">
                        Rp <?php echo number_format(array_sum(array_column($_SESSION['products'], 'price')) / count($_SESSION['products']), 0, ',', '.'); ?>
                    </div>
                </div>
            </div>

            <!-- Recent Products -->
            <div class="section-container">
                <div class="section-header">
                    <h2>📦 Produk Terbaru</h2>
                    <a href="?view=products" class="btn btn-primary btn-sm">Lihat Semua</a>
                </div>
                
                <div class="products-grid">
                    <?php 
                    $recent_products = array_slice(array_reverse($_SESSION['products']), 0, 4);
                    foreach ($recent_products as $product): 
                    ?>
                        <div class="product-card">
                            <span class="product-id">#<?php echo $product['id']; ?></span>
                            <img src="<?php echo htmlspecialchars($product['image']); ?>" 
                                 alt="<?php echo htmlspecialchars($product['name']); ?>" 
                                 class="product-image">
                            <div class="product-info">
                                <div class="product-name"><?php echo htmlspecialchars($product['name']); ?></div>
                                <div class="product-desc"><?php echo htmlspecialchars($product['description']); ?></div>
                                <div class="product-price">Rp <?php echo number_format($product['price'], 0, ',', '.'); ?></div>
                                <div class="product-actions">
                                    <a href="?view=form&edit=<?php echo $product['id']; ?>" class="btn btn-primary btn-sm" style="flex: 1;">✏️ Edit</a>
                                    <form method="POST" action="" style="flex: 1;" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                                        <button type="submit" class="btn btn-danger btn-sm" style="width: 100%;">🗑️ Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

        <?php elseif ($current_view === 'products'): ?>
            <!-- All Products Grid -->
            <div class="section-container">
                <div class="section-header">
                    <h2>📦 Semua Produk (<?php echo count($_SESSION['products']); ?>)</h2>
                    <a href="?view=form" class="btn btn-primary">➕ Tambah Produk Baru</a>
                </div>

                <?php if (empty($_SESSION['products'])): ?>
                    <div class="empty-state">
                        <div class="empty-state-icon">📭</div>
                        <h3>Belum Ada Produk</h3>
                        <p>Mulai tambahkan produk pertama Anda</p>
                        <a href="?view=form" class="btn btn-primary">➕ Tambah Produk</a>
                    </div>
                <?php else: ?>
                    <div class="products-grid">
                        <?php foreach ($_SESSION['products'] as $product): ?>
                            <div class="product-card">
                                <span class="product-id">#<?php echo $product['id']; ?></span>
                                <img src="<?php echo htmlspecialchars($product['image']); ?>" 
                                     alt="<?php echo htmlspecialchars($product['name']); ?>" 
                                     class="product-image">
                                <div class="product-info">
                                    <div class="product-name"><?php echo htmlspecialchars($product['name']); ?></div>
                                    <div class="product-desc"><?php echo htmlspecialchars($product['description']); ?></div>
                                    <div class="product-price">Rp <?php echo number_format($product['price'], 0, ',', '.'); ?></div>
                                    <div class="product-actions">
                                        <a href="?view=form&edit=<?php echo $product['id']; ?>" class="btn btn-primary btn-sm" style="flex: 1;">✏️ Edit</a>
                                        <form method="POST" action="" style="flex: 1;" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                                            <button type="submit" class="btn btn-danger btn-sm" style="width: 100%;">🗑️ Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

        <?php elseif ($current_view === 'form'): ?>
            <!-- Add/Edit Form -->
            <div class="form-section">
                <h2><?php echo $edit_product ? '✏️ Edit Produk' : '➕ Tambah Produk Baru'; ?></h2>
                <form method="POST" action="?view=products">
                    <input type="hidden" name="action" value="<?php echo $edit_product ? 'edit' : 'add'; ?>">
                    <?php if ($edit_product): ?>
                        <input type="hidden" name="id" value="<?php echo $edit_product['id']; ?>">
                    <?php endif; ?>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label>📝 Nama Produk *</label>
                            <input type="text" name="name" value="<?php echo $edit_product ? htmlspecialchars($edit_product['name']) : ''; ?>" required placeholder="Contoh: RMS EXHAUST">
                        </div>

                        <div class="form-group">
                            <label>💰 Harga (Rp) *</label>
                            <input type="number" name="price" value="<?php echo $edit_product ? $edit_product['price'] : ''; ?>" required placeholder="Contoh: 125000">
                        </div>

                        <div class="form-group">
                            <label>🖼️ URL Gambar *</label>
                            <input type="url" name="image" value="<?php echo $edit_product ? htmlspecialchars($edit_product['image']) : ''; ?>" required placeholder="https://example.com/image.jpg">
                        </div>

                        <div class="form-group">
                            <label>📄 Deskripsi *</label>
                            <textarea name="description" required placeholder="Deskripsi produk..."><?php echo $edit_product ? htmlspecialchars($edit_product['description']) : ''; ?></textarea>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <?php echo $edit_product ? '💾 Update Produk' : '➕ Tambah Produk'; ?>
                        </button>
                        <a href="?view=<?php echo $edit_product ? 'products' : 'dashboard'; ?>" class="btn btn-secondary">❌ Batal</a>
                    </div>
                </form>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>