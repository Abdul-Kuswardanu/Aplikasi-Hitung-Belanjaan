<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tanggal = $_POST['tanggal'];
    $nama_produk = $_POST['nama_produk'];
    $harga_produk = str_replace(['Rp', '.', ','], '', $_POST['harga_produk']);
    $created_at = date('Y-m-d H:i:s');
    $updated_at = date('Y-m-d H:i:s');

    $query = "INSERT INTO produk (tanggal, nama_produk, harga_produk, created_at, updated_at) 
              VALUES ('$tanggal', '$nama_produk', '$harga_produk', '$created_at', '$updated_at')";
    $db->exec($query);
    header('Location: main.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Belanja</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <div class="dashboard">
        <header>
            <div class="container">
                <h1><a href="main.php">HitungTotalBelanja</a></h1>
            </div>
        </header>
    </div>

    <div class="content">
        <form action="tambah.php" method="POST" class="form-edit">
            <label for="tanggal">Tanggal:</label>
            <input type="date" name="tanggal" value="<?php echo date('Y-m-d'); ?>" required>
            
            <label for="nama_produk">Nama Produk:</label>
            <input type="text" name="nama_produk" placeholder="Barang apapun yang Anda beli" required>
            
            <label for="harga_produk">Harga Produk:</label>
            <input type="text" name="harga_produk" id="harga_produk" placeholder="contoh: 20000" required>
            
            <button type="submit" class="button">Tambah</button>
        </form>
    </div>
</body>
</html>
