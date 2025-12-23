<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Help Center</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap + Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="./index.css">

    <style>
        body {
            background: #f5f8fa;
            font-family: system-ui, sans-serif;
        }

        .page-container {
            max-width: 900px;
            margin: 80px auto;
            padding: 0 20px;
        }

        /* ===== FLOAT MESSAGE BUTTON ===== */
        .chat-toggle {
            position: fixed;
            bottom: 30px;
            left: 30px;
            background: #1d9bf0;
            color: #fff;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            border: none;
            font-size: 22px;
            cursor: pointer;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .25);
            z-index: 999;
        }

        /* ===== CHATBOT PANEL ===== */
        .chatbot {
            position: fixed;
            bottom: 0;
            left: -380px;
            width: 360px;
            height: 520px;
            background: #fff;
            border-radius: 16px 16px 0 0;
            box-shadow: 0 10px 40px rgba(0, 0, 0, .3);
            display: flex;
            flex-direction: column;
            transition: 0.35s ease;
            z-index: 998;
        }

        .chatbot.open {
            left: 20px;
        }

        .chat-header {
            background: #1d9bf0;
            color: white;
            padding: 14px;
            font-weight: 700;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .chat-messages {
            flex: 1;
            padding: 15px;
            overflow-y: auto;
            background: #f5f8fa;
        }

        .msg {
            margin-bottom: 10px;
            max-width: 80%;
            padding: 10px 14px;
            border-radius: 14px;
            font-size: 14px;
        }

        .user {
            background: #1d9bf0;
            color: white;
            margin-left: auto;
            border-bottom-right-radius: 4px;
        }

        .bot {
            background: white;
            border: 1px solid #ddd;
            border-bottom-left-radius: 4px;
        }

        .chat-input {
            display: flex;
            padding: 10px;
            border-top: 1px solid #ddd;
        }

        .chat-input input {
            flex: 1;
            border: none;
            outline: none;
            padding: 8px;
        }

        .chat-input button {
            background: #1d9bf0;
            border: none;
            color: white;
            padding: 0 16px;
            border-radius: 10px;
            font-weight: 600;
        }

        .help-hero {
            text-align: center;
            margin-bottom: 60px;
        }

        .help-hero h1 {
            font-size: 48px;
            font-weight: 800;
        }

        .help-hero .lead {
            max-width: 600px;
            margin: 16px auto 30px;
            color: #536471;
        }

        .help-search {
            display: flex;
            max-width: 420px;
            margin: auto;
            background: white;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, .1);
        }

        .help-search input {
            border: none;
            flex: 1;
            padding: 12px 18px;
            outline: none;
        }

        .help-search button {
            border: none;
            background: #1d9bf0;
            color: white;
            padding: 0 20px;
        }

        .help-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 60px;
        }

        .action-card {
            background: white;
            padding: 24px;
            border-radius: 16px;
            text-align: center;
            box-shadow: 0 6px 20px rgba(0, 0, 0, .08);
        }

        .action-card i {
            font-size: 32px;
            color: #1d9bf0;
            margin-bottom: 12px;
        }

        .help-section h2 {
            font-weight: 800;
            margin-bottom: 20px;
        }

        .topic-list {
            display: grid;
            gap: 16px;
        }

        .topic-item {
            background: white;
            padding: 20px;
            border-radius: 14px;
            box-shadow: 0 4px 14px rgba(0, 0, 0, .06);
        }

        .help-ai {
            margin: 70px 0;
            text-align: center;
        }

        .ai-box {
            background: linear-gradient(135deg, #1d9bf0, #0a66c2);
            color: white;
            padding: 40px;
            border-radius: 20px;
        }

        .help-contact {
            text-align: center;
            margin-bottom: 40px;
        }

        .contact-options {
            display: flex;
            justify-content: center;
            gap: 40px;
            margin-top: 20px;
        }

        .contact-options i {
            color: #1d9bf0;
            margin-right: 8px;
        }

        .help-page {
            max-width: 1100px;
            margin: 80px auto;
            padding: 0 20px;
            font-family: system-ui;
        }

        /* HERO */
        .help-hero {
            text-align: center;
            margin-bottom: 60px;
        }

        .help-hero h1 {
            font-size: 48px;
            font-weight: 800;
        }

        .help-hero p {
            max-width: 600px;
            margin: 12px auto 30px;
            color: #555;
        }

        /* SEARCH */
        .help-search {
            max-width: 420px;
            margin: auto;
            display: flex;
            background: #fff;
            border-radius: 999px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, .08);
            overflow: hidden;
        }

        .help-search input {
            flex: 1;
            border: none;
            padding: 14px 18px;
        }

        .help-search button {
            border: none;
            background: #1d9bf0;
            color: #fff;
            padding: 0 22px;
        }

        /* FEATURES */
        .help-features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 24px;
            margin-bottom: 80px;
        }

        .feature-card {
            background: #fff;
            padding: 26px;
            border-radius: 18px;
            transition: .3s;
        }

        .feature-card:hover {
            transform: translateY(-8px);
        }

        .feature-card i {
            font-size: 26px;
            color: #1d9bf0;
        }

        /* TOPICS */
        .help-topics h2 {
            text-align: center;
            margin-bottom: 40px;
        }

        .topics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 20px;
        }

        .topic-box {
            background: #fff;
            padding: 22px;
            border-radius: 16px;
        }

        /* AI */
        .help-ai {
            margin: 90px 0;
        }

        .ai-card {
            background: linear-gradient(135deg, #1d9bf0, #0f6cd8);
            color: #fff;
            border-radius: 24px;
            padding: 50px;
            text-align: center;
        }

        .ai-card button {
            margin-top: 20px;
            padding: 12px 28px;
            border-radius: 999px;
            border: none;
            font-weight: 600;
        }

        /* CONTACT */
        .help-contact {
            text-align: center;
        }
    </style>
</head>
<button class="dark-toggle">
    <i class="fa-solid fa-moon"></i>
</button>
<script src="./index.js"></script>

<body>

    <div class="help-page">

        <!-- HERO -->
        <section class="help-hero">
            <h1>How can we help you?</h1>
            <p>
                Find answers, explore features, or chat instantly with our AI-powered assistant.
            </p>

            <div class="help-search">
                <input type="text" placeholder="Search topics, features, or issues..." />
                <button>
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
        </section>

        <!-- FEATURES -->
        <section class="help-features">
            <div class="feature-card">
                <i class="fa-solid fa-user-shield"></i>
                <h5>Account & Login</h5>
                <p>
                    Login problems, password recovery, account security and verification.
                </p>
            </div>

            <div class="feature-card">
                <i class="fa-solid fa-lock"></i>
                <h5>Privacy & Safety</h5>
                <p>
                    Control visibility, block users, report abuse, and manage data.
                </p>
            </div>

            <div class="feature-card">
                <i class="fa-solid fa-comment-dots"></i>
                <h5>Posting & Engagement</h5>
                <p>
                    Create posts, reply, like, repost, and grow your audience.
                </p>
            </div>

            <div class="feature-card">
                <i class="fa-solid fa-gear"></i>
                <h5>Settings</h5>
                <p>
                    Customize notifications, preferences, and account options.
                </p>
            </div>
        </section>

        <!-- POPULAR QUESTIONS -->
        <section class="help-topics">
            <h2>Popular questions</h2>

            <div class="topics-grid">
                <div class="topic-box">
                    <h6>How do I create an account?</h6>
                    <p>
                        Sign up using your email or phone number, choose a username,
                        and start posting within minutes.
                    </p>
                </div>

                <div class="topic-box">
                    <h6>Forgot your password?</h6>
                    <p>
                        Use the password recovery option on the login page to reset it securely.
                    </p>
                </div>

                <div class="topic-box">
                    <h6>How to follow or unfollow users?</h6>
                    <p>
                        Visit any profile and click the Follow or Unfollow button.
                    </p>
                </div>

                <div class="topic-box">
                    <h6>How do I delete my account?</h6>
                    <p>
                        Go to Settings → Account → Deactivate account.
                    </p>
                </div>
            </div>
        </section>

        <!-- AI SUPPORT -->
        <section class="help-ai">
            <div class="ai-card">
                <div class="ai-text">
                    <h3>🤖 AI Support Assistant</h3>
                    <p>
                        Our AI assistant is available 24/7 to answer questions,
                        guide you through features, and resolve common issues instantly.
                    </p>
                    <button onclick="toggleChat()">
                        Start chatting
                    </button>
                </div>
            </div>
        </section>

    </div>


    <!-- ===== MESSAGE BUTTON ===== -->
    <button class="chat-toggle" onclick="toggleChat()">
        <i class="fa-solid fa-message"></i>
    </button>

    <!-- ===== CHATBOT ===== -->
    <div class="chatbot" id="chatbot">
        <div class="chat-header">
            <span>🤖 AI Support</span>
            <i class="fa-solid fa-xmark" style="cursor:pointer" onclick="toggleChat()"></i>
        </div>

        <div class="chat-messages" id="messages">
            <div class="msg bot">Hello 👋 I'm your AI assistant. How can I help you today?</div>
        </div>

        <div class="chat-input">
            <input type="text" id="input" placeholder="Type a message..." />
            <button onclick="sendMessage()">Send</button>
        </div>
    </div>

    <?php include 'partials/footer.php'; ?>

    <script>
        const chatbot = document.getElementById("chatbot");
        const messages = document.getElementById("messages");
        const input = document.getElementById("input");

        function toggleChat() {
            chatbot.classList.toggle("open");
        }

        function sendMessage() {
            if (!input.value.trim()) return;

            addMessage(input.value, "user");
            const userText = input.value;
            input.value = "";

            setTimeout(() => {
                addMessage(botReply(userText), "bot");
            }, 800);
        }

        function addMessage(text, type) {
            const div = document.createElement("div");
            div.className = "msg " + type;
            div.innerText = text;
            messages.appendChild(div);
            messages.scrollTop = messages.scrollHeight;
        }

        function botReply(text) {
            text = text.toLowerCase();

            if (text.includes("login")) return "If you have login issues, try resetting your password or clearing cookies.";
            if (text.includes("signup")) return "You can create an account by clicking Sign Up on the homepage.";
            if (text.includes("privacy")) return "Your privacy is important. Visit the Privacy Policy page for full details.";
            if (text.includes("hello")) return "Hello 👋 How can I assist you?";
            return "Thanks for your message! Our AI is learning and will assist you better soon 😊";
        }
    </script>

</body>

</html>