<?php
require_once 'src/init.php';

if(!$user->loggedIn()) {
  header('Location: index.php');
}

if(isset($_POST['update'])) {
  if(empty($_POST['user_name']) || empty($_POST['user_username']) || empty($_POST['user_email'])) {
    $error = "Fill in all fields";
  } else if(!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
    $error = "Enter a valid email address";
  } else {
    $data = [
      'user_name' => escape($_POST['user_name']),
      'user_username' => escape($_POST['user_username']),
      'user_email' => escape($_POST['user_email'])
    ];

    if($user->updateProfile($data, $user_data->user_id)) {
      $_SESSION['user'] = $data['user_username'];
    
      header('Location: update.php');
    } else {
      $error = "Unable to update profile. Try again later";
    }
  }
}

if(isset($_POST['update_profile_picture'])) {
  if(empty($_FILES['user_profile_picture']['name'])) {
    $picture_error = "Select a file to upload";
  } else {
    $target_dir = "uploads/profile-pictures/";
    $file_name = basename($_FILES['user_profile_picture']['name']);
    $path = $target_dir . $file_name;
    $file_type = pathinfo($path, PATHINFO_EXTENSION);
    $allow_types = array('jpg', 'png');

    if(!in_array($file_type, $allow_types)) {
      $picture_error = "This file type is not allowed";
    } else if(!move_uploaded_file($_FILES['user_profile_picture']['tmp_name'], $path)) {
      $picture_error = "Unable to upload file";
    } else {
      if($user->updateProfilePicture($file_name, $user_data->user_id)) {
        header('Location: update.php');
      } else {
        $picture_error = "Unable to update profile picture. Try again later.";
      }
    }
  }
}

if(isset($_POST['update_password'])) {
  if(empty($_POST['current_password']) || empty($_POST['new_password']) || empty($_POST['confirm_password'])) {
    $password_error = "Fill in all fields";
  } else if(!password_verify($_POST['current_password'], $user_data->user_password)) {
    $password_error = "Enter your current password correctly";
  } else if($_POST['new_password'] !== $_POST['confirm_password']) {
    $password_error = "Passwords must match";
  } else {
    $new_password = password_hash($_POST['new_password'], PASSWORD_BCRYPT);
  
    if($user->updatePassword($new_password, $user_data->user_id)) {
      header('Location: update.php');
    } else {
      $password_error = "Unable to update password. Try again later";
    }
  }
}

if(isset($_POST['delete_profile'])) {
  if(empty($_POST['user_password'])) {
    $delete_error = "Enter your password";
  } else if(!password_verify($_POST['user_password'], $user_data->user_password)) {
    $delete_error = "Enter your password correctly";
  } else {
    if($user->deleteProfile($user_data->user_id)) {
      header('Location: logout.php');
    } else {
      $delete_error = "Unable to delete profile. Try again later";
    }
  }
}

$page_title = 'Update Profile';

require_once VIEW_ROOT . '/update.php';