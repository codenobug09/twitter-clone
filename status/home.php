<?php
require_once "../core/init.php";

$user_id = $_SESSION['user_id'] ?? null;
$tweet_id = $_GET['id'] ?? null;

if (!$tweet_id || !is_numeric($tweet_id)) {
    header("Location: ../index.php");
    exit;
}

if (Tweet::isTweet($tweet_id)) {
    $tweet = Tweet::getTweet($tweet_id);
} else if (Tweet::isRetweet($tweet_id)) {
    $tweet = Tweet::getRetweet($tweet_id);
} else {
    header("Location: ../index.php");
    exit;
}

$user = User::getData($tweet->user_id);

$likes = Tweet::countLikes($tweet_id);
$retweets = Tweet::countRetweets($tweet_id);
$comments = Tweet::countComments($tweet_id);

$user_like = Tweet::userLikeIt($user_id, $tweet_id);
$user_retweet = Tweet::userRetweeetedIt($user_id, $tweet_id);

$timeAgo = Tweet::getTimeAgo($tweet->post_on);
$comment_list = Tweet::getComments($tweet_id);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Tweet</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

    <div class="box-tweet">

        <!-- Tweet -->
        <div class="grid-tweet">
            <img src="../assets/images/users/<?php echo $user->img; ?>" class="img-user-tweet">

            <div>
                <p>
                    <strong><?php echo $user->name; ?></strong>
                    <span>@<?php echo $user->username; ?></span>
                    <span><?php echo $timeAgo; ?></span>
                </p>
                <?php
                if (isset($tweet->status)) {
                    ?>
                    <p><?php echo $tweet->status; ?></p>
                    <?php
                } ?>
                <?php if (isset($tweet->img)) { ?>
                    <img src="../assets/images/tweets/<?php echo $tweet->img; ?>" class="img-post-tweet">
                <?php } ?>
            </div>
        </div>

        <!-- Reaction -->
        <div class="grid-reactions">
            ❤️ <?php echo $likes; ?>
            🔁 <?php echo $retweets; ?>
            💬 <?php echo $comments; ?>
        </div>

    </div>

    <!-- COMMENT FORM -->
    <div class="comment-box">
        <form method="post" action="../comment/create.php">
            <input type="hidden" name="tweet_id" value="<?php echo $tweet_id; ?>">
            <textarea name="comment" placeholder="Write your reply"></textarea>
            <button type="submit">Reply</button>
        </form>
    </div>

    <!-- COMMENT LIST -->
    <div class="comments">
        <?php foreach ($comment_list as $c):
            $cu = User::getData($c->user_id);
            ?>
            <div class="comment">
                <strong><?php echo $cu->name; ?></strong>
                <span>@<?php echo $cu->username; ?></span>
                <p><?php echo Tweet::getTweetLinks($c->comment); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
    <style>
        /* RESET */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }

        body {
            background: #f5f8fa;
            color: #0f1419;
        }

        /* ===== TWEET BOX ===== */
        .box-tweet {
            max-width: 600px;
            margin: 30px auto;
            background: #fff;
            border-radius: 16px;
            padding: 16px;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.05);
        }

        /* ===== GRID TWEET ===== */
        .grid-tweet {
            display: grid;
            grid-template-columns: 48px 1fr;
            gap: 12px;
        }

        .img-user-tweet {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
        }

        /* ===== USER INFO ===== */
        .grid-tweet p {
            margin-bottom: 6px;
        }

        .grid-tweet strong {
            font-size: 15px;
        }

        .grid-tweet span {
            font-size: 13px;
            color: #536471;
            margin-left: 6px;
        }

        /* ===== TWEET TEXT ===== */
        .grid-tweet p:last-of-type {
            font-size: 15px;
            line-height: 1.5;
            margin-top: 6px;
        }

        /* ===== IMAGE ===== */
        .img-post-tweet {
            width: 100%;
            border-radius: 16px;
            margin-top: 10px;
            border: 1px solid #e6ecf0;
        }

        /* ===== REACTIONS ===== */
        .grid-reactions {
            display: flex;
            justify-content: space-around;
            padding-top: 12px;
            margin-top: 12px;
            border-top: 1px solid #e6ecf0;
            font-size: 14px;
            color: #536471;
        }

        .grid-reactions span {
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .grid-reactions span:hover {
            color: #1d9bf0;
        }

        /* ===== COMMENT BOX ===== */
        .comment-box {
            max-width: 600px;
            margin: 15px auto;
            background: #fff;
            border-radius: 16px;
            padding: 14px;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.05);
        }

        .comment-box textarea {
            width: 100%;
            min-height: 80px;
            resize: none;
            border: none;
            outline: none;
            font-size: 15px;
        }

        .comment-box textarea::placeholder {
            color: #536471;
        }

        .comment-box button {
            float: right;
            margin-top: 10px;
            background: #1d9bf0;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 999px;
            font-weight: bold;
            cursor: pointer;
        }

        .comment-box button:hover {
            background: #1a8cd8;
        }

        /* ===== COMMENTS ===== */
        .comments {
            max-width: 600px;
            margin: 10px auto 40px;
        }

        .comment {
            background: #fff;
            border-radius: 16px;
            padding: 14px;
            margin-bottom: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .comment strong {
            font-size: 14px;
        }

        .comment span {
            font-size: 13px;
            color: #536471;
            margin-left: 6px;
        }

        .comment p {
            margin-top: 6px;
            font-size: 14px;
            line-height: 1.5;
        }

        /* ===== LINKS ===== */
        a {
            text-decoration: none;
            color: #1d9bf0;
        }

        a:hover {
            text-decoration: underline;
        }

        /* ===== MOBILE ===== */
        @media (max-width: 600px) {

            .box-tweet,
            .comment-box,
            .comments {
                margin: 10px;
                border-radius: 12px;
            }
        }
    </style>
</body>

</html>