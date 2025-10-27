<?php
// config.php - Database Configuration
session_start();

// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'kyo_space_cafe');

// Create connection
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Initialize cart if not exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Coffee products data
$products = array(
    1 => array(
        'id' => 1,
        'name' => 'Espresso',
        'price' => 25000,
        'description' => 'Strong and bold Italian coffee',
        'image' => 'https://images.unsplash.com/photo-1510591509098-f4fdc6d0ff04?w=400'
    ),
    2 => array(
        'id' => 2,
        'name' => 'Cappuccino',
        'price' => 30000,
        'description' => 'Perfect blend of espresso, steamed milk and foam',
        'image' => 'https://images.unsplash.com/photo-1572442388796-11668a67e53d?w=400'
    ),
    3 => array(
        'id' => 3,
        'name' => 'Latte',
        'price' => 32000,
        'description' => 'Smooth and creamy coffee with milk',
        'image' => 'https://images.unsplash.com/photo-1461023058943-07fcbe16d735?w=400'
    )
);

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function formatPrice($price) {
    return 'Rp ' . number_format($price, 0, ',', '.');
}
?>