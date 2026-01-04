<?php
require_once "../core/init.php";

$username = $_GET['username'];
$user = User::getUserByUsername($username);
$tweets = Tweet::getTweetsByUser($user->id);
?>

<h2><?php echo $user->name; ?></h2>
<p>@<?php echo $user->username; ?></p>

<?php foreach ($tweets as $tweet): ?>
    <a href="./status/home.php?id=<?php echo $tweet_link; ?>">
        <?php echo Tweet::getTweetLinks($tweet->status); ?>
    </a>
<?php endforeach; ?>