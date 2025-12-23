<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>About · Twitter Clone</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="./index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

    <div class="page-container about-page">

        <!-- HERO -->
        <section class="about-hero reveal">
            <i class="fa-brands fa-twitter"></i>
        </section>

        <!-- CTA -->
        <section class="about-cta reveal">
            <h2>Explore the Platform</h2>
            <p>
                Ready to see how everything works together?
                Start exploring features or reach out if you have questions.
            </p>

            <div class="about-actions">
                <a href="help.php">Help Center</a>
                <a href="signup.php" class="outline">Create Account</a>
            </div>
        </section>

    </div>
    <style>
        /* ===== ABOUT PAGE ===== */
        .about-page {
            max-width: 880px;
            margin: 80px auto;
            padding: 25px 20px;
        }

        /* HERO */
        .about-hero {
            text-align: center;
        }

        .about-hero i {
            font-size: 60px;
            color: #1d9bf0;
        }

        .about-hero h1 {
            font-size: 48px;
            font-weight: 800;
            margin-top: 20px;
        }

        .about-hero p {
            max-width: 640px;
            margin: 18px auto;
            font-size: 17px;
            color: #536471;
        }

        /* BLOCKS */
        .about-block {
            margin-bottom: 70px;
        }

        .about-block h2 {
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 16px;
        }

        .about-block p,
        .about-block li {
            font-size: 16px;
            line-height: 1.9;
            color: #444;
        }

        .about-block ul {
            padding-left: 22px;
        }

        /* Divider */
        .about-block:not(:last-child)::after {
            content: "";
            display: block;
            height: 1px;
            width: 100%;
            margin-top: 60px;
            background: linear-gradient(to right, transparent, #e6ecf0, transparent);
        }

        /* TECH LIST */
        .tech-list li {
            margin-bottom: 8px;
        }

        /* CTA */
        .about-cta {
            padding: 30px 0;
            text-align: center;
        }

        .about-cta h2 {
            font-size: 34px;
            font-weight: 800;
        }

        .about-cta p {
            color: #536471;
            max-width: 600px;
            margin: 14px auto 30px;
        }

        .about-actions {
            display: flex;
            justify-content: center;
            gap: 16px;
            flex-wrap: wrap;
        }

        .about-actions a {
            padding: 12px 28px;
            border-radius: 999px;
            background: #1d9bf0;
            color: #fff;
            font-weight: 700;
            text-decoration: none;
        }

        .about-actions a.outline {
            background: transparent;
            color: #1d9bf0;
            border: 2px solid #1d9bf0;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .about-hero h1 {
                font-size: 38px;
            }

            .about-cta h2 {
                font-size: 28px;
            }
        }
    </style>

    <?php include 'partials/footer.php'; ?>

    <script src="./index.js"></script>
</body>

</html>