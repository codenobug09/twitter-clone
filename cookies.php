<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Cookies Policy</title>
    <link rel="stylesheet" href="./index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<button class="dark-toggle">
    <i class="fa-solid fa-moon"></i>
</button>

<body>

    <div class="page-container cookies-page">

        <!-- HERO -->
        <section class="cookies-hero reveal">
            <i class="fa-solid fa-cookie-bite"></i>
            <h1>Cookies Policy</h1>
            <p>
                We use cookies to improve performance, personalize content,
                analyze traffic, and enhance your experience on Twitter Clone.
            </p>
        </section>

        <!-- CONTENT -->
        <section class="cookies-section reveal">
            <h2>🍪 What Are Cookies?</h2>
            <p>
                Cookies are small text files stored on your device when you visit a website.
                They help websites remember your actions and preferences over time.
            </p>
            <p>
                Cookies can store information such as login status, language preferences,
                theme selection, and usage behavior.
            </p>
        </section>

        <section class="cookies-section reveal">
            <h2>⚙️ How We Use Cookies</h2>
            <ul>
                <li>Maintain user sessions and authentication</li>
                <li>Remember theme and UI preferences</li>
                <li>Analyze traffic and user interactions</li>
                <li>Improve performance and load speed</li>
                <li>Detect and prevent fraudulent activity</li>
            </ul>
        </section>

        <section class="cookies-section reveal">
            <h2>📊 Types of Cookies We Use</h2>

            <h4>Essential Cookies</h4>
            <p>Required for login, security, and core functionality.</p>

            <h4>Performance Cookies</h4>
            <p>Help us understand usage patterns and improve the platform.</p>

            <h4>Functional Cookies</h4>
            <p>Remember preferences such as theme, language, and layout.</p>
        </section>

        <section class="cookies-section reveal">
            <h2>🔒 Data Protection & Privacy</h2>
            <p>
                Cookies do not store sensitive personal information such as passwords
                or payment details. All data is anonymized and secured.
            </p>
        </section>

        <section class="cookies-section reveal">
            <h2>🛠 Managing Cookies</h2>
            <p>
                You can control or delete cookies through your browser settings.
                Disabling cookies may affect certain features.
            </p>
        </section>

        <!-- CTA -->
        <section class="cookies-cta reveal">
            <h2>Need more help?</h2>
            <p>
                Have questions about cookies or privacy? Visit our Help Center.
            </p>
            <a href="help.php">Go to Help Center</a>
        </section>

    </div>
    <style>
        /* ===== PAGE BASE ===== */
        .page-container {
            max-width: 900px;
            margin: 80px auto;
            box-shadow: none;
            padding: 0 20px;
            font-family: system-ui, sans-serif;
        }

        /* ===== HERO ===== */
        .cookies-hero {
            text-align: center;
            margin-bottom: 80px;
        }

        .cookies-hero i {
            font-size: 64px;
            color: #1d9bf0;
        }

        .cookies-hero h1 {
            margin-top: 20px;
            font-size: 46px;
            font-weight: 800;
        }

        .cookies-hero p {
            max-width: 650px;
            margin: 16px auto;
            color: #536471;
        }

        /* ===== SECTIONS ===== */
        .cookies-section {
            background: #fff;
            padding: 36px;
            border-radius: 20px;
            margin-bottom: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .06);
        }

        .cookies-section h2 {
            font-weight: 800;
            margin-bottom: 16px;
        }

        .cookies-section h4 {
            margin-top: 24px;
            font-weight: 700;
        }

        .cookies-section p,
        .cookies-section li {
            color: #444;
            line-height: 1.8;
        }

        .cookies-section ul {
            padding-left: 20px;
        }

        /* ===== CTA ===== */
        .cookies-cta {
            background: linear-gradient(135deg, #1d9bf0, #0f6cd8);
            color: #fff;
            padding: 50px;
            border-radius: 24px;
            text-align: center;
        }

        .cookies-cta a {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 28px;
            background: #fff;
            color: #1d9bf0;
            border-radius: 999px;
            font-weight: 700;
            text-decoration: none;
        }

        /* ===== REVEAL ANIMATION ===== */
        .reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: .6s ease;
        }

        .reveal.show {
            opacity: 1;
            transform: none;
        }
    </style>

    <?php include 'partials/footer.php'; ?>
    <script src="./index.js"></script>
</body>

</html>