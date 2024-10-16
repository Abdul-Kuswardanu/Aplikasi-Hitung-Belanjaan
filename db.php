<?php
$db = new SQLite3('database.db');

if (!$db) {
    echo $db->lastErrorMsg();
    exit();
}

$query_produk = "CREATE TABLE IF NOT EXISTS produk (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    tanggal TEXT NOT NULL,
    nama_produk TEXT NOT NULL,
    harga_produk INTEGER NOT NULL,
    created_at TEXT NOT NULL,
    updated_at TEXT NOT NULL
)";
$result_produk = $db->exec($query_produk);

if (!$result_produk) {
    echo "Error creating produk table: " . $db->lastErrorMsg();
    exit();
}

$query_login = "CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL
)";
$result_login = $db->exec($query_login);

if (!$result_login) {
    echo "Error creating login table: " . $db->lastErrorMsg();
    exit();
}

$query_signup = "CREATE TABLE IF NOT EXISTS signup (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nama TEXT NOT NULL,
    username TEXT NOT NULL UNIQUE,
    email TEXT NOT NULL,
    password TEXT NOT NULL
)";
$result_signup = $db->exec($query_signup);

if (!$result_signup) {
    echo "Error creating signup table: " . $db->lastErrorMsg();
    exit();
}
?>
