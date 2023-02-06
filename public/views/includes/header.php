<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="<?=BASE_URL?>/public/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?=BASE_URL?>/public/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?=BASE_URL?>/public/img/favicons/favicon-16x16.png">
    <link rel="manifest" href="<?=BASE_URL?>/public/img/favicons/site.webmanifest">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="<?=BASE_URL?>/public/css/style.css" rel="stylesheet">
    <script src="<?=BASE_URL?>/public/js/script.js" defer></script>
    <title><?=isset($page_title) ? 'microblog &bull; ' . $page_title : 'microblog'?></title>
  </head>
  <body>
    <header>
      <h1 id="logo"><a href="<?=BASE_URL?>">microblog</a></h1>

      <?php if($user->loggedIn()): ?>
        <img id="toggle-menu" src="<?=BASE_URL?>/public/img/menu.svg" alt="Toggle Menu">

        <div class="menu">
          <ul>
            <a href="profile?u=<?=escape($user_data->user_username)?>"><li>Your Profile</li></a>
            <a href="update"><li>Update Profile</li></a>
            <a href="logout"><li>Log Out</li></a>
          </ul>
        </div>
      <?php endif; ?>
    </header>
    <div class="content">