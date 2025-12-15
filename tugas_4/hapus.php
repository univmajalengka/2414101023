<?php
session_start();
require 'koneksi.php';

if(!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin'){
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];

if(isset($id)){
    // REVISI: Menggunakan 'WHERE id = ...' (bukan id_pesanan)
    $query = "DELETE FROM pesanan WHERE id = '$id'";
    
    if(mysqli_query($conn, $query)){
        echo "<script>alert('Data berhasil dihapus!'); document.location.href = 'admin.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data!'); document.location.href = 'admin.php';</script>";
    }
}
?>