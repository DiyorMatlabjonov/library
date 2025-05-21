<?php
require 'includes/db.php';
$stmt = $pdo->query("SELECT books.*, genres.name AS genre_name FROM books LEFT JOIN genres ON books.genre_id = genres.id");
$books = $stmt->fetchAll();
?>

<?php foreach ($books as $book): ?>
    <div>
        <img src="assets/uploads/covers/<?= $book['cover_image'] ?>" width="100">
        <h3><?= $book['title'] ?> — <?= $book['author'] ?></h3>
        <p><?= $book['genre_name'] ?></p>
        <a href="read.php?id=<?= $book['id'] ?>">Читать онлайн</a> |
        <a href="download.php?id=<?= $book['id'] ?>">Скачать</a>
    </div>
<?php endforeach; ?>
