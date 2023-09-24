<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Film</title>
    <link rel="stylesheet" href="../assets/styles.css"> <!-- Pastikan path ke file CSS sesuai dengan struktur proyek Anda -->
</head>
<body>
    <header>
        <h1>Detail Film</h1>
    </header>
    <main>
        <?php
            // Gantilah dengan kode Anda sendiri untuk mengambil dan menampilkan detail film
            require_once('../includes/api.php');
            
            if(isset($_GET['id'])) {
                $movieId = $_GET['id'];
                $movie = getMovieDetails($movieId); // Anda perlu membuat fungsi ini untuk mengambil detail film

                if (!empty($movie)) {
                    echo '<div class="movie-details">';
                    echo '<img src="' . $movie['poster_url'] . '" alt="' . $movie['title'] . '">';
                    echo '<h2>' . $movie['title'] . '</h2>';
                    echo '<p>' . $movie['overview'] . '</p>';
                    echo '<h3>Informasi Film</h3>';
                    echo '<ul>';
                    echo '<li><strong>Genre:</strong> ' . $movie['genre'] . '</li>';
                    echo '<li><strong>Tanggal Rilis:</strong> ' . $movie['release_date'] . '</li>';
                    echo '<li><strong>Durasi:</strong> ' . $movie['runtime'] . ' menit</li>';
                    echo '</ul>';
                    echo '</div>';
                } else {
                    echo '<p>Film tidak ditemukan.</p>';
                }
            } else {
                echo '<p>ID film tidak valid.</p>';
            }
        ?>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Situs Streaming Film</p>
    </footer>
</body>
</html>
