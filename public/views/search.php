<?php include_once 'includes/header.php'; ?>

<?php include_once 'includes/sidebar.php'; ?>

<div class="posts">
  <ul id="toggle-results">
    <li id="toggle-post-results">Posts</li>
    <li id="toggle-user-results">Users</li>
  </ul>
  <div class="post-results">
    <?php if(!$post_results): ?>
      <h3 id="message">No Results</h3>
    <?php else: ?>
      <?php foreach($post_results as $post_result): ?>
        <div class="post" onclick="location.href='post?p=<?=escape($post_result->post_id)?>'">
          <img id="post-profile-picture" src="<?=BASE_URL?>/uploads/profile-pictures/<?=escape($post_result->user_profile_picture)?>" alt="<?=escape($post_result->user_profile_picture)?>">
          <h4><a href="profile?u=<?=escape($post_result->user_username)?>"><?=escape($post_result->user_name)?></a></h4>
          <h5>@<?=escape($post_result->user_username)?>
          <h6><?=escape(date('l j F Y \a\t H:i', strtotime($post_result->post_date)))?></h6>
          <p><?=escape($post_result->post_content)?></p>

          <?php if($user_data->user_id === $post_result->post_by): ?>
            <span><a href="?s=<?=escape(str_replace('%', '', $keywords))?>&edit=<?=escape($post_result->post_id)?>">Edit</a><a href="?s=<?=escape(str_replace('%', '', $keywords))?>&delete=<?=escape($post_result->post_id)?>">Delete</a></span>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
  <div class="user-results">
    <?php if(!$user_results): ?>
      <h3 id="message">No Results</h3>
    <?php else: ?>
      <?php foreach($user_results as $user_result): ?>
        <div class="post" onclick="location.href='profile?u=<?=escape($user_result->user_username)?>'">
          <img id="post-profile-picture" src="<?=BASE_URL?>/uploads/profile-pictures/<?=escape($user_result->user_profile_picture)?>" alt="<?=escape($user_result->user_profile_picture)?>">
          <h4><a href="profile?u=<?=escape($user_result->user_username)?>"><?=escape($user_result->user_name)?></a></h4>
          <h5>@<?=escape($user_result->user_username)?>
          <h6><?=escape(date('l j F Y \a\t H:i', strtotime($user_result->user_created)))?></h6>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</div>

<?php include_once 'includes/footer.php'; ?>