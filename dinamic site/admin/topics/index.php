
<?php
include '../../path.php';
include '../../app/controllers/topics.php';
include '../../app/include/header-admin.php';

?><link rel="stylesheet" href="../../assets/css/admin.css">
   
     <div class="container">
     <?php include '../../app/include/sidebar-admin.php'; ?>
        <div class="posts col-9">
        <div class="button row">
            <a href="<?php echo BASE_URL . "admin/topics/create.php";?>" class="col-4 btn btn-success">Створити</a>
            <span class="col-1"></span>
            <a href="<?php echo BASE_URL . "admin/topics/index.php";?>" class="col-4 btn btn-warning">Змінити</a>
          </div>
          <div class="row title-table">
            <h2>Управління категоріями</h2>
            <div class="col-1">ID</div>
            <div class="col-5">Назва</div>
            <div class="col-6">Редагування</div>
          </div>
          <?php foreach($alltopics as $key => $val):?>
          <div class="row post">
            <div class="id col-1"><?=$key + 1;?></div>
            <div class="title col-5"><?=$val['name'];?></div>
            <div class="edit col-2"><a href="edit.php?id=<?=$val['id'];?>">Редагувати</a></div>
            <div class="edit col-2"></div>
            <div class="delete col-2"><a href="edit.php?del_id=<?=$val['id'];?>">Видалити</a></div>
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
   