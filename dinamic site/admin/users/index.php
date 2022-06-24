
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
            <h2>Користувачі</h2>
            <div class="col-1">ID</div>
            <div class="col-2">Логін</div>
            <div class="col-3">email</div>
            <div class="col-2">Роль</div>
            <div class="col-4">Редагування</div>
          </div>
          <?php foreach($users as $key => $val): ?>
          <div class="row post">
          <div class="col-1"><?=$val['id'];?></div>
            <div class="col-2"><?=$val['username'];?></div>
            <div class="col-4"><?=$val['email'];?></div>
            <?php if($val['admin'] == 1): ?>
            <div class="col-1">Admin</div>
            <?php else: ?>
            <div class="col-1">User</div>
            <?endif; ?>
            <div class="edit col-2"><a href="edit.php?edit_id=<?=$val['id'];?>">Редагувати</a></div>
            <div class="delete col-2"><a href="index.php?delete_id=<?=$val['id'];?>">Видалити</a></div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
     </div> 
    <!--footer start-->
    <?php
     include('../../app/include/footer.php');
    ?>
     <!--footer end-->
   