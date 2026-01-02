<?php
include 'core/init.php';
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);
$user_id = $_SESSION['user_id'];
$user = User::getData($user_id);
$who_users = Follow::whoToFollow($user_id);

// update notification count
User::updateNotifications($user_id);

$notify_count = User::CountNotification($user_id);
$notofication = User::notification($user_id);
// var_dump($notofication);
// die();
if (User::checkLogIn() === false)
  header('location: index.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Notifications | Twitter</title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/all.min.css">
  <link rel="stylesheet" href="assets/css/profile_style.css?v=<?php echo time(); ?>">

  <link rel="shortcut icon" type="image/png" href="assets/images/twitter.svg">

</head>

<body>

  <script src="assets/js/jquery-3.5.1.min.js"></script>


  <div id="mine">
    <div class="wrapper-left">
      <div class="sidebar-left">
        <div class="grid-sidebar" style="margin-top: 12px">
          <div class="icon-sidebar-align">
            <img src="https://i.ibb.co/86d7x4Z/twitter.png" alt="" height="30px" width="30px" />
          </div>
        </div>

        <a href="home.php">
          <div class="grid-sidebar bg-active" style="margin-top: 12px">
            <div class="icon-sidebar-align">
              <img src="https://i.ibb.co/6tKFLWG/home.png" alt="" height="26.25px" width="26.25px" />
            </div>
            <div class="wrapper-left-elements">
              <a href="home.php" style="margin-top: 4px;"><strong>Home</strong></a>
            </div>
          </div>
        </a>

        <a href="notification.php">
          <div class="grid-sidebar">
            <div class="icon-sidebar-align position-relative">
              <?php if ($notify_count > 0) { ?>
                <i class="notify-count"><?php echo $notify_count; ?></i>
              <?php } ?>
              <img src="https://i.ibb.co/Gsr7qyX/notification.png" alt="" height="26.25px" width="26.25px" />
            </div>

            <div class="wrapper-left-elements">
              <a class="wrapper-left-active" href="notification.php"
                style="margin-top: 4px"><strong>Notification</strong></a>
            </div>
          </div>
        </a>

        <a href="./profile.php?username=<?= urlencode($user->username) ?>">
          <div class="grid-sidebar">
            <div class="icon-sidebar-align">
              <img src="https://i.ibb.co/znTXjv6/perfil.png" alt="" height="26.25px" width="26.25px" />
            </div>

            <div class="wrapper-left-elements">
              <span style="margin-top: 4px"><strong>Profile</strong></span>
            </div>
          </div>
        </a>

        <a href="./account.php">
          <div class="grid-sidebar ">
            <div class="icon-sidebar-align">
              <img
                src="https://www.bing.com/th/id/OIP.Qs1NuFtNZmtxK8WJ7H4KjgHaHa?w=216&h=211&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=3.1&rm=2"
                alt="" height="26.25px" width="26.25px" />
            </div>

            <div class="wrapper-left-elements">
              <a href="./account.php" style="margin-top: 4px"><strong>Settings</strong></a>
            </div>


          </div>
        </a>
        <a href="includes/logout.php">
          <div class="grid-sidebar">
            <div class="icon-sidebar-align">
              <i style="font-size: 26px; color:red" class="fas fa-sign-out-alt"></i>
            </div>

            <div class="wrapper-left-elements">
              <a style="color:red" href="includes/logout.php" style="margin-top: 4px"><strong>Logout</strong></a>
            </div>
          </div>
        </a>
        <button class="button-twittear">
          <strong><a href="./home.php">Tweet</a></strong>
        </button>

        <div class="box-user">
          <div class="grid-user">
            <div>
              <img src="assets/images/users/<?php echo $user->img ?>" alt="user" class="img-user" />
            </div>
            <div>
              <p class="name"><strong><?php if ($user->name !== null) {
                echo $user->name;
              } ?></strong></p>
              <p class="username">@<?php echo $user->username; ?></p>
            </div>

          </div>
        </div>
      </div>
    </div>



    <div class="grid-posts">
      <div class="border-right">
        <div class="grid-toolbar-center">
          <div class="center-input-search">

          </div>

        </div>

        <div class="box-fixed" id="box-fixed"></div>

        <div class="box-home feed">
          <div class="container">
            <div style="border-bottom: 1px solid #F5F8FA;" class="row position-fixed box-name">
              <div class="col-xs-2">
                <a href="javascript: history.go(-1);"> <i style="font-size:20px;"
                    class="fas fa-arrow-left arrow-style"></i> </a>
              </div>
              <div class="col-xs-10">
                <p style="margin-top: 12px;" class="home-name"> Notifications</p>
              </div>
            </div>

          </div>
          <div class="notification-container mt-5">

            <?php foreach ($notofication as $notify):

              $user = User::getData($notify->notify_from);
              if (!$user)
                continue;

              $timeAgo = Tweet::getTimeAgo($notify->time);

              switch ($notify->type) {
                case 'like':
                  $icon = "<i class='fas fa-heart'></i>";
                  $msg = "liked your Tweet";
                  $iconClass = "like";
                  break;

                case 'retweet':
                  $icon = "<i class='fas fa-retweet'></i>";
                  $msg = "retweeted your Tweet";
                  $iconClass = "retweet";
                  break;

                case 'qoute':
                  $icon = "<i class='fas fa-retweet'></i>";
                  $msg = "quoted your Tweet";
                  $iconClass = "retweet";
                  break;

                case 'comment':
                  $icon = "<i class='far fa-comment'></i>";
                  $msg = "commented on your Tweet";
                  $iconClass = "comment";
                  break;

                case 'reply':
                  $icon = "<i class='far fa-comment'></i>";
                  $msg = "replied to your comment";
                  $iconClass = "comment";
                  break;

                case 'follow':
                  $icon = "<i class='fas fa-user'></i>";
                  $msg = "followed you";
                  $iconClass = "follow";
                  break;

                case 'mention':
                  $icon = "<i class='fas fa-at'></i>";
                  $msg = "mentioned you in a Tweet";
                  $iconClass = "mention";
                  break;
              }

              $avatar = $user->img ?? 'default.png';
              ?>

              <div class="notification-item">

                <!-- Click toàn card -->
                <a class="overlay-link" href="<?php echo ($notify->type === 'follow')
                  ? '/profile/index.php?username=' . urlencode($user->username)
                  : '/status/home.php?id=' . $notify->target; ?>">
                </a>

                <div class="icon <?= $iconClass ?>">
                  <?= $icon ?>
                </div>

                <div class="content">
                  <a class="avatar" href="/profile/index.php?username=<?= urlencode($user->username); ?>">
                    <img src="/assets/images/users/<?= htmlspecialchars($avatar); ?>">
                  </a>

                  <div class="text">
                    <a class="name" href="/profile/index.php?username=<?= urlencode($user->username); ?>">
                      <?= htmlspecialchars($user->name); ?>
                    </a>
                    <span class="message"><?= $msg ?></span>
                    <div class="time"><?= $timeAgo ?></div>
                  </div>
                </div>

              </div>

            <?php endforeach; ?>

          </div>
          <style>
            /* ===== Notification Container ===== */
            .notification-container {
              max-width: 833px;
            }

            /* ===== Notification Item ===== */
            .notification-item {
              position: relative;
              display: flex;
              padding: 14px 16px;
              border-bottom: 1px solid #e6ecf0;
              cursor: pointer;
              background: #fff;
              transition: background 0.2s ease;
            }

            .notification-item:hover {
              background: #f7f9fa;
            }

            /* Click toàn card */
            .notification-item .overlay-link {
              position: absolute;
              inset: 0;
              z-index: 1;
            }

            /* ===== Icon ===== */
            .notification-item .icon {
              width: 42px;
              text-align: center;
              font-size: 18px;
              margin-right: 12px;
            }

            /* Icon màu theo type */
            .notification-item .icon.like {
              color: #e0245e;
            }

            .notification-item .icon.retweet {
              color: #17bf63;
            }

            .notification-item .icon.comment {
              color: #1da1f2;
            }

            .notification-item .icon.follow {
              color: #794bc4;
            }

            .notification-item .icon.mention {
              color: #1da1f2;
            }

            /* ===== Content ===== */
            .notification-item .content {
              display: flex;
              gap: 10px;
              z-index: 2;
            }

            /* Avatar */
            .notification-item .avatar img {
              width: 42px;
              height: 42px;
              border-radius: 50%;
              object-fit: cover;
            }

            /* Text */
            .notification-item .text {
              display: flex;
              flex-direction: column;
              font-size: 14px;
            }

            /* Name */
            .notification-item .name {
              font-weight: 700;
              color: #0f1419;
              text-decoration: none;
            }

            .notification-item .name:hover {
              text-decoration: underline;
            }

            /* Message */
            .notification-item .message {
              color: #536471;
              margin-left: 4px;
            }

            /* Time */
            .notification-item .time {
              font-size: 12px;
              color: #8899a6;
              margin-top: 4px;
            }
          </style>


        </div>
      </div>

      <div class="wrapper-right">
        <div style="width: 90%;" class="container">

          <div class="input-group py-2 m-auto pr-5 position-relative">

            <i id="icon-search" class="fas fa-search tryy"></i>
            <input type="text" class="form-control search-input" placeholder="Search Twitter">
            <div class="search-result">


            </div>
          </div>
        </div>



        <div class="box-share">
          <p class="txt-share"><strong>Who to follow</strong></p>
          <?php
          foreach ($who_users as $user) {
            //  $u = User::getData($user->user_id);
            $user_follow = Follow::isUserFollow($user_id, $user->id);
            ?>
            <div class="grid-share">
              <a style="position: relative; z-index:5; color:black"
                href="/profile.php?username=<?php echo $user->username; ?>">
                <img src="assets/images/users/<?php echo $user->img; ?>" alt="" class="img-share" />
              </a>
              <div>
                <p>
                  <a style="position: relative; z-index:5; color:black"
                    href="/profile.php?username=<?php echo $user->username; ?>">
                    <strong><?php echo $user->name; ?></strong>
                  </a>
                </p>
                <p class="username">@<?php echo $user->username; ?>
                  <?php if (Follow::FollowsYou($user->id, $user_id)) { ?>
                    <span class="ml-1 follows-you">Follows You</span>
                  </p>
                <?php } ?></p>
                </p>
              </div>
              <div>
                <button class="follow-btn follow-btn-m <?php echo $user_follow ? 'following' : 'follow'; ?>"
                  data-follow="<?php echo $user->id; ?>" data-user="<?php echo $user_id; ?>"
                  data-profile="<?php echo $profileData->id; ?>" style="font-weight:700;">
                  <?php echo $user_follow ? 'Following' : 'Follow'; ?>
                </button>
              </div>

            </div>

          <?php } ?>


        </div>


      </div>
    </div>
  </div>

  <script src="assets/js/search.js"></script>
  <script src="assets/js/photo.js"></script>
  <script src="assets/js/follow.js?v=<?php echo time(); ?>"></script>
  <script src="assets/js/users.js?v=<?php echo time(); ?>"></script>
  <script type="text/javascript" src="assets/js/hashtag.js"></script>
  <script type="text/javascript" src="assets/js/like.js"></script>
  <script type="text/javascript" src="assets/js/comment.js?v=<?php echo time(); ?>"></script>
  <script type="text/javascript" src="assets/js/retweet.js?v=<?php echo time(); ?>"></script>
  <script src="https://kit.fontawesome.com/38e12cc51b.js" crossorigin="anonymous"></script>
  <!-- <script src="assets/js/jquery-3.4.1.slim.min.js"></script> -->
  <script src="assets/js/jquery-3.5.1.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>