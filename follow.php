<?php
require_once 'src/init.php';

if(isset($_GET['u'])) {
  $follow = escape($_GET['u']);

  $user->follow($user_data->user_id, $follow);

  $follow_user = $user->getUser($follow);

  header('Location: profile?u=' . $follow_user->user_username);
} else {
  header('Location: profile?u=' . $follow_user->user_username);
}