<?php
require_once 'src/init.php';

$post = new Post($db);

if(!$user->loggedIn()) {
  header('Location: index.php');
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
      header('Location: home.php');
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
        header('Location: home.php');
      }
    }
  }
}

if(isset($_GET['delete'])) {
  if(!$post->deletePost(escape($_GET['delete']))) {
    $error = "Unable to delete post. Try again later.";
  } else {
    header('Location: home.php');
  }
}

$posts = $post->getHomepagePosts($user_data->user_id);

$page_title = 'Home';

require_once VIEW_ROOT . '/home.php';