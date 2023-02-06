<?php
require_once 'src/init.php';

if($user->loggedIn()) {
  header('Location: home.php');
}

if(isset($_POST['signup'])) {
  if(empty($_POST['user_name']) || empty($_POST['user_username']) || empty($_POST['user_email']) || empty($_POST['user_password']) || empty($_POST['confirm_password'])) {
    $error = "Fill in all fields";
  } else if(!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
    $error = "Enter a valid email address";
  } else if($_POST['user_password'] !== $_POST['confirm_password']) {
    $error = "Passwords must match";
  } else {
    $data = [
      'user_name' => escape($_POST['user_name']),
      'user_username' => escape($_POST['user_username']),
      'user_email' => escape($_POST['user_email']),
      'user_password' => password_hash($_POST['user_password'], PASSWORD_BCRYPT)
    ];

    if($user->createUser($data)) {
      $_SESSION['user'] = $data['user_username'];
    
      header('Location: home.php');      
    } else {
      $error = "Unable to sign up. Please try again later";
    }
  }
}

$page_title = 'Sign Up';

require_once VIEW_ROOT . '/index.php';