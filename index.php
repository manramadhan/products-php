<?php
// Koneksi ke database
$db = new SQLite3('products.db');

// Buat Tabel
$query = "
CREATE TABLE IF NOT EXISTS products (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    price REAL NOT NULL,
    description TEXT
)";

$db->query($query);

$results = $db->query('SELECT * FROM products');


if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $db->query("DELETE FROM products WHERE id = $id");
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .navbar {
            background-color: #4CAF50;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar h1 {
            color: white; 
            margin: 0; 
        }
        .navbar button {
            padding: 10px 15px;
            background-color: white;
            color: #4CAF50;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .navbar button:hover {
            background-color: #45a049; 
            color: white;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .add-button {
            margin-left: auto;
        }
        .delete-button {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 3px;
        }
        .delete-button:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>Daftar Produk</h1>
        <a class="add-button" href="add.php"><button>Tambah Produk</button></a>
    </div>

    <table>
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>
        <?php
        $no = 1;
        while ($row = $results->fetchArray()) {
            echo "<tr>
                <td>{$no}</td>
                <td>{$row['name']}</td>
                <td>Rp " . number_format($row['price'], 2, ',', '.') . "</td>
                <td>{$row['description']}</td>
                <td>
                    <a href='edit.php?id={$row['id']}'><button>Edit</button></a>
                    <a href='index.php?delete={$row['id']}' onclick='return confirm(\"Apakah Anda yakin ingin menghapus produk ini?\");'>
                        <button class='delete-button'>Delete</button>
                    </a>
                </td>
            </tr>";
            $no++;
        }
        ?>
    </table>
</body>
</html>
