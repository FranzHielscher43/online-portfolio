<?php
require_once 'db/db_connection.php';

// Persönliche Infos laden
$info_sql = "SELECT * FROM informations ORDER BY created ASC";
$info_result = $conn->query($info_sql);
$info = $info_result->fetch_assoc();

// Projekte laden
$project_sql = "SELECT * FROM projects ORDER BY created DESC";
$project_result = $conn->query($project_sql);
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title><?= $info ? $info['first_name'] . ' ' . $info['last_name'] : 'Mein Portfolio' ?></title>
    <link rel="stylesheet" href="style/global.css"> 
</head>
<body>
    <header>
        <h1><?= $info['first_name'] ?? '' ?> <?= $info['last_name'] ?? '' ?></h1>
        <p><strong><?= $info['profession'] ?? '' ?></strong></p>
        <p><?= $info['email'] ?? '' ?></p>
    </header>

    <main>
        <h2>Meine Projekte</h2>
        <ul>
            <?php while ($project = $project_result->fetch_assoc()): ?>
                <li>
                    <h3><?= htmlspecialchars($project['title']) ?></h3>
                    <p><?= htmlspecialchars($project['description']) ?></p>
                    <a href="<?= htmlspecialchars($project['url']) ?>" target="_blank">Projekt ansehen</a>
                </li>
            <?php endwhile; ?>
        </ul>
    </main>

    <footer>
        <div class="footer_content">
            <div class = "left">© 
                <?= date('Y') ?> <?= $info['first_name'] ?? '' ?> <?= $info['last_name'] ?? '' ?>
            </div>
            <div class = "center">
                <span>Instagram</span>
                <span>Impressum</span>
                <span>Kontakt</span>
            </div>
        </div>
    </footer>
</body>
</html>