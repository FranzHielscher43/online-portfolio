<?php
require_once 'db/db_connection.php';
require __DIR__ . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Mailversand 
if(isset($_POST['send'])) {
    $name = htmlspecialchars($_POST['name']);
    $subject = htmlspecialchars($_POST['subject']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $message = htmlspecialchars($_POST['message']);

    if($email && !empty($message)) {
        $mail = new PHPMailer(true);

        try {
            // SMTP Verbindung
            $mail->isSMTP();
            $mail->Host         = 'smtp.gmail.com';
            $mail->SMTPAuth     = true; 
            $mail->Username     = getenv('SMTP_USER');
            $mail->Password     = getenv('SMTP_PASS');
            $mail->SMTPSecure   = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port         = 587;

            // Absender und Empfänger
            $mail->setFrom($email, $name);
            $mail->addAddress('franzhielscher1@gmail.com');
            $mail->addReplyTo($email, $name);

            // Inhalt
            $mail->isHTML(true);
            $mail->Subject  = "$name hat eine Frage - $subject";
            $mail->Body     = nl2br("Name: $name\nE-Mail: $email\n\nNachricht:\n$message");
            $mail->AltBody  = "Name: $name\nE-Mail: $email\n\nNachricht:\n$message";

            $mail->send();
            $success = "Deine Nachricht wurde erfolgreich gesendet!";

        } catch (Exception $e){
            $error = "Die Nachricht konnte nicht gesendet werden. Fehler: {$mail->ErrorInfo}";
        }
    } else {
        $error = "Bitte eine gültige E-Mail und Nachricht eingeben.";
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

$success = $_SESSION['success'] ?? '';
$error = $_SESSION['error'] ?? '';
unset($_SESSION['success'], $_SESSION['error']);

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
    <link rel="stylesheet" href="style/index.css">
</head>
<body>
    <nav class = "navbar">
        <div class = "nav_container">
            <div class = "nav_logo">
                <?= $info['first_name'] ?? '' ?> <?= $info['last_name'] ?? '' ?>
            </div>
            <div class = "nav_links">
                <li><a href="#about">About Me</a></li>
                <li><a href="#projects">Projects</a></li>
                <li><a href="#contact">Contact</a></li>
            </div>
        </div>
    </nav>
    <main class = "main_part">
        <?php while ($project = $project_result->fetch_assoc()): ?>

        <div class = "about_me">
            <img src = "style/images/about_me_4.jpg" alt = "about me">
            <p><strong><?= $info['about_text'] ?? '' ?></strong></p>
        </div>

        <div class = "projects">
            <h3><?= htmlspecialchars($project['title']) ?></h3>
            <p><?= htmlspecialchars($project['description']) ?></p>
            <a href="<?= htmlspecialchars($project['url']) ?>" target="_blank">Projekt ansehen</a>
        </div>
        <?php endwhile; ?>
    </main>

    <footer>
        <div class="footer_content" id = "contact">
            <div class = "left_container">
                <div class = "footer_heading"><b>Let's talk</b></div>
                <br>
                <div class = "footer_information">If you have not found the information you were seeking, please feel free to contact me directly. I will gladly provide you with any additional details you may require.</div>
                <br>
                <button id="btn_modal">Get in Touch for More Information</button>
                <div id="mail_modal" class="modal">
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <?php if (!empty($success)): ?>
                            <p style="color:green;"><?= $success ?></p>
                        <?php endif; ?>
                        <?php if (!empty($error)): ?>
                            <p style="color:red;"><?= $error ?></p>
                        <?php endif; ?>

                        <form method="post" action="">
                            <label for="name">Name:</label><br>
                            <input type="text" id="name" name="name" required><br><br>

                            <label for="subject">Subject:</label><br>
                            <input type="text" id="subject" name="subject" required><br><br>

                            <label for="email">E-Mail: (so I can write back to you)</label><br>
                            <input type="email" id="email" name="email" required><br><br>

                            <label for="message">Message:</label><br>
                            <textarea id="message" name="message" rows="5" required></textarea><br><br>

                            <button type="submit" name="send"><b>Send message</b></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class = "right_container">
                <div>
                    <div class = "left_column">
                        <div><b>Email</b></div>
                        <div><b>Phone</b></div>
                        <div><b>Address</b></div>
                    </div>
                </div>
                <div>
                    <div class = "right_column">
                        <div><b>franzhielscher1@gmail.com</b></div>
                        <div><b>(+49) 15225637773</b></div>
                        <div><b><Address>Bahnhofstraße 1, 04849 Bad Düben <br> Saxony, Germany</Address></b></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
<script src = "script/footer.js"></script>
</html>