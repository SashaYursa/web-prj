<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My blog</title>
    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!--Font awsome-->
    <script src="https://kit.fontawesome.com/7ac5fb4e69.js" crossorigin="anonymous"></script>
    <!--Custom Style-->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  </head>
  <body>
  <header class="container-fluid">
          <div class="container">
            <div class="row">
              <div class="col-4">
                <h1>
                <a href="<?php echo BASE_URL?>">My blog</a>  
                </h1>
              </div>
              <nav class="col-8">
                <ul>
                  <li>
                    <?php if (isset($_SESSION['id'])): ?>
                    <a href="">
                      <i class="fa fa-user"></i>
                      <?php echo $_SESSION['login']; ?>
                    </a>
                    <ul>
                      <?php if ($_SESSION['admin']): ?>
                      <li><a href=<?= BASE_URL ."admin/posts/index.php"?>>Адмін панель</a></li>
                      <?php endif; ?>
                      <li><a href="<?php echo BASE_URL .'/logout.php'?>">Вихід</a></li>
                    </ul>
                    <?php else: ?>
                    <a href="<?php echo BASE_URL . '/log.php';?>">
                      <i class="fa fa-user"></i>
                      Увійти
                    </a>
                    <ul>
                      <li><a href="<?php echo BASE_URL . '/reg.php';?>">Реєстрація</a></li>
                    </ul>
                    <?php endif; ?>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
      </header>