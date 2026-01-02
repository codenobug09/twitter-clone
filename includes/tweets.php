<?php
$user_id = $_SESSION['user_id'];
// global $tweets;
foreach ($tweets as $tweet) {

  $retweet_sign = false;
  $retweet_comment = false;
  $qoq = false;

  if (Tweet::isTweet($tweet->id)) {

    $tweet_user = User::getData($tweet->user_id);
    $tweet_real = Tweet::getTweet($tweet->id);
    $timeAgo = Tweet::getTimeAgo($tweet->post_on);
    $likes_count = Tweet::countLikes($tweet->id);
    $user_like_it = Tweet::userLikeIt($user_id, $tweet->id);
    $retweets_count = Tweet::countRetweets($tweet->id);
    $user_retweeted_it = Tweet::userRetweeetedIt($user_id, $tweet->id);

  } else if (Tweet::isRetweet($tweet->id)) {

    $retweet = Tweet::getRetweet($tweet->id);

    if ($retweet->retweet_msg == null) {

      if ($retweet->retweet_id == null) {

        // if retweeted normal tweet
        $retweeted_tweet = Tweet::getTweet($retweet->tweet_id);
        $tweet_user = User::getData($retweeted_tweet->user_id);
        $tweet_real = Tweet::getTweet($retweet->tweet_id);
        $timeAgo = Tweet::getTimeAgo($tweet_real->post_on);
        $likes_count = Tweet::countLikes($retweet->tweet_id);
        $user_like_it = Tweet::userLikeIt($user_id, $retweet->tweet_id);
        $retweets_count = Tweet::countRetweets($retweet->tweet_id);
        $user_retweeted_it = Tweet::userRetweeetedIt($user_id, $retweet->tweet_id);
        $retweeted_user = User::getData($tweet->user_id);
        $retweet_sign = true;
      } else {

        // this condtion if user retweeted qouted tweet or qoute of qoute tweet


        $retweeted_tweet = Tweet::getRetweet($retweet->retweet_id);

        if ($retweeted_tweet->tweet_id != null) {
          // here it's retweeted qouted
          // if($retweeted_tweet->) 
          $tweet_user = User::getData($retweeted_tweet->user_id);
          $timeAgo = Tweet::getTimeAgo($retweeted_tweet->post_on);
          $likes_count = Tweet::countLikes($retweeted_tweet->post_id);
          $user_like_it = Tweet::userLikeIt($user_id, $retweeted_tweet->post_id);
          $retweets_count = Tweet::countRetweets($retweeted_tweet->post_id);
          $user_retweeted_it = Tweet::userRetweeetedIt($user_id, $retweeted_tweet->post_id);


          $tweet_inner = Tweet::getTweet($retweeted_tweet->tweet_id);
          $user_inner_tweet = User::getData($tweet_inner->user_id);
          $timeAgo_inner = Tweet::getTimeAgo($tweet_inner->post_on);
          $retweeted_user = User::getData($tweet->user_id);
          $retweet_sign = true;

          $qoute = $retweeted_tweet->retweet_msg;
          $retweet_comment = true;
        } else {
          // here is retweeted qouted of qouted

          $retweet_sign = true;
          $tweet_user = User::getData($retweeted_tweet->user_id);

          $timeAgo = Tweet::getTimeAgo($retweeted_tweet->post_on);
          $likes_count = Tweet::countLikes($retweeted_tweet->post_id);
          $user_like_it = Tweet::userLikeIt($user_id, $retweeted_tweet->post_id);
          $retweets_count = Tweet::countRetweets($retweeted_tweet->post_id);
          $user_retweeted_it = Tweet::userRetweeetedIt($user_id, $retweeted_tweet->post_id);

          $qoq = true; // stand for qoute of qoute
          $qoute = $retweeted_tweet->retweet_msg;
          $tweet_inner = Tweet::getRetweet($retweeted_tweet->retweet_id);
          $user_inner_tweet = User::getData($tweet_inner->user_id);
          $timeAgo_inner = Tweet::getTimeAgo($tweet_inner->post_on);
          $inner_qoute = $tweet_inner->retweet_msg;



          $retweeted_user = User::getData($tweet->user_id);

        }
      }

    } else {
      // qoute tweet condtion
      if ($retweet->retweet_id == null) {
        $tweet_user = User::getData($tweet->user_id);
        $timeAgo = Tweet::getTimeAgo($tweet->post_on);
        $likes_count = Tweet::countLikes($tweet->id);
        $user_like_it = Tweet::userLikeIt($user_id, $tweet->id);
        $retweets_count = Tweet::countRetweets($tweet->id);
        $user_retweeted_it = Tweet::userRetweeetedIt($user_id, $tweet->id);
        $qoute = $retweet->retweet_msg;
        $retweet_comment = true;


        $tweet_inner = Tweet::getTweet($retweet->tweet_id);
        $user_inner_tweet = User::getData($tweet_inner->user_id);
        $timeAgo_inner = Tweet::getTimeAgo($tweet_inner->post_on);
      } else {

        // this condtion for qoute of qoute which retweet_id not null and retweet msg not null
        $tweet_user = User::getData($tweet->user_id);
        $timeAgo = Tweet::getTimeAgo($tweet->post_on);
        $likes_count = Tweet::countLikes($tweet->id);
        $user_like_it = Tweet::userLikeIt($user_id, $tweet->id);
        $retweets_count = Tweet::countRetweets($tweet->id);
        $user_retweeted_it = Tweet::userRetweeetedIt($user_id, $tweet->id);
        $qoute = $retweet->retweet_msg;
        $qoq = true; // stand for qoute of qoute

        $tweet_inner = Tweet::getRetweet($retweet->retweet_id);
        $user_inner_tweet = User::getData($tweet_inner->user_id);
        $timeAgo_inner = Tweet::getTimeAgo($tweet_inner->post_on);
        $inner_qoute = $tweet_inner->retweet_msg;
        if ($inner_qoute == null) {

          $tweet_innerr = Tweet::getRetweet($tweet_inner->retweet_id);
          $inner_qoute = $tweet_innerr->retweet_msg;

          // $inner_qoute = "qork";

        }

      }

    }

  }
  $tweet_link = $tweet->id;

  if ($retweet_sign)
    $comment_count = Tweet::countComments($retweeted_tweet->id);
  else
    $comment_count = Tweet::countComments($tweet->id);

  ?>

  <div class="box-tweet feed" style="position: relative;">
    <a href="status/home.php?id=<?php echo $tweet_link; ?>">
      <span style="position:absolute; width:100%; height:100%; top:0;left: 0; z-index: 1;"></span>
    </a>
    <?php if ($retweet_sign) { ?>
      <span class="retweed-name"> <i class="fa fa-retweet retweet-name-i" aria-hidden="true"></i>
        <a style="position: relative; z-index:100; color:rgb(102, 117, 130);"
          href="/profile.php?username=<?= urlencode($retweeted_user->username); ?> "> <?php if ($retweeted_user->id == $user_id)
               echo "You";
             else
               echo $retweeted_user->name; ?> </a> retweeted</span>
    <?php } ?>
    <div class="grid-tweet">
      <a style="position: relative; z-index:1000" href="/profile.php?username=<?= urlencode($tweet_user->username); ?>">
        <img src="assets/images/users/<?php echo $tweet_user->img; ?>" alt="" class="img-user-tweet" />
      </a>

      <div>
        <p>
          <a style="position: relative; z-index:1000; color:black"
            href="/profile.php?username=<?= urlencode($tweet_user->username); ?>">
            <strong> <?php echo $tweet_user->name ?> </strong>
          </a>
          <span class="username-twitter">@<?php echo $tweet_user->username ?> </span>
          <span class="username-twitter"><?php echo $timeAgo ?></span>
        </p>
        <p class="tweet-links">
          <?php
          // check if it's qoute or normal tweet
          if ($retweet_comment || $qoq)
            echo Tweet::getTweetLinks($qoute);
          else
            echo Tweet::getTweetLinks($tweet_real->status); ?>
        </p>
        <?php if ($retweet_comment == false && $qoq == false) { ?>
          <?php if ($tweet_real->img != null) { ?>
            <p class="mt-post-tweet">
              <img src="assets/images/tweets/<?php echo $tweet_real->img; ?>" alt="" class="img-post-tweet" />
            </p>
          <?php }
        } else { ?>
          <!-- qoued tweet place here -->

          <div class="mt-post-tweet comment-post" style="position: relative;">

            <a href="status/home.php?id=<?php echo $tweet_link; ?>">
              <span class="" style="position:absolute; width:100%; height:100%; top:0;left: 0; z-index: 2;"></span>
            </a>
            <div class="grid-tweet py-3 ">

              <a style="position: relative; z-index:1000"
                href="/profile.php?username=<?= urlencode($user_inner_tweet->username); ?>">
                <img src="assets/images/users/<?php echo $user_inner_tweet->img; ?>" alt="" class="img-user-tweet" />
              </a>

              <div>
                <p>
                  <a style="position: relative; z-index:1000; color:black"
                    href="/profile.php?username=<?= urlencode($user_inner_tweet->username) ?>">
                    <strong> <?php echo $user_inner_tweet->name ?> </strong>
                  </a>
                  <span class="username-twitter">@<?php echo $user_inner_tweet->username ?> </span>
                  <span class="username-twitter"><?php echo $timeAgo_inner ?></span>
                </p>
                <p>
                  <?php
                  if ($qoq)
                    echo Tweet::getTweetLinks($inner_qoute);
                  else
                    echo Tweet::getTweetLinks($tweet_inner->status); ?>
                </p>
                <?php   // don't show img if qoute of qoute
                    if ($qoq == false) {
                      if ($tweet_inner->img != null) { ?>
                    <p class="mt-post-tweet">
                      <img src="assets/images/tweets/<?php echo $tweet_inner->img; ?>" alt="" class="img-post-retweet" />
                    </p>
                  <?php }
                    } ?>

              </div>

            </div>


          </div>

        <?php } ?>

        <div class="grid-reactions">
          <div class="grid-box-reaction">
            <div class="hover-reaction hover-reaction-comment comment" data-user="<?php echo $user_id; ?>" data-tweet="<?php
               if ($retweet_sign)
                 echo $retweeted_tweet->id;
               else
                 echo $tweet->id; ?>">

              <i class="far fa-comment"></i>
              <div class="mt-counter likes-count d-inline-block">
                <p> <?php if ($comment_count > 0)
                  echo $comment_count; ?> </p>
              </div>
            </div>
          </div>
          <div class="grid-box-reaction">

            <div class="hover-reaction hover-reaction-retweet
        <?= $user_retweeted_it ? 'retweeted' : 'retweet' ?> option" data-tweet="<?php
               // send the tweet you wanna undo retweet to undo function
               // if the user retweeted it and it's the real tweet
               // to send the id of retweeted tweet
               // if($user_retweeted_it && !$retweet_sign)
               // echo Tweet::retweetRealId($tweet->id);
               // else
               echo $tweet->id;
               ?>" data-user="<?php echo $user_id; ?>
        " data-retweeted="<?php echo $user_retweeted_it; ?>" data-sign="<?php echo $retweet_sign; ?>"
              data-tmp="<?php echo $retweet_comment; ?>" data-qoq="<?php echo $qoq; ?>">



              <i class="fas fa-retweet"></i>
              <div class="mt-counter likes-count d-inline-block">
                <p><?php if ($retweets_count > 0)
                  echo $retweets_count; ?></p>
              </div>



            </div>

            <div class="options">


            </div>

          </div>
          <div class="grid-box-reaction">
            <a class="hover-reaction hover-reaction-like 
        <?= $user_like_it ? 'unlike-btn' : 'like-btn' ?> " data-tweet="<?php
               if ($retweet_sign) {
                 if ($retweet->tweet_id != null) {
                   echo $retweet->tweet_id;
                 }
                 echo $retweet->retweet_id;
               } else
                 echo $tweet->id;
               //  echo Tweet::likedTweetRealId($tweet->id);
             
               ?>" data-user="<?php echo $user_id; ?>">


              <i class="fa-heart <?= $user_like_it ? 'fas' : 'far mt-icon-reaction' ?>"></i>
              <!-- <i class="fas fa-heart liked"></i> -->

              <div class="mt-counter likes-count d-inline-block">
                <p> <?php if ($likes_count > 0)
                  echo $likes_count; ?> </p>
              </div>
            </a>


          </div>

          <div class="grid-box-reaction">
            <div class="hover-reaction hover-reaction-comment">

              <i class="fas fa-ellipsis-h mt-icon-reaction"></i>
            </div>
            <div class="mt-counter">
              <p></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <style>
      /* ===== Tweet Box ===== */
      .box-tweet.feed {
        background: #fff;
        padding: 14px 16px;
        border-bottom: 1px solid #e6ecf0;
        transition: background 0.2s ease;
      }

      .box-tweet.feed:hover {
        background: #f7f9fa;
      }

      /* ===== Retweet info ===== */
      .retweed-name {
        font-size: 13px;
        color: #657786;
        margin-left: 52px;
        display: flex;
        align-items: center;
        gap: 6px;
      }

      .retweet-name-i {
        color: #17bf63;
      }

      /* ===== Grid Tweet ===== */
      .grid-tweet {
        display: grid;
        grid-template-columns: 48px 1fr;
        column-gap: 12px;
      }

      /* ===== Avatar ===== */
      .img-user-tweet {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        object-fit: cover;
      }

      /* ===== Username ===== */
      .username-twitter {
        color: #657786;
        font-size: 14px;
        margin-left: 6px;
      }

      /* ===== Tweet Content ===== */
      .tweet-links,
      .grid-tweet p {
        font-size: 15px;
        line-height: 1.5;
        color: #0f1419;
        word-break: break-word;
      }

      /* ===== Tweet Image ===== */
      .img-post-tweet,
      .img-post-retweet {
        width: 100%;
        border-radius: 16px;
        margin-top: 10px;
        border: 1px solid #e6ecf0;
      }

      /* ===== Quoted Tweet ===== */
      .comment-post {
        border: 1px solid #e6ecf0;
        border-radius: 14px;
        padding: 12px;
        margin-top: 12px;
        background: #fff;
        transition: background 0.2s;
      }

      .comment-post:hover {
        background: #f7f9fa;
      }

      /* ===== Reactions ===== */
      .grid-reactions {
        display: flex;
        justify-content: space-between;
        margin-top: 12px;
        max-width: 420px;
      }

      .grid-box-reaction {
        display: flex;
        align-items: center;
      }

      /* ===== Reaction Button ===== */
      .hover-reaction {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 16px;
        color: #657786;
        cursor: pointer;
        padding: 6px;
        border-radius: 50%;
        transition: all 0.2s ease;
      }

      /* ===== Hover Colors ===== */
      .hover-reaction-comment:hover {
        color: #1da1f2;
        background: rgba(29, 161, 242, 0.1);
      }

      .hover-reaction-retweet:hover,
      .hover-reaction-retweet.retweeted {
        color: #17bf63;
        background: rgba(23, 191, 99, 0.1);
      }

      .hover-reaction-like:hover {
        color: #e0245e;
        background: rgba(224, 36, 94, 0.1);
      }

      /* ===== Liked ===== */
      .unlike-btn i {
        color: #e0245e;
      }

      /* ===== Counters ===== */
      .mt-counter p {
        font-size: 13px;
        color: #657786;
        margin: 0;
      }

      /* ===== Options ===== */
      .mt-icon-reaction {
        font-size: 15px;
      }

      /* ===== Link overlay ===== */
      .box-tweet.feed a span {
        pointer-events: none;
      }
    </style>




  </div>


  <div class="popupTweet">

  </div>
  <div class="popupComment">

  </div>




<?php } ?>