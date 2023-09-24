<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Film</title>
    <link rel="stylesheet" href="assets/styles.css"> <!-- Gantilah dengan file CSS Anda sendiri -->
</head>
<body>
    <?php
        // Gantilah dengan kode Anda sendiri untuk mengambil data detail film dari API TMDb
        require_once('includes/api.php');
        $movieId = $_GET['id']; // Anda perlu memeriksa dan membersihkan input ini
        $movie = getMovieDetails($movieId); // Anda perlu membuat fungsi ini
    ?>

    <header>
        <h1><?php echo $movie['title']; ?></h1>
    </header>
    <main>
        <div class="movie-details">
            <img src="<?php echo $movie['poster_url']; ?>" alt="<?php echo $movie['title']; ?>">
            <h2>Deskripsi</h2>
            <p><?php echo $movie['overview']; ?></p>
            <h2>Informasi Film</h2>
            <ul>
                <li><strong>Genre:</strong> <?php echo $movie['genre']; ?></li>
                <li><strong>Tanggal Rilis:</strong> <?php echo $movie['release_date']; ?></li>
                <li><strong>Durasi:</strong> <?php echo $movie['runtime']; ?> menit</li>
                <!-- Tambahkan informasi lain sesuai kebutuhan Anda -->
            </ul>
        </div>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Streaming Film Online</p>
    </footer>
</body>
</html>
