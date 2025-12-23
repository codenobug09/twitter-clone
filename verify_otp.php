<?php session_start(); ?>

<div class="login-box">
    <h3>Xác thực OTP</h3>

    <?php if (isset($_SESSION['otp_error'])) { ?>
        <div class="error-box"><?= $_SESSION['otp_error'] ?></div>
    <?php unset($_SESSION['otp_error']);
    } ?>

    <form action="./handle/handleVerifyOtp.php" method="POST">
        <input
            class="input-box"
            type="text"
            name="otp"
            placeholder="Nhập mã OTP"
            maxlength="6"
            inputmode="numeric"
            pattern="[0-9]*"
            autofocus>
        <button class="login-btn" type="submit">Xác nhận</button>
    </form>

    <div class="resend-box">
        <span id="countdown">Gửi lại sau <b>60</b>s</span>
        <form action="./handle/handleResendOtp.php" method="POST">
            <button id="resendBtn" class="resend-btn" disabled>Gửi lại OTP</button>
        </form>
    </div>
</div>
<style>
    * {
        box-sizing: border-box;
        font-family: 'Segoe UI', sans-serif;
    }

    body {
        margin: 0;
        height: 100vh;
        background: linear-gradient(135deg, #667eea, #764ba2);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-box {
        width: 360px;
        background: #fff;
        padding: 32px 28px;
        border-radius: 14px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        text-align: center;
    }

    .login-box h3 {
        margin-bottom: 20px;
        color: #333;
    }

    .input-box {
        width: 100%;
        padding: 12px;
        font-size: 18px;
        border-radius: 8px;
        border: 1px solid #ddd;
        text-align: center;
        letter-spacing: 6px;
        outline: none;
    }

    .input-box:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, .2);
    }

    .login-btn {
        width: 100%;
        margin-top: 18px;
        padding: 12px;
        border-radius: 8px;
        border: none;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: #fff;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
    }

    .login-btn:hover {
        opacity: 0.9;
    }

    .resend-box {
        margin-top: 18px;
        font-size: 14px;
        color: #555;
    }

    .resend-btn {
        margin-top: 6px;
        background: none;
        border: none;
        color: #667eea;
        font-weight: 600;
        cursor: pointer;
    }

    .resend-btn:disabled {
        color: #aaa;
        cursor: not-allowed;
    }

    .error-box {
        background: #ffe5e5;
        color: #d8000c;
        padding: 10px;
        border-radius: 8px;
        margin-bottom: 14px;
    }
</style>
<script>
    let timeLeft = 60;
    const countdownEl = document.getElementById("countdown");
    const resendBtn = document.getElementById("resendBtn");

    const timer = setInterval(() => {
        timeLeft--;
        countdownEl.innerHTML = `Gửi lại sau <b>${timeLeft}</b>s`;

        if (timeLeft <= 0) {
            clearInterval(timer);
            countdownEl.innerHTML = "Bạn có thể gửi lại OTP";
            resendBtn.disabled = false;
        }
    }, 1000);
</script>
