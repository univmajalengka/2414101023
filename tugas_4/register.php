<?php
require 'koneksi.php';

if(isset($_POST['register'])){
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Enkripsi password
    
    // Cek username kembar
    $cek = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
    if(mysqli_num_rows($cek) > 0){
        echo "<script>alert('Username sudah terpakai!');</script>";
    } else {
        // Insert sebagai customer
        $sql = "INSERT INTO users (nama_lengkap, username, password, role) VALUES ('$nama', '$username', '$password', 'customer')";
        if(mysqli_query($conn, $sql)){
            echo "<script>alert('Daftar berhasil! Silakan login.'); window.location='login.php';</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Akun</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-xl shadow-lg w-96">
        <h2 class="text-2xl font-bold mb-6 text-emerald-600 text-center">Register Customer</h2>
        <form method="POST">
            <input type="text" name="nama" placeholder="Nama Lengkap" required class="w-full mb-4 p-3 border rounded">
            <input type="text" name="username" placeholder="Username" required class="w-full mb-4 p-3 border rounded">
            <input type="password" name="password" placeholder="Password" required class="w-full mb-6 p-3 border rounded">
            <button type="submit" name="register" class="w-full bg-emerald-500 text-white p-3 rounded font-bold hover:bg-emerald-600">Daftar Sekarang</button>
        </form>
        <p class="mt-4 text-center text-sm">Sudah punya akun? <a href="login.php" class="text-emerald-600 font-bold">Login</a></p>
    </div>
</body>
</html>