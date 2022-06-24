
<?php
include '../../path.php';
include '../../app/controllers/users.php';
include '../../app/include/header-admin.php';

?><link rel="stylesheet" href="../../assets/css/admin.css">
   
     <div class="container">
     <?php include '../../app/include/sidebar-admin.php'; ?>
        <div class="posts col-9">
        <div class="button row">
            <a href="<?php echo BASE_URL . "admin/users/create.php";?>" class="col-4 btn btn-success">Створити</a>
            <span class="col-1"></span>
            <a href="<?php echo BASE_URL . "admin/users/index.php";?>" class="col-4 btn btn-warning">Змінити</a>
          </div>
          <div class="row title-table">
            <h2>Створення користувача</h2>
          </div>
          <div class="row add-post">
          <div class="mb-12 col-12 col-md-12 err">
              <!-- Показ масива з помилками -->
            <?php include '../../app/helps/errorinfo.php'; ?>
            </div>
            <form action="create.php" method="post">
            <div class="col">
          <label for="GroupExampleInput" class="form-label">Логін</label>
          <input name="login"  value="<?=$login ?>" type="text" class="form-control" id="formGroupExampleInput">
        </div>
        <div class="col">
          <label for="InputEmail" class="form-label">Email</label>
          <input name="email"  value="<?=$email ?>" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
         </div>
        <div class="col">
          <label for="InputPassword" class="form-label">Пароль</label>
          <input name="password" type="password" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="col">
          <label for="InputPassword" class="form-label">Підтвердження паролю</label>
          <input name="password-submit" type="password" class="form-control" id="exampleInputPassword2">
        </div>
        <input name="admin" value="1" type="checkbox" class="form-check-input" id="flexCheckChecked">
                <label class="form-check-label" for="flexCheckChecked">
                  Адмін
                </label>
          <div class="col">
            <button name="create-user" class="btn btn-primary" type="submit">Створити</button>
           </div>
            </form>
          </div>
        </div>
      </div>
     </div> 
    <!--footer start-->
    <?php
     include('../../app/include/footer.php');
    ?>
     <!--footer end-->
   