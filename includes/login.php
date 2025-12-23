<?php
// session_start(); // đảm bảo session đã start ở file cha
?>

<form action="./handle/handlelogin.php" method="POST" id="loginForm" class="login-box" novalidate>

  <h3 class="form-title">Welcome Back</h3>

  <!-- PHP ERROR -->
  <?php if (isset($_SESSION['errors'])) { ?>
    <?php foreach ($_SESSION['errors'] as $error) { ?>
      <div class="error-box"><?= $error ?></div>
    <?php }
    unset($_SESSION['errors']); ?>
  <?php } ?>

  <!-- EMAIL -->
  <input class="input-box" type="email" name="email" placeholder="Email address">
  <small class="error-text"></small>

  <!-- PASSWORD -->
  <input class="input-box" type="password" name="password" placeholder="Password">
  <small class="error-text"></small>

  <a class="login-link" href="#">Forgot password?</a>

  <input type="submit" name="login" class="login-btn" value="Log in">
  <style>
    .login-box {
      width: 360px;
      padding: 30px;
      background: #ffffff;
      border-radius: 18px;
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
      margin: 80px auto;
    }

    .form-title {
      text-align: center;
      font-size: 22px;
      font-weight: 700;
      margin-bottom: 25px;
    }

    .input-box {
      width: 100%;
      padding: 13px 18px;
      border-radius: 999px;
      border: 1px solid #ddd;
      font-size: 14px;
      margin-bottom: 6px;
      outline: none;
    }

    .input-box:focus {
      border-color: #0d6efd;
    }

    .login-btn {
      width: 100%;
      padding: 13px;
      border-radius: 999px;
      background: #0d6efd;
      color: #fff;
      border: none;
      font-weight: 700;
      font-size: 15px;
      margin-top: 14px;
      cursor: pointer;
    }

    .login-btn:hover {
      background: #0b5ed7;
    }

    .login-link {
      display: block;
      text-align: right;
      font-size: 13px;
      color: #0d6efd;
      text-decoration: none;
      margin-top: 6px;
    }

    .login-link:hover {
      text-decoration: underline;
    }

    .error-text {
      color: #e0245e;
      font-size: 12px;
      margin-left: 14px;
      height: 14px;
      display: block;
    }

    .error-box {
      background: #ffe6ea;
      color: #b00020;
      padding: 10px;
      border-radius: 10px;
      font-size: 13px;
      margin-bottom: 14px;
      text-align: center;
    }
  </style>
  <script>
    const form = document.getElementById("loginForm");
    const email = form.email;
    const password = form.password;

    function showError(input, message) {
      input.nextElementSibling.innerText = message;
    }

    function clearError(input) {
      input.nextElementSibling.innerText = "";
    }

    function validateEmail(value) {
      return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
    }

    form.addEventListener("submit", function(e) {
      let valid = true;

      // EMAIL
      if (!validateEmail(email.value)) {
        showError(email, "Please enter a valid email");
        valid = false;
      } else clearError(email);

      // PASSWORD
      if (password.value.length < 6) {
        showError(password, "Password must be at least 6 characters");
        valid = false;
      } else clearError(password);

      if (!valid) e.preventDefault();
    });

    // realtime clear error
    [email, password].forEach(input => {
      input.addEventListener("input", () => {
        clearError(input);
      });
    });
  </script>

</form>