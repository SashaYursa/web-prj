<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">  
    <li class="page-item">
      <a class="page-link" href="?page=1<?php if(isset($_GET['search-term'])) echo ('&search-term='.$_GET['search-term']);
      if(isset($_GET['id'])) echo ('&id='.$_GET['id']);?>">First</a>
    </li>
    <?php if($page > 1):?>
      <li class="page-item">
      <a class="page-link" href="?page=<?php echo ($page - 1);
      if(isset($_GET['search-term'])) echo ('&search-term='.$_GET['search-term']);
      if(isset($_GET['id'])) echo ('&id='.$_GET['id']);?>"><? echo ($page - 1);?></a>
    </li>
    <?php endif; ?>
    <li class="page-item">
      <a class="item static"><?php echo $page;?></a>
    </li>
    <?php if($page < $totalPages):?>
      <li class="page-item">
      <a class="page-link" href="?page=<?php echo ($page + 1);
      if(isset($_GET['search-term'])) echo ('&search-term='.$_GET['search-term']);
      if(isset($_GET['id'])) echo ('&id='.$_GET['id']);?>"><? echo ($page + 1);?></a>
    </li>
    <?php endif;?>
    <li class="page-item">
      <a class="page-link" href="?page=<?php echo $totalPages;
      if(isset($_GET['search-term'])) echo ('&search-term='.$_GET['search-term']);
      if(isset($_GET['id'])) echo ('&id='.$_GET['id']);?>">Last</a>
    </li>
  </ul>
</nav>