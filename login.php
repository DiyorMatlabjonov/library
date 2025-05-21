<?php
require 'includes/db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$_POST['email']]);
    $user = $stmt->fetch();

    if ($user && password_verify($_POST['password'], $user['password'])) {
        $_SESSION['user'] = $user;
        header("Location: books.php");
    } else {
        echo "Неверный логин или пароль.";
    }
}
?>

<!-- HTML-форма -->
<form method="POST">
    <input name="email" type="email" placeholder="Email">
    <input name="password" type="password" placeholder="Пароль">
    <button type="submit">Войти</button>
</form>
