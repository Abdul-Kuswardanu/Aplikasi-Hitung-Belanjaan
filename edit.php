<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nama_produk = $_POST['nama_produk'];
    $harga_produk = $_POST['harga_produk'];
    $updated_at = date('Y-m-d H:i:s');

    $query = "UPDATE produk SET nama_produk='$nama_produk', harga_produk='$harga_produk', updated_at='$updated_at' WHERE id=$id";
    $db->exec($query);
    header('Location: main.php');
}

$id = $_GET['id'];
$query = "SELECT * FROM produk WHERE id=$id";
$result = $db->query($query);
$product = $result->fetchArray(SQLITE3_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Belanja</title>
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
        <form action="edit.php" method="POST" class="form-edit">
            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
            
            <label for="nama_produk">Nama Produk:</label>
            <input type="text" name="nama_produk" value="<?php echo $product['nama_produk']; ?>" required>
            
            <label for="harga_produk">Harga Produk:</label>
            <input type="number" name="harga_produk" value="<?php echo $product['harga_produk']; ?>" required>
            
            <button type="submit" class="button">Edit</button>
        </form>
    </div>
</body>
</html>
