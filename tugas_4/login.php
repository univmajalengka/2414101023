<?php
session_start();
require 'koneksi.php';

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cari akun berdasarkan username
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

    // Cek jika username ada
    if(mysqli_num_rows($result) === 1){
        $row = mysqli_fetch_assoc($result);
        
        // Cek Password (Verify Hash)
        if(password_verify($password, $row['password'])){
            
            // SET SESSION (Simpan identitas siapa yang login)
            $_SESSION['login'] = true;
            $_SESSION['id_user'] = $row['id_user'];
            $_SESSION['role'] = $row['role']; // Ini kuncinya! (admin/customer)
            $_SESSION['nama'] = $row['nama_lengkap'];

            // LOGIKA PEMISAH (REDIRECT)
            if($row['role'] == 'admin'){
                // Jika Admin, masuk ke halaman Admin
                echo "<script>alert('Login Berhasil! Selamat Datang Admin.'); window.location='admin.php';</script>";
            } else {
                // Jika Customer, masuk ke halaman Booking
                echo "<script>alert('Login Berhasil! Silakan Booking.'); window.location='index.php';</script>";
            }
            exit;
        }
    }
    $error = true;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login User</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-emerald-900 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-xl shadow-2xl w-96">
        <h2 class="text-2xl font-bold mb-2 text-center text-gray-800">Login User</h2>
        <p class="text-center text-gray-500 mb-6">Masuk untuk melanjutkan</p>
        
        <?php if(isset($error)) : ?>
            <p class="text-red-500 text-center mb-4 italic font-bold">Username / Password salah!</p>
        <?php endif; ?>

        <form method="POST">
            <label class="block mb-2 font-semibold text-gray-600">Username</label>
            <input type="text" name="username" class="w-full mb-4 p-3 border rounded focus:ring-2 focus:ring-emerald-400 outline-none" required>
            
            <label class="block mb-2 font-semibold text-gray-600">Password</label>
            <input type="password" name="password" class="w-full mb-6 p-3 border rounded focus:ring-2 focus:ring-emerald-400 outline-none" required>
            
            <button type="submit" name="login" class="w-full bg-emerald-600 text-white p-3 rounded-lg font-bold hover:bg-emerald-700 transition">MASUK</button>
        </form>
        
        <p class="mt-6 text-center text-sm text-gray-600">
            Belum punya akun? <a href="register.php" class="text-emerald-600 font-bold hover:underline">Daftar Customer</a>
        </p>
    </div>
</body>
</html>