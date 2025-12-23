<?php
session_start();
require "../../twitter-clone-v3/core/database/connection.php";

if (!isset($_SESSION['otp'], $_SESSION['signup_data'])) {

?>

    <script>
        window.history.back();
    </script>
<?php
    exit;
}

// HẾT HẠN
if (time() > $_SESSION['otp_expire']) {
    $_SESSION['otp_error'] = "OTP đã hết hạn";
    header("Location: ../verify_otp.php");
    exit;
}

// SAI OTP
if ($_POST['otp'] != $_SESSION['otp']) {
    $_SESSION['otp_error'] = "OTP không đúng";
    header("Location: ../verify_otp.php");
    exit;
}

// OTP ĐÚNG → INSERT USER
$data = $_SESSION['signup_data'];

$stmt = $pdo->prepare("
    INSERT INTO users (name, username, email, password)
    VALUES (?, ?, ?, ?)
");
$stmt->execute([
    $data['name'],
    $data['username'],
    $data['email'],
    $data['password']
]);

// CLEAR SESSION
unset($_SESSION['otp'], $_SESSION['otp_expire'], $_SESSION['signup_data']);

?>


<script>
    alert("Đăng ký thành công! Vui lòng đăng nhập.");
    window.location.href = "../home.php";
</script>
