<?php include_once 'includes/header.php'; ?>

<?php include_once 'includes/sidebar.php'; ?>

<div class="posts">
  <?php if(!$posts): ?>
    <h3 id="message">Julie hasn't posted yet.</h3>
  <?php else: ?>
    <?php foreach($posts as $post): ?>
      <div class="post" onclick="location.href='post?p=<?=escape($post->post_id)?>'">
        <img id="post-profile-picture" src="<?=BASE_URL?>/uploads/profile-pictures/<?=escape($post->user_profile_picture)?>" alt="<?=escape($post->user_profile_picture)?>">
        <h4><a href="profile?u=<?=escape($post->user_username)?>"><?=escape($post->user_name)?></a></h4>
        <h5>@<?=escape($post->user_username)?>
        <h6><?=escape(date('l j F Y \a\t H:i', strtotime($post->post_date)))?></h6>
        <p><?=escape($post->post_content)?></p>

        <?php if($user_data->user_id === $post->post_by): ?>
          <span><a href="?u=<?=escape($profile_data->user_username)?>&edit=<?=escape($post->post_id)?>">Edit</a><a href="?u=<?=escape($profile_data->user_username)?>&delete=<?=escape($post->post_id)?>">Delete</a></span>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>

<?php include_once 'includes/footer.php'; ?>