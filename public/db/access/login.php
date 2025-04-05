<?php
session_start();
require_once './../db_connection.php';

$fehler = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $passwort = $_POST['password'] ?? '';

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($passwort, $user['password'])) {
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $user['username'];
            header("Location: ./../formular.php");
            exit();
        }
    }

    $fehler = "Benutzername oder Passwort ist falsch.";
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <?php if ($fehler): ?><p style="color:red;"><?= $fehler ?></p><?php endif; ?>
    <form method="POST">
        <label>Benutzername: <input type="text" name="username" required></label><br><br>
        <label>Passwort: <input type="password" name="password" required></label><br><br>
        <button type="submit">Einloggen</button>
    </form>
</body>
</html>