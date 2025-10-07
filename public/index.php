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

// Einstellungen laden
$color_sql = "SELECT primary_color, secondary_color, contact_font_color, navbar_color, footer_color FROM settings ORDER BY created ASC LIMIT 1";
$color_result = $conn->query($color_sql);
$color = $color_result->fetch_assoc();

$primary_color = $color['primary_color'];
$secondary_color = $color['secondary_color'];
$contact_font_color = $color['contact_font_color'];
$navbar_color = $color['navbar_color'];
$footer_color = $color['footer_color'];

// Persönliche Infos laden
$info_sql = "SELECT * FROM informations ORDER BY created ASC";
$info_result = $conn->query($info_sql);
$info = $info_result->fetch_assoc();

// CV laden
$cv_sql = "SELECT * FROM CV ORDER BY created ASC";
$cv_result = $conn->query($cv_sql);

// Projekte laden
$project_sql = "SELECT * FROM projects ORDER BY created ASC";
$project_result = $conn->query($project_sql);

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $info ? $info['first_name'] . ' ' . $info['last_name'] : 'Mein Portfolio' ?></title>

    <style>
        :root {
            --primary-color: <?= htmlspecialchars($primary_color) ?>;
            --secondary-color: <?= htmlspecialchars($secondary_color) ?>;
            --contact-font-color: <?= htmlspecialchars($contact_font_color) ?>;
            --navbar-color: <?= htmlspecialchars($navbar_color) ?>;
            --footer-color: <?= htmlspecialchars($footer_color) ?>;
        }
    </style>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="style/index.css" rel="stylesheet">

</head>
<body>
    <nav class = "navbar">
        <div class = "nav_container">
            <div class = "nav_logo">
                <?= $info['first_name'] ?? '' ?> <?= $info['last_name'] ?? '' ?>
            </div>
            <div id = "nav_links">
                <a href="#about">About Me</a>
                <a href="#cv">CV</a>
                <a href="#projects">Projects</a>
                <a href="#contact">Contact</a>
            </div>
            <a href = "javascript:void(0);" class = "icon" onclick = "toggle_menu()">
                <i class = "fa fa-bars"></i>
            </a>
        </div>
        <div class="progress_container">
            <div class="progress_bar" id="myBar"></div>
        </div>
    </nav>
    <main class = "main_part">
        <div class = "about_me" id = "about">
            <img src="style/images/about_me/<?= htmlspecialchars($info['image_path'] ?? 'default.jpg') ?>" alt="about me">
            <div class = "about_me_text">
                <h1>Hello, I'm <?= $info['first_name'] ?? '' ?>...</h1>
                <p><?= $info['about_text'] ?? '' ?></p>
            </div>
            <br>
        </div>
        <div class = "cv" id = "cv">
            <div class = "cv_heading">
                <h1>Milestones</h1>
            </div>
            <div class = "cv_container">
                <?php while($cv = $cv_result->fetch_assoc()): ?>
                <div class="cv_entry">
                    <h2><?= htmlspecialchars($cv['name']) ?? ''?></h2>
                    <p>Position: <?= htmlspecialchars($cv['position']) ?? ''?></p>
                    <p>Institution: <?= htmlspecialchars($cv['company']) ?? ''?></p>
                    <p>Address: <?= htmlspecialchars($cv['address']) ?? ''?></p>
                    <p>Since: <?= htmlspecialchars($cv['start_date']) ?? ''?></p>
                    <p>Until: <?= htmlspecialchars($cv['end_date']) ?? ''?></p>
                    <p>Description: <?= htmlspecialchars($cv['description']) ?? ''?></p>
                </div>
                <?php endwhile; ?>
            </div>
        </div>

        <div class="projects" id="projects">
            <h1>Projects</h1>
            <?php while($project = $project_result->fetch_assoc()): ?>
            <div class="project_entry">
                <div class="project_text">
                    <h3><?= htmlspecialchars($project['title']) ?></h3>
                    <p><?= htmlspecialchars($project['description']) ?></p>
                    <a href="<?= htmlspecialchars($project['url']) ?>" target="_blank"><b>View project</b></a>
                </div>
                <div class="swiper project_swiper">
                    <div class="swiper-wrapper">
                        <?php for($i = 1; $i <= 3; $i++):
                            $img = $project["image_path_$i"] ?? '';
                            if($img): ?>
                                <div class="swiper-slide">
                                    <img src="style/images/project/<?= htmlspecialchars($img) ?>" alt="Projektbild <?= $i ?>">
                                </div>
                        <?php endif; endfor; ?>
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
            <br>
            <?php endwhile; ?>
        </div>
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
<script src = "https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script src = "script/rgb.js"></script>
<script src = "script/swiper_init.js"></script>
<script src = "script/toggle_menu.js"></script>
<script src = "script/footer.js"></script>
<script src = "script/progress_bar.js"></script>
</html>