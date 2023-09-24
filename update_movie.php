<?php
require_once('vendor/autoload.php');
require_once('includes/db.php'); // Sertakan file koneksi database Anda

$client = new \GuzzleHttp\Client();

$response = $client->request('GET', 'https://api.themoviedb.org/3/discover/movie?include_adult=false&include_video=false&language=en-US&page=1&sort_by=popularity.desc', [
  'headers' => [
    'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIxY2I5YWRf....', // Gantilah dengan token Anda
    'accept' => 'application/json',
  ],
]);

$data = json_decode($response->getBody(), true);

if (!empty($data['results'])) {
    foreach ($data['results'] as $movie) {
        // Lakukan penyisipan data ke dalam tabel movie di database Anda
        $title = $mysqli->real_escape_string($movie['title']);
        $overview = $mysqli->real_escape_string($movie['overview']);
        $poster_url = $mysqli->real_escape_string($movie['poster_path']);
        $genre = $mysqli->real_escape_string(implode(', ', $movie['genre_ids']));
        $release_date = $mysqli->real_escape_string($movie['release_date']);
        $runtime = $mysqli->real_escape_string($movie['runtime']);

        // Contoh SQL untuk menyimpan data film ke dalam tabel movie
        $sql = "INSERT INTO movies (title, overview, poster_url, genre, release_date, runtime) VALUES ('$title', '$overview', '$poster_url', '$genre', '$release_date', '$runtime')";
        
        if ($mysqli->query($sql) === TRUE) {
            echo "Data film berhasil disimpan.";
        } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
    }
} else {
    echo "Tidak ada data film yang ditemukan.";
}

// Tutup koneksi basis data
$mysqli->close();
?>
