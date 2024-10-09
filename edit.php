<?php
// Koneksi ke database
$db = new SQLite3('products.db');

// Ambil ID produk dari URL dan validasi
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Ambil data produk berdasarkan ID
$product = $db->querySingle("SELECT * FROM products WHERE id = $id", true);

// Periksa apakah produk ditemukan
if (!$product) {
    die("Produk tidak ditemukan.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Query untuk memperbarui produk
    $sql = "UPDATE products SET name = '$name', price = $price, description = '$description' WHERE id = $id";

    // Eksekusi query
    $result = $db->query($sql);

    if ($result) {
        header('Location: index.php');
    } else {
        echo "Gagal memperbarui produk: " . $db->lastErrorMsg();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
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
    <h1>Edit Produk</h1>
    <form method="POST">
        <label for="name">Nama Produk:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required><br>
        
        <label for="price">Harga:</label>
        <input type="number" step="0.01" name="price" value="<?= htmlspecialchars($product['price']) ?>" required><br>
        
        <label for="description">Deskripsi:</label>
        <textarea name="description" required><?= htmlspecialchars($product['description']) ?></textarea><br>
        
        <div class="button-container">
            <button type="submit">Simpan Perubahan</button>
            <a href="index.php"><button type="button">Kembali</button></a>
        </div>
    </form>
</body>
</html>
