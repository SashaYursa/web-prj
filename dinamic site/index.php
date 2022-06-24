<?php

include 'path.php';
include 'app/controllers/topics.php';

$page = isset($_GET['page'])? $_GET['page']: 1;
$limit = 2;
$offset = $limit * ($page - 1);
$totalPages = round(countRow('posts') / $limit, 0);

$posts = selectAllFromPostsWithUsersOnIndex('posts', 'users', $limit, $offset);
$topTopics = selectTopTopicFromPostsOnIndex('posts');
include 'app/include/header.php';
?>
   <!-- Карусель-->
   <div class="container">
    <div class="row">
      <h2 class="slider-title">Топ записи</h2>
    </div>
   <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
    
   <div class="carousel-inner">
    <?php foreach ($topTopics as $key => $post): ?>
      <?php if ($key == 0): ?>
          <div class="carousel-item active">
        <?php else: ?>
          <div class="carousel-item">
        <?php endif; ?>
            <img src="<?=BASE_URL . 'assets/images/posts/'. $post['img'];?>" alt="<?=  $post['title'];?>" class="d-block w-100">
            <div class="carousel-caption-hack carousel-caption d-none d-md-block">
            <h5><a href="<?= BASE_URL . 'single.php?post=' .$post['id'];?>"><?php $str = $post['title']; if(strlen($str) > 82) echo mb_substr($str, 0 , 82, 'UTF-8') . '...'; else echo $str;?></a></h5>
            </div>
          </div>
      <?php endforeach; ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</div>
   <!--Кінець каруселі-->
    <!--блок мейн-->
  <div class="container">
    <div class="content row">
      <div class="main-content col-md-9 col-12">
        <h2>Остання публікація</h2>
        <?php foreach($posts as $post): ?>
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
     include('app/include/pagination.php');
    ?>
    <!-- Pagination-->
    </div>
    
    <!-- Sidebar-->
      <div class="sidebar col-md-3 col-12">
          <div class="section search">
            <h3>Search</h3>
            <form action="search.php" method="get">
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
   