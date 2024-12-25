<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'website_db');
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $jenis_kelamin = $_POST['jenis-kelamin'];
    $kategori = $_POST['kategori'];

    // Gunakan prepared statements untuk keamanan
    $stmt = $conn->prepare("INSERT INTO pendaftar (name, email, phone, gender, category) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nama, $email, $telepon, $jenis_kelamin, $kategori);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
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
    <title>Form Pendaftaran Peserta Lomba</title>
    <style>
        body {
            font-family: cursive;
            background: linear-gradient(90deg, #f6d365, #fda085);  /* Gradient from light orange to pink */
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
            margin-top: 50px; /* Menambahkan jarak ke atas */
            max-width: 90%;
            position: relative;
        }

        .title-box {
            background: linear-gradient(90deg, #e74c3c, #f39c12);  /* Gradient from red to yellow */
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
        }

        form button {
            width: 100%;
            padding: 12px;
            margin-top: 25px;
            background-color: #9b59b6;  /* Purple button */
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
        <div class="title-box">Form Pendaftaran</div>
        <form action="#" method="post">
            <label for="nama">Nama Lengkap:</label>
            <input type="text" id="nama" name="nama" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="telepon">Nomor Telepon:</label>
            <input type="tel" id="telepon" name="telepon" required>

            <label for="jenis-kelamin">Jenis Kelamin:</label>
            <select id="jenis-kelamin" name="jenis-kelamin" required>
                <option value="laki-laki">Laki-laki</option>
                <option value="perempuan">Perempuan</option>
            </select>

            <label for="kategori">Kategori Lomba:</label>
            <select id="kategori" name="kategori" required>
                <option value="lari">Lari</option>
                <option value="berenang">Berenang</option>
                <option value="sepak-bola">Sepak Bola</option>
                <option value="bulu-tangkis">Bulu Tangkis</option>
                <option value="voli">Voli</option>
                <option value="tenis">Tenis</option>
            </select>

            <button type="submit">Daftar</button>
        </form>
    </div>
</body>
</html>
