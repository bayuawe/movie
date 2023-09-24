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
            $api_key = '819a4a59abba893b709e265dbbf62935'; // Gantilah dengan kunci API Anda
            $url = 'https://api.themoviedb.org/3/genre/movie/list?language=en';

            try {
                $response = $client->request('GET', $url, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $api_key,
                        'accept' => 'application/json',
                    ],
                ]);

                $genres = json_decode($response->getBody(), true);

                if (!empty($genres['genres'])) {
                    echo '<ul>';
                    foreach ($genres['genres'] as $genre) {
                        echo '<li>' . $genre['name'] . '</li>';
                    }
                    echo '</ul>';
                } else {
                    echo 'Tidak ada genre film yang ditemukan.';
                }
            } catch (Exception $e) {
                // Handle error, misalnya tampilkan pesan kesalahan atau log pesan kesalahan
                echo 'Terjadi kesalahan saat mengambil data genre film.' . $e->getMessage();
            }
        ?>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Situs Streaming Film</p>
    </footer>
</body>
</html>
