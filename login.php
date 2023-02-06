<?php
require_once 'src/init.php';

if($user->loggedIn()) {
  header('Location: home.php');
}

if(isset($_POST['login'])) {
  if(empty($_POST['user_username']) || empty($_POST['user_password'])) {
    $error = "Enter your Username and Password";
  } else {
    $data = [
      'user_username' => escape($_POST['user_username']),
      'user_password' => escape($_POST['user_password'])
    ];
  
    if($user->logIn($data)) {
      $_SESSION['user'] = $data['user_username'];
  
      header('Location: home.php');
    } else {
      $error = "Incorrect Username or Password";
    }
  }
}

$page_title = 'Log In';

require_once VIEW_ROOT . '/login.php';