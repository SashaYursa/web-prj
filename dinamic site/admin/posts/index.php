
<?php
include '../../path.php';
include '../../app/controllers/post.php';
include '../../app/include/header-admin.php';
?>
<link rel="stylesheet" href="../../assets/css/admin.css">
   
     <div class="container">
      <?php include '../../app/include/sidebar-admin.php'; ?>
        <div class="posts col-9">
          <div class="button row">
            <a href="<?php echo BASE_URL . "admin/posts/create.php";?>" class="col-4 btn btn-success">Створити</a>
            <span class="col-1"></span>
            <a href="<?php echo BASE_URL . "admin/posts/index.php";?>" class="col-4 btn btn-warning">Змінити</a>
          </div>
          <div class="row title-table">
            <h2>Управління записами</h2>
            <div class="col-1">ID</div>
            <div class="col-3">Назва</div>
            <div class="col-2">Автор</div>
            <div class="col-2">Редагувати</div>
            <div class="col-2">Видалити</div>
            <div class="col-2">Статус</div>
          </div>
          <?php foreach($allposts as $key => $val): ?>
          <div class="row post">
            <div class="id col-1"><?=$key + 1;?></div>
            <div class="title col-3"><?= mb_substr($val['title'], 0 , 30, 'UTF-8');?></div>
            <div class="author col-2"><?=$val['username'];?></div>
            <div class="edit col-2"><a href="edit.php?id=<?=$val['id'];?>">Редагувати</a></div>
            <div class="delete col-2"><a href="edit.php?delete_id=<?=$val['id'];?>">Видалити</a></div>
            <?php if($val['status']):?>
            <div class="delete col-2"><a href="edit.php?publish=0&pub_id=<?=$val['id'];?>">В чернетку</a></div>
            <?php  else: ?>
            <div class="edit col-2"><a href="edit.php?publish=1&pub_id=<?=$val['id'];?>">Публікація</a></div>
            <?php  endif; ?>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
     </div> 
    <!--footer start-->
    <?php
     include('../../app/include/footer.php');
    ?>