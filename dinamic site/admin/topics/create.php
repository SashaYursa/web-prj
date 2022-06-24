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
            <h2>Додавання категорії</h2>
          </div>
          <div class="row add-post">
          <div class="mb-12 col-12 col-md-12 err">
              <!-- Показ масива з помилками -->
            <?php include '../../app/helps/errorinfo.php'; ?>
            </div>
            <form action="create.php" method="post">
              <div class="col">
                <input name="name" value="<?=$name;?>" type="text" class="form-control" placeholder="Ім'я категорії" arial-lable="Ім'я категорії">
              </div>
              <div class="col">
                <label for="content" class="form-label">Опис категорії</label>
                <textarea name="description" class="form-control" id="cotent" rows="6"><?=$description;?></textarea>
              </div>
              <div class="col">
                <button class="btn btn-primary" name="topic-create" type="submit">Створити категорію</button>
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
   