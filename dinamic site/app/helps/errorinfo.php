<?php if(count($errorMsg) > 0): ?>
  <ul>
    <?php foreach ($errorMsg as $error): ?>
      <li><?=$error;?></li>
    <?php endforeach;?>
  </ul>
<?php endif; ?>