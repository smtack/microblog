<?php include_once 'includes/header.php'; ?>

<div class="submit submit-single">
  <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
    <div class="form-group">
      <h2>Update Profile</h2>
    </div>
    <?php if(isset($error)): ?>
      <div class="form-group error">
        <p><?=$error?></p>
      </div>
    <?php endif; ?>
    <div class="form-group">
      <label for="user_name">Name</label>
      <input id="user_name" type="text" name="user_name" value="<?=escape($user_data->user_name)?>">
    </div>
    <div class="form-group">
      <label for="user_username">Username</label>
      <input id="user_username" type="text" name="user_username" value="<?=escape($user_data->user_username)?>">
    </div>
    <div class="form-group">
      <label for="user_email">Email</label>
      <input id="user_email" type="text" name="user_email" value="<?=escape($user_data->user_email)?>">
    </div>
    <div class="form-group">
      <input type="submit" name="update" value="Update Profile">
    </div>
  </form>
  <form enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF']?>" method="post">
    <div class="form-group">
      <h2>Update Profile Picture</h2>
    </div>
    <?php if(isset($picture_error)): ?>
      <div class="form-group error">
        <p><?=$picture_error?></p>
      </div>
    <?php endif; ?>
    <div class="form-group">
      <label for="user_profile_picture">Select an image to upload</label>
      <input id="user_profile_picture" type="file" name="user_profile_picture">
    </div>
    <div class="form-group">
      <input type="submit" name="update_profile_picture" value="Update Profile Picture">
    </div>
  </form>
  <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
    <div class="form-group">
      <h2>Change Password</h2>
    </div>
    <?php if(isset($password_error)): ?>
      <div class="form-group error">
        <p><?=$password_error?></p>
      </div>
    <?php endif; ?>
    <div class="form-group">
      <label for="current_password">Current Password</label>
      <input id="current_password" type="password" name="current_password">
    </div>
    <div class="form-group">
      <label for="new_password">New Password</label>
      <input id="new_password" type="password" name="new_password">
    </div>
    <div class="form-group">
      <label for="confirm_password">Confirm Password</label>
      <input id="confirm_password" type="password" name="confirm_password">
    </div>
    <div class="form-group">
      <input type="submit" name="update_password" value="Change Password">
    </div>
  </form>
  <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
    <div class="form-group">
      <h2>Delete Profile</h2>
    </div>
    <?php if(isset($delete_error)): ?>
      <div class="form-group error">
        <p><?=$delete_error?></p>
      </div>
    <?php endif; ?>
    <div class="form-group">
      <label for="user_password">Password</label>
      <input id="user_password" type="password" name="user_password">
    </div>
    <div class="form-group">
      <input type="submit" name="delete_profile" value="Delete Profile">
    </div>
  </form>
</div>

<?php include_once 'includes/footer.php'; ?>