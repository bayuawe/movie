<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Genre Film</title>
    <link rel="stylesheet" href="../asset/style.css"> <!-- Pastikan path ke file CSS sesuai dengan struktur proyek Anda -->
</head>
<body>
    <header>
        <h1>Daftar Genre Film</h1>
    </header>
    <main>
        <?php
            require_once('../vendor/autoload.php');
            require_once('../include/api.php');
            use GuzzleHttp\Client;

            $client = new Client();
            $api_key = '439651f2'; // Gantilah dengan kunci API OMDb Anda
            $movieTitle = 'Avatar'; // Gantilah dengan judul film yang Anda inginkan

            try {
                // Menggunakan contoh fungsi untuk mendapatkan detail film berdasarkan judul
                $movieDetails = getMovieDetails($api_key, $movieTitle);

                // Tampilkan informasi film sesuai kebutuhan Anda
                echo '<h2>' . $movieDetails['title'] . '</h2>';
                echo '<img src="' . $movieDetails['poster_url'] . '" alt="' . $movieDetails['title'] . '">';
                echo '<p>Plot: ' . $movieDetails['plot'] . '</p>';
                echo '<p>Genre: ' . $movieDetails['genre'] . '</p>';
                echo '<p>Release Date: ' . $movieDetails['release_date'] . '</p>';
                echo '<p>Runtime: ' . $movieDetails['runtime'] . '</p>';
                // Tambahkan tampilan lain sesuai kebutuhan Anda
            } catch (Exception $e) {
                // Handle error, misalnya tampilkan pesan kesalahan atau log pesan kesalahan
                echo 'Terjadi kesalahan saat mengambil data film.' . $e->getMessage();
            }
        ?>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Situs Streaming Film</p>
    </footer>
</body>
</html>
