<div class="submit">
  <?php if(isset($profile_data)): ?>
    <div class="user-info">
      <img id="profile-picture" src="<?=BASE_URL?>/uploads/profile-pictures/<?=escape($profile_data->user_profile_picture)?>" alt="<?=escape($profile_data->user_profile_picture)?>">
      <h3><?=escape($profile_data->user_name)?>
      <h4>@<?=escape($profile_data->user_username)?>
      <h6>Joined on <?=escape(date('l j F Y', strtotime($profile_data->user_created)))?></h6>

      <?php if($profile_data->user_id !== $user_data->user_id): ?>
        <?php if(!findValue($follows, 'follow_user', $user_data->user_id)): ?>
          <a href="follow?u=<?=escape($profile_data->user_id)?>"><button>Follow</button></a>
        <?php else: ?>
          <a href="unfollow?u=<?=escape($profile_data->user_id)?>"><button>Unfollow</button></a>
        <?php endif; ?>
      <?php endif; ?>
    </div>
  <?php endif; ?>

  <form action="search" method="get">
    <div class="form-group">
      <input type="text" name="s" placeholder="Search" value="<?=isset($keywords) ? str_replace('%', '', $keywords) : ''?>">
    </div>
  </form>

  <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
    <?php if(isset($error)): ?>
      <div class="form-group error">
        <p><?=$error?></p>
      </div>
    <?php endif; ?>
    <div class="form-group">
      <textarea name="post_content" placeholder="Your message"><?=isset($_GET['edit']) ? $post_to_edit->post_content : ''?></textarea>
    </div>
    <div class="form-group">
      <input type="submit" name="<?=!isset($_GET['edit']) ? 'submit' : 'edit'?>" value="Post">
    </div>
  </form>

  <div class="navigation">
    <a href="all"><button>All Posts</button></a>
  </div>
</div>