<?php
// Koneksi ke Database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "wisata_db";

$conn = mysqli_connect($host, $user, $pass, $db);

if(isset($_POST['simpan'])){
    $nama = $_POST['nama'];
    $durasi = $_POST['durasi'];
    $peserta = $_POST['peserta'];
    
    // Cek apakah checkbox dicentang (1 atau 0)
    $inap = isset($_POST['penginapan']) ? 1 : 0;
    $trans = isset($_POST['transport']) ? 1 : 0;
    $makan = isset($_POST['makan']) ? 1 : 0;
    
    $harga_paket = $_POST['harga_paket'];
    $total = $_POST['total_tagihan'];

    // Query Insert
    $sql = "INSERT INTO pesanan (nama_pemesan, waktu_perjalanan, jumlah_peserta, layanan_penginapan, layanan_transport, layanan_makan, harga_paket, total_tagihan) 
            VALUES ('$nama', '$durasi', '$peserta', '$inap', '$trans', '$makan', '$harga_paket', '$total')";

    if(mysqli_query($conn, $sql)){
        echo "Data berhasil disimpan! <a href='index.php'>Lihat Data</a>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>