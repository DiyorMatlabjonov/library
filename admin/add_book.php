<?php
require '../includes/db.php';
session_start();

// Только для администратора
if ($_SESSION['user']['role'] !== 'admin') {
    die("Доступ запрещён");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre_id = $_POST['genre_id'];
    $description = $_POST['description'];

    // Загрузка файла и обложки
    $file_path = basename($_FILES['file']['name']);
    $cover_path = basename($_FILES['cover']['name']);
    move_uploaded_file($_FILES['file']['tmp_name'], "../assets/uploads/books/" . $file_path);
    move_uploaded_file($_FILES['cover']['tmp_name'], "../assets/uploads/covers/" . $cover_path);

    $stmt = $pdo->prepare("INSERT INTO books (title, author, genre_id, description, file_path, cover_image) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$title, $author, $genre_id, $description, $file_path, $cover_path]);

    header("Location: index.php");
}
?>

<!-- HTML-форма -->
<form method="POST" enctype="multipart/form-data">
    <input name="title" placeholder="Название книги">
    <input name="author" placeholder="Автор">
    <select name="genre_id">
        <?php
        $genres = $pdo->query("SELECT * FROM genres")->fetchAll();
        foreach ($genres as $g) {
            echo "<option value='{$g['id']}'>{$g['name']}</option>";
        }
        ?>
    </select>
    <textarea name="description" placeholder="Описание"></textarea>
    <input type="file" name="file">
    <input type="file" name="cover">
    <button type="submit">Добавить</button>
</form>
