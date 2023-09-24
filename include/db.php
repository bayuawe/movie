<?php
// Konfigurasi koneksi basis data
$host = "localhost"; // Ganti dengan host basis data Anda
$username = "root"; // Ganti dengan username basis data Anda
$password = "123"; // Ganti dengan password basis data Anda
$database = "indoflix"; // Ganti dengan nama basis data Anda

// Membuat koneksi ke basis data MySQL
$mysqli = new mysqli($host, $username, $password, $database);

// Memeriksa koneksi
if ($mysqli->connect_error) {
    die("Koneksi ke basis data gagal: " . $mysqli->connect_error);
}

// Fungsi untuk mengambil daftar film terbaru
function getLatestMovies() {
    global $mysqli;
    $sql = "SELECT * FROM movies ORDER BY release_date DESC LIMIT 10"; // Gantilah sesuai dengan struktur tabel Anda

    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        $movies = [];
        while ($row = $result->fetch_assoc()) {
            $movies[] = $row;
        }
        return $movies;
    } else {
        return [];
    }
}

// Fungsi untuk mengambil detail film berdasarkan ID
function getMovieDetails($movieId) {
    global $mysqli;
    $movieId = $mysqli->real_escape_string($movieId); // Mencegah SQL injection

    $sql = "SELECT * FROM movies WHERE id = '$movieId'"; // Gantilah sesuai dengan struktur tabel Anda

    $result = $mysqli->query($sql);

    if ($result->num_rows == 1) {
        return $result->fetch_assoc();
    } else {
        return [];
    }
}
