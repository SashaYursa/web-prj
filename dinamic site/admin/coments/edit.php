
<?php
include '../../path.php';
include '../../app/controllers/coments.php';
include '../../app/include/header-admin.php';

?><link rel="stylesheet" href="../../assets/css/admin.css">
   
     <div class="container">
     <?php include '../../app/include/sidebar-admin.php'; ?>
        <div class="posts col-9">
          <div class="row title-table">
            <h2>Редагування коментаря</h2>
          </div>
          <div class="row add-post">
            <div class="mb-12 col-12 col-md-12 err">
              <!-- Показ масива з помилками -->
            <?php include '../../app/helps/errorinfo.php'; ?>
            </div>
            <form action="edit.php" method="post" enctype="multipart/form-data">
              <input type="hidden" name="id" value="<?=$id;?>">
            <div class="col mb-4">
                <input value="<?=$email?>" name="email" type="text" readonly class="form-control" placeholder="Назва" arial-lable="Назва статті">
              </div>
              <div class="col">
                <label for="editor" class="form-label">Вміст</label>
                <textarea name="content" id="editor" class="form-control" rows="6"><?=$text;?></textarea>
              </div>
              <div class="form-check">
                <?php if (empty($publish) || $publish == 0):?>
                <input name="publish" type="checkbox" class="form-check-input" id="flexCheckChecked">
                <label class="form-check-label" for="flexCheckChecked">
                  Публікація
                </label>
                <?php else: ?>
                  <input name="publish" type="checkbox" class="form-check-input" id="flexCheckChecked" checked>
                <label class="form-check-label" for="flexCheckChecked">
                  Публікація
                </label>
                <?php endif; ?>
              </div>
                
              <div class="col col-6">
                <button name="edit_comment" class="btn btn-primary" type="submit">Зберегти</button>
              </div>
            </form>
          </div>
        </div>
      </div>
     </div> 
    <!--footer start-->
    <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>
    <script src="../../assets/js/scripts.js"></script>
    <?php
     include('../../app/include/footer.php');
    ?>
     <!--footer end-->
   