<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian Film</title>
    <link rel="stylesheet" href="assets/styles.css"> <!-- Gantilah dengan file CSS Anda sendiri -->
</head>
<body>
    <header>
        <h1>Pencarian Film</h1>
    </header>
    <main>
        <form method="GET">
            <input type="text" name="query" placeholder="Masukkan judul film">
            <button type="submit">Cari</button>
        </form>

        <?php
            if(isset($_GET['query'])) {
                $query = $_GET['query'];
                // Gantilah dengan kode Anda sendiri untuk melakukan pencarian dalam basis data
                require_once('includes/db.php'); // Hubungkan ke basis data Anda
                $results = searchMovies($query); // Anda perlu membuat fungsi ini

                if (empty($results)) {
                    echo '<p>Tidak ada hasil yang ditemukan.</p>';
                } else {
                    echo '<h2>Hasil Pencarian untuk "'.$query.'":</h2>';
                    foreach ($results as $movie) {
                        echo '<div class="movie-card">';
                        echo '<img src="' . $movie['poster_url'] . '" alt="' . $movie['title'] . '">';
                        echo '<h2>' . $movie['title'] . '</h2>';
                        echo '<p>' . $movie['overview'] . '</p>';
                        echo '</div>';
                    }
                }
            }
        ?>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Streaming Film Online</p>
    </footer>
</body>
</html>
