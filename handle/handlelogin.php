<?php
include '../core/init.php';
require_once '../core/classes/validation/Validator.php';

use validation\Validator;

if (!isset($_POST['login'])) {
    header('Location: ../home.php');
    exit;
}

$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

/* ===== VALIDATION ===== */
$v = new Validator();
$v->rules('email', $email, ['required', 'email']);
$v->rules('password', $password, ['required', 'string']);

if (!empty($v->errors)) {
    $_SESSION['errors'] = $v->errors;
    header("Location: /index.php");
    exit;
}

/* ===== CHECK USER ===== */
$user = User::findByEmail($email);

if (!$user) {
    $_SESSION['errors'] = ['Email hoặc mật khẩu không đúng'];
    header("Location: /index.php");
    exit;
}

/* ===== VERIFY PASSWORD HASH ===== */
if ($password !== $user['password']) {
    $_SESSION['errors'] = ['Email hoặc mật khẩu không đúng'];
    header("Location: /index.php");
    exit;
}


/* ===== LOGIN SUCCESS ===== */
$_SESSION['user_id'] = $user['id'];
$_SESSION['user_email'] = $user['email'];
header("Location: /home.php");
exit;
