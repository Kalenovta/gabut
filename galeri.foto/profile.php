<?
session_start();
include 'inc/fungsi.php';
// Redirect jika belum login
if (!isLoggedIn()) {
    header('Location: login.php');
    exit();
}

// Ambil data pengguna dari session
$albums = mysqli_query($conn, "SELECT * FROM album WHERE UserID = " . $_SESSION['user_id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $upload_dir = 'uploads/';
   $file_name =basename($_FILES['fote']['name']);
   $file_path = $upload_dir . $file_name;

   //pindahkan file ke folder uploads
   if (move_uploaded_file($_FILES['fote']['tmp_name'], $file_path)) {
       // Simpan ke database
      include 'inc/koneksi.php';
      $judul = trim($_POST['judul'] ?? 'tanpa judul');
      $deskripsi = $_SESSION['deskripsi'];
      $user_id =trim ($_SESSION['user_id']);
      $album_id = trim($_POST['album_id']);

      $sql = "INSERT INTO foto (Judul, Deskripsi, LokasiFile, UserID, AlbumID) 
        VALUES ('$judul', '$deskripsi', '$file_name', '$user_id', '$album_id')";
    mysqli_query($conn, $sql);   
    $success= "Foto berhasil diunggah!";
   } else {
       $error = "Gagal mengunggah foto.";
}
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Upload Foto</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <header>
        <h1>Upload Foto</h1>
        <nav>
            <a href="index.php">Beranda</a>
            <a href="profile.php">Profil</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <main>
        <div class ="form-container">
           <div class ="profile-info">
            <h3><?=htmlspecialchars($user['NamaLengkap'])?></h3>
            p>Username: <?= htmlspecialchars($user['Username']) ?></p>
            <p>Email: <?= htmlspecialchars($user['Email']) ?></p>
            <p>Alamat: <?= htmlspecialchars($user['Alamat']) ?></p>
        </div>
        
        <div class="profile-stats">
            <span class="stat">Foto: <?= $total_foto ?></span>
        </div>
    </div>
 </main>
</body>
</html>