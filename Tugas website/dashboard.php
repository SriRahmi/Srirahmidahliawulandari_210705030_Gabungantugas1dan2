<?php
include 'koneksi.php';

// Proses pencarian
$search_query = "";
$result = null;

if (isset($_GET['search'])) {
    $search_query = $conn->real_escape_string($_GET['search']);
    $sql = "SELECT * FROM pendaftar WHERE 
            name LIKE '%$search_query%' OR 
            email LIKE '%$search_query%' OR 
            phone LIKE '%$search_query%'";
    $result = $conn->query($sql);
} else {
    $sql = "SELECT * FROM pendaftar";
    $result = $conn->query($sql);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Peserta Lomba</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: cursive;
        }

        body {
            background-color: #f0f0f0;
            display: flex;
            flex-direction: column;
            align-items: center;
            color: #333;
        }

        header {
            width: 100%;
            padding: 20px;
            background: linear-gradient(90deg, #ff7f50, #ff6347); /* Orange to red gradient */
            color: white;
            text-align: center;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            font-family: cursive;
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        header nav ul {
            display: flex;
            justify-content: center;
            list-style: none;
            margin-top: 10px;
        }

        header nav ul li {
            margin: 0 15px;
        }

        header nav ul li a {
            color: white;
            font-size: 1rem;
            text-decoration: none;
            transition: color 0.3s;
        }

        header nav ul li a:hover {
            color: #ffd700;
        }

        main {
            width: 90%;
            max-width: 1200px;
            margin-top: 20px;
        }

        .search-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            align-items: center;
        }

        .search-container form {
            display: flex;
            gap: 10px;
        }

        .search-container input[type="text"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1rem;
            width: 250px;
        }

        .search-container button {
            padding: 10px 20px;
            background: linear-gradient(90deg, #8e44ad, #9b59b6); /* Purple gradient */
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .search-container button:hover {
            transform: translateY(-2px);
        }

        .search-container .btn {
            padding: 10px 20px;
            background: linear-gradient(90deg, #3498db, #2980b9); /* Blue gradient */
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-size: 1rem;
            transition: transform 0.3s;
        }

        .search-container .btn:hover {
            transform: translateY(-2px);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        table th, table td {
            padding: 15px;
            text-align: center;
            border: 1px solid #ddd;
        }

        table th {
            background: linear-gradient(90deg, #2ecc71, #27ae60); /* Green gradient */
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        .btn-edit {
            background: linear-gradient(90deg, #f39c12, #f1c40f); /* Yellow gradient */
            color: white;
            padding: 10px 15px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 1rem;
            transition: transform 0.3s ease;
        }

        .btn-edit:hover {
            transform: translateY(-2px);
        }

        .btn-delete {
            background: linear-gradient(90deg, #e74c3c, #c0392b); /* Red gradient */
            color: white;
            padding: 10px 15px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 0.9rem;
            transition: transform 0.3s ease;
        }

        .btn-delete:hover {
            transform: translateY(-2px);
        }

        footer {
            margin-top: 20px;
            padding: 10px;
            text-align: center;
            background: #333;
            color: white;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Dashboard Peserta Lomba</h1>
        <nav>
            <ul>
                <li><a href="index.php">Beranda</a></li>
                <li><a href="form.php">Daftar Lomba</a></li>
                <li><a href="dashboard.php">Dashboard Peserta</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="dashboard">
            <div class="search-container">
                <form method="get" action="">
                    <input type="text" name="search" placeholder="Cari peserta..." value="<?php echo htmlspecialchars($search_query); ?>">
                    <button type="submit">Cari</button>
                </form>
                <a href="create.php" class="btn">Tambah Peserta Baru</a>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result && $result->num_rows > 0) {
                        $counter = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $counter++ . "</td>";
                            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['category']) . "</td>";
                            echo "<td>
                                    <a href='update.php?id=" . $row['id'] . "' class='btn-edit'>Edit</a>
                                    <a href='delete.php?id=" . $row['id'] . "' class='btn-delete' onclick='return confirm(\"Apakah Anda yakin?\")'>Hapus</a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>Tidak ada data peserta</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </main>

</body>
</html>
