
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
                    <a href="">
                      <i class="fa fa-user"></i>
                      <?php echo $_SESSION['login']; ?>
                    </a>
                    </li>          
                      <li>
                        <a href="<?php echo BASE_URL .'/logout.php'?>">Вихід</a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
      </header>