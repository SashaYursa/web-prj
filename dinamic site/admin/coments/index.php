
<?php
include '../../path.php';
include '../../app/controllers/coments.php';
include '../../app/include/header-admin.php';

?>
<link rel="stylesheet" href="../../assets/css/admin.css">
   
     <div class="container">
      <?php include '../../app/include/sidebar-admin.php'; ?>
        <div class="posts col-9">
          <div class="row title-table">
            <h2>Управління коментаря</h2>
            <div class="mb-12 col-12 col-md-12 err">
            <?php include '../../app/helps/errorinfo.php'; ?>
            </div>
            <div class="col-1">ID</div>
            <div class="col-4">Текст</div>
            <div class="col-4">Автор</div>
            <div class="col-3">Управління</div> 
          </div>
          <?php foreach($commentsForAdm as $key => $val): ?>
          <div class="row post">
            <div class="id col-1"><?=$val['id'];?></div>
            <div class="title col-3"><?= mb_substr($val['comment'], 0 , 20, 'UTF-8') . '...';?></div>
            <?php $user = $val['email'];
            $user = explode('@', $user);
            $user = $user[0];
            ?>
            <div class="author col-3"><?=$user . '@';?></div>
            <div class="edit col-2"><a href="edit.php?id=<?=$val['id'];?>">Редагувати</a></div>
            <div class="delete col-2"><a href="index.php?delete_id=<?=$val['id'];?>">Видалити</a></div>
            <?php if($val['status']):?>
            <div class="delete col-1"><a href="index.php?publish=0&pub_id=<?=$val['id'];?>">В чернетку</a></div>
            <?php  else: ?>
            <div class="edit col-1"><a href="index.php?publish=1&pub_id=<?=$val['id'];?>">Публікація</a></div>
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