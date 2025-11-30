<!DOCTYPE html>
<html>
<head>
    <title>Hitung Diskon</title>
</head>
<body>

    <h2>Input Total Belanja</h2>

    <form method="POST" action="">
        Total Belanja (Rp): 
        <input type="number" name="totalBelanja" required> 
        <input type="submit" name="hitung" value="Hitung">
    </form>

    <?php
    // --- BAGIAN PHP ---
    
    // 1. Fungsi Logika Diskon (Sesuai tugas)
    function hitungDiskon($totalBelanja) {
        if ($totalBelanja >= 100000) {
            return $totalBelanja * 0.10; // 10%
        } elseif ($totalBelanja >= 50000) {
            return $totalBelanja * 0.05; // 5%
        } else {
            return 0; // Tidak ada diskon
        }
    }

    // 2. Cek apakah tombol Hitung sudah ditekan
    if (isset($_POST['hitung'])) {
        $total = $_POST['totalBelanja'];
        
        // Panggil fungsi
        $diskon = hitungDiskon($total);
        $bayar = $total - $diskon;

        // --- TAMPILAN HASIL (Sesuai gambar) ---
        echo "<h3>Hasil Perhitungan</h3>";
        
        // Menggunakan number_format agar ada titik ribuan (Rp 50.000)
        echo "Total Belanja: Rp " . number_format($total, 0, ',', '.') . "<br>";
        echo "Diskon: Rp " . number_format($diskon, 0, ',', '.') . "<br>";
        echo "Total Bayar: Rp " . number_format($bayar, 0, ',', '.') . "<br>";
    }
    ?>

</body>
</html>