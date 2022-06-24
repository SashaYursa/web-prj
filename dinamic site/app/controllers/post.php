<?php

include SITE_ROOT . '/app/database/db.php';
if(!$_SESSION){
  header('location: ' . BASE_URL . 'log.php');
}

$errorMsg = [];
$id = '';
$title = '';
$content = '';
$img = '';
$topic = '';
$publish = '';
$fileSize = 1536000;
$imageWidth = 1920;
$imageHeight = 1080;

$alltopics = selectAll('topics');

$allposts = selectAllFromPostsWithUsers('posts', 'users');
// Форма створення запису
if($_SERVER['REQUEST_METHOD'] === 'POST' and isset($_POST['add_post'])){
  if(!empty($_FILES['img']['name'])){
    $imgName = time() . "_" . $_FILES['img']['name'];
    $fileTmpName = $_FILES['img']['tmp_name'];
    $fileType = $_FILES['img']['type'];
    $destination = ROOT_PATH . "\assets\images\posts\\" . $imgName;
    $imageSize = getimagesize($fileTmpName);
      if(strpos($fileType, 'image') === false){
        array_push($errorMsg, "Потрібно вибрати картинку");
        $_POST['img'] = '';
      }
      elseif($imageSize['0']>$imageWidth || $imageSize['1']>$imageHeight){
        array_push($errorMsg, "Розмір картинки дуже великий");}
        else{
        $result = move_uploaded_file($fileTmpName, $destination);
        if($result){
          $_POST['img'] = $imgName;
        }
        else{
          array_push($errorMsg, "Помилка при завантаженні зображення на сервер");
          $_POST['img'] = '';
        }
      }
  }
  else{
    array_push($errorMsg, "Помилка при отриманні картинки");
    $_POST['img'] = '';
  }
  if (empty($errorMsg)){
  $title = trim($_POST['title']);
  $content = trim($_POST['content']);
  $topic = trim($_POST['topic']);
  $img = $_POST['img'];
  $publish = isset($_POST['publish']) ? 1 : 0;
 
  if($title === '' || $content === '' || $topic === ''){
    array_push($errorMsg, "Не всі поля заповнені");
  }elseif(mb_strlen($title, 'UTF8') < 5){
    array_push($errorMsg, "Назва статті повинна бути більше 5-ти символів");
  }else{ 
    $post = [
    'id_user' => $_SESSION['id'],
    'title' => $title,
    'content' => $content,
    'img' => $img,
    'status' => $publish,
    'id_topic' => $topic,
    ];
   $post = insert('posts', $post);
   $topic = selectOne('posts', ['id' => $id]);
   header('location: ' . BASE_URL . 'admin/posts/index.php');
  }
}else{
  $id = '';
  $title = '';
  $content = '';
  $publish = '';
  $topic = '';
}
}
else{
  $id = '';
  $title = '';
  $content = '';
  $publish = '';
  $topic = '';
}

// Редагування категорій
if($_SERVER['REQUEST_METHOD'] === 'GET' and isset($_GET['id'])){
  $post = selectOne('posts', ['id' => $_GET['id']]);
  
  $id = $post['id'];
  $title = $post['title'];
  $content = $post['content'];
  $topic_id = $post['id_topic'];
  $publish = $post['status'];
}

if($_SERVER['REQUEST_METHOD'] === 'POST' and isset($_POST['edit_post'])){
  $id = $_POST['id'];
  $title = trim($_POST['title']);
  $content = trim($_POST['content']);
  $topic = trim($_POST['topic']);
  $publish = isset($_POST['publish'])? 1 : 0;

  if(!empty($_FILES['img']['name'])){
    $imgName = time() . "_" . $_FILES['img']['name'];
    $fileTmpName = $_FILES['img']['tmp_name'];
    $fileType = $_FILES['img']['type'];
    $destination = ROOT_PATH . "\assets\images\posts\\" . $imgName;
    $imageSize = getimagesize($fileTmpName);
      if(strpos($fileType, 'image') === false){
        array_push($errorMsg, "Потрібно вибрати картинку");
        $_POST['img'] = '';
      }
      elseif($imageSize['0']>$imageWidth || $imageSize['1']>$imageHeight){
        array_push($errorMsg, "Розмір картинки дуже великий");}
        else{
        $result = move_uploaded_file($fileTmpName, $destination);
        if($result){
          $_POST['img'] = $imgName;
        }
        else{
          array_push($errorMsg, "Помилка при завантаженні зображення на сервер");
          $_POST['img'] = '';
        }
      }
  }
  else{
    array_push($errorMsg, "Помилка при отриманні картинки");
    $_POST['img'] = '';
  } 
  if($title === '' || $content === '' || $topic === ''){
    array_push($errorMsg, "Не всі поля заповнені");
  }elseif(mb_strlen($title, 'UTF8') < 5){
    array_push($errorMsg, "Назва статті повинна бути більше 5-ти символів");
  }else{
    $post = [
      'id_user' => $_SESSION['id'],
      'title' => $title,
      'content' => $content,
      'img' => $_POST['img'],
      'status' => $publish,
      'id_topic' => $topic,
      ];

   $post = update('posts', $id, $post);
   header('location: ' . BASE_URL . 'admin/posts/index.php');
  }
}else{
  $title = '';
  $content = '';
  $publish = isset($_POST['publish']) ? 1 : 0;
  $topic = '';
}
// Статус публікації
if($_SERVER['REQUEST_METHOD'] === 'GET' and isset($_GET['pub_id'])){
  $id = $_GET['pub_id'];
  $publish = $_GET['publish'];

  $postId = update('posts', $id, ['status' => $publish]);

  header('location: ' . BASE_URL . 'admin/posts/index.php');
  exit();
}

// Видалення категорій
if($_SERVER['REQUEST_METHOD'] === 'GET' and isset($_GET['delete_id'])){
  $id = $_GET['delete_id'];
  delete('posts', $id);
  header('location: ' . BASE_URL . 'admin/posts/index.php');
}
