<?php
include('path.php');
include 'app/controllers/topics.php';
//$post = selectOne('posts', ['id' => $_GET['post']]);

$post = selectPostFromPostsWithUsersOnSingle('posts', 'users', $_GET['post']);
include('app/include/header.php');
?>
  <!--блок мейн-->
  <div class="container">
    <div class="content row">
      <div class="main-content col-md-9 col-12">
        <h2><?php echo $post['title']?></h2>
        <div class="single_post row">
          <div class="img col-12">
            <img src="<?=BASE_URL . 'assets/images/posts/'. $post['img'];?>" alt="<?=  $post['title'];?>" class="img-thumbnail">
          </div>
          <div class="info">
            <i class="far fa-user"><?=$post['username']?></i>
            <i class="far fa-calendar"><?=$post['created_date']?></i>
          </div>
          <div class="single_post_text col-12">
          <?= $post['content'] ?>
          <!-- include comments start -->
          </div>
          <?php include('app/include/coments.php'); ?>
          </div>
          <!-- include comments end -->
    </div>
      <div class="sidebar col-md-3 col-12">
          <div class="section search">
            <h3>Search</h3>
            <form action="/" method="post">
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