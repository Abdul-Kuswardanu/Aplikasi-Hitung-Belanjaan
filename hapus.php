<?php
include 'db.php';

$id = $_GET['id'];

$query = "DELETE FROM produk WHERE id=$id";
$db->exec($query);

header('Location: main.php');
?>
