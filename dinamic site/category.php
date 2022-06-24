<?php

include 'path.php';
include 'app/controllers/topics.php';
$page = isset($_GET['page'])? $_GET['page']: 1;
$limit = 2;
$offset = $limit * ($page - 1);
$totalPages = round(countRowInCategory('posts', $_GET['id']) / $limit, 0);
$posts = selectAllFromPostsWithUsersOnIndexToCategory('posts', 'users', $limit, $offset, $_GET['id']);
$category = selectOne('topics', ['id' => $_GET['id']]);

if ($_SERVER['REQUEST_METHOD']=== 'GET' && isset($_GET['id'])){
  $posts = selectAllFromPostsWithUsersOnIndexToCategory('posts', 'users', $limit, $offset, $_GET['id']);
  $result = ' ';
  if(!$posts){
    $result = " Результатів немає";  
  }
}

include 'app/include/header.php';
?>
    <!--блок мейн-->
  <div class="container">
    <div class="content row">
      <div class="main-content col-md-9 col-12">
        <h2>Розділ: <strong><?=$category['name']?></strong><?=$result?></h2>
        <?php foreach($posts as $post):?>
        <div class="post row">
          <div class="img col-12 col-md-4">
            <img src="<?=BASE_URL . 'assets/images/posts/'. $post['img'];?>" alt="<?=  $post['title'];?>" class="img-thumbnail">
          </div>
          <div class="post_text col-12 col-md-8">
            <h3>
              <a href="<?= BASE_URL . 'single.php?post=' .$post['id'];?>"><?php $str = $post['title']; if(strlen($str) > 30) echo mb_substr($str, 0 , 30, 'UTF-8') . '...'; else echo $str;?></a>
            </h3>
            <i class="far fa-user"><?=$post['username'];?></i>
            <i class="far fa-calendar"><?=$post['created_date'];?></i>
            <p class="preview-text">
            <? $str = $post['content']; if(strlen($str) > 60) echo mb_substr($str, 0 , 60, 'UTF-8') . '...'; else echo $str; ?>
            </p> 
      </div>
    </div>
    <?php endforeach; ?>
    <!-- Pagination-->
    <?php
    if($posts) include('app/include/pagination.php');
     
    ?>
    <!-- Pagination-->
    </div>
    <!-- Sidebar-->
      <div class="sidebar col-md-3 col-12">
          <div class="section search">
            <h3>Search</h3>
            <form action="search.php" method="post">
              <input type="text" name="search-term" class="text-input" placeholder="Search...">
            </form>
          </div>    
      <div class="section topics">
        <h3>Categories</h3>
        <ul>
        <?php foreach($alltopics as $key => $val):?>
          <li>
            <a href="<?= BASE_URL . 'category.php?id='.$val['id'];?>"><?=$val['name'];?></a>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
    </div>
    </div>
     <!--Кінець мейн-->
      <!--footer start-->
    <?php
     include('app/include/footer.php');
    ?>
     <!--footer end-->
   