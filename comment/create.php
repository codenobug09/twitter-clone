<?php
require_once "../core/init.php";

$user_id = $_SESSION['user_id'];
$tweet_id = $_POST['tweet_id'];
$comment = trim($_POST['comment']);

if ($comment && $tweet_id) {
    Tweet::addComment($user_id, $tweet_id, $comment);
}

header("Location: ../status/$tweet_id");
