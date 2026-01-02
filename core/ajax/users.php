<?php
include '../init.php';

$user_id = $_SESSION['user_id'] ?? 0;
$u_id = 0;
$flag = true;
$headline = '';
$users = [];

if (isset($_POST['retweetby']) && !empty($_POST['retweetby'])) {
    $tweet_id = $_POST['retweetby'];
    $users = Tweet::usersRetweeeted($tweet_id);
    $headline = "Retweeted by";

} elseif (isset($_POST['likeby']) && !empty($_POST['likeby'])) {
    $tweet_id = $_POST['likeby'];
    $users = Tweet::usersLiked($tweet_id);
    $headline = "Liked by";

} elseif (isset($_POST['follower']) && !empty($_POST['follower'])) {
    $u_id = $_POST['follower'];
    $users = Follow::usersFollowers($u_id);
    $headline = "Followers";

} elseif (isset($_POST['following']) && !empty($_POST['following'])) {
    $u_id = $_POST['following'];
    $users = Follow::usersFollowing($u_id);
    $headline = "Following";

} else {
    $flag = false;
}

if (!$flag) {
    exit;
}
?>

<div class="retweet-popup">
  <div class="wrap5">
    <div class="retweet-popup-body-wrap popup-users">

      <div class="retweet-popup-heading users">
        <h3><?= $headline ?></h3>
        <span>
          <button class="close-retweet-popup">
            <i class="fa fa-times"></i>
          </button>
        </span>
      </div>

      <div class="box-share-users">

        <?php foreach ($users as $user): 
            $u = User::getData($user->user_id);
            if (!$u) continue;

            $user_follow = Follow::isUserFollow($user_id, $u->id);
        ?>

        <div class="grid-share grid-users">

          <!-- AVATAR -->
          <div class="user-avatar"
               onclick="goToProfile('./profile.php?username=<?= urlencode($u->username) ?>')">
            <img
              src="./assets/images/users/<?= $u->img ?>"
              alt="<?= $u->username ?>"
              class="img-share"
            >
          </div>

          <!-- INFO -->
          <div class="user-info"
               onclick="goToProfile('./profile.php?username=<?= urlencode($u->username) ?>')">
            <p><strong><?= htmlspecialchars($u->name) ?></strong></p>
            <p class="username">
              @<?= htmlspecialchars($u->username) ?>
              <?php if (Follow::FollowsYou($u->id, $user_id)): ?>
                <span class="ml-1 follows-you">Follows You</span>
              <?php endif; ?>
            </p>
          </div>

          <!-- FOLLOW BUTTON -->
          <div class="user-action">
            <?php if ($u->id != $user_id): ?>
              <button
                class="follow-btn follow-btn-m <?= $user_follow ? 'following' : 'follow' ?>"
                data-follow="<?= $u->id ?>"
                data-user="<?= $user_id ?>"
                data-profile="<?= $u_id ?>"
              >
                <?= $user_follow ? 'Following' : 'Follow' ?>
              </button>
            <?php endif; ?>
          </div>

        </div>
        <?php endforeach; ?>

      </div>
    </div>
  </div>
</div>

<script>
function goToProfile(url) {
  window.location.href = url;
}
</script>
