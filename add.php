<?php
// Koneksi ke database
$db = new SQLite3('products.db');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // query untuk menambahkan produk
    $sql = "INSERT INTO products (name, price, description) VALUES ('$name', $price, '$description')";

    // Eksekusi query
    $result = $db->query($sql);

    header('Location: index.php');}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #4CAF50; /* Warna hijau */
        }
        form {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            max-width: 400px;
            margin: auto;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #4CAF50; /* Warna hijau */
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #45a049; /* Warna hijau lebih gelap */
        }
        .button-container {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <h1>Tambah Produk</h1>
    <form method="POST">
        <label for="name">Nama Produk:</label>
        <input type="text" name="name" autocomplete="off">
        
        <label for="price">Harga:</label>
        <input type="number" name="price" required>
        
        <label for="description">Deskripsi:</label>
        <textarea name="description" required></textarea>
        
        <div class="button-container">
            <button type="submit">Tambah Produk</button>
            <a href="index.php"><button type="button">Kembali</button></a>
        </div>
    </form>
</body>
</html>
