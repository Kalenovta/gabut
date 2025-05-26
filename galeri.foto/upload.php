<?php 
session_start();
include 'inc/fungsi.php';
//redirect jika belum login
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
} else {
    $error = "Gagal mengunggah foto.";
}
?>
<!DOCTYPE html>
<>
<head>
    <title>Upload Foto</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<>
    <header>
        <h1>Upload Foto</h1>
        <nav>
            <a href="index.php">Beranda</a>
            <a href="profile.php">Profil</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>
        <?php if (isset($error)): ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>
    <main>
            <div class="form-container">
			<form method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label>Judul Foto:</label>
					<input type="text" name="judul" required>
				</div>
				
				<div class="form-group">
					<label>Pilih Album:</label>
					<select name="album_id" required>
						<?php while($album = mysqli_fetch_assoc($albums)): ?>
							<option value="<?= $album['AlbumID'] ?>"><?= $album['NamaAlbum'] ?></option>
						<?php endwhile; ?>
					</select>
				</div>
				
				<div class="form-group">
					<label>Deskripsi Foto:</label>
					<input type="text" name="deskripsi" required>
				</div>
				
				<div class="form-group">
					<label>Pilih Foto:</label>
					<input type="file" name="foto" accept="image/*" required>
				</div>
            </form>	
        </div>
    </main>
</body>    		
</html>