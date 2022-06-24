<?php
include('path.php');
include('app/controllers/users.php');
include('app/include/header.php');
?>
    <!--Form-->
    <div class="container reg_form">
      <form class="row justify-content-center" method="post" action="reg.php">
        <h2 class="col-12">Реєстрація</h2>
        <div class="mb-3 col-12 col-md-4 err">
            <p><?=$errorMsg?></p>
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
          <label for="GroupExampleInput" class="form-label">Логін</label>
          <input name="login" value="<?=$login ?>" type="text" class="form-control" id="formGroupExampleInput" placeholder="Ваш логін">
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
          <label for="InputEmail" class="form-label">Email</label>
          <input name="email"  value="<?=$email ?>" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
          <div id="emailHelp" class="form-text">Ваш email не буде використаний для спаму</div>
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
          <label for="InputPassword" class="form-label">Пароль</label>
          <input name="password" type="password" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
          <label for="InputPassword" class="form-label">Підтвердження паролю</label>
          <input name="password-submit" type="password" class="form-control" id="exampleInputPassword2">
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
        <button type="submit" name="button-reg" class="btn btn-secondary">Відправити</button>
        <a href="log.php">Авторизація</a>
      </div>
      </form>
    </div>
    <!--EndForm-->
     <!--footer start-->
     <?php
     include('app/include/footer.php');
    ?>
     <!--footer end-->
