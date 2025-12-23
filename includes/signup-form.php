<?php

?>
<script src="assets/js/jquery-3.4.1.slim.min.js"></script>

<form action="./handle/handleSignUp.php" method="post" id="signupForm" novalidate>

    <?php if (isset($_SESSION['errors_signup'])) { ?>
        <script>
            $(document).ready(function() {
                $("#exampleModalCenter").modal('show');
            });
        </script>

        <?php foreach ($_SESSION['errors_signup'] as $error) { ?>
            <div class="alert alert-danger text-center" style="font-size:14px;">
                <?= $error ?>
            </div>
    <?php }
        unset($_SESSION['errors_signup']);
    } ?>

    <!-- NAME -->
    <div class="form-group">
        <input type="text" name="name" class="form-control input-style" placeholder="Full name">
        <small class="error-text"></small>
    </div>

    <!-- USERNAME -->
    <div class="form-group">
        <input type="text" name="username" class="form-control input-style" placeholder="Username">
        <small class="error-text"></small>
    </div>

    <!-- EMAIL -->
    <div class="form-group">
        <input type="email" name="email" class="form-control input-style" placeholder="Email address">
        <small class="error-text"></small>
    </div>

    <!-- PASSWORD -->
    <div class="form-group">
        <input type="password" name="password" class="form-control input-style" placeholder="Password">
        <small class="error-text"></small>
    </div>

    <!-- CONFIRM PASSWORD -->
    <div class="form-group">
        <input type="password" name="confirm_password" class="form-control input-style" placeholder="Confirm password">
        <small class="error-text"></small>
    </div>

    <button type="submit" name="signup" class="btn btn-primary btn-block signup-btn">
        Create account
    </button>

</form>
<style>
    .input-style {
        border-radius: 999px;
        padding: 12px 18px;
        font-size: 15px;
    }

    .signup-btn {
        border-radius: 999px;
        font-weight: 700;
        padding: 12px;
        margin-top: 10px;
    }

    .error-text {
        color: #e0245e;
        font-size: 13px;
        margin-left: 10px;
        display: block;
        height: 14px;
    }
</style>
<script>
    const form = document.getElementById("signupForm");
    const inputs = form.querySelectorAll("input");

    function showError(input, message) {
        input.nextElementSibling.innerText = message;
    }

    function clearError(input) {
        input.nextElementSibling.innerText = "";
    }

    function validateEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    form.addEventListener("submit", function(e) {
        let valid = true;

        const name = form.name;
        const username = form.username;
        const email = form.email;
        const password = form.password;
        const confirm = form.confirm_password;

        // NAME
        if (name.value.trim().length < 2) {
            showError(name, "Name must be at least 2 characters");
            valid = false;
        } else clearError(name);

        // USERNAME
        if (username.value.trim().length < 3) {
            showError(username, "Username must be at least 3 characters");
            valid = false;
        } else clearError(username);

        // EMAIL
        if (!validateEmail(email.value)) {
            showError(email, "Invalid email address");
            valid = false;
        } else clearError(email);

        // PASSWORD
        if (password.value.length < 6) {
            showError(password, "Password must be at least 6 characters");
            valid = false;
        } else clearError(password);

        // CONFIRM PASSWORD
        if (confirm.value !== password.value) {
            showError(confirm, "Passwords do not match");
            valid = false;
        } else clearError(confirm);

        if (!valid) e.preventDefault();
    });

    // realtime validate
    inputs.forEach(input => {
        input.addEventListener("input", () => {
            input.nextElementSibling.innerText = "";
        });
    });
</script>