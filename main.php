<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    $login_button = '<a href="login.php" class="button">Login</a>';
} else {
    $username = $_SESSION['username'];
    $login_button = "<div>Welcome, <span>$username</div><br>  <a href='logout.php' class='button'>Logout</a></span>";
}

$query = "SELECT * FROM produk ORDER BY tanggal ASC";
$result = $db->query($query);

$data_produk = [];
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $data_produk[] = $row;
}

$grouped_by_date = [];
foreach ($data_produk as $item) {
    $grouped_by_date[$item['tanggal']][] = $item;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hitung Total Belanja</title>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="table.css">
</head>
<body>
    <div class="dashboard">
        <header>
            <div class="container">
                <h1><a href="main.php">HitungTotalBelanja</a></h1>
                <div class="login"><?= $login_button ?></div>
            </div>
        </header>
    </div>
    
    <div class="content">
        <div class="actions">
            <a href="tambah.php" class="button">Hitung Belanja</a>
        </div>
        <?php
        if (!empty($grouped_by_date)) {
            foreach ($grouped_by_date as $tanggal => $products) {
                echo "<h2>Tanggal: $tanggal</h2>";
                echo "<table>";
                echo "<tr><th>No</th><th>Nama Produk</th><th>Harga Produk</th><th>created_at</th><th>updated_at</th><th>Aksi</th></tr>";
                
                $total_harga = 0;
                foreach ($products as $index => $product) {
                    $total_harga += $product['harga_produk'];
                    $formatted_harga = number_format($product['harga_produk'], 0, ',', '.');
                    echo "<tr>";
                    echo "<td>" . ($index + 1) . "</td>";
                    echo "<td>" . $product['nama_produk'] . "</td>";
                    echo "<td>Rp " . $formatted_harga . "</td>";
                    echo "<td>" . $product['created_at'] . "</td>";
                    echo "<td>" . $product['updated_at'] . "</td>";
                    echo "<td><a href='edit.php?id=" . $product['id'] . "' class='edit-button'>Edit</a> | 
                          <a href='hapus.php?id=" . $product['id'] . "' class='delete-button'>Hapus</a></td>";
                    echo "</tr>";
                }
                
                echo "<tr><td colspan='6' style='text-align:right; font-weight:bold;'>Total Harga: Rp " . number_format($total_harga, 0, ',', '.') . "</td></tr>";
                echo "</table><br>";
            }
        } else {
            echo "<p>Tidak ada data belanja untuk saat ini</p>";
        }
        ?>
    </div>
</body>
</html>
