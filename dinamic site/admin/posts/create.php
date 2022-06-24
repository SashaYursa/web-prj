
<?php
include '../../path.php';
include '../../app/controllers/post.php';
include '../../app/include/header-admin.php';

?><link rel="stylesheet" href="../../assets/css/admin.css">
   
     <div class="container">
     <?php include '../../app/include/sidebar-admin.php'; ?>
        <div class="posts col-9">
        <div class="button row">
            <a href="<?php echo BASE_URL . "admin/posts/create.php";?>" class="col-4 btn btn-success">Створити</a>
            <span class="col-1"></span>
            <a href="<?php echo BASE_URL . "admin/posts/index.php";?>" class="col-4 btn btn-warning">Змінити</a>
          </div>
          <div class="row title-table">
            <h2>Додавання записів</h2>
          </div>
          <div class="row add-post">
            <div class="mb-12 col-12 col-md-12 err">
              <!-- Показ масива з помилками -->
            <?php include '../../app/helps/errorinfo.php'; ?>
            </div>
            <form action="create.php" method="post" enctype="multipart/form-data">
              <div class="col mb-4">
                <input value="<?=$title;?>" name="title" type="text" class="form-control" placeholder="Назва" arial-lable="Назва статті">
              </div>
              <div class="col">
                <label for="editor" class="form-label">Вміст</label>
                <textarea name="content" id="editor" class="form-control" rows="6"><?=$content;?></textarea>
              </div>
              <div class="input-group col mb-4 mt-4">
                <input name="img" type="file" class="form-control" id="inputGroupFile02">
              </div>
              <select name="topic" class="form-select mb-4" aria-label="Default select example"> 
                <?php foreach($alltopics as $key => $val):?>
                  <option value="<?=$val['id'];?>"><?=$val['name'];?></option>
                <?php endforeach; ?>
                </select>

              <div class="form-check">
                <input name="publish" type="checkbox" class="form-check-input" value="1" id="flexCheckChecked" checked>
                <label class="form-check-label" for="flexCheckChecked">
                  Публікація
                </label>
              </div>
                
              <div class="col col-6">
                <button name="add_post" class="btn btn-primary" type="submit">Додати запис</button>
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
   