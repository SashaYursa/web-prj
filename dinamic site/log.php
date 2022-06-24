<?php
include('path.php');
include('app/include/header.php');
include('app/controllers/users.php');
?> 
    <!--Form-->
    <div class="container reg_form">
      <form class="row justify-content-center" method="post" action="log.php">
        <h2 class="col-12">Авторизація</h2>
        <div class="mb-12 col-12 col-md-12 err">
              <!-- Показ масива з помилками -->
            <?php include 'app/helps/errorinfo.php'; ?>
            </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
          <label for="formGroupInput" class="form-label">Email</label>
          <input name="email" value="<?=$email ?>" type="email" class="form-control" id="InputEmail" aria-describedby="email">
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
          <label for="InputPassword1" class="form-label">Пароль</label>
          <input name="pass" type="password" class="form-control" id="InputPassword1">
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
        <button type="submit" name="button-log" class="btn btn-secondary">Увійти</button>
        <a href="auth.html">Реєстрація</a>
      </div>
      </form>
    </div>
    <!--EndForm-->
    <!--footer start-->
    <?php
     include('app/include/footer.php');
    ?>
     <!--footer end-->
  