<?php
require 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$name, $email, $password]);

    header("Location: login.php");
}
?>

<!-- HTML-форма -->
<form method="POST">
    <input name="name" placeholder="Имя">
    <input name="email" type="email" placeholder="Email">
    <input name="password" type="password" placeholder="Пароль">
    <button type="submit">Зарегистрироваться</button>
</form>
