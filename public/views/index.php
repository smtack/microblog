<?php include_once 'includes/header.php'; ?>

<div class="submit submit-single">
  <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
    <div class="form-group">
      <h2>Sign Up</h2>
    </div>
    <?php if(isset($error)): ?>
      <div class="form-group error">
        <p><?=$error?></p>
      </div>
    <?php endif; ?>
    <div class="form-group">
      <label for="user_name">Name</label>
      <input id="user_name" type="text" name="user_name">
    </div>
    <div class="form-group">
      <label for="user_username">Username</label>
      <input id="user_username" type="text" name="user_username">
    </div>
    <div class="form-group">
      <label for="user_email">Email</label>
      <input id="user_email" type="text" name="user_email">
    </div>
    <div class="form-group">
      <label for="user_password">Password</label>
      <input id="user_password" type="password" name="user_password">
    </div>
    <div class="form-group">
      <label for="confirm_password">Confirm Password</label>
      <input id="confirm_password" type="password" name="confirm_password">
    </div>
    <div class="form-group">
      <input type="submit" name="signup" value="Sign Up">
    </div>
    <div class="form-group">
      <p>Already have an account? <a href="login">Log In</a>.</p>
    </div>
  </form>
</div>

<?php include_once 'includes/footer.php'; ?>