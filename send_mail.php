<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// PHPMailer files php-mailer/src ke andar hain
require __DIR__ . '/php-mailer/src/Exception.php';
require __DIR__ . '/php-mailer/src/PHPMailer.php';
require __DIR__ . '/php-mailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? 'Portfolio Contact Form');
    $message = trim($_POST['message'] ?? '');

    if ($name === '' || $email === '' || $message === '') {
        echo "Please fill all required fields.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address.";
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        // SMTP (Gmail) settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;

        // 👇 1) Yaha apna GMAIL (jisse app password banaya)
        $mail->Username   = 'vriza2004@gmail.com';

        // 👇 2) Yaha APP PASSWORD (16 characters, bina space)
        $mail->Password   = 'trweqasklzblfjti';

        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // From (user ka email) & To (tumhara gmail)
        $mail->setFrom('vrindaoza2412@gmail.com', 'Portfolio Contact Form');
        // Reply-To: user ka email (taan ke tum reply kar sako)
		$mail->addReplyTo($email, $name);
        // 👇 3) Jis email pe tum mail receive karna chahti ho
        $mail->addAddress('vriza2004@gmail.com');

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'New message from portfolio: ' . $subject;

        $mail->Body = "
            <h3>New Message from Portfolio</h3>
            <p><b>Name:</b> {$name}</p>
            <p><b>Email:</b> {$email}</p>
            <p><b>Subject:</b> {$subject}</p>
            <p><b>Message:</b><br>" . nl2br(htmlspecialchars($message)) . "</p>
        ";

        $mail->send();

        echo "
        <script>
            alert('Thank you! Your message has been sent successfully.');
            window.location.href = 'index.html';
        </script>
        ";

    } catch (Exception $e) {
        echo "
    <script>
        alert('Sorry, your message could not be sent. Please try again later.');
        window.location.href = 'index.html';
    </script>
    ";
    }
} else {
    echo "Invalid request method.";
}
?>
