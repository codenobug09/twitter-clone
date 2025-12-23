<?php
include 'core/init.php';

if (isset($_SESSION['user_id'])) {
  header('Location: home.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Twitter Clone</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Bootstrap & Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" href="index.css">

  <style>
    body {
      margin: 0;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
      background: #f5f8fa;
      color: #0f1419;
    }

    /* HEADER */
    header {
      background: #ffffff;
      border-bottom: 1px solid #e6ecf0;
      padding: 14px 32px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .logo {
      font-size: 26px;
      font-weight: 800;
      color: #1d9bf0;
    }

    .header-actions button {
      margin-left: 10px;
      border-radius: 30px;
      padding: 6px 18px;
      font-weight: 600;
    }

    /* HERO */
    .hero {
      min-height: 80vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, #1d9bf0, #0a66c2);
      color: white;
      text-align: center;
      padding: 40px 20px;
    }

    .hero h1 {
      font-size: 42px;
      font-weight: 800;
      margin-bottom: 16px;
    }

    .hero p {
      font-size: 18px;
      margin-bottom: 30px;
      opacity: 0.9;
    }

    .hero .btn {
      border-radius: 30px;
      padding: 10px 26px;
      font-weight: 700;
    }

    /* FEATURES */
    .features {
      background: #ffffff;
      padding: 60px 20px;
    }

    .feature-item {
      text-align: center;
      padding: 20px;
    }

    .feature-item i {
      font-size: 36px;
      color: #1d9bf0;
      margin-bottom: 14px;
    }

    /* FOOTER */
    footer {
      background: #ffffff;
      border-top: 1px solid #e6ecf0;
      padding: 30px 20px;
      text-align: center;
      font-size: 14px;
      color: #536471;
    }

    footer a {
      margin: 0 10px;
      color: #536471;
      text-decoration: none;
    }

    footer a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<button class="dark-toggle">
    <i class="fa-solid fa-moon"></i>
</button>
<script src="./index.js"></script>
<body>

<!-- ================= HEADER ================= -->
<header>
  <div class="logo">
    <i class="fa-brands fa-twitter"></i> Twitter
  </div>
  <div class="header-actions">
    <button class="btn btn-outline-primary" data-toggle="modal" data-target="#loginModal">
      Log in
    </button>
    <button class="btn btn-primary" data-toggle="modal" data-target="#signupModal">
      Sign up
    </button>
  </div>
</header>

<!-- ================= HERO ================= -->
<section class="hero">
  <div>
    <h1>See what’s happening</h1>
    <p>Join the conversation and stay connected with the world.</p>

    <button class="btn btn-light btn-lg mr-2" data-toggle="modal" data-target="#signupModal">
      Create account
    </button>

    <button class="btn btn-outline-light btn-lg" data-toggle="modal" data-target="#loginModal">
      Sign in
    </button>
  </div>
</section>

<!-- ================= FEATURES ================= -->
<section class="features">
  <div class="container">
    <div class="row">
      <div class="col-md-4 feature-item">
        <i class="fa-solid fa-hashtag"></i>
        <h5>Follow topics</h5>
        <p>Discover what people care about.</p>
      </div>
      <div class="col-md-4 feature-item">
        <i class="fa-solid fa-comment"></i>
        <h5>Join conversations</h5>
        <p>Share your thoughts in real time.</p>
      </div>
      <div class="col-md-4 feature-item">
        <i class="fa-solid fa-heart"></i>
        <h5>Connect with people</h5>
        <p>Build your community.</p>
      </div>
    </div>
  </div>
</section>

<!-- ================= FOOTER ================= -->
<?php include 'partials/footer.php'; ?>

<!-- ================= LOGIN MODAL ================= -->
<div class="modal fade" id="loginModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold">Log in</h5>
        <button type="button" class="close" data-dismiss="modal">
          <span>&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php include 'includes/login.php'; ?>
      </div>
    </div>
  </div>
</div>

<!-- ================= SIGNUP MODAL ================= -->
<div class="modal fade" id="signupModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold">Create your account</h5>
        <button type="button" class="close" data-dismiss="modal">
          <span>&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php include 'includes/signup-form.php'; ?>
      </div>
    </div>
  </div>
</div>

<!-- ================= JS ================= -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
