<?php include_once 'includes/header.php'; ?>

<?php include_once 'includes/sidebar.php'; ?>

<div class="posts">
  <div class="post single-post">
    <img id="post-profile-picture" src="<?=BASE_URL?>/uploads/profile-pictures/<?=escape($post_data->user_profile_picture)?>" alt="<?=escape($post_data->user_profile_picture)?>">
    <h4><a href="profile?u=<?=escape($post_data->user_username)?>"><?=escape($post_data->user_name)?></a></h4>
    <h5>@<?=escape($post_data->user_username)?>
    <h6><?=escape(date('l j F Y \a\t H:i', strtotime($post_data->post_date)))?></h6>
    <p><?=escape($post_data->post_content)?></p>

    <?php if($user_data->user_id === $post_data->post_by): ?>
      <span><a href="?p=<?=escape($post_data->post_id)?>&edit=<?=escape($post_data->post_id)?>">Edit</a><a href="?p=<?=escape($post_data->post_id)?>&delete=<?=escape($post_data->post_id)?>">Delete</a></span>
    <?php endif; ?>

    <div class="replies">
      <div class="submit-reply">
        <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
          <?php if(isset($reply_error)): ?>
            <div class="form-group error">
              <p><?=$reply_error?></p>
            </div>
          <?php endif; ?>
          <div class="form-group">
            <textarea name="reply_content" placeholder="Your reply"><?=isset($_GET['edit-reply']) ? $reply_to_edit->reply_content : ''?></textarea>
          </div>
          <div class="form-group">
            <input type="submit" name="<?=!isset($_GET['edit-reply']) ? 'reply' : 'edit-reply'?>" value="Reply">
          </div>
        </form>
      </div>
      
      <?php foreach($replies as $reply): ?>
        <div class="reply">
          <img id="post-profile-picture" src="<?=BASE_URL?>/uploads/profile-pictures/<?=escape($reply->user_profile_picture)?>" alt="<?=escape($reply->user_profile_picture)?>">
          <h4><a href="profile?u=<?=escape($reply->user_username)?>"><?=escape($reply->user_name)?></a></h4>
          <h5>@<?=escape($reply->user_username)?>
          <h6><?=escape(date('l j F Y \a\t H:i', strtotime($reply->reply_date)))?></h6>
          <p><?=escape($reply->reply_content)?></p>

          <?php if($user_data->user_id === $reply->reply_by): ?>
            <span><a href="?p=<?=escape($post_data->post_id)?>&edit-reply=<?=escape($reply->reply_id)?>">Edit</a><a href="?p=<?=escape($post_data->post_id)?>&delete-reply=<?=escape($reply->reply_id)?>">Delete</a></span>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>

<?php include_once 'includes/footer.php'; ?>