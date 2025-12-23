<?php
session_start();

require "../core/database/connection.php";
require "../config/mail.php";
require "../vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;

if (!isset($_POST['signup'])) {
    header("../home.php");
    exit;
}

$name     = trim($_POST['name']);
$username = trim($_POST['username']);
$email    = trim($_POST['email']);
$password = $_POST['password'];
$confirm  = $_POST['confirm_password'];

$errors = [];

// VALIDATE SERVER
if (strlen($name) < 2) $errors[] = "Name quá ngắn";
if (strlen($username) < 3) $errors[] = "Username quá ngắn";
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Email không hợp lệ";
if (strlen($password) < 6) $errors[] = "Password phải >= 6 ký tự";
if ($password !== $confirm) $errors[] = "Password không khớp";

// CHECK TRÙNG
$stmt = $pdo->prepare("SELECT id FROM users WHERE email=? OR username=?");
$stmt->execute([$email, $username]);
if ($stmt->fetch()) {
    $errors[] = "Email hoặc username đã tồn tại";
}

if ($errors) {
    $_SESSION['errors_signup'] = $errors;

?>
    <script>
        window.history.back();
    </script>
<?php
    exit;
}

// ========== SINH OTP ==========
$otp = rand(100000, 999999);

// LƯU SESSION
$_SESSION['otp'] = $otp;
$_SESSION['otp_expire'] = time() + 300; // 5 phút
$_SESSION['signup_data'] = [
    "name" => $name,
    "username" => $username,
    "email" => $email,
    "password" => $password
];

// ========== GỬI MAIL ==========
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = MAIL_HOST;
    $mail->SMTPAuth = true;
    $mail->Username = MAIL_USER;
    $mail->Password = MAIL_PASS;
    $mail->SMTPSecure = "tls";
    $mail->Port = MAIL_PORT;

    $mail->setFrom(MAIL_USER, "OTP Verification");
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = "Your OTP Code";
    $mail->Body = "
        <h2>Mã OTP của bạn</h2>
        <h1>$otp</h1>
        <p>Hết hạn sau 5 phút</p>
    ";

    $mail->send();
    header("Location: ../verify_otp.php");
    exit;
} catch (Exception $e) {
    $_SESSION['errors_signup'] = ["Không gửi được email OTP"];
    header("Location: ../home.php");
    exit;
}
