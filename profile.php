<?php
require_once 'src/init.php';

if(!$user->loggedIn()) {
  header('Location: index.php');
}

$post = new Post($db);

if(!$profile_data = $user->getUser(escape($_GET['u']))) {
  header('Location: home.php');
}

if(isset($_POST['submit'])) {
  if(empty($_POST['post_content'])) {
    $error = "Enter a post";
  } else {
    $data = [
      'post_content' => escape($_POST['post_content']),
      'post_by' => escape($user_data->user_id)
    ];

    if(!$post->createPost($data)) {
      $error = "Unable to make post. Try again later.";
    } else {
      header('Location: profile?u=' . $profile_data->user_username);
    }
  }
}

if(isset($_GET['edit'])) {
  $post_to_edit = $post->getPost(escape($_GET['edit']));

  if(isset($_POST['edit'])) {
    if(empty($_POST['post_content'])) {
      $error = "Enter a post";
    } else {
      $data = [
        'post_id' => escape($_GET['edit']),
        'post_content' => escape($_POST['post_content']),
        'post_by' => escape($user_data->user_id)
      ];
  
      if(!$post->editPost($data)) {
        $error = "Unable to edit post. Try again later.";
      } else {
        header('Location: profile?u=' . $profile_data->user_username);
      }
    }
  }
}

if(isset($_GET['delete'])) {
  if(!$post->deletePost(escape($_GET['delete']))) {
    $error = "Unable to delete post. Try again later.";
  } else {
    header('Location: profile?u=' . $profile_data->user_username);
  }
}

$posts = $post->getProfilePosts($profile_data->user_id);

$follows = $user->getFollows($profile_data->user_id);

$page_title = $profile_data->user_name . '\'s Profile';

require_once VIEW_ROOT . '/profile.php';