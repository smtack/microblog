<?php
require_once 'src/init.php';

if(isset($_GET['u'])) {
  $unfollow = escape($_GET['u']);

  $user->unfollow($user_data->user_id, $unfollow);

  $follow_user = $user->getUser($unfollow);

  header('Location: profile?u=' . $follow_user->user_username);
} else {
  header('Location: profile?u=' . $follow_user->user_username);
}