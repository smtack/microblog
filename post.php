<?php
require_once 'src/init.php';

if(!$user->loggedIn()) {
  header('Location: index.php');
}

$post = new Post($db);

if(isset($_GET['p'])) {
  if(!$post_data = $post->getPost(escape($_GET['p']))) {
    header('Location: home.php');
  }

  $page_title = 'Post by ' . $post_data->user_name;

  $replies = $post->getReplies($post_data->post_id);
} else {
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
      header('Location: post?p=' . $post_data->post_id);
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
        header('Location: post?p=' . $post_data->post_id);
      }
    }
  }
}

if(isset($_GET['delete'])) {
  if(!$post->deletePost(escape($_GET['delete']))) {
    $error = "Unable to delete post. Try again later.";
  } else {
    header('Location: post?p=' . $post_data->post_id);
  }
}

if(isset($_POST['reply'])) {
  if(empty($_POST['reply_content'])) {
    $reply_error = "Enter a reply";
  } else {
    $data = [
      'reply_content' => escape($_POST['reply_content']),
      'reply_by' => escape($user_data->user_id),
      'reply_post' => escape($_GET['p'])
    ];
  
    if(!$post->createReply($data)) {
      $reply_error = "Unable to make reply. Try again later.";
    } else {
      header('Location: post?p=' . $post_data->post_id);
    }
  }
}

if(isset($_GET['edit-reply'])) {
  $reply_to_edit = $post->getReply(escape($_GET['edit-reply']));

  if(isset($_POST['edit-reply'])) {
    if(empty($_POST['reply_content'])) {
      $reply_error = "Enter a reply";
    } else {
      $reply = [
        'reply_id' => escape($_GET['edit-reply']),
        'reply_content' => escape($_POST['reply_content']),
        'reply_by' => escape($user_data->user_id)
      ];
  
      if(!$post->editReply($reply)) {
        $reply_error = "Unable to post reply. Please try again later.";
      } else {
        header('Location: post?p=' . $post_data->post_id);
      }
    }
  }
}

if(isset($_GET['delete-reply'])) {
  if(!$post->deleteReply(escape($_GET['delete-reply']))) {
    $reply_error = "Unable to delete reply. Please try again later.";
  } else {
    header('Location: post?p=' . $post_data->post_id);
  }
}

require_once VIEW_ROOT . '/post.php';