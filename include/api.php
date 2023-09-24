<?php
require_once('vendor/autoload.php');
use GuzzleHttp\Client;

// Kunci API
$api_key = '819a4a59abba893b709e265dbbf62935'; // Gantilah dengan kunci API Anda

// Fungsi untuk mengambil data film trending dari API TMDb
function getTrendingMovies($api_key) {
    $client = new Client();
    $url = 'https://api.themoviedb.org/3/trending/movie/week';

    try {
        $response = $client->request('GET', $url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $api_key,
                'accept' => 'application/json',
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        return isset($data['results']) ? $data['results'] : [];
    } catch (Exception $e) {
        // Handle error, misalnya tampilkan pesan kesalahan atau log pesan kesalahan
        return [];
    }
}

// Fungsi untuk mengambil detail film dari API TMDb berdasarkan ID film
function getMovieDetails($api_key, $movieId) {
    $client = new Client();
    $url = 'https://api.themoviedb.org/3/movie/' . $movieId;

    try {
        $response = $client->request('GET', $url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $api_key,
                'accept' => 'application/json',
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        // Format informasi film sesuai kebutuhan Anda
        $movieDetails = [
            'title' => isset($data['original_title']) ? $data['original_title'] : '',
            'poster_url' => isset($data['poster_path']) ? 'https://image.tmdb.org/t/p/w500' . $data['poster_path'] : '',
            'overview' => isset($data['overview']) ? $data['overview'] : '',
            'genre' => isset($data['genres']) ? implode(', ', array_column($data['genres'], 'name')) : '',
            'release_date' => isset($data['release_date']) ? $data['release_date'] : '',
            'runtime' => isset($data['runtime']) ? $data['runtime'] : '',
            // Tambahkan informasi lain sesuai kebutuhan Anda
        ];

        return $movieDetails;
    } catch (Exception $e) {
        // Handle error, misalnya tampilkan pesan kesalahan atau log pesan kesalahan
        return [];
    }
}

// Menggunakan contoh fungsi untuk mendapatkan film trending
$trendingMovies = getTrendingMovies($api_key);
foreach ($trendingMovies as $movie) {
    // Menggunakan contoh fungsi untuk mendapatkan detail film berdasarkan ID
    $movieDetails = getMovieDetails($api_key, $movie['id']);

    // Tampilkan informasi film sesuai kebutuhan Anda
    echo '<h2>' . $movieDetails['title'] . '</h2>';
    echo '<img src="' . $movieDetails['poster_url'] . '" alt="' . $movieDetails['title'] . '">';
    echo '<p>' . $movieDetails['overview'] . '</p>';
    echo '<p>Genre: ' . $movieDetails['genre'] . '</p>';
    echo '<p>Release Date: ' . $movieDetails['release_date'] . '</p>';
    echo '<p>Runtime: ' . $movieDetails['runtime'] . ' minutes</p>';
    // Tambahkan tampilan lain sesuai kebutuhan Anda
}
?>
