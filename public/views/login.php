<?php include_once 'includes/header.php'; ?>

<div class="submit submit-single">
  <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
    <div class="form-group">
      <h2>Log In</h2>
    </div>
    <?php if(isset($error)): ?>
      <div class="form-group error">
        <p><?=$error?></p>
      </div>
    <?php endif; ?>
    <div class="form-group">
      <label for="user_username">Username</label>
      <input id="user_username" type="text" name="user_username">
    </div>
    <div class="form-group">
      <label for="user_password">Password</label>
      <input id="user_password" type="password" name="user_password">
    </div>
    <div class="form-group">
      <input type="submit" name="login" value="Log In">
    </div>
    <div class="form-group">
      <p>Don't have an account? <a href="<?=BASE_URL?>">Sign Up</a>.</p>
    </div>
  </form>
</div>

<?php include_once 'includes/footer.php'; ?>