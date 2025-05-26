<?php 
session_start();
include 'inc/fungsi.php';
$photos = getPhotos();

error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Foto Online</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <header>
        <h1>Galeri foto</h1>
        <nav>
            <?php if (isLoggedIn()): ?>
                <a href="upload.php">Upload</a>
                <a href="Profile.php">Profil</a>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
                <a href="register.php">Register</a> 
            <?php endif; ?>
        </nav>
    </header>
    <main>
        <div class="photo-grid">
            <?php foreach ($photos as $photo): 
                $file = $photo ['LokasiFile'] ?? $photo['LokasiFile'] ?? 'default.jpg';
                $image_path = 'uploads/' . $file;
            ?>
                <div class="photo-card">
                    <img src ="<?= file_exists($image_path) ? $image_path : 'default.jpg' ?>" 
                        alt="<?= htmlspecialchars($photo['JudulFoto'] ?? 'Foto') ?>"  
                        class="photo-thumbnail">
                    <div class ="photo-info">
                        <h3 class ="photo-title"><?= htmlspecialchars($photo['JudulFoto'] ?? 'judul Foto') ?></h3>
                    <div class="photo-stats">
                        <span class="likes">
                            <i class="fa fa-heart"></i> <?= $photo['jumlah_like'] ?? 0 ?> suka
                        </span>
                        <span class="comments">
                            <i class="fa fa-comment"></i> <?= $photo['jumlah_komentar'] ?? 0 ?> komentar
                        </span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main> 
    <footer>
        <p>&copy; 2025 Galeri Foto.</p>
    </footer>
</body>
</html>