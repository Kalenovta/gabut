<?php
include 'koneksi.php';
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}
function getPhotos($album_id = null) {
    global $conn;
    $query = "SELECT * FROM foto";
    if ($album_id) {
        $query .= " WHERE AlbumID = $album_id";
    }
    $query .= " ORDER BY TanggalUnggah DESC";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>