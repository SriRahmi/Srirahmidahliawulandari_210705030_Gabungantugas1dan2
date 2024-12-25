<?php
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Lomba Olahraga</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <header>
        <div class="container">
            <h1>Pendaftaran Peserta Lomba Olahraga</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Beranda</a></li>
                    <li><a href="form.php">Daftar Lomba</a></li>
                    <li><a href="dashboard.php">Dashboard Peserta</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <section class="konten-utama">
            <div class="hero-section">
                <img src="foto-kegiatan.jpg" alt="Lomba Olahraga" class="hero-image">
                <div class="hero-text">
                    <h2>Selamat Datang di Lomba Olahraga</h2>
                    <p>Bergabunglah dalam lomba seru yang menantang dan buktikan kemampuanmu!</p>
                    <a href="form.php" class="btn">Daftar Sekarang</a>
                </div>
            </div>

            <section class="keunggulan">
                <div class="container">
                    <h3>Kenapa Bergabung?</h3>
                    <p>Ikuti berbagai lomba olahraga seru yang akan menguji ketangkasan dan kemampuanmu dalam berkompetisi. Dapatkan pengalaman tak terlupakan dan hadiah menarik!</p>
                    <div class="icon-container">
                        <i class="fas fa-trophy animated-icon"></i>
                        <i class="fas fa-users animated-icon"></i>
                        <i class="fas fa-medal animated-icon"></i>
                    </div>
                </div>
            </section>

            <section class="informasi">
                <div class="container">
                    <h3>Informasi Lomba</h3>
                    <div class="informasi-content">
                       <div class="informasi-item">
                            <i class="fas fa-calendar-alt"></i>
                            <h4>Tanggal Lomba</h4>
                            <p>Setiap peserta akan mengikuti lomba pada tanggal yang telah ditentukan. Pastikan mendaftar tepat waktu!</p>
                        </div>
                        <div class="informasi-item">
                            <i class="fas fa-location-arrow"></i>
                            <h4>Lokasi Lomba</h4>
                            <p>Lomba ini akan diadakan di beberapa lokasi strategis, pastikan kamu datang tepat waktu di lokasi yang telah ditentukan.</p>
                        </div>
                        <div class="informasi-item">
                            <i class="fas fa-prize"></i>
                            <h4>Hadiah Menarik</h4>
                            <p>Pemenang lomba akan mendapatkan hadiah menarik berupa uang tunai, medali, dan sertifikat!</p>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Pendaftaran Peserta Lomba Olahraga</p>
    </footer>

</body>
</html>
