<?php 
$conn = new mysqli('localhost', 'root', '', 'website_db');
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM pendaftar WHERE id='$id'");
    $user = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $jenis_kelamin = $_POST['jenis-kelamin'];
    $kategori = $_POST['kategori'];

    // Menggunakan prepared statement untuk mencegah SQL injection
    $sql = "UPDATE pendaftar SET name=?, email=?, phone=?, gender=?, category=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $nama, $email, $telepon, $jenis_kelamin, $kategori, $id);

    if ($stmt->execute()) {
        header("Location: dashboard.php");  
    } else {
        echo "Error updating record: " . $stmt->error;
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Peserta</title>
    <style>
        body {
            font-family: cursive;
            background: linear-gradient(90deg, #ff6347, #ff7f50); /* Warm gradient */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }

        .container {
            background-color: #fff;
            padding: 20px 40px;
            border-radius: 12px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.15);
            width: 400px;
            margin-top: 50px;
            max-width: 90%;
            position: relative;
        }

        .title-box {
            background: linear-gradient(90deg, #ff4500, #f44336); /* Bright red gradient */
            padding: 10px;
            border-radius: 8px;
            margin: -40px auto 20px; 
            color: #fff;
            font-size: 2.5rem;
            font-family: cursive;
            text-align: center;
            width: 100%;
            position: absolute;
            top: -25px;
            left: 50%;
            transform: translateX(-50%);
        }

        form label {
            display: block;
            font-weight: bold;
            margin-top: 20px;
        }

        form input[type="text"], form input[type="email"], form input[type="tel"], form select {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            background-color: #fafafa; /* Light background for form fields */
        }

        form button {
            width: 100%;
            padding: 12px;
            margin-top: 25px;
            background-color: #28a745; /* Green for action button */
            border: none;
            color: #fff;
            font-size: 1rem;
            border-radius: 8px;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        form button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="title-box">Edit Peserta</div>
        <form action="#" method="post">
            <label for="nama">Nama Lengkap:</label>
            <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($user['name'] ?? ''); ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" required>

            <label for="telepon">Nomor Telepon:</label>
            <input type="tel" id="telepon" name="telepon" value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>" required>

            <label for="jenis-kelamin">Jenis Kelamin:</label>
            <select id="jenis-kelamin" name="jenis-kelamin" required>
                <option value="laki-laki" <?php if ($user['gender'] == 'laki-laki') echo 'selected'; ?>>Laki-laki</option>
                <option value="perempuan" <?php if ($user['gender'] == 'perempuan') echo 'selected'; ?>>Perempuan</option>
            </select>

            <label for="kategori">Kategori Lomba:</label>
            <select id="kategori" name="kategori" required>
                <option value="lari" <?php if ($user['category'] == 'lari') echo 'selected'; ?>>Lari</option>
                <option value="berenang" <?php if ($user['category'] == 'berenang') echo 'selected'; ?>>Berenang</option>
                <option value="sepak bola" <?php if ($user['category'] == 'sepak-bola') echo 'selected'; ?>>Sepak Bola</option>
                <option value="bulu tangkis" <?php if ($user['category'] == 'bulu-tangkis') echo 'selected'; ?>>Bulu Tangkis</option>
                <option value="voli" <?php if ($user['category'] == 'voli') echo 'selected'; ?>>Voli</option>
                <option value="tenis" <?php if ($user['category'] == 'tenis') echo 'selected'; ?>>Tenis</option>
            </select>

            <button type="submit">Edit</button>
        </form>
    </div>
</body>
</html>

<?php $conn->close(); ?>
