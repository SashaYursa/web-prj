<?php

include 'path.php';
include SITE_ROOT .'/app/database/db.php';
    $page = isset($_GET['page'])? $_GET['page']: 1;
    $limit = 2;
    $offset = $limit * ($page - 1);
    $totalPages = round(countRowInSearch('posts', $_GET['search-term']) / $limit, 0);
    

if ($_SERVER['REQUEST_METHOD']=== 'GET' && isset($_GET['search-term'])){
  $posts = searchInTytleAndContent($_GET['search-term'], 'posts', 'users', $limit, $offset);
  if(!$posts){
    $result = "Результатів немає";  
  }else{
    $result = "Результати пошуку"; 
  }
}

include 'app/include/header.php';
?>
    <!--блок мейн-->
  <div class="container">
    <div class="content row">
      <div class="main-content col-12">
        <h2><?= $result ?></h2>
        <?php foreach($posts as $post): ?>
        <div class="post row">
          <div class="img col-12 col-md-4">
            <img src="<?=BASE_URL . 'assets/images/posts/'. $post['img'];?>" alt="<?=  $post['title'];?>" class="img-thumbnail">
          </div>
          <div class="post_text col-12 col-md-8">
            <h3>
              <a href="<?= BASE_URL . 'single.php?post=' .$post['id'];?>"><?php $str = $post['title']; if(strlen($str) > 120) echo mb_substr($str, 0 , 120, 'UTF-8') . '...'; else echo $str;?></a>
            </h3>
            <i class="far fa-user"><?=$post['username'];?></i>
            <i class="far fa-calendar"><?=$post['created_date'];?></i>
            <p class="preview-text">
            <? $str = $post['content']; if(strlen($str) > 60) echo mb_substr($str, 0 , 60, 'UTF-8') . '...'; else echo $str; ?>
            </p>  
    </div>
    <?php endforeach; ?>
    <!-- Pagination-->
    <?php
    if($posts){ 
      include('app/include/pagination.php');
     
    }
    ?>
    <!-- Pagination -->
    </div> 
    </div>
    </div>
  </div>
  </div>
      <!--footer start-->
    <?php
     include('app/include/footer.php');
    ?>
     <!--footer end-->
   