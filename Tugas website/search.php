<?php 
// Menghubungkan ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "website_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Menangani pencarian
$searchTerm = '';
$results = [];

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['keyword'])) {
    $searchTerm = $_GET['keyword'];

    // Query untuk mencari data berdasarkan kolom 'name', 'email', atau 'phone'
    $sql = "SELECT * FROM pendaftar WHERE name LIKE ? OR email LIKE ? OR phone LIKE ?";
    $stmt = $conn->prepare($sql);
    $likeSearch = "%" . $searchTerm . "%";
    $stmt->bind_param("sss", $likeSearch, $likeSearch, $likeSearch);
    $stmt->execute();
    $result = $stmt->get_result();

    // Menyimpan hasil pencarian
    while ($row = $result->fetch_assoc()) {
        $results[] = $row;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="zactor/style.css">
    <title>Hasil Pencarian</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f4f8; /* Light grayish-blue background */
            color: #333;
            margin: 0;
            padding: 0;
        }

        .contalner {
            width: 90%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #3e8e41; /* Green title color */
            text-align: center;
        }

        .header-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .btn {
            background-color: #ff5722; /* Bright orange */
            padding: 10px 20px;
            border-radius: 5px;
            color: white;
            text-decoration: none;
            font-weight: bold;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .search-form {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .search-form input[type="text"] {
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-size: 1em;
            background: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 250px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .search-form input[type="text"]:focus {
            outline: none;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
        }

        .search-form button {
            padding: 12px 24px;
            background: linear-gradient(90deg, #4CAF50, #66BB6A);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1em;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .search-form button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.3);
        }

        .table-container {
            margin-top: 20px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50; /* Green header */
            color: white;
        }

        td {
            background-color: #f9f9f9;
        }

        td a {
            padding: 8px 12px;
            margin: 0 5px;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn-edit {
            background-color: #ffc107; /* Yellow for edit */
            color: white;
        }

        .btn-delete {
            background-color: #f44336; /* Red for delete */
            color: white;
        }

        .btn-edit:hover, .btn-delete:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <div class="contalner">
        <h2>Hasil Pencarian</h2>
        <div class="header-actions">
            <a href="index.php" class="btn">Kembali</a>
            <form action="search.php" method="GET" class="search-form">
                <input type="text" name="keyword" placeholder="Cari nama atau email..." value="<?php echo htmlspecialchars($_GET['keyword'] ?? ''); ?>" required>
                <button type="submit" class="search-btn">Cari</button>
            </form>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if (!empty($results)) {
                    foreach ($results as $index => $row) {
                        echo "<tr>";
                        echo "<td>" . ($index + 1) . "</td>";
                        echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["phone"]) . "</td>";
                        echo "<td>
                                <a href='update.php?id=" . $row["id"] . "' class='btn-edit'>Edit</a>
                                <a href='delete.php?id=" . $row["id"] . "' class='btn-delete'>Hapus</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Tidak ada hasil yang ditemukan</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
